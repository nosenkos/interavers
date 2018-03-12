<?php
get_header();

$blog_cats = get_terms('blog_tax');
?>


    <div class="blog-news container">
        <div class="row">
            <div class="col-md-12">
                <?php get_sidebar('breadcrumbs') ?>
                    <div class="under_line text-center"><?php single_term_title(); ?></div>
                <ul class="blog_category list-inline list-unstyled text-center">
                    <li><a href="<?= get_bloginfo('url') . '/blog/'; ?>">Все рубрики</a></li>
                    <?php
                    foreach ($blog_cats as $cat) :
                        ?>
                        <li><a id="<?= $cat->term_id ?>"
                               href="<?= get_term_link($cat->term_id); ?>"><?= $cat->name ?></a></li>
                        <?php
                    endforeach;
                    ?>
                </ul>
                <div class="row flex">
                    <?php
                    if (have_posts()):
                        while (have_posts()):
                            the_post();
                            ?>
                            <div class="col-flex-item text-center block-news_item">
                                <a href="<?php the_permalink(); ?>" class="link-blog">
                                    <div class="img_blog">
                                        <?php the_post_thumbnail('blog-small'); ?>
                                    </div>
                                    <div class="text-blog">
                                        <div class="text-blog_title blog_equal">
                                            <?php the_title(); ?>
                                        </div>
                                        <div class="text-blog_content text-left">
                                            <?php echo cut_my_post(get_the_excerpt(), 255); ?>
                                        </div>
                                    </div>
                                </a>
                                <a href="<?php the_permalink(); ?>"
                                   class="btn btn-yellow"><?php echo __('Подробнее', 'Avers'); ?></a>
                            </div>
                            <?php
                        endwhile;
                        ?>
                        <div class="pagination aligncenter">
                            <?php
                            the_posts_pagination(array(
                                'mid_size' => 2,
                                'prev_text' => __('<i class="fa fa-long-arrow-left" aria-hidden="true"></i>', 'interavers'),
                                'next_text' => __('<i class="fa fa-long-arrow-right" aria-hidden="true"></i>', 'interavers'),
                            ));
                            ?>
                        </div>
                        <?php
                    endif; ?>
                </div>
            </div>
        </div>
    </div>

<?php
get_footer();
?>