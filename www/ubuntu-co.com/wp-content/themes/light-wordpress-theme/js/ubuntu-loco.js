/**
 * Contains all the javascript calls
 */

/* Load slider */
// Alternative way to set the speed
var ubuntu_loco_slider_speed = jQuery('.slider').attr('speed');
if( !ubuntu_loco_slider_speed )
    ubuntu_loco_slider_speed = 10000;
jQuery(window).load(function() {
    jQuery('.slider').nivoSlider({
        effect:'random', //Specify sets like: 'fold,fade,sliceDown'
        animSpeed:500,
        pauseTime:ubuntu_loco_slider_speed,
        startSlide:0, //Set starting Slide (0 index)
        directionNav:true, //Next & Prev
        directionNavHide:false,
        controlNav:false, //1,2,3...
        controlNavThumbs:false, //Use thumbnails for Control Nav
        keyboardNav:true, //Use left & right arrows
        pauseOnHover:true, //Stop animation while hovering
        manualAdvance:false, //Force manual transitions
        captionOpacity:0.8 //Universal caption opacity
    });
});

/* Make borders rounded */
jQuery('.awesome').corner('round 5px keep;');
jQuery('.more-link').corner('round 5px keep;');
jQuery('#secondary-access').corner('round bl br 8px keep;');
jQuery('#primary').corner('round 5px keep;');
jQuery('#secondary').corner('round 5px keep;');
jQuery('#page-bottom').corner('round 5px keep;');
jQuery('#content .entry-meta').corner('round bl br 5px keep;');
jQuery('#respond').corner('round 5px keep;');
jQuery('#respond #form-allowed-tags').corner('round 5px keep;');
jQuery('#comments-list').corner('round 5px keep;');
jQuery('#trackbacks-list').corner('round 5px keep;');
jQuery('#comments-list ol li').corner('round 5px keep;');
jQuery('#trackbacks-list ol li').corner('round 5px keep;');
jQuery('#comments-list .comment-author img').corner('round 5px keep;');
jQuery('#content .post').corner('round 5px keep;');
jQuery('#content .page').corner('round 5px keep;');
jQuery('#content .entry-content .page-link').corner('round tr tl 5px keep;');
jQuery('.loco-columns').corner('round br bl 5px keep;');
jQuery('#content .entry-utility div ul li').corner('round tl bl 5px keep;');
jQuery('#content .entry-utility div.cat-links li').corner('round 5px keep;');

/* Add some awesome buttons */
jQuery('#content .navigation .nav-previous a').addClass('awesome');
jQuery('#content .navigation .nav-next a').addClass('awesome');
jQuery('#content .more-link').addClass('awesome');
jQuery('#comments-list a.comment-reply-link').addClass('awesome');
