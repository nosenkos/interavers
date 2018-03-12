<?php 
get_header();
 ?>

 <div class="container">
 	<div class="row">
	 	<div class="col-md-3">
	 		<?php get_sidebar('navigation'); ?>
	 	</div>
	 	<div class="col-md-9">
	 		<?php if (function_exists('dimox_breadcrumbs')) dimox_breadcrumbs();?>
	 		<?php if(have_posts()):
	 						while(have_posts()):
	 							the_post(); ?>
	 		<div class="blog_single_title">
	 			<?php the_title(); ?>
	 		</div>
	 		<div class="blog_single_content">
	 			<?php 
	 			if(have_rows('data_of_meet')):
	 				while(have_rows('data_of_meet')):
	 					the_row();?>
	 				<div class="row" style="display: <?php the_field('enable_meet');?>">
	 					<div class="meet_block">
		 					<div class="data_meet">
		 						<p class="city"><?php the_sub_field('city_of_meet'); ?></p>
		 						<p class="date_of_meet">Дата мероприятия: <span><?php the_sub_field('date_of_meet') ?></span></p>
		 						<p class="time_of_meet">Время: <span><?php the_sub_field('time_of_meet'); ?></span></p>
		 					</div>
		 					<div class="reg_block pull-right">
				 				<a href="#vopros-popup" class="voprosik">задать вопрос</a>
				 				</div>
		 				</div>
	 				</div>
	 			<?php endwhile;
	 			endif;
	 			the_content(); ?>
	 		</div>
	 	<?php 	endwhile;
	 				endif; ?>
	 	</div>
 	</div>
 	<div style="display: none;">
							       <div id="vopros-popup" class="form-pop">
							    	   <div class="pop-tit">РЕГИСТРАЦИЯ НА МЕРОПРИЯТИЕ</div>
							            <?php echo do_shortcode('[contact-form-7 id="1422" title="Заявка"]'); ?>
							        </div>
							    </div>
 </div>

 <?php 
 get_footer();
  ?>