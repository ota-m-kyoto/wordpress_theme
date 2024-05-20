console.log("aa");
jQuery(function($){
    //グーグルアナリティクスコンバージョン設置
    $("[href*='/contact']").attr("onClick","ga('send', 'event', 'click', 'contact-click')");
    $("[href*='tel:']").attr("onClick","ga('send', 'event', 'click', 'tel-tap')");

    $(".menuBtn").tap(function(e,me){
        $("body").toggleClass("menuActive");
        $(".menuBtn").toggleClass("active");
        $(".headMenuBox").slideToggle(300);

        //メニュー表示中はその他のコンテンツを非表示
        $(".pageWrap").fadeIn(300);
        $(".menuActive .pageWrap").fadeOut(300);
    });
    //メニューのページ内リンク
    $(".home #main-navSp [href*='#']").tap(function(e,me){
        $(".headMenuBox").hide();
        $("body").removeClass("menuActive");
        $(".headMenuBox").removeAttr("style");
        $(".menuBtn").removeClass("active");
        $(".pageWrap").show(function(){
            $("body,html").animate({scrollTop:$(me[0].hash).offset().top})
        });
    });

    commonResizer();
    $(window).on("resize",commonResizer);
    function commonResizer(){
        moving(".siteH1","h1Desc");
        moving("#headSerchName_select","searchbox_name");
        moving("#headSerchPrefecture_select","searchbox_prefecture");
        var ww = window.innerWidth;
        if(769 <= ww){
            //Pc
            //メニュー開いているときにPCサイズになった場合
            $(".headMenuBox").hide();
            $("body").removeClass("menuActive");
            $(".headMenuBox").removeAttr("style");
            $(".menuBtn").removeClass("active");
            $(".pageWrap").fadeIn(300);


            $(".acc").show();

        }else{
            //Sp
            $(".googleMAP iframe").appendTo(".googleMAP_move");
            $(".acc:not(.open)").hide();
        }
    }

    //要素の移動
    function moving(selector,label){
        if(window.innerWidth <= 768){
            $("[data-moving-pc]").each(function(){
                // var label = $(this).attr("data-moving-pc");
                $(selector).appendTo($("[data-moving-sp='"+label+"']"));
            });
        }else{
            $("[data-moving-sp]").each(function(){
                // var label = $(this).attr("data-moving-sp");
                $(selector).appendTo($("[data-moving-pc='"+label+"']"));
            });
        }
    }


    //アコーディオン
    $(".dormitory_row > .blockTitleA").tap(function(e,me){
      if(window.innerWidth <= 768){
        $(".acc").slideUp();
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

    //申込みの戻るボタン
    $(".backBtn_apply").tap(function(){
        window.history.back(-1);
        return false;
    });


    //教習所リストがない場合
    $(".dormitorytTable_head + span").prev(".dormitorytTable_head").hide();


    //TOPへ戻るボタン
    $(window).on("scroll",scroller);
    $(".TOPmove").smooth(0);
    function scroller(){
        if(1500 <= $(window).scrollTop()){
            $(".TOPmove").addClass("active");
        }else{
            $(".TOPmove").removeClass("active");
        }
    }





    favinit();
    $(".favlistAdd").tap(function(e,me){
        var id = me.attr("data-school-id");
        if(me.hasClass("faving")){
            favlistRemove(id);
            me.removeClass("faving");
        }else{
            favlistSet(id);
            me.addClass("faving");
        }
        favinit();
    });
    function lsfav(setValue){
        if(typeof setValue == "undefined"){
            var fav = localStorage.localfav ? localStorage.localfav : "{}";
            return fav;
        }else{
            localStorage.localfav = typeof setValue == "string" ? setValue : JSON.stringify(setValue);
            return 0;
        }
    }
    function favinit(){
        var fav = lsfav();
        //追加ボタン
        fav = JSON.parse(fav);
        Object.keys(fav).forEach(function(val,i){
            $("[data-school-id='"+fav[val]+"']").addClass("faving");
        });
        $("[data-school-id]").addClass("visible");


        //リンクボタン
        fav = JSON.stringify(fav);
        var favLink = $("#favLinkBtn").attr("href").split("?")[0];
        fav = encodeURIComponent(fav);
        console.log($(".rewriteLink"));
        $(".rewriteLink").attr("href",favLink+"?favdata="+fav);
    }

    function favingBtn(id){
        var fav = lsfav();
        fav = JSON.parse(fav);

        lsfav(fav);
        return 0;
    }
    function favlistSet(schoolNumber){
        var fav = lsfav();
        fav = JSON.parse(fav);
        leng = Object.keys(fav).length+1;
        if(leng <= 6){
            fav["id"+leng] = schoolNumber;
        }else{
            // alert("これ以上登録することはできません。");
        }
        lsfav(fav);
        return 0;
    }

    function favlistRemove(id){
        var fav = lsfav();
        var fav2 = {};
        fav = JSON.parse(fav);
        Object.keys(fav).forEach(function(val,i){
            if(id == fav[val]) delete fav["id"+(i+1)];
        });
        Object.keys(fav).forEach(function(val,i){
            fav2["id"+(i+1)] = fav[val];
        })
        fav = fav2;
        lsfav(fav);
        return 0;
    }


    $("[data-favreset]").tap(function(e,me){
        favclear();
    });
    function favclear(){
        localStorage.removeItem("localfav");
        $("#favLinkBtn").attr("href",$("#favLinkBtn").attr("href").split("?")[0]);
    }
})