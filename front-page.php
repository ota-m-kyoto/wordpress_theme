<?php get_header(); ?>

<!--page-->
<div id="wholeContents" class="wholeContents page-php" role="main">
	<div id="mainContents" class="mainContents">
		<div id="contentsWrapper" class="contentsWrapper maxWidth flex fWrap_wrap twoColumn">
			<!--main-->
				<div id="main" class="mainContent">
					<!--start firstView_section-->
					<section id="firstView" class="">
						<div class="secInner">
							<!--start firstImage_row-->
							<div class="firstImage_block">
							  <div class="firstImage_row1 firstImage_row box_row">
							    <div class="imageBox">
							      <div class="image">
							        <div class="image_inner">
							          <img class="onlyPc" src="<?php echo content_url();?>/uploads/2018/09/areaBg.png" alt="お客様満足度90%(当社調べ)の合宿免許Happyなら あなたに最適なプランがみつかります">
							          <img class="hidePc" src="<?php echo content_url();?>/uploads/2018/09/8520f64dea85c5ed7c298d49d7623743.png" alt="お客様満足度90%(当社調べ)の合宿免許Happyなら あなたに最適なプランがみつかります">
							        </div><!--end image_inner-->
							      </div><!--end image-->
							    </div><!--end imageBox-->
							  </div><!--end firstImage_row-->
							  <div class="firstImage_row2 firstImage_row box_row">
									<div class="imageBox">
									  <div class="image">
									    <div class="image_inner">
									      <?php echo do_shortcode('[ip_area]'); ?>
									    </div><!--end image_inner-->
									  </div><!--end image-->
									</div><!--end imageBox-->
							  </div><!--end firstImage_row-->
							  <div class="firstImage_row3 firstImage_row box_row">
							  	<div class="firstBtn_wrap">
							  		<a href="<?php echo home_url();?>/school_cat/all" class="firstBtn btn dblArrow_right">教習所一覧を見る</a>
							  	</div>
							  </div>
							</div><!--end firstImage_block-->
						</div><!--end secInner-->
					</section><!--end firstView_section-->
					<?php
					// ループ開始
					while ( have_posts() ) : the_post();

						// content-page.phpをロード
						get_template_part( 'template-parts/content', 'page' );//

						// コメント表示がオンになっていて、1つ以上のコメントがついている場合表示する
						if ( comments_open() || get_comments_number() ) :
							comments_template();
						endif;
					// ループ終わり
					endwhile;
					?>

					<section id="dormitory_list" class="">
	          <div class="secInner">
	            <div class="secTitleA">
	              <h3 class="titleText">Happyが提供する教習所⼀覧</h3>
	            </div>

	                <!--start dormiory_row-->
	                <?php
	                $html = "";
	                $schoolList = "";
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
				</div>

				<?php echo do_shortcode('[sidebar]'); ?>
		</div><!--contentsWrapper-->

	</div><!--#mainContents-->
</div><!--#wholeContents-->




<?php get_footer(); ?>
