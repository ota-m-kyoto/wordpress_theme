<?php get_header(); ?>
<!--page-->
<div id="wholeContents" class="wholeContents page-php" role="main">
  <div id="mainContents" class="mainContents">
    <div id="contentsWrapper" class="contentsWrapper maxWidth flex fWrap_wrap twoColumn RefineList">
      <!--main-->
        <div id="main" class="mainContent">
          <!--start dormitory_list_section-->
          <section id="dormitory_list" class="">
            <div class="secInner">
              <div class="pageTitleA">
                <h2 class="titleText flex">
                 <div class="imageBox">
                   <div class="image">
                     <div class="image_inner">
                       <img src="<?php echo get_template_directory_uri()?>/assets/icomoon/doubleCircle.svg" alt="">
                     </div><!--end image_inner-->
                   </div><!--end image-->
                 </div><!--end imageBox-->
                 <?php
                 $term_data = get_term_by('slug', $term, 'school_cat');
                 $text_schoolcat = '';

                 if($term =='month_01' || $term =='month_02'|| $term =='month_03'|| $term =='month_04'|| $term =='month_05'|| $term =='month_06'
                 || $term =='month_07'|| $term =='month_08'|| $term =='month_09'|| $term =='month_10'|| $term =='month_11'|| $term =='month_12'){
                  /*各月の掘り出し情報*/
                  $termname = $term_data->name;
                  if(substr($term_data->name, 0, 1) === '0'){
                   $termname = ltrim($term_data->name, '0');
                  }
                  $text_schoolcat = file_get_contents(locate_template('my_parts/text_files/'.$term.'.txt'));
                  echo $termname.'の掘り出し教習所一覧';

                 }else if($term =='kansai_departure' || $term =='chugoku_departure' || $term =='kyushu_departure' || $term =='hokkaido_departure' || $term =='hokuriku_departure'
                 || $term =='shikoku_departure' || $term =='tohoku_departure' || $term =='toukai_departure' || $term =='koushinetsu_departure' || $term =='kanto_departure'){
                  /*出発一覧*/
                  $termname = $term_data->name;
                  $text_schoolcat = file_get_contents(locate_template('my_parts/text_files/school_cat_'.$term.'.txt'));
                  echo $termname.'の教習所一覧';

                 }else if($term =='unique' || $term =='motorcycle' || $term =='group' || $term =='for_woman' || $term =='single' || $term =='divide'
                 || $term =='hot_spring' || $term =='international_student' || $term =='cook' || $term =='tourism' || $term =='meal' || $term == 'new_year'){
                  /*特集一覧*/
                  $termname = $term_data->name;
                  $text_schoolcat = file_get_contents(locate_template('my_parts/text_files/school_cat_'.$term.'.txt'));
                  echo $termname.'の教習所一覧';

                 }else{
                  /*どれでもないとき*/
                  $termname = $term_data->name;
                  echo $termname.'の教習所一覧';
                 }
                 ?>
                </h2>
                <div class="descText"><p><?php echo $text_schoolcat; ?></p></div>
              </div>
              <div class="dormitorytTable_head flex">
                <p class="dormitory_co2">教習所名、料⾦(税込)</p>
                <p class="dormitory_co3">お得情報</p>
              </div>
<?php
global $query_string;
query_posts( $query_string . "&posts_per_page=-1");
$themeURL = get_template_directory_uri();
if (have_posts()){
 while (have_posts()) :the_post();
  $postslug = get_post_field('post_name', get_the_ID());
  //値段関連
  $price_csv = csv_return_Func($postslug,'price');
  foreach ($price_csv as $key => $value) {
    if($key < 4)continue;
    foreach ($value as $key2 => $value2) {
      if($key2 == 0)continue;
      if(!empty($value2) && $value2 !== "-"){
        $eliminatedComma=str_replace(',' ,"",$value2);
        if(empty($minPrice))$minPrice = intval($eliminatedComma);
        if($eliminatedComma < intval($minPrice))$minPrice = intval($eliminatedComma);
      }
    }
  }
  if(!empty($minPrice)){
   $minPriceNumberd = number_format($minPrice);//AT値段
  }
  $ryokinhyoHeader = $price_csv[0][1];
  $ryokinhyoHeader = str_replace(',' ,"",$ryokinhyoHeader);
  preg_match('/MT車：税込(\w+).*円UP/', $ryokinhyoHeader, $mtPricematch);
  $mtPricematch2 = preg_replace('/[^0-9]/', '', $mtPricematch[1]);
  if(!empty($mtPricematch2)){
   $mtMinPrice = $minPrice + $mtPricematch2;//MT値段
  }

  //tポイント有無
  $tpoint = get_post_meta(get_the_ID(),'school_TPOINT',true);
  if(!empty($tpoint)){
   //空じゃないとき
   $tpoint = <<< EOD
 <div class="imageBox">
   <div class="image">
     <div class="image_inner">
       <a href="{$homeURL}/tpoint">
        <img src="{$themeURL}/assets/images/common/tPointBtn.png" alt="Tポイント対象" srcset="{$themeURL}/assets/images/common/tPointBtn.png 1x , {$themeURL}/assets/images/common/tPointBtn@2x.png 2x">
       </a>
     </div><!--end image_inner-->
   </div><!--end image-->
 </div><!--end imageBox-->
EOD;
  }else{
   //空の時
    $tpoint = "";
  }

  //早割り
   $hayawari_data = '';
  // for ($i=1; $i <= 30; $i++) {
   // $hayawari_name = get_post_meta(get_the_ID(),'school_割引'.$i.'_企画名',true);
   $hayawari_flg = get_post_meta(get_the_ID(),'school_割引1_適応',true);
   if(!empty($hayawari_flg)){
    //あるとき
    $hayawari_data = <<< EOD
    <div class="imageBox">
      <div class="image">
        <div class="image_inner">
          <a href="{$homeURL}/discount_feature#hayawari_list">
            <img src="{$themeURL}/assets/images/common/hayawariBtn.png" alt="早割" srcset="{$themeURL}/assets/images/common/hayawariBtn.png 1x , {$themeURL}/assets/images/common/hayawariBtn@2x.png 2x">
          </a>
        </div><!--end image_inner-->
      </div><!--end image-->
    </div><!--end imageBox-->
EOD;
   }
  // }

  //学割
  $gakuwari_data = '';
  // for ($ii=1; $ii <= 30; $ii++) {
   // $gakuwari_name = get_post_meta(get_the_ID(),'school_割引'.$ii.'_企画名',true);
   $gakuwari_flg = get_post_meta(get_the_ID(),'school_割引2_適応',true);
   if(!empty($gakuwari_flg)){
    //あるとき
    $gakuwari_data = <<< EOD
    <div class="imageBox">
      <div class="image">
        <div class="image_inner">
          <a href="{$homeURL}/discount_feature#gakuwari_list">
            <img src="{$themeURL}/assets/images/common/gakuwariBtn.png" alt="学割" srcset="{$themeURL}/assets/images/common/gakuwariBtn.png 1x , {$themeURL}/assets/images/common/gakuwariBtn@2x.png 2x">
          </a>
        </div><!--end image_inner-->
      </div><!--end image-->
    </div><!--end imageBox-->
EOD;
   }
  // }

  //G割
  $Gwari_data = '';
  // for ($iii=1; $iii <= 30; $iii++) {
   // $Gwari_name = get_post_meta(get_the_ID(),'school_割引'.$iii.'_企画名',true);
   $Gwari_flg = get_post_meta(get_the_ID(),'school_割引3_適応',true);
   if(!empty($Gwari_flg)){
    //あるとき
    $Gwari_data = <<< EOD
    <div class="imageBox">
      <div class="image">
        <div class="image_inner">
         <a href="{$homeURL}/discount_feature#gwari_list">
           <img src="{$themeURL}/assets/images/common/gwariBtn.png" alt="G割" srcset="{$themeURL}/assets/images/common/gwariBtn.png 1x , {$themeURL}/assets/images/common/gwariBtn@2x.png 2x">
         </a>
        </div><!--end image_inner-->
      </div><!--end image-->
    </div><!--end imageBox-->
EOD;
   }
  // }

  $title = get_the_title();//タイトル
  $link = get_permalink();//詳細リンク
  $contact_link = '/contact?sec='.$title;//お問合せ
  $minPriceNumberd;//AT値段
  $mtMinPrice;//MT値段
  // $tpoint;//tpoint
  // $hayawari_data;//早割
  // $gakuwari_data;//学割
  // $Gwari_data;//G割

  $minPriceNumberd = number_format(floor((int)get_post_meta(get_the_ID(),'school_AT最低料金',true))*1.08);//料金設定
  $mtMinPrice = (floor((int)get_post_meta(get_the_ID(),'school_MT料金UP',true)) * 1.08) + (floor((int)get_post_meta(get_the_ID(),'school_AT最低料金',true))*1.08);//料金設定
  $mtMinPrice = number_format($mtMinPrice);//料金設定

  $result .= <<< EOD
  <!--start dormitory_wrap-->
  <div class="dormitory_wrap">
    <div class="dormitory_inner flex">
      <div class="dormitory_co1 dormitory_co box_co">
        <div class="dormitory_info dormitory_border">
          <a href="{$link}" class="dormitory_name skn_dormitory_name">{$title}</a>
          <div class="flex">
            <span class="skn_dormitory_at">普通⾞AT {$minPriceNumberd}円(税込)〜</span>
            <span class="skn_dormitory_mt">普通⾞MT {$mtMinPrice}円(税込)〜</span>
          </div>
        </div>
      </div><!--end dormitory_co-->
      <div class="dormitory_co2 dormitory_co box_co">
        <div class="sale_info flex dormitory_border">
          <div class="sale_A">
            {$tpoint}
          </div>
          <div class="sale_B">
            {$hayawari_data}
          </div>
          <div class="sale_C">
            {$gakuwari_data}
          </div>
          <div class="sale_D">
            {$Gwari_data}
          </div>
        </div>
      </div><!--end dormitory_co-->
      <div class="dormitory_co3 dormitory_co box_co">
        <div class="dormitory_btns">
          <div class="dormitory_btnA">
            <a href="{$link}" class="btn skn_orange_rivers dblArrow_right">学校詳細</a>
          </div>
          <div class="dormitory_btnB">
            <a href="{$contact_link}" class="btn skn_blue_rivers dblArrow_right">問い合わせ</a>
          </div>
        </div>
      </div><!--end dormitory_co-->
    </div><!--end dormitory_inner-->
  </div><!--end dormitory_wrap-->
EOD;

 endwhile;
}

$ret_block = '<span>該当の教習所は見つかりませんでした。</span>';
if(!empty($result)){
 $termname = get_term_by('slug', $area, 'school_cat');
 $ret_block = <<<EOM
 <div class="dormiory_block">
   <div class="dormiory_inner_row1 dormiory_row box_row">
     <!--start prefecture_wrap-->
     <div class="prefecture_wrap">
       <div class="prefecture_inner flex">
         <div class="prefecture_co2 prefecture_co box_co">
           {$result}
         </div><!--end prefecture_co-->
       </div><!--end prefecture_inner-->
     </div><!--end prefecture_wrap-->
   </div><!--end dormiory_row-->
 </div><!--end dormiory_block-->
EOM;
}
echo $ret_block;
?>
</div>
</section>
<?php echo do_shortcode('[takusan_block]');?>

        </div>

        <?php echo do_shortcode('[sidebar]'); ?>
    </div><!--contentsWrapper-->

  </div><!--#mainContents-->
</div><!--#wholeContents-->

<?php
get_footer();
