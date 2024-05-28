<?php
require_once get_stylesheet_directory().DS.'App'.DS.'CPT'.DS.'CPT.php';
function registerCustomPostType()
{
    CPT::create([
        'type' => 'arts',
        'name' => 'Art',
        's_name' => 'Art',
        'add_new' => 'Add art',
        'add_new_item' => 'Art title',
        'edit_item' => 'Edit art',
        'new_item' => 'New art',
        'view_item' => 'View art',
        'search_item' => 'Search arts',
        'not_found' => 'Arts not found',
        'not_found_in_trash' => 'Arts not found',
        'parent_item_colon' => '',
        'menu_name' => 'Arts',
        'desc' => 'Arts',
        'public' => true,
        'position' => 5,
        'icon' => '',
        'has_archive' => true,
    ], 'ttfc', [
        [
            'tax' => 'music',
            'name' => 'Music',
            's_name' => 'Music',
            'search_items' => 'Search music',
            'all_items' => 'All music',
            'view_item' => 'View music',
            'parent_item' => 'Parent music category',
            'parent_item_colon' => 'Parent music category',
            'edit_item' => 'Edit music',
            'update_item' => 'Update music',
            'add_new_item' => 'Add music',
            'new_item_name' => 'New music',
            'menu_name' => 'Music',
            'back_to_items' => 'Back to music category',
            'desc' => 'Music description',
            'public' => true,
            'hierarchical' => true,
            'show_admin_column' => true,
            'rest' => true,
        ],
        [
            'tax' => 'photo',
            'name' => 'Photo',
            's_name' => 'Photo',
            'search_items' => 'Search photo',
            'all_items' => 'All photos',
            'view_item' => 'View photo',
            'parent_item' => '',
            'parent_item_colon' => '',
            'edit_item' => 'Edit photo',
            'update_item' => 'Update photo',
            'add_new_item' => 'Add photo',
            'new_item_name' => 'New photo',
            'menu_name' => 'Photo',
            'back_to_items' => 'Back to photo',
            'desc' => 'Photo description',
            'public' => true,
            'hierarchical' => false,
            'show_admin_column' => true,
            'rest' => true,
        ],
    ], [
            'name' => __('Uncategorized arts', 'ttfc'),
            'slug' => 'uncategorized-arts',
            'desc' => __('Uncategorized arts here', 'ttfc')
        ]
    );
    flush_rewrite_rules();
};

//registerCustomPostType();
add_action('init', 'registerCustomPostType');