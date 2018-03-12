<?php
get_header();
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
    <div class="container single-property">
        <main id="main" class="site-main site-content" role="main">
            <div class="row">
                <div class="col-md-3"><?php get_sidebar('property-navigation'); ?></div>
                <div class="col-md-9">
                    <?php get_sidebar('breadcrumbs'); ?>
                    <div class="under_line"><?php the_title(); ?> (<?php echo __('ID:', 'interavers');
                        echo get_the_ID(); ?>)
                    </div>
                    <div class="row">
                        <div class="col-md-8">
                            <div class="single-property__gray-box">
                                <?php
                                the_post_thumbnail('single-programms', array('class' => 'pull-left'));
                                ?>
                                <p class="single-property__info price_item">
                                    <span><?php echo __('Цена: ', 'interavers'); ?></span>
                                    <?php if (get_field('till_price')):
                                        ?>
                                        <?php echo __('от ', 'interavers'); ?>
                                        <span class="blue"><?php the_field('price') ?></span> <span
                                            class="blue"><?php the_field('value'); ?></span>
                                        <?php echo __('до - ', 'interavers'); ?>
                                        <span class="blue"><?php the_field('till_price'); ?></span> <span
                                            class="blue"><?php the_field('value'); ?></span>
                                        <?php
                                    else:
                                        ?>
                                        <span class="blue"><?php the_field('price') ?></span> <span
                                            class="blue"><?php the_field('value'); ?></span>
                                        <?php
                                    endif;
                                    ?>
                                </p>
                                <p class="single-property__info">
                                    <span><?php echo __('Страна: ', 'interavers'); ?></span>
                                    <?php echo ($country) ? $country : '-'; ?></p>
                                <p class="single-property__info"><span><?php echo __('Город: ', 'interavers'); ?></span>
                                    <?php echo ($city) ? $city : '-'; ?></p>
                                <p class="single-property__info">
                                    <span><?php echo __('Вид недвиж.: ', 'interavers'); ?></span>
                                    <?php echo $args_type_of_property[0]->name; ?></p>
                                <p class="single-property__info">
                                    <span><?php echo __('Тип операции: ', 'interavers'); ?></span>
                                    <?php echo $args_kind_of_property[0]->name; ?></p>
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
                                    <?php echo get_the_ID() ?>
                                </p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="single-property__cta text-center">
                                <p><?php echo __('Заинтересовались?', 'interavers'); ?></p>
                                <p class="single-property__cta___light-blue-color"><?php echo __('Interavers ответит на все вопросы', 'interavers'); ?></p>
                                <?php
                                if (have_rows('phone', 12)):
                                    while (have_rows('phone', 12)):
                                        the_row();
                                        ?>
                                        <p class="single-property__cta___phone"><?php the_sub_field('mob_phone') ?></p>
                                        <?php
                                    endwhile;
                                endif;
                                ?>
                                <p class=""><?php echo __('Для получения полной актуальной информации по данному объекту - заполните форму!', 'interavers'); ?></p>
                                <a href="#left-request" class="btn-blue left-request">Получить</a>
                                <a href="<?php echo get_post_type_archive_link('reviews'); ?>" class="green-text">Читать
                                    все
                                    отзывы</a>
                            </div>
                        </div>
                    </div>
                    <?php if (get_field('add_photo')): ?>
                        <div class="single-property_title">
                            <?php echo __('Дополнительные фото', 'interavers'); ?>
                        </div>
                        <div class="row">
                            <div class="single-property__photogallery">
                                <div class="photogallery__head-slider">
                                    <?php
                                    foreach (get_field('add_photo') as $image):?>
                                        <div>
                                            <img src="<?php echo $image['sizes']['slider-country']; ?>"
                                                 class="photogallery__head-slider_img" alt="">
                                        </div>
                                        <?php
                                    endforeach;
                                    ?>
                                </div>
                                <div class="photogallery__small-slider-position">
                                    <div class="small-slider-position__small-slider">
                                        <?php
                                        foreach (get_field('add_photo') as $image):?>
                                            <div class="text-center">
                                                <img src="<?php echo $image['sizes']['image-gallery-small-country']; ?>"
                                                     class="small-slider-position__small-slider_img" alt="">
                                            </div>
                                            <?php
                                        endforeach;
                                        ?>
                                    </div>
                                </div>
                                <a href="#" class="next-block arrows">
                                    <img src="<?php echo get_template_directory_uri() ?>/assets/images/Nextphone.png"
                                         alt="">
                                </a>
                                <a href="#" class="prev-block arrows">
                                    <img src="<?php echo get_template_directory_uri() ?>/assets/images/Prevphone.png"
                                         alt="">
                                </a>
                            </div>
                        </div>
                    <?php endif ?>
                    <?php if (get_the_content()): ?>
                        <div class="single-property_title">
                            <?php echo __('ОПИСАНИЕ', 'interavers'); ?>
                        </div>
                        <div><?php the_content(); ?></div>
                    <?php endif ?>
                </div>
            </div>
            <div style="display: none;">
                <div id="left-request" class="form-pop">
                    <div class="pop-tit"><?php echo __('ПОЛУЧИТЕ ДОСТУП', 'interavers'); ?></div>
                    <?php echo do_shortcode('[contact-form-7 id="1648" title="Получить доп.информацию"]'); ?>
                </div>
            </div>
        </main>
    </div>

<?php
get_footer();
?>