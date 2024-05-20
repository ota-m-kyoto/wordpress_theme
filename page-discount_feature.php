<?php
/*
Template Name: お得な割引特集用
*/
?>
<?php get_header(); ?>
<!--page-->
<div id="wholeContents" class="wholeContents page-php" role="main">
  <div id="mainContents" class="mainContents">
    <div id="contentsWrapper" class="contentsWrapper maxWidth flex fWrap_wrap twoColumn RefineList">
      <!--main-->
        <div id="main" class="mainContent">
          <section id="dormitory_list" class="">
            <div class="secInner">
              <div class="pageTitleA">
                <h2 class="titleText flex">
                 <div class="imageBox">
                   <div class="image">
                     <div class="image_inner">
                       <img src="<?php echo get_template_directory_uri()?>/assets/icomoon/doubleCircle.svg" alt="">
                     </div><!--end image_inner-->
                   </div><!--end image-->
                 </div><!--end imageBox-->
                 <?php the_title(); ?>
                </h2>
              </div>
          <?php
          // $getid = $_GET['id'];

          $hayawari = sql_waribiki_Func('早割');//●有無関係なくpostID返ってくる
          foreach ($hayawari as $value1) {
           $myhtml1 .= do_shortcode('[waribiki_list '.$value1.' "早割"]');
          }

          $gakuwari = sql_waribiki_Func('学割');//●有無関係なくpostID返ってくる
          foreach ($gakuwari as $value2) {
           $myhtml2 .= do_shortcode('[waribiki_list '.$value2.' "学割"]');
          }

          $gwari = sql_waribiki_Func('Ｇ割');//●有無関係なくpostID返ってくる
          foreach ($gwari as $value3) {
           $myhtml3 .= do_shortcode('[waribiki_list '.$value3.' "Ｇ割"]');
          }

          $notfound = '<span class="notfound marginBottom3 block">該当の教習所は見つかりませんでした。</span>';
          if(empty($myhtml1)){
            $hayawari = $notfound;
          }else{
            $hayawari = $myhtml1;
          }

          if(empty($myhtml2)){
            $gakuwari = $notfound;
          }else{
            $gakuwari = $myhtml2;
          }

          if(empty($myhtml3)){
            $gwari = $notfound;
          }else{
            $gwari = $myhtml3;
          }


          /**
           * txt読み込んで出す
           */
          $text_top = file_get_contents(locate_template('my_parts/text_files/discount_feature_top.html'));//TOPテキスト
          $text_hayawari = file_get_contents(locate_template('my_parts/text_files/discount_feature_hayawari.txt'));//早割テキスト
          $text_gakuwari = file_get_contents(locate_template('my_parts/text_files/discount_feature_gakuwari.txt'));//学割テキスト
          $text_gwari = file_get_contents(locate_template('my_parts/text_files/discount_feature_gwari.txt'));//G割テキスト


?>
<div id='top_area'>
  <div class="descText"><p><?php echo $text_top; ?></p></div>
</div>

<div id='hayawari_list'>
  <div class="secTitleA">
    <h3 class="titleText">早割</h3>
  </div>
  <div class="descText"><p><?php echo $text_hayawari; ?></p></div>
  <div class="dormitorytTable_head flex">
    <p class="dormitory_co2">教習所名、料⾦(税込)</p>
    <p class="dormitory_co3">お得情報</p>
  </div>
  <?php echo $hayawari; ?>
</div>

<div id='gakuwari_list'>
  <div class="secTitleA">
    <h3 class="titleText">学割</h3>
  </div>
  <div class="descText"><p><?php echo $text_gakuwari; ?></p></div>
  <div class="dormitorytTable_head flex">
    <p class="dormitory_co2">教習所名、料⾦(税込)</p>
    <p class="dormitory_co3">お得情報</p>
  </div>
  <?php echo $gakuwari; ?>
</div>

<div id='gwari_list'>
  <div class="secTitleA">
    <h3 class="titleText">G割</h3>
  </div>
  <div class="descText"><p><?php echo $text_gwari; ?></p></div>
  <div class="dormitorytTable_head flex">
    <p class="dormitory_co2">教習所名、料⾦(税込)</p>
    <p class="dormitory_co3">お得情報</p>
  </div>
  <?php echo $gwari; ?>
</div>
  </div><!--end secInner-->
</section><!--end dormitory_list_section-->
          <?php echo do_shortcode('[takusan_block]');
          ?>
        </div>

        <?php echo do_shortcode('[sidebar]'); ?>
    </div><!--contentsWrapper-->

  </div><!--#mainContents-->
</div><!--#wholeContents-->
<?php
get_footer();
