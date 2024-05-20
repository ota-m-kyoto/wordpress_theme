jQuery(function($){
  $(".swiper-wrapper > .scheduleTableInner,.swiper-wrapper > .none").remove();
  // if(2 <= document.querySelector(".calendarSlideAT .swiper-wrapper").children.length){
    var calendarSlideAT = new Swiper (".calendarSlideAT", {
        // effect:"slide", //"fade" "flip"//エフェクト指定
        simulateTouch:false,//マウスでスライドできるか
        speed: 0,//スライド速度
        loop: false,//ループ
        // slidesPerView:1,//同時表示枚数
        loopedSlides:2,//ループするときに途切れないように余分に出しておくスライド数
        preventClicks: true,//クリック出来なくなる場合はfalse
        preventClicksPropagation: true,//クリック出来なくなる場合はfalse
        allowTouchMove:true,//スライド操作できるか
        autoHeight:true,
        navigation: {//スライドボタン
          nextEl: ".swiper-button-next",
          prevEl: ".swiper-button-prev",
        },
        paginationClickable:false,//ページネーションクリックできるか
        on: {
            slideChangeTransitionEnd: function () {
              if(document.querySelector(".calendarSlideAT .swiper-slide-active") != null){
                if(typeof calendarSlideAT != "undefined"){
                  calendarSlideMT.slideTo(calendarSlideAT.activeIndex,0);
                }
              }
            },
        }
    });
  // }

  // if(2 <= document.querySelector(".calendarSlideMT .swiper-wrapper").children.length){
    var calendarSlideMT = new Swiper (".calendarSlideMT", {
        // effect:"slide", //"fade" "flip"//エフェクト指定
        simulateTouch:false,//マウスでスライドできるか
        speed: 0,//スライド速度
        loop: false,//ループ
        // slidesPerView:1,//同時表示枚数
        loopedSlides:2,//ループするときに途切れないように余分に出しておくスライド数
        preventClicks: true,//クリック出来なくなる場合はfalse
        preventClicksPropagation: true,//クリック出来なくなる場合はfalse
        allowTouchMove:true,//スライド操作できるか
        autoHeight:true,
        navigation: {//スライドボタン
          nextEl: ".swiper-button-next",
          prevEl: ".swiper-button-prev",
        },
        paginationClickable:false,//ページネーションクリックできるか
        on: {
            slideChangeTransitionEnd: function () {
              if(document.querySelector(".calendarSlideMT .swiper-slide-active") != null){
                if(typeof calendarSlideMT != "undefined"){
                  calendarSlideAT.slideTo(calendarSlideMT.activeIndex,0);
                }
              }
            },
        }
    });
  // }

  $(".ATSelected,.MTSelected").css({"display":"none"});
  $(".ATSelected").removeAttr("style");

  $(".calendarMTAT").on("change",function(){
      $(".ATSelected,.MTSelected").css({"display":"none"});
      $("."+$('.calendarMTAT option:selected').val()+"Selected").removeAttr("style");
      calendarSlideMT.update();
      calendarSlideAT.update();
  });

  $(".calendarSwipe").tap(function(e,me){
    me.css("pointer-event","none");
    setTimeout(function(){
      me.css("pointer-event","auto");
    },600);
  });

  resizer();
  $(window).on("resize",resizer);
  function resizer(){
    if(window.innerWidth <= 768){
      $("#scheduleSlide .bgcolor .gradLabel").text("卒業日");
     $("#scheduleSlide .bgcolor a").text("申込み");
    }else{
      $("#scheduleSlide .bgcolor .gradLabel").text("卒業日：");
      $("#scheduleSlide .bgcolor a").text("この日で申込み");
    }
  }
});
