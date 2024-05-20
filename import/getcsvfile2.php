#!/usr/bin/php
<?php
	error_reporting(E_ERROR | E_WARNING | E_PARSE);
	define("DEBUG","ON");

	define("HOME_DIR","/var/www/import/");
	define("LOG_FILE","/var/www/import/import.log");
	define("BASE_DIR","/var/www/data/");
	
	$filelist1 = scandir(BASE_DIR."race");
	if( is_array($filelist1) ){
		foreach($filelist1 as $filename){
			if(substr($filename,0,2)!="SR"){
				continue;
			}
			$import = "php ".HOME_DIR."import_keirinrace.php ".BASE_DIR."race/".$filename;
//			output_log("RACE: import file ".$filename);
//			print $import."\n";
			system($import);
			unlink(BASE_DIR."race/".$filename);
		}
	}
	$filelist2 = scandir(BASE_DIR."news");
	if( is_array($filelist2) ){
		foreach($filelist2 as $filename){
			if(substr($filename,0,2)=="SN"){
				$import = "php ".HOME_DIR."import_news.php ".BASE_DIR."news/".$filename;
//				output_log("NEW: import file ".$filename);
				system($import);
				unlink(BASE_DIR."news/".$filename);
			}
			if( substr($filename,-1,3)=="jpg"){
				$import = "php ".HOME_DIR."import_image.php ".BASE_DIR."news/".$filename;
				system($import);
				unlink(BASE_DIR."news/".$filename);
			}
		}
	}

	$filelist3 = scandir(BASE_DIR."result");
	if( is_array($filelist3) ){
		foreach($filelist3 as $filename){
			if(substr($filename,0,1)=="S"){
				$import = "php ".HOME_DIR."import_raceresult.php ".BASE_DIR."result/".$filename;
				system($import);
//				print $import."\n";
				unlink(BASE_DIR."result/".$filename);
			}
		}
	}



function output_log($msg){
	file_put_contents(LOG_FILE,$msg,FILE_APPEND);

}

