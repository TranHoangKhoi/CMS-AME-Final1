
<body>
<div class="alert-box success">Cập nhật thành công !!! Chuyển hướng sau 2s</div>
  <?php
  $args = array(
    'posts_per_page' => -1,
    'post_type' => 'shortcoder',
    'p' => $post_id
  );
  
  $the_query = new WP_Query($args);
  ?>
  <?php
  if ($the_query->have_posts()) :
  ?>
      <div style="padding: 20px;">
        <div id="vnkings_postBox">
          <?php while ($the_query->have_posts()) : $the_query->the_post(); ?>
            <h1 style="font-size: 18px; padding-top: 10px; font-weight: 700; color: black">Chỉnh sửa ảnh </h1>
            <form id="update_post" class="form-horizontal" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
              <div class="form-group vnking_pd col-sm-12 col-md-6">
                <label for="post_title" style="margin-left: -11px;">Tên shortcode</label>
                <input value="<?php echo $post_id ?>" type="hidden" id="post_id">
                <input style="margin-left: -11px;" type="text" name="post_title" readonly class="form-control" placeholder="Tiêu đề" value="<?php the_title() ?>">
              </div>
              <div class="form-group">
                <h6>Nội dung</h6>
                <td>
                  <textarea class="ckeditor" id="editor1" rows="10" cols="150"><?php the_content() ?></textarea>
                </td>
              </div>
        </div>
      </div>
      <div style="padding-bottom: 30px; padding-left: 20px; ">
      <button type="button" class="btn btn-outline-warning btn-back" style="color: #0d3380;">Quay lại</button> 
      <button style="background-color: #0d3380; color: #ffc72b;" type="submit" id="btn-update" class="btn btn-primary">Update</button>
      </div>
    </div>
    </form>
    <script>
       var editor = CKEDITOR.replace( 'editor1' );
       CKFinder.setupCKEditor( editor );
    </script>
   
    <style>
      .alert-box {
        margin-top: 2%;
        padding: 15px;
        margin-bottom: 20px;
        border: 1px solid transparent;
        border-radius: 4px;
      }

      .success {
        color: #3c763d;
        background-color: #dff0d8;
        border-color: #d6e9c6;
        display: none;
      }
    </style>
    <script>
      jQuery(document).ready(function($) {
        $('.btn-back').on('click', function() {
          location.reload();
        });

        //========================upload========================
        $('#upload').on('click', function(){
          var post_id = jQuery('#post_id').val();
          console.log(post_id);
          $.ajax({
            type: 'POST',
            url: ajaxurl,
            data: {
              action: 'add_img',
              post_id: post_id,
            }
          })
        })
        //============================update===============
        $('#btn-update').on('click', function() {
          var post_id = jQuery('#post_id').val();
          CKEDITOR.replace('editor1');
          var post_content = CKEDITOR.instances.editor1.getData();
          console.log(post_content);
          $.ajax({
            type: 'POST',
            url: ajaxurl,
            data: {
              action: 'update_shortcode',
              post_id: post_id,
              post_content: post_content
            },
            success: function(result) {
              $( "div.success" ).fadeIn( 300 ).delay( 1500 ).fadeOut( 400 );
              location.reload();
              
            }
          });
        });
      });
    </script>
  <?php endwhile; ?>
  </div>
  </div>
  </div>
<?php endif; ?>
</body>

</html>