(function() {
    eventHandler = {
        addEvent: function ( element, type, handler ) {
                    if ( element.addEventListener ) {
                        element.addEventListener( type, handler, false );
                    } else if ( element.attachEvent ) {
                        element.attachEvent( "on" + type, handler );
                    } else {
                        element[ "on" + type ] = handler;
                    }
                },
        preventDefault: function ( event ) {
                    if ( event.preventDefault ) {
                        event.preventDefault();
                    } else {
                        event.returnValue = false;
                    }
                },
        getEvent: function ( event ) {
              return event ? event : window.event;
          },
        getTarget: function( event ) {
               return event.target || event.srcElement;
           }
    };
    var form = document.forms || document.getElementsByTagName("form");
    eventHandler.addEvent( form[1], "click", function( event ) {
        var input = form[1].children[2];
        var caption = document.getElementById("message-caption");
        var email = document.getElementById("message-email");
        event = eventHandler.getEvent( event );
        var target = eventHandler.getTarget( event );
        eventHandler.preventDefault( event );
        if ( target.getAttribute("type").toLowerCase() === "submit" ) {
            alert("该功能正在建设当中");
            return false;
        };
        if ( target.id.toLowerCase() === "service-button-1" 
            && input.value !== "" && caption.value !=="" && email.value !== "") {
            var response = $.ajax({
                type: "POST",
                url: "/message/",
                data: "caption=" + caption.value + 
                "&&" + "email=" + email.value + 
                "&&" + "content=" + input.value
            }).status;
            caption.value = email.value = input.value = "";
        }
    });
    eventHandler.addEvent( form[2], "click", function( event ) {
        event = eventHandler.getEvent( event );
        var target = eventHandler.getTarget( event );
        eventHandler.preventDefault( event );
        if ( target.tagName.toLowerCase() === "input" ) {
            $.ajax({
                type: "POST",
                url: "/vote/",
                data: "voteid=" + target.getAttribute("choiceid"),
                success: function(data) {
                    data['status'] === "ip" ?
                alert("您已经投过票了"):
                (function() {
                    var plusone = document.createElement("span");
                    plusone.innerHTML = "+1";
                    plusone.className = "plusone";
                    target.parentNode.appendChild(plusone);
                    $( plusone ).animate( { top: 0, opacity: 1 }, 'fast', function() {
                        $( plusone ).animate( {top: -20, opacity: 0 }, function() {
                            target.parentNode.removeChild( plusone );
                        })
                    })
                    target.parentNode.children[1].innerHTML = parseInt(target.parentNode.children[1].innerHTML, 10) + 1;
                })();
                }
            });
        }
    });
})();
