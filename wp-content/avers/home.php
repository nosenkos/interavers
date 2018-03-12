<?php 
	/*
		Template name: Homepage
	*/

	get_header();

	$args = array(
		'post_type'=>'blog',
		'posts_per_page'=>6,
		'order'=>'date',
		'order_by'=>'DESC'
		);

	$blogs = new WP_Query($args);


?>

<section class="block1 text-center">
	<div class="container">
		<div class="row">
		<?php if(get_field('title_block1','options')): ?>
			<h1 class="under_line"><?=get_field('title_block1','options'); ?></h1>
			<?php endif; 
			if(get_field('content_block1','options')):?>
				<div class="content_block1">
				<?=get_field('content_block1','options'); ?>
				</div>
			<?php endif;
        if(have_rows('slider','options')):?>
            <div class="col-md-12">
                <div class="slider">
                    <?php
                    while(have_rows('slider','options')):
                        the_row();?>
                        <div style="position: relative;">
                            <?php
                            $post_object = get_sub_field('slider_object');
                            if($post_object):
                                $post = $post_object;
                                setup_postdata($post);
                                ?>
                                <?php the_post_thumbnail('slider');?>
                                <div class="slider-text">
                                    <div class="slider-title"><?php the_title();?></div>
                                    <div class="slider-excerpt"><?php echo cut_my_post(get_the_excerpt(),755);?></div>
                                    <a href="<?php the_permalink();?>" class="btn btn-blue">Узнать больше</a>
                                </div>
                                <?php
                                wp_reset_postdata();
                            endif;?>
                        </div>
                        <?php
                    endwhile;?>
                </div>
                <a href="#" class="next-block arrows">
                    <img src="<?php echo get_template_directory_uri()?>/assets//images/Nextphone.png" alt="">
                </a>
                <a href="#" class="prev-block arrows">
                    <img src="<?php echo get_template_directory_uri()?>/assets//images/Prevphone.png" alt="">
                </a>
            </div>
            <?php
        endif;
        ?>
		</div>
	</div>
</section>
<section class="slider">
	<div class="row">
		<!-- Здесь будет слайдер -->
	</div>
</section>
<section class="block2 text-center">
	<div class="container">
		<div class="row">
		<?php if(get_field('title_block2','options')): ?>
			<div class="under_line"><?=get_field('title_block2','options'); ?></div>
			<?php endif; 
			if(get_field('content_block2','options')):?>
				<div class="content_block2">
				<?=get_field('content_block2','options'); ?>
				</div>
			<?php endif; ?>
		</div>
	</div>
</section>
<section class="block_offers">
	<div class="container">
		<div class="text-center">
			<?php if(get_field('title_of_offers','options')): ?>
			<div class="under_line"><?=get_field('title_of_offers','options'); ?></div>
			<?php endif;?>
		</div>
		<div class="row">
			<?php
				if (have_rows('kind_of_offers','options')):
					while (have_rows('kind_of_offers','options')):
						the_row();
			?>
				<div class="col-md-4">
					<a href="<?php bloginfo('url');?>/<?php echo get_sub_field('page_link_of_offer');?>/" class="frontpage" style="background:rgba(<?php echo get_sub_field('offer_color');?>,0.6);">
					</a>
					<div class="frontpage_articles__title text-center slideDown" style="color:rgba(<?php echo get_sub_field('offer_color');?>,1);"><?php echo get_sub_field('title_of_offer');?></div>
					<div class="frontpage_articles__content text-center slideUp"><?php echo cut_my_post(get_sub_field('content_of_offer'),455);?></div>
					<a href="<?php bloginfo('url');?>/<?php echo get_sub_field('page_link_of_offer');?>/" class="btn btn-orange slideUp" style="background:rgba(<?php echo get_sub_field('offer_color');?>,1);"><?php echo get_sub_field('text_of_link');?></a>
					<img src="<?php echo get_sub_field('image_of_offer')['sizes']['offers'];?>" alt="">
				</div>
			<?php
					endwhile;
				endif;
			?>
		</div>
	</div>
</section>
<section class="block-news">
	<div class="container">
		<div class="row">
			<div class="zebra_line">
				<?php if(get_field('news_title','options')): ?>
					<div class="news_title"><?php the_field('news_title','options'); ?></div>
				<?php endif; ?>
			</div>
			<?php 
			if($blogs->have_posts()):
				while($blogs->have_posts()):
					$blogs->the_post();
			 ?>
			 	<div class="col-md-4 text-center">
			 		<a href="<?php the_permalink();?>" class="link-blog">
			 			<div class="img_blog">
				 			<?php the_post_thumbnail('blog-small'); ?>
				 		</div>
				 		<div class="text-blog">
				 			<div class="text-blog_title">
				 			 	<?php the_title(); ?>
				 			</div>
				 		 	<div class="text-blog_content">
				 		 		<?php echo cut_my_post(get_the_excerpt(),255); ?>
				 		 	</div>
				 		</div>
			 		</a>
			 	</div>
			 <?php 
			 	endwhile;
			 endif;
			  ?>
		</div>
	</div>
</section>
<section class="partners">
	<div class="container">
		<div class="text-center">
			<?php if(get_field('partners_title','options')): ?>
			<div class="under_line"><?=get_field('partners_title','options'); ?></div>
			<?php endif;
			if(have_rows('partners','options')):
				while(have_rows('partners','options')):
					the_row();?>
					<div class="col-md-2">
						<div class="img_height">
							<img src="<?php echo get_sub_field('image_partners');?>" alt="">
						</div>
					</div>
			<?php endwhile;
			endif; ?>
		</div>
	</div>
</section>

<?php 
get_footer();
 ?>