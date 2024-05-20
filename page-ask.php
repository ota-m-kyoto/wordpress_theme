

<?php

// リダイレクト先のURLへ転送する
$url = 'https://www.happymenkyo.com/contact/';
header('Location: ' . $url, true, 301);

// すべての出力を終了
exit;