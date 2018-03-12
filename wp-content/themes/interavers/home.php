<?php
/*
    Template name: Homepage
*/

get_header();

$args = array(
    'post_type' => 'blog',
    'posts_per_page' => 3,
    'order' => 'date',
    'order_by' => 'DESC'
);

$blogs = new WP_Query($args);
?>

    <section class="block1 text-center">
        <div class="container">
            <div class="row">
                <?php if (get_field('title_block1', 'options')): ?>
                    <h1 class="under_line"><?= get_field('title_block1', 'options'); ?></h1>
                <?php endif;
                if (get_field('content_block1', 'options')):?>
                    <div class="content_block1">
                        <?= get_field('content_block1', 'options'); ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>
<?php
if (get_field("image_block2", 'options')) {
    $bg = get_field("image_block2", 'options');
}
?>
    <div class="col-sm-12 al-sections-wrapper">
    <section class="block2 text-center"
             style="background: url(<?= $bg['url'] ?>) no-repeat center center;background-size: cover;">
        <div class="container">
            <div class="row">
                <div class="block2_white-bg aligncenter">
                    <?php if (get_field('title_block2', 'options')): ?>
                        <div class="under_line"><?= get_field('title_block2', 'options'); ?></div>
                    <?php endif;
                    if (get_field('content_block2', 'options')):?>
                        <div class="content_block2">
                            <?= get_field('content_block2', 'options'); ?>
                        </div>
                    <?php endif;
                    if (have_rows('btn_block2', 'options')):
                        while (have_rows('btn_block2', 'options')):
                            the_row();
                            if ($post_object = get_sub_field('btn_block2_link')) :
                                $post = $post_object;
                                setup_postdata($post);
                                ?>
                                <a href="<?php the_permalink(); ?>"
                                   class="btn btn-yellow"><?= get_sub_field('btn_block2_text') ?></a>
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
    </div>
    <section class="block_offers">
        <div class="container">
            <div class="text-center">
                <?php if (get_field('title_of_offers', 'options')): ?>
                    <div class="under_line"><?= get_field('title_of_offers', 'options'); ?></div>
                <?php endif; ?>
            </div>
            <div class="row flex">
                <?php
                if (have_rows('kind_of_offers', 'options')):
                    while (have_rows('kind_of_offers', 'options')):
                        the_row();
                        ?>
                        <div class="col-flex-item">
                            <div style="position: relative; overflow:hidden; max-width:370px" class="aligncenter">
                                <?php
                                if ($post_object = get_sub_field('page_link_of_offer')) :
                                    $post = $post_object;
                                    setup_postdata($post);
                                    ?>
                                    <a href="<?php the_permalink();
                                    wp_reset_postdata(); ?>"
                                       class="frontpage"
                                       style="background:rgba(<?php echo get_sub_field('offer_color'); ?>,0.6);">
                                    </a>
                                    <?php
                                endif;
				$offer_image = get_sub_field('image_of_offer');
                                ?>
                                <img src="<?php echo $offer_image['sizes']['offers']; ?>" alt="">
                            </div>
                            <div class="frontpage_articles__title text-center slideDown"
                                 style="color:rgba(<?php echo get_sub_field('offer_color'); ?>,1);"><?php echo get_sub_field('title_of_offer'); ?></div>
                            <div class="frontpage_articles__content text-left slideUp"><?php echo cut_my_post(get_sub_field('content_of_offer'), 455); ?></div>
                            <?php
                            if ($post_object = get_sub_field('page_link_of_offer')) :
                                $post = $post_object;
                                setup_postdata($post);
                                ?>
                                <a href="<?php the_permalink();
                                wp_reset_postdata(); ?>"
                                   class="btn btn-orange"
                                   style="border: 3px solid rgba(<?php echo get_sub_field('offer_color'); ?>,1);"><?php echo get_sub_field('text_of_link'); ?></a>
                                <?php
                            endif;
                            ?>
                        </div>
                        <?php
                    endwhile;
                endif;
                ?>
            </div>
        </div>
    </section>
<?php
if (get_field("image_block3", 'options')) {
    $bg2 = get_field("image_block3", 'options');
}
?>
    <section class="block3 text-center"
             style="background: url(<?= $bg2['url'] ?>) no-repeat center center;background-size: cover;">
        <div class="container">
            <div class="row">
                <div class="block2_white-bg aligncenter">
                    <?php if (get_field('title_block3', 'options')): ?>
                        <div class="under_line"><?= get_field('title_block3', 'options'); ?></div>
                    <?php endif;
                    if (get_field('content_block3', 'options')):?>
                        <div class="content_block3">
                            <?= get_field('content_block3', 'options'); ?>
                        </div>
                    <?php endif;
                    if (have_rows('btn_block3', 'options')):
                        while (have_rows('btn_block3', 'options')):
                            the_row();
                            if ($post_object = get_sub_field('btn_block3_link')) :
                                $post = $post_object;
                                setup_postdata($post);
                                ?>
                                <a href="<?php the_permalink(); ?>"
                                   class="btn btn-yellow"><?= get_sub_field('btn_block3_text') ?></a>
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
    <section class="block-news text-center">
        <div class="container">
            <?php if (get_field('news_title', 'options')): ?>
                <div class="under_line"><?php the_field('news_title', 'options'); ?></div>
            <?php endif; ?>
            <div class="row flex">
                <?php
                if ($blogs->have_posts()):
                    while ($blogs->have_posts()):
                        $blogs->the_post();
                        ?>
                        <div class="col-flex-item text-center block-news_item">
                            <a href="<?php the_permalink(); ?>" class="link-blog">
                                <div class="img_blog">
                                    <?php the_post_thumbnail('blog-small'); ?>
                                </div>
                                <div class="text-blog">
                                    <div class="text-blog_title equal">
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
                endif;
                ?>
            </div>
        </div>
    </section>

<?php
get_sidebar('partners');
get_footer();
?>