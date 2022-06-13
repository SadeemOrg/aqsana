jQuery(document).ready(function(){
    // Start links
    $('.stop-link').click(function(e) {
      e.preventDefault();
    });
    
    // show and hide submenu
    $('body').on('mouseenter mouseleave click','.nav-item',function(e){
      if ($(window).width() < 750) {
        $( this ).addClass('show');
      }
    });
    $( ".nav-item" ).hover(
      function() {
        $( this ).addClass('show');
      }, function() {
        $( this ).removeClass('show');
      }
    );

    
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