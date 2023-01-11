<?php
$args = array(
    'posts_per_page' => -1,
    'post_type'      => 'shortcoder',
);
global $wpdb;

$table_shortcode = $wpdb -> prefix.'posts';
$data = $wpdb->get_results("SELECT * FROM $table_shortcode WHERE post_name Like '%ter'");
$the_query = new WP_Query($args);
?>
<style>

    .tim{
        margin-left: 710px;
        width: 161px;
    }
    .border-hd{
        border: 1px #f7f9fb solid;
        padding: 10px;
        /* border-radius: 10px; */
        width: 97%;
        margin-left: 19px;
        background-color: #f7f9fb;
    }
    .table-sc{
        margin-top: 15px;
    }
    .filter1{
        height: 5px;
        margin-top: 2px;
    }
    .title{
        margin-top: 6px;
    }
    .sc{
        width: 500px;
    }
    
</style>
<?php if ($the_query->have_posts()) : ?>
    <h1 style="padding-top: 20px; font-weight: 900; font-size: 25px; color:#0d3380; margin-left: 0px;">TÙY BIẾN FOOTER</h1>
    <div class="table-sc" id="table_list_shortcode"> 
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                        <tr>
                            <th style="width: 80%; text-align:left; font-size: 15px; font-weight: 600; color:#0d3380">Tên shortcode</th>
                            <th hidden>Mã shortcode</th>
                            <th style="width: 80%; text-align:left; font-size: 15px; font-weight: 600; color:#0d3380" >Hành động</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th style="width: 80%; text-align:left; font-size: 15px; font-weight: 600; color:#0d3380">Tên shortcode</th>
                            <th hidden>Mã shortcode</th>
                            <th style="width: 80%; text-align:left; font-size: 15px; font-weight: 600; color:#0d3380">Hành động</th>
                        </tr>
                    </tfoot>
                    <tbody id="data_filter1" ></tbody>
                    <tbody id="pagination1" ></tbody>
                    <tbody id="data_table1" style="">
                    <?php foreach( (array) $data as $key){?>
                            <tr>
                                <td style="color: black; font-weight: 500"><?php echo $key -> post_title ?></br></td>
                                <td hidden class="sc">[sc name="<?php echo $key -> post_name ?>"][/sc]</td>
                                <td>
                                    <a href="#" id="<?php echo $key -> ID ?>" class="btn-edit btn btn-danger btn-icon-split edit_shortcode">
                                        <!-- <span class="icon text-white-50">
                                            <i class="fas fa-pencil-alt"></i>
                                        </span> -->
                                        <span class="text">Chỉnh sửa </span>
                                    </a>
                                </td>
                            </tr>
                            <?php }?>
                    </tbody>
                </table>
            </div>
        </div>
    
    <div id="result"></div>
    <script>
        jQuery(document).ready(function($) {
            $('.edit_shortcode').on('click', function() {
                var post_id = $(this).attr('id');
                $.ajax({
                    type: 'POST',
                    url: ajaxurl,
                    data: {
                        action: 'show_edit_shortcode',
                        post_id: post_id
                    },
                    success: function(result) {
                        $('#result').html(result);
                        $('#table_list_shortcode').hide();
                    }
                });
            });
        });
        //video
        jQuery(document).ready(function($) {
            $('.video_shortcode').on('click', function() {
                var post_id = $(this).attr('id');
                $.ajax({
                    type: 'POST',
                    url: ajaxurl,
                    data: {
                        action: 'show_shortcode_video',
                        post_id: post_id
                    },
                    success: function(result) {
                        $('#result').html(result);
                        $('#table_list_shortcode').hide();
                    }
                });
            });
        });
        //img
        jQuery(document).ready(function($) {
            $('.img_shortcode').on('click', function() {
                var post_id = $(this).attr('id');
                $.ajax({
                    type: 'POST',
                    url: ajaxurl,
                    data: {
                        action: 'show_shortcode_img',
                        post_id: post_id
                    },
                    success: function(result) {
                        $('#result').html(result);
                        $('#table_list_shortcode').hide();
                    }
                });
            });
        });
        //catarogy post
        jQuery(document).ready(function($) {
            jQuery('#filter1').change(function(e){
                    e.preventDefault();
                    $("#data_table1").hide();
                    var ajaxurl = "<?php echo admin_url('admin-ajax.php');?>";
                    var filterPage1 = $('#filter1').val()
                    var post_id = $(this).attr('id');
                    var dataFilter1 = {
                        action : 'show_pageFilter_post',
                        filterPage1: filterPage1,
                        post_id : post_id
                    };
                    (function($) {
                        $.post(ajaxurl, dataFilter1,
                         function(response) {
                            
                            $("#data_filter1").html(response);
                        });
                    }(jQuery))
                });
        });
        
        //Phântrang
        jQuery(document).ready(function($) {
            jQuery('.pagination').change(function(e){
                    e.preventDefault();
                    $("#data_table1").hide();
                    var ajaxurl = "<?php echo admin_url('admin-ajax.php');?>";
                    var pagination = $('#pagination').val()
                    var post_id = $(this).attr('id');
                    var pagination1 = {
                        action : 'show_Pagination',
                        pagination1: pagination1,
                        post_id : post_id
                    };
                    (function($) {
                        $.post(ajaxurl, pagination1,
                         function(response) {
                            
                            $("#pagination1").html(response);
                        });
                    }(jQuery))
                });
        });
        //
        
        function myFunction() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("myInput");
            filter = input.value.toUpperCase();
            table = document.getElementById("dataTable");
            tr = table.getElementsByTagName("tr");
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[0];
                if (td) {
                    txtValue = td.textContent || td.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        }
    </script>

<?php endif; ?>
<?php wp_reset_query(); ?>