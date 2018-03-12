<?php
//new WP_Query
$count_posts = 6;
$posts_per_page = (isset($_SESSION['currentPage']) && $_SESSION['currentPage'] != "" && !empty($_SESSION['currentPage']))?($_SESSION['currentPage']+1) * $count_posts:$count_posts;
$args = array(
    'post_type' => 'property',
    'order' => 'date',
    'posts_per_page' => $posts_per_page,
);
// для таксономий
if ((isset($_SESSION['cityfilter']) && $_SESSION['cityfilter'] != "" && !empty($_SESSION['cityfilter']))
    || (isset($_SESSION['typefilter']) && $_SESSION['typefilter'] != "" && !empty($_SESSION['typefilter']))
    || (isset($_SESSION['kindfilter']) && $_SESSION['kindfilter'] != "" && !empty($_SESSION['kindfilter']))) {
    $args['tax_query'] = array('relation' => 'AND');
}
//countryfilter
if ((isset($_SESSION['countryfilter']) || !empty($_SESSION['countryfilter'])) && $_SESSION['countryfilter'] != 0) {
    $args['tax_query'][] = array(
        'taxonomy' => 'education_country',
        'field' => 'term_id',
        'terms' => $_SESSION['countryfilter']
    );
}
//cityfilter
if ((isset($_SESSION['cityfilter']) || !empty($_SESSION['cityfilter'])) && $_SESSION['cityfilter'] != 0) {
    $args['tax_query'][] = array(
        'taxonomy' => 'education_country',
        'field' => 'term_id',
        'terms' => $_SESSION['cityfilter']
    );
}
//typefilter
if ((isset($_SESSION['typefilter']) || !empty($_SESSION['typefilter'])) && $_SESSION['typefilter'] != 0) {
    $args['tax_query'][] = array(
        'taxonomy' => 'type_of_property',
        'field' => 'term_id',
        'terms' => $_SESSION['typefilter']
    );
}
//kindfilter
if ((isset($_SESSION['kindfilter']) || !empty($_SESSION['kindfilter'])) && $_SESSION['kindfilter'] != 0) {
    $args['tax_query'][] = array(
        'taxonomy' => 'kind_of_property',
        'field' => 'term_id',
        'terms' => $_SESSION['kindfilter']
    );
}

// Конец для таксономий

//Сортировка по цене
if ((isset($_SESSION['min_price']) && $_SESSION['min_price'] != "")
    && (isset($_SESSION['max_price']) && $_SESSION['max_price'] != "" && !empty($_SESSION['max_price']))
) {
    $args['meta_query'] = array('relation' => 'AND');
}

//min_price
if (isset($_SESSION['min_price']) && $_SESSION['min_price'] != "") {
    $args['meta_query'][] = array(
        'key' => 'price',
        'value' => $_SESSION['min_price'],
        'type' => 'numeric',
        'compare' => '>='
    );
}
//min_price
if (isset($_SESSION['max_price']) && $_SESSION['max_price'] != "") {
    $args['meta_query'][] = array(
        'key' => 'price',
        'value' => $_SESSION['max_price'],
        'type' => 'numeric',
        'compare' => '<='
    );
}


//Конец сортировки по цене
$properties = new WP_Query($args);
if ($properties->have_posts()):
    while ($properties->have_posts()):
        $properties->the_post();
        $args_country = get_terms(array(
            'taxonomy' => 'education_country',
            'object_ids' => get_the_ID()
        ));
        $country = '0';
        $city = '0';
        foreach ($args_country as $c => $c1):
            if ($c1->parent == 0) {
                $country = $c1->name;
            } else {
                $city = $c1->name;
            }
        endforeach;
        $args_type_of_property = get_terms(array(
            'taxonomy' => 'type_of_property',
            'object_ids' => get_the_ID()
        ));
        $args_kind_of_property = get_terms(array(
            'taxonomy' => 'kind_of_property',
            'object_ids' => get_the_ID()
        ));
        ?>
        <div class="row">
            <a href="<?php the_permalink(); ?>" class="search_item link-search" target="_blank">
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
                            (<?php echo __('ID:', 'interavers');
                            echo get_the_ID(); ?>)
                        </div>
                        <div class="text-search_content text-left">
                            <div class="row">
                                <div class="col-md-6">
                                    <p class="single-property__info price_item">
                                        <span><?php echo __('Цена: ', 'interavers'); ?></span>
                                        <?php if (get_field('till_price')):
                                            ?>
                                            <?php echo __('от ', 'interavers'); ?>
                                            <span class="blue"><?php the_field('price') ?></span>
                                            <span class="blue"><?php the_field('value'); ?></span>
                                            <?php echo __('до - ', 'interavers'); ?>
                                            <span class="blue"><?php the_field('till_price'); ?></span>
                                            <span class="blue"><?php the_field('value'); ?></span>
                                            <?php
                                        else:
                                            ?>
                                            <span class="blue"><?php the_field('price'); ?></span>
                                            <span class="blue"><?php the_field('value'); ?></span>
                                            <?php
                                        endif;
                                        ?>
                                    </p>
                                    <p class="single-property__info">
                                        <span><?php echo __('Страна: ', 'interavers'); ?></span>
                                        <?php echo ($country) ? $country : '-'; ?></p>
                                    <p class="single-property__info">
                                        <span><?php echo __('Город: ', 'interavers'); ?></span>
                                        <?php echo ($city) ? $city : '-'; ?></p>
                                    <p class="single-property__info">
                                        <span><?php echo __('Вид недвиж.: ', 'interavers'); ?></span>
                                        <?php echo $args_type_of_property[0]->name; ?></p>
                                    <p class="single-property__info">
                                        <span><?php echo __('Тип операции: ', 'interavers'); ?></span>
                                        <?php echo $args_kind_of_property[0]->name; ?></p>
                                </div>
                                <div class="col-md-6">
                                    <p class="single-property__info">
                                        <span><?php echo __('Год постройки: ', 'interavers'); ?></span>
                                        <?php echo (get_field('build_year')) ? get_field('build_year') : '-'; ?>
                                    </p>
                                    <p class="single-property__info">
                                        <span><?php echo __('Площадь: ', 'interavers'); ?></span>
                                        <?php if (have_rows('square')):
                                            while (have_rows('square')):
                                                the_row();
                                                if (get_sub_field('square_till')):
                                                    ?>
                                                    <?php echo __('от ', 'interavers'); ?>
                                                    <?php the_sub_field('square_from') ?> м<sup>2</sup>
                                                    <?php echo __('до - ', 'interavers'); ?>
                                                    <?php the_sub_field('square_till'); ?> м<sup>2</sup>
                                                    <?php
                                                elseif (get_sub_field('square_from')):
                                                    ?>
                                                    <?php the_sub_field('square_from') ?> м<sup>2</sup>
                                                    <?php
                                                else:?>
                                                    -
                                                    <?php
                                                endif;
                                            endwhile;
                                        endif;
                                        ?>
                                    </p>
                                    <p class="single-property__info">
                                        <span><?php echo __('Меблировка: ', 'interavers'); ?></span>
                                        <?php the_field('furniture'); ?>
                                    </p>
                                    <p class="single-property__info">
                                        <span><?php echo __('Количество спален: ', 'interavers'); ?></span>
                                        <?php echo (get_field('count_room')) ? get_field('count_room') : '-'; ?>
                                    </p>
                                    <p class="single-property__info">
                                        <span><?php echo __('Номер лота: ', 'interavers'); ?></span>
                                        <?php echo get_the_ID(); ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div href="<?php the_permalink(); ?>"
                             class="btn-search"><?php echo __('Подробнее', 'Avers'); ?></div>
                    </div>
                </div>
            </a>
        </div>
        <?php
    endwhile;
    ?>
    <?php
    if ($properties->max_num_pages > 1):
        ?>
        <div id="pagination-property" class="pagination aligncenter text-center">
            <a href=""><span><?php echo __('Следующая страница', 'interavers'); ?></span><i
                        class="fa fa-arrow-circle-o-down fa-4x" aria-hidden="true"></i></a>
        </div>
        <?php
    endif;
//End pagination
endif;
?>