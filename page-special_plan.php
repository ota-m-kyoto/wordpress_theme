<?php
/*
Template Name: ハッピーだけの特別企画用
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
                 <?php
                 $myid = $_GET['id'];
                 $text_schoolcat = '';
                 $mytitle = '';
                 switch ($myid){
                  case 'sp1':
                  $text_schoolcat = file_get_contents(locate_template('my_parts/text_files/special_planid_sp1.txt'));
                  $mytitle = '限定割の教習所一覧';
                  echo $mytitle;
                  break;
                  case 'sp2':
                  $text_schoolcat = file_get_contents(locate_template('my_parts/text_files/special_planid_sp2.txt'));
                  $mytitle = 'ツイン特別の教習所一覧';
                  echo $mytitle;
                  break;
                  case 'sp3':
                  $text_schoolcat = file_get_contents(locate_template('my_parts/text_files/special_planid_sp3.txt'));
                  $mytitle = '二輪同時特別の教習所一覧';
                  echo $mytitle;
                  break;
                  case 'sp4':
                  $text_schoolcat = file_get_contents(locate_template('my_parts/text_files/special_planid_sp4.txt'));
                  $mytitle = '年末一時帰宅の教習所一覧';
                  echo $mytitle;
                  break;
                  case 'sp5':
                  $text_schoolcat = file_get_contents(locate_template('my_parts/text_files/special_planid_sp5.txt'));
                  $mytitle = '卒業日一時帰宅の教習所一覧';
                  echo $mytitle;
                  break;
                  case 'sp6':
                  $text_schoolcat = file_get_contents(locate_template('my_parts/text_files/special_planid_sp6.txt'));
                  $mytitle = 'オフシーズン一時帰宅の教習所一覧';
                  echo $mytitle;
                  break;
                  case 'sp7':
                  $text_schoolcat = file_get_contents(locate_template('my_parts/text_files/special_planid_sp7.txt'));
                  $mytitle = 'シングルユースの教習所一覧';
                  echo $mytitle;
                  break;
                  case 'sp8':
                  $text_schoolcat = file_get_contents(locate_template('my_parts/text_files/special_planid_sp8.txt'));
                  $mytitle = 'グループユースの教習所一覧';
                  echo $mytitle;
                  break;
                  case 'sp9':
                  $text_schoolcat = file_get_contents(locate_template('my_parts/text_files/special_planid_sp9.txt'));
                  $mytitle = '春特の教習所一覧';
                  echo $mytitle;
                  break;
                  case 'sp10':
                  $text_schoolcat = file_get_contents(locate_template('my_parts/text_files/special_planid_sp10.txt'));
                  $mytitle = 'ゴールドの教習所一覧';
                  echo $mytitle;
                  break;
                  case 'sp11':
                  $text_schoolcat = file_get_contents(locate_template('my_parts/text_files/special_planid_sp11.txt'));
                  $mytitle = '自炊プランの教習所一覧';
                  echo $mytitle;
                  break;
                  default:

                 }
                 ?>
                </h2>
                <div class="descText"><p><?php echo $text_schoolcat; ?></p></div>
              </div>
              <div class="dormitorytTable_head flex">
                <p class="dormitory_co2">教習所名、料⾦(税込)</p>
                <p class="dormitory_co3">お得情報</p>
              </div>

<?php
$getid = $_GET['id'];
$tokubethu = '';
if($getid == 'sp1'){
 $tokubethu = '限定割';
}else if($getid == 'sp2'){
 $tokubethu = 'ツイン特別';
}else if($getid == 'sp3'){
 $tokubethu = '二輪同時特別';
}else if($getid == 'sp4'){
 $tokubethu = '年末一時帰宅';
}else if($getid == 'sp5'){
 $tokubethu = '卒業日一時帰宅';
}else if($getid == 'sp6'){
 $tokubethu = 'オフシーズン一時帰宅';
}else if($getid == 'sp7'){
 $tokubethu = 'シングルユース';
}else if($getid == 'sp8'){
 $tokubethu = 'グループユース';
}else if($getid == 'sp9'){
 $tokubethu = '春特';
}else if($getid == 'sp10'){
 $tokubethu = 'ゴールド';
}else if($getid == 'sp11'){
 $tokubethu = '自炊プラン';
}

$toku = "toku";

$get_ids = sql_tokubetsu_Func($tokubethu);//●有無関係なくpostID返ってくる
$myhtml = '';

foreach ($get_ids as $value) {
 $myhtml .= do_shortcode('[waribiki_list '.$value.' '.$tokubethu.' '.$toku.']');
}

if($getid == 'sp11'){
 $myhtml = do_shortcode('[tokubetukikaku_list cook_plan '.$toku.']');
}

if(empty($myhtml)){
 $myhtml = '<span>該当の教習所は見つかりませんでした。</span>';
}

echo $myhtml;
?>
  </div><!--end secInner-->
</section><!--end dormitory_list-->
<?php echo do_shortcode('[takusan_block]'); ?>
        </div>

        <?php echo do_shortcode('[sidebar]'); ?>
    </div><!--contentsWrapper-->

  </div><!--#mainContents-->
</div><!--#wholeContents-->

<?php
get_footer();
