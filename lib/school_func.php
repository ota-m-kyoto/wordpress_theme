<?php
/*
csv配列で返す
$slugname・・・スラッグ
$filename・・・何のcsv
[csv_return]
*/
function csv_return_Func($slugname, $filename){
  $csv_return = array();
  setlocale(LC_ALL, 'ja_JP.UTF-8');
  if(empty($slugname))return $csv_return;
  if(empty($filename))return $csv_return;
  //$filepath = dirname(__FILE__).'/school/'.$slugname;

  //ファイルパス設定
  $filepath = get_stylesheet_directory().'/school/'.$slugname ."/".$filename.".csv" ;//政井追加

  //変換後のUTF8ファイルを一時的に書き出し
  $filepath_utfed = get_stylesheet_directory().'/school/'.$slugname ."/utfed/".$filename."_utfed.csv" ;//政井追加

  //chmod
  // $chmod_dir =  dirname(__FILE__).'/school/'.$slugname;
  // chmod($chmod_dir , 0777);

  //utfedディレクトリがなかったら作成
  $directory_path = get_stylesheet_directory().'/school/'.$slugname ."/utfed/";
  if(!file_exists($directory_path)){
    // mkdir($directory_path, 0777);
      system('chmod 0777 '.$filepath_utfed);//オオタ改修
  }

  //ファイルを読み込む
  if(!file_exists($filepath))return;
  $fileContent = file_get_contents($filepath);//政井追加

  //UFTへ変換
  $fileContent = mb_convert_encoding($fileContent, 'UTF-8', 'sjis-win');//政井追加

  //ファイルの読み書き
  $fp = fopen($filepath_utfed, 'w');//政井追加

  // fwriteで文字列を書き込む
  fwrite($fp,  $fileContent);//政井追加

  // ファイルを閉じる（書き出し）
  fclose($fp);//政井追加

  //ファイルのパーミッションを変更
  // chmod($filepath_utfed, 0777);//政井追加
  system('chmod 0777 '.$filepath_utfed);//オオタ改修


  //$file = new SplFileObject($filepath."/".$filename.".csv");
  $file = new SplFileObject($filepath_utfed);//政井追加


  //mb_convert_encoding($file, 'UTF-8', 'SJIS');


  $file->setFlags(SplFileObject::READ_CSV);
  $file->setCsvControl(',');

  foreach($file as $line){
    //終端の空行を除く処理
    if(!is_null($line[0])){
      //mb_convert_variables("utf-8", "utf-8", $line);
      $csv_return[] = $line;

    }
  }

  return $csv_return;
}





//CSVの読み込みコード
// http://www.warna.info/archives/1481/　参照
function table_shortcode( $atts ) {
    $default = array(
        'th'            => 'row',
        'caption'       => '',
        'file'          => get_stylesheet_directory_uri()  . '/school/' . basename(get_permalink()) . '/schedule.csv',
        'id'            => false,
        'charset'       => 'sjis-win',
        'tag_id'      => '',
        'tag_class'   => 'scheduleTableContentWrapper',
        'tfoot'         => 'false',
    );
    $args = shortcode_atts( $default, $atts );

    if ( is_numeric( $args['id'] ) ) {
        $post = get_post( $args['id'] );
        if ( $post->post_mime_type == 'text/csv' ) {
            $args['file'] = $post->guid;
        }
    }

    $match_num = 0;
    if ( preg_match( '|^https?://|', $args['file'] ) && strpos( $args['file'], '../' ) === false ) {
        $file = str_replace( WP_CONTENT_URL, WP_CONTENT_DIR, $args['file'], $match_num );
    } elseif ( preg_match( '|^/|', $args['file'] ) && strpos( $args['file'], '../' ) === false ) {
        $file = $_SERVER['DOCUMENT_ROOT'] . $args['file'];
        $match_num = 1;
    }

    if ( $match_num && file_exists( $file ) && is_readable( $file ) ) {
        $charset = in_array( strtolower( $args['charset'] ), array( 'utf-8', 'euc-jp', 'eucjp-win', 'sjis', 'sjis-win', 'iso-2022-jp' ) ) ? $args['charset'] : $default['charset'];
        $th = in_array( strtolower( $args['th'] ), array( 'col', 'row', 'both' ) ) ? strtolower( $args['th'] ) : $default['th'];
        $fh = fopen( $file, 'r' );


        //カレンダー生成処理開始
        if ( $fh ) {

            $row_num = $th == 'row' ? 1 : 0;
            $table_id = $args['table_id'] ? ' id="' . esc_attr( $args['table_id'] ) . '"' : '';
            $table_class = $args['table_class'] ? ' class="' . esc_attr( $args['table_class'] ) . '"' : '';

            $outputAT = '<div class="ATSelected"><div class="scheduleTableWrapper atWrapper flex fWrap_wrap">
            <div class="calendarSlideAT swiper-container">
            <div class="swiper-wrapper">
            <div class="scheduleTableInner">
            <div' . $table_id . $table_class . '>' . "\n";

            $outputMT = '<div class="MTSelected"><div class="scheduleTableWrapper mtWrapper flex fWrap_wrap">
            <div class="calendarSlideMT swiper-container">
            <div class="swiper-wrapper">
            <div class="scheduleTableInner">
            <div' . $table_id . $table_class . '>' . "\n";


            // 配列の初期化
            {
              $csv=array();//入校スケジュール下のラベル処理
              $circle="";//入校スケジュール下のラベル処理

              $campaignName=array();//キャンペーンの処理に関連している
              $classArray = array("null","限定割","春特","ゴールド","年末一時帰宅","卒業日一時帰宅","ツイン特別","二輪同時特別","オフシーズン一時帰宅コース","シングルユース","グループユース");//キャンペーンの処理に関連している

              $otherClassNumber="";//キャンペーンの処理関連
              $other_color_o = array();

            }

            //CSV読み込み処理
            while ( $row = Ps_fgetcsv_reg( $fh, $args['charset'] ) ) {


                array_push($csv,$row);//入校スケジュール下のラベル処理

                //オフセット処理
                if($row_num > 7){
                  $offsetColumn='';

                  $offsetColumnTag ='
                    <div class="col1of7 row_offset ">
                      <div class="bgcolor bgcolor_">
                       <p class="atEntryDate coOffset"></p>
                      </div>
                    </div>
                  ';

                  //日付を分割
                  // $date_data[0] ⇒yyyy/mm/dd　$date_data[1]⇒yyyy $date_data[2]⇒mm $date_data[3]⇒dd
                  $date_dataOffset = array();




                  //エクスポートしたファイル対応
                  if(empty($row[0])||$row[0]==""){ $displayNone='none'; }
                  $row[0]= date('Y/m/d',strtotime($row[0]));
                  preg_match("@([0-9]{4,})/([0-9]{1,2})/([0-9]{1,2})@",$row[0],$date_dataOffset);
                  //エクスポートしたファイル対応

                  //オフセットループ
                  if( $date_dataOffset[3] == 1 ){

                    //エクスポートしたファイル対応
                    if(!empty($row[1])){
                      //https://php-archive.net/php/day-of-week-2/
                      $date = date('Y/m/d',(intval($row[1]) - 25569) * 60 * 60 * 24);
                      $datetime = date_create($date);
                      $week = array("日", "月", "火", "水", "木", "金", "土");
                      $w = (int)date_format($datetime, 'w');
                      $row[1] = $week[$w];
                      // echo $date;
                    }
                    //エクスポートしたファイル対応

                    if($row[1]=="日"){$offsetColumn ='';}
                    elseif($row[1]=="月"){$offsetColumn =$offsetColumnTag;}
                    elseif($row[1]=="火"){$offsetColumn =$offsetColumnTag.$offsetColumnTag;}
                    elseif($row[1]=="水"){$offsetColumn =$offsetColumnTag.$offsetColumnTag.$offsetColumnTag;}
                    elseif($row[1]=="木"){$offsetColumn =$offsetColumnTag.$offsetColumnTag.$offsetColumnTag.$offsetColumnTag;}
                    elseif($row[1]=="金"){$offsetColumn =$offsetColumnTag.$offsetColumnTag.$offsetColumnTag.$offsetColumnTag.$offsetColumnTag;}
                    elseif($row[1]=="土"){$offsetColumn =$offsetColumnTag.$offsetColumnTag.$offsetColumnTag.$offsetColumnTag.$offsetColumnTag.$offsetColumnTag;}
                  }
                  //オフセットループ

                    $line1AT =  $offsetColumn.'<div class="col1of7 row_' . $row_num . ' '. $row_class . '">';
                    $line1MT =  $offsetColumn.'<div class="col1of7 row_' . $row_num . ' '. $row_class . '">';
                }
                //オフセット処理


                //キャンペーンの処理に関連している処理
                for ( $i = 0; $i < count( $row ); $i++ ) {
                  if($row_num == 7){
                     array_push($campaignName,$row[$i]);//キャンペーンの処理に関連している
                }
                //キャンペーンの処理に関連している処理


                $otherClassNumber="";//キャンペーンの処理関連

                //カレンダー内処理
                if($row_num > 7){

                  //日付表示処理
                  if( $i ==0){

                    //日付を分割
                    $date_data = array();
                    preg_match("@([0-9]{4,})/([0-9]{1,2})/([0-9]{1,2})@",$row[$i],$date_data);
                    $line3AT = '<p class="atEntryDate co_' . $i  .'">' . $date_data[3] . '</p>';
                    $line3MT = '<p class="mtEntryDate co_' . $i  .'">' . $date_data[3] . '</p>';
                  }
                  //日付表示処理


                  //ATの卒業日
                  elseif($i ==2 && !empty($row[2])){
                    $line4AT = '
                    <p class="gradLabel">卒業日：</p>
                    <p class="gradDate">' . date('n/j',  strtotime($row[$i])).
                    '</p>';
                  }
                  //ATの卒業日

                  //MTの卒業日
                  elseif($i ==3 && !empty($row[3])){
                    $line4MT = '
                    <p class="gradLabel">卒業日：</p>
                    <p class="gradDate">' . date('n/j',  strtotime($row[$i])).
                    '</p>';
                  }
                  //MTの卒業日

                  //キャンペーンの処理
                  elseif($i >= 4 && $i <= 28  ){
                    //空白チェック
                    if( !empty($row[$i]) && (!empty($row[2] || !empty($row[3]))) ){

                      if( array_search($campaignName[$i], $classArray)){
                      $classnumber =array_search($campaignName[$i], $classArray);
                      $campaignNameValue = 'campaign co_cn'. $classnumber;
                      }

                      //otherClassNumber処理
                      else{
                        //$otherClassNumber++;
                        if(array_search($campaignName[$i],$other_color_o) === false){
                          array_push($other_color_o, $campaignName[$i]);
                        }

                        $otherClassNumber = array_search($campaignName[$i], $other_color_o)+1;
                        $campaignNameValue = 'campaign co_ocn'. $otherClassNumber;
                      }
                      //otherClassNumber処理
                    }
                    //キャンペーンの処理


                    if( !empty($row[$i]) && !empty($row[2]) ){
                      $line5AT .= '<span class="circle ' . $campaignNameValue . '">●</span>';
                    }
                    if( !empty($row[$i]) && !empty($row[3])){
                      $line5MT .= '<span class="circle ' . $campaignNameValue . '">●</span>';
                    }
                  }
                  //キャンペーンの処理


                  //背景色処理
                  if(!empty($row[29]) && !empty($row[2])){$bgColorAT = 29;}
                  elseif(!empty($row[30]) && !empty($row[2])){$bgColorAT = 30;}
                  elseif(!empty($row[31]) && !empty($row[2])){$bgColorAT = 31;}
                  elseif(!empty($row[32]) && !empty($row[2])){$bgColorAT = 32;}
                  elseif(!empty($row[33]) && !empty($row[2])){$bgColorAT = 33;}
                  elseif(!empty($row[34]) && !empty($row[2])){$bgColorAT = 34;}
                  elseif(!empty($row[35]) && !empty($row[2])){$bgColorAT = 35;}
                  elseif(!empty($row[36]) && !empty($row[2])){$bgColorAT = 36;}
                  else{$bgColorAT =  "";}
                  //背景色処理

                  //背景色処理
                  if(!empty($row[29]) && !empty($row[3])){$bgColorMT = 29;}
                  elseif(!empty($row[30]) && !empty($row[3])){$bgColorMT = 30;}
                  elseif(!empty($row[31]) && !empty($row[3])){$bgColorMT = 31;}
                  elseif(!empty($row[32]) && !empty($row[3])){$bgColorMT = 32;}
                  elseif(!empty($row[33]) && !empty($row[3])){$bgColorMT = 33;}
                  elseif(!empty($row[34]) && !empty($row[3])){$bgColorMT = 34;}
                  elseif(!empty($row[35]) && !empty($row[3])){$bgColorMT = 35;}
                  elseif(!empty($row[36]) && !empty($row[3])){$bgColorMT = 36;}
                  else{$bgColorMT =  "";}
                  //背景色処理


                  $line2AT ='<div class="bgcolor bgcolor_'. $bgColorAT .'">';
                  $line2MT ='<div class="bgcolor bgcolor_'. $bgColorMT .'">';
                }
                //カレンダー内処理

                //HTML処理
                $flag="";
                if( $date_data[2] != $temp_date){
                     $lineWrapperLower = '

                     </div>
                     </div><!--/.scheduleTableContentInnder-->



                     <!--.scheduleTableContentInnder-->
                     <div class="scheduleTableContentInnder swiper-slide ' . $displayNone . '">
                     <div class="title">'  .  sprintf('%01d',$date_data[2])  . '月</div>
                     <div class="youbi flex">
                      <div class="col1of7 nichi "><div class="bgcolor bgcolor_"><p>日</p></div></div>
                      <div class="col1of7 getsu "><div class="bgcolor bgcolor_"><p>月</p></div></div>
                      <div class="col1of7 ka "><div class="bgcolor bgcolor_"><p>火</p></div></div>
                      <div class="col1of7 sui "><div class="bgcolor bgcolor_"><p>水</p></div></div>
                      <div class="col1of7 moku "><div class="bgcolor bgcolor_"><p>木</p></div></div>
                      <div class="col1of7 kin "><div class="bgcolor bgcolor_"><p>金</p></div></div>
                      <div class="col1of7 do "><div class="bgcolor bgcolor_"><p>土</p></div></div>
                     </div>
                     <div class="scheduleTableCalendar flex fWrap_wrap">
                     ';
                 }
                //HTML処理

                $temp_date = $date_data[2];
            }
            //CSV読み込み処理


            //閉じ処理
            if($row_num > 7){
              $line6AT = '</div></div>' ."\n";
              $line6MT = '</div></div>' ."\n";
            }
            //閉じ処理


            if(empty($line5AT)&&empty($line4AT)){
              $line5AT = '-';
            }
            if(empty($line5MT)&&empty($line4MT)){
              $line5MT = '-';
            }


            /*申し込みボタン*/
            // {
              //AT申し込みボタン
              $mousikomi_btn = '';
              if(!empty($line4AT)){
               $schoolname = get_the_title();
               $date_m = $date_data[2];
               $date_d = $date_data[3];
               $mousikomi_btn = '<a href="https://www.happymenkyo.com/form?sec='.$schoolname.'&mm='.$date_m.'&dd='.$date_d.'" class="btn skn_orange dblArrow_right">この日で申込み</a>';
              }
              //AT申し込みボタン

              //MT申し込みボタン
              $mousikomi_btn_mt = '';
              if(!empty($line4MT)){
               $schoolname = get_the_title();
               $date_m = $date_data[2];
               $date_d = $date_data[3];
               $mousikomi_btn_mt = '<a href="https://www.happymenkyo.com/form?sec='.$schoolname.'&mm='.$date_m.'&dd='.$date_d.'" class="btn skn_orange dblArrow_right">この日で申込み</a>';
              }
              //MT申し込みボタン
            // }
            /*申し込みボタン*/

            //結合
            // {
              $outputAT .=   $lineWrapperLower .$line1AT.$line2AT.$line3AT. '<p class="campaignMark">' . $line5AT . '</p>' . $line4AT.$mousikomi_btn.$line6AT;
              $outputMT .=   $lineWrapperLower .$line1MT.$line2MT.$line3MT. '<p class="campaignMark">' . $line5MT . '</p>' . $line4MT.$mousikomi_btn_mt.$line6MT;
              $lineWrapperLower="";
              $line1AT="";
              $line1MT="";
              $line2AT="";
              $line2MT="";
              $line3AT="";
              $line3MT="";
              $line4AT="";
              $line4MT="";
              $line5AT="";
              $line5MT="";
              $line6AT="";
              $line6MT="";
            // }
            //結合

            //処理
            // {
              $endflg = 0;
              if(((int)$date_data[2] === 4 || (int)$date_data[2] === 6 || (int)$date_data[2] === 9 || (int)$date_data[2] === 11) && (int)$date_data[3] === 30){$endflg = 1;}
              if(((int)$date_data[2] === 1 || (int)$date_data[2] === 3 || (int)$date_data[2] === 5 || (int)$date_data[2] === 7 || (int)$date_data[2] === 8 || (int)$date_data[2] === 10 || (int)$date_data[2] === 12) && (int)$date_data[3] === 31){$endflg = 1;}
              if((int)$date_data[2] === 2 && ((int)$date_data[3] === 28 || (int)$date_data[3] === 29)){$endflg = 1;}
            // }
            //処理

            //閉じオフセット処理
            if($endflg === 1){

              //エクスポートしたファイル対応
                if(!empty($row[1])){
                  //https://php-archive.net/php/day-of-week-2/
                  // $date = date('Y/m/d',(intval($row[1]) - 25569) * 60 * 60 * 24);
                  $date = date('Y/m/d',((int)$row[1] - 25569) * 60 * 60 * 24);
                  $datetime = date_create($date);
                  $week = array("日", "月", "火", "水", "木", "金", "土");
                  $w = (int)date_format($datetime, 'w');
                  $row[1] = $week[$w];
                  // echo $date;
                }
              //エクスポートしたファイル対応

              if($row[1]=="土"){$offsetColumn ='';}
              elseif($row[1]=="金"){$offsetColumn =$offsetColumnTag;}
              elseif($row[1]=="木"){$offsetColumn =$offsetColumnTag.$offsetColumnTag;}
              elseif($row[1]=="水"){$offsetColumn =$offsetColumnTag.$offsetColumnTag.$offsetColumnTag;}
              elseif($row[1]=="火"){$offsetColumn =$offsetColumnTag.$offsetColumnTag.$offsetColumnTag.$offsetColumnTag;}
              elseif($row[1]=="月"){$offsetColumn =$offsetColumnTag.$offsetColumnTag.$offsetColumnTag.$offsetColumnTag.$offsetColumnTag;}
              elseif($row[1]=="日"){$offsetColumn =$offsetColumnTag.$offsetColumnTag.$offsetColumnTag.$offsetColumnTag.$offsetColumnTag.$offsetColumnTag;}

              $outputAT .= $offsetColumn;
              $outputMT .= $offsetColumn;

            }
            //閉じオフセット処理

            $row_num++;
          }




        //カレンダー生成処理開始

        //最後の閉じ処理
        if($row_num > 7){

          $outputAT .= '
          </div>
          </div>
          </div>
          <div class="calendarSwipe swiper-button-prev"></div>
          <div class="calendarSwipe swiper-button-next"></div>
          </div>

          </div>
          </div>';

          $outputMT .= '
          </div>
          </div>
          </div>
          <div class="calendarSwipe swiper-button-prev"></div>
          <div class="calendarSwipe swiper-button-next"></div>
          </div>

          </div>
          </div>';

        }
        //最後の閉じ処理

      }

    }
  //入校スケジュール下のラベル処理
  	foreach ($csv  as $countNumber => $eacharray) {

  	if ($countNumber==5){
  	  for ( $i = 4; $i < 22; $i++ ) {
  	      if(!empty($eacharray[$i])){


                if( array_search($csv[6][$i], $classArray)){
                  $classnumber =array_search($csv[6][$i], $classArray);
                                $classname = 'campaign co_cn'. $classnumber;

                }

                else{
                  $otherClassNumber++;
                $classname = 'campaign co_ocn'. $otherClassNumber;
                }

               $circle .= '<span class="' . $classname . '">●:' . ($csv[6][$i]).'</span>' ;  	          }
  	      }
  	    }
  	}
  //入校スケジュール下のラベル処理

    $circleWrapper = '<div class="circleNotice">' . $circle . ' <a href="#campaignSection" class="checkCampaign">⇒キャンペーン内容</a></div>';


	return $outputAll . $outputAT . $outputMT . $circleWrapper;
}
add_shortcode( 'csv2table', 'table_shortcode' );



























/*

function table_shortcode( $atts ) {
    $default = array(
        'th'            => 'row',
        'caption'       => '',
        'file'          => get_stylesheet_directory_uri()  . '/school/' . basename(get_permalink()) . '/schedule.csv',
        'id'            => false,
        'charset'       => 'sjis-win',
        'tag_id'      => '',
        'tag_class'   => '',
        'tfoot'         => 'false',
    );
    $args = shortcode_atts( $default, $atts );

    $offset_day = 0;

    if ( is_numeric( $args['id'] ) ) {
        $post = get_post( $args['id'] );
        if ( $post->post_mime_type == 'text/csv' ) {
            $args['file'] = $post->guid;
        }
    }

    $match_num = 0;
    if ( preg_match( '|^https?://|', $args['file'] ) && strpos( $args['file'], '../' ) === false ) {
        $file = str_replace( WP_CONTENT_URL, WP_CONTENT_DIR, $args['file'], $match_num );
    } elseif ( preg_match( '|^/|', $args['file'] ) && strpos( $args['file'], '../' ) === false ) {
        $file = $_SERVER['DOCUMENT_ROOT'] . $args['file'];
        $match_num = 1;
    }

    if ( $match_num && file_exists( $file ) && is_readable( $file ) ) {
        $charset = in_array( strtolower( $args['charset'] ), array( 'utf-8', 'euc-jp', 'eucjp-win', 'sjis', 'sjis-win', 'iso-2022-jp' ) ) ? $args['charset'] : $default['charset'];
        $th = in_array( strtolower( $args['th'] ), array( 'col', 'row', 'both' ) ) ? strtolower( $args['th'] ) : $default['th'];
        $fh = fopen( $file, 'r' );
        if ( $fh ) {
            $row_num = $th == 'row' ? 1 : 0;
            // $tag_id = $args['tag_id'] ? ' id="' . esc_attr( $args['tag_id'] ) . '"' : '';
            // $tag_class = $args['tag_class'] ? ' class="' . esc_attr( $args['tag_class'] ) . '"' : '';
            // $output = '<div' . $tag_id . $tag_class . '>' . "\n";
            $output = '<div id="dummy" class="calendarWrapper flex fWrap_wrap">' . "\n";
            $outputAT = '<h2>AT</h2><div id="at" class="calendarWrapper flex fWrap_wrap">' . "\n";
            $outputMT = '<h2>MT</h2><div id="mt" class="calendarWrapper flex fWrap_wrap">' . "\n";
            // if ( $args['caption'] ) {
            //     $output .= '<caption>' . esc_html( $args['caption'] ) . "</caption>\n";
            // }


            $start_flag = 0;
            while ( $row = Ps_fgetcsv_reg( $fh, $args['charset'] ) ) {
                if($start_flag === 0){
                  $year = $row[0];
                  $month2 = "";
                  $start_flag = 1;
                }
                if ( $row_num == 0 ) {
                    $row_class = 'head_row';
                } else {
                    $row_class = $row_num % 2 ? 'odd' : 'even';
                }
                // if ( $row_num == 0 ) {
                //     $output .= '<thead>' . "\n";
                // } elseif ( $row_num == 1 ) {
                //     $output .= '<tbody>' . "\n";
                // }

                if($row_num != 1 && $row_num != 2 && $row_num != 3 ){
                  $diffrence = 0;
                  $line = '<div class="' . $row_class . '">' . "\n";
                  $lineAT = '<div class="' . $row_class . '">' . "\n";
                  $lineMT = '<div class="' . $row_class . '">' . "\n";

                    if($row[0] != $month){
                      if( $month != "" ){
                        $after = '</div><!--/calendarInner-->';
                        $after .= '</div><!--monthInner-->' . "\n";
                        $after .= '</div><!--month-->' . "\n";
                      }
                      $diffrence = 1;
                      $before = '<div class="col1of2 month month' . $row[0] . '">'. "\n";
                      $before .= '<div class="monthInner">'. "\n";
                      $before .= '<div class="monthTitle">' . $row[0] . '</div><!--monthTitle-->' . "\n";
                      $before .= '<div class="week flex fWrap_wrap"><p class="row">日</p><p class="row">月</p><p class="row">火</p><p class="row">水</p><p class="row">木</p><p class="row">金</p><p class="row">土</p></div>' . "\n";
                      $before .= '<div class="calendarInner flex fWrap_wrap">' . "\n";
                      $month = $row[0];
                    }
                if($start_flag > 0){
                  if($month2 != $month){
                    $month2 = $month;
                    if($start_flag >= 2 && intval($month2) === 1){
                      $year = $year + 1;
                    }elseif($start_flag === 1){
                      $year = $year;
                    }
                    $start_flag += 1;
                    $day = 1;
                  $datetime = date_create();
                  //date_date_set($datetime, $year, $month2, $day);
                  $week = array("日", "月", "火", "水", "木", "金", "土");
                  $w = (int)date_format($datetime, 'w');
                  $offset_day = $w;
                  //echo $week[$w].":";
                  }
                }
                for ( $i = 0; $i < count( $row ); $i++ ) {
                  if( $i == 1 ){
                    // $elm = ( $th != 'col' && $i == 0 ) || $row_num == 0 ? 'th' : 'td';
                    $line .= '<p class="row' . $i . '">' . $row[1] . "</p>\n";
                    $lineAT .= '<p class="at row ' . $row[2] . ' ' . $row[3]  . ' ' . $row[4]  . '"><span>' . $row[1] . "</span></p>\n";
                    $lineMT .= '<p class="mt row ' . $row[5] . ' ' . $row[6]  . ' ' . $row[7]  . '"><span>' . $row[1] . "</span></p>\n";
                    }
                  // if( $i >= 2 && $i <= 4){
                  //   // $elm = ( $th != 'col' && $i == 0 ) || $row_num == 0 ? 'th' : 'td';
                  //   $line .= '<p class="at row' . $i . '">' . $row[$i] . "</p>\n";
                  //   $lineAT .= '<p class="at row' . $i . '">' . $row[$i] . "</p>\n";
                  //   }
                  // if( $i >= 5 && $i <= 7){
                  //   // $elm = ( $th != 'col' && $i == 0 ) || $row_num == 0 ? 'th' : 'td';
                  //   $line .= '<p class="mt row' . $i . '">' . $row[$i] . "</p>\n";
                  //   $lineMT .= '<p class="mt row' . $i . '">' . $row[$i] . "</p>\n";
                  //   }
                }

                $line .= '</div><!--even/odd-->' . "\n";
                $lineAT .= '</div><!--even/odd-->' . "\n";
                $lineMT .= '</div><!--even/odd-->' . "\n";

                if($diffrence == 1){
                  //すべて
                  $output .= $after;
                  $output .= $before;
                  $output .= $line;

                  //AT
                  $outputAT .= $after;
                  $outputAT .= $before;
                  for($ii = 0; $ii < $offset_day; $ii++){
                    $outputAT.='<div class="even">
                                  <p class="at row   "><span>-</span></p>
                                </div>';
                  }
                  $outputAT .= $lineAT;

                  //MT
                  $outputMT .= $after;
                  $outputMT .= $before;
                  for($j = 0; $j < $offset_day; $j++){
                    $outputMT.='<div class="even">
                                  <p class="mt row   "><span>-</span></p>
                                </div>';
                  }
                  $outputMT .= $lineMT;




                  $after = "";

                }
                else{
                  $output .= $line ;
                  $outputAT .= $lineAT ;
                  $outputMT .= $lineMT ;

                }
                $diffrence = 0;
              }

                // if ( $row_num == 0 ) {
                //     $output .= '</thead>' . "\n";
                //     if ( in_array( strtolower( $args['tfoot'] ), array( '1', 'true' ) ) ) {
                //         $output .= '<tfoot>' . "\n";
                //         $output .= '<tr class="' . $row_class . '">' . "\n";
                //         $output .= $line;
                //         $output .= '</tr>' . "\n";
                //         $output .= '</tfoot>' . "\n";
                //     }
                // }
                $row_num++;
            }

            // $output .= "</tbody>\n";
            $output .= '</div><!--/calendarInner-->';
            $output .= '</div><!--/monthInner-->';
            $output .= '</div><!--/month-->';
            $output .= '</div><!--/calendarWrapper-->';

            //AT
            $outputAT .= '</div><!--/calendarInner-->';
            $outputAT .= '</div><!--/monthInner-->';
            $outputAT .= '</div><!--/month-->';
            $outputAT .= '</div><!--/calendarWrapper-->';

            //MT
            $outputMT .= '</div><!--/calendarInner-->';
            $outputMT .= '</div><!--/monthInner-->';
            $outputMT .= '</div><!--/month-->';
            $outputMT .= '</div><!--/calendarWrapper-->';


            $allOutput = $output . $outputAT . $outputMT;
        }
    }
    return $allOutput;
}
add_shortcode( 'csv2table', 'table_shortcode' );

*/


/**
 * ipアドレスで地域判定
 */
 function ip_area_Func($array) {
   $result = '';

   require_once locate_template('lib/iparea/geoipcity.inc');
   require_once locate_template('lib/iparea/timezone.php');

   $region_name = array(
   'hokkaido'=>'tohoku','aomori'=>'tohoku','iwate'=>'tohoku','miyagi'=>'tohoku',
   'akita'=>'tohoku','yamagata'=>'tohoku','fukushima'=>'tohoku','ibaraki'=>'kanto',
   'tochigi'=>'kanto','gunma'=>'kanto','saitama'=>'kanto','chiba'=>'kanto',
   'tokyo'=>'kanto','kanagawa'=>'kanto','niigata'=>'koushinetsu','toyama'=>'hokuriku',
   'ishikawa'=>'hokuriku','fukui'=>'hokuriku','yamanashi'=>'koushinetsu','nagano'=>'koushinetsu',
   'gifu'=>'tokai','shizuoka'=>'tokai','aichi'=>'tokai','mie'=>'tokai',
   'shiga'=>'kansai','kyoto'=>'kansai','osaka'=>'kansai','hyogo'=>'kansai',
   'nara'=>'kansai','wakayama'=>'kansai','tottori'=>'chugoku','shimane'=>'chugoku',
   'okayama'=>'chugoku','hiroshima'=>'chugoku','yamaguchi'=>'chugoku','tokushima'=>'shikoku',
   'kagawa'=>'shikoku','ehime'=>'shikoku','kochi'=>'shikoku','fukuoka'=>'kyushu',
   'saga'=>'kyushu','nagasaki'=>'kyushu','kumamoto'=>'kyushu','oita'=>'kyushu',
   'miyazaki'=>'kyushu','kagoshima'=>'kyushu','okinawa'=>'kyushu'
   );

   // Yahoo.com の IP アドレス
   if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
    $ip = $_SERVER['HTTP_CLIENT_IP'];
   } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
   } else {
    $ip = $_SERVER['REMOTE_ADDR'];
   }
   // $ip = '61.27.193.2';
   $host = gethostbyaddr( $ip );

   $gip = geoip_open( locate_template('lib/iparea/GeoLiteCity.dat'), GEOIP_STANDARD );
   $dat = new stdClass();
   $dat = GeoIP_record_by_addr( $gip, $ip );
   if(!empty($dat)){
    geoip_close( $gip );
    if( isset( $GEOIP_REGION_NAME[$dat->country_code][$dat->region] ) ) {
     $dat->region_name = $GEOIP_REGION_NAME[$dat->country_code][$dat->region];
    }
    $dat->time_zone = get_time_zone( $dat->country_code, $dat->region );
    $str = mb_strtolower($dat->region_name);
    $result = '<a href="https://www.happymenkyo.com/school_cat/kansai_departure"><img src="/wp-content/uploads/2018/09/kansaiBtn.png" /></a>';
    foreach ($region_name as $key => $value) {
     if($key == $str){
      $imgpath = $value;
      if($value == 'kyushu'){$area = $value;}
      $result = '<a href="https://www.happymenkyo.com/school_cat/'.$value.'_departure"><img src="/wp-content/uploads/2018/09/'.$imgpath.'Btn.png" srcset="/wp-content/uploads/2018/09/'.$imgpath.'Btn.png 1x,/wp-content/uploads/2018/09/'.$imgpath.'Btn2x.png 2x"/></a>';
     }
    }
   }else{
    $result = '<a href="https://www.happymenkyo.com/school_cat/kansai_departure"><img src="/wp-content/uploads/2018/09/kansaiBtn.png" /></a>';
   }
// echo '<script type="text/javascript">console.log("'.$dat->city.'");</script>';
// echo "ip            = " . $ip . "<br>";
// echo "host          = " . $host . "<br><br>";
// echo "city          = " . $dat->city . "<br>";
// echo "region_name   = " . $dat->region_name . "<br>";
// echo "region        = " . $dat->region . "<br>";
// echo "area_code     = " . $dat->area_code . "<br>";
// echo "time_zone     = " . $dat->time_zone . "<br>";
// echo "longitude     = " . $dat->longitude . "<br>";
// echo "metro_code    = " . $dat->metro_code . "<br>";
// echo "country_code3 = " . $dat->country_code3 . "<br>";
// echo "latitude      = " . $dat->latitude . "<br>";
// echo "postal_code   = " . $dat->postal_code . "<br>";
// echo "dma_code      = " . $dat->dma_code . "<br>";
// echo "country_code  = " . $dat->country_code . "<br>";
// echo "country_name  = " . $dat->country_name . "<br>";

// city          = Sunnyvale            // 都市名
// region_name   = California           // 地域名
// region        = CA                   // 地域コード
// area_code     = 408                  // エリアコード？
// time_zone     = America/Los_Angeles  // タイムゾーン
// longitude     = -122.0074            // 経度
// metro_code    = 807                  // なにこれ？
// country_code3 = USA                  // 国コード（3文字）
// latitude      = 37.4249              // 緯度
// postal_code   = 94089                // 郵便番号
// dma_code      = 807                  // わからん？
// country_code  = US                   // 国コード（2文字）
// country_name  = United States        // 国名


  return $result;
 }
 add_shortcode("ip_area", "ip_area_Func");


/**
 * ボタン群
 */
function mainbtn_Func($attr) {
 $slug_name = $attr[0];//どの学校か
 $result = '';
 $noneflg = '';
 // $items = array("概要","施設・設備紹介","合宿の様子","アクセス・地図","料金表","おトク情報","キャンペーン","保証内容","入校日カレンダー","宿泊施設","周辺スポット");
 if(!file_exists(get_stylesheet_directory().'/school/'.$slug_name.'/spot.csv')){$noneflg = 'none';}
 if(!file_exists(get_stylesheet_directory().'/school/'.$slug_name.'/img/camp1.jpg')){$noneflg_yousu = 'none';}
 $mypath = '/school/'.$slug_name;
 $result = <<<EOM
 <div class="schoolBtn_block fas">
 <div class="schoolBtns_wrap">
 <div class="school_btns flex fWrap_wrap">
 <div class="school_btnA">
 <a href="{$mypath}/#gaiyou" data-scroll="gaiyou" class="btn skn_schoolLink">概要</a>
 </div>
 <div class="school_btnA">
 <a href="{$mypath}/#facility" data-scroll="facility" class="btn skn_schoolLink">施設・設備紹介</a>
 </div>
 <div class="school_btnA {$noneflg_yousu}">
 <a href="{$mypath}/#state" data-scroll="state" class="btn skn_schoolLink">合宿の様子</a>
 </div>
 <div class="school_btnA">
 <a href="{$mypath}/#access" data-scroll="access" class="btn skn_schoolLink">アクセス・地図</a>
 </div>
 <div class="school_btnA">
 <a href="{$mypath}?id=info2#priceTable" data-scroll="priceTable" class="btn skn_schoolLink">料金表</a>
 </div>
 <div class="school_btnA">
 <a href="{$mypath}?id=info2#happyOtoku" data-scroll="happyOtoku" class="btn skn_schoolLink">おトク情報</a>
 </div>
 <div class="school_btnA">
 <a href="{$mypath}?id=info2#campaignSection" data-scroll="campaignSection" class="btn skn_schoolLink">キャンペーン</a>
 </div>
 <div class="school_btnA">
 <a href="{$mypath}?id=info2#hoshou" data-scroll="hoshou" class="btn skn_schoolLink">保証内容</a>
 </div>
 <div class="school_btnA">
 <a href="{$mypath}?id=info2#scheduleSlide" data-scroll="scheduleSlide" class="btn skn_schoolLink">入校日カレンダー</a>
 </div>
 <div class="school_btnA">
 <a href="{$mypath}?id=info3#hotelDetail" data-scroll="hotelDetail" class="btn skn_schoolLink">宿泊施設</a>
 </div>
 <div class="school_btnA {$noneflg}">
 <a href="{$mypath}?id=info4#spot" data-scroll="spot" class="btn skn_schoolLink">周辺スポット</a>
 </div>
 </div>
 </div>
 </div>
EOM;


 return $result;
}
add_shortcode("mainbtn", "mainbtn_Func");


/*
詳細ページ取れる免許出力
[single_menkyo]
*/
function single_menkyoFunc(){
 global $post;
 $single_menkyo = '';
 //アイコン出力
 $menkyoitems = array('school_対応免許1','school_対応免許2','school_対応免許3','school_対応免許4','school_対応免許5',
 'school_対応免許6','school_対応免許7','school_対応免許8','school_対応免許9','school_対応免許10',
 'school_対応免許11','school_対応免許12','school_対応免許13','school_対応免許14','school_対応免許15',
 'school_対応免許16','school_対応免許17','school_対応免許18','school_対応免許19','school_対応免許20',
 'school_対応免許21','school_対応免許22','school_対応免許23','school_対応免許24','school_対応免許25',);
foreach ($menkyoitems as $value) {
 if(!empty($post->$value)){
  $single_menkyo .= '<div class="feasible"><span class="feasible_text">'.esc_html($post->$value).'</span></div>';
 }
}
 return $single_menkyo;
}
add_shortcode('single_menkyo', 'single_menkyoFunc');


/**
 * たくさんのお客様に選ばれていますブロック
 */
function takusan_block_Func($attr){
 $result = '';
 $school_name = $attr[0];//学校名
 $content_url = content_url();

 if(!empty($school_name)){
  $text1 = $school_name.'の';
  $text2 = $school_name.'について';
 }


  if(strlen($school_name) >= 56){
      $schoolNameFontSize = 'schoolSmall '.strlen($school_name);
    }
  elseif(strlen($school_name) <= 55){
      $schoolNameFontSize = 'schoolSmaller '.strlen($school_name);
    }

  if(strlen($school_name) <= 29){
      $schoolNameFontSize = 'schoolNormal '.strlen($school_name);
    }

  elseif(strlen($school_name) <= 10){
      $schoolNameFontSize ='schoolLarger '.strlen($school_name);
    }

 $result = <<<EOM
 <section id="selected" class="selected_marginBottom3">
   <div class="secInner">
     <!--start selected_row-->
     <div class="selected_block">
       <div class="selected_row1 selected_row box_row">
         <div class="imageBox">
           <div class="image">
             <div class="image_inner">
               <img src="{$content_url}/uploads/2018/09/CTA_PC.png" alt="合宿免許Happyはたくさんのお客様に選ばれています。" class="onlyPc">
               <img src="{$content_url}/uploads/2018/09/CTA_SP.png" alt="合宿免許Happyはたくさんのお客様に選ばれています。" class="hidePc">
             </div><!--end image_inner-->
           </div><!--end image-->
         </div><!--end imageBox-->
       </div><!--end selected_row-->
       <div class="selected_row2 selected_row box_row">
         <div class="selectedBtn_wrap">
           <div class="btn_selected_wrap {$schoolNameFontSize}">
            <a href="https://www.happymenkyo.com/form/?sec={$school_name}" class="btn_selected dblArrow_right skn_selected_orange"><span class="selected_em">今すぐ予約してお得に！</span><br />{$text1}お申し込みを行う</a>
           </div>
           <div class="btn_selected_wrap {$schoolNameFontSize}">
            <a href="https://www.happymenkyo.com/contact/?sec={$school_name}" class="btn_selected dblArrow_right skn_selected_blue"><span class="selected_em">まだ予定など決まっていないけどまずは</span><br />{$text2}問い合わせ</a>
           </div>
         </div>
       </div><!--end selected_row-->
     </div><!--end selected_block-->
   </div><!--end secInner-->
 </section><!--end selected_section-->
EOM;

 return $result;
}
add_shortcode('takusan_block', 'takusan_block_Func');



/**
 * トップ　２ブロック目　固定ページ　出す
 */
function top_2ndblock_kotei_Func(){
 $result = '';
 $page_data = get_page_by_path('top2block');
 $page = get_post($page_data);
 $result = do_shortcode($page -> post_content);

 return $result;
}
add_shortcode('top_2ndblock_kotei', 'top_2ndblock_kotei_Func');


/**
 * 割引のsql
 */
function sql_waribiki_Func($namevalue){


  //wp-configにはサーバによって、（127.0.0.1:3307のように）ポートがホストと書かれている場合があるのでその保険
  $dbhost=DB_HOST;

  //ポート番号を抽出
  if(strpos($dbhost, ":")){
    //port
    $port = strpos($dbhost, ":");
    $port= substr($dbhost, $port+1);
    //host
    $host = strpos($dbhost, ":");
    $host= substr($dbhost, 0,$host);

  }
  else{
    $port=3306;
   $host=DB_HOST;
  }
  //DBへ接続
  $link = mysqli_connect($host ,DB_USER, DB_PASSWORD, DB_NAME,$port);





 $sql = "
 SELECT ID,post_date
  FROM wp_posts
  INNER JOIN wp_postmeta ON wp_posts.ID = wp_postmeta.post_id
  WHERE wp_posts.post_type = 'school' AND wp_posts.post_status = 'publish'
  AND (
  wp_posts.ID IN (select post_id from wp_postmeta where wp_postmeta.meta_key = 'school_割引1_企画名' AND wp_postmeta.meta_value LIKE '".$namevalue."%' )
  OR
  wp_posts.ID IN (select post_id from wp_postmeta where wp_postmeta.meta_key = 'school_割引2_企画名' AND wp_postmeta.meta_value LIKE '".$namevalue."%' )
  OR
  wp_posts.ID IN (select post_id from wp_postmeta where wp_postmeta.meta_key = 'school_割引3_企画名' AND wp_postmeta.meta_value LIKE '".$namevalue."%' )
  OR
  wp_posts.ID IN (select post_id from wp_postmeta where wp_postmeta.meta_key = 'school_割引4_企画名' AND wp_postmeta.meta_value = '".$namevalue."' )
  OR
  wp_posts.ID IN (select post_id from wp_postmeta where wp_postmeta.meta_key = 'school_割引5_企画名' AND wp_postmeta.meta_value = '".$namevalue."' )
  OR
  wp_posts.ID IN (select post_id from wp_postmeta where wp_postmeta.meta_key = 'school_割引6_企画名' AND wp_postmeta.meta_value = '".$namevalue."' )
  OR
  wp_posts.ID IN (select post_id from wp_postmeta where wp_postmeta.meta_key = 'school_割引7_企画名' AND wp_postmeta.meta_value = '".$namevalue."' )
  OR
  wp_posts.ID IN (select post_id from wp_postmeta where wp_postmeta.meta_key = 'school_割引8_企画名' AND wp_postmeta.meta_value = '".$namevalue."' )
  OR
  wp_posts.ID IN (select post_id from wp_postmeta where wp_postmeta.meta_key = 'school_割引9_企画名' AND wp_postmeta.meta_value = '".$namevalue."' )
  OR
  wp_posts.ID IN (select post_id from wp_postmeta where wp_postmeta.meta_key = 'school_割引10_企画名' AND wp_postmeta.meta_value = '".$namevalue."' )
  OR
  wp_posts.ID IN (select post_id from wp_postmeta where wp_postmeta.meta_key = 'school_割引11_企画名' AND wp_postmeta.meta_value = '".$namevalue."' )
  OR
  wp_posts.ID IN (select post_id from wp_postmeta where wp_postmeta.meta_key = 'school_割引12_企画名' AND wp_postmeta.meta_value = '".$namevalue."' )
  OR
  wp_posts.ID IN (select post_id from wp_postmeta where wp_postmeta.meta_key = 'school_割引13_企画名' AND wp_postmeta.meta_value = '".$namevalue."' )
  OR
  wp_posts.ID IN (select post_id from wp_postmeta where wp_postmeta.meta_key = 'school_割引14_企画名' AND wp_postmeta.meta_value = '".$namevalue."' )
  OR
  wp_posts.ID IN (select post_id from wp_postmeta where wp_postmeta.meta_key = 'school_割引15_企画名' AND wp_postmeta.meta_value = '".$namevalue."' )
  OR
  wp_posts.ID IN (select post_id from wp_postmeta where wp_postmeta.meta_key = 'school_割引16_企画名' AND wp_postmeta.meta_value = '".$namevalue."' )
  OR
  wp_posts.ID IN (select post_id from wp_postmeta where wp_postmeta.meta_key = 'school_割引17_企画名' AND wp_postmeta.meta_value = '".$namevalue."' )
  OR
  wp_posts.ID IN (select post_id from wp_postmeta where wp_postmeta.meta_key = 'school_割引18_企画名' AND wp_postmeta.meta_value = '".$namevalue."' )
  OR
  wp_posts.ID IN (select post_id from wp_postmeta where wp_postmeta.meta_key = 'school_割引19_企画名' AND wp_postmeta.meta_value = '".$namevalue."' )
  OR
  wp_posts.ID IN (select post_id from wp_postmeta where wp_postmeta.meta_key = 'school_割引20_企画名' AND wp_postmeta.meta_value = '".$namevalue."' )
  OR
  wp_posts.ID IN (select post_id from wp_postmeta where wp_postmeta.meta_key = 'school_割引21_企画名' AND wp_postmeta.meta_value = '".$namevalue."' )
  OR
  wp_posts.ID IN (select post_id from wp_postmeta where wp_postmeta.meta_key = 'school_割引22_企画名' AND wp_postmeta.meta_value = '".$namevalue."' )
  OR
  wp_posts.ID IN (select post_id from wp_postmeta where wp_postmeta.meta_key = 'school_割引23_企画名' AND wp_postmeta.meta_value = '".$namevalue."' )
  OR
  wp_posts.ID IN (select post_id from wp_postmeta where wp_postmeta.meta_key = 'school_割引24_企画名' AND wp_postmeta.meta_value = '".$namevalue."' )
  OR
  wp_posts.ID IN (select post_id from wp_postmeta where wp_postmeta.meta_key = 'school_割引25_企画名' AND wp_postmeta.meta_value = '".$namevalue."' )
  OR
  wp_posts.ID IN (select post_id from wp_postmeta where wp_postmeta.meta_key = 'school_割引26_企画名' AND wp_postmeta.meta_value = '".$namevalue."' )
  OR
  wp_posts.ID IN (select post_id from wp_postmeta where wp_postmeta.meta_key = 'school_割引27_企画名' AND wp_postmeta.meta_value = '".$namevalue."' )
  OR
  wp_posts.ID IN (select post_id from wp_postmeta where wp_postmeta.meta_key = 'school_割引28_企画名' AND wp_postmeta.meta_value = '".$namevalue."' )
  OR
  wp_posts.ID IN (select post_id from wp_postmeta where wp_postmeta.meta_key = 'school_割引29_企画名' AND wp_postmeta.meta_value = '".$namevalue."' )
  )
  GROUP BY wp_posts.ID
  ORDER BY wp_posts.post_date DESC
	";

 mysqli_set_charset($link, "utf8");
 $result = mysqli_query($link,$sql);

 $postids = array();
 while ($row = $result->fetch_assoc()) {
  array_push($postids, $row['ID']);
 }

 return $postids;
}


/**
 * 特別企画のsql
 */
function sql_tokubetsu_Func($namevalue){

  //wp-configにはサーバによって、（127.0.0.1:3307のように）ポートがホストと書かれている場合があるのでその保険
  $dbhost=DB_HOST;

  //ポート番号を抽出
  if(strpos($dbhost, ":")){
    //port
    $port = strpos($dbhost, ":");
    $port= substr($dbhost, $port+1);
    //host
    $host = strpos($dbhost, ":");
    $host= substr($dbhost, 0,$host);

  }
  else{
    $port=3306;
   $host=DB_HOST;
  }
  //DBへ接続
  $link = mysqli_connect($host ,DB_USER, DB_PASSWORD, DB_NAME,$port);


 $sql = "
 SELECT ID,post_date
  FROM wp_posts
  INNER JOIN wp_postmeta ON wp_posts.ID = wp_postmeta.post_id
  WHERE wp_posts.post_type = 'school' AND wp_posts.post_status = 'publish'
  AND (
  wp_posts.ID IN (select post_id from wp_postmeta where wp_postmeta.meta_key = 'school_割引1_企画名' AND wp_postmeta.meta_value LIKE '".$namevalue."%' )
  OR
  wp_posts.ID IN (select post_id from wp_postmeta where wp_postmeta.meta_key = 'school_割引2_企画名' AND wp_postmeta.meta_value LIKE '".$namevalue."%' )
  OR
  wp_posts.ID IN (select post_id from wp_postmeta where wp_postmeta.meta_key = 'school_割引3_企画名' AND wp_postmeta.meta_value LIKE '".$namevalue."%' )
  OR
  wp_posts.ID IN (select post_id from wp_postmeta where wp_postmeta.meta_key = 'school_割引4_企画名' AND wp_postmeta.meta_value LIKE '%".$namevalue."%' )
  OR
  wp_posts.ID IN (select post_id from wp_postmeta where wp_postmeta.meta_key = 'school_割引5_企画名' AND wp_postmeta.meta_value LIKE '%".$namevalue."%' )
  OR
  wp_posts.ID IN (select post_id from wp_postmeta where wp_postmeta.meta_key = 'school_割引6_企画名' AND wp_postmeta.meta_value LIKE '%".$namevalue."%' )
  OR
  wp_posts.ID IN (select post_id from wp_postmeta where wp_postmeta.meta_key = 'school_割引7_企画名' AND wp_postmeta.meta_value LIKE '%".$namevalue."%' )
  OR
  wp_posts.ID IN (select post_id from wp_postmeta where wp_postmeta.meta_key = 'school_割引8_企画名' AND wp_postmeta.meta_value LIKE '%".$namevalue."%' )
  OR
  wp_posts.ID IN (select post_id from wp_postmeta where wp_postmeta.meta_key = 'school_割引9_企画名' AND wp_postmeta.meta_value LIKE '%".$namevalue."%' )
  OR
  wp_posts.ID IN (select post_id from wp_postmeta where wp_postmeta.meta_key = 'school_割引10_企画名' AND wp_postmeta.meta_value LIKE '%".$namevalue."%' )
  OR
  wp_posts.ID IN (select post_id from wp_postmeta where wp_postmeta.meta_key = 'school_割引11_企画名' AND wp_postmeta.meta_value LIKE '%".$namevalue."%' )
  OR
  wp_posts.ID IN (select post_id from wp_postmeta where wp_postmeta.meta_key = 'school_割引12_企画名' AND wp_postmeta.meta_value LIKE '%".$namevalue."%' )
  OR
  wp_posts.ID IN (select post_id from wp_postmeta where wp_postmeta.meta_key = 'school_割引13_企画名' AND wp_postmeta.meta_value LIKE '%".$namevalue."%' )
  OR
  wp_posts.ID IN (select post_id from wp_postmeta where wp_postmeta.meta_key = 'school_割引14_企画名' AND wp_postmeta.meta_value LIKE '%".$namevalue."%' )
  OR
  wp_posts.ID IN (select post_id from wp_postmeta where wp_postmeta.meta_key = 'school_割引15_企画名' AND wp_postmeta.meta_value LIKE '%".$namevalue."%' )
  OR
  wp_posts.ID IN (select post_id from wp_postmeta where wp_postmeta.meta_key = 'school_割引16_企画名' AND wp_postmeta.meta_value LIKE '%".$namevalue."%' )
  OR
  wp_posts.ID IN (select post_id from wp_postmeta where wp_postmeta.meta_key = 'school_割引17_企画名' AND wp_postmeta.meta_value LIKE '%".$namevalue."%' )
  OR
  wp_posts.ID IN (select post_id from wp_postmeta where wp_postmeta.meta_key = 'school_割引18_企画名' AND wp_postmeta.meta_value LIKE '%".$namevalue."%' )
  OR
  wp_posts.ID IN (select post_id from wp_postmeta where wp_postmeta.meta_key = 'school_割引19_企画名' AND wp_postmeta.meta_value LIKE '%".$namevalue."%' )
  OR
  wp_posts.ID IN (select post_id from wp_postmeta where wp_postmeta.meta_key = 'school_割引20_企画名' AND wp_postmeta.meta_value LIKE '%".$namevalue."%' )
  OR
  wp_posts.ID IN (select post_id from wp_postmeta where wp_postmeta.meta_key = 'school_割引21_企画名' AND wp_postmeta.meta_value LIKE '%".$namevalue."%' )
  OR
  wp_posts.ID IN (select post_id from wp_postmeta where wp_postmeta.meta_key = 'school_割引22_企画名' AND wp_postmeta.meta_value LIKE '%".$namevalue."%' )
  OR
  wp_posts.ID IN (select post_id from wp_postmeta where wp_postmeta.meta_key = 'school_割引23_企画名' AND wp_postmeta.meta_value LIKE '%".$namevalue."%' )
  OR
  wp_posts.ID IN (select post_id from wp_postmeta where wp_postmeta.meta_key = 'school_割引24_企画名' AND wp_postmeta.meta_value LIKE '%".$namevalue."%' )
  OR
  wp_posts.ID IN (select post_id from wp_postmeta where wp_postmeta.meta_key = 'school_割引25_企画名' AND wp_postmeta.meta_value LIKE '%".$namevalue."%' )
  OR
  wp_posts.ID IN (select post_id from wp_postmeta where wp_postmeta.meta_key = 'school_割引26_企画名' AND wp_postmeta.meta_value LIKE '%".$namevalue."%' )
  OR
  wp_posts.ID IN (select post_id from wp_postmeta where wp_postmeta.meta_key = 'school_割引27_企画名' AND wp_postmeta.meta_value LIKE '%".$namevalue."%' )
  OR
  wp_posts.ID IN (select post_id from wp_postmeta where wp_postmeta.meta_key = 'school_割引28_企画名' AND wp_postmeta.meta_value LIKE '%".$namevalue."%' )
  OR
  wp_posts.ID IN (select post_id from wp_postmeta where wp_postmeta.meta_key = 'school_割引29_企画名' AND wp_postmeta.meta_value LIKE '%".$namevalue."%' )
  )
  GROUP BY wp_posts.ID
  ORDER BY wp_posts.post_date DESC
	";

mysqli_set_charset($link, "utf8");
 $result = mysqli_query($link,$sql);

 $postids = array();
 while ($row = $result->fetch_assoc()) {
   array_push($postids, $row['ID']);
 }

 return $postids;
}


/**
 * 都道府県ごとに学校取得
 */
 function top_todouhuken_school_Func($attr){
  $result = '';

  $area = $attr[0];
  $taxonomy = 'school_cat';
  $homeURL= home_url();
  $themeURL = get_template_directory_uri();
  $args2 = array(
    'post_type' => array('school'), /* 投稿タイプを指定 */
    'order' => 'DESC',  // カスタム投稿タイプ名
    'post_status' => 'publish',
    'tax_query' => array(
    'relation' => 'AND',
      array(
        'taxonomy' => $taxonomy, /* 指定したい投稿タイプが持つタクソノミーを指定 */
        'field' => 'slug',
        'terms' => $area, /* 都道府県を指定 */
      ),
    ),
  'posts_per_page' => -1
  );
  query_posts( $args2 );
  if (have_posts()){
   while (have_posts()) :the_post();
    $postslug = get_post_field('post_name', get_the_ID());
    //値段関連
    $price_csv = csv_return_Func($postslug,'price');
    foreach ($price_csv as $key => $value) {
      if($key < 4)continue;
      foreach ($value as $key2 => $value2) {
        if($key2 == 0)continue;
        if(!empty($value2) && $value2 !== "-"){
          $eliminatedComma=str_replace(',' ,"",$value2);
          if(empty($minPrice))$minPrice = intval($eliminatedComma);
          if($eliminatedComma < intval($minPrice))$minPrice = intval($eliminatedComma);
        }
      }
    }
    if(!empty($minPrice)){
     $minPriceNumberd = number_format($minPrice);//AT値段
    }
    $ryokinhyoHeader = $price_csv[0][1];
    $ryokinhyoHeader = str_replace(',' ,"",$ryokinhyoHeader);
    preg_match('/MT車：税込(\w+).*円UP/', $ryokinhyoHeader, $mtPricematch);
    $mtPricematch2 = preg_replace('/[^0-9]/', '', $mtPricematch[1]);
    if(!empty($mtPricematch2)){
     $mtMinPrice = $minPrice + $mtPricematch2;//MT値段
    }

    //tポイント有無
    $tpoint = get_post_meta(get_the_ID(),'school_TPOINT',true);
    if(!empty($tpoint)){
     //空じゃないとき
     $tpoint = <<< EOD
   <div class="imageBox">
     <div class="image">
       <div class="image_inner">
        <a href="{$homeURL}/tpoint">
         <img src="{$themeURL}/assets/images/common/tPointBtn.png" alt="Tポイント対象" srcset="{$themeURL}/assets/images/common/tPointBtn.png 1x , {$themeURL}/assets/images/common/tPointBtn@2x.png 2x">
        </a>
       </div><!--end image_inner-->
     </div><!--end image-->
   </div><!--end imageBox-->
EOD;
    }else{
     //空の時
      $tpoint = "";
    }

    //早割り
    $hayawari_data = '';
    //for ($i=1; $i <= 30; $i++) {
     // $hayawari_name = get_post_meta(get_the_ID(),'school_割引'.$i.'_企画名',true);
     $hayawari_flg = get_post_meta(get_the_ID(),'school_割引1_適応',true);
     if($hayawari_flg == '●'){
      //あるとき
      $hayawari_data = <<< EOD
      <div class="imageBox">
        <div class="image">
          <div class="image_inner">
            <a href="{$homeURL}/discount_feature#hayawari_list">
              <img src="{$themeURL}/assets/images/common/hayawariBtn.png" alt="早割" srcset="{$themeURL}/assets/images/common/hayawariBtn.png 1x , {$themeURL}/assets/images/common/hayawariBtn@2x.png 2x">
            </a>
          </div><!--end image_inner-->
        </div><!--end image-->
      </div><!--end imageBox-->
EOD;
     }
    //}

    //学割
    $gakuwari_data = '';
    // for ($ii=1; $ii <= 30; $ii++) {
     // $gakuwari_name = get_post_meta(get_the_ID(),'school_割引'.$ii.'_企画名',true);
     $gakuwari_flg = get_post_meta(get_the_ID(),'school_割引2_適応',true);
     if($gakuwari_flg == '●'){
      //あるとき
      $gakuwari_data = <<< EOD
      <div class="imageBox">
        <div class="image">
          <div class="image_inner">
            <a href="{$homeURL}/discount_feature#gakuwari_list">
              <img src="{$themeURL}/assets/images/common/gakuwariBtn.png" alt="学割" srcset="{$themeURL}/assets/images/common/gakuwariBtn.png 1x , {$themeURL}/assets/images/common/gakuwariBtn@2x.png 2x">
              </a>
          </div><!--end image_inner-->
        </div><!--end image-->
      </div><!--end imageBox-->
EOD;
     }
    // }

    //G割
    $Gwari_data = '';
    // for ($iii=1; $iii <= 30; $iii++) {
     // $Gwari_name = get_post_meta(get_the_ID(),'school_割引'.$iii.'_企画名',true);
     $Gwari_flg = get_post_meta(get_the_ID(),'school_割引3_適応',true);
     if($Gwari_flg == '●'){
      //あるとき
      $Gwari_data = <<< EOD
      <div class="imageBox">
        <div class="image">
          <div class="image_inner">
            <a href="{$homeURL}/discount_feature#gwari_list">
             <img src="{$themeURL}/assets/images/common/gwariBtn.png" alt="G割" srcset="{$themeURL}/assets/images/common/gwariBtn.png 1x , {$themeURL}/assets/images/common/gwariBtn@2x.png 2x">
            </a>
          </div><!--end image_inner-->
        </div><!--end image-->
      </div><!--end imageBox-->
EOD;
     }
    // }

    $title = get_the_title();//タイトル
    $link = get_permalink();//詳細リンク
    $contact_link = '/contact?sec='.$title;//お問合せ
    $minPriceNumberd;//AT値段
    $mtMinPrice;//MT値段
    // $tpoint;//tpoint
    // $hayawari_data;//早割
    // $gakuwari_data;//学割
    // $Gwari_data;//G割
    $minPriceNumberdwoTax=(int)get_post_meta(get_the_ID(),'school_AT最低料金',true);
    $minPriceNumberd = number_format(floor($minPriceNumberdwoTax)*1.08);//料金設定


    $mtMinPrice = (floor((int)get_post_meta(get_the_ID(),'school_MT料金UP',true)) * 1.08) + (floor($minPriceNumberdwoTax)*1.08);//料金設定
    $mtMinPriceTaxed = number_format(floor($mtMinPrice));//料金設定

    //静岡県セイブ自動車学校だけ例外処理
    if($title == "静岡県セイブ自動車学校"){
          $minPriceNumberd = number_format((floor($minPriceNumberdwoTax*1.08 / 10000 * 1000))*10);
          $mtMinPriceTaxed = number_format((floor($mtMinPrice / 10000 * 1000))*10);
    }




    $result .= <<< EOD
    <!--start dormitory_wrap-->
    <div class="dormitory_wrap">
      <div class="dormitory_inner flex">
        <div class="dormitory_co1 dormitory_co box_co">
          <div class="dormitory_info dormitory_border">
            <a href="{$link}" class="dormitory_name skn_dormitory_name">{$title}</a>
            <div class="flex">
              <span class="skn_dormitory_at">普通⾞AT{$minPriceNumberd}円<span class="taxLabel">(税込)</span>〜</span>
              <span class="skn_dormitory_mt">普通⾞MT{$mtMinPriceTaxed}円<span class="taxLabel">(税込)</span>〜</span>
            </div>
          </div>
        </div><!--end dormitory_co-->
        <div class="dormitory_co2 dormitory_co box_co">
          <div class="sale_info flex dormitory_border">
            <div class="sale_A">
              {$tpoint}
            </div>
            <div class="sale_B">
              {$hayawari_data}
            </div>
            <div class="sale_C">
              {$gakuwari_data}
            </div>
            <div class="sale_D">
              {$Gwari_data}
            </div>
          </div>
        </div><!--end dormitory_co-->
        <div class="dormitory_co3 dormitory_co box_co">
          <div class="dormitory_btns">
            <div class="dormitory_btnA">
              <a href="{$link}" class="btn skn_orange_rivers dblArrow_right">学校詳細</a>
            </div>
            <div class="dormitory_btnB">
              <a href="{$contact_link}" class="btn skn_blue_rivers dblArrow_right">問い合わせ</a>
            </div>
          </div>
        </div><!--end dormitory_co-->
      </div><!--end dormitory_inner-->
    </div><!--end dormitory_wrap-->
EOD;

   endwhile;
  }

  $ret_block = '';
  if(!empty($result)){
   $termname = get_term_by('slug', $area, 'school_cat');
   $ret_block = <<<EOM
   <div class="dormiory_block">
     <div class="dormiory_inner_row1 dormiory_row box_row">
       <!--start prefecture_wrap-->
       <div class="prefecture_wrap">
         <div class="prefecture_inner flex">
           <div class="prefecture_co1 prefecture_co box_co">
             {$termname->name}
           </div><!--end prefecture_co-->
           <div class="prefecture_co2 prefecture_co box_co">
             {$result}
           </div><!--end prefecture_co-->
         </div><!--end prefecture_inner-->
       </div><!--end prefecture_wrap-->
     </div><!--end dormiory_row-->
   </div><!--end dormiory_block-->
EOM;
  }

  return $ret_block;
 }
 add_shortcode('top_todouhuken_school', 'top_todouhuken_school_Func');


/**
 * 免許皆伝サイドn件
 */
function side_menkyokaiden_Func($attr){
 $result = '';
 $getnum = 5;
 if(!empty($attr[0]))$getnum = $attr[0];
 $customPostArg = array(
   'posts_per_page' => $getnum,
   'post_status' => 'publish',
   'post_type'      => 'post',
   'category_name' => 'untenmenkyokaiden',
   'order'      => 'DESC',
 );
 $the_query = new WP_Query($customPostArg);
 if ( $the_query->have_posts() ) :
  while ( $the_query->have_posts() ) : $the_query->the_post();
   $mydate = get_post_time('Y年n月j日');
   $mypath = get_the_permalink();
   $mytitle = get_the_title();
   $result .= <<<EOM
   <li class="marginBottom1">
     <span class="publicity_date">{$mydate}</span>
     <a href="{$mypath}">
       <span class="publicity_title">{$mytitle}</span>
     </a>
   </li>
EOM;
  endwhile;
 endif;

 return $result;
}
add_shortcode('side_menkyokaiden', 'side_menkyokaiden_Func');


/**
 * 割引特集のところ
 */
 function waribiki_list_Func($attr){
  $result = '';
  $waribikiflg = 0;
  $pid = $attr[0];
  $bikiname = $attr[1];
  $tokubetukikaku_flg = $attr[2];//特別企画のフラグ
  $taxonomy = 'school_cat';
  $themeURL = get_template_directory_uri();
  $args2 = array(
  'post_type' => array('school'), /* 投稿タイプを指定 */
  'order' => 'DESC',  // カスタム投稿タイプ名
  'post_status' => 'publish',
  'p' => $pid,
  'posts_per_page' => -1
  );
  query_posts( $args2 );
  if (have_posts()){
   while (have_posts()) :the_post();

    $postslug = get_post_field('post_name', get_the_ID());
    //値段関連
    $price_csv = csv_return_Func($postslug,'price');
    foreach ($price_csv as $key => $value) {
      if($key < 4)continue;
      foreach ($value as $key2 => $value2) {
        if($key2 == 0)continue;
        if(!empty($value2) && $value2 !== "-"){
          $eliminatedComma=str_replace(',' ,"",$value2);
          if(empty($minPrice))$minPrice = intval($eliminatedComma);
          if($eliminatedComma < intval($minPrice))$minPrice = intval($eliminatedComma);
        }
      }
    }
    if(!empty($minPrice)){
     $minPriceNumberd = number_format($minPrice);//AT値段
    }
    $ryokinhyoHeader = $price_csv[0][1];
    $ryokinhyoHeader = str_replace(',' ,"",$ryokinhyoHeader);
    preg_match('/MT車：税込(\w+).*円UP/', $ryokinhyoHeader, $mtPricematch);
    $mtPricematch2 = preg_replace('/[^0-9]/', '', $mtPricematch[1]);
    if(!empty($mtPricematch2)){
     $mtMinPrice = $minPrice + $mtPricematch2;//MT値段
    }

    //tポイント有無
    $tpoint = get_post_meta(get_the_ID(),'school_TPOINT',true);
    if(!empty($tpoint)){
     //空じゃないとき
     $tpoint = <<< EOD
   <div class="imageBox">
     <div class="image">
       <div class="image_inner">
         <a href="{$homeURL}/tpoint">
          <img src="{$themeURL}/assets/images/common/tPointBtn.png" alt="Tポイント対象" srcset="{$themeURL}/assets/images/common/tPointBtn.png 1x , {$themeURL}/assets/images/common/tPointBtn@2x.png 2x">
         </a>
       </div><!--end image_inner-->
     </div><!--end image-->
   </div><!--end imageBox-->
EOD;
    }else{
     //空の時
      $tpoint = "";
    }

    //早割り
    $hayawari_data = '';
    // for ($i=1; $i <= 30; $i++) {
     // $hayawari_name = get_post_meta(get_the_ID(),'school_割引'.$i.'_企画名',true);
     $hayawari_flg = get_post_meta(get_the_ID(),'school_割引1_適応',true);
     if($hayawari_flg == '●'){
      //あるとき
      $hayawari_data = <<< EOD
      <div class="imageBox">
        <div class="image">
          <div class="image_inner">
            <a href="{$homeURL}/discount_feature#hayawari_list">
              <img src="{$themeURL}/assets/images/common/hayawariBtn.png" alt="早割" srcset="{$themeURL}/assets/images/common/hayawariBtn.png 1x , {$themeURL}/assets/images/common/hayawariBtn@2x.png 2x">
            </a>
          </div><!--end image_inner-->
        </div><!--end image-->
      </div><!--end imageBox-->
EOD;
     }
    // }

    //学割
    //学割
    $gakuwari_data = '';
    // for ($ii=1; $ii <= 30; $ii++) {
     // $gakuwari_name = get_post_meta(get_the_ID(),'school_割引'.$ii.'_企画名',true);
     $gakuwari_flg = get_post_meta(get_the_ID(),'school_割引2_適応',true);
     if($gakuwari_flg == '●'){
      //あるとき
      $gakuwari_data = <<< EOD
      <div class="imageBox">
        <div class="image">
          <div class="image_inner">
            <a href="{$homeURL}/discount_feature#gakuwari_list">
              <img src="{$themeURL}/assets/images/common/gakuwariBtn.png" alt="学割" srcset="{$themeURL}/assets/images/common/gakuwariBtn.png 1x , {$themeURL}/assets/images/common/gakuwariBtn@2x.png 2x">
            </a>
          </div><!--end image_inner-->
        </div><!--end image-->
      </div><!--end imageBox-->
EOD;
     }
    // }

    //G割
    $Gwari_data = '';
    // for ($iii=1; $iii <= 30; $iii++) {
     // $Gwari_name = get_post_meta(get_the_ID(),'school_割引'.$iii.'_企画名',true);
     $Gwari_flg = get_post_meta(get_the_ID(),'school_割引3_適応',true);
     if($Gwari_flg == '●'){
      //あるとき
      $Gwari_data = <<< EOD
      <div class="imageBox">
        <div class="image">
          <div class="image_inner">
            <a href="{$homeURL}/discount_feature#gwari_list">
             <img src="{$themeURL}/assets/images/common/gwariBtn.png" alt="G割" srcset="{$themeURL}/assets/images/common/gwariBtn.png 1x , {$themeURL}/assets/images/common/gwariBtn@2x.png 2x">
            </a>
          </div><!--end image_inner-->
        </div><!--end image-->
      </div><!--end imageBox-->
EOD;
     }
    // }


    $wari_data = '';
    if(!empty($tokubetukikaku_flg)){//特別企画のとき
     for ($iiii=1; $iiii <= 29; $iiii++) {
      $wari_name = get_post_meta(get_the_ID(),'school_割引'.$iiii.'_企画名',true);
      $wari_flg = get_post_meta(get_the_ID(),'school_割引'.$iiii.'_適応',true);
      if(strpos($wari_name, $bikiname) !== false && $wari_flg == '●'){
       $wari_data = 'sp';
      }
     }
    }


    $title = get_the_title();//タイトル
    $link = get_permalink();//詳細リンク
    $contact_link = '/contact?sec='.$title;//お問合せ
    $minPriceNumberd;//AT値段
    $mtMinPrice;//MT値段

    // $myterms = wp_get_object_terms(get_the_ID(),'school_cat');
    // foreach($myterms as $myterm){
    //  $area_cat = $term->slug;
    // }
    // $area_cat = '';
    // 県名後回し


    $minPriceNumberdwoTax = (int)get_post_meta(get_the_ID(),'school_AT最低料金',true);
    $minPriceNumberd = number_format(floor($minPriceNumberdwoTax*1.08));//料金設定


    $mtMinPricewoTax = (int)get_post_meta(get_the_ID(),'school_MT料金UP',true) + (int)get_post_meta(get_the_ID(),'school_AT最低料金',true);//料金設定
    $mtMinPrice = number_format(floor($mtMinPricewoTax)*1.08);//料金設定

    //静岡県セイブ自動車学校だけ例外処理
    if($title == "静岡県セイブ自動車学校"){
          $minPriceNumberd = number_format((floor($minPriceNumberdwoTax*1.08 / 10000 * 1000))*10);
          $mtMinPrice = number_format((floor($mtMinPricewoTax*1.08 / 10000 * 1000))*10);
    }


    $result .= <<< EOD
    <!--start dormitory_wrap-->
    <div class="dormitory_wrap">
      <div class="dormitory_inner flex">
        <div class="dormitory_co1 dormitory_co box_co">
          <div class="dormitory_info dormitory_border">
            <a href="{$link}" class="dormitory_name skn_dormitory_name">{$title}</a>
            <div class="flex">
              <span class="skn_dormitory_at">普通⾞AT {$minPriceNumberd}円<span class="taxLabel">(税込)</span>〜</span>
              <span class="skn_dormitory_mt">普通⾞MT {$mtMinPrice}円<span class="taxLabel">(税込)</span>〜</span>
            </div>
          </div>
        </div><!--end dormitory_co-->
        <div class="dormitory_co2 dormitory_co box_co">
          <div class="sale_info flex dormitory_border">
            <div class="sale_A">
              {$tpoint}
            </div>
            <div class="sale_B">
              {$hayawari_data}
            </div>
            <div class="sale_C">
              {$gakuwari_data}
            </div>
            <div class="sale_D">
              {$Gwari_data}
            </div>
          </div>
        </div><!--end dormitory_co-->
        <div class="dormitory_co3 dormitory_co box_co">
          <div class="dormitory_btns">
            <div class="dormitory_btnA">
              <a href="{$link}" class="btn skn_orange_rivers dblArrow_right">学校詳細</a>
            </div>
            <div class="dormitory_btnB">
              <a href="{$contact_link}" class="btn skn_blue_rivers dblArrow_right">問い合わせ</a>
            </div>
          </div>
        </div><!--end dormitory_co-->
      </div><!--end dormitory_inner-->
    </div><!--end dormitory_wrap-->
EOD;

   endwhile;
  }


  $ret_block = '';
  if(!empty($result)){
   $termname = get_term_by('slug', $area, 'school_cat');
   $ret_block = <<<EOM
   <div class="dormiory_block">
     <div class="dormiory_row1 dormiory_row box_row">
       <!--start prefecture_wrap-->
       <div class="prefecture_wrap">
         <div class="prefecture_inner flex">
           <div class="prefecture_co2 prefecture_co box_co">
             {$result}
           </div><!--end prefecture_co-->
         </div><!--end prefecture_inner-->
       </div><!--end prefecture_wrap-->
     </div><!--end dormiory_row-->
   </div><!--end dormiory_block-->
EOM;
  }


  if(!empty($tokubetukikaku_flg)){//特別企画のとき
   if(empty($wari_data)){
    $ret_block = "";
   }
  }else{
   if(strpos($bikiname, '早割') !== false && empty($hayawari_data)){
    $ret_block = "";
   }else if(strpos($bikiname, '学割') !== false && empty($gakuwari_data)){
    $ret_block = "";
   }else if(strpos($bikiname, 'Ｇ割') !== false && empty($Gwari_data)){
    $ret_block = "";
   }
  }

  return $ret_block;
 }
 add_shortcode('waribiki_list', 'waribiki_list_Func');


/**
 * サイドバー　目的別教習所選び
 */
function side_mokutekischool_Func(){
 $result = '';
 $works_id = get_term_by( 'slug', 'feature', 'school_cat' );
 $result = NULL;
 $args = array(
   'hide_empty' => false,
   'parent' => $works_id->term_id,
   'orderby' => 'description'
 );
 // カスタム分類のタームのリストを取得
 $terms = get_terms( 'school_cat' , $args );
 if( !empty( $terms ) && !is_wp_error( $terms ) ) {
   foreach($terms as $term){
     // $result .= '<p>'.$term->name."\n".'</p>';
     $result .= '<li>
  				<a href="https://www.happymenkyo.com/school_cat/'.$term->slug.'">'.$term->name.'</a>
  			</li>';
   }
 }

 return $result;
}
add_shortcode('side_mokutekischool', 'side_mokutekischool_Func');


/*
*Tポイント一覧
 */
 function get_tpoint_school_Func(){
  $result = '';
  $taxonomy = 'school_cat';
  $themeURL = get_template_directory_uri();
  $todofuken_id = get_term_by( 'slug', 'todofuken', $taxonomy );
  $args = array(
   'hide_empty' => true,
   'parent' => $todofuken_id->term_id,
   'orderby' => 'description'
  );
  // カスタム分類のタームのリストを取得
  $terms = get_terms( $taxonomy , $args );
  if( !empty( $terms ) && !is_wp_error( $terms ) ) {
   foreach($terms as $term){
    $result_head = '';
    $result_body = '';
    $result_foot = '';
    $args2 = array(
     'post_type' => array('school'), /* 投稿タイプを指定 */
     'order' => 'DESC',  // カスタム投稿タイプ名
     'orderby' => 'date',
     'post_status' => 'publish',
     'tax_query' => array(
      'relation' => 'AND',
      array(
       'taxonomy' => $taxonomy, /* 指定したい投稿タイプが持つタクソノミーを指定 */
       'field' => 'slug',
       'terms' => $term->slug, /* 都道府県を指定 */
      ),
     ),
     'posts_per_page' => -1
    );
    $the_query = new WP_Query($args2);
    if ( $the_query->have_posts() ) :
     $area_name = $term->name;
     while ( $the_query->have_posts() ) : $the_query->the_post();
     //tpoint ● notoki
     $point_flg = get_post_meta(get_the_ID(),'school_TPOINT',true);
     if($point_flg == "●"){
      //tポイント有無
      $tpoint = get_post_meta(get_the_ID(),'school_TPOINT',true);
      if(!empty($tpoint)){
       //空じゃないとき
       $tpoint = <<< EOD
     <div class="imageBox">
       <div class="image">
         <div class="image_inner">
          <a href="{$homeURL}/tpoint">
           <img src="{$themeURL}/assets/images/common/tPointBtn.png" alt="Tポイント対象" srcset="{$themeURL}/assets/images/common/tPointBtn.png 1x , {$themeURL}/assets/images/common/tPointBtn@2x.png 2x">
          </a>
         </div><!--end image_inner-->
       </div><!--end image-->
     </div><!--end imageBox-->
EOD;
      }else{
       //空の時
        $tpoint = "";
      }

      //早割り
      $hayawari_data = '';
      //for ($i=1; $i <= 30; $i++) {
       // $hayawari_name = get_post_meta(get_the_ID(),'school_割引'.$i.'_企画名',true);
       $hayawari_flg = get_post_meta(get_the_ID(),'school_割引1_適応',true);
       if($hayawari_flg == '●'){
        //あるとき
        $hayawari_data = <<< EOD
        <div class="imageBox">
          <div class="image">
            <div class="image_inner">
              <a href="{$homeURL}/discount_feature#hayawari_list">
                <img src="{$themeURL}/assets/images/common/hayawariBtn.png" alt="早割" srcset="{$themeURL}/assets/images/common/hayawariBtn.png 1x , {$themeURL}/assets/images/common/hayawariBtn@2x.png 2x">
              </a>
            </div><!--end image_inner-->
          </div><!--end image-->
        </div><!--end imageBox-->
EOD;
       }
      //}

      //学割
      $gakuwari_data = '';
      // for ($ii=1; $ii <= 30; $ii++) {
       // $gakuwari_name = get_post_meta(get_the_ID(),'school_割引'.$ii.'_企画名',true);
       $gakuwari_flg = get_post_meta(get_the_ID(),'school_割引2_適応',true);
       if($gakuwari_flg == '●'){
        //あるとき
        $gakuwari_data = <<< EOD
        <div class="imageBox">
          <div class="image">
            <div class="image_inner">
              <a href="{$homeURL}/discount_feature#gakuwari_list">
                <img src="{$themeURL}/assets/images/common/gakuwariBtn.png" alt="学割" srcset="{$themeURL}/assets/images/common/gakuwariBtn.png 1x , {$themeURL}/assets/images/common/gakuwariBtn@2x.png 2x">
                </a>
            </div><!--end image_inner-->
          </div><!--end image-->
        </div><!--end imageBox-->
EOD;
       }
      // }

      //G割
      $Gwari_data = '';
      // for ($iii=1; $iii <= 30; $iii++) {
       // $Gwari_name = get_post_meta(get_the_ID(),'school_割引'.$iii.'_企画名',true);
       $Gwari_flg = get_post_meta(get_the_ID(),'school_割引3_適応',true);
       if($Gwari_flg == '●'){
        //あるとき
        $Gwari_data = <<< EOD
        <div class="imageBox">
          <div class="image">
            <div class="image_inner">
              <a href="{$homeURL}/discount_feature#gwari_list">
               <img src="{$themeURL}/assets/images/common/gwariBtn.png" alt="G割" srcset="{$themeURL}/assets/images/common/gwariBtn.png 1x , {$themeURL}/assets/images/common/gwariBtn@2x.png 2x">
              </a>
            </div><!--end image_inner-->
          </div><!--end image-->
        </div><!--end imageBox-->
EOD;
       }
      // }

      $title = get_the_title();//タイトル
      $link = get_permalink();//詳細リンク
      $contact_link = home_url().'/contact?sec='.$title;//お問合せ
      $minPriceNumberd;//AT値段
      $mtMinPrice;//MT値段
      // $tpoint;//tpoint
      // $hayawari_data;//早割
      // $gakuwari_data;//学割
      // $Gwari_data;//G割
      $minPriceNumberdwoTax=(int)get_post_meta(get_the_ID(),'school_AT最低料金',true);
      $minPriceNumberd = number_format(floor($minPriceNumberdwoTax)*1.08);//料金設定


      $mtMinPrice = (floor((int)get_post_meta(get_the_ID(),'school_MT料金UP',true)) * 1.08) + (floor($minPriceNumberdwoTax)*1.08);//料金設定
      $mtMinPriceTaxed = number_format(floor($mtMinPrice));//料金設定

      //静岡県セイブ自動車学校だけ例外処理
      if($title == "静岡県セイブ自動車学校"){
            $minPriceNumberd = number_format((floor($minPriceNumberdwoTax*1.08 / 10000 * 1000))*10);
            $mtMinPriceTaxed = number_format((floor($mtMinPrice / 10000 * 1000))*10);
      }

      $result .= <<< EOD
      <!--start dormitory_wrap-->
      <div class="dormitory_wrap">
        <div class="dormitory_inner flex">
          <div class="dormitory_co1 dormitory_co box_co">
            <div class="dormitory_info dormitory_border">
              <a href="{$link}" class="dormitory_name skn_dormitory_name">{$title}</a>
              <div class="flex">
                <span class="skn_dormitory_at">普通⾞AT{$minPriceNumberd}円<span class="taxLabel">(税込)</span>〜</span>
                <span class="skn_dormitory_mt">普通⾞MT{$mtMinPriceTaxed}円<span class="taxLabel">(税込)</span>〜</span>
              </div>
            </div>
          </div><!--end dormitory_co-->
          <div class="dormitory_co2 dormitory_co box_co">
            <div class="sale_info flex dormitory_border">
              <div class="sale_A">
                {$tpoint}
              </div>
              <div class="sale_B">
                {$hayawari_data}
              </div>
              <div class="sale_C">
                {$gakuwari_data}
              </div>
              <div class="sale_D">
                {$Gwari_data}
              </div>
            </div>
          </div><!--end dormitory_co-->
          <div class="dormitory_co3 dormitory_co box_co">
            <div class="dormitory_btns">
              <div class="dormitory_btnA">
                <a href="{$link}" class="btn skn_orange_rivers dblArrow_right">学校詳細</a>
              </div>
              <div class="dormitory_btnB">
                <a href="{$contact_link}" class="btn skn_blue_rivers dblArrow_right">問い合わせ</a>
              </div>
            </div>
          </div><!--end dormitory_co-->
        </div><!--end dormitory_inner-->
      </div><!--end dormitory_wrap-->
EOD;

     }/**tpoint_flg 終わり*/
    endwhile;

    // $ret_block = '';
    if(!empty($result)){
     $ret_block .= <<<EOM
     <div class="dormiory_block">
       <div class="dormiory_inner_row1 dormiory_row box_row">
         <!--start prefecture_wrap-->
         <div class="prefecture_wrap">
           <div class="prefecture_inner flex">
             <div class="prefecture_co1 prefecture_co box_co">
               {$term->name}
             </div><!--end prefecture_co-->
             <div class="prefecture_co2 prefecture_co box_co">
               {$result}
             </div><!--end prefecture_co-->
           </div><!--end prefecture_inner-->
         </div><!--end prefecture_wrap-->
       </div><!--end dormiory_row-->
     </div><!--end dormiory_block-->
EOM;
$result = '';
    }

   endif;
   // 投稿データをリセット
   wp_reset_postdata();
  }/**都道府県ループ終わり*/
 }



 return $ret_block;
 }
 add_shortcode('get_tpoint_school', 'get_tpoint_school_Func');


 /**
  * サイドバー　クイック検索
  */
 function side_quicksearch_Func(){
  $result = '';
  $taxonomy = 'school_cat';

  ///////////////////////////////エリア
  $area_list = '';
  $area_id = get_term_by( 'slug', 'area', $taxonomy );
  $args = array(
    'hide_empty' => false,
    'parent' => $area_id->term_id,
    'orderby' => 'description'
  );
  // カスタム分類のタームのリストを取得
  $terms = get_terms( $taxonomy , $args );
  if( !empty( $terms ) && !is_wp_error( $terms ) ) {
    foreach($terms as $term){
     $area_list .= '<option value="'.$term->slug.'">'.$term->name.'</option>';
    }
  }
  //////////////////////////////

  ///////////////////////////////免許種類
  $menkyo_list = '';
  $menkyo_arr = array('普通AT', '普通MT', '普通二輪',
                     '大型二輪', '準中型', '中型',
                     '大型', '大型特殊', 'けん引',
                     '普通二種', '大型二種', 'フォークリフト');
  foreach ($menkyo_arr as $menkyo) {
   $menkyo_list .= '<option value="'.$menkyo.'">'.$menkyo.'</option>';
  }
  //////////////////////////////

  ///////////////////////////////こだわり
  $kodawari_list = '';
  $kodawari_id = get_term_by( 'slug', 'feature', $taxonomy );
  $args2 = array(
    'hide_empty' => false,
    'parent' => $kodawari_id->term_id,
    'orderby' => 'description'
  );
  // カスタム分類のタームのリストを取得
  $terms2 = get_terms( $taxonomy , $args2 );
  if( !empty( $terms2 ) && !is_wp_error( $terms2 ) ) {
    foreach($terms2 as $term2){
     $kodawari_list .= '<div class="checkList"><input type="checkbox" name="kodawari_data[]" value="'.$term2->slug.'" id="'.$term2->slug.'" /><label for="'.$term2->slug.'">'.$term2->name.'</label></div>';
    }
  }
  //////////////////////////////



  $result = <<<EOM
  <div class="side_quickSearch side_box side_margin_bottom">
    <div class="side_box_title side_quickSearch_icon">
      <span>合宿免許クイック検索</span>
    </div>
    <div class="side_box_wrap">
      <form method="POST" name="quicksearchForm" action="/quick_search" class="side_search_select">
        <div class="side_select_box">
          <div class="side_areaSelect">
            <span class="side_areaSelect_title">希望入校教習所エリア</span>
            <select name="area_data">
              <option value="">エリアを選択してください</option>
              {$area_list}
            </select>
          </div>
          <div class="side_schoolSelect">
            <span class="side_schoolSelect_title">免許の種類</span>
            <select name="menkyo_data">
              <option value="">免許の種類を選択してください</option>
              {$menkyo_list}
            </select>
          </div>
        </div>
        <div class="side_kodawari_box">
          <span class="side_kodawari_title">こだわり検索</span>
          <div class="side_kodawari_checklist">
            {$kodawari_list}
          </div>
        </div>
        <div class="side_quick_search_btn">
          <a onClick="document.quicksearchForm.submit();" class="btn skn_green">教習所検索</a>
        </div>
      </form>
    </div>
  </div>
EOM;

  return $result;
 }
 add_shortcode('side_quicksearch', 'side_quicksearch_Func');



/**
 * 特別企画一覧(自炊プラン)
 */
 function tokubetukikaku_list_Func($attr){
  $result = '';
  $waribikiflg = 0;
  $slug_name = $attr[0];
  $tokubetukikaku_flg = $attr[1];//特別企画のフラグ
  $taxonomy = 'school_cat';
  $themeURL = get_template_directory_uri();
  $args2 = array(
    'post_type' => array('school'), /* 投稿タイプを指定 */
    'order' => 'DESC',  // カスタム投稿タイプ名
    'post_status' => 'publish',
    'tax_query' => array(
    'relation' => 'AND',
      array(
        'taxonomy' => $taxonomy, /* 指定したい投稿タイプが持つタクソノミーを指定 */
        'field' => 'slug',
        'terms' => $slug_name, /* 都道府県を指定 */
      ),
    ),
  'posts_per_page' => -1
  );
  query_posts( $args2 );
  if (have_posts()){
   while (have_posts()) :the_post();

    $postslug = get_post_field('post_name', get_the_ID());
    //値段関連
    $price_csv = csv_return_Func($postslug,'price');
    foreach ($price_csv as $key => $value) {
      if($key < 4)continue;
      foreach ($value as $key2 => $value2) {
        if($key2 == 0)continue;
        if(!empty($value2) && $value2 !== "-"){
          $eliminatedComma=str_replace(',' ,"",$value2);
          if(empty($minPrice))$minPrice = intval($eliminatedComma);
          if($eliminatedComma < intval($minPrice))$minPrice = intval($eliminatedComma);
        }
      }
    }
    if(!empty($minPrice)){
     $minPriceNumberd = number_format($minPrice);//AT値段
    }
    $ryokinhyoHeader = $price_csv[0][1];
    $ryokinhyoHeader = str_replace(',' ,"",$ryokinhyoHeader);
    preg_match('/MT車：税込(\w+).*円UP/', $ryokinhyoHeader, $mtPricematch);
    $mtPricematch2 = preg_replace('/[^0-9]/', '', $mtPricematch[1]);
    if(!empty($mtPricematch2)){
     $mtMinPrice = $minPrice + $mtPricematch2;//MT値段
    }

    //tポイント有無
    $tpoint = get_post_meta(get_the_ID(),'school_TPOINT',true);
    if(!empty($tpoint)){
     //空じゃないとき
     $tpoint = <<< EOD
   <div class="imageBox">
     <div class="image">
       <div class="image_inner">
         <a href="{$homeURL}/tpoint">
          <img src="{$themeURL}/assets/images/common/tPointBtn.png" alt="Tポイント対象" srcset="{$themeURL}/assets/images/common/tPointBtn.png 1x , {$themeURL}/assets/images/common/tPointBtn@2x.png 2x">
         </a>
       </div><!--end image_inner-->
     </div><!--end image-->
   </div><!--end imageBox-->
EOD;
    }else{
     //空の時
      $tpoint = "";
    }

    //早割り
    $hayawari_data = '';
    // for ($i=1; $i <= 30; $i++) {
     // $hayawari_name = get_post_meta(get_the_ID(),'school_割引'.$i.'_企画名',true);
     $hayawari_flg = get_post_meta(get_the_ID(),'school_割引1_適応',true);
     if($hayawari_flg == '●'){
      //あるとき
      $hayawari_data = <<< EOD
      <div class="imageBox">
        <div class="image">
          <div class="image_inner">
            <a href="{$homeURL}/discount_feature#hayawari_list">
              <img src="{$themeURL}/assets/images/common/hayawariBtn.png" alt="早割" srcset="{$themeURL}/assets/images/common/hayawariBtn.png 1x , {$themeURL}/assets/images/common/hayawariBtn@2x.png 2x">
            </a>
          </div><!--end image_inner-->
        </div><!--end image-->
      </div><!--end imageBox-->
EOD;
     }
    // }

    //学割
    //学割
    $gakuwari_data = '';
    // for ($ii=1; $ii <= 30; $ii++) {
     // $gakuwari_name = get_post_meta(get_the_ID(),'school_割引'.$ii.'_企画名',true);
     $gakuwari_flg = get_post_meta(get_the_ID(),'school_割引2_適応',true);
     if($gakuwari_flg == '●'){
      //あるとき
      $gakuwari_data = <<< EOD
      <div class="imageBox">
        <div class="image">
          <div class="image_inner">
            <a href="{$homeURL}/discount_feature#gakuwari_list">
              <img src="{$themeURL}/assets/images/common/gakuwariBtn.png" alt="学割" srcset="{$themeURL}/assets/images/common/gakuwariBtn.png 1x , {$themeURL}/assets/images/common/gakuwariBtn@2x.png 2x">
            </a>
          </div><!--end image_inner-->
        </div><!--end image-->
      </div><!--end imageBox-->
EOD;
     }
    // }

    //G割
    $Gwari_data = '';
    // for ($iii=1; $iii <= 30; $iii++) {
     // $Gwari_name = get_post_meta(get_the_ID(),'school_割引'.$iii.'_企画名',true);
     $Gwari_flg = get_post_meta(get_the_ID(),'school_割引3_適応',true);
     if($Gwari_flg == '●'){
      //あるとき
      $Gwari_data = <<< EOD
      <div class="imageBox">
        <div class="image">
          <div class="image_inner">
            <a href="{$homeURL}/discount_feature#gwari_list">
             <img src="{$themeURL}/assets/images/common/gwariBtn.png" alt="G割" srcset="{$themeURL}/assets/images/common/gwariBtn.png 1x , {$themeURL}/assets/images/common/gwariBtn@2x.png 2x">
            </a>
          </div><!--end image_inner-->
        </div><!--end image-->
      </div><!--end imageBox-->
EOD;
     }
    // }


    $wari_data = '';
    if(!empty($tokubetukikaku_flg)){//特別企画のとき
     // for ($iiii=1; $iiii <= 29; $iiii++) {
     //  $wari_name = get_post_meta(get_the_ID(),'school_割引'.$iiii.'_企画名',true);
     //  $wari_flg = get_post_meta(get_the_ID(),'school_割引'.$iiii.'_適応',true);
     //  if(strpos($wari_name, $bikiname) !== false && $wari_flg == '●'){
       $wari_data = 'sp';
     //  }
     // }
    }


    $title = get_the_title();//タイトル
    $link = get_permalink();//詳細リンク
    $contact_link = '/contact?sec='.$title;//お問合せ
    $minPriceNumberd;//AT値段
    $mtMinPrice;//MT値段

    // $myterms = wp_get_object_terms(get_the_ID(),'school_cat');
    // foreach($myterms as $myterm){
    //  $area_cat = $term->slug;
    // }
    // $area_cat = '';
    // 県名後回し


    $minPriceNumberdwoTax = (int)get_post_meta(get_the_ID(),'school_AT最低料金',true);
    $minPriceNumberd = number_format(floor($minPriceNumberdwoTax*1.08));//料金設定


    $mtMinPricewoTax = (int)get_post_meta(get_the_ID(),'school_MT料金UP',true) + (int)get_post_meta(get_the_ID(),'school_AT最低料金',true);//料金設定
    $mtMinPrice = number_format(floor($mtMinPricewoTax)*1.08);//料金設定

    //静岡県セイブ自動車学校だけ例外処理
    if($title == "静岡県セイブ自動車学校"){
          $minPriceNumberd = number_format((floor($minPriceNumberdwoTax*1.08 / 10000 * 1000))*10);
          $mtMinPrice = number_format((floor($mtMinPricewoTax*1.08 / 10000 * 1000))*10);
    }


    $result .= <<< EOD
    <!--start dormitory_wrap-->
    <div class="dormitory_wrap">
      <div class="dormitory_inner flex">
        <div class="dormitory_co1 dormitory_co box_co">
          <div class="dormitory_info dormitory_border">
            <a href="{$link}" class="dormitory_name skn_dormitory_name">{$title}</a>
            <div class="flex">
              <span class="skn_dormitory_at">普通⾞AT {$minPriceNumberd}円<span class="taxLabel">(税込)</span>〜</span>
              <span class="skn_dormitory_mt">普通⾞MT {$mtMinPrice}円<span class="taxLabel">(税込)</span>〜</span>
            </div>
          </div>
        </div><!--end dormitory_co-->
        <div class="dormitory_co2 dormitory_co box_co">
          <div class="sale_info flex dormitory_border">
            <div class="sale_A">
              {$tpoint}
            </div>
            <div class="sale_B">
              {$hayawari_data}
            </div>
            <div class="sale_C">
              {$gakuwari_data}
            </div>
            <div class="sale_D">
              {$Gwari_data}
            </div>
          </div>
        </div><!--end dormitory_co-->
        <div class="dormitory_co3 dormitory_co box_co">
          <div class="dormitory_btns">
            <div class="dormitory_btnA">
              <a href="{$link}" class="btn skn_orange_rivers dblArrow_right">学校詳細</a>
            </div>
            <div class="dormitory_btnB">
              <a href="{$contact_link}" class="btn skn_blue_rivers dblArrow_right">問い合わせ</a>
            </div>
          </div>
        </div><!--end dormitory_co-->
      </div><!--end dormitory_inner-->
    </div><!--end dormitory_wrap-->
EOD;

   endwhile;
  }


  $ret_block = '';
  if(!empty($result)){
   $termname = get_term_by('slug', $area, 'school_cat');
   $ret_block = <<<EOM
   <div class="dormiory_block">
     <div class="dormiory_row1 dormiory_row box_row">
       <!--start prefecture_wrap-->
       <div class="prefecture_wrap">
         <div class="prefecture_inner flex">
           <div class="prefecture_co2 prefecture_co box_co">
             {$result}
           </div><!--end prefecture_co-->
         </div><!--end prefecture_inner-->
       </div><!--end prefecture_wrap-->
     </div><!--end dormiory_row-->
   </div><!--end dormiory_block-->
EOM;
  }


  if(!empty($tokubetukikaku_flg)){//特別企画のとき
   if(empty($wari_data)){
    $ret_block = "";
   }
  }

  return $ret_block;
 }
 add_shortcode('tokubetukikaku_list', 'tokubetukikaku_list_Func');


/**
 * 取得可能車種サイドバー
 */
 function side_getcars_Func(){
  $result = '';
  $cars_arr = array('普通AT', '普通MT', '普通二輪',
                     '大型二輪', '準中型', '中型',
                     '大型', '大型特殊', 'けん引',
                     '普通二種', '大型二種', 'フォークリフト');
  foreach ($cars_arr as $cars) {
   $result .= '<div><a href="">'.$cars.'</a></div>';
  }

  return $result;
 }
 add_shortcode('side_getcars', 'side_getcars_Func');


/**
 * その他備考欄
 */
 function sonotabikou_Func(){
  $result = '';
  $sonota_txt = '';
  $sonota_txt = get_post_meta(get_the_ID(),'school_',true);
  if(!empty($sonota_txt)){
   $result = $sonota_txt;
  }

  return $result;
 }
 add_shortcode('sonotabikou', 'sonotabikou_Func');


 /**
  * 設備下に出るテキスト
  * otherFacility
  */
  function otherFacility_Func(){
   $result = '';
   $otherFacility_txt = '';
   $otherFacility_txt = get_post_meta(get_the_ID(),'school_設備13',true);
   if(!empty($otherFacility_txt)){
    $result = '<p class="otherFacility">'.$otherFacility_txt.'</p>';
   }

   return $result;
  }
  add_shortcode('otherFacility', 'otherFacility_Func');
