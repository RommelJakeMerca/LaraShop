<!-- <NAV BAR TOP -->
<div class="container-fluid navbar-top border-bottom" id="navbar-top">
    <div class="container mt-2" >
        <div class="row">
            <div class="col-6">
            <a class="navbar-brand" href="{{route('products.store')}}">
                <img src="{{asset('products_asset/icon/legashop.png')}}">
            </a>
            </div>
            <div class="col-4 mt-4">
                <input class="form-control shadow-none search" type="search" id="search-bar"
                placeholder="What are you looking for?" name="product_name" aria-label="Search" maxlength="50">
                <span><i class="fas fa-search search-icon"></i></span>
            </div>
            <div class="col-2 quantity-product-container">
            @if(isset($totalQuantity))
                @if($totalQuantity > 0)
                    <span class="quantity count-products">{{$totalQuantity}}</span>
                @else 
                    <span class="quantity count-products">0</span>
                @endif
            @endif 
                <ul class="icon-container">
                    <li id="sidebar-cart-btn">
                        <i class="fas fa-shopping-cart" id="open-cart-btn"></i>
                    </li>
                    <li class="user-icon"><i class="fas fa-user" id="user-account-btn"></i>
                        <ul class="user-container">
                            @if (Auth::id())
                                <li class="manage-info">
                                    Manage Information
                                </li>
                                <li class="mt-2 customer-name">Welcome, 
                                    <b id="customer-name">{{$currentUsers->name}}</b>
                                </li>
                                <li class="mt">
                                    <a href="{{route('products.profile-settings')}}">
                                        My Account
                                    </a>
                                </li>
                                <li>
                                    <a href="{{route('products.rewards')}}">
                                        My Reward Points
                                    </a>
                                </li>
                                <li class="mb-2 ">
                                    <a href="{{route('products.transaction')}}">
                                        Transaction History
                                    </a>
                                </li>
                                <li class="logout">
                                <a href="{{route('client.logout')}}" onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                                    Log out
                                </a>
                                    <form id="logout-form" action="{{route('client.logout')}}" 
                                        method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </li>
                            @else
                                <li class="manage-info-guest">
                                    LOGIN | REGISTER
                                </li>
                                <div class="lr-container mt-2">
                                    <li class="login-guest mt-2">
                                        <a href="{{route('client.login')}}"><i class="fas fa-sign-in-alt"></i>
                                            <b>
                                                LOGIN
                                            </b>
                                        </a>
                                    </li>
                                    <li class="register-guest mt-2" style="">
                                        <a href="#"><i class="fas fa-user-plus"></i> 
                                            <b class="register1">
                                                REGISTER
                                            </b>
                                        </a>
                                    </li>
                                </div>
                            @endif
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div> 
</div>
        
<!-- <NAV BAR BOTTOM -->
<div class="container-fluid navbar-bottom">
    <div class="container pt-3" >
        <ul class="nav">
        <li><a class="{{request()->is('products/rice&grains')?'actived':''}}" 
            href="{{route('products.rice_grains')}}">Rice & Grains
            <span><i class="fas fa-sort-down"></i></span></a>
            <ul class="nav-list-items">
                <li><a class="{{request()->is('products/rice&grains/dinorado')?'actived':''}}"
                    href="{{route('products.dinorado')}}">
                    Dinorado Rice
                    </a>
                </li>
                <li><a class="{{request()->is('products/rice&grains/jasponica')?'actived':''}}" 
                    href="{{route('products.jasponica')}}">
                    Doña Maria Jasponica 
                    </a>
                </li> 
                <li><a class="{{request()->is('products/rice&grains/miponica')?'actived':''}}"
                    href="{{route('products.miponica')}}">
                    Doña Maria Miponica 
                    </a>
                </li>
                <li><a class="{{request()->is('products/rice&grains/jasmine')?'actived':''}}" 
                        href="{{route('products.jasmine')}}">
                        Jasmine Rice
                    </a>
                </li>
                <li><a class="{{request()->is('products/rice&grains/sinandomeng')?'actived':''}}"
                        href="{{route('products.sinandomeng')}}">
                        Sinandomeng Rice
                    </a>
                </li>
            </ul>
        </li>
        <li><a class="{{request()->is('products/fruits&vegetables')?'actived':''}}"
            href="{{route('products.fruits_vegetables')}}">Fruits & Vegetables 
            <span><i class="fas fa-sort-down"></i></span></a>
            <ul class="nav-list-items">
                <li><a class="{{request()->is('products/fruits&vegetables/ampalaya')?'actived':''}}"
                        href="{{route('products.ampalaya')}}">
                        Ampalaya
                    </a>
                </li>
                <li><a class="{{request()->is('products/fruits&vegetables/banana')?'actived':''}}"
                        href="{{route('products.banana')}}">
                        Banana
                    </a>
                </li>
                <li><a class="{{request()->is('products/fruits&vegetables/cabbage')?'actived':''}}"
                        href="{{route('products.cabbage')}}">
                        Cabbage
                    </a>
                </li>
                <li><a class="{{request()->is('products/fruits&vegetables/carrot')?'actived':''}}"
                        href="{{route('products.carrot')}}">
                        Carrot
                    </a>
                </li>
                <li><a class="{{request()->is('products/fruits&vegetables/orange')?'actived':''}}"
                        href="{{route('products.orange')}}">
                        Orange
                    </a>
                </li>
            </ul>
        </li>
        <li><a class="{{request()->is('products/cannedgoods')?'actived':''}}"
            href="{{route('products.cannedGoods')}}">Canned Goods 
            <span><i class="fas fa-sort-down"></i></span></a>
            <ul class="nav-list-items">
                <li><a class="{{request()->is('products/cannedgoods/cornedbeef')?'actived':''}}"
                    href="{{route('products.cornedBeef')}}">
                    Corned Beef
                    </a>
                </li>
                <li><a class="{{request()->is('products/cannedgoods/ham')?'actived':''}}"
                        href="{{route('products.ham')}}">
                        Ham
                    </a>
                </li>
                <li><a class="{{request()->is('products/cannedgoods/luncheonmeat')?'actived':''}}"
                        href="{{route('products.luncheonMeat')}}">
                        Luncheon Meat
                    </a>
                </li>
                <li><a class="{{request()->is('products/cannedgoods/sardines')?'actived':''}}"
                        href="{{route('products.sardines')}}">
                        Sardines
                    </a>
                </li>
                <li><a class="{{request()->is('products/cannedgoods/tuna')?'actived':''}}"
                        href="{{route('products.tuna')}}">
                        Tuna
                    </a>
                </li>
            </ul>
        </li>
            <li><a class="{{request()->is('products/snacks&beverages')?'actived':''}}"
            href="{{route('products.snacksBeverages')}}">Snacks & Beverages
            <span><i class="fas fa-sort-down"></i></span></a>
            <ul class="nav-list-items">
                <li><a class="{{request()->is('products/snacks&beverages/beer')?'actived':''}}"
                    href="{{route('products.beer')}}">
                    Beer
                    </a>
                </li>
                <li><a class="{{request()->is('products/snacks&beverages/biscuit')?'actived':''}}"
                    href="{{route('products.biscuit')}}">
                    Biscuit
                    </a>
                </li>
                <li><a class="{{request()->is('products/snacks&beverages/chips')?'actived':''}}"
                    href="{{route('products.chips')}}">
                    Chips
                    </a>
                </li>
                <li><a class="{{request()->is('products/snacks&beverages/coffee')?'actived':''}}"
                    href="{{route('products.coffee')}}">
                    Coffee
                    </a>
                </li>
                <li><a class="{{request()->is('products/snacks&beverages/softdrinks')?'actived':''}}"
                    href="{{route('products.softdrinks')}}">
                    Softdrinks
                    </a>
                </li>
            </ul>
        </li>
            <li><a class="{{request()->is('products/householdcare')?'actived':''}}" 
                href="{{route('products.householdCare')}}">Household Care
                <span><i class="fas fa-sort-down"></i></span></a>
            <ul class="nav-list-items">
                <li><a class="{{request()->is('products/householdcare/dishwashing')?'actived':''}}"
                    href="{{route('products.dishwashing')}}">
                    Dishwashing
                    </a>
                </li>
                <li><a class="{{request()->is('products/householdcare/insect&pest')?'actived':''}}"
                    href="{{route('products.insectPest')}}">
                    Insect & Pest Control
                    </a>
                </li>
                <li><a class="{{request()->is('products/householdcare/laundry')?'actived':''}}"
                    href="{{route('products.laundry')}}">
                    Laundry
                    </a>
                </li>
                <li><a class="{{request()->is('products/householdcare/tissue')?'actived':''}}"
                    href="{{route('products.tissue')}}">
                    Tissue
                    </a>
                </li>
                <li><a class="{{request()->is('products/householdcare/toilet-cleaners')?'actived':''}}"
                    href="{{route('products.toiletCleaners')}}">
                    Toilet Cleaners
                    </a>
                </li>
            </ul></li>
        </ul>
    </div> 
</div>
    
    
<!-- JQUERY -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js" 
integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" 
crossorigin="anonymous"></script>

<script>
    // JQUERY SHOW ONLY FIRSTNAME
    var customerName = $('#customer-name').text();
    var customerSplit = customerName.split(" ");
    var customerSlice = customerSplit.slice(0,1);
    $('#customer-name').text(customerSlice);
</script>
    