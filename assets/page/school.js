jQuery(function($){
    $(".ttl-access").tap(function(e,me){
      if(window.innerWidth <= 768){
        $(".access-table").slideUp();
        $(".openBtn").removeClass("openBtn");
        if(!me.next().hasClass("open")){
          me.addClass("openBtn");
          me.next().slideDown(function(){
            $(this).addClass("open");
          });
        }
        $(".open").removeClass("open");
      }
    });

    resizer();
    function resizer(){
      if(window.innerWidth <= 768){
        $(".access-table:not(.open)").hide();
      }else{
        $(".access-table").show();
      }
    }
    $(window).on("resize",resizer);


    $(".pageTitleA + div [data-scroll]").each(function(){
      if($("#"+$(this).attr("data-scroll"))[0]){
        $("[data-scroll='"+$(this).attr("data-scroll")+"']").smooth($("#"+$(this).attr("data-scroll")).offset().top);
      }
    })

})
