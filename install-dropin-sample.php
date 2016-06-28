<?php

/**
 * 
 * WordPress checks for this file on install or upgrade, and if found with an existing `wp_install_defaults()` function runs it instead of running its own default wp_install_defaults function which creates Hello World, etc.
 * 
 * The modifications made include:
 * **not creating default comments, hello world, and the sample page
 * * setting comments to off by default.
 * * the hello world page is actually created, but then deleted. This is done to work around an apparent bug that prevents WordPress from enabling permalinks by default.
 * removing widgets: search, meta, and comments
 * 
 *  */
function wp_install_defaults( $user_id ) {



    disallow_comments();
    add_categories();
    enable_widgets();

    
    
    #create first post
   create_hello_world_post();

    #enable pretty links
    wp_install_maybe_enable_pretty_permalinks();
    #delete hello world since its only needed so pretty_permalinks can be autoenabled. This is a work around to a bug that was found when attempting to auto enable permalinks without having any posts or pages craeated.
    wp_delete_post( 1 );



}

/**
 * Create Hello World Post
 *
 * Creates the Hello World Post . Code taken from the upgrade.php file in core.
 * @return void
 */
function create_hello_world_post() {

    global $wpdb;
    $user_id = 1;

// First post
    $now = current_time( 'mysql' );
    $now_gmt = current_time( 'mysql', 1 );
    $first_post_guid = get_option( 'home' ) . '/?p=1';

    if ( is_multisite() ) {
        $first_post = get_site_option( 'first_post' );

        if ( !$first_post ) {
            /* translators: %s: site link */
            $first_post = __( 'Welcome to %s. This is your first post. Edit or delete it, then start blogging!' );
                }

        $first_post = sprintf( $first_post, sprintf( '<a href="%s">%s</a>', esc_url( network_home_url() ), get_current_site()->site_name )
        );

        // Back-compat for pre-4.4
        $first_post = str_replace( 'SITE_URL', esc_url( network_home_url() ), $first_post );
        $first_post = str_replace( 'SITE_NAME', get_current_site()->site_name, $first_post );
        } else {
        $first_post = __( 'Welcome to WordPress. This is your first post. Edit or delete it, then start writing!' );
        }

    $wpdb->insert( $wpdb->posts, array(
        'post_author' => $user_id,
        'post_date' => $now,
        'post_date_gmt' => $now_gmt,
        'post_content' => $first_post,
        'post_excerpt' => '',
        'post_title' => __( 'Hello world!' ),
        /* translators: Default post slug */
        'post_name' => sanitize_title( _x( 'hello-world', 'Default post slug' ) ),
        'post_modified' => $now,
        'post_modified_gmt' => $now_gmt,
        'guid' => $first_post_guid,
        'comment_count' => 1,
        'to_ping' => '',
        'pinged' => '',
        'post_content_filtered' => ''
    ) );


}

/**
 * Disallow Comments
 *
 * Disallows Comments for all new posts
 * @param none
 * @return void
 */
function disallow_comments() {

    update_option( 'default_comment_status', 'closed' );


}

/**
 * Enable Widgets
 *
 * Enables Default Widgets
 * @param string $content The shortcode content
 * @return string The parsed output of the form body tag
 */
function enable_widgets() {

$user_id=1;

    global $wpdb, $wp_rewrite, $table_prefix;
    // Set up default widgets for default theme.
    #search
    #update_option( 'widget_search', array ( 2 => array ( 'title' => '' ), '_multiwidget' => 1 ) );
    
    #recent post
    update_option( 'widget_recent-posts', array( 2 => array( 'title' => '', 'number' => 5 ), '_multiwidget' => 1 ) );
    
    #recent comments
    #update_option( 'widget_recent-comments', array ( 2 => array ( 'title' => '', 'number' => 5 ), '_multiwidget' => 1 ) );
    
    #archives
    update_option( 'widget_archives', array( 2 => array( 'title' => '', 'count' => 0, 'dropdown' => 0 ), '_multiwidget' => 1 ) );
    
    #categories
    update_option( 'widget_categories', array( 2 => array( 'title' => '', 'count' => 0, 'hierarchical' => 0, 'dropdown' => 0 ), '_multiwidget' => 1 ) );
    
    #meta
    #update_option( 'widget_meta', array( 2 => array( 'title' => '' ), '_multiwidget' => 1 ) );
    
    #inactive widgets
    update_option( 'sidebars_widgets', array( 'wp_inactive_widgets' => array(), 'sidebar-1' => array( 0 => 'search-2', 1 => 'recent-posts-2', 2 => 'recent-comments-2', 3 => 'archives-2', 4 => 'categories-2', 5 => 'meta-2', ), 'array_version' => 3 ) );

    if ( !is_multisite() )
        update_user_meta( $user_id, 'show_welcome_panel', 1 );
    elseif ( !is_super_admin( $user_id ) && !metadata_exists( 'user', $user_id, 'show_welcome_panel' ) )
        update_user_meta( $user_id, 'show_welcome_panel', 2 );

    if ( is_multisite() ) {
        // Flush rules to pick up the new page.
        $wp_rewrite->init();
        $wp_rewrite->flush_rules();

        $user = new WP_User( $user_id );
        $wpdb->update( $wpdb->options, array( 'option_value' => $user->user_email ), array( 'option_name' => 'admin_email' ) );

        // Remove all perms except for the login user.
        $wpdb->query( $wpdb->prepare( "DELETE FROM $wpdb->usermeta WHERE user_id != %d AND meta_key = %s", $user_id, $table_prefix . 'user_level' ) );
        $wpdb->query( $wpdb->prepare( "DELETE FROM $wpdb->usermeta WHERE user_id != %d AND meta_key = %s", $user_id, $table_prefix . 'capabilities' ) );

        // Delete any caps that snuck into the previously active blog. (Hardcoded to blog 1 for now.) TODO: Get previous_blog_id.
        if ( !is_super_admin( $user_id ) && $user_id != 1 )
            $wpdb->delete( $wpdb->usermeta, array( 'user_id' => $user_id, 'meta_key' => $wpdb->base_prefix . '1_capabilities' ) );
        }


}
    /**
     * Add Categories
     *
     * Adds the default categories for installation 
     * @param null
     * @return void
     */
    function add_categories() {



        global $wpdb, $wp_rewrite, $table_prefix;

        // Default category
        $cat_name = __( 'Uncategorized' );
        /* translators: Default category slug */
        $cat_slug = sanitize_title( _x( 'Uncategorized', 'Default category slug' ) );

        if ( global_terms_enabled() ) {
            $cat_id = $wpdb->get_var( $wpdb->prepare( "SELECT cat_ID FROM {$wpdb->sitecategories} WHERE category_nicename = %s", $cat_slug ) );
            if ( $cat_id == null ) {
                $wpdb->insert( $wpdb->sitecategories, array( 'cat_ID' => 0, 'cat_name' => $cat_name, 'category_nicename' => $cat_slug, 'last_updated' => current_time( 'mysql', true ) ) );
                $cat_id = $wpdb->insert_id;
                }
            update_option( 'default_category', $cat_id );
        } else {
            $cat_id = 1;
        }

        $wpdb->insert( $wpdb->terms, array( 'term_id' => $cat_id, 'name' => $cat_name, 'slug' => $cat_slug, 'term_group' => 0 ) );
        $wpdb->insert( $wpdb->term_taxonomy, array( 'term_id' => $cat_id, 'taxonomy' => 'category', 'description' => '', 'parent' => 0, 'count' => 1 ) );
        $cat_tt_id = $wpdb->insert_id;

        $wpdb->insert( $wpdb->term_relationships, array( 'term_taxonomy_id' => $cat_tt_id, 'object_id' => 1 ) );


    }
?>