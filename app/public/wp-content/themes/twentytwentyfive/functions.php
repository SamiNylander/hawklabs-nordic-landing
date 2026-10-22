<?php
/**
 * Twenty Twenty-Five functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_Five
 * @since Twenty Twenty-Five 1.0
 */

if ( ! function_exists( 'twentytwentyfive_post_format_setup' ) ) :
	/**
	 * Adds theme support for post formats.
	 *
	 * @since Twenty Twenty-Five 1.0
	 *
	 * @return void
	 */
	function twentytwentyfive_post_format_setup() {
		add_theme_support( 'post-formats', array( 'aside', 'audio', 'chat', 'gallery', 'image', 'link', 'quote', 'status', 'video' ) );
	}
endif;
add_action( 'after_setup_theme', 'twentytwentyfive_post_format_setup' );

if ( ! function_exists( 'twentytwentyfive_editor_style' ) ) :
	/**
	 * Enqueues editor-style.css in the editors.
	 *
	 * @since Twenty Twenty-Five 1.0
	 *
	 * @return void
	 */
	function twentytwentyfive_editor_style() {
		add_editor_style( 'assets/css/editor-style.css' );
	}
endif;
add_action( 'after_setup_theme', 'twentytwentyfive_editor_style' );

if ( ! function_exists( 'twentytwentyfive_enqueue_styles' ) ) :
	/**
	 * Enqueues the theme stylesheet on the front.
	 *
	 * @since Twenty Twenty-Five 1.0
	 *
	 * @return void
	 */
	function twentytwentyfive_enqueue_styles() {
		$suffix = SCRIPT_DEBUG ? '' : '.min';
		$src    = 'style' . $suffix . '.css';

		wp_enqueue_style(
			'twentytwentyfive-style',
			get_parent_theme_file_uri( $src ),
			array(),
			wp_get_theme()->get( 'Version' )
		);
		wp_style_add_data(
			'twentytwentyfive-style',
			'path',
			get_parent_theme_file_path( $src )
		);
	}
endif;
add_action( 'wp_enqueue_scripts', 'twentytwentyfive_enqueue_styles' );

if ( ! function_exists( 'twentytwentyfive_block_styles' ) ) :
	/**
	 * Registers custom block styles.
	 *
	 * @since Twenty Twenty-Five 1.0
	 *
	 * @return void
	 */
	function twentytwentyfive_block_styles() {
		register_block_style(
			'core/list',
			array(
				'name'         => 'checkmark-list',
				'label'        => __( 'Checkmark', 'twentytwentyfive' ),
				'inline_style' => '
				ul.is-style-checkmark-list {
					list-style-type: "\2713";
				}

				ul.is-style-checkmark-list li {
					padding-inline-start: 1ch;
				}',
			)
		);
	}
endif;
add_action( 'init', 'twentytwentyfive_block_styles' );

if ( ! function_exists( 'twentytwentyfive_pattern_categories' ) ) :
	/**
	 * Registers pattern categories.
	 *
	 * @since Twenty Twenty-Five 1.0
	 *
	 * @return void
	 */
	function twentytwentyfive_pattern_categories() {

		register_block_pattern_category(
			'twentytwentyfive_page',
			array(
				'label'       => __( 'Pages', 'twentytwentyfive' ),
				'description' => __( 'A collection of full page layouts.', 'twentytwentyfive' ),
			)
		);

		register_block_pattern_category(
			'twentytwentyfive_post-format',
			array(
				'label'       => __( 'Post formats', 'twentytwentyfive' ),
				'description' => __( 'A collection of post format patterns.', 'twentytwentyfive' ),
			)
		);
	}
endif;
add_action( 'init', 'twentytwentyfive_pattern_categories' );

if ( ! function_exists( 'twentytwentyfive_register_block_bindings' ) ) :
	/**
	 * Registers the post format block binding source.
	 *
	 * @since Twenty Twenty-Five 1.0
	 *
	 * @return void
	 */
	function twentytwentyfive_register_block_bindings() {
		register_block_bindings_source(
			'twentytwentyfive/format',
			array(
				'label'              => _x( 'Post format name', 'Label for the block binding placeholder in the editor', 'twentytwentyfive' ),
				'get_value_callback' => 'twentytwentyfive_format_binding',
			)
		);
	}
endif;
add_action( 'init', 'twentytwentyfive_register_block_bindings' );

if ( ! function_exists( 'twentytwentyfive_format_binding' ) ) :
	/**
	 * Callback function for the post format name block binding source.
	 *
	 * @since Twenty Twenty-Five 1.0
	 *
	 * @return string|void Post format name, or nothing if the format is 'standard'.
	 */
	function twentytwentyfive_format_binding() {
		$post_format_slug = get_post_format();

		if ( $post_format_slug && 'standard' !== $post_format_slug ) {
			return get_post_format_string( $post_format_slug );
		}
	}
endif;

function hawklabs_register_newsletter_route() {
	register_rest_route(
		'hawklabs/v1',
		'/newsletter',
		array(
			'methods'             => WP_REST_Server::CREATABLE,
			'callback'            => 'hawklabs_submit_newsletter_signup',
			'permission_callback' => '__return_true',
		)
	);
}
add_action( 'rest_api_init', 'hawklabs_register_newsletter_route' );

function hawklabs_submit_newsletter_signup( WP_REST_Request $request ) {
	$name    = $request->get_param( 'name' );
	$email   = $request->get_param( 'email' );
	$consent = $request->get_param( 'consent' );
	$website = $request->get_param( 'website' );

	if ( ! is_string( $name ) || ! is_string( $email ) || ! is_string( $website ) ) {
		return new WP_Error(
			'hawklabs_invalid_signup',
			'Please provide a valid name and email address.',
			array( 'status' => 400 )
		);
	}

	$name  = sanitize_text_field( $name );
	$email = sanitize_email( $email );

	if ( '' === $name || strlen( $name ) > 100 || ! is_email( $email ) || true !== $consent ) {
		return new WP_Error(
			'hawklabs_invalid_signup',
			'Please provide a valid name and email address and consent to updates.',
			array( 'status' => 400 )
		);
	}

	if ( '' !== trim( $website ) ) {
		return new WP_Error(
			'hawklabs_invalid_signup',
			'The signup could not be accepted.',
			array( 'status' => 400 )
		);
	}

	$api_key = getenv( 'BREVO_API_KEY' );
	if ( ! is_string( $api_key ) || '' === trim( $api_key ) ) {
		return new WP_Error(
			'hawklabs_newsletter_unavailable',
			'Newsletter signup is temporarily unavailable.',
			array( 'status' => 503 )
		);
	}

	$client_ip = isset( $_SERVER['REMOTE_ADDR'] ) && is_string( $_SERVER['REMOTE_ADDR'] )
		? sanitize_text_field( wp_unslash( $_SERVER['REMOTE_ADDR'] ) )
		: '';

	if ( '' === $client_ip ) {
		return new WP_Error(
			'hawklabs_newsletter_unavailable',
			'Newsletter signup is temporarily unavailable.',
			array( 'status' => 503 )
		);
	}

	$rate_limit_key = 'hawklabs_newsletter_' . hash_hmac( 'sha256', $client_ip, wp_salt( 'auth' ) );
	$submission_count = (int) get_transient( $rate_limit_key );

	if ( $submission_count >= 5 ) {
		return new WP_Error(
			'hawklabs_rate_limit',
			'Too many signup attempts. Please try again later.',
			array( 'status' => 429 )
		);
	}

	set_transient( $rate_limit_key, $submission_count + 1, HOUR_IN_SECONDS );

	$brevo_response = wp_remote_post(
		'https://api.brevo.com/v3/contacts',
		array(
			'timeout' => 15,
			'headers' => array(
				'accept'       => 'application/json',
				'content-type' => 'application/json',
				'api-key'      => trim( $api_key ),
			),
			'body'    => wp_json_encode(
				array(
					'email'         => $email,
					'attributes'    => array(
						'FIRSTNAME' => $name,
					),
					'listIds'       => array( 2 ),
					'updateEnabled' => true,
				)
			),
		)
	);

	if ( is_wp_error( $brevo_response ) ) {
		return new WP_Error(
			'hawklabs_newsletter_upstream_error',
			'Newsletter signup could not be completed. Please try again later.',
			array( 'status' => 502 )
		);
	}

	$brevo_status = wp_remote_retrieve_response_code( $brevo_response );
	if ( $brevo_status < 200 || $brevo_status >= 300 ) {
		return new WP_Error(
			'hawklabs_newsletter_upstream_error',
			'Newsletter signup could not be completed. Please try again later.',
			array( 'status' => 502 )
		);
	}

	return new WP_REST_Response( array( 'success' => true ), 200 );
}