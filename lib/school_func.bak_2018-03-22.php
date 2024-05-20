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
    mkdir($directory_path, 0777);
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
  chmod($filepath_utfed, 0777);//政井追加


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
        'tag_class'   => '',
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
        if ( $fh ) {
            $row_num = $th == 'row' ? 1 : 0;
            $table_id = $args['table_id'] ? ' id="' . esc_attr( $args['table_id'] ) . '"' : '';
            $table_class = $args['table_class'] ? ' class="' . esc_attr( $args['table_class'] ) . '"' : '';
            
            $outputAT = '<div class="scheduleTableWrapper flex fWrap_wrap">
            <div class="scheduleTableInner col2of2">
            <table' . $table_id . $table_class . '><tbody>' . "\n";
            $outputMT = '<h1>MT</h1><div class="scheduleTableWrapper flex fWrap_wrap">
            <div class="scheduleTableInner col2of2">
            <table' . $table_id . $table_class . '><tbody>' . "\n";



            while ( $row = Ps_fgetcsv_reg( $fh, $args['charset'] ) ) {

                 
                // if($row_num == 8){
                // $output .="<!--table-->";
                // }


                //セル処理
              if($row_num > 7){
                $lineAT = '<tr class="col1of7 row_' . $row_num . ' '. $row_class . '">' . "\n";
                $lineMT = '<tr class="col1of7 row_' . $row_num . ' '. $row_class . '">' . "\n";
                //実データ抽出
                }




                for ( $i = 0; $i < count( $row ); $i++ ) {

                    if($row_num > 7){



                      if($i >= 29 && !empty($row[$i])){

                        $bgColor =  $i;
                        } 


                      if( $i ==0){
                        //日付を分割
                        // $date_data[0] ⇒yyyy/mm/dd　$date_data[1]⇒yyyy $date_data[2]⇒mm $date_data[3]⇒dd
                        $date_data = array();
                        preg_match("@([0-9]{4,})/([0-9]{1,2})/([0-9]{1,2})@",$row[$i],$date_data);

              
                         $lineAT .= '<td class="bgcolor bgcolor_'. $bgColor .'"><p class="co_' . $i  .'">' . $date_data[3] . '</p>';
                         $lineMT .= '<td class="bgcolor bgcolor_'. $bgColor .'"><p class="co_' . $i  .'">' . $date_data[3] . '</p>';
                         

                         // $line .= '</div>';
                      }

                      elseif($i ==2 ){ //ATの卒業日
                          $lineAT .= '<p class="co_' . $i . '">' . $row[$i] . '</p>';
                      }

                      elseif($i ==3){//MTの卒業日
                          $lineMT .= '<p class="co_' . $i . '">' . $row[$i] . '</p>';
                      }
                    // elseif($i == 4){//flag
                    //   $lineAT .= '<p class="campaign">';
                    // }
                      elseif($i >= 4 && $i <= 28 && !empty($row[$i]) ){//flag
                          $lineAT .= '<span class="campaign co_' . $i . '">' . $row[$i] . '</span>';
                      }
                    // elseif($i == 10){//flag
                    //   $lineAT .= '</p><!--/.campaign-->';
                    // }

                     }


                     $flag="";
                    
                    if( $date_data[2] != $temp_date ){ 
                         $lineWrapperLower = '
                         </tbody><!--tbody-->
                         </table>
                         </div>

                         <div class="scheduleTableInnder col2of2">
                         <div class="title">'  . $date_data[2]  . '</div>
                         <table>
                         <tbody>
                         ';
                     }
                    $temp_date = $date_data[2];
                }
                if($row_num > 7){
                $lineAT .= '</td></tr>' ."\n";
                $lineMT .= '</td></tr>' ."\n";
              }
                //一時的
                // if($row_num == 8){
                //   $output .= "</tbody>\n";
                //   $output .= '</table>';
                //    $output .= "<table>\n";
                //    $output .= "<tbody>\n";
                // }
                //一時的
                $outputAT .=   $lineWrapperLower .$lineAT;
                $outputMT .=   $lineWrapperLower .$lineMT;
                $lineWrapperLower="";
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
if($row_num > 7){
            $outputAT .= '</tbody>
            </table>
            </div>
            </div>';
            $outputMT .= '</tbody>
            </table>
            </div>
            </div>';
          }

        }
    }
    return $outputAll . $outputAT . $outputMT;
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

