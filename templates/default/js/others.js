$(document).ready(function() {
    $('.special li:gt(6)').css("margin-top", "-5px");
    $('.special ul').css("left", "0");
    $('.has-sub-ul').hover(
        function(event) {
        if ($(event.target).parent().hasClass("has-sub-ul")) {
        $(event.target).next().addClass("ulhover");
        $(event.target).css("background", "url(static/image/list-hover.png)");
        event.stopPropagation();
        }
    },
    function(event) {
        $('.has-sub-ul > ul').removeClass("ulhover");
        $('.has-sub-ul > a').css("background", "");
        event.stopPropagation();
    })
})
