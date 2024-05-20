<?php
/*
Template Name: お気に入り用
*/
?>
<?php get_header(); ?>
<!--page-->
<div id="wholeContents" class="wholeContents page-php" role="main">
  <div id="mainContents" class="mainContents">
    <div id="contentsWrapper" class="contentsWrapper maxWidth flex fWrap_wrap twoColumn">
      <!--main-->
        <div id="main" class="mainContent">
          <section id="dormitory_list" class="">
            <div class="secInner">
              <div class="pageTitleA">
                <h2 class="titleText flex">
                 <div class="imageBox">
                   <div class="image">
                     <div class="image_inner">
                       <img src="<?php echo get_template_directory_uri()?>/assets/icomoon/doubleCircle.svg">
                     </div><!--end image_inner-->
                   </div><!--end image-->
                 </div><!--end imageBox-->
                 <?php the_title(); ?>
                </h2>
              </div>
          <?php
          $ids_json = '{}';
          $ids_json = $_GET['favdata'];
          $ids_json = mb_convert_encoding($ids_json, 'UTF8', 'ASCII,JIS,UTF-8,EUC-JP,SJIS-WIN');/**utf化*/
          $ids_json = urldecode($ids_json);/**パーセント文字デコード*/
          $ids_json = str_replace('\\', '', $ids_json);/**円マーク消す*/
          $ids_json = json_decode($ids_json,true);/**配列に戻す化*/

          $ret_html = '';
          if(!empty($ids_json)){
            foreach ($ids_json as $myid) {
             $args2 = array(
             'post_type' => array('school'), /* 投稿タイプを指定 */
             'order' => 'DESC',
             'post_status' => 'publish',
             'p' => $myid,
             'posts_per_page' => -1
             );
             query_posts( $args2 );
             if (have_posts()){
              while (have_posts()){the_post();
               $mytitle = get_the_title();//タイトル

               $mylink = get_the_permalink();//リンク

               $minPriceNumberdwoTax = (int)get_post_meta(get_the_ID(),'school_AT最低料金',true);

               $at_min_price = number_format(floor($minPriceNumberdwoTax*1.08));//料金設定
               //静岡県セイブ自動車学校だけ例外処理
               if($mytitle == "静岡県セイブ自動車学校"){
                $at_min_price = number_format((floor($minPriceNumberdwoTax*1.08 / 10000 * 1000))*10);
               }

               $tpoint = get_post_meta(get_the_ID(),'school_TPOINT',true);//Tpoint
               if(!empty($tpoint)){/**Tpointあるよ*/}

               $hayawari_flg = get_post_meta(get_the_ID(),'school_割引1_適応',true);//早割り
               if($hayawari_flg == '●'){/**早割りあるよ*/}

               $gakuwari_flg = get_post_meta(get_the_ID(),'school_割引2_適応',true);//学割
               if($gakuwari_flg == '●'){/**学割あるよ*/}

               $Gwari_flg = get_post_meta(get_the_ID(),'school_割引3_適応',true);//G割
               if($Gwari_flg == '●'){/**G割あるよ*/}

               echo $mytitle."\n<br />";
              }
             }
             // クエリをリセット
             wp_reset_query();
            }//ループ終了
          }else{
          /**学校ないとき*/
          $ret_html = '<span class="notfound marginBottom3 block">該当の教習所は見つかりませんでした。</span>';
         }

          /**
           * txt読み込んで出す
           */
          $text_gwari = file_get_contents(locate_template('my_parts/text_files/discount_feature_gwari.txt'));//G割テキスト


?>
    <div id='top_area'>
      <div class="descText"><p><?php echo $text_top; ?></p></div>
    </div>
  </div>
</section>
<!--start hikaku_section-->
<section id="hikaku" class="">
  <div class="sec_inner">
    <a data-favreset class="btn skn_orange">お気に入りをリセット</a>
  </div><!--end sec_inner-->
</section><!--end hikaku_section-->
          <?php echo do_shortcode('[takusan_block]');?>
        </div>

        <?php echo do_shortcode('[sidebar]'); ?>
    </div><!--contentsWrapper-->

  </div><!--#mainContents-->
</div><!--#wholeContents-->
<?php
get_footer();
