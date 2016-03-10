// JavaScript by TeckStack.com
if (!(/Android|webOS|iPhone|iPod|BlackBerry|BB|PlayBook|IEMobile|Windows Phone|Silk|Opera Mini/i.test(navigator.userAgent))) {
    // Take the user to a different screen here.
    window.location.href="index.html";
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
