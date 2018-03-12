<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package interavers
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11">

    <?php wp_head(); ?>

    <!-- Facebook Pixel Code -->
    <script>
        !function(f,b,e,v,n,t,s)
        {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
            n.callMethod.apply(n,arguments):n.queue.push(arguments)};
            if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
            n.queue=[];t=b.createElement(e);t.async=!0;
            t.src=v;s=b.getElementsByTagName(e)[0];
            s.parentNode.insertBefore(t,s)}(window,document,'script',
            'https://connect.facebook.net/en_US/fbevents.js');
        fbq('init', '131486130875626');
        fbq('track', 'PageView');

        fbq('track', 'Lead');
    </script>
    <noscript>
        <img height="1" width="1"
             src="https://www.facebook.com/tr?id=131486130875626&ev=PageView
&noscript=1"/>
    </noscript>
    <!-- End Facebook Pixel Code -->
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-110533327-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-110533327-1');
    </script>
</head>

<body <?php body_class(); ?>>

<header id="masthead" class="site-header text-center" role="banner">
    <div class="header-top">
        <div class="container">
            <div class="row">
                <div class="col-md-9">
                    <nav class="navbar navbar-default">
                        <!-- Brand and toggle get grouped for better mobile display -->
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                                    data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                            <a class="navbar-brand logo" href="<?php bloginfo('url'); ?>">
                                <img src="<?php echo get_header_image(); ?>" alt="">
                            </a>
                        </div>
                        <!-- Collect the nav links, forms, and other content for toggling -->
                        <div class="collapse navbar-collapse text-center nav-nabvar" id="bs-example-navbar-collapse-1">
                            <?php wp_nav_menu(array('menu' => 'Главное', 'menu_class' => 'pull-right main-menu list-unstyled list-inline')); ?>
                        </div><!-- /.navbar-collapse -->
                    </nav>
                </div>
                <div class="col-md-3 text-center">
                    <a href="#consult-popup" class="free-consultation btn btn-blue"><?php echo __('Бесплатная консультация','interavers');?></a>
                </div>
            </div>
            <div style="display: none;">
                <div id="consult-popup" class="form-pop">
                    <div class="pop-tit"><?php echo __('Бесплатная консультация', 'interavers'); ?></div>
                    <?php echo do_shortcode('[contact-form-7 id="1526" title="Бесплатная консультация"]'); ?>
                </div>
            </div>
        </div>
    </div>
    <?php if (get_field("header_bg_image", 'options')) {
        $bg = get_field("header_bg_image", 'options');
    }
    ?>
    <div class="header-mid" style="background: url(<?= $bg['url'] ?>) no-repeat center center;background-size: cover;">
        <div class="white-bg">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <h1><?php (get_field('header_title', 'options')) ? the_field('header_title', 'options') : "" ?></h1>
                        <?php
                        if (have_rows('header_btn', 'options')):
                            while (have_rows('header_btn', 'options')):
                                the_row();
                                if ($post_object = get_sub_field('header_btn-link')) {
                                    $post = $post_object;
                                    setup_postdata($post);
                                    ?>
                                    <a href="<?php the_permalink(); ?>"
                                       class="btn btn-yellow"><?= get_sub_field('header_btn-text') ?></a>
                                    <?php
                                    wp_reset_postdata();
                                }
                            endwhile;
                        endif;
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="header-bottom">
        <div class="container">
            <div class="row">
                <?php wp_nav_menu(array('menu' => 'Подменю', 'menu_class' => 'text-center under-main-menu list-unstyled list-inline')); ?>
            </div>
        </div>
    </div>
</header><!-- #masthead -->
<div id="content" class="site-content">
