<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package interavers
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <header class="entry-header">
        <?php the_title('<h1 class="entry-title under_line">', '</h1>'); ?>
    </header><!-- .entry-header -->

    <div class="entry-content">
        <div class="img-title">
            <?php
            the_post_thumbnail();
            ?>
        </div>
        <?php
        the_content();
        if (have_rows('images_gallery')):?>
            <div class="images-gallery">
                <?php while (have_rows('images_gallery')):
                    the_row();
                    $item_object = get_sub_field('image_gallery');
                    /*                    echo "<pre>";
                                        print_r(get_sub_field('image_gallery'));
                                        echo "</pre>"*/
                    ?>
                    <a href="<?= $item_object['url'] ?>" title="<?= $item_object['title'] ?>" style="margin: 0px 10px;"><img
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

    <?php if (get_edit_post_link()) : ?>
        <footer class="entry-footer">
            <?php
            edit_post_link(
                sprintf(
                /* translators: %s: Name of current post */
                    esc_html__('Edit %s', 'interavers'),
                    the_title('<span class="screen-reader-text">"', '"</span>', false)
                ),
                '<span class="edit-link">',
                '</span>'
            );
            ?>
        </footer><!-- .entry-footer -->
    <?php endif; ?>
</article><!-- #post-## -->
