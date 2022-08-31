jQuery(document).ready(function(){
    // Start links
    $('.stop-link').click(function(e) {
      e.preventDefault();
    });

    // show and hide submenu
    $('body').on('mouseenter mouseleave click','.nav-item',function(e){
      if ($(window).width() < 750) {
          $( this ).siblings().removeClass('show');
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
      console.log('aaaaaa',$(this).data('tab'));
      $( '.' + $(this).data('tab')).fadeIn()
    })
    //End text accodrion text + Start tabs system


    // Start goals in about us page
    $('.goal-title').click(function() {
        $('.goal-text').not($(this).siblings('.goal-text')).slideUp();
        $(this).siblings('.goal-text').slideToggle();
        // Arrow rotate
        $('.arrow-icon').not($(this).find('.arrow-icon')).removeClass('rotate-90');
        $(this).find('.arrow-icon').toggleClass('rotate-90')
    });
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
        $('.nav-item').removeClass('show');
      }
      else {
        burger.addClass(activeClass)
              .attr("title", openText);

        srText.text(openText);
      }
    });
  }($));


  $('#search').on('keyup', function(){
    var val = $('#search').val().toLowerCase();
    console.log('val',val)
    if(val.length>2){
    console.log('val',val)
        $('.search-bar').siblings().css('display','flex');
    console.log('val1',val)
    $.get({
        url: '{{url('/')}}/search/'+val,
        data: {
            val: val,
        },
        dataType: 'json',
        beforeSend: function () {
            // console.log('ameed',$('.search-result-box').html(''));
            $('.search-result-box').html('');
            $('.svgSearch').css('display','none');

        },

        success: function (response) {
            console.log("🚀 ~ file: app.blade.php ~ line 581 ~ $ ~ response", response)
            var elements = [];
            response.map(item=>{
                var trimmedString ={
                    trumedTitle:item.title.substring(0, 100),
                    title:item.title,
                    id:item.id
                };
                    elements.push(trimmedString)
                })
                let searchData = $();
            for(i = 0; i < elements.length; i++) {
                $('.search-result-box').html('');
                searchData = searchData.add('<a class="searchList"  target="_self" href="/categor/' + elements[i].title + '/' + elements[i].id + '">'+elements[i].trumedTitle+'</br> </a>');
        }
                $('.search-result-box').append(searchData)
        },
        complete: function () {
            console.log('searchCompleted')
        },
        error: function (err) {
            console.log('searchError',err)
        }
    });
}
});

