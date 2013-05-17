// salytics  ....
var saTrk;
var masterOnSwitch = true;
var trkPgVisits = true;

jQuery(document).ready( function() {
 if (masterOnSwitch) {
  jQuery.getScript("http://lifeboat.na4.force.com/salytics/apex/salytics__saJS", function() {
    saTrk = new jQuery.sa();
    if (trkPgVisits) {
	    saTrk.eventTrack({type: "01260000000UJC4AAO"});
	}

    if (jQuery("#email").length > 0){
      jQuery("#email").change( function() {
        saTrk.linkEmail({ email: this.value });
      });
    }
            
    if (jQuery(".content-share").length > 0){
      jQuery(".content-share").click( function() {
        saTrk.eventTrack({type: "01260000000UJE4AAO"});
      });
    }

    if (jQuery(".channel-subscribe").length > 0){
      jQuery(".channel-subscribe").click( function() {
        saTrk.eventTrack({type: "01260000000UJE9AAO"});
      });
    }

    if (jQuery(".website-comment").length > 0){
      jQuery(".website-comment").click( function() {
        saTrk.eventTrack({type: "01260000000UJEEAA4"});
      });
    }
  });   
 }
});

