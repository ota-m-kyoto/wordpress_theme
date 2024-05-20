<?php
// CSS・JS読み込み
function add_files() {
 if(is_singular('school')){
  $info = $_GET['id'];
  if($info == 'info5'){
   wp_enqueue_style('single_info2-style', get_stylesheet_directory_uri(). '/assets/page/single_info5.css' , array() , '1.0.0' , false);
   wp_enqueue_script('single_info2-script', get_stylesheet_directory_uri(). '/assets/page/single_info5.js' , array() , '1.0.0' , true);
  }else if($info == 'info4'){
   wp_enqueue_style('single_info2-style', get_stylesheet_directory_uri(). '/assets/page/single_info4.css' , array() , '1.0.0' , false);
   wp_enqueue_script('single_info2-script', get_stylesheet_directory_uri(). '/assets/page/single_info4.js' , array() , '1.0.0' , true);
  }else if($info == 'info2'){
   wp_enqueue_style('single_info2-style', get_stylesheet_directory_uri(). '/assets/page/single_info2.css' , array() , '1.0.0' , false);
   wp_enqueue_script('single_info2-script', get_stylesheet_directory_uri(). '/assets/page/single_info2.js' , array() , '1.0.0' , true);
  }else if($info == 'info3'){
   wp_enqueue_style('single_info3-style', get_stylesheet_directory_uri(). '/assets/page/single_info3.css' , array() , '1.0.0' , false);
   wp_enqueue_script('single_info3-script', get_stylesheet_directory_uri(). '/assets/page/single_info3.js' , array() , '1.0.0' , true);
  }else{
   wp_enqueue_style('single_info1-style', get_stylesheet_directory_uri(). '/assets/page/single_info1.css' , array() , '1.0.0' , false);
   wp_enqueue_script('single_info1-script', get_stylesheet_directory_uri(). '/assets/page/single_info1.js' , array() , '1.0.0' , true);
  }
 }
}
add_action('wp_enqueue_scripts', 'add_files');
