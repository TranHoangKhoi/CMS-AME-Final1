<?php



class AME_EDIT_SHORTCODE

{

    static public $shortcodes = array();

    //=====================Add css vào header admin========================================

    public function CustomHeaderAdmin()

    {
                                                                            
        $css = "<link rel='stylesheet' id='AME_CHAT-admin-css'  href='" . site_url() . "\wp-content\plugins\CMS-AME-Final1\css\sb-admin-2.min.css' media='all' />  ";

        // $fontawesomeUrl = plugins_url('/vendor/fontawesome-free/css/all.min.css', __FILE__);

        $fontawesome = "<link href='" . site_url() . "\wp-content\plugins\CMS-AME-Final1\\vendor\\fontawesome-free\\css\\all.min.css' rel='stylesheet' type='text/css'>";

        $Googlefont = '<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">';

        echo $css . "\n";

        echo $fontawesome . "\n";

        echo $Googlefont . "\n";

    }

    //=========Add js cript vào footer admin===

    public function CustomFooterAdmin()

    {

        echo '



         <!-- Custom scripts for all pages-->
        

         <script src="' . site_url() . '\wp-content\plugins\CMS-AME-Final1/js/sb-admin-2.js"></script>
         <script src="' . site_url() . '\wp-content\plugins\CMS-AME-Final1/js/sb-admin-2.min.js"></script>
        <!-- CKEDITOR --!>
        
        <script src="' . site_url() . '\wp-content\plugins\CMS-AME-Final1\js\ckeditor\ckeditor.js"></script>
        <script src="' . site_url() . '\wp-content\plugins\CMS-AME-Final1\js\ckfinder\ckfinder.js"></script>
    
       
         ';
    }

    //========Add Admin menu plugin===========

    public function AddAdminMenu()

    {

        add_menu_page(

            'Ame_edit_shortcode',

            'Header - Footer',

            'delete_others_pages',

            'edit_short',

            array($this, 'show_index'),
            AME_EDIT_SHORTCODE_URL . '/img/ame-edit.png',

            '2'
        );
        add_submenu_page('edit_short', '', 'Header', 'delete_others_pages', 'show_plugin_dashboard', array($this, 'show_plugin_dashboard'));
        add_submenu_page('edit_short', '', 'Logo', 'delete_others_pages', 'show_edit_img', array($this, 'show_edit_img'));
        add_submenu_page('edit_short', '', 'Footer', 'delete_others_pages', 'show_list_shortcode_video', array($this, 'show_shortcode_video'));
    }



    public function show_index()

    {

        require(AME_EDIT_SHORTCODE_DIR . 'views/index.php');
    }
    // 
    public function show_edit_img()

    {

        require(AME_EDIT_SHORTCODE_DIR . 'views/edit-img.php');
    }

    public function show_plugin_dashboard()

    {

        require(AME_EDIT_SHORTCODE_DIR . 'views/dashboard.php');
    }
    public static function show_edit_shortcode()
    {
        $post_id = $_POST['post_id'];
        require(AME_EDIT_SHORTCODE_DIR . 'views/edit_form.php');
        wp_die();
    }
    public static function show_edit_shortcode_video()
    {
        $post_id = $_POST['post_id'];
        require(AME_EDIT_SHORTCODE_DIR . 'views/edit_form_video.php');
        wp_die();
    }

    public static function show_edit_shortcode_img()
    {
        $post_id = $_POST['post_id'];
        require(AME_EDIT_SHORTCODE_DIR . 'views/edit_form_img.php');
        wp_die();
    }

    public static function show_shortcode_video()
    {
        //$post_id = $_POST['post_id'];
        require(AME_EDIT_SHORTCODE_DIR . 'views/dashboard2.php');
        // wp_die();
    }

    public static function show_shortcode_img()
    {
        //$post_id = $_POST['post_id'];
        require(AME_EDIT_SHORTCODE_DIR . 'views/dashboard3.php');
        // wp_die();
    }

    public static function show_shortcode_slide()
    {
        //$post_id = $_POST['post_id'];
        require(AME_EDIT_SHORTCODE_DIR . 'views/index-slide.php');
        // wp_die();
    }

    //lam viec voi wp them/update/...

    public static function show_add_shortcode()
    {
        // $post_id = $_POST['post_id'];
        require(AME_EDIT_SHORTCODE_DIR . 'views/create_shortcode.php');
        wp_die();
    }

    public static function show_add_tag()
    {
        // $post_id = $_POST['post_id'];
        require(AME_EDIT_SHORTCODE_DIR . 'views/edit_tag.php');
        wp_die();
    }

    public static function update_shortcode()
    {
        $post_id = $_POST['post_id'];
        $post_content = $_POST['post_content'];
        global $wpdb;
        $table_post = $wpdb->prefix . "posts";
        // update `wp_posts` set post_content='post_content' WHERE ID=1799
        $sql = "update `" . $table_post . "` set post_content='" . $post_content . "' WHERE ID=" . $post_id;
        $wpdb->query($sql);
        wp_die();
    }

    public static function add_shortcode()
    {
        $sc_name = $_POST['sc_name'];
        $sc_content = $_POST['sc_content'];
        $sc_type = $_POST['sc_type'];
        $url_img = $_POST['url_img'];
        $url_video = $_POST['url_video'];
        $sc_tag = $_POST['sc_tag'];
        $type = $_POST['type'];
        global $wpdb;
        $ame_shortcode = $wpdb->prefix . "ame_shortcoder";
        $sql = "INSERT INTO `" . $ame_shortcode . "` (`SC_name`, `SC_Content`, `SC_type`, `url_img`, `url_video`, `tag`, `type`) VALUES ( '" . $sc_name . "','" . $sc_content . "','" . $sc_type . "','" . $url_img . "','" . $url_video . "', '" . $sc_tag . "', '" . $type . "')";
        $wpdb->query($sql);
        wp_die();
    }

    public static function update_shortcode2()
    {
        $post_id = $_POST['post_id'];
        $sc_content2 = $_POST['sc_content2'];
        $url_img = $_POST['url_img'];
        $url_video = $_POST['url_video'];
        $type = $_POST['type'];
        global $wpdb;
        $ame_shortcode = $wpdb->prefix . "ame_shortcoder";
        // update `wp_posts` set post_content='post_content' WHERE ID=1799
        $sql = "UPDATE `" . $ame_shortcode . "` SET `SC_Content`= '" . $sc_content2 . "', `url_img`= '" . $url_img . "', `url_video`= '" . $url_video . "' WHERE ID = '" . $post_id . "'";
        $wpdb->query($sql);
        wp_die();
    }
    public static function show_pageFilter()
    {
        $filterPage = $_POST['filterPage'];
        // echo $filterPage;
        global $wpdb;
        $ame_shortcode = $wpdb->prefix . 'ame_shortcoder';
        $sql = "SELECT * FROM `" . $ame_shortcode . "` WHERE tag LIKE '" . $filterPage . "'";
        $data = $wpdb->get_results($sql);
        if (!empty($data))                        // Checking if $results have some values or not
        {
            foreach ($data as $row) {              //putting the user_ip field value in variable to use it later in update query
                echo '<tr>';                           // Adding rows of table inside foreach loop
                echo '<td>' . $row->SC_name . '</td>';
                echo '<td>' . $row->tag . '</td>';
                echo '<td>[video src="'. $row->url_video .'"]</td>';
                echo '<td> <a href="#" id="'.$row -> ID.'" class="btn btn-danger btn-icon-split edit_shortcode2">
                                    <span class="text">Chỉnh sửa </span>
                            </a> </td>';
                echo '<td><input type="checkbox" '.$row -> ID.'></td>';
                echo '</tr>';
          
            }
    
        }
        wp_die();
    }

    public static function show_pageFilter_post()
    {
        $filterPage1 = $_POST['filterPage1'];
        global $wpdb;
        $table_post = $wpdb->prefix . "posts";
        $sql = "SELECT * FROM `" . $table_post . "` WHERE post_title LIKE '".$filterPage1."'";
        $data = $wpdb -> get_results($sql);
            foreach ($data as $row) {              //putting the user_ip field value in variable to use it later in update query
                echo '<tr>';                           // Adding rows of table inside foreach loop
                echo '<td>'.$row-> post_title.'</td>';
                echo '<td>[sc name="'.$row->post_title.'"][/sc]</td>';
                echo '<td> <a href="#" id="'.$row -> ID.'" class="btn btn-danger btn-icon-split edit_shortcode2">
                                    <span class="text">Chỉnh sửa </span>
                            </a> </td>';
                echo '</tr>';
            }
    
        
         
        wp_die();
    }
    //
    public static function show_pageFilter_post2()
    {   
        $post_id = $_POST['post_id'];
        $filterPage2 = $_POST['filterPage2'];
        global $wpdb;
        $table_post = $wpdb->prefix . "posts";
        $sql = "SELECT * FROM `" . $table_post . "` WHERE post_title LIKE '".$filterPage2."'";
        $data = $wpdb -> get_results($sql);
            foreach ($data as $row) {              //putting the user_ip field value in variable to use it later in update query
                echo '<tr>';                           // Adding rows of table inside foreach loop
                echo '<td>'.$row-> post_title.'</td>';
                echo '<td>[sc name="'.$row->post_title.'"][/sc]</td>';
                echo '<td> <a href="#" id="'.$row -> ID.'"class="btn btn-danger btn-icon-split edit_shortcode2">
                                    <span class="text">Chỉnh sửa </span>
                            </a> </td>';
                echo '</tr>';
            }
        wp_die();
    }
    //
    public static function show_pageFilter_post3()
    {   
        $post_id = $_POST['post_id'];
        $filterPage3 = $_POST['filterPage3'];
        global $wpdb;
        $table_post = $wpdb->prefix . "posts";
        $sql = "SELECT * FROM `" . $table_post . "` WHERE post_title LIKE '".$filterPage3."'";
        $data = $wpdb -> get_results($sql);
            foreach ($data as $row) {              //putting the user_ip field value in variable to use it later in update query
                echo '<tr>';                           // Adding rows of table inside foreach loop
                echo '<td>Slide: <span style="font-weight: 900;">'.$row-> post_title.'</span></td>';
                echo '<td>[soliloquy id="'.$row-> ID.'"]</td>';
                echo '<td> <a href="http://localhost/Alphamedia/wp-admin/post.php?post='.$row -> ID.'&action=edit" id="'.$row -> ID.'"class="btn btn-danger btn-icon-split edit_shortcode2">
                                    <span class="text">Chỉnh sửa </span>
                            </a> </td>';
                echo '</tr>';
            }
        wp_die();
    }
    //
    public static function del_sc_video(){
        $post_id = $_POST['post_id'];
        global $wpdb;
        $ame_shortcode = $wpdb->prefix . "ame_shortcoder";
        $sql = "DELETE FROM `".$ame_shortcode."` WHERE ID = '".$post_id."' ";
        $wpdb->query($sql);
        wp_die();
    

    }
  // PHÂN TRANG
  public static function show_Pagination()
  {   
      $post_id = $_POST['post_id'];
      $pagination1 = $_POST['pagination1'];
      global $wpdb;
      $table_post = $wpdb->prefix . "posts";
      $sql = "SELECT * FROM `" . $table_post . "` WHERE post_type = 'shortcoder' ORDER BY ID ASC LIMIT 0,3";
      echo $sql;
      
    //   $data = $wpdb -> get_results($sql);
    //       foreach ($data as $row) {              //putting the user_ip field value in variable to use it later in update query
    //           echo '<tr>';                           // Adding rows of table inside foreach loop
    //           echo '<td>Slide: <span style="font-weight: 900;">'.$row-> post_title.'</span></td>';
    //           echo '<td>[soliloquy id="'.$row-> ID.'"]</td>';
    //           echo '<td> <a href="http://localhost/Alphamedia/wp-admin/post.php?post='.$row -> ID.'&action=edit" id="'.$row -> ID.'"class="btn btn-danger btn-icon-split edit_shortcode2">
    //                               <span class="icon text-white-50">
    //                                   <i class="fas fa-pencil-alt"></i>
    //                               </span>
    //                               <span class="text">Chỉnh sửa </span>
    //                       </a> </td>';
    //           echo '</tr>';
    //       }
          
    //   wp_die();
  }
//
public static function update_shortcode_tag()
    {
        $post_id = $_POST['post_id'];
        $tag = $_POST['tag'];
        global $wpdb;
        $ame_shortcode = $wpdb->prefix . "ame_shortcoder";
        // update `wp_posts` set post_content='post_content' WHERE ID=1799
        $sql = "UPDATE `" . $ame_shortcode . "` SET `tag`= '" . $tag . "' WHERE ID = '" . $post_id . "'";
        $wpdb->query($sql);
        wp_die();
    }

}
