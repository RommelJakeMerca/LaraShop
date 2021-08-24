
$('.proceed-to-checkout').click((event) => {
    let totalValue = $('.total-value').text();

    if(totalValue < 500) {
        event.preventDefault();
        $('.minimum-container').show();
    }
});


//VALIDATION FOR QUANTITY
$('.product-quantity-value').bind('keyup paste', function(e){
    this.value = this.value.replace(/[^0-9]/g, '1'); 
});

//SPECIFIC PRODUCT INCREMENT BUTTON 
$('[class=plus-product]').click((event)=> {
    let plusQuantity = $(event.target)
                        .closest('.product-col')
                        .find('#product-quantity-value');
    let plusValueQuantity = parseInt(plusQuantity.val());

    if( plusValueQuantity >= 0) {
        plusValueQuantity++;
        parseInt(plusQuantity.val(plusValueQuantity));
        $(event.target).closest('.product-col')
                       .find('.minus-product')
                       .removeAttr('disabled');
   }
});

//SPECIFIC PRODUCT DECREMENT BUTTON 
$('[class=minus-product]').click((event)=> {
    let minusQuantity = $(event.target)
                    .closest('.product-col')
                    .find('#product-quantity-value');
    let minusValueQuantity = parseInt(minusQuantity.val());

    if( minusValueQuantity > 1) {
        minusValueQuantity--;
        parseInt(minusQuantity.val(minusValueQuantity));
    } else {
        $(event.target).closest('.product-col')
                       .find('.minus-product')
                       .prop("disabled", true);
   }
});

// let totalValue = parseInt($('.total-value').text());
// let totalValueWithComma = (totalValue).toLocaleString(undefined,
//     {minimumFractionDigits:2,maximumFractionDigits:2});
// $('.total-value').html(totalValueWithComma);

// let receiptValue = parseInt($('.receipt-value').text());
// let receiptValueWithComma = (totalValue).toLocaleString(undefined,
//     {minimumFractionDigits:2,maximumFractionDigits:2});
// $('.receipt-value').html(receiptValueWithComma);

// let priceValue = $('.price-value').text();
// let priceValueWithComma = (totalValue).toLocaleString(undefined,
//     {minimumFractionDigits:2,maximumFractionDigits:2});
// $('.price-value').html(priceValueWithComma);




  // let totalValue = parseInt($('.total-value').text());
      // let totalValueWithComma = (totalValue).toLocaleString(undefined,
      //     {minimumFractionDigits:2,maximumFractionDigits: 2});
      // $('.total-value').html(cartTotalValueWithComma);
      // let receiptValue = parseInt($('.receipt-value').text());
      // let receiptValueWithComma = (totalValue).toLocaleString(undefined,
      //     {minimumFractionDigits:2,maximumFractionDigits: 2});
      // $('.receipt-value').html(receiptValueWithComma);
      // let priceValue = $('.price-value').text();
      // let priceValueWithComma = (totalValue).toLocaleString(undefined,
      //     {minimumFractionDigits:2,maximumFractionDigits:2});
      // $('.price-value').html(priceValueWithComma);




// $('[id=add-cart]').click((event)=> {
//     swal({
//         icon:'success',
//         title:'Success!',
//         text:'Product successfully added to your cart',
//         timer: 1500,
//         button:false,
//         className:'swal-back'
//     });
//     let getDataProductId = $(event.target)
//                     .closest('.product-col')
//                     .data('id');

//     let getProductImage = $(event.target)
//                     .closest('.product-col')
//                     .find('.product-img')
//                     .attr('src');

//     let getSubtringImage = getProductImage
//                     .substring(getProductImage
//                     .lastIndexOf('images/')+7);

//     let getProductName = $(event.target)
//                     .closest('.product-col')
//                     .find('.card-name')
//                     .text();

//     let getProductQuantity = parseInt($(event.target)
//                     .closest('.product-col')
//                     .find('#product-quantity-value')
//                     .val());

//     let getProductPrice = parseFloat($(event.target)
//                     .closest('.product-col')
//                     .find('#price-product')
//                     .text()
//                     .trim()
//                     .replace(',','') * getProductQuantity);
    
//     let getProductPriceWithComma = getProductPrice.toLocaleString( undefined, {
//                                     minimumFractionDigits: 2,
//                                     maximumFractionDigits: 2
//                                 });
                     
//     getValueLocalStorage = [];

//     localStorage.getItem('products') ? getValueLocalStorage = JSON.parse(localStorage.getItem('products')) : '';

//     let existingProduct = getValueLocalStorage.find(({productId}) => productId === getDataProductId);

//     if (existingProduct) {
//         Object.assign(existingProduct, {
//             'productId':getDataProductId,
//             'productImage':getSubtringImage,
//             'productName':getProductName,
//             'productQuantity':getProductQuantity,
//             'productPrice':getProductPriceWithComma
//         });
//     } else {
//         let localStorageProduct = 
//     {
//         'productId':getDataProductId,
//         'productImage':getSubtringImage,
//         'productName':getProductName,
//         'productQuantity':getProductQuantity,
//         'productPrice':getProductPriceWithComma
//     };
//         getValueLocalStorage.push(localStorageProduct);
//     }

//     localStorage.setItem('products', JSON.stringify(getValueLocalStorage));
      
//     $('.cart-sidebar-content').html('');
//     for (let i in getValueLocalStorage) {
//          $('.cart-sidebar-content').prepend(
//             "<li>"+ "<img class='sidebar-cart-img' src='/products_asset/images/"+(getValueLocalStorage[i].productImage)+"'/>" + 
//             "<p class='sidebar-cart-name' id='sidebar-cart-name'>" + getValueLocalStorage[i].productName + 
//             "</p><p class='sidebar-cart-quantity'> X" + "<b>" + getValueLocalStorage[i].productQuantity +  "</b>" +
//             "</p><p class='sidebar-cart-price'>" + "<b>" + "₱&nbsp;" + getValueLocalStorage[i].productPrice + "</b>" + "</p></li>"
//         );
//     }

//     let sumQuantity = 0;
//     let sumPrice = 0;
//     for(let i in  getValueLocalStorage) {
//         sumQuantity += getValueLocalStorage[i].productQuantity;
//         sumPrice +=  parseFloat((getValueLocalStorage[i].productPrice).trim().replace(',',''));
//     }
//     let getSumPriceWithComma = sumPrice.toLocaleString(undefined,
//         {minimumFractionDigits: 2,maximumFractionDigits: 2});

//     $('.count-products').text(sumQuantity);
//     $('#cart-total-price').text(getSumPriceWithComma);
// });

// let keepGetValueLocalStorage = JSON.parse(localStorage.getItem('products'));
// let sumQuantity = 0;
// let sumPrice = 0;

// for(let i in keepGetValueLocalStorage) {
//     if(keepGetValueLocalStorage){
//         sumQuantity += keepGetValueLocalStorage[i].productQuantity;
//         sumPrice +=  parseFloat((keepGetValueLocalStorage[i].productPrice).trim().replace(',',''));
//         $('.cart-sidebar-content').prepend(
//         "<li>"+ "<img class='sidebar-cart-img' src='/products_asset/images/"+(keepGetValueLocalStorage[i].productImage)+"'/>" + 
//         "<p class='sidebar-cart-name' id='sidebar-cart-name'>" + keepGetValueLocalStorage[i].productName + 
//         "</p><p class='sidebar-cart-quantity'> X" + "<b>" +keepGetValueLocalStorage[i].productQuantity + "</b>" +
//         "</p><p class='sidebar-cart-price'>" + "<b>" + "₱&nbsp;" + keepGetValueLocalStorage[i].productPrice + "</b>" + "</p></li>"
//         );
//     }
// }

// //FETCHING EVERY QUANTITY OF DATA
// $('[id=product-quantity-value]').each(function() { 
//     let getDataProductId = $(this).closest('.product-col').data('id');
//         for(let i in keepGetValueLocalStorage) {
//             if( getDataProductId == keepGetValueLocalStorage[i].productId){
//                 $(this).closest('.product-col').find('#product-quantity-value')
//                 .val(keepGetValueLocalStorage[i].productQuantity);
//         }
//     }
// });

// let keepGetSumPriceWithComma = sumPrice.toLocaleString(undefined,
//         {minimumFractionDigits: 2,maximumFractionDigits: 2});

// //KEEP SHOWING THE DATA 
// window.onload = () =>  {
//     $('.count-products').text(sumQuantity);
//     $('#cart-total-price').text(keepGetSumPriceWithComma);
//     if(keepGetValueLocalStorage == null){
//         $('.cart-sidebar-content').html(
//         "<li><p><i class='fas fa-shopping-cart'></i></p>" +
//         "<p class='cart-empty'>YOUR SHOPPING CART IS EMPTY</i></p></li>"
//         );
//     };  
// };

// //VALIDATION FOR QUANTITY
// $('.product-quantity-value').bind('keyup paste', function(e){
//     this.value = this.value.replace(/[^0-9]/g, '1'); 
// });

// //SPECIFIC PRODUCT INCREMENT BUTTON 
// $('[class=plus-product]').click((event)=> {
//     let plusQuantity = $(event.target)
//                         .closest('.product-col')
//                         .find('#product-quantity-value');
//     let plusValueQuantity = parseInt(plusQuantity.val());

//     if( plusValueQuantity >= 0) {
//         plusValueQuantity++;
//         parseInt(plusQuantity.val(plusValueQuantity));
//         $(event.target).closest('.product-col')
//                        .find('.minus-product')
//                        .removeAttr('disabled');
//    }
// });

// //SPECIFIC PRODUCT DECREMENT BUTTON 
// $('[class=minus-product]').click((event)=> {
//     let minusQuantity = $(event.target)
//                     .closest('.product-col')
//                     .find('#product-quantity-value');
//     let minusValueQuantity = parseInt(minusQuantity.val());

//     if( minusValueQuantity > 1) {
//         minusValueQuantity--;
//         parseInt(minusQuantity.val(minusValueQuantity));
//     } else {
//         $(event.target).closest('.product-col')
//                        .find('.minus-product')
//                        .prop("disabled", true);
//    }
// });


