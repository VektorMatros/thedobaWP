</div><!-- CLOSING CONTAINER -->
</div><!-- CLOSING WRAPPER -->

		<div class="footer-wrapper">

		        <!-- BEGINNING FOOTER -->
		        <div class="footer">

		        		<!-- WIDGETIZED AREA 1 FOOTER -->
		                <div class="footer-col footer-col1">
		                		<?php
								if ( ! dynamic_sidebar( 'Footer Col1' )) :
								endif;
								?>
		                </div>

		                <!-- WIDGETIZED AREA 2 FOOTER -->
		                <div class="footer-col">
		                		<?php
								if ( ! dynamic_sidebar( 'Footer Col2' )) :
								endif;
								?>
		                </div>

		                <!-- WIDGETIZED AREA 3 FOOTER -->
		                <div class="footer-col">
		                		<?php
								if ( ! dynamic_sidebar( 'Footer Col3' )) :
								endif;
								?>
		                </div>


		        </div><!-- CLOSING FOOTER -->

		        <!-- BEGINNING BOTTOM BAR -->
		        <div class="bottombar-wrapper">
				       <div class="bottom-bar">

								<!-- FOOTER NAVIGATION -->
								<?php
								if ( has_nav_menu( 'footer-menu' ) )
								{
									wp_nav_menu( array(
										 'theme_location' => 'footer-menu',
										 'container' => false,
										 'menu_class'=>'footer-nav'
										 )
									);
								}
								?>

				               	<!-- FOOTER LOGO -->
<center><div><a href="https://www.dobovo.com/ru/днепропетровск-квартиры-посуточно/белоснежная-квартира-рядом-с-центром-25565/отзывы-клиентов.html#other-properties-reviews" target="_blank"><img style="height: 40px; margin-top: 12px; opacity: 0.6;" src="http://doba.in.ua/wp-content/uploads/2017/10/dobovolog.png" onerror="this.onerror=null;pagespeed.lazyLoadImages.loadIfVisibleAndMaybeBeacon(this);"></a></div><div style="font-size: 11px;"><a href="https://www.dobovo.com/ru/днепропетровск-квартиры-посуточно/белоснежная-квартира-рядом-с-центром-25565/отзывы-клиентов.html#other-properties-reviews" target="_blank">ссылка на отзывы</a></div></center>
		                        <a href="<?php echo home_url(); ?>">
										<?php
												if( function_exists( 'ot_get_option' ))
												{
													?>
							                        <img class="logo-footer" src="<?php echo ot_get_option('footer_logo' ); ?>" alt="<?php bloginfo('name'); ?>" title="<?php bloginfo('name'); ?>"/>
													<?php
												}
										?>
								</a>

		                       <!-- COPYRIGTH TEXT FOOTER -->
		                       <div class="copy-right-wrapper">
							   			<p class="developed-by">
												<a href="https://madness.in.ua">Разработка и автоматизация</a>
						                </p>
						                <p class="copy-right">
		                                        <?php
												if( function_exists( 'ot_get_option' ))
												{
													echo "Квартиры посуточно в Днепропетровске";
												}
														$parametr = get_post_custom(1146);
														echo "<!-- <pre>";
														print_r ($parametr);
														echo "</pre> -->";
												?>
						                </p>
				               </div>

		               </div>
		        </div><!-- CLOSING BOTOMBAR -->

		</div><!-- FOOTER WRAPPER CLOSED -->

		<?php wp_footer(); ?>



		<script type="text/javascript">
		jQuery(document).ready(function(){

		/*-----------------------------------------------------------------------------------*/
		/*	Search Slider in Footer -- Settings can be changed from theme options
		/*-----------------------------------------------------------------------------------*/
			<?php
			if (isset($_GET['min_price']) &&  isset($_GET['max_price'])) {
				?>
				var min_val = parseInt(<?php echo ot_get_option( 'min_val', 0 ); ?>);
				var max_val = parseInt(<?php echo ot_get_option( 'max_val', 1000000 ); ?>);
				var ini_min_val = parseInt(<?=$_GET['min_price']?>);
				var ini_max_val = parseInt(<?=$_GET['max_price']?>);
				var step = parseInt(<?php echo ot_get_option( 'step', 5000 ); ?>);
				<?
			}

			else if( function_exists( 'ot_get_option' ))
			{
				?>
				var min_val = parseInt(<?php echo ot_get_option( 'min_val', 0 ); ?>);
				var max_val = parseInt(<?php echo ot_get_option( 'max_val', 1000000 ); ?>);
				var ini_min_val = parseInt(<?php echo ot_get_option( 'ini_min_val', 100000 ); ?>);
				var ini_max_val = parseInt(<?php echo ot_get_option( 'ini_max_val', 500000 ); ?>);
				var step = parseInt(<?php echo ot_get_option( 'step', 5000 ); ?>);
				<?php
			}
			else
			{
				?>
				var min_val = 0;
				var max_val = 1000000;
				var ini_min_val = 100000;
				var ini_max_val = 500000;
				var step = 5000;
				<?php
			}
			?>


			$("#slider-range").slider({
				range: true,
				min: min_val,
				max: max_val,
				values: [ ini_min_val, ini_max_val ],
				step: step,
				slide: function( event, ui ) {
					$( "#min-price" ).val( ui.values[ 0 ]);
					$( "#max-price" ).val( ui.values[ 1 ]);
					$( "#amount" ).val( ui.values[ 0 ] + " - " + ui.values[ 1 ] );
				}
			});

			$( "#amount" ).val( $( "#slider-range" ).slider( "values", 0 ) + " - " + $( "#slider-range" ).slider( "values",1 ) );

			$( "#min-price" ).val( $( "#slider-range" ).slider( "values", 0 ) );
			$( "#max-price" ).val( $( "#slider-range" ).slider( "values", 1 ) );
		});
		</script>


<?php
switch(get_bloginfo('language')) {
  case 'en-US':
    $bn_w_arr = array('lang' => 'en', 'title' => 'Booking online', 'arrival' => 'Arrival', 'departure' => 'Departure', 'avail' => 'Show availability');
    break;
  case 'de-DE':
    $bn_w_arr = array('lang' => 'de', 'title' => 'Online-Buchung', 'arrival' => 'Anreise', 'departure' => 'Abreise', 'avail' => 'Verfügbarkeit prüfen');
    break;
  case 'uk':
    $bn_w_arr = array('lang' => 'uk', 'title' => 'Забронювати онлайн', 'arrival' => 'Заїзд', 'departure' => 'Виїзд', 'avail' => 'Перевірити наявність');
    break;
  default:
    $bn_w_arr = array('lang' => 'ru', 'title' => 'Забронировать онлайн', 'arrival' => 'Заезд', 'departure' => 'Выезд', 'avail' => 'Показать наличие');
}
?>
<script src="http://widget.bnovo.ru/js/bnovo.js"></script>
<script type="text/javascript">
  Bnovo_Widget.init(function(){
    Bnovo_Widget.open('_bn_widget_', {
        type: "vertical",
        lcode: "1470216405",
        lang: "<?php echo $bn_w_arr['lang'] ?>",
        title: "<?php echo $bn_w_arr['title'] ?>",
        arrival: "<?php echo $bn_w_arr['arrival'] ?>",
        departure: "<?php echo $bn_w_arr['departure'] ?>",
        btn_text: "<?php echo $bn_w_arr['avail'] ?>",
        width: "100%",
        background: "#555555",
        bg_alpha: "0",
        padding: "18",
        font_size: "12",
        title_color: "#000000",
        inp_bordcolor: "#949494",
        inp_bordhover: "#6b6b6b",
        btn_background: "#b02b27",
        btn_background_over: "#d60000",
        btn_textcolor: "#FFFFFF",
        btn_textover: "#FFFFFF",
        _logo_background: "none",
        url: "http://doba.in.ua/booking?lang=<?php echo $bn_w_arr['lang'] ?>"
    });
  });
</script>

<!-- Google Аналитика -->
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-40758400-3', 'auto');
  ga('send', 'pageview');

</script>
<!-- //Google Аналитика -->

<!-- Yandex.Metrika counter --><script type="text/javascript">(function (d, w, c) { (w[c] = w[c] || []).push(function() { try { w.yaCounter26566209 = new Ya.Metrika({id:26566209, webvisor:true, clickmap:true, trackLinks:true, accurateTrackBounce:true}); } catch(e) { } }); var n = d.getElementsByTagName("script")[0], s = d.createElement("script"), f = function () { n.parentNode.insertBefore(s, n); }; s.type = "text/javascript"; s.async = true; s.src = (d.location.protocol == "https:" ? "https:" : "http:") + "//mc.yandex.ru/metrika/watch.js"; if (w.opera == "[object Opera]") { d.addEventListener("DOMContentLoaded", f, false); } else { f(); } })(document, window, "yandex_metrika_callbacks");</script><noscript><div><img src="//mc.yandex.ru/watch/26566209" style="position:absolute; left:-9999px;" alt="" /></div></noscript><!-- /Yandex.Metrika counter -->
<!-- Тут скрипт звонка с сайта -->
<script type="text/javascript">
  (function(d, w, s) {
	var widgetHash = '23045', gcw = d.createElement(s); gcw.type = 'text/javascript'; gcw.async = true;
	gcw.src = '//widgets.binotel.com/getcall/widgets/'+ widgetHash +'.js';
	var sn = d.getElementsByTagName(s)[0]; sn.parentNode.insertBefore(gcw, sn);
  })(document, window, 'script');
</script> 
<!--Взять с ЛК my.binotel.ua -->
<!-- Закончился скрипт звонка doba.in.ua с сайта -->
</body>
</html>
