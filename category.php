<?php get_header("frontpage"); ?>
<?php
global $query_string;
query_posts( $query_string . "&posts_per_page=10&paged=".$paged );
?>
<div id="wholeContents" class="wholeContents">

		<!--information All-->
	<div id="informationAll" class="maxWidth">
		<div class="listWrapper flex fWrap_wrap twoColumn">
			<div id="main">
				<?php
					//global $post;
					echo '<div class="newslist">';
					echo '<div class="pageTitleA">
						      	  <h2 class="titleText flex">
						      	   <div class="imageBox">
						      	     <div class="image">
						      	       <div class="image_inner">
						      	         <img src="'.get_template_directory_uri().'/assets/icomoon/doubleCircle.svg" alt="">
						      	       </div><!--end image_inner-->
						      	     </div><!--end image-->
						      	   </div><!--end imageBox-->
						      	   '.get_the_category()[0]->cat_name.'一覧
						      	 </h2>
						      	</div>';
					echo '<div class="col_wrap">';

					if(have_posts()) {
						$count = 1;
						echo '<ul id="newsList" class="newsListWrapper withoutCategory newsList2">';
						while (have_posts()) : the_post();
							$content = strip_tags($post->post_content);
				      $cat = get_the_category();//カテゴリー
				      $catname = $cat[0]->cat_name;//カテゴリー名
				      $category_id = get_cat_ID( $catname );// 指定したカテゴリーの ID を取得
				      $category_link = get_category_link( $category_id );    // このカテゴリーの URL を取得
							$terms = get_the_terms($post->ID, 'category');
							if (!empty($terms[0])) {
								$cate = $terms[0]->name;
							} else {
								$cate = "";
							}
				      echo '<li class="categoryListWrapper">';
				      echo '<span class="entry-date">'.get_the_time('Y/m/d').'</span>';
								//echo '<span>' . $cate . '</span>';
				      echo '<h2 class="categoryListTitle "><i class="fa fa-caret-right" aria-hidden="true"></i><a href="'.esc_url( get_permalink() ).'">'.the_title("","",false).'</a></h2>';
							echo '</li>';
							$count++;
						endwhile;
						echo '</ul>';
					}
					echo '</div>';
					if (function_exists('wp_pagenavi')) {
						echo '<div class="pagenation">';
						echo wp_pagenavi();
						echo '</div>';
					}
					echo '</div>';
					echo '<div class="sidebar">';
					dynamic_sidebar( 'group_recruit-sidebar' );
					echo '</div>';
					wp_reset_postdata();
				?>
			</div>
			<?php echo do_shortcode('[sidebar]'); ?>
		</div>
	</div>
</div>
<?php

get_footer("frontpage");
?>





<?php
// $url = '/';
//
// header('Location: ' . $url, true, 301);
 ?>
