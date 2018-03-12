<?php
get_header();

$country_args = get_terms(array(
    'taxonomy' => 'education_country',
    'object_ids' => get_the_ID()
));

$education_args = get_terms(array(
    'taxonomy' => 'kind_of_education',
    'object_ids' => get_the_ID()
));

$args = array(
    'post_type' => 'programms',
    'posts_per_page' => -1,
    'orderby' => 'title',
    'order' => 'ASC',
    $country_args[0]->taxonomy => $country_args[0]->slug,
    $education_args[0]->taxonomy => $education_args[0]->slug

);

$kind_ed = new WP_Query($args);
?>
    <div class="container single-country">
        <div class="row">
            <div class="col-md-3"><?php get_sidebar('navigation'); ?></div>
            <div class="col-md-9">
                <?php get_sidebar('breadcrumbs'); ?>
                <div class="under_line"><?php the_title(); ?></div>
                <div class="text-center"><?php the_post_thumbnail();?></div>
                <?php if ($kind_ed->have_posts()): ?>
                    <div class="single-country__programms-title"><?php echo get_field('single-country__programms-title'); ?></div>
                    <table class="table table-striped table-responsive">
                        <thead class="thead-default">
                        <tr class="active">
                            <th><?php echo __('Название', 'interavers'); ?></th>
                            <th class="text-center"><?php echo __('Расположение', 'interavers'); ?></th>
                            <th class="text-center"><?php echo __('Стоимость', 'interavers'); ?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php while ($kind_ed->have_posts()):
                            $kind_ed->the_post();
                            $args_country = get_terms(array(
                                'taxonomy' => 'education_country',
                                'object_ids' => get_the_ID()
                            ));
                            $city = '0';
                            foreach ($args_country as $c => $c1):
                                if ($c1->parent != 0) {
                                    $city = $c1->name;
                                }
                            endforeach;
                            ?>
                            <tr>
                                <td class="col-md-4">
                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                </td>
                                <td class="text-center col-md-4">
                                    <?php echo ($city) ? $city : '-'; ?>
                                </td>
                                <td class="text-center col-md-4">
                                    <?php (get_field('price')) ? the_field('price') : ''; ?>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                        </tbody>
                    </table>
                <?php
                wp_reset_postdata();
                endif; ?>
                <div><?php the_content(); ?></div>
            </div>
        </div>
    </div>

<?php
get_footer();
?>