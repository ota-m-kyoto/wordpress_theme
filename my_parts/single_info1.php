<!--start gaiyou_section-->
<section id="gaiyou" class="marginBottom3">
  <div class="secInner">
    <?php
    $tpoint_flg = get_post_meta(get_the_ID(),'school_TPOINT',true);
    if($tpoint_flg == '●'){
     $themeURL = get_template_directory_uri();
     echo <<< EOD
     <div class="tpointTitleBox flex">
       <div class="secTitleA">
         <h3 class="titleText">{$title}の概要</h3>
       </div>
     <div class="imageBox">
       <div class="image">
         <div class="image_inner">
           <a href="{$homeURL}/tpoint">
            <img src="{$themeURL}/assets/images/common/tPointBtn.png" alt="Tポイント対象" srcset="{$themeURL}/assets/images/common/tPointBtn.png 1x , {$themeURL}/assets/images/common/tPointBtn@2x.png 2x">
           </a>
         </div><!--end image_inner-->
       </div><!--end image-->
     </div><!--end imageBox-->
   </div>
EOD;
    } else{ ?>
      <div class="secTitleA">
        <h3 class="titleText"><?php echo $title; ?>の概要</h3>
      </div>
    <?php } ?>
    <!--start gaiyou_row-->
    <div class="gaiyou_block">
      <div class="gaiyou_row1 gaiyou_row box_row">
        <p class="school_lead skn_strong_blue"><?php echo $school_data_csv[0][1]; ?></p>
        <p class="school_comment"><?php echo $school_data_csv[1][1]; ?></p>
      </div><!--end gaiyou_row-->
      <div class="gaiyou_row2 gaiyou_row box_row">
        <!--start gaiyou_wrap-->
        <div class="gaiyou_wrap">
          <div class="gaiyou_inner flex fWrap_wrap">
            <div class="gaiyou_co1 gaiyou_co box_co">
              <div class="imageBox">
                <div class="image">
                  <div class="image_inner">
                    <img src="<?php echo get_stylesheet_directory_uri() ."/school/" . $slug_name ;?>/img/school1.jpg" alt="<?php echo $title ;?>の安心、格安、丁寧な予約は運転免許受付センター"></img>
                  </div><!--end image_inner-->
                </div><!--end image-->
              </div><!--end imageBox-->
            </div><!--end gaiyou_co-->
            <div class="gaiyou_co2 gaiyou_co box_co">
              <div class="streetAddres_wrap gaiyou_row">
                <div class="contTitleA small flex">
                  <p class="titleText">住所</p>
                  <a href="" class="streetAddres_maplink dblArrow_right">地図</a>
                </div>
                <p class="streetAddres">〒<?php echo $school_data_csv[5][1]; ?> <?php echo $school_data_csv[5][2]; ?></p>
              </div>
              <div class="graduate_wrap gaiyou_row">
                <div class="contTitleA small">
                  <p class="titleText">卒業日数</p>
                </div>
                <div class="graduate_flex flex">
                  <div class="graduate skn_graduate_orange">
                    <p class="graduate_text">AT車　最短<span class="em2"><?php echo esc_html( $post->school_AT最短 ); ?></span>日～</p>
                  </div>
                  <div class="graduate skn_graduate_blue">
                    <p class="graduate_text">MT車　最短<span class="em2"><?php echo esc_html( $post->school_MT最短 ); ?></span>日～</p>
                  </div>
                </div>
              </div>
              <div class="feasibles_wrap gaiyou_row">
                <div class="contTitleA small">
                  <p class="titleText">取得可能免許</p>
                </div>
                <div class="feasibles flex fWrap_wrap">
                  <?php echo do_shortcode('[single_menkyo]'); ?>
                </div>
              </div>
              <div class="highway_wrap gaiyou_row">
                <div class="contTitleA small">
                  <p class="titleText">高速教習</p>
                </div>
                <div class="highway_flex flex">
                <p class="highway"><?php echo esc_html( $post->school_高速教習 ); ?></p>
                <p class="notes">※諸事情により変更となる場合がございます。</p>
              </div>
              </div>

            </div><!--end gaiyou_co-->
          </div><!--end gaiyou_inner-->
        </div><!--end gaiyou_wrap-->
      </div><!--end gaiyou_row-->
    </div><!--end gaiyou_block-->
  </div><!--end secInner-->
</section><!--end gaiyou_section-->

<!--start facility_section-->
<section id="facility" class="marginBottom3">
  <div class="secInner">
    <!--start facility_row-->
    <div class="facility_block">
      <div class="facility_row1 facility_row box_row">
        <div class="secTitleA">
          <h3 class="titleText"><?php echo $title; ?>の施設・設備・周辺施設</h3>
        </div>
      </div><!--end facility_row-->
      <div class="facility_row2 facility_row box_row">
        <div class="infoboxs">
          <div class="infoboxs_inner flex fWrap_wrap">
            <div class="infobox">
              <div class="infobox_inner">
                <div class="infobox_title_wrap skn_infobox_title_wrap">
                  <span class="infobox_title">Wi-Fi</span>
                </div>
                <div class="infobox_content_wrap">
                 <?php
                 $setubi1 = get_post_meta(get_the_ID(),'school_設備1',true);
                 ?>
                  <span class="infobox_content"><?php if(!empty($setubi1)){echo $setubi1;}else{echo "-";} ?></span>
                </div>
              </div>
            </div>
            <div class="infobox">
              <div class="infobox_inner">
                <div class="infobox_title_wrap skn_infobox_title_wrap">
                  <span class="infobox_title">レンタサイクル</span>
                </div>
                <div class="infobox_content_wrap">
                 <?php
                 $setubi2 = get_post_meta(get_the_ID(),'school_設備2',true);
                 ?>
                  <span class="infobox_content"><?php if(!empty($setubi2)){echo $setubi2;}else{echo "-";} ?></span>
                </div>
              </div>
            </div>
            <div class="infobox">
              <div class="infobox_inner">
                <div class="infobox_title_wrap skn_infobox_title_wrap">
                  <span class="infobox_title">コンビニ</span>
                </div>
                <div class="infobox_content_wrap">
                 <?php
                 $setubi3 = get_post_meta(get_the_ID(),'school_設備3',true);
                 ?>
                  <span class="infobox_content"><?php if(!empty($setubi3)){echo $setubi3;}else{echo "-";} ?></span>
                </div>
              </div>
            </div>
            <div class="infobox">
              <div class="infobox_inner">
                <div class="infobox_title_wrap skn_infobox_title_wrap">
                  <span class="infobox_title">郵便局</span>
                </div>
                <div class="infobox_content_wrap">
                 <?php
                 $setubi4 = get_post_meta(get_the_ID(),'school_設備4',true);
                 ?>
                  <span class="infobox_content"><?php if(!empty($setubi4)){echo $setubi4;}else{echo "-";} ?></span>
                </div>
              </div>
            </div>
            <div class="infobox">
              <div class="infobox_inner">
                <div class="infobox_title_wrap skn_infobox_title_wrap">
                  <span class="infobox_title">銀行</span>
                </div>
                <div class="infobox_content_wrap">
                 <?php
                 $setubi5 = get_post_meta(get_the_ID(),'school_設備5',true);
                 ?>
                  <span class="infobox_content"><?php if(!empty($setubi5)){echo $setubi5;}else{echo "-";} ?></span>
                </div>
              </div>
            </div>
            <div class="infobox">
              <div class="infobox_inner">
                <div class="infobox_title_wrap skn_infobox_title_wrap">
                  <span class="infobox_title">駅</span>
                </div>
                <div class="infobox_content_wrap">
                 <?php
                 $setubi6 = get_post_meta(get_the_ID(),'school_設備6',true);
                 ?>
                  <span class="infobox_content"><?php if(!empty($setubi6)){echo $setubi6;}else{echo "-";} ?></span>
                </div>
              </div>
            </div>
            <div class="infobox">
              <div class="infobox_inner">
                <div class="infobox_title_wrap skn_infobox_title_wrap">
                  <span class="infobox_title">女性専用休憩室</span>
                </div>
                <div class="infobox_content_wrap">
                 <?php
                 $setubi7 = get_post_meta(get_the_ID(),'school_設備7',true);
                 ?>
                  <span class="infobox_content"><?php if(!empty($setubi7)){echo $setubi7;}else{echo "-";} ?></span>
                </div>
              </div>
            </div>
            <div class="infobox">
              <div class="infobox_inner">
                <div class="infobox_title_wrap skn_infobox_title_wrap">
                  <span class="infobox_title">卓球台</span>
                </div>
                <div class="infobox_content_wrap">
                 <?php
                 $setubi8 = get_post_meta(get_the_ID(),'school_設備8',true);
                 ?>
                  <span class="infobox_content"><?php if(!empty($setubi8)){echo $setubi8;}else{echo "-";} ?></span>
                </div>
              </div>
            </div>
            <div class="infobox">
              <div class="infobox_inner">
                <div class="infobox_title_wrap skn_infobox_title_wrap">
                  <span class="infobox_title">図書コーナー</span>
                </div>
                <div class="infobox_content_wrap">
                 <?php
                 $setubi9 = get_post_meta(get_the_ID(),'school_設備9',true);
                 ?>
                  <span class="infobox_content"><?php if(!empty($setubi9)){echo $setubi9;}else{echo "-";} ?></span>
                </div>
              </div>
            </div>
            <div class="infobox">
              <div class="infobox_inner">
                <div class="infobox_title_wrap skn_infobox_title_wrap">
                  <span class="infobox_title">ゲーム施設</span>
                </div>
                <div class="infobox_content_wrap">
                 <?php
                 $setubi10 = get_post_meta(get_the_ID(),'school_設備10',true);
                 ?>
                  <span class="infobox_content"><?php if(!empty($setubi10)){echo $setubi10;}else{echo "-";} ?></span>
                </div>
              </div>
            </div>
            <div class="infobox">
              <div class="infobox_inner">
                <div class="infobox_title_wrap skn_infobox_title_wrap">
                  <span class="infobox_title">ネット接続パソコン</span>
                </div>
                <div class="infobox_content_wrap">
                 <?php
                 $setubi11 = get_post_meta(get_the_ID(),'school_設備11',true);
                 ?>
                  <span class="infobox_content"><?php if(!empty($setubi11)){echo $setubi11;}else{echo "-";} ?></span>
                </div>
              </div>
            </div>
            <div class="infobox">
              <div class="infobox_inner">
                <div class="infobox_title_wrap skn_infobox_title_wrap">
                  <span class="infobox_title">ランドリー</span>
                </div>
                <div class="infobox_content_wrap">
                 <?php
                 $setubi12 = get_post_meta(get_the_ID(),'school_設備12',true);
                 ?>
                  <span class="infobox_content"><?php if(!empty($setubi12)){echo $setubi12;}else{echo "-";} ?></span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div><!--end facility_row-->

      <?php echo do_shortcode('[otherFacility]');//otherFacility ?>

      <div class="facility_row3 facility_row box_row">
        <!--start schoolImages_wrap-->
        <div class="facilitySlide schoolImages_wrap swiper-container">
          <div class="schoolImages_inner swiper-wrapper flex fWrap_wrap">
            <?php $picDirNAme = get_stylesheet_directory(). '/school/' . $slug_name . '/img/school';
              $html = "";
              $iPic = 2;
              while($iPic < 20){// echo $picDirNAme . $iPic . ".jpg";
                  if (file_exists($picDirNAme . $iPic . ".jpg")) {
                    $html .= <<< EOD
                    <div class="schoolImages_co1 schoolImages_co box_co swiper-slide">
                      <div class="imageBox">
                        <div class="image">
                          <div class="image_inner skn_radius">
                            <img src="/wp-content/themes/nanairo/school/{$slug_name}/img/school{$iPic}.jpg" alt="{$title}の安心、格安、丁寧な予約はHappy運転免許">
                          </div><!--end image_inner-->
                        </div><!--end image-->
                        <div class="text">
                          <p>
                            {$school_data_csv[7][$iPic - 1]}
                          </p>
                        </div>
                      </div><!--end imageBox-->
                    </div><!--end schoolImages_co-->
EOD;
                } else {
                    end;
                }
                 $iPic++;
              }
              echo $html;
              $html = "";
             ?>
          </div><!--end schoolImages_inner-->
          <div class="swiper-pagination"></div>
        </div><!--end schoolImages_wrap-->
        <script>
        if(2 <= document.querySelector(".facilitySlide .swiper-wrapper").children.length){
          var swiperOption = {
              effect:"slide", //"fade" "flip"//エフェクト指定
              autoplay:{
                  delay: 4000,//自動再生待ち時間
                  disableOnInteraction: false,//ユーザーが操作したあと自動再生を止めるか
              },
              speed: 1000,//スライド速度
              loop: true,//ループ
              slidesPerView:"auto",//同時表示枚数
              loopedSlides:6,//ループするときに途切れないように余分に出しておくスライド数
              preventClicks: true,//クリック出来なくなる場合はfalse
              preventClicksPropagation: true,//クリック出来なくなる場合はfalse
              allowTouchMove:true,//スライド操作できるか
              pagination: {//ページネーション
                el: '.swiper-pagination',
                type: 'bullets', //"fraction" "progress" "custom",//ページネーションスタイル
              },
              // navigation: {//スライドボタン
              //   nextEl: '.swiper-button-next',
              //   prevEl: '.swiper-button-prev',
              // },
              clickable:true,//ページネーションクリックできるか
          }
          var facilitySlide = null;

          swipeSwitch();
          window.addEventListener("resize",swipeSwitch);
          function swipeSwitch(){
            if(window.innerWidth <= 768){
              if(facilitySlide == null){
                if(document.querySelector(".facilitySlide .swiper-slide")){
                  facilitySlide = new Swiper ('.facilitySlide', swiperOption);
                }
              }
            }else{
              if(facilitySlide != null){
                facilitySlide.destroy();
                facilitySlide = null;
              }
            }
          }
        }
      </script>
      </div>
    </div><!--end facility_block-->
  </div><!--end secInner-->
</section><!--end facility_section-->


<?php //たくさんのお客様に選ばれていますゾーン ?>
<?php echo do_shortcode('[takusan_block '.$title.']'); ?>

<!-- 様子セクション開始 -->
<?php
  $picDirNAme = get_stylesheet_directory() . '/school/' . $slug_name . '/img/camp';
  if (file_exists($picDirNAme . "1.jpg")){
    $html = "";
    $html = <<< EOD
      <!--start  state_section-->
      <section id="state" class="marginBottom3">
        <div class="secInner">
          <!--start state_row-->
          <div class="state_block">
            <div class="state_row1 state_row box_row">
              <div class="secTitleA">
                <h3 class="titleText">{$title}の合宿の様子</h3>
              </div>
              </div><!--end state_row-->
              <div class="state_row2 state_row box_row">
                <!--start schoolImages_wrap-->
                <div class="stateSlide schoolImages_wrap swiper-container">
                  <div class="schoolImages_inner swiper-wrapper flex fWrap_wrap">
EOD;
  }
  echo $html; $html = ""; //出力して一度リセット
?>

<!-- 様子画像ループ -->
<?php //$picDirNAme = dirname(__FILE__).'/school/' . $slug_name . '/img/camp';
  $iPic = 1;
  while($iPic < 20){
    // echo $picDirNAme . $iPic . ".jpg";
    if (file_exists($picDirNAme . $iPic . ".jpg")) {
    $html .= <<< EOD
      <div class="schoolImages_co1 schoolImages_co box_co swiper-slide">
        <div class="imageBox">
          <div class="image">
            <div class="image_inner skn_radius">
              <img src="/wp-content/themes/nanairo/school/{$slug_name}/img/camp{$iPic}.jpg" alt="{$title}の安心、格安、丁寧な予約は運転免許受付センター">
            </div><!--end image_inner-->
          </div><!--end image-->
          <div class="text">
            <p>
              {$school_data_csv[8][$iPic - 0]}
            </p>
          </div>
        </div><!--end imageBox-->
      </div><!--end schoolImages_co-->
EOD;
    } else {
      end;
    }
    $iPic++;
  }
  echo $html; $html = ""; //出力して一度リセット
?>

<!-- 様子セクションを閉じる -->
<?php
  if (file_exists($picDirNAme . "1.jpg")){
    $html = "";
    $html = <<< EOD
                </div><!--end schoolImages_inner-->
                <div class="swiper-pagination"></div>
              </div><!--end schoolImages_wrap-->
              <script>
              if(2 <= document.querySelector(".stateSlide .swiper-wrapper").children.length){
                  var swiperOption = {
                      effect:"slide", //"fade" "flip"//エフェクト指定
                      autoplay:{
                          delay: 4000,//自動再生待ち時間
                          disableOnInteraction: false,//ユーザーが操作したあと自動再生を止めるか
                      },
                      speed: 1000,//スライド速度
                      loop: true,//ループ
                      slidesPerView:"auto",//同時表示枚数
                      loopedSlides:6,//ループするときに途切れないように余分に出しておくスライド数
                      preventClicks: true,//クリック出来なくなる場合はfalse
                      preventClicksPropagation: true,//クリック出来なくなる場合はfalse
                      allowTouchMove:true,//スライド操作できるか
                      pagination: {//ページネーション
                        el: '.swiper-pagination',
                        type: 'bullets', //"fraction" "progress" "custom",//ページネーションスタイル
                      },
                      clickable:true,//ページネーションクリックできるか
                  }

                  var stateSlide = null;
                  swipeSwitch();
                  window.addEventListener("resize",swipeSwitch);
                  function swipeSwitch(){
                    if(window.innerWidth <= 768){
                      if(stateSlide == null){
                        if(document.querySelector(".stateSlide .swiper-slide")){
                          stateSlide = new Swiper ('.stateSlide', swiperOption);
                        }
                      }
                    }else{
                      if(stateSlide != null){
                        stateSlide.destroy();
                        stateSlide = null;
                      }
                    }
                  }
                }
              </script>
            </div><!--end state_row-->
          </div><!--end state_block-->
        </div><!--end secInner-->
      </section><!--end  state_section-->
EOD;
  }
  echo $html; $html = ""; //出力して＄HTMLリセット
?>

<?php if(!empty($school_data_csv[2][1])){
 ?>
 <!--start その他備考_section-->
 <section id="other" class="marginBottom3">
   <div class="secInner">
     <div class="secTitleA">
       <h3 class="titleText">その他備考</h3>
     </div>
     <!--start access_row-->
     <div class="other_block">
       <div class="other_row1 other_row box_row">
         <?php
         //読み込み B3
         echo $school_data_csv[2][1];
         ?>
       </div><!--end other_row-->
     </div><!--end other_block-->
   </div><!--end secInner-->
 </section><!--end その他備考_section-->
 <?php
} ?>

<!--start access_section-->
<section id="access" class="marginBottom3">
  <div class="secInner">
    <div class="secTitleA">
      <h3 class="titleText"><?php echo $title; ?>への交通費とアクセス方法</h3>
    </div>
    <!--start access_row-->
    <div class="access_block">
      <div class="access_row1 access_row box_row">
        <?php
        //アクセス部分の読み込み
        if(file_exists($filepath.'/access.html'))readfile($filepath.'/access.html');
        ?>
      </div><!--end access_row-->
    </div><!--end access_block-->
  </div><!--end secInner-->
</section><!--end access_section-->


<?php //たくさんのお客様に選ばれていますゾーン ?>
<?php echo do_shortcode('[takusan_block '.$title.']'); ?>
