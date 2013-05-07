// Salytics Code ....
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
  
  
	function disqus_config() {
	    this.callbacks.onNewComment = [function() { 
	    	console.log('disqus comment');
//	    	saTracker.eventTrack({type: "01260000000UJEEAA4"}); 
	    }];
	}
  
  
});