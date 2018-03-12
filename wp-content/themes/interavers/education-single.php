<?php
/*

    Template Name: Single Education Programs

*/

get_header();
?>
<div id="primary" class="content-area container education-single">
    <main id="main" class="site-main site-content" role="main">
        <?php
        while (have_posts()) : the_post();

            get_template_part('template-parts/content', 'page-education-single');

            // If comments are open or we have at least one comment, load up the comment template.
            if (comments_open() || get_comments_number()) :
                comments_template();
            endif;

        endwhile; // End of the loop.
        ?>

    </main><!-- #main -->
</div><!-- #primary -->
<?php
get_sidebar('partners');
get_footer();
?>

