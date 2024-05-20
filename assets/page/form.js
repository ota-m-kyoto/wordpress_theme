jQuery(function($){
	$(".nop .last input ,.nop .first input").on("change",function(){
		$(".hitoriFlag").toggleClass("hide");
	});
});