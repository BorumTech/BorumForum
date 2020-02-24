$(document).ready(function() {
  $("div.product").css("display", "none");
  $("div.product").each(function(index) {
      $(this).delay(index * 1000).fadeIn(800);
  });
});
