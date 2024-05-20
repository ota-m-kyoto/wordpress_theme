<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js no-svg">

<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php if (is_mobile()) { ?>
  <meta name="format-detection" content="telephone=no,address=no,email=no">
  <?php } else {
}?>
  <link rel="profile" href="http://gmpg.org/xfn/11">
  <?php wp_head(); ?>
  <?php if( is_page('1048') || is_page('1013')): ?>



<script >
    jQuery(function(){
        <?php
          $sec = "";
          $sec = $_GET['sec'];
          $mm = "";
          $mm = $_GET['mm'];
          $dd = "";
          $dd = $_GET['dd'];

          //LPから飛んできたとき
          $LP_flg = "";
          $LP_flg = $_GET['lp'];
        ?>
        <?php if($LP_flg == 'lp'){ ?>
         jQuery('input[value="UniLifeパンフレット"]').prop("checked", true);
        <?php } ?>

        <?php $my_query = new WP_Query();
              $param = array(
                'posts_per_page' => '-1', //表示件数。-1なら全件表示
                'post_type' => 'school', //カスタム投稿タイプの名称を入れる
                'post_status' => 'publish', //取得するステータス。publishなら一般公開のもののみ
                'orderby' => 'date', //ID順に並び替え
                'order' => 'DESC'
              );
              $my_query->query($param); ?>
        <?php if ($my_query->have_posts()) : ?>
            <?php while ($my_query->have_posts()) : $my_query->the_post(); ?>

                jQuery('#select-title').append(jQuery('<option>').attr({ value: '<?php the_title(); ?>' }).text('<?php the_title(); ?>'));

            <?php endwhile; ?>
        <?php endif; ?>
    jQuery('#select-title').val('<?php echo $sec; ?>');
    jQuery('#kiboumm').val('<?php echo $mm; ?>');
    jQuery('#kiboudd').val('<?php echo $dd; ?>');
    });
</script>
<?php endif; ?>

<link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet">

<script src="//kitchen.juicer.cc/?color=XBMUSh3R6VE=" async></script>

<!-- Global site tag (gtag.js) - Google AdWords: 803955454 -->
<!-- <script async src="https://www.googletagmanager.com/gtag/js?id=AW-803955454"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'XXXXXXXXXX');
</script>
 -->
<script>
// window.addEventListener('load',function(){

//   if(window.location.pathname == '/'){
//     jQuery('a:not([href^="tel:"])').click(function(){
//        gtag('event', 'conversion', {'send_to': 'AW-803955454/Z5w5CNvgsIMBEP7Frf8C'});
//     })
//   }

//   jQuery('[href^="tel:"]').click(function(){
//     gtag('event', 'conversion', {'send_to': 'AW-803955454/rlpeCL3psIMBEP7Frf8C'});
//   })

//   if(window.location.pathname.match('/form/')){
//   jQuery('[value="入力内容の確認"]').click(function(){
//      var myVar = setInterval(function(){ var x = 0;  if(x==0){
//         if(jQuery('.wpcf7-mail-sent-ok:contains(ありがとうございます。メッセージは送信されました。)').is(':visible')){
//          gtag('event', 'conversion', {'send_to': 'AW-803955454/dXPlCNfxoIMBEP7Frf8C'});
//          clearInterval(myVar); x=1;
//         }  }  }, 1000);
//    })
//   }

// })


</script>


<script language="JavaScript">
//fileName
document.documentElement.className += location.pathname.split("/").pop() ? " page-" + location.pathname.split("/").pop().split(".")[0] + " " : " page-index ";
//Platform
document.documentElement.className += " " + platform.name.replace(/ |\/|\./g, "-") + " browserVer" + platform.version.replace(/ |\/|\./g, "-") + " " + platform.os.family.replace(/ |\/|\./g, "-") + " osVer" + platform.os.version.replace(/ |\/|\./g, "-");
document.documentElement.className += !/(iOS|Android)/.test(document.documentElement.className) ? " Pc " : " Mb ";
</script>

<?php if(is_page("form")){ ?>
  <script>
  document.addEventListener( 'wpcf7mailsent', function( event ) {
      ga('send', 'event', 'Apply Form', 'submit');
  }, false );
  </script>
<?php } ?>

<?php if(is_page("contact")){ ?>
  <script>
  document.addEventListener( 'wpcf7mailsent', function( event ) {
      ga('send', 'event', 'Contact Form', 'submit');
  }, false );
  </script>
<?php } ?>

<?php if ( $post->my_description ): //meta descriptionの設定 ?>
  <meta name="description" content="<?php echo esc_attr( $post->my_description ); ?>" />
<?php else: ?>

  <meta name="description" content="" />
<?php endif; ?>

  <!--グーグルアナリティクス-->
<script>
 (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
   (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
   m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
 })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

 ga('create', 'UA-116663499-1', 'auto');
 ga('send', 'pageview');
</script>
</head>

<body <?php body_class(); ?>>
  <div class="bodyInner">
    <div class="topBg"></div>

    <header id="masthead" class="site-header">
      <!--start header_row-->
      <div class="header_block">
        <div class="header_row1 header_row box_row maxWidth">
          <!--start header_wrap-->
          <div class="header_wrap">
            <div class="headerInner flex fWrap_wrap">
              <div class="header_co1 header_co box_co">
                <div data-moving-pc="h1Desc">
                  <?php echo do_shortcode( '[h1]' ); ?>
                </div>
                <div class="imageBox logoImage">
                  <div class="image">
                    <div class="image_inner">
                      <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php echo do_shortcode( '[logo]'); ?></a>
                    </div><!--end image_inner-->
                  </div><!--end image-->
                </div><!--end imageBox-->
              </div><!--end header_co-->
              <div class="header_co2 header_co box_co">
                <div class="head_searchArea heiStand-33 flex onlyPc">
                  <div class="fav_btn">
                    <a href="<?php echo home_url();?>/favorite" id="favLinkBtn" class="btn skn_orange skn_icon_star">
                      <i class="far fa-star"></i>お気に入り
                    </a>
                  </div>
                  <div class="head_search_name" data-moving-pc="searchbox_name">
                    <select id="headSerchName_select" class="skn_select" onChange="location.href=value;">
                      <option value="1" selected>教習所名検索</option>
                      <?php
                            $old_post = $post;
                            $my_query = new WP_Query();
                            $param = array(
                              'posts_per_page' => '-1', //表示件数。-1なら全件表示
                              'post_type' => 'school', //カスタム投稿タイプの名称を入れる
                              'post_status' => 'publish', //取得するステータス。publishなら一般公開のもののみ
                              'orderby' => 'date', //ID順に並び替え
                              'order' => 'DESC'
                            );
                            $my_query->query($param); ?>
                      <?php if ($my_query->have_posts()) : ?>
                          <?php while ($my_query->have_posts()) : $my_query->the_post(); ?>

                              <script>jQuery('#headSerchName_select').append(jQuery('<option>').attr({ value: '<?php the_permalink(); ?>' }).text('<?php the_title(); ?>'));</script>

                          <?php endwhile; ?>
                      <?php endif; ?>
                      <?php $post = $old_post; ?>
                    </select>
                  </div>

                  <div class="head_search_prefecture" data-moving-pc="searchbox_prefecture">
                    <select id="headSerchPrefecture_select" class="skn_select" onChange="location.href=value;">
                      <option value="1" selected>都道府県別</option>
                      <?php
                      $area_id = get_term_by( 'slug', 'todofuken', 'school_cat' );
                      $result = NULL;
                      $args = array(
                        'hide_empty' => true,
                        'parent' => $area_id->term_id,
                        'orderby' => 'description'
                      );
                      // カスタム分類のタームのリストを取得
                      $areaterms = get_terms( 'school_cat' , $args );
                      if(!empty($areaterms)){
                       foreach ($areaterms as $areaterm) {
                        ?><script>jQuery('#headSerchPrefecture_select').append(jQuery('<option>').attr({ value: '<?php echo "/school_cat/".$areaterm->slug; ?>' }).text('<?php echo $areaterm->name; ?>'));</script><?php
                       }
                      }
                      ?>
                    </select>
                  </div>
                </div>
                <div class="head_linkBtns flex onlyPc">
                  <div class="imageBox">
                    <div class="image">
                      <div class="image_inner">
                        <a href="<?php echo home_url();?>/discount_feature">
                          <img src="<?php echo content_url();?>/uploads/2018/09/campaign13000yen.png" alt="キャンペーン割引で最大13000円引" srcset="<?php echo content_url();?>/uploads/2018/09/campaign13000yen.png 1x,<?php echo content_url();?>/uploads/2018/09/c3bd5d8ae7f69cb7c4c59fba8dfe0596.png 2x">
                        </a>
                      </div><!--end image_inner-->
                    </div><!--end image-->
                  </div><!--end imageBox-->
                  <div class="imageBox">
                    <div class="image">
                      <div class="image_inner">
                        <a href="<?php echo home_url();?>/contact">
                          <img class="hideSp" src="<?php echo content_url();?>/uploads/2018/09/documentRequestBtnPC.png" alt="資料請求（無料）" srcset="<?php echo content_url();?>/uploads/2018/09/documentRequestBtnPC.png 1x,<?php echo content_url();?>/uploads/2018/09/2e1cd3b6e0ed5fde57439c27384bc60a.png 2x">
                          <img class="hidePc" src="<?php echo content_url();?>/uploads/2018/09/documentRequestBtnPC.png" alt="資料請求（無料）" srcset="<?php echo content_url();?>/uploads/2018/09/documentRequestBtnPC.png 1x,<?php echo content_url();?>/uploads/2018/09/2e1cd3b6e0ed5fde57439c27384bc60a.png 2x">
                        </a>
                      </div><!--end image_inner-->
                    </div><!--end image-->
                  </div><!--end imageBox-->
                  <div class="imageBox">
                    <div class="image">
                      <div class="image_inner">
                        <a href="<?php echo home_url();?>/form">
                          <img class="hideSp" src="<?php echo content_url();?>/uploads/2018/09/applyBtnPC.png" alt="合宿免許に申込む" srcset="<?php echo content_url();?>/uploads/2018/09/applyBtnPC.png 1x,<?php echo content_url();?>/uploads/2018/09/19d2f36de5c61487a438b02f4ca02fb5.png 2x">
                          <img class="hidePc" src="<?php echo content_url();?>/uploads/2018/09/applyBtnPC.png" alt="合宿免許に申込む" srcset="<?php echo content_url();?>/uploads/2018/09/applyBtnPC.png 1x,<?php echo content_url();?>/uploads/2018/09/19d2f36de5c61487a438b02f4ca02fb5.png 2x">
                        </a>
                      </div><!--end image_inner-->
                    </div><!--end image-->
                  </div><!--end imageBox-->
                  <div class="imageBox">
                    <div class="image">
                      <div class="image_inner">
                          <img src="<?php echo content_url();?>/uploads/2018/09/telBtn.png" alt="" srcset="<?php echo content_url();?>/uploads/2018/09/telBtn.png 1x,<?php echo content_url();?>/uploads/2018/09/4cfccd5e6bbc4a04f11b23421348f33f.png 2x">
                      </div><!--end image_inner-->
                    </div><!--end image-->
                  </div><!--end imageBox-->
                </div>

                <div class="spTelBtn hidePc flex">
                  <div class="imageBox spTel">
                    <div class="image">
                      <div class="image_inner">
                        <a href="tel:0120677663" class="hidePc">
                          <img src="<?php echo content_url();?>/uploads/2018/09/ca52eea4ee35c1972f3f60c62686e2af.png" alt="0120677663 平日9:30~19:00/土日祝10:00~17:00">
                        </a>
                      </div><!--end image_inner-->
                    </div><!--end image-->
                  </div><!--end imageBox-->

                  <div class="menuBtn">
                    <div class="menuBtnInner">
                      <div class="bar1"></div>
                      <div class="bar2"></div>
                      <div class="bar3"></div>
                    </div>
                  </div>
                </div>
              </div><!--end header_co-->
            </div><!--end header_inner-->
          </div><!--end header_wrap-->
          <div data-moving-sp="h1Desc">
          </div>
        </div><!--end header_row-->
        <div class="header_row2 header_row box_row maxWidth">
          <!--menu-->
          <div class="menu">
            <div class="headMenuBox ">
              <div class="menuWrap minWidth">
                <div class="onlyPc">
                  <?php wp_nav_menu( array(
                    'theme_location'=>'globalmenu',
                    'container'     =>'',
                    'menu_class'    =>'',
                    'items_wrap'    =>'<ul id="main-nav" class="menu flex">%3$s</ul>'));
                  ?>
                </div>
                <div class="hidePc">
                  <div class="sp_menubtn flex">
                    <div class="menu_reqBtn">
                      <div class="imageBox center menu_req">
                        <div class="image">
                          <div class="image_inner">
                            <a href="<?php echo home_url();?>/contact">
                              <img src="<?php echo content_url();?>/uploads/2018/09/ce72cb13c12528fdcebbf685f4b1224c.png" alt="資料請求（無料）">
                            </a>
                          </div><!--end image_inner-->
                        </div><!--end image-->
                      </div><!--end imageBox-->
                    </div>
                    <div class="menu_applyBtn">
                      <div class="imageBox center menu_apply">
                        <div class="image">
                          <div class="image_inner">
                            <a href="<?php echo home_url();?>/form">
                              <img src="<?php echo content_url();?>/uploads/2018/09/19d2f36de5c61487a438b02f4ca02fb5-1.png" alt="合宿免許に申込む">
                            </a>
                          </div><!--end image_inner-->
                        </div><!--end image-->
                      </div><!--end imageBox-->
                    </div>
                  </div>
                  <div class="flex sp_head_search_name">
                    <div class="headSerchName_select" data-moving-sp="searchbox_name">

                    </div>
                    <div class="headSerchPrefecture_select" data-moving-sp="searchbox_prefecture">

                    </div>
                  </div>
                  <div class="menu_selected_image imageBox center">
                    <div class="image">
                      <div class="image_inner">
                        <img src="<?php echo content_url();?>/uploads/2018/09/9bbe40bd3843bc244977cb209012d516.png" alt="教習所との強いパイプで、希望の条件でも見つけやすい　丁寧なヒアリングでベストなご提案を行います！　ご自宅から教習所へのアクセス方法等も丁寧にサポート">
                      </div><!--end image_inner-->
                    </div><!--end image-->
                  </div><!--end imageBox-->


                  <?php wp_nav_menu( array(
                    'theme_location'=>'spglobalmenu',
                    'container'     =>'',
                    'menu_class'    =>'',
                    'items_wrap'    =>'<ul id="main-navSp" class="menu flex fWrap_wrap">%3$s</ul>'));
                  ?>
                </div>
              </div>
            </div>
          </div>

        </div><!--end header_row-->
      </div><!--end header_block-->
    </header>
    <div class="pageWrap">
    <!-- .site-header -->
    <!-- breadcrumb  -->
    <div class="breadcrumbWrapper maxWidth">
      <?php breadcrumb(); ?>
    </div>
