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
  <?php if( is_page('1048')): ?>
<script type='text/javascript'>
    jQuery(function(){
        <?php 
          $sec = "";
          $sec = $_GET['sec'];
        ?>
        <?php $my_query = new WP_Query();
              $param = array(
                'posts_per_page' => '-1', //表示件数。-1なら全件表示
                'post_type' => 'school', //カスタム投稿タイプの名称を入れる
                'post_status' => 'publish', //取得するステータス。publishなら一般公開のもののみ
                'orderby' => 'ID', //ID順に並び替え
                'order' => 'DESC'
              );
              $my_query->query($param); ?>
        <?php if ($my_query->have_posts()) : ?>
            <?php while ($my_query->have_posts()) : $my_query->the_post(); ?>
            
                jQuery('#select-title').append(jQuery('<option>').attr({ value: '<?php the_title(); ?>' }).text('<?php the_title(); ?>'));
            
            <?php endwhile; ?>
        <?php endif; ?>
    $('#select-title').val('<?php echo $sec; ?>');
    });
</script>
<?php endif; ?>

<!-- Global site tag (gtag.js) - Google AdWords: 803955454 -->
<script async src="https://www.googletagmanager.com/gtag/js?id=AW-803955454"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'AW-803955454');
</script>

<script>
window.addEventListener('load',function(){

  if(window.location.pathname == '/'){
    jQuery('a:not([href^="tel:"])').click(function(){
       gtag('event', 'conversion', {'send_to': 'AW-803955454/Z5w5CNvgsIMBEP7Frf8C'});
    })
  } 
  
  jQuery('[href^="tel:"]').click(function(){ 
    gtag('event', 'conversion', {'send_to': 'AW-803955454/rlpeCL3psIMBEP7Frf8C'});
  })
  
  if(window.location.pathname.match('/form/')){ 
  jQuery('[value="入力内容の確認"]').click(function(){ 
     var myVar = setInterval(function(){ var x = 0;  if(x==0){
        if(jQuery('.wpcf7-mail-sent-ok:contains(ありがとうございます。メッセージは送信されました。)').is(':visible')){
         gtag('event', 'conversion', {'send_to': 'AW-803955454/dXPlCNfxoIMBEP7Frf8C'});   
         clearInterval(myVar); x=1;
        }  }  }, 1000); 
   })
  }
    
})
</script>


</head>

<body <?php body_class(); ?>>
  <script>
    document.body.className += " " + platform.name.replace(/ |\/|\./g, "-") + " b" + platform.version.replace(/ |\/|\./g, "-") + " " + platform.os.family.replace(/ |\/|\./g, "-") + " o" + platform.os.version.replace(/ |\/|\./g, "-");
    if (!/(iOS|Android)/.test(document.body.className)) {
      document.body.className += " Pc ";
    }

  </script>
      <div class="topBg"></div>

  <header id="masthead" class="site-header" role="banner">
    <div class="site-branding siteBranding flex  fjc_center fWrap_wrap maxWidth">
      <?php

          if ( is_front_page() || is_home() ) : //topページの場合、サイト名をH1にする ?>
        <!--left-->
        <div class="co1 left">
          <div class="flex fWrap_wrap">
          <h1 class="site-title siteTitle">
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">

                <?php
                  $get_the_logo_img_url = get_the_logo_img_url();
                  $description = get_bloginfo( 'description', 'display' );

                  if(empty($get_the_logo_img_url)){//ロゴ未設定時
                    bloginfo( 'name' );
                    }
                  else{//ロゴ設定時
                    //echo '<img src="'. get_the_logo_img_url() . '" alt="' . $description . '" class="imgRes"/>';
                    echo do_shortcode( '[logo]');
                    }
                ;?>
                </a>
          </h1>
          <?php else ://topページ以外の場合 ?>

        <div class="co1 left">
          <div class="flex fWrap_wrap">
          <h1 class="site-title siteTitle">
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">

                <?php
                  $get_the_logo_img_url = get_the_logo_img_url();
                  $description = get_bloginfo( 'description', 'display' );

                  if(empty($get_the_logo_img_url)){//ロゴ未設定時
                    bloginfo( 'name' );
                    }
                  else{//ロゴ設定時
                    //echo '<img src="'. get_the_logo_img_url() . '" alt="' . $description . '" class="imgRes"/>';
                    echo do_shortcode( '[logo]');
                    }
                ;?>
                </a>
          </h1>

          <?php endif;

            $description = get_bloginfo( 'description', 'display' );
            if ( $description || is_customize_preview() ) : ?>
          <?php endif;
          ?>

                              <?php echo do_shortcode( '[h1]' ); ?>

          </div>
      </div>
      <!--right-->
      <div class="co2 right ">
        <!--row1-->
        <div class="row1 telWrapper flex col2of2">
          <div class="tel co1 left">
            <p><i class="fa fa-phone" aria-hidden="true"></i><span>0120-991-737</span></p>
          </div>
          <div class="co2 right info">
            <p class="row1">平日 9時30分～19時00分</p>
            <p class="row2">土日祝　10時00分～17時00分</p>
          </div>
        </div>

        <!--row2-->
        <div class="row2 ctaWrapper buttonWrapper col2of2">
          <a href="https://www.happymenkyo.com/contact" class="btn redBtn"> <i class="fa fa-caret-right" aria-hidden="true"></i>&nbsp;お問い合わせ </a>
          <a href="https://www.happymenkyo.com/form" class="btn redBtn"> <i class="fa fa-caret-right" aria-hidden="true"></i>&nbsp;お申込み </a>
        </div>
      </div>
      <div class="menu_btn">
          <div class="menuBtn_inner">
            <div class="bar1"></div>
            <div class="bar2"></div>
            <div class="bar3"></div>
          </div>
        </div>
    </div>
    <!-- .site-branding -->

      <!--menu-->
      <div class="menu">
        <div class="headMenuBox ">
          <div class="menuWrap close maxWidth minWidth">
          <?php wp_nav_menu( array(
                  'theme_location'=>'globalmenu',
                  'container'     =>'',
                  'menu_class'    =>'',
                  'items_wrap'    =>'<ul id="main-nav" class="menu flex fjc_around">%3$s</ul>'));
          ?>
          </div>
        </div>

        <?php //echo do_shortcode( '[sns]' ) ?>

      </div>



  </header>
  <!-- .site-header -->
 
  <!-- breadcrumb  -->
    <div class="breadcrumbWrapper maxWidth">
      <?php breadcrumb(); ?>
    </div>


