<?php
get_header();
?>
    <div class="education_country container">
        <div class="row">
            <div class="col-md-3"><?php get_sidebar('navigation'); ?></div>
            <div class="col-md-9">
                <?php if (isset($_GET['country'])):
                    get_template_part('component-parts/component', 'country-education');
                elseif (isset($_GET['youth'])):
                    get_template_part('component-parts/component', 'country-youth');
                elseif (isset($_GET['abroad_work'])):
                    get_template_part('component-parts/component', 'country-work');
                else:
                    get_template_part('component-parts/component', 'country');
                endif; ?>
            </div>
        </div>
    </div>

<?php
get_footer();
?>