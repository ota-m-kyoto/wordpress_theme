<?php
/*
Template Name: なないろトップ
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
			<div class="contentsWrapperInner flex maxWidth">
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
				</div>
				<!--sidebar-->
				<div id="sidebar">
          <div class="sidebar_inner">
  					<?php
  					 if (is_page()) {
  						$parent_id = $post->post_parent; // 親ページのIDを取得
  						$parent_slug = get_post($parent_id)->post_name; // 親ページのスラッグを取得
  					}
  					dynamic_sidebar( $parent_slug.'-sidebar' );
  					?>
            
            <!-- クイック検索 -->
            <div class="search">
            </div>


            <!-- 準中型バナーなど -->
            <div class="side_banner_sty side_banner_area1">
              <div class="imageBox">
                <div class="image">
                  <div class="image_inner">
                    <img src="http://placeimg.com/297/100/animals" alt="">
                  </div><!--end image_inner-->
                </div><!--end image-->
              </div><!--end imageBox-->
              <div class="imageBox">
                <div class="image">
                  <div class="image_inner">
                    <img src="http://placeimg.com/297/100/animals" alt="">
                  </div><!--end image_inner-->
                </div><!--end image-->
              </div><!--end imageBox-->
              <div class="imageBox">
                <div class="image">
                  <div class="image_inner">
                    <img src="http://placeimg.com/297/100/animals" alt="">
                  </div><!--end image_inner-->
                </div><!--end image-->
              </div><!--end imageBox-->
              <div class="imageBox">
                <div class="image">
                  <div class="image_inner">
                    <img src="http://placeimg.com/297/100/animals" alt="">
                  </div><!--end image_inner-->
                </div><!--end image-->
              </div><!--end imageBox-->
              <div class="imageBox">
                <div class="image">
                  <div class="image_inner">
                    <img src="http://placeimg.com/297/100/animals" alt="">
                  </div><!--end image_inner-->
                </div><!--end image-->
              </div><!--end imageBox-->
            </div>

            <!-- ハッピーだけの特別企画 -->
            <div class="side_kikaku side_box">
              <div class="side_box_title">
                <span>ハッピーだけの特別企画！</span>
              </div>
              <div class="side_box_wrap">
                <ul class="side_list_sty">
                  <li>
                    <a>Happy 夏割</a>
                  </li>
                  <li>
                    <a>Happy 夏割</a>
                  </li>
                  <li>
                    <a>Happy 夏割</a>
                  </li>
                  <li>
                    <a>Happy 夏割</a>
                  </li>
                  <li>
                    <a>Happy 夏割</a>
                  </li>
                  <li>
                    <a>Happy 夏割</a>
                  </li>
                  <li>
                    <a>Happy 夏割</a>
                  </li>
                </ul>
              </div>
            </div>

            <!-- 目的地別教習所選び -->
            <div class="side_location_select side_box">
              <div class="side_box_title">
                <span>ハッピーだけの特別企画！</span>
              </div>
              <div class="side_box_wrap">
                <ul class="side_list_sty">
                  <li>
                    <a>Happy 夏割</a>
                  </li>
                  <li>
                    <a>Happy 夏割</a>
                  </li>
                  <li>
                    <a>Happy 夏割</a>
                  </li>
                  <li>
                    <a>Happy 夏割</a>
                  </li>
                  <li>
                    <a>Happy 夏割</a>
                  </li>
                  <li>
                    <a>Happy 夏割</a>
                  </li>
                  <li>
                    <a>Happy 夏割</a>
                  </li>
                </ul>
              </div>
            </div>

            <!-- 割引　13,000 -->
            <div class="side_banner_sty side_banner_area2">
              <div class="imageBox">
                <div class="image">
                  <div class="image_inner">
                    <img src="http://placeimg.com/297/100/animals" alt="">
                  </div><!--end image_inner-->
                </div><!--end image-->
              </div><!--end imageBox-->
              <div class="imageBox">
                <div class="image">
                  <div class="image_inner">
                    <img src="http://placeimg.com/297/100/animals" alt="">
                  </div><!--end image_inner-->
                </div><!--end image-->
              </div><!--end imageBox-->
              <div class="imageBox">
                <div class="image">
                  <div class="image_inner">
                    <img src="http://placeimg.com/297/100/animals" alt="">
                  </div><!--end image_inner-->
                </div><!--end image-->
              </div><!--end imageBox-->
            </div>

            <!-- 取得可能免許で探す -->
            <div class="side_license_select side_box">
              <div class="side_box_title">
                <span>ハッピーだけの特別企画！</span>
              </div>
              <div class="side_box_wrap">
                <ul class="side_license_sty">
                  <li>
                    <a>Happy 夏割</a>
                  </li>
                  <li>
                    <a>Happy 夏割</a>
                  </li>
                  <li>
                    <a>Happy 夏割</a>
                  </li>
                  <li>
                    <a>Happy 夏割</a>
                  </li>
                  <li>
                    <a>Happy 夏割</a>
                  </li>
                  <li>
                    <a>Happy 夏割</a>
                  </li>
                  <li>
                    <a>Happy 夏割</a>
                  </li>
                </ul>
              </div>
            </div>

            <!-- 高校３年生から -->
            <div class="side_banner_sty side_banner_area3">
              <div class="imageBox">
                <div class="image">
                  <div class="image_inner">
                    <img src="http://placeimg.com/297/100/animals" alt="">
                  </div><!--end image_inner-->
                </div><!--end image-->
              </div><!--end imageBox-->
            </div>

            <!-- 運転免許皆伝 -->
            <div class="side_publicity side_box">
              <div class="side_box_title">
                <span>ハッピーだけの特別企画！</span>
              </div>
              <div class="side_box_wrap">
                <ul class="side_publicity_sty">
                  <li>
                    <a>Happy 夏割</a>
                  </li>
                  <li>
                    <a>Happy 夏割</a>
                  </li>
                  <li>
                    <a>Happy 夏割</a>
                  </li>
                  <li>
                    <a>Happy 夏割</a>
                  </li>
                  <li>
                    <a>Happy 夏割</a>
                  </li>
                  <li>
                    <a>Happy 夏割</a>
                  </li>
                  <li>
                    <a>Happy 夏割</a>
                  </li>
                </ul>
                <div class="btn">
                  <a class="dblArrow_right">すべてを見る</a>
                </div>
              </div>
            </div>


          </div>
				</div>
			</div>
		</div><!--contentsWrapper-->


	</div><!--#mainContents-->
</div><!--#wholeContents-->


<?php get_footer(); ?>
