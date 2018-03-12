<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package interavers
 */
if (get_the_post_thumbnail()) {
    ?>
    <header class="entry-header text-center">
        <?php the_title('<h1 class="entry-title under_line">', '</h1>');
        if (get_field('title2')) {
            the_field('title2');
        }
        ?>
    </header><!-- .entry-header -->
    <div class="row">
        <div class="col-md-7">
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <div class="entry-content text-center">
                    <?php
                    the_content();
                    wp_link_pages(array(
                        'before' => '<div class="page-links">' . esc_html__('Pages:', 'interavers'),
                        'after' => '</div>',
                    ));
                    ?>
                </div><!-- .entry-content -->
            </article><!-- #post-## -->
        </div>
        <div class="col-md-5">
            <?php the_post_thumbnail(); ?>
        </div>
    </div>
    <?php
    if (have_rows('images_gallery')):?>
        <div class="row">
            <div class="col-md-12">
                <?php if (get_field('title_license')) { ?>
                    <div class="under_line text-center">
                        <?php the_field('title_license'); ?>
                    </div>
                    <?php
                } ?>
                <div class="images-gallery">
                    <?php while (have_rows('images_gallery')):
                        the_row();
                        $item_object = get_sub_field('image_gallery');
                        /*                    echo "<pre>";
                                            print_r(get_sub_field('image_gallery'));
                                            echo "</pre>"*/
                        ?>
                        <a href="<?= $item_object['url'] ?>" title="<?= $item_object['title'] ?>"
                           style="margin: 0px 10px;"><img
                                    src="<?= $item_object['sizes']['image-gallery-small'] ?>"></a>
                    <?php endwhile; ?>
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
    <?php
} else {
    ?>
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <header class="entry-header text-center">
            <?php the_title('<h1 class="entry-title under_line">', '</h1>'); ?>
        </header><!-- .entry-header -->

        <div class="entry-content text-center">
            <?php
            the_content();
            if (have_rows('images_gallery')):?>
                <?php if (get_field('title_license')) { ?>
                    <div class="under_line text-center">
                        <?php the_field('title_license'); ?>
                    </div>
                    <?php
                } ?>
                <div class="images-gallery">
                    <?php while (have_rows('images_gallery')):
                        the_row();
                        $item_object = get_sub_field('image_gallery');
                        /*                    echo "<pre>";
                                            print_r(get_sub_field('image_gallery'));
                                            echo "</pre>"*/
                        ?>
                        <a href="<?= $item_object['url'] ?>" title="<?= $item_object['title'] ?>"
                           style="margin: 0px 10px;"><img
                                    src="<?= $item_object['sizes']['image-gallery-small'] ?>"></a>
                    <?php endwhile; ?>
                </div>
                <?php
            endif;
            wp_link_pages(array(
                'before' => '<div class="page-links">' . esc_html__('Pages:', 'interavers'),
                'after' => '</div>',
            ));
            ?>
        </div><!-- .entry-content -->
    </article><!-- #post-## -->
    <?php
} ?>
</div>
<?php
if (get_field("banner_bg")) {
    $bg_about = get_field("banner_bg");
}
?>
<section class="text-center about-us banner"
         style="background: url(<?= $bg_about['url'] ?>) no-repeat center center;background-size: cover;">
    <div class="container">
        <div class="row">
            <div class="block-about_white-bg aligncenter">
                <?php
                if (get_field('banner_text')):?>
                    <div class="content_block-about">
                        <?= get_field('banner_text'); ?>
                    </div>
                <?php endif;
                if (have_rows('banner_btn')):
                    while (have_rows('banner_btn')): the_row();
                        $post_object = get_sub_field('banner_btn_link');
                        if ($post_object):
                            $post = $post_object;
                            setup_postdata($post); ?>
                            <a href="<?php the_permalink(); ?>"
                               class="btn btn-yellow"><?= get_sub_field('banner_btn_text'); ?></a>
                            <?php
                            wp_reset_postdata();
                        endif;
                    endwhile;
                endif;
                ?>
            </div>
        </div>
    </div>
</section>
<div class="content-area container about-us"">
