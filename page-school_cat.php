
<?php get_header(); ?>
<!--page-->
<link rel="stylesheet" id="each-page" href="/wp-content/themes/nanairo/assets/page/school_cat.css" type="text/css" media="">

<div id="wholeContents" class="wholeContents twoColumnpage single-school" role="main">
  <div id="mainContents" class="mainContents">
    <div id="contentsWrapper" class="contentsWrapper maxWidth flex fWrap_wrap">

      <!--main-->
      <div id="main" class="mainContent">
        <div class="mainWrapper">
          <div class="listMapWrapper">
            <p class="image">
              <img src="<?php echo get_bloginfo($show = 'siteurl'); ?>/wp-content/uploads/2018/03/search_map_bg.png" alt="
              運転免許Happy" class="imgRes">
            </p>
          </div>

 
<div class="listMapButton flex fWrap_wrap">
<div class="vc_btn3-container  areaBtn tohoku vc_btn3-center">
  <a style="background-color:#82a0de; color:#ffffff;" class="vc_general vc_btn3 vc_btn3-size-md vc_btn3-shape-square vc_btn3-style-custom vc_btn3-block" href="https://www.happymenkyo.com/school_cat/tohoku_area/" title="">東北</a></div>
<div class="vc_btn3-container  areaBtn kanto vc_btn3-center">
  <a style="background-color:#a2d04b; color:#ffffff;" class="vc_general vc_btn3 vc_btn3-size-md vc_btn3-shape-square vc_btn3-style-custom vc_btn3-block" href="https://www.happymenkyo.com/school_cat/kanto_area/" title="">関東</a></div>
<div class="vc_btn3-container  areaBtn koshinetsu vc_btn3-center">
  <a style="background-color:#ec9b9a; color:#ffffff;" class="vc_general vc_btn3 vc_btn3-size-md vc_btn3-shape-square vc_btn3-style-custom vc_btn3-block" href="https://www.happymenkyo.com/school_cat/koushinetsu_area/" title="">甲信越</a></div>
<div class="vc_btn3-container  areaBtn hokuriku vc_btn3-center">
  <a style="background-color:#d9ce1f; color:#ffffff;" class="vc_general vc_btn3 vc_btn3-size-md vc_btn3-shape-square vc_btn3-style-custom vc_btn3-block" href="https://www.happymenkyo.com/school_cat/hokuriku_area/" title="">北陸</a></div>
<div class="vc_btn3-container  areaBtn tokai vc_btn3-center">
  <a style="background-color:#f1a538; color:#ffffff;" class="vc_general vc_btn3 vc_btn3-size-md vc_btn3-shape-square vc_btn3-style-custom vc_btn3-block" href="https://www.happymenkyo.com/school_cat/toukai_area/" title="">東海</a></div>
<div class="vc_btn3-container  areaBtn kansai vc_btn3-center">
  <a style="background-color:#4f91ff; color:#ffffff;" class="vc_general vc_btn3 vc_btn3-size-md vc_btn3-shape-square vc_btn3-style-custom vc_btn3-block" href="https://www.happymenkyo.com/school_cat/kansai_area/" title="">関西</a></div>
<div class="vc_btn3-container  areaBtn chugoku vc_btn3-center">
  <a style="background-color:#c797d5; color:#ffffff;" class="vc_general vc_btn3 vc_btn3-size-md vc_btn3-shape-square vc_btn3-style-custom vc_btn3-block" href="https://www.happymenkyo.com/school_cat/chugoku_area/" title="">中国</a></div>
<div class="vc_btn3-container  areaBtn shikoku vc_btn3-center">
  <a style="background-color:#8a93d2; color:#ffffff;" class="vc_general vc_btn3 vc_btn3-size-md vc_btn3-shape-square vc_btn3-style-custom vc_btn3-block" href="https://www.happymenkyo.com/school_cat/shikoku_area/" title="">四国</a></div>
<div class="vc_btn3-container  areaBtn kyushu vc_btn3-center">
  <a style="background-color:#e573a9; color:#ffffff;" class="vc_general vc_btn3 vc_btn3-size-md vc_btn3-shape-square vc_btn3-style-custom vc_btn3-block" href="https://www.happymenkyo.com/school_cat/kyushu_okinawa_area/" title="">九州</a></div>
</div>




      </div><!--/.mainWrapper-->
        </div><!--/#main-->



        <!--sidebar-->
        <div id="sidebar" class="sidebarContent">
          <div class="sidebarWrapper">
          <?php
            if (is_page()) {
              $parent_id = $post->post_parent; // 親ページのIDを取得
              $parent_slug = get_post($parent_id)->post_name; // 親ページのスラッグを取得
              }
              dynamic_sidebar( 'untenmenkyouketsukecentersidebar' );
            ?>
          </div>
        </div><!--/#sidebar-->
 
      </div><!--contentsWrapper-->
    </div><!--/#mainContents-->
  </div><!--/#wholeContents-->






<?php

get_footer();