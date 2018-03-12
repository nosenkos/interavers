<?php
$args_rent = array(
    'post_type' => 'property',
    'posts_per_page' => 4,
    'kind_of_property' => 'rent',
    'orderby' => 'post_date',
    'meta_key' => 'featured_property',
    'meta_compare' => '=',
    'meta_value' => 1

);
$property_rent = new WP_Query($args_rent);

$args_sell = array(
    'post_type' => 'property',
    'posts_per_page' => 4,
    'kind_of_property' => 'sell',
    'orderby' => 'post_date',
    'meta_key' => 'featured_property',
    'meta_compare' => '=',
    'meta_value' => 1

);
$property_sell = new WP_Query($args_sell);

$property = new WP_Query(array(
    'post_type' => 'property',
    'posts_per_page' => -1
));
$property_id = array();
if ($property->have_posts()):
    while ($property->have_posts()):
        $property->the_post();
        $property_id[] = get_the_ID();
    endwhile;
endif;

$all_countries = get_terms(array(
    'taxonomy' => 'education_country',
    'object_ids' => $property_id,
    'pad_counts' => 1
));
?>
<?php
if ($all_countries):
    ?>
    <div class="row">
        <div class="property_title">
            <?php echo __('НЕДВИЖИМОСТЬ В СТРАНАХ', 'interavers'); ?>
        </div>
        <?php
        foreach ($all_countries as $all_country):
            if ($all_country->parent == 0):
                $image = get_field('tax_image', $all_country->taxonomy . '_' . $all_country->term_id);
                ?>
                <div class="col-md-2 property-country">
                    <a href="<?php echo get_page_link(1609); ?>" data-country-id="<?php echo $all_country->term_id; ?>"
                       class="property-country_link">
                        <div class="b_link_img">
                            <img src="<?php echo ($image) ? $image['sizes']['blog-small'] : get_stylesheet_directory_uri() . '/assets/images/placeholder.png'; ?>"
                                 alt="">
                        </div>
                        <div class="b_link_content">
                            <div class="b_link_content_title property_country_equal">
                                <?php echo $all_country->name; ?>
                            </div>
                        </div>
                    </a>
                </div>
                <?php
            endif;
        endforeach;
        ?>
    </div>
    <?php
endif;
if ($property_rent->have_posts()):
    ?>
    <div class="row">
        <div class="property_title">
            <?php echo __('Горячие предложения - АРЕНДА', 'interavers'); ?>
        </div>
        <?php
        while ($property_rent->have_posts()):
            $property_rent->the_post();
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
            ?>
            <div class="col-md-6 property-item property_equal">
                <a href="<?php the_permalink(); ?>" class="property_link" target="_blank">
                    <div class="property-item__image">
                        <?php
                        if (get_the_post_thumbnail()):
                            the_post_thumbnail('property-small', array('class' => 'property-item__image_img'));
                        else:
                            ?>
                            <img class="property-item__image_img"
                                 src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/placeholder.png"
                                 alt="">
                            <?php
                        endif;
                        ?>
                    </div>
                    <div class="property-item__content">
                        <div class="property-item__content_title property_title_equal">
                            <?php the_title(); ?> (<?php echo __('ID:', 'interavers');
                            echo get_the_ID(); ?>)
                        </div>
                        <?php
                        if (get_field('price')):?>
                            <div class="property-item__content_price">
                                <?php
                                echo __('Цена: ', 'interavers');
                                if (get_field('till_price')):
                                    ?>
                                    <div class="price_item">
                                        <?php echo __('от ', 'interavers'); ?>
                                        <span><?php the_field('price'); ?></span> <span
                                                class="blue"><?php the_field('value'); ?></span>
                                        <?php echo __('до - ', 'interavers'); ?>
                                        <span><?php the_field('till_price'); ?></span> <span
                                                class="blue"><?php the_field('value'); ?></span>
                                    </div>
                                    <?php
                                else:
                                    ?>
                                    <div class="price_item">
                                        <span><?php the_field('price'); ?></span> <span
                                                class="blue"><?php the_field('value'); ?></span>
                                    </div>
                                    <?php
                                endif;
                                ?>
                            </div>
                            <?php
                        endif;
                        if ($args_country):
                            ?>
                            <div class="property-item__content_country">
                                <?php
                                echo __('Страна: ', 'interavers');
                                ?>
                                <div class="country_item">
                                    <?php echo ($country) ? $country : '-'; ?>
                                </div>
                            </div>
                            <div class="property-item__content_city">
                                <?php
                                echo __('Город: ', 'interavers');
                                ?>
                                <div class="city_item">
                                    <?php echo ($city) ? $city : '-'; ?>
                                </div>
                            </div>
                            <?php
                        endif;
                        if ($args_type_of_property):
                            ?>
                            <div class="property-item__content_type_of_property">
                                <?php
                                echo __('Вид недвиж.: ', 'interavers');
                                ?>
                                <div class="type_of_property_item">
                                    <?php echo $args_type_of_property[0]->name; ?>
                                </div>
                            </div>
                            <?php
                        endif;
                        ?>
                    </div>
                </a>
            </div>
            <?php
        endwhile;
        ?>
    </div>
    <?php
endif;
wp_reset_postdata();
if ($property_sell->have_posts()):
    ?>
    <div class="row">
        <div class="property_title">
            <?php echo __('Горячие предложения - Продажа', 'interavers'); ?>
        </div>
        <?php
        while ($property_sell->have_posts()):
            $property_sell->the_post();
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
            ?>
            <div class="col-md-6 property-item property_equal">
                <a href="<?php the_permalink(); ?>" class="property_link" target="_blank">
                    <div class="property-item__image">
                        <?php
                        if (get_the_post_thumbnail()):
                            the_post_thumbnail('property-small', array('class' => 'property-item__image_img'));
                        else:
                            ?>
                            <img class="property-item__image_img"
                                 src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/placeholder.png"
                                 alt="">
                            <?php
                        endif;
                        ?>
                    </div>
                    <div class="property-item__content">
                        <div class="property-item__content_title property_title_equal">
                            <?php the_title(); ?> (<?php echo __('ID:', 'interavers');
                            echo get_the_ID(); ?>)

                        </div>
                        <?php
                        if (get_field('price')):?>
                            <div class="property-item__content_price">
                                <?php
                                echo __('Цена: ', 'interavers');
                                if (get_field('till_price')):
                                    ?>
                                    <div class="price_item">
                                        <?php echo __('от ', 'interavers'); ?>
                                        <span><?php the_field('price'); ?></span> <span
                                                class="blue"><?php the_field('value'); ?></span>
                                        <?php echo __('до - ', 'interavers'); ?>
                                        <span><?php the_field('till_price'); ?></span> <span
                                                class="blue"><?php the_field('value'); ?></span>
                                    </div>
                                    <?php
                                else:
                                    ?>
                                    <div class="price_item">
                                        <span><?php the_field('price'); ?></span> <span
                                                class="blue"><?php the_field('value'); ?></span>
                                    </div>
                                    <?php
                                endif;
                                ?>
                            </div>
                            <?php
                        endif;
                        if ($args_country):
                            ?>
                            <div class="property-item__content_country">
                                <?php
                                echo __('Страна: ', 'interavers');
                                ?>
                                <div class="country_item">
                                    <?php echo ($country) ? $country : '-'; ?>
                                </div>
                            </div>
                            <div class="property-item__content_city">
                                <?php
                                echo __('Город: ', 'interavers');
                                ?>
                                <div class="city_item">
                                    <?php echo ($city) ? $city : '-'; ?>
                                </div>
                            </div>
                            <?php
                        endif;
                        if ($args_type_of_property):
                            ?>
                            <div class="property-item__content_type_of_property">
                                <?php
                                echo __('Вид недвиж.: ', 'interavers');
                                ?>
                                <div class="type_of_property_item">
                                    <?php echo $args_type_of_property[0]->name; ?>
                                </div>
                            </div>
                            <?php
                        endif;
                        ?>
                    </div>
                </a>
            </div>
            <?php
        endwhile;
        ?>
    </div>
    <?php
endif;
wp_reset_postdata();
if (get_the_content()):
    ?>
    <div class="row">
        <div class="property_title">
            <?php echo __('НЕДВИЖИМОСТЬ ЗА РУБЕЖОМ', 'interavers'); ?>
        </div>
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