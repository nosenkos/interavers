<?php

function wp_register_rewrite_rules()
{
    add_rewrite_rule('country/?$', 'index.php?post_type=country', 'top');
    add_rewrite_tag('%education_country%', '([^/]+)');

    add_rewrite_rule('youth_program/?$', 'index.php?post_type=youth_program', 'top');
    add_rewrite_tag('%kind_of_youth_program%', '([^/]+)');
}

add_action('init', 'wp_register_rewrite_rules');

function ed_country_post_link($post_link, $id = 0)
{
    $post = get_post($id);
    if (is_wp_error($post) || 'country' != $post->post_type || empty($post->post_name))
        return $post_link;
    // Get the genre:
    $terms = get_the_terms($post->ID, 'education_country');
    if (is_wp_error($terms) || !$terms) {
        $ed_country = 'uncategorized';
    } else {
        $ed_country_obj = array_pop($terms);
        $ed_country = $ed_country_obj->slug;
    }
    return home_url(user_trailingslashit("country/{$ed_country}/{$post->post_name}"));
}

add_filter('post_type_link', 'ed_country_post_link', 10, 2);

function ed_youth_program_post_link($post_link, $id = 0)
{
    $post = get_post($id);
    if (is_wp_error($post) || 'youth_program' != $post->post_type || empty($post->post_name))
        return $post_link;
    // Get the genre:
    $terms = get_the_terms($post->ID, 'kind_of_youth_program');
    if (is_wp_error($terms) || !$terms) {
        $ed_country = 'uncategorized';
    } else {
        $ed_country_obj = array_pop($terms);
        $ed_country = $ed_country_obj->slug;
    }
    return home_url(user_trailingslashit("youth_program/{$ed_country}/{$post->post_name}"));
}

add_filter('post_type_link', 'ed_youth_program_post_link', 10, 2);

//flush_rewrite_rules();
?>