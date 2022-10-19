$(document).ready(function() {
  $("#hamburger").on("click", function() {
    $("#list").toggleClass("height-auto");
    $("nav").toggleClass("height-fixed");
  })
})