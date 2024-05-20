<?php
/*
Template Name: 2カラムテンプレート
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
