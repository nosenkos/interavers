<?php
/*
The sidebar containing navigation
*/

$countries = get_terms('education_country');

?>

<aside id="navigation" class="nav-area navigation">
    <div class="property-navigation_search">
        <?php echo do_shortcode('[wpdreams_ajaxsearchlite]'); ?>
    </div>
    <div class="navigation_title"><?= __('СТРАНЫ', 'interavers'); ?></div>
    <ul class="navigation__list">
        <?php foreach ($countries as $country):
            if ($country->parent == 0):
                //Education block
                $kind_ed_args = array(
                    'post_type' => 'country',
                    'tax_query' => array(
                        array(
                            'taxonomy' => 'education_country',
                            'field' => 'term_id',
                            'terms' => $country->term_id
                        )
                    )
                );

                $kind_ed = new WP_Query($kind_ed_args);
                //End Education block
                //Youth Program
                $youth_args = array(
                    'post_type' => 'youth_program',
                    'tax_query' => array(
                        array(
                            'taxonomy' => 'education_country',
                            'field' => 'term_id',
                            'terms' => $country->term_id
                        )
                    )
                );

                $youth = new WP_Query($youth_args);
                //End youth program
                //Work
                $work_args = array(
                    'post_type' => 'abroad_work',
                    'tax_query' => array(
                        array(
                            'taxonomy' => 'education_country',
                            'field' => 'term_id',
                            'terms' => $country->term_id
                        )
                    )
                );

                $work_abroad = new WP_Query($work_args);
                if ($kind_ed->have_posts() || $youth->have_posts() || $work_abroad->have_posts()):
                    ?>
                    <li class="navigation__list_item"><a
                                href="<?php echo get_term_link($country->term_id); ?>"><?php echo $country->name ?></a>
                        <?php
                        if ($kind_ed->have_posts() || $youth->have_posts() || $work_abroad->have_posts()):
                            ?>
                            <ul class="sub-navigation-menu hidden hiddenvisibility">
                                <?php
                                if ($kind_ed->have_posts()):
                                    ?>
                                    <li class="sub-navigation-menu_item"><a
                                                href="<?php echo get_term_link($country->term_id); ?>?country"><?php echo __('Образование', 'interavers'); ?></a>
                                    </li>
                                    <?php
                                endif;
                                ?>
                                <?php
                                if ($youth->have_posts()):
                                    ?>
                                    <li class="sub-navigation-menu_item"><a
                                                href="<?php echo get_term_link($country->term_id); ?>?youth"><?php echo __('Молодёжные программы', 'interavers'); ?></a>
                                    </li>
                                    <?php
                                endif;
                                ?>
                                <?php
                                if ($work_abroad->have_posts()):
                                    ?>
                                    <li class="sub-navigation-menu_item"><a
                                                href="<?php echo get_term_link($country->term_id); ?>?abroad_work"><?php echo __('Работа', 'interavers'); ?></a>
                                    </li>
                                    <?php
                                endif;
                                ?>
                            </ul>
                            <?php
                        endif;
                        ?>
                    </li>
                    <?php
                endif;
            endif;
        endforeach; ?>
    </ul>
    <?php //wp_nav_menu(array('menu'=>'Навигация','menu_class'=>'nav-main-menu list-unstyled')); ?>
</aside>
