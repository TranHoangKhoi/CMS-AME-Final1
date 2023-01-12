<?php
/*Thay đổi logo trang đăng nhập*/

use Elementor\Core\Schemes\Color;

function login_page_logo()
{
  echo '<style>.login h1 a {
    background-repeat: no-repeat;
    background-image: url(https://amedigital.vn/wp-content/uploads/2022/02/Logo-AME-Digital.webp);
    background-position: center center;
    background-size: contain !important;
    width: 100% !important;
    }
    </style>';
}
add_action('login_head', 'login_page_logo');

/*Thay đổi link url logo trang đăng nhập*/
function login_page_URL($url)
{
  $url = home_url('/');
  return $url;
}
add_filter('login_headerurl', 'login_page_URL');

/*Xóa admin wordpress*/
add_action('admin_bar_menu', 'remove_wp_logo', 999);
function remove_wp_logo($wp_admin_bar)
{
  $wp_admin_bar->remove_node('wp-logo');
}

/*Footer admin wordpress*/
function remove_footer_admin()
{
  echo 'Cảm ơn bạn đã sử dụng dịch vụ tại <a href="https://amedigital.vn/" target="_blank">AME Digital</a>.';
}
add_filter('admin_footer_text', 'remove_footer_admin');

/*Dịch title search elementor*/
add_filter('elementor/utils/get_the_archive_title', 'archive_callback');
function archive_callback($title)
{
  if (is_search()) {
    return 'Kết quả tìm kiếm: ' . get_search_query();
  }
  return $title;
}
/* Tắt chức năng updtae */

function disable_any_plugin_updates($value)
{
  $Disableplugins = ['elementor/elementor.php', 'elementor-pro/elementor-pro.php', 'shortcoder/shortcoder.php', 'custom-post-type-ui/custom-post-type-ui.php', 'quantriame/shortcoder.php', 'advanced-custom-fields/acf.php'];
  if (isset($value) && is_object($value)) {
    foreach ($Disableplugins as $plugin) {
      if (isset($value->response[$plugin])) {
        unset($value->response[$plugin]);
      }
    }
  }
  return $value;
}
add_filter('site_transient_update_plugins', 'disable_any_plugin_updates');
// Custom 

function hcf_register_meta_boxes()
{
  add_meta_box('hcf-1', __('Kích thước và dung lượng ảnh', 'hcf'), 'hcf_display_callback', 'post');
}
add_action('add_meta_boxes', 'hcf_register_meta_boxes');

/**
 * Meta box display callback.
 *
 * @param WP_Post $post Current post object.
 */
function hcf_display_callback($post)
{
  echo "
  <h2>Bài viết: </h2>
  <p>- Ảnh trong bài: 900 x 564(px)</p> 
  <p>- Ảnh đại diện (thumbnail: 1200 x 630 (px)</p>
  <p>- Kích thước Video chèn: 900 x 564 (px) </p>
  <p>- Dung lượng ảnh tối đa 250kB (khuyến khích) </p> ";
}

/*
|--------------------------------------------------------------------------
| CONSTANTS
|--------------------------------------------------------------------------
*/

// plugin folder url
if (!defined('RC_SCD_PLUGIN_URL')) {
  define('RC_SCD_PLUGIN_URL', plugin_dir_url(__FILE__));
}

/*
|--------------------------------------------------------------------------
| MAIN CLASS
|--------------------------------------------------------------------------
*/

class rc_sweet_custom_dashboard
{

  /*--------------------------------------------*
 * Constructor
 *--------------------------------------------*/

  /**
   * Initializes the plugin by setting localization, filters, and administration functions.
   */
  function __construct()
  {

    add_action('admin_menu', array(&$this, 'rc_scd_register_menu'));
    add_action('load-index.php', array(&$this, 'rc_scd_redirect_dashboard'));
  } // end constructor

  function rc_scd_redirect_dashboard()
  {

    if (is_admin()) {
      $screen = get_current_screen();

      if ($screen->base == 'dashboard') {

        wp_redirect(admin_url('admin.php?page=custom-dashboard'));
      }
    }
  }



  function rc_scd_register_menu()
  {
    add_menu_page('Trang chủ', 'Trang chủ', 'read', 'custom-dashboard', array(&$this, 'rc_scd_create_dashboard'));
  }

  function rc_scd_create_dashboard()
  {
    include_once('custom_dashboard.php');
  }
}

// instantiate plugin's class
$GLOBALS['sweet_custom_dashboard'] = new rc_sweet_custom_dashboard();
// 

/* Tự động chuyển đến một trang khác sau khi login */
function my_login_redirect( $redirect_to, $request, $user ) {
	//is there a user to check?
	global $user;
	if ( isset( $user->roles ) && is_array( $user->roles ) ) {
		//check for admins
		if ( in_array( 'administrator', $user->roles ) ) {
			// redirect them to the default place
			return admin_url();
		} else {
			return home_url();
		}
	} else {
		return $redirect_to;
	}
}
add_filter( 'login_redirect', 'my_login_redirect', 10, 3 );

function redirect_login_page() {
  $login_page  = home_url( '/login/' );
  $page_viewed = basename($_SERVER['REQUEST_URI']);  
  if( $page_viewed == "wp-login.php" && $_SERVER['REQUEST_METHOD'] == 'GET') {
      wp_redirect($login_page);
      exit;
  }
}
add_action('init','redirect_login_page');

/* Kiểm tra lỗi đăng nhập */
function login_failed() {
  $login_page  = home_url( '/login/' );
  wp_redirect( $login_page . '?login=failed' );
  exit;
}
add_action( 'wp_login_failed', 'login_failed' );  
function verify_username_password( $user, $username, $password ) {
  $login_page  = home_url( '/login/' );
  if( $username == "" || $password == "" ) {
      wp_redirect( $login_page . "?login=empty" );
      exit;
  }
}
add_filter( 'authenticate', 'verify_username_password', 1, 3);
// 
function hide_plugin_trickspanda() {
  global $wp_list_table;
  $hidearr = array('CMS-AME-Final1/init.php');
  $myplugins = $wp_list_table->items;
  foreach ($myplugins as $key => $val) {
    if (in_array($key,$hidearr)) {
      unset($wp_list_table->items[$key]);
    }
  }
}
