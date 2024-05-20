<?php
//西日本4件表示
// [top_nisinihon_get]
function top_nisinihon_get_Func() {

  //
  $customPostArg = array(
    'posts_per_page' => 4,
    'post_status' => 'publish',
    'post_type'      => 'school',  // カスタム投稿タイプ名
    'order'      => 'DESC',
    'tax_query'      => array(
      array(
        'taxonomy' => 'school_cat',  // カスタムタクソノミー名
        'field'    => 'slug',  // ターム名を term_id,slug,name のどれで指定するか
        'terms'    => 'west_starting' // タクソノミーに属するターム名
      )
    )
  );
  global $post;
  $myposts = get_posts($customPostArg);
  $top_nisinihon_get.= '<div class="nisinihon">';
  foreach($myposts as $post) :
  setup_postdata($post);
  // アイキャッチ画像のIDを取得
  $thumbnail_id = get_post_thumbnail_id();
  $thumb_post = get_post($thumbnail_id);
  // mediumサイズの画像内容を取得（引数にmediumをセット）
  if (has_post_thumbnail() )  {
    $eye_img = wp_get_attachment_image_src( $thumbnail_id ,'thumbnail-about' );
    $thumb_url=$eye_img[0];
  }
  else {
    $thumb_url ="/wp-content/uploads/2017/12/noimage-390x220.png";
  }
  //「説明」を取得
  $thumb_content = $thumb_post->post_content;
  //キャプションを取得
  $thumb_caption = $thumb_post->post_excerpt;
  //altを取得
  $post_meta = get_post_meta( $thumbnail_id );
  $thumb_alt = $post_meta['_wp_attachment_image_alt'][0];

  $title = get_the_title($myposts->ID);
  $link = get_permalink($myposts->ID);
  $price = post_custom('top_price');
  $coment = post_custom('school_comment1');
  $terms = get_the_terms($myposts->ID ,'school_cat');
  $cat = "";
  foreach ($terms as $term) :
    $t = $term->name;
    if(strpos($t,'道') !== false || strpos($t,'府') !== false || strpos($t,'都') !== false || strpos($t,'県') !== false){
      $cat = $term->name;
    }
  endforeach;
  $num += 1;
  $top_nisinihon_get.= '
  <div class="co'.$num.'">
    <div class="image_block">
      <img src="'.$thumb_url.'" alt="'.$thumb_alt.'">
      <p class="area">'.$cat.'</p>
      <p class="title">'.$title.'</p>
    </div>
    <div class="info_block">
      <p class="coment">'.$coment.'</p>
      <p class="price">'.$price.'</p>
    </div>
    <div class="btn">
      <a href="'.$link.'"><p>学校をチェックする</p></a>
    </div>
  </div>
  ';
  endforeach;
  $top_nisinihon_get .='</div>';
  wp_reset_postdata();

  return $top_nisinihon_get;
}
add_shortcode("top_nisinihon_get", "top_nisinihon_get_Func");


//東日本4件表示
// [top_higasinihon_get]
function top_higasinihon_get_Func() {

  //
  $customPostArg = array(
    'posts_per_page' => 4,
    'post_status' => 'publish',
    'post_type'      => 'school',  // カスタム投稿タイプ名
    'order'      => 'DESC',
    'tax_query'      => array(
      array(
        'taxonomy' => 'school_cat',  // カスタムタクソノミー名
        'field'    => 'slug',  // ターム名を term_id,slug,name のどれで指定するか
        'terms'    => 'east_starting' // タクソノミーに属するターム名
      )
    )
  );
  global $post;
  $myposts = get_posts($customPostArg);
  $top_higasinihon_get.= '<div class="higasinihon">';
  foreach($myposts as $post) :
  setup_postdata($post);
  // アイキャッチ画像のIDを取得
  $thumbnail_id = get_post_thumbnail_id();
  $thumb_post = get_post($thumbnail_id);
  // mediumサイズの画像内容を取得（引数にmediumをセット）
  if (has_post_thumbnail() )  {
    $eye_img = wp_get_attachment_image_src( $thumbnail_id ,'thumbnail-about' );
    $thumb_url=$eye_img[0];
  }
  else {
    $thumb_url ="/wp-content/uploads/2017/12/noimage-390x220.png";
  }
  //「説明」を取得
  $thumb_content = $thumb_post->post_content;
  //キャプションを取得
  $thumb_caption = $thumb_post->post_excerpt;
  //altを取得
  $post_meta = get_post_meta( $thumbnail_id );
  $thumb_alt = $post_meta['_wp_attachment_image_alt'][0];

  $title = get_the_title($myposts->ID);
  $link = get_permalink($myposts->ID);
  $price = post_custom('top_price');
  $coment = post_custom('school_comment1');
  $terms = get_the_terms($myposts->ID ,'school_cat');
  $cat = "";
  foreach ($terms as $term) :
    $t = $term->name;
    if(strpos($t,'道') !== false || strpos($t,'府') !== false || strpos($t,'都') !== false || strpos($t,'県') !== false){
      $cat = $term->name;
    }
  endforeach;
  $num += 1;
  $top_higasinihon_get.= '
  <div class="co'.$num.'">
    <div class="image_block">
      <img src="'.$thumb_url.'" alt="'.$thumb_alt.'">
      <p class="area">'.$cat.'</p>
      <p class="title">'.$title.'</p>
    </div>
    <div class="info_block">
      <p class="coment">'.$coment.'</p>
      <p class="price">'.$price.'</p>
    </div>
    <div class="btn">
      <a href="'.$link.'"><p>学校をチェックする</p></a>
    </div>
  </div>
  ';
  endforeach;
  $top_higasinihon_get .='</div>';
  wp_reset_postdata();

  return $top_higasinihon_get;
}
add_shortcode("top_higasinihon_get", "top_higasinihon_get_Func");
