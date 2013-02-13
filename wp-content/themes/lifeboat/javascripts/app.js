/* Custom Functions Added by Jordan Lewin for Lifeboat */
// as the page loads, call these scripts
$(document).ready(function() {
  
  // Make #more-from-blog span on homepage act as link
  $(".home #more-from-blog").click(function() {
    window.location.assign($(this).attr('data-href'));
    return false;
  });
  
  // Fix figure and figcaption height so body content snugs up against photo
  $("#content figure figcaption").each(function() {
    var figHeight = $(this).height();
    var figMargin = figHeight+17;
    $(this).parent('figure').css("margin-bottom",-figMargin);
  });
  
  // Add span tag for styling line on titles in Lifeboat Practices in the Getting Started Guide
  $("#lifeboat-practices .content-inner h2, #lifeboat-practices .content-inner h3, #lifeboat-practices .content-inner h4, #lifeboat-practices .content-inner h5").wrapInner("<span></span>");

});

$(window).load(function() {
  $("#home-slider .slider").orbit({
    animation: 'fade',                  // fade, horizontal-slide, vertical-slide, horizontal-push
    //animationSpeed: 800,                // how fast animtions are
    //timer: true,                        // true or false to have the timer
    //resetTimerOnClick: false,           // true resets the timer instead of pausing slideshow progress
    //advanceSpeed: 4000,                 // if timer is enabled, time between transitions
    //pauseOnHover: true,                // if you hover pauses the slider
    //startClockOnMouseOut: false,        // if clock should start on MouseOut
    //startClockOnMouseOutAfter: 1000,    // how long after MouseOut should the timer start again
    //directionalNav: true,               // manual advancing directional navs
    //captions: true,                     // do you want captions?
    //captionAnimation: 'fade',           // fade, slideOpen, none
    //captionAnimationSpeed: 800,         // if so how quickly should they animate in
    //bullets: false,                     // true or false to activate the bullet navigation
    //bulletThumbs: false,                // thumbnails for the bullets
    //bulletThumbLocation: '',            // location from this file where thumbs will be
    //afterSlideChange: function(){},     // empty function
    fluid: true                         // or set a aspect ratio for content slides (ex: '4x3')
  });
});



// Salytics Code
var saTracker;
jQuery(document).ready( function() {
  jQuery.getScript("http://lifeboat.na4.force.com/salytics/apex/salytics__saJS", function() {
    saTracker = new jQuery.sa();
    saTracker.eventTrack({type: "01260000000UJC4AAO"});

    if (jQuery("#email").length > 0){
      jQuery("#email").change( function() {
        saTracker.linkEmail({ email: this.value });
      });
    }
            
    if (jQuery(".content-share").length > 0){
      jQuery(".content-share").click( function() {
        saTracker.eventTrack({type: "01260000000UJE4AAO"});
      });
    }

    if (jQuery(".channel-subscribe").length > 0){
      jQuery(".channel-subscribe").click( function() {
        saTracker.eventTrack({type: "01260000000UJE9AAO"});
      });
    }

    if (jQuery(".website-comment").length > 0){
      jQuery(".website-comment").click( function() {
        saTracker.eventTrack({type: "01260000000UJEEAA4"});
      });
    }
  });
});