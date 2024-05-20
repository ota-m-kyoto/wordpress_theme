<?php
//★投稿画面のカテゴリー階層を正常表示
function lig_wp_category_terms_checklist_no_top( $args, $post_id = null ) {
 $args['checked_ontop'] = false;
 return $args;
}
add_action( 'wp_terms_checklist_args', 'lig_wp_category_terms_checklist_no_top' );


add_filter('widget_text', 'do_shortcode' );//ウェジットでショートコード使うよ


// 並び替え順番任意の順番でソートをかける
function taxonomy_orderby_description( $orderby, $args ) {

    if ( $args['orderby'] == 'description' ) {
        $orderby = 'tt.description';
    }
    return $orderby;
}
add_filter( 'get_terms_orderby', 'taxonomy_orderby_description', 10, 2 );


//カテゴリ自動付加　全件一覧用
function auto_set_category ( $post_id ) {
  global $post;
  $new_post = get_post( $post_id );
  $content = $new_post->post_content;

/* ループ開始　全てのカテゴリーを１つ１つ調べる */
// $cat_all = get_terms( "works_cat", "fields=all&get=all" );
// foreach($cat_all as $value):
  wp_remove_object_terms( $post_id, 1, 'school_cat' );
  wp_add_object_terms( $post_id, 'all', 'school_cat' );
// endforeach;
/* ループ終了　全てのカテゴリーを１つ１つ調べる */

/* もしカテゴリーが１つも無かったらエラーになるからデフォのカテゴリーを付ける */
// $catcheck = get_the_category($post_id);
// if ( is_array($catcheck) && is_null($catcheck[0]) ) {
//   wp_add_object_terms( $post_id, 1, 'category' );
//       }
}
add_action( 'save_post', 'auto_set_category' );



//サイド日本出発一覧
// [side_nihon_get]
function side_nihon_get_Func($array) {
  if($array[2] == "" || $array[2] == NULL){
    $customPostArg = array(
      'posts_per_page' => -1,
      'post_status' => 'publish',
      'post_type'      => 'school',  // カスタム投稿タイプ名
      'order'      => 'DESC',
      'tax_query'      => array(
        'relation' => 'AND',
        array(
          'taxonomy' => 'school_cat',  // カスタムタクソノミー名
          'field'    => 'slug',  // ターム名を term_id,slug,name のどれで指定するか
          'terms'    => $array[0] // タクソノミーに属するターム名
        ),
        array(
          'taxonomy' => 'school_cat',  // カスタムタクソノミー名
          'field'    => 'slug',  // ターム名を term_id,slug,name のどれで指定するか
          'terms'    => $array[1] // タクソノミーに属するターム名
        ),
      )
    );
  }else{
    $customPostArg = array(
      'posts_per_page' => -1,
      'post_status' => 'publish',
      'post_type'      => 'school',  // カスタム投稿タイプ名
      'order'      => 'DESC',
      'tax_query'      => array(
        'relation' => 'AND',
        array(
          'taxonomy' => 'school_cat',  // カスタムタクソノミー名
          'field'    => 'slug',  // ターム名を term_id,slug,name のどれで指定するか
          'terms'    => array($array[1], $array[2]), // タクソノミーに属するターム名
          'operator' => 'IN'
        ),
        array(
          'taxonomy' => 'school_cat',  // カスタムタクソノミー名
          'field'    => 'slug',  // ターム名を term_id,slug,name のどれで指定するか
          'terms'    => $array[0] // タクソノミーに属するターム名
        )
      )
    );
  }

  global $post;
  $myposts = get_posts($customPostArg);
  $side_nihon_get.= '<div class="block">';
  foreach($myposts as $post) :
  setup_postdata($post);

  $title = get_the_title($myposts->ID);
  $link = get_permalink($myposts->ID);

  $num += 1;
  $side_nihon_get.= '
  <div class="co'.$num.'">
    <div class="btn">
      <a href="'.$link.'">
        <p class="title">'.$title.'</p>
      </a>
    </div>
  </div>
  ';
  endforeach;
  $side_nihon_get .='</div>';
  wp_reset_postdata();

  return $side_nihon_get;
}
add_shortcode("side_nihon_get", "side_nihon_get_Func");




// ===================================================================
// メニューカスタマイズ
// ===================================================================
//CSVデータ登録
add_action ( 'admin_menu', 'csv_regist' );
function csv_regist () {
    add_menu_page('csv登録', 'csv登録', 'manage_options', 'index3.php', 'csv_data_regist');
    //add_submenu_page('index2.php', 'csv登録', 'csv登録', 'manage_options', 'index3.php', 'csv_data_regist');
}


// ===================================================================
// csv登録
// ===================================================================
define("CSVDATA_BASE_DIR",get_stylesheet_directory()."/school/");//csvの場所
define("CSVDATA_HOME_DIR",get_stylesheet_directory()."/import/");//処理書いたファイルの場所

//登録
function csv_data_regist() {
 require_once locate_template('import/import_price.php');//処理書いたphp

 $filelist1 = scandir(CSVDATA_BASE_DIR);//学校フォルダ一覧

 // 表示させないディレクトリ配列
 $excludes = array(
  '.',
  '..',
  '.DS_Store',
  '._.DS_Store',
  'csvsyuturyokuVer0_6.xlsm',
  'macro.xlsb',
  'macro.xlsx',
  '~$csvsyuturyokuVer0_6.xlsm',
  '~$macro.xlsb',
 );

 if( is_array($filelist1) ){
  echo '<script type="text/javascript">alert("処理を開始します。しばらくお待ちください...");</script>';
  echo "処理を開始します。しばらくお待ちください...<br />\n";
  echo str_pad(" ",4096)."<br />\n";
  ob_end_flush();
  ob_start('mb_output_handler');

  $score = 100 / count($filelist1);
  $now_score = 0;
  foreach($filelist1 as $filename){
   // 特定のディレクトリの場合は表示させない
   if (in_array($filename, $excludes)) {
    $now_score += 1;
    continue;
   }
   ini_set('max_execution_time', 300);
   start_process(CSVDATA_BASE_DIR, $filename);
   $now_score += 1;
   echo $filename."完了:<strong>".$now_score."/".count($filelist1)."</strong><br />\n";
   ob_flush();
   flush();
   // $import = "php ".CSVDATA_HOME_DIR."import_price.php ".CSVDATA_BASE_DIR.$filename;
   // exec($import);
   //unlink(CSVDATA_BASE_DIR."profile/".$filename);
  }
  start_process('/home/share/web/www/happy/wp-content/themes/nanairo/school/','fukui');//テスト用
  echo "処理が完了しました<br />\n";
  echo '<script type="text/javascript">alert("処理が完了しました");</script>';
 }
 else{
  echo "エラーが発生しました<br />\n";
  echo "中断しました";
 }

}



// ===================================================================
// csv出力
// ===================================================================
// define("CSVDATA_BASE_DIR",get_stylesheet_directory()."/school/");//csvの場所
add_action ( 'admin_menu', 'cam_sche_pri_csv' );
function cam_sche_pri_csv () {
    add_menu_page('キャンペーンcsv出力', 'キャンペーンcsv出力', 'manage_options', 'index0.php', 'campaign_csv_data');
    add_menu_page('プライスcsv出力', 'プライスcsv出力', 'manage_options', 'index1.php', 'price_csv_data');
    add_menu_page('スケジュールcsv出力', 'スケジュールcsv出力', 'manage_options', 'index2.php', 'schedule_csv_data');
    add_menu_page('アクセスHTML出力', 'アクセスHTML出力', 'manage_options', 'index4.php', 'access_txt_data');
    add_menu_page('ホテルcsv出力', 'ホテルcsv出力', 'manage_options', 'index5.php', 'hotel_csv_data');
    add_menu_page('スクールデータcsv出力', 'スクールデータcsv出力', 'manage_options', 'index6.php', 'school_data_csv_data');
    //add_submenu_page('index2.php', 'csv登録', 'csv登録', 'manage_options', 'index3.php', 'csv_data_regist');
}
define("CSVDATA_EXPORT_DIR",get_stylesheet_directory()."/export/");//処理書いたファイルの場所

//スクールデータ出力
function school_data_csv_data() {
 require_once locate_template('export/export_school_data.php');//処理書いたphp

 $filelist1 = scandir(CSVDATA_BASE_DIR);//学校フォルダ一覧

 // 表示させないディレクトリ配列
 $excludes = array(
  '.',
  '..',
  '.DS_Store',
  '._.DS_Store',
  'csvsyuturyokuVer0_6.xlsm',
  'macro.xlsb',
  'macro.xlsx',
  '~$csvsyuturyokuVer0_6.xlsm',
  '~$macro.xlsb',
 );

 if( is_array($filelist1) ){
  echo '<script type="text/javascript">alert("処理を開始します。しばらくお待ちください...");</script>';
  echo "処理を開始します。しばらくお待ちください...<br />\n";
  echo str_pad(" ",4096)."<br />\n";
  ob_end_flush();
  ob_start('mb_output_handler');

  $score = 100 / count($filelist1);
  $now_score = 0;
  foreach($filelist1 as $filename){
   // 特定のディレクトリの場合は表示させない
   if (in_array($filename, $excludes)) {
    $now_score += 1;
    continue;
   }
   ini_set('max_execution_time', 300);
   start_process(CSVDATA_BASE_DIR, $filename);
   $now_score += 1;
   echo $filename."完了:<strong>".$now_score."/".count($filelist1)."</strong><br />\n";
   ob_flush();
   flush();
   // $import = "php ".CSVDATA_HOME_DIR."import_price.php ".CSVDATA_BASE_DIR.$filename;
   // exec($import);
   //unlink(CSVDATA_BASE_DIR."profile/".$filename);
  }
  // start_process('/home/share/web/www/happy/wp-content/themes/nanairo/school/','fukui');//テスト用
  echo "処理が完了しました<br />\n";
  echo '<script type="text/javascript">alert("処理が完了しました");</script>';
 }
 else{
  echo "エラーが発生しました<br />\n";
  echo "中断しました";
 }

}


//ホテル出力
function hotel_csv_data() {
 require_once locate_template('export/export_hotel.php');//処理書いたphp

 $filelist1 = scandir(CSVDATA_BASE_DIR);//学校フォルダ一覧

 // 表示させないディレクトリ配列
 $excludes = array(
  '.',
  '..',
  '.DS_Store',
  '._.DS_Store',
  'csvsyuturyokuVer0_6.xlsm',
  'macro.xlsb',
  'macro.xlsx',
  '~$csvsyuturyokuVer0_6.xlsm',
  '~$macro.xlsb',
 );

 if( is_array($filelist1) ){
  echo '<script type="text/javascript">alert("処理を開始します。しばらくお待ちください...");</script>';
  echo "処理を開始します。しばらくお待ちください...<br />\n";
  echo str_pad(" ",4096)."<br />\n";
  ob_end_flush();
  ob_start('mb_output_handler');

  $score = 100 / count($filelist1);
  $now_score = 0;
  foreach($filelist1 as $filename){
   // 特定のディレクトリの場合は表示させない
   if (in_array($filename, $excludes)) {
    $now_score += 1;
    continue;
   }
   ini_set('max_execution_time', 300);
   start_process(CSVDATA_BASE_DIR, $filename);
   $now_score += 1;
   echo $filename."完了:<strong>".$now_score."/".count($filelist1)."</strong><br />\n";
   ob_flush();
   flush();
   // $import = "php ".CSVDATA_HOME_DIR."import_price.php ".CSVDATA_BASE_DIR.$filename;
   // exec($import);
   //unlink(CSVDATA_BASE_DIR."profile/".$filename);
  }
  // start_process('/home/share/web/www/happy/wp-content/themes/nanairo/school/','fukui');//テスト用
  echo "処理が完了しました<br />\n";
  echo '<script type="text/javascript">alert("処理が完了しました");</script>';
 }
 else{
  echo "エラーが発生しました<br />\n";
  echo "中断しました";
 }

}


//アクセス出力
function access_txt_data() {
 require_once locate_template('export/export_access.php');//処理書いたphp

 $filelist1 = scandir(CSVDATA_BASE_DIR);//学校フォルダ一覧

 // 表示させないディレクトリ配列
 $excludes = array(
  '.',
  '..',
  '.DS_Store',
  '._.DS_Store',
  'csvsyuturyokuVer0_6.xlsm',
  'macro.xlsb',
  'macro.xlsx',
  '~$csvsyuturyokuVer0_6.xlsm',
  '~$macro.xlsb',
 );

 if( is_array($filelist1) ){
  echo '<script type="text/javascript">alert("処理を開始します。しばらくお待ちください...");</script>';
  echo "処理を開始します。しばらくお待ちください...<br />\n";
  echo str_pad(" ",4096)."<br />\n";
  ob_end_flush();
  ob_start('mb_output_handler');

  $score = 100 / count($filelist1);
  $now_score = 0;
  foreach($filelist1 as $filename){
   // 特定のディレクトリの場合は表示させない
   if (in_array($filename, $excludes)) {
    $now_score += 1;
    continue;
   }
   ini_set('max_execution_time', 300);
   start_process(CSVDATA_BASE_DIR, $filename);
   $now_score += 1;
   echo $filename."完了:<strong>".$now_score."/".count($filelist1)."</strong><br />\n";
   ob_flush();
   flush();
   // $import = "php ".CSVDATA_HOME_DIR."import_price.php ".CSVDATA_BASE_DIR.$filename;
   // exec($import);
   //unlink(CSVDATA_BASE_DIR."profile/".$filename);
  }
  // start_process('/home/share/web/www/happy/wp-content/themes/nanairo/school/','fukui');//テスト用
  echo "処理が完了しました<br />\n";
  echo '<script type="text/javascript">alert("処理が完了しました");</script>';
 }
 else{
  echo "エラーが発生しました<br />\n";
  echo "中断しました";
 }

}


//price出力
function price_csv_data() {
 require_once locate_template('export/export_price.php');//処理書いたphp

 $filelist1 = scandir(CSVDATA_BASE_DIR);//学校フォルダ一覧

 // 表示させないディレクトリ配列
 $excludes = array(
  '.',
  '..',
  '.DS_Store',
  '._.DS_Store',
  'csvsyuturyokuVer0_6.xlsm',
  'macro.xlsb',
  'macro.xlsx',
  '~$csvsyuturyokuVer0_6.xlsm',
  '~$macro.xlsb',
 );

 if( is_array($filelist1) ){
  echo '<script type="text/javascript">alert("処理を開始します。しばらくお待ちください...");</script>';
  echo "処理を開始します。しばらくお待ちください...<br />\n";
  echo str_pad(" ",4096)."<br />\n";
  ob_end_flush();
  ob_start('mb_output_handler');

  $score = 100 / count($filelist1);
  $now_score = 0;
  foreach($filelist1 as $filename){
   // 特定のディレクトリの場合は表示させない
   if (in_array($filename, $excludes)) {
    $now_score += 1;
    continue;
   }
   ini_set('max_execution_time', 300);
   start_process(CSVDATA_BASE_DIR, $filename);
   $now_score += 1;
   echo $filename."完了:<strong>".$now_score."/".count($filelist1)."</strong><br />\n";
   ob_flush();
   flush();
   // $import = "php ".CSVDATA_HOME_DIR."import_price.php ".CSVDATA_BASE_DIR.$filename;
   // exec($import);
   //unlink(CSVDATA_BASE_DIR."profile/".$filename);
  }
  // start_process('/home/share/web/www/happy/wp-content/themes/nanairo/school/','fukui');//テスト用
  echo "処理が完了しました<br />\n";
  echo '<script type="text/javascript">alert("処理が完了しました");</script>';
 }
 else{
  echo "エラーが発生しました<br />\n";
  echo "中断しました";
 }

}


//campaign出力
function campaign_csv_data() {
 require_once locate_template('export/export_campaign.php');//処理書いたphp

 $filelist1 = scandir(CSVDATA_BASE_DIR);//学校フォルダ一覧

 // 表示させないディレクトリ配列
 $excludes = array(
  '.',
  '..',
  '.DS_Store',
  '._.DS_Store',
  'csvsyuturyokuVer0_6.xlsm',
  'macro.xlsb',
  'macro.xlsx',
  '~$csvsyuturyokuVer0_6.xlsm',
  '~$macro.xlsb',
 );

 if( is_array($filelist1) ){
  echo '<script type="text/javascript">alert("処理を開始します。しばらくお待ちください...");</script>';
  echo "処理を開始します。しばらくお待ちください...<br />\n";
  echo str_pad(" ",4096)."<br />\n";
  ob_end_flush();
  ob_start('mb_output_handler');

  $score = 100 / count($filelist1);
  $now_score = 0;
  foreach($filelist1 as $filename){
   // 特定のディレクトリの場合は表示させない
   if (in_array($filename, $excludes)) {
    $now_score += 1;
    continue;
   }
   ini_set('max_execution_time', 300);
   start_process(CSVDATA_BASE_DIR, $filename);
   $now_score += 1;
   echo $filename."完了:<strong>".$now_score."/".count($filelist1)."</strong><br />\n";
   ob_flush();
   flush();
   // $import = "php ".CSVDATA_HOME_DIR."import_price.php ".CSVDATA_BASE_DIR.$filename;
   // exec($import);
   //unlink(CSVDATA_BASE_DIR."profile/".$filename);
  }
  // start_process('/home/share/web/www/happy/wp-content/themes/nanairo/school/','fukui');//テスト用
  echo "処理が完了しました<br />\n";
  echo '<script type="text/javascript">alert("処理が完了しました");</script>';
 }
 else{
  echo "エラーが発生しました<br />\n";
  echo "中断しました";
 }

}


//schedule出力
function schedule_csv_data() {
 require_once locate_template('export/export_schedule.php');//処理書いたphp

 $filelist1 = scandir(CSVDATA_BASE_DIR);//学校フォルダ一覧

 // 表示させないディレクトリ配列
 $excludes = array(
  '.',
  '..',
  '.DS_Store',
  '._.DS_Store',
  'csvsyuturyokuVer0_6.xlsm',
  'macro.xlsb',
  'macro.xlsx',
  '~$csvsyuturyokuVer0_6.xlsm',
  '~$macro.xlsb',
 );

 if( is_array($filelist1) ){
  echo '<script type="text/javascript">alert("処理を開始します。しばらくお待ちください...");</script>';
  echo "処理を開始します。しばらくお待ちください...<br />\n";
  echo str_pad(" ",4096)."<br />\n";
  ob_end_flush();
  ob_start('mb_output_handler');

  $score = 100 / count($filelist1);
  $now_score = 0;
  foreach($filelist1 as $filename){
   // 特定のディレクトリの場合は表示させない
   if (in_array($filename, $excludes)) {
    $now_score += 1;
    continue;
   }
   ini_set('max_execution_time', 300);
   start_process(CSVDATA_BASE_DIR, $filename);
   $now_score += 1;
   echo $filename."完了:<strong>".$now_score."/".count($filelist1)."</strong><br />\n";
   ob_flush();
   flush();
   // $import = "php ".CSVDATA_HOME_DIR."import_price.php ".CSVDATA_BASE_DIR.$filename;
   // exec($import);
   //unlink(CSVDATA_BASE_DIR."profile/".$filename);
  }
  // start_process('/home/share/web/www/happy/wp-content/themes/nanairo/school/','fukui');//テスト用
  echo "処理が完了しました<br />\n";
  echo '<script type="text/javascript">alert("処理が完了しました");</script>';
 }
 else{
  echo "エラーが発生しました<br />\n";
  echo "中断しました";
 }

}



/**
 * コンタクトフォーム7エラー対処
 * https://contactform7.com/ja/2017/06/07/on-sent-ok-is-deprecated/
 */
add_action( 'wp_footer', 'mycustom_wp_footer' );
function mycustom_wp_footer() {
?>
<?php
}
