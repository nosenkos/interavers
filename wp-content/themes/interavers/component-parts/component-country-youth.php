<?php
$tax_args = get_terms(array(
    'taxonomy' => 'education_country',
    'object_ids' => get_the_ID(),
    'parent' => 0
));

//Youth Program
$youth_args = array(
    'post_type' => 'youth_program',
    $tax_args[0]->taxonomy => $tax_args[0]->slug
);

$youth = new WP_Query($youth_args);

//End youth program

?>
<?php get_sidebar('breadcrumbs');
if (get_the_archive_title()) {
    ?>
    <?php if (get_field('tax_image', $tax_args[0]->taxonomy . '_' . $tax_args[0]->term_id)):
        $image = get_field('tax_image', $tax_args[0]->taxonomy . '_' . $tax_args[0]->term_id); ?>
    <?php endif ?>
    <div class="under_line text-center">
        <img src="<?php echo $image['url']; ?>" style="width:36px;"/>
        <?php single_term_title(); ?>
    </div>
    <?php
}
?>
<?php if ($youth->have_posts()): ?>
    <div class="row">
        <div class="col-md-12">
            <p class="education_country__describe"><?php echo __('Предлагаем вам следующие молодёжные программы:', 'interavers'); ?></p>
            <div class="row">
                <?php while ($youth->have_posts()):
                    $youth->the_post();
                    ?>
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
        </div>
    </div>
<?php endif; ?>
<?php
if (get_field('tax_text_youth', $tax_args[0]->taxonomy . '_' . $tax_args[0]->term_id)):?>
    <div class="row">
        <div class="col-md-12">
            <?php
            the_field('tax_text_youth', $tax_args[0]->taxonomy . '_' . $tax_args[0]->term_id);
            ?>
        </div>
    </div>
    <?php
endif;
?>