<?php

$meta_key = NULL;
$meta_key = $_GET['key'];

if (empty($meta_key)) {
    header('HTTP/1.0 404 Not Found');
    include(TEMPLATEPATH.'/404.php');
    exit;
}

$get = $_GET;
if ($get['page'] == NULL) {
  $get['page'] = 1;
}

$news_data_array = get_posts_list($post_type="school", $orderby = "post_date", $ter = $meta_key, $flag1 = 0);
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
  // 12件出してるから12
  $news_data = array_chunk($news_data_array, 10);
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


  $page_html = get_posts_pagenation($sou_page=$all_page, $gen_page=$current_page, $sento="«", $saikoubi="»", $page_option="school/?key=".$meta_key."&");
}
?>

<?php get_header(); ?>


<?php // 投稿をカスタムフィールドの値でソートする
$custom_field_value = '"'.$meta_key.'"';// フィールド値の指定
$now_page = get_query_var('page' , 1);
$offset = ( $now_page - 1 ) * 10;
$paged = get_query_var('paged') ? get_query_var('paged') : 1 ;
$args = array(
  'paged' => $paged,
  'offset' => $offset,
  'post_type' => 'school', // 投稿タイプを指定
  'posts_per_page' => '10', // 表示件数を指定
  'meta_query' => array( // カスタムフィールドを指定
    'relation' => 'OR',
    array(
      'key' => 'waribiki', // フィールド名の指定
      'value' => $custom_field_value, // 値の指定
      'compare' => 'LIKE', // フィールド値の部分一致
    ),
    array(
      'key' => 'course', // フィールド名の指定
      'value' => $custom_field_value, // 値の指定
      'compare' => 'LIKE', // フィールド値の部分一致
    ),
    array(
      'key' => 'mennkyo', // フィールド名の指定
      'value' => $custom_field_value, // 値の指定
      'compare' => 'LIKE', // フィールド値の部分一致
    )
  )
);
$the_query = new WP_Query($args);
if($the_query->have_posts()):
  while ($the_query->have_posts()): $the_query->the_post();
?>
<!-- 一覧 -->
<a href="<?php the_permalink(); ?>"><?php echo get_the_title(); ?></a>
<?php 
//フィールド確認用デバッグ
// $custom_fields = get_post_custom($post_id); 
// echo "<pre>";
// var_dump($custom_fields);
// echo "</pre>";
 ?>

<?php 
  endwhile;
wp_reset_postdata();
else:
?>
<!-- 投稿が無い場合の処理 -->
<div><p>教習所は見つかりませんでした。</p></div>
<?php endif; ?>

<div class="pagination textCenterCm">
<?php if(count($news_data_array) >= 11){echo $page_html;} ?>
</div>
<?php

get_footer();