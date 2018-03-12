<?php
get_header();
?>
    <div class="container single-country">
        <main id="main" class="site-main site-content" role="main">
            <div class="row">
                <div class="col-md-3"><?php get_sidebar('navigation'); ?></div>
                <div class="col-md-9">
                    <?php get_sidebar('breadcrumbs'); ?>
                    <div class="under_line"><?php the_title(); ?></div>
                    <div class="text-center"><?php echo the_post_thumbnail();?></div>
                    <div><?php the_content(); ?></div>
                </div>
            </div>
        </main>
    </div>

<?php
get_footer();
?>