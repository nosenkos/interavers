<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package interavers
 */

get_header(); ?>

    <section id="primary" class="container content-area search">
        <main id="main" class="site-main" role="main">
            <div class="row">
                <div class="col-md-3"><?php
                get_sidebar('navigation');
                    ?></div>
                <div class="col-md-9">

                    <?php
                    if (have_posts()) : ?>

                        <header class="page-header">
                            <h1 class="page-title under_line"><?php echo __('Результат поиска: ', 'interavers'); ?></h1>
                        </header><!-- .page-header -->

                        <?php
                        /* Start the Loop */
                        while (have_posts()) : the_post();

                            /**
                             * Run the loop for the search to output the results.
                             * If you want to overload this in a child theme then include a file
                             * called content-search.php and that will be used instead.
                             */
                            get_template_part('template-parts/content', 'search');

                        endwhile;?>
                        <div class="pagination aligncenter text-center">
                            <?php
                            the_posts_pagination(array(
                                'mid_size' => 2,
                                'prev_text' => __('<i class="fa fa-long-arrow-left" aria-hidden="true"></i>', 'interavers'),
                                'next_text' => __('<i class="fa fa-long-arrow-right" aria-hidden="true"></i>', 'interavers'),
                            ));
                            ?>
                        </div>
                        <?php

                    else :

                        get_template_part('template-parts/content', 'none');
                        ?>
                        <?php

                    endif; ?>
                </div>
            </div>
        </main><!-- #main -->
    </section><!-- #primary -->

<?php
get_footer();
