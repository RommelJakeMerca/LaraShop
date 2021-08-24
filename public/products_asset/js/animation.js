//OPEN SIDEBAR NAVIGATION LIST
function openSidebar() {
  document.getElementById('sidebar-navigation').style.left="0%";
  document.getElementById('sidebar-navigation').style.transition="1s";
  document.body.style.overflowY="hidden";
}

//CLOSE SIDEBAR NAVIGATION LIST
function closeSidebar() {
  document.getElementById('sidebar-navigation').style.left="-100%";
  document.body.style.overflowY = "scroll";
}

AOS.init();

//OPEN SIDEBAR CART
$('#open-cart-btn').click(()=>{
  $('#sidebar-cart').css({
    'right': '0',
    'transition': '.5s'
  });
});

//CLOSE SIDEBAR CART
$('#close-cart-btn').click(()=>{
  $('#sidebar-cart').css({'right': '-50%','transition': '1s'});
});

//ZOOM OPTION
$(document).ready(()=> {
  $('#zoom-product').okzoom({
  width: 200,
  height:200
  });
});