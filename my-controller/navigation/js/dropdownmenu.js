$(function(){
 $("ul.dropdown li:has(ul)").find("a:first").append(" &raquo; ");
    $("ul.dropdown li").hover(function(){
    
        $(this).addClass("hover");
        $('ul:first',this).css('visibility', 'visible');
	
    
    }, function(){
    
        $(this).removeClass("hover");
        $('ul:first',this).css('visibility', 'hidden');
   
    });
    
   

});