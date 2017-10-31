// CSRF protection
$.ajaxSetup(
{
    headers:
    {
        'X-CSRF-Token': $('input[name="_token"]').val()
    }
});

//========================== Guest Functions ======================================

    function myPlusFunction(p1,p2,p3) {
         $.ajax({
               type:'POST',
               beforeSend: function(){
                    $('.ajax-loader').css("visibility", "visible");
               },
               url:'/quantityPlus',
                data: {
                    'productId':p1,
                    'quantity':p2,
                    'productPrice':p3},
               success:function(data){
                   $('#'+p1+'value').text(data.newProductQuantity);
                   $('#'+p1+'amount').text("₹ "+data.productAmount);
                   $('#totalUnits').text(data.newNoOfUnits);
                   $('#totalAmount').text("₹ "+data.newTotalAmount);
               },
               complete: function(){
                    $('.ajax-loader').css("visibility", "hidden");
               }
            });
        
    }
    
    function myMinusFunction(p1,p2,p3) {
        $.ajax({
               type:'POST',
               beforeSend: function(){
                    $('.ajax-loader').css("visibility", "visible");
               },
               url:'/quantityMinus',
                data: {
                    'productId':p1,
                    'quantity':p2,
                    'productPrice':p3},
               success:function(data){
                   $('#'+p1+'value').text(data.newProductQuantity);
                   $('#'+p1+'amount').text("₹ "+data.productAmount);
                   $('#totalUnits').text(data.newNoOfUnits);
                   $('#totalAmount').text("₹ "+data.newTotalAmount);
               },
               complete: function(){
                    $('.ajax-loader').css("visibility", "hidden");
               }
            });
        
    }
        
    function myDeleteFunction(p1) {
        $.ajax({
               type:'POST',
               beforeSend: function(){
                    $('.ajax-loader').css("visibility", "visible");
               },
               url:'/productDelete',
                data: {'productId':p1},
               success:function(data){
                   if(data.success == 1) {
                        $('#totalUnits').text(data.newNoOfUnits);
                        $('#totalAmount').text("₹ "+data.newTotalAmount);
                        $('#'+p1+'row').fadeOut('slow', function(c){
							$('#'+p1+'row').remove();
						});
                   }
                   if(data.delete == 1) {
                       $('#checkLogin').css('display','none');
                       $('.table').fadeOut('slow', function(c){
							$('.table').remove();
						});
                       $('#empty-error').css('display','block');
                   }
               },
               complete: function(){
                    $('.ajax-loader').css("visibility", "hidden");
               }
            });
    }

// ======================== User Functions =======================================

    function userPlusFunction(p1,p2,p3) {
         $.ajax({
               type:'POST',
               beforeSend: function(){
                    $('.ajax-loader').css("visibility", "visible");
               },
               url:'userQuantityPlus',
                data: {
                    'productId':p1,
                    'quantity':p2,
                    'productPrice':p3},
               success:function(data){
                   $('#'+p1+'value').text(data.newProductQuantity);
                   $('#'+p1+'amount').text("₹ "+data.productAmount);
                   $('#totalUnits').text(data.newNoOfUnits);
                   $('#totalAmount').text("₹ "+data.newTotalAmount);
               },
               complete: function(){
                    $('.ajax-loader').css("visibility", "hidden");
               }
            });
        
    }

    function userMinusFunction(p1,p2,p3) {
        $.ajax({
               type:'POST',
               beforeSend: function(){
                    $('.ajax-loader').css("visibility", "visible");
               },
               url:'userQuantityMinus',
                data: {
                    'productId':p1,
                    'quantity':p2,
                    'productPrice':p3},
               success:function(data){
                   $('#'+p1+'value').text(data.newProductQuantity);
                   $('#'+p1+'amount').text("₹ "+data.productAmount);
                   $('#totalUnits').text(data.newNoOfUnits);
                   $('#totalAmount').text("₹ "+data.newTotalAmount);
               },
               complete: function(){
                    $('.ajax-loader').css("visibility", "hidden");
               }
            });
        
    }

    function userDeleteFunction(p1) {
        $.ajax({
               type:'POST',
               beforeSend: function(){
                    $('.ajax-loader').css("visibility", "visible");
               },
               url:'userProductDelete',
                data: {'productId':p1},
               success:function(data){
                   if(data.success == 1) {
                        $('#totalUnits').text(data.newNoOfUnits);
                        $('#totalAmount').text("₹ "+data.newTotalAmount);
                        $('#'+p1+'row').fadeOut('slow', function(c){
							$('#'+p1+'row').remove();
						});
                   }
                   if(data.delete == 1) {
                       $('#authStatus').css('display','none');
                       $('#addressBox').css('display','none');
                       $('#submitBox').css('display','none');
                       $('.table').fadeOut('slow', function(c){
							$('.table').remove();
						});
                       $('#empty-error').css('display','block');
                   }
               },
               complete: function(){
                    $('.ajax-loader').css("visibility", "hidden");
               }
            });
    }