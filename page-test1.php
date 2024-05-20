
<?php get_header(); ?>

<!--page-->


<div id="wholeContents" class="wholeContents single-school" role="main">
	<div id="mainContents" class="mainContents">





		<div id="contentsWrapper" class="contentsWrapper maxWidth flex fWrap_wrap">

			<!--main-->
			<div id="main" class="mainContent col3of4Pc">

				<p class="shiteiIinkai">鳥取県公安委員会指定</p>
				<h2 class="schoolName text title"><?php echo get_the_title() ?></h2>
				<!-- TAB CONTROLLERS -->
				<input id="panel-1-ctrl" class="panel-radios" type="radio" name="tab-radios" checked>
				<input id="panel-2-ctrl" class="panel-radios" type="radio" name="tab-radios">
				<input id="panel-3-ctrl" class="panel-radios" type="radio" name="tab-radios">
				<input id="panel-4-ctrl" class="panel-radios" type="radio" name="tab-radios">

				<!-- TABS LIST -->
				<ul id="tabs-list">
				    <!-- MENU TOGGLE -->
				    <li id="li-for-panel-1">
				      <label class="panel-label" for="panel-1-ctrl">教習所について</label>
				    </li><!--INLINE-BLOCK FIX-->
				    <li id="li-for-panel-2">
				      <label class="panel-label" for="panel-2-ctrl">オトクな合宿プラン</label>
				    </li><!--INLINE-BLOCK FIX-->
				    <li id="li-for-panel-3">
				      <label class="panel-label" for="panel-3-ctrl">宿泊施設</label>
				    </li><!--INLINE-BLOCK FIX-->
				    <li id="li-for-panel-4">
				      <label class="panel-label" for="panel-4-ctrl">周辺スポット</label>
				    </li><!--INLINE-BLOCK FIX-->
				</ul>

				<!-- THE PANELS -->
				<div id="panels">
				  <div class="tabContainer">
				    <div id="panel-1">
				      <main>
				      	<div id="topImages">
					        <p class="image">
					        	<img class="imgRes" src="/wp-content/themes/nanairo/school/saninchuoujidoushagakkou/saninchuoujidoushagakkou01.jpg"></img>
					        </p>
						</div>


						<div id="leadText">
							<p class="text">
								教習熱心が自慢！<br />
								卒業までしっかりサポートいたします！
							</p>
						</div>
						<div id="schoolComment">
							<p class="text">
								日本名峰ランキングでベスト3に選ばれた大山を目の前に教習！<br />また、3分歩けば海岸！！<br />絶好のロケーションで教習ができます。<br />先生は個性的でおもしろく親切丁寧と評判！<br />疑問や不安なことがあればいつでもご相談ください♪
							</p>
						</div>
						<div id="typeOf" class="flex fWrap_wrap">
							<div id="typeOfLicense" class="col1of2 col2of2Sp co1 left">
								<h3><i class="fa fa-car"></i>対応免許</h3>
								<ul>
									<li><span>普通AT</span></li>
									<li><span>普通MT</span></li>
									<li><span>普通二輪</span></li>
									<li><span>大型二輪</span></li>
									<li><span>中型車</span></li>
									<li><span>大特</span></li>
									<li><span>普通二種</span></li>
								</ul>
								<p class="highway">高速教習：シミュレーター<br />
※諸事情により変更となる場合がございます。</p>
							</div>
							<div id="daysForGrad" class="col1of2 col2of2Sp co2 right">
								<h3><i class="fa fa-calendar"></i>卒業日数</h3>
								<div class="atmt flex">
									<p class="at">
										AT：最短<span>14</span>日～
									</p>
									<p class="mt">
										MT：最短<span>16</span>日～
									</p>
								</div>
							</div>
						</div>


						<!--施設紹介-->
						<div id="facility">
							<h3><i class="fa fa-home"></i>施設紹介</h3>
							<p class="address">住所：〒683-0853 鳥取県米子市両三柳3027番地5</p>
							<div class="images flex fWrap_wrap">
								<div class="col1of2 col2of2Sp co1">
									<p class="image">
										<img src="/wp-content/themes/nanairo/school/saninchuoujidoushagakkou/saninchuoujidoushagakkou02.png" alt="" class="imgRes">
									</p>
									<p class="text">
										教習所の目の前には広がる青い海！
									</p>

								</div>
								<div class="col1of2 col2of2Sp co2">
									<p class="image">
										<img src="/wp-content/themes/nanairo/school/saninchuoujidoushagakkou/saninchuoujidoushagakkou03.png" alt="" class="imgRes">
									</p>
									<p class="text">
										教習車
									</p>
								</div>
								<div class="col1of2 col2of2Sp co3">
									<p class="image">
										<img src="/wp-content/themes/nanairo/school/saninchuoujidoushagakkou/saninchuoujidoushagakkou04.png" alt="" class="imgRes">
									</p>
									<p class="text">
										自転車無料貸出しあり♪
									</p>
								</div>
							</div>

							<div id="facilityTable">
								<h4>設備・周辺施設</h4>
								<ul class="list-col2">
									<li>
										<p class="item-head">Wi-fi</p>
										<p class="item-data">あり</p>
									</li>
									<li>
										<p class="item-head">レンタサイクル</p>
										<p class="item-data">あり</p>
									</li>
									<li>
										<p class="item-head">郵便局</p>
										<p class="item-data">自転車5分</p>
									</li>
									<li>
										<p class="item-head">コンビニ</p>
										<p class="item-data">ファミリーマート　徒歩3分</p>
									</li>
									<li>
										<p class="item-head">銀行</p>
										<p class="item-data">山陰合同銀行　自転車10分</p>
									</li>
									<li>
										<p class="item-head">駅</p>
										<p class="item-data">JR米子駅　車20分</p>
									</li>
								</ul>
							</div>

						</div>

						<!--合宿の様子-->
						<div id="camp">
							<h3><i class="fa fa-image"></i>合宿の様子</h3>
							<div class="images flex fWrap_wrap">
								<div class="col1of2 col2of2Sp co1">
									<p class="image">
										<img src="/wp-content/themes/nanairo/school/saninchuoujidoushagakkou/saninchuoujidoushagakkou02.png" alt="" class="imgRes">
									</p>
									<p class="text">
										教習所の目の前には広がる青い海！
									</p>

								</div>
								<div class="col1of2 col2of2Sp co2">
									<p class="image">
										<img src="/wp-content/themes/nanairo/school/saninchuoujidoushagakkou/saninchuoujidoushagakkou03.png" alt="" class="imgRes">
									</p>
									<p class="text">
										教習車
									</p>
								</div>
								<div class="col1of2 col2of2Sp co3">
									<p class="image">
										<img src="/wp-content/themes/nanairo/school/saninchuoujidoushagakkou/saninchuoujidoushagakkou04.png" alt="" class="imgRes">
									</p>
									<p class="text">
										自転車無料貸出しあり♪
									</p>
								</div>
							</div>
						</div>


						<!-- アクセス -->
						<div id="access">
							<h3><i class="fa fa-map-marker"></i>アクセス</h3>

							<!--from-->
							<div class="from">
								大阪・京都・兵庫からのご出発
							</div>
							<div class="wayto">
								高速バス利用（出発日：入校日当日）
							</div>
							<div class="hours">
								梅田・難波・京都・三宮 → 米子（約3時間30分）
							</div>
							<div class="support">
								（上記区間往復交通費全額支給）
							</div>
							<div class="notice">
								【ご集合】米子駅　無料送迎バスで教習所へ<br />
								【その他の地域からのご出発】往復9,600円（税込）を上限として教習所が定めた金額が支給されます。
							</div>

							<!--from-->
							<div class="from">
								三重からのご出発
							</div>
							<div class="wayto">
								近鉄線＋高速バス利用（出発日：入校日当日）
							</div>
							<div class="hours">
								津駅・四日市駅・名張駅 → 近鉄大阪難波駅（約2時間5分） ≪乗換≫ なんばOCAT → 米子駅（約3時間30分）
							</div>
							<div class="support">
								（上記区間往復交通費全額支給）
							</div>
							<div class="notice">
								【ご集合】米子駅　無料送迎バスで教習所へ<br />
								【その他の地域からのご出発】往復15,000円（税込）を上限として教習所が定めた金額が支給されます。
							</div>

							<!--from-->
							<div class="from">
								愛知・岐阜からのご出発
							</div>
							<div class="wayto">
								新幹線＋高速バス利用（出発日：入校日当日）
							</div>
							<div class="hours">
								名古屋駅・岐阜羽島駅 → 京都駅（約35分）≪乗換≫　京都駅前バス乗り場 → 米子駅（約4時間25分）
							</div>
							<div class="support">
								（上記区間往復交通費全額支給）
							</div>
							<div class="notice">
								【ご集合】米子駅　無料送迎バスで教習所へ<br />
								【その他の地域からのご出発】往復15,000円（税込）を上限として教習所が定めた金額が支給されます。
							</div>

							<!--from-->
							<div class="from">
								岡山からのご出発
							</div>
							<div class="wayto">
								JR線利用（出発日：入校日当日）
							</div>
							<div class="hours">
								岡山駅 → 米子駅（約2時間10分）
							</div>
							<div class="support">
								（上記区間往復交通費全額支給）
							</div>
							<div class="notice">
								【ご集合】米子駅　無料送迎バスで教習所へ<br />
								【その他の地域からのご出発】往復9,500円（税込）を上限として教習所が定めた金額が支給されます。
							</div>

							<!--from-->
							<div class="from">
								広島からのご出発
							</div>
							<div class="wayto">
								高速バス利用（出発日：入校日当日
							</div>
							<div class="hours">
								広島駅・広島バスセンター → 米子駅（約4時間）
							</div>
							<div class="support">
								（上記区間往復交通費全額支給）
							</div>
							<div class="notice">
								【ご集合】米子駅　無料送迎バスで教習所へ<br />
								【その他の地域からのご出発】往復7,800円（税込）を上限として教習所が定めた金額が支給されます。
							</div>

							<!--from-->
							<div class="from">
								山口からのご出発
							</div>
							<div class="wayto">
								新山口駅 → 米子駅（約4時間20分）
							</div>
							<div class="hours">
								広島駅・広島バスセンター → 米子駅（約4時間）
							</div>
							<div class="support">
								（上記区間往復交通費全額支給)
							</div>
							<div class="notice">
								【ご集合】米子駅　無料送迎バスで教習所へ<br />
								【その他の地域からのご出発】往復14,920円（税込）を上限として教習所が定めた金額が支給されます。
							</div>

							<!--from-->
							<div class="from">
								福岡からのご出発
							</div>
							<div class="wayto">
								新幹線＋JR線利用（出発日：入校日当日）
							</div>
							<div class="hours">
								博多駅・小倉駅 → 岡山駅（約2時間）≪乗換≫ 岡山駅 → 米子駅（約2時間10分）
							</div>
							<div class="support">
								（上記区間往復交通費全額支給
							</div>
							<div class="notice">
								【ご集合】米子駅　無料送迎バスで教習所へ<br />
								【その他の地域からのご出発】往復29,160円（税込）を上限として教習所が定めた金額が支給されます。
							</div>

							<!--from-->
							<div class="from">
								東京からのご出発
							</div>
							<div class="wayto">
								夜行高速バス利用（出発日：入校日前日）
							</div>
							<div class="hours">
								品川バスターミナル → 米子駅（約10時間20分）
							</div>
							<div class="support">
								（上記区間往復交通費全額支給
							</div>
							<div class="notice">
								【ご集合】米子駅　無料送迎バスで教習所へ<br />
								【その他の地域からのご出発】往復23,000円（税込）を上限として教習所が定めた金額が支給されます。
							</div>

							<h4>【上記以外の地域からのご出発】</h4>
							<p class="text">
								お気軽にお問合せ下さい。ご相談承ります。　<br />
								支給される交通費（※)および、よりよい交通アクセスをご案内いたします。
							</p>

							<h4>※交通費の支給について</h4>
							<p class="text">
								・交通費の支給は、教習所規定の算出および支給方法によりお渡しします。（教習所卒業を条件とします）。<br />
								・中途退校や適性検査不合格、および自己都合による帰宅の際の交通費は、お客さまのご負担となります。<br />
								・原則として、お客さまの住民票を基に、適切な交通機関を設定し支給額を算出します。記載の指定区間の範囲内であっても指定席・グリーン料金は除外となります。<br /> 
								・仮免許入校および、普通車以外の車種取得の方の交通費支給額は上記と異なる場合がありますので、お問い合わせください。
							</p>

							<h4>山陰中央自動車学校ご入校いただけないお住まいエリア</h4>
							<p class="text">
								鳥取県内・島根県松江市旧美保関・島根県松江市旧八束・島根県安来市にお住まいの方、または住民票・ご実家のある方は合宿でご入校いただくことができません。
							</p>

						</div>


						<!-- アクセスマップ -->
						<div id="accessMap">
							<h3>アクセスマップ</h3>
							<div class="map">
								<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3249.7506950977977!2d133.33568251525276!3d35.46096598024627!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x35565807b88fa741%3A0x5fdd1981079ab2f9!2z44CSNjgzLTA4NTMg6bOl5Y-W55yM57Gz5a2Q5biC5Lih5LiJ5p-z77yT77yQ77yS77yX4oiS77yV!5e0!3m2!1sja!2sjp!4v1499924749166" width="714" height="350" frameborder="0" style="border:0" allowfullscreen=""></iframe>
							</div>
						</div>

						<ul id="footer-tabs-list">
			    <!-- MENU TOGGLE -->
			    <li id="li-for-panel-1">
			      <label for="panel-1-ctrl">教習所について</label>
			    </li><!--INLINE-BLOCK FIX-->
			    <li id="li-for-panel-2">
			      <label for="panel-2-ctrl">オトクな合宿プラン</label>
			    </li><!--INLINE-BLOCK FIX-->
			    <li id="li-for-panel-3">
			      <label for="panel-3-ctrl">宿泊施設</label>
			    </li><!--INLINE-BLOCK FIX-->
			    <li id="li-for-panel-4">
			      <label for="panel-4-ctrl">周辺スポット</label>
			    </li><!--INLINE-BLOCK FIX-->
			</ul>


				      </main>
				    </div>
				    <div id="panel-2">
				      <main id="plan">
				        <!-- ////////////////////////////// 料金表 start -->
            <section class="main-sct">
              <h3 class="ttl01 icon-car"><i class="fa fa-car"></i>料金表（AT車）</h3>
              <div class="main-sct-inner">
                <p>MT車：税込16,200円UP<br>
                  自動二輪免許所持者：<span class="attention-normal">税込16,200円割引</span></p>

                <div class="price-tbl-wrap">
                  <div class="price-tbl">
                    <div class="price-tbl-col">
                      <div><p>宿泊プラン</p></div>
                      <div><p>レギュラー</p></div>
                      <div><p>ホテルツイン(女性の方)<br>ホテルシングルA</p></div>
                      <div><p>ホテルシングルB</p></div>
                    </div>
                    <div class="price-tbl-col">
                      <div><p>10/1〜1/18<br>3/25〜5/31</p></div>
                      <div><p><span class="price-tx-exc"><strong>200,000</strong>円</span></p></div>
                      <div><p><span class="price-tx-exc"><strong>205,000</strong>円</span></p></div>
                      <div><p><span class="price-tx-exc"><strong>210,000</strong>円</span></p></div>
                    </div>
                    <div class="price-tbl-col">
                      <div><p>1/19〜1/25</p></div>
                      <div><p><span class="price-tx-exc"><strong>224,000</strong>円</span></p></div>
                      <div><p><span class="price-tx-exc"><strong>236,500</strong>円</span></p></div>
                      <div><p><span class="price-tx-exc"><strong>239,000</strong>円</span></p></div>
                    </div>
                    <div class="price-tbl-col">
                      <div><p>1/26〜1/31<br>3/16〜3/24</p></div>
                      <div><p><span class="price-tx-exc"><strong>253,000</strong>円</span></p></div>
                      <div><p><span class="price-tx-exc"><strong>268,000</strong>円</span></p></div>
                      <div><p><span class="price-tx-exc"><strong>271,000</strong>円</span></p></div>
                    </div>
                  </div>

                  <div class="price-tbl col3">
                    <div class="price-tbl-col">
                      <div><p>宿泊プラン</p></div>
                      <div><p>レギュラー</p></div>
                      <div><p>ホテルツイン(女性の方)<br>ホテルシングルA</p></div>
                      <div><p>ホテルシングルB</p></div>
                    </div>
                    <div class="price-tbl-col">
                      <div><p>2/1〜2/25<br>3/5〜3/15</p></div>
                      <div><p><span class="price-tx-exc"><strong>286,000</strong>円</span></p></div>
                      <div><p><span class="price-tx-exc"><strong>303,500</strong>円</span></p></div>
                      <div><p><span class="price-tx-exc"><strong>305,000</strong>円</span></p></div>
                    </div>
                    <div class="price-tbl-col">
                      <div><p>2/26〜3/4</p></div>
                      <div><p><span class="price-tx-exc"><strong>295,000</strong>円</span></p></div>
                      <div><p><span class="price-tx-exc"><strong>313,000</strong>円</span></p></div>
                      <div><p><span class="price-tx-exc"><strong>315,000</strong>円</span></p></div>
                    </div>

                  </div>
                </div><!-- // .price-tbl-wrap -->

<!--
                <ul class="price-notes">
                  <li>※昼食のみのプランは上記より税込16,200円割引。</li>
                  <li>※過去に免許停止・無免許運転・免許取り消し等の行政処分を受けたことがある方および複数回違反のある方は入校できません。</li>
                  <li>※2/1〜3/20は学生の方のみの入校とさせていただきます。</li>
                  <li>（※1）10/1〜1/10・4/10〜5/31の期間はグループオススメ（2人部屋を3名以上）でご利用の方は税込5,400円割引（男性のみ）</li>
                  <li>※66歳以上の方はご入校いただけません。</li>
                </ul>
//-->

              </div><!-- // .main-sct-inner -->
            </section><!-- // .main-sct -->
            <!-- ////////////////////////////// 料金表 end -->





            <!-- ////////////////////////////// おトク情報 start -->
            <section class="main-sct color-pink">
              <h3 class="ttl01 icon-note"><i class="fa fa-music"></i>おトク情報</h3>
              <div class="main-sct-inner">

                <!-- キャンペーン start -->
                <div class="cp-box-wrap">

                  <section class="cp-box cp-genteiwari">
                    <h3 class="cp-box-ttl">限定割コース <span>レギュラー・ひとりでオススメ</span></h3>
                    <div class="cp-box-inner">
                      <div class="cp-box-price">
                        <p class="price-type">AT車</p>
                        <p class="price-tx-exc"><strong>195,000</strong>円</p>
                        <p class="price-tx-inc">税込<strong>210,600</strong>円</p>
                      </div>
                      <p class="cp-box-priceUp">[MT車] 税込16,200円UP<br>
                        [ホテルツイン] 税込5,400円UP<br>
                        [ホテルシングルＡ] 税込8,100円UP</p>
                      <p class="cp-box-period">対象入校日：カレンダーの<span class="cp-color">●</span>の日</p>
                      <p class="cp-box-notes">※30歳までの方対象</p>
                    </div>
                  </section>

                  <section class="cp-box cp-twin">
                    <h3 class="cp-box-ttl">2人でお得 <span></span></h3>
                    <div class="cp-box-inner">
                      <div class="cp-box-price">
                        <p class="price-type">AT車</p>
                        <p class="price-tx-exc"><strong>200,000</strong>円</p>
                        <p class="price-tx-inc">税込<strong>216,000</strong>円</p>
                      </div>
                      <p class="cp-box-priceUp">[MT車] 税込16,200円UP</p>
                      <p class="cp-box-period">対象入校日：10/1〜1/18・3/25〜5/31の全入校日</p>
                      <p class="cp-box-notes">※30歳までの方（女性）対象</p>
                    </div>
                  </section>

                  <section class="cp-box cp-harutoku">
                    <h3 class="cp-box-ttl">スプリング <span>レギュラー</span></h3>
                    <div class="cp-box-inner">
                      <div class="cp-box-price">
                        <p class="price-type">AT車</p>
                        <p class="price-tx-exc"><strong>205,000</strong>円</p>
                        <p class="price-tx-inc">税込<strong>221,400</strong>円</p>
                      </div>
                      <p class="cp-box-priceUp">[MT車] 税込16,200円UP<br>
                        [ホテルツイン] 税込10,800円UP<br>
                        [ホテルシングルＡ] 税込10,800円UP</p>
                        <p class="cp-box-period">対象入校日：カレンダーの<span class="cp-color">●</span>の日</p>
                      <p class="cp-box-notes">※30歳までの方対象</p>
                    </div>
                  </section>

                  <section class="cp-box cp-gold">
                    <h3 class="cp-box-ttl">リミテッド <span>レギュラー</span></h3>
                    <div class="cp-box-inner">
                      <div class="cp-box-price">
                        <p class="price-type">AT車</p>
                        <p class="price-tx-exc"><strong>228,500</strong>円</p>
                        <p class="price-tx-inc">税込<strong>246,780</strong>円</p>
                      </div>
                      <p class="cp-box-priceUp">[MT車] 税込16,200円UP<br>
                        [ホテルツイン] 税込10,800円UP<br>
                        [ホテルシングルＡ] 税込10,800円UP</p>
                        <p class="cp-box-period">対象入校日：カレンダーの<span class="cp-color">●</span>の日</p>
                      <p class="cp-box-notes">※30歳までの方対象</p>
                    </div>
                  </section>

                  <section class="cp-box cp-nirindouji">
                    <h3 class="cp-box-ttl">二輪同時特別コース <span>普通AT＋普通二輪（MT科）</span></h3>
                    <div class="cp-box-inner">
                      <div class="cp-box-price">
                        <p class="price-tx-exc"><strong>252,000</strong>円</p>
                        <p class="price-tx-inc">税込<strong>272,160</strong>円</p>
                      </div>
                      <p class="cp-box-priceUp">[普通MT＋普通二輪（MT科）]<br>税込285,660円</p>
                      <p class="cp-box-period">対象入校日：10/1〜1/18・3/25〜5/31の全入校日</p>
                      <p class="cp-box-notes">※30歳までの方対象</p>
                    </div>
                  </section>

                </div>
                <!-- キャンペーン end -->


                <!-- うれしい特典 start -->
                <section>
                  <h3 class="ttl02">うれしい特典</h3>
                  <ul class="special-list">
                    <li>レディス限定特典（A～Cより1つ選べます）<br>
                      <span class="notes">A：OUランド温泉入浴無料券3回分<br>B：水木しげるロード観光＋海の見えるレストラン「ORANG LAUT」でのディナー券1回分<br>C：皆生温泉旅館「つるや」での貸切岩盤浴と温泉入浴券1回分（偶数グループ限定）</span></li>
                    <li>卒業のお祝いに初心者マークプレゼント</li>
                  </ul>
                </section>
                <!-- うれしい特典 end -->


                <!-- その他割引 start -->
<!--
                <section>
                  <h3 class="ttl02">その他割引</h3>
                  <ul class="option-list">
                    <li>
                      <a href="/campaign/">
                        <span class="option-name">早割</span>
                        <span class="option-discount">税込<strong>5,000</strong>円割引</span>
                      </a>
                    </li>
                    <li>
                      <a href="/campaign/">
                        <span class="option-name">学割</span>
                        <span class="option-discount">税込<strong>3,000</strong>円割引</span>
                      </a>
                    </li>
                    <li>
                      <a href="/campaign/">
                        <span class="option-name">G割</span>
                        <span class="option-discount">税込<strong>5,000</strong>円割引</span>
                      </a>
                    </li>
                  </ul>
                </section>
//-->
                <!-- その他割引 end -->


              </div><!-- // .main-sct-inner -->
            </section><!-- // .main-sct -->
            <!-- ////////////////////////////// おトク情報 end -->





            <!-- ////////////////////////////// 入校日カレンダー start -->
            <section class="main-sct color-green">
              <h3 class="ttl01 icon-calendar">入校日カレンダー</h3>
              <div class="main-sct-inner">
                <p><img src="/wp-content/themes/nanairo/school/saninchuoujidoushagakkou/cal_notes.png" alt="" width="500"></p>

                <div class="calendar-box-wrap">
                  <div class="calendar-box">
                    <h3 class="ttl02">10月</h3>
                    <p><img src="/wp-content/themes/nanairo/school/saninchuoujidoushagakkou/calendar_img10.png" alt="10月の入校日カレンダー"></p>
                  </div>
                  <div class="calendar-box">
                    <h3 class="ttl02">11月</h3>
                    <p><img src="/wp-content/themes/nanairo/school/saninchuoujidoushagakkou/calendar_img11.png" alt="11月の入校日カレンダー"></p>
                  </div>
                  <div class="calendar-box">
                    <h3 class="ttl02">12月</h3>
                    <p><img src="/wp-content/themes/nanairo/school/saninchuoujidoushagakkou/calendar_img12.png" alt="12月の入校日カレンダー"></p>
                  </div>
                  <div class="calendar-box">
                    <h3 class="ttl02">1月</h3>
                    <p><img src="/wp-content/themes/nanairo/school/saninchuoujidoushagakkou/calendar_img01.png" alt="1月の入校日カレンダー"></p>
                  </div>
                  <div class="calendar-box">
                    <h3 class="ttl02">2月</h3>
                    <p><img src="/wp-content/themes/nanairo/school/saninchuoujidoushagakkou/calendar_img02.png" alt="2月の入校日カレンダー"></p>
                  </div>
                  <div class="calendar-box">
                    <h3 class="ttl02">3月</h3>
                    <p><img src="/wp-content/themes/nanairo/school/saninchuoujidoushagakkou/calendar_img03.png" alt="3月の入校日カレンダー"></p>
                  </div>
                <div class="calendar-box">
                  <h3 class="ttl02">4月</h3>
                  <p><img src="/wp-content/themes/nanairo/school/saninchuoujidoushagakkou/calendar_img04.png" alt="4月の入校日カレンダー"></p>
                </div>
                <div class="calendar-box">
                  <h3 class="ttl02">5月</h3>
                  <p><img src="/wp-content/themes/nanairo/school/saninchuoujidoushagakkou/calendar_img05.png" alt="5月の入校日カレンダー"></p>
                </div>
              </div>

                <!-- カレンダー注釈 start -->
                <section>
                  <ul class="endyear-list">
                    <li>※<span class="brown">◯</span>年末一時帰宅</li>
                    <li>※年末一時帰宅該当日以外のご入校で教習延長により年末休校日にかかる場合は、一時帰宅していただきます。その際の交通費はお客様のご負担となります。</li>
                  </ul>
                </section>
                <!-- カレンダー注釈 end -->

                <section class="sct-calendar-notes">
                  <h3 class="ttl02 mb0">注意事項</h3>
                  <div class="box-border calendar-notes">
                    <p>〓〓〓〓　保証内容　〓〓〓〓</p>
                    <p>【30歳までの方】<br>
                      ■技能教習・修了検定・卒業検定・宿泊：卒業まで追加料金なし<br>
				  ※ホテルプランは規定宿泊数＋3泊まで保証　以降はレギュラーへ移動</p>
                    <p>【31歳以上の方】<br>
                      ■技能教習：規定時限数+10時限まで(追加料金：1時限 税込4,860円)<br>
                      ■修了検定：1回まで(追加料金：1回 税込4,320円)<br>
                      ■卒業検定：1回まで(追加料金：1回 税込4,536円)<br>
                      ■宿泊：レギュラープランの場合は規定宿泊数＋5泊まで(追加料金：1泊 税込4,320円）、ホテルプランの場合は規定宿泊数＋3泊まで（追加料金：1泊 税込7,560円）<br>※ホテルプランは規定宿泊数＋3泊まで保証　以降はレギュラーへ移動 </p>
                    <p>
                      〓〓〓〓　別途料金　〓〓〓〓<br>
                      ●仮免許試験手数料　1,700円（非課税）/回（不合格の場合、受験ごとに必要）<br>
                      ●仮免許証交付手数料　1,100円（非課税）<br>
                      </p>
                    <p>
                      〓〓〓〓　その他　〓〓〓〓<br>
                      ●普通二輪同時　税込72,360円UP　※普通二輪ATの場合は税込51,840円UP（10/１～11/16・4/2～5/31）<br>
                      ●大型二輪同時　税込51,840円UP　※普通二輪免許所持の方に限る（10/１～11/14・4/3～5/31）<br>
                      </p>
                  </div>
                </section>

                <!-- ローカルナビ start -->
	            <ul id="footer-tabs-list">
			    <!-- MENU TOGGLE -->
			    <li id="li-for-panel-1">
			      <label for="panel-1-ctrl">教習所について</label>
			    </li><!--INLINE-BLOCK FIX-->
			    <li id="li-for-panel-2">
			      <label for="panel-2-ctrl">オトクな合宿プラン</label>
			    </li><!--INLINE-BLOCK FIX-->
			    <li id="li-for-panel-3">
			      <label for="panel-3-ctrl">宿泊施設</label>
			    </li><!--INLINE-BLOCK FIX-->
			    <li id="li-for-panel-4">
			      <label for="panel-4-ctrl">周辺スポット</label>
			    </li><!--INLINE-BLOCK FIX-->
			</ul>
	            <!-- ローカルナビ end -->

              </div><!-- // .main-sct-inner -->
            </section><!-- // .main-sct -->
            <!-- ////////////////////////////// 入校日カレンダー end -->
				      </main>
				    </div>
				    <div id="panel-3">
				      <main id="hotel">
				        <!-- ////////////////////////////// 宿泊施設 start -->
            <section class="main-sct">

              <ul class="box-col3">
                <li>
                  <a href="#05"><img src="/wp-content/themes/nanairo/school/saninchuoujidoushagakkou/thumb05.png" alt="" width="228" height="135" class="img-full">
                  <span class="img-caption">専用宿舎（男）</span></a>
                </li>
                <li>
                  <a href="#06"><img src="/wp-content/themes/nanairo/school/saninchuoujidoushagakkou/thumb06.png" alt="" width="228" height="135" class="img-full">
                  <span class="img-caption">夢寛歩（ゆめかんぽ）（女）</span></a>
                </li>
                <li>
                  <a href="#04"><img src="/wp-content/themes/nanairo/school/saninchuoujidoushagakkou/thumb04.png" alt="" width="228" height="135" class="img-full">
                  <span class="img-caption">ホテルアジェンダ本館（男）</span></a>
                </li>
                <li>
                  <a href="#02"><img src="/wp-content/themes/nanairo/school/saninchuoujidoushagakkou/thumb02.png" alt="" width="228" height="135" class="img-full">
                  <span class="img-caption">ホテルアジェンダ駅前（女）</span></a>
                </li>
                <li>
                  <a href="#03"><img src="/wp-content/themes/nanairo/school/saninchuoujidoushagakkou/thumb03.png" alt="" width="228" height="135" class="img-full">
                  <span class="img-caption">ホテルアクシス（女）</span></a>
                </li>
                <li>
                  <a href="#01"><img src="/wp-content/themes/nanairo/school/saninchuoujidoushagakkou/thumb01.png" alt="" width="228" height="135" class="img-full">
                  <span class="img-caption">米子タウンホテル（男・女）</span></a>
                </li>
              </ul>


              <h3 class="ttl05"><i class="fa fa-bed"></i>宿泊施設詳細</h3>
              <div class="main-sct-inner">


                <div class="hotel-box-wrap">

                  <section class="main-sct hotel-box" id="05">
                    <h4 class="ttl03">専用宿舎（男）</h4>

                    <ul class="photo-slider">
                      <li>
                        <img src="/wp-content/themes/nanairo/school/saninchuoujidoushagakkou/hotel05_img01.png" alt="" width="714" height="437">
                        <span class="slide-caption">お部屋</span>
                      </li>
                      <li>
                        <img src="/wp-content/themes/nanairo/school/saninchuoujidoushagakkou/hotel05_img02.png" alt="" width="714" height="437">
                        <span class="slide-caption">大浴場</span>
                      </li>
                    </ul>

                    <h4 class="ttl02 mb0">宿舎情報</h4>
                    <ul class="list-col2">
                      <li>
                        <p class="item-head">宿泊プラン</p>
                        <p class="item-data">レギュラー</p>
                      </li>
                      <li>
                        <p class="item-head">学校から</p>
                        <p class="item-data">敷地内</p>
                      </li>
                      <li>
                        <p class="item-head">部屋人数</p>
                        <p class="item-data">3～6名</p>
                      </li>
                      <li>
                        <p class="item-head">バス/トイレ</p>
                        <p class="item-data">共同</p>
                      </li>
                      <li>
                        <p class="item-head">テレビ</p>
                        <p class="item-data">○</p>
                      </li>
                      <li>
                        <p class="item-head">冷蔵庫</p>
                        <p class="item-data">○</p>
                      </li>
                      <li>
                        <p class="item-head">洗濯機</p>
                        <p class="item-data">無料</p>
                      </li>
                      <li>
                        <p class="item-head">乾燥機</p>
                        <p class="item-data">無料</p>
                      </li>
                      <li>
                        <p class="item-head">ネット環境</p>
                        <p class="item-data">Wi-Fi</p>
                      </li>
                      <li>
                        <p class="item-head">コンビニまで</p>
                        <p class="item-data">徒歩3分</p>
                      </li>
                      <li>
                        <p class="item-head">食事場所</p>
                        <p class="item-data">朝食:校内、昼食:校内、夕食:校内</p>
                      </li>
                      <li>
                        <p class="item-head"></p>
                        <p class="item-data"></p>
                      </li>
                    </ul>
					<!--
                  <ul class="endyear-list">
                    <li>※インターネットLAN環境のある場合、PCはご持参ください。</li>
                    <li>※満室時には他の宿舎をご利用いただく場合がございます。（途中移動を含む）</li>
                  </ul>
		  -->
                  </section><!-- // .hotel-box -->




                  <section class="main-sct hotel-box" id="06">
                    <h4 class="ttl03">夢寛歩（ゆめかんぽ）（女）</h4>

                    <ul class="photo-slider">
                      <li>
                        <img src="/wp-content/themes/nanairo/school/saninchuoujidoushagakkou/hotel06_img01.png" alt="" width="714" height="437">
                        <span class="slide-caption">施設外観</span>
                      </li>
                      <li>
                        <img src="/wp-content/themes/nanairo/school/saninchuoujidoushagakkou/hotel06_img02.png" alt="" width="714" height="437">
                        <span class="slide-caption">お部屋</span>
                      </li>
                      <li>
                        <img src="/wp-content/themes/nanairo/school/saninchuoujidoushagakkou/hotel06_img03.png" alt="" width="714" height="437">
                        <span class="slide-caption">大浴場</span>
                      </li>
                      <li>
                        <img src="/wp-content/themes/nanairo/school/saninchuoujidoushagakkou/hotel06_img04.png" alt="" width="714" height="437">
                        <span class="slide-caption">露天風呂</span>
                      </li>
                      <li>
                        <img src="/wp-content/themes/nanairo/school/saninchuoujidoushagakkou/hotel06_img05.png" alt="" width="714" height="437">
                        <span class="slide-caption">売店・土産物店</span>
                      </li>
                      <li>
                        <img src="/wp-content/themes/nanairo/school/saninchuoujidoushagakkou/hotel06_img06.png" alt="" width="714" height="437">
                        <span class="slide-caption">カラオケルーム</span>
                      </li>
                    </ul>

                    <h4 class="ttl02 mb0">宿舎情報</h4>
                    <ul class="list-col2">
                      <li>
                        <p class="item-head">宿泊プラン</p>
                        <p class="item-data">レギュラー</p>
                      </li>
                      <li>
                        <p class="item-head">学校から</p>
                        <p class="item-data">送迎バス7分</p>
                      </li>
                      <li>
                        <p class="item-head">部屋人数</p>
                        <p class="item-data">3名</p>
                      </li>
                      <li>
                        <p class="item-head">バス/トイレ</p>
                        <p class="item-data">バス：共用（温泉大浴場）<br>トイレ：〇</p>
                      </li>
                      <li>
                        <p class="item-head">テレビ</p>
                        <p class="item-data">○</p>
                      </li>
                      <li>
                        <p class="item-head">冷蔵庫</p>
                        <p class="item-data">○</p>
                      </li>
                      <li>
                        <p class="item-head">洗濯機</p>
                        <p class="item-data">無料</p>
                      </li>
                      <li>
                        <p class="item-head">乾燥機</p>
                        <p class="item-data">-</p>
                      </li>
                      <li>
                        <p class="item-head">ネット環境</p>
                        <p class="item-data">Wi-Fi</p>
                      </li>
                      <li>
                        <p class="item-head">コンビニまで</p>
                        <p class="item-data">徒歩3分</p>
                      </li>
                      <li>
                        <p class="item-head">食事場所</p>
                        <p class="item-data">朝食:校内、昼食:校内、夕食:校内</p>
                      </li>
                      <li>
                        <p class="item-head"></p>
                        <p class="item-data"></p>
                      </li>
                    </ul>
					<!--
                  <ul class="endyear-list">
                    <li>※インターネットLAN環境のある場合、PCはご持参ください。</li>
                    <li>※満室時には他の宿舎をご利用いただく場合がございます。（途中移動を含む）</li>
                  </ul>
			  -->
                  </section><!-- // .hotel-box -->




                  <section class="main-sct hotel-box" id="04">
                    <h4 class="ttl03">ホテルアジェンダ本館（男）</h4>

                    <ul class="photo-slider">
                      <li>
                        <img src="/wp-content/themes/nanairo/school/saninchuoujidoushagakkou/hotel04_img01.png" alt="" width="714" height="437">
                        <span class="slide-caption">外観</span>
                      </li>
                      <li>
                        <img src="/wp-content/themes/nanairo/school/saninchuoujidoushagakkou/hotel04_img02.png" alt="" width="714" height="437">
                        <span class="slide-caption">シングル</span>
                      </li>
                    </ul>

                    <h4 class="ttl02 mb0">宿舎情報</h4>
                    <ul class="list-col2">
                      <li>
                        <p class="item-head">宿泊プラン</p>
                        <p class="item-data">ホテルシングルA</p>
                      </li>
                      <li>
                        <p class="item-head">学校から</p>
                        <p class="item-data">送迎バス15分</p>
                      </li>
                      <li>
                        <p class="item-head">部屋人数</p>
                        <p class="item-data">1名</p>
                      </li>
                      <li>
                        <p class="item-head">バス/トイレ</p>
                        <p class="item-data">○</p>
                      </li>
                      <li>
                        <p class="item-head">テレビ</p>
                        <p class="item-data">○</p>
                      </li>
                      <li>
                        <p class="item-head">冷蔵庫</p>
                        <p class="item-data">○</p>
                      </li>
                      <li>
                        <p class="item-head">洗濯機</p>
                        <p class="item-data">コインランドリー（徒歩5分）</p>
                      </li>
                      <li>
                        <p class="item-head">乾燥機</p>
                        <p class="item-data">コインランドリー（徒歩5分）</p>
                      </li>
                      <li>
                        <p class="item-head">ネット環境</p>
                        <p class="item-data">有線LAN</p>
                      </li>
                      <li>
                        <p class="item-head">コンビニまで</p>
                        <p class="item-data">徒歩1分</p>
                      </li>
                      <li>
                        <p class="item-head">食事場所</p>
                        <p class="item-data">朝食:校内、昼食:校内、夕食:校内</p>
                      </li>
                      <li>
                        <p class="item-head"></p>
                        <p class="item-data"></p>
                      </li>
                    </ul>
					<!--
                  <ul class="endyear-list">
                    <li>※インターネットLAN環境のある場合、PCはご持参ください。</li>
                    <li>※満室時には他の宿舎をご利用いただく場合がございます。（途中移動を含む）</li>
                  </ul>
			  -->
                  </section><!-- // .hotel-box -->



                  <section class="main-sct hotel-box" id="02">
                    <h4 class="ttl03">ホテルアジェンダ駅前（女）</h4>

                     <ul class="photo-slider">
                      <li>
                        <img src="/wp-content/themes/nanairo/school/saninchuoujidoushagakkou/hotel02_img01.png" alt="" width="714" height="437">
                        <span class="slide-caption">ツイン</span>
                      </li>
                      <li>
                        <img src="/wp-content/themes/nanairo/school/saninchuoujidoushagakkou/hotel02_img02.png" alt="" width="714" height="437">
                        <span class="slide-caption">シングル</span>
                      </li>
                      <li>
                        <img src="/wp-content/themes/nanairo/school/saninchuoujidoushagakkou/hotel02_img03.png" alt="" width="714" height="437">
                        <span class="slide-caption">外観</span>
                      </li>
                      <li>
                        <img src="/wp-content/themes/nanairo/school/saninchuoujidoushagakkou/hotel02_img04.png" alt="" width="714" height="437">
                        <span class="slide-caption">ロビー</span>
                      </li>
                    </ul>

                    <h4 class="ttl02 mb0">宿舎情報</h4>
                    <ul class="list-col2">
                      <li>
                        <p class="item-head">宿泊プラン</p>
                        <p class="item-data">ホテルツイン<br>ホテルシングルA</p>
                      </li>
                      <li>
                        <p class="item-head">学校から</p>
                        <p class="item-data">送迎バス20分</p>
                      </li>
                      <li>
                        <p class="item-head">部屋人数</p>
                        <p class="item-data">1・2名</p>
                      </li>
                      <li>
                        <p class="item-head">バス/トイレ</p>
                        <p class="item-data">○</p>
                      </li>
                      <li>
                        <p class="item-head">テレビ</p>
                        <p class="item-data">○</p>
                      </li>
                      <li>
                        <p class="item-head">冷蔵庫</p>
                        <p class="item-data">○</p>
                      </li>
                      <li>
                        <p class="item-head">洗濯機</p>
                        <p class="item-data">無料</p>
                      </li>
                      <li>
                        <p class="item-head">乾燥機</p>
                        <p class="item-data">無料</p>
                      </li>
                      <li>
                        <p class="item-head">ネット環境</p>
                        <p class="item-data">有線LAN</p>
                      </li>
                      <li>
                        <p class="item-head">コンビニまで</p>
                        <p class="item-data">徒歩6分</p>
                      </li>
                      <li>
                        <p class="item-head">食事場所</p>
                        <p class="item-data">朝食:校内、昼食:校内、夕食:校内</p>
                      </li>
                      <li>
                        <p class="item-head"></p>
                        <p class="item-data"></p>
                      </li>
                    </ul>
					<!--
                  <ul class="endyear-list">
                    <li>※インターネットLAN環境のある場合、PCはご持参ください。</li>
                    <li>※満室時には他の宿舎をご利用いただく場合がございます。（途中移動を含む）</li>
                  </ul>

                  </section><!-- // .hotel-box -->



                  <section class="main-sct hotel-box" id="03">
                    <h4 class="ttl03">ホテルアクシス（女）</h4>

                    <ul class="photo-slider">
                      <li>
                        <img src="/wp-content/themes/nanairo/school/saninchuoujidoushagakkou/hotel03_img01.png" alt="" width="714" height="437">
                        <span class="slide-caption">お部屋</span>
                      </li>
                    </ul>

                    <h4 class="ttl02 mb0">宿舎情報</h4>
                    <ul class="list-col2">
                      <li>
                        <p class="item-head">宿泊プラン</p>
                        <p class="item-data">ホテルツイン<br>ホテルシングルA</p>
                      </li>
                      <li>
                        <p class="item-head">学校から</p>
                        <p class="item-data">送迎バス15分</p>
                      </li>
                      <li>
                        <p class="item-head">部屋人数</p>
                        <p class="item-data">1・2名</p>
                      </li>
                      <li>
                        <p class="item-head">バス/トイレ</p>
                        <p class="item-data">○</p>
                      </li>
                      <li>
                        <p class="item-head">テレビ</p>
                        <p class="item-data">○</p>
                      </li>
                      <li>
                        <p class="item-head">冷蔵庫</p>
                        <p class="item-data">○</p>
                      </li>
                      <li>
                        <p class="item-head">洗濯機</p>
                        <p class="item-data">コインランドリー（徒歩1分）</p>
                      </li>
                      <li>
                        <p class="item-head">乾燥機</p>
                        <p class="item-data">コインランドリー（徒歩1分）</p>
                      </li>
                      <li>
                        <p class="item-head">ネット環境</p>
                        <p class="item-data">Wi-Fi</p>
                      </li>
                      <li>
                        <p class="item-head">コンビニまで</p>
                        <p class="item-data">徒歩2分</p>
                      </li>
                      <li>
                        <p class="item-head">食事場所</p>
                        <p class="item-data">朝食:校内、昼食:校内、夕食:校内</p>
                      </li>
                      <li>
                        <p class="item-head"></p>
                        <p class="item-data"></p>
                      </li>
                    </ul>
					<!--
                  <ul class="endyear-list">
                    <li>※インターネットLAN環境のある場合、PCはご持参ください。</li>
                    <li>※満室時には他の宿舎をご利用いただく場合がございます。（途中移動を含む）</li>
                  </ul>
			  -->
                  </section><!-- // .hotel-box -->





                  <section class="main-sct hotel-box" id="01">
                    <h4 class="ttl03">米子タウンホテル（男・女）</h4>

                    <ul class="photo-slider">
                      <li>
                        <img src="/wp-content/themes/nanairo/school/saninchuoujidoushagakkou/hotel01_img02.png" alt="" width="714" height="437">
                        <span class="slide-caption">シングル</span>
                      </li>
                    </ul>

                    <h4 class="ttl02 mb0">宿舎情報</h4>
                    <ul class="list-col2">
                      <li>
                        <p class="item-head">宿泊プラン</p>
                        <p class="item-data">ホテルシングルB</p>
                      </li>
                      <li>
                        <p class="item-head">学校から</p>
                        <p class="item-data">送迎バス20分</p>
                      </li>
                      <li>
                        <p class="item-head">部屋人数</p>
                        <p class="item-data">1名</p>
                      </li>
                      <li>
                        <p class="item-head">バス/トイレ</p>
                        <p class="item-data">○</p>
                      </li>
                      <li>
                        <p class="item-head">テレビ</p>
                        <p class="item-data">○</p>
                      </li>
                      <li>
                        <p class="item-head">冷蔵庫</p>
                        <p class="item-data">○</p>
                      </li>
                      <li>
                        <p class="item-head">洗濯機</p>
                        <p class="item-data">200円(税込)～/1回</p>
                      </li>
                      <li>
                        <p class="item-head">乾燥機</p>
                        <p class="item-data">100円(税込)～/30分</p>
                      </li>
                      <li>
                        <p class="item-head">ネット環境</p>
                        <p class="item-data">Wi-Fi</p>
                      </li>
                      <li>
                        <p class="item-head">コンビニまで</p>
                        <p class="item-data">徒歩2分</p>
                      </li>
                      <li>
                        <p class="item-head">食事場所</p>
                        <p class="item-data">朝食:宿舎、昼食:校内、夕食:校内</p>
                      </li>
                      <li>
                        <p class="item-head"></p>
                        <p class="item-data"></p>
                      </li>
                    </ul>
                  <ul class="endyear-list">
                    <li>※満室時には他の宿舎をご利用いただく場合がございます。（途中移動を含む）</li>
                  </ul>
                  </section><!-- // .hotel-box -->





                </div><!-- // .hotel-box-wrap -->

              </div><!-- // .main-sct-inner -->
            </section><!-- // .main-sct -->
            <!-- ////////////////////////////// 宿泊施設 end -->


            <!-- ローカルナビ start -->
            <ul id="footer-tabs-list">
			    <!-- MENU TOGGLE -->
			    <li id="li-for-panel-1">
			      <label for="panel-1-ctrl">教習所について</label>
			    </li><!--INLINE-BLOCK FIX-->
			    <li id="li-for-panel-2">
			      <label for="panel-2-ctrl">オトクな合宿プラン</label>
			    </li><!--INLINE-BLOCK FIX-->
			    <li id="li-for-panel-3">
			      <label for="panel-3-ctrl">宿泊施設</label>
			    </li><!--INLINE-BLOCK FIX-->
			    <li id="li-for-panel-4">
			      <label for="panel-4-ctrl">周辺スポット</label>
			    </li><!--INLINE-BLOCK FIX-->
			</ul>
            <!-- ローカルナビ end -->

				      </main>
				    </div>
				    <div id="panel-4">
				      <main id="spot">
				        
            <!-- ////////////////////////////// 周辺スポット start -->
            <section class="main-sct">


              <h3 class="ttl05"><i class="fa fa-map-marker" aria-hidden="true"></i>周辺スポット詳細</h3>
              <div class="main-sct-inner">

                <div class="spot-box-wrap">

                  <section class="main-sct spot-box">
                    <h4 class="ttl03">ＯＵランド</h4>
                    <ul class="photo-slider">
                      <li>
                        <img src="/wp-content/themes/nanairo/school/saninchuoujidoushagakkou/spot01_img01.png" alt="" width="714" height="437">
                      </li>
                    </ul>
                    <section>
                      <p>有名な皆生温泉を源泉とするスーパー銭湯。<br>テーマ別お風呂や露天風呂、家族風呂、ジェットバス、サウナ等、色々な種類のお風呂が楽しめます。グループ等で丸一日ゆっくり楽しめる施設です。名前の由来でもあるＯとＵの形どった浴槽があるのが特徴。毎週月曜日に男湯・女湯入替えがあります。<br>バイブラバス、ジェットバス、ジェット寝湯、ワイン風呂などのテーマ風呂、露天風呂まで！</p>
                    </section>
                  </section>

                  <section class="main-sct spot-box">
                    <h4 class="ttl03">皆生温泉海水浴場</h4>
                    <ul class="photo-slider">
                      <li><img src="/wp-content/themes/nanairo/school/saninchuoujidoushagakkou/spot02_img01.png" alt="" width="714" height="437"></li>
                    </ul>
                    <section>
                      <p>皆生温泉の目前に広がる海岸が皆生海水浴場です。
 「日本の水浴場88選」にも選ばれるほど水質が良好。海水浴場から徒歩１０分圏内に日帰り温泉施設があって、海水浴のあとには温泉でゆっくり…というのが魅力です。</p>
                    </section>
                  </section>


                  <section class="main-sct spot-box">
                    <h4 class="ttl03">夏もオススメ…大山スキー場</h4>
                    <ul class="photo-slider">
                      <li><img src="/wp-content/themes/nanairo/school/saninchuoujidoushagakkou/spot03_img01.png" alt="" width="714" height="437"></li>
                    </ul>
                    <section>
                      <p>「海の見えるゲレンデ」として知られます。<br>リフトから降りて見下ろすとそんなパノラマの風景が広がるのです。日本海はもちろん島根半島、そして遠くは隠岐島まで。しばし呆然と眺めてみては…。<br>
広々とした大山の斜面を利用したゲレンデは、西日本一の規模。<br>
国際、豪円山、中の原、上の原の４エリアがあります。すべてのゲレンデが各コースに隣接。多彩なコース、ロケーションでウインターリゾートを満喫することが可能です。
</p>
                    </section>
                  </section>


                </div><!-- // .spot-box-wrap -->


              </div><!-- // .main-sct-inner -->
            </section><!-- // .main-sct -->
            <!-- ////////////////////////////// 周辺スポット end -->


           <ul id="footer-tabs-list">
			    <!-- MENU TOGGLE -->
			    <li id="li-for-panel-1">
			      <label for="panel-1-ctrl">教習所について</label>
			    </li><!--INLINE-BLOCK FIX-->
			    <li id="li-for-panel-2">
			      <label for="panel-2-ctrl">オトクな合宿プラン</label>
			    </li><!--INLINE-BLOCK FIX-->
			    <li id="li-for-panel-3">
			      <label for="panel-3-ctrl">宿泊施設</label>
			    </li><!--INLINE-BLOCK FIX-->
			    <li id="li-for-panel-4">
			      <label for="panel-4-ctrl">周辺スポット</label>
			    </li><!--INLINE-BLOCK FIX-->
			</ul>
				      </main>
				    </div>
				  </div>
				</div>





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
			</div>


			<!--sidebar-->
			<div id="sidebar" class="col1of4Pc">
				<div class="sidebarWrapper">
					sidebar-area
				<?php
						dynamic_sidebar( 'untenmenkyo-sidebar' );
					?>
				</div>
			</div>
		</div><!--contentsWrapper-->


	</div><!--#mainContents-->
</div><!--#wholeContents-->



<?php get_footer(); ?>
