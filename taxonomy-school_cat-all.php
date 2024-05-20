<?php get_header(); ?>

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
                       <img src="<?php echo get_template_directory_uri()?>/assets/icomoon/doubleCircle.svg" alt="">
                     </div><!--end image_inner-->
                   </div><!--end image-->
                 </div><!--end imageBox-->
                 全ての教習所一覧
                </h2>
              </div>
              <div class="secTitleA">
                <h3 class="titleText">Happyが提供する教習所⼀覧</h3>
              </div>

                  <!--start dormiory_row-->
                  <?php
                  $html = "";
                  $schoolList = "";
                  $schoolList .= do_shortcode('[top_todouhuken_school hokkaido]');
                  $schoolList .= do_shortcode('[top_todouhuken_school hokkaido]');
                  $schoolList .= do_shortcode('[top_todouhuken_school aomori]');
                  $schoolList .= do_shortcode('[top_todouhuken_school iwate]');
                  $schoolList .= do_shortcode('[top_todouhuken_school miyagi]');
                  $schoolList .= do_shortcode('[top_todouhuken_school akita]');
                  $schoolList .= do_shortcode('[top_todouhuken_school yamagata]');
                  $schoolList .= do_shortcode('[top_todouhuken_school fukushima]');
                  $html = <<< EOD
                  <div class="dormitory_row1 dormitory_row box_row">
                    <div class="blockTitleA">
                      <h3 class="titleText">北海道・東北の教習所⼀覧</h3>
                    </div>
                    <div class="acc">
                      <div class="dormitorytTable_head flex">
                        <p class="prefecture_wid">都道府県</p>
                        <p class="dormitory_co2">教習所名、料⾦(税込)</p>
                        <p class="dormitory_co3">お得情報</p>
                      </div>
                      {$schoolList}
                    </div>
                  </div>
EOD;
                  if(!empty($schoolList)){
                    echo $html;
                  }
                  ?>
                <!--start dormiory_row-->
                <?php
                $html = "";
                $schoolList = "";
                $schoolList .= do_shortcode('[top_todouhuken_school tokyo]');
                $schoolList .= do_shortcode('[top_todouhuken_school kanagawa]');
                $schoolList .= do_shortcode('[top_todouhuken_school chiba]');
                $schoolList .= do_shortcode('[top_todouhuken_school saitama]');
                $schoolList .= do_shortcode('[top_todouhuken_school ibaragi]');
                $schoolList .= do_shortcode('[top_todouhuken_school tochigi]');
                $schoolList .= do_shortcode('[top_todouhuken_school gunma]');
                $html = <<< EOD
                <div class="dormitory_row1 dormitory_row box_row">
                  <div class="blockTitleA">
                    <h3 class="titleText">関東の教習所⼀覧</h3>
                  </div>
                  <div class="acc">
                    <div class="dormitorytTable_head flex">
                      <p class="prefecture_wid">都道府県</p>
                      <p class="dormitory_co2">教習所名、料⾦(税込)</p>
                      <p class="dormitory_co3">お得情報</p>
                    </div>
                    {$schoolList}
                  </div>
                </div>
EOD;
                if(!empty($schoolList)){
                  echo $html;
                }
                ?>
                <!--start dormiory_row-->
                <?php
                $html = "";
                $schoolList = "";
                $schoolList .= do_shortcode('[top_todouhuken_school nigata]');
                $schoolList .= do_shortcode('[top_todouhuken_school yamanashi]');
                $schoolList .= do_shortcode('[top_todouhuken_school nagano]');
                $html = <<< EOD
                <div class="dormitory_row1 dormitory_row box_row">
                  <div class="blockTitleA">
                    <h3 class="titleText">甲信越の教習所⼀覧</h3>
                  </div>
                  <div class="acc">
                    <div class="dormitorytTable_head flex">
                      <p class="prefecture_wid">都道府県</p>
                      <p class="dormitory_co2">教習所名、料⾦(税込)</p>
                      <p class="dormitory_co3">お得情報</p>
                    </div>
                    {$schoolList}
                  </div>
                </div>
EOD;
                if(!empty($schoolList)){
                  echo $html;
                }
                ?>

                <?php
                $schoolList = "";
                $schoolList .= do_shortcode('[top_todouhuken_school toyama]');
                $schoolList .= do_shortcode('[top_todouhuken_school ishikawa]');
                $schoolList .= do_shortcode('[top_todouhuken_school fukui]');
                $html = <<< EOD
                <div class="dormitory_row1 dormitory_row box_row">
                  <div class="blockTitleA">
                    <h3 class="titleText">北陸の教習所⼀覧</h3>
                  </div>
                  <div class="acc">
                    <div class="dormitorytTable_head flex">
                      <p class="prefecture_wid">都道府県</p>
                      <p class="dormitory_co2">教習所名、料⾦(税込)</p>
                      <p class="dormitory_co3">お得情報</p>
                    </div>
                    {$schoolList}
                  </div>
                </div>
EOD;
                if(!empty($schoolList)){
                  echo $html;
                }
                ?>

                <?php
                $schoolList = "";
                $schoolList .= do_shortcode('[top_todouhuken_school aiti]');
                $schoolList .= do_shortcode('[top_todouhuken_school gihu]');
                $schoolList .= do_shortcode('[top_todouhuken_school shizuoka]');
                $schoolList .= do_shortcode('[top_todouhuken_school mie]');
                $html = <<< EOD
                <div class="dormitory_row1 dormitory_row box_row">
                  <div class="blockTitleA">
                    <h3 class="titleText">東海の教習所⼀覧</h3>
                  </div>
                  <div class="acc">
                    <div class="dormitorytTable_head flex">
                      <p class="prefecture_wid">都道府県</p>
                      <p class="dormitory_co2">教習所名、料⾦(税込)</p>
                      <p class="dormitory_co3">お得情報</p>
                    </div>
                    {$schoolList}
                  </div>
                </div>
EOD;
                if(!empty($schoolList)){
                  echo $html;
                }
                ?>

                <?php
                $schoolList = "";
                $schoolList .= do_shortcode('[top_todouhuken_school osaka]');
                $schoolList .= do_shortcode('[top_todouhuken_school hyogo]');
                $schoolList .= do_shortcode('[top_todouhuken_school kyoto]');
                $schoolList .= do_shortcode('[top_todouhuken_school shiga]');
                $schoolList .= do_shortcode('[top_todouhuken_school nara]');
                $schoolList .= do_shortcode('[top_todouhuken_school wakayama]');
                $html = <<< EOD
                <div class="dormitory_row1 dormitory_row box_row">
                  <div class="blockTitleA">
                    <h3 class="titleText">関西の教習所⼀覧</h3>
                  </div>
                  <div class="acc">
                    <div class="dormitorytTable_head flex">
                      <p class="prefecture_wid">都道府県</p>
                      <p class="dormitory_co2">教習所名、料⾦(税込)</p>
                      <p class="dormitory_co3">お得情報</p>
                    </div>
                    {$schoolList}
                  </div>
                </div>
EOD;
                if(!empty($schoolList)){
                  echo $html;
                }
                ?>

                <?php
                $schoolList = "";
                $schoolList .= do_shortcode('[top_todouhuken_school tottori]');
                $schoolList .= do_shortcode('[top_todouhuken_school shimane]');
                $schoolList .= do_shortcode('[top_todouhuken_school okayama]');
                $schoolList .= do_shortcode('[top_todouhuken_school hiroshima]');
                $schoolList .= do_shortcode('[top_todouhuken_school yamaguchi]');
                $html = <<< EOD
                <div class="dormitory_row1 dormitory_row box_row">
                  <div class="blockTitleA">
                    <h3 class="titleText">中国の教習所⼀覧</h3>
                  </div>
                  <div class="acc">
                    <div class="dormitorytTable_head flex">
                      <p class="prefecture_wid">都道府県</p>
                      <p class="dormitory_co2">教習所名、料⾦(税込)</p>
                      <p class="dormitory_co3">お得情報</p>
                    </div>
                    {$schoolList}
                  </div>
                </div>
EOD;
                if(!empty($schoolList)){
                  echo $html;
                }
                ?>

                <?php
                $schoolList = "";
                $schoolList .= do_shortcode('[top_todouhuken_school tokushima]');
                $schoolList .= do_shortcode('[top_todouhuken_school kagawa]');
                $schoolList .= do_shortcode('[top_todouhuken_school ehime]');
                $schoolList .= do_shortcode('[top_todouhuken_school kochi]');
                $html = <<< EOD
                <div class="dormitory_row1 dormitory_row box_row">
                <div class="blockTitleA">
                <h3 class="titleText">四国の教習所⼀覧</h3>
                </div>
                <div class="acc">
                <div class="dormitorytTable_head flex">
                <p class="prefecture_wid">都道府県</p>
                <p class="dormitory_co2">教習所名、料⾦(税込)</p>
                <p class="dormitory_co3">お得情報</p>
                </div>
                {$schoolList}
                </div>
                </div>
EOD;
                if(!empty($schoolList)){
                echo $html;
                }
                ?>

                <?php
                $schoolList = "";
                $schoolList .= do_shortcode('[top_todouhuken_school fukuoka]');
                $schoolList .= do_shortcode('[top_todouhuken_school saga]');
                $schoolList .= do_shortcode('[top_todouhuken_school nagasaki]');
                $schoolList .= do_shortcode('[top_todouhuken_school kumamoto]');
                $schoolList .= do_shortcode('[top_todouhuken_school oita]');
                $schoolList .= do_shortcode('[top_todouhuken_school miyazaki]');
                $schoolList .= do_shortcode('[top_todouhuken_school kagoshima]');
                $html = <<< EOD
                <div class="dormitory_row1 dormitory_row box_row">
                  <div class="blockTitleA">
                    <h3 class="titleText">九州・沖縄の教習所⼀覧</h3>
                  </div>
                  <div class="acc">
                    <div class="dormitorytTable_head flex">
                      <p class="prefecture_wid">都道府県</p>
                      <p class="dormitory_co2">教習所名、料⾦(税込)</p>
                      <p class="dormitory_co3">お得情報</p>
                    </div>
                    {$schoolList}
                  </div>
                </div>
EOD;
                if(!empty($schoolList)){
                  echo $html;
                }
                ?>
            </div><!--end secInner-->
          </section><!--end dormitory_list_section-->

          <?php echo do_shortcode('[takusan_block]'); ?>
        </div>

        <?php echo do_shortcode('[sidebar]'); ?>
    </div><!--contentsWrapper-->

  </div><!--#mainContents-->
</div><!--#wholeContents-->
<!--start dormitory_list_section-->

<?php
get_footer();
