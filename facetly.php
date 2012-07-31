<?php
	/*
	Plugin Name: Facetly-Woocommerce
	Version: 0.1
	Description: Facetly Search Plugin for Woocommerce.
	Author: Andrew Junior
	Author URI: http://pionize.wordpress.com
	Plugin URI: http://www.facetly.com
	*/
	require_once("facetly_common.php");
	require_once("facetly_admin.php");
	require_once("facetly_fields.php");
	require_once("facetly_reindex.php");
	require_once("facetly_template.php");
	require_once('facetly_widget.php');

	function facetly_deactivated() {
    	/*delete_option('facetly_fields');
	    delete_option('facetly_settings');
	    delete_option('facetly_tplpage');
		delete_option('facetly_tplsearch');
		delete_option('facetly_tplfacet');
    	
		$unzipsource = TEMPLATEPATH. "/searchform-def-backup.zip";
		$unzipdest = TEMPLATEPATH. "/";  //folder directory must be ended with "/", example: c:/xampp/htdocs/wordpress/
		$unzip1 = unzipfile($unzipsource, $unzipdest);

    	if ( is_writable(TEMPLATEPATH) ) {
			$facetly_searchtpl = TEMPLATEPATH. "/facetly-search-template.php";
			unlink($facetly_searchtpl);
			$facetly_searchtpl = TEMPLATEPATH. "/searchform.php";
			unlink($facetly_searchtpl);
				
		}*/
	}

	register_deactivation_hook( __FILE__, 'facetly_deactivated' );
	register_uninstall_hook( __FILE__, 'facetly_deactivated' );

	function facetly_activated(){
		/*add_option('facetly_fields');
		add_option('facetly_settings');
		add_option('facetly_tplpage');
		add_option('facetly_tplsearch');
		add_option('facetly_tplfacet');*/
		$facetly_page = wp_insert_post( array(
			'post_title' => 'Facetly Search',
			'post_type' 	=> 'page',
			'post_name'	 => 'finds',
			'comment_status' => 'closed',
			'ping_status' => 'closed',
			'post_content' => '',
			'post_status' => 'publish',
			'post_author' => 1,
			'menu_order' => 0
		));
	}
	register_activation_hook( __FILE__, 'facetly_activated' );
	
	function facetly_admin_actions(){
		add_menu_page("Facetly Settings", "Facetly Settings", 'manage_options', "facetly-settings", "facetly_admin");
		add_submenu_page("facetly-settings", "Fields", "Fields", 'manage_options', "facetly-settings-fields", "facetly_fields");
		add_submenu_page("facetly-settings", "Reindex", "Reindex", 'manage_options', "facetly-settings-reindex", "facetly_reindex");
		add_submenu_page("facetly-settings", "Template", "Template", 'manage_options', "facetly-settings-template", "facetly_template");
	}
	add_action('admin_menu', 'facetly_admin_actions');

	function style(){
		wp_register_style('facetly-search-style', plugins_url('static/style/facetly.css', __FILE__));
		wp_enqueue_style('facetly-search-style');
		wp_register_style('facetly-search-autocomplete-style', plugins_url('static/style/autocomplete.css', __FILE__));
		wp_enqueue_style('facetly-search-autocomplete-style');
		wp_register_style('facetly-search-progress-bar', plugins_url('static/style/progress-bar.css', __FILE__));
		wp_enqueue_style('facetly-search-progress-bar');
		wp_register_style('facetly-jquery-dynatree-style', plugins_url('static/style/ui.dynatree.css', __FILE__));
		wp_enqueue_style('facetly-jquery-dynatree-style');
	};
	add_action ( 'wp_head', 'style');

	function js(){
		wp_register_script('facetly-search-jquery-address-js', plugins_url('static/js/jquery.address.js', __FILE__));
		wp_enqueue_script('facetly-search-jquery-address-js');
		wp_register_script('facetly-search-jquery-autocomplete-js', plugins_url('static/js/jquery.autocomplete.js', __FILE__));
		wp_enqueue_script('facetly-search-jquery-autocomplete-js');
		wp_register_script('facetly-search-facetly-js', plugins_url('static/js/facetly.js', __FILE__));
		wp_enqueue_script('facetly-search-facetly-js');
		wp_register_script('facetly-jquery-ui-custom-js', plugins_url('static/js/jquery-ui.custom.js', __FILE__));
		wp_enqueue_script('facetly-jquery-ui-custom-js');
		wp_register_script('facetly-jquery-dynatree-js', plugins_url('static/js/jquery.dynatree.js', __FILE__));
		wp_enqueue_script('facetly-jquery-dynatree-js');
		wp_register_script('facetly-jquery-dynatree-init-js', plugins_url('static/js/jquery.dynatree.init.js', __FILE__));
		wp_enqueue_script('facetly-jquery-dynatree-init-js');
	};
	add_action ( 'wp_head', 'js');

	function add_js_connection(){
		$common = get_option('facetly_settings');
		$key = $common['key'];
		$secret = $common['secret'];
		$server = $common['server'];
		$limit = $common['limit'];
		
		echo '
		<script type="text/javascript">
			var facetly = {
			    "key" : "'. $key. '",
			    "server" : "'. $server. '",
			    "file" : "finds",
			    "baseurl" : "/",
			    "limit" : "'. $limit. '",
			}
			
		</script>';
	}
	add_action('wp_head', 'add_js_connection');

	function admin_head_init(){
		wp_register_style('facetly-admin-style', plugins_url('static/style/facetly-admin.css', __FILE__));
		wp_enqueue_style('facetly-admin-style');
	}
	add_action( 'admin_head', 'admin_head_init' );

	function facetly_search(){
		static $var;
		if (empty($var)) {
			try {
				$facetly = facetly_api_init();
				$searchtype = "html";
				$query = $_GET['query'];
				$filter = $_GET;
				unset($filter['q']);
				$common = get_option('facetly_settings');
				$limit = $common['limit'];
				$filter['limit'] = $limit;
				$var = $facetly->searchProduct($query, $filter, $searchtype);			
			} catch (Exception $e) {
				$var = new StdClass();
				$var->results = $e->getMessage();
				echo '<div class="error"><p><strong>'. $var->results. '</strong></p></div>';
			}
		}
		return $var;
	}

	function include_facetly_template($t) {
		global $wp_query;
		if ($wp_query->is_404) {
			$wp_query->is_404 = false;
        	$wp_query->is_archieve = true;
			header("HTTP/1.1 200 OK");
			include($t);
			exit();
		}
	}
	function facetly_custom_template() {
		if (strstr($_SERVER['REQUEST_URI'],'/finds')) {
			include_facetly_template(TEMPLATEPATH . '/facetly-search-template.php');
		}
	}
	add_action('template_redirect', 'facetly_custom_template');

	function facetly_search_shortcode( $atts ) {
		extract( shortcode_atts( array(
			'output' => 'results',
		), $atts ) );
		$search = facetly_search();
		if ($output == 'results') {
			$return = $search->results;
		} else if ($output == 'facets') {
			$return = $search->facets;
		}
		return $return;
	}
	add_shortcode( 'facetly_search', 'facetly_search_shortcode' );