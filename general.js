// JavaScript by TeckStack.com
if (/Android|webOS|iPhone|iPod|BlackBerry|BB|PlayBook|IEMobile|Windows Phone|Silk|Opera Mini/i.test(navigator.userAgent)) {
    // Take the user to a different screen here.
    window.location.href="wap.html";
}

$(document).ready(function() {
    $(".button").click(function(e) {
        $("body").append('<div class="overlay"></div>');
		$(".popup").show();
		
		$(".close").click(function(e) {
			$(".popup, .overlay").hide();
		});
    });
});

var winWidth = $(window).width();
$(window).resize(function() {
  winWidth = $(window).width();
  $("#status").text(winWidth);
    if(winWidth <= 960)
    {
        $(".ar").css("float","center");
        $(".popup").css("right","auto");
        $(".popup").css("left","221px");

    }
    
    else
    {
        $(".ar").css("float","right");
        $(".popup").css("right","0");
        $(".popup").css("left","auto");
    }

});

