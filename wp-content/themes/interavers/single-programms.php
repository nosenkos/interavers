<?php
get_header();
$term = get_terms(array(
    'taxonomy' => 'kind_of_education',
    'object_ids' => get_the_ID()
));
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
?>
    <div class="container single-country">
        <main id="main" class="site-main site-content" role="main">
            <div class="row">
                <div class="col-md-3"><?php get_sidebar('navigation'); ?></div>
                <div class="col-md-9">
                    <?php get_sidebar('breadcrumbs'); ?>
                    <div class="under_line"><?php the_title(); ?></div>
                    <div class="row">
                        <div class="col-md-8">
                            <div class="single-country__gray-box">
                                <?php
                                the_post_thumbnail('single-programms', array('class' => 'pull-left'));
                                ?>
                                <p class="single-country__info"><span><?php echo __('Город:', 'interavers'); ?></span>
                                    <?php echo ($city) ? $city : '-'; ?></p>
                                <p class="single-country__info">
                                    <span><?php echo __('Тип программы:', 'interavers'); ?></span>
                                    <?php echo ($term) ? $term[0]->name : '-'; ?></p>
                                <p class="single-country__info"><span><?php echo __('Возраст:', 'interavers'); ?></span>
                                    <?php echo (get_field('age')) ? the_field('age') : '-'; ?></p>
                                <p class="single-country__info">
                                    <span><?php echo __('Продолжительность:', 'interavers'); ?></span>
                                    <?php echo (get_field('continueu')) ? the_field('continueu') : '-'; ?>
                                </p>
                                <p class="single-country__info">
                                    <span><?php echo __('Дата начала программ:', 'interavers'); ?></span>
                                    <?php echo (get_field('start_date')) ? the_field('start_date') : '-'; ?>
                                </p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="single-country__cta text-center">
                                <p><?php echo __('Заинтересовались?', 'interavers'); ?></p>
                                <p class="single-country__cta___light-blue-color"><?php echo __('Interavers ответит на все вопросы', 'interavers'); ?></p>
                                <?php
                                if (have_rows('phone', 12)):
                                    while (have_rows('phone', 12)):
                                        the_row();
                                        ?>
                                        <p class="single-country__cta___phone"><?php the_sub_field('mob_phone') ?></p>
                                        <?php
                                    endwhile;
                                endif;
                                ?>
                                <a href="#left-request" class="btn-blue left-request">Оставить запрос</a>
                                <a href="<?php echo get_post_type_archive_link('reviews'); ?>" class="green-text">Читать
                                    все
                                    отзывы</a>
                            </div>
                        </div>
                    </div>
                    <?php if (get_field('photogallery')): ?>
                        <div class="under_line"><?php echo __('ФОТОГАЛЕРЕЯ', 'interavers'); ?></div>
                        <div class="row">
                            <div class="single-country__photogallery">
                                <div class="photogallery__head-slider">
                                    <?php
                                    foreach (get_field('photogallery') as $image):?>
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
                                        foreach (get_field('photogallery') as $image):?>
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
                        <div class="under_line"><?php echo __('ОПИСАНИЕ', 'interavers'); ?></div>
                        <div><?php the_content(); ?></div>
                    <?php endif ?>
                </div>
            </div>
            <div style="display: none;">
                <div id="left-request" class="form-pop">
                    <div class="pop-tit"><?php echo __('ОСТАВИТЬ ЗАПРОС', 'interavers'); ?></div>
                    <?php echo do_shortcode('[contact-form-7 id="1636" title="Оставить запрос"]'); ?>
                </div>
            </div>
        </main>
    </div>

<?php
get_footer();
?>