<?php
/*
Template Name: フォーム用
*/
?>
<?php get_header(); ?>
<!--page-->


<div id="wholeContents" class="wholeContents twoColumnpage" role="main">
	<div id="mainContents" class="mainContents">

		<?php //echo do_shortcode( '[topslider]' ); ?>




		<div id="contentsWrapper" class="contentsWrapper maxWidth flex fWrap_wrap twoColumn">
		      <!--main-->
		      <div id="main" class="mainContent">
		      	<div class="pageTitleA">
		      	  <h2 class="titleText flex">
		      	   <div class="imageBox">
		      	     <div class="image">
		      	       <div class="image_inner">
		      	         <img src="<?php echo get_template_directory_uri()?>/assets/icomoon/doubleCircle.svg" alt="">
		      	       </div><!--end image_inner-->
		      	     </div><!--end image-->
		      	   </div><!--end imageBox-->
		      	   <?php echo get_the_title(); ?>
		      	 </h2>
		      	</div>
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
			</div>
		      <?php echo do_shortcode('[sidebar]'); ?>
		</div><!--contentsWrapper-->


	</div><!--#mainContents-->
</div><!--#wholeContents-->


<?php get_footer(); ?>
