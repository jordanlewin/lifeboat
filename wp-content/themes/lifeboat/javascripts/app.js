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