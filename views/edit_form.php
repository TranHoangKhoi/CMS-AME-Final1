<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

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
            <form id="update_post" class="form-horizontal" method="post" action="" enctype="multipart/form-data">
              <div class="form-group vnking_pd col-sm-12 col-md-6 edit-nd">
                <label class="label1" for="post_title" style="margin-left: 3px;">Chỉnh sửa nội dung: </label>
                <input value="<?php echo $post_id ?>" type="hidden" id="post_id">
                <a style="margin-left: 0px; border: 1px solid white; padding-top: 5px; padding-bottom: 5px; padding-left: 25px; padding-right: 25px; font-size: 16px; border-radius: 5px; background-color: white; color: #0d3380; font-weight: 600;"><?php the_title() ?></a>
                <!-- <input style="margin-left: 10px; background-color: white;" type="text" name="post_title" readonly class="form-control" placeholder="Tiêu đề" value=""> -->
                <button type="button" class="btn btn-outline-warning btn-back btn-x" style="color: white; border: 1px solid red; background-color: red; ">X</button> 
              </div>
              <div class="form-group">
                <td>
                  <textarea   class="ckeditor" id="editor1" rows="10" cols="150"><?php the_content() ?></textarea>
                </td>
              </div>
        </div>
      </div>
      <div style="padding-bottom: 30px; padding-left: 20px; ">
      
      <button style="background-color: #0d3380; color: #ffc72b; border: 1px solid #0d3380; border-radius: 5px; padding: 5px; font-weight: 600;  box-shadow: 0 0 11px rgba(33,33,33,.2);" type="submit" id="btn-update" class="btn btn-primary">Cập nhật</button>
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