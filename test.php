<?php 

  $filepath = dirname(__FILE__).'/school/kanonji/spot.csv';
  $filepath_utfed = dirname(__FILE__).'/school/kanonji/spot_utfed.csv';
  $fileContent = file_get_contents($filepath);
  $fileContent = mb_convert_encoding($fileContent, 'UTF-8', 'sjis-win');
  //file_put_contents($filepath_utfed, $fileContent);
// fopenでファイルを開く（'w'は上書きモードで開く）
$fp = fopen($filepath_utfed, 'w');

// fwriteで文字列を書き込む
fwrite($fp,  $fileContent);

// ファイルを閉じる
fclose($fp);
 chmod($filepath_utfed, 0666);

; ?>