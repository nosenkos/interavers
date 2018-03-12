<?php
get_header();

$review_cats = get_terms('review');
?>

    <div class="reviews container">
        <div class="row">
            <div class="col-md-12">
                <?php get_sidebar('breadcrumbs');
                if (get_the_archive_title()) {
                    ?>
                    <div class="under_line text-center"><?php post_type_archive_title(); ?></div>
                    <?php
                }
                ?>
                <ul class="reviews_category list-inline list-unstyled text-center">
                    <li><a href="<?= get_bloginfo('url') . '/reviews/'; ?>">Все отзывы</a></li>
                    <?php
                    foreach ($review_cats as $cat) :
                        ?>
                        <li><a id="<?= $cat->term_id ?>"
                               href="<?= get_term_link($cat->term_id); ?>"><?= $cat->name ?></a></li>
                        <?php
                    endforeach;
                    ?>
                </ul>
                <?php
                if (have_posts()):
                    while (have_posts()):
                        the_post();
                        ?>
                        <div class="row">
                            <a href="<?php the_permalink(); ?>" class="reviews_item link-reviews">
                                <div class="col-md-4">
                                    <div class="img_reviews">
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
                                </div>
                                <div class="col-md-8">
                                    <div class="text-reviews">
                                        <div class="text-reviews_title">
                                            <?php the_title(); ?>
                                        </div>
                                        <div class="text-reviews_content text-left">
                                            <?php echo cut_my_post(get_the_excerpt(), 255); ?>
                                        </div>
                                        <div href="<?php the_permalink(); ?>"
                                             class="btn-reviews"><?php echo __('Читать далее', 'Avers'); ?></div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <?php
                    endwhile; ?>
                    <div class="pagination aligncenter text-center">
                        <?php
                        the_posts_pagination(array(
                            'mid_size' => 2,
                            'prev_text' => __('<i class="fa fa-long-arrow-left" aria-hidden="true"></i>', 'interavers'),
                            'next_text' => __('<i class="fa fa-long-arrow-right" aria-hidden="true"></i>', 'interavers'),
                        ));
                        ?>
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