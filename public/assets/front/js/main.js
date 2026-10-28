$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

function showCart(cart){
   $('#cart-modal .modal-body').html(cart)
   $('#cart-modal').modal()
   let cartQty = $('#modal-cart-qty').text() ? $('#modal-cart-qty').text() : 0
   $('.mini-cart-qty').text(cartQty)
   
   $('.mini-cart-total, #modal-cart-total').text($('#modal-cart-total').text() ? $('#modal-cart-total').text() : '0 руб.');

   if (cartQty){
    $('#cart-modal .modal-footer button.btn-cart').removeClass('d-none')
   } else {
    $('#cart-modal .modal-footer button.btn-cart').addClass('d-none')
   }
}


function clearCart (action){
    $.ajax({
        url: action,
        type: 'get',
        success: function(result){
            let now_location = document.location.pathname;
            if (now_location == '/cart/checkout'){
                location = '/cart/checkout'
            } else {
                showCart(result);
            }
        },
        error: function (){
            alert('Error')
        }
    })
}

function getCart(action){
   $.ajax({
      url: action,
      type: 'get',
      success: function (result){
         showCart(result)
      },
      error: function (){
         alert('error')
      }
   })
}

$(function() {
        // cart
    $('.addtocart').on('submit', function (e){
        e.preventDefault(); 
        
        let form = $(this);
        let btn = form.find('.card-addtocart'); 
        
        // БЛОКИРОВКА ОТ СПАМА
        if (btn.prop('disabled')) {
            return false;
        }

        // Защита ввода количества
        let qtyInput = form.find('input[name="qty"]');
        let qtyValue = parseInt(qtyInput.val(), 10);
        if (isNaN(qtyValue) || qtyValue < 1) { qtyValue = 1; }
        qtyInput.val(qtyValue);

        btn.prop('disabled', true).addClass('disabled').css('opacity', '0.7');

        $.ajax({
            url: form.attr('action'),
            data: form.serialize(),
            type: 'post',
            success: function(result){
                btn.prop('disabled', false).removeClass('disabled').css('opacity', '1');

                $('#cart-modal .modal-body').html(result);
                
                let cartQty = $('#modal-cart-qty').text() ? $('#modal-cart-qty').text() : 0;
                let cartTotal = $('#modal-cart-total').text() ? $('#modal-cart-total').text() : '0 руб.';
                
                $('.mini-cart-qty').text(cartQty);
                $('.mini-cart-total').text(cartTotal); 
            },
            error: function (msg){
                btn.prop('disabled', false).removeClass('disabled').css('opacity', '1');

                alert('Произошла ошибка при добавлении товара. Попробуйте еще раз.');
                console.log(msg.responseJSON);
            }
        });
        return false;
   
    });


    $('#cart-modal .modal-body') .on ('click', '.del-item', function (){
        $.ajax({
            url: $(this) .data('action'),
            type: 'get',
            success: function (result){
                let now_location = document.location.pathname;
                if (now_location == '/cart/checkout'){
                    location = '/cart/checkout'
                } else {
                    showCart(result);
                }
            },
            error: function (msg){
                alert('Error!!')
            }
        })
    })
});
