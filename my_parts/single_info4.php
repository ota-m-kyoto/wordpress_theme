<!--start spot_section-->
<section id="spot" class="marginBottom3">
  <div class="secInner">
    <div class="secTitleA">
      <h3 class="titleText"><?php echo $title; ?>の周辺スポット</h3>
    </div>
<?php 
for($i = 1; $i < count($spot_csv); $i++){
  $spot_imgs = "";
  $img_path = get_stylesheet_directory().'/school/'.$slug_name.'/img';
  $img_path = file_search($img_path);
  for($ii = 0; $ii < count($img_path); $ii++){
    if(strpos($img_path[$ii],'img/'.$spot_csv[$i][1]) !== false){
      $wppoint = strpos($img_path[$ii], '/wp-content');
      $wppoint = substr($img_path[$ii], $wppoint);
      $spot_imgs .= <<< EOD
      <div class="swiper-slide">
        <div class="imageBox">
          <div class="image">
            <div class="image_inner skn_radius">
              <img src="{$wppoint}" alt="">
            </div><!--end image_inner-->
          </div><!--end image-->
        </div><!--end imageBox-->
      </div><!--end swiper-slide -->
EOD;
    }
  }
  $html = <<< EOD
  <!--start spot_row-->
  <div class="spot_block commonClass_block">
    <div class="spot_row1 spot_row commonClass_row1 commonClass_row box_row">
      <div class="contTitleA flex">
        <h4 class="titleText bold">{$spot_csv[$i][0]}</h4>
      </div>
    </div><!--end spot_row-->
    <div class="spot_row2 spot_row commonClass_row1 commonClass_row box_row">
      <div class="spot{$i} swiper-container swiperButtonPsitionCenter">
        <div class="swiper-wrapper">
          {$spot_imgs}
        </div><!--end swiper-wrapper -->
        <div class="swiper-pagination"></div>
      </div><!--end spot-->
      <script data-src-swiper>
      if(2 <= document.querySelector(".spot{$i} .swiper-wrapper").children.length){
        var hotel{$i} = new Swiper ('.spot{$i}', {
            effect:"fade", //"fade" "flip"//エフェクト指定
            simulateTouch:true,//マウスでスライドできるか
            autoplay:{
                delay: 4000,//自動再生待ち時間
                disableOnInteraction: false,//ユーザーが操作したあと自動再生を止めるか
            },
            speed: 500,//スライド速度
            loop: true,//ループ
            slidesPerView:"auto",//同時表示枚数
            loopedSlides:3,//ループするときに途切れないように余分に出しておくスライド数
            preventClicks: true,//クリック出来なくなる場合はfalse
            preventClicksPropagation: true,//クリック出来なくなる場合はfalse
            allowTouchMove:true,//スライド操作できるか
            spaceBetween:10,
            pagination: {//ページネーション
              el: '.swiper-pagination',
              type: 'bullets', //"fraction" "progress" "custom",//ページネーションスタイル
            },
            // navigation: {//スライドボタン
            //   nextEl: '.swiper-button-next',
            //   prevEl: '.swiper-button-prev',
            // },
            clickable:true,//ページネーションクリックできるか
        });
      }
      </script>
    </div><!--end spot_row-->
    <div class="spot_row3 spot_row commonClass_row1 commonClass_row box_row">
      <div class="text">
        <p>
          {$spot_csv[$i][2]}
        </p>
      </div>
    </div><!--end spot_row-->
  </div><!--end spot_block-->

EOD;
  echo $html;
}
?>
  </div><!--end secInner-->
</section><!--end spot_section-->
<?php echo do_shortcode('[takusan_block '.$title.']'); ?>