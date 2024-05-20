<?php 

// ページネーション
// ============================
// ページネーション処理
// ============================
// function get_posts_list($post_type, $orderby, $ter) {

//     global $wpdb;

//     //$sql  = 'SELECT * FROM wp_posts WHERE post_type = "'. $post_type. '" AND post_status = "publish" ORDER BY '. $orderby .' DESC';
//     if ($ter == 1) {
//       $sql  = 'SELECT * FROM wp_posts WHERE post_type = "'. $post_type. '" AND post_status = "publish" ORDER BY post_date DESC';
//     }elseif($orderby != "post_date"){
//      $sql  = 'SELECT *
// FROM wp_posts
// WHERE id IN(SELECT id
// FROM wp_posts
// WHERE post_type = "'. $post_type. '" AND post_status =  "publish"
// AND id IN(
// SELECT object_id
// FROM wp_term_relationships
// WHERE term_taxonomy_id = (
// SELECT term_taxonomy_id
// FROM wp_term_taxonomy AS tt
// INNER  JOIN wp_terms AS tm ON tt.term_id = tm.term_id
// WHERE tm.slug =  "'.$ter.'" )
// )) AND id IN(SELECT id
// FROM wp_posts
// WHERE post_type = "'. $post_type. '" AND post_status =  "publish"
// AND id IN(
// SELECT object_id
// FROM wp_term_relationships
// WHERE term_taxonomy_id = (
// SELECT term_taxonomy_id
// FROM wp_term_taxonomy AS tt
// INNER  JOIN wp_terms AS tm ON tt.term_id = tm.term_id
// WHERE tm.slug =  "'.$orderby.'" )
// ))
// ORDER  BY post_date DESC ';
//     }else{
//       $sql  = 'SELECT *
//                FROM wp_posts
//                WHERE post_type = "'. $post_type. '" AND post_status =  "publish"
//                      AND id IN(
//                          SELECT object_id
//                          FROM wp_term_relationships
//                          WHERE term_taxonomy_id = (
//                              SELECT term_taxonomy_id
//                              FROM wp_term_taxonomy AS tt
//                              INNER  JOIN wp_terms AS tm ON tt.term_id = tm.term_id
//                              WHERE tm.slug =  "'.$ter.'"  ))
//                     ORDER  BY post_date DESC ';
//     }

//     $sql .= '';
//     $sql .= '';

//     $result = $wpdb->get_results($sql);

//     $flg = 0;
//     foreach ($result as $data) {
//         $news_data_array[$flg]['post_title'] = $data->post_title;
//         $news_data_array[$flg]['ID'] = $data->ID;

//         // 日付処理
//         $nen = substr($data->post_date, 0, 4);
//         $tsuki = substr($data->post_date, 5, 2);
//         $tsuki = intval($tsuki);
//         $hinichi = substr($data->post_date, 8, 2);
//         $hinichi = intval($hinichi);
//         //$news_data_array[$flg]['post_date'] = $nen. '年'. $tsuki. '月'. $hinichi. '日';
//         // スラッシュ化
//         $news_data_array[$flg]['post_date'] = $nen. '/'. $tsuki. '/'. $hinichi;

//         // 更新日時
//         $news_data_array[$flg]['post_modified'] = get_hachiketa_hiduke($data->post_modified);

//         $news_data_array[$flg]['post_content'] = $data->post_content;

//         $flg++;
//     }

//     return $news_data_array;

// }

// =====================================
// ページネーションhtmlの取得
// =====================================
// function get_posts_pagenation($sou_page, $gen_page, $sento, $saikoubi, $page_option) {

//     $page_html  = '<div class="pagination textCenterCm">';
//     $page_html .= '    <div class="wp-pagenavi">';


//     // 7ページ以下なら
//     if ($sou_page <= 7) {
//         for ($i = 1; $i <= $sou_page; $i++) {
//             if ($i == $gen_page) {
//                 $page_html .= '        <span class="current">'. $i. '</span>';
//             } else {
//                 $page_html .= '        <a class="page larger" title="Page '. $i. '" href="'. home_url(). '/'. $page_option. 'page='. $i. '">'. $i. '</a>';
//             }
//         }


//     // 7ページ以上なら
//     } else {

//         // gen_pageが１，２，３の場合
//         if ($gen_page <= 3) {
//             for ($i = 1; $i <= 5; $i++) {
//                 if ($i == $gen_page) {
//                     $page_html .= '        <span class="current">'. $i. '</span>';
//                 } else {
//                     $page_html .= '        <a class="page larger" title="Page '. $i. '" href="'. home_url(). '/'. $page_option. 'page='. $i. '">'. $i. '</a>';
//                 }
//             }

//             // 6つ目
//             $page_html .= '        <span class="tenten">…</span>';

//             // 7つ目
//             $page_html .= '        <a class="nextpostslink" rel="next" href="'. home_url(). '/'. $page_option. 'page='. $sou_page. '">'. $saikoubi. '</a>';


//         // 現在のページが最後のページから１番目、２番目、３番目なら
//         } else if (($gen_page == $sou_page) || ($gen_page == $sou_page - 1) || ($gen_page == $sou_page - 2)) {

//             // 1つ目
//             $page_html .= '        <a class="nextpostslink" rel="next" href="'. home_url(). '/'. $page_option. 'page=1">'. $sento. '</a>';

//             // 2つ目
//             $page_html .= '        <span class="tenten">…</span>';

//             $flg = $sou_page - 4;
//             for ($i = $flg; $i <= $sou_page; $i++) {
//                 if ($i == $gen_page) {
//                     $page_html .= '        <span class="current">'. $i. '</span>';
//                 } else {
//                     $page_html .= '        <a class="page larger" title="Page '. $i. '" href="'. home_url(). '/'. $page_option. 'page='. $i. '">'. $i. '</a>';
//                 }
//             }


//         // 現在のページが１でもなく、最後でもない、中ページの場合
//         } else {

//             // 1つ目
//             $page_html .= '        <a class="nextpostslink" rel="next" href="'. home_url(). '/'. $page_option. 'page=1">'. $sento. '</a>';

//             // 2つ目
//             $page_html .= '        <span class="tenten">…</span>';

//             // ３ループさせる
//             for ($i = 1; $i <= 3; $i++) {

//                 // gen_pageは真ん中になるので、一旦gen_pageから-2をする
//                 $text_flg = $gen_page - 2;
//                 $a_text = $text_flg + $i;
//                 if ($a_text == $gen_page) {
//                     $page_html .= '        <span class="current">'. $a_text. '</span>';
//                 } else {
//                     $page_html .= '        <a class="page larger" title="Page '. $a_text. '" href="'. home_url(). '/'. $page_option. 'page='. $a_text. '">'. $a_text. '</a>';
//                 }

//             }

//             // 6つ目
//             $page_html .= '        <span class="tenten">…</span>';

//             // 7つ目
//             $page_html .= '        <a class="nextpostslink" rel="next" href="'. home_url(). '/'. $page_option. 'page='. $sou_page. '">'. $saikoubi. '</a>';

//         }

//     }


//     $page_html .= '    </div>';
//     $page_html .= '</div>';

//     return $page_html;

// }

// function get_hachiketa_hiduke($data) {

//         $nen = substr($data, 0, 4);
//         $tsuki = substr($data, 5, 2);
//         $tsuki = intval($tsuki);
//         $hinichi = substr($data, 8, 2);
//         $hinichi = intval($hinichi);
//         //$retval = $nen. '年'. $tsuki. '月'. $hinichi. '日';
//         // スラッシュ化
//         $retval = $nen. '/'. $tsuki. '/'. $hinichi;

//         return $retval;

// }
/////////////////////////////////////////////////////////
