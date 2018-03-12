<?php

/*Search Property by ID*/

add_action('parse_request', 'idsearch');
function idsearch($wp)
{
    global $pagenow;

    // If it's not the post listing return
    if ('edit.php' != $pagenow)
        return;

    // If it's not a search return
    if (!isset($wp->query_vars['s']))
        return;

    // If it's a search but there's no prefix, return
    if ('#' != substr($wp->query_vars['s'], 0, 1))
        return;

    // Validate the numeric value
    $id = absint(substr($wp->query_vars['s'], 1));
    if (!$id)
        return; // Return if no ID, absint returns 0 for invalid values

    // If we reach here, all criteria is fulfilled, unset search and select by ID instead
    unset($wp->query_vars['s']);
    $wp->query_vars['p'] = $id;
}
// Filter the search page
add_filter('pre_get_posts', 'my_search_pre_get_posts');

function my_search_pre_get_posts($query)
{
    // Verify that we are on the search page that that this came from the event search form
    if ($query->query_vars['s'] != '' && is_search()) {
        // If "s" is a positive integer, assume post id search and change the search variables
        if (absint($query->query_vars['s'])) {
            // Set the post id value
            $query->set('p', $query->query_vars['s']);

            // Reset the search value
            $query->set('s', '');
        }
    }
}
?>