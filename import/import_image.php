#!/use/bin/php
<?php
	require("/var/www/html/wp-config.php");
	require("/var/www/html/wp-load.php");
	require_once( ABSPATH . 'wp-admin/includes/image.php' );
	
	error_reporting(E_ERROR | E_WARNING | E_PARSE);

	define("DEBUG","ON");
	define("LOG_FILE","/var/www/import/import_image.log");
	define("DATA_DIR","/var/www/data/news/");
	define("HTTP_USER","apache");
//	define("HTTP_USER","nginx");
	// 画像の置き場は、wpのABSPATHを使う事

	$error_reason = array(
		"00100"=>"",
		"00001"=>"",
		"00002"=>"",
		"00020"=>"",
		"00030"=>"",
		"00040"=>"",
		"00041"=>""
	);

	if( $argv[1]!="" ){
		$open_file =$argv[1];
	}
	else{
		print "import.php [csv file]\n";
		exit;
	}
	$title = pathinfo($open_file,PATHINFO_FILENAME);


	$fd = fopen($open_file,"r");
	if( !$fd ){
		output_log("IMAGE:画像ファイル".$open_file."を開くことができませんでした\n");
		exit;
	}
	fclose($fd);

	$img_file_path =ABSPATH."wp-content/uploads/".date("Y")."/".date("m")."/";
	@mkdir($img_file_path,0755,true);
	chown($img_file_path,HTTP_USER);
	copy($open_file,$img_file_path.basename($open_file));
	chown($img_file_path.basename($open_file),HTTP_USER);
	chgrp($img_file_path.basename($open_file),HTTP_USER);
	$title = basename($open_file);
	$guid_url = (substr($base_url,-1,1)!="/" ? $base_url."/" : $base_url )."wp-content/uploads/".date("Y")."/".date("m")."/".basename($open_file);
	$meta_uploadfname = date("Y")."/".date("m")."/".basename($open_file);
	$attachment = array(
		'post_mime_type' => 'image/jpeg', //1
		'post_title' => sanitize_file_name(basename($open_file)), //2
		'post_content' => '', //3
		'post_status' => 'inherit' //4
	);	
	$attach_id = wp_insert_attachment($attachment,$meta_uploadfname,0);
	$fullsizepath = get_attached_file( $attach_id );
	$attach_data = wp_generate_attachment_metadata( $attach_id, $fullsizepath );
	wp_update_attachment_metadata( $attach_id, $attach_data );
	exit(0);

/*
 *
 *
 *
 */


function output_log($msg){
	file_put_contents(LOG_FILE,$msg,FILE_APPEND);

}

?>