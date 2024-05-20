<?php

?>



<?php
get_header(); ?>

<div id="wholeContents" class="wholeContents page-php" role="main">
    <div id="mainContents" class="mainContents">

      

  <table border="1">
    <tbody>
    <tr>
      <td rowspan="2">都道府県</td>
      <td rowspan="2">学校名</td>
      <td colspan="4">宿泊プラン</td>
      <td colspan="2">ホテル</td>
      <td rowspan="2">高速教習</td>
    </tr>
    <tr>
      <td><img src="/wp-content/uploads/2018/01/icon_regular.png" alt="宿泊プランレギュラー"></td>
      <td><img src="/wp-content/uploads/2018/01/icon_triple.png" alt="宿泊プラントリプル"></td>
      <td><img src="/wp-content/uploads/2018/01/icon_twin.png" alt="宿泊プランツイン"></td>
      <td><img src="/wp-content/uploads/2018/01/icon_single.png" alt="宿泊プランシングル"></td>
      <td><img src="/wp-content/uploads/2018/01/icon_twin02.png" alt="ホテルツイン"></td>
      <td><img src="/wp-content/uploads/2018/01/icon_single02.png" alt="ホテルシングル"></td>
    </tr>

<?php
            $type = get_query_var( 'school_cat' ); //指定したいタクソノミーを指定
            $args = array(
                'post_type' => array('school'), /* 投稿タイプを指定 */
                'tax_query' => array(
                    'relation' => 'OR',
                    array(
                        'taxonomy' => 'school_cat', /* 指定したい投稿タイプが持つタクソノミーを指定 */
                        'field' => 'slug',
                        'terms' => $type, /* 上記で指定した変数を指定 */
                    ),
                ),
                //'paged' => $paged,
                'posts_per_page' => '-1'
            ); ?>
            <?php query_posts( $args ); ?>
            <?php if (have_posts()) : ?>
            <?php while (have_posts()) : the_post(); /* ループ開始 */ ?>
            <?php
              $product_terms = wp_get_object_terms($post->ID, 'school_cat');
              $area = "";
              if(!empty($product_terms)){
                if(!is_wp_error($product_terms)){
                  foreach($product_terms as $term){
                    $t = $term->name;
                    if(strpos($t,'道') !== false || strpos($t,'府') !== false || strpos($t,'都') !== false || strpos($t,'県') !== false){
                      $area = $term->name;
                    }
                  }
                }
              }
             ?>
            <?php 
              //アイコン出力
              $field = get_field_object('stay_plan');
              $stay_plan = $field['value'];
              $plan_icon = "";
              if( $stay_plan ){
                foreach( $stay_plan as $stay_plan ){
                  if($field['choices'][ $stay_plan ] != "" || $field['choices'][ $stay_plan ] != NULL){
                    if($field['choices'][ $stay_plan ] == "高速教習実車走行"){
                      $plan_icon .= '<td><img src="/wp-content/uploads/2018/01/icon_car_jisshu.png" alt="高速教習実車走行"></td>';
                    }elseif($field['choices'][ $stay_plan ] == "高速教習シミュレーター"){
                      $plan_icon .= '<td><img src="/wp-content/uploads/2018/01/icon_single02-08.png" alt="高速教習実車走行"></td>';
                    }else{
                      $plan_icon .= "<td>●</td>";
                    }
                  }else{
                    $plan_icon .= "<td></td>";
                  }
                }
              }
            ?>

            <tr>
              <td><?php echo $area; ?></td>
              <td><?php the_title(); ?></td>
              <?php echo $plan_icon; ?>
            </tr>
            <?php endwhile; else: ?>
            <p><?php echo "お探しの記事、ページは見つかりませんでした。"; ?></p>
            <?php endif; ?>
    </tbody>
  </table>



    </div><!--#mainContents-->
</div><!--#wholeContents-->
<div id="side">
  <?php dynamic_sidebar('nihon-sidebar');?>
</div>
<?php get_footer(); ?>
