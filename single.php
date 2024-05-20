<?php
  $category = get_the_category();
  $cat_id   = $category[0]->cat_ID;
  $cat_name = $category[0]->cat_name;
  $cat_slug = $category[0]->category_nicename;
?>

<?php get_header(); ?>

<!--page-->


<div id="wholeContents" class="wholeContents twoColumnpage singlePost" role="main">
  <div id="mainContents" class="mainContents">
    <div id="contentsWrapper" class="contentsWrapper maxWidth flex fWrap_wrap twoColumn">

      <!--main-->
      <div id="main" class="mainContent">
        <div class="mainWrapper">
          <div class="mainTitle">
            <div class="mainInner">
              <div class="pageTitleA">
              <h2 class="titleText flex">
               <div class="imageBox">
                 <div class="image">
                   <div class="image_inner">
                     <img src="<?php echo get_template_directory_uri();?>/assets/icomoon/doubleCircle.svg" alt="">
                   </div><!--end image_inner-->
                 </div><!--end image-->
               </div><!--end imageBox-->
               <?php echo $cat_name;?>
             </h2>
            </div>

              <div class="secTitleA">
                <h3 class="titleText"><?php echo get_the_title() ; ?></h3>
              </div>
              <?php echo get_the_date() ; ?>
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
        </div>
        <div class="page_link">
          <div class="paging">
              <?php if (get_previous_post()):?>
              <div class="prev"><?php previous_post_link('%link','<i class="fas fa-arrow-left"></i>',TRUE); ?></div>
              <?php endif; ?>
              <?php if (get_next_post()): ?>
              <div class="next"><?php next_post_link('%link','<i class="fas fa-arrow-right"></i>',TRUE); ?></div>
              <?php endif; ?>
          </div>
        </div>
      </div>
    </div>
      <?php echo do_shortcode('[sidebar]'); ?>
    </div><!--contentsWrapper-->

  </div><!--#mainContents-->
</div><!--#wholeContents-->



<?php get_footer(); ?>
