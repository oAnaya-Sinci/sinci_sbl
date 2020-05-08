$(document).ready(function(){ 
    $("#b_dia").on( "click", function() {
        $('#i_dia').show(); 
        $('#i_mes').hide();
        $('#b_sdia').show(); 
        $('#b_smes').hide();
        
     });
    $("#b_mes").on( "click", function() {
        $('#i_mes').show(); 
        $('#i_dia').hide();
        $('#b_smes').show(); 
        $('#b_sdia ').hide();
    });
    
});
