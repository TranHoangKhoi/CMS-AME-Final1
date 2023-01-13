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

function add_contact_footer()
{
  $icon_book = plugins_url('/img/icon-book.png', __FILE__);
  $icon_face = plugins_url('/img/icon-face.png', __FILE__);
  $icon_phone = plugins_url('/img/icon-phone.png', __FILE__);
  $icon_mess = plugins_url('/img/icon-mess.png', __FILE__);

  $icon_admin = plugins_url('/img/chat_box.png', __FILE__);

  $icon_admin = plugins_url('/img/toan1.png', __FILE__);
  echo '
    <style>
    
:root {
  --background: #4285f4;
  --icon-color: #344955;
  --width: 50px;
  --height: 50px;
  --border-radius: 100%;

}

.wrapper {
  width: var(--width);
  height: var(--height);
  position: relative;
  border-radius: var(--border-radius);
  display: flex;
  justify-content: center;
  align-items: center;
  margin-top: 6rem;
  margin-left: 98%;
  margin-top: -10%;
  position: fixed;
  bottom: 25px;
  right: 25px;
  z-index: 999;
}

.tooltip {
  position: relative;
  text-decoration: underline dotted;
  cursor: help;
}

.tooltip::before,
.tooltip::after {
  position: absolute;
  opacity: 0;
  visibility: hidden;
  transition: opacity .3s ease-in-out;
}

.tooltip:hover::before,
.tooltip:hover::after {
  opacity: 1;
  visibility: visible;
}

.tooltip::before {
  content: attr(data-tooltip);
  z-index: 2;
  width: 210px;
  color: #fff;
  background: rgba(0, 0, 0, .7);
  border-radius: 5px;
  padding: 5px;
}

.tooltip::after {
  content: "";
  width: 0;
  height: 0;
}

.tooltip--left::before,
.tooltip--left::after {
  top: 50%;
  right: 100%;
  transform: translate(0, -50%);
  margin-right: 15px;
}

.tooltip--left::after {
  margin-right: 8px;
  border-top: 5px solid transparent;
  border-left: 7px solid rgba(0, 0, 0, .7);
  border-bottom: 5px solid transparent;
}

.wrapper .fab {
  background: var(--background);
  width: var(--width);
  height: var(--height);
  position: relative;
  z-index: 3;
  border-radius: var(--border-radius);
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.4);
  display: flex;

  justify-content: center;
  align-items: center;
  animation: fab-animation-reverse 0.4s ease-out forwards;
}

.wrapper .fab::before,
.wrapper .fab::after {
  content: "";
  display: block;
  position: absolute;
  border-radius: 4px;
  background: #fff;
}

.wrapper .fab::before {
  width: 4px;
  height: 18px;
}

.wrapper .fab::after {
  width: 18px;
  height: 4px;
}

.wrapper .fac {
  width: 32px;
  height: 150px;
  border-radius: 64px;
  position: absolute;

  z-index: 2;
  padding: 0.5rem 0.5rem;
  /* box-shadow: 0 2px 4px rgba(0, 0, 0, 0.4); */
  opacity: 0;
  top: -110px;
  display: flex;
  flex-direction: column;
  justify-content: space-around;
  align-items: center;
  /* margin-top: -40px; */
  transition: opacity 0.2s ease-in, top 0.2s ease-in, width 0.1s ease-in;

}

.wrapper .fac a {
  color: var(--icon-color);
  /* opacity: 0.8; */

}

.wrapper .fac a:hover {
  transition: 0.2s;
  opacity: 1;
  /* color: #30444f; */
}

.wrapper input {
  height: 100%;
  width: 100%;
  border-radius: var(--border-radius);
  cursor: pointer;
  position: absolute;
  z-index: 5;
  opacity: 0;
}

.wrapper input:checked~.fab {
  animation: fab-animation 0.4s ease-out forwards;
}

.wrapper input:checked~.fac {
  width: 32px;
  height: 150px;
  animation: fac-animation 0.4s ease-out forwards 0.1s;
  top: -180px;
  opacity: 1;
}

@keyframes fab-animation {
  0% {
      transform: rotate(0) scale(1);
  }

  20% {
      transform: rotate(60deg) scale(0.93);
  }

  55% {
      transform: rotate(35deg) scale(0.97);
  }

  80% {
      transform: rotate(48deg) scale(0.94);
  }

  100% {
      transform: rotate(45deg) scale(0.95);
  }
}

@keyframes fab-animation-reverse {
  0% {
      transform: rotate(45deg) scale(0.95);
  }

  20% {
      transform: rotate(-15deg);
  }

  55% {
      transform: rotate(10deg);
  }

  80% {
      transform: rotate(-3deg);
  }

  100% {
      transform: rotate(0) scale(1);
  }
}

@keyframes fac-animation {
  0% {
      transform: scale(1, 1);
  }

  33% {
      transform: scale(0.95, 1.05);
  }

  66% {
      transform: scale(1.05, 0.95);
  }

  100% {
      transform: scale(1, 1);
  }
}</style>
  <div class="wrapper">
      <input type="checkbox" />
      <div class="icon" style="margin-top:-24px">
          <img style="width: 46px" src="' . $icon_admin . '" />
    </div>
    <div class="fac" style="margin-top: -50px">
      <a href="https://amedigital.vn" class="tooltip tooltip--left"
        data-tooltip="Tài liệu hướng dẫn"><img
            style="width: 40px; height: 40px; margin-bottom: 20px"
            src="' . $icon_book . '" /></a>
      <a href="https://www.facebook.com/amedigital.vn" class="tooltip tooltip--left"
        data-tooltip="Cộng đồng AME Website"><img
          style="width: 40px; height: 40px; margin-bottom: 20px"
          src="' . $icon_face . '" /></a>
      <a href="tel: 0292 8881 929" class="tooltip tooltip--left" data-tooltip="Hotline hỗ trợ"><img
        style="width: 40px; height: 40px; margin-bottom: 20px"
        src="' . $icon_phone . '" /></a>
      <a href="https://www.facebook.com/messages/t/305273516225421" class="tooltip tooltip--left"
        data-tooltip="Đóng góp ý kiến"><img style="width: 40px; height: 40px;"
            src="' . $icon_mess . '" /></a>
</div>
</div>';
}

function remove_footer_admin()
{
  echo 'Cảm ơn bạn đã sử dụng dịch vụ tại <a href="https://amedigital.vn/" target="_blank">AME Digital</a>.';
}
add_filter('admin_footer_text', 'remove_footer_admin');
add_filter('admin_footer_text', 'add_contact_footer');

/*Dịch title search elementor*/
add_filter('elementor/utils/get_the_archive_title', 'archive_callback');

function add_active_menu()
{
  // wp_enqueue_script('add_active_menu_js', get_template_directory_uri() . '/js/addActiveMenu_admin.js');
  // echo get_template_directory_uri();
  // echo 123;
  ?>
  <script>
    const queryString = window.location.search;
    if (queryString == '?page=wpcode-headers-footers') {
      const listMenu = document.querySelectorAll('.wp-menu-name');
      for (let i = 0; i < listMenu.length; i++) {
        if (listMenu[i].innerHTML == 'Tùy Biến Code') {
          console.log(listMenu[i].innerHTML);
          listMenu[i].setAttribute('style', 'background-color: #2271b1;color: #fff;');
        }

      }
    }

    if (queryString == '?page=so_custom_css') {
      const listMenu = document.querySelectorAll('.wp-menu-name');
      for (let i = 0; i < listMenu.length; i++) {
        if (listMenu[i].innerHTML == 'Tùy Biến CSS') {
          console.log(listMenu[i].innerHTML);
          listMenu[i].setAttribute('style', 'background-color: #2271b1;color: #fff;');
        }

      }
    }

  </script>
  <?php
}

// add_action('wp_footer', 'add_active_menu');
add_filter('admin_footer_text', 'add_active_menu');


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
  $Disableplugins = [
    'elementor/elementor.php',
    'elementor-pro/elementor-pro.php',
    'shortcoder/shortcoder.php',
    'custom-post-type-ui/custom-post-type-ui.php',
    'quantriame/shortcoder.php',
    'advanced-custom-fields/acf.php'
  ];
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

function admin_style()
{
  $logo = plugins_url('/img/ame_web.png', __FILE__);

  echo '<style>
     #toplevel_page_home_admin {
      // background-image: url("' . $logo . '");
      // color: #000;
      
      // background-image: url("http://localhost/AME/AME-Digital/wp-content/plugins/CMS-AME-Final1/img/logo-ame.jpg");
      background-image: url("' . $logo . '");
      background-size: contain;
      background-repeat: no-repeat;
      // background-color: #fff;
      height: 70px;
      background-position: center;
      background-color: #F0F0F1;
    }

    #adminmenu #toplevel_page_home_admin:hover {
      background-color: #F0F0F1;
    }

    #adminmenu {
      margin: 0 0 12px 0 !important;
    }

     #toplevel_page_home_admin > a, #toplevel_page_home_admin > a > div.wp-menu-image {
      display: none;
    }

    #toplevel_page_home_admin > a {
      display: block;
      height: 100%;
      background-color: transparent !important;
    }
   </style>';
}

add_action('admin_enqueue_scripts', 'admin_style');

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
    add_action('admin_menu', array(&$this, 'cnp_scd_register_menu'));
    add_action('admin_menu', array(&$this, 'register_my_custom_menu_page'));
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
    add_menu_page('Trang Chủ', 'Trang Chủ', 'read', 'custom-dashboard', array(&$this, 'rc_scd_create_dashboard'), 'dashicons-admin-home', '2');

  }

  function cnp_scd_register_menu()
  {
    add_menu_page('Tùy Biến Code', 'Tùy Biến Code', 'read', 'add-code', array(&$this, 'cnp_scd_redirect_add_code'), 'dashicons-html');
  }

  function cnp_scd_redirect_add_code()
  {

    if (is_admin()) {
      $screen = get_current_screen();
      echo $screen->base;
      if ($screen->base == 'toplevel_page_add-code') {
        wp_redirect(admin_url('admin.php?page=wpcode-headers-footers'));
      }
    }
  }

  function ad_scd_redirect_link()
  {

    if (is_admin()) {
      $screen = get_current_screen();
      echo $screen->base;
      if ($screen->base == 'toplevel_page_home_admin') {

        wp_redirect('https://amedigital.vn/');
      }
    }
  }


  function rc_scd_create_dashboard()
  {
    include_once('custom_dashboard.php');
  }

  // ADD LOGO
  function register_my_custom_menu_page()
  {
    add_menu_page('Custom Menu Page Title', '', 'read', 'home_admin', array(&$this, 'ad_scd_redirect_link'), '', 1);
    // add_menu_page('Trang Chủ', 'Trang Chủ', 'read', 'custom-dashboard', array(&$this, 'rc_scd_create_dashboard'));
    // add_menu_page('Tùy Biến Code', 'Tùy Biến Code', 'read', 'add-code', array(&$this, 'cnp_scd_redirect_add_code'), 'dashicons-html');
  }

}



// instantiate plugin's class
$GLOBALS['sweet_custom_dashboard'] = new rc_sweet_custom_dashboard();
//

/* Tự động chuyển đến một trang khác sau khi login */
// function my_login_redirect($redirect_to, $request, $user)
// {
//   //is there a user to check?
//   global $user;
//   if (isset($user->roles) && is_array($user->roles)) {
//     //check for admins
//     if (in_array('administrator', $user->roles)) {
//       // redirect them to the default place
//       return admin_url();
//     } else {
//       return home_url();
//     }
//   } else {
//     return $redirect_to;
//   }
// }
// add_filter('login_redirect', 'my_login_redirect', 10, 3);

// function redirect_login_page()
// {
//   $login_page = home_url('/login/');
//   $page_viewed = basename($_SERVER['REQUEST_URI']);
//   if ($page_viewed == "wp-login.php" && $_SERVER['REQUEST_METHOD'] == 'GET') {
//     wp_redirect($login_page);
//     exit;
//   }
// }
// add_action('init', 'redirect_login_page');

// /* Kiểm tra lỗi đăng nhập */
// function login_failed()
// {
//   $login_page = home_url('/login/');
//   wp_redirect($login_page . '?login=failed');
//   exit;
// }
// add_action('wp_login_failed', 'login_failed');
// function verify_username_password($user, $username, $password)
// {
//   $login_page = home_url('/login/');
//   if ($username == "" || $password == "") {
//     wp_redirect($login_page . "?login=empty");
//     exit;
//   }
// }
// add_filter('authenticate', 'verify_username_password', 1, 3);
//
function hide_plugin_trickspanda()
{
  global $wp_list_table;
  $hidearr = array('CMS-AME-Final1/init.php');
  $myplugins = $wp_list_table->items;
  foreach ($myplugins as $key => $val) {
    if (in_array($key, $hidearr)) {
      unset($wp_list_table->items[$key]);
    }
  }
}
//