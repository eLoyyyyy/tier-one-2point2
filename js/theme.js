window.goBack = function (e){
    var defaultLocation = "http://www.jennifer.com/wordpress/";
    var oldHash = window.location.hash;

    history.back(); // Try to go back

    var newHash = window.location.hash;

    /* If the previous page hasn't been loaded in a given time (in this case
    * 1000ms) the user is redirected to the default location given above.
    * This enables you to redirect the user to another page.
    *
    * However, you should check whether there was a referrer to the current
    * site. This is a good indicator for a previous entry in the history
    * session.
    *
    * Also you should check whether the old location differs only in the hash,
    * e.g. /index.html#top --> /index.html# shouldn't redirect to the default
    * location.
    */

    if(
        newHash === oldHash &&
        (typeof(document.referrer) !== "string" || document.referrer  === "")
    ){
        window.setTimeout(function(){
            // redirect to default location
            window.location.href = defaultLocation;
        },1000); // set timeout in ms
    }
    if(e){
        if(e.preventDefault)
            e.preventDefault();
        if(e.preventPropagation)
            e.preventPropagation();
    }
    return false; // stop event propagation and browser default event
}

jQuery.fn.exists = function () {
    return this.length !== 0;
}

jQuery(document).ready(function($){
    //Preloader
    jQuery(window).load(function() {
        preloaderFadeOutTime = 500;
        function hidePreloader() {
            var preloader = jQuery('.preloader');
            preloader.fadeOut(preloaderFadeOutTime);
        }
        hidePreloader();
    });
    
    $('ul.tabs').tabs();
    
    $(".button-collapse").sideNav();
    
    
    
     jQuery(window).on('load resize', function() {
        console.log('resize');
        var viewportWidth = $(window).width();
        var viewportHeight = $(window).height();
        var breadcrumb = $('.breadcrumb-list .col > span:last-child .breadcrumb');
         
        if ( viewportWidth < 601 ) {
            $('.blogpost').removeClass('horizontal');
            breadcrumb.addClass('truncate');
            
            
        } else {
            $('.blogpost').addClass('horizontal');
            breadcrumb.removeClass('truncate');
        }
    });
    
    $('.blog-list-archive li ul').hide();
    $('.blog-list-archive li a').click(function(){
        $(this).parent().addClass('selected');
        $(this).parent().children('ul').slideDown(250);
        $(this).parent().siblings().children('ul').slideUp(250);
        $(this).parent().siblings().removeClass('selected');
    });
    
    
    jQuery('.social-share').click(function(e){
        var social = $(this).data('share');
        var url = encodeURIComponent(window.location.href);
        var width = 545;
        var height = 433;
        var leftPosition, topPosition;
        //Allow for borders.
        leftPosition = (window.screen.width / 2) - ((width / 2) + 10);
        //Allow for title and status bars.
        topPosition = (window.screen.height / 2) - ((height / 2) + 50);
        var settings = "height=" + height + ",width=" + width + ",resizable=yes,left=" + leftPosition + ",top=" + topPosition + ",screenX=" + leftPosition + ",screenY=" + topPosition + ",toolbar=no,menubar=no,scrollbars=no,directories=no";
        
        switch ( social ) {
            case 'facebook' :
                console.log('facebook');
                window.open('http://www.facebook.com/sharer.php?u=' + url,'mypopuptitle', settings);
                break;
            case 'twitter' :
                window.open('https://twitter.com/share?url=' + url /*+ '&via=twitterdev&hashtags=bryaaaaaan&text=custom%20share%20text'*/,'mypopuptitle', settings)
                break;
            case 'linkedin' :
                window.open('http://www.linkedin.com/shareArticle?url=' + url,'mypopuptitle', settings)
                break;
            case 'reddit' :
                window.open('http://reddit.com/submit?url=' + url,'mypopuptitle', settings)
                break;
            case 'google-plus' :
                window.open('https://plus.google.com/share?url=' + url,'mypopuptitle', settings)
                break;
            case 'pinterest' :
                window.open('http://pinterest.com/pin/create/link/?url='+url+'&media='+$(this).data('image')+'&description='+$(this).data('title'),'mypopuptitle', settings)
                break;
        }
        
        e.preventDefault()
    });
    
});