$(document).ready(function(){ 
    $("#exportA").on( "click", function() {
        var date = $('#i_date').val();
        var idmachine = $('#idmachine').val();
        var idgroup = 2;
        var var_name = $('#var_name').val();
        var caso =  $('#i_caso').val();
        window.location="/events/"+caso+"/"+date+"/"+idmachine+"/"+idgroup+"/"+var_name+"/export";
       
     });
     $("#exportT").on( "click", function() {
        var date = $('#i_dia').val();
        var idvar = $('#idvariable').val();
        var var_name = $('#var_name').val();
        var caso =  'd';
        window.location="/trends/"+caso+"/"+date+"/"+idvar+"/"+var_name+"/export";
       
     });
    
});