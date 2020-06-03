$(document).ready(function(){ 
    $("#b_dia").on( "click", function() {
        $('#i_dia').show(); 
        $('#i_mes').hide();
        $('#i_year').hide();
        $('#i_mes').val('');
        $('#i_year').val('');
        
     });
    $("#b_mes").on( "click", function() {
        $('#i_mes').show(); 
        $('#i_dia').hide();
        $('#i_year').hide();
        $('#i_dia').val('');
        $('#i_year').val('');

    });
    $("#b_año").on( "click", function() {
        $('#i_year').show(); 
        $('#i_mes').hide();
        $('#i_dia').hide();
        $('#i_dia').val('');
        $('#i_mes').val('');
    });

    
});
