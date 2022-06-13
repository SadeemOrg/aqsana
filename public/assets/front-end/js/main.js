jQuery(document).ready(function(){
	// $('#hamburger').click(function(){
	// 	$(this).toggleClass('open');
	// });
});

// Auto animate for demo

(function($){
  
    // Simple vars
    var activeClass = "is-active", 
        closedText = "Open menu",
        openText = "Close menu";
    
    $(".hamburger").off("click").on("click", function(evt){
      evt.preventDefault();

      $('.nav-links').toggleClass('open');
      
      // Store the hambuger and the screen reader text element
      var burger = $(this),
          srText = burger.find(".sr-only");
      
      // Toggle hamburger and text depending on state
      if(burger.hasClass(activeClass)) {
        
        burger.removeClass(activeClass)
              .attr("title", closedText);
        
        srText.text(closedText);
      }
      else {
        
        burger.addClass(activeClass)
              .attr("title", openText);
        
        srText.text(openText);
      }
    });
    
  }($));