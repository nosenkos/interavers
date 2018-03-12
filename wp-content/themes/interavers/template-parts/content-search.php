<?php
/**
 * Template part for displaying results in search pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package interavers
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="row">
        <a href="<?php the_permalink(); ?>" class="search_item link-search" target="_blank">
            <?php
            if (get_post_type() == 'property'):
                get_template_part('component-parts/component', 'search-property');
            else:
                get_template_part('component-parts/component', 'search-posts');
            endif;
            ?>
        </a>
    </div>
</article><!-- #post-## -->

