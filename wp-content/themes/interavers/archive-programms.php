<?php
get_header();

$blog_cats = get_terms('reviews_tax');
?>

    <div class="single-country container">
        <div class="row">
            <div class="col-md-3"><?php get_sidebar('navigation'); ?></div>
            <div class="col-md-9">
                <?php if (function_exists('dimox_breadcrumbs')) dimox_breadcrumbs(); ?>
                <?php
                if (have_posts()):?>
                    <div class="row">
                        <?php
                        while (have_posts()):
                            the_post();
                            ?>
                            <div class="col-md-6 block-tax-education_item">
                                <a href="<?php the_permalink(); ?>" class="link-tax-education">
                                    <div class="img_tax-education">
                                        <?php
                                        if (get_the_post_thumbnail()):
                                            the_post_thumbnail('blog-small');
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
                                        <div class="text-tax-education_title programms_equal">
                                            <?php the_title(); ?>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <?php
                        endwhile; ?>
                    </div>
                    <?php
                endif;
                ?>
            </div>
        </div>
    </div>

<?php
get_footer();
?>