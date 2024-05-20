jQuery(function($){
	//tap
	$.fn.tap = function(func,selector){
		var moveflag = 0;
		var count = 0;
		var fOption = {
			touchstart:function(){
				count = 1;
				moveflag = 0;
			},
			touchmove:function(){
				moveflag = 1;
			},
			touchend:function(e){
				if(moveflag == 0){
					func(e,$(this));
				}
			},
			click:function(e){
				if(count == 0){
					func(e,$(this));
				}
				count = 0;
			}
		};
		if(typeof selector === "undefined"){
			$(this).on(fOption);
		}else{
			$(this).on(fOption,selector);
		}
		return this;
	}

	//scroll
	$.fn.smooth = function(selector,speed){
		var sp = typeof selector === "number" ? selector : $(selector).offset().top;
		var speed = typeof speed !== "undefined" ? speed : 1000;
		$(this).tap(function(e){
			e.preventDefault();
			$("body,html").animate({scrollTop:sp},speed);
		});
		return this;
	}
});