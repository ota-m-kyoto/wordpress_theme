<?php
$category = get_the_category();
$cat_id   = $category[0]->cat_ID;
$cat_name = $category[0]->cat_name;
$cat_slug = $category[0]->category_nicename;


$slug_name = basename(get_permalink());

$spot_csv = csv_return_Func($slug_name,'spot');
$hotel_csv = csv_return_Func($slug_name,'hotel');
$price_csv = csv_return_Func($slug_name,'price');
$campaign_csv = csv_return_Func($slug_name,'campaign');
$school_data_csv = csv_return_Func($slug_name,'school_data');

$filepath = get_stylesheet_directory().'/school/'.$slug_name;

$title = get_the_title();
// $getid=get_the_ID();
$terms = get_the_terms($post->ID,'school_cat');
foreach($terms as $term){
  $t = $term->name;
  if(strpos($t,'道') !== false || strpos($t,'府') !== false || strpos($t,'都') !== false || strpos($t,'県') !== false){
    $area = $term->name;
  }
}
 ?>

<?php get_header(''); ?>

<!--page-->

<div id="wholeContents" class="wholeContents single-school" role="main">
  <div id="mainContents" class="mainContents">
    <div id="contentsWrapper" class="contentsWrapper maxWidth flex fWrap_wrap twoColumn">

      <!--main-->
      <div id="main" class="mainContent">
       <div class="pageTitleA">
         <p class="shiteiIinkai">
          <span>
            <?php echo $area; ?>公安委員会指定
          </span>
        </p>
         <h2 class="titleText flex">
          <div class="imageBox">
            <div class="image">
              <div class="image_inner">
                <img src="<?php echo get_template_directory_uri()?>/assets/icomoon/doubleCircle.svg" alt="">
              </div><!--end image_inner-->
            </div><!--end image-->
          </div><!--end imageBox-->
          <?php echo $title; ?>のご紹介</h2>
          <a class="favlistAdd btn skn_orange" data-school-id="<?php echo get_the_ID(); ?>" data-favtext-add="お気に入りへ追加" data-favtext-remove="お気に入りから外す"></a>
       </div>
       <?php echo do_shortcode('[mainbtn '.$slug_name.']'); ?>

        <?php
        $page_kind = $_GET['id'];
        if($page_kind == 'info5'){//お客様の声
         include locate_template('my_parts/single_info5.php');
        }else if($page_kind == 'info4'){//周辺施設
         include locate_template('my_parts/single_info4.php');
        }else if($page_kind == 'info3'){//宿泊　スポット　声
         include locate_template('my_parts/single_info3.php');
        }else if($page_kind == 'info2'){//料金　おとく　キャンペン　保証　カレンダ
         include locate_template('my_parts/single_info2.php');
        }else{//概要　設備　様子　アクセス
         include locate_template('my_parts/single_info1.php');
        }
         ?>
         <div class="detailMenu"><span>詳細情報メニュー</span></div>
         <?php echo do_shortcode('[mainbtn '.$slug_name.']');//詳細情報メニュー ?>
      </div>
      <?php echo do_shortcode('[sidebar]'); ?>
  </div><!--contentsWrapper-->
  </div><!--#mainContents-->
</div><!--#wholeContents-->


<?php get_footer(); ?>
