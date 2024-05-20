<?php $home='<a href="'. home_url() .'">合宿免許Happy</a>'; ?>
<footer id="colophon" class="site-footer" >
  <div class="footerLogo">
    <!--footer menu-->
    <div class="imageBox footerLogoImage footerMaxWidth">
      <div class="image">
        <div class="image_inner">
          <a href="<?php echo home_url();?>">
            <img src="/wp-content/uploads/2018/01/logo.png" alt="合宿免許Happy">
          </a>
        </div><!--end image_inner-->
      </div><!--end image-->
    </div><!--end imageBox-->
  </div>
  <div class="footerText footerMaxWidth">
    <div class="text">
      <p>
        学⽣⽀持No1の<a href=" <php home_url() ;?>">合宿免許Happy</a>公式サイト。運転免許を取るなら指定⾃動⾞教習所公正取引協議会賛助会員エース免許センターが運営する顧客満⾜度90％以上（当社調べ）の<a href=" <php home_url() ;?>">合宿免許Happy</a>で。Happyは教習所と直取引なので超お得割引や激安・掘出しプランを多数⽤意。春休みや夏休み中⼊校も多数取り揃えしています。
      </p>
    </div>
  </div>
  <div class="footerMenuWrapper">
    <div id="footerMenu" class="flex fWrap_wrap maxWidth">
      <div id="footerSidebar01" class="">
        <?php dynamic_sidebar('footersidebar01');?>
      </div><!--/#footerSidebar01-->

      <div id="footerSidebar02" class="">
        <?php dynamic_sidebar('footersidebar02');?>
      </div><!--/#footerSidebar02-->

      <div id="footerSidebar03" class="">
        <?php dynamic_sidebar('footersidebar03');?>
      </div><!--/#footerSidebar03-->

      <div id="footerSidebar04" class="">
        <?php dynamic_sidebar('footersidebar04');?>
      </div><!--/#footerSidebar03-->

    </div><!--/#footerMenu-->
  </div><!--/.footerMenuWrapper-->

  <div id="subFooter">
    <div class="subFooterWrapeer">
      <div class="subFooterInner flex maxWidth">
        <div class="left flex">
          <div class="sublink">
            <a href="<?php echo home_url();?>/corporate">運営会社</a>
          </div>
          <div class="sublink">
            <a href="<?php echo home_url();?>/privacypolicy">個人情報保護方針</a>
          </div>
          <div class="sublink">
            <a href="<?php echo home_url();?>/tokusho">特定商取引法に基づく表示</a>
          </div>
          <div class="sublink">
            <a href="<?php echo home_url();?>/kiyaku_menseki">利用規約・免責事項</a>
          </div>
        </div>
        <div class="right">
          <?php echo do_shortcode('[copyright]'); ?>
        </div>
     </div>
    </div>
  </div><!--/#subFooter -->



</footer><!--/#colophon -->
</div>
<div class="TOPmove">
  <div class="imageBox">
    <div class="image">
      <div class="image_inner">
        <img src="<?php echo get_template_directory_uri();?>/assets/images/common/pagetop.png">
      </div><!--end image_inner-->
    </div><!--end image-->
  </div><!--end imageBox-->
  
</div>


<?php wp_footer(); ?>

<!-- Yahoo Code for your Target List -->
<script type="text/javascript" language="javascript">
/* <![CDATA[ */
var yahoo_retargeting_id = 'LFAZ58W1NA';
var yahoo_retargeting_label = '';
var yahoo_retargeting_page_type = '';
var yahoo_retargeting_items = [{item_id: '', category_id: '', price: '', quantity: ''}];
/* ]]> */
</script>
<script type="text/javascript" language="javascript" src="https://b92.yahoo.co.jp/js/s_retargeting.js"></script>

<script type="text/javascript">
/* <![CDATA[ */
var google_conversion_id = 803955454;
var google_custom_params = window.google_tag_params;
var google_remarketing_only = true;
/* ]]> */
</script>
<script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<div style="display:inline;">
<img height="1" width="1" style="border-style:none;" alt="" src="//googleads.g.doubleclick.net/pagead/viewthroughconversion/803955454/?guid=ON&amp;script=0"/>
</div>
</noscript>

</div>


<!-- <script>
  Array.prototype.slice.call(document.querySelectorAll("a"),0).forEach(function(val){ console.log(val.href) })
  Array.prototype.slice.call(document.querySelectorAll("a"),0).forEach(function(val){ val.href = val.href.replace("<?php echo home_url();?>","<?php echo esc_url( home_url( ) ); ?>"); })
</script> -->
</body>

</html>