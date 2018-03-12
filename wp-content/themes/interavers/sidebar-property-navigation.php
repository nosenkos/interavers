<?php
/*
The sidebar containing property navigation
*/
$property = new WP_Query(array(
    'post_type' => 'property',
    'posts_per_page' => -1
));
$property_id = array();
if ($property->have_posts()):
    while ($property->have_posts()):
        $property->the_post();
        $property_id[] = get_the_ID();
    endwhile;
endif;

$countries = get_terms(array(
    'taxonomy' => 'education_country',
    'object_ids' => $property_id,
    'orderby' => 'name',
    'order' => 'ASC'
));

$type_of_properties = get_terms(array(
    'taxonomy' => 'type_of_property',
    'orderby' => 'name',
    'order' => 'ASC'
));

$kind_of_properties = get_terms(array(
    'taxonomy' => 'kind_of_property',
    'orderby' => 'name',
    'order' => 'ASC'
));
?>

<aside id="property-navigation" class="property-navigation nav-area">
    <div class="property-navigation_search">
        <?php echo do_shortcode('[wpdreams_ajaxsearchlite]'); ?>
    </div>
    <div class="property-navigation_form">
        <form action="<?php echo site_url() ?>/wp-admin/admin-ajax.php" method="POST" id="filter">
            <div class="form-group">
                <?php
                if ($countries) : ?>
                    <label for="countryfilter">Выберите страну:</label>
                    <select id="countryfilter" name="countryfilter" class="form-control">
                        <option value="0">Все страны</option>
                        <?php
                        foreach ($countries as $country) :
                            if ($country->parent == 0):?>
                                <option value="<?= $country->term_id; ?>" <?= (isset($_SESSION['countryfilter'])) ? ($country->term_id == $_SESSION['countryfilter']) ? 'selected' : '' : '' ?>><?= $country->name; ?></option>
                            <?php endif;
                        endforeach; ?>
                    </select>
                    <?php
                endif;
                ?>
            </div>
            <div class="form-group">
                <label for="cityfilter">Выберите город:</label>
                <?php
                if (isset($_SESSION['countCity']) && $_SESSION['countCity'] != 0):
                    ?>
                    <select id="cityfilter" name="cityfilter" class="form-control">
                        <option value="0">Все города</option>
                        <?php
                        foreach ($countries as $city) :
                            if ($city->parent == $_SESSION['countryfilter']):?>
                                <option value="<?= $city->term_id; ?>" <?= (isset($_SESSION['cityfilter'])) ? ($city->term_id == $_SESSION['cityfilter']) ? 'selected' : '' : '' ?>><?= $city->name; ?></option>
                            <?php endif;
                        endforeach; ?>
                    </select>
                    <?php
                else:
                    ?>
                    <select id="cityfilter" name="cityfilter" class="form-control" disabled>
                        <option value="0">Все города</option>
                    </select>
                    <?php
                endif;
                ?>
            </div>
            <div class="form-group">
                <?php
                if ($type_of_properties) : ?>
                    <label for="typefilter">Тип недвижимости:</label>
                    <select id="typefilter" name="typefilter" class="form-control">
                        <option value="0">Все</option>
                        <?php
                        foreach ($type_of_properties as $type_of_property) :?>
                            <option value="<?= $type_of_property->term_id; ?>" <?= (isset($_SESSION['typefilter'])) ? ($type_of_property->term_id == $_SESSION['typefilter']) ? 'selected' : '' : '' ?>><?= $type_of_property->name; ?></option>
                            <?php
                        endforeach; ?>
                    </select>
                    <?php
                endif;
                ?>
            </div>
            <div class="form-group">
                <?php
                if ($kind_of_properties) : ?>
                    <label for="kindfilter">Тип операции:</label>
                    <select id="kindfilter" name="kindfilter" class="form-control">
                        <option value="0">Все</option>
                        <?php
                        foreach ($kind_of_properties as $kind_of_property) :?>
                            <option value="<?= $kind_of_property->term_id; ?>" <?= (isset($_SESSION['kindfilter'])) ? ($kind_of_property->term_id == $_SESSION['kindfilter']) ? 'selected' : '' : '' ?>><?= $kind_of_property->name; ?></option>
                            <?php
                        endforeach; ?>
                    </select>
                    <?php
                endif;
                ?>
            </div>
            <div class="form-group">
                <label>Ценовой диапазон, €/$:</label>
                <div class="row second-labels">
                    <div class="col-md-6">
                        <label for="min_price" class="col-form-label">Минимальная цена</label>
                        <input id="min_price" class="form-control" type="number" name="min_price"
                               value="<?= (isset($_SESSION['min_price']) && $_SESSION['min_price'] != "") ? $_SESSION['min_price'] : '0'; ?>"
                               required
                        />
                    </div>
                    <div class="col-md-6">
                        <label for="max_price" class="col-form-label">Максимальная цена</label>
                        <input id="max_price" class="form-control" type="number" name="max_price"
                               value="<?= (isset($_SESSION['max_price']) && $_SESSION['max_price'] != "") ? $_SESSION['max_price'] : '300000'; ?>"
                               required/>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <button id="submit" class="btn btn-inter form-control">Найти</button>
            </div>
            <input type="hidden" name="action" value="myfilter">
        </form>
        <a href="" id="clean-filter"><i class="fa fa-times"></i> <?= __('Очистить фильтр', 'interavers') ?></a>
    </div>
</aside>
<?php
wp_reset_postdata();
?>
