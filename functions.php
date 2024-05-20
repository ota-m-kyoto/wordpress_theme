<?php
//00000 svg 許可
//add SVG to allowed file uploads
function add_file_types_to_uploads($file_types){

    $new_filetypes = array();
    $new_filetypes['svg'] = 'image/svg+xml';
    $file_types = array_merge($file_types, $new_filetypes );

    return $file_types;
}
add_action('upload_mimes', 'add_file_types_to_uploads');


//00005 スクリプトを読み込むときに自動で挿入される［type属性］を削除する
function remove_script_type($tag) {
  return str_replace("type='text/javascript' ", "", $tag);
}
add_filter('script_loader_tag','remove_script_type');

//00100 デバイスの切り分け
  /*Mobile_Detectの読み込み*/
  require_once 'assets/Mobile_Detect/Mobile_Detect.php' ;

  // 判別
      // タブレットの場合
      $detect = new Mobile_Detect ;
      if( $detect->isTablet() )
      {
          // 処理
          $browser = 'Tb' ;
          $viewport = '<meta name="viewport" content="width=1280,user-scalable=no">';
          $forBody="tb";
      }
      // スマホの場合
      elseif( $detect->isMobile() )
      {
          // 処理
          $browser = 'Sp' ;
          $viewport = '<meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=2.0,user-scalable=yes">';
          $forBody="sp";
      }
      // デスクトップの場合
      else
      {
          // 処理
          $browser = 'Pc';
          $viewport = '<meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">';
          $forBody = "pc";
      }

//001900
// jQuery読み込みを停止
function register_common_script() {
  if (!is_admin()){
    $script_dir = get_template_directory_uri();
    if(!is_page_template( 'page-form.php' )){
    wp_deregister_script( 'jquery' );
    wp_enqueue_script('nanairo-jquery3.1.1', 'https://code.jquery.com/jquery-3.1.1.min.js' , array(), '3.1.1', false);
    // wp_enqueue_script( 'jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js',array(), false, false);
    // wp_enqueue_script( 'cssfx', $script_dir.'/lib/cssfx.min.js', array(), false, false );
    // wp_enqueue_script( 'respondjs', $script_dir.'/lib/respond.min.js',array('jquery'), false, true);
    }
  }
}
add_action('wp_enqueue_scripts','register_common_script');


//00200 cssとjsの読み込み
  function nanairo_scripts()
    {
    global $pattern_file;
    global $browser;
    global $filename;

    //Fundamental CSS & JS
    //ie9
    if ( is_customize_preview() ) {
      wp_enqueue_style( 'nanairo-ie9', get_stylesheet_directory_uri( '/assets/library/css/ie9.css' ), array( 'nanairo-wacuCm' ), '1.0' );
      wp_style_add_data( 'nanairo-ie9', 'conditional', 'IE 9' );
    }

    // Load the Internet Explorer 8 specific stylesheet.
    wp_enqueue_style( 'nanairo-ie8', get_stylesheet_directory_uri( '/assets/library/css/ie8.css' ), array( 'nanairo-wacuCm' ), '1.0' );
    wp_style_add_data( 'nanairo-ie8', 'conditional', 'lt IE 9' );

    // Load the html5 shiv.
    wp_enqueue_script( 'nanairo-html5', get_stylesheet_directory_uri( '/assets/library/js/html5.js' ), array(), '3.7.3' );
    wp_script_add_data( 'html5', 'conditional', 'lt IE 9' );


    //fontawesome
    wp_enqueue_style('fontawesome', get_stylesheet_directory_uri().'/assets/font-awesome/css/all.min.css' , array() , '5.3.0' );

    //wacuCm
    wp_enqueue_style('nanairo-wacuCm', get_stylesheet_directory_uri().'/assets/wacu/css/wacuCm.css' , array('js_composer_front') , '1.0.0' );
    wp_enqueue_style('nanairo-wacuPc', get_stylesheet_directory_uri().'/assets/wacu/css/wacuPc.css' , array('nanairo-wacuCm') , '1.0.0' ,'screen and (min-width: 769px)');
    wp_enqueue_style('nanairo-wacuTb', get_stylesheet_directory_uri().'/assets/wacu/css/wacuTb.css' , array('nanairo-wacuPc') , '1.0.0' ,'screen and (min-width: 481px) and (max-width:768px)');
    wp_enqueue_style('nanairo-wacuSp', get_stylesheet_directory_uri().'/assets/wacu/css/wacuSp.css' , array('nanairo-wacuTb') , '1.0.0' ,'screen and (max-width:480px)');

    //wacu load
    //wp_enqueue_style('nanairo-wacu'.$browser , get_stylesheet_directory_uri().'/assets/wacu/css/wacu'.$browser.'.css' , array('nanairo-wacuCm') , '1.0.0' , false);

    //style
    wp_enqueue_style('nanairo-style', get_stylesheet_directory_uri(). '/assets/library/css/style.css' , array('nanairo-wacuCm') , '1.0.0' );
    // wp_enqueue_style('nanairo-stylePc', get_stylesheet_directory_uri(). '/assets/library/css/stylePc.css' , array('nanairo-styleCm') , '1.0.0' ,'screen and (min-width: 769px)', false);
    // wp_enqueue_style('nanairo-styleTb', get_stylesheet_directory_uri(). '/assets/library/css/styleTb.css' , array('nanairo-stylePc') , '1.0.0' ,'screen and (min-width: 481px) and (max-width:768px)', false);
    // wp_enqueue_style('nanairo-styleSp', get_stylesheet_directory_uri(). '/assets/library/css/styleSp.css' , array('nanairo-styleTb') , '1.0.0' ,'screen and (max-width:480px)', false);


  // original Font
    wp_enqueue_style('nanairo-icomoon', get_stylesheet_directory_uri(). '/assets/icomoon/style.css' );





    //style load
    //wp_enqueue_style('nanairo-style'.$browser , get_stylesheet_directory_uri(). '/assets/library/css/style' . 'Cm.css' , array('nanairo-styleCm') , '1.0.0' , false);

    //jQuery.js
    // wp_enqueue_script('nanairo-jquery3.1.1', 'https://code.jquery.com/jquery-3.1.1.min.js' , array(), '3.1.1', false);

    wp_enqueue_script('extension-cscript', get_stylesheet_directory_uri().'/assets/library/js/jquery.extension.0.0.1.js', array(), 'jquery', false);

    //jquery.scrollTo
    wp_enqueue_script( 'nanairo-jqueryScrollto', get_theme_file_uri( '/assets/library/js/jquery.scrollTo.js' ), array( 'jquery' ), '2.1.2', true );

    //jsPc
    // wp_enqueue_script( 'nanairo-jsPc', get_theme_file_uri( '/assets/library/js/jsPc.js' ), array( 'jquery' ), '2.1.2', true );



    //platform.js
    wp_enqueue_script('nanairo-platform', get_stylesheet_directory_uri().'/assets/library/js/platform.js', array(), 'jquery', false);
    wp_enqueue_script('nanairo-cscript', get_stylesheet_directory_uri().'/assets/library/js/script.js', array(), 'jquery', true);
    //swiper
    wp_enqueue_style('nanairo-swipercss', get_stylesheet_directory_uri(). '/assets/library/swiper/swiper.min.css' );
    wp_enqueue_script('nanairo-swiperjs', get_stylesheet_directory_uri().'/assets/library/swiper/swiper.min.js', array(), 'swiper', false);




    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
      wp_enqueue_script( 'comment-reply' );
    }

    //各ページでのCSSの取得
    global $post;

    if ( is_front_page() ) // 固定ページでのトップページの場合
      {
        $frontpagefilename = get_stylesheet_directory() . '/assets/page/frontpage.css';
        if(file_exists($frontpagefilename)){
      wp_enqueue_style('style-frontpage', get_stylesheet_directory_uri() . '/assets/page/frontpage.css');
      wp_enqueue_script( 'js-frontpage', get_stylesheet_directory_uri( ) .'/assets/page/frontpage.js', array(), 'jquery', false );


        }else{

        }
      }elseif ( is_page() ){
      //frontpage以外の固定ページの場合
      $pageSlug = get_page(get_the_ID());
    $page = get_page(get_the_ID());

    $slug = $page->post_name;
      $filename = get_stylesheet_directory().'/assets/page/' . $slug .  '.css';


      $pageSlug = get_page_uri($post->ID);
      $slugfilename = get_stylesheet_directory().'/assets/page/' .$pageSlug . '.css';

      if(file_exists($filename))
        {
          wp_enqueue_style('style-eachpage',get_stylesheet_directory_uri().'/assets/page/' . $slug  . '.css' , array() , '1.0.0');
         wp_enqueue_script( 'js-eachpage', get_stylesheet_directory_uri().'/assets/page/' . $slug  . '.js', array('jquery' ), '1.0.0', true );
         // wp_enqueue_style('style-eachpagePc',get_stylesheet_directory_uri().'/assets/page/'.$slug . '/css' .'/'  . $slug  . 'Pc.css' , array() , '1.0.0' , 'screen and (min-width: 769px)' , false);
          // wp_enqueue_style('style-eachpageTb',get_stylesheet_directory_uri().'/assets/page/'.$slug . '/css' .'/'  . $slug  . 'Tb.css' , array() , '1.0.0' , 'screen and (min-width: 481px) and (max-width:768px)' , false);
          // wp_enqueue_style('style-eachpageSp',get_stylesheet_directory_uri().'/assets/page/'.$slug . '/css' .'/'  . $slug  . 'Sp.css' , array() , '1.0.0' , 'screen and (max-width:480px)' , false);
       }
      // else{
      //孫以降の処理
        $pageSlug = $page = get_page(get_the_ID());

        if($post -> post_parent != 0 )
          {
          $ancestors = array_reverse(get_post_ancestors( $post->ID ));
          foreach($ancestors as $ancestor)
            {
            $slugcss = get_post($ancestor)->post_name;
            if(file_exists($filename))
              {
              wp_enqueue_style('style-child-page', get_stylesheet_directory_uri().'/assets/page/'  . $slugcss  . '.css' , array() , '1.0.0' , false);
      wp_enqueue_script( 'js-child-page', get_stylesheet_directory_uri().'/assets/page/' . $slugcss  . '.css', array('jquery' ), '1.0.0', false );
              // wp_enqueue_style('style-child-pagePc', get_stylesheet_directory_uri().'/assets/page/' . $slugcss . '/css' .'/'  . $slugcss .'Pc.css' , array() , '1.0.0' , 'screen and (min-width: 769px)' , false);
              // wp_enqueue_style('style-child-pageTb', get_stylesheet_directory_uri().'/assets/page/' . $slugcss . '/css' .'/'  . $slugcss .'Tb.css' , array() , '1.0.0' , 'screen and (min-width: 481px) and (max-width:768px)' , false);
              // wp_enqueue_style('style-child-pageSp', get_stylesheet_directory_uri().'/assets/page/' . $slugcss . '/css' .'/'  . $slugcss .'Sp.css' , array() , '1.0.0' , 'screen and (max-width:480px)' , false);
              }
            }
          }
        else
          {
          //トップから見ての子ページの処理
          if(file_exists($filename))
            {
            }
          elseif(file_exists($slugfilename))
            {
              wp_enqueue_style('style-slugfilename', get_stylesheet_directory_uri().'/assets/page/'. get_page_uri($post->ID) . '.css' , array() , '1.0.0' );
        wp_enqueue_script( 'js-slugfilename', get_stylesheet_directory_uri().'/assets/page/' . get_page_uri($post->ID) . '.js', array('jquery' ), '1.0.0', true );
            // wp_enqueue_style('style-slugfilenamePc', get_stylesheet_directory_uri().'/assets/page/'. get_page_uri($post->ID) .'/css' .'/'  . get_page_uri($post->ID) . 'Pc.css' , array() , '1.0.0' , 'screen and (min-width: 769px)' , false);
              // wp_enqueue_style('style-slugfilenameTb', get_stylesheet_directory_uri().'/assets/page/'. get_page_uri($post->ID) .'/css' .'/'  . get_page_uri($post->ID) . 'Tb.css' , array() , '1.0.0' , 'screen and (min-width: 481px) and (max-width:768px)' , false);
              // wp_enqueue_style('style-slugfilenameSp', get_stylesheet_directory_uri().'/assets/page/'. get_page_uri($post->ID) .'/css' .'/'  . get_page_uri($post->ID) . 'Sp.css' , array() , '1.0.0' , 'screen and (max-width:480px)' , false);
            }
          }
      // }
      }
      elseif ( is_category() )
        {
        //カテゴリの場合の処理（まだ）
        $categories = get_the_category( $post->ID );
        $categorySlug = $categories[0]->slug;
        return $categorySlug;
        }

       //school custompost type
      elseif (get_post_type() === 'school'){

        wp_enqueue_style('cp-school', get_stylesheet_directory_uri().'/assets/page/school.css' , array() , '1.0.0'  );


        wp_enqueue_script( 'js-cp-school', get_stylesheet_directory_uri().'/assets/page/school.js', array(), '1.0.0', false );

      }
      elseif(is_single() ){
        wp_enqueue_style('cp-school', get_stylesheet_directory_uri().'/assets/page/single.css' , array() , '1.0.0' , '' );


        wp_enqueue_script( 'js-cp-school', get_stylesheet_directory_uri().'/assets/page/single.js', array('jquery' ), '1.0.0', false);

      }
       //school custompost type
      // elseif (get_post_type() === 'school'){

      //   wp_enqueue_style('cp-school', get_stylesheet_directory_uri().'/assets/page/school.css' , array() , '1.0.0'  );


      //   wp_enqueue_script( 'js-cp-school', get_stylesheet_directory_uri().'/assets/page/school.js', array('jquery' ), '1.0.0', false );

      // }else{
      //   return NULL;
      //   }

      }



  add_action( 'wp_enqueue_scripts', 'nanairo_scripts' );




//00300 「テーマで wp_title() を呼び出すことはできません。」対策
  add_theme_support( 'title-tag' );



//00400 wp_head()の内容で不必要なものを消す
  remove_action('wp_head', 'feed_links', 2);
  remove_action('wp_head', 'feed_links_extra', 3);
  remove_action('wp_head', 'rsd_link');
  remove_action('wp_head', 'wlwmanifest_link');
  remove_action('wp_head', 'adjacent_posts_rel_link_wp_head');
  remove_action('wp_head', 'wp_generator');
  remove_action('wp_head', 'rel_canonical');
  remove_action('wp_head', 'index_rel_link');
  remove_action('wp_head', 'parent_post_rel_link', 10, 0);
  remove_action('wp_head', 'start_post_rel_link', 10, 0);
  remove_action('wp_head', 'wp_shortlink_wp_head');
  // Since 4.4
  remove_action('wp_head','wp_oembed_add_discovery_links');
  remove_action('wp_head','rest_output_link_wp_head');





//00500　contents width assign コンテンツ幅（大）の設定
  if ( ! isset( $content_width ) )
  {
    $content_width = 640;
  }



//00600 Add default posts and comments RSS feed links to head.
  add_theme_support( 'automatic-feed-links' );



//00700 サムネイル
  add_theme_support( 'post-thumbnails' );
  add_image_size( 'thumbnail-profile', 400, 400, true );
  add_image_size( 'thumb75', 75, 75, true);


//00800 サイドバー
  //top サイドバー追加 v.1.0.5
  add_action( 'widgets_init', 'topSidebar_init' );
    function topSidebar_init() {
        register_sidebar( array(
          'name' => __('TOPページ用サイドバー'),
          'id' => 'topSidebar',
          'description' => __('TOPページ用サイドバーです'),
          'before_widget' => '<aside id="%1$s" class="top-side-bar widget %2$s">',
          'after_widget' => '</aside>',
          'before_title' => '<h3 class="">',
          'after_title' => '</h3>',
        ) );
    }


  //フッター サイドバー01追加
  add_action( 'widgets_init', 'footerSidebar01_init' );
    function footerSidebar01_init() {
        register_sidebar( array(
          'name' => __('フッター用サイドバー01'),
          'id' => 'footersidebar01',
          'description' => __('フッター用サイドバー01です'),
          'before_widget' => '<aside id="%1$s" class="footer-side-bar widget %2$s">',
          'after_widget' => '</aside>',
          'before_title' => '<div class="">',
          'after_title' => '</h3>',
        ) );
    }

  //フッター サイドバー02追加
  add_action( 'widgets_init', 'footerSidebar02_init' );
    function footerSidebar02_init() {
        register_sidebar( array(
          'name' => __('フッター用サイドバー02'),
          'id' => 'footersidebar02',
          'description' => __('フッター用サイドバー02です'),
          'before_widget' => '<aside id="%1$s" class="footer-side-bar widget %2$s">',
          'after_widget' => '</aside>',
          'before_title' => '<div class="">',
          'after_title' => '</h3>',
        ) );
    }


  //フッター サイドバー03追加
  add_action( 'widgets_init', 'footerSidebar03_init' );
    function footerSidebar03_init() {
        register_sidebar( array(
          'name' => __('フッター用サイドバー03'),
          'id' => 'footersidebar03',
          'description' => __('フッター用サイドバー03です'),
          'before_widget' => '<aside id="%1$s" class="footer-side-bar widget %2$s">',
          'after_widget' => '</aside>',
          'before_title' => '<div class=""></div><h3>',
          'after_title' => '</h3>',
        ) );
    }


  //フッター サイドバー04追加
  add_action( 'widgets_init', 'footerSidebar04_init' );
    function footerSidebar04_init() {
        register_sidebar( array(
          'name' => __('フッター用サイドバー04'),
          'id' => 'footersidebar04',
          'description' => __('フッター用サイドバー04です'),
          'before_widget' => '<aside id="%1$s" class="footer-side-bar widget %2$s">',
          'after_widget' => '</aside>',
          'before_title' => '<div class=""></div><h3>',
          'after_title' => '</h3>',
        ) );
    }


  //運転免許受付センターサイドバー
  add_action( 'widgets_init', 'untenmenkyouketsukecenterSidebar_init' );
    function untenmenkyouketsukecenterSidebar_init() {
        register_sidebar( array(
          'name' => __('合宿免許ハッピーサイドバー'),
          'id' => 'untenmenkyouketsukecentersidebar',
          'description' => __('合宿免許ハッピー用サイドバーです'),
          'before_widget' => '<aside id="%1$s" class="untenmenkyouketsukecenterSidebar widget %2$s">',
          'after_widget' => '</aside>',
          'before_title' => '<div class=""></div><h3>',
          'after_title' => '</h3>',
        ) );
    }

    add_action( 'widgets_init', 'side_banner_sty' );
    function side_banner_sty() {
        register_sidebar( array(
          'name' => __('バナー1'),
          'id' => 'side_banner_sty_id',
          'description' => __('バナー1サイドバーです'),
          'before_widget' => '<aside id="%1$s" class="side_banner_sty_wrap widget %2$s">',
          'after_widget' => '</aside>',
          'before_title' => '<div class=""></div><h3>',
          'after_title' => '</h3>',
        ) );
    }

      add_action( 'widgets_init', 'side_banner_sty2' );
      function side_banner_sty2() {
          register_sidebar( array(
            'name' => __('バナー2'),
            'id' => 'side_banner_sty2_id',
            'description' => __('バナー2サイドバーです'),
            'before_widget' => '<aside id="%1$s" class="side_banner_sty_wrap widget %2$s">',
            'after_widget' => '</aside>',
            'before_title' => '<div class=""></div><h3>',
            'after_title' => '</h3>',
          ) );
      }
      add_action( 'widgets_init', 'side_banner_sty3' );
      function side_banner_sty3() {
          register_sidebar( array(
            'name' => __('バナー3'),
            'id' => 'side_banner_sty3_id',
            'description' => __('バナー3サイドバーです'),
            'before_widget' => '<aside id="%1$s" class="side_banner_sty3_wrap widget %2$s">',
            'after_widget' => '</aside>',
            'before_title' => '<div class=""></div><h3>',
            'after_title' => '</h3>',
          ) );
      }
      add_action( 'widgets_init', 'side_banner_sty4' );
      function side_banner_sty4() {
          register_sidebar( array(
            'name' => __('バナー4'),
            'id' => 'side_banner_sty4_id',
            'description' => __('バナー4サイドバーです'),
            'before_widget' => '<aside id="%1$s" class="side_banner_sty4_wrap widget %2$s">',
            'after_widget' => '</aside>',
            'before_title' => '<div class=""></div><h3>',
            'after_title' => '</h3>',
          ) );
      }


      add_action( 'widgets_init', 'side_kikaku' );
      function side_kikaku() {
          register_sidebar( array(
            'name' => __('ハッピーだけの特別企画'),
            'id' => 'side_kikaku_id',
            'description' => __('ハッピーだけの特別企画サイドバーです'),
            'before_widget' => '<aside id="%1$s" class="side_kikaku_wrap widget %2$s">',
            'after_widget' => '</aside>',
            'before_title' => '<div class=""></div><h3>',
            'after_title' => '</h3>',
          ) );
      }
      add_action( 'widgets_init', 'side_location_select' );
      function side_location_select() {
          register_sidebar( array(
            'name' => __('目的別教習所選び'),
            'id' => 'side_location_select_id',
            'description' => __('目的別教習所選びサイドバーです'),
            'before_widget' => '<aside id="%1$s" class="side_location_select_wrap widget %2$s">',
            'after_widget' => '</aside>',
            'before_title' => '<div class=""></div><h3>',
            'after_title' => '</h3>',
          ) );
      }
      add_action( 'widgets_init', 'side_license_sty' );
      function side_license_sty() {
          register_sidebar( array(
            'name' => __('取得可能免許で探す'),
            'id' => 'side_license_sty_id',
            'description' => __('取得可能免許で探すサイドバーです'),
            'before_widget' => '<aside id="%1$s" class="side_license_sty_wrap widget %2$s">',
            'after_widget' => '</aside>',
            'before_title' => '<div class=""></div><h3>',
            'after_title' => '</h3>',
          ) );
      }
      add_action( 'widgets_init', 'side_publicity' );
      function side_publicity() {
          register_sidebar( array(
            'name' => __('運転免許皆伝'),
            'id' => 'side_publicity_id',
            'description' => __('運転免許皆伝サイドバーです'),
            'before_widget' => '<aside id="%1$s" class="side_publicity_wrap widget %2$s">',
            'after_widget' => '</aside>',
            'before_title' => '<div class=""></div><h3>',
            'after_title' => '</h3>',
          ) );
      }
      add_action( 'widgets_init', 'side_halfhalf' );
      function side_halfhalf() {
          register_sidebar( array(
            'name' => __('１週間分割'),
            'id' => 'side_halfhalf_id',
            'description' => __('１週間分割サイドバーです'),
            'before_widget' => '<aside id="%1$s" class="side_halfhalf_wrap widget %2$s">',
            'after_widget' => '</aside>',
            'before_title' => '<div class=""></div><h3>',
            'after_title' => '</h3>',
          ) );
      }


      add_action( 'widgets_init', 'side_provisional_license' );
      function side_provisional_license() {
          register_sidebar( array(
            'name' => __('仮免からの合宿免許'),
            'id' => 'side_provisional_license_id',
            'description' => __('仮免からの合宿免許サイドバーです'),
            'before_widget' => '<aside id="%1$s" class="side_provisional_license_wrap widget %2$s">',
            'after_widget' => '</aside>',
            'before_title' => '<div class=""></div><h3>',
            'after_title' => '</h3>',
          ) );
      }
      add_action( 'widgets_init', 'side_penalty' );
      function side_penalty() {
          register_sidebar( array(
            'name' => __('行政処分を受けた方でも安心'),
            'id' => 'side_penalty_id',
            'description' => __('行政処分を受けた方でも安心サイドバーです'),
            'before_widget' => '<aside id="%1$s" class="side_penalty_wrap widget %2$s">',
            'after_widget' => '</aside>',
            'before_title' => '<div class=""></div><h3>',
            'after_title' => '</h3>',
          ) );
      }
      add_action( 'widgets_init', 'side_qa' );
      function side_qa() {
          register_sidebar( array(
            'name' => __('合宿免許のQ&A'),
            'id' => 'side_qa_id',
            'description' => __('合宿免許のQ&Aサイドバーです'),
            'before_widget' => '<aside id="%1$s" class="side_qa_wrap widget %2$s">',
            'after_widget' => '</aside>',
            'before_title' => '<div class=""></div><h3>',
            'after_title' => '</h3>',
          ) );
      }
      add_action( 'widgets_init', 'side_quick_search' );
      function side_quick_search() {
          register_sidebar( array(
            'name' => __('合宿免許クイック検索'),
            'id' => 'side_quick_search_id',
            'description' => __('合宿免許クイック検索サイドバーです'),
            'before_widget' => '<aside id="%1$s" class="side_qa_wrap widget %2$s">',
            'after_widget' => '</aside>',
            'before_title' => '<div class=""></div><h3>',
            'after_title' => '</h3>',
          ) );
      }
function sidebar() {
  echo '
  <div id="sidebar" class="sidebarContent">
    <div class="sidebarWrapper">
    ';
    dynamic_sidebar( 'side_banner_sty_id' );
    dynamic_sidebar('side_quick_search_id');//クイック検索
    dynamic_sidebar( 'side_banner_sty2_id' );
    dynamic_sidebar( 'side_kikaku_id' );
    dynamic_sidebar( 'side_location_select_id' );
    dynamic_sidebar( 'side_banner_sty3_id' );
    dynamic_sidebar( 'side_publicity_id' );
    dynamic_sidebar( 'side_halfhalf_id' );
    dynamic_sidebar( 'side_provisional_license_id' );
    dynamic_sidebar( 'side_banner_sty4_id' );
    dynamic_sidebar( 'side_penalty_id' );
    dynamic_sidebar( 'side_qa_id' );
    echo '
      </div>
    </div>
  ';

}
add_shortcode('sidebar', 'sidebar');





//00900 ファイル実行 ショートコード v.1.0.8
  //[myphp file="test.php"]
  function Include_my_php($params = array())
  {
    extract(shortcode_atts(array('file' => 'default',), $params));
    ob_start();
    include get_theme_root().'/'.get_template()."/$file.php";
    return ob_get_clean();
  }
  add_shortcode('myphp', 'Include_my_php');




//00950　特定のカテゴリのみニュースに出す カテゴリ表記なし
// [news1 cat="1" num="10"]
//echo do_shortcode( '[news21 cat="1" num="10"]' );
/* 最新記事リスト */
  function getNewItems1($atts)
  {
    extract(shortcode_atts(array(
        'num' => '',    //最新記事リストの取得数
        'cat' => '',    //表示する記事のカテゴリー指定
    ), $atts));

    global $post;
    $oldpost = $post;

    $myposts = get_posts('numberposts='.$num.'&order=DESC&orderby=post_date&category='.$cat);
    $retHtml = '<ul  class="newsListWrapper withCategory newsList1">';

    foreach ($myposts as $post) :
      $content = strip_tags($post->post_content);
      $cat = get_the_category();//カテゴリー
      $catname = $cat[0]->cat_name;//カテゴリー名
      $catslug = $cat[0]->slug;//カテゴリースラッグ
    $category_id = get_cat_ID( $catname );// 指定したカテゴリーの ID を取得
    $category_link = get_category_link( $category_id );// このカテゴリーの URL を取得

    // このカテゴリーの URL を取得
    $category_link = get_category_link( $category_id );
      setup_postdata($post);
    $retHtml .= '<li class="categoryListWrapper">';
    $retHtml .= '<span class="entry-date">'.get_post_time('Y.m.d').'</span>'; //"Y年n月j日 l H:i:s"
    $retHtml .= '<span class="cat ' . $catslug . '">' . $catname . '</span>'; //"Y年n月j日 l H:i:s"
        $retHtml .= '<h3 class="categoryListTitle santen "><a href="'.get_permalink().'">'.the_title("","",false).'</a></h3>';
        //$retHtml .= '<p class="post-content">'.nl2br($content).'</p>';
        //$retHtml.='<p class="more-detail"><a href="'.get_permalink().'">詳しく見る</a></p>';

        $retHtml .= '</li>';
  endforeach;
  $retHtml .= '</ul>';
  $post = $oldpost;
  wp_reset_postdata();

  return $retHtml;
  }
add_shortcode('news1', 'getNewItems1');


//01000　特定のカテゴリのみニュースに出す カテゴリ表記なし
// [news2 cat="1" num="10"]
//echo do_shortcode( '[news2 cat="1" num="10"]' );
/* 最新記事リスト */
  function getNewItems2($atts)
  {
    extract(shortcode_atts(array(
        'num' => '',    //最新記事リストの取得数
        'cat' => '',    //表示する記事のカテゴリー指定
    ), $atts));

    global $post;
    $oldpost = $post;

    $myposts = get_posts('numberposts='.$num.'&order=DESC&orderby=post_date&category='.$cat);
    $retHtml = '<ul class="newsListWrapper withoutCategory newsList2">';

    foreach ($myposts as $post) :
      $content = strip_tags($post->post_content);
      $cat = get_the_category();//カテゴリー
      $catname = $cat[0]->cat_name;//カテゴリー名
      $catslug = $cat[0]->slug;//カテゴリースラッグ
    $category_id = get_cat_ID( $catname );// 指定したカテゴリーの ID を取得
    $category_link = get_category_link( $category_id );// このカテゴリーの URL を取得

    // このカテゴリーの URL を取得
    $category_link = get_category_link( $category_id );
      setup_postdata($post);
    $retHtml .= '<li class="categoryListWrapper">';
    $retHtml .= '<time class="entry-date">'.get_post_time('Y/m/d').'</time>'; //"Y年n月j日 l H:i:s"
        $retHtml .= '<h2 class="categoryListTitle "><i class="fa fa-caret-right" aria-hidden="true"></i><a href="'.get_permalink().'">'.the_title("","",false).'</a></h2>';
        //$retHtml .= '<p class="post-content">'.nl2br($content).'</p>';
        //$retHtml.='<p class="more-detail"><a href="'.get_permalink().'">詳しく見る</a></p>';

        $retHtml .= '</li>';
  endforeach;
  $retHtml .= '</ul>';
  $post = $oldpost;
  wp_reset_postdata();

  return $retHtml;
  }
add_shortcode('news2', 'getNewItems2');



//01100  パンくずリスト
function breadcrumb(){
  global $post;
  $str ='';
  if(is_home() || is_front_page()){
   $str.= '<div id="breadcrumb">';
   $str.= '<ul>';
   $str.= '<li itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><span itemprop="title">合宿免許を選ぶならHappyの運転免許で！顧客満足度90％（当社調べ）の合宿免許Happyなら激安、親切、安心、丁寧！</span></li>';
   $str.='</ul>';
   $str.='</div>';
  }
  if(!is_home()&&!is_admin()&&!is_front_page()){ /* !is_admin は管理ページ以外という条件分岐 */
    $str.= '<div id="breadcrumb">';
    $str.= '<ul>';
    $str.= '<li itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a href="' . home_url('/') .'" class="home" itemprop="url" ><span itemprop="title">合宿免許Happyホーム</span></a></li>';

    /* 投稿のページ */
    if(is_singular('school')){
      $terms = get_the_terms($post->ID,'school_cat');
      $cat = $terms[0];
      // if($cat -> parent != 0){
      //   $ancestors = array_reverse(get_ancestors( $cat -> term_id, 'school_cat' ));
      //   foreach($ancestors as $ancestor){
      //     $str.='<li itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a href="'. get_term_link($ancestor).'"  itemprop="url" ><span itemprop="title">'. get_term_name($ancestor). '</span></a></li>';
      //             }
      // }
      $str.='<li itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a href="https://www.happymenkyo.com/school_cat/all" itemprop="url" ><span itemprop="title">全ての教習所</span></a></li>';
      $str.= '<li itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><span itemprop="title">'. overStringSafe($post -> post_title, 30) .'</span></li>';
    }else
    if(is_single()){
      $categories = get_the_category($post->ID);
      $cat = $categories[0];
      if($cat -> parent != 0){
        $ancestors = array_reverse(get_ancestors( $cat -> cat_ID, 'category' ));
        foreach($ancestors as $ancestor){
          $str.='<li itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a href="'. get_category_link($ancestor).'"  itemprop="url" ><span itemprop="title">'. get_cat_name($ancestor). '</span></a></li>';
                  }
      }
      $str.='<li itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a href="'. get_category_link($cat -> term_id). '" itemprop="url" ><span itemprop="title">'. $cat-> cat_name . '</span></a></li>';
      $str.= '<li itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><span itemprop="title">'. overStringSafe($post -> post_title, 30) .'</span></li>';
    }

    elseif(is_tax()) {
        if(is_tax('school_cat')) {
         if(is_tax('school_cat', array('all'))){
          $str.='<li itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><span itemprop="title">'. overStringSafe($cat -> name, 30) . '全ての教習所</span></li>';
         }else{
          if(is_tax('school_cat', array('month_01','month_02','month_03',
          'month_04','month_05','month_06',
          'month_07','month_08','month_09',
          'month_10','month_11','month_12'))){
           $cat = get_queried_object();
           $pagename = $cat -> name;
           $top_mozi = substr($pagename, 0, 1);
           if((int)$top_mozi === 0){$pagename = substr($pagename, 1);}

           $str.='<li itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><span itemprop="title">'. overStringSafe($pagename, 30) . 'の掘り出し教習所一覧</span></li>';
          }else{
           $cat = get_queried_object();
           $str.='<li itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><span itemprop="title">'. overStringSafe($cat -> name, 30) . 'の教習所一覧</span></li>';
          }
         }
        }else{
         $cat = get_queried_object();
         $str.='<li itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><span itemprop="title">'. overStringSafe($cat -> name, 30) . '</span></li>';
      }
    }

    /* 固定ページ */
    elseif(is_page()){
      wp_reset_query();
      if($post -> post_parent != 0 ){
        $ancestors = array_reverse(get_post_ancestors( $post->ID ));
        foreach($ancestors as $ancestor){
          $str.='<li itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a href="'. get_permalink($ancestor).'" itemprop="url" ><span itemprop="title">'. get_the_title($ancestor) .'</span></a></li>';
        }
      }
      $getid = $_GET['id'];
      $tokubethu = '';
      if($getid == 'sp1'){
       $tokubethu = '限定割';
      }else if($getid == 'sp2'){
       $tokubethu = 'ツイン特別';
      }else if($getid == 'sp3'){
       $tokubethu = '二輪同時特別';
      }else if($getid == 'sp4'){
       $tokubethu = '年末一時帰宅';
      }else if($getid == 'sp5'){
       $tokubethu = '卒業日一時帰宅';
      }else if($getid == 'sp6'){
       $tokubethu = 'オフシーズン一時帰宅';
      }else if($getid == 'sp7'){
       $tokubethu = 'シングルユース';
      }else if($getid == 'sp8'){
       $tokubethu = 'グループユース';
      }else if($getid == 'sp9'){
       $tokubethu = '春特';
      }else if($getid == 'sp10'){
       $tokubethu = 'ゴールド';
      }else if($getid == 'sp11'){
       $tokubethu = '自炊プラン';
      }
      if(!empty($tokubethu)){
       $str.= '<li itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><span itemprop="title">'.$tokubethu.'の教習所一覧</span></li>';
      }else{
       $str.= '<li itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><span itemprop="title">'. overStringSafe($post -> post_title, 30) .'</span></li>';
      }
    }

    /* カテゴリページ */
    elseif(is_category()) {
      $cat = get_queried_object();
      if($cat -> parent != 0){
        $ancestors = array_reverse(get_ancestors( $cat -> cat_ID, 'category' ));
        foreach($ancestors as $ancestor){
          $str.='<li itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a href="'. get_category_link($ancestor) .'" itemprop="url" ><span itemprop="title">'. get_cat_name($ancestor) .'</span></a></li>';
        }
      }
      $str.='<li itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><span itemprop="title">'. overStringSafe($cat -> name, 30) . '一覧</span></li>';
    }

    /* タグページ */
    elseif(is_tag()){
      $str.='<li itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><span itemprop="title">'. single_tag_title( '' , false ). '</span></li>';
    }

    /* 時系列アーカイブページ */
    elseif(is_date()){
      if(get_query_var('day') != 0){
        $str.='<li itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a href="'. get_year_link(get_query_var('year')). '" itemprop="url" ><span itemprop="title">' . get_query_var('year'). '年</span></a></li>';
        $str.='<li itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a href="'. get_month_link(get_query_var('year'), get_query_var('monthnum')). '" itemprop="url" ><span itemprop="title">'. get_query_var('monthnum') .'月</span></a></li>';
        $str.='<li itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><span itemprop="title">'. get_query_var('day'). '</span>日</li>';
      } elseif(get_query_var('monthnum') != 0){
        $str.='<li itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a href="'. get_year_link(get_query_var('year')) .'" itemprop="url" ><span itemprop="title">'. get_query_var('year') .'年</span.</a></li>';
        $str.='<li itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><span itemprop="title">'. get_query_var('monthnum'). '</span>月</li>';
      } else {
        $str.='<li itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><span itemprop="title">'. get_query_var('year') .'年</span></li>';
      }
    }

    /* 投稿者ページ */
    elseif(is_author()){
      $str .='<li itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><span itemprop="title">投稿者 : '. get_the_author_meta('display_name', get_query_var('author')).'</span></li>';
    }

    /* 添付ファイルページ */
    elseif(is_attachment()){
      if($post -> post_parent != 0 ){
        $str.= '<li itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a href="'. get_permalink($post -> post_parent).'" itemprop="url" ><span itemprop="title">'. get_the_title($post -> post_parent) .'</span></a></li>';
      }
      $str.= '<li itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><span itemprop="title">' . $post -> post_title . '</span></li>';
    }

    /* 検索結果ページ */
    elseif(is_search()){
      $str.='<li itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><span itemprop="title">「'. get_search_query() .'」で検索した結果</span></li>';
    }

    /* 404 Not Found ページ */
    elseif(is_404()){
      $str.='<li itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><span itemprop="title">お探しの記事は見つかりませんでした。</span></li>';
    }

    /* その他のページ */
    else{
      $str.='<li itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><span itemprop="title">'. wp_title('', false) .'</span></li>';
    }
    $str.='</ul>';
    $str.='</div>';
    }
  echo $str;
  }

//01200 固定ページにカテゴリ付与機能を追加
//  add_action('init', 'add_categories_for_pages');
//
//  function add_categories_for_pages()
//  {
//    register_taxonomy_for_object_type('category', 'page');
//  }
//  add_action('pre_get_posts', 'nobita_merge_page_categories_at_category_archive');
//
//  function nobita_merge_page_categories_at_category_archive($query)
//  {
//    if ($query->is_category == true && $query->is_main_query()) {
//      $query->set('post_type', array('post', 'page', 'nav_menu_item'));
//    }
//  }

//01200
// =========================================================
// 文字数が制限オーバーした場合に、最後に…をつける処理
// =========================================================
function overStringSafe($string, $seigen) {
    $moji_count = strlen($string);
    $seigen = $seigen * 2;
    if (is_category()){
        if ($moji_count > $seigen) {
            $string = mb_substr($string, 0, 30, 'UTF-8');
            $string = $string. '>>>>';
        }
    }else{
        if ($moji_count > $seigen) {
            $string = mb_substr($string, 0, 30, 'UTF-8');
            $string = $string. '…';
        }
    }

    return $string;
}

//01300 管理バーにログアウトを追加
  function add_new_item_in_admin_bar()
  {
    global $wp_admin_bar;
    $wp_admin_bar->add_menu(array(
  'id' => 'new_item_in_admin_bar',
  'title' => __('ログアウト'),
  'href' => wp_logout_url(),
  ));
  }
  add_action('wp_before_admin_bar_render', 'add_new_item_in_admin_bar');



//01400 5.3-バージョンアップ通知を管理者のみ表示させるようにします。
  function update_nag_admin_only()
  {
    if (!current_user_can('administrator'))
    {
      remove_action('admin_notices', 'update_nag', 3);
    }
  }
  add_action('admin_init', 'update_nag_admin_only');


//01500 tagにIDタグを追加　
    //[body_id]
    //echo do_shortcode( '[body_id]' );
    function body_idFunc()
    {
        if (is_front_page()) {
            $body_id = home;
        } elseif (is_single() || is_page()) {
            $page = get_page(get_the_ID());
            $body_id = $page->post_name;
        } elseif (is_category()) {
            $category = get_the_category();
            $body_id = 'category_'.$category[0]->category_nicename;
        }

        return $body_id;
    }
    add_shortcode('body_id', 'body_idFunc');


//01600 カテゴリーページの「カテゴリー：○○」の「カテゴリー：」を消す
    add_filter('get_the_archive_title', function ($title) {

        if (is_category()) {
            $title = single_cat_title('', false);
        }

        return $title;

    });

//01700 bodyタグのclassにページスラッグを追加する
    function body_classFunc($classes = '')
    {
        if (is_page()) {
            $page = get_page(get_the_ID());
            $classes[] = 'page-'.$page->post_name;
            if ($page->post_parent) {
                $classes[] = 'page-'.get_page_uri($page->post_parent).'-child';
            }
        }

        return $classes;
    }
    add_filter('body_class', 'body_classFunc');



//01800 URLからcategoryを抜く
    add_filter('user_trailingslashit', 'remcat_function');
    function remcat_function($link) {
        return str_replace("/category/", "/", $link);
    }

    add_action('init', 'remcat_flush_rules');
    function remcat_flush_rules() {
        global $wp_rewrite;
        $wp_rewrite->flush_rules();
    }

    add_filter('generate_rewrite_rules', 'remcat_rewrite');
    function remcat_rewrite($wp_rewrite) {
        $new_rules = array('(.+)/page/(.+)/?' => 'index.php?category_name='.$wp_rewrite->preg_index(1).'&paged='.$wp_rewrite->preg_index(2));
        $wp_rewrite->rules = $new_rules + $wp_rewrite->rules;
    }


//01900 サムネイルサイズの追加設定
  // add_image_size('thumb75', 75, 75, true);


//02000 管理画面とフロントの見え方の統一
add_editor_style( get_stylesheet_directory_uri().'/assets/library/css/editor-style.css');

function my_admin_style(){
    wp_enqueue_style( 'my_admin_style', get_template_directory_uri().'/assets/library/css/editor-style.css' );
}
add_action( 'admin_enqueue_scripts', 'my_admin_style' );


//02100 ロゴ追加
add_action( 'customize_register', 'theme_customize' );

function theme_customize($wp_customize){

  //画像
  $wp_customize->add_section( 'img_section', array(
    'title' => '画像', //セクションのタイトル
    'priority' => 59, //セクションの位置
    'description' => '画像をアップロードしてください。', //セクションの説明
  ));

    $wp_customize->add_setting( 'logo_img' ); //設定項目を追加
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'logo_img', array(
      'label' => 'ロゴ画像', //設定項目のタイトル
      'section' => 'img_section', //追加するセクションのID
      'settings' => 'logo_img', //追加する設定項目のID
      'description' => 'ロゴ画像を設定してください。', //設定項目の説明
    )));

}

/* テーマカスタマイザーで設定された画像のURLを取得
---------------------------------------------------------- */
//ヘッダーロゴ画像
function get_the_logo_img_url(){
  return esc_url( get_theme_mod( 'logo_img' ) );
}


//02200　デバイス判定ロジック
/*is_mobile
---------------------------------------------------------- */
function is_mobile() {
  $useragents = array(
    'iPhone',          // iPhone
    'iPod',            // iPod touch
    'Android',         // 1.5+ Android
    'dream',           // Pre 1.5 Android
    'CUPCAKE',         // 1.5+ Android
    'blackberry9500',  // Storm
    'blackberry9530',  // Storm
    'blackberry9520',  // Storm v2
    'blackberry9550',  // Storm v2
    'blackberry9800',  // Torch
    'webOS',           // Palm Pre Experimental
    'incognito',       // Other iPhone browser
    'webmate'          // Other iPhone browser
  );
  $pattern = '/'.implode('|', $useragents).'/i';
  return preg_match($pattern, $_SERVER['HTTP_USER_AGENT']);
}


//02300 セキュリティ
/*
 WordPressで作られたということと、そのバージョンを伝えるためのタグ
　<meta name=”generator” content=”WordPress 4.2.5″>
 を消す
*/
 remove_action('wp_head', 'wp_generator');


/*
 長くなってしまったパーマリンクを短くするための短縮URL
　<link rel=”shortlink” href=”http://example.com/?p=1234″ />
 を消す
*/
remove_action('wp_head', 'wp_shortlink_wp_head');


/*
 Windows Live riterというブログ編集ツールを使って編集するためのリソースファイルwlwmanifest.xml
　<link rel=”EditURI” type=”application/wlwmanifest+xml”
title=”RSD” href=”http://exmample.com/wp-includes/wlwmanifest.xml” />
 を消す
*/
remove_action('wp_head', 'wlwmanifest_link');


/*
 外部アプリケーションからリモート投稿や編集をするためのリソースファイル
　<link rel=”EditURI” type=”application/rsd+xml”
title=”RSD” href=”http://exmample.com/xmlrpc.php?rsd” />
 を消す
*/
remove_action('wp_head', 'rsd_link');


/*
 RSSフィード
　<link rel=”alternate” type=”application/rss+xml”
title=”フィード” href=”http://exmample.com/feed/” />
<link rel=”alternate” type=”application/rss+xml”
title=”コメントフィード” href=”http://exmample.com/comments/feed/” />
 を消す
*/
remove_action('wp_head', 'feed_links_extra', 3);


/*
 絵文字に対応するためのJavaScriptとCSSを読み込むタグ。
 を消す
*/
remove_action( 'wp_head', 'print_emoji_detection_script', 7 ); //絵文字対応
remove_action( 'admin_print_scripts', 'print_emoji_detection_script' ); //絵文字対応
remove_action( 'wp_print_styles', 'print_emoji_styles' ); //絵文字対応
remove_action( 'admin_print_styles', 'print_emoji_styles' ); //絵文字対応


/*
 絵文字に対応するためのJavaScriptとCSSを読み込むタグ。
 を消す
*/
remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 ); //分割ページへのリンク
remove_action( 'wp_head', 'start_post_rel_link', 10, 0 ); //分割ページへのリンク
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 ); //分割ページへのリンク


/*
 indexへのリンクさせない。
*/
remove_action( 'wp_head', 'index_rel_link' );


/*
xmlrpc.php攻撃対策
*/
//  1）xmlrpc.phpの無効化(verにより効かない可能性あり)
add_filter('xmlrpc_enabled','__return_false');

// 2）「X-Pingback」のヘッダー情報も消去
function remove_x_pingback($headers) {
unset($headers['X-Pingback']);
return $headers;
}
add_filter('wp_headers','remove_x_pingback');


//02400 ヘッダーフッターメニュー処理
register_nav_menus(array(
    'globalmenu' => esc_html__('グローバルメニュー', 'globalmenus'),
));
register_nav_menus(array(
    'footermenu' => esc_html__('フッターメニュー', 'footer_menus'),
));
register_nav_menus(array(
    'spglobalmenu' => esc_html__('メニュー', 'spglobalmenu'),
));
register_nav_menus(array(
    'spglobalmenu' => esc_html__('メニュー', 'spglobalmenu'),
));

//02500 tinyMCE advance フォントサイズ
add_filter( 'tiny_mce_before_init', 'my_mce_before_init',5 );
function my_mce_before_init( $settings ) {
    $settings['fontsize_formats'] = "0.8rem 1rem 1.2rem 1.4rem 1.6rem 1.8rem 2rem 2.2rem 2.4rem";
    return $settings;
}

//02600 コピーライト ショートコード
function copyrightFunc()
{
    return '&copy;&nbsp;2017-'.date("Y").'&nbsp;<a href="'.home_url().'" class="copyright">合宿免許Happy</a>';
}
add_shortcode('copyright', 'copyrightFunc');


//02700 SNS　ショートコード
function snsFunc()

{
  if ( !is_home() && !is_front_page() ){
    $snsContent=  '-' .get_the_title();
  }
return'
            <div id="sns">
              <div class="snsWrapper">
                <a id="twitterBtn" class="twitter btn" href="http://twitter.com/share?url=' . get_the_permalink() . '&text=' . get_bloginfo('name') . ' ' . $snsContent .'" target="_blank">
                  <span class="icon-twitter"></span>
                </a>
                <a id="fbBtn" class="fb btn" href="http://www.facebook.com/share.php?u=' . get_the_permalink() . '" onclick="window.open(this.href, \'FBwindow\', \'width=650, height=450, menubar=no, toolbar=no, scrollbars=yes\'); return false;" target="_blank">
                  <span class="icon-facebook"></span>
                </a>
                <a id="lineBtn" class="line btn" href="http://line.me/R/msg/text/?'. get_the_permalink() . ' ' . get_bloginfo('name') . $snsContent . '" target="_blank">
                  <span class="icon-line"></span>
                </a>
              </div>
            </div>


        ';
      }
add_shortcode('sns', 'snsFunc');



//02800 カスタム投稿一覧処理
// [custompost_get]
function custompost_get_Func($attr) {
  //URLから今何ページ目を表示したいのか取得します
$now_page = get_query_var('page');

//スキップする記事数を決めます。
//1ページ目なら0、2ページ目から18件の記事をスキップして、
//1ページ目なら1件目、2ページ目から19件目から表示できるようにします。
$offset = ( $now_page - 1 ) * 18;

if($attr[4] == "0"){
  $customPostArg = array(
    'paged'        => $paged,
    'offset' => $offset,
    'posts_per_page' => $attr[1],
    'post_type'      => $attr[0],  // カスタム投稿タイプ名
    'order'      => 'DESC',  // カスタム投稿タイプ名
    'tax_query'      => array(
      // 'relation' => 'AND',
      array(
        'taxonomy' => $attr[2],  // カスタムタクソノミー名
        'field'    => 'slug',  // ターム名を term_id,slug,name のどれで指定するか
        'terms'    => $attr[3] // タクソノミーに属するターム名
      )
    )
  );
}else{
  $customPostArg = array(
    'paged'        => $paged,
    'offset' => $offset,
    'posts_per_page' => $attr[1],
    'post_type'      => $attr[0],  // カスタム投稿タイプ名
    'order'      => 'DESC',  // カスタム投稿タイプ名
    'tax_query'      => array(
      'relation' => 'AND',
      array(
        'taxonomy' => $attr[2],  // カスタムタクソノミー名
        'field'    => 'slug',  // ターム名を term_id,slug,name のどれで指定するか
        'terms'    => $attr[3] // タクソノミーに属するターム名
      ),
      array(
        'taxonomy' => $attr[2],  // カスタムタクソノミー名
        'field'    => 'slug',  // ターム名を term_id,slug,name のどれで指定するか
        'terms'    => $attr[4] // タクソノミーに属するターム名
      )
    )
  );
}


  global $post;
  $myposts = get_posts($customPostArg);
  foreach($myposts as $post) :
  setup_postdata($post);
  // アイキャッチ画像のIDを取得
  $thumbnail_id = get_post_thumbnail_id();
  $thumb_post = get_post($thumbnail_id);
  // mediumサイズの画像内容を取得（引数にmediumをセット）
  if (has_post_thumbnail() )  {
    $eye_img = wp_get_attachment_image_src( $thumbnail_id , $size );
    $thumb_url=$eye_img[0];
  }
  else {
    $thumb_url ="/lib/wp-content/uploads/2017/01/img09-200x200.jpg";
  }
  //「説明」を取得
  $thumb_content = $thumb_post->post_content;
  //キャプションを取得
  $thumb_caption = $thumb_post->post_excerpt;
  //altを取得
  $post_meta = get_post_meta( $thumbnail_id );
  $thumb_alt = $post_meta['_wp_attachment_image_alt'][0];

  if(post_custom('tax_included_price') == NULL){
    $price = '';
  }else{
    $price = '<p class="post_content"><span class="red">￥'. post_custom('tax_included_price') . '</span>&nbsp;税込</p>';
  }

  $terms = get_the_terms($myposts->ID ,'productregistration_cat');
  $tags = "";
  foreach ($terms as $term) :
    $tags .= '<div class="categorys">'.$term->name.'</div>';
  endforeach;

  $custompost_get.= '<li>';
    $custompost_get.= '<div class="list_inner">';
      $custompost_get.= $tags;
      $custompost_get.= '<a href="'.get_permalink().'">';
      $custompost_get.= '<img src="'. $thumb_url.'" alt="'.$thumb_alt.'" class="imgRes" />';
      $custompost_get.= '<p class="post_content">'.post_custom('product_name'). '</p>';
      $custompost_get.= '<p class="post_content">'. post_custom('ancillary_information') . '</p>'.$price.'</a>'; $discription_flg++;
    $custompost_get.= '</div>';
  $custompost_get.= '</li>';
  endforeach;
  wp_reset_postdata();
  return $custompost_get;
}
add_shortcode("custompost_get", "custompost_get_Func");


// ページネーション
// ============================
// ページネーション処理
// ============================
function get_posts_list($post_type, $orderby, $ter, $flag) {

    global $wpdb;
    //$sql  = 'SELECT * FROM wp_posts WHERE post_type = "'. $post_type. '" AND post_status = "publish" ORDER BY '. $orderby .' DESC';
    if($post_type == "school" && !empty($ter) && $flag === 0){
      $sql  = 'SELECT *
                FROM wp_posts
                WHERE post_type = "'. $post_type. '" AND post_status =  "publish"
                      AND id IN(
                          SELECT post_id
                          FROM wp_postmeta
                          WHERE meta_value LIKE "%'.$ter.'%")
                     ORDER BY post_date DESC ';
    }
    if($post_type == "school" && !empty($ter) && $flag === 1){
      $sql  = 'SELECT *
                FROM wp_posts
                WHERE post_type = "'. $post_type. '" AND post_status =  "publish"
                      AND id IN(
                          SELECT object_id
                          FROM wp_term_relationships
                          WHERE term_taxonomy_id = (
                              SELECT term_taxonomy_id
                              FROM wp_term_taxonomy AS tt
                              INNER  JOIN wp_terms AS tm ON tt.term_id = tm.term_id
                              WHERE tm.slug =  "'.$ter.'"  ))
                     ORDER  BY post_date DESC ';
    }
//     if (($ter != "0")&&($maker_flag == "0")&&($post_type == "post")) {
//       $sql  = 'SELECT *
//                FROM wp_posts
//                WHERE post_type = "'. $post_type. '" AND post_status =  "publish"
//                      AND id IN(
//                          SELECT object_id
//                          FROM wp_term_relationships
//                          WHERE term_taxonomy_id = (
//                              SELECT term_taxonomy_id
//                              FROM wp_term_taxonomy AS tt
//                              INNER  JOIN wp_terms AS tm ON tt.term_id = tm.term_id
//                              WHERE tm.slug =  "'.$ter.'"  ))
//                     ORDER  BY post_date DESC ';
//     }else{
// $sql  = 'SELECT *
// FROM wp_posts
// WHERE id IN(SELECT id
// FROM wp_posts
// WHERE post_type = "'. $post_type. '" AND post_status =  "publish"
// AND id IN(
// SELECT object_id
// FROM wp_term_relationships
// WHERE term_taxonomy_id = (
// SELECT term_taxonomy_id
// FROM wp_term_taxonomy AS tt
// INNER  JOIN wp_terms AS tm ON tt.term_id = tm.term_id
// WHERE tm.slug =  "'.$maker_flag.'" )
// )) AND id IN(SELECT id
// FROM wp_posts
// WHERE post_type = "'. $post_type. '" AND post_status =  "publish"
// AND id IN(
// SELECT object_id
// FROM wp_term_relationships
// WHERE term_taxonomy_id = (
// SELECT term_taxonomy_id
// FROM wp_term_taxonomy AS tt
// INNER  JOIN wp_terms AS tm ON tt.term_id = tm.term_id
// WHERE tm.slug =  "'.$ter.'" )
// ))
// ORDER  BY post_date DESC ';

//     }
//}

    $sql .= '';
    $sql .= '';

    $result = $wpdb->get_results($sql);

    $flg = 0;
    foreach ($result as $data) {
        $news_data_array[$flg]['post_title'] = $data->post_title;
        $news_data_array[$flg]['ID'] = $data->ID;

        // 日付処理
        $nen = substr($data->post_date, 0, 4);
        $tsuki = substr($data->post_date, 5, 2);
        $tsuki = intval($tsuki);
        $hinichi = substr($data->post_date, 8, 2);
        $hinichi = intval($hinichi);
        //$news_data_array[$flg]['post_date'] = $nen. '年'. $tsuki. '月'. $hinichi. '日';
        // スラッシュ化
        $news_data_array[$flg]['post_date'] = $nen. '/'. $tsuki. '/'. $hinichi;

        // 更新日時
        $news_data_array[$flg]['post_modified'] = get_hachiketa_hiduke($data->post_modified);

        $news_data_array[$flg]['post_content'] = $data->post_content;

        $flg++;
    }

    return $news_data_array;

}

// =====================================
// ページネーションhtmlの取得
// =====================================
function get_posts_pagenation($sou_page, $gen_page, $sento, $saikoubi, $page_option) {

    $page_html  = '<div class="pagination textCenterCm">';
    $page_html .= '    <div class="wp-pagenavi">';


    // 7ページ以下なら
    if ($sou_page <= 7) {
        for ($i = 1; $i <= $sou_page; $i++) {
            if ($i == $gen_page) {
                $page_html .= '        <span class="current">'. $i. '</span>';
            } else {
                $page_html .= '        <a class="page larger" title="Page '. $i. '" href="'. home_url(). '/'. $page_option. 'page='. $i. '">'. $i. '</a>';
            }
        }


    // 7ページ以上なら
    } else {

        // gen_pageが１，２，３の場合
        if ($gen_page <= 3) {
            for ($i = 1; $i <= 5; $i++) {
                if ($i == $gen_page) {
                    $page_html .= '        <span class="current">'. $i. '</span>';
                } else {
                    $page_html .= '        <a class="page larger" title="Page '. $i. '" href="'. home_url(). '/'. $page_option. 'page='. $i. '">'. $i. '</a>';
                }
            }

            // 6つ目
            $page_html .= '        <span class="tenten">…</span>';

            // 7つ目
            $page_html .= '        <a class="nextpostslink" rel="next" href="'. home_url(). '/'. $page_option. 'page='. $sou_page. '">'. $saikoubi. '</a>';


        // 現在のページが最後のページから１番目、２番目、３番目なら
        } else if (($gen_page == $sou_page) || ($gen_page == $sou_page - 1) || ($gen_page == $sou_page - 2)) {

            // 1つ目
            $page_html .= '        <a class="nextpostslink" rel="next" href="'. home_url(). '/'. $page_option. 'page=1">'. $sento. '</a>';

            // 2つ目
            $page_html .= '        <span class="tenten">…</span>';

            $flg = $sou_page - 4;
            for ($i = $flg; $i <= $sou_page; $i++) {
                if ($i == $gen_page) {
                    $page_html .= '        <span class="current">'. $i. '</span>';
                } else {
                    $page_html .= '        <a class="page larger" title="Page '. $i. '" href="'. home_url(). '/'. $page_option. 'page='. $i. '">'. $i. '</a>';
                }
            }


        // 現在のページが１でもなく、最後でもない、中ページの場合
        } else {

            // 1つ目
            $page_html .= '        <a class="nextpostslink" rel="next" href="'. home_url(). '/'. $page_option. 'page=1">'. $sento. '</a>';

            // 2つ目
            $page_html .= '        <span class="tenten">…</span>';

            // ３ループさせる
            for ($i = 1; $i <= 3; $i++) {

                // gen_pageは真ん中になるので、一旦gen_pageから-2をする
                $text_flg = $gen_page - 2;
                $a_text = $text_flg + $i;
                if ($a_text == $gen_page) {
                    $page_html .= '        <span class="current">'. $a_text. '</span>';
                } else {
                    $page_html .= '        <a class="page larger" title="Page '. $a_text. '" href="'. home_url(). '/'. $page_option. 'page='. $a_text. '">'. $a_text. '</a>';
                }

            }

            // 6つ目
            $page_html .= '        <span class="tenten">…</span>';

            // 7つ目
            $page_html .= '        <a class="nextpostslink" rel="next" href="'. home_url(). '/'. $page_option. 'page='. $sou_page. '">'. $saikoubi. '</a>';

        }

    }


    $page_html .= '    </div>';
    $page_html .= '</div>';

    return $page_html;

}

function get_hachiketa_hiduke($data) {

        $nen = substr($data, 0, 4);
        $tsuki = substr($data, 5, 2);
        $tsuki = intval($tsuki);
        $hinichi = substr($data, 8, 2);
        $hinichi = intval($hinichi);
        //$retval = $nen. '年'. $tsuki. '月'. $hinichi. '日';
        // スラッシュ化
        $retval = $nen. '/'. $tsuki. '/'. $hinichi;

        return $retval;

}
/////////////////////////////////////////////////////////







//マルチサイト処理　親サイト
// update_option( 'siteurl', '/' );
// update_option( 'blogname', '運転免許受付センター' );
// update_option( 'blogdescription', '運転免許受付センター' );
// update_option( 'page_on_front', '2' );

// register_nav_menus(array(
//     'globalmenu_untenmenkyo_uketsuke' => esc_html__('運転免許受付センター', 'globalmenus_untenmenkyo_uketsuke'),
// ));






function Ps_fgetcsv_reg ( &$handle, $charset = 'sjis-win', $length = null, $d = ',', $e = '"' ) {
    $d = preg_quote( $d );
    $e = preg_quote( $e );
    $_line = "";
    $eof = false;
    while ( ( $eof != true ) and ( ! feof( $handle ) ) ) {
        $_line .= ( empty( $length ) ? fgets( $handle ) : fgets( $handle, $length ) );
        $itemcnt = preg_match_all( '/'.$e.'/', $_line, $dummy );
        if ( $itemcnt % 2 == 0 ) $eof = true;
    }
    if ( strtolower( $charset ) != 'utf-8' ) {
        $_line = mb_convert_encoding( $_line, 'UTF-8', $charset );
    }
    $_csv_line = preg_replace( '/(?:\r\n|[\r\n])?$/', $d, trim( $_line ) );
    $_csv_pattern = '/('.$e.'[^'.$e.']*(?:'.$e.$e.'[^'.$e.']*)*'.$e.'|[^'.$d.']*)'.$d.'/';
    preg_match_all( $_csv_pattern, $_csv_line, $_csv_matches );
    $_csv_data = $_csv_matches[1];
    for( $_csv_i = 0; $_csv_i < count( $_csv_data ); $_csv_i++ ) {
        $_csv_data[$_csv_i] = preg_replace( '/^'.$e.'(.*)'.$e.'$/s', '$1', $_csv_data[$_csv_i] );
        $_csv_data[$_csv_i] = str_replace( $e.$e, $e, $_csv_data[$_csv_i] );
    }
    return empty( $_line ) ? false : $_csv_data;
}


//top page topslider
// [topslider cat="1"]
//echo do_shortcode( '[topslider cat="1"]' );
/* 最新記事リスト */
function topsliderFunc($atts)
  {
    // extract(shortcode_atts(array(
    //     'num' => '6',    //最新記事リストの取得数
    //     'cat' => '',    //表示する記事のカテゴリー指定
    //   // 'order'=>'DESC',
    //   'orderby'=>'post_date',
    // 'post_type'      => 'topslider',  // カスタム投稿タイプ名
    //   'tax_query'      => array(
    //     array(
    //       'taxonomy' => 'topslider_cat',  // カスタムタクソノミー名
    //       'field'    => 'slug',  // ターム名を term_id,slug,name のどれで指定するか
    //       'terms'    => 'untenmenkyo' // タクソノミーに属するターム名
    //     )
    //   )
    // ), $atts));
    $customPostArg = array(
      'posts_per_page' => 6,
      'post_status' => 'publish',
      'post_type'      => 'topslider',  // カスタム投稿タイプ名
      'order'      => 'DESC',
      'tax_query'      => array(
        array(
          'taxonomy' => 'topslider_cat',  // カスタムタクソノミー名
          'field'    => 'slug',  // ターム名を term_id,slug,name のどれで指定するか
          'terms'    => 'happy' // タクソノミーに属するターム名
        )
      )
    );
    global $post;
    $oldpost = $post;

    //$myposts = get_posts('numberposts='.$num.'&order=DESC&orderby=post_date&category='.$cat);
    $myposts = get_posts($customPostArg);
    $retHtml = ' <div id="topSlider">
    <div class="sliderWrapper ">
    <div class="slider maxWidth">';
    $i=1;
    foreach ($myposts as $post) :
      $content = strip_tags($post->post_content);
      $cat = get_the_category();//カテゴリー
      $catname = $cat[0]->cat_name;//カテゴリー名
      $catslug = $cat[0]->slug;//カテゴリースラッグ
    $category_id = get_cat_ID( $catname );// 指定したカテゴリーの ID を取得
    $category_link = get_category_link( $category_id );// このカテゴリーの URL を取得

    // このカテゴリーの URL を取得
    $category_link = get_category_link( $category_id );
      setup_postdata($post);

    if (has_post_thumbnail() )  {
    //アイキャッチがあれば img タグの画像を返す。
    //画像サイズは medium で出力しています。
    $image_url = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'firstview');
    $number = get_post_thumbnail_id($post->ID);
    $thumb_alt = get_post_meta(get_post_thumbnail_id($post->ID), '_wp_attachment_image_alt', true);

    $thumbnail = '<img src="'. $image_url[0] .'" class="imgRes" alt="' . $thumb_alt . '">';
    } else {
    //アイキャッチがない場合は代替画像を表示。
    //$thumbnail =  '<img src="/wp-content/uploads/2018/01/point4_totori1img.jpg">';
    }


        $retHtml .='

          <!--slide-->
            <div class="image">
              <a href="'.get_post_meta($post->ID, 'link', true).'">
              ' . $thumbnail .
              '</a>
              </div>';

        $i++;
  endforeach;

  $retHtml .= '
    </div><!--/.slider-->
    </div><!--./sliderWrapper-->
  </div><!--/#topSlider-->
  <script>
  $(function() {
    $(\'.slider\').slick({
    arrows:false,
    cssEase :\'ease\',
    pauseOnFocus:false,
     autoplay: true,
  autoplaySpeed: 5000,
    speed: 1000,
    slidesToShow: 3,

   responsive: [
    {
      breakpoint: 769,
      settings: {
    slidesToShow: 1,
    centerPadding: \'0\',
    prevArrow: \'<a class="slick-prev" href="#">前へ</a>\',
    nextArrow: \'<a class="slick-next" href="#">次へ</a>\',

      }
    }
  ],
        });
    });
  </script>
';
  $post = $oldpost;
  wp_reset_postdata();



  return $retHtml;
  }
add_shortcode('topslider', 'topsliderFunc');

// [h１]
//echo do_shortcode( '[h1]' );
function h1Func()
  {
   $namae = '';
   if(is_singular('school')){$namae = get_the_title();}
     $H1Html .= '<h1 class="siteH1">'.$namae.'免許を取ろう！人気の合宿免許自動車教習所をご案内「合宿免許Happy」</h1>';
  return $H1Html;
  }
add_shortcode('h1', 'h1Func');


// [logo]
//echo do_shortcode( '[logo]');
function logoFunc()
  {
     $logo .= '<img src="/wp-content/uploads/2018/01/logo.png" alt="人気の合宿免許自動車教習所をご案内「合宿免許Happy」ロゴ" class="imgRes"/>';
  return $logo;
  }
add_shortcode('logo', 'logoFunc');


//自サイトリンク
function homeurlFunc()
{
    return '<a href="'.home_url().'" class="homeurl">合宿免許Happy</a>';
}
add_shortcode('homeurl', 'homeurlFunc');


//太田追加___________________________________________________________________

add_filter('widget_text', 'do_shortcode' );


//切り分けたfunctions読み込み
require_once locate_template('lib/top_func.php');        // トップ関連
require_once locate_template('lib/school_func.php');        // 教習所関連
require_once locate_template('lib/css_js_load_func.php');        // CSSとJS関連
require_once locate_template('lib/custom_post_func.php');        // カスタム投稿（ページネーションとか）関連
require_once locate_template('lib/other_func.php');        // 色々諸々関連

//太田追加___________________________________________________________________



//おおた追加_______________________________________________________________



/*
カスタムフィールドで絞ってリスト返す
[dropmenu]
*/
function dropmenuFunc($attr){
  $dropmenu = '';
$args = array(
  'post_type' => 'school', // 投稿タイプを指定
  'posts_per_page' => '-1', // 表示件数を指定
  'meta_query' => array( // カスタムフィールドを指定
    'relation' => 'OR',
    array(
      'key' => 'waribiki', // フィールド名の指定
      'value' => $attr[0], // 値の指定
      'compare' => 'LIKE', // フィールド値の部分一致
    ),
    array(
      'key' => 'course', // フィールド名の指定
      'value' => $attr[0], // 値の指定
      'compare' => 'LIKE', // フィールド値の部分一致
    ),
    array(
      'key' => 'mennkyo', // フィールド名の指定
      'value' => $attr[0], // 値の指定
      'compare' => 'LIKE', // フィールド値の部分一致
    )
  )
);
$dropmenu .= '<div class="dropmenu">
    <label for="menu_' . $attr[0].'">教習所を見る</label>
    <input type="checkbox" id="menu_' . $attr[0].'" class="accordion" />
    <ul id="links_'.$attr[0].'">';
$the_query = new WP_Query($args);
if($the_query->have_posts()):
  while ($the_query->have_posts()): $the_query->the_post();
    $link = get_the_permalink();
    $title = get_the_title();
    $dropmenu .= '<li><a href="'.$link.'">'.$title.'</a></li>';
  endwhile;
  wp_reset_postdata();
endif;
  $dropmenu .= '</ul>
</div>';
  $dropmenu .='
      <style>

    #menu_'.$attr[0].':checked ~ #links_'.$attr[0].' li {
      max-height: 300px;
      opacity: 1;
    }
    </style>

  ';

  return $dropmenu;
}
add_shortcode('dropmenu', 'dropmenuFunc');


/*
詳細ページ割りびき出力
[single_menkyo]
*/
function single_waribikiFunc(){
  $single_waribiki = '';
      //アイコン出力
      $field = get_field_object('waribiki');
      $meta_value = $field['value'];
      // echo "<pre>";
      // var_dump($field);
      // echo "</pre>";
      if( $meta_value ){
        foreach( $meta_value as $getvalue ){
          if($field['choices'][ $getvalue ] != "" || $field['choices'][ $getvalue ] != NULL){
            $single_waribiki .= '<div class="'.$getvalue.'"><p class="inner"><a href="https://www.happymenkyo.com/#'.$getvalue.'">'.$field['choices'][ $getvalue ].'</a></p></div>';
          }
        }
      }

  return $single_waribiki;
}
add_shortcode('single_waribiki', 'single_waribikiFunc');


// 戻り値はファイル名とディレクトリ名の配列。
function file_search($attr = ""){
  // ディレクトリのパス
  //$dir = "../data/odds";
  $dir = $attr;
  $check_dirs = array($dir);
  $file_paths = array();

  while( $check_dirs ) {
    $dir_path = $check_dirs[0] ;

    if( is_dir ( $dir_path ) && $handle = opendir ( $dir_path ) ) {
      while( ( $file = readdir ( $handle ) ) !== false ) {
        if( in_array ( $file, array(".", "..") ) !== false ) continue ;
        $path = rtrim ( $dir_path, "/" ) . "/" . $file ;

        if ( filetype ( $path ) === "dir" ) {
          $check_dirs[] = $path ;
        } else {
          // $file: ファイル名
          // $path: ファイルのパス
          $filepath[] = $path;
        }
      }
    }

    array_shift( $check_dirs ) ;
  }
  return $filepath;
}


//申し込み同意画面ボタン
function form_apply2_Func(){
  $sec = "";
  $mm = "";
  $dd = "";
  $code = '';
  $get = $_GET;
  $sec = $get['sec'];
  $mm = $get['mm'];
  $dd = $get['dd'];
  $lp = $get['lp'];

  if (!empty($sec)) {
    $my_query = new WP_Query();
    $param = array(
      'posts_per_page' => '-1', //表示件数。-1なら全件表示
      'post_type' => 'school', //カスタム投稿タイプの名称を入れる
      'post_status' => 'publish', //取得するステータス。publishなら一般公開のもののみ
      'orderby' => 'ID', //ID順に並び替え
      'order' => 'DESC'
    );
    $my_query->query($param);
    if ($my_query->have_posts()) :
      while ($my_query->have_posts()) : $my_query->the_post();
        if(get_the_title() === $get['sec']) $sec = $get['sec'];
      endwhile;
    endif;
  }
  if(!empty($mm)){

  }
  if(!empty($dd)){

  }
  $code .= '<div class="vc_btn3-container  btn vc_btn3-center">
  <a style="background-color:#ff8c00; color:#ffffff;" class="vc_general vc_btn3 vc_btn3-size-lg vc_btn3-shape-square vc_btn3-style-custom vc_btn3-block" href="https://www.happymenkyo.com/form/?sec='.$sec.'&mm='.$mm.'&dd='.$dd.'&lp='.$lp.'" title="">同意する</a></div>';

  return $code;
}
add_shortcode('form_apply2', 'form_apply2_Func');


/* ContactForm7 のカスタムバリデーション */
add_filter('wpcf7_validate', 'wpcf7_validate_customize', 11, 2);
function wpcf7_validate_customize($result,$tags){
  if(empty($_POST['kibou1-month']) || empty($_POST['kibou1-day'])){
    $result->invalidate( 'kibou1-day','必須項目に入力してください。' );
  }
  if(empty($_POST['kibou2-month']) || empty($_POST['kibou2-day'])){
    $result->invalidate( 'kibou2-day','必須項目に入力してください。' );
  }
  if(empty($_POST['subform1-year']) || empty($_POST['subform1-month']) || empty($_POST['subform1-day']) ){
    $result->invalidate( 'subform1-day','必須項目に入力してください。' );
  }
  // if(empty($_POST['subform2-year']) || empty($_POST['subform2-month']) || empty($_POST['subform2-day']) ){
  //   $result->invalidate( 'subform2-day','必須項目に入力してください。' );
  // }
  // if(empty($_POST['subform3-year']) || empty($_POST['subform3-month']) || empty($_POST['subform3-day']) ){
  //   $result->invalidate( 'subform3-day','必須項目に入力してください。' );
  // }
  // if(empty($_POST['subform4-year']) || empty($_POST['subform4-month']) || empty($_POST['subform4-day']) ){
  //   $result->invalidate( 'subform4-day','必須項目に入力してください。' );
  // }
  if(empty($_POST['contact-nengappi1']) || empty($_POST['contact-nengappi2']) || empty($_POST['contact-nengappi3']) ){
    $result->invalidate( 'contact-nengappi3','必須項目に入力してください。' );
  }

  return $result;
}


//教習所をさがす一覧
function serch_list_Func($attr){
  $sec = "";
  $code = '';
    $my_query = new WP_Query();
    $param = array(
      'posts_per_page' => '-1', //表示件数。-1なら全件表示
      'post_type' => 'school', //カスタム投稿タイプの名称を入れる
      'post_status' => 'publish', //取得するステータス。publishなら一般公開のもののみ
      'orderby' => 'ID', //ID順に並び替え
      'order' => 'DESC',
      'tax_query' => array(
        array(
          'taxonomy' => 'school_cat',  // カスタムタクソノミー名
          'field'    => 'slug',  // ターム名を term_id,slug,name のどれで指定するか
          'terms'    => $attr[0] // タクソノミーに属するターム名
        )
      )
    );
    $my_query->query($param);
    if ($my_query->have_posts()):
      while ($my_query->have_posts()) : $my_query->the_post();
        echo $post->post_name;
        the_title();
        $code .='
               <section class="srch-box-sct">
                <a href="rikuzentakata/about/">
                  <div class="srch-box">
                    <p class="srch-box-img"><img src="rikuzentakata/about/img/about_img01.jpg" alt=""></p>
                    <div class="srch-box-inner">
                      <h3 class="srch-box-ttl">陸前高田ドライビングスクール</h3>
                      <p class="srch-box-pref"><span>岩手県</span></p>
                      <ul class="srch-box-priceList">
                        <li>
                          <h4 class="item-ttl">普通車AT</h4>
                          <p class="item-price"><span class="price">230,000</span>円〜<br><span class="tax">税込248,400円〜</span></p>
                          <!-- <p class="item-notes">最短13⽇で卒業</p> -->
                        </li>
                        <li>
                          <h4 class="item-ttl">普通車MT</h4>
                          <p class="item-price"><span class="price">250,000</span>円〜<br><span class="tax">税込270,000円〜</span></p>
                          <!-- <p class="item-notes">最短13⽇で卒業</p> -->
                        </li>
                      </ul>
                      <p class="srch-box-btn">詳細を見る</p>
                    </div>
                  </div><!-- // .srch-box -->
                </a>
              </section>
              ';
      endwhile;
    endif;

  return $code;
}
add_shortcode('serch_list', 'serch_list_Func');


//おおた追加_______________________________________________________________





/*カスタムポスト　カテゴリ絞り込み*/
function add_post_taxonomy_restrict_filter() {
    global $post_type;
    if ( 'school' == $post_type ) {
        echo '<select name="school_cat">';
            echo '<option value="">カテゴリー指定なし</option>';
            $terms = get_terms('school_cat', 'hide_empty=0');
            foreach ($terms as $term) :
             if ($term->parent == 0):
              echo '<option value="' . $term->slug . '">' . $term->name . '</option>';
              $parentID = $term->term_id;

              $children = get_term_children( $parentID , 'school_cat' );
              if(!empty($children)):

               foreach($children as $childID):
                $child=get_term_by('id', $childID, 'school_cat');
                echo '<option value="' . $child->slug  . '">　' . $child->name . '</option>';
               endforeach;

              endif;
             endif;
           endforeach;

        echo '</select>';
    }
}
add_action( 'restrict_manage_posts', 'add_post_taxonomy_restrict_filter' );








//アフィリエイトコードを認識させる
function affiFunc()
{

    return '



    ';
}
add_shortcode('affi', 'affiFunc');



//

function changeDescription($description) {
//例えば特定のカスタム投稿のシングルで表示したい
 global $post;
if($post -> post_type == 'school'){

$description = "%post_title%の免許を合宿で取得するなら学生支持No1の合宿免許Happy公式サイトで。指定自動車教習所公正取引協議会賛助会員エース免許センターが運営する顧客満足度90％以上（当社調べ）の合宿免許Happyは教習所と直取引で超お得割引や激安・掘出し春休みや夏休み中入校も多数取り揃えるプランを多数用意";

}

return $description;

}
add_filter( 'aioseop_description', 'changeDescription');


function homeurl_func() {
  $obj = WPCF7_ShortcodeManager::get_instance();
  $test = do_shortcode('[homeurl]');
  return $test;
}
wpcf7_add_shortcode('homeurl', 'homeurl_func');