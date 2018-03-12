<?php
$page_cat = get_terms(array(
    "taxonomy" => 'kind_of_education',
    "object_ids" => get_the_ID()
));

$args = array(
    'post_type' => 'country',
    'posts_per_page' => -1,
    'orderby' => 'title',
    'order' => 'ASC',
    $page_cat[0]->taxonomy => $page_cat[0]->slug


);
$country_cat = new WP_Query($args);

?>
<header class="entry-header text-center">
    <?php //the_title('<h1 class="entry-title under_line">', '</h1>'); ?>
</header><!-- .entry-header -->
<div class="row">
    <div class="col-md-3"><?php get_sidebar('navigation'); ?></div>
    <div class="col-md-9">
        <?php get_sidebar('breadcrumbs'); ?>
        <?php the_title('<h1 class="entry-title under_line">', '</h1>'); ?>
        <div class="entry-content text-center">
            <div class="row">
                <?php
                if ($country_cat->have_posts()):?>
                    <div class="col-md-12">
                        <div class="choose_country text-left"><?php echo __('Рассмотрите наши предложения в разных странах ⇒:', 'interavers'); ?></div>
                    </div>
                    <?php
                    while ($country_cat->have_posts()):
                        $country_cat->the_post();
                        $cat_posts = wp_get_object_terms(get_the_ID(), 'education_country');
                        foreach ($cat_posts as $tax_item):
                            $image = get_field('tax_image', 'education_country_' . $tax_item->term_id);
                            ?>
                            <div class="col-md-3 block-tax-education_item">
                                <a href="<?php the_permalink(); ?>" class="link-tax-education">
                                    <div class="img_tax-education">
                                        <img src="<?php echo ($image) ? $image['sizes']['blog-small'] : get_stylesheet_directory_uri() . '/assets/images/placeholder.png'; ?>"
                                             alt="">
                                    </div>
                                    <div class="text-tax-education">
                                        <div class="text-tax-education_title tax-education_equal">
                                            <?php echo $tax_item->name; ?>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <?php
                        endforeach;
                    endwhile;
                endif;
                wp_reset_postdata(); ?>
            </div>
            <?php
            if (get_the_content()):
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
                <?php
            endif;
            ?>
        </div><!-- .entry-content-->
    </div>
</div>
