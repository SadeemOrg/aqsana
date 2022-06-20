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

    //Start text accodrion text + Start tabs system
    $('.news-title').click(function() {
        $(this).parent('.newsShaddow').toggleClass('open').siblings('.newsShaddow').removeClass('open');
        $('.news-text').not($(this).siblings('.news-text')).slideUp();
        $(this).siblings('.news-text').slideToggle();
        // Arrow rotate
        $('.arrow-icon').not($(this).find('.arrow-icon')).removeClass('rotate-90');
        $(this).find('.arrow-icon').toggleClass('rotate-90')
    });

    $('.tabs-btn .tab-btn').click(function() {
      $(this).addClass('active').siblings().removeClass('active');
      $('.tabs-container .tab').hide()
      $( '.' + $(this).data('tab')).fadeIn()
    })
    //End text accodrion text + Start tabs system


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
