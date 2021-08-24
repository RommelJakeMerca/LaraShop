<!-- SIDEBAR CART  -->
<div class="sidebar-cart" id="sidebar-cart">
  <header>SHOPPING CART <i class="fas fa-shopping-bag"></i>
    <button id="close-cart-btn" class="close-cart"><i class="fas fa-times"></i></button>
  </header>
  <div class="cart-subtext">
    <p class="added-products">Latest Added Products</p>
  </div>
  @if(isset($cartTables))
    <ul class="cart-sidebar-content">
      @forelse ($cartTables as $cartTable)
        <li>
          <img class='sidebar-cart-img' src="{{asset('uploads/product_images/'.$cartTable->product_image)}}">
          <p class='sidebar-cart-name' id='sidebar-cart-name'>{{$cartTable->product_name}}</p>
        <p class='sidebar-cart-quantity'>X<b>{{$cartTable->product_quantity}}</b></p>
          <p class='sidebar-cart-price'><b>₱ {{$cartTable->product_price}}.00</b></p>
        </li>
      @empty
        <li>
          <p><i class='fas fa-shopping-cart'></i></p>
          <p class='cart-empty'>YOUR SHOPPING CART IS EMPTY</i></p>
        </li>
      @endforelse
    </ul>
    <p class="sidebar-cart-total">
        CART TOTAL:<b id="cart-total-price">{{$totalPrice}}</b><b>&#8369;</b>
    </p>
  @endif 
  @if(Auth::id())
    {{-- <form action="{{route('addCart')}}" method="POST"> --}}
      @csrf
      <p class="sidebar-cart-gtsc">
        <a class="shopping-cart-btn" href="{{route('products.shopping-cart')}}">
          PROCEED TO SHOPPING CART <i class="fas fa-shopping-cart"></i>
        </a>
      </p>
    </form>
  @else 
    <p class="sidebar-cart-gtsc">
      <a class="shopping-cart-btn" href="{{route('client.login')}}">
        LOGIN 
      </a> 
    </p>
  @endif
</div>

<script>
let getValueLocalStorage = JSON.parse(localStorage.getItem('products'));
let getSumQuantity = 0;
let getSumPrice = 0;
</script>