$(document).ready(function() {
    var eleme = 108;
    var lastId =$
    var urlinfo = window.location.search.slice(1);
    $(window).scroll(function() {
        var scrollPos = $(window).scrollTop();
        var windowHeight = $(window).height();
        var bodyHeight = $("body").height();
        var bottomHeight = $("#support").height() + 120;
        if((scrollPos + windowHeight) >= (bodyHeight - bottomHeight)) {
            $.ajax({
                type: "get",
                dataType: "json",
                url: "/article/xiala",
                data: urlinfo + "&&" + "id=" +ID[ID.length - 1],
                success: function(data) {
                    var ul = document.getElementById("list");
                    var fragment = document.createDocumentFragment();
                    var li = ul.children[0];
                    var length = data.length;
                    for ( var i = 0; i < length; i++ ) {
                        var newLi = li.cloneNode(true);
                        var a = newLi.children[0].children[0];
                        var spanList = newLi.children[1];
                        var time = data[i]['time'].slice( 0, 10 );
                        a.innerHTML = data[i]['title'];
                        a.href = data[i]['url'];
                        spanList.children[0].innerHTML.replace( /(\d-?)+/, time );
                        spanList.children[1].innerHTML.replace( /\d+/, data[i]['hit'] );
                        fragment.appendChild(newLi);
                        ID[ID.length] = data[i]['id'];
                    }
                    ul.appendChild(fragment);
                }
            });
        };
    });
});
