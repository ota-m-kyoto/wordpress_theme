<?php get_header(); ?>
<!--page-->
<link rel="stylesheet" id="each-page" href="/wp-content/themes/nanairo/assets/page/school_cat.css" type="text/css" media="">

<div id="wholeContents" class="wholeContents twoColumnpage single-school" role="main">
  <div id="mainContents" class="mainContents">
    <div id="contentsWrapper" class="contentsWrapper maxWidth flex fWrap_wrap twoColumn">

      <!--main-->
      <div id="main" class="mainContent">
        <div class="mainWrapper">
          <div class="listMapWrapper">
            <p class="image">
              <img src="<?php echo get_bloginfo($show = 'siteurl'); ?>/wp-content/uploads/2018/03/search_map_bg.png" alt="
              運転免許Happy" class="imgRes">
            </p>
          </div>

 
<div class="listMapButton flex fWrap_wrap">
<div class="vc_btn3-container  areaBtn tohoku vc_btn3-center">
  <a style="background-color:#82a0de; color:#ffffff;" class="vc_general vc_btn3 vc_btn3-size-md vc_btn3-shape-square vc_btn3-style-custom vc_btn3-block" href="https://www.happymenkyo.com/school_cat/tohoku_area/" title="">東北</a></div>
<div class="vc_btn3-container  areaBtn kanto vc_btn3-center">
  <a style="background-color:#a2d04b; color:#ffffff;" class="vc_general vc_btn3 vc_btn3-size-md vc_btn3-shape-square vc_btn3-style-custom vc_btn3-block" href="https://www.happymenkyo.com/school_cat/kanto_area/" title="">関東</a></div>
<div class="vc_btn3-container  areaBtn koshinetsu vc_btn3-center">
  <a style="background-color:#ec9b9a; color:#ffffff;" class="vc_general vc_btn3 vc_btn3-size-md vc_btn3-shape-square vc_btn3-style-custom vc_btn3-block" href="https://www.happymenkyo.com/school_cat/koushinetsu_area/" title="">甲信越</a></div>
<div class="vc_btn3-container  areaBtn hokuriku vc_btn3-center">
  <a style="background-color:#d9ce1f; color:#ffffff;" class="vc_general vc_btn3 vc_btn3-size-md vc_btn3-shape-square vc_btn3-style-custom vc_btn3-block" href="https://www.happymenkyo.com/school_cat/hokuriku_area/" title="">北陸</a></div>
<div class="vc_btn3-container  areaBtn tokai vc_btn3-center">
  <a style="background-color:#f1a538; color:#ffffff;" class="vc_general vc_btn3 vc_btn3-size-md vc_btn3-shape-square vc_btn3-style-custom vc_btn3-block" href="https://www.happymenkyo.com/school_cat/toukai_area/" title="">東海</a></div>
<div class="vc_btn3-container  areaBtn kansai vc_btn3-center">
  <a style="background-color:#4f91ff; color:#ffffff;" class="vc_general vc_btn3 vc_btn3-size-md vc_btn3-shape-square vc_btn3-style-custom vc_btn3-block" href="https://www.happymenkyo.com/school_cat/kansai_area/" title="">関西</a></div>
<div class="vc_btn3-container  areaBtn chugoku vc_btn3-center">
  <a style="background-color:#c797d5; color:#ffffff;" class="vc_general vc_btn3 vc_btn3-size-md vc_btn3-shape-square vc_btn3-style-custom vc_btn3-block" href="https://www.happymenkyo.com/school_cat/chugoku_area/" title="">中国</a></div>
<div class="vc_btn3-container  areaBtn shikoku vc_btn3-center">
  <a style="background-color:#8a93d2; color:#ffffff;" class="vc_general vc_btn3 vc_btn3-size-md vc_btn3-shape-square vc_btn3-style-custom vc_btn3-block" href="https://www.happymenkyo.com/school_cat/shikoku_area/" title="">四国</a></div>
<div class="vc_btn3-container  areaBtn kyushu vc_btn3-center">
  <a style="background-color:#e573a9; color:#ffffff;" class="vc_general vc_btn3 vc_btn3-size-md vc_btn3-shape-square vc_btn3-style-custom vc_btn3-block" href="https://www.happymenkyo.com/school_cat/kyushu_okinawa_area/" title="">九州</a></div>
</div>


          <ul class="schoolWrapper">
        <?php

// $meta_key = NULL;
// $meta_key = $_GET['key'];

// if (empty($meta_key)) {
//     header('HTTP/1.0 404 Not Found');
//     include(TEMPLATEPATH.'/404.php');
//     exit;
// }

$get = $_GET;
if ($get['page'] == NULL) {
  $get['page'] = 1;
}

$news_data_array = get_posts_list($post_type="school", $orderby = "post_date", $ter = $term, $flag1 = 1);
$retour = NULL;
if(empty($news_data_array)){
  $retour = '<div class="no_product"><span>教習所は見つかりませんでした。</span></div>';
  if (($get['page'] > "1") || ($get['page'] < "1") || !is_numeric($get['page'])) {
    header('HTTP/1.0 404 Not Found');
    include(TEMPLATEPATH.'/404.php');
    exit;
      //$get['page'] = 1;
  }
}else{
  // 12件出してるから10
  $news_data = array_chunk($news_data_array, 100);
  $all_page = count($news_data);

  // エラー回避処理、現在のページが総ページよりも大きい場合は（get値で適当な値がきたら）
  if (($get['page'] > $all_page) || ($get['page'] < "1") || !is_numeric($get['page'])) {
    header('HTTP/1.0 404 Not Found');
    include(TEMPLATEPATH.'/404.php');
    exit;
      //$get['page'] = 1;
  }

  $current_page = $get['page'];
  $current_page_flg = $get['page'] - 1;
  $news_data = $news_data[$current_page_flg];


  $page_html = get_posts_pagenation($sou_page=$all_page, $gen_page=$current_page, $sento="«", $saikoubi="»", $page_option="school_cat/".$term."/?");
}
?>



<?php // 投稿をカスタムフィールドの値でソートする
$now_page = get_query_var('page' , 1);
$offset = ( $now_page - 1 ) * 10;
$paged = get_query_var('paged') ? get_query_var('paged') : 1 ;
$args = array(
    'post_type' => 'school', /* 投稿タイプを指定 */
    'tax_query' => array(
      'relation' => 'AND',
      array(
        'taxonomy' => 'school_cat', /* 指定したい投稿タイプが持つタクソノミーを指定 */
        'field' => 'slug',
        'terms' => $term, /* 上記で指定した変数を指定 */
      )
    ),
    'paged' => $paged,
    'offset' => $offset,
    'posts_per_page' => '100',
    'order', 'DESC'
  );
$the_query = new WP_Query($args);
if($the_query->have_posts()):
  while ($the_query->have_posts()): $the_query->the_post();
?>
  <li class="flex">
    <p class="image thumbnail">
      <img src="<?php $slug_name = get_post_field( 'post_name', get_the_ID() );
 ;echo get_stylesheet_directory_uri() . '/school/' . $slug_name . '/img/' . 'school1.jpg'; ?>" alt="<?php echo get_the_title(); ?>" class="imgRes">
    </p>
    <div class="text listSchoolContent">
      <h2 class="listSchoolName">
        <a href="<?php the_permalink(); ?>"><?php echo get_the_title(); ?></a>
      </h2>
      <?php 
          $terms = get_the_terms($post->ID,'school_cat');
          foreach($terms as $term){
            $t = $term->name;
            if(strpos($t,'道') !== false || strpos($t,'府') !== false || strpos($t,'都') !== false || strpos($t,'県') !== false){
              $area = $term->name;
            }
          }

           $mtPricematchNumberd = "";
            $mtPricematchtaxInc = ""; 
            $mtMinPrice = "";
            $atMintaxInc = "";
        $mintaxInc="";
        $minPrice="";
        $minPriceNumberd="";
        $campaign_csv = csv_return_Func($slug_name,'campaign');
        //$minPrice = $campaign_csv[0][0] . $campaign_csv[0][1];
        //$minPrice = preg_replace('/[^0-9]/', '', $minPrice);
        //if(!empty($minPrice)){
          //$minPriceNumberd = number_format($minPrice);
          //$mintaxInc = number_format($minPrice*1.08); 
        //}


        $price_csv = csv_return_Func($slug_name,'price');
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
          $minPriceNumberd = number_format($minPrice);
          $mintaxInc = number_format(floor($minPrice*1.08 / 10000 * 1000)*10);
        }

         $ryokinhyoHeader = $price_csv[0][1];


        $ryokinhyoHeader = str_replace(',' ,"",$ryokinhyoHeader);

        preg_match('/MT車：税込(\w+).*円UP/', $ryokinhyoHeader, $mtPricematch);



        $mtPricematch2 = preg_replace('/[^0-9]/', '', $mtPricematch[1]);
         if(!empty($mtPricematch2)){

          $mtMinPrice = ($minPrice + $mtPricematch2/1.08);
          $mtMintaxInc = ($mtMinPrice*1.08);


        }



        if(!empty($mtMinPrice)){
          $mtMinPriceNumberd = number_format($mtMinPrice);
          $mtmintaxIncNumberd = number_format($mtMintaxInc); 

          $mtWrapper='
           <div class="co2 right col1of2">
           <p class="Label">普通車MT</p>
           <p class="minprice">' . $mtMinPriceNumberd .'円〜</p>
           <p class="taxInc">税込' . $mtmintaxIncNumberd . '円〜</p>
           </div>';
        }
        echo'<!--' .$mtMinPrice .'  ' . $mtPricematch2. '-->';
       echo '<p class="area"><span>' . $area . '</span></p>
       <div class="minPrice">
         <div class="flex">
           <div class="co1 left col1of2">
           <p class="Label">普通車AT</p>
           <p class="minprice">' . $minPriceNumberd . '円〜</p>
           <p class="taxInc">税込' . $mintaxInc . '円〜</p>
           </div>'

           .$mtWrapper.


           '
         </div>
         <div class="moreBtn">
           <p class="btn"><a href="' . get_the_permalink() .'">この学校を見る</a></p>
         </div>
       </div>'; 

        $mtMinPriceNumberd="";
        $mtmintaxIncNumberd="";
        $mtWrapper='';
       ?>
     </div>
  </li>
  <li class="banner flex fai_center fjc_center">
    <a href="tel:0120677663" class="onlySp pointerEventsSP" onclick="ga('send', 'event', 'click', 'tel-tap');">今すぐお電話で<br />お問い合わせ！
    </a>
    <a href="/contact/" class=""  onclick="ga('send', 'event', 'click', 'contact-click');">
      今すぐメールで<br />お問い合わせ！
    </a>
  </li>
  <?php 
    endwhile;
  wp_reset_postdata();
  else:
  ?>
  <!-- 投稿が無い場合の処理 -->
  <div class="noSchool">
     <p>教習所は見つかりませんでした。</p>
  </div>
  <?php endif; ?>
          </ul>

  <!-- <div class="pagination textCenter"> -->
  <?php //if(count($news_data_array) >= 11){echo $page_html;} ?>
  <!-- </div> -->


      </div><!--/.mainWrapper-->
        </div><!--/#main-->



        <?php echo do_shortcode('[sidebar]'); ?>
 
      </div><!--contentsWrapper-->
    </div><!--/#mainContents-->
  </div><!--/#wholeContents-->






<?php

get_footer();