<?php
/*AJAX for select*/
add_action("wp_ajax_loadCities", "loadCities");
add_action("wp_ajax_nopriv_loadCities", "loadCities");

function loadCities()
{
    $_SESSION['currentCity'] = $_POST['currentCity'];
    $cities = get_terms(array(
        'taxonomy' => 'education_country',
        'orderby' => 'name',
        'order' => 'ASC'
    ));
    ob_start();
    echo "<option value='0'>Все города</option>";
    $count = 0;
    if ($_SESSION['currentCity'] != 0) {
        foreach ($cities as $city) {
            if ($city->parent == $_SESSION['currentCity']) {
                $count++;
                echo "<option value=" . $city->term_id . ">" . $city->name . "</option>";
            }
        }
    }
    $_SESSION['countCity'] = $count;
    $result = ob_get_contents();
    ob_clean();
    wp_send_json(array(
        'res' => $result,
        'count' => $count
    ));
}

/* End select AJAX*/

/*Filter AJAX*/

add_action('init', 'start_session', 1);
function start_session()
{
    if (!session_id()) {
        session_start();
    }
}

add_action('wp_logout', 'end_session');
add_action('wp_login', 'end_session');
function end_session()
{
    session_destroy();
}

add_action("wp_ajax_cleanFilter", "clear_function");
add_action("wp_ajax_nopriv_cleanFilter", "clear_function");

function clear_function()
{
    session_unset();

    wp_send_json(array(
        'link' => get_page_link(1609),
    ));
}

add_action("wp_ajax_getCurrentPage", "getCurrentPage_function");
add_action("wp_ajax_nopriv_getCurrentPage", "getCurrentPage_function");

function getCurrentPage_function()
{

    wp_send_json(array(
        'currentPage' => $_SESSION['currentPage'],
    ));
}

add_action('wp_ajax_myfilter', 'filter_function');
add_action('wp_ajax_nopriv_myfilter', 'filter_function');
function filter_function()
{
    $count_posts = 6;
    $_SESSION['currentPage'] = (isset($_POST['currentPage']) && $_POST['currentPage'] != 0) ? (int)$_POST['currentPage'] : 0;
    $offset = (isset($_SESSION['currentPage']) && $_SESSION['currentPage'] != 0) ? $_SESSION['currentPage'] * $count_posts : 0;
    if ($_POST['countryfilter'] != "") {
        $_SESSION['countryfilter'] = $_POST['countryfilter'];
    }
    if ($_POST['countryfilter'] == 0 && $_POST['cityfilter'] == "") {
        $_SESSION['cityfilter'] = 0;
    } elseif ($_POST['cityfilter'] != "") {
        $_SESSION['cityfilter'] = $_POST['cityfilter'];
    }
    if ($_POST['typefilter'] != "") {
        $_SESSION['typefilter'] = $_POST['typefilter'];
    }
    if ($_POST['kindfilter'] != "") {
        $_SESSION['kindfilter'] = $_POST['kindfilter'];
    }
    if ($_POST['min_price'] != "") {
        $_SESSION['min_price'] = $_POST['min_price'];
    }
    if ($_POST['max_price'] != "") {
        $_SESSION['max_price'] = $_POST['max_price'];
    }

    //new WP_Query
    $args = array(
        'post_type' => 'property',
        'order' => 'date',
        'offset' => $offset,
        'posts_per_page' => $count_posts,
    );
    // для таксономий
    if ((isset($_SESSION['cityfilter']) && $_SESSION['cityfilter'] != "" && !empty($_SESSION['cityfilter']))
        || (isset($_SESSION['typefilter']) && $_SESSION['typefilter'] != "" && !empty($_SESSION['typefilter']))
        || (isset($_SESSION['kindfilter']) && $_SESSION['kindfilter'] != "" && !empty($_SESSION['kindfilter']))) {
        $args['tax_query'] = array('relation' => 'AND');
    }
    //countryfilter
    if ((isset($_SESSION['countryfilter']) || !empty($_SESSION['countryfilter'])) && $_SESSION['countryfilter'] != 0) {
        $args['tax_query'][] = array(
            'taxonomy' => 'education_country',
            'field' => 'term_id',
            'terms' => $_SESSION['countryfilter']
        );
    }
    //cityfilter
    if ((isset($_SESSION['cityfilter']) || !empty($_SESSION['cityfilter'])) && $_SESSION['cityfilter'] != 0) {
        $args['tax_query'][] = array(
            'taxonomy' => 'education_country',
            'field' => 'term_id',
            'terms' => $_SESSION['cityfilter']
        );
    }
    //typefilter
    if ((isset($_SESSION['typefilter']) || !empty($_SESSION['typefilter'])) && $_SESSION['typefilter'] != 0) {
        $args['tax_query'][] = array(
            'taxonomy' => 'type_of_property',
            'field' => 'term_id',
            'terms' => $_SESSION['typefilter']
        );
    }
    //kindfilter
    if ((isset($_SESSION['kindfilter']) || !empty($_SESSION['kindfilter'])) && $_SESSION['kindfilter'] != 0) {
        $args['tax_query'][] = array(
            'taxonomy' => 'kind_of_property',
            'field' => 'term_id',
            'terms' => $_SESSION['kindfilter']
        );
    }

    // Конец для таксономий

    //Сортировка по цене
    if ((isset($_SESSION['min_price']) && $_SESSION['min_price'] != "")
        && (isset($_SESSION['max_price']) && $_SESSION['max_price'] != "" && !empty($_SESSION['max_price']))
    ) {
        $args['meta_query'] = array('relation' => 'AND');
    }

    //min_price
    if (isset($_SESSION['min_price']) && $_SESSION['min_price'] != "") {
        $args['meta_query'][] = array(
            'key' => 'price',
            'value' => $_SESSION['min_price'],
            'type' => 'numeric',
            'compare' => '>='
        );
    }
    //min_price
    if (isset($_SESSION['max_price']) && $_SESSION['max_price'] != "") {
        $args['meta_query'][] = array(
            'key' => 'price',
            'value' => $_SESSION['max_price'],
            'type' => 'numeric',
            'compare' => '<='
        );
    }


    //Конец сортировки по цене
    $properties = new WP_Query($args);
    ob_start();
    if ($properties->have_posts()):
        while ($properties->have_posts()):
            $properties->the_post();
            $args_country = get_terms(array(
                'taxonomy' => 'education_country',
                'object_ids' => get_the_ID()
            ));
            $country = '0';
            $city = '0';
            foreach ($args_country as $c => $c1):
                if ($c1->parent == 0) {
                    $country = $c1->name;
                } else {
                    $city = $c1->name;
                }
            endforeach;
            $args_type_of_property = get_terms(array(
                'taxonomy' => 'type_of_property',
                'object_ids' => get_the_ID()
            ));
            $args_kind_of_property = get_terms(array(
                'taxonomy' => 'kind_of_property',
                'object_ids' => get_the_ID()
            ));
            echo "<a href=\"" . get_permalink() . "\" class=\"search_item link-search\" target=\"_blank\">";
            echo "<div class=\"row\">";
            echo "<div class=\"col-md-4\">";
            echo "<div class=\"img_search\">";
            if (get_the_post_thumbnail()):
                the_post_thumbnail('single-programms');
            else:
                ?>
                <img class="image-placeholder_blog-small"
                     src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/placeholder.png"
                     alt="">
                <?php
            endif;
            echo "</div>";
            echo "</div>";
            echo "<div class=\"col-md-8\">";
            echo "<div class=\"text-search\">";
            echo "<div class=\"text-search_title\">";
            the_title();
            echo " (ID:" . get_the_ID() . ")";
            echo "</div>";
            echo "<div class=\"text-search_content text-left\">";
            echo "<div class=\"row\">";
            echo "<div class=\"col-md-6\">";
            echo "<p class=\"single-property__info price_item\">";
            echo "<span>" . __('Цена: ', 'interavers') . "</span>";
            if (get_field('till_price')):
                echo __('от ', 'interavers');
                echo "<span class=\"blue\">" . get_field('price') . "</span> ";
                echo "<span class=\"blue\" >" . get_field('value') . "</span>";
                echo __(' до - ', 'interavers');
                echo "<span class=\"blue\">" . get_field('till_price') . "</span> ";
                echo "<span class=\"blue\" >" . get_field('value') . "</span>";
            else:
                echo "<span class=\"blue\" >" . get_field('price') . "</span> ";
                echo "<span class=\"blue\" >" . get_field('value') . "</span>";
            endif;
            echo "</p>";
            echo "<p class=\"single-property__info\">";
            echo "<span>" . __('Страна: ', 'interavers') . "</span>";
            echo ($country) ? $country : '-';
            echo "</p>";
            echo "<p class=\"single-property__info\">";
            echo "<span>" . __('Город: ', 'interavers') . "</span>";
            echo ($city) ? $city : '-';
            echo "</p>";
            echo "<p class=\"single-property__info\">";
            echo "<span>" . __('Вид недвиж.: ', 'interavers') . "</span>";
            echo $args_type_of_property[0]->name;
            echo "</p>";
            echo "<p class=\"single-property__info\">";
            echo "<span>" . __('Тип операции: ', 'interavers') . "</span>";
            echo $args_kind_of_property[0]->name;
            echo "</p>";
            echo "</div>";
            echo "<div class=\"col-md-6\">";
            echo "<p class=\"single-property__info\">";
            echo "<span>" . __('Год постройки: ', 'interavers') . "</span>";
            echo (get_field('build_year')) ? get_field('build_year') : '-';
            echo "</p>";
            echo "<p class=\"single-property__info\">";
            echo "<span>" . __('Площадь: ', 'interavers') . "</span>";
            if (have_rows('square')):
                while (have_rows('square')):
                    the_row();
                    if (get_sub_field('square_till')):
                        echo __('от ', 'interavers');
                        the_sub_field('square_from');
                        echo "м<sup>2</sup>";
                        echo __('до - ', 'interavers');
                        the_sub_field('square_till');
                        echo "м<sup>2</sup>";
                    elseif (get_sub_field('square_from')):
                        the_sub_field('square_from');
                        echo "м<sup>2</sup>";
                    else:
                        echo "-";
                    endif;
                endwhile;
            endif;
            echo "</p>";
            echo "<p class=\"single-property__info\">";
            echo "<span>" . __('Меблировка: ', 'interavers') . "</span>";
            the_field('furniture');
            echo "</p>";
            echo "<p class=\"single-property__info\">";
            echo "<span>" . __('Количество спален: ', 'interavers') . "</span>";
            echo (get_field('count_room')) ? get_field('count_room') : '-';
            echo "</p>";
            echo "<p class=\"single-property__info\">";
            echo "<span>" . __('Номер лота: ', 'interavers') . "</span>";
            echo get_the_ID();
            echo "</p>";
            echo "</div>";
            echo "</div>";
            echo "</div>";
            echo "<div href=\"" . get_permalink() . "\" class=\"btn-search\">";
            echo __('Подробнее', 'Avers');
            echo "</div>";
            echo "</div>";
            echo "</div>";
            echo "</div>";
            echo "</a>";
        endwhile;
        //wp_reset_postdata();
        //Pagination
        if ($properties->max_num_pages > $_SESSION['currentPage'] + 1):
            echo "<div id=\"pagination-property\" class=\"pagination aligncenter text-center\">";
            echo "<a href=\"\"><span>" . __('Следующая страница', 'interavers') . "</span><i class=\"fa fa-arrow-circle-o-down fa-4x\" aria-hidden=\"true\"></i></a>";
            echo "</div>";
        endif;
        //End pagination
    endif;
    $result = ob_get_contents();
    ob_clean();
    $_SESSION['res'] = ($result == "") ? 0 : 1;
    wp_send_json(array(
        'res' => $result,
        'redirect' => get_page_link(1609),
        'currentPage' => $_SESSION['currentPage'],
    ));
}

/*End Filter AJAX*/
?>