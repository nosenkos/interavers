<?php
get_header();

$blog_cats = get_terms('blog_tax');
?>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <?php get_sidebar('breadcrumbs');
                if (get_the_archive_title()) {
                    ?>
                    <div class="under_line text-center"><?php echo __('Блог', 'interavers'); ?></div>
                    <?php
                }
                ?>
                <ul class="blog_category list-inline list-unstyled text-center">
                    <li><a href="<?= get_bloginfo('url') . '/blog/'; ?>">Все рубрики</a></li>
                    <?php
                    foreach ($blog_cats as $cat) :
                        ?>
                        <li><a id="<?= $cat->term_id ?>"
                               href="<?= get_term_link($cat->term_id); ?>"><?= $cat->name ?></a></li>
                        <?php
                    endforeach;
                    ?>
                </ul>
                <?php if (have_posts()):
                    while (have_posts()):
                        the_post(); ?>
                        <div class="blog_single_title text-center">
                            <?php the_title(); ?>
                        </div>
                        <div class="blog_single_content">
                            <?php
                            if (have_rows('data_of_meet')):
                                while (have_rows('data_of_meet')):
                                    the_row(); ?>
                                    <div class="row" style="display: <?php the_field('enable_meet'); ?>">
                                        <div class="meet_block">
                                            <div class="data_meet">
                                                <p class="city"><?php the_sub_field('city_of_meet'); ?></p>
                                                <p class="date_of_meet"><?php echo __('Дата мероприятия:', 'intervasers'); ?>
                                                    <span><?php the_sub_field('date_of_meet') ?></span></p>
                                                <p class="time_of_meet"><?php echo __('Время:', 'interavers'); ?>
                                                    <span><?php the_sub_field('time_of_meet'); ?></span></p>
                                            </div>
                                            <div class="reg_block pull-right">
                                                <a href="#vopros-popup"
                                                   class="voprosik"><?php echo __('Регистрация', 'interavers'); ?></a>
                                            </div>
                                        </div>
                                    </div>
                                <?php endwhile;
                            endif;
                            if (get_the_post_thumbnail()):?>
                                <div class="blog_single_img text-center">
                                    <?php the_post_thumbnail('blog-single-thumb'); ?>
                                </div>
                                <?php
                            endif;
                            the_content(); ?>
                        </div>
                    <?php endwhile;
                endif; ?>
            </div>
        </div>
        <div style="display: none;">
            <div id="vopros-popup" class="form-pop">
                <div class="pop-tit"><?php echo __('РЕГИСТРАЦИЯ НА МЕРОПРИЯТИЕ', 'interavers'); ?></div>
                <?php echo do_shortcode('[contact-form-7 id="1422" title="Задать вопрос"]'); ?>
            </div>
        </div>
    </div>

<?php
get_footer();
?>