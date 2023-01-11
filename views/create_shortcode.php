<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="//cdn.ckeditor.com/4.19.0/standard/ckeditor.js"></script>
  <style>
  </style>
</head>
<style>
  .tag{
    margin-left: 320px;
    margin-top: -85px;
  }
</style>
<body>
<div class="alert-box success">Cập nhật thành công !!! Chuyển hướng sau 2s</div>
      <div style="padding: 20px;">
        <div id="vnkings_postBox">
     
            <h1 style="font-size: 18px; padding-top: 10px; font-weight: 700; color: black">Thêm shortcode video</h1>
            <form id="insert_sc" class="form-horizontal" method="post" action="" enctype="multipart/form-data">
              <div class="form-group vnking_pd col-sm-12 col-md-6">
                <label for="sc_name" style="margin-left: -11px;">Tên shortcode</label>
                <input style="margin-left: -11px;" type="text" name="sc_name" class="form-control" placeholder="Tiêu đề" id="sc_name">
              </div>
              <div class="form-group vnking_pd col-sm-12 col-md-6 video">
                <label for="url_video" style="margin-left: -11px;">URL Video</label>
                <input style="margin-left: -11px;" type="text" name="url_video" id="url_video" class="form-control" placeholder="Link, File" value="">
              </div>
              <div class="form-group" hidden>
                <h6>Nội dung</h6>
                <td>
                  <textarea hidden class="ckeditor" id="sc_content" rows="5" cols="150"></textarea>
                </td>
              </div>

              <div class="form-group vnking_pd col-sm-6 col-md-3">
                <label for="sc_type" style="margin-left: -11px;">Loại Shortcode</label>
                <input style="margin-left: -11px;" type="text" name="sc_type" id="sc_type"class="form-control" readonly placeholder="Link, File" value="video">
                </select>
              </div>
              <div class="form-group vnking_pd col-sm-6 col-md-3 tag">
                <label for="sc_tag" style="margin-left: -11px;">Tag</label>
                <input style="margin-left: -11px;" type="text" name="sc_tag" id="sc_tag" class="form-control" placeholder="trangchu, lienhe" value="">
              </div>
              <div class="form-group vnking_pd col-sm-6 col-md-3">
                <label for="url_img" style="margin-left: -11px;" hidden>URL Hình Ảnh</label>
                <input style="margin-left: -11px;" type="text" name="url_img" id="url_img"class="form-control" placeholder="Link, File" hidden value="">
              </div>
                 
              <div class="form-group vnking_pd col-sm-6 col-md-3 video">
                <label for="type" style="margin-left: -11px;" hidden>URL Video</label>
                <input style="margin-left: -11px;" type="text" name="type" id="type" class="form-control" placeholder="Link, File" value="ameshortcode" hidden>
              </div>   
        </div>
      </div>
      <div style="padding-bottom: 30px; padding-left: 20px; padding-top: 5px; ">
      <button type="button" class="btn btn-outline-warning btn-back" style="color: #0d3380;">Quay lại</button> 
      <button style="background-color: #0d3380; color: #ffc72b;" type="submit" id="btn-insert" class="btn btn-primary">Insert</button>
      </div>
    </div>
    </form>   
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
        $('#btn-insert').on('click', function() {
          var sc_name = jQuery('#sc_name').val();
          var sc_type = jQuery('#sc_type').val();
          var sc_tag = jQuery('#sc_tag').val();
          var url_img = jQuery('#url_img').val();
          var url_video = jQuery('#url_video').val();
          var type = jQuery('#type').val();
          CKEDITOR.replace('sc_content');
          var sc_content = CKEDITOR.instances.sc_content.getData();
          $.ajax({
            type: 'POST',
            url: ajaxurl,
            data: {
              action: 'add_shortcode',
              sc_name: sc_name,
              sc_content: sc_content,
              sc_type: sc_type,
              url_img: url_img,
              url_video: url_video,
              sc_tag: sc_tag,
              type : type
            },
            success: function(result) {
              $( "div.success" ).fadeIn( 300 ).delay( 1500 ).fadeOut( 400 );
              location.reload();
              
            }
          });
        });
      });
    </script>
  </div>
  </div>
  </div>
    </div>

</body>

</html>