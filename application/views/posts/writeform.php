<?php
/**
 * Post Add
 *
 * @category  View
 * @package   post
 * @author    Gongjam <guruahn@gmail.com>
 * @copyright Copyright (c) 2014
 * @license   http://opensource.org/licenses/gpl-3.0.html GNU Public License
 * @version   1.0
 **/
?>
<!--froala editor style start-->
<link href="<?php echo _BASE_URL_;?>/public/css/froala/font-awesome.min.css" rel="stylesheet" type="text/css">
<link href="<?php echo _BASE_URL_;?>/public/css/froala/froala_editor.min.css" rel="stylesheet" type="text/css">
<link href="<?php echo _BASE_URL_;?>/public/css/froala/froala_reset.min.css" rel="stylesheet" type="text/css">
<!--froala editor style end-->
</head>
<body>

  <div id="wrapper">
      <h2><?php echo $title?></h2>
      <form method="post" action="<?=_BASE_URL_?>/posts/add">
          <input type="hidden" name="ip" value="<?php echo $_SERVER['SERVER_ADDR']; ?>" />
          <ul>
              <li>
                  <label for="Title">Title</label>
                  <input name="title" id="title" type="text" size="30" value="" />
              </li>
              <li>
                  <label for="category_id">category</label>
                  <input name="category_id" id="category_id" type="text" size="30" value="" />
              </li>
              <li>
                  <label for="content">content</label>
                  <textarea name="content" id="content" size="30" ></textarea>
              </li>
              <li>
                  <label for="tags">tags</label>
                  <input name="tags" id="tags" type="text" size="30" value="" />
              </li>
              <li>
                  <label for="is_notice_Y">is notice yes</label>
                  <input type="radio" name="is_notice" value="Y" id="is_notice_Y" />
                  <label for="is_notice_N">is notice no</label>
                  <input type="radio" name="is_notice" value="N" id="is_notice_N" checked />
              </li>
              <li>
                  <label for="is_notice_Y">is secret yes</label>
                  <input type="radio" name="is_secret" value="Y" id="is_secret_Y" />
                  <label for="is_notice_N">is secret no</label>
                  <input type="radio" name="is_secret" value="N" id="is_secret_N" checked />
              </li>
              <li>
                  <label for="modify_date">modify date</label>
                  <input name="modify_date" id="modify_date" type="text" size="30" value="<?php echo date("Y-m-d H:i:s"); ?>" />
              </li>
          </ul>
          <p><input type="submit" value="submit" /> </p>
      </form>
  </div>



<a href="<?=_BASE_URL_?>/posts/viewall">
	<span>
	Posts list
	</span>
</a>

  <script src="http://code.jquery.com/jquery-1.10.2.js"></script>
  <!--froala editor js start http://editor.froala.com/-->
  <script src="<?php echo _BASE_URL_;?>/public/js/froala/libs/beautify/beautify-html.js"></script>
  <script src="<?php echo _BASE_URL_;?>/public/js/froala/froala_editor.min.js"></script>
  <!--[if lt IE 9]>
  <script src="<?php echo _BASE_URL_;?>/public/js/froala/froala_editor_ie8.min.js"></script>
  <![endif]-->
  <script src="<?php echo _BASE_URL_;?>/public/js/froala/plugins/tables.min.js"></script>
  <script src="<?php echo _BASE_URL_;?>/public/js/froala/plugins/colors.min.js"></script>
  <script src="<?php echo _BASE_URL_;?>/public/js/froala/plugins/fonts/fonts.min.js"></script>
  <script src="<?php echo _BASE_URL_;?>/public/js/froala/plugins/fonts/font_family.min.js"></script>
  <script src="<?php echo _BASE_URL_;?>/public/js/froala/plugins/fonts/font_size.min.js"></script>
  <script src="<?php echo _BASE_URL_;?>/public/js/froala/plugins/block_styles.min.js"></script>
  <script src="<?php echo _BASE_URL_;?>/public/js/froala/plugins/video.min.js"></script>
  <script src="<?php echo _BASE_URL_;?>/public/js/froala/langs/ko.js"></script>
  <script>
  $(function(){
      $('#content').editable({
          inlineMode: false,
          textNearImage: false,
          language: 'ko',
          height: 300,
          imageUploadURL: "<?php echo _BASE_URL_;?>/api/posts/uploadFile"
      });

      $('.attach_file').on( 'change', uploadFiles);

  });

  function uploadFiles(){
      //로딩이미지
      $(this).parent().find('.loading').show();
      var ele_id = $(this).attr('id');
      var id = '<%=Model.Id%>';

      var data = new FormData();
      data.append('file', $(this)[0].files[0]);
      data.append('uploadType',ele_id);
      data.append('id',id);
      $.ajax({
          url: "<%=defaultPath%>/Upload.asp",
          type: 'POST',
          data: data,
          dataType: 'json',
          processData: false,
          contentType: false,
          mimeType: 'multipart/form-data',
          success: function(data){
              if(data.link){
                  $("#"+ele_id+"_RealName").val(data.realFilename);
                  $("#"+ele_id).parent().find('.message').text("upload success!");
              }else{
                  $("#"+ele_id).parent().find('.message').text("upload failed!");
              }
              $('.loading').hide();
          }
      });
  }
</script>