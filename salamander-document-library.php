<?php
/**
 * Plugin Name: Salamander Document Library
 * Description: Creates a custom post type "Document" for inclusion in a document library/repository
 * Version: 1.0.0
 * Author: gillespieza
 * Author URI: https://github.com/gillespieza
 * License: GPL-3.0-or-later
 * License URI: https://www.gnu.org/licenses/gpl-3.0.html
 *
 * @package salamander-document-library
 * @wordpress-plugin
 */

// Security Check: Prevent this file being executed outside the WordPress context.
if ( ! defined( 'ABSPATH' ) ) {
	die( 'You are not allowed to call this page directly.' );
}

/**
 * Initialize plugin and load text domain.
 *
 * This function is hooked into the 'plugins_loaded' action to ensure that the plugin's text domain
 * is loaded, allowing for translation of plugin strings.
 *
 * @since 1.0.0
 */
function sdl_init() {
	load_plugin_textdomain( 'salamander-document-library', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
}
add_action( 'plugins_loaded', 'sdl_init' );


/**
 * Registers the 'documents' custom post type for managing documents.
 *
 * This function defines the labels and arguments for the 'documents' custom post type,
 * including its name, description, supported features, taxonomies, and other settings.
 *
 * @since 1.0.0
 */
function sdl_create_document_post_type() {

	$labels = array(
		'name'                  => _x( 'Documents', 'Post Type General Name', 'salamander-document-library' ),
		'singular_name'         => _x( 'Document', 'Post Type Singular Name', 'salamander-document-library' ),
		'menu_name'             => __( 'Documents', 'salamander-document-library' ),
		'name_admin_bar'        => __( 'Documents', 'salamander-document-library' ),
		'archives'              => __( 'Document Archives', 'salamander-document-library' ),
		'attributes'            => __( 'Document Attributes', 'salamander-document-library' ),
		'parent_item_colon'     => __( 'Parent Document:', 'salamander-document-library' ),
		'all_items'             => __( 'All Documents', 'salamander-document-library' ),
		'add_new_item'          => __( 'Add New Document', 'salamander-document-library' ),
		'add_new'               => __( 'Add New', 'salamander-document-library' ),
		'new_item'              => __( 'New Document', 'salamander-document-library' ),
		'edit_item'             => __( 'Edit Document', 'salamander-document-library' ),
		'update_item'           => __( 'Update Document', 'salamander-document-library' ),
		'view_item'             => __( 'View Document', 'salamander-document-library' ),
		'view_items'            => __( 'View Documents', 'salamander-document-library' ),
		'search_items'          => __( 'Search Document', 'salamander-document-library' ),
		'not_found'             => __( 'Not found', 'salamander-document-library' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'salamander-document-library' ),
		'featured_image'        => __( 'Featured Image', 'salamander-document-library' ),
		'set_featured_image'    => __( 'Set featured image', 'salamander-document-library' ),
		'remove_featured_image' => __( 'Remove featured image', 'salamander-document-library' ),
		'use_featured_image'    => __( 'Use as featured image', 'salamander-document-library' ),
		'insert_into_item'      => __( 'Insert into document', 'salamander-document-library' ),
		'uploaded_to_this_item' => __( 'Uploaded to this document', 'salamander-document-library' ),
		'items_list'            => __( 'Documents list', 'salamander-document-library' ),
		'items_list_navigation' => __( 'Documents list navigation', 'salamander-document-library' ),
		'filter_items_list'     => __( 'Filter Documents list', 'salamander-document-library' ),
	);
	$args   = array(
		'label'               => __( 'Document', 'salamander-document-library' ),
		'description'         => __( 'A document', 'salamander-document-library' ),
		'labels'              => $labels,
		'supports'            => array( 'title', 'editor', 'excerpt', 'thumbnail', 'page-attributes' ),
		'taxonomies'          => array( 'document-category' ),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'menu_position'       => 5,
		'menu_icon'           => 'dashicons-media-document',
		'show_in_admin_bar'   => true,
		'show_in_nav_menus'   => true,
		'can_export'          => true,
		'has_archive'         => 'documents',
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'capability_type'     => 'page',
	);
	register_post_type( 'documents', $args );

}
add_action( 'init', 'sdl_create_document_post_type', 0 );



/**
 * Registers the 'document-category' custom taxonomy for organizing documents into categories.
 *
 * This function defines the labels and arguments for the 'document-category' custom taxonomy,
 * including its name, hierarchical structure, visibility in the admin UI, and other settings.
 *
 * @since 1.0.0
 */
function sdl_create_document_taxonomy() {

	$labels = array(
		'name'                       => _x( 'Document Categories', 'Taxonomy General Name', 'salamander-document-library' ),
		'singular_name'              => _x( 'Document Category', 'Taxonomy Singular Name', 'salamander-document-library' ),
		'menu_name'                  => __( 'Document Categories', 'salamander-document-library' ),
		'all_items'                  => __( 'All Document Categories', 'salamander-document-library' ),
		'parent_item'                => __( 'Parent Document Category', 'salamander-document-library' ),
		'parent_item_colon'          => __( 'Parent Document Category:', 'salamander-document-library' ),
		'new_item_name'              => __( 'New Document Category Name', 'salamander-document-library' ),
		'add_new_item'               => __( 'Add New Document Category', 'salamander-document-library' ),
		'edit_item'                  => __( 'Edit Document Category', 'salamander-document-library' ),
		'update_item'                => __( 'Update Document Category', 'salamander-document-library' ),
		'view_item'                  => __( 'View Document Category', 'salamander-document-library' ),
		'separate_items_with_commas' => __( 'Separate Document Categories with commas', 'salamander-document-library' ),
		'add_or_remove_items'        => __( 'Add or remove Document Categories', 'salamander-document-library' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'salamander-document-library' ),
		'popular_items'              => __( 'Most used Document Categories', 'salamander-document-library' ),
		'search_items'               => __( 'Search Document Categories', 'salamander-document-library' ),
		'not_found'                  => __( 'Not Found', 'salamander-document-library' ),
		'no_terms'                   => __( 'No Document Categories', 'salamander-document-library' ),
		'items_list'                 => __( 'Document Categories list', 'salamander-document-library' ),
		'items_list_navigation'      => __( 'Document Categories list navigation', 'salamander-document-library' ),
	);
	$args   = array(
		'labels'            => $labels,
		'hierarchical'      => true,
		'public'            => true,
		'show_ui'           => true,
		'show_admin_column' => true,
		'show_in_nav_menus' => true,
		'show_tagcloud'     => true,
	);
	register_taxonomy( 'document-category', array( 'documents' ), $args );

}
add_action( 'init', 'sdl_create_document_taxonomy', 0 );
