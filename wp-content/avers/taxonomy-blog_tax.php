<?php 
get_header();

$blog_cats = get_terms('blog_tax');
 ?>

<div class="container">
	<div class="row">
		<div class="col-md-3">
			<?php 
				get_sidebar('navigation');
			 ?>
		</div>
		<div class="col-md-9">
			<?php if (function_exists('dimox_breadcrumbs')) dimox_breadcrumbs();?>

			<ul class="blog_category list-inline list-unstyled">
				<li><a href="<?=get_bloginfo('url').'/blog/';?>">Все рубрики</a></li>
				<?php 

					foreach ($blog_cats as $cat) :
				 ?>
					<li><a id="<?=$cat->term_id?>" href="<?=get_term_link($cat->term_id);?>"><?=$cat->name?></a></li>
				<?php 
					endforeach;
				 ?>
				</ul>
			<?php 
			if(have_posts()):
				while(have_posts()):
					the_post();
			?>
				<div class="row">
					<a href="<?php the_permalink();?>" class="blog_item">
						<div class="col-md-5">
							<?php the_post_thumbnail('blog-small'); ?>
						</div>
						<div class="col-md-7">
							<div class="blog_title">
								<?php the_title(); ?>
							</div>
							<div class="blog_content">
								<?php echo cut_my_post(get_the_content(),300) ?>
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
</div>

<?php 
get_footer();
 ?>