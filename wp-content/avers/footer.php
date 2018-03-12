<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package interavers
 */

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="container">
			<div class="white-side">
				<div class="white-side_padding">
					<div class="row">
						<div class="col-md-6">
							<div class="site-icons text-left">
								<?php if(have_rows('footer_icons','options')):
												while(have_rows('footer_icons','options')):
													the_row(); ?>
												<a href="<?php echo get_sub_field('link_icon');?>" class="hvr-wobble-to-top-right">
												<i class="fa <?php echo get_sub_field('fa_icon');?>"></i>
												</a>
								<?php 	endwhile;
											endif; ?>
							</div>
						</div>
						<div class="col-md-6">
							<div class="site_check text-right">
								<div class="liveinternet">
									<!--LiveInternet counter--><script type="text/javascript"><!--
									document.write("<a href='//www.liveinternet.ru/click' "+
									"target=_blank><img src='//counter.yadro.ru/hit?t14.1;r"+
									escape(document.referrer)+((typeof(screen)=="undefined")?"":
									";s"+screen.width+"*"+screen.height+"*"+(screen.colorDepth?
									screen.colorDepth:screen.pixelDepth))+";u"+escape(document.URL)+
									";"+Math.random()+
									"' alt='' title='LiveInternet: показано число просмотров за 24"+
									" часа, посетителей за 24 часа и за сегодня' "+
									"border='0' width='88' height='31'><\/a>")
									//--></script><!--/LiveInternet-->
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="site-info text-center">
							<p>Интераверс © 1995-<?php echo date( 'Y' ); ?>  ООО "Фирма"АВЕРС-ЭКСПРЕСС ЛТД"</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</footer><!-- #colophon -->

<?php wp_footer(); ?>

</body>
</html>
