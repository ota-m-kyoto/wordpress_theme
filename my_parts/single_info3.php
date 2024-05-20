<!--start hotelDetail_section-->
<section id="hotelDetail" class="">
  <div class="secInner">
    <div class="secTitleA">
      <h3 class="titleText"><?php echo $title; ?>の宿泊施設詳細</h3>
    </div>
<?php

//ホテル情報
$num_hotelcsv = 0;
foreach ($hotel_csv as $value_a) {
 if(($value_a[0]) == '〇' || ($value_a[0]) == '○' || ($value_a[0]) == '●'){
  $num_hotelcsv++;
 }
}
  for($hhh = 1; $hhh < 50 ;$hhh++){
    // echo $ccc.'<br>';
     if(!empty($hotel_csv[$hhh][0])){
      $html = "";
      if( ($hotel_csv[$hhh][0]) == '〇' || ($hotel_csv[$hhh][0]) == '○' || ($hotel_csv[$hhh][0]) == '●'){
        for($pic = 1; $pic < 50 ;$pic++){
          $img_path = get_stylesheet_directory() . '/school/' . $slug_name . '/img/hotel' . sprintf('%02d', $hhh) . '_' . sprintf('%02d', $pic) . '.jpg';
          if (file_exists($img_path)){
            $img_path_uri = get_stylesheet_directory_uri() . '/school/' . $slug_name . '/img/hotel' . sprintf('%02d', $hhh) . '_' . sprintf('%02d', $pic) . '.jpg';







            $hotel_imgs .= <<< EOD
              <div class="swiper-slide">
                <div class="imageBox">
                  <div class="image">
                    <div class="image_inner skn_radius">
                      <img src="{$img_path_uri}" alt="{$title}の宿泊施設詳細">
                    </div>
                  </div>
                </div>
              </div><!--end swiper-slide -->
EOD;
          }
        }



        $html .= <<< EOD
        <!--start hotelDetail_row-->
        <div class="hotelDetail_block">
          <div class="hotelDetail_row1 hotelDetail_row box_row">
            <div class="contTitleA">
              <h4 class="titleText bold">{$hotel_csv[$hhh][2]}</h4>
            </div>
          </div><!--end hotelDetail_row-->
          <div class="hotelDetail_row2 hotelDetail_row box_row">
            <div class="hotel{$hhh} hotel_swiper swiper-container">
              <div class="swiper-wrapper">
                {$hotel_imgs}
              </div><!--end swiper-wrapper -->
              <div class="swiper-pagination"></div>
            </div><!--end hotel{$hhh}-->
            <script data-src-swiper>
            if(2 <= document.querySelector(".hotel{$hhh} .swiper-wrapper").children.length){
              var hotel{$hhh} = new Swiper ('.hotel{$hhh}', {
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
                  clickable:true,//ページネーションクリックできるか
              });
            }
            </script>
          </div>
EOD;

          $html .= '
          <div class="hotelDetail_row3 hotelDetail_row box_row">
            <ul class="detailText_list flex fWrap_wrap">
          ';
            foreach($hotel_csv[0] as $hotel_csv0){ //先頭から１つずつ$fruitに代入する
          if ($i>=1){


            $html.='
              <li class="detailText_wrap flex">
                <p class="label">' . $hotel_csv0.'</p><p class="hotelDetail">' . $hotel_csv[$hhh][$i]. '</p>

            </li>';
            }
            $i++;

            }
            $i=0;

            $add_text = '';
            if($num_hotelcsv == $hhh){
             $add_text = '<div class="add_text"><span>※各宿泊施設の詳細につきましては、'.do_shortcode('[homeurl]').'に<a href="'.home_url().'/contact?sec='.$title.'">お問い合わせ</a>ください。</span></div>';
            }

          $html .= '
            </ul>
            '.$add_text.'
          </div><!--end hotelDetail_row-->
        </div>';
    echo $html;
    }
    $hotel_imgs="";
    }
  }
?>
  </div><!--end secInner-->
</section><!--end hotelDetail_section-->

<?php echo do_shortcode('[takusan_block '.$title.']'); ?>
