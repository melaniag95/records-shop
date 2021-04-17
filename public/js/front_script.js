$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
})

$(document).on('click', '.btnItemUpdate', function(){
    if($(this).hasClass('btn_minus')){
        var quantity = $(this).prev().val();
        //alert(quantity); 
        if(quantity<=1){
            alert("Quantity must be 1 or greater")
        } else{
            new_quantity = parseInt(quantity)-1;
        }
    }

    if($(this).hasClass('btn_add')){
        var quantity = $(this).prev().prev().val();
        //alert(quantity);
        new_quantity = parseInt(quantity)+1;
    }

    //alert(new_quantity);
    var cartid = $(this).data('cartid');
    //alert(cartid);
    $.ajax({
        data:{"cartid":cartid, "quantity":new_quantity},
        url: '/update-cart-item-quantity',
        type:'post',
        success: function(response){
            //alert(response);
            $('#AppendCartItems').html(response.view);
        },
        errror: function(){
            alert("Error");
        }
    })
})

//Delete cart item
$(document).on('click', '.btnItemDelete', function(){
    var cartid = $(this).data('cartid');
    //alert(cartid);
    var result = confirm('Do you want to delete this item from your shopping cart?');
    if(result){
        $.ajax({
            data:{"cartid":cartid},
            url: '/delete-cart-item-quantity',
            type:'post',
            success: function(response){
                //alert(response);
                $('#AppendCartItems').html(response.view);
            },
            errror: function(){
                alert("Error");
            }
        })
    }
    
})