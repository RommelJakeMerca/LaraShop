<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomControllers\CartController;
use App\Http\Controllers\CustomControllers\CustomerController;
use App\Http\Controllers\CustomControllers\RouletteController;
use App\Http\Controllers\CustomControllers\ShopController;
use App\Http\Controllers\CustomControllers\StoreController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// to show landing page
    Route::get('/', [App\Http\Controllers\Admin\MainDashboardController::class, 'show_landing'])->name('show_landing');

// to show about-page
    Route::get('/about', function () {
        return view('landing.about');
    });
// to show under construction
    Route::get('/unavailable', function () {
        return view('landing.underconstruction');
    });

// paypal routes
    Route::post('/paypal', [App\Http\Controllers\PayPalController::class, 'index'])->name('paypal_call');
    Route::get('/paypal/return', [App\Http\Controllers\PayPalController::class, 'paypalReturn'])->name('paypal_return');
    Route::get('/paypal/cancel', [App\Http\Controllers\PayPalController::class, 'paypalCancel'])->name('paypal_cancel');


// Group route for visitor - middleware
    Route::group(['middleware' => ['visitors']], function () {
        // Sentinel Registration - for admin
        Route::get('/sentinel_register', [App\Http\Controllers\Security\RegisterController::class, 'admin_reg'])->name('sentinel_register');

        // Sentinel Login - for admin
        Route::get('/sentinel_login', [App\Http\Controllers\Security\LoginController::class, 'admin_log'])->name('sentinel_login');

        // Sentinel Registration - action
        Route::post('/register_action', [App\Http\Controllers\Security\RegisterController::class, 'admin_register'])->name('register_action');
        // Sentinel Login - action
        Route::post('/login_action', [App\Http\Controllers\Security\LoginController::class, 'admin_login'])->name('login_action');

        // User Activation
        Route::get('/activate/{email}/{code}', [App\Http\Controllers\Security\ActivationController::class, 'activate'])->name('activate');

        // Forgot Password
        Route::get('/forgot_show', [App\Http\Controllers\Security\ForgotPasswordController::class, 'forgot_show'])->name('forgot_show');

        // Forgot Password - send email
        Route::post('/send_email', [App\Http\Controllers\Security\ForgotPasswordController::class, 'forgot_send_email'])->name('send_email');

        // Forgot Password
        Route::get('/reset_password/{email}/{code}', [App\Http\Controllers\Security\ForgotPasswordController::class, 'reset']);
        
        //Route for the reset password action - post
        Route::post('/reset_password/{email}/{code}', [App\Http\Controllers\Security\ForgotPasswordController::class, 'reset_password']);

        // Get QR Code
        Route::get('/getqr_code/{id}', [App\Http\Controllers\Admin\MainDashboardController::class, 'getqr_code'])->name('getqr_code');
    });
  
// Routes for shop
    // route to show shop index 
    Route::get('/shop_index', [App\Http\Controllers\CustomControllers\ShopController::class, 'show_shop_index'])->name('shop_index');
    // route to show beneficiary info form 
    Route::get('/beneficiary_info/{id}', [App\Http\Controllers\CustomControllers\ShopController::class, 'show_beneficiary_info_form'])->name('beneficiary_info');
    // route to insert shopping info to database
    Route::post('/add_beneficiary_info', [App\Http\Controllers\CustomControllers\ShopController::class, 'insert_order_info'])->name('add_beneficiary_info');
    

    // Get method for Logout
    Route::post('/logout', [App\Http\Controllers\Security\LoginController::class, 'admin_logout'])->name('logout');


    //TO SHOW SHOPPING CART PANEL
    Route::get('/products/shopping-cart', [StoreController::class, 'shoppingCart'])->name('products.shopping-cart');
    //TO SHOW CHECKOUT PANEL
    Route::get('/products/checkout', [StoreController::class, 'checkout'])->name('products.checkout');
    //TO SHOW PAYMENT PANEL
    Route::get('/products/payment', [StoreController::class, 'payment'])->name('products.payment');
    //TO SHOW THANKYOU PANEL
    Route::get('products/thankyou', [StoreController::class, 'thankyou'])->name('products.thankyou');

    //TO SHOW SEARCH PANEL
    Route::get('products/search', [StoreController::class, 'search'])->name('products.search');

    //TO SHOW SEARCH PRODUCTS
    Route::get('/searchProducts', [StoreController::class, 'searchProducts'])->name('productsSearch');
     
    
        
//GROUP FOR AUTHENTICATION CLIENT MIDDLEWARE
Route::group(['middleware' => ['client']], function () {
     //PRODUCT_INDEX FOR REWARDS ONLY 
    Route::get('/products/product_index', [StoreController::class,'productIndex'])->name('products.index');
    //TO SHOW STORE CONTENT PANEL
    Route::get('/products/store', [StoreController::class,'store'])->name('products.store');

    //TO SHOW RICE&GRAINS PANEL
    Route::get('/products/rice&grains', [StoreController::class,'riceGrains'])->name('products.rice_grains');
    //TO SHOW PRICE FILTER OF RICE&GRAINS
    Route::post('/products/rice&grains', [StoreController::class,'riceGrains'])->name('filterRiceGrains');

   //TO SHOW PRODUCT DETAILS PANEL
   Route::get('/products/product-details/{id}', [StoreController::class, 'productDetails'])->name('products.product-details');
   
    //TO SHOW JASMINE PANEL
    Route::get('/products/rice&grains/jasmine',[StoreController::class, 'jasmine'])->name('products.jasmine');
    //TO SHOW DINORADO PANEL
    Route::get('/products/rice&grains/dinorado', [StoreController::class, 'dinorado'])->name('products.dinorado');
    //TO SHOW SINANDOMENG PANEL
    Route::get('/products/rice&grains/sinandomeng', [StoreController::class, 'sinandomeng'])->name('products.sinandomeng');
    //TO SHOW MIPONICA PANEL
    Route::get('/products/rice&grains/miponica', [StoreController::class, 'miponica'])->name('products.miponica');
    //TO SHOW JASPONICA PANEL
    Route::get('/products/rice&grains/jasponica', [StoreController::class, 'jasponica'])->name('products.jasponica');

    //TO SHOW FRUITS & VEGETABLES
    Route::get('/products/fruits&vegetables', [StoreController::class, 'fruitsVegetables'])->name('products.fruits_vegetables');
    //TO SHOW PRICE FILTER OF FRUITS&VEGETABLES
    Route::post('/products/fruits&vegetables', [StoreController::class,'fruitsVegetables'])->name('filterFruitsVegetables');

    //TO SHOW AMPALAYA
    Route::get('/products/fruits&vegetables/ampalaya', [StoreController::class, 'ampalaya'])->name('products.ampalaya');
    //TO SHOW BANANA
    Route::get('/products/fruits&vegetables/banana', [StoreController::class, 'banana'])->name('products.banana');
    //TO SHOW CABBAGE
    Route::get('/products/fruits&vegetables/cabbage', [StoreController::class, 'cabbage'])->name('products.cabbage');
    //TO SHOW CARROT
    Route::get('/products/fruits&vegetables/carrot', [StoreController::class, 'carrot'])->name('products.carrot');
    //TO SHOW ORANGE
    Route::get('/products/fruits&vegetables/orange', [StoreController::class, 'orange'])->name('products.orange');

    //TO SHOW CANNED GOODS
    Route::get('/products/cannedgoods', [StoreController::class, 'cannedGoods'])->name('products.cannedGoods');
    //TO SHOW PRICE FILTER OF CANNEDGOODS
    Route::post('/products/cannedgoods', [StoreController::class,'cannedGoods'])->name('filterCannedGoods');

    //TO SHOW CORNED BEEF
    Route::get('/products/cannedgoods/cornedbeef', [StoreController::class, 'cornedBeef'])->name('products.cornedBeef');
    //TO SHOW HAM
    Route::get('/products/cannedgoods/ham', [StoreController::class, 'ham'])->name('products.ham');
    //TO SHOW LUNCHEON MEAT
    Route::get('/products/cannedgoods/luncheonmeat', [StoreController::class, 'luncheonMeat'])->name('products.luncheonMeat');
    //TO SHOW SARDINES
    Route::get('/products/cannedgoods/sardines', [StoreController::class, 'sardines'])->name('products.sardines');
    //TO SHOW TUNA
    Route::get('/products/cannedgoods/tuna', [StoreController::class, 'tuna'])->name('products.tuna');
    
    //TO SHOW SNACKS&BEVERAGES
    Route::get('/products/snacks&beverages', [StoreController::class, 'snacksBeverages'])->name('products.snacksBeverages');
    //TO SHOW PRICE FILTER OF SNACKS&BEVERAGES
    Route::post('/products/snacks&beverages', [StoreController::class,'snacksBeverages'])->name('filterSnacksBeverages');
    
    //TO SHOW BEER
    Route::get('/products/snacks&beverages/beer', [StoreController::class, 'beer'])->name('products.beer');
    //TO SHOW BISCUIT
    Route::get('/products/snacks&beverages/biscuit', [StoreController::class, 'biscuit'])->name('products.biscuit');
    //TO SHOW CHIPS
    Route::get('/products/snacks&beverages/chips', [StoreController::class, 'chips'])->name('products.chips');
    //TO SHOW COFFEE
    Route::get('/products/snacks&beverages/coffee', [StoreController::class, 'coffee'])->name('products.coffee');
    //TO SHOW SOFTDRINKS
    Route::get('/products/snacks&beverages/softdrinks', [StoreController::class, 'softdrinks'])->name('products.softdrinks');
    
    //TO SHOW HOUSEHOLD CARE
    Route::get('/products/householdcare', [StoreController::class, 'householdCare'])->name('products.householdCare');
    //TO SHOW PRICE FILTER OF HOUSEHOLDCARE
    Route::post('/products/householdcare', [StoreController::class,'householdCare'])->name('filterHouseholdCare');
    
    //TO SHOW DISHWASHING
    Route::get('/products/householdcare/dishwashing', [StoreController::class, 'dishwashing'])->name('products.dishwashing');
    //TO SHOW INSECT & PEST CONTROL
    Route::get('/products/householdcare/insect&pest', [StoreController::class, 'insectPest'])->name('products.insectPest');
    //TO SHOW LAUNDRY
    Route::get('/products/householdcare/laundry', [StoreController::class, 'laundry'])->name('products.laundry');
    //TO SHOW TISSUE
    Route::get('/products/householdcare/tissue', [StoreController::class, 'tissue'])->name('products.tissue');
    //TO SHOW TOILET CLEANERS
    Route::get('/products/householdcare/toilet-cleaners', [StoreController::class, 'toiletCleaners'])->name('products.toiletCleaners');
    
    //TO SHOW PROFILE SETTINGS PANEL
    Route::get('customer/profile-settings', [CustomerController::class, 'profileSettings'])->name('products.profile-settings');
    //UPDATE PROFILE SETTINGS PNAEL 
    Route::post('customer/profile-settings', [CustomerController::class, 'updateCustomer'])->name('customerUpdate');
        
    //TO SHOW REWARDS PANEL
    Route::get('customer/rewards', [CustomerController::class, 'rewards'])->name('products.rewards');
    //TO SHOW TRANSACTION HISTORY PANEL
    Route::get('customer/transaction-history', [CustomerController::class, 'transactionHistory'])->name('products.transaction');
    //TO SHOW TRANSACTION DETAILS
    Route::get('customer/transaction-details', [CustomerController::class, 'transactionDetails'])->name('products.transaction-details');
    //TO SHOW PROFILE SETTINGS PANEL
    Route::get('customer/profile-settings', [CustomerController::class, 'profileSettings'])->name('products.profile-settings');
    //UPDATE PROFILE SETTINGS PNAEL 
    Route::post('customer/profile-settings', [CustomerController::class, 'updateCustomer'])->name('customerUpdate');
        
    //TO SHOW REWARDS PANEL
    Route::get('customer/rewards', [CustomerController::class, 'rewards'])->name('products.rewards');
    //TO SHOW TRANSACTION HISTORY PANEL
    Route::get('customer/transaction-history', [CustomerController::class, 'transactionHistory'])->name('products.transaction');
    //TO SHOW TRANSACTION DETAILS
    Route::get('customer/transaction-details', [CustomerController::class, 'transactionDetails'])->name('products.transaction-details');
});

    //CLIENT LOGIN - show client login view
    Route::get('/client_login', [CustomerController::class, 'clientLogin'])->name('client.login');
    //CLIENT LOG OUT 
    Route::post('/client_logout', [CustomerController::class, 'clientLogout'])->name('client.logout');
    
    //INSERT DATA IN ROULETTE TABLE 
    Route::post('/insert-rewards', [RouletteController::class, 'insertRewards'])->name('insertRewards');
    //UPDATE DATETIME IN ROULETTE TABLE 
    Route::post('/update-date', [RouletteController::class, 'updateDate'])->name('updateRewards');

    //ADD PRODUCTS TO SHOPPING CART
    Route::post('/addCart', [CartController::class, 'addToCart'])->name('addCart'); 
    //TO SHOW SIDEBARCART
    Route::get('/showCart', [CartController::class, 'showCart'])->name('showCart');
    //UPDATE PRODUCTS SHOPPING CART BLADE
    Route::post('/updateShoppingCart', [CartController::class, 'updateShoppingCart'])->name('updateShoppingCart');
    //DELETE PRODUCTS SHOPPING CART BLADE
    Route::delete('/DeleteShoppingCart',[CartController::class, 'DeleteShoppingCart'])->name('deleteShoppingCart');
    //TO SHOW EXISTING SHOPPING CART
    Route::get('/showExistingShoppingCart', [CartController::class, 'showExistingShoppingCart'])->name('showExistingShoppingCart');

//GROUP FOR GUEST AUTHENTICATION MIDDLEWARE
Route::group(['middleware' => ['beneficiary']], function () {
    // route to show beneficiary info form 
    Route::get('/shop_index', [ShopController::class, 'show_shop_index'])->name('shop_index');
    // route to show beneficiary info form 
    Route::get('/beneficiary_info/{id}', [ShopController::class, 'show_beneficiary_info_form'])->name('beneficiary_info');
});

//GROUP FOR GUEST AUTHENTICATION MIDDLEWARE
Route::group(['middleware' => ['guest']], function () {
    //TO SHOW CHECKOUT PANEL
    Route::get('/products/checkout', [StoreController::class, 'checkout'])->name('products.checkout');
    //TO SHOW PAYMENT PANEL
    Route::get('/products/payment', [StoreController::class, 'payment'])->name('products.payment');
    //TO SHOW THANKYOU PANEL
    Route::get('products/thankyou', [StoreController::class, 'thankyou'])->name('products.thankyou');
    //TO SHOW SHOPPING CART PANEL
    Route::get('/products/shopping-cart', [StoreController::class, 'shoppingCart'])->name('products.shopping-cart');
    // route to show beneficiary info form 
    Route::get('/shop_index', [ShopController::class, 'show_shop_index'])->name('shop_index');
    // route to show beneficiary info form 
    Route::get('/beneficiary_info/{id}', [ShopController::class, 'show_beneficiary_info_form'])->name('beneficiary_info');
});


// Get method for Logout
    Route::post('/logout', [App\Http\Controllers\Security\LoginController::class, 'admin_logout'])->name('logout');

// Socialite routes
    // Google Login
    Route::get('login/google', [App\Http\Controllers\CustomControllers\LoginController::class, 'redirectToGoogle'])->name('login.google');
    Route::get('login/google/callback', [App\Http\Controllers\CustomControllers\LoginController::class, 'handleGoogleCallback']);

    // Facebook Login
    Route::get('login/facebook', [App\Http\Controllers\CustomControllers\LoginController::class, 'redirectToFacebook'])->name('login.facebook');
    Route::get('login/facebook/callback', [App\Http\Controllers\CustomControllers\LoginController::class, 'handleFacebookCallback']);


// Group route for admin - middleware 
    Route::group(['middleware' => ['admin']], function () {
    // Main Admin Dashboard Routes
        // To not allow guest users go to admin panel
        Route::get('/only_admin', [App\Http\Controllers\Admin\MainDashboardController::class, 'only_admin'])->name('only_admin');

        // Routes for the Dashboard
        // To prompt user to admin panel - main
        Route::get('/sendQREmail/{id}', [App\Http\Controllers\Admin\MainDashboardController::class, 'sendQREmail'])->name('sendQREmail');
            // To prompt user to admin panel - main
            Route::get('/show_dashboard_main', [App\Http\Controllers\Admin\MainDashboardController::class, 'show_dashboard_main'])->name('show_dashboard_main');
            // To prompt user to announcements
            Route::get('/show_announcements', [App\Http\Controllers\Admin\MainDashboardController::class, 'show_announcements'])->name('show_announcements');
            // add new announcement 
            Route::post('/add_announcement', [App\Http\Controllers\Admin\MainDashboardController::class, 'add_announcement'])->name('add_announcement');
            // show announcement details
            Route::get('/announcement_details/{id}', [App\Http\Controllers\Admin\MainDashboardController::class, 'announcement_details'])->name('announcement_details');
            // delete announcement from table
            Route::delete('/delete_announcement/{id}', [App\Http\Controllers\Admin\MainDashboardController::class, 'delete_announcement'])->name('delete_announcement');
            // show page to update announcement from table
            Route::get('/announcement_update/{id}', [App\Http\Controllers\Admin\MainDashboardController::class, 'announcement_update'])->name('announcement_update');
            // update announcement from table
            Route::put('/announcement_update_action/{id}', [App\Http\Controllers\Admin\MainDashboardController::class, 'announcement_update_action'])->name('announcement_update_action');

        // Orders
            // show latest order
            Route::get('/show_latest_order', [App\Http\Controllers\Admin\MainDashboardController::class, 'show_latest_order'])->name('show_latest_order');
            // approve order
            Route::put('/approve_order/{id}', [App\Http\Controllers\Admin\MainDashboardController::class, 'approve_order'])->name('approve_order');
            // decline order
            Route::put('/decline_order/{id}', [App\Http\Controllers\Admin\MainDashboardController::class, 'decline_order'])->name('decline_order');
            // show approved orders
            Route::get('/show_approved_orders', [App\Http\Controllers\Admin\MainDashboardController::class, 'show_approved_orders'])->name('show_approved_orders');
            // show declined orders
            Route::get('/show_declined_orders', [App\Http\Controllers\Admin\MainDashboardController::class, 'show_declined_orders'])->name('show_declined_orders');
            // show orders history
            Route::get('/show_order_history', [App\Http\Controllers\Admin\MainDashboardController::class, 'show_order_history'])->name('show_order_history');
            // show approved orders
            Route::get('/show_order_details/{id}', [App\Http\Controllers\Admin\MainDashboardController::class, 'show_order_details'])->name('show_order_details');
            // show qr code of order
            Route::get('/show_qr_of_order/{id}', [App\Http\Controllers\Admin\MainDashboardController::class, 'show_qr_of_order'])->name('show_qr_of_order');

        // Routes for Regions table 
            // show regions table
            Route::get('/show_regions', [App\Http\Controllers\Admin\MainDashboardController::class, 'show_regions'])->name('show_regions');
            // add region to table
            Route::post('/add_region', [App\Http\Controllers\Admin\MainDashboardController::class, 'add_region'])->name('add_region');
            // delete region from table
            Route::delete('/delete_region/{id}', [App\Http\Controllers\Admin\MainDashboardController::class, 'delete_region'])->name('delete_region');
            // show page to update region from table
            Route::get('/region_update/{id}', [App\Http\Controllers\Admin\MainDashboardController::class, 'region_update'])->name('region_update');
            // update region from table
            Route::put('/region_update_action/{id}', [App\Http\Controllers\Admin\MainDashboardController::class, 'region_update_action'])->name('region_update_action');

        // Routes for Provinces table 
            // show provinces table
            Route::get('/show_provinces', [App\Http\Controllers\Admin\MainDashboardController::class, 'show_provinces'])->name('show_provinces');
            // add province to table
            Route::post('/add_province', [App\Http\Controllers\Admin\MainDashboardController::class, 'add_province'])->name('add_province');
            // delete province from table
            Route::delete('/delete_province/{id}', [App\Http\Controllers\Admin\MainDashboardController::class, 'delete_province'])->name('delete_province');
            // show page to update province from table
            Route::get('/province_update/{id}', [App\Http\Controllers\Admin\MainDashboardController::class, 'province_update'])->name('province_update');
            // update province from table
            Route::put('/province_update_action/{id}', [App\Http\Controllers\Admin\MainDashboardController::class, 'province_update_action'])->name('province_update_action');

        // Routes for Cities table 
            // show cities table
            Route::get('/show_cities', [App\Http\Controllers\Admin\MainDashboardController::class, 'show_cities'])->name('show_cities');
            // add city to table
            Route::post('/add_city', [App\Http\Controllers\Admin\MainDashboardController::class, 'add_city'])->name('add_city');
            // delete city from table
            Route::delete('/delete_city/{id}', [App\Http\Controllers\Admin\MainDashboardController::class, 'delete_city'])->name('delete_city');
            // show page to update city from table
            Route::get('/city_update/{id}', [App\Http\Controllers\Admin\MainDashboardController::class, 'city_update'])->name('city_update');
            // update city from table
            Route::put('/city_update_action/{id}', [App\Http\Controllers\Admin\MainDashboardController::class, 'city_update_action'])->name('city_update_action');
            // for ajax
            Route::get('/getProvinces/{id}', [App\Http\Controllers\Admin\MainDashboardController::class, 'getProvinces']);

        // Routes for Store Branches table 
            // show branch table
            Route::get('/show_branches', [App\Http\Controllers\Admin\MainDashboardController::class, 'show_branches'])->name('show_branches');
            // add branch to table
            Route::post('/add_store_branch', [App\Http\Controllers\Admin\MainDashboardController::class, 'add_store_branch'])->name('add_store_branch');
            // delete branch from table
            Route::delete('/delete_branch/{id}', [App\Http\Controllers\Admin\MainDashboardController::class, 'delete_branch'])->name('delete_branch');
            // show page to update branch from table
            Route::get('/branch_update/{id}', [App\Http\Controllers\Admin\MainDashboardController::class, 'branch_update'])->name('branch_update');
            // update branch from table
            Route::put('/branch_update_action/{id}', [App\Http\Controllers\Admin\MainDashboardController::class, 'branch_update_action'])->name('branch_update_action');
            // for ajax
            Route::get('/getCities/{id}', [App\Http\Controllers\Admin\MainDashboardController::class, 'getCities']);
            Route::get('/getProvince/{id}', [App\Http\Controllers\Admin\MainDashboardController::class, 'getProvince']);

        // Routes for Product Categories
            // show categories table
            Route::get('/show_categories', [App\Http\Controllers\Admin\MainDashboardController::class, 'show_categories'])->name('show_categories');
            // add category to table
            Route::post('/add_category', [App\Http\Controllers\Admin\MainDashboardController::class, 'add_category'])->name('add_category');
            // delete category from table
            Route::delete('/delete_category/{id}', [App\Http\Controllers\Admin\MainDashboardController::class, 'delete_category'])->name('delete_category');
            // show page to update category from table
            Route::get('/category_update_info/{id}', [App\Http\Controllers\Admin\MainDashboardController::class, 'category_update_info'])->name('category_update_info');
            // show page to update category from table
            Route::get('/category_update/{id}', [App\Http\Controllers\Admin\MainDashboardController::class, 'category_update'])->name('category_update');
            // update category from table
            Route::put('/category_update_action/{id}', [App\Http\Controllers\Admin\MainDashboardController::class, 'category_update_action'])->name('category_update_action');

        // Routes for Product Subcategories
            // show subcategories table
            Route::get('/show_subcategories', [App\Http\Controllers\Admin\MainDashboardController::class, 'show_subcategories'])->name('show_subcategories');
            // add category to table
            Route::post('/add_subcategory', [App\Http\Controllers\Admin\MainDashboardController::class, 'add_subcategory'])->name('add_subcategory');
            // delete subcategory from table
            Route::delete('/delete_subcategory/{id}', [App\Http\Controllers\Admin\MainDashboardController::class, 'delete_subcategory'])->name('delete_subcategory');
            // show page to update category from table
            Route::get('/subcategory_update/{id}', [App\Http\Controllers\Admin\MainDashboardController::class, 'subcategory_update'])->name('subcategory_update');
            // update category from table
            Route::put('/subcategory_update_action/{id}', [App\Http\Controllers\Admin\MainDashboardController::class, 'subcategory_update_action'])->name('subcategory_update_action');

        // Routes for Products table
            // show products table
            Route::get('/show_products', [App\Http\Controllers\Admin\MainDashboardController::class, 'show_products'])->name('show_products');
            // add products to table
            Route::post('/add_products', [App\Http\Controllers\Admin\MainDashboardController::class, 'add_products'])->name('add_products');
            // search products
            Route::get('/search_products', [App\Http\Controllers\Admin\MainDashboardController::class, 'search_products'])->name('search_products');
            // show product details
            Route::get('/products_details/{id}', [App\Http\Controllers\Admin\MainDashboardController::class, 'products_details'])->name('products_details');
            // delete products from table
            Route::delete('/delete_product', [App\Http\Controllers\Admin\MainDashboardController::class, 'delete_product'])->name('delete_product');
            // show product update 
            Route::get('/product_update/{id}', [App\Http\Controllers\Admin\MainDashboardController::class, 'product_update'])->name('product_update');
            // update product from table
            Route::put('/product_update_action/{id}', [App\Http\Controllers\Admin\MainDashboardController::class, 'product_update_action'])->name('product_update_action');

            // for ajax
            Route::get('/getSubcategory/{id}', [App\Http\Controllers\Admin\MainDashboardController::class, 'getSubcategory']);

        // Routes for Admin Users
            // show admin users
            Route::get('/show_admin_users', [App\Http\Controllers\Admin\MainDashboardController::class, 'show_admin_users'])->name('show_admin_users');
            // search users
            Route::get('/search_admin_users', [App\Http\Controllers\Admin\MainDashboardController::class, 'search_admin_users'])->name('search_admin_users');
            // show admin user details
            Route::get('/admin_user_details/{id}', [App\Http\Controllers\Admin\MainDashboardController::class, 'admin_user_details'])->name('admin_user_details');
            // update user role
            Route::put('/update_user_role/{id}', [App\Http\Controllers\Admin\MainDashboardController::class, 'update_user_role'])->name('update_user_role');
            

        // Routes for Client Users
            // show client users
            Route::get('/show_client_users', [App\Http\Controllers\Admin\MainDashboardController::class, 'show_client_users'])->name('show_client_users');
            // show client users details
            Route::get('/client_details/{id}', [App\Http\Controllers\Admin\MainDashboardController::class, 'client_details'])->name('client_details');

        // Routes for User Profile
            // show user profile
            Route::get('/show_userprofile', [App\Http\Controllers\Admin\MainDashboardController::class, 'show_userprofile'])->name('show_userprofile');
            // update product from table
            Route::put('/user_image_update', [App\Http\Controllers\Admin\MainDashboardController::class, 'user_image_update'])->name('user_image_update');
            // update product from table
            Route::put('/user_details_update', [App\Http\Controllers\Admin\MainDashboardController::class, 'user_details_update'])->name('user_details_update');
    });

