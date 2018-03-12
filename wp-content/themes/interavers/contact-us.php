<?php
/*

    Template Name: Contact Us

*/

get_header();
?>
<div id="primary" class="content-area container contact-us">
    <main id="main" class="site-main" role="main">
        <?php
        if (get_the_title()):
            ?>
            <h1 class="under_line">
                <?php
                the_title();
                ?>
            </h1>
            <?php
        endif;
        ?>
        <div class="container-contact">
            <div class="row">
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="container-contact-inner-pad map">
                        <p class="uppercase our-contacts">
                            <?php
                            echo __('Наши Контакты', 'interavers');
                            ?>
                        </p>
                        <div class="row">
                            <div class="col-md-2">
                                <p class="title_address">
                                    <?php
                                    echo __('Адрес:', 'interavers');
                                    ?>
                                </p>
                            </div>
                            <div class="col-md-10">
                                <?php
                                if (get_field('address')):
                                    ?>
                                    <?php the_field('address') ?>
                                    <?php
                                endif;
                                ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">
                                <p class="title_address">
                                    <?php
                                    echo __('Телефон:', 'interavers');
                                    ?>
                                </p>
                            </div>
                            <div class="col-md-10">
                                <?php
                                if (have_rows('phone')):
                                    while (have_rows('phone')):
                                        the_row();
                                        ?>
                                        <p><?php the_sub_field('mob_phone') ?></p>
                                        <?php
                                    endwhile;
                                endif;
                                ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">
                                <p class="title_address">
                                    <?php
                                    echo __('Email:', 'interavers');
                                    ?>
                                </p>
                            </div>
                            <div class="col-md-10">
                                <?php
                                if (have_rows('e-mail')):
                                    while (have_rows('e-mail')):
                                        the_row();
                                        ?>
                                        <p>
                                            <a href="mailto:<?php the_sub_field('e-mail_single') ?>"><?php the_sub_field('e-mail_single') ?></a>
                                        </p>
                                        <?php
                                    endwhile;
                                endif;
                                ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">
                                <p class="title_address">
                                    <?php
                                    echo __('Web:', 'interavers');
                                    ?>
                                </p>
                            </div>
                            <div class="col-md-10">
                                <?php
                                if (have_rows('web')):
                                    while (have_rows('web')):
                                        the_row();
                                        ?>
                                        <p>
                                            <a href="<?php the_sub_field('web_single') ?>"><?php the_sub_field('web_single') ?></a>
                                        </p>
                                        <?php
                                    endwhile;
                                endif;
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <?php
                    $location = get_field('map');
                    if (!empty($location)):
                        ?>
                        <div class="acf-map map">
                            <div class="marker" data-lat="<?php echo $location['lat']; ?>"
                                 data-lng="<?php echo $location['lng']; ?>"></div>
                        </div>
                        <?php
                    endif; ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8 col-md-offset-2 col-sm-12 col-sm-offset-0">
                <div class="contact-form-contact-us">
                    <div class="contact-form-contact-us_title under_line text-center"><?php echo __('Cвяжитесь с нами','interavers')?></div>
                    <?php echo do_shortcode('[contact-form-7 id="1524" title="Контакты"]');?>
                </div>
            </div>
        </div>

    </main><!-- #main -->
</div><!-- #primary -->
<?php
get_footer();
?>


