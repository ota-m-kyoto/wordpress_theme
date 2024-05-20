<?php
/*
Template Name: 資格表
*/
?>
<?php get_header(); ?>

<!--page-->
<div id="wholeContents" class="wholeContents page-php" role="main">
	<div id="mainContents" class="mainContents">
		<div id="pageTitle" class="pageTitle">
			<h1>
				<?php //blogのTOPもしくは固定ページのTOPでなければサイトのタイトルが表示
					if ( !is_home() && !is_front_page() ) {
						//bloginfo( 'name' );
						the_title();
					}
					?>
			</h1>
		</div><!--=#pageTitle-->





		<div id="contentsWrapper" class="contentsWrapper">
			<!--sidebar-->
			<div id="sidebar">
				<?php
				if (is_page()) {
					$parent_id = $post->post_parent; // 親ページのIDを取得
					$parent_slug = get_post($parent_id)->post_name; // 親ページのスラッグを取得
					}
					dynamic_sidebar( $parent_slug.'-sidebar' );
					?>
					
			</div>
			<!--main-->
			<div id="main" class="main-content">
				<?php
				// ループ開始
				while ( have_posts() ) : the_post();

					// content-page.phpをロード
					get_template_part( 'template-parts/content', 'page' );//

					// コメント表示がオンになっていて、1つ以上のコメントがついている場合表示する
					if ( comments_open() || get_comments_number() ) :
						comments_template();
					endif;
				// ループ終わり
				endwhile;
				?>
  <table border="1">
    <tbody>
    <tr>
      <td rowspan="2">都道府県</td>
      <td rowspan="2">学校名</td>
      <td colspan="9">対応免許</td>
    </tr>
    <tr>
      <td>普通AT</td>
      <td>普通MT</td>
      <td>普通二輪</td>
      <td>大型二輪</td>
      <td>準中型車</td>
      <td>中型車</td>
      <td>大型車</td>
      <td>大特</td>
      <td>けん引</td>
    </tr>

<?php
            $type = get_query_var( 'school_cat' ); //指定したいタクソノミーを指定
            $args = array(
                'post_type' => array('school'), /* 投稿タイプを指定 */
                //'paged' => $paged,
                'orderby' => 'post_date',
                'order' => 'DESC',
                'posts_per_page' => '-1' /* 5件を取得 */
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
              $field = get_field_object('mennkyo');
              $meta_value = $field['value'];
              $plan_icon = "";
              if( $meta_value ){
                foreach( $meta_value as $getvalue ){
                  if($field['choices'][ $getvalue ] != "" || $field['choices'][ $getvalue ] != NULL){
                      $plan_icon .= "<td>●</td>";
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
			</div>
		</div><!--contentsWrapper-->


	</div><!--#mainContents-->
</div><!--#wholeContents-->


<?php get_footer(); ?>
