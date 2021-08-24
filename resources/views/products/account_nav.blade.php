
<link rel="stylesheet" href="{{ asset('products_asset/css/style.css')}}">
<!-- MYACCOUNT NAVIGATION -->
<div class="col-md-3 customer-list">
    <h5 class="acc-dash">Account Dashboard</h5>
    <div class="d-flex pb-3 profile-container">
        <img class="profile-photo"src="{{$currentUsers->avatar}}">
        <p class="profile-name">{{$currentUsers->name}}</p>
        <p class="profile-shopper">LegaShopper</p>
    </div>
    <ul class="mt-2">
        <li>
            <i class="fas fa-user-circle"></i>  
            <a href="{{route('products.profile-settings')}}" 
            class="{{request()->is('customer/profile-settings') ? 'actived' : ''}}">
                My Account
            </a>
        </li>
        <li>
            <i class="fas fa-gifts"></i>
            <a href="{{route('products.rewards')}}"
            class="{{request()->is('customer/rewards') ? 'actived' : ''}}">
                My Rewards
            </a>
        </li>
        <li>
            <i class="fas fa-list-alt"></i>
            <a href="{{route('products.transaction')}}"
            class="{{request()->is('customer/transaction-history') ? 'actived' : ''}}">
                Transaction  History
            </a>
        </li>
    </ul>
</div>