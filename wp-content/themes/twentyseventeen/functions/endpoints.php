<?php

function get_cleaned_up_pages() {

	$cleaned_up_pages = [];
	$pages = get_pages();

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

		$cleaned_up_pages[] = $cleaned_up_page;

	}

	return rest_ensure_response($cleaned_up_pages);
}

function get_cleaned_up_page($request) {

	$id = $request['id'];
	$page = get_post($id);

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


function get_menus() {

	$cleaned_up_menus = [];
	$menus = get_terms( 'nav_menu', array( 'hide_empty' => true ));

	foreach ($menus as $menu) {

		$menu_items = wp_get_nav_menu_items($menu);

		$cleaned_up_menu = [];
		$cleaned_up_menu['ID'] = $menu->term_id;
		$cleaned_up_menu['slug'] = $menu->slug;
		$cleaned_up_menu['pages'] = [];

		foreach ($menu_items as $menu_item) {

			$page = create_object_from_another_object_properties([
				'title',
				'menu_item_parent',
				'menu_order'
			], $menu_item);
			$page['slug'] = get_post_field( 'post_name', $menu_item->object_id);
			$page['ID'] = $menu_item->object_id;

			if(get_post_status($menu_item->object_id) !== 'private') {
				$cleaned_up_menu['pages'][] = $page;
			}


		}

		$cleaned_up_menus[] = $cleaned_up_menu;

	}

	return rest_ensure_response($cleaned_up_menus);
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

add_action( 'rest_api_init', 'add_pages_endpoint' );
add_action( 'rest_api_init', 'add_page_endpoint' );
add_action( 'rest_api_init', 'add_menus_endpoint' );