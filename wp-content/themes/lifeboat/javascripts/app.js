/* Custom Functions Added by Jordan Lewin for Lifeboat */
// as the page loads, call these scripts
$(document).ready(function() {
  
  // Fix figure and figcaption height so body content snugs up against photo
  $("#content figure figcaption").each(function() {
    var figHeight = $(this).height();
    var figMargin = figHeight+17;
    $(this).parent('figure').css("margin-bottom",-figMargin);
  });

});