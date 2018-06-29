<?php

function get_cleaned_up_pages() {

	$cleaned_up_pages = [];
	$pages = get_pages();
	$homepage_id = (int)get_option( 'page_on_front' );
	$available_langs = icl_get_languages('skip_missing=0&orderby=KEY&order=DIR&link_empty_to=str');

	foreach($pages as $page) {

		$cleaned_up_page = create_object_from_another_object_properties([
			'ID',
			'post_title',
			'post_status',
			'post_content',
			'post_name',
			'post_parent'
		], $page);
		$cleaned_up_page['template'] = get_field('template', $page->ID);
		$cleaned_up_page['slugs'] = [];

		foreach ($available_langs as $lang_key=>$lang_object) {

			if(apply_filters( 'wpml_object_id', $cleaned_up_page['ID'], 'post', false, $lang_key) === apply_filters( 'wpml_object_id', $homepage_id, 'post', false, $lang_key)) {
				$cleaned_up_page['slugs'][$lang_key] = "";
			}
			else {
				$slug = get_post_field('post_name', apply_filters( 'wpml_object_id', $cleaned_up_page['ID'], 'post', false, $lang_key));
				$cleaned_up_page['slugs'][$lang_key] = $slug !== '' ? $slug : null;
			}
		}

		$cleaned_up_pages[] = $cleaned_up_page;

	}

	return rest_ensure_response($cleaned_up_pages);
}

function get_cleaned_up_page($request) {

	$id = $request['id'];
	$page = get_post(apply_filters('wpml_object_id', $id, 'page'));

	if($page) {
		$cleaned_up_page = create_object_from_another_object_properties([
			'ID',
			'post_author',
			'post_status',
			'post_name',
			'post_date',
			'post_title',
			'post_parent'
		], $page);
		$cleaned_up_page['post_content'] = nl2br($page->post_content);
		return rest_ensure_response($cleaned_up_page);
	}
	else {
		return rest_ensure_response(new WP_Error( '404', 'Page content not found in the requested lang.', array( 'status' => 404 )));
	}

}


function get_menus() {

	$cleaned_up_menus = [];
	$menus = array_unique(get_terms( 'nav_menu'), SORT_REGULAR);
	$available_langs = icl_get_languages('skip_missing=0&orderby=KEY&order=DIR&link_empty_to=str');

	foreach ($menus as $menu) {

		$menu_items = wp_get_nav_menu_items($menu);

		$cleaned_up_menu = [];
		$cleaned_up_menu['ID'] = $menu->term_id;
		$cleaned_up_menu['slug'] = $menu->slug;
		$cleaned_up_menu['pages'] = [];

		foreach ($menu_items as $menu_item) {

			$page_id = (int)$menu_item->object_id;

			$page = create_object_from_another_object_properties([
				'title',
				'menu_item_parent',
				'menu_order'
			], $menu_item);

			$page['slugs'] = [];
			foreach ($available_langs as $lang_key=>$lang_object) {

				if(apply_filters( 'wpml_object_id', $menu_item->object_id, 'post', false, $lang_key) === apply_filters( 'wpml_object_id', get_option( 'page_on_front' ), 'post', false, $lang_key)) {
					$page['slugs'][$lang_key] = "";
				}
				else {
					$slug = get_post_field('post_name', apply_filters( 'wpml_object_id', $menu_item->object_id, 'post', false, $lang_key));
					$page['slugs'][$lang_key] = $slug !== '' ? $slug : null;
				}
			}

			$page['ID'] = $page_id;

			if(get_post_status($menu_item->object_id) !== 'private') {
				$cleaned_up_menu['pages'][] = $page;
			}


		}

		$cleaned_up_menus[] = $cleaned_up_menu;

	}

	return rest_ensure_response($cleaned_up_menus);
}

function get_site_settings() {

	global $sitepress;
	$available_langs = icl_get_languages('skip_missing=0&orderby=KEY&order=DIR&link_empty_to=str');

	$settings = [];
	$settings['defaultLang'] = $sitepress->get_default_language();
	$settings['availableLangs'] = icl_get_languages('skip_missing=0&orderby=KEY&order=DIR&link_empty_to=str');
	$settings['homepageIds'] = [];

	foreach ($available_langs as $lang_key=>$lang_object) {
		$settings['homepageIds'][$lang_key] = apply_filters( 'wpml_object_id', get_option( 'page_on_front' ), 'post', false, $lang_key);
	}

	return rest_ensure_response($settings);

}

function add_pages_endpoint() {

	register_rest_route( 'reptile', '/pages', array(
		'methods'  => WP_REST_Server::READABLE,
		'callback' => 'get_cleaned_up_pages',
	));
}

function add_page_endpoint() {

	register_rest_route( 'reptile', '/pages/(?P<id>\d+)', array(
		'methods'  => WP_REST_Server::READABLE,
		'callback' => 'get_cleaned_up_page',
		'args' => array(
		  'id' => array(
			'validate_callback' => function($param, $request, $key) {
			  return is_numeric( $param );
			}
		  ),
		),
	));
}


function add_menus_endpoint() {

	register_rest_route( 'reptile', '/menus', array(
		'methods' => WP_REST_Server::READABLE,
		'callback' => 'get_menus',
	) );

}

function add_settings_endpoint() {

	register_rest_route( 'reptile', '/settings', array(
		'methods' => WP_REST_Server::READABLE,
		'callback' => 'get_site_settings',
	) );

}

add_action( 'rest_api_init', 'add_pages_endpoint' );
add_action( 'rest_api_init', 'add_page_endpoint' );
add_action( 'rest_api_init', 'add_menus_endpoint' );
add_action( 'rest_api_init', 'add_settings_endpoint' );