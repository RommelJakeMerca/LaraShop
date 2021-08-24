<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\QREmailer;
use App\Http\Controllers\Controller;
use App\Models\RegionsModel;
use App\Models\ProvincesModel;
use App\Models\CitiesModel;
use App\Models\StoreBranchesModel;
use App\Models\ProductCategoriesModel;
use App\Models\ProductSubcategoriesModel;
use App\Models\ProductsModel;
use App\Models\AnnouncementsModel;
use App\Models\ClientOrderModel;
use App\Models\ClientUser;
use App\Models\Roles\RoleModel;
use App\Models\Roles\RoleUsers;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Session;
use Image;
use Sentinel;

class MainDashboardController extends Controller
{
    //function to not let guest users access the admin panel
    public function show_landing() {
        if(Sentinel::check()){
            if(Sentinel::getUser()->roles->first()->name == 'SuperAdmin'){
                Session::flash('statuscode', 'success');
                return redirect('show_dashboard_main')->with('status', 'Session Exists, Welcome back!');
            }else{
                return view('landing.landing');
            }
        }else{
            return view('landing.landing');

        }
    }

    //function to not let guest users access the admin panel
    public function only_admin() {
        if(Sentinel::check()){
            if(Sentinel::getUser()->roles->first()->name == 'SuperAdmin'){
                Session::flash('statuscode', 'success');
                return redirect('show_dashboard_main')->with('status', 'Session Exists, Welcome back!');
            }else{
                return redirect('/');
            }
        }else{
            return view('security.admin_reglog');
        }
    }

// dashboard
    // to show dashboard
    public function show_dashboard_main() {
        $announcements = AnnouncementsModel::orderBy('id', 'desc')->take(3)->get();
        $orders = ClientOrderModel::count();
        $clients = ClientUser::count();
        $admin_users = Sentinel::getUserRepository()->count();
        $products = ProductsModel::count();
        $approvals = ClientOrderModel::where('status', '=', "For Approval")->count();

        return view('main_admin.dashboard.main_dashboard')->with('announcements', $announcements)
                                                        ->with('orders', $orders)
                                                        ->with('clients', $clients)
                                                        ->with('admin_users', $admin_users)
                                                        ->with('products', $products)
                                                        ->with('approvals', $approvals);
    }
    // to show announcements
    public function show_announcements() {
        $announcements = AnnouncementsModel::all();
        return view('main_admin.announcements.announcements')->with('announcements', $announcements);
    }
    // to add announcements
    public function add_announcement(Request $request) {
        $announcement = new AnnouncementsModel;
        if ($request->hasFile('announcement_image'))  {
            $image = $request->file('announcement_image');
            $extension = $image->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $image->move('uploads/announcement_images/', $filename);
            $announcement->announcement_image = $filename;
        }
        $announcement->announcement_urgency = $request->input('announcement_urgency');
        $announcement->announcement_subject	 = $request->input('announcement_subject');
        $announcement->announcement_details = $request->input('announcement_details');

        $announcement->save();
        Session::flash('statuscode', 'info');
        return redirect('show_dashboard_main')->with('status', 'Announcement Added Successfully!');
    }
    // to show page for announcement details
    public function announcement_details($id){
        $announcement = AnnouncementsModel::findOrfail($id);
        return view('main_admin.dashboard.announcements_details')->with('announcement', $announcement);
    }
    // announcement confirm delete
    public function delete_announcement($id) {
        $announcement = AnnouncementsModel::findOrfail($id);
        $announcement->delete();
        Session::flash('statuscode', 'error');
        return redirect('show_announcements')->with('status', 'Announcement Deleted!');
    }
    // to show page for updating announcement
    public function announcement_update($id){
        $announcement = AnnouncementsModel::findOrfail($id);
        return view('main_admin.announcements.announcement_update')->with('announcement', $announcement);
    }
    // to update the announcement
    public function announcement_update_action(Request $request, $id){
        $announcement = AnnouncementsModel::findOrfail($id);
        if ($request->hasFile('announcement_image'))  {
            $image = $request->file('announcement_image');
            $extension = $image->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $image->move('uploads/announcement_images/', $filename);
            $announcement->announcement_image = $filename;
        }   
        $announcement->announcement_subject = $request->input('announcement_subject');
        $announcement->announcement_urgency = $request->input('announcement_urgency');
        $announcement->announcement_details = $request->input('announcement_details');
        
        $announcement->update();
        Session::flash('statuscode', 'info');
        return redirect('show_announcements')->with('status', 'Announcement Updated Successfully!');
    }

// Orders
    // to show latest orders
    public function show_latest_order() {
        $latest_order = ClientOrderModel::all()->last();
        if($latest_order == null){
            Session::flash('statuscode', 'info');
            return redirect('show_dashboard_main')->with('status', 'No Latest Orders yet, maybe try again later.');
        }else {
            $products = ProductsModel::whereIn('id', $latest_order->product_ids)->get();
            $client = ClientUser::all()->where('id', '==', $latest_order->client_id)->last();
            return view('main_admin.orders.latest_order')->with('latest_order', $latest_order)
                                                    ->with('products', $products)
                                                    ->with('client', $client);
        }
    }
    // to approve order
    public function approve_order(Request $request, $id){
        $order = ClientOrderModel::findOrfail($id);
        $order->status = "Approved";
        
        $ids = json_encode($order->product_ids);
        $qr_code = QrCode::size(300)->generate(
            "Order ID:" . ' ' . $order->id. 
            "\r\n" . 
            "Client ID:" . ' ' .$order->client_id.
            "\r\n" . 
            "Mode of Payment:" . ' ' .$order->mode_of_payment.
            "\r\n" . 
            "Total Payment:" . ' ' .$order->total_payment.
            "\r\n" . 
            "Items Ordered:".
            "\r\n" . 
            "Item IDs:" . ' ' .$ids
        );

        $order->update();
        return view('main_admin.orders.qr_code')->with('qr_code', $qr_code)
                                                ->with('order', $order);
    }
    // to send the QR code to email of client and client's beneficiary
    public function sendQREmail($id){
        $order = ClientOrderModel::findOrfail($id);
        $client = ClientUser::all()->where('id', '==', $order->client_id)->last();
        $details = [
            'title' => 'Hey there'. ' ' .$client->name,
            'body' => 'Please click on the button below to show your QR Code'
        ];

        Mail::to($client->email)->send(new QREmailer($details,$order));
        $order->email_status = "Sent";
        $order->update();
        Session::flash('statuscode', 'info');
        return redirect('show_latest_order')->with('status', 'Email Sent Successfully!');
    }
    // for client to get his/her qr code
    public function getqr_code($id){
        $order = ClientOrderModel::findOrfail($id);
        $ids = json_encode($order->product_ids);
        $qr_code = QrCode::size(300)->generate(
            "Order ID:" . ' ' . $order->id. 
            "\r\n" . 
            "Client ID:" . ' ' .$order->client_id.
            "\r\n" . 
            "Mode of Payment:" . ' ' .$order->mode_of_payment.
            "\r\n" . 
            "Total Payment:" . ' ' .$order->total_payment.
            "\r\n" . 
            "Items Ordered:".
            "\r\n" . 
            "Item IDs:" . ' ' .$ids
        );
        return view('client.get_qr')->with('qr_code', $qr_code);
    }
    // to show qr code of order
    public function show_qr_of_order($id){
        $order = ClientOrderModel::findOrfail($id);
        $ids = json_encode($order->product_ids);
        $qr_code = QrCode::size(300)->generate(
            "Order ID:" . ' ' . $order->id. 
            "\r\n" . 
            "Client ID:" . ' ' .$order->client_id.
            "\r\n" . 
            "Mode of Payment:" . ' ' .$order->mode_of_payment.
            "\r\n" . 
            "Total Payment:" . ' ' .$order->total_payment.
            "\r\n" . 
            "Items Ordered:".
            "\r\n" . 
            "Item IDs:" . ' ' .$ids
        );
        return view('main_admin.orders.qr_code')->with('qr_code', $qr_code)
                                                ->with('order', $order);
    }
    // to decline order
    public function decline_order(Request $request, $id){
        $order = ClientOrderModel::findOrfail($id);
        $order->status = "Declined";

        $order->update();
        Session::flash('statuscode', 'info');
        return redirect('show_latest_order')->with('status', 'Order Declined Successfully!');
    }
    // to show approved orders
    public function show_approved_orders() {
        $approved_orders = ClientOrderModel::all()->where('status', '==', 'Approved');

        return view('main_admin.orders.approved_orders')->with('approved_orders', $approved_orders);
    }
    // to show declined orders
    public function show_declined_orders() {
        $declined_orders = ClientOrderModel::all()->where('status', '==', 'Declined');

        return view('main_admin.orders.declined_orders')->with('declined_orders', $declined_orders);
    }
    // to show orders history
    public function show_order_history() {
        $orders = ClientOrderModel::all();

        return view('main_admin.orders.orders_history')->with('orders', $orders);
    }
    // to show order details
    public function show_order_details($id){
        $order = ClientOrderModel::findOrfail($id);
        $products = ProductsModel::whereIn('id', $order->product_ids)->get();
        $client = ClientUser::all()->where('id', '==', $order->client_id)->last();
        return view('main_admin.orders.order_details')->with('order', $order)
                                                    ->with('products', $products)
                                                    ->with('client', $client);
    }
    
    
// regions
    // to show regions
    public function show_regions() {
        $regions = RegionsModel::all();
        $branches = StoreBranchesModel::all();

        return view('main_admin.region.regions')->with('regions', $regions)
                                                ->with('branches', $branches);
    }
    // add regions
    public function add_region(Request $request) {
        $region = new RegionsModel;
        $region->region_number = $request->input('region_number');
        $region->region_name = $request->input('region_name');

        $region->save();
        Session::flash('statuscode', 'success');
        return redirect('show_regions')->with('status', 'Region Added Successfully!');
    }
    // region confirm delete
    public function delete_region($id) {
        $region = RegionsModel::findOrfail($id);
        $region->delete();
        Session::flash('statuscode', 'error');
        return redirect('show_regions')->with('status', 'Region Deleted!');
    }
    // to show page for updating region
    public function region_update($id){
        $region = RegionsModel::findOrfail($id);
        return view('main_admin.region.regions_update')->with('region', $region);
    }
    // to update the region
    public function region_update_action(Request $request, $id){
        $region = RegionsModel::findOrfail($id);
        $region->region_number = $request->input('region_number');
        $region->region_name = $request->input('region_name');

        $region->update();
        Session::flash('statuscode', 'info');
        return redirect('show_regions')->with('status', 'Region Updated Successfully!');
    }


// provinces
    // to show provinces
    public function show_provinces() {
        $provinces = ProvincesModel::all();
        $regions = RegionsModel::all();
        $branches = StoreBranchesModel::all();
        
        return view('main_admin.province.provinces')->with('provinces', $provinces)
                                        ->with('regions', $regions)
                                        ->with('branches', $branches);
    }
    // add province
    public function add_province(Request $request) {
        $province = new ProvincesModel;
        $region = RegionsModel::all()->where('region_number', '==', $request->input('region_number'))->first();
        $province->region_number = $request->input('region_number');
        $province->province_name = $request->input('province_name');
        $province->region_id = $region->id;

        $province->save();
        Session::flash('statuscode', 'success');
        return redirect('show_provinces')->with('status', 'Province Added Successfully!');
    }
    // province confirm delete
    public function delete_province($id) {
        $province = ProvincesModel::findOrfail($id);
        $province->delete();
        Session::flash('statuscode', 'error');
        return redirect('show_provinces')->with('status', 'Province Deleted!');
    }
    // to show page for updating province
    public function province_update($id){
        $province = ProvincesModel::findOrfail($id);
        return view('main_admin.province.province_update')->with('province', $province);
    }
    // to update the province
    public function province_update_action(Request $request, $id){
        $province = ProvincesModel::findOrfail($id);
        $province->region_number = $request->input('region_number');
        $province->province_name = $request->input('province_name');

        $province->update();
        Session::flash('statuscode', 'info');
        return redirect('show_provinces')->with('status', 'Province Updated Successfully!');
    }

// cities
    // to show cities
    public function show_cities() {
        $regions = RegionsModel::all();
        $provinces = ProvincesModel::all();
        $cities = CitiesModel::all();
        $branches = StoreBranchesModel::all();

        return view('main_admin.city.cities')->with('provinces', $provinces)
                                        ->with('regions', $regions)
                                        ->with('cities', $cities)
                                        ->with('branches', $branches);
    }
    // Fetch records
    public function getProvinces($departmentid=0){
        // Fetch Employees by Departmentid
        $empData['data'] = ProvincesModel::orderby("province_name","asc")
        ->select('province_name')
        ->where('region_id', $departmentid)
        ->get();

        return response()->json($empData);
    }
    // add city
    public function add_city(Request $request) {
        $city = new CitiesModel;
        $region = RegionsModel::all()->where('id', '==', $request->input('region_number'))->first();
        $province = ProvincesModel::all()->where('province_name', '==', $request->input('province_name'))->first();
        $region_number = $region->region_number;
        $city->region_number = $region_number;
        $city->province_name = $request->input('province_name');
        $city->city_name = $request->input('city_name');
        $city->province_id = $province->id;
        $city->region_id = $region->id;

        $city->save();
        Session::flash('statuscode', 'success');
        return redirect('show_cities')->with('status', 'City Added Successfully!');
    }
    // city confirm delete
    public function delete_city($id) {
        $city = CitiesModel::findOrfail($id);
        $city->delete();
        Session::flash('statuscode', 'error');
        return redirect('show_cities')->with('status', 'City Deleted!');
    }
    // to show page for updating province
    public function city_update($id){
        $regions = RegionsModel::all();
        $provinces = ProvincesModel::all();
        $city = CitiesModel::findOrfail($id);
        return view('main_admin.city.city_update')->with('provinces', $provinces)
                                        ->with('regions', $regions)
                                        ->with('city', $city);
    }
    // to update the city
    public function city_update_action(Request $request, $id){
        $city = CitiesModel::findOrfail($id);
        $city->region_number = $request->input('region_number');
        $city->province_name = $request->input('province_name');
        $city->city_name = $request->input('city_name');

        $city->update();
        Session::flash('statuscode', 'info');
        return redirect('show_cities')->with('status', 'City Updated Successfully!');
    }

// store branches
    // to show store branches
    public function show_branches() {
        $regions = RegionsModel::all();
        $provinces = ProvincesModel::all();
        $cities = CitiesModel::all();
        $stores = StoreBranchesModel::all();
        return view('main_admin.store.store_branches')->with('provinces', $provinces)
                                        ->with('regions', $regions)
                                        ->with('cities', $cities)
                                        ->with('stores', $stores);
    }
    // Fetch records
    public function getCities($id=0){
        // Fetch Employees by Departmentid
        $empData['data'] = CitiesModel::orderby("city_name","asc")
        ->select('id', 'city_name')
        ->where('province_id', $id)
        ->get();

        return response()->json($empData);
    }
    // Fetch records
    public function getProvince($departmentid=0){
        // Fetch Employees by Departmentid
        $empData['data'] = ProvincesModel::orderby("province_name","asc")
        ->select('id','province_name')
        ->where('region_id', $departmentid)
        ->get();

        return response()->json($empData);
    }
    // add store branch
    public function add_store_branch(Request $request) {
        $store_branch = new StoreBranchesModel;
        $region = RegionsModel::all()->where('id', '==', $request->input('region_number'))->first();
        $province = ProvincesModel::all()->where('id', '==', $request->input('province_name'))->first();
        $city = CitiesModel::all()->where('id', '==', $request->input('city_name'))->first();
        $store_branch->region_id = $request->input('region_number');
        $store_branch->province_id = $request->input('province_name');
        $store_branch->city_id = $request->input('city_name');
        $store_branch->region_number = $region->region_number;
        $store_branch->province_under = $province->province_name;
        $store_branch->city_under = $city->city_name;
        $store_branch->branch_name = $request->input('branch_name');
        $store_branch->branch_address = $request->input('branch_address');

        $store_branch->save();
        Session::flash('statuscode', 'success');
        return redirect('show_branches')->with('status', 'Branch Added Successfully!');
    }
    // store branch confirm delete
    public function delete_branch($id) {
        $store_branch = StoreBranchesModel::findOrfail($id);
        $store_branch->delete();
        Session::flash('statuscode', 'error');
        return redirect('show_branches')->with('status', 'Store Branch Deleted!');
    }
    // to show page for updating province
    public function branch_update($id){
        $regions = RegionsModel::all();
        $provinces = ProvincesModel::all();
        $cities = CitiesModel::all();
        $store_branch = StoreBranchesModel::findOrfail($id);
        return view('main_admin.store.store_branch_update')->with('provinces', $provinces)
                                        ->with('regions', $regions)
                                        ->with('cities', $cities)
                                        ->with('store_branch', $store_branch);
    }
    // to update the city
    public function branch_update_action(Request $request, $id){
        $store_branch = StoreBranchesModel::findOrfail($id);
        $region = RegionsModel::all()->where('region_number', '==', $request->input('region_number'))->first();
        $province = ProvincesModel::all()->where('province_name', '==', $request->input('province_name'))->first();
        $city = CitiesModel::all()->where('city_name', '==', $request->input('city_name'))->first();
        $store_branch->region_number = $request->input('region_number');
        $store_branch->province_under = $request->input('province_name');
        $store_branch->city_under = $request->input('city_name');
        $store_branch->branch_name = $request->input('branch_name');
        $store_branch->branch_address = $request->input('branch_address');
        $store_branch->region_id = $region->id;
        $store_branch->province_id = $province->id;
        $store_branch->city_id = $city->id;
        

        $store_branch->update();
        Session::flash('statuscode', 'info');
        return redirect('show_branches')->with('status', 'Branch Updated Successfully!');
    }

// Products
    // show Product Categories
    public function show_categories() {
        $categories = ProductCategoriesModel::all();
        return view('main_admin.product_categories.categories')->with('categories', $categories);
    }
    // add category 
    public function add_category(Request $request) {
        $category = new ProductCategoriesModel();
        if ($request->hasFile('category_image'))  {
            $image = $request->file('category_image');
            $extension = $image->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $image->move('uploads/category_images/', $filename);
            $category->category_image = $filename;
        }

        $category->category_name = $request->input('category_name');
        $category->save();
        Session::flash('statuscode', 'info');
        return redirect('show_categories')->with('status', 'Category Added Successfully!');
        
    }
    // category confirm delete
    public function delete_category($id) {
        $category = ProductCategoriesModel::findOrfail($id);
        $category->delete();
        Session::flash('statuscode', 'error');
        return redirect('show_categories')->with('status', 'Category Deleted!');
    }
    // to show page for updating category
    public function category_update($id){
        $category = ProductCategoriesModel::findOrfail($id);
        return view('main_admin.product_categories.category_update')->with('category', $category);
    }
    // to update the category
    public function category_update_action(Request $request, $id){
        $category = ProductCategoriesModel::findOrfail($id);
        if ($request->hasFile('category_image'))  {
            $image = $request->file('category_image');
            $extension = $image->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $image->move('uploads/category_images/', $filename);
            $category->category_image = $filename;
        }   
        $category->category_name = $request->input('category_name');
        $category->update();
        Session::flash('statuscode', 'info');
        return redirect('show_categories')->with('status', 'Category Updated Successfully!');
    }

    // show Product Subcategories
    public function show_subcategories() {
        $subcategories = ProductSubcategoriesModel::all();
        $categories = ProductCategoriesModel::all();
        return view('main_admin.product_subcategories.sub_categories')->with('subcategories', $subcategories)
                                                                    ->with('categories', $categories);
    }
    // add category 
    public function add_subcategory(Request $request) {
        $subcategory = new ProductSubcategoriesModel();
        $category = ProductCategoriesModel::all()->where('id', '==', $request->input('category_id'))->first();
        $subcategory->subcategory_name = $request->input('subcategory_name');
        $subcategory->category_id = $request->input('category_id');
        $subcategory->category_name = $category->category_name;

        $subcategory->save();
        Session::flash('statuscode', 'info');
        return redirect('show_subcategories')->with('status', 'Subcategory Added Successfully!');
    }
    // subcategory confirm delete
    public function delete_subcategory($id) {
        $subcategory = ProductSubcategoriesModel::findOrfail($id);
        $subcategory->delete();
        Session::flash('statuscode', 'error');
        return redirect('show_subcategories')->with('status', 'Subcategory Deleted!');
    }
    // to show page for updating subcategory
    public function subcategory_update($id){
        $categories = ProductCategoriesModel::all();
        $subcategory = ProductSubcategoriesModel::findOrfail($id);
        return view('main_admin.product_subcategories.subcategory_update')->with('subcategory', $subcategory)
                                                                        ->with('categories', $categories);
    }
    // to update the subcategory
    public function subcategory_update_action(Request $request, $id){
        $subcategory = ProductSubcategoriesModel::findOrfail($id);
        $category = ProductCategoriesModel::all()->where('id', '==', $request->input('category_id'))->first();
        $subcategory->category_id = $request->input('category_id');
        $subcategory->subcategory_name = $request->input('subcategory_name');
        $subcategory->category_name = $category->category_name;

        $subcategory->update();
        Session::flash('statuscode', 'info');
        return redirect('show_subcategories')->with('status', 'Subcategory Updated Successfully!');
    }

    // show Products
    public function show_products() {
        $categories = ProductCategoriesModel::all();
        $products = ProductsModel::all();
        return view('main_admin.products_list.products_list')->with('categories', $categories)
                                                        ->with('products', $products);
    }
    // Fetch records
    public function getSubcategory($id=0){
        $empData['data'] = ProductSubcategoriesModel::orderby("subcategory_name","asc")
        ->select('id', 'subcategory_name')
        ->where('category_id', $id)
        ->get();

        return response()->json($empData);
    }
    // add products 
    public function add_products(Request $request) {
        $product = new ProductsModel;
        $category = ProductCategoriesModel::all()->where('id', '==', $request->input('category_id'))->first();
        $subcategory = ProductSubcategoriesModel::all()->where('id', '==', $request->input('subcategory_id'))->first();
        if ($request->hasFile('product_image'))  {
            $image = $request->file('product_image');
            $extension = $image->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $image->move('uploads/product_images/', $filename);
            $product->product_image = $filename;
        }
        $product->product_name = $request->input('product_name');
        $product->category_id = $request->input('category_id');
        $product->category_name = $category->category_name;
        $product->subcategory_id = $request->input('subcategory_id');
        $product->subcategory_name = $subcategory->subcategory_name;
        $product->product_price = $request->input('product_price');
        $product->stocks = $request->input('stocks');
        $product->product_description = $request->input('product_description');

        $product->save();
        Session::flash('statuscode', 'info');
        return redirect('show_products')->with('status', 'Product Added Successfully!');
    }
    // search products 
    public function search_products(){
        $search_text = $_GET['query'];
        $products = ProductsModel::where('product_name', 'LIKE', '%'.$search_text.'%')
                                ->orWhere('id', 'LIKE', '%'.$search_text.'%')->get();

        return view('main_admin.products_list.products_search')->with('products', $products);
    }
    // show Product details
    public function products_details($id) {
        $products = ProductsModel::findOrfail($id);
        return view('main_admin.products_list.products_details')->with('products', $products);
    }
    // products confirm delete
    public function delete_product(Request $request) {
        $products = ProductsModel::where('id', $request->input('id'));
        $products->delete();
        Session::flash('statuscode', 'error');
        return redirect('show_products')->with('status', 'Product Deleted!');
    }
    // to show page for updating product
    public function product_update($id){
        $categories = ProductCategoriesModel::all();
        $subcategories = ProductSubcategoriesModel::all();
        $products = ProductsModel::findOrfail($id);
        return view('main_admin.products_list.product_update')->with('categories', $categories)
                                                            ->with('subcategories', $subcategories)
                                                            ->with('products', $products);
    }
    // to update the product
    public function product_update_action(Request $request, $id){
        $product = ProductsModel::findOrfail($id);
        $category = ProductCategoriesModel::all()->where('id', '==', $request->input('category_id'))->first();
        $subcategory = ProductSubcategoriesModel::all()->where('id', '==', $request->input('subcategory_id'))->first();
        if ($request->hasFile('product_image'))  {
            $image = $request->file('product_image');
            $extension = $image->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $image->move('uploads/product_images/', $filename);
            $product->product_image = $filename;
        }
        $product->product_name = $request->input('product_name');
        $product->category_id = $request->input('category_id');
        $product->category_name = $category->category_name;
        $product->subcategory_id = $request->input('subcategory_id');
        $product->subcategory_name = $subcategory->subcategory_name;
        $product->product_price = $request->input('product_price');
        $product->stocks = $request->input('stocks');
        $product->product_description = $request->input('product_description');

        $product->update();
        Session::flash('statuscode', 'info');
        return redirect('show_products')->with('status', 'Product Updated Successfully!');
    }

// Admin Users
    // show admin users
    public function show_admin_users() {
        $admin_users = Sentinel::getUserRepository()->with('roles')->get();
        return view('main_admin.admin_users.admin_users')->with('admin_users', $admin_users);
    }
    // search users 
    public function search_admin_users(){
        $search_text = $_GET['query'];
        $admin_users = Sentinel::getUserRepository()->where('username', 'LIKE', '%'.$search_text.'%')
                                ->orWhere('id', 'LIKE', '%'.$search_text.'%')->get();

        return view('main_admin.admin_users.admin_user_search')->with('admin_users', $admin_users);
    }
    // show admin user details
    public function admin_user_details($id) {
        $admin_users = Sentinel::findById($id);
        $role_user = RoleUsers::all()->where('user_id', '==', $id)->first();
        
        $role = RoleModel::all()->where('id', '==', $role_user->role_id)->first();
        $data['roles'] = RoleModel::get();
        return view('main_admin.admin_users.admin_user_details')->with('admin_users', $admin_users)
                                                        ->with('data', $data)
                                                        ->with('role', $role);
    }
    // update user roles
    public function update_user_role(Request $request, $id) {
        $user = Sentinel::findById($id);
        $rolUser = $user->roles()->get();
        $roles = Sentinel::findRoleBySlug($rolUser[0]->slug);
        $roles->users()->detach($user);
        $data = $request->input('role');
        $role = Sentinel::findRoleById($data);
        $role->users()->attach($user);
        $user->save();
        Session::flash('statuscode', 'info');
        return redirect('show_admin_users')->with('status', 'User Updated!');
    }
    

// Client Users
    // show client users
    public function show_client_users() {
        $client_users = ClientUser::all();
        return view('main_admin.client_users.client_users')->with('client_users', $client_users);
    }
    // show client details
    public function client_details(Request $reques, $id) {
        $client = ClientUser::findOrfail($id);
        return view('main_admin.client_users.client_user_details')->with('client', $client);
    }

// User Profile
    // show user profile
    public function show_userprofile() {
        $currentUser = Sentinel::getUser();
        return view('main_admin.user_profile.user_profile')->with('currentUser', $currentUser);
    }

    // to update the image of user
    public function user_image_update(Request $request){
        $currentUser = Sentinel::getUser();
        
        if ($request->hasFile('user_image'))  {
            $image = $request->file('user_image');
            $extension = $image->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $image->move('uploads/user_images/', $filename);
            $currentUser->user_image = $filename;
        }

        $currentUser->update();
        Session::flash('statuscode', 'info');
        return redirect('show_userprofile')->with('status', 'User Image Updated Successfully!');
    }

    // to update the details of user
    public function user_details_update(Request $request){
        $currentUser = Sentinel::getUser();

        $currentUser->first_name = $request->input('first_name');
        $currentUser->middle_name = $request->input('middle_name');
        $currentUser->last_name = $request->input('last_name');
        $currentUser->address = $request->input('address');
        $currentUser->position = $request->input('position');
        $currentUser->age = $request->input('age');

        $currentUser->update();
        Session::flash('statuscode', 'info');
        return redirect('show_userprofile')->with('status', 'User Details Updated Successfully!');
    }
}
