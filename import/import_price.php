<?php
	require(ABSPATH."wp-config.php");
	error_reporting(E_ERROR | E_WARNING | E_PARSE);

	define("DEBUG","ON");
	define("LOG_FILE",dirname(__FILE__)."/import_price.log");
	define("BASE_URL",get_home_url()."/school/");
	date_default_timezone_set('Asia/Tokyo');

	global $scheduleinfo_metakey;
	$scheduleinfo_metakey = array(
		 0 => "school_AT最短",
		 1 => "school_MT最短",
		 2 => "school_高速教習",
		 3 => "school_設備1",
		 4 => "school_設備2",
		 5 => "school_設備3",
		 6 => "school_設備4",
		 7 => "school_設備5",
		 8 => "school_設備6",
		 9 => "school_設備7",
		10 => "school_設備8",
		11 => "school_設備9",
		12 => "school_設備10",
		13 => "school_設備11",
		14 => "school_設備12",
		15 => "school_設備13",
		16 => "school_設備14",
		17 => "school_設備15",
		18 => "school_設備16",
		19 => "school_設備17",
		20 => "school_設備18",
		21 => "school_設備19",
		22 => "school_設備20",
		23 => "school_設備21",
		24 => "school_設備22",
		25 => "school_設備23",
		26 => "school_設備24",
		27 => "school_設備25",
		28 => "school_設備26",
		29 => "school_設備27",
		30 => "school_設備28",
		31 => "school_設備29",
		32 => "school_設備30",
		33 => "school_プラン説明",
		34 => "school_対応免許1",
		35 => "school_対応免許2",
		36 => "school_対応免許3",
		37 => "school_対応免許4",
		38 => "school_対応免許5",
		39 => "school_対応免許6",
		40 => "school_対応免許7",
		41 => "school_対応免許8",
		42 => "school_対応免許9",
		43 => "school_対応免許10",
		44 => "school_対応免許11",
		45 => "school_対応免許12",
		46 => "school_対応免許13",
		47 => "school_対応免許14",
		48 => "school_対応免許15",
		49 => "school_対応免許16",
		50 => "school_対応免許17",
		51 => "school_対応免許18",
		52 => "school_対応免許19",
		53 => "school_対応免許20",
		54 => "school_対応免許21",
		55 => "school_対応免許22",
		56 => "school_対応免許23",
		57 => "school_対応免許24",
		58 => "school_対応免許25",
		59 => "school_割引1_適応",
		60 => "school_割引1_企画名",
		61 => "school_割引1_宿泊プラン(車種)",
		62 => "school_割引1_税抜金額",
		63 => "school_割引1_MT時UP金額",
		64 => "school_割引1_案内内容",
		65 => "school_割引2_適応",
		66 => "school_割引2_企画名",
		67 => "school_割引2_宿泊プラン(車種)",
		68 => "school_割引2_税抜金額",
		69 => "school_割引2_MT時UP金額",
		70 => "school_割引2_案内内容",
		71 => "school_割引3_適応",
		72 => "school_割引3_企画名",
		73 => "school_割引3_宿泊プラン(車種)",
		74 => "school_割引3_税抜金額",
		75 => "school_割引3_MT時UP金額",
		76 => "school_割引3_案内内容",
		77 => "school_割引4_適応",
		78 => "school_割引4_企画名",
		79 => "school_割引4_宿泊プラン(車種)",
		80 => "school_割引4_税抜金額",
		81 => "school_割引4_MT時UP金額",
		82 => "school_割引4_案内内容",
		83 => "school_割引5_適応",
		84 => "school_割引5_企画名",
		85 => "school_割引5_宿泊プラン(車種)",
		86 => "school_割引5_税抜金額",
		87 => "school_割引5_MT時UP金額",
		88 => "school_割引5_案内内容",
		89 => "school_割引6_適応",
		90 => "school_割引6_企画名",
		91 => "school_割引6_宿泊プラン(車種)",
		92 => "school_割引6_税抜金額",
		93 => "school_割引6_MT時UP金額",
		94 => "school_割引6_案内内容",
		95 => "school_割引7_適応",
		96 => "school_割引7_企画名",
		97 => "school_割引7_宿泊プラン(車種)",
		98 => "school_割引7_税抜金額",
		99 => "school_割引7_MT時UP金額",
		100 => "school_割引7_案内内容",
		101 => "school_割引8_適応",
		102 => "school_割引8_企画名",
		103 => "school_割引8_宿泊プラン(車種)",
		104 => "school_割引8_税抜金額",
		105 => "school_割引8_MT時UP金額",
		106 => "school_割引8_案内内容",
		107 => "school_割引9_適応",
		108 => "school_割引9_企画名",
		109 => "school_割引9_宿泊プラン(車種)",
		110 => "school_割引9_税抜金額",
		111 => "school_割引9_MT時UP金額",
		112 => "school_割引9_案内内容",
		113 => "school_割引10_適応",
		114 => "school_割引10_企画名",
		115 => "school_割引10_宿泊プラン(車種)",
		116 => "school_割引10_税抜金額",
		117 => "school_割引10_MT時UP金額",
		118 => "school_割引10_案内内容",
		119 => "school_割引11_適応",
		120 => "school_割引11_企画名",
		121 => "school_割引11_宿泊プラン(車種)",
		122 => "school_割引11_税抜金額",
		123 => "school_割引11_MT時UP金額",
		124 => "school_割引11_案内内容",
		125 => "school_割引12_適応",
		126 => "school_割引12_企画名",
		127 => "school_割引12_宿泊プラン(車種)",
		128 => "school_割引12_税抜金額",
		129 => "school_割引12_MT時UP金額",
		130 => "school_割引12_案内内容",
		131 => "school_割引13_適応",
		132 => "school_割引13_企画名",
		133 => "school_割引13_宿泊プラン(車種)",
		134 => "school_割引13_税抜金額",
		135 => "school_割引13_MT時UP金額",
		136 => "school_割引13_案内内容",
		137 => "school_割引14_適応",
		138 => "school_割引14_企画名",
		139 => "school_割引14_宿泊プラン(車種)",
		140 => "school_割引14_税抜金額",
		141 => "school_割引14_MT時UP金額",
		142 => "school_割引14_案内内容",
		143 => "school_割引15_適応",
		144 => "school_割引15_企画名",
		145 => "school_割引15_宿泊プラン(車種)",
		146 => "school_割引15_税抜金額",
		147 => "school_割引15_MT時UP金額",
		148 => "school_割引15_案内内容",
		149 => "school_割引16_適応",
		150 => "school_割引16_企画名",
		151 => "school_割引16_宿泊プラン(車種)",
		152 => "school_割引16_税抜金額",
		153 => "school_割引16_MT時UP金額",
		154 => "school_割引16_案内内容",
		155 => "school_割引17_適応",
		156 => "school_割引17_企画名",
		157 => "school_割引17_宿泊プラン(車種)",
		158 => "school_割引17_税抜金額",
		159 => "school_割引17_MT時UP金額",
		160 => "school_割引17_案内内容",
		161 => "school_割引18_適応",
		162 => "school_割引18_企画名",
		163 => "school_割引18_宿泊プラン(車種)",
		164 => "school_割引18_税抜金額",
		165 => "school_割引18_MT時UP金額",
		166 => "school_割引18_案内内容",
		167 => "school_割引19_適応",
		168 => "school_割引19_企画名",
		169 => "school_割引19_宿泊プラン(車種)",
		170 => "school_割引19_税抜金額",
		171 => "school_割引19_MT時UP金額",
		172 => "school_割引19_案内内容",
		173 => "school_割引20_適応",
		174 => "school_割引20_企画名",
		175 => "school_割引20_宿泊プラン(車種)",
		176 => "school_割引20_税抜金額",
		177 => "school_割引20_MT時UP金額",
		178 => "school_割引20_案内内容",
		179 => "school_割引21_適応",
		180 => "school_割引21_企画名",
		181 => "school_割引21_宿泊プラン(車種)",
		182 => "school_割引21_税抜金額",
		183 => "school_割引21_MT時UP金額",
		184 => "school_割引21_案内内容",
		185 => "school_割引22_適応",
		186 => "school_割引22_企画名",
		187 => "school_割引22_宿泊プラン(車種)",
		188 => "school_割引22_税抜金額",
		189 => "school_割引22_MT時UP金額",
		190 => "school_割引22_案内内容",
		191 => "school_割引23_適応",
		192 => "school_割引23_企画名",
		193 => "school_割引23_宿泊プラン(車種)",
		194 => "school_割引23_税抜金額",
		195 => "school_割引23_MT時UP金額",
		196 => "school_割引23_案内内容",
		197 => "school_割引24_適応",
		198 => "school_割引24_企画名",
		199 => "school_割引24_宿泊プラン(車種)",
		200 => "school_割引24_税抜金額",
		201 => "school_割引24_MT時UP金額",
		202 => "school_割引24_案内内容",
		203 => "school_割引25_適応",
		204 => "school_割引25_企画名",
		205 => "school_割引25_宿泊プラン(車種)",
		206 => "school_割引25_税抜金額",
		207 => "school_割引25_MT時UP金額",
		208 => "school_割引25_案内内容",
		209 => "school_割引26_適応",
		210 => "school_割引26_企画名",
		211 => "school_割引26_宿泊プラン(車種)",
		212 => "school_割引26_税抜金額",
		213 => "school_割引26_MT時UP金額",
		214 => "school_割引26_案内内容",
		215 => "school_割引27_適応",
		216 => "school_割引27_企画名",
		217 => "school_割引27_宿泊プラン(車種)",
		218 => "school_割引27_税抜金額",
		219 => "school_割引27_MT時UP金額",
		220 => "school_割引27_案内内容",
		221 => "school_割引28_適応",
		222 => "school_割引28_企画名",
		223 => "school_割引28_宿泊プラン(車種)",
		224 => "school_割引28_税抜金額",
		225 => "school_割引28_MT時UP金額",
		226 => "school_割引28_案内内容",
		227 => "school_割引29_適応",
		228 => "school_割引29_企画名",
		229 => "school_割引29_宿泊プラン(車種)",
		230 => "school_割引29_税抜金額",
		231 => "school_割引29_MT時UP金額",
		232 => "school_割引29_案内内容",
		233 => "school_その他の割引",
		234 => "school_割引予備1",
		235 => "school_割引予備2",
		236 => "school_割引予備3",
		237 => "school_割引予備4",
		238 => "school_割引予備5",
		239 => "school_保証ブロック1_タイトル",
		240 => "school_保証ブロック1_技能教習",
		241 => "school_保証ブロック1_修了検定",
		242 => "school_保証ブロック1_卒業検定",
		243 => "school_保証ブロック1_宿泊",
		244 => "school_保証ブロック2_タイトル",
		245 => "school_保証ブロック2_技能教習",
		246 => "school_保証ブロック2_修了検定",
		247 => "school_保証ブロック2_卒業検定",
		248 => "school_保証ブロック2_宿泊",
		249 => "school_保証ブロック追加料金_タイトル",
		250 => "school_保証ブロック追加料金_技能教習",
		251 => "school_保証ブロック追加料金_修了検定",
		252 => "school_保証ブロック追加料金_卒業検定",
		253 => "school_保証ブロック追加料金_宿泊",
		254 => "school_保証ブロック備考",
		255 => "school_保証ブロック別途料金",
		256 => "school_保証ブロック二輪同時",
		257 => "school_TPOINT",
		258 => "school_AT最低料金",
		259 => "school_MT料金UP",
		260 => "school_スケジュール補足",
		261 => "school_予備5",
		262 => "school_予備6",
		263 => "school_予備7",
		264 => "school_予備8",
		265 => "school_予備9",
		266 => "school_予備10",
		267 => "school_予備11",
		268 => "school_予備12",
		269 => "school_予備13",
		270 => "school_予備14",
		271 => "school_予備15",
	);

 global $error_reason;
	$error_reason = array(
		"00100"=>"",
		"00001"=>"",
		"00002"=>"",
		"00020"=>"",
		"00030"=>"",
		"00040"=>"",
		"00041"=>""
	);


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
			output_log("import.php [csv file]\n");
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

				setlocale(LC_ALL, 'ja_JP.UTF-8');
				$file = $dir_path.$dir_name.'/csv_beta.csv';
				//csv作成
				$fpcsv = fopen($file, 'w');
				$null_flg = 0;
				foreach($excel_arry as $key => $excel_data){
					if($null_flg !== 0){break;}
					if($key > 2){break;}//取るのは１行２行

					$judge = array_filter($excel_data);
					if(empty($judge)){
						$null_flg = 1;
						break;
					}

					$line = implode('$$$' , $excel_data);//区切る
					$line = str_replace(',', '', $line);//置換
					$line = str_replace(PHP_EOL, '<br/>', $line);//置換
					$line = str_replace('$$$', ',', $line);//置換

					fwrite($fpcsv, $line . "\n");
				}
				fclose($fpcsv);
				if($null_flg === 0){/////////////////1行目nullならスルー　　0がOK状態
					$data = file_get_contents($file);
					//$data = mb_convert_encoding($data, 'UTF-8', 'sjis-win');
					$temp = $dir_path.$dir_name.'/tmp/'.$dir_name.'_re.csv';
					$fp = fopen($temp, 'w');
					fwrite($fp, $data);
					fclose($fp);
					system('chmod 0777 '.$temp);

					$fd = fopen($temp, "r" );
					// $fd = fopen($value,"r");
					if( !$fd ){
						output_log("csvファイル".$value."を開くことができませんでした\n");
						exit("エラー：".$value. "を開くことができませんでした" . EOL);
					}

					$link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);


					if( !$link ){
						output_log( mysqli_error($link) );
						fclose($fd);
						exit("mysqlエラーです。" . EOL);
					}
					mysqli_query($link,"SET NAMES BINARY");
					/*
					$delsql = "
					DELETE FROM `wp_posts` WHERE `post_type` = 'keirin_schedule'
					";
					mysqli_query($link,$delsql);
					*/
					// $title = pathinfo($open_file,PATHINFO_FILENAME);
					$first = 1;
					while (($data = fgetcsv($fd, 20000, ",")) !== FALSE){
						if( $first ){
							$first = 0;
							continue;
						}
						$post_id = regOpenField($link,$data,$dir_name);
					}

					output_log("csvファイル".$value."の登録を完了\n");
					mysqli_close($link);
					fclose($fd);
					//exit(0);
				}
			}
		}
	}

/*
 *
 *
 *
 */
function regOpenField($link,$data,$dir_name){
	global $scheduleinfo_metakey;

	$title = $dir_name;

/*
	if( ($post_id = checkExistSchedule($link,$title)) ){
		update_post($link,$post_id,$title);
		$delsql = "
			DELETE FROM `wp_postmeta` WHERE `post_id` = $post_id
		";
		if( !mysqli_query($link,$delsql) ){
			output_log("エラーにより中断 del\n");
			exit;
		}
	}
	else{
*/
		$post_id = insert_post_dummy($link,$title);//該当投稿(学校)id取得

		if( !$post_id ){
			output_log("regOpenField():エラーにより中断 ins\n");
			exit("エラーにより中断。" . EOL);
			exit;
		}
//	}

	foreach($data as $key=>$value){
		if( $scheduleinfo_metakey[$key] ){

////////////////////////////////////////末尾空白消す
				// $pattern="^(\s|　　)+$";  //正規表現のパターン
				$data[$key] = rtrim($data[$key], '　');

				// $kuhaku_flg = 0;
				// if(mb_ereg_match($pattern,mb_substr($data[$key], -1))){
				// 	$kuhaku_flg = 1;
				// }
				// while ($kuhaku_flg > 0) {
				// $data[$key] = preg_replace('/$pattern/u', '', $data[$key]);//全角空白2つきたら末尾まで消す
					// $data[$key] = preg_replace('/[ 　]+$/u', '', $data[$key]);//末尾空白消す
					// if(mb_ereg_match($pattern,mb_substr($data[$key], -1))){
					// 	$kuhaku_flg = 1;
					// }
					// else{
					// 	$kuhaku_flg = 0;
					// }
				// }
///////////////////////////////////////

			// $inssql = "
		 // 	DELETE FROM `wp_postmeta` WHERE `post_id` = ".$post_id." AND `meta_key` = '".$scheduleinfo_metakey[$key]."';
			// ";
			$inssql = "
			UPDATE `wp_postmeta` SET `meta_value` = '".$data[$key]."' WHERE `post_id` = ".$post_id." AND `meta_key` = '".$scheduleinfo_metakey[$key]."';
			";
			if( !mysqli_query($link,$inssql) ){
				return false;
			}
			// $inssql = "
			// 	INSERT INTO `wp_postmeta` (`post_id`, `meta_key`, `meta_value`) VALUES(
			// 		".$post_id.",
			// 		'".$scheduleinfo_metakey[$key]."',
			// 		'".$data[$key]."'
			// 	);
			// ";
			$inssql = "
			INSERT INTO `wp_postmeta` (`post_id`, `meta_key`, `meta_value`)
			SELECT * FROM (SELECT ".$post_id.", '".$scheduleinfo_metakey[$key]."', '".$data[$key]."') AS TMP
			WHERE NOT EXISTS (SELECT * FROM `wp_postmeta` WHERE `post_id` = ".$post_id." AND `meta_key` = '".$scheduleinfo_metakey[$key]."');
			";
			if( !mysqli_query($link,$inssql) ){
				return false;
			}
		}
	}
	return $post_id;
}


function checkExistSchedule($link,$title){
	$sql = "
		SELECT
			ID
		FROM
			wp_posts
		WHERE
			`post_title` = '".$title."'
	";
	$result = mysqli_query($link,$sql);
	if( mysqli_num_rows($result) ){
		$row = mysqli_fetch_assoc($result);
		$post_id = $row["ID"];
	}
	else{
		$post_id = "";
	}
	mysqli_free_result($result);
	return $post_id;
}

function insert_post_dummy($link,$title){

	$post = get_page_by_path($title, OBJECT, 'school');

	if($post->ID != NULL){
		$return = $post->ID;
	}
	else{
		print mysqli_error($link);
		$return = "";
	}
	return $return;
}

function update_post($link,$post_id,$title){
	$updsql = "
		UPDATE wp_posts SET
			`post_name` = '".$title."'
			`post_date` = NOW(),
			`post_date_gmt` = UTC_TIMESTAMP()
		WHERE
			ID = $post_id
	";
	mysqli_query($link,$updsql);
}


function updateParmaLink($link,$post_id){
	$updsql  = "
		UPDATE wp_posts SET post_name = '".$post_id."'
		WHERE ID = $post_id
	";
	mysqli_query($link,$updsql);
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

	$xls = PHPExcel_IOFactory::createReader("Excel2007");
	// $targetSheetName = "csvdata";
	// $xls->setLoadSheetsOnly($targetSheetName);

	// xlsxをPHPExcelに食わせる

	$objPExcel = $xls->load($readFile);
	$objPExcel = $objPExcel->setActiveSheetIndexByName("csvdata");
	return $objPExcel->toArray(null,true,true,true);// 配列形式で返す

	// return $objPExcel->getActiveSheet()->toArray(null,true,true,true);


	// $objPExcel->getActiveSheet()->toArray(null,true,true,true);
	// $writer = PHPExcel_IOFactory::createWriter($objPExcel, 'csv');
	// $writer->save('csv_beta.csv');
}

?>
