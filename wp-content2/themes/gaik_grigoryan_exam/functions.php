<?php

// ENQUEUE STYLES
 function enqueue_styles() {
     wp_enqueue_style( 'style', get_stylesheet_uri());
 }
 add_action('wp_enqueue_scripts', 'enqueue_styles');


// ENQUEUE SCRIPTS
function enqueue_scripts() {
    wp_enqueue_script('jquery-2.1.3.min', get_template_directory_uri() . '/js/jquery-2.1.3.min.js', 'wp_footer');
    wp_enqueue_script('isotope.pkgd.min', get_template_directory_uri() . '/js/isotope.pkgd.min.js', 'wp_footer');
    wp_enqueue_script('html5-shim', 'http://html5shim.googlecode.com/svn/trunk/html5.js', 'wp_footer');
    wp_enqueue_script( 'main', get_template_directory_uri() . '/js/main.js', 'wp_footer');
}
add_action( 'wp_enqueue_scripts', 'enqueue_scripts' );




// Theme Customization API LOGO
function logo_customize_register( $wp_customize ) {
	$wp_customize->add_section( 'logo_image' , array(
	    'title'      => __( 'Logo Image', 'logo' ),
	    'description' => 'Insert logo image',
	    'priority'   => 29,
	) );
	$wp_customize->add_setting( 'header_logo' , array(
	    'default'     => '',
	) );
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'header_logo', array(
		'label'        => __( 'Edit Logo', 'logo' ),
		'section'    => 'logo_image',
		'settings'   => 'header_logo',
	) ) );
}
add_action( 'customize_register', 'logo_customize_register' );

// MAVIGATION MENU
if ( function_exists( 'register_nav_menus' ) ) {
	register_nav_menus(
		array(
			'custom-menu'=>__('Custom menu'),
		)
	);
}

function custom_menu(){
	echo '<ul>';
	wp_list_pages('title_li=&');
	echo '</ul>';
}

// THUMBNAILS
add_theme_support( 'post-thumbnails' );


// POST TYPE
function custom_post_postname() {
	$labels = array(
		'name'               => _x( 'postname', 'post type general name' ),
		'singular_name'      => _x( 'postname', 'post type singular name' ),
		'add_new'            => _x( 'Добавить новый', 'postname' ),
		'add_new_item'       => __( 'Добавить новый postname' ),
		'edit_item'          => __( 'Редактировать postname' ),
		'new_item'           => __( 'Новый postname' ),
		'all_items'          => __( 'Все postname' ),
		'view_item'          => __( 'Просмотр postname' ),
		'search_items'       => __( 'Поиск postname' ),
		'not_found'          => __( 'postname не найден' ),
		'not_found_in_trash' => __( 'postname не найден в Корзине' ),
		'parent_item_colon'  => '',
		'menu_name'          => 'postname'
	);
	$args = array(
		'labels'        => $labels,
		'description'   => 'Для добавления нового postname',
		'public'        => true,
		'menu_position' => 5,
		'supports'      => array( 'title', 'editor', 'thumbnail', 'excerpt', 'comments' ),
		'has_archive'   => true,
	);
	register_post_type( 'postname', $args );
}
add_action( 'init', 'custom_post_postname' );


// Register Widget
if ( function_exists('register_sidebar') ) {

    register_sidebar(array(
        'id' => 'sidebar-right',
        'name' => 'sidebar-right',
        'before_widget' => '<section class="right-sidebar">',
        'before_title' => '',
        'after_title' => '',
        'after_widget' => '</section>'
    ));
        register_sidebar(array(
        'id' => 'sidebar-footer',
        'name' => 'sidebar-footer',
        'before_widget' => '',
        'before_title' => '',
        'after_title' => '',
        'after_widget' => ''
    ));
}

// Theme Customization API Footer
function geekhub_customize_register( $wp_customize ) {
	$wp_customize->add_section( 'geekhub_copyright' , array(
	'title'      => __( 'Copyright', 'geekhub' ),
) );

	$wp_customize->add_setting( 'copyright_details' , array(
	'default'     => 'Gaik Grigoryan',
	'transport'   => 'refresh',
) );

	$wp_customize->add_control( 'copyright_details', array(
	'label'        => __( 'Copyright info', 'geekhub' ),
	'section'    => 'geekhub_copyright',
	'settings'   => 'copyright_details',
) );
}

add_action( 'customize_register', 'geekhub_customize_register' );

// Footer copyright
function devise_copyright() {
	global $wpdb;
	$copyright_dates = $wpdb->get_results("
	SELECT
	YEAR(min(post_date_gmt)) AS firstdate,
	YEAR(max(post_date_gmt)) AS lastdate
	FROM
	$wpdb->posts
	WHERE
	post_status = 'publish'
	");
	$output = '';
	if($copyright_dates) {
		$copyright = "Copyright " . $copyright_dates[0]->firstdate;
		if($copyright_dates[0]->firstdate != $copyright_dates[0]->lastdate) {
			$copyright .= '-' . $copyright_dates[0]->lastdate;
		}
		$output = $copyright;
	}
	return $output;
}

?>