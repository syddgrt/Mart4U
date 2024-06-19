
    
    function getCart(val){
      var quantity = document.getElementById('quantity_' + val).value;
      
      var total_added_to_cart_quantity = 0;
      if(document.getElementById('total-added-to-cart-quantity-' + val))
      {
        var total_added_to_cart_quantity = document.getElementById('total-added-to-cart-quantity-' + val).innerHTML;
      }
      var max_quantity = document.getElementById('max-quantity-' + val).innerHTML;

      var new_total_quantity = parseInt(total_added_to_cart_quantity) + parseInt(quantity);

      // If exceeded max quantity
      if (new_total_quantity > parseInt(max_quantity))
      {
        var message = "Exceeded quantity amount!";
        
        document.getElementById('exampleModalLabel').innerHTML = message;
        document.getElementById('cart-modal-exceeded-quantity').classList.remove('d-none');
        document.getElementById('cart-modal-title-h2').classList.add('d-none');
        document.getElementById('cart-modal-item-name').classList.add('d-none');
        document.getElementById('cart-modal-item-quantity').classList.add('d-none');
        document.getElementById('cart-modal-item-price').classList.add('d-none');
        document.getElementById('cart-modal-item-total-price').classList.add('d-none');

        document.getElementById('cart-bg-color-alert').classList.add('text-bg-danger');

      }
      else
      {
        // If NOT exceeded max quantity
        document.getElementById('cart-modal-exceeded-quantity').classList.add('d-none');
        document.getElementById('cart-modal-title-h2').classList.remove('d-none');
        document.getElementById('cart-modal-item-name').classList.remove('d-none');
        document.getElementById('cart-modal-item-quantity').classList.remove('d-none');
        document.getElementById('cart-modal-item-price').classList.remove('d-none');
        document.getElementById('cart-modal-item-total-price').classList.remove('d-none');

        document.getElementById('exampleModalLabel').innerHTML = "Add To Cart Successful!";
        document.getElementById('cart-bg-color-alert').classList.remove('text-bg-danger');

        var item_name = document.getElementById('add-to-cart-item-name').innerHTML = document.getElementById('item-name-' + val).innerHTML;
        var item_quantity = document.getElementById('add-to-cart-item-quantity').innerHTML = quantity;
        var item_price = document.getElementById('add-to-cart-item-price').innerHTML = document.getElementById('item-price-' + val).innerHTML;
        var item_total_price = document.getElementById('add-to-cart-item-total-price').innerHTML = document.getElementById('item-price-' + val).innerHTML * parseInt(quantity);
        
        var _token = document.querySelector('input[name=_token]').value;
  
  
        var jqxhr = $.ajax({
          url: "/cart",
          method: "POST",
          data: {
            "item_id": val,
            "item_quantity": item_quantity,
            "_token": _token
          }
        })
          .done(function( data ) {
            document.getElementById('body-visibility').classList.add('d-none');
            getTotalCart();
            document.getElementById('body-spinner').classList.add('d-none');
            document.getElementById('body-visibility').classList.remove('d-none');
          })
          .fail(function() {
            // alert( "error" );
          })
          .always(function() {
            // alert( "complete" );
          });
      }


    }

    $( document ).ready(function() {
        document.getElementById('body-visibility').classList.add('d-none');
        getTotalCart();
        document.getElementById('body-spinner').classList.add('d-none');
        document.getElementById('body-visibility').classList.remove('d-none');
    });

    function getTotalCart(remove_notification_message){
      $.ajax({
        url: "/cart",
        method: "GET",
        data: {
          "from": "cart"
        }
      }).done(function( data ) {
        // alert( "success " + data[1].stock_name);
        var totalCart =  Object.keys(data).length;
        document.getElementById('total_cart').innerHTML = totalCart;

        var text = "This is your item(s) in the cart!<br><br><div id='remove-cart-notification'></div>"; 
        for(var i = 0; i < totalCart; i++)
        {
          var stockImage = data[i].stock_image ? "/storage/" + data[i].stock_image : "https://dummyimage.com/450x300/dee2e6/6c757d.jpg";
          text += 
          "<div class='modal-header text-bg-secondary mb-3 rounded-3'>" + "<div class='me-3'><img class='img-fluid rounded' style='width: 150px; max-height: 150px;' src='" + stockImage + "' alt=''></div>" + "<div class='modal-title'>Item Name: <strong>" + data[i].stock_name + "</strong>" +
          "<br>" +
          'Quantity: <strong id="total-added-to-cart-quantity-' + data[i].stock_id + '">' + data[i].stock_quantity + "</strong>" +
          "<br>" +
          "Price: <strong>RM " + data[i].stock_price + "</strong>" +
          "<br>" +
          "<hr>Total Price: <strong>RM " + data[i].stock_price * data[i].stock_quantity + "</strong><hr></div>" + 
          "<form method='POST' action='/cart/" + data[i].stock_id + "'>" + 
          "<input type='hidden' name='_token' value='" + $('meta[name="csrf-token"]').attr('content') + "'>" +
          "<input type='hidden' name='_method' value='DELETE'>" +
          "<button type='button' class='btn-close' aria-label='Close' onclick='removeCart(" + data[i].stock_id + ")'></button>" +
          "</form>" +
          "</div>"
        }

        document.getElementById('items-cart').innerHTML = text;

        if(remove_notification_message)
        {
          var success_notification = 
          '<div class="alert alert-success alert-dismissible fade show" role="alert">' + 
            'Your item have been successfully removed.' +
            '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>' +
          '</div>';
  
          document.getElementById('remove-cart-notification').innerHTML = success_notification;
        }

      }).fail(function() {
        // alert( "error" );
      });
    }

    
    function removeCart(val){

      var val = parseInt(val);
      var _token = document.querySelector('input[name=_token]').value;
      var _method = document.querySelector('input[name=_method]').value;
      // console.log(val);

      $.ajax({
        url: "/cart/" + val,
        method: "POST",
        data: {
          "item_id": val,
          "_token": _token,
          "_method": _method
        }
      })
        .done(function( data ) {
          if(data == true)
          {
            document.getElementById('body-visibility').classList.add('d-none');
            getTotalCart(true);
            document.getElementById('body-spinner').classList.add('d-none');
            document.getElementById('body-visibility').classList.remove('d-none');
          }
        })
        .fail(function() {
          // alert( "error" );
        })
        .always(function() {
          // alert( "complete" );
        });

    }