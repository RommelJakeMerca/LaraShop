<?php

namespace App\Http\Controllers\CustomControllers;

use App\Http\Controllers\Controller;
use Auth;
use DateTime; 
use DateInterval;
use App\Models\CartModel;
use App\Models\ClientOrderModel;
use App\Models\ClientUser;
use App\Models\OrderModel;
use App\Models\ProductCategoriesModel;
use App\Models\ProductSubcategoriesModel;
use App\Models\ProductsModel;
use App\Models\RewardsModel;
use Illuminate\Http\Request;

class StoreController extends Controller
{

    public function __construct()
    {   
        $this->middleware('preventBackHistory');
        $this->middleware('thankyou',['only' => ['thankyou']]);
        $this->middleware('cart', ['only' => ['payment', 'checkout']]);
        $this->middleware('client', 
        [
            'only' => 
            [
                'payment',
                'shoppingCart',
                'checkout',
                'thankyou'
            ]
        ]);
    }

    //SHOW PRODUCTS / STORE CONTENT PANEL
    public function store() {
        $customerId = Auth::id();
        $unpaid = 'unpaid';
        $rewardTitle = 'Daily Roulette Spin';
        $currentUsers = ClientUser::where('id', $customerId)->first();
        //  $rewardDatas = RewardsModel::where('user_id', $customerId)->orderBy('created_at', 'desc')->limit(1)->get();
        $rewardDatas= RewardsModel::where(['user_id' => $customerId, 'title' => $rewardTitle])->orderBy('created_at', 'desc')->limit(1)->get();
        $cartTables = CartModel::where(['user_id' => $customerId, 'cart_status' => $unpaid])->get();
        $totalPrice = CartModel::where(['user_id' => $customerId, 'cart_status' => $unpaid])->sum('product_price');
        $totalQuantity = CartModel::where(['user_id' => $customerId, 'cart_status' => $unpaid])->sum('product_quantity');

        return view('products.store',[
            'cartTables' => $cartTables,
            'currentUsers' => $currentUsers,
            'rewardDatas' => $rewardDatas,
            'totalPrice' => $totalPrice,
            'totalQuantity' => $totalQuantity
        ]);

    }

    //SHOW SEARCH PANEL
    public function search() {
        $customerId = Auth::id();
        $currentUsers = ClientUser::where('id', $customerId)->first();

        return view('products.search',[
            'currentUsers' => $currentUsers
        ]);
    }

    //SHOW SEARCH PRODUCTS
    public function searchProducts(Request $request) {
        if($request->ajax()) {
            $output="";
            $inputSearchProducts = $request->product_name;
            // $replaceSearchProducts = str_replace('/\s+/', '', $inputSearchProducts);
            $searchProducts = ProductsModel::where('product_name', 'LIKE', '%'.$inputSearchProducts.'%')->get();
            if(count($searchProducts) > 0) {
                foreach ($searchProducts as $searchProduct) {
                    $output.="<div class='col-md-3 product-col' data-id='$searchProduct->id'>".
                                "<a class='link-details' href='/products/product-details/$searchProduct->id'>".
                                "<div class='card'>".
                                    "<div class='card-body'>".
                                        "<img src='/uploads/product_images/$searchProduct->product_image' class='product-img'>".
                                        "<div class='product-info-container'>".
                                            "<p class='card-title mt-4'>&#8369; <b id='price-product'>".$searchProduct->product_price.".00</b></p>".
                                            "<p class='card-name'>".$searchProduct->product_name."</p></a>".
                                            "<p class='card-category'>".$searchProduct->category_name."</p>".
                                            "<button class='minus-product'><i class='fas fa-minus'></i></button>".
                                            "<input type='text' class='product-quantity-value' 
                                            id='product-quantity-value' value='1' maxlength='2'>".
                                            "<button class='plus-product'><i class='fas fa-plus'></i></button>".
                                            "<button class='btnAddToCart mt-3' id='add-cart'>ADD TO CART</button>".
                                        "</div>".
                                    "</div>".
                                "</div>".
                            "</div>";
                }
                return response()->json($output);
            } else {
                $output.="<div class='col product-col' style='text-align:center;padding-bottom:20px;'>".
                "<img src='/products_asset/images/error/product-not-found.png' style='height:300px;object-fit:contain:mix-blend-mode:multiply;'>".
                "<h2 style='letter-spacing:1px;font-weight:bolder;color:#0E67B9;text-transform:uppercase;'>SEARCH RESULTS FOR: '".$inputSearchProducts."'</h2>".
                "<h4 class='mt-3'>NO PRODUCT RESULTS FOUND.</h4>".
                "</div>";
                return response()->json($output);
            }   
        }
    }

    //SHOW RICE AND GRAINS PANEL
    public function riceGrains(Request $request) {
        $customerId = Auth::id();
        $unpaid = 'unpaid';
        $riceGrains = 1020;
        $currentUsers = ClientUser::where('id', $customerId)->first();
        $cartTables = CartModel::where(['user_id' => $customerId, 'cart_status' => $unpaid])->get();
        $totalPrice = CartModel::where(['user_id' => $customerId, 'cart_status' => $unpaid])->sum('product_price');
        $totalQuantity = CartModel::where(['user_id' => $customerId, 'cart_status' => $unpaid])->sum('product_quantity');
        $value = $request->sort;

        if($value) {
            $productsRiceGrains = ProductsModel::where('category_id', $riceGrains)->orderBy('product_price', $value ?? 'desc' )->paginate(12);
        } else {
            $productsRiceGrains = ProductsModel::where('category_id', $riceGrains)->paginate(12);
        }

        return view('products/rice_grains.rice_grains',[
            'cartTables' => $cartTables,
            'currentUsers' => $currentUsers,
            'productsRiceGrains' => $productsRiceGrains,
            'totalPrice' => $totalPrice,
            'totalQuantity' => $totalQuantity
        ]);
    }
    
    //SHOW PRODUCT DETAILS PANEL
    public function productDetails($id) {
        $customerId = Auth::id();
        $unpaid = 'unpaid';
        $currentUsers = ClientUser::where('id', $customerId)->first();
        $productsDetails = ProductsModel::findOrfail($id);
        $cartTables = CartModel::where(['user_id' => $customerId, 'cart_status' => $unpaid])->get();
        $totalPrice = CartModel::where(['user_id' => $customerId, 'cart_status' => $unpaid])->sum('product_price');
        $totalQuantity = CartModel::where(['user_id' => $customerId, 'cart_status' => $unpaid])->sum('product_quantity');

        return view('products.product_details',[
            'cartTables' => $cartTables,
            'currentUsers' => $currentUsers,
            'productsDetails' => $productsDetails,
            'totalPrice' => $totalPrice,
            'totalQuantity' => $totalQuantity
        ]);
    }

    //SHOW SHOPPING CART PANEL
    public function shoppingCart() {
        $customerId = Auth::id();
        $unpaid = 'unpaid';
        $currentUsers = ClientUser::where('id', $customerId)->first();
        $cartTables = CartModel::where(['user_id' => $customerId, 'cart_status' => $unpaid])->get();
        $totalPrice = CartModel::where(['user_id' => $customerId, 'cart_status' => $unpaid])->sum('product_price');
        $totalQuantity = CartModel::where(['user_id' => $customerId, 'cart_status' => $unpaid])->sum('product_quantity');
        $vat = 0.12;
        $vatValue = $totalPrice * $vat;
        $totalPrice > 0 ? $rewardPoints = floor($totalPrice / 1000) : $rewardPoints = 0;

        return view('products.cart',[
            'cartTables' => $cartTables,
            'currentUsers' => $currentUsers,
            'totalPrice' => $totalPrice,
            'totalQuantity' => $totalQuantity,
            'vatValue' => $vatValue,
            'rewardPoints' => $rewardPoints
        ]);
    }

    //SHOW CHECKOUT PANEL
    public function checkout() {
        $customerId = Auth::id();
        $unpaid = 'unpaid';
        $currentUsers = ClientUser::where('id', $customerId)->first();
        $cartTables = CartModel::where(['user_id' => $customerId, 'cart_status' => $unpaid])->get();
        $totalPrice = CartModel::where(['user_id' => $customerId, 'cart_status' => $unpaid])->sum('product_price');
        $beneficiaries = OrderModel::where('user_id', $customerId)
                        ->orderBy('created_at', 'desc')
                        ->limit(1)
                        ->get();
        $vat = 0.12;
        $vatValue = $totalPrice * $vat;
        $totalPrice > 0 ? $rewardPoints = floor($totalPrice / 1000) : $rewardPoints = 0;

        return view('products.checkout',[
            'cartTables' => $cartTables,
            'currentUsers' => $currentUsers,
            'beneficiaries'=> $beneficiaries,
            'totalPrice' => $totalPrice,
            'vatValue' => $vatValue,
            'rewardPoints' => $rewardPoints
        ]);
    }

    //SHOW PAYMENT PANEL
    public function payment() {
        $customerId = Auth::id();
        $unpaid = 'unpaid';
        $currentUsers = ClientUser::where('id', $customerId)->first();
        $totalPrice = CartModel::where(['user_id' => $customerId, 'cart_status' => $unpaid])->sum('product_price');
        $vat = 0.12;
        $vatValue = $totalPrice * $vat;
        $totalPrice > 0 ? $rewardPoints = floor($totalPrice / 1000) : $rewardPoints = 0;

        return view('products.payment',[
            'currentUsers' => $currentUsers,
            'totalPrice' => $totalPrice,
            'vatValue' => $vatValue,
            'rewardPoints' => $rewardPoints
        ]);
    }
    
    //SHOW THANKYOU PANEL
    public function thankyou() {
        $customerId = Auth::id();
        $paid = 'paid';
        $currentUsers = ClientUser::where('id', $customerId)->firstOrFail();
        $beneficiaries = OrderModel::where('user_id', $customerId)->orderBy('created_at', 'desc')->limit(1)->get();
        $productDates = CartModel::where(['user_id' => $customerId, 'cart_status' => $paid])->get()->last();
        $updated_at = $productDates->updated_at->sub(new DateInterval('PT10S'));
      
        $paidProducts = CartModel::where(['user_id' => $customerId, 'cart_status' => $paid])->where('updated_at', '>=', $updated_at)->get();
        $clientOrder = ClientOrderModel::where(['client_id' => $customerId])->get()->last();
        $totalPayment = $clientOrder->total_payment;
        $vat = 0.12;
        $vatValue = $totalPayment * $vat;

        return view('products.thankyou',[
            'currentUsers' => $currentUsers,
            'beneficiaries' => $beneficiaries,
            'paidProducts' => $paidProducts,
            'clientOrder' => $clientOrder,
            'vatValue' => $vatValue
        ]);
    }

    //SHOW JASMINE PANEL 
    public function jasmine() {
        $customerId = Auth::id();
        $unpaid = 'unpaid';
        $jasmineRice = 2021;
        $currentUsers = ClientUser::where('id', $customerId)->first();
        $productsJasmineRices = ProductsModel::where('subcategory_id', $jasmineRice)->paginate(12);
        $cartTables = CartModel::where(['user_id' => $customerId, 'cart_status' => $unpaid])->get();
        $totalPrice = CartModel::where(['user_id' => $customerId, 'cart_status' => $unpaid])->sum('product_price');
        $totalQuantity = CartModel::where(['user_id' => $customerId, 'cart_status' => $unpaid])->sum('product_quantity');

        return view('products/rice_grains.jasmine',[
            'cartTables' => $cartTables,
            'currentUsers' => $currentUsers,
            'productsJasmineRices' => $productsJasmineRices,
            'totalPrice' => $totalPrice,
            'totalQuantity' => $totalQuantity
        ]);
    }

    //SHOW DINORADO PANEL
    public function dinorado() {
        $customerId = Auth::id();
        $unpaid = 'unpaid';
        $dinoradoRice = 2023;
        $currentUsers = ClientUser::where('id', $customerId)->first();
        $productsDinoradoRices = ProductsModel::where('subcategory_id', $dinoradoRice)->paginate(12);
        $cartTables = CartModel::where(['user_id' => $customerId, 'cart_status' => $unpaid])->get();
        $totalPrice = CartModel::where(['user_id' => $customerId, 'cart_status' => $unpaid])->sum('product_price');
        $totalQuantity = CartModel::where(['user_id' => $customerId, 'cart_status' => $unpaid])->sum('product_quantity');
        
        return view('products/rice_grains.dinorado', [
            'cartTables' => $cartTables,
            'currentUsers' => $currentUsers,
            'productsDinoradoRices' => $productsDinoradoRices,
            'totalPrice' => $totalPrice,
            'totalQuantity' => $totalQuantity
        ]);
    }

    //SHOW SINANDOMENG PANEL
    public function sinandomeng() {
        $customerId = Auth::id();
        $unpaid = 'unpaid';
        $sinandomengRice = 2026;
        $currentUsers = ClientUser::where('id', $customerId)->first();
        $productsSinandomengRices = ProductsModel::where('subcategory_id', $sinandomengRice)->paginate(12);
        $cartTables = CartModel::where(['user_id' => $customerId, 'cart_status' => $unpaid])->get();
        $totalPrice = CartModel::where(['user_id' => $customerId, 'cart_status' => $unpaid])->sum('product_price');
        $totalQuantity = CartModel::where(['user_id' => $customerId, 'cart_status' => $unpaid])->sum('product_quantity');
        
        return view('products/rice_grains.sinandomeng', [
            'cartTables' => $cartTables,
            'currentUsers' => $currentUsers,
            'productsSinandomengRices' => $productsSinandomengRices,
            'totalPrice' => $totalPrice,
            'totalQuantity' => $totalQuantity
        ]);
    }

    //SHOW MIPONICA PANEL
    public function miponica() {
        $customerId = Auth::id();
        $unpaid = 'unpaid';
        $miponicaRice = 2027;
        $currentUsers = ClientUser::where('id', $customerId)->first();
        $productsMiponicaRices = ProductsModel::where('subcategory_id', $miponicaRice)->paginate(12);
        $cartTables = CartModel::where(['user_id' => $customerId, 'cart_status' => $unpaid])->get();
        $totalPrice = CartModel::where(['user_id' => $customerId, 'cart_status' => $unpaid])->sum('product_price');
        $totalQuantity = CartModel::where(['user_id' => $customerId, 'cart_status' => $unpaid])->sum('product_quantity');

        return view('products/rice_grains.miponica', [
            'cartTables' => $cartTables,
            'currentUsers' => $currentUsers,
            'productsMiponicaRices' => $productsMiponicaRices,
            'totalPrice' => $totalPrice,
            'totalQuantity' => $totalQuantity
        ]);
    }

    //SHOW JASPONICA PANEL
    public function jasponica() {
        $customerId = Auth::id();
        $unpaid = 'unpaid';
        $jasponicaRice = 2028;
        $currentUsers = ClientUser::where('id', $customerId)->first();
        $productsJasponicaRices = ProductsModel::where('subcategory_id', $jasponicaRice)->paginate(12);
        $cartTables = CartModel::where(['user_id' => $customerId, 'cart_status' => $unpaid])->get();
        $totalPrice = CartModel::where(['user_id' => $customerId, 'cart_status' => $unpaid])->sum('product_price');
        $totalQuantity = CartModel::where(['user_id' => $customerId, 'cart_status' => $unpaid])->sum('product_quantity');

        return view('products/rice_grains.jasponica', [
            'cartTables' => $cartTables,
            'currentUsers' => $currentUsers,
            'productsJasponicaRices' => $productsJasponicaRices,
            'totalPrice' => $totalPrice,
            'totalQuantity' => $totalQuantity
        ]);
    }

    //SHOW FRUITS AND VEGETABLES
    public function fruitsVegetables(Request $request) {
        $customerId = Auth::id();
        $unpaid = 'unpaid';
        $fruitsVegetables = 1021;
        $currentUsers = ClientUser::where('id', $customerId)->first();
        $cartTables = CartModel::where(['user_id' => $customerId, 'cart_status' => $unpaid])->get();
        $totalPrice = CartModel::where(['user_id' => $customerId, 'cart_status' => $unpaid])->sum('product_price');
        $totalQuantity = CartModel::where(['user_id' => $customerId, 'cart_status' => $unpaid])->sum('product_quantity');
        $value = $request->sort;

        if($value) {
            $productsFruitsVegetables  = ProductsModel::where('category_id', $fruitsVegetables)->orderBy('product_price', $value ?? 'desc' )->paginate(12);
        } else {
            $productsFruitsVegetables = ProductsModel::where('category_id', $fruitsVegetables)->paginate(12);
        }

        return view('products/fruits_vegetables.fruits_vegetables', [
            'cartTables' => $cartTables,
            'currentUsers' => $currentUsers,
            'productsFruitsVegetables' => $productsFruitsVegetables,
            'totalPrice' => $totalPrice,
            'totalQuantity' => $totalQuantity
        ]);
    }

    //SHOW AMPALAYA PANEL
    public function ampalaya() {
        $customerId = Auth::id();
        $unpaid = 'unpaid';
        $ampalaya = 2024;
        $currentUsers = ClientUser::where('id', $customerId)->first();
        $productsAmpalayas = ProductsModel::where('subcategory_id', $ampalaya)->paginate(12);
        $cartTables = CartModel::where(['user_id' => $customerId, 'cart_status' => $unpaid])->get();
        $totalPrice = CartModel::where(['user_id' => $customerId, 'cart_status' => $unpaid])->sum('product_price');
        $totalQuantity = CartModel::where(['user_id' => $customerId, 'cart_status' => $unpaid])->sum('product_quantity');

        return view('products/fruits_vegetables/ampalaya', [
            'cartTables' => $cartTables,
            'currentUsers' => $currentUsers,
            'productsAmpalayas' => $productsAmpalayas,
            'totalPrice' => $totalPrice,
            'totalQuantity' => $totalQuantity
        ]);
    }

    //SHOW BANANA PANEL
    public function banana() {
        $customerId = Auth::id();
        $unpaid = 'unpaid';
        $banana = 2029;
        $currentUsers = ClientUser::where('id', $customerId)->first();
        $productsBananas = ProductsModel::where('subcategory_id', $banana)->paginate(12);
        $cartTables = CartModel::where(['user_id' => $customerId, 'cart_status' => $unpaid])->get();
        $totalPrice = CartModel::where(['user_id' => $customerId, 'cart_status' => $unpaid])->sum('product_price');
        $totalQuantity = CartModel::where(['user_id' => $customerId, 'cart_status' => $unpaid])->sum('product_quantity');

        return view('products/fruits_vegetables/banana', [
            'cartTables' => $cartTables,
            'currentUsers' => $currentUsers,
            'productsBananas' => $productsBananas,
            'totalPrice' => $totalPrice,
            'totalQuantity' => $totalQuantity
        ]);
    }

    //SHOW CABBAGE PANEL
    public function cabbage() {
        $customerId = Auth::id();
        $unpaid = 'unpaid';
        $cabbage = 2030;
        $currentUsers = ClientUser::where('id', $customerId)->first();
        $productsCabbages = ProductsModel::where('subcategory_id', $cabbage)->paginate(12);
        $cartTables = CartModel::where(['user_id' => $customerId, 'cart_status' => $unpaid])->get();
        $totalPrice = CartModel::where(['user_id' => $customerId, 'cart_status' => $unpaid])->sum('product_price');
        $totalQuantity = CartModel::where(['user_id' => $customerId, 'cart_status' => $unpaid])->sum('product_quantity');
       
        return view('products/fruits_vegetables/cabbage', [
            'cartTables' => $cartTables,
            'currentUsers' => $currentUsers,
            'productsCabbages' => $productsCabbages,
            'totalPrice' => $totalPrice,
            'totalQuantity' => $totalQuantity
        ]);
    }

    //SHOW CARROT PANEL
    public function carrot() {
        $customerId = Auth::id();
        $unpaid = 'unpaid';
        $carrot = 2031;
        $currentUsers = ClientUser::where('id', $customerId)->first();
        $productsCarrots = ProductsModel::where('subcategory_id', $carrot)->paginate(12);
        $cartTables = CartModel::where(['user_id' => $customerId, 'cart_status' => $unpaid])->get();
        $totalPrice = CartModel::where(['user_id' => $customerId, 'cart_status' => $unpaid])->sum('product_price');
        $totalQuantity = CartModel::where(['user_id' => $customerId, 'cart_status' => $unpaid])->sum('product_quantity');
        
        return view('products/fruits_vegetables/carrot', [
            'cartTables' => $cartTables,
            'currentUsers' => $currentUsers,
            'productsCarrots' => $productsCarrots,
            'totalPrice' => $totalPrice,
            'totalQuantity' => $totalQuantity
        ]);
    }

    //SHOW ORANGE PANEL
    public function orange() {
        $customerId = Auth::id();
        $unpaid = 'unpaid';
        $orange = 2032;
        $currentUsers = ClientUser::where('id', $customerId)->first();
        $productsOranges = ProductsModel::where('subcategory_id', $orange)->paginate(12);
        $cartTables = CartModel::where(['user_id' => $customerId, 'cart_status' => $unpaid])->get();
        $totalPrice = CartModel::where(['user_id' => $customerId, 'cart_status' => $unpaid])->sum('product_price');
        $totalQuantity = CartModel::where(['user_id' => $customerId, 'cart_status' => $unpaid])->sum('product_quantity');
        
        return view('products/fruits_vegetables/orange', [
            'cartTables' => $cartTables,
            'currentUsers' => $currentUsers,
            'productsOranges' => $productsOranges,
            'totalPrice' => $totalPrice,
            'totalQuantity' => $totalQuantity
        ]);
    }

    //SHOW CANNED GOODS
    public function cannedGoods(Request $request) {
        $customerId = Auth::id();
        $unpaid = 'unpaid';
        $cannedGoods = 1022;
        $currentUsers = ClientUser::where('id', $customerId)->first();
        $cartTables = CartModel::where(['user_id' => $customerId, 'cart_status' => $unpaid])->get();
        $totalPrice = CartModel::where(['user_id' => $customerId, 'cart_status' => $unpaid])->sum('product_price');
        $totalQuantity = CartModel::where(['user_id' => $customerId, 'cart_status' => $unpaid])->sum('product_quantity');
        $value = $request->sort;

        if($value) {
            $productsCannedGoods  = ProductsModel::where('category_id', $cannedGoods)->orderBy('product_price', $value ?? 'desc' )->paginate(12);
        } else {
            $productsCannedGoods = ProductsModel::where('category_id', $cannedGoods)->paginate(12);
        }

        return view('products/cannedgoods/canned_goods', [
            'cartTables' => $cartTables,
            'currentUsers' => $currentUsers,
            'productsCannedGoods' => $productsCannedGoods,
            'totalPrice' => $totalPrice,
            'totalQuantity' => $totalQuantity
        ]);
    }

    //SHOW CORNED BEEF PANEL
    public function cornedBeef() {
        $customerId = Auth::id();
        $unpaid = 'unpaid';
        $cornedBeef = 2033;
        $currentUsers = ClientUser::where('id', $customerId)->first();
        $productsCornedBeefs = ProductsModel::where('subcategory_id', $cornedBeef)->paginate(12);
        $cartTables = CartModel::where(['user_id' => $customerId, 'cart_status' => $unpaid])->get();
        $totalPrice = CartModel::where(['user_id' => $customerId, 'cart_status' => $unpaid])->sum('product_price');
        $totalQuantity = CartModel::where(['user_id' => $customerId, 'cart_status' => $unpaid])->sum('product_quantity');
    
        return view('products/cannedgoods/cornedbeef', [
            'cartTables' => $cartTables,
            'currentUsers' => $currentUsers,
            'productsCornedBeefs' => $productsCornedBeefs,
            'totalPrice' => $totalPrice,
            'totalQuantity' => $totalQuantity
        ]);
    }

    //SHOW HAM PANEL
    public function ham() {
        $customerId = Auth::id();
        $unpaid = 'unpaid';
        $ham = 2034;
        $currentUsers = ClientUser::where('id', $customerId)->first();
        $productsHams = ProductsModel::where('subcategory_id', $ham)->paginate(12);
        $cartTables = CartModel::where(['user_id' => $customerId, 'cart_status' => $unpaid])->get();
        $totalPrice = CartModel::where(['user_id' => $customerId, 'cart_status' => $unpaid])->sum('product_price');
        $totalQuantity = CartModel::where(['user_id' => $customerId, 'cart_status' => $unpaid])->sum('product_quantity');

        return view('products/cannedgoods/ham', [
            'cartTables' => $cartTables,
            'currentUsers' => $currentUsers,
            'productsHams' => $productsHams,
            'totalPrice' => $totalPrice,
            'totalQuantity' => $totalQuantity
        ]);
    }

    //SHOW LUNCHEON MEAT PANEL
    public function luncheonMeat() {
        $customerId = Auth::id();
        $unpaid = 'unpaid';
        $luncheonMeat = 2035;
        $currentUsers = ClientUser::where('id', $customerId)->first();
        $productsLuncheonMeats = ProductsModel::where('subcategory_id', $luncheonMeat)->paginate(12);
        $cartTables = CartModel::where(['user_id' => $customerId, 'cart_status' => $unpaid])->get();
        $totalPrice = CartModel::where(['user_id' => $customerId, 'cart_status' => $unpaid])->sum('product_price');
        $totalQuantity = CartModel::where(['user_id' => $customerId, 'cart_status' => $unpaid])->sum('product_quantity');

        return view('products/cannedgoods/luncheonmeat', [
            'cartTables' => $cartTables,
            'currentUsers' => $currentUsers,
            'productsLuncheonMeats' => $productsLuncheonMeats,
            'totalPrice' => $totalPrice,
            'totalQuantity' => $totalQuantity
        ]);
    }

    //SHOW SARDINES PANEL
    public function sardines() {
        $customerId = Auth::id();
        $unpaid = 'unpaid';
        $sardines = 2036;
        $currentUsers = ClientUser::where('id', $customerId)->first();
        $productsSardines = ProductsModel::where('subcategory_id', $sardines)->paginate(12);
        $cartTables = CartModel::where(['user_id' => $customerId, 'cart_status' => $unpaid])->get();
        $totalPrice = CartModel::where(['user_id' => $customerId, 'cart_status' => $unpaid])->sum('product_price');
        $totalQuantity = CartModel::where(['user_id' => $customerId, 'cart_status' => $unpaid])->sum('product_quantity');

        return view('products/cannedgoods/sardines', [
            'cartTables' => $cartTables,
            'currentUsers' => $currentUsers,
            'productsSardines' => $productsSardines,
            'totalPrice' => $totalPrice,
            'totalQuantity' => $totalQuantity
        ]);
    }

    //SHOW TUNA PANEL
    public function tuna() {
        $customerId = Auth::id();
        $unpaid = 'unpaid';
        $tuna = 2037;
        $currentUsers = ClientUser::where('id', $customerId)->first();
        $productsTunas = ProductsModel::where('subcategory_id', $tuna)->paginate(12);
        $cartTables = CartModel::where(['user_id' => $customerId, 'cart_status' => $unpaid])->get();
        $totalPrice = CartModel::where(['user_id' => $customerId, 'cart_status' => $unpaid])->sum('product_price');
        $totalQuantity = CartModel::where(['user_id' => $customerId, 'cart_status' => $unpaid])->sum('product_quantity');
        
        return view('products/cannedgoods/tuna', [
            'cartTables' => $cartTables,
            'currentUsers' => $currentUsers,
            'productsTunas' => $productsTunas,
            'totalPrice' => $totalPrice,
            'totalQuantity' => $totalQuantity
        ]);
    }

    //SHOW SNACKS _ BEVERAGES
    public function snacksBeverages(Request $request) {
        $customerId = Auth::id();
        $unpaid = 'unpaid';
        $snacksBeverages = 1023;
        $currentUsers = ClientUser::where('id', $customerId)->first();
        $cartTables = CartModel::where(['user_id' => $customerId, 'cart_status' => $unpaid])->get();
        $totalPrice = CartModel::where(['user_id' => $customerId, 'cart_status' => $unpaid])->sum('product_price');
        $totalQuantity = CartModel::where(['user_id' => $customerId, 'cart_status' => $unpaid])->sum('product_quantity');
        $value = $request->sort;

        if($value) {
            $productsSnacksBeverages = ProductsModel::where('category_id', $snacksBeverages)->orderBy('product_price', $value ?? 'desc' )->paginate(12);
        } else {
            $productsSnacksBeverages = ProductsModel::where('category_id', $snacksBeverages)->paginate(12);
        }

        return view('products/snacks_beverages/snacks_beverages', [
            'cartTables' => $cartTables,
            'currentUsers' => $currentUsers,
            'productsSnacksBeverages' => $productsSnacksBeverages,
            'totalPrice' => $totalPrice,
            'totalQuantity' => $totalQuantity
        ]);
    }

    //SHOW BEER
    public function beer() {
        $customerId = Auth::id();
        $unpaid = 'unpaid';
        $beer = 2038;
        $currentUsers = ClientUser::where('id', $customerId)->first();
        $productsBeers = ProductsModel::where('subcategory_id', $beer)->paginate(12);
        $cartTables = CartModel::where(['user_id' => $customerId, 'cart_status' => $unpaid])->get();
        $totalPrice = CartModel::where(['user_id' => $customerId, 'cart_status' => $unpaid])->sum('product_price');
        $totalQuantity = CartModel::where(['user_id' => $customerId, 'cart_status' => $unpaid])->sum('product_quantity');
     
        return view('products/snacks_beverages/beer', [
            'cartTables' => $cartTables,
            'currentUsers' => $currentUsers,
            'productsBeers' => $productsBeers,
            'totalPrice' => $totalPrice,
            'totalQuantity' => $totalQuantity
        ]);
    }

    //SHOW BISCUIT
    public function biscuit() {
        $customerId = Auth::id();
        $unpaid = 'unpaid';
        $biscuit = 2039;
        $currentUsers = ClientUser::where('id', $customerId)->first();
        $productsBiscuits = ProductsModel::where('subcategory_id', $biscuit)->paginate(12);
        $cartTables = CartModel::where(['user_id' => $customerId, 'cart_status' => $unpaid])->get();
        $totalPrice = CartModel::where(['user_id' => $customerId, 'cart_status' => $unpaid])->sum('product_price');
        $totalQuantity = CartModel::where(['user_id' => $customerId, 'cart_status' => $unpaid])->sum('product_quantity');

        return view('products/snacks_beverages/biscuit', [
            'cartTables' => $cartTables,
            'currentUsers' => $currentUsers,
            'productsBiscuits' => $productsBiscuits,
            'totalPrice' => $totalPrice,
            'totalQuantity' => $totalQuantity
        ]);
    }

    //SHOW CHIPS
    public function chips() {
        $customerId = Auth::id();
        $unpaid = 'unpaid';
        $chips = 2040;
        $currentUsers = ClientUser::where('id', $customerId)->first();
        $productsChips = ProductsModel::where('subcategory_id', $chips)->paginate(12);
        $cartTables = CartModel::where(['user_id' => $customerId, 'cart_status' => $unpaid])->get();
        $totalPrice = CartModel::where(['user_id' => $customerId, 'cart_status' => $unpaid])->sum('product_price');
        $totalQuantity = CartModel::where(['user_id' => $customerId, 'cart_status' => $unpaid])->sum('product_quantity');

        return view('products/snacks_beverages/chips', [
            'cartTables' => $cartTables,
            'currentUsers' => $currentUsers,
            'productsChips' => $productsChips,
            'totalPrice' => $totalPrice,
            'totalQuantity' => $totalQuantity
        ]);
    }

    //SHOW CHIPS
    public function coffee() {
        $customerId = Auth::id();
        $unpaid = 'unpaid';
        $coffee = 2041;
        $currentUsers = ClientUser::where('id', $customerId)->first();
        $productsCoffees = ProductsModel::where('subcategory_id', $coffee)->paginate(12);
        $cartTables = CartModel::where(['user_id' => $customerId, 'cart_status' => $unpaid])->get();
        $totalPrice = CartModel::where(['user_id' => $customerId, 'cart_status' => $unpaid])->sum('product_price');
        $totalQuantity = CartModel::where(['user_id' => $customerId, 'cart_status' => $unpaid])->sum('product_quantity');

        return view('products/snacks_beverages/coffee', [
            'cartTables' => $cartTables,
            'currentUsers' => $currentUsers,
            'productsCoffees' => $productsCoffees,
            'totalPrice' => $totalPrice,
            'totalQuantity' => $totalQuantity
        ]);
    }

    //SHOW CHIPS
    public function softdrinks() {
        $customerId = Auth::id();
        $unpaid = 'unpaid';
        $softdrinks = 2042;
        $currentUsers = ClientUser::where('id', $customerId)->first();
        $productsSoftdrinks = ProductsModel::where('subcategory_id', $softdrinks)->paginate(12);
        $cartTables = CartModel::where(['user_id' => $customerId, 'cart_status' => $unpaid])->get();
        $totalPrice = CartModel::where(['user_id' => $customerId, 'cart_status' => $unpaid])->sum('product_price');
        $totalQuantity = CartModel::where(['user_id' => $customerId, 'cart_status' => $unpaid])->sum('product_quantity');

        return view('products/snacks_beverages/softdrinks', [
            'cartTables' => $cartTables,
            'currentUsers' => $currentUsers,
            'productsSoftdrinks' => $productsSoftdrinks,
            'totalPrice' => $totalPrice,
            'totalQuantity' => $totalQuantity
        ]);
    }

    //SHOW HOUSEHOLD CARE
    public function householdCare(Request $request) {
        $customerId = Auth::id();
        $unpaid = 'unpaid';
        $householdCare = 1024;
        $currentUsers = ClientUser::where('id', $customerId)->first();
        $cartTables = CartModel::where(['user_id' => $customerId, 'cart_status' => $unpaid])->get();
        $totalPrice = CartModel::where(['user_id' => $customerId, 'cart_status' => $unpaid])->sum('product_price');
        $totalQuantity = CartModel::where(['user_id' => $customerId, 'cart_status' => $unpaid])->sum('product_quantity');
        $value = $request->sort;

        if($value) {
            $productsHouseholdCares = ProductsModel::where('category_id', $householdCare)->orderBy('product_price', $value ?? 'desc' )->paginate(12);
        } else {
            $productsHouseholdCares = ProductsModel::where('category_id', $householdCare)->paginate(12);
        }

        return view('products/householdcare/householdcare', [
            'cartTables' => $cartTables,
            'currentUsers' => $currentUsers,
            'productsHouseholdCares' => $productsHouseholdCares,
            'totalPrice' => $totalPrice,
            'totalQuantity' => $totalQuantity
        ]);
    }

    //SHOW DISHWASHING
    public function dishwashing() {
        $customerId = Auth::id();
        $unpaid = 'unpaid';
        $dishwashing = 2043;
        $currentUsers = ClientUser::where('id', $customerId)->first();
        $productsDiswashings = ProductsModel::where('subcategory_id', $dishwashing)->paginate(12);
        $cartTables = CartModel::where(['user_id' => $customerId, 'cart_status' => $unpaid])->get();
        $totalPrice = CartModel::where(['user_id' => $customerId, 'cart_status' => $unpaid])->sum('product_price');
        $totalQuantity = CartModel::where(['user_id' => $customerId, 'cart_status' => $unpaid])->sum('product_quantity');

        return view('products/householdcare/dishwashing', [
            'cartTables' => $cartTables,
            'currentUsers' => $currentUsers,
            'productsDiswashings' => $productsDiswashings,
            'totalPrice' => $totalPrice,
            'totalQuantity' => $totalQuantity
        ]);
    }

    //SHOW INSECT & PEST CONTROL
    public function insectPest() {
        $customerId = Auth::id();
        $unpaid = 'unpaid';
        $insectPestControl = 2044;
        $currentUsers = ClientUser::where('id', $customerId)->first();
        $productsinsectPestControls = ProductsModel::where('subcategory_id', $insectPestControl)->paginate(12);
        $cartTables = CartModel::where(['user_id' => $customerId, 'cart_status' => $unpaid])->get();
        $totalPrice = CartModel::where(['user_id' => $customerId, 'cart_status' => $unpaid])->sum('product_price');
        $totalQuantity = CartModel::where(['user_id' => $customerId, 'cart_status' => $unpaid])->sum('product_quantity');

        return view('products/householdcare/insect_pest', [
            'cartTables' => $cartTables,
            'currentUsers' => $currentUsers,
            'productsinsectPestControls' => $productsinsectPestControls,
            'totalPrice' => $totalPrice,
            'totalQuantity' => $totalQuantity
        ]);
    }

    //SHOW LAUNDRY
    public function laundry() {
        $customerId = Auth::id();
        $unpaid = 'unpaid';
        $laundry = 2045;
        $currentUsers = ClientUser::where('id', $customerId)->first();
        $productsLaundries = ProductsModel::where('subcategory_id', $laundry)->paginate(12);
        $cartTables = CartModel::where(['user_id' => $customerId, 'cart_status' => $unpaid])->get();
        $totalPrice = CartModel::where(['user_id' => $customerId, 'cart_status' => $unpaid])->sum('product_price');
        $totalQuantity = CartModel::where(['user_id' => $customerId, 'cart_status' => $unpaid])->sum('product_quantity');
        
        return view('products/householdcare/laundry', [
            'cartTables' => $cartTables,
            'currentUsers' => $currentUsers,
            'productsLaundries' => $productsLaundries,
            'totalPrice' => $totalPrice,
            'totalQuantity' => $totalQuantity
        ]);
    }

    //SHOW TISSUE
    public function tissue() {
        $customerId = Auth::id();
        $unpaid = 'unpaid';
        $tissue = 2046;
        $currentUsers = ClientUser::where('id', $customerId)->first();
        $productsTissues = ProductsModel::where('subcategory_id', $tissue)->paginate(12);
        $cartTables = CartModel::where(['user_id' => $customerId, 'cart_status' => $unpaid])->get();
        $totalPrice = CartModel::where(['user_id' => $customerId, 'cart_status' => $unpaid])->sum('product_price');
        $totalQuantity = CartModel::where(['user_id' => $customerId, 'cart_status' => $unpaid])->sum('product_quantity');

        return view('products/householdcare/tissue', [
            'cartTables' => $cartTables,
            'currentUsers' => $currentUsers,
            'productsTissues' => $productsTissues,
            'totalPrice' => $totalPrice,
            'totalQuantity' => $totalQuantity
        ]);
    }

    //SHOW TOILET CLEANERS
    public function toiletCleaners() {
        $customerId = Auth::id();
        $unpaid = 'unpaid';
        $toiletCleaners = 2047;
        $currentUsers = ClientUser::where('id', $customerId)->first();
        $productstoiletCleaners = ProductsModel::where('subcategory_id', $toiletCleaners)->paginate(12);
        $cartTables = CartModel::where(['user_id' => $customerId, 'cart_status' => $unpaid])->get();
        $totalPrice = CartModel::where(['user_id' => $customerId, 'cart_status' => $unpaid])->sum('product_price');
        $totalQuantity = CartModel::where(['user_id' => $customerId, 'cart_status' => $unpaid])->sum('product_quantity');

        return view('products/householdcare/toilet_cleaners', [
            'cartTables' => $cartTables,
            'currentUsers' => $currentUsers,
            'productstoiletCleaners' => $productstoiletCleaners,
            'totalPrice' => $totalPrice,
            'totalQuantity' => $totalQuantity
        ]);
    }
}
