<?php
/*
Plugin Name: CMS AME Web
Description: CMS AME Web là hệ thống quản trị website chuyên nghiệp dành cho khách hàng đang sử dụng website do AME Web cung cấp và phát triển.
Donate link: https://amedigital.vn/
Author: AME Digital.
Author URI: https://amedigital.vn/
Version: 1.0
Requires at least: 4.1
Tested up to: 6.0
Requires PHP: 7.0
Domain Path: languages
Text Domain: ame-digital
License: GPLv2 or later
License URI: https://amedigital.vn/
*/

use ElementorPro\Modules\Forms\Actions\Redirect;

ob_start();

if (!defined('ABSPATH')) {
	die('-1');
}

// Plugin constants
define('WPS_HIDE_LOGIN_VERSION', '1.9.6');
define('WPS_HIDE_LOGIN_FOLDER', 'wps-hide-login');

define('WPS_HIDE_LOGIN_URL', plugin_dir_url(__FILE__));
define('WPS_HIDE_LOGIN_DIR', plugin_dir_path(__FILE__));
define('WPS_HIDE_LOGIN_BASENAME', plugin_basename(__FILE__));

require_once WPS_HIDE_LOGIN_DIR . 'autoload.php';

register_activation_hook(__FILE__, array('\WPS\WPS_Hide_Login\Plugin', 'activate'));

add_action('plugins_loaded', 'plugins_loaded_wps_hide_login_plugin');
function plugins_loaded_wps_hide_login_plugin()
{
	\WPS\WPS_Hide_Login\Plugin::get_instance();

	load_plugin_textdomain('wps-hide-login', false, dirname(WPS_HIDE_LOGIN_BASENAME) . '/languages');
}
require_once WPS_HIDE_LOGIN_DIR . 'custom-admin.php';
// 
if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

if (!class_exists('ACF')) {

	/**
	 * The main ACF class
	 */
	class ACF
	{

		/**
		 * The plugin version number.
		 *
		 * @var string
		 */
		public $version = '6.0.6';

		/**
		 * The plugin settings array.
		 *
		 * @var array
		 */
		public $settings = array();

		/**
		 * The plugin data array.
		 *
		 * @var array
		 */
		public $data = array();

		/**
		 * Storage for class instances.
		 *
		 * @var array
		 */
		public $instances = array();

		/**
		 * A dummy constructor to ensure ACF is only setup once.
		 *
		 * @date    23/06/12
		 * @since   5.0.0
		 *
		 * @return  void
		 */
		public function __construct()
		{
			// Do nothing.
		}

		/**
		 * Sets up the ACF plugin.
		 *
		 * @date    28/09/13
		 * @since   5.0.0
		 *
		 * @return  void
		 */
		public function initialize()
		{

			// Define constants.
			$this->define('ACF', true);
			$this->define('ACF_PATH', plugin_dir_path(__FILE__));
			$this->define('ACF_BASENAME', plugin_basename(__FILE__));
			$this->define('ACF_VERSION', $this->version);
			$this->define('ACF_MAJOR_VERSION', 6);
			$this->define('ACF_FIELD_API_VERSION', 5);
			$this->define('ACF_UPGRADE_VERSION', '5.5.0'); // Highest version with an upgrade routine. See upgrades.php.

			// Define settings.
			$this->settings = array(
				'name' => __('Advanced Custom Fields', 'acf'),
				'slug' => dirname(ACF_BASENAME),
				'version' => ACF_VERSION,
				'basename' => ACF_BASENAME,
				'path' => ACF_PATH,
				'file' => __FILE__,
				'url' => plugin_dir_url(__FILE__),
				'show_admin' => true,
				'show_updates' => true,
				'stripslashes' => false,
				'local' => true,
				'json' => true,
				'save_json' => '',
				'load_json' => array(),
				'default_language' => '',
				'current_language' => '',
				'capability' => 'manage_options',
				'uploader' => 'wp',
				'autoload' => false,
				'l10n' => true,
				'l10n_textdomain' => '',
				'google_api_key' => '',
				'google_api_client' => '',
				'enqueue_google_maps' => true,
				'enqueue_select2' => true,
				'enqueue_datepicker' => true,
				'enqueue_datetimepicker' => true,
				'select2_version' => 4,
				'row_index_offset' => 1,
				'remove_wp_meta_box' => true,
				'rest_api_enabled' => true,
				'rest_api_format' => 'light',
				'rest_api_embed_links' => true,
				'preload_blocks' => true,
				'enable_shortcode' => true,
			);

			// Include utility functions.
			include_once ACF_PATH . 'includes/acf-utility-functions.php';

			// Include previous API functions.
			acf_include('includes/api/api-helpers.php');
			acf_include('includes/api/api-template.php');
			acf_include('includes/api/api-term.php');

			// Include classes.
			acf_include('includes/class-acf-data.php');
			acf_include('includes/fields/class-acf-field.php');
			acf_include('includes/locations/abstract-acf-legacy-location.php');
			acf_include('includes/locations/abstract-acf-location.php');

			// Include functions.
			acf_include('includes/acf-helper-functions.php');
			acf_include('includes/acf-hook-functions.php');
			acf_include('includes/acf-field-functions.php');
			acf_include('includes/acf-field-group-functions.php');
			acf_include('includes/acf-form-functions.php');
			acf_include('includes/acf-meta-functions.php');
			acf_include('includes/acf-post-functions.php');
			acf_include('includes/acf-user-functions.php');
			acf_include('includes/acf-value-functions.php');
			acf_include('includes/acf-input-functions.php');
			acf_include('includes/acf-wp-functions.php');

			// Include core.
			acf_include('includes/fields.php');
			acf_include('includes/locations.php');
			acf_include('includes/assets.php');
			acf_include('includes/compatibility.php');
			acf_include('includes/deprecated.php');
			acf_include('includes/l10n.php');
			acf_include('includes/local-fields.php');
			acf_include('includes/local-meta.php');
			acf_include('includes/local-json.php');
			acf_include('includes/loop.php');
			acf_include('includes/media.php');
			acf_include('includes/revisions.php');
			acf_include('includes/updates.php');
			acf_include('includes/upgrades.php');
			acf_include('includes/validation.php');
			acf_include('includes/rest-api.php');

			// Include ajax.
			acf_include('includes/ajax/class-acf-ajax.php');
			acf_include('includes/ajax/class-acf-ajax-check-screen.php');
			acf_include('includes/ajax/class-acf-ajax-user-setting.php');
			acf_include('includes/ajax/class-acf-ajax-upgrade.php');
			acf_include('includes/ajax/class-acf-ajax-query.php');
			acf_include('includes/ajax/class-acf-ajax-query-users.php');
			acf_include('includes/ajax/class-acf-ajax-local-json-diff.php');

			// Include forms.
			acf_include('includes/forms/form-attachment.php');
			acf_include('includes/forms/form-comment.php');
			acf_include('includes/forms/form-customizer.php');
			acf_include('includes/forms/form-front.php');
			acf_include('includes/forms/form-nav-menu.php');
			acf_include('includes/forms/form-post.php');
			acf_include('includes/forms/form-gutenberg.php');
			acf_include('includes/forms/form-taxonomy.php');
			acf_include('includes/forms/form-user.php');
			acf_include('includes/forms/form-widget.php');

			// Include admin.
			if (is_admin()) {
				acf_include('includes/admin/admin.php');
				acf_include('includes/admin/admin-field-group.php');
				acf_include('includes/admin/admin-field-groups.php');
				acf_include('includes/admin/admin-notices.php');
				acf_include('includes/admin/admin-tools.php');
				acf_include('includes/admin/admin-upgrade.php');
			}

			// Include legacy.
			acf_include('includes/legacy/legacy-locations.php');

			// Include PRO.
			acf_include('pro/acf-pro.php');

			// Add actions.
			add_action('init', array($this, 'init'), 5);
			add_action('init', array($this, 'register_post_types'), 5);
			add_action('init', array($this, 'register_post_status'), 5);
			add_action('activated_plugin', array($this, 'deactivate_other_instances'));
			add_action('pre_current_active_plugins', array($this, 'plugin_deactivated_notice'));

			// Add filters.
			add_filter('posts_where', array($this, 'posts_where'), 10, 2);
		}

		/**
		 * Completes the setup process on "init" of earlier.
		 *
		 * @date    28/09/13
		 * @since   5.0.0
		 *
		 * @return  void
		 */
		public function init()
		{

			// Bail early if called directly from functions.php or plugin file.
			if (!did_action('plugins_loaded')) {
				return;
			}

			// This function may be called directly from template functions. Bail early if already did this.
			if (acf_did('init')) {
				return;
			}

			// Update url setting. Allows other plugins to modify the URL (force SSL).
			acf_update_setting('url', plugin_dir_url(__FILE__));

			// Load textdomain file.
			acf_load_textdomain();

			// Include 3rd party compatiblity.
			acf_include('includes/third-party.php');

			// Include wpml support.
			if (defined('ICL_SITEPRESS_VERSION')) {
				acf_include('includes/wpml.php');
			}

			// Include fields.
			acf_include('includes/fields/class-acf-field-text.php');
			acf_include('includes/fields/class-acf-field-textarea.php');
			acf_include('includes/fields/class-acf-field-number.php');
			acf_include('includes/fields/class-acf-field-range.php');
			acf_include('includes/fields/class-acf-field-email.php');
			acf_include('includes/fields/class-acf-field-url.php');
			acf_include('includes/fields/class-acf-field-password.php');
			acf_include('includes/fields/class-acf-field-image.php');
			acf_include('includes/fields/class-acf-field-file.php');
			acf_include('includes/fields/class-acf-field-wysiwyg.php');
			acf_include('includes/fields/class-acf-field-oembed.php');
			acf_include('includes/fields/class-acf-field-select.php');
			acf_include('includes/fields/class-acf-field-checkbox.php');
			acf_include('includes/fields/class-acf-field-radio.php');
			acf_include('includes/fields/class-acf-field-button-group.php');
			acf_include('includes/fields/class-acf-field-true_false.php');
			acf_include('includes/fields/class-acf-field-link.php');
			acf_include('includes/fields/class-acf-field-post_object.php');
			acf_include('includes/fields/class-acf-field-page_link.php');
			acf_include('includes/fields/class-acf-field-relationship.php');
			acf_include('includes/fields/class-acf-field-taxonomy.php');
			acf_include('includes/fields/class-acf-field-user.php');
			acf_include('includes/fields/class-acf-field-google-map.php');
			acf_include('includes/fields/class-acf-field-date_picker.php');
			acf_include('includes/fields/class-acf-field-date_time_picker.php');
			acf_include('includes/fields/class-acf-field-time_picker.php');
			acf_include('includes/fields/class-acf-field-color_picker.php');
			acf_include('includes/fields/class-acf-field-message.php');
			acf_include('includes/fields/class-acf-field-accordion.php');
			acf_include('includes/fields/class-acf-field-tab.php');
			acf_include('includes/fields/class-acf-field-group.php');

			/**
			 * Fires after field types have been included.
			 *
			 * @date    28/09/13
			 * @since   5.0.0
			 *
			 * @param   int ACF_FIELD_API_VERSION The field API version.
			 */
			do_action('acf/include_field_types', ACF_FIELD_API_VERSION);

			// Include locations.
			acf_include('includes/locations/class-acf-location-post-type.php');
			acf_include('includes/locations/class-acf-location-post-template.php');
			acf_include('includes/locations/class-acf-location-post-status.php');
			acf_include('includes/locations/class-acf-location-post-format.php');
			acf_include('includes/locations/class-acf-location-post-category.php');
			acf_include('includes/locations/class-acf-location-post-taxonomy.php');
			acf_include('includes/locations/class-acf-location-post.php');
			acf_include('includes/locations/class-acf-location-page-template.php');
			acf_include('includes/locations/class-acf-location-page-type.php');
			acf_include('includes/locations/class-acf-location-page-parent.php');
			acf_include('includes/locations/class-acf-location-page.php');
			acf_include('includes/locations/class-acf-location-current-user.php');
			acf_include('includes/locations/class-acf-location-current-user-role.php');
			acf_include('includes/locations/class-acf-location-user-form.php');
			acf_include('includes/locations/class-acf-location-user-role.php');
			acf_include('includes/locations/class-acf-location-taxonomy.php');
			acf_include('includes/locations/class-acf-location-attachment.php');
			acf_include('includes/locations/class-acf-location-comment.php');
			acf_include('includes/locations/class-acf-location-widget.php');
			acf_include('includes/locations/class-acf-location-nav-menu.php');
			acf_include('includes/locations/class-acf-location-nav-menu-item.php');

			/**
			 * Fires after location types have been included.
			 *
			 * @date    28/09/13
			 * @since   5.0.0
			 *
			 * @param   int ACF_FIELD_API_VERSION The field API version.
			 */
			do_action('acf/include_location_rules', ACF_FIELD_API_VERSION);

			/**
			 * Fires during initialization. Used to add local fields.
			 *
			 * @date    28/09/13
			 * @since   5.0.0
			 *
			 * @param   int ACF_FIELD_API_VERSION The field API version.
			 */
			do_action('acf/include_fields', ACF_FIELD_API_VERSION);

			/**
			 * Fires after ACF is completely "initialized".
			 *
			 * @date    28/09/13
			 * @since   5.0.0
			 *
			 * @param   int ACF_MAJOR_VERSION The major version of ACF.
			 */
			do_action('acf/init', ACF_MAJOR_VERSION);
		}

		/**
		 * Registers the ACF post types.
		 *
		 * @date    22/10/2015
		 * @since   5.3.2
		 *
		 * @return  void
		 */
		public function register_post_types()
		{

			// Vars.
			$cap = acf_get_setting('capability');

			// Register the Field Group post type.
			register_post_type(
				'acf-field-group',
				array(
					'labels' => array(
						'name' => __('CÁC TRƯỜNG', 'acf'),
						'singular_name' => __('Field Group', 'acf'),
						'add_new' => __('Thêm mới', 'acf'),
						'add_new_item' => __('Add New Field Group', 'acf'),
						'edit_item' => __('Edit Field Group', 'acf'),
						'new_item' => __('New Field Group', 'acf'),
						'view_item' => __('View Field Group', 'acf'),
						'search_items' => __('Tìm kiếm trường ', 'acf'),
						'not_found' => __('No Field Groups found', 'acf'),
						'not_found_in_trash' => __('No Field Groups found in Trash', 'acf'),
					),
					'public' => false,
					'hierarchical' => true,
					'show_ui' => true,
					'show_in_menu' => false,
					'_builtin' => false,
					'capability_type' => 'post',
					'capabilities' => array(
						'edit_post' => $cap,
						'delete_post' => $cap,
						'edit_posts' => $cap,
						'delete_posts' => $cap,
					),
					'supports' => false,
					'rewrite' => false,
					'query_var' => false,
				)
			);

			// Register the Field post type.
			register_post_type(
				'acf-field',
				array(
					'labels' => array(
						'name' => __('Fields', 'acf'),
						'singular_name' => __('Field', 'acf'),
						'add_new' => __('Add New', 'acf'),
						'add_new_item' => __('Add New Field', 'acf'),
						'edit_item' => __('Edit Field', 'acf'),
						'new_item' => __('New Field', 'acf'),
						'view_item' => __('View Field', 'acf'),
						'search_items' => __('Search Fields', 'acf'),
						'not_found' => __('No Fields found', 'acf'),
						'not_found_in_trash' => __('No Fields found in Trash', 'acf'),
					),
					'public' => false,
					'hierarchical' => true,
					'show_ui' => false,
					'show_in_menu' => false,
					'_builtin' => false,
					'capability_type' => 'post',
					'capabilities' => array(
						'edit_post' => $cap,
						'delete_post' => $cap,
						'edit_posts' => $cap,
						'delete_posts' => $cap,
					),
					'supports' => array('title'),
					'rewrite' => false,
					'query_var' => false,
				)
			);
		}

		/**
		 * Registers the ACF post statuses.
		 *
		 * @date    22/10/2015
		 * @since   5.3.2
		 *
		 * @return  void
		 */
		public function register_post_status()
		{

			// Register the Inactive post status.
			register_post_status(
				'acf-disabled',
				array(
					'label' => _x('Inactive', 'post status', 'acf'),
					'public' => true,
					'exclude_from_search' => false,
					'show_in_admin_all_list' => true,
					'show_in_admin_status_list' => true,
					/* translators: counts for inactive field groups */
					'label_count' => _n_noop('Inactive <span class="count">(%s)</span>', 'Inactive <span class="count">(%s)</span>', 'acf'),
				)
			);
		}

		/**
		 * Checks if another version of ACF/ACF PRO is active and deactivates it.
		 * Hooked on `activated_plugin` so other plugin is deactivated when current plugin is activated.
		 *
		 * @param string $plugin The plugin being activated.
		 */
		public function deactivate_other_instances($plugin)
		{
			if (!in_array($plugin, array('advanced-custom-fields/acf.php', 'advanced-custom-fields-pro/acf.php'), true)) {
				return;
			}

			$plugin_to_deactivate = 'advanced-custom-fields/acf.php';
			$deactivated_notice_id = '1';

			// If we just activated the free version, deactivate the pro version.
			if ($plugin === $plugin_to_deactivate) {
				$plugin_to_deactivate = 'advanced-custom-fields-pro/acf.php';
				$deactivated_notice_id = '2';
			}

			if (is_multisite() && is_network_admin()) {
				$active_plugins = (array) get_site_option('active_sitewide_plugins', array());
				$active_plugins = array_keys($active_plugins);
			} else {
				$active_plugins = (array) get_option('active_plugins', array());
			}

			foreach ($active_plugins as $plugin_basename) {
				if ($plugin_to_deactivate === $plugin_basename) {
					set_transient('acf_deactivated_notice_id', $deactivated_notice_id, 1 * HOUR_IN_SECONDS);
					deactivate_plugins($plugin_basename);
					return;
				}
			}
		}

		/**
		 * Displays a notice when either ACF or ACF PRO is automatically deactivated.
		 */
		public function plugin_deactivated_notice()
		{
			$deactivated_notice_id = (int) get_transient('acf_deactivated_notice_id');
			if (!in_array($deactivated_notice_id, array(1, 2), true)) {
				return;
			}

			$message = __("Advanced Custom Fields and Advanced Custom Fields should not be active at the same time. We've automatically deactivated Advanced Custom Fields.", 'acf');
			if (2 === $deactivated_notice_id) {
				$message = __("Advanced Custom Fields and Advanced Custom Fields should not be active at the same time. We've automatically deactivated Advanced Custom Fields PRO.", 'acf');
			}

			?>
			<div class="updated" style="border-left: 4px solid #ffba00;">
				<p><?php echo esc_html($message); ?></p>
			</div>
			<?php

			delete_transient('acf_deactivated_notice_id');
		}

		/**
		 * Filters the $where clause allowing for custom WP_Query args.
		 *
		 * @date    31/8/19
		 * @since   5.8.1
		 *
		 * @param   string   $where The WHERE clause.
		 * @param   WP_Query $wp_query The query object.
		 * @return  WP_Query $wp_query The query object.
		 */
		public function posts_where($where, $wp_query)
		{
			global $wpdb;

			$field_key = $wp_query->get('acf_field_key');
			$field_name = $wp_query->get('acf_field_name');
			$group_key = $wp_query->get('acf_group_key');

			// Add custom "acf_field_key" arg.
			if ($field_key) {
				$where .= $wpdb->prepare(" AND {$wpdb->posts}.post_name = %s", $field_key);
			}

			// Add custom "acf_field_name" arg.
			if ($field_name) {
				$where .= $wpdb->prepare(" AND {$wpdb->posts}.post_excerpt = %s", $field_name);
			}

			// Add custom "acf_group_key" arg.
			if ($group_key) {
				$where .= $wpdb->prepare(" AND {$wpdb->posts}.post_name = %s", $group_key);
			}

			// Return.
			return $where;
		}

		/**
		 * Defines a constant if doesnt already exist.
		 *
		 * @date    3/5/17
		 * @since   5.5.13
		 *
		 * @param   string $name The constant name.
		 * @param   mixed  $value The constant value.
		 * @return  void
		 */
		public function define($name, $value = true)
		{
			if (!defined($name)) {
				define($name, $value);
			}
		}

		/**
		 * Returns true if a setting exists for this name.
		 *
		 * @date    2/2/18
		 * @since   5.6.5
		 *
		 * @param   string $name The setting name.
		 * @return  boolean
		 */
		public function has_setting($name)
		{
			return isset($this->settings[$name]);
		}

		/**
		 * Returns a setting or null if doesn't exist.
		 *
		 * @date    28/09/13
		 * @since   5.0.0
		 *
		 * @param   string $name The setting name.
		 * @return  mixed
		 */
		public function get_setting($name)
		{
			return isset($this->settings[$name]) ? $this->settings[$name] : null;
		}

		/**
		 * Updates a setting for the given name and value.
		 *
		 * @date    28/09/13
		 * @since   5.0.0
		 *
		 * @param   string $name The setting name.
		 * @param   mixed  $value The setting value.
		 * @return  true
		 */
		public function update_setting($name, $value)
		{
			$this->settings[$name] = $value;
			return true;
		}

		/**
		 * Returns data or null if doesn't exist.
		 *
		 * @date    28/09/13
		 * @since   5.0.0
		 *
		 * @param   string $name The data name.
		 * @return  mixed
		 */
		public function get_data($name)
		{
			return isset($this->data[$name]) ? $this->data[$name] : null;
		}

		/**
		 * Sets data for the given name and value.
		 *
		 * @date    28/09/13
		 * @since   5.0.0
		 *
		 * @param   string $name The data name.
		 * @param   mixed  $value The data value.
		 * @return  void
		 */
		public function set_data($name, $value)
		{
			$this->data[$name] = $value;
		}

		/**
		 * Returns an instance or null if doesn't exist.
		 *
		 * @date    13/2/18
		 * @since   5.6.9
		 *
		 * @param   string $class The instance class name.
		 * @return  object
		 */
		public function get_instance($class)
		{
			$name = strtolower($class);
			return isset($this->instances[$name]) ? $this->instances[$name] : null;
		}

		/**
		 * Creates and stores an instance of the given class.
		 *
		 * @date    13/2/18
		 * @since   5.6.9
		 *
		 * @param   string $class The instance class name.
		 * @return  object
		 */
		public function new_instance($class)
		{
			$instance = new $class();
			$name = strtolower($class);
			$this->instances[$name] = $instance;
			return $instance;
		}

		/**
		 * Magic __isset method for backwards compatibility.
		 *
		 * @date    24/4/20
		 * @since   5.9.0
		 *
		 * @param   string $key Key name.
		 * @return  bool
		 */
		public function __isset($key)
		{
			return in_array($key, array('locations', 'json'), true);
		}

		/**
		 * Magic __get method for backwards compatibility.
		 *
		 * @date    24/4/20
		 * @since   5.9.0
		 *
		 * @param   string $key Key name.
		 * @return  mixed
		 */
		public function __get($key)
		{
			switch ($key) {
				case 'locations':
					return acf_get_instance('ACF_Legacy_Locations');
				case 'json':
					return acf_get_instance('ACF_Local_JSON');
			}
			return null;
		}
	}

	/**
	 * The main function responsible for returning the one true acf Instance to functions everywhere.
	 * Use this function like you would a global variable, except without needing to declare the global.
	 *
	 * Example: <?php $acf = acf(); ?>
	 *
	 * @date 4/09/13
	 * @since 4.3.0
	 *
	 * @return ACF
	 */
	function acf()
	{
		global $acf;

		// Instantiate only once.
		if (!isset($acf)) {
			$acf = new ACF();
			$acf->initialize();
		}
		return $acf;
	}

	// Instantiate.
	acf();
} // class_exists check


// Start CPT-UI
// Exit if accessed directly.
if (!defined('ABSPATH')) {
	exit;
}

define('CPT_VERSION', '1.13.4'); // Left for legacy purposes.
define('CPTUI_VERSION', '1.13.4');
define('CPTUI_WP_VERSION', get_bloginfo('version'));

/**
 * Load our Admin UI class that powers our form inputs.
 *
 * @since 1.0.0
 *
 * @internal
 */
function cptui_load_ui_class()
{
	require_once plugin_dir_path(__FILE__) . 'classes/class.cptui_admin_ui.php';
	require_once plugin_dir_path(__FILE__) . 'classes/class.cptui_debug_info.php';
}
add_action('init', 'cptui_load_ui_class');

/**
 * Set a transient used for redirection upon activation.
 *
 * @since 1.4.0
 */
function cptui_activation_redirect()
{
	// Bail if activating from network, or bulk.
	if (is_network_admin()) {
		return;
	}

	// Add the transient to redirect.
	set_transient('cptui_activation_redirect', true, 30);
}
add_action('activate_' . plugin_basename(__FILE__), 'cptui_activation_redirect');

/**
 * Redirect user to CPTUI about page upon plugin activation.
 *
 * @since 1.4.0
 */
function cptui_make_activation_redirect()
{

	if (!get_transient('cptui_activation_redirect')) {
		return;
	}

	delete_transient('cptui_activation_redirect');

	// Bail if activating from network, or bulk.
	if (is_network_admin()) {
		return;
	}

	if (!cptui_is_new_install()) {
		return;
	}

	// Redirect to CPTUI about page.
	wp_safe_redirect(
		add_query_arg(
			['page' => 'cptui_main_menu'],
			cptui_admin_url('admin.php?page=cptui_main_menu')
		)
	);
}
add_action('admin_init', 'cptui_make_activation_redirect', 1);

/**
 * Flush our rewrite rules on deactivation.
 *
 * @since 0.8.0
 *
 * @internal
 */
function cptui_deactivation()
{
	flush_rewrite_rules();
}
register_deactivation_hook(__FILE__, 'cptui_deactivation');

/**
 * Register our text domain.
 *
 * @since 0.8.0
 *
 * @internal
 */
function cptui_load_textdomain()
{
	load_plugin_textdomain('custom-post-type-ui');
}
add_action('plugins_loaded', 'cptui_load_textdomain');

/**
 * Load our main menu.
 *
 * Submenu items added in version 1.1.0
 *
 * @since 0.1.0
 *
 * @internal
 */
function cptui_plugin_menu()
{

	/**
	 * Filters the required capability to manage CPTUI settings.
	 *
	 * @since 1.3.0
	 *
	 * @param string $value Capability required.
	 */
	$capability = apply_filters('cptui_required_capabilities', 'manage_options');
	$parent_slug = 'cptui_main_menu';

	add_menu_page(
		__('Custom Post Types', 'custom-post-type-ui'),
		__('CPT UI', 'custom-post-type-ui'),
		$capability,
		$parent_slug,
		'cptui_settings',
		cptui_menu_icon()
	);
	add_submenu_page($parent_slug, __('Thêm/Sửa Post Types', 'custom-post-type-ui'), __(
		'Thêm/Sửa Post Types',
		'custom-post-type-ui'
	), $capability, 'cptui_manage_post_types', 'cptui_manage_post_types');
	add_submenu_page($parent_slug, __('Thêm/Sửa Taxonomies', 'custom-post-type-ui'), __(
		'Thêm/Sửa Taxonomies',
		'custom-post-type-ui'
	), $capability, 'cptui_manage_taxonomies', 'cptui_manage_taxonomies');
	// add_submenu_page($parent_slug, __('Add/Edit Post Types', 'custom-post-type-ui'), __('Add/Edit Post Types',
// 'custom-post-type-ui'), $capability, 'cptui_manage_post_types', 'cptui_manage_post_types');
// // add_submenu_page($parent_slug, __('Add/Edit Taxonomies', 'custom-post-type-ui'), __('Add/Edit Taxonomies',
// 'custom-post-type-ui'), $capability, 'cptui_manage_taxonomies', 'cptui_manage_taxonomies');
	add_submenu_page($parent_slug, __('Registered Types and Taxes', 'custom-post-type-ui'), __(
		'Registered Types/Taxes',
		'custom-post-type-ui'
	), $capability, 'cptui_listings', 'cptui_listings');
	add_submenu_page($parent_slug, __('Custom Post Type UI Tools', 'custom-post-type-ui'), __(
		'Tools',
		'custom-post-type-ui'
	), $capability, 'cptui_tools', 'cptui_tools');
	add_submenu_page(
		$parent_slug,
		__('Help/Support', 'custom-post-type-ui'),
		__('Help/Support', 'custom-post-type-ui'),
		$capability,
		'cptui_support',
		'cptui_support'
	);

	/**
	 * Fires after the default submenu pages.
	 *
	 * @since 1.3.0
	 *
	 * @param string $value Parent slug for Custom Post Type UI menu.
	 * @param string $capability Capability required to manage CPTUI settings.
	 */
	do_action('cptui_extra_menu_items', $parent_slug, $capability);

	// Remove the default one so we can add our customized version.
	remove_submenu_page($parent_slug, 'cptui_main_menu');
	add_submenu_page(
		$parent_slug,
		__('About CPT UI', 'custom-post-type-ui'),
		__('About CPT UI', 'custom-post-type-ui'),
		$capability,
		'cptui_main_menu',
		'cptui_settings'
	);
}
add_action('admin_menu', 'cptui_plugin_menu');

/**
 * Fire our CPTUI Loaded hook.
 *
 * @since 1.3.0
 *
 * @internal Use `cptui_loaded` hook.
 */
function cptui_loaded()
{

	if (class_exists('WPGraphQL')) {
		require_once plugin_dir_path(__FILE__) . 'external/wpgraphql.php';
	}

	/**
	 * Fires upon plugins_loaded WordPress hook.
	 *
	 * CPTUI loads its required files on this hook.
	 *
	 * @since 1.3.0
	 */
	do_action('cptui_loaded');
}
add_action('plugins_loaded', 'cptui_loaded');

/**
 * Load our submenus.
 *
 * @since 1.0.0
 *
 * @internal
 */
function cptui_create_submenus()
{
	require_once plugin_dir_path(__FILE__) . 'inc/about.php';
	require_once plugin_dir_path(__FILE__) . 'inc/utility.php';
	require_once plugin_dir_path(__FILE__) . 'inc/post-types.php';
	require_once plugin_dir_path(__FILE__) . 'inc/taxonomies.php';
	require_once plugin_dir_path(__FILE__) . 'inc/listings.php';
	require_once plugin_dir_path(__FILE__) . 'inc/tools.php';
	require_once plugin_dir_path(__FILE__) . 'inc/tools-sections/tools-post-types.php';
	require_once plugin_dir_path(__FILE__) . 'inc/tools-sections/tools-taxonomies.php';
	require_once plugin_dir_path(__FILE__) . 'inc/tools-sections/tools-get-code.php';
	require_once plugin_dir_path(__FILE__) . 'inc/tools-sections/tools-debug.php';
	require_once plugin_dir_path(__FILE__) . 'inc/support.php';

	if (defined('WP_CLI') && WP_CLI) {
		require_once plugin_dir_path(__FILE__) . 'inc/wp-cli.php';
	}
}
add_action('cptui_loaded', 'cptui_create_submenus');

/**
 * Fire our CPTUI init hook.
 *
 * @since 1.3.0
 *
 * @internal Use `cptui_init` hook.
 */
function cptui_init()
{

	/**
	 * Fires upon init WordPress hook.
	 *
	 * @since 1.3.0
	 */
	do_action('cptui_init');
}
add_action('init', 'cptui_init');

/**
 * Enqueue CPTUI admin styles.
 *
 * @since 1.0.0
 *
 * @internal
 */
function cptui_add_styles()
{
	if (wp_doing_ajax()) {
		return;
	}
	$min = defined('SCRIPT_DEBUG') && SCRIPT_DEBUG ? '' : '.min';
	wp_register_script('cptui', plugins_url("build/cptui-scripts{$min}.js", __FILE__), [
		'jquery',
		'jquery-ui-dialog',
		'postbox'
	], CPTUI_VERSION, true);
	wp_register_script(
		'dashicons-picker',
		plugins_url("build/dashicons-picker{$min}.js", __FILE__),
		['jquery'],
		'1.0.0',
		true
	);
	wp_register_style(
		'cptui-css',
		plugins_url("build/cptui-styles{$min}.css", __FILE__),
		['wp-jquery-ui-dialog'],
		CPTUI_VERSION
	);
}
add_action('admin_enqueue_scripts', 'cptui_add_styles');

/**
 * Register our users' custom post types.
 *
 * @since 0.5.0
 *
 * @internal
 */
function cptui_create_custom_post_types()
{
	$cpts = get_option('cptui_post_types', []);
	/**
	 * Filters an override array of post type data to be registered instead of our saved option.
	 *
	 * @since 1.10.0
	 *
	 * @param array $value Default override value.
	 */
	$cpts_override = apply_filters('cptui_post_types_override', []);

	if (empty($cpts) && empty($cpts_override)) {
		return;
	}

	// Assume good intent, and we're also not wrecking the option so things are always reversable.
	if (is_array($cpts_override) && !empty($cpts_override)) {
		$cpts = $cpts_override;
	}

	/**
	 * Fires before the start of the post type registrations.
	 *
	 * @since 1.3.0
	 *
	 * @param array $cpts Array of post types to register.
	 */
	do_action('cptui_pre_register_post_types', $cpts);

	if (is_array($cpts)) {
		foreach ($cpts as $post_type) {

			/**
			 * Filters whether or not to skip registration of the current iterated post type.
			 *
			 * Dynamic part of the filter name is the chosen post type slug.
			 *
			 * @since 1.7.0
			 *
			 * @param bool $value Whether or not to skip the post type.
			 * @param array $post_type Current post type being registered.
			 */
			if ((bool) apply_filters("cptui_disable_{$post_type['name']}_cpt", false, $post_type)) {
				continue;
			}

			/**
			 * Filters whether or not to skip registration of the current iterated post type.
			 *
			 * @since 1.7.0
			 *
			 * @param bool $value Whether or not to skip the post type.
			 * @param array $post_type Current post type being registered.
			 */
			if ((bool) apply_filters('cptui_disable_cpt', false, $post_type)) {
				continue;
			}

			cptui_register_single_post_type($post_type);
		}
	}

	/**
	 * Fires after the completion of the post type registrations.
	 *
	 * @since 1.3.0
	 *
	 * @param array $cpts Array of post types registered.
	 */
	do_action('cptui_post_register_post_types', $cpts);
}
add_action('init', 'cptui_create_custom_post_types', 10); // Leave on standard init for legacy purposes.

/**
 * Helper function to register the actual post_type.
 *
 * @since 1.0.0
 *
 * @internal
 *
 * @param array $post_type Post type array to register. Optional.
 * @return null Result of register_post_type.
 */
function cptui_register_single_post_type($post_type = [])
{

	/**
	 * Filters the map_meta_cap value.
	 *
	 * @since 1.0.0
	 *
	 * @param bool $value True.
	 * @param string $name Post type name being registered.
	 * @param array $post_type All parameters for post type registration.
	 */
	$post_type['map_meta_cap'] = apply_filters('cptui_map_meta_cap', true, $post_type['name'], $post_type);

	if (empty($post_type['supports'])) {
		$post_type['supports'] = [];
	}

	/**
	 * Filters custom supports parameters for 3rd party plugins.
	 *
	 * @since 1.0.0
	 *
	 * @param array $value Empty array to add supports keys to.
	 * @param string $name Post type slug being registered.
	 * @param array $post_type Array of post type arguments to be registered.
	 */
	$user_supports_params = apply_filters('cptui_user_supports_params', [], $post_type['name'], $post_type);

	if (is_array($user_supports_params) && !empty($user_supports_params)) {
		if (is_array($post_type['supports'])) {
			$post_type['supports'] = array_merge($post_type['supports'], $user_supports_params);
		} else {
			$post_type['supports'] = [$user_supports_params];
		}
	}

	$yarpp = false; // Prevent notices.
	if (!empty($post_type['custom_supports'])) {
		$custom = explode(',', $post_type['custom_supports']);
		foreach ($custom as $part) {
			// We'll handle YARPP separately.
			if (in_array($part, ['YARPP', 'yarpp'], true)) {
				$yarpp = true;
				continue;
			}
			$post_type['supports'][] = trim($part);
		}
	}

	if (isset($post_type['supports']) && is_array($post_type['supports']) && in_array('none', $post_type['supports'], true)) {
		$post_type['supports'] = false;
	}

	$labels = [
		'name' => $post_type['label'],
		'singular_name' => $post_type['singular_label'],
	];

	$preserved = cptui_get_preserved_keys('post_types');
	$preserved_labels = cptui_get_preserved_labels();
	foreach ($post_type['labels'] as $key => $label) {

		if (!empty($label)) {
			if ('parent' === $key) {
				$labels['parent_item_colon'] = $label;
			} else {
				$labels[$key] = $label;
			}
		} elseif (empty($label) && in_array($key, $preserved, true)) {
			$singular_or_plural = (in_array($key, array_keys($preserved_labels['post_types']['plural']))) ? 'plural' : 'singular';
			// phpcs:ignore.
			$label_plurality = ('plural' === $singular_or_plural) ? $post_type['label'] : $post_type['singular_label'];
			$labels[$key] = sprintf($preserved_labels['post_types'][$singular_or_plural][$key], $label_plurality);
		}
	}

	$has_archive = isset($post_type['has_archive']) ? get_disp_boolean($post_type['has_archive']) : false;
	if ($has_archive && !empty($post_type['has_archive_string'])) {
		$has_archive = $post_type['has_archive_string'];
	}

	$show_in_menu = get_disp_boolean($post_type['show_in_menu']);
	if (!empty($post_type['show_in_menu_string'])) {
		$show_in_menu = $post_type['show_in_menu_string'];
	}

	$rewrite = get_disp_boolean($post_type['rewrite']);
	if (false !== $rewrite) {
		// Core converts to an empty array anyway, so safe to leave this instead of passing in boolean true.
		$rewrite = [];
		$rewrite['slug'] = !empty($post_type['rewrite_slug']) ? $post_type['rewrite_slug'] : $post_type['name'];

		$rewrite['with_front'] = true; // Default value.
		if (isset($post_type['rewrite_withfront'])) {
			$rewrite['with_front'] = 'false' === disp_boolean($post_type['rewrite_withfront']) ? false : true;
		}
	}

	$menu_icon = !empty($post_type['menu_icon']) ? $post_type['menu_icon'] : null;
	$register_meta_box_cb = !empty($post_type['register_meta_box_cb']) ? $post_type['register_meta_box_cb'] : null;

	if (in_array($post_type['query_var'], ['true', 'false', '0', '1'], true)) {
		$post_type['query_var'] = get_disp_boolean($post_type['query_var']);
	}
	if (!empty($post_type['query_var_slug'])) {
		$post_type['query_var'] = $post_type['query_var_slug'];
	}

	$menu_position = null;
	if (!empty($post_type['menu_position'])) {
		$menu_position = (int) $post_type['menu_position'];
	}

	$delete_with_user = null;
	if (!empty($post_type['delete_with_user'])) {
		$delete_with_user = get_disp_boolean($post_type['delete_with_user']);
	}

	$capability_type = 'post';
	if (!empty($post_type['capability_type'])) {
		$capability_type = $post_type['capability_type'];
		if (false !== strpos($post_type['capability_type'], ',')) {
			$caps = array_map('trim', explode(',', $post_type['capability_type']));
			if (count($caps) > 2) {
				$caps = array_slice($caps, 0, 2);
			}
			$capability_type = $caps;
		}
	}

	$public = get_disp_boolean($post_type['public']);
	if (!empty($post_type['exclude_from_search'])) {
		$exclude_from_search = get_disp_boolean($post_type['exclude_from_search']);
	} else {
		$exclude_from_search = false === $public;
	}

	$queryable = (!empty($post_type['publicly_queryable']) && isset($post_type['publicly_queryable'])) ? 
		get_disp_boolean($post_type['publicly_queryable']) : $public;

	if (empty($post_type['show_in_nav_menus'])) {
		// Defaults to value of public.
		$post_type['show_in_nav_menus'] = $public;
	}

	if (empty($post_type['show_in_rest'])) {
		$post_type['show_in_rest'] = false;
	}

	$rest_base = null;
	if (!empty($post_type['rest_base'])) {
		$rest_base = $post_type['rest_base'];
	}

	$rest_controller_class = null;
	if (!empty($post_type['rest_controller_class'])) {
		$rest_controller_class = $post_type['rest_controller_class'];
	}

	$rest_namespace = null;
	if (!empty($post_type['rest_namespace'])) {
		$rest_namespace = $post_type['rest_namespace'];
	}

	$can_export = null;
	if (!empty($post_type['can_export'])) {
		$can_export = get_disp_boolean($post_type['can_export']);
	}

	$args = [
		'labels' => $labels,
		'description' => $post_type['description'],
		'public' => get_disp_boolean($post_type['public']),
		'publicly_queryable' => $queryable,
		'show_ui' => get_disp_boolean($post_type['show_ui']),
		'show_in_nav_menus' => get_disp_boolean($post_type['show_in_nav_menus']),
		'has_archive' => $has_archive,
		'show_in_menu' => $show_in_menu,
		'delete_with_user' => $delete_with_user,
		'show_in_rest' => get_disp_boolean($post_type['show_in_rest']),
		'rest_base' => $rest_base,
		'rest_controller_class' => $rest_controller_class,
		'rest_namespace' => $rest_namespace,
		'exclude_from_search' => $exclude_from_search,
		'capability_type' => $capability_type,
		'map_meta_cap' => $post_type['map_meta_cap'],
		'hierarchical' => get_disp_boolean($post_type['hierarchical']),
		'can_export' => $can_export,
		'rewrite' => $rewrite,
		'menu_position' => $menu_position,
		'menu_icon' => $menu_icon,
		'register_meta_box_cb' => $register_meta_box_cb,
		'query_var' => $post_type['query_var'],
		'supports' => $post_type['supports'],
		'taxonomies' => $post_type['taxonomies'],
	];

	if (true === $yarpp) {
		$args['yarpp_support'] = $yarpp;
	}

	/**
	 * Filters the arguments used for a post type right before registering.
	 *
	 * @since 1.0.0
	 * @since 1.3.0 Added original passed in values array
	 *
	 * @param array $args Array of arguments to use for registering post type.
	 * @param string $value Post type slug to be registered.
	 * @param array $post_type Original passed in values for post type.
	 */
	$args = apply_filters('cptui_pre_register_post_type', $args, $post_type['name'], $post_type);

	return register_post_type($post_type['name'], $args);
}

/**
 * Register our users' custom taxonomies.
 *
 * @since 0.5.0
 *
 * @internal
 */
function cptui_create_custom_taxonomies()
{
	$taxes = get_option('cptui_taxonomies', []);
	/**
	 * Filters an override array of taxonomy data to be registered instead of our saved option.
	 *
	 * @since 1.10.0
	 *
	 * @param array $value Default override value.
	 */
	$taxes_override = apply_filters('cptui_taxonomies_override', []);

	if (empty($taxes) && empty($taxes_override)) {
		return;
	}

	// Assume good intent, and we're also not wrecking the option so things are always reversable.
	if (is_array($taxes_override) && !empty($taxes_override)) {
		$taxes = $taxes_override;
	}

	/**
	 * Fires before the start of the taxonomy registrations.
	 *
	 * @since 1.3.0
	 *
	 * @param array $taxes Array of taxonomies to register.
	 */
	do_action('cptui_pre_register_taxonomies', $taxes);

	if (is_array($taxes)) {
		foreach ($taxes as $tax) {
			/**
			 * Filters whether or not to skip registration of the current iterated taxonomy.
			 *
			 * Dynamic part of the filter name is the chosen taxonomy slug.
			 *
			 * @since 1.7.0
			 *
			 * @param bool $value Whether or not to skip the taxonomy.
			 * @param array $tax Current taxonomy being registered.
			 */
			if ((bool) apply_filters("cptui_disable_{$tax['name']}_tax", false, $tax)) {
				continue;
			}

			/**
			 * Filters whether or not to skip registration of the current iterated taxonomy.
			 *
			 * @since 1.7.0
			 *
			 * @param bool $value Whether or not to skip the taxonomy.
			 * @param array $tax Current taxonomy being registered.
			 */
			if ((bool) apply_filters('cptui_disable_tax', false, $tax)) {
				continue;
			}

			cptui_register_single_taxonomy($tax);
		}
	}

	/**
	 * Fires after the completion of the taxonomy registrations.
	 *
	 * @since 1.3.0
	 *
	 * @param array $taxes Array of taxonomies registered.
	 */
	do_action('cptui_post_register_taxonomies', $taxes);
}
add_action('init', 'cptui_create_custom_taxonomies', 9); // Leave on standard init for legacy purposes.

/**
 * Helper function to register the actual taxonomy.
 *
 * @since 1.0.0
 *
 * @internal
 *
 * @param array $taxonomy Taxonomy array to register. Optional.
 * @return null Result of register_taxonomy.
 */
function cptui_register_single_taxonomy($taxonomy = [])
{

	$labels = [
		'name' => $taxonomy['label'],
		'singular_name' => $taxonomy['singular_label'],
	];

	$description = '';
	if (!empty($taxonomy['description'])) {
		$description = $taxonomy['description'];
	}

	$preserved = cptui_get_preserved_keys('taxonomies');
	$preserved_labels = cptui_get_preserved_labels();
	foreach ($taxonomy['labels'] as $key => $label) {

		if (!empty($label)) {
			$labels[$key] = $label;
		} elseif (empty($label) && in_array($key, $preserved, true)) {
			$singular_or_plural = (in_array($key, array_keys($preserved_labels['taxonomies']['plural']))) ? 'plural' : 'singular';
			// phpcs:ignore.
			$label_plurality = ('plural' === $singular_or_plural) ? $taxonomy['label'] : $taxonomy['singular_label'];
			$labels[$key] = sprintf($preserved_labels['taxonomies'][$singular_or_plural][$key], $label_plurality);
		}
	}

	$rewrite = get_disp_boolean($taxonomy['rewrite']);
	if (false !== get_disp_boolean($taxonomy['rewrite'])) {
		$rewrite = [];
		$rewrite['slug'] = !empty($taxonomy['rewrite_slug']) ? $taxonomy['rewrite_slug'] : $taxonomy['name'];
		$rewrite['with_front'] = true;
		if (isset($taxonomy['rewrite_withfront'])) {
			$rewrite['with_front'] = ('false' === disp_boolean($taxonomy['rewrite_withfront'])) ? false : true;
		}
		$rewrite['hierarchical'] = false;
		if (isset($taxonomy['rewrite_hierarchical'])) {
			$rewrite['hierarchical'] = ('true' === disp_boolean($taxonomy['rewrite_hierarchical'])) ? true : false;
		}
	}

	if (in_array($taxonomy['query_var'], ['true', 'false', '0', '1'], true)) {
		$taxonomy['query_var'] = get_disp_boolean($taxonomy['query_var']);
	}
	if (true === $taxonomy['query_var'] && !empty($taxonomy['query_var_slug'])) {
		$taxonomy['query_var'] = $taxonomy['query_var_slug'];
	}

	$public = (!empty($taxonomy['public']) && false === get_disp_boolean($taxonomy['public'])) ? false : true;
	$publicly_queryable = (!empty($taxonomy['publicly_queryable']) && false ===
		get_disp_boolean($taxonomy['publicly_queryable'])) ? false : true;
	if (empty($taxonomy['publicly_queryable'])) {
		$publicly_queryable = $public;
	}

	$show_admin_column = (!empty($taxonomy['show_admin_column']) && false !==
		get_disp_boolean($taxonomy['show_admin_column'])) ? true : false;

	$show_in_menu = (!empty($taxonomy['show_in_menu']) && false !== get_disp_boolean($taxonomy['show_in_menu'])) ? true :
		false;

	if (empty($taxonomy['show_in_menu'])) {
		$show_in_menu = get_disp_boolean($taxonomy['show_ui']);
	}

	$show_in_nav_menus = (!empty($taxonomy['show_in_nav_menus']) && false !==
		get_disp_boolean($taxonomy['show_in_nav_menus'])) ? true : false;
	if (empty($taxonomy['show_in_nav_menus'])) {
		$show_in_nav_menus = $public;
	}

	$show_tagcloud = (!empty($taxonomy['show_tagcloud']) && false !== get_disp_boolean($taxonomy['show_tagcloud'])) ? true :
		false;
	if (empty($taxonomy['show_tagcloud'])) {
		$show_tagcloud = get_disp_boolean($taxonomy['show_ui']);
	}

	$show_in_rest = (!empty($taxonomy['show_in_rest']) && false !== get_disp_boolean($taxonomy['show_in_rest'])) ? true :
		false;

	$show_in_quick_edit = (!empty($taxonomy['show_in_quick_edit']) && false !==
		get_disp_boolean($taxonomy['show_in_quick_edit'])) ? true : false;

	$sort = (!empty($taxonomy['sort']) && false !== get_disp_boolean($taxonomy['sort'])) ? true : false;

	$rest_base = null;
	if (!empty($taxonomy['rest_base'])) {
		$rest_base = $taxonomy['rest_base'];
	}

	$rest_controller_class = null;
	if (!empty($taxonomy['rest_controller_class'])) {
		$rest_controller_class = $taxonomy['rest_controller_class'];
	}

	$rest_namespace = null;
	if (!empty($taxonomy['rest_namespace'])) {
		$rest_namespace = $taxonomy['rest_namespace'];
	}

	$meta_box_cb = null;
	if (!empty($taxonomy['meta_box_cb'])) {
		$meta_box_cb = (false !== get_disp_boolean($taxonomy['meta_box_cb'])) ? $taxonomy['meta_box_cb'] : false;
	}
	$default_term = null;
	if (!empty($taxonomy['default_term'])) {
		$term_parts = explode(',', $taxonomy['default_term']);
		if (!empty($term_parts[0])) {
			$default_term['name'] = trim($term_parts[0]);
		}
		if (!empty($term_parts[1])) {
			$default_term['slug'] = trim($term_parts[1]);
		}
		if (!empty($term_parts[2])) {
			$default_term['description'] = trim($term_parts[2]);
		}
	}

	$args = [
		'labels' => $labels,
		'label' => $taxonomy['label'],
		'description' => $description,
		'public' => $public,
		'publicly_queryable' => $publicly_queryable,
		'hierarchical' => get_disp_boolean($taxonomy['hierarchical']),
		'show_ui' => get_disp_boolean($taxonomy['show_ui']),
		'show_in_menu' => $show_in_menu,
		'show_in_nav_menus' => $show_in_nav_menus,
		'show_tagcloud' => $show_tagcloud,
		'query_var' => $taxonomy['query_var'],
		'rewrite' => $rewrite,
		'show_admin_column' => $show_admin_column,
		'show_in_rest' => $show_in_rest,
		'rest_base' => $rest_base,
		'rest_controller_class' => $rest_controller_class,
		'rest_namespace' => $rest_namespace,
		'show_in_quick_edit' => $show_in_quick_edit,
		'sort' => $sort,
		'meta_box_cb' => $meta_box_cb,
		'default_term' => $default_term,
	];

	$object_type = !empty($taxonomy['object_types']) ? $taxonomy['object_types'] : '';

	/**
	 * Filters the arguments used for a taxonomy right before registering.
	 *
	 * @since 1.0.0
	 * @since 1.3.0 Added original passed in values array
	 * @since 1.6.0 Added $obect_type variable to passed parameters.
	 *
	 * @param array $args Array of arguments to use for registering taxonomy.
	 * @param string $value Taxonomy slug to be registered.
	 * @param array $taxonomy Original passed in values for taxonomy.
	 * @param array $object_type Array of chosen post types for the taxonomy.
	 */
	$args = apply_filters('cptui_pre_register_taxonomy', $args, $taxonomy['name'], $taxonomy, $object_type);

	return register_taxonomy($taxonomy['name'], $object_type, $args);
}

/**
 * Construct and output tab navigation.
 *
 * @since 1.0.0
 *
 * @param string $page Whether it's the CPT or Taxonomy page. Optional. Default "post_types".
 * @return string
 */
function cptui_settings_tab_menu($page = 'post_types')
{

	/**
	 * Filters the tabs to render on a given page.
	 *
	 * @since 1.3.0
	 *
	 * @param array $value Array of tabs to render.
	 * @param string $page Current page being displayed.
	 */
	$tabs = (array) apply_filters('cptui_get_tabs', [], $page);

	if (empty($tabs['page_title'])) {
		return '';
	}

	$tmpl = '<h1>%s</h1>
<nav class="nav-tab-wrapper wp-clearfix" aria-label="Secondary menu">%s</nav>';

	$tab_output = '';
	foreach ($tabs['tabs'] as $tab) {
		$tab_output .= sprintf(
			'<a class="%s" href="%s" aria-selected="%s">%s</a>',
			implode(' ', $tab['classes']),
			$tab['url'],
			$tab['aria-selected'],
			$tab['text']
		);
	}

	printf(
		$tmpl, // phpcs:ignore.
		$tabs['page_title'],
		// phpcs:ignore.
		$tab_output // phpcs:ignore.
	);
}

/**
 * Convert our old settings to the new options keys.
 *
 * These are left with standard get_option/update_option function calls for legacy and pending update purposes.
 *
 * @since 1.0.0
 *
 * @internal
 *
 * @return bool Whether or not options were successfully updated.
 */
function cptui_convert_settings()
{

	if (wp_doing_ajax()) {
		return;
	}

	$retval = '';

	if (false === get_option('cptui_post_types') && ($post_types = get_option('cpt_custom_post_types'))) { // phpcs:ignore.

		$new_post_types = [];
		foreach ($post_types as $type) {
			$new_post_types[$type['name']] = $type; // This one assigns the # indexes. Named arrays are our friend.
			$new_post_types[$type['name']]['supports'] = !empty($type[0]) ? $type[0] : []; // Especially for multidimensional
			arrays .
				$new_post_types[$type['name']]['taxonomies'] = !empty($type[1]) ? $type[1] : [];
			$new_post_types[$type['name']]['labels'] = !empty($type[2]) ? $type[2] : [];
			unset(
				$new_post_types[$type['name']][0],
				$new_post_types[$type['name']][1],
				$new_post_types[$type['name']][2]
				); // Remove our previous indexed versions.
		}

		$retval = update_option('cptui_post_types', $new_post_types);
	}

	if (false === get_option('cptui_taxonomies') && ($taxonomies = get_option('cpt_custom_tax_types'))) { // phpcs:ignore.

		$new_taxonomies = [];
		foreach ($taxonomies as $tax) {
			$new_taxonomies[$tax['name']] = $tax; // Yep, still our friend.
			$new_taxonomies[$tax['name']]['labels'] = $tax[0]; // Taxonomies are the only thing with.
			$new_taxonomies[$tax['name']]['object_types'] = $tax[1]; // "tax" in the name that I like.
			unset(
				$new_taxonomies[$tax['name']][0],
				$new_taxonomies[$tax['name']][1]
				);
		}

		$retval = update_option('cptui_taxonomies', $new_taxonomies);
	}

	if (!empty($retval)) {
		flush_rewrite_rules();
	}

	return $retval;
}
add_action('admin_init', 'cptui_convert_settings');

/**
 * Return a notice based on conditions.
 *
 * @since 1.0.0
 *
 * @param string $action The type of action that occurred. Optional. Default empty string.
 * @param string $object_type Whether it's from a post type or taxonomy. Optional. Default empty string.
 * @param bool $success Whether the action succeeded or not. Optional. Default true.
 * @param string $custom Custom message if necessary. Optional. Default empty string.
 * @return bool|string false on no message, else HTML div with our notice message.
 */
function cptui_admin_notices($action = '', $object_type = '', $success = true, $custom = '')
{

	$class = [];
	$class[] = $success ? 'updated' : 'error';
	$class[] = 'notice is-dismissible';
	$object_type = esc_attr($object_type);

	$messagewrapstart = '<div id="message" class="' . implode(' ', $class) . '">
    <p>';
	$message = '';

	$messagewrapend = '</p>
</div>';

	if ('add' === $action) {
		if ($success) {
			$message .= sprintf(__('%s has been successfully added', 'custom-post-type-ui'), $object_type);
		} else {
			$message .= sprintf(__('%s has failed to be added', 'custom-post-type-ui'), $object_type);
		}
	} elseif ('update' === $action) {
		if ($success) {
			$message .= sprintf(__('%s has been successfully updated', 'custom-post-type-ui'), $object_type);
		} else {
			$message .= sprintf(__('%s has failed to be updated', 'custom-post-type-ui'), $object_type);
		}
	} elseif ('delete' === $action) {
		if ($success) {
			$message .= sprintf(__('%s has been successfully deleted', 'custom-post-type-ui'), $object_type);
		} else {
			$message .= sprintf(__('%s has failed to be deleted', 'custom-post-type-ui'), $object_type);
		}
	} elseif ('import' === $action) {
		if ($success) {
			$message .= sprintf(__('%s has been successfully imported', 'custom-post-type-ui'), $object_type);
		} else {
			$message .= sprintf(__('%s has failed to be imported', 'custom-post-type-ui'), $object_type);
		}
	} elseif ('error' === $action) {
		if (!empty($custom)) {
			$message = $custom;
		}
	}

	if ($message) {

		/**
		 * Filters the custom admin notice for CPTUI.
		 *
		 * @since 1.0.0
		 *
		 * @param string $value Complete HTML output for notice.
		 * @param string $action Action whose message is being generated.
		 * @param string $message The message to be displayed.
		 * @param string $messagewrapstart Beginning wrap HTML.
		 * @param string $messagewrapend Ending wrap HTML.
		 */
		return apply_filters(
			'cptui_admin_notice', $messagewrapstart . $message . $messagewrapend,
			$action,
			$message,
			$messagewrapstart,
			$messagewrapend
		);
	}

	return false;
}

/**
 * Return array of keys needing preserved.
 *
 * @since 1.0.5
 *
 * @param string $type Type to return. Either 'post_types' or 'taxonomies'. Optional. Default empty string.
 * @return array Array of keys needing preservered for the requested type.
 */
function cptui_get_preserved_keys($type = '')
{

	$preserved_labels = [
		'post_types' => [
			'add_new_item',
			'edit_item',
			'new_item',
			'view_item',
			'view_items',
			'all_items',
			'search_items',
			'not_found',
			'not_found_in_trash',
		],
		'taxonomies' => [
			'search_items',
			'popular_items',
			'all_items',
			'parent_item',
			'parent_item_colon',
			'edit_item',
			'update_item',
			'add_new_item',
			'new_item_name',
			'separate_items_with_commas',
			'add_or_remove_items',
			'choose_from_most_used',
		],
	];
	return !empty($type) ? $preserved_labels[$type] : [];
}

/**
 * Return label for the requested type and label key.
 *
 * @since 1.0.5
 *
 * @deprecated
 *
 * @param string $type Type to return. Either 'post_types' or 'taxonomies'. Optional. Default empty string.
 * @param string $key Requested label key. Optional. Default empty string.
 * @param string $plural Plural verbiage for the requested label and type. Optional. Default empty string.
 * @param string $singular Singular verbiage for the requested label and type. Optional. Default empty string.
 * @return string Internationalized default label.
 */
function cptui_get_preserved_label($type = '', $key = '', $plural = '', $singular = '')
{

	$preserved_labels = [
		'post_types' => [
			'add_new_item' => sprintf(__('Add new %s', 'custom-post-type-ui'), $singular),
			'edit_item' => sprintf(__('Edit %s', 'custom-post-type-ui'), $singular),
			'new_item' => sprintf(__('New %s', 'custom-post-type-ui'), $singular),
			'view_item' => sprintf(__('View %s', 'custom-post-type-ui'), $singular),
			'view_items' => sprintf(__('View %s', 'custom-post-type-ui'), $plural),
			'all_items' => sprintf(__('All %s', 'custom-post-type-ui'), $plural),
			'search_items' => sprintf(__('Search %s', 'custom-post-type-ui'), $plural),
			'not_found' => sprintf(__('No %s found.', 'custom-post-type-ui'), $plural),
			'not_found_in_trash' => sprintf(__('No %s found in trash.', 'custom-post-type-ui'), $plural),
		],
		'taxonomies' => [
			'search_items' => sprintf(__('Search %s', 'custom-post-type-ui'), $plural),
			'popular_items' => sprintf(__('Popular %s', 'custom-post-type-ui'), $plural),
			'all_items' => sprintf(__('All %s', 'custom-post-type-ui'), $plural),
			'parent_item' => sprintf(__('Parent %s', 'custom-post-type-ui'), $singular),
			'parent_item_colon' => sprintf(__('Parent %s:', 'custom-post-type-ui'), $singular),
			'edit_item' => sprintf(__('Edit %s', 'custom-post-type-ui'), $singular),
			'update_item' => sprintf(__('Update %s', 'custom-post-type-ui'), $singular),
			'add_new_item' => sprintf(__('Add new %s', 'custom-post-type-ui'), $singular),
			'new_item_name' => sprintf(__('New %s name', 'custom-post-type-ui'), $singular),
			'separate_items_with_commas' => sprintf(__('Separate %s with commas', 'custom-post-type-ui'), $plural),
			'add_or_remove_items' => sprintf(__('Add or remove %s', 'custom-post-type-ui'), $plural),
			'choose_from_most_used' => sprintf(__('Choose from the most used %s', 'custom-post-type-ui'), $plural),
		],
	];

	return $preserved_labels[$type][$key];
}

/**
 * Returns an array of translated labels, ready for use with sprintf().
 *
 * Replacement for cptui_get_preserved_label for the sake of performance.
 *
 * @since 1.6.0
 *
 * @return array
 */
function cptui_get_preserved_labels()
{
	return [
		'post_types' => [
			'singular' => [
				'add_new_item' => __('Add new %s', 'custom-post-type-ui'),
				'edit_item' => __('Edit %s', 'custom-post-type-ui'),
				'new_item' => __('New %s', 'custom-post-type-ui'),
				'view_item' => __('View %s', 'custom-post-type-ui'),
			],
			'plural' => [
				'view_items' => __('View %s', 'custom-post-type-ui'),
				'all_items' => __('All %s', 'custom-post-type-ui'),
				'search_items' => __('Search %s', 'custom-post-type-ui'),
				'not_found' => __('No %s found.', 'custom-post-type-ui'),
				'not_found_in_trash' => __('No %s found in trash.', 'custom-post-type-ui'),
			],
		],
		'taxonomies' => [
			'singular' => [
				'parent_item' => __('Parent %s', 'custom-post-type-ui'),
				'parent_item_colon' => __('Parent %s:', 'custom-post-type-ui'),
				'edit_item' => __('Edit %s', 'custom-post-type-ui'),
				'update_item' => __('Update %s', 'custom-post-type-ui'),
				'add_new_item' => __('Add new %s', 'custom-post-type-ui'),
				'new_item_name' => __('New %s name', 'custom-post-type-ui'),
			],
			'plural' => [
				'search_items' => __('Search %s', 'custom-post-type-ui'),
				'popular_items' => __('Popular %s', 'custom-post-type-ui'),
				'all_items' => __('All %s', 'custom-post-type-ui'),
				'separate_items_with_commas' => __('Separate %s with commas', 'custom-post-type-ui'),
				'add_or_remove_items' => __('Add or remove %s', 'custom-post-type-ui'),
				'choose_from_most_used' => __('Choose from the most used %s', 'custom-post-type-ui'),
			],
		],
	];
}

// End CPT-IU
// Start Code Snippet
if (!defined('ABSPATH')) {
	exit;
}

// Don't allow multiple versions to be active.
if (function_exists('WPCode')) {

	if (!function_exists('wpcode_pro_just_activated')) {
		/**
		 * When we activate a Pro version, we need to do additional operations:
		 * 1) deactivate a Lite version;
		 * 2) register option which help to run all activation process for Pro version (custom tables creation, etc.).
		 */
		function wpcode_pro_just_activated()
		{
			wpcode_deactivate();
			add_option('wpcode_install', 1);
		}
	}
	add_action('activate_wpcode-premium/wpcode.php', 'wpcode_pro_just_activated');

	if (!function_exists('wpcode_lite_just_activated')) {
		/**
		 * Store temporarily that the Lite version of the plugin was activated.
		 * This is needed because WP does a redirect after activation and
		 * we need to preserve this state to know whether user activated Lite or not.
		 */
		function wpcode_lite_just_activated()
		{

			set_transient('wpcode_lite_just_activated', true);
		}
	}
	add_action('activate_insert-headers-and-footers/ihaf.php', 'wpcode_lite_just_activated');

	if (!function_exists('wpcode_lite_just_deactivated')) {
		/**
		 * Store temporarily that Lite plugin was deactivated.
		 * Convert temporary "activated" value to a global variable,
		 * so it is available through the request. Remove from the storage.
		 */
		function wpcode_lite_just_deactivated()
		{

			global $wpcode_lite_just_activated, $wpcode_lite_just_deactivated;

			$wpcode_lite_just_activated = (bool) get_transient('wpcode_lite_just_activated');
			$wpcode_lite_just_deactivated = true;

			delete_transient('wpcode_lite_just_activated');
		}
	}
	add_action('deactivate_insert-headers-and-footers/ihaf.php', 'wpcode_lite_just_deactivated');

	if (!function_exists('wpcode_deactivate')) {
		/**
		 * Deactivate Lite if WPCode already activated.
		 */
		function wpcode_deactivate()
		{

			$plugin = 'insert-headers-and-footers/ihaf.php';

			deactivate_plugins($plugin);

			do_action('wpcode_plugin_deactivated', $plugin);
		}
	}
	add_action('admin_init', 'wpcode_deactivate');

	if (!function_exists('wpcode_lite_notice')) {
		/**
		 * Display the notice after deactivation when Pro is still active
		 * and user wanted to activate the Lite version of the plugin.
		 */
		function wpcode_lite_notice()
		{

			global $wpcode_lite_just_activated, $wpcode_lite_just_deactivated;

			if (
				empty($wpcode_lite_just_activated) ||
				empty($wpcode_lite_just_deactivated)
			) {
				return;
			}

			// Currently tried to activate Lite with Pro still active, so display the message.
			printf(
				'<div class="notice notice-warning">
    <p>%1$s</p>
    <p>%2$s</p>
</div>',
				esc_html__('Heads up!', 'insert-headers-and-footers'),
				esc_html__('Your site already has WPCode Pro activated. If you want to switch to WPCode Lite, please first go to Plugins
→ Installed Plugins and deactivate WPCode. Then, you can activate WPCode Lite.', 'insert-headers-and-footers')
			);

			if (isset($_GET['activate'])) { // phpcs:ignore WordPress.Security.NonceVerification.Recommended
				unset($_GET['activate']); // phpcs:ignore WordPress.Security.NonceVerification.Recommended
			}

			unset($wpcode_lite_just_activated, $wpcode_lite_just_deactivated);
		}
	}
	add_action('admin_notices', 'wpcode_lite_notice');

	// Do not process the plugin code further.
	return;
}

/**
 * Main WPCode Class
 */
class WPCode
{

	/**
	 * Holds the instance of the plugin.
	 *
	 * @since 2.0.0
	 *
	 * @var WPCode The one true WPCode
	 */
	private static $instance;

	/**
	 * Plugin version.
	 *
	 * @since 2.0.0
	 *
	 * @var string
	 */
	public $version = '';

	/**
	 * The auto-insert instance.
	 *
	 * @var WPCode_Auto_Insert
	 */
	public $auto_insert;

	/**
	 * The snippet execution instance.
	 *
	 * @var WPCode_Snippet_Execute
	 */
	public $execute;

	/**
	 * The error handling instance.
	 *
	 * @var WPCode_Error
	 */
	public $error;

	/**
	 * The conditional logic instance.
	 *
	 * @var WPCode_Conditional_Logic
	 */
	public $conditional_logic;

	/**
	 * The conditional logic instance.
	 *
	 * @var WPCode_Snippet_Cache
	 */
	public $cache;

	/**
	 * The snippet library.
	 *
	 * @var WPCode_Library
	 */
	public $library;

	/**
	 * The Snippet Generator.
	 *
	 * @var WPCode_Generator
	 */
	public $generator;

	/**
	 * The plugin settings.
	 *
	 * @var WPCode_Settings
	 */
	public $settings;

	/**
	 * The plugin importers.
	 *
	 * @var WPCode_Importers
	 */
	public $importers;
	/**
	 * The file cache class.
	 *
	 * @var WPCode_File_Cache
	 */
	public $file_cache;

	/**
	 * The notifications instance (admin-only).
	 *
	 * @var WPCode_Notifications
	 */
	public $notifications;

	/**
	 * The admin page loader.
	 *
	 * @var WPCode_Admin_Page_Loader
	 */
	public $admin_page_loader;

	/**
	 * The library auth instance.
	 *
	 * @var WPCode_Library_Auth
	 */
	public $library_auth;

	/**
	 * The admin notices instance.
	 *
	 * @var WPCode_Notice
	 */
	public $notice;

	/**
	 * Main instance of WPCode.
	 *
	 * @return WPCode
	 * @since 2.0.0
	 */
	public static function instance()
	{
		if (!isset(self::$instance) && !(self::$instance instanceof WPCode)) {
			self::$instance = new WPCode();
		}

		return self::$instance;
	}

	/**
	 * Constructor.
	 */
	private function __construct()
	{
		$this->setup_constants();
		$this->includes();
		$this->load_components();

		add_action('init', array($this, 'load_plugin_textdomain'), 15);
	}

	/**
	 * Set up global constants.
	 *
	 * @return void
	 */
	private function setup_constants()
	{

		define('WPCODE_FILE', __FILE__);

		$plugin_headers = get_file_data(WPCODE_FILE, array('version' => 'Version'));

		define('WPCODE_VERSION', $plugin_headers['version']);
		define('WPCODE_PLUGIN_BASENAME', plugin_basename(WPCODE_FILE));
		define('WPCODE_PLUGIN_URL', plugin_dir_url(WPCODE_FILE));
		define('WPCODE_PLUGIN_PATH', plugin_dir_path(WPCODE_FILE));

		$this->version = WPCODE_VERSION;
	}

	/**
	 * Require the files needed for the plugin.
	 *
	 * @return void
	 */
	private function includes()
	{
		// Load the safe mode logic first.
		require_once WPCODE_PLUGIN_PATH . 'includes/safe-mode.php';
		// Plugin helper functions.
		require_once WPCODE_PLUGIN_PATH . 'includes/helpers.php';
		// Functions for global headers & footers output.
		require_once WPCODE_PLUGIN_PATH . 'includes/global-output.php';
		// Use the old class name for backwards compatibility.
		require_once WPCODE_PLUGIN_PATH . 'includes/legacy.php';
		// Register code snippets post type.
		require_once WPCODE_PLUGIN_PATH . 'includes/post-type.php';
		// The snippet class.
		require_once WPCODE_PLUGIN_PATH . 'includes/class-wpcode-snippet.php';
		// Auto-insert options.
		require_once WPCODE_PLUGIN_PATH . 'includes/class-wpcode-auto-insert.php';
		// Execute snippets.
		require_once WPCODE_PLUGIN_PATH . 'includes/class-wpcode-snippet-execute.php';
		// Handle PHP errors.
		require_once WPCODE_PLUGIN_PATH . 'includes/class-wpcode-error.php';
		// [wpcode] shortcode.
		require_once WPCODE_PLUGIN_PATH . 'includes/shortcode.php';
		// Conditional logic.
		require_once WPCODE_PLUGIN_PATH . 'includes/class-wpcode-conditional-logic.php';
		// Snippet Cache.
		require_once WPCODE_PLUGIN_PATH . 'includes/class-wpcode-snippet-cache.php';
		// Settings class.
		require_once WPCODE_PLUGIN_PATH . 'includes/class-wpcode-settings.php';
		// Custom capabilities.
		require_once WPCODE_PLUGIN_PATH . 'includes/class-wpcode-capabilities.php';
		// Install routines.
		require_once WPCODE_PLUGIN_PATH . 'includes/class-wpcode-install.php';

		if (is_admin() || (defined('DOING_CRON') && DOING_CRON)) {
			require_once WPCODE_PLUGIN_PATH . 'includes/icons.php'; // This is not needed in the frontend atm.
// Code Editor class.
			require_once WPCODE_PLUGIN_PATH . 'includes/admin/class-wpcode-code-editor.php';
			require_once WPCODE_PLUGIN_PATH . 'includes/admin/class-wpcode-admin-page-loader.php';
			require_once WPCODE_PLUGIN_PATH . 'includes/admin/admin-scripts.php';
			require_once WPCODE_PLUGIN_PATH . 'includes/admin/admin-ajax-handlers.php';
			// Always used just in the backend.
			require_once WPCODE_PLUGIN_PATH . 'includes/class-wpcode-generator.php';
			// Snippet Library.
			require_once WPCODE_PLUGIN_PATH . 'includes/class-wpcode-library.php';
			// Authentication for the library site.
			require_once WPCODE_PLUGIN_PATH . 'includes/class-wpcode-library-auth.php';
			// Importers.
			require_once WPCODE_PLUGIN_PATH . 'includes/admin/class-wpcode-importers.php';
			// File cache.
			require_once WPCODE_PLUGIN_PATH . 'includes/class-wpcode-file-cache.php';
			// The docs.
			require_once WPCODE_PLUGIN_PATH . 'includes/admin/class-wpcode-docs.php';
			// Notifications class.
			require_once WPCODE_PLUGIN_PATH . 'includes/admin/class-wpcode-notifications.php';
			// Upgrade page.
			require_once WPCODE_PLUGIN_PATH . 'includes/admin/class-wpcode-upgrade-welcome.php';
			// Metabox class.
			require_once WPCODE_PLUGIN_PATH . 'includes/admin/class-wpcode-metabox-snippets.php';
			// Metabox class.
			require_once WPCODE_PLUGIN_PATH . 'includes/admin/class-wpcode-admin-notice.php';
			// Ask for some love.
			require_once WPCODE_PLUGIN_PATH . 'includes/admin/class-wpcode-review.php';
		}

		// Load lite-specific files.
		require_once WPCODE_PLUGIN_PATH . 'includes/lite/loader.php';
	}

	/**
	 * Load components in the main plugin instance.
	 *
	 * @return void
	 */
	public function load_components()
	{
		$this->auto_insert = new WPCode_Auto_Insert();
		$this->execute = new WPCode_Snippet_Execute();
		$this->error = new WPCode_Error();
		$this->conditional_logic = new WPCode_Conditional_Logic();
		$this->cache = new WPCode_Snippet_Cache();
		$this->settings = new WPCode_Settings();

		if (is_admin() || (defined('DOING_CRON') && DOING_CRON)) {
			$this->file_cache = new WPCode_File_Cache();
			$this->library = new WPCode_Library();
			$this->library_auth = new WPCode_Library_Auth();
			$this->generator = new WPCode_Generator();
			$this->importers = new WPCode_Importers();
			$this->notifications = new WPCode_Notifications();
			$this->admin_page_loader = new WPCode_Admin_Page_Loader_Lite();
			$this->notice = new WPCode_Notice();

			new WPCode_Metabox_Snippets_Lite();
		}
	}

	/**
	 * Load the plugin translations.
	 *
	 * @return void
	 */
	public function load_plugin_textdomain()
	{
		if (is_user_logged_in()) {
			unload_textdomain('insert-headers-and-footers');
		}

		load_plugin_textdomain('insert-headers-and-footers', false, dirname(plugin_basename(WPCODE_FILE)) . '/languages/');
	}
}

require_once dirname(__FILE__) . '/includes/ihaf.php';

WPCode();

// End Code Snippet


// Start Custom Css
// Handle the legacy CSS editor that came with SiteOrigin themes
include plugin_dir_path(__FILE__) . 'inc/legacy.php';

define('SOCSS_VERSION', '1.5.5');
define('SOCSS_JS_SUFFIX', '.min');

/**
 * Class SiteOrigin_CSS The main class for the SiteOrigin CSS Editor
 */
class SiteOrigin_CSS
{
	private $theme;
	private $snippet_paths;
	private $css_file;

	function __construct()
	{
		$this->theme = basename(get_template_directory());
		$this->snippet_paths = array();

		// Main header actions
		add_action('plugins_loaded', array($this, 'set_plugin_textdomain'));

		global $wp_filesystem;
		if (!class_exists('wp_filesystem')) {
			require_once(ABSPATH . '/wp-admin/includes/file.php');
			WP_Filesystem();
		}

		// Priority 20 is necessary to ensure our CSS takes precedence.
		add_action('wp_head', array($this, 'enqueue_css'), 20);

		// All the admin actions
		add_action('admin_menu', array($this, 'action_admin_menu'));
		add_action('admin_enqueue_scripts', array($this, 'enqueue_admin_scripts'), 20);
		add_action('admin_enqueue_scripts', array($this, 'dequeue_admin_scripts'), 19);
		add_action('load-appearance_page_so_custom_css', array($this, 'add_help_tab'));

		// Add the action links.
// add_action('plugin_action_links_' . plugin_basename(__FILE__), array($this, 'plugin_action_links'));

		// The request to hide the getting started video
		add_action('wp_ajax_socss_hide_getting_started', array($this, 'admin_action_hide_getting_started'));

		add_action('wp_ajax_socss_get_post_css', array($this, 'admin_action_get_post_css'));
		add_action('wp_ajax_socss_get_revisions_list', array($this, 'admin_action_get_revisions_list'));
		add_action('wp_ajax_socss_save_css', array($this, 'admin_action_save_css'));

		if (!is_admin()) {
			if (isset($_GET['so_css_preview'])) {

				add_action('plugins_loaded', array($this, 'disable_ngg_resource_manager'));
				add_filter('show_admin_bar', '__return_false');
				add_filter('wp_enqueue_scripts', array($this, 'enqueue_inspector_scripts'));
				add_filter('wp_footer', array($this, 'inspector_templates'));

				// We'll be grabbing all the enqueued scripts and outputting them
				add_action('wp_enqueue_scripts', array($this, 'inline_inspector_scripts'), 100);
			}
		}
	}

	/**
	 * Get a singleton of the SiteOrigin CSS.
	 *
	 * @return SiteOrigin_CSS
	 */
	static function single()
	{
		static $single;

		if (empty($single)) {
			$single = new SiteOrigin_CSS();
		}

		return $single;
	}

	/**
	 * Retrieve the current custom CSS for a given theme and post id combination.
	 *
	 * @param $theme string The name of the theme for which to retrieve custom CSS.
	 * @param $post_id int The ID of the specific post for which to retrieve custom CSS.
	 *
	 * @return string The custom CSS for the theme and post ID combination.
	 */
	function get_custom_css($theme, $post_id = null)
	{
		$css_key = 'siteorigin_custom_css[' . $theme . ']';
		if (empty($post_id) && WP_Filesystem()) {
			$custom_css_file = apply_filters('siteorigin_custom_css_file', false);
			if (
				!empty($custom_css_file) &&
				!empty($custom_css_file['file'])
			) {
				// Did we previously load the CSS file? If not, load it.
				if (empty($this->css_file) || isset($_POST['siteorigin_custom_css'])) {
					global $wp_filesystem;

					// If custom file doesn't exist, create it.
					if (!$wp_filesystem->exists($custom_css_file['file'])) {
						$wp_filesystem->touch($custom_css_file['file']);
					}

					if (empty(get_option('siteorigin_custom_file'))) {
						update_option('siteorigin_custom_file', true, true);
					}

					if ($wp_filesystem->is_writable($custom_css_file['file'])) {
						$this->css_file = $wp_filesystem->get_contents($custom_css_file['file']);
					}
				}
				return $this->css_file;
			} elseif (!empty(get_option('siteorigin_custom_file'))) {
				// If the custom file filter was previously active we need to
// generate the global CSS file to avoid no CSS outputting
// without modification.
				delete_option('siteorigin_custom_file', true);
				$css_file_path = $this->get_css_file_name($theme);

				global $wp_filesystem;
				$wp_filesystem->put_contents(
					$css_file_path,
					get_option($css_key, '')
				);
			}
		}

		if (!empty($post_id)) {
			return get_post_meta($post_id, $css_key, true);
		}

		return get_option($css_key, '');
	}

	/**
	 * Save custom CSS for a given theme and post id combination.
	 *
	 * @param $custom_css string The custom CSS to save.
	 * @param $theme string The name of the theme for which to save custom CSS.
	 * @param $post_id int The ID of the specific post for which to save custom CSS.
	 *
	 * @return bool Whether or not saving the custom CSS was successful.
	 */
	function save_custom_css($custom_css, $theme, $post_id = null)
	{
		$css_key = 'siteorigin_custom_css[' . $theme . ']';
		if (empty($post_id)) {
			$current = get_option($css_key);
			if ($current === false) {
				return add_option($css_key, $custom_css, '', 'no');
			} else {
				return update_option($css_key, $custom_css);
			}
		}

		if (metadata_exists('post', $post_id, $css_key)) {
			return update_post_meta($post_id, $css_key, $custom_css);
		}

		return add_post_meta($post_id, $css_key, $custom_css);
	}

	/**
	 * Returns the file name of the CSS file we're editing.
	 *
	 * @param $theme
	 * @param null $post_id
	 */
	function get_css_file_name($theme, $post_id = null)
	{
		global $wp_filesystem;
		$upload_dir = wp_upload_dir();
		$upload_dir_path = $upload_dir['basedir'] . '/so-css/';

		if (!$wp_filesystem->is_dir($upload_dir_path)) {
			$wp_filesystem->mkdir($upload_dir_path);
		}

		$css_file_name = 'so-css-' . $theme . (!empty($post_id) ? '_' . $post_id : '');
		return $upload_dir_path . $css_file_name . '.css';
	}

	/**
	 * Save custom CSS for a given theme and post id combination to a file in the uploads directory to allow for caching.
	 *
	 * @param $custom_css
	 * @param $theme
	 * @param null $post_id
	 */
	function save_custom_css_file($custom_css, $theme, $post_id = null)
	{
		if (WP_Filesystem()) {
			global $wp_filesystem;
			$css_file_path = apply_filters('siteorigin_custom_css_file', false);

			if (
				empty($css_file_path) ||
				empty($css_file_path['file']) ||
				!$wp_filesystem->is_writable($css_file_path['file'])
			) {
				$css_file_path = $this->get_css_file_name($theme, $post_id);

				if (file_exists($css_file_path)) {
					$wp_filesystem->delete($css_file_path);
				}
			} else {
				$css_file_path = $css_file_path['file'];
				$this->css_file = $custom_css;
			}

			$wp_filesystem->put_contents(
				$css_file_path,
				$custom_css
			);
		}
	}

	/**
	 * Retrieve the previous revisions of custom CSS for a given theme and post id combination.
	 *
	 * @param $theme string The name of the theme for which to retrieve custom CSS revisions.
	 * @param $post_id int The ID of the specific post for which to retrieve custom CSS revisions.
	 *
	 * @return array The custom CSS revisions for the theme and post ID combination.
	 */
	function get_custom_css_revisions($theme, $post_id = null)
	{
		$css_key = 'siteorigin_custom_css_revisions[' . $theme . ']';
		if (empty($post_id)) {
			return get_option($css_key, '');
		}

		return get_post_meta($post_id, $css_key, true);
	}

	/**
	 * Adds a custom CSS revision for a given theme and post id combination.
	 *
	 * @param $custom_css string The custom CSS to add as a revision.
	 * @param $theme string The name of the theme for which to save custom CSS.
	 * @param $post_id int The ID of the specific post for which to save custom CSS.
	 *
	 * @return bool Whether or not adding the custom CSS revision was successful.
	 */
	function add_custom_css_revision($custom_css, $theme, $post_id = null)
	{
		$revisions = $this->get_custom_css_revisions($this->theme, $post_id);

		$css_key = 'siteorigin_custom_css_revisions[' . $theme . ']';

		if (empty($revisions)) {
			$revisions = array();
			if (empty($post_id)) {
				add_option($css_key, $revisions, '', 'no');
			} else {
				add_post_meta($post_id, $css_key, $revisions);
			}
		}
		$revisions[time()] = $custom_css;

		// Sort the revisions and cut off any old ones.
		krsort($revisions);
		$revisions = array_slice($revisions, 0, 15, true);

		if (empty($post_id)) {
			return update_option($css_key, $revisions);
		}

		return update_post_meta($post_id, $css_key, $revisions);
	}

	/**
	 * Enqueue or print inline CSS.
	 */
	function enqueue_css()
	{

		$this->enqueue_custom_css($this->theme);

		if (is_singular()) {
			$this->enqueue_custom_css($this->theme, get_the_ID());
		}
	}

	/**
	 * Enqueue the custom CSS for the given theme and post id combination.
	 *
	 * @param $theme string The name of the theme for which to enqueue custom CSS.
	 * @param $post_id int The ID of the specific post for which to enqueue custom CSS.
	 *
	 */
	function enqueue_custom_css($theme, $post_id = null)
	{
		$css_id = $theme . (!empty($post_id) ? '_' . $post_id : '');
		if (
			empty($_GET['so_css_preview']) &&
			!is_admin() &&
			apply_filters('siteorigin_css_enqueue_css', true)
		) {
			$custom_css_file = apply_filters('siteorigin_custom_css_file', array());
			if (!empty($post_id) || empty($custom_css_file)) {
				$upload_dir = wp_upload_dir();
				$upload_dir_path = $upload_dir['basedir'] . '/so-css/';
				$css_file_name = 'so-css-' . $css_id;
				$css_file_path = $upload_dir_path . $css_file_name . '.css';
				$css_file_url = $upload_dir['baseurl'] . '/so-css/' . $css_file_name . '.css';
			} elseif (isset($custom_css_file['url'])) {
				$css_file_path = $custom_css_file['file'];
				$css_file_url = $custom_css_file['url'];
			}

			if (!empty($css_file_path) && file_exists($css_file_path)) {
				wp_enqueue_style(
					'so-css-' . $css_id,
					set_url_scheme($css_file_url),
					array(),
					$this->get_latest_revision_timestamp()
				);
			}
		} else {
			$custom_css = $this->get_custom_css($theme, $post_id);
			// We just need to enqueue a dummy style
			if (!empty($custom_css)) {
				echo "<style id='" . sanitize_html_class($css_id) . "-custom-css' class='siteorigin-custom-css' type='text/css'>
\n";
				echo self::sanitize_css($custom_css) . "\n";
				echo "
</style>\n";
			}
		}
	}

	function set_plugin_textdomain()
	{
		load_plugin_textdomain('so-css', false, plugin_dir_path(__FILE__) . 'lang/');
	}

	/**
	 * Action to run on the admin action.
	 */
	function action_admin_menu()
	{

		add_theme_page(
			esc_html__('Custom CSS', 'so-css'),
			esc_html__('Custom CSS', 'so-css'),
			'edit_theme_options',
			'so_custom_css',
			array(
				$this,
				'display_admin_page'
			)
		);

		add_menu_page('Tùy Biến CSS', 'Tùy Biến CSS', 'edit_theme_options', 'custom_css', array(
			$this,
			'rederectToCustomCss'
		), 'dashicons-layout');



		// add_menu_page(esc_html__('Custom CSS', 'so-css'), esc_html__('Custom CSS', 'so-css'), 'edit_theme_options',
// 'so_custom_css', array(
// $this,
// 'display_admin_page'
// ));


		if (current_user_can('edit_theme_options') && isset($_POST['siteorigin_custom_css'])) {
			check_admin_referer('custom_css', '_sononce');

			// Sanitize CSS input. Should keep most tags, apart from script and style tags.
			$custom_css = self::sanitize_css(filter_input(INPUT_POST, 'siteorigin_custom_css'));
			$socss_post_id = filter_input(INPUT_GET, 'socss_post_id', FILTER_VALIDATE_INT);

			if (empty($this->css_file)) {
				$current = $this->get_custom_css($this->theme, $socss_post_id);
				$this->save_custom_css($custom_css, $this->theme, $socss_post_id);
			} else {
				$current = $this->css_file;
			}

			// If this has changed, then add a revision.
			if ($current != $custom_css) {
				$this->add_custom_css_revision($custom_css, $this->theme, $socss_post_id);

				$this->save_custom_css_file($custom_css, $this->theme, $socss_post_id);
			}

			// Update Editor Theme.
			if (
				$_POST['so_css_editor_theme'] == 'neat' ||
				$_POST['so_css_editor_theme'] == 'ambiance'
			) {
				update_option('so_css_editor_theme', $_POST['so_css_editor_theme']);
			}
		}
	}

	function rederectToCustomCss()
	{
		$screen = get_current_screen();
		if ($screen->base == 'toplevel_page_custom_css') {
			// print_r($screen->base);
// $this->display_admin_page();
			$urlCustomCss = site_url() . '/wp-admin/themes.php?page=so_custom_css';
			wp_redirect($urlCustomCss);
			exit();
		}
	}

	/**
	 * Display the help tab
	 */
	function add_help_tab()
	{
		$screen = get_current_screen();
		$screen->add_help_tab(
			array(
				'id' => 'custom-css',
				'title' => esc_html__('Custom CSS', 'so-css'),
				'content' => '<p>'
				. sprintf(esc_html__("SiteOrigin CSS adds any custom CSS you enter here into your site's header. ", 'so-css'))
				. esc_html__("These changes will persist across updates so it's best to make all your changes here. ", 'so-css')
				. '</p>'
			)
		);
	}

	function enqueue_admin_scripts($page)
	{
		if ($page != 'appearance_page_so_custom_css') {
			return;
		}

		// Core WordPress stuff that we use
		wp_enqueue_media();

		global $wp_version;
		if (version_compare($wp_version, '4.9', '>=') && wp_get_current_user()->syntax_highlighting) {
			wp_enqueue_code_editor(
				array(
					'type' => 'css',
					'codemirror' => array(
						'lint' => true,
					),
				)
			);
		} else {
			$this->enqueue_fallback_codemirror();
		}
		wp_enqueue_style(
			'socss-codemirror-theme-neat', plugin_dir_url(__FILE__) . 'lib/codemirror/theme/neat.css',
			array(),
			SOCSS_VERSION
		);
		wp_enqueue_style(
			'socss-codemirror-theme-ambiance', plugin_dir_url(__FILE__) . 'lib/codemirror/theme/ambiance.css',
			array(),
			SOCSS_VERSION
		);

		// Enqueue the scripts for theme CSS processing
		wp_enqueue_script(
			'siteorigin-css-parser-lib', plugin_dir_url(__FILE__) . 'js/css' . SOCSS_JS_SUFFIX . '.js',
			array('jquery'),
			SOCSS_VERSION
		);

		// There are conflicts between CSS linting and the built in WordPress color picker, so use something else
		wp_enqueue_style(
			'siteorigin-custom-css-minicolors', plugin_dir_url(__FILE__) . 'lib/minicolors/jquery.minicolors.css',
			array(),
			'2.1.7'
		);
		wp_enqueue_script('siteorigin-custom-css-minicolors', plugin_dir_url(__FILE__) . 'lib/minicolors/jquery.minicolors' .
			SOCSS_JS_SUFFIX . '.js', array('jquery'), '2.1.7');

		// URI parsing for preview navigation
		wp_enqueue_script(
			'siteorigin-uri', plugin_dir_url(__FILE__) . 'js/URI' . SOCSS_JS_SUFFIX . '.js',
			array(),
			SOCSS_VERSION,
			true
		);

		// All the custom SiteOrigin CSS stuff
		wp_enqueue_script(
			'siteorigin-custom-css', plugin_dir_url(__FILE__) . 'js/editor' . SOCSS_JS_SUFFIX . '.js',
			array('jquery', 'underscore', 'backbone'),
			SOCSS_VERSION,
			true
		);
		wp_enqueue_style('siteorigin-custom-css', plugin_dir_url(__FILE__) . 'css/admin.css', array(), SOCSS_VERSION);


		// Pretty confusing, but it seems we should be using `home_url` and NOT `site_url`
// as described here => https://wordpress.stackexchange.com/a/50605
		$init_url = home_url();

		if (!empty($socss_post_id) && is_int($socss_post_id)) {
			$init_url = set_url_scheme(get_permalink($socss_post_id));
		}

		$open_visual_editor = !empty($_REQUEST['open_visual_editor']);

		$home_url = add_query_arg('so_css_preview', '1', $init_url);

		wp_localize_script(
			'siteorigin-custom-css',
			'socssOptions',
			array(
				'homeURL' => $home_url,
				'postCssUrlRoot' => wp_nonce_url(admin_url('admin-ajax.php?action=socss_get_post_css'), 'get_post_css'),
				'getRevisionsListAjaxUrl' => wp_nonce_url(
					admin_url('admin-ajax.php?action=socss_get_revisions_list'),
					'get_revisions_list'
				),
				'ajaxurl' => wp_nonce_url(admin_url('admin-ajax.php'), 'so-css-ajax'),
				'openVisualEditor' => $open_visual_editor,

				'propertyControllers' => apply_filters('siteorigin_css_property_controllers', $this->get_property_controllers()),

				'loc' => array(
					'unchanged' => esc_html__('Unchanged', 'so-css'),
					'select' => esc_html__('Select', 'so-css'),
					'select_image' => esc_html__('Select Image', 'so-css'),
					'leave' => esc_html__('Are you sure you want to leave without saving?', 'so-css'),
				)
			)
		);

		// This is for the templates required by the CSS editor. Ideally this would be out in the footer, but we need
// it earlier for dependent scripts.
		include plugin_dir_path(__FILE__) . 'tpl/js-templates.php';
	}

	// Handles loading the fallback version of CodeMirror.
	function enqueue_fallback_codemirror()
	{
		// Enqueue the codemirror scripts. Call Underscore and Backbone dependencies so they're enqueued first to prevent
		conflicts .
			wp_enqueue_script('socss-codemirror', plugin_dir_url(__FILE__) . 'lib/codemirror/lib/codemirror' . SOCSS_JS_SUFFIX .
				'.js', array('underscore', 'backbone'), '5.2.0');
		wp_enqueue_script('socss-codemirror-mode-css', plugin_dir_url(__FILE__) . 'lib/codemirror/mode/css/css' .
			SOCSS_JS_SUFFIX . '.js', array(), '5.2.0');

		// Add in all the linting libs
		wp_enqueue_script('socss-codemirror-lint', plugin_dir_url(__FILE__) . 'lib/codemirror/addon/lint/lint' . SOCSS_JS_SUFFIX
			. '.js', array('socss-codemirror'), '5.2.0');
		wp_enqueue_script('socss-codemirror-lint-css', plugin_dir_url(__FILE__) . 'lib/codemirror/addon/lint/css-lint' .
			SOCSS_JS_SUFFIX . '.js', array(
				'socss-codemirror',
				'socss-codemirror-lint-css-lib'
			), '5.2.0');
		wp_enqueue_script(
			'socss-codemirror-lint-css-lib', plugin_dir_url(__FILE__) . 'js/csslint' . SOCSS_JS_SUFFIX . '.js',
			array(),
			'0.10.0'
		);

		// The CodeMirror autocomplete library
		wp_enqueue_script('socss-codemirror-show-hint', plugin_dir_url(__FILE__) . 'lib/codemirror/addon/hint/show-hint' .
			SOCSS_JS_SUFFIX . '.js', array('socss-codemirror'), '5.2.0');

		// CodeMirror search and dialog addons
		wp_enqueue_script('socss-codemirror-dialog', plugin_dir_url(__FILE__) . 'lib/codemirror/addon/dialog/dialog' .
			SOCSS_JS_SUFFIX . '.js', array('socss-codemirror'), '5.2.0');

		wp_enqueue_script('socss-codemirror-search', plugin_dir_url(__FILE__) . 'lib/codemirror/addon/search/search' .
			SOCSS_JS_SUFFIX . '.js', array('socss-codemirror'), '5.37.0');
		wp_enqueue_script('socss-codemirror-search-searchcursor', plugin_dir_url(__FILE__) .
			'lib/codemirror/addon/search/searchcursor' . SOCSS_JS_SUFFIX . '.js', array(
				'socss-codemirror',
				'socss-codemirror-search'
			), '5.37.0');
		wp_enqueue_script('socss-codemirror-search-match-cursor', plugin_dir_url(__FILE__) .
			'lib/codemirror/addon/search/match-highlighter' . SOCSS_JS_SUFFIX . '.js', array(
				'socss-codemirror',
				'socss-codemirror-search'
			), '5.37.0');
		wp_enqueue_script('socss-codemirror-search-matchesonscrollbar', plugin_dir_url(__FILE__) .
			'lib/codemirror/addon/search/matchesonscrollbar' . SOCSS_JS_SUFFIX . '.js', array(
				'socss-codemirror',
				'socss-codemirror-search'
			), '5.37.0');
		wp_enqueue_script('socss-codemirror-scroll-annotatescrollbar', plugin_dir_url(__FILE__) .
			'lib/codemirror/addon/scroll/annotatescrollbar' . SOCSS_JS_SUFFIX . '.js', array(
				'socss-codemirror',
				'socss-codemirror-search',
				'socss-codemirror-search-matchesonscrollbar'
			), '5.37.0');
		wp_enqueue_script('socss-codemirror-jump-to-line', plugin_dir_url(__FILE__) . 'lib/codemirror/addon/search/jump-to-line'
			. SOCSS_JS_SUFFIX . '.js', array('socss-codemirror', 'socss-codemirror-search'), '5.37.0');

		// All the CodeMirror styles
		wp_enqueue_style('socss-codemirror', plugin_dir_url(__FILE__) . 'lib/codemirror/lib/codemirror.css', array(), '5.2.0');
		wp_enqueue_style(
			'socss-codemirror-lint-css', plugin_dir_url(__FILE__) . 'lib/codemirror/addon/lint/lint.css',
			array(),
			'5.2.0'
		);
		wp_enqueue_style(
			'socss-codemirror-show-hint', plugin_dir_url(__FILE__) . 'lib/codemirror/addon/hint/show-hint.css',
			array(),
			'5.2.0'
		);
		wp_enqueue_style(
			'socss-codemirror-dialog', plugin_dir_url(__FILE__) . 'lib/codemirror/addon/dialog/dialog.css',
			'5.2.0'
		);
		wp_enqueue_style('socss-codemirror-search-matchesonscrollbar', plugin_dir_url(__FILE__) .
			'lib/codemirror/addon/search/matchesonscrollbar.css', array(), '5.37.0');
	}

	/**
	 * @param $page
	 */
	function dequeue_admin_scripts($page)
	{
		if ($page != 'appearance_page_so_custom_css') {
			return;
		}

		// Dequeue the core WordPress color picker on the custom CSS page.
// This script causes conflicts and other plugins seem to be enqueueing it on the SO CSS admin page.
		wp_dequeue_script('wp-color-picker');
		wp_dequeue_style('wp-color-picker');
	}

	/**
	 * Get all the available property controllers
	 */
	function get_property_controllers()
	{
		return include plugin_dir_path(__FILE__) . 'inc/controller-config.php';
	}

	function plugin_action_links($links)
	{
		if (isset($links['edit'])) {
			unset($links['edit']);
		}
		$links['css_editor'] = '<a href="' . admin_url('themes.php?page=so_custom_css') . '">' . esc_html__(
			'CSS Editor',
			'so-css'
		) . '</a>';
		$links['support'] = '<a href="https://siteorigin.com/thread/" target="_blank">' . esc_html__('Support', 'so-css') .
			'</a>';
		if (apply_filters('siteorigin_premium_upgrade_teaser', true) && !defined('SITEORIGIN_PREMIUM_VERSION')) {
			$links['addons'] = '<a href="https://siteorigin.com/downloads/premium/?featured_addon=plugin/web-font-selector"
    style="color: #3db634" target="_blank" rel="noopener noreferrer">' . esc_html__('Addons', 'so-css') . '</a>';
		}
		return $links;
	}

	//



	function display_admin_page()
	{

		$socss_post_id = filter_input(INPUT_GET, 'socss_post_id', FILTER_VALIDATE_INT);
		$theme = filter_input(INPUT_GET, 'theme');
		$time = filter_input(INPUT_GET, 'time', FILTER_VALIDATE_INT);

		$page_title = esc_html__('SiteOrigin CSS', 'so-css');
		$theme_obj = wp_get_theme();
		$theme_name = $theme_obj->get('Name');
		$editor_description = sprintf(esc_html__('Changes apply to %s and its child themes', 'so-css'), $theme_name);
		$save_button_label = esc_html__('Save CSS', 'so-css');
		$form_save_url = admin_url('themes.php?page=so_custom_css');

		if (!empty($socss_post_id)) {
			$selected_post = get_post($socss_post_id);

			$page_title = sprintf(
				esc_html__('Editing CSS for: %s', 'so-css'),
				$selected_post->post_title
			);

			$editor_description = sprintf(
				esc_html__('Changes apply to the %s %s when the current theme is %s or its child themes', 'so-css'),
				$selected_post->post_type,
				$selected_post->post_title,
				$theme_name
			);
			$post_type_obj = get_post_type_object($selected_post->post_type);
			$post_type_labels = $post_type_obj->labels;
			$save_button_label = sprintf(esc_html__('Save %s CSS', 'so-css'), $post_type_labels->singular_name);
			$form_save_url = add_query_arg('socss_post_id', urlencode($socss_post_id), $form_save_url);
		}
		$custom_css = $this->get_custom_css($this->theme, $socss_post_id);
		$custom_css_revisions = $this->get_custom_css_revisions($this->theme, $socss_post_id);
		$current_revision = 0;

		if (!empty($theme) && $theme == $this->theme && !empty($time) && !empty($custom_css_revisions[$time])) {
			$current_revision = $time;
			$custom_css = $custom_css_revisions[$time];
		}

		if (!empty($current_revision)) {
			$save_button_label = esc_html__('Revert to this revision', 'so-css');
		}

		if (!empty($custom_css_revisions)) {
			krsort($custom_css_revisions);
		}

		$theme = basename(get_template_directory());

		$editor_theme = get_option('so_css_editor_theme', 'neat');

		include plugin_dir_path(__FILE__) . 'tpl/page.php';
	}


	function display_teaser()
	{
		return apply_filters('siteorigin_premium_upgrade_teaser', true) &&
			!defined('SITEORIGIN_PREMIUM_VERSION');
	}

	/**
	 * Generates the url to edit the custom CSS for a post.
	 */
	function get_edit_css_link($post)
	{
		$url = admin_url('themes.php?page=so_custom_css');
		if (!is_int($post)) {
			$post = get_post($post);
			$post = $post->ID;
		}

		return empty($post) ? $url : add_query_arg(
			array(
				'socss_post_id' => urlencode($post),
				'open_visual_editor' => 1,
			),
			$url
		);
	}
	/**
	 *
	 */
	function admin_action_hide_getting_started()
	{
		if (!isset($_GET['_wpnonce']) || !wp_verify_nonce($_GET['_wpnonce'], 'hide')) {
			return;
		}

		$user = wp_get_current_user();
		if (!empty($user)) {
			update_user_meta($user->ID, 'socss_hide_gs', true);
		}
	}

	/**
	 * Retrieves the post specific CSS for the supplied postId.
	 */
	function admin_action_get_post_css()
	{
		if (!isset($_GET['_wpnonce']) || !wp_verify_nonce($_GET['_wpnonce'], 'get_post_css')) {
			wp_die(
				esc_html__('The supplied nonce is invalid.', 'so-css'),
				esc_html__('Invalid nonce.', 'so-css'),
				403
			);
		}

		$post_id = filter_input(INPUT_GET, 'postId', FILTER_VALIDATE_INT);

		$current = $this->get_custom_css($this->theme, $post_id);

		$url = empty($post_id) ? home_url() : set_url_scheme(get_permalink($post_id));

		wp_send_json(array('css' => empty($current) ? '' : $current, 'postUrl' => $url));
	}

	/**
	 * Retrieves the past revisions of post specific CSS for the supplied postId.
	 */
	function admin_action_get_revisions_list()
	{
		if (!isset($_GET['_wpnonce']) || !wp_verify_nonce($_GET['_wpnonce'], 'get_revisions_list')) {
			wp_die(
				esc_html__('The supplied nonce is invalid.', 'so-css'),
				esc_html__('Invalid nonce.', 'so-css'),
				403
			);
		}

		$post_id = filter_input(INPUT_GET, 'postId', FILTER_VALIDATE_INT);

		$this->custom_css_revisions_list($this->theme, $post_id);

		wp_die();
	}

	/**
	 * Retrieves the past revisions of post specific CSS for the supplied postId.
	 */
	function admin_action_save_css()
	{
		if (!isset($_GET['_wpnonce']) || !wp_verify_nonce($_GET['_wpnonce'], 'so-css-ajax')) {
			wp_die(
				esc_html__('The supplied nonce is invalid.', 'so-css'),
				esc_html__('Invalid nonce.', 'so-css'),
				403
			);
		}

		if (current_user_can('edit_theme_options') && isset($_POST['css'])) {
			// Sanitize CSS input. Should keep most tags, apart from script and style tags.
			$custom_css = self::sanitize_css(stripslashes($_POST['css']));

			if (empty($this->css_file)) {
				$current = $this->get_custom_css($this->theme);
				$this->save_custom_css($custom_css, $this->theme);
			} else {
				$current = $this->css_file;
			}

			// If this has changed, then add a revision.
			if ($current != $custom_css) {
				$this->add_custom_css_revision($custom_css, $this->theme);
				$this->save_custom_css_file($custom_css, $this->theme);

				// Output the full revisions list.
				$this->custom_css_revisions_list($this->theme);
			}
		}
		wp_die();
	}

	function custom_css_revisions_list($theme, $post_id = null, $current_revision = null)
	{

		$revisions = $this->get_custom_css_revisions($theme, $post_id);

		if (is_array($revisions) && !empty($revisions)) {
			$i = 0;
			foreach ($revisions as $time => $css) {
				$is_current = (empty($current_revision) && $i == 0) || (!empty($current_revision) && $time == $current_revision);
				$query_args = array('theme' => $theme, 'time' => $time, 'open_visual_editor' => false);
				if (!empty($post_id)) {
					$query_args['socss_post_id'] = $post_id;
				}
				?>
				<li>
					<?php if (!$is_current): ?>
						<a href="<?php echo esc_url(add_query_arg($query_args, admin_url('themes.php?page=so_custom_css'))) ?>"
							class="load-css-revision">
						<?php endif; ?>
						<?php echo date('j F Y @ H:i:s', $time + get_option('gmt_offset') * 60 * 60) ?>
						<?php if (!$is_current): ?>
						</a>
					<?php endif; ?>
					(<?php printf(esc_html__('%d chars', 'so-css'), strlen($css)) ?>)<?php if ($i == 0): ?>
						(<?php esc_html_e('Latest', 'so-css'); ?>)<?php endif; ?>
				</li>
				<?php
				$i++;
			}
		} else {
			printf('<em>%s</em>', esc_html__('No revisions yet.', 'so-css'));
		}
	}

	/**
	 *  Add one or more paths to the registered snippet paths
	 *
	 * @param string|array $path
	 */
	function register_snippet_path($path)
	{
		$this->snippet_paths = array_merge($this->snippet_paths, (array) $path);
	}

	/**
	 * Get all the available snippets
	 *
	 * @return array|bool
	 */
	function get_snippets()
	{
		// Get the snippet paths
		$snippet_paths = apply_filters('siteorigin_css_snippet_paths', $this->snippet_paths);
		if (empty($snippet_paths)) {
			return array();
		}

		static $snippets = array();
		if (!empty($snippets)) {
			return $snippets;
		}

		if (!WP_Filesystem()) {
			return false;
		}
		global $wp_filesystem;
		foreach ($snippet_paths as $path) {
			foreach (glob($path . '/*.css') as $css_file) {
				$data = get_file_data(
					$css_file,
					array(
						'Name' => 'Name',
						'Description' => 'Description',
					)
				);

				// Get the CSS and strip out the first header
				$css = $wp_filesystem->get_contents($css_file);
				$css = preg_replace('!/\*.*?\*/!s', '', $css, 1);

				$snippets[] = wp_parse_args(
					$data,
					array(
						'css' => str_replace("\t", '  ', trim($css)),
					)
				);
			}
		}

		usort($snippets, array($this, 'sort_snippet_callback'));

		return $snippets;
	}

	/**
	 * Sort snippets by name.
	 *
	 * @param $a
	 * @param $b
	 *
	 * @return int
	 */
	static function sort_snippet_callback($a, $b)
	{
		return $a['Name'] > $b['Name'] ? 1 : -1;
	}

	/**
	 * A very simple CSS sanitization function.
	 *
	 * @param $css
	 *
	 * @return string
	 */
	static function sanitize_css($css)
	{
		return trim(strip_tags($css));
	}

	/**
	 * Get all the available theme CSS
	 */
	function get_theme_css()
	{
		$css = '';
		if (file_exists(get_template_directory() . '/style.css')) {
			$css .= file_get_contents(get_template_directory() . '/style.css');
		}

		if (is_child_theme()) {
			$css .= file_get_contents(get_stylesheet_directory() . '/style.css');
		}

		// Remove all CSS comments
		$regex = array(
			"`^([\t\s]+)`ism" => '',
			"`^\/\*(.+?)\*\/`ism" => "",
			"`(\A|[\n;]+)/\*[^*]*\*+(?:[^/*][^*]*\*+)*/`" => "$1",
			"`(^[\r\n]*|[\r\n]+)[\s\t]*[\r\n]+`ism" => "\n"
		);
		$css = preg_replace(array_keys($regex), $regex, $css);
		$css = preg_replace('/\s+/', ' ', $css);

		return $css;
	}

	function enqueue_inspector_scripts()
	{
		if (!current_user_can('edit_theme_options')) {
			return;
		}

		wp_enqueue_style('dashicons');

		wp_enqueue_script('siteorigin-css-parser-lib', plugin_dir_url(__FILE__) . 'js/css' . SOCSS_JS_SUFFIX . '.js', array('jquery'), SOCSS_VERSION);

		wp_enqueue_script('siteorigin-css-sizes', plugin_dir_url(__FILE__) . 'js/jquery.sizes' . SOCSS_JS_SUFFIX . '.js', array('jquery'), '0.33');
		wp_enqueue_script('siteorigin-css-specificity', plugin_dir_url(__FILE__) . 'js/specificity' . SOCSS_JS_SUFFIX . '.js', array());
		wp_enqueue_script('siteorigin-css-inspector', plugin_dir_url(__FILE__) . 'js/inspector' . SOCSS_JS_SUFFIX . '.js', array(
			'jquery',
			'underscore',
			'backbone'
		), SOCSS_VERSION, true);
		wp_enqueue_style('siteorigin-css-inspector', plugin_dir_url(__FILE__) . 'css/inspector.css', array(), SOCSS_VERSION);

		wp_localize_script('siteorigin-css-inspector', 'socssOptions', array());
	}

	function inspector_templates()
	{
		if (!current_user_can('edit_theme_options')) {
			return;
		}

		include plugin_dir_path(__FILE__) . 'tpl/inspector-templates.php';
	}

	/**
	 * Change the stylesheets to all be inline
	 */
	function inline_inspector_scripts()
	{
		if (!current_user_can('edit_theme_options')) {
			return;
		}

		$regex = array(
			"`^([\t\s]+)`ism" => '',
			"`^\/\*(.+?)\*\/`ism" => "",
			"`(\A|[\n;]+)/\*[^*]*\*+(?:[^/*][^*]*\*+)*/`" => "$1",
			"`(^[\r\n]*|[\r\n]+)[\s\t]*[\r\n]+`ism" => "\n"
		);

		global $wp_styles;
		if (empty($wp_styles->queue)) {
			return;
		}

		// Make each of the scripts inline
		foreach ($wp_styles->queue as $handle) {
			if ($handle === 'siteorigin-css-inspector' || $handle === 'dashicons') {
				continue;
			}
			$style = $wp_styles->registered[$handle];
			if (empty($style->src) || substr($style->src, 0, 4) !== 'http') {
				continue;
			}
			$response = wp_remote_get($style->src);
			if (is_wp_error($response) || $response['response']['code'] !== 200 || empty($response['body'])) {
				continue;
			}

			$css = $response['body'];
			$css = preg_replace(array_keys($regex), $regex, $css);

			?>
			<script type="text/css" class="socss-theme-styles" id="socss-inlined-style-<?php echo sanitize_html_class($handle) ?>">
			<?php echo strip_tags($css);
			?>
			</script>
			<?php
		}
	}

	function disable_ngg_resource_manager()
	{
		if (!current_user_can('edit_theme_options')) {
			return;
		}

		//The NextGen Gallery plugin does some weird interfering with the output buffer.
		define('NGG_DISABLE_RESOURCE_MANAGER', true);
	}

	private function get_latest_revision_timestamp()
	{
		$revisions = $this->get_custom_css_revisions($this->theme);
		if (empty($revisions)) {
			return false;
		}
		krsort($revisions);
		$revision_times = array_keys($revisions);

		return $revision_times[0];
	}
}

// Initialize the single
SiteOrigin_CSS::single();

// List Social 
if (!defined('ABSPATH'))
	die();

$cnssUploadDir = wp_upload_dir();
$cnssBaseDir = $cnssUploadDir['basedir'] . '/';
$cnssBaseURL = $cnssUploadDir['baseurl'] . '';
$cnssPluginsURI = plugins_url('/', __FILE__);

add_action('init', 'cnss_init_script');
add_action('init', 'cnss_process_post');
add_action('admin_init', 'cnss_delete_icon');
add_action('wp_ajax_update-social-icon-order', 'cnss_save_ajax_order');
add_action('admin_menu', 'cnss_add_menu_pages');
add_action('wp_head', 'cnss_social_profile_links_fn');
add_action('admin_enqueue_scripts', 'cnss_admin_style');
if (isset($_GET['page'])) {
	if ($_GET['page'] == 'cnss_social_icon_add') {
		add_action('admin_enqueue_scripts', 'cnss_admin_enqueue');
	}
}
register_activation_hook(__FILE__, 'cnss_db_install');
add_shortcode('cn-social-icon', 'cn_social_icon');

function cnss_delete_icon()
{
	global $wpdb, $err, $msg, $cnssBaseDir;
	if (isset($_GET['cnss-delete'])) {
		if (!is_numeric($_GET['id'])) {
			wp_die('Sequrity Issue.');
		}

		if ($_GET['id'] != '' && wp_verify_nonce($_GET['_wpnonce'], 'cnss_delete_icon')) {
			$table_name = $wpdb->prefix . "cn_social_icon";
			$image_file_path = $cnssBaseDir;
			$wpdb->delete($table_name, array('id' => sanitize_text_field($_GET['id'])), array('%d'));
			$msg = "Delete Successful !";
		}
	}
}

function cnss_admin_sidebar()
{

	$banners = array(
		array(
			'url' => 'http://www.cybernetikz.com/wordpress-magento-plugins/wordpress-plugins/?utm_source=easy-social-icons&utm_medium=banner&utm_campaign=wordpress-plugins',
			'img' => 'banner-1.jpg',
			'alt' => 'Banner 1',
		),
		array(
			'url' => 'http://www.cybernetikz.com/web-development/wordpress-website/?utm_source=easy-social-icons&utm_medium=banner&utm_campaign=wordpress-plugins',
			'img' => 'banner-2.jpg',
			'alt' => 'Banner 2',
		),
		array(
			'url' => 'http://www.cybernetikz.com/seo-consultancy/?utm_source=easy-social-icons&utm_medium=banner&utm_campaign=wordpress-plugins',
			'img' => 'banner-3.jpg',
			'alt' => 'Banner 3',
		),
	);
	//shuffle( $banners );
	?>
	<div class="cn_admin_banner">
		<?php
		$i = 0;
		foreach ($banners as $banner) {
			echo '<a target="_blank" href="' . esc_url($banner['url']) . '"><img width="261" height="190" src="' . plugins_url('images/' . $banner['img'], __FILE__) . '" alt="' . esc_attr($banner['alt']) . '"/></a>';
			$i++;
		}
		?>
	</div>
	<?php
}

function cnss_admin_style()
{
	global $cnssPluginsURI;
	wp_register_style('cnss_admin_css', $cnssPluginsURI . 'css/admin-style.css', false, '1.0');
	wp_register_style('cnss_font_awesome_css', $cnssPluginsURI . 'css/font-awesome/css/all.min.css', false, '5.7.2');
	wp_register_style('cnss_font_awesome_v4_shims', $cnssPluginsURI . 'css/font-awesome/css/v4-shims.min.css', false, '5.7.2');
	wp_enqueue_style('cnss_admin_css');
	wp_enqueue_style('cnss_font_awesome_css');
	wp_enqueue_style('cnss_font_awesome_v4_shims');
	wp_enqueue_style('wp-color-picker');
}

function cnss_init_script()
{
	global $cnssPluginsURI;
	wp_enqueue_script('jquery');
	wp_enqueue_script('jquery-ui-sortable');
	wp_register_script('cnss_js', $cnssPluginsURI . 'js/cnss.js', array(), '1.0');
	wp_enqueue_script('cnss_js');

	wp_register_style('cnss_font_awesome_css', $cnssPluginsURI . 'css/font-awesome/css/all.min.css', false, '5.7.2');
	wp_enqueue_style('cnss_font_awesome_css');

	wp_register_style('cnss_font_awesome_v4_shims', $cnssPluginsURI . 'css/font-awesome/css/v4-shims.min.css', false, '5.7.2');
	wp_enqueue_style('cnss_font_awesome_v4_shims');

	wp_register_style('cnss_css', $cnssPluginsURI . 'css/cnss.css', array(), '1.0');
	wp_enqueue_style('cnss_css');
	wp_enqueue_script('wp-color-picker');
}

function cnss_admin_enqueue()
{
	global $cnssPluginsURI;
	wp_enqueue_media();
	wp_register_script('cnss_admin_js', $cnssPluginsURI . 'js/cnss_admin.js', array(), '1.0');
	wp_enqueue_script('cnss_admin_js');
}

function cnss_get_all_icons($where_sql = '')
{
	global $wpdb;
	$table_name = $wpdb->prefix . "cn_social_icon";
	$sql = $wpdb->prepare("SELECT `id`, `title`, `url`, `image_url`, `sortorder`, `target` FROM {$table_name} WHERE `url` != '' AND `image_url` != '' ORDER BY `sortorder`");

	$social_icons = $wpdb->get_results($sql);
	if (count($social_icons) > 0) {
		return $social_icons;
	} else {
		return array();
	}
}

function cnss_get_option($key = '')
{
	if ($key == '') {
		return;
	}

	$cnss_esi_settings = array(
		'cnss-width' => '32',
		'cnss-height' => '32',
		'cnss-margin' => '4',
		'cnss-row-count' => '1',
		'cnss-vertical-horizontal' => 'horizontal',
		'cnss-text-align' => 'center',
		'cnss-social-profile-links' => '0',
		'cnss-social-profile-type' => 'Person',
		'cnss-icon-bg-color' => '#999999',
		'cnss-icon-bg-hover-color' => '#666666',
		'cnss-icon-color' => '#ffffff',
		'cnss-icon-hover-color' => '#ffffff',
		'cnss-icon-shape' => 'square',
		'cnss-original-icon-color' => '1'
	);
	if (get_option($key) != '') {
		return get_option($key);
	} else {
		return $cnss_esi_settings[$key];
	}
}

function cnss_social_profile_links_fn()
{

	$social_profile_links = cnss_get_option('cnss-social-profile-links');
	$cnss_original_icon_color = cnss_get_option('cnss-original-icon-color');
	$icon_bg_color = cnss_get_option('cnss-icon-bg-color');
	$icon_bg_hover_color = cnss_get_option('cnss-icon-bg-hover-color');
	$icon_hover_color = cnss_get_option('cnss-icon-hover-color');

	$icons = cnss_get_all_icons();
	if (!empty($icons) && $social_profile_links == 1) {
		$sameAs = '';
		$social_profile_type = get_option('cnss-social-profile-type');
		$profile_type = $social_profile_type == 'Person' ? 'Person' : 'Organization';
		foreach ($icons as $icon) {
			$sameAs .= '"' . $icon->url . '",';
		}
		$sameAs = rtrim($sameAs, ',');
		echo '<script type="application/ld+json">
		{
		  "@context": "http://schema.org",
		  "@type": "' . $profile_type . '",
		  "name": "' . get_option('blogname') . '",
		  "url": "' . esc_url(home_url('/')) . '",
		  "sameAs": [' . $sameAs . ']
		}
		</script>';
	}

	if ($cnss_original_icon_color == '1') {
		echo '<style type="text/css">
		ul.cnss-social-icon li.cn-fa-icon a:hover{opacity: 0.7!important;color:' . $icon_hover_color . '!important;}
		</style>';
	} else {
		echo '<style type="text/css">
		ul.cnss-social-icon li.cn-fa-icon a{background-color:' . $icon_bg_color . '!important;}
		ul.cnss-social-icon li.cn-fa-icon a:hover{background-color:' . $icon_bg_hover_color . '!important;color:' . $icon_hover_color . '!important;}
		</style>';
	}
}

function cnss_add_menu_pages()
{
	add_menu_page('Tùy Biến Icons', 'Tùy Biến Icons', 'manage_options', 'cnss_social_icon_page', 'cnss_social_icon_page_fn', 'dashicons-share');

	add_submenu_page('cnss_social_icon_page', 'Tất Cả Icons', 'Tất Cả Icons', 'manage_options', 'cnss_social_icon_page', 'cnss_social_icon_page_fn');

	add_submenu_page('cnss_social_icon_page', 'Thêm Mới', 'Thêm Mới', 'manage_options', 'cnss_social_icon_add', 'cnss_social_icon_add_fn');

	add_submenu_page('cnss_social_icon_page', 'Sấp Xếp', 'Sấp Xếp', 'manage_options', 'cnss_social_icon_sort', 'cnss_social_icon_sort_fn');

	add_submenu_page('cnss_social_icon_page', 'Cài Đặt', 'Cài Đặt', 'manage_options', 'cnss_social_icon_option', 'cnss_social_icon_option_fn');

	add_action('admin_init', 'cnss_register_settings');
}

function cnss_register_settings()
{
	register_setting('cnss-settings-group', 'cnss-width');
	register_setting('cnss-settings-group', 'cnss-height');
	register_setting('cnss-settings-group', 'cnss-margin');
	register_setting('cnss-settings-group', 'cnss-row-count');
	register_setting('cnss-settings-group', 'cnss-vertical-horizontal');
	register_setting('cnss-settings-group', 'cnss-text-align');
	register_setting('cnss-settings-group', 'cnss-social-profile-links');
	register_setting('cnss-settings-group', 'cnss-social-profile-type');
	register_setting('cnss-settings-group', 'cnss-icon-bg-color');
	register_setting('cnss-settings-group', 'cnss-icon-bg-hover-color');
	register_setting('cnss-settings-group', 'cnss-icon-color');
	register_setting('cnss-settings-group', 'cnss-icon-hover-color');
	register_setting('cnss-settings-group', 'cnss-icon-shape');
	register_setting('cnss-settings-group', 'cnss-original-icon-color', 'cnss_original_icon_color_fn');
}

function cnss_original_icon_color_fn($value)
{
	return $value == '' ? '0' : $value;
}

function cnss_sanitize_array(array $arr)
{
	return array_map('sanitize_text_field', $arr);
}

function cnss_social_icon_option_fn()
{

	$cnss_width = esc_attr(get_option('cnss-width'));
	$cnss_height = esc_attr(get_option('cnss-height'));
	$cnss_margin = esc_attr(get_option('cnss-margin'));
	$cnss_rows = esc_attr(get_option('cnss-row-count'));
	$vorh = esc_attr(get_option('cnss-vertical-horizontal'));
	$text_align = esc_attr(get_option('cnss-text-align'));
	$social_profile_links = get_option('cnss-social-profile-links');
	$social_profile_type = get_option('cnss-social-profile-type');
	$icon_bg_color = get_option('cnss-icon-bg-color');
	$icon_bg_hover_color = get_option('cnss-icon-bg-hover-color');
	$icon_color = get_option('cnss-icon-color');
	$icon_hover_color = get_option('cnss-icon-hover-color');
	$icon_shape = get_option('cnss-icon-shape');
	$cnss_original_icon_color = get_option('cnss-original-icon-color');

	$vertical = '';
	$horizontal = '';
	if ($vorh == 'vertical')
		$vertical = 'checked="checked"';
	if ($vorh == 'horizontal')
		$horizontal = 'checked="checked"';

	$center = '';
	$left = '';
	$right = '';
	if ($text_align == 'center')
		$center = 'checked="checked"';
	if ($text_align == 'left')
		$left = 'checked="checked"';
	if ($text_align == 'right')
		$right = 'checked="checked"';

	?>
	<div class="wrap">

		<h2 style="margin-bottom: 12px;">Cài Đặt Icon</h2>
		<div class="content_wrapper">
			<div style="background-color: #fff; padding: 12px 24px;" class="left">
				<form method="post" action="options.php" enctype="multipart/form-data">
					<?php settings_fields('cnss-settings-group'); ?>
					<table class="form-table">
						<tr valign="top">
							<th scope="row">Chiều Rộng Icon</th>
							<td><input type="number" name="cnss-width" id="cnss-width" class="small-text"
									value="<?php echo esc_attr($cnss_width) ?>" />px</td>
						</tr>
						<tr valign="top">
							<th scope="row">Chiều Cao Icon</th>
							<td><input type="number" name="cnss-height" id="cnss-height" class="small-text"
									value="<?php echo esc_attr($cnss_height) ?>" />px</td>
						</tr>
						<tr valign="top">
							<th scope="row">Khoảng cách Icon</th>
							<td><input type="number" name="cnss-margin" id="cnss-margin" class="small-text"
									value="<?php echo esc_attr($cnss_margin) ?>" />px <em><small>(Khoảng cách giữa các
										icon)</small></em></td>
						</tr>

						<tr valign="top">
							<th scope="row">Hiển Thị Icon</th>
							<td>
								<input <?php echo $horizontal ?> type="radio" name="cnss-vertical-horizontal"
									id="horizontal" value="horizontal" />&nbsp;<label for="horizontal">Theo chiều
									ngang</label><br />
								<input <?php echo $vertical ?> type="radio" name="cnss-vertical-horizontal" id="vertical"
									value="vertical" />&nbsp;<label for="vertical">Theo chiều dọc</label>
							</td>
						</tr>

						<tr valign="top">
							<th scope="row">Căn Chỉnh Icon</th>
							<td>
								<input <?php echo $center ?> type="radio" name="cnss-text-align" id="center"
									value="center" />&nbsp;<label for="center">Giữa</label><br />
								<input <?php echo $left ?> type="radio" name="cnss-text-align" id="left"
									value="left" />&nbsp;<label for="left">Trái</label><br />
								<input <?php echo $right ?> type="radio" name="cnss-text-align" id="right"
									value="right" />&nbsp;<label for="right">Phải</label>
							</td>
						</tr>

						<?php /* ?><tr valign="top">
						 <th scope="row">Google Social Profile Links</th>
						 <td>
						 <input type="checkbox" id="cnss_social_profile_links" name="cnss-social-profile-links"
						 value="1" <?php echo $social_profile_links==1?'checked="checked"':''; ?>>
						 <a target="_blank"
						 href="https://developers.google.com/search/docs/data-types/social-profile-links"
						 style="text-decoration: none;" id="show_whatis_social_profile_links">What is Social
						 Profile Links?</a>
						 <div style="position: relative;">
						 <img width="300" style="position: absolute; top:-300px; right: 0;"
						 id="whatis_social_profile_links" class="hidden"
						 src="<?php echo plugins_url( 'images/' . 'social-profiles.png', __FILE__ ); ?>">
						 </div>
						 </td>
						 </tr>
						 <tr id="wrap-social-profile-type" valign="top"
						 style="<?php echo $social_profile_links==1?'':'display: none;'; ?>">
						 <th scope="row">Google Social Profile Type</th>
						 <td>
						 <select name="cnss-social-profile-type">
						 <option <?php echo $social_profile_type=='Person'?'selected="selected"':''; ?>
						 value="Person">Person</option>
						 <option <?php echo $social_profile_type=='Organization'?'selected="selected"':''; ?>
						 value="Organization">Organization</option>
						 </select>
						 </td>
						 </tr>
						 <tr>
						 <th colspan="2">
						 <h2>Following settings is for Font-Awesome icons only</h2>
						 </th>
						 </tr><?php */?>

						<tr valign="top">
							<th scope="row">Sử Dụng Màu Gốc</th>
							<td style="display: flex; align-items: center; padding: 20px 10px 20px 0"><input type="checkbox"
									id="cnss_use_original_color" name="cnss-original-icon-color" value="1"
									<?php echo $cnss_original_icon_color == 1 ? 'checked="checked"' : ''; ?>>
								<em>Sử dụng màu gốc cho các Icon, như <span
										style="background:#3b5998; color: #fff;">facebook</span> là màu xanh lam, <span
										style="background:#e62f27; color: #fff;">youtube</span> là màu đỏ.</em>
							</td>
						</tr>

						<!-- <tr class="wrap-icon-bg-color" valign="top"
																																						style="<?php echo $cnss_original_icon_color == 1 ? 'display: none;' : ''; ?>"> -->
						<tr class="wrap-icon-bg-color" valign="top">
							<th scope="row">Màu Sắc Background Icon</th>
							<td><input type="text" name="cnss-icon-bg-color" id="cnss-icon-bg-color"
									class="cnss-fa-icon-color" value="<?php echo esc_attr($icon_bg_color) ?>" /></td>
						</tr>
						<!-- <tr class="wrap-icon-bg-color" valign="top"
																																					style="<?php echo $cnss_original_icon_color == 1 ? 'display: none;' : ''; ?>"> -->
						<tr class="wrap-icon-bg-color" valign="top">
							<th scope="row">Màu Sắc Background Khi Di Chuột Vào Icon</th>
							<td><input type="text" name="cnss-icon-bg-hover-color" id="cnss-icon-bg-hover-color"
									class="cnss-fa-icon-color" value="<?php echo esc_attr($icon_bg_hover_color) ?>" /></td>
						</tr>

						<tr valign="top">
							<th scope="row">Màu Sắc Icon</th>
							<td><input type="text" name="cnss-icon-color" id="cnss-icon-color" class="cnss-fa-icon-color"
									value="<?php echo esc_attr($icon_color) ?>" /></td>
						</tr>
						<tr valign="top">
							<th scope="row">Màu sắc Icon Khi Di Chuột Vào</th>
							<td><input type="text" name="cnss-icon-hover-color" id="cnss-icon-hover-color"
									class="cnss-fa-icon-color" value="<?php echo esc_attr($icon_hover_color) ?>" /></td>
						</tr>

						<tr valign="top">
							<th scope="row">Hình Dạng Icon</th>
							<td><select name="cnss-icon-shape" id="cnss-icon-shape">
									<!-- <option <?php selected($icon_shape, 'square'); ?> value="square">Square</option>
																																						<option <?php selected($icon_shape, 'circle'); ?> value="circle">Circle</option>
																																						<option <?php selected($icon_shape, 'round-corner'); ?> value="round-corner">Round
																																							Corner</option> -->
									<option <?php selected($icon_shape, 'square'); ?> value="square">Hình Vuông</option>
									<option <?php selected($icon_shape, 'circle'); ?> value="circle">Hình Tròn</option>
									<option <?php selected($icon_shape, 'round-corner'); ?> value="round-corner">Round
									</option>
								</select></td>
						</tr>
					</table>
					<p class="submit" style="text-align:center"><input type="submit" class="button-primary"
							value="<?php _e('Save Changes') ?>" />
						<?php echo cnss_back_to_link() ?>
					</p>
				</form>
				<script type="text/javascript">
				jQuery(document).ready(function($) {
					$('#show_whatis_social_profile_links').hover(function() {
						//e.preventDefault();
						$('#whatis_social_profile_links').fadeToggle('fast');
					});
					$('input#cnss_social_profile_links').change(function(event) {
						if ($(this).prop("checked") == true) {
							$('#wrap-social-profile-type').fadeIn('fast');
						} else {
							$('#wrap-social-profile-type').fadeOut('fast');
						}
					});
					$('input#cnss_use_original_color').change(function(event) {
						if ($(this).prop("checked") == false) {
							$('.wrap-icon-bg-color').fadeIn('fast');
						} else {
							$('.wrap-icon-bg-color').fadeOut('fast');
						}
					});

				});
				jQuery(document).ready(function($) {
					$('.cnss-fa-icon-color').wpColorPicker();
				});
				</script>

				<h2 id="shortcode">Cách sử dụng</h2>
				<fieldset style="display: none;" class="cnss-esi-shadow">
					<legend>
						<h4 class="sec-title">Using Widget</h4>
					</legend>
					<p>Simply go to <strong>Appearance -> <a href="widgets.php">Widgets</a></strong>
						then drag drop <code>Easy Social Icons</code> widget to <strong>Widget Area</strong></p>
				</fieldset>

				<fieldset class="cnss-esi-shadow">
					<legend>
						<h4 class="sec-title">Sử Dụng Shortcode</h4>
					</legend>
					<?php
					$shortcode = '[cn-social-icon';
					if (isset($_POST['generate_shortcode']) && check_admin_referer('cn_gen_sc')) {
						if (is_numeric($_POST['_width']) && $cnss_width != $_POST['_width']) {
							$shortcode .= ' width=&quot;' . sanitize_text_field($_POST['_width']) . '&quot;';
						}
						if (is_numeric($_POST['_height']) && $cnss_height != $_POST['_height']) {
							$shortcode .= ' height=&quot;' . sanitize_text_field($_POST['_height']) . '&quot;';
						}
						if (is_numeric($_POST['_margin']) && $cnss_margin != $_POST['_margin']) {
							$shortcode .= ' margin=&quot;' . sanitize_text_field($_POST['_margin']) . '&quot;';
						}
						if (isset($_POST['_alignment']) && $text_align != $_POST['_alignment']) {
							$shortcode .= ' alignment=&quot;' . sanitize_text_field($_POST['_alignment']) . '&quot;';
							$text_align = sanitize_text_field($_POST['_alignment']);
						}
						if (isset($_POST['_display']) && $vorh != $_POST['_display']) {
							$shortcode .= ' display=&quot;' . sanitize_text_field($_POST['_display']) . '&quot;';
							$vorh = sanitize_text_field($_POST['_display']);
						}
						if (isset($_POST['_attr_id']) && $_POST['_attr_id'] != '') {
							$shortcode .= ' attr_id=&quot;' . sanitize_text_field($_POST['_attr_id']) . '&quot;';
						}
						if (isset($_POST['_attr_class']) && $_POST['_attr_class'] != '') {
							$shortcode .= ' attr_class=&quot;' . sanitize_text_field($_POST['_attr_class']) . '&quot;';
						}
						if (isset($_POST['_selected_icons'])) {
							if (is_array($_POST['_selected_icons'])) {
								$ids = implode(',', cnss_sanitize_array($_POST['_selected_icons']));
								$shortcode .= ' selected_icons=&quot;' . $ids . '&quot;';
							}
						}
					}
					$shortcode .= ']';
					?>
					<p>Sao chép và dán <strong>Shortcode</strong> vào bất kì <strong>Trang</strong> hoặc <strong>Bài
							Viết</strong> nào.
					<p>

					<p><input onclick="this.select();" readonly="readonly" type="text"
							value="<?php echo esc_attr($shortcode); ?>" class="large-text" /></p>
					<!-- <p>Or you can change following icon settings and click <strong>Generate Shortcode</strong> button to get
																														updated shortcode.</p> -->
					<form method="post" action="admin.php?page=cnss_social_icon_option#shortcode"
						enctype="application/x-www-form-urlencoded">
						<?php wp_nonce_field('cn_gen_sc'); ?>
						<input type="hidden" name="generate_shortcode" value="1" />
						<table width="100%" border="0">
							<tr>
								<td width="140">
									<label><?php _e('Chiều Rộng Icon <em>(px)</em>:'); ?></label>
									<input class="widefat" name="_width" type="number" value="<?php
									echo esc_attr(isset($_POST['_width']) ? $_POST['_width'] : $cnss_width); ?>">
								</td>
								<td>&nbsp;</td>
								<td width="140">
									<label>
										<?php _e('Chiều Cao Icon <em>(px)</em>:'); ?>
									</label>
									<input class="widefat" name="_height" type="number" value="<?php
									echo esc_attr(isset($_POST['_height']) ? $_POST['_height'] : $cnss_height); ?>">
								</td>
								<td>&nbsp;</td>
								<td>
									<label>
										<?php _e('Khoảng Cách <em>(px)</em>:'); ?>
									</label><br />
									<input class="widefat" name="_margin" type="number" value="<?php
									echo esc_attr(isset($_POST['_margin']) ? $_POST['_margin'] : $cnss_margin); ?>">
								</td>
								<td>&nbsp;</td>
								<td><label>
										<?php _e('Căn Chỉnh:'); ?>
									</label><br />
									<select name="_alignment">
										<option <?php if ($text_align == 'center')
											echo 'selected="selected"'; ?> value="center">Giữa</option>
										<option <?php if ($text_align == 'left')
											echo 'selected="selected"'; ?> value="left">
											Trái</option>
										<option <?php if ($text_align == 'right')
											echo 'selected="selected"'; ?> value="right">Phải</option>
									</select>
								</td>
								<td>&nbsp;</td>
								<td><label>
										<?php _e('Hiển Thị:'); ?>
									</label><br />
									<select name="_display">
										<option <?php if ($vorh == 'horizontal')
											echo 'selected="selected"'; ?> value="horizontal">Theo chiều ngang</option>
										<option <?php if ($vorh == 'vertical')
											echo 'selected="selected"'; ?> value="vertical">Theo chiều dọc</option>
									</select>
								</td>
								<td>&nbsp;</td>
								<td>
									<label>
										<?php _e('Tùy Chỉnh ID:'); ?>
									</label>
									<input class="widefat" placeholder="ID" name="_attr_id" type="text" value="<?php
									echo esc_attr(isset($_POST['_attr_id']) ? $_POST['_attr_id'] : ''); ?>">
								</td>
								<td>&nbsp;</td>
								<td>
									<label>
										<?php _e('Tùy Chỉnh Class:'); ?>
									</label>
									<input class="widefat" placeholder="Class" name="_attr_class" type="text" value="<?php
									echo esc_attr(isset($_POST['_attr_class']) ? $_POST['_attr_class'] : ''); ?>">
								</td>
							</tr>
						</table>
						<p></p>
						<?php echo cnss_social_icon_sc(isset($_POST['_selected_icons']) ? cnss_sanitize_array($_POST['_selected_icons']) : array()); ?>
						<p style="display: flex; align-items: center;">
							<label style="margin-right: 10px">
								<?php _e('Chọn Icons Hiển Thị:'); ?>
							</label>
							<span>(Niếu bạn không chọn ít nhất 1 icon thì tất cả icon sẽ hiển thị)</span>
						</p>
						<p>
							<input type="submit" class="button-primary" value="<?php _e('Tạo Shortcode') ?>" />
						</p>
					</form>
					<p><strong>Ghi Chú</strong>: Bạn có thể thêm shortcode vào <strong>Text Widget</strong> với đoạn mã
						<code>add_filter('widget_text', 'do_shortcode');</code> và cần được thêm vào theme chủ đề của bạn
						<strong>functions.php</strong> file.
					</p>
				</fieldset>

				<fieldset style="display: none;" class="cnss-esi-shadow" style="margin-bottom:0px;">
					<legend>
						<h4 class="sec-title">Using PHP Template Tag</h4>
					</legend>
					<p><strong>Simple Use</strong></p>
					<p>If you are familiar with PHP code, then you can use PHP Template Tag</p>
					<pre><code>&lt;?php if ( function_exists('cn_social_icon') ) echo cn_social_icon(); ?&gt;</code></pre>
					<p><strong>Advanced Use</strong></p>
					<pre><code>&lt;?php
																																			$attr = array (
																																				'width' => '32', //input only number, in pixel
																																				'height' => '32', //input only number, in pixel
																																				'margin' => '4', //input only number, in pixel
																																				'display' => 'horizontal', //horizontal | vertical
																																				'alignment' => 'center', //center | left | right
																																				'attr_id' => 'custom_icon_id', //add custom id to &lt;ul&gt; wraper
																																				'attr_class' => 'custom_icon_class', //add custom class to &lt;ul&gt; wraper
																																				'selected_icons' => array ( '1', '3', '5', '6' )
																																				//you can get the icon ID form <strong><a href="admin.php?page=cnss_social_icon_page">All Icons</a></strong> page
																																			);
																																			if ( function_exists('cn_social_icon') ) echo cn_social_icon( $attr );
																																			?&gt;</code></pre>
				</fieldset>

			</div>

		</div>
	</div>
	<?php
}

function cnss_db_install()
{
	global $wpdb;

	$table_name = $wpdb->prefix . "cn_social_icon";
	if ($wpdb->get_var("show tables like '$table_name'") != $table_name) {
		$sql_create_table = "CREATE TABLE IF NOT EXISTS `$table_name` (
		`id` INT NOT NULL AUTO_INCREMENT,
		`title` VARCHAR(255) NULL,
		`url` VARCHAR(255) NOT NULL,
		`image_url` VARCHAR(255) NOT NULL,
		`sortorder` INT NOT NULL DEFAULT '0',
		`date_upload` VARCHAR(50) NULL,
		`target` tinyint(1) NOT NULL DEFAULT '1',
		PRIMARY KEY (`id`)) ENGINE = InnoDB;
		INSERT INTO `wp_cn_social_icon` (`id`, `title`, `url`, `image_url`, `sortorder`, `date_upload`, `target`) VALUES
		(1, 'Facebook', 'https://facebook.com/', 'fa fa-facebook', 0, '1487164658', 1),
		(2, 'Twitter', 'https://twitter.com/', 'fa fa-twitter', 1, '1487164673', 1),
		(3, 'LinkedIn', 'https://linkedin.com/', 'fa fa-linkedin', 2, '1487164712', 1);";

		require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
		dbDelta($sql_create_table);
	}

	$cnss_esi_settings = array(
		'cnss-width' => '32',
		'cnss-height' => '32',
		'cnss-margin' => '4',
		'cnss-row-count' => '1',
		'cnss-vertical-horizontal' => 'horizontal',
		'cnss-text-align' => 'center',
		'cnss-social-profile-links' => '0',
		'cnss-social-profile-type' => 'Person',
		'cnss-icon-bg-color' => '#666666',
		'cnss-icon-bg-hover-color' => '#333333',
		'cnss-icon-color' => '#ffffff',
		'cnss-icon-hover-color' => '#ffffff',
		'cnss-icon-shape' => 'square',
		'cnss-original-icon-color' => '1'
	);

	foreach ($cnss_esi_settings as $key => $value) {
		add_option(trim($key), trim($value));
	}
}

function cnss_process_post()
{
	global $wpdb, $err, $msg, $cnssBaseDir;
	if (isset($_POST['submit_button']) && check_admin_referer('cn_insert_icon')) {

		if ($_POST['action'] == 'update') {

			$err = "";
			$msg = "";

			$image_file_path = $cnssBaseDir;

			if ($err == '') {
				$table_name = $wpdb->prefix . "cn_social_icon";

				$results = $wpdb->insert(
					$table_name,
					array(
						'title' => sanitize_title($_POST['title']),
						'url' => esc_url_raw($_POST['url']),
						'image_url' => sanitize_text_field($_POST['image_file']),
						'sortorder' => sanitize_sql_orderby($_POST['sortorder']),
						'date_upload' => time(),
						'target' => sanitize_sql_orderby($_POST['target']),
					),
					array(
						'%s',
						'%s',
						'%s',
						'%d',
						'%s',
						'%d',
					)
				);

				if (!$results)
					$err .= "Fail to update database";
				else
					$msg .= "Update successful !";
			}
			/*
			$allSocialMediaIcons = array('500px','amazon','android','angellist','apple','bandcamp','behance','behance-square','bitbucket','bluetooth','cc-amex','cc-mastercard','cc-paypal','cc-stripe','cc-visa','codepen','css3','delicious','deviantart','digg','dribbble ','dropbox','drupal','edge ','etsy','expeditedssl','facebook','facebook-f','facebook-official','facebook-square','firefox','flickr','forumbee ','foursquare','free-code-camp','get-pocket','git ','git-square ','github ','github-square ','gitlab','google ','google-plus','google-plus-circle','google-plus-official','google-plus-square','google-wallet','gratipay','hacker-news','houzz','html5','imdb','instagram','internet-explorer','joomla','lastfm','linkedin','linkedin-square','linux','maxcdn ','medium ','meetup','odnoklassniki','opera','paypal','pinterest ','pinterest-p ','pinterest-square ','product-hunt','quora ','reddit ','rss ','scribd','skype','slack','slideshare ','snapchat','soundcloud','spotify','stack-exchange','stack-overflow','steam','stumbleupon','telegram','trello','tripadvisor','tumblr','tumblr-square','twitch','twitter','twitter-square','viadeo','vimeo ','vimeo-square ','vine ','wechat','whatsapp ','wikipedia-w','windows','wordpress ','xing','xing-square','yahoo','yelp','youtube','youtube-square');
			$table_name = $wpdb->prefix . "cn_social_icon";
			$i = 0;
			foreach ($allSocialMediaIcons as $icon) {
			$results = $wpdb->insert(
			$table_name,
			array(
			'title' => $icon,
			'url' => 'https://'.$icon.'.com/',
			'image_url' => 'fa fa-'.$icon,
			'sortorder' => $i,
			'date_upload' => time(),
			'target' => '1',
			),
			array(
			'%s',
			'%s',
			'%s',
			'%d',
			'%s',
			'%d',
			)
			);
			$i++;
			}
			*/
		} // end if update

		if ($_POST['action'] == 'edit' and $_POST['id'] != '') {
			$err = "";
			$msg = "";

			$image_file_path = $cnssBaseDir;

			$update = "";
			$type = 1;

			if ($err == '') {
				$table_name = $wpdb->prefix . "cn_social_icon";
				$result3 = $wpdb->update(
					$table_name,
					array(
						'title' => sanitize_title($_POST['title']),
						'url' => esc_url_raw($_POST['url']),
						'image_url' => sanitize_text_field($_POST['image_file']),
						'sortorder' => sanitize_sql_orderby($_POST['sortorder']),
						'date_upload' => time(),
						'target' => sanitize_sql_orderby($_POST['target']),
					),
					array('id' => sanitize_text_field($_POST['id'])),
					array(
						'%s',
						'%s',
						'%s',
						'%d',
						'%s',
						'%d',
					),
					array('%d')
				);

				if (false === $result3) {
					$err .= "Update fails !";
				} else {
					$msg = "Update successful !";
				}
			}
		} // end edit
	}
}

function cnss_social_icon_sort_fn()
{
	global $wpdb, $cnssBaseURL;

	$cnss_width = esc_attr(get_option('cnss-width'));
	$cnss_height = esc_attr(get_option('cnss-height'));

	$image_file_path = $cnssBaseURL;
	$icons = cnss_get_all_icons();

	?>
	<div class="wrap">

		<h2>Sấp Xếp Icons</h2>

		<div id="ajax-response"></div>
		<div class="content_wrapper">
			<div class="left">

				<noscript>
					<div class="error message">
						<p>
							<?php _e('This plugin can\'t work without javascript, because it\'s use drag and drop and AJAX.', 'cpt') ?>
						</p>
					</div>
				</noscript>

				<div id="order-post-type" style="padding:15px 20px 20px; background:#fff; border:1px solid #ebebeb;">
					<ul id="sortable">
						<?php
						foreach ($icons as $icon) {
							?>
							<li id="item_<?php echo esc_attr($icon->id) ?>">
								<table width="100%" border="0" cellspacing="0" cellpadding="0">
									<tr style="background:#f7f7f7">
										<td style="padding:5px 5px 0;" width="64">
											<?php echo cnss_get_icon_html($icon->image_url, $icon->title); ?>
										</td>
										<td width="200"><span><?php echo $icon->title; ?></span></td>
										<td align="left" style="text-align:left;"><span>
												<?php echo $icon->url; ?>
											</span></td>
									</tr>
								</table>
							</li>
						<?php } ?>
					</ul>
					<div class="clear"></div>
				</div>

				<p class="submit" style="text-align:center"><input type="submit" id="save-order" class="button-primary"
						value="<?php _e('Save Changes') ?>" />
					<?php echo cnss_back_to_link() ?>
				</p>

				<script type="text/javascript">
				jQuery(document).ready(function() {
					jQuery("#sortable").sortable({
						tolerance: 'intersect',
						cursor: 'pointer',
						items: 'li',
						placeholder: 'placeholder'
					});
					jQuery("#sortable").disableSelection();
					jQuery("#save-order").bind("click", function() {
						jQuery.post(ajaxurl, {
							action: 'update-social-icon-order',
							order: jQuery("#sortable").sortable("serialize")
						}, function(response) {
							jQuery("#ajax-response").html(
								'<div class="message updated fade"><p>Items Order Updated</p></div>'
							);
							jQuery("#ajax-response div").delay(1000).hide("slow");
						});
					});
				});
				</script>

			</div>

		</div>
	</div>
	<?php
}

function cnss_save_ajax_order()
{
	global $wpdb;
	$table_name = $wpdb->prefix . "cn_social_icon";
	parse_str(sanitize_text_field($_POST['order']), $data);
	if (!is_array($data)) {
		return;
	}
	foreach ($data as $key => $values) {
		if ($key != 'item') {
			continue;
		}
		foreach ($values as $position => $id) {
			$wpdb->update(
				$table_name,
				array('sortorder' => $position),
				array('id' => $id),
				array('%d'),
				array('%d')
			);
		}
	}
}

function cnss_get_icon_html($url = '', $title = '', $width = '', $height = '', $margin = '')
{
	if ($url == '') {
		return '<span>Input source invalid.</span>';
	}

	$title = esc_attr($title);
	$width = ($width == '') ? esc_attr(get_option('cnss-width')) : $width;
	$height = ($height == '') ? esc_attr(get_option('cnss-height')) : $height;
	$icon_output_html = '';

	if (cnss_is_image_icon($url)) {
		$url = esc_url($url);
		$imgStyle = '';
		$imgStyle .= ($margin == '') ? '' : 'margin:' . $margin . 'px;';
		$imgStyle .= ($width == $height) ? '' : 'height:' . $height . 'px;';
		$icon_output_html = '<img src="' . cnss_get_img_url($url) . '" border="0" width="' . $width . '" height="' . $height . '" alt="' . $title . '" title="' . $title . '" style="' . $imgStyle . '" />';
	} else {
		$url = esc_attr($url);
		$icon_output_html = '<i title="' . $title . '" style="font-size:' . $width . 'px;" class="' . $url . '"></i>';
	}
	return $icon_output_html;
}

function cnss_get_img_url($url)
{
	global $cnssBaseURL;
	if ($url == '') {
		return;
	}

	if (strpos($url, '/') === false) {
		return $cnssBaseURL . '/' . $url;
	} else {
		return $url;
	}
}

function cnss_is_image_icon($url)
{
	return !preg_match('/fa[srb]?\s+fa-[a-z0-9-]+/', $url);
}

function cnss_social_icon_add_fn()
{

	global $wpdb, $err, $msg, $cnssBaseURL;

	$social_sites = array(
		"https://500px.com/" => "500px",
		"https://angellist.com/" => "AngelList",
		"https://bandcamp.com/" => "Bandcamp",
		"https://behance.com/" => "Behance",
		"https://bitbucket.org/" => "BitBucket",
		"https://bloglovin.com/" => "Blog Lovin'",
		"https://codepen.com/" => "Codepen",
		"mail:" => "Email",
		"https://delicious.com/" => "Delicious",
		"https://deviantart.com/" => "DeviantArt",
		"https://digg.com/" => "Digg",
		"https://dribbble.com/" => "Dribbble",
		"https://dropbox.com/" => "Dropbox",
		"https://facebook.com/" => "Facebook",
		"https://flickr.com/" => "Flickr",
		"https://foursquare.com/" => "Foursquare",
		"https://github.com/" => "Github",
		"https://plus.google.com/" => "Google+",
		"https://houzz.com/" => "Houzz",
		"https://instagram.com/" => "Instagram",
		"https://itunes.com/" => "iTunes",
		"https://jsfiddle.com/" => "JSFiddle",
		"https://lastfm.com/" => "Last.fm",
		"https://linkedin.com/" => "LinkedIn",
		"https://mixcloud.com/" => "Mixcloud",
		"https://paper-plane.com/" => "Newsletter",
		"https://pinterest.com/" => "Pinterest",
		"https://reddit.com/" => "Reddit",
		"rss" => "RSS",
		"skype" => "Skype",
		"https://snapchat.com/" => "Snapchat",
		"https://soundcloud.com/" => "Soundcloud",
		"https://spotify.com/" => "Spotify",
		"https://stackoverflow.com/" => "Stack Overflow",
		"https://steam.com/" => "Steam",
		"https://stumbleupon.com/" => "Stumbleupon",
		"https://tripadvisor.com/" => "Trip Advisor",
		"https://tumblr.com/" => "Tumblr",
		"https://twitch.com/" => "Twitch",
		"https://twitter.com/" => "Twitter",
		"viber" => "Viber",
		"https://vimeo.com/" => "Vimeo",
		"https://vine.com/" => "Vine",
		"https://vkontakte.com/" => "VK",
		"https://wordpress.com/" => "WordPress",
		"https://xing.com/" => "Xing",
		"https://yelp.com/" => "Yelp",
		"https://youtube.com/" => "YouTube",
		"https://yahoo.com/" => "Yahoo"
	);

	$cnss_width = esc_attr(get_option('cnss-width'));
	$cnss_height = esc_attr(get_option('cnss-height'));
	$blank_img = "data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7";

	if (isset($_GET['mode'])) {
		if ($_GET['mode'] == 'edit' and $_GET['id'] != '') {

			if (!is_numeric($_GET['id']))
				wp_die('Sequrity Issue.');

			$page_title = 'Cập Nhật Icon';
			$uptxt = 'Icon';

			$table_name = $wpdb->prefix . "cn_social_icon";
			$image_file_path = $cnssBaseURL;
			$sql = $wpdb->prepare(
				"SELECT * FROM `{$table_name}` WHERE `id`=%d",
				$_GET['id']
			);
			$icon_info = $wpdb->get_row($sql);

			if (!empty($icon_info)) {
				$id = esc_attr($icon_info->id);
				$title = esc_attr($icon_info->title);
				$url = esc_url($icon_info->url);
				$image_url = esc_attr($icon_info->image_url);
				$sortorder = esc_attr($icon_info->sortorder);
				$target = esc_attr($icon_info->target);
			}
		}
	} else {
		$page_title = 'Add New Icon';
		$title = "";
		$url = "";
		$image_url = "";

		$sortorder = count(cnss_get_all_icons());
		$target = "";
		$uptxt = 'Icon';
	}
	?>
	<?php add_thickbox(); ?>
	<div id="cnss-font-awesome-icons-list" style="display:none;">
		<?php include_once 'fa-brand-icons.php'; ?>
	</div>
	<div class="wrap">

		<?php
		if ($msg != '')
			echo '<div id="message" class="updated fade">' . esc_html($msg) . '</div>';
		if ($err != '')
			echo '<div id="message" class="error fade">' . esc_html($err) . '</div>';
		?>
		<h2 style="margin-bottom: 12px;">
			<?php echo esc_attr($page_title); ?>
		</h2>
		<div class="content_wrapper">
			<div style="background-color: #fff; padding: 12px 24px;" class="left">

				<script type="text/javascript">
				jQuery(document).ready(function($) {

					$('.fontawesome-icon-list a').click(function(event) {
						event.preventDefault();
						id = $(this).find('i').attr('class');
						$('input#image_file').val(id);
						$('#fa-placeholder').removeClass().addClass(id);
						$('#logoimg').hide();
						$('#fa-placeholder').show();
						$("#TB_closeWindowButton").trigger('click');
					});
				});
				</script>
				<style type="text/css">
				img#logoimg {
					max-width: 32px;
				}
				</style>
				<form method="post" enctype="multipart/form-data" action="">
					<?php wp_nonce_field('cn_insert_icon'); ?>
					<table class="form-table">
						<tr valign="top">
							<th scope="row">Tiêu Đề<em>*</em></th>
							<td>
								<input style="line-height: unset;" list="title-autofill" type="text" name="title" id="title"
									class="regular-text" value="<?php echo $title ?>" /><br />
								<p>Nhập vài ký tự để gợi ý</p>
								<datalist style="display: none;" id="title-autofill">
									<?php foreach ($social_sites as $key => $value) { ?>
										<option value="<?php echo esc_attr($value); ?>">
										<?php } ?>
							</td>
						</tr>

						<tr valign="top">
							<th scope="row">
								<?php echo esc_attr($uptxt); ?><em>*</em>
							</th>
							<td>
								<i id="fa-placeholder" class="fa <?php echo esc_attr($image_url); ?>" aria-hidden="true"
									style="font-size: 2em;"></i>

								<img id="logoimg" style="vertical-align:top"
									src="<?php echo cnss_is_image_icon($image_url) ? esc_url($image_url) : $blank_img; ?>"
									border="0" width="<?php //echo $cnss_width; 
										?>" height="<?php //echo $cnss_height; 
											?>" alt="<?php echo $title; ?>" />

								<a title="Chọn Font Awesome Icon (Version 5.7.2)"
									href="#TB_inline?width=600&height=500&inlineId=cnss-font-awesome-icons-list"
									class="thickbox button">Chọn Từ FontAwesome Icon </a>
								<span style="vertical-align:middle;">Hoặc</span>
								<input style="vertical-align:top" id="logo_image_button" class="button" type="button"
									value="Upload Hình Ảnh Icon" />

								<input style="vertical-align:top" type="hidden" name="image_file" id="image_file"
									class="regular-text" value="<?php echo $image_url ?>" readonly="readonly" />

							</td>
						</tr>

						<tr valign="top">
							<th scope="row">Đường Dẫn<em>*</em></th>
							<td><input style="line-height: unset;" list="url-autofill" type="text" name="url" id="url"
									class="regular-text" value="<?php echo $url ?>" />
								<datalist style="display: none;" id="url-autofill">
									<?php foreach ($social_sites as $key => $value) { ?>
										<option value="<?php echo esc_attr($key); ?>">
										<?php } ?>
								</datalist><br />
								<p>Nhập vài kí tự để gợi ý &ndash; Đùng quên
									<strong><code>http(s)://</code></strong>
								</p>
							</td>
						</tr>

						<tr valign="top">
							<th scope="row">Vị trí hiển Thị</th>
							<td>
								<input type="number" name="sortorder" id="sortorder" class="small-text"
									value="<?php echo esc_attr($sortorder); ?>">
							</td>
						</tr>

						<tr valign="top">
							<th scope="row">Mở trong</th>
							<td>
								<input type="radio" name="target" id="new" checked="checked" value="1" />&nbsp;<label
									for="new">Mở trong tap mới</label>&nbsp;<br />
								<input type="radio" name="target" id="same" value="0" />&nbsp;<label for="same">Mở trong tap
									này</label>&nbsp;
							</td>
						</tr>
					</table>

					<?php if (isset($_GET['mode'])) { ?>
						<input type="hidden" name="action" value="edit">
						<input type="hidden" name="id" id="id" value="<?php echo esc_attr($id); ?>">
					<?php } else { ?>
						<input type="hidden" name="action" value="update">
					<?php } ?>

					<p class="submit" style="text-align:center"><input id="submit_button" name="submit_button" type="submit"
							class="button-primary" value="<?php _e('Save Changes') ?>">
						<?php echo cnss_back_to_link() ?>
					</p>
				</form>
			</div>

		</div>
	</div>
	<script type="text/javascript">
	jQuery(document).ready(function($) {
		$('form').submit(function(event) {
			if ($('#url').val() == '' ||
				$('#image_file').val() == '' ||
				$('#title').val() == '') {
				event.preventDefault();
				alert('Please input Title, Icon & Url field(s)');
			}
		});
	});
	</script>
	<?php
}

function cnss_back_to_link()
{
	return '&nbsp;&nbsp;<a href="admin.php?page=cnss_social_icon_page"><input type="button" class="button-secondary" value="Tất Cả Icon" /></a><small>&nbsp;&larr;Trở lại</small>';
}

function cnss_manage_icon_table_header()
{
	return '
	<th class="manage-column column-title" scope="col" width="20">ID</th>
	<th class="manage-column column-title" scope="col">Tiêu Đề</th>
	<th class="manage-column column-title" scope="col">Đường Dẫn</th>
	<th class="manage-column column-title" scope="col" width="100">Cách Mở</th>
	<th class="manage-column column-title" scope="col" width="100">Icons</th>
	<th class="manage-column column-title" scope="col" width="60"><a href="admin.php?page=cnss_social_icon_sort">Vị Trí <i class="fa fa-sort"></i></a></th>
	<th class="manage-column column-title" scope="col" width="80">Hành Động</th>
	<th class="manage-column column-title" scope="col" width="80">Hành Động</th>
	';
}

function cnss_esi_review_text()
{
	return '<div class="cnss-esi-review"><p><span>Please <a target="_blank" href="https://wordpress.org/support/plugin/easy-social-icons/reviews/">review</a> this plugin</span><span style="float: right;">Need support please <a target="_blank" href="http://www.cybernetikz.com/wordpress-magento-plugins/wordpress-plugins/easy-social-icons/#disqus_thread">contact us here</a></span></p></div>';
}

function cnss_social_icon_page_fn()
{

	global $wpdb, $cnssBaseURL;

	$cnss_width = esc_attr(get_option('cnss-width'));
	$cnss_height = esc_attr(get_option('cnss-height'));

	$image_file_path = $cnssBaseURL;
	$icons = cnss_get_all_icons();
	$nonce = wp_create_nonce('cnss_delete_icon');
	?>
	<div class="wrap">

		<h1 style="margin-bottom: 10px;" class="wp-heading-inline">Danh Sách Icons</h1> <a
			href="admin.php?page=cnss_social_icon_add" class="page-title-action">Thêm Mới</a>
		<script type="text/javascript">
		function show_confirm(title, id) {
			var rpath1 = "";
			var rpath2 = "";
			var r = confirm('Are you confirm to delete "' + title + '"');
			if (r == true) {
				rpath1 = '<?php echo admin_url('admin.php?page=cnss_social_icon_page'); ?>';
				rpath2 = '&cnss-delete=y&id=' + id + '&_wpnonce=<?php echo esc_attr($nonce); ?>';
				window.location = rpath1 + rpath2;
			}
		}
		</script>
		<div class="content_wrapper">
			<div class="left">
				<table class="widefat page fixed" cellspacing="0">
					<thead>
						<tr valign="top">
							<?php echo cnss_manage_icon_table_header(); ?>
						</tr>
					</thead>

					<tbody>
						<?php
						if ($icons) {
							foreach ($icons as $icon) {
								$icon->id = esc_attr($icon->id);
								$icon->title = esc_attr($icon->title);
								$icon->url = esc_url($icon->url);
								$icon->sortorder = esc_attr($icon->sortorder);
								?>
								<tr valign="top">
									<td>
										<?php echo esc_attr($icon->id); ?>
									</td>
									<td>
										<?php echo esc_attr($icon->title); ?>
									</td>
									<td>
										<a target="_blank" href="<?php echo esc_url($icon->url); ?>">
											<?php echo esc_url($icon->url); ?>
										</a>
									</td>
									<td>
										<?php echo $icon->target == 1 ? 'Tap Mới' : 'Tap Này' ?>
									</td>
									<td>
										<?php echo cnss_get_icon_html($icon->image_url, $icon->title); ?>
									</td>
									<td align="center">
										<?php echo $icon->sortorder; ?>
									</td>
									<td align="center">
										<a title="Edit <?php echo $icon->title; ?>"
											href="?page=cnss_social_icon_add&mode=edit&id=<?php echo $icon->id; ?>"><i
												class="fa fa-pencil-square-o fa-2x" aria-hidden="true"></i></a>
									</td>
									<td align="center">
										<a title="Delete <?php echo $icon->title; ?>"
											onclick="show_confirm('<?php echo addslashes($icon->title) ?>','<?php echo $icon->id; ?>');"
											href="#delete"><i class="fa fa-trash-o fa-2x" aria-hidden="true"></i></a>
									</td>
								</tr>
								<?php
							} //endforeach
						} else {
							echo '<tr valign="top"><td align="center" colspan="8">No icon found, please <a href="admin.php?page=cnss_social_icon_add">Add New</a> icon</td></tr>';
						}
						?>
					</tbody>
					<tfoot>
						<tr valign="top">
							<?php echo cnss_manage_icon_table_header(); ?>
						</tr>
					</tfoot>
				</table>

			</div>

		</div>
	</div>
	<?php
}

function cnss_social_icon_table()
{

	$cnss_width = esc_attr(get_option('cnss-width'));
	$cnss_height = esc_attr(get_option('cnss-height'));
	$cnss_margin = esc_attr(get_option('cnss-margin'));
	$cnss_rows = esc_attr(get_option('cnss-row-count'));
	$vorh = esc_attr(get_option('cnss-vertical-horizontal'));

	global $wpdb, $cnssBaseURL;
	$table_name = $wpdb->prefix . "cn_social_icon";
	$image_file_path = $cnssBaseURL;
	$sql = $wpdb->prepare("SELECT * FROM `{$table_name}` WHERE `image_url` != '' AND `url` != '' ORDER BY `sortorder`");
	$icons = $wpdb->get_results($sql);
	$icon_count = count($icons);

	$_collectionSize = count($icons);
	$_rowCount = $cnss_rows ? $cnss_rows : 1;
	$_columnCount = ceil($_collectionSize / $_rowCount);

	if ($vorh == 'vertical')
		$table_width = $cnss_width;
	else
		$table_width = $_columnCount * ($cnss_width + $cnss_margin);

	$td_width = $cnss_width + $cnss_margin;

	ob_start();
	echo '<table class="cnss-social-icon" style="width:' . $table_width . 'px" border="0" cellspacing="0" cellpadding="0">';
	$i = 0;
	foreach ($icons as $icon) {

		echo $vorh == 'vertical' ? '<tr>' : '';
		if ($i++ % $_columnCount == 0 && $vorh != 'vertical')
			echo '<tr>';
		?><td style="width:<?php echo $td_width ?>px"><a <?php echo ($icon->target == 1) ? 'target="_blank"' : '' ?>
				title="<?php echo $icon->title ?>" href="<?php echo $icon->url ?>">
				<?php echo cnss_get_icon_html($icon->image_url, $icon->title); ?>
			</a></td>
		<?php
		if (($i % $_columnCount == 0 || $i == $_collectionSize) && $vorh != 'vertical')
			echo '</tr>';
		echo $vorh == 'vertical' ? '</tr>' : '';
	}
	echo '</table>';
	$out = ob_get_contents();
	ob_end_clean();
	return $out;
}

function cnss_format_title($str)
{
	$pattern = '/[^a-zA-Z0-9]/';
	return strtolower(preg_replace($pattern, '-', $str));
}

function cnss_format_class($str)
{
	return str_replace(array('fa ', 'fab ', 'fas ', 'far ', 'fa-'), array('', '', '', '', 'cnss-'), $str);
}

function cn_social_icon($attr = array(), $call_from_widget = NULL)
{

	global $wpdb, $cnssBaseURL;
	$image_file_path = $cnssBaseURL;
	$attr_id = isset($attr['attr_id']) ? $attr['attr_id'] : '';
	$attr_class = isset($attr['attr_class']) ? $attr['attr_class'] : '';
	$where_sql = "";

	if (isset($attr['selected_icons'])) {
		if (is_string($attr['selected_icons'])) {
			$attr['selected_icons'] = preg_replace('/[^0-9,]/', '', $attr['selected_icons']);
			$attr['selected_icons'] = explode(',', $attr['selected_icons']);
		}

		if (is_array($attr['selected_icons']) && !empty($attr['selected_icons'])) {
			$placeholder = implode(', ', array_fill(0, count($attr['selected_icons']), '%d'));
			$where_sql .= $wpdb->prepare("AND `id` IN({$placeholder})", $attr['selected_icons']);
		}
	}

	$cnss_width = isset($attr['width']) ? $attr['width'] : esc_attr(get_option('cnss-width'));
	$cnss_height = isset($attr['height']) ? $attr['height'] : esc_attr(get_option('cnss-height'));
	$cnss_margin = isset($attr['margin']) ? $attr['margin'] : esc_attr(get_option('cnss-margin'));
	$cnss_rows = esc_attr(get_option('cnss-row-count'));
	$vorh = isset($attr['display']) ? $attr['display'] : esc_attr(get_option('cnss-vertical-horizontal'));
	$text_align = isset($attr['alignment']) ? $attr['alignment'] : esc_attr(get_option('cnss-text-align'));

	// settings for font-awesome icons
	$icon_bg_color = cnss_get_option('cnss-icon-bg-color');
	$icon_color = cnss_get_option('cnss-icon-color');
	$icon_hover_color = cnss_get_option('cnss-icon-hover-color');
	$icon_shape = cnss_get_option('cnss-icon-shape');
	$cnss_original_icon_color = cnss_get_option('cnss-original-icon-color');

	$table_name = $wpdb->prefix . "cn_social_icon";
	$sql = $wpdb->prepare("SELECT * FROM `{$table_name}` WHERE `image_url` != '' AND `url` != '' $where_sql ORDER BY `sortorder`");
	$icons = $wpdb->get_results($sql);
	$icon_count = count($icons);
	$li_margin = round($cnss_margin / 2);

	ob_start();
	echo '<ul id="' . esc_attr($attr_id) . '" class="cnss-social-icon ' . esc_attr($attr_class) . '" style="text-align:' . esc_attr($text_align) . ';">';
	$i = 0;
	foreach ($icons as $icon) {
		$aStyle = '';
		$liClass = 'cn-fa-' . cnss_format_title($icon->title);
		$aClass = '';
		$liStyle = ($vorh == 'horizontal') ? 'display:inline-block;' : '';
		$aTarget = ($icon->target == 1) ? 'target="_blank"' : '';
		if (!cnss_is_image_icon($icon->image_url)) {
			$liClass .= " cn-fa-icon ";
			$aPadding = round($cnss_width / 4);
			$aWidth = $cnss_width + $aPadding * 2;
			$aHeight = $aWidth;
			$aStyle .= "width:{$aWidth}px;";
			$aStyle .= "height:{$aHeight}px;";
			$aStyle .= "padding:{$aPadding}px 0;";
			$aStyle .= "margin:{$li_margin}px;";
			$aStyle .= "color: {$icon_color};";
			if ($cnss_original_icon_color == '1') {
				$aClass = cnss_format_class($icon->image_url);
			} else {
				//$aStyle .= "background-color:{$icon_bg_color};";
			}
			if ($icon_shape == 'circle') {
				$borderRadius = '50%';
			} elseif ($icon_shape == 'round-corner') {
				$borderRadius = '10%';
			} else {
				$borderRadius = '0%';
			}
			$aStyle .= "border-radius: {$borderRadius};";
		}
		?>
		<li class="<?php echo $liClass; ?>" style="<?php echo $liStyle; ?>"><a class="<?php echo $aClass; ?>"
				<?php echo $aTarget ?> href="<?php echo $icon->url ?>" title="<?php echo $icon->title ?>"
				style="<?php echo $aStyle ?>">
				<?php echo cnss_get_icon_html($icon->image_url, $icon->title, $cnss_width, $cnss_height, $li_margin); ?>
			</a></li>
		<?php
		$i++;
	}
	echo '</ul>';
	$out = ob_get_contents();
	ob_end_clean();
	return $out;
}

function cnss_social_icon_sc($selected_icons_array = array())
{
	global $wpdb, $cnssBaseURL;

	$cnss_width = esc_attr(get_option('cnss-width'));
	$cnss_height = esc_attr(get_option('cnss-height'));
	$image_file_path = $cnssBaseURL;

	$icons = cnss_get_all_icons();
	$icon_count = count($icons);

	ob_start();
	echo '<ul class="cnss-social-icon-admin" style="text-align:left;">' . "\r\n";
	$i = 0;
	foreach ($icons as $icon) {
		$icon->id = esc_attr($icon->id);
		?>
		<li style="display:inline-block; padding:2px 8px; border:1px dotted #ccc;">
			<div style="text-align: center; width: <?php echo $cnss_width ?>px;">
				<label for="icon<?php echo $icon->id; ?>">
					<?php echo cnss_get_icon_html($icon->image_url, $icon->title); ?>
				</label>
			</div>
			<div style="text-align: center;"><input <?php if (in_array($icon->id, $selected_icons_array))
				echo 'checked="checked"'; ?> style="margin:0;" type="checkbox" name="_selected_icons[]"
					id="icon<?php echo $icon->id; ?>" value="<?php echo $icon->id; ?>" /></div>
		</li>
		<?php
		$i++;
	}
	echo '</ul>' . "\r\n";
	$out = ob_get_contents();
	ob_end_clean();
	return $out;
}

class Cnss_Widget extends WP_Widget
{

	public function __construct()
	{
		parent::__construct(
			'cnss_widget',
			// Base ID
			'Easy Social Icons',
			// Name
			array('description' => __('Add social media icons to your Sidebar.')) // Args
		);
	}

	public function widget($args, $instance)
	{
		extract($args);
		$title = apply_filters('widget_title', $instance['title']);

		echo $before_widget;
		if (!empty($title))
			echo $before_title . $title . $after_title;
		echo cn_social_icon($instance, 1);
		echo $after_widget;
	}

	public function update($new_instance, $old_instance)
	{

		$instance = array();
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['attr_id'] = strip_tags($new_instance['attr_id']);
		$instance['attr_class'] = strip_tags($new_instance['attr_class']);
		$instance['width'] = strip_tags($new_instance['width']);
		$instance['height'] = strip_tags($new_instance['height']);
		$instance['margin'] = strip_tags($new_instance['margin']);
		$instance['display'] = strip_tags($new_instance['display']);
		$instance['alignment'] = strip_tags($new_instance['alignment']);
		// $instance['selected_icons'] = $new_instance['selected_icons'];
		return $instance;
	}

	public function form($instance)
	{

		$cnss_width = esc_attr(get_option('cnss-width'));
		$cnss_height = esc_attr(get_option('cnss-height'));
		$cnss_margin = esc_attr(get_option('cnss-margin'));
		$cnss_rows = esc_attr(get_option('cnss-row-count'));
		$vorh = esc_attr(get_option('cnss-vertical-horizontal'));
		$text_align = esc_attr(get_option('cnss-text-align'));

		if (isset($instance['title'])) {
			$title = $instance['title'];
		} else {
			$title = __('Follow Us');
		}
		$instance['alignment'] = isset($instance['alignment']) ? $instance['alignment'] : $text_align;
		$instance['display'] = isset($instance['display']) ? $instance['display'] : $vorh;
		?>
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>">
				<?php _e('Title:'); ?>
			</label>
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>"
				name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
		</p>
		<p><em>Following settings will override the default <a href="admin.php?page=cnss_social_icon_option">Icon
					Settings</a></em></p>
		<table width="100%" border="0">
			<tr>
				<td><label for="<?php echo $this->get_field_id('width'); ?>">
						<?php _e('Icon Width <em>(px)</em>:'); ?>
					</label>
					<input class="widefat" id="<?php echo $this->get_field_id('width'); ?>"
						name="<?php echo $this->get_field_name('width'); ?>" type="number"
						value="<?php echo esc_attr(isset($instance['width']) ? $instance['width'] : $cnss_width); ?>" />
				</td>
				<td>&nbsp;</td>
				<td><label for="<?php echo $this->get_field_id('height'); ?>">
						<?php _e('Icon Height <em>(px)</em>:'); ?>
					</label>
					<input class="widefat" id="<?php echo $this->get_field_id('height'); ?>"
						name="<?php echo $this->get_field_name('height'); ?>" type="number"
						value="<?php echo esc_attr(isset($instance['height']) ? $instance['height'] : $cnss_height); ?>" />
				</td>
			</tr>
		</table>

		<table width="100%" border="0">
			<tr>
				<td><label for="<?php echo esc_attr($this->get_field_id('alignment')); ?>">
						<?php _e('Alignment:'); ?>
					</label><br />
					<select id="<?php echo esc_attr($this->get_field_id('alignment')); ?>"
						name="<?php echo esc_attr($this->get_field_name('alignment')); ?>">
						<option <?php selected($instance['alignment'], 'center'); ?> value="center">Center</option>
						<option <?php selected($instance['alignment'], 'left'); ?> value="left">Left</option>
						<option <?php selected($instance['alignment'], 'right'); ?> value="right">Right</option>
					</select>
				</td>
				<td>&nbsp;</td>
				<td><label for="<?php echo $this->get_field_id('display'); ?>">
						<?php _e('Display:'); ?>
					</label><br />
					<select id="<?php echo $this->get_field_id('display'); ?>"
						name="<?php echo $this->get_field_name('display'); ?>">
						<option <?php selected($instance['display'], 'horizontal'); ?> value="horizontal">Horizontally</option>
						<option <?php selected($instance['display'], 'vertical'); ?> value="vertical">Vertically</option>
					</select>
				</td>
				<td>&nbsp;</td>
				<td><label for="<?php echo $this->get_field_id('margin'); ?>">
						<?php _e('Margin <em>(px)</em>:'); ?>
					</label><br />
					<input maxlength="3" class="widefat" id="<?php echo $this->get_field_id('margin'); ?>"
						name="<?php echo $this->get_field_name('margin'); ?>" type="number"
						value="<?php echo esc_attr(isset($instance['margin']) ? $instance['margin'] : $cnss_margin); ?>" />
				</td>
			</tr>
		</table>

		<p>
			<label>
				<?php _e('Chọn Icons Hiển Thị:'); ?>
			</label> <em>(Niếu không chọn, tất cả icon sẽ được hiển thị)</em><br />
			<?php echo $this->cnss_social_icon_widget(isset($instance['selected_icons']) ? $instance['selected_icons'] : array()); ?>
		</p>

		<table style="margin-bottom:15px;" width="100%" border="0">
			<tr>
				<td><label for="<?php echo $this->get_field_id('attr_id'); ?>">
						<?php _e('Add Custom ID:'); ?>
					</label>
					<input class="widefat" placeholder="ID" id="<?php echo $this->get_field_id('attr_id'); ?>"
						name="<?php echo $this->get_field_name('attr_id'); ?>" type="text"
						value="<?php echo esc_attr(isset($instance['attr_id']) ? $instance['attr_id'] : ''); ?>" />
				</td>
				<td>&nbsp;</td>
				<td><label for="<?php echo $this->get_field_id('attr_class'); ?>">
						<?php _e('Add Custom Class:'); ?>
					</label>
					<input class="widefat" placeholder="Class" id="<?php echo $this->get_field_id('attr_class'); ?>"
						name="<?php echo $this->get_field_name('attr_class'); ?>" type="text"
						value="<?php echo esc_attr(isset($instance['attr_class']) ? $instance['attr_class'] : ''); ?>" />
				</td>
			</tr>
		</table>
		<?php
	}

	public function cnss_social_icon_widget($selected_icons_array = array())
	{

		global $wpdb, $cnssBaseURL;

		$cnss_width = esc_attr(get_option('cnss-width'));
		$cnss_height = esc_attr(get_option('cnss-height'));
		$image_file_path = $cnssBaseURL;

		$icons = cnss_get_all_icons();
		$icon_count = count($icons);

		ob_start();
		if ($icons) {
			echo '<ul class="cnss-social-icon-admin-widget" style="text-align:left;">' . "\r\n";
			$i = 0;
			foreach ($icons as $icon) {
				$icon->id = esc_attr($icon->id);
				?>
				<li style="display:inline-block; padding:2px 8px; border:1px dashed #ccc;">
					<div style="text-align: center; width: <?php echo $cnss_width ?>px;">
						<label for="<?php echo $this->get_field_id('selected_icons' . esc_attr($icon->id)); ?>">
							<?php echo cnss_get_icon_html($icon->image_url, $icon->title); ?>
						</label>
					</div>
					<div style="text-align: center;"><input <?php if (in_array($icon->id, $selected_icons_array))
						echo 'checked="checked"'; ?> style="margin:0;" type="checkbox"
							name="<?php echo $this->get_field_name('selected_icons'); ?>[]"
							id="<?php echo $this->get_field_id('selected_icons' . $icon->id); ?>" value="<?php echo $icon->id; ?>" />
					</div>
				</li>
				<?php
				$i++;
			}
			echo '</ul>' . "\r\n";
		} else {
			echo 'No icon found, please <a href="admin.php?page=cnss_social_icon_add" class="page-title-action">Add New</a> icon.';
		}
		$out = ob_get_contents();
		ob_end_clean();
		return $out;
	}
} // class Cnss_Widget

if (version_compare(PHP_VERSION, '5.6.0') >= 0) {
	add_action('widgets_init', function () {
		register_widget("Cnss_Widget");
	});
} else {
	add_action('widgets_init', create_function('', 'register_widget( "Cnss_Widget" );'));
}
// ================================================


define('AME_EDIT_SHORTCODE', '1.0.0');

define('AME_EDIT_SHORTCODE_URL', plugin_dir_url(__FILE__));

define('AME_EDIT_SHORTCODE_DIR', plugin_dir_path(__FILE__));

register_activation_hook(__FILE__, 'ame_shortcoder');

function upload_file()
{
	mkdir("img/upload", 0700);
}

add_action('init', 'do_output_buffer');
function do_output_buffer()
{
	ob_start();
}
function insert_attachment($file_handler, $post_id, $setthumb = 'false')
{
	// check to make sure its a successful upload
	if ($_FILES[$file_handler]['error'] !== UPLOAD_ERR_OK)
		__return_false();
	require_once(ABSPATH . "wp-admin" . '/includes/image.php');
	require_once(ABSPATH . "wp-admin" . '/includes/file.php');
	require_once(ABSPATH . "wp-admin" . '/includes/media.php');
	$attach_id = media_handle_upload($file_handler, $post_id);

	if ($setthumb)
		update_post_meta($post_id, '_thumbnail_id', $attach_id);
	return $attach_id;
}

function ame_shortcoder()
{
	global $wpdb; // Gọi hàm làm việc với database
	$table_shortcode = $wpdb->prefix . "ame_shortcoder";
	// $table_page_list = $wpdb -> prefix . "ame_chat_page_list";
	if ($wpdb->get_var("SHOW TABLE LIKE`" . $table_shortcode . "`") != $table_shortcode) {
		$sql = " CREATE TABLE `" . $table_shortcode . "`(
        `ID` INT NOT NULL AUTO_INCREMENT,
        `SC_name` VARCHAR(20) NULL , 
        `SC_Content` VARCHAR(5000) NULL ,
        `SC_type` VARCHAR(30) NULL ,
        `url_img` TEXT NULL ,
        `url_video` TEXT NULL , 
        `tag` VARCHAR(30) NULL , 
        `type` VARCHAR (100) NULL,
        PRIMARY KEY (`ID`)) ENGINE = InnoDB
        ;
    ";
		require_once ABSPATH . "wp-admin/includes/upgrade.php";
		dbDelta($sql);
	}
}

if (is_admin()) {

	// $includeDir = AME_CHAT_DIR . '/includes';

	require_once AME_EDIT_SHORTCODE_DIR . 'includes/admin.php';

	$AME_EDIT_SHORTCODE = new AME_EDIT_SHORTCODE();
	add_action('admin_menu', array($AME_EDIT_SHORTCODE, 'AddAdminMenu'));
	add_action('admin_head', array($AME_EDIT_SHORTCODE, 'CustomHeaderAdmin'));
	add_action('admin_footer', array($AME_EDIT_SHORTCODE, 'CustomFooterAdmin'));
	//==========================Add  ajax edit shortcode ========================

	add_action('wp_ajax_show_edit_shortcode', array($AME_EDIT_SHORTCODE, 'show_edit_shortcode'));
	add_action('wp_ajax_nopriv_show_edit_shortcode', array($AME_EDIT_SHORTCODE, 'show_edit_shortcode'));
	// update sc
	add_action('wp_ajax_update_shortcode', array($AME_EDIT_SHORTCODE, 'update_shortcode'));
	add_action('wp_ajax_nopriv_update_shortcode', array($AME_EDIT_SHORTCODE, 'update_shortcode'));
	// show video
	add_action('wp_ajax_show_shortcode_video', array($AME_EDIT_SHORTCODE, 'show_shortcode_video'));
	add_action('wp_ajax_nopriv_show_shortcode_video', array($AME_EDIT_SHORTCODE, 'show_shortcode_video'));
	// show add video
	add_action('wp_ajax_show_add_shortcode', array($AME_EDIT_SHORTCODE, 'show_add_shortcode'));
	add_action('wp_ajax_nopriv_show_add_shortcode', array($AME_EDIT_SHORTCODE, 'show_add_shortcode'));
	// add
	add_action('wp_ajax_add_shortcode', array($AME_EDIT_SHORTCODE, 'add_shortcode'));
	add_action('wp_ajax_nopriv_add_shortcode', array($AME_EDIT_SHORTCODE, 'add_shortcode'));
	// update sc video
	add_action('wp_ajax_update_shortcode2', array($AME_EDIT_SHORTCODE, 'update_shortcode2'));
	add_action('wp_ajax_nopriv_update_shortcode2', array($AME_EDIT_SHORTCODE, 'update_shortcode2'));
	// show edit video
	add_action('wp_ajax_show_edit_shortcode_video', array($AME_EDIT_SHORTCODE, 'show_edit_shortcode_video'));
	add_action('wp_ajax_nopriv_show_edit_shortcode_video', array($AME_EDIT_SHORTCODE, 'show_edit_shortcode_video'));
	// show sc img
	add_action('wp_ajax_show_shortcode_img', array($AME_EDIT_SHORTCODE, 'show_shortcode_img'));
	add_action('wp_ajax_nopriv_show_shortcode_img', array($AME_EDIT_SHORTCODE, 'show_shortcode_img'));
	// show edit img
	add_action('wp_ajax_show_edit_shortcode_img', array($AME_EDIT_SHORTCODE, 'show_edit_shortcode_img'));
	add_action('wp_ajax_nopriv_show_edit_shortcode_img', array($AME_EDIT_SHORTCODE, 'show_edit_shortcode_img'));
	//add img
	add_action('wp_ajax_add_img', array($AME_EDIT_SHORTCODE, 'add_img'));
	add_action('wp_ajax_nopriv_add_img', array($AME_EDIT_SHORTCODE, 'add_img'));
	//show page
	add_action('wp_ajax_show_pageFilter', array($AME_EDIT_SHORTCODE, 'show_pageFilter'));
	add_action('wp_ajax_nopriv_show_pageFilter', array($AME_EDIT_SHORTCODE, 'show_pageFilter'));
	//show page db post
	add_action('wp_ajax_show_pageFilter_post', array($AME_EDIT_SHORTCODE, 'show_pageFilter_post'));
	add_action('wp_ajax_nopriv_show_pageFilter_post', array($AME_EDIT_SHORTCODE, 'show_pageFilter_post'));
	//show page db post2
	add_action('wp_ajax_show_pageFilter_post2', array($AME_EDIT_SHORTCODE, 'show_pageFilter_post2'));
	add_action('wp_ajax_nopriv_show_pageFilter_post2', array($AME_EDIT_SHORTCODE, 'show_pageFilter_post2'));
	//show page db post3
	add_action('wp_ajax_show_pageFilter_post3', array($AME_EDIT_SHORTCODE, 'show_pageFilter_post3'));
	add_action('wp_ajax_nopriv_show_pageFilter_post3', array($AME_EDIT_SHORTCODE, 'show_pageFilter_post3'));
	//show slide
	add_action('wp_ajax_show_shortcode_slide', array($AME_EDIT_SHORTCODE, 'show_shortcode_slide'));
	add_action('wp_ajax_nopriv_show_shortcode_slide', array($AME_EDIT_SHORTCODE, 'show_shortcode_slide'));
	//del
	add_action('wp_ajax_del_sc_video', array($AME_EDIT_SHORTCODE, 'del_sc_video'));
	add_action('wp_ajax_nopriv_del_sc_video', array($AME_EDIT_SHORTCODE, 'del_sc_video'));
	//paging
	add_action('wp_ajax_show_Pagination', array($AME_EDIT_SHORTCODE, 'show_Pagination'));
	add_action('wp_ajax_nopriv_show_Pagination', array($AME_EDIT_SHORTCODE, 'show_Pagination'));
	//
	add_action('wp_ajax_show_edit_tag', array($AME_EDIT_SHORTCODE, 'show_edit_tag'));
	add_action('wp_ajax_nopriv_show_edit_tag', array($AME_EDIT_SHORTCODE, 'show_edit_tag'));
	//
	add_action('wp_ajax_update_shortcode_tag', array($AME_EDIT_SHORTCODE, 'update_shortcode_tag'));
	add_action('wp_ajax_nopriv_update_shortcode_tag', array($AME_EDIT_SHORTCODE, 'update_shortcode_tag'));
} else {
}

// ============================================================================================================
define('SC_VERSION', '6.1');
define('SC_PATH', plugin_dir_path(__FILE__)); // All have trailing slash
define('SC_URL', plugin_dir_url(__FILE__));
define('SC_ADMIN_URL', trailingslashit(plugin_dir_url(__FILE__) . 'admin'));
define('SC_BASE_NAME', plugin_basename(__FILE__));
define('SC_POST_TYPE', 'shortcoder');

// error_reporting(E_ALL);

final class Shortcoder
{

	static public $shortcodes = array();

	static public $current_shortcode = false;

	public static function init()
	{

		// Include the required
		self::includes();

		add_shortcode('sc', array(__CLASS__, 'execute_shortcode'));

	}

	public static function includes()
	{

		include_once(SC_PATH . 'includes/updates.php');
		include_once(SC_PATH . 'includes/metadata.php');
		include_once(SC_PATH . 'admin/admin.php');
		include_once(SC_PATH . 'admin/form.php');
		include_once(SC_PATH . 'admin/edit.php');
		include_once(SC_PATH . 'admin/settings.php');
		include_once(SC_PATH . 'admin/manage.php');
		include_once(SC_PATH . 'admin/tools.php');

	}

	public static function execute_shortcode($atts, $enclosed_content = null)
	{

		$atts = (array) $atts;
		$shortcodes = self::get_shortcodes();

		if (empty($shortcodes)) {
			return '<!-- No shortcodes are defined -->';
		}

		$shortcode = self::find_shortcode($atts, $shortcodes);

		$shortcode = apply_filters('sc_mod_shortcode', $shortcode, $atts, $enclosed_content);
		do_action('sc_do_before', $shortcode, $atts);

		if (!is_array($shortcode)) {
			return $shortcode;
		}

		// Prevent same shortcode nested loop
		if (self::$current_shortcode == $shortcode['name']) {
			return '';
		}
		self::$current_shortcode = $shortcode['name'];

		$sc_content = $shortcode['content'];
		$sc_settings = $shortcode['settings'];

		if (!self::can_display($shortcode)) {
			$sc_content = '<!-- Shortcode does not match the conditions -->';
		} else {
			$sc_content = self::replace_sc_params($sc_content, $atts);
			$sc_content = self::replace_wp_params($sc_content, $enclosed_content);
			$sc_content = self::replace_custom_fields($sc_content);
			$sc_content = do_shortcode($sc_content);
		}

		$sc_content = apply_filters('sc_mod_output', $sc_content, $atts, $sc_settings, $enclosed_content);
		do_action('sc_do_after', $shortcode, $atts);

		self::$current_shortcode = false;

		return $sc_content;

	}

	public static function get_shortcodes()
	{

		if (!empty(self::$shortcodes)) {
			return self::$shortcodes;
		}

		$shortcodes = array();
		$shortcode_posts = get_posts(
			array(
				'post_type' => SC_POST_TYPE,
				'posts_per_page' => -1,
				'post_status' => 'publish'
			)
		);

		foreach ($shortcode_posts as $index => $post) {
			$shortcodes[$post->post_name] = array(
				'id' => $post->ID,
				'name' => $post->post_name,
				'content' => $post->post_content,
				'settings' => self::get_sc_settings($post->ID)
			);
		}

		self::$shortcodes = $shortcodes;

		return $shortcodes;

	}

	public static function default_sc_settings()
	{

		return apply_filters(
			'sc_mod_sc_settings',
			array(
				'_sc_description' => '',
				'_sc_disable_sc' => 'no',
				'_sc_disable_admin' => 'no',
				'_sc_editor' => '',
				'_sc_allowed_devices' => 'all'
			)
		);

	}

	public static function default_settings()
	{

		return apply_filters(
			'sc_mod_settings',
			array(
				'default_editor' => 'code',
				'default_content' => ''
			)
		);

	}

	public static function get_settings()
	{

		$settings = get_option('sc_settings', array());
		$default_settings = self::default_settings();

		return self::set_defaults($settings, $default_settings);

	}

	public static function get_sc_settings($post_id)
	{

		$meta_vals = get_post_meta($post_id, '', true);
		$default_vals = self::default_sc_settings();
		$settings = array();

		if (!is_array($meta_vals)) {
			return $default_vals;
		}

		foreach ($default_vals as $key => $val) {
			$settings[$key] = array_key_exists($key, $meta_vals) ? $meta_vals[$key][0] : $val;
		}

		$settings['_sc_title'] = get_the_title($post_id);

		return $settings;

	}

	public static function get_sc_tag($post_id)
	{
		$post = get_post($post_id);
		return '[sc name="' . $post->post_name . '"][/sc]';
	}

	public static function find_shortcode($atts, $shortcodes)
	{

		$sc_name = false;

		// Find by shortcode ID
		if (array_key_exists('sc_id', $atts)) {
			$sc_id = $atts['sc_id'];
			foreach ($shortcodes as $temp_name => $temp_props) {
				if ($temp_props['id'] == $sc_id) {
					$sc_name = $temp_name;
					break;
				}
			}
		}

		// If shortcode ID is not passed, then get the shortcode name
		if (!$sc_name) {
			if (!array_key_exists('name', $atts)) {
				return '<!-- Shortcode is missing "name" attribute -->';
			}
			$sc_name = $atts['name'];
		}

		// Check if the shortcode name exists
		if (!array_key_exists($sc_name, $shortcodes)) {
			$sc_name = sanitize_title_with_dashes($sc_name);
			if (!array_key_exists($sc_name, $shortcodes)) {
				return '<!-- Shortcode does not exist -->';
			}
		}

		return $shortcodes[$sc_name];

	}

	public static function can_display($sc_props)
	{

		$settings = $sc_props['settings'];

		if ($settings['_sc_disable_sc'] == 'yes') {
			return false;
		}

		$devices = $settings['_sc_allowed_devices'];

		if ($devices == 'mobile_only' && !wp_is_mobile()) {
			return false;
		}

		if ($devices == 'desktop_only' && wp_is_mobile()) {
			return false;
		}

		if (current_user_can('manage_options') && $settings['_sc_disable_admin'] == 'yes') {
			return false;
		}

		return true;

	}

	public static function replace_sc_params($content, $params)
	{

		$params = array_change_key_case($params, CASE_LOWER);

		preg_match_all('/%%([a-zA-Z0-9_\-]+)\:?(.*?)%%/', $content, $matches);

		$cp_tags = $matches[0];
		$cp_names = $matches[1];
		$cp_defaults = $matches[2];
		$to_replace = array();

		for ($i = 0; $i < count($cp_names); $i++) {

			$name = strtolower($cp_names[$i]);
			$default = $cp_defaults[$i];
			$value = '';

			if (array_key_exists($name, $params)) {
				$value = $params[$name];

				// Handle scenario when the attributes are added with paragraph tags by autop
				if (substr($value, 0, 4) == '</p>') {
					$value = substr($value, 4);
					if (substr($value, -3) == '<p>') {
						$value = substr($value, 0, -3);
					}
				}

			}

			if ($value == '') {
				array_push($to_replace, $default);
			} else {
				array_push($to_replace, $value);
			}

		}

		$content = str_ireplace($cp_tags, $to_replace, $content);

		return $content;

	}

	public static function replace_wp_params($content, $enc_content = null)
	{

		$params = self::wp_params_list();
		$metadata = Shortcoder_Metadata::metadata();
		$metadata['enclosed_content'] = $enc_content;
		$all_params = array();
		$to_replace = array();

		foreach ($params as $group => $group_info) {
			$all_params = array_merge($group_info['params'], $all_params);
		}

		foreach ($all_params as $id => $name) {
			if (array_key_exists($id, $metadata)) {
				$placeholder = '$$' . $id . '$$';
				$to_replace[$placeholder] = $metadata[$id];
			}
		}

		$content = strtr($content, $to_replace);

		return $content;

	}

	public static function replace_custom_fields($content)
	{

		global $post;

		preg_match_all('/\$\$[^\s^$]+\$\$/', $content, $matches);

		$cf_tags = $matches[0];

		if (empty($cf_tags)) {
			return $content;
		}

		foreach ($cf_tags as $tag) {

			if (strpos($tag, 'custom_field:') === false) {
				continue;
			}

			preg_match('/:[^\s\$]+/', $tag, $match);

			if (empty($match)) {
				continue;
			}

			$match = substr($match[0], 1);
			$value = is_object($post) ? get_post_meta($post->ID, $match, true) : '';
			$content = str_replace($tag, $value, $content);

		}

		return $content;

	}

	public static function wp_params_list()
	{

		return apply_filters(
			'sc_mod_wp_params',
			array(
				'wp_info' => array(
					'name' => __('WordPress information', 'shortcoder'),
					'icon' => 'wordpress-alt',
					'params' => array(
						'url' => __('URL of the post/location', 'shortcoder'),
						'title' => __('Title of the post/location', 'shortcoder'),
						'short_url' => __('Short URL of the post/location', 'shortcoder'),

						'post_id' => __('Post ID', 'shortcoder'),
						'post_image' => __('Post featured image URL', 'shortcoder'),
						'post_excerpt' => __('Post excerpt', 'shortcoder'),
						'post_author' => __('Post author', 'shortcoder'),
						'post_date' => __('Post date', 'shortcoder'),
						'post_modified_date' => __('Post modified date', 'shortcoder'),
						'post_comments_count' => __('Post comments count', 'shortcoder'),
						'post_slug' => __('Post slug', 'shortcoder'),

						'site_name' => __('Site title', 'shortcoder'),
						'site_description' => __('Site description', 'shortcoder'),
						'site_url' => __('Site URL', 'shortcoder'),
						'site_wpurl' => __('WordPress URL', 'shortcoder'),
						'site_charset' => __('Site character set', 'shortcoder'),
						'wp_version' => __('WordPress version', 'shortcoder'),
						'stylesheet_url' => __('Active theme\'s stylesheet URL', 'shortcoder'),
						'stylesheet_directory' => __('Active theme\'s directory', 'shortcoder'),
						'atom_url' => __('Atom feed URL', 'shortcoder'),
						'rss_url' => __('RSS 2.0 feed URL', 'shortcoder')
					)
				),
				'date_info' => array(
					'name' => __('Date parameters', 'shortcoder'),
					'icon' => 'calendar-alt',
					'params' => array(
						'day' => __('Day', 'shortcoder'),
						'day_lz' => __('Day - leading zeros', 'shortcoder'),
						'day_ws' => __('Day - words - short form', 'shortcoder'),
						'day_wf' => __('Day - words - full form', 'shortcoder'),
						'month' => __('Month', 'shortcoder'),
						'month_lz' => __('Month - leading zeros', 'shortcoder'),
						'month_ws' => __('Month - words - short form', 'shortcoder'),
						'month_wf' => __('Month - words - full form', 'shortcoder'),
						'year' => __('Year', 'shortcoder'),
						'year_2d' => __('Year - 2 digit', 'shortcoder'),
					)
				),
				'sc_cnt' => array(
					'name' => __('Shortcode enclosed content', 'shortcoder'),
					'icon' => 'text',
					'params' => array(
						'enclosed_content' => __('Shortcode enclosed content', 'shortcoder')
					)
				)
			)
		);

	}

	public static function set_defaults($a, $b)
	{

		$a = (array) $a;
		$b = (array) $b;
		$result = $b;

		foreach ($a as $k => &$v) {
			if (is_array($v) && isset($result[$k])) {
				$result[$k] = self::set_defaults($v, $result[$k]);
			} else {
				$result[$k] = $v;
			}
		}
		return $result;
	}

}

Shortcoder::init();

// 
if (!function_exists('get_option')) {
	header('HTTP/1.0 403 Forbidden');
	die; // Silence is golden, direct call is prohibited
}

if (defined('URE_VERSION')) {
	if (is_admin() && (!defined('DOING_AJAX') || !DOING_AJAX)) {
		if (!class_exists('URE_Admin_Notice')) {
			require_once(plugin_dir_path(__FILE__) . 'includes/classes/admin-notice.php');
		}
		new URE_Admin_Notice();
	}
	return;
}

define('URE_VERSION', '4.63.2');
define('URE_PLUGIN_URL', plugin_dir_url(__FILE__));
define('URE_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('URE_PLUGIN_BASE_NAME', plugin_basename(__FILE__));
define('URE_PLUGIN_FILE', basename(__FILE__));
define('URE_PLUGIN_FULL_PATH', __FILE__);

require_once(URE_PLUGIN_DIR . 'includes/classes/admin-notice.php');
require_once(URE_PLUGIN_DIR . 'includes/classes/base-lib.php');
require_once(URE_PLUGIN_DIR . 'includes/classes/lib.php');

// check PHP version
$ure_required_php_version = '7.3';
$exit_msg = '' . $ure_required_php_version . ' or newer. ' .
	'<a href="https://www.php.net/supported-versions.php">Please update!</a>';
if (!URE_Lib::check_version(PHP_VERSION, $ure_required_php_version, $exit_msg, __FILE__)) {
	return;
}

// check WP version
$ure_required_wp_version = '4.4';
$exit_msg = ' ' . $ure_required_wp_version . ' or newer. ' .
	'<a href="http://codex.wordpress.org/Upgrading_WordPress">Please update!</a>';
if (!URE_Lib::check_version(get_bloginfo('version'), $ure_required_wp_version, $exit_msg, __FILE__)) {
	return;
}

require_once(URE_PLUGIN_DIR . 'includes/loader.php');

// Uninstall action
register_uninstall_hook(URE_PLUGIN_FULL_PATH, array('User_Role_Editor', 'uninstall'));

$GLOBALS['user_role_editor'] = User_Role_Editor::get_instance();