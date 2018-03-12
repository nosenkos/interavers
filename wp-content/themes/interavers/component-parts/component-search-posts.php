<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 10/16/2017
 * Time: 4:39 PM
 */
?>
<div class="col-md-4">
            <div class="img_search">
                <?php
                if (get_the_post_thumbnail()):
                    the_post_thumbnail('single-programms');
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
    <div class="text-search">
        <div class="text-search_title">
            <?php the_title(); ?>
        </div>
        <div class="text-search_content text-left">
            <?php echo cut_my_post(get_the_excerpt(), 255); ?>
        </div>
        <div href="<?php the_permalink(); ?>"
             class="btn-search"><?php echo __('Читать далее', 'Avers'); ?></div>
    </div>
</div>