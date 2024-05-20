<?php $home='<a href="'. home_url() .'">合宿免許Happy</a>'; ?>

<section id="priceTable" class="main-sct marginBottom3">
  <div class="secTitleA">
    <h3 class="titleText"><?php echo $title; ?>の宿泊プランの料金表（AT車）</h3>
  </div>
  <div class="text otokuText">
    <p>
      価格がオトクな日を狙って予約しちゃおう！<?php echo $title; ?>のお得な情報は<?php echo $home;?>の<a href="<?php echo home_url();?>/contact/">お問合せからも入手可能です！
    </a></p>
  </div>
<div class="main-sct-inner">
<?php
  $plans = "";
  $praice_col = "";
  $plan_flag = 0;
  $col_count = 0;
  //ヘッダー
    // if($k ==0){
      if(!empty($price_csv[0][1])){
      $ryokinhyoHeader = $price_csv[0][1];
      }
    // }
  //フッター
    // if($k ==1){
      if(!empty($price_csv[1][1])){
      $ryokinhyoFooter = $price_csv[1][1];
      }
    // }
  //嬉しい特典
    // if($k ==2){
      if(!empty($price_csv[2][1])){
      $ureshiitokuten = $price_csv[2][1];
      }
    // }
    //料金表
      for($iii = 3; $iii < 12 ;$iii++){
        if(!empty($price_csv[$iii][0])){
          for($kk = 0; $kk < count($price_csv[3]); $kk++){
            if(!empty($price_csv[$iii][$kk])){
            if($iii == 3 ){
              if(strlen($price_csv[$iii][$kk]) >= 71){
                  $fontSize = 'titleSmall';
                  str_replace("\r\n", "　",str_replace("　","",$price_csv[$iii][$kk]));
                }

              else{
                  $fontSize ='titleNormal';
                }
                if($kk=="0"){
                  $plan[$iii] .= '<div class="hotelPlanTitle' . $iii . '_' . $kk . ' ' .'"><p>' . nl2br(str_replace("　","",mb_convert_kana($price_csv[$iii][$kk],"a")))  .'</p></div>';
                }
                else{
                  $plan[$iii] .= '<div class="hotelPlanTitle' . $iii . '_' . $kk . ' ' .'"><p>' . nl2br(str_replace("　","",mb_convert_kana($price_csv[$iii][$kk],"a")))  . '<a href="/plan" class="checkPlan">説明</a></p>' .'</div>';
                }

              }
              elseif($kk == 0 ){
                $plan[$iii] .= '<div class="hotelPlan' . $iii . '_' . $kk . '"><p>' . nl2br($price_csv[$iii][$kk])   . '</p>' .'</div>';
              }
              else{

                if($price_csv[$iii][$kk]=='-' || empty($price_csv[$iii][$kk] || $price_csv[$iii][$kk]=='')){
                  if( empty($price_csv[3][$kk])){break;}
                  else{
                    $plan[$iii] .= '<div class="textCenter hotelPlanPrice' . $iii . '_' . $kk . '"><p> - </p></div>';
                  }
                }

                elseif(!empty($price_csv[$iii][$kk])){
                    $taxInc =intval(floor(str_replace(',','',$price_csv[$iii][$kk]) * 1.08));//元データを数値化して1.08倍して切り捨て

                  //静岡県セイブ自動車学校だけ例外処理
                  if($title == "静岡県セイブ自動車学校"){

                    //下一桁1円になってる場合、1円を引く
                    $d = intval(substr($taxInc, -1));
                    if($d == 1){
                      $taxInc = $taxInc - 1;
                    }
                  }
                  $taxInc = '<p class="taxInc">税込' . number_format($taxInc) . '円</p>';
                  // $taxInc = '<p class="taxInc">税込' . number_format(floor(str_replace(',','',$price_csv[$iii][$kk]) * 1.08 / 10000 * 1000)*10) . '円</p>';
                  $plan[$iii] .= '<div class="hotelPlanPrice' . $iii . '_' . $kk . '"><p class="normalprice">' . number_format(nl2br(str_replace(',','',$price_csv[$iii][$kk])))   . '円</p>' . $taxInc . '</div>';
                }

                else{
                  $plan[$iii] .= '<div class="textCenter hotelPlanPrice' . $iii . '_' . $kk . '"><p> - </p></div>';
                }
              }
            }
          }
        }
        if(!empty($plan[$iii]) && $iii != 3){
          $plans .= '<div class="set_col flex"><div class="price_label">'.$plan[3].'</div><div class="price-tbl-col '  .'"">'. $plan[$iii] .'</div>';

          $num_flg = ($iii - 3) % 2;
          if($num_flg === 0){
           // $plans .= '<p class="upprice">'.nl2br($ryokinhyoHeader).'</p>'
           $plans .= '</div>';
          }else{
            $plans .= '</div>';
          }
        }
      }

?>

 <div class="ryokinhyoHeader">
   <p>
     <?php
     $ryokinhyoHeader =str_replace("税込",'<span class="taxInc">税込み',$ryokinhyoHeader);
     $ryokinhyoHeader =str_replace("UP",'</span>UP',$ryokinhyoHeader);
     $ryokinhyoHeader =str_replace("引",'</span>引',$ryokinhyoHeader);

      echo nl2br($ryokinhyoHeader); ?>
   </p>
 </div>

  <div class="price-tbl-wrap">
    <div class="price-tbl <?php echo $fontSize;?>">
      <?php echo $plans ?>
      <?php //echo $praice_col; ?>
    </div>
  </div><!-- // .price-tbl-wrap -->

  <div class="ryokinhyoFooter">

    <p>
      <?php echo nl2br($ryokinhyoFooter); ?>
    </p>
  </div>

</div><!-- // .main-sct-inner -->
</section><!-- // .main-sct -->



<!--start happyOtoku_section-->
<section id="happyOtoku" class="">
  <div class="secInner">
    <div class="secTitleA">
      <h3 class="titleText">Happyオススメ！<?php echo $title; ?>のおトク情報</h3>
    </div>
    <!--start otoku_wrap-->
    <div class="otoku_wrap">
      <div class="otoku_inner flex fWrap_wrap">
        <div class="otoku_co1 otoku_co box_co">
          <div class="imageBox center">
            <div class="image">
              <div class="image_inner">
                <img src="<?php echo content_url();?>/uploads/2018/09/marutoku.png" alt="得" srcset="<?php echo content_url();?>/uploads/2018/09/marutoku.png 1x,<?php echo content_url();?>/uploads/2018/09/9e96547c5ac47c23a5d22abbd03cdc72.png 2x">
              </div><!--end image_inner-->
            </div><!--end image-->
          </div><!--end imageBox-->
        </div><!--end otoku_co-->
        <div class="otoku_co2 otoku_co box_co">
          <?php echo nl2br($ureshiitokuten); ?>
        </div><!--end otoku_co-->
      </div><!--end otoku_inner-->
    </div><!--end otoku_wrap-->
  </div><!--end secInner-->
</section><!--end happyOtoku_section-->



<?php /*たくさんのお客様に選ばれています*/ ?>
<?php echo do_shortcode('[takusan_block '.$title.']'); ?>
<?php /*たくさんのお客様に選ばれています*/ ?>



<section id="campaignSection" class="main-sct color-pink">
    <div class="secTitleA">
      <h3 class="titleText"><?php echo $title; ?>のお得なキャンペーン</h3>
    </div>
  <!-- キャンペーン -->

  <?php
    if(!empty(campaign_csv[2][0])){
    {
      $campaignOutput = array();

                 //料金表
      for($ccc = 2; $ccc < 50 ;$ccc++){
        // echo $ccc.'<br>';

        if(!empty($campaign_csv[$ccc][0])){


              $classArray = array("null","限定割","春特","ゴールド","年末一時帰宅","卒業日一時帰宅","ツイン特別","二輪同時特別","オフシーズン一時帰宅コース","シングルユース","グループユース");
              if( array_search($campaign_csv[$ccc][0], $classArray)){
                $classnumber =array_search($campaign_csv[$ccc][0], $classArray);
                              $campaignOutput[$ccc][0] = 'campaign co_cn'. $classnumber;

              }
              elseif ( strpos( $campaign_csv[$ccc][6], '●') !== false ) {
                  $bgnumber ++;
                  $otherClassNumber++;
                $campaignOutput[$ccc][0] = 'campaign co_ocn'. $otherClassNumber . ' bgNumber_' . $bgnumber;
              }
              else{
                  $bgnumber ++;
                  $campaignOutput[$ccc][0] = 'campaign co_ocn bgNumber_' . $bgnumber;

              }

              $campaignOutput[$ccc][1] = $campaign_csv[$ccc][0]; //ace 限定割
              $campaignOutput[$ccc][2] = $campaign_csv[$ccc][2];
              $campaignOutput[$ccc][3] = str_replace('●' , '<span>●</span>' ,$campaign_csv[$ccc][3]);
              $campaignOutput[$ccc][4] = $campaign_csv[$ccc][4];
              $campaignOutput[$ccc][5] = nl2br($campaign_csv[$ccc][5]);
              $campaignOutput[$ccc][6] = str_replace('カレンダーの<span>●</span>の日', 'カレンダーの<span>●</span>の日<a href="#scheduleSlide" class="checkCalendar">⇒カレンダーを見る</a>',nl2br($campaign_csv[$ccc][6]));
              // $campaignOutput[$ccc][6] = nl2br($campaign_csv[$ccc][6]);
              $campaignOutput[$ccc][7] = nl2br($campaign_csv[$ccc][1]);

         }


        $loopi++;
        // else{
        //   break;
        // }


      }


      for($ccc = 2; $ccc < 50 ;$ccc++){

        if(!empty($campaignOutput[$ccc][0])) {
            $iiii++;
            if ( $iiii & 1 ) {
              //odd
              $oddEven=" odd";
            } else {
              //even
              $oddEven=" even";
            }
            if(!empty($campaignOutput[$ccc][4])){
              $price='
                <div class="campaignPrice_co">
                  <p class="Circle atCircle">AT車免許で</p>
                  <p class="Price atPrice">' . number_format(str_replace(',','',$campaignOutput[$ccc][4]))  . '円</p>
                  <p class="PriceTaxInc atPriceTaxInc">税込' . number_format (round(str_replace(',','',$campaignOutput[$ccc][4]) * 1.08/10000*10000)) . '円</p>
                  </div>
                ';
              $at = preg_replace('/[^0-9]/', '', number_format(str_replace(',','',$campaignOutput[$ccc][4])));
            }
            else{
              $price='';
              $at = 0;
            }

            if(!empty($campaignOutput[$ccc][5])){
              $mt = $campaignOutput[$ccc][4] + intval($campaignOutput[$ccc][5]);
              // $mt = ($mt / 108) * 100;
            }else{
              $mt = 0;
            }
            if(!empty($mt)){
              $mtTax = ($mt*1.08);
              $mtTax = number_format($mtTax);

              $mt = $mt;
              $mt = number_format($mt);
              $mtPrice='
                <div class="campaignPrice_co">
                  <p class="Circle atCircle">MT車免許で</p>

                  <p class="Price mtPrice">'.$mt.'円</p>
                  <p class="PriceTaxInc mtPriceTaxInc">税込'.$mtTax.'円</p>
                </div>
                  ';
            }else{
              $mtPrice = '';
            }
            $campaignOutputAll .= <<< EOD

            <div class="campaign_co  {$campaignOutput[$ccc][0]}">
              <div class="campaignCo_inner">
                <div class="campaignNameWrapper">
                  <p class="campaignName">{$campaignOutput[$ccc][1]}</p>
                  <p class="campaignSubtitle">{$campaignOutput[$ccc][2]}</p>
                </div><!--/.campaignNameWrapper-->


                    <div class="bg_inner"></div><!--end bg_inner-->



                <div class="campaignPriceWrapper flex ">

                  {$price}

                  {$mtPrice}

                </div><!--/.campaignPriceWrapper-->

                <div class="campaignDetailWrapper">
                  <p class="condition2">{$campaignOutput[$ccc][6]}</p>
                  <p class="limitation">{$campaignOutput[$ccc][3]}</p>
                </div><!--/.campaignDetailWrapper-->


              </div>
            </div><!--/.campaignWrapper-->
EOD;

          }


          }
          echo'<div class="waribikiWrapper flex fWrap_wrap">';

          // $meta_arr = get_post_meta($post->ID , 'waribiki' ,true);
          // if (is_array($meta_arr)){
          //   foreach ($meta_arr as $meta_key => $meta_value) {
          //     if($meta_value === "hayawari"){
          //       echo '<div class="wpb_wrapper">
          //               <p class="waribikiBtn"><a href=""><span class="planName">早割</span><span class="taxInc">税込</span><span class="taxIncPrice">5,000</span><span class="taxInc">円割引</span></a></p>
          //            </div>';
          //     }
          //     if($meta_value === "gakuwari"){
          //       echo '<div class="wpb_wrapper">
          //               <p class="waribikiBtn"><a href=""><span class="planName">学割</span><span class="taxInc">税込</span><span class="taxIncPrice">3,000</span><span class="taxInc">円割引</span></a></p>
          //             </div>';
          //     }
          //     if($meta_value === "gwari"){
          //       echo '<div class="wpb_wrapper">
          //               <p class="waribikiBtn"><a href=""><span class="planName">G割</span><span class="taxInc">税込</span><span class="taxIncPrice">5,000</span><span class="taxInc">円割引</span></a></p>
          //             </div>';
          //     }
          //   }
          // }

          $themeURL = get_template_directory_uri();
          //早割り
          $hayawari_data = '';
          $hayawari_text = '';
          $hayawari_sosoku = '';
          //for ($i=1; $i <= 30; $i++) {
           $hayawari_name = get_post_meta(get_the_ID(),'school_割引1_企画名',true);
           $hayawari_flg = get_post_meta(get_the_ID(),'school_割引1_適応',true);
           if($hayawari_flg == '●'){
            //あるとき
            $hayawari_sosoku = '早割　'.get_post_meta(get_the_ID(),'school_割引1_案内内容',true).'<br />';
            preg_match('/（(.*)）/', $hayawari_name, $a);
            if(number_format($a[1]) > 0)$hayawari_text = '<div class="wpb_wrapper"><p class="waribikiBtn"><span class="planName">早割</span><span class="taxInc">税込</span><span class="taxIncPrice">'.number_format($a[1]).'</span><span class="taxInc">円割引</span></p></div>';
            $hayawari_data = <<< EOD
            <div class="imageBox">
              <div class="image">
                <div class="image_inner">
                  <img src="{$themeURL}/assets/images/common/hayawariBtn.png" alt="早割" srcset="{$themeURL}/assets/images/common/hayawariBtn.png 1x , {$themeURL}/assets/images/common/hayawariBtn@2x.png 2x">
                </div><!--end image_inner-->
              </div><!--end image-->
            </div><!--end imageBox-->
EOD;
           }
          //}

          //学割
          $gakuwari_data = '';
          $gakuwari_text = '';
          $gakuwari_sosoku = '';
          // for ($ii=1; $ii <= 30; $ii++) {
           $gakuwari_name = get_post_meta(get_the_ID(),'school_割引2_企画名',true);
           $gakuwari_flg = get_post_meta(get_the_ID(),'school_割引2_適応',true);
           if($gakuwari_flg == '●'){
            //あるとき
            $gakuwari_sosoku = '学割　'.get_post_meta(get_the_ID(),'school_割引2_案内内容',true).'<br />';
            preg_match('/（(.*)）/', $gakuwari_name, $a);
            if(number_format($a[1]) > 0)$gakuwari_text = '<div class="wpb_wrapper"><p class="waribikiBtn"><span class="planName">学割</span><span class="taxInc">税込</span><span class="taxIncPrice">'.number_format($a[1]).'</span><span class="taxInc">円割引</span></p></div>';
            $gakuwari_data = <<< EOD
            <div class="imageBox">
              <div class="image">
                <div class="image_inner">
                  <img src="{$themeURL}/assets/images/common/gakuwariBtn.png" alt="学割" srcset="{$themeURL}/assets/images/common/gakuwariBtn.png 1x , {$themeURL}/assets/images/common/gakuwariBtn@2x.png 2x">
                </div><!--end image_inner-->
              </div><!--end image-->
            </div><!--end imageBox-->
EOD;
           }
          // }

          //G割
          $Gwari_data = '';
          $Gwari_text = '';
          $Gwari_sosoku = '';
          // for ($iii=1; $iii <= 30; $iii++) {
           $Gwari_name = get_post_meta(get_the_ID(),'school_割引3_企画名',true);
           $Gwari_flg = get_post_meta(get_the_ID(),'school_割引3_適応',true);
           if($Gwari_flg == '●'){
            //あるとき
            $Gwari_sosoku = 'Ｇ割　'.get_post_meta(get_the_ID(),'school_割引3_案内内容',true).'<br />';
            preg_match('/（(.*)）/', $Gwari_name, $a);
            if(number_format($a[1]) > 0)$Gwari_text = '<div class="wpb_wrapper"><p class="waribikiBtn"><span class="planName">Ｇ割</span><span class="taxInc">税込</span><span class="taxIncPrice">'.number_format($a[1]).'</span><span class="taxInc">円割引</span></p></div>';
            $Gwari_data = <<< EOD
            <div class="imageBox">
              <div class="image">
                <div class="image_inner">
                  <img src="{$themeURL}/assets/images/common/gwariBtn.png" alt="G割" srcset="{$themeURL}/assets/images/common/gwariBtn.png 1x , {$themeURL}/assets/images/common/gwariBtn@2x.png 2x">
                </div><!--end image_inner-->
              </div><!--end image-->
            </div><!--end imageBox-->
EOD;
           }
           //その他の割引
           $other_waribiki_text = '';
           $other_waribiki_text = get_post_meta(get_the_ID(),'school_その他の割引',true);

           echo $hayawari_data.$hayawari_text;
           echo $gakuwari_data.$gakuwari_text;
           echo $Gwari_data.$Gwari_text;

          echo '</div>';

          //補足挿入
          // $waribiki_hosoku = get_post_meta($post->ID , 'waribikihosoku' ,true);
          // $waribiki_hosoku = nl2br($waribiki_hosoku);
          $waribiki_hosoku = '
            <div class="waribikihosoku">
              <p>
              '.$hayawari_sosoku.'
              '.$gakuwari_sosoku.'
              '.$Gwari_sosoku.'
              '.$other_waribiki_text.'
              </p>
            </div>
          ';
          echo $waribiki_hosoku;


          if(empty($campaignOutputAll)){
            $campaignOutputAll = "<span class='nocampaign'>※キャンペーン情報は現在ございません。</span";
          }
        }
        $html = <<< EOD
        <div id="campaign">
          <div class="otokuTitle">{$title}のお得なキャンペーンです。{$home}でお得に運転免許を取得しよう！</div>
          <div class="campaign_wrap">
            <div class="campaign_inner flex fWrap_wrap">
              {$campaignOutputAll}
              </div>
            </div>
          </div>
EOD;
        echo $html;

    }


  ?>
</section><!-- // .main-sct -->
<?php /*保証内容*/ ?>
<?php
 $hoshou_block1_title = mb_convert_kana(str_replace("　"," ",get_post_meta(get_the_ID(),'school_保証ブロック1_タイトル',true)),'a');//タイトル
 $hoshou_block1_ginou = mb_convert_kana(str_replace("　"," ",get_post_meta(get_the_ID(),'school_保証ブロック1_技能教習',true)),'a');//技能教習
 $hoshou_block1_sothugyou = mb_convert_kana(str_replace("　"," ",get_post_meta(get_the_ID(),'school_保証ブロック1_卒業検定',true)),'a');//卒業まで追加料金
 $hoshou_block1_shuryo = mb_convert_kana(str_replace("　"," ",get_post_meta(get_the_ID(),'school_保証ブロック1_修了検定',true)),'a');//修了検定
 $hoshou_block1_shukuhaku = mb_convert_kana(str_replace("　"," ",get_post_meta(get_the_ID(),'school_保証ブロック1_宿泊',true)),'a');//宿泊
  $hoshou_block1_title = strip_tags($hoshou_block1_title);
 $hosyouHtml1 = <<< EOD
 <div class="contTitleA flex">
   <p class="titleText bold">{$hoshou_block1_title}</p>
 </div>
 <!--start hosyou_wrap-->
 <div class="hosyou_wrap marginBottom2">
   <div class="hosyou_inner flex fWrap_wrap">
     <div class="hosyou_co1 hosyou_co box_co">
       <div class="flex">
         <div class="hosyou_label">技能教習</div>
         <div class="hosyou_content"><span>{$hoshou_block1_ginou}</span></div>
       </div>
     </div><!--end hosyou_co-->
     <div class="hosyou_co2 hosyou_co box_co">
       <div class="flex">
         <div class="hosyou_label">修了検定</div>
         <div class="hosyou_content"><span>{$hoshou_block1_shuryo}</span></div>
       </div>
     </div><!--end hosyou_co-->
     <div class="hosyou_co3 hosyou_co box_co">
       <div class="flex">
         <div class="hosyou_label">卒業検定</div>
         <div class="hosyou_content"><span>{$hoshou_block1_sothugyou}</span></div>
       </div>
     </div><!--end hosyou_co-->
     <div class="hosyou_co4 hosyou_co box_co">
       <div class="flex">
         <div class="hosyou_label">宿泊(食事付き)</div>
         <div class="hosyou_content"><span>{$hoshou_block1_shukuhaku}</span></div>
       </div>
     </div><!--end hosyou_co-->

   </div><!--end hosyou_inner-->
 </div><!--end hosyou_wrap-->
EOD;


 $hoshou_block2_title = mb_convert_kana(str_replace("　"," ",get_post_meta(get_the_ID(),'school_保証ブロック2_タイトル',true)),'a');//タイトル
 $hoshou_block2_ginou = mb_convert_kana(str_replace("　"," ",get_post_meta(get_the_ID(),'school_保証ブロック2_技能教習',true)),'a');//技能教習
 $hoshou_block2_sothugyou = mb_convert_kana(str_replace("　"," ",get_post_meta(get_the_ID(),'school_保証ブロック2_卒業検定',true)),'a');//卒業まで追加料金
 $hoshou_block2_shuryo = mb_convert_kana(str_replace("　"," ",get_post_meta(get_the_ID(),'school_保証ブロック2_修了検定',true)),'a');//修了検定
 $hoshou_block2_shukuhaku = mb_convert_kana(str_replace("　"," ",get_post_meta(get_the_ID(),'school_保証ブロック2_宿泊',true)),'a');//宿泊
  $hoshou_block2_title = strip_tags($hoshou_block2_title);
 if(!empty($hoshou_block2_title)){
  $hosyouHtml2 = <<< EOD
  <div class="contTitleA flex">
    <p class="titleText bold">{$hoshou_block2_title}</p>
  </div>
  <!--start hosyou_wrap-->
  <div class="hosyou_wrap marginBottom2">
    <div class="hosyou_inner flex fWrap_wrap">
      <div class="hosyou_co1 hosyou_co box_co">
        <div class="flex">
          <div class="hosyou_label">技能教習</div>
          <div class="hosyou_content"><span>{$hoshou_block2_ginou}</span></div>
        </div>
      </div><!--end hosyou_co-->
      <div class="hosyou_co2 hosyou_co box_co">
        <div class="flex">
          <div class="hosyou_label">修了検定</div>
          <div class="hosyou_content"><span>{$hoshou_block2_shuryo}</span></div>
        </div>
      </div><!--end hosyou_co-->
      <div class="hosyou_co3 hosyou_co box_co">
        <div class="flex">
          <div class="hosyou_label">卒業検定</div>
          <div class="hosyou_content"><span>{$hoshou_block2_sothugyou}</span></div>
        </div>
      </div><!--end hosyou_co-->
      <div class="hosyou_co4 hosyou_co box_co">
        <div class="flex">
          <div class="hosyou_label">宿泊(食事付き)</div>
          <div class="hosyou_content"><span>{$hoshou_block2_shukuhaku}</span></div>
        </div>
      </div><!--end hosyou_co-->

    </div><!--end hosyou_inner-->
  </div><!--end hosyou_wrap-->
EOD;
}
 $hoshou_tuika_title = mb_convert_kana(str_replace("　"," ",get_post_meta(get_the_ID(),'school_保証ブロック追加料金_タイトル',true)),'a');//タイトル
 $hoshou_tuika_ginou = mb_convert_kana(str_replace("　"," ",get_post_meta(get_the_ID(),'school_保証ブロック追加料金_技能教習',true)),'a');//技能教習
 $hoshou_tuika_sothugyou = mb_convert_kana(str_replace("　"," ",get_post_meta(get_the_ID(),'school_保証ブロック追加料金_卒業検定',true)),'a');//卒業まで追加料金
 $hoshou_tuika_shuryo = mb_convert_kana(str_replace("　"," ",get_post_meta(get_the_ID(),'school_保証ブロック追加料金_修了検定',true)),'a');//修了検定
 $hoshou_tuika_shukuhaku = mb_convert_kana(str_replace("　"," ",get_post_meta(get_the_ID(),'school_保証ブロック追加料金_宿泊',true)),'a');//宿泊
 $hosyouHtml3 = <<< EOD
 <div class="contTitleA flex">
   <p class="titleText bold">追加料金</p>
 </div>
 <!--start hosyou_wrap-->
 <div class="hosyou_wrap marginBottom2">
   <div class="hosyou_inner flex fWrap_wrap">
     <div class="hosyou_co1 hosyou_co box_co">
       <div class="flex">
         <div class="hosyou_label">技能教習</div>
         <div class="hosyou_content"><span>{$hoshou_tuika_ginou}</span></div>
       </div>
     </div><!--end hosyou_co-->
     <div class="hosyou_co2 hosyou_co box_co">
       <div class="flex">
         <div class="hosyou_label">修了検定</div>
         <div class="hosyou_content"><span>{$hoshou_tuika_shuryo}</span></div>
       </div>
     </div><!--end hosyou_co-->
     <div class="hosyou_co3 hosyou_co box_co">
       <div class="flex">
         <div class="hosyou_label">卒業検定</div>
         <div class="hosyou_content"><span>{$hoshou_tuika_sothugyou}</span></div>
       </div>
     </div><!--end hosyou_co-->
     <div class="hosyou_co4 hosyou_co box_co">
       <div class="flex">
         <div class="hosyou_label">宿泊(食事付き)</div>
         <div class="hosyou_content"><span>{$hoshou_tuika_shukuhaku}</span></div>
       </div>
     </div><!--end hosyou_co-->

   </div><!--end hosyou_inner-->
 </div><!--end hosyou_wrap-->
EOD;


 $hoshou_other_content = mb_convert_kana(str_replace("　"," ",get_post_meta(get_the_ID(),'school_保証ブロック備考',true)),'a');//その他
 $hoshou_separateFee_content = mb_convert_kana(str_replace("　"," ",get_post_meta(get_the_ID(),'school_保証ブロック別途料金',true)),'a');//別途料金
 $hoshou_nirin_douzi = mb_convert_kana(str_replace("　"," ",get_post_meta(get_the_ID(),'school_保証ブロック二輪同時',true)),'a');//二輪同時
 $hosyouHtml4 = <<< EOD
 <div class="contTitleA flex">
   <p class="titleText bold">その他・注釈</p>
 </div>
 <div class="text marginBottom1">
   <p>
    {$hoshou_other_content}
   </p>
 </div>
 <div class="text marginBottom1">
   <p>
    {$hoshou_separateFee_content}
   </p>
 </div>
 <div class="text marginBottom1">
   <p>
    {$hoshou_nirin_douzi}
   </p>
 </div>
EOD;
?>

<!--start hoshou_section-->
<section id="hoshou" class="">
  <div class="secInner">
    <div class="secTitleA">
      <h3 class="titleText">とっても安心！各コースの保証内容</h3>
    </div>
    <div class="text marginBottom1">
      <p>
        <?php echo $home;?>なら万が一のときでも保証がついているから安心！<?php echo $title; ?>の保証内容です。
      </p>
    </div>
    <?php echo $hosyouHtml1; ?>
    <?php echo $hosyouHtml2; ?>
    <?php echo $hosyouHtml3; ?>
    <?php echo $hosyouHtml4; ?>
    <?php echo $hosyouHtml5; ?>
  </div><!--end secInner-->
</section><!--end hoshou_section-->
<?php /*保証内容*/ ?>


<!--start scheduleSlide_section-->
<section id="scheduleSlide" class="">
  <div class="secInner">
    <div class="secTitleA">
      <h3 class="titleText"><?php echo $title; ?>　入校日カレンダー</h3>
    </div>
    <div class="slideCalendarSwitch">
      <select class="calendarMTAT">
        <option value="AT" selected>AT車</option>
        <option value="MT">MT車</option>
      </select>
      <?php /*カレンダー*/ ?>
      <?php echo do_shortcode('[csv2table table_id="sample-table"]'); ?>
      <?php /*カレンダー*/ ?>
    </div>
  </div><!--end secInner-->
  <?php
  //注釈出す場所
  echo '<p>'.get_post_meta(get_the_ID(),'school_スケジュール補足',true).'</p>';
   ?>
</section><!--end scheduleSlide_section-->

<?php /*たくさんのお客様に選ばれています*/ ?>
<?php echo do_shortcode('[takusan_block '.$title.']'); ?>
<?php /*たくさんのお客様に選ばれています*/ ?>
