<?php
$args = array(
    'post_type' => 'page',
    'posts_per_page' => -1,
    'post_parent' => 75,
    'orderby' => 'title',
    'order' => 'ASC'
);
$education = new WP_Query($args);
//echo "<pre>";
//print_r($education);
//echo "</pre>";
?>
<div class="row">
    <div class="col-md-3"><?php get_sidebar('navigation'); ?></div>
    <div class="col-md-9">
        <?php get_sidebar('breadcrumbs'); ?>
        <?php the_title('<h1 class="entry-title under_line">', '</h1>'); ?>
        <div class="entry-content text-center">
            <?php
            if ($education->have_posts()):
                ?>
                <div class="row">
                    <?php
                    while ($education->have_posts()):
                        $education->the_post();
                        ?>
                        <div class="col-md-6 block-tax-education_item">
                            <a href="<?php the_permalink(); ?>" class="link-tax-education">
                                <div class="img_tax-education">
                                    <?php
                                    if (get_the_post_thumbnail()):
                                        the_post_thumbnail('education-small');
                                    else:
                                        ?>
                                        <img class="image-placeholder_blog-small"
                                             src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/placeholder.png"
                                             alt="">
                                        <?php
                                    endif;
                                    ?>
                                </div>
                                <div class="text-tax-education">
                                    <div class="text-tax-education_title tax-education_equal">
                                        <?php the_title(); ?>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <?php
                    endwhile;
                    ?>
                </div>
                <?php
            endif;
            wp_reset_postdata();
            ?>
            <div class="row">
                <div class="col-md-12">
                    <div class="content-education">
                        <?php if (get_the_post_thumbnail()): ?>
                            <div class="content-education_img pull-right">
                                <?php the_post_thumbnail(); ?>
                            </div>
                        <?php endif; ?>
                        <div class="content-education_text">
                            <?php the_content(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- .entry-content -->
    </div>
</div>
