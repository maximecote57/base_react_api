<?php

require_once('utilities.php');
require_once('functions/endpoints.php');

function twentyseventeen_setup() {

	load_theme_textdomain( 'twentyseventeen' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'title-tag' );
	register_nav_menus( array(
		'top'    => __( 'Top Menu', 'twentyseventeen' )
	) );


}

add_action( 'after_setup_theme', 'twentyseventeen_setup' );