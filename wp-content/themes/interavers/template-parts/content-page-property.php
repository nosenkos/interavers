<div class="row">
    <div class="col-md-3"><?php get_sidebar('property-navigation'); ?></div>
    <div class="col-md-9">
        <?php //get_sidebar('breadcrumbs') ?>
        <img class="hide ajax-img" src="<?php echo get_stylesheet_directory_uri() ?>\assets\images\loader.gif" alt="">
        <div id="property" class="entry-content text-left">
            <?php
            if ((isset($_SESSION['res']) && $_SESSION['res'] != "" && !empty($_SESSION['res']))
                && ((isset($_SESSION['countryfilter']) && $_SESSION['countryfilter'] != "" && !empty($_SESSION['countryfilter']))
                    || (isset($_SESSION['cityfilter']) && $_SESSION['cityfilter'] != "" && !empty($_SESSION['cityfilter']))
                    || (isset($_SESSION['typefilter']) && $_SESSION['typefilter'] != "" && !empty($_SESSION['typefilter']))
                    || (isset($_SESSION['kindfilter']) && $_SESSION['kindfilter'] != "" && !empty($_SESSION['kindfilter']))
                    || (isset($_SESSION['currentPage']) && $_SESSION['currentPage'] != "" && !empty($_SESSION['currentPage'])))) :
                get_template_part('component-parts/component', 'property-filter');
            else:
                get_template_part('component-parts/component', 'property');
            endif;
            ?>
        </div><!-- .entry-content -->
        <div class="alert alert-danger alert-interavers" role="alert">Извините! По вашему запросу ничего не
            найдено!
        </div>
    </div>
</div>
