<?php
/*
Template Name: クイック検索結果用
*/
?>
<?php get_header(); ?>

<?php
$taxonomy = 'school_cat';
global $post;
$old_post = $post;
/**エリアデータ*/
$area_data = $_POST["area_data"] ;
$area_data_array = get_term_by( 'slug', $area_data, $taxonomy );

/**免許データ*/
$menkyo_data = $_POST["menkyo_data"] ;

/**こだわりデータ*/
$terms_arr = NULL;
$kodawari_html = '';
if (isset($_POST['kodawari_data']) && is_array($_POST['kodawari_data'])) {
  $terms_arr = array();
  foreach( $_POST['kodawari_data'] as $value ){
      array_push($terms_arr, $value);
      $kodawari_data = get_term_by( 'slug', $value, $taxonomy );
      $kodawari_html .= '<div><span>'.$kodawari_data->name.'</span></div>';
  }
}

/**条件*/
$area_ar = NULL;
if(!empty($area_data)){
 $area_ar = array(
   'taxonomy' => $taxonomy, /* 指定したい投稿タイプが持つタクソノミーを指定 */
   'field' => 'slug',
   'terms' => $area_data, /* 都道府県を指定 */
 );
}

$kodawari_ar = NULL;
if(!empty($terms_arr)){
 $kodawari_ar = array(
   'taxonomy' => $taxonomy, /* 指定したい投稿タイプが持つタクソノミーを指定 */
   'field' => 'slug',
   'terms' => $terms_arr, /* こだわりを指定 */
   'operator'=>'AND',
 );
}

$args2 = array(
  'post_type' => array('school'), /* 投稿タイプを指定 */
  'order' => 'DESC',  // カスタム投稿タイプ名
  'orderby' => 'date',
  'post_status' => 'publish',
  'tax_query' => array(
  'relation' => 'AND',
    $area_ar,
    $kodawari_ar,
  ),
'posts_per_page' => -1
);
$the_query = new WP_Query($args2);

$themeURL = get_template_directory_uri();
$result = '';
if ( $the_query->have_posts() ) :
 while ( $the_query->have_posts() ) : $the_query->the_post();
  if(!empty($menkyo_data)){
   /**免許指定ある時*/
   for ($i=1; $i <= 25; $i++) {
    $menkyo_i = get_post_meta(get_the_ID(),'school_対応免許'.$i,true);
    if($menkyo_i == $menkyo_data){

     //tポイント有無
     $tpoint = get_post_meta(get_the_ID(),'school_TPOINT',true);
     if(!empty($tpoint)){

      //空じゃないとき
      $tpoint = '
      <div class="imageBox">
       <div class="image">
        <div class="image_inner">
         <a href="'.$homeURL.'/tpoint">
          <img src="'.$themeURL.'/assets/images/common/tPointBtn.png" alt="Tポイント対象" srcset="'.$themeURL.'/assets/images/common/tPointBtn.png 1x , '.$themeURL.'/assets/images/common/tPointBtn@2x.png 2x">
         </a>
        </div><!--end image_inner-->
       </div><!--end image-->
      </div><!--end imageBox-->
      ';
     }else{
      //空の時
       $tpoint = "";
     }

     //早割り
     $hayawari_data = '';
     $hayawari_flg = get_post_meta(get_the_ID(),'school_割引1_適応',true);
     if($hayawari_flg == '●'){
      //あるとき
      $hayawari_data = '
      <div class="imageBox">
       <div class="image">
        <div class="image_inner">
         <a href="'.$homeURL.'/discount_feature#hayawari_list">
          <img src="'.$themeURL.'/assets/images/common/hayawariBtn.png" alt="早割" srcset="'.$themeURL.'/assets/images/common/hayawariBtn.png 1x , '.$themeURL.'/assets/images/common/hayawariBtn@2x.png 2x">
         </a>
        </div><!--end image_inner-->
       </div><!--end image-->
      </div><!--end imageBox-->
      ';
     }

     //学割
     $gakuwari_data = '';
     $gakuwari_flg = get_post_meta(get_the_ID(),'school_割引2_適応',true);
     if($gakuwari_flg == '●'){
      //あるとき
      $gakuwari_data = '
      <div class="imageBox">
       <div class="image">
        <div class="image_inner">
         <a href="'.$homeURL.'/discount_feature#gakuwari_list">
          <img src="'.$themeURL.'/assets/images/common/gakuwariBtn.png" alt="学割" srcset="'.$themeURL.'/assets/images/common/gakuwariBtn.png 1x , '.$themeURL.'/assets/images/common/gakuwariBtn@2x.png 2x">
         </a>
        </div><!--end image_inner-->
       </div><!--end image-->
      </div><!--end imageBox-->
      ';
     }

     //G割
     $Gwari_data = '';
     $Gwari_flg = get_post_meta(get_the_ID(),'school_割引3_適応',true);
     if($Gwari_flg == '●'){
      //あるとき
      $Gwari_data = '
      <div class="imageBox">
       <div class="image">
        <div class="image_inner">
         <a href="'.$homeURL.'/discount_feature#gwari_list">
          <img src="'.$themeURL.'/assets/images/common/gwariBtn.png" alt="G割" srcset="'.$themeURL.'/assets/images/common/gwariBtn.png 1x , '.$themeURL.'/assets/images/common/gwariBtn@2x.png 2x">
         </a>
        </div><!--end image_inner-->
       </div><!--end image-->
      </div><!--end imageBox-->
      ';
     }

     $title = get_the_title();//タイトル
     $link = get_permalink();//詳細リンク
     $contact_link = '/contact?sec='.$title;//お問合せ

     $minPriceNumberdwoTax = (int)get_post_meta(get_the_ID(),'school_AT最低料金',true);
     $minPriceNumberd = number_format(floor($minPriceNumberdwoTax*1.08));//料金設定


     $mtMinPricewoTax = (int)get_post_meta(get_the_ID(),'school_MT料金UP',true) + (int)get_post_meta(get_the_ID(),'school_AT最低料金',true);//料金設定
     $mtMinPrice = number_format(floor($mtMinPricewoTax)*1.08);//料金設定

     //静岡県セイブ自動車学校だけ例外処理
     if($title == "静岡県セイブ自動車学校"){
           $minPriceNumberd = number_format((floor($minPriceNumberdwoTax*1.08 / 10000 * 1000))*10);
           $mtMinPrice = number_format((floor($mtMinPricewoTax*1.08 / 10000 * 1000))*10);
     }


     $result .= '
     <!--start dormitory_wrap-->
     <div class="dormitory_wrap">
       <div class="dormitory_inner flex">
         <div class="dormitory_co1 dormitory_co box_co">
           <div class="dormitory_info dormitory_border">
             <a href="'.$link.'" class="dormitory_name skn_dormitory_name">'.$title.'</a>
             <div class="flex">
               <span class="skn_dormitory_at">普通⾞AT '.$minPriceNumberd.'円<span class="taxLabel">(税込)</span>〜</span>
               <span class="skn_dormitory_mt">普通⾞MT '.$mtMinPrice.'円<span class="taxLabel">(税込)</span>〜</span>
             </div>
           </div>
         </div><!--end dormitory_co-->
         <div class="dormitory_co2 dormitory_co box_co">
           <div class="sale_info flex dormitory_border">
             <div class="sale_A">
               '.$tpoint.'
             </div>
             <div class="sale_B">
               '.$hayawari_data.'
             </div>
             <div class="sale_C">
               '.$gakuwari_data.'
             </div>
             <div class="sale_D">
               '.$Gwari_data.'
             </div>
           </div>
         </div><!--end dormitory_co-->
         <div class="dormitory_co3 dormitory_co box_co">
           <div class="dormitory_btns">
             <div class="dormitory_btnA">
               <a href="'.$link.'" class="btn skn_orange_rivers dblArrow_right">学校詳細</a>
             </div>
             <div class="dormitory_btnB">
               <a href="'.$contact_link.'" class="btn skn_blue_rivers dblArrow_right">問い合わせ</a>
             </div>
           </div>
         </div><!--end dormitory_co-->
       </div><!--end dormitory_inner-->
     </div><!--end dormitory_wrap-->
     ';
     $break;
    }
   }
  }else{
   /**免許指定ないとき*/
   //tポイント有無
   $tpoint = get_post_meta(get_the_ID(),'school_TPOINT',true);
   if(!empty($tpoint)){

    //空じゃないとき
    $tpoint = '
    <div class="imageBox">
     <div class="image">
      <div class="image_inner">
       <a href="'.$homeURL.'/tpoint">
        <img src="'.$themeURL.'/assets/images/common/tPointBtn.png" alt="Tポイント対象" srcset="'.$themeURL.'/assets/images/common/tPointBtn.png 1x , '.$themeURL.'/assets/images/common/tPointBtn@2x.png 2x">
       </a>
      </div><!--end image_inner-->
     </div><!--end image-->
    </div><!--end imageBox-->
    ';
   }else{
    //空の時
     $tpoint = "";
   }

   //早割り
   $hayawari_data = '';
   $hayawari_flg = get_post_meta(get_the_ID(),'school_割引1_適応',true);
   if($hayawari_flg == '●'){
    //あるとき
    $hayawari_data = '
    <div class="imageBox">
     <div class="image">
      <div class="image_inner">
       <a href="'.$homeURL.'/discount_feature#hayawari_list">
        <img src="'.$themeURL.'/assets/images/common/hayawariBtn.png" alt="早割" srcset="'.$themeURL.'/assets/images/common/hayawariBtn.png 1x , '.$themeURL.'/assets/images/common/hayawariBtn@2x.png 2x">
       </a>
      </div><!--end image_inner-->
     </div><!--end image-->
    </div><!--end imageBox-->
    ';
   }

   //学割
   $gakuwari_data = '';
   $gakuwari_flg = get_post_meta(get_the_ID(),'school_割引2_適応',true);
   if($gakuwari_flg == '●'){
    //あるとき
    $gakuwari_data = '
    <div class="imageBox">
     <div class="image">
      <div class="image_inner">
       <a href="'.$homeURL.'/discount_feature#gakuwari_list">
        <img src="'.$themeURL.'/assets/images/common/gakuwariBtn.png" alt="学割" srcset="'.$themeURL.'/assets/images/common/gakuwariBtn.png 1x , '.$themeURL.'/assets/images/common/gakuwariBtn@2x.png 2x">
       </a>
      </div><!--end image_inner-->
     </div><!--end image-->
    </div><!--end imageBox-->
    ';
   }

   //G割
   $Gwari_data = '';
   $Gwari_flg = get_post_meta(get_the_ID(),'school_割引3_適応',true);
   if($Gwari_flg == '●'){
    //あるとき
    $Gwari_data = '
    <div class="imageBox">
     <div class="image">
      <div class="image_inner">
       <a href="'.$homeURL.'/discount_feature#gwari_list">
        <img src="'.$themeURL.'/assets/images/common/gwariBtn.png" alt="G割" srcset="'.$themeURL.'/assets/images/common/gwariBtn.png 1x , '.$themeURL.'/assets/images/common/gwariBtn@2x.png 2x">
       </a>
      </div><!--end image_inner-->
     </div><!--end image-->
    </div><!--end imageBox-->
    ';
   }

   $title = get_the_title();//タイトル
   $link = get_permalink();//詳細リンク
   $contact_link = '/contact?sec='.$title;//お問合せ

   $minPriceNumberdwoTax = (int)get_post_meta(get_the_ID(),'school_AT最低料金',true);
   $minPriceNumberd = number_format(floor($minPriceNumberdwoTax*1.08));//料金設定


   $mtMinPricewoTax = (int)get_post_meta(get_the_ID(),'school_MT料金UP',true) + (int)get_post_meta(get_the_ID(),'school_AT最低料金',true);//料金設定
   $mtMinPrice = number_format(floor($mtMinPricewoTax)*1.08);//料金設定

   //静岡県セイブ自動車学校だけ例外処理
   if($title == "静岡県セイブ自動車学校"){
         $minPriceNumberd = number_format((floor($minPriceNumberdwoTax*1.08 / 10000 * 1000))*10);
         $mtMinPrice = number_format((floor($mtMinPricewoTax*1.08 / 10000 * 1000))*10);
   }
   $result .= '
   <!--start dormitory_wrap-->
   <div class="dormitory_wrap">
     <div class="dormitory_inner flex">
       <div class="dormitory_co1 dormitory_co box_co">
         <div class="dormitory_info dormitory_border">
           <a href="'.$link.'" class="dormitory_name skn_dormitory_name">'.$title.'</a>
           <div class="flex">
             <span class="skn_dormitory_at">普通⾞AT '.$minPriceNumberd.'円<span class="taxLabel">(税込)</span>〜</span>
             <span class="skn_dormitory_mt">普通⾞MT '.$mtMinPrice.'円<span class="taxLabel">(税込)</span>〜</span>
           </div>
         </div>
       </div><!--end dormitory_co-->
       <div class="dormitory_co2 dormitory_co box_co">
         <div class="sale_info flex dormitory_border">
           <div class="sale_A">
             '.$tpoint.'
           </div>
           <div class="sale_B">
             '.$hayawari_data.'
           </div>
           <div class="sale_C">
             '.$gakuwari_data.'
           </div>
           <div class="sale_D">
             '.$Gwari_data.'
           </div>
         </div>
       </div><!--end dormitory_co-->
       <div class="dormitory_co3 dormitory_co box_co">
         <div class="dormitory_btns">
           <div class="dormitory_btnA">
             <a href="'.$link.'" class="btn skn_orange_rivers dblArrow_right">学校詳細</a>
           </div>
           <div class="dormitory_btnB">
             <a href="'.$contact_link.'" class="btn skn_blue_rivers dblArrow_right">問い合わせ</a>
           </div>
         </div>
       </div><!--end dormitory_co-->
     </div><!--end dormitory_inner-->
   </div><!--end dormitory_wrap-->
   ';
  }
 endwhile;
endif;


$ret_block = '';
if(!empty($result)){
 $ret_block = '
 <div class="dormiory_block">
  <div class="dormiory_row1 dormiory_row box_row">
  <!--start prefecture_wrap-->
   <div class="prefecture_wrap">
    <div class="prefecture_inner flex">
     <div class="prefecture_co2 prefecture_co box_co">
      '.$result.'
    </div><!--end prefecture_co-->
    </div><!--end prefecture_inner-->
   </div><!--end prefecture_wrap-->
  </div><!--end dormiory_row-->
 </div><!--end dormiory_block-->
 ';
}else{
 $ret_block = '
 <div class="dormiory_block">
  <div class="dormiory_row1 dormiory_row box_row">
  <!--start prefecture_wrap-->
   <div class="prefecture_wrap">
    <div class="prefecture_inner flex">
     <div class="prefecture_co2 prefecture_co box_co">
      <span>該当の教習所は見つかりませんでした。</span>
    </div><!--end prefecture_co-->
    </div><!--end prefecture_inner-->
   </div><!--end prefecture_wrap-->
  </div><!--end dormiory_row-->
 </div><!--end dormiory_block-->
 ';
}


?>
<div id="wholeContents" class="wholeContents page-php" role="main">
  <div id="mainContents" class="mainContents">
    <div id="contentsWrapper" class="contentsWrapper maxWidth flex fWrap_wrap twoColumn RefineList">
      <!--main-->
        <div id="main" class="mainContent">
          <div class="quickSerch_value">
            <div class="quickSerchValue_row">
              <span class="quick_label">エリア：</span><span class="quick_value"><?php if(!empty($area_data_array->name)){ echo $area_data_array->name; }else{ echo "指定なし"; } ?></span>
            </div>
            <div class="quickSerchValue_row">
              <span class="quick_label">免許：</span><span class="quick_value"><?php if(!empty($menkyo_data)){ echo $menkyo_data; }else{ echo "指定なし"; } ?></span>
            </div>
            <div class="quickSerchValue_row">
              <span class="quick_label">こだわり：</span><span class="quick_value"><?php if(!empty($kodawari_html)){ echo $kodawari_html; }else{ echo "指定なし"; } ?></span>
            </div>
          </div>
          <?php $post = $old_post; ?>
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
                 <?php the_title(); ?>
                </h2>
              </div>
              <div id='top_area'>
                <div class="descText"><p><?php echo $text_top; ?></p></div>
              </div>
              <?php echo $ret_block; ?>
              </div><!--end secInner-->
            </section><!--end dormitory_list_section-->

          <?php echo do_shortcode('[takusan_block]');
          ?>
        </div>
        <?php echo do_shortcode('[sidebar]'); ?>
    </div><!--contentsWrapper-->

  </div><!--#mainContents-->
</div><!--#wholeContents-->

<?php get_footer(); ?>
