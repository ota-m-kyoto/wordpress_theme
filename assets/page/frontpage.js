jQuery(function(){
  $(".nvc_moving_box_SP").children().remove();
  function moving(selector,label){
      if(window.innerWidth <= 768){
        $(".nvc_moving_boxA").find(".nvc_innerBlock_box").addClass("moving_A").appendTo(".nvc_moving_box_SP");
        $(".nvc_moving_boxB").find(".nvc_innerBlock_box").addClass("moving_B").appendTo(".nvc_moving_box_SP");
      }else{
        $(".moving_A").appendTo(".nvc_moving_boxA");
        $(".moving_B").appendTo(".nvc_moving_boxB");
      }
  }
  moving();
  $(window).on("resize",moving);


});