<?php
get_header();

$review_cats = get_terms('review');
?>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <?php get_sidebar('breadcrumbs');
                if (get_the_archive_title()) {
                    ?>
                    <div class="under_line text-center"><?php echo __('Отзывы', 'interavers'); ?></div>
                    <?php
                }
                ?>
                <ul class="blog_category list-inline list-unstyled text-center">
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
                <?php if (have_posts()):
                    while (have_posts()):
                        the_post(); ?>
                        <div class="blog_single_title text-center">
                            <?php the_title(); ?>
                        </div>
                        <div class="blog_single_content">
                            <?php
                            if (get_the_post_thumbnail()):?>
                                <div class="blog_single_img text-center">
                                    <?php the_post_thumbnail('blog-single-thumb'); ?>
                                </div>
                                <?php
                            endif;
                            the_content(); ?>
                        </div>
                    <?php endwhile;
                endif; ?>
            </div>
        </div>
        <?php
        if (get_field('images_gallery')):?>
            <div class="row">
                <div class="col-md-12">
                    <?php if (get_field('title_news')) { ?>
                        <div class="under_line text-center">
                            <?php the_field('title_news'); ?>
                        </div>
                        <?php
                    } ?>
                    <div class="images-gallery">
                        <?php foreach (get_field('images_gallery') as $image):
                            ?>
                            <a href="<?= $image['url'] ?>" title="<?= $image['title'] ?>"
                               style="margin: 0px 10px;"><img
                                        src="<?= $image['sizes']['image-gallery-small'] ?>"></a>
                        <?php endforeach; ?>
                    </div>
                    <a href="#" class="next-block arrows">
                        <img src="<?php echo get_template_directory_uri() ?>/assets/images/Nextphone.png" alt="">
                    </a>
                    <a href="#" class="prev-block arrows">
                        <img src="<?php echo get_template_directory_uri() ?>/assets/images/Prevphone.png" alt="">
                    </a>
                </div>
            </div>
            <?php
        endif;
        ?>
    </div>

<?php
get_footer();
?>