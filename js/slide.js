 $( function() {
    $( "#tabs" ).tabs();
  });

 $(".columns").click(function(){
        $(this).removeAttr('active');
        var $parent = $(this).parent();        
        if (!$parent.hasClass('active')) {
        	
        	$parent.addClass('active');           
        }
        else{
        	$parent.removeClass('active');           	
        }
    });