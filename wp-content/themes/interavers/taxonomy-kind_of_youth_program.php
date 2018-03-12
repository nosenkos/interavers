<?php
get_header();

$tax_args = get_terms(array(
    'taxonomy' => 'kind_of_youth_program',
    'object_ids' => get_the_ID()
));

$args = array(
    'post_type' => 'youth_program',
    'posts_per_page' => -1,
    $tax_args[0]->taxonomy => $tax_args[0]->slug
);

$kind_ed = new WP_Query($args);
?>


    <div class="education_country container">
        <div class="row">
            <div class="col-md-3"><?php get_sidebar('navigation'); ?></div>
            <div class="col-md-9">
                <?php get_sidebar('breadcrumbs');
                if (get_the_archive_title()) {
                    ?>
                    <?php if (get_field('tax_image', 'education_country_' . $tax_args[0]->term_id)):
                        $image = get_field('tax_image', 'education_country_' . $tax_args[0]->term_id); ?>
                    <?php endif ?>
                    <div class="under_line text-center">
                        <img src="<?php echo $image['url']; ?>" style="width:36px;"/>
                        <?php single_term_title(); ?>
                    </div>
                    <p class="education_country__describe"><?php echo __('Предлагаем вам и вашим детям следующие образовательные программы:', 'interavers'); ?></p>
                    <?php
                }
                ?>
                <?php if ($kind_ed->have_posts()): ?>
                    <div class="row">
                        <?php while ($kind_ed->have_posts()):
                            $kind_ed->the_post(); ?>
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
                                        <div class="text-tax-education_title tax-education_equal">
                                            <?php the_title(); ?>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        <?php endwhile ?>
                    </div>
                <?php endif;
                if (get_field('tax_text', 'education_country_' . $tax_args[0]->term_id)):?>
                    <div class="row">
                        <?php
                        the_field('tax_text', 'education_country_' . $tax_args[0]->term_id);
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