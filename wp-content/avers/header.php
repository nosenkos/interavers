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
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11">

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<header id="masthead" class="site-header text-center" role="banner">
    <div class="header-top">
        <div class="container">
            <div class="row">
                <div class="col-md-5 text-left">
                    <i class="fa fa-map-marker" aria-hidden="true"></i>
                    <p><?php the_field('address_header','option') ?></p>
                </div>
                <div class="col-md-7 text-right">
                    <?php if(have_rows('contacts_header','options')):
                        while(have_rows('contacts_header','options')):
                            the_row(); ?>
                            <div class="contacts_header">
                                <img src="<?php echo get_sub_field('contacts_header_image');?>" alt="">
                                <p><?php echo get_sub_field('contacts_header_number'); ?></p>
                            </div>
                        <?php 	endwhile;
                    endif;
                    if(get_field('contacts_header_mail','options')):?>
                        <div class="contacts_header">
                            <a href="mailto:<?php echo get_field('contacts_header_mail','options');?>"><?php echo get_field('contacts_header_mail','options'); ?></a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <nav class="navbar navbar-default">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?php bloginfo('url');?>">
                    <img src="<?php echo get_header_image();?>" alt="">
                </a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse text-center" id="bs-example-navbar-collapse-1">
                <?php wp_nav_menu(array('menu'=>'Главное','menu_class'=>'pull-right main-menu list-unstyled list-inline')); ?>
            </div><!-- /.navbar-collapse -->
        </nav>
    </div>
    <div class="header-bottom">
        <?php if(is_front_page() || is_page()): ?>
        <div class="container">
            <div class="row">
                <?php wp_nav_menu(array('menu'=>'Подменю','menu_class'=>'text-center under-main-menu list-unstyled list-inline')); ?>
            </div>
        </div>
    </div>
</header><!-- #masthead -->
<div id="content" class="site-content">
    <?php elseif (is_post_type_archive(blog) || is_tax(blog_tax) || is_singular(blog)): ?>
    <div class="header-bottom__red">
        <div class="container">
            <div class="row">
                <?php wp_nav_menu(array('menu'=>'Подменю','menu_class'=>'text-center under-main-menu list-unstyled list-inline')); ?>
            </div>
        </div>
    </div>
</div>
</header><!-- #masthead -->

<div id="content" class="site-content site-content__red">
    <?php endif; ?>
    <!-- </div>
        </header>#masthead

        <div id="content" class="site-content"> -->
