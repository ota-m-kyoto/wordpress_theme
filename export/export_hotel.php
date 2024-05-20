<?php
	require(ABSPATH."wp-config.php");
	error_reporting(E_ERROR | E_WARNING | E_PARSE);

	define("DEBUG","ON");
	define("LOG_FILE",dirname(__FILE__)."/export.log");
	define("BASE_URL",get_home_url()."/school/");
	date_default_timezone_set('Asia/Tokyo');

	/**
 * [start_process description]
 * @param  [type] $dir_name [description]
 * @return [type]           [description]
 *
 * $dir_nameは学校フォルダ名
 */
	function start_process($dir_path,$dir_name){
		$open_file = array();
		if( $dir_name != ""){
			$open_file[0] = $dir_path.$dir_name.'/data_sheet.xlsx';//ファイルパス
			// $open_file[1] = $dir_name.'/';//ファイルパス
			// $open_file[2] = $dir_name.'/';//ファイルパス
		}
		else{
			output_log("export_hotel\n");
			exit;
		}

		//ファイル分回す
		foreach ($open_file as $value) {
			// ファイルの存在チェック
			if (!file_exists($value)) {
				//exit("エラー：".$value. "が見つかりません。" . EOL);
				//スルー
			}else{
				// 連想配列でデータ受け取り
				$excel_arry = readXlsx($value);
				if($excel_arry === false){break;}

				// setlocale(LC_ALL, 'ja_JP.UTF-8');
				$file = $dir_path.$dir_name.'/export/ex_hotel.csv';
				//csv作成
				$fpcsv = fopen($file, 'w');
				$null_flg = 0;

				$result = array();
				foreach ($excel_arry as $key => $value) {
					foreach($value as $key2 => $value2) {
						$result[$key2][$key] = $value2;
					}
				}

				foreach($result as $key3 => $excel_data){
					// if($null_flg !== 0){break;}
					// if($key > 2){break;}//取るのは１行２行
					//
					// $judge = array_filter($excel_data);
					// if(empty($judge)){
					// 	$null_flg = 1;
					// 	break;
					// }
					$line = implode('$$$' , $excel_data);//区切る
					$line = str_replace(',', '', $line);//置換
					$line = str_replace(PHP_EOL, '<br/>', $line);//置換
					$line = str_replace('$$$', ',', $line);//置換

					fwrite($fpcsv, $line . "\n");
				}
				fclose($fpcsv);
				if($null_flg === 0){/////////////////1行目nullならスルー　　0がOK状態
					$data = file_get_contents($file);
					$data = mb_convert_encoding($data, 'sjis-win','UTF-8');
					// $data = mb_convert_encoding($data, 'UTF-8', 'sjis-win');
					$temp = $dir_path.$dir_name.'/hotel.csv';
					$fp = fopen($temp, 'w');
					fwrite($fp, $data);
					fclose($fp);
					system('chmod 0777 '.$temp);

					output_log("".$value." : hotel.csvファイルの出力を完了\n");
					//exit(0);
				}
			}
		}
	}

	function output_log($msg){
		file_put_contents(LOG_FILE,$msg,FILE_APPEND);

	}

// ファイル名渡したら配列返すラッパー関数
function readXlsx($readFile){
	// ライブラリファイルの読み込み （パス指定し直す）
	require_once locate_template('import/PHPExcel/IOFactory.php');

	// ファイルの存在チェック
	if (!file_exists($readFile)) {
		exit($readFile. "が見つかりません。" . EOL);
	}

	try{
		$xls = PHPExcel_IOFactory::createReader("Excel2007");
		// $targetSheetName = "csvdata";
		// $xls->setLoadSheetsOnly($targetSheetName);

		// xlsxをPHPExcelに食わせる

		$objPExcel = $xls->load($readFile);
		$objPExcel = $objPExcel->setActiveSheetIndexByName("宿泊施設");
		return $objPExcel->toArray(null,true,true,true);// 配列形式で返す
	}catch(Exception $e){
		return false;
	}

	// return $objPExcel->getActiveSheet()->toArray(null,true,true,true);


	// $objPExcel->getActiveSheet()->toArray(null,true,true,true);
	// $writer = PHPExcel_IOFactory::createWriter($objPExcel, 'csv');
	// $writer->save('csv_beta.csv');
}

?>
