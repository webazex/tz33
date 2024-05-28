<?php
if( ! defined('ABSPATH') ) exit;
class CPT {
	static function create($cpt, $domain, $taxonomies = false, $defTax = []){
		if($taxonomies){
			$isDefault = [];
			if(!empty($defTax)){
				$isDefault['name'] = $defTax['name'];
				$isDefault['slug'] = $defTax['slug'];
				$isDefault['description'] = $defTax['desc'];
			}
			foreach ($taxonomies as $taxonomy){
				register_taxonomy( $taxonomy['tax'], [ $cpt['type'] ], [
					'label'                 => '', // определяется параметром $labels->name
					'labels'                => [
						'name'              => __($taxonomy['name'], $domain),
						'singular_name'     => __($taxonomy['s_name'], $domain),
						'search_items'      => __($taxonomy['search_items'], $domain),
						'all_items'         => __($taxonomy['all_items'], $domain),
						'view_item '        => __($taxonomy['view_item'], $domain),
						'parent_item'       => __($taxonomy['parent_item'], $domain),
						'parent_item_colon' => __($taxonomy['parent_item_colon'], $domain),
						'edit_item'         => __($taxonomy['edit_item'], $domain),
						'update_item'       => __($taxonomy['update_item'], $domain),
						'add_new_item'      => __($taxonomy['add_new_item'], $domain),
						'new_item_name'     => __($taxonomy['new_item_name'], $domain),
						'menu_name'         => (!empty($taxonomy['menu_name']))? __($taxonomy['menu_name'], $domain) :__($taxonomy['name'], $domain),
						'back_to_items'     => __($taxonomy['back_to_items'], $domain),
					],
					'description'           => __($taxonomy['desc'], $domain), // описание таксономии
					'public'                => $taxonomy['public'],
					// 'publicly_queryable'    => null, // равен аргументу public
					// 'show_in_nav_menus'     => true, // равен аргументу public
					// 'show_ui'               => true, // равен аргументу public
					// 'show_in_menu'          => true, // равен аргументу show_ui
					// 'show_tagcloud'         => true, // равен аргументу show_ui
					// 'show_in_quick_edit'    => null, // равен аргументу show_ui
					'hierarchical'          => $taxonomy['hierarchical'],

					'rewrite'               => true,
					//'query_var'             => $taxonomy, // название параметра запроса
					'capabilities'          => [],
					'meta_box_cb'           => null, // html метабокса. callback: `post_categories_meta_box` или `post_tags_meta_box`. false — метабокс отключен.
					'show_admin_column'     => $taxonomy['show_admin_column'], // авто-создание колонки таксы в таблице ассоциированного типа записи. (с версии 3.5)
					'show_in_rest'          => $taxonomy['rest'], // добавить в REST API
					'rest_base'             => null, // $taxonomy
					'default_term' => $isDefault,
					 //'_builtin'              => true,
					//'update_count_callback' => '_update_post_term_count',
				] );
			}
			register_post_type( $cpt['type'], [
				'label'  => null,
				'labels' => [
					'name'               => __($cpt['name'], $domain), // основное название для типа записи
					'singular_name'      => __($cpt['s_name'], $domain), // название для одной записи этого типа
					'add_new'            => __($cpt['add_new'], $domain), // для добавления новой записи
					'add_new_item'       => __($cpt['add_new_item'], $domain), // заголовка у вновь создаваемой записи в админ-панели.
					'edit_item'          => __($cpt['edit_item'], $domain), // для редактирования типа записи
					'new_item'           => __($cpt['new_item'], $domain), // текст новой записи
					'view_item'          => __($cpt['view_item'], $domain), // для просмотра записи этого типа.
					'search_items'       => __($cpt['search_item'], $domain), // для поиска по этим типам записи
					'not_found'          => __($cpt['not_found'], $domain), // если в результате поиска ничего не было найдено
					'not_found_in_trash' => __($cpt['not_found_in_trash'], $domain), // если не было найдено в корзине
					'parent_item_colon'  => (!empty($cpt['parent_item_colon']))? __($cpt['not_found_in_trash'], $domain) : '', // для родителей (у древовидных типов)
					'menu_name'          => (!empty($cpt['menu_name']))? __($cpt['menu_name'], $domain) : __($cpt['name'], $domain), // название меню
				],
				'description'            => __($cpt['desc'], $domain),
				'public'                 => boolval($cpt['public']),
				// 'publicly_queryable'  => null, // зависит от public
				// 'exclude_from_search' => null, // зависит от public
				// 'show_ui'             => null, // зависит от public
				// 'show_in_nav_menus'   => null, // зависит от public
				'show_in_menu'           => true, // показывать ли в меню админки
				// 'show_in_admin_bar'   => null, // зависит от show_in_menu
				'show_in_rest'        => true, // добавить в REST API. C WP 4.7
				'rest_base'           => null, // $post_type. C WP 4.7
				'menu_position'       => intval($cpt['position']),
				'menu_icon'           => (!empty($cpt['icon']))? $cpt['icon']: '',
				//'capability_type'   => 'post',
				//'capabilities'      => 'post', // массив дополнительных прав для этого типа записи
				//'map_meta_cap'      => null, // Ставим true чтобы включить дефолтный обработчик специальных прав
				'hierarchical'        => false,
				'supports'            => [ 'title','editor','author','thumbnail','excerpt','trackbacks','custom-fields','comments','revisions','page-attributes','post-formats' ], // 'title','editor','author','thumbnail','excerpt','trackbacks','custom-fields','comments','revisions','page-attributes','post-formats'
				'taxonomies'          => [],
				'has_archive'         => boolval($cpt['has_archive']),
				'rewrite'             => true,
				'query_var'           => true,
			] );
		}else{
			register_post_type( $cpt['type'], [
				'label'  => null,
				'labels' => [
					'name'               => __($cpt['name'], $domain), // основное название для типа записи
					'singular_name'      => __($cpt['s_name'], $domain), // название для одной записи этого типа
					'add_new'            => __($cpt['add_new'], $domain), // для добавления новой записи
					'add_new_item'       => __($cpt['add_new_item'], $domain), // заголовка у вновь создаваемой записи в админ-панели.
					'edit_item'          => __($cpt['edit_item'], $domain), // для редактирования типа записи
					'new_item'           => __($cpt['new_item'], $domain), // текст новой записи
					'view_item'          => __($cpt['view_item'], $domain), // для просмотра записи этого типа.
					'search_items'       => __($cpt['search_item'], $domain), // для поиска по этим типам записи
					'not_found'          => __($cpt['not_found'], $domain), // если в результате поиска ничего не было найдено
					'not_found_in_trash' => __($cpt['not_found_in_trash'], $domain), // если не было найдено в корзине
					'parent_item_colon'  => (!empty($cpt['parent_item_colon']))? __($cpt['not_found_in_trash'], $domain) : '', // для родителей (у древовидных типов)
					'menu_name'          => (!empty($cpt['menu_name']))? __($cpt['menu_name'], $domain) : __($cpt['name'], $domain), // название меню
				],
				'description'            => __($cpt['desc'], $domain),
				'public'                 => boolval($cpt['public']),
				// 'publicly_queryable'  => null, // зависит от public
				// 'exclude_from_search' => null, // зависит от public
				// 'show_ui'             => null, // зависит от public
				// 'show_in_nav_menus'   => null, // зависит от public
				'show_in_menu'           => true, // показывать ли в меню админки
				// 'show_in_admin_bar'   => null, // зависит от show_in_menu
				'show_in_rest'        => true, // добавить в REST API. C WP 4.7
				'rest_base'           => null, // $post_type. C WP 4.7
				'menu_position'       => intval($cpt['position']),
				'menu_icon'           => (!empty($cpt['icon']))? $cpt['icon']: '',
				//'capability_type'   => 'post',
				//'capabilities'      => 'post', // массив дополнительных прав для этого типа записи
				//'map_meta_cap'      => null, // Ставим true чтобы включить дефолтный обработчик специальных прав
				'hierarchical'        => false,
				'supports'            => [ 'title','editor','author','thumbnail','excerpt','trackbacks','custom-fields','comments','revisions','page-attributes','post-formats' ], // 'title','editor','author','thumbnail','excerpt','trackbacks','custom-fields','comments','revisions','page-attributes','post-formats'
				'taxonomies'          => [],
				'has_archive'         => boolval($cpt['has_archive']),
				'rewrite'             => true,
				'query_var'           => true,
			] );
		}
	}

}