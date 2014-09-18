<?php
/**
 * Post View
 *
 * @category  View
 * @package   post
 * @author    Gongjam <guruahn@gmail.com>
 * @copyright Copyright (c) 2014
 * @license   http://opensource.org/licenses/gpl-3.0.html GNU Public License
 * @version   1.0
 **/
$obj_post = (object) $post;
?>
</head>
<body>
    <div id="wrapper">
        <div id="content">
            <h2><?php echo $obj_post->title?></h2>
            <ul>

                <li>
                    <span>Writer : </span>
                    <span><?php echo $obj_post->user_id; ?></span>
                </li>
                <li>
                    <span>category : </span>
                    <input name="category_id" id="category_id" type="text" size="30" value="<?php echo $obj_post->category_id; ?>" />
                </li>
                <li>
                    <span>content :</span>
                    <div><?php echo $obj_post->content; ?></div>
                </li>
                <li>
                    <span>tags : </span>
                    <span><?php echo $obj_post->tags; ?></span>
                </li>
                <li>
                    <span>is notice :</span>
                    <span><?php echo $obj_post->is_notice; ?></span>
                </li>
                <li>
                    <span>is secret yes</span>
                    <span><?php echo $obj_post->is_secret; ?></span>
                </li>
                <li>
                    <span>modify date</span>
                    <span><?php echo $obj_post->modify_date; ?></span>
                </li>
            </ul>
            <a href="/posts/edit/<?php echo $obj_post->id?>">
                <span>
                edit this post
                </span>
            </a>

            <a href="/posts/delete/<?php echo $obj_post->id?>">
                <span>
                Delete this post
                </span>
            </a>

            <a href="/posts/viewall/">
                <span>
                list post
                </span>
            </a>
        </div><!--//#content-->

        <div id="comment">
            <h3 id="reply-title" class="comment-reply-title">
                Reply
            </h3>
            <a href="#" class="comment_add" data-parent-id="0">add reply</a>
            <div id="comment-list"></div>
            <div id="add-comment-popup" style="display: none;">
                <form action="<?php echo _BASE_URL_;?>/comments/add" method="post" id="commentform" class="comment_form">
                    <?php
                    $type = "text";
                    if(is_login()) {
                        echo "by ".$_SESSION['LOGIN_NAME'];
                        $type = 'hidden';
                    }
                    ?>
                    <input id="name" name="name" type="<?php echo $type;?>" placeholder="Name (required)" value="<?php echo (is_login() ? $_SESSION['LOGIN_NAME'] : "");?>" size="30"  />
                    <input id="email" name="email" type="<?php echo $type;?>" placeholder="Email (required)" value="<?php echo (is_login() ? $_SESSION['LOGIN_EMAIL'] : "");?>" size="30" />
                    <input id="website" name="website" type="text" placeholder="Website" value="" size="30">
                    <p class="comment_form_comment">
                        <textarea id="content" placeholder="Comment..." name="content" cols="45" rows="8" ></textarea>
                    </p>
                    <p class="form-submit">
                        <input name="submit" type="submit" id="submit-comment" value="Submit">
                        <input type="hidden" name="post_id" value="<?php echo $obj_post->id?>" id="post_id">
                        <input type="hidden" name="parent_id" value="0" id="parent_id">
                        <?php
                        if(is_login()) echo '<input type="hidden" name="user_id" id="user_id" value="'.$_SESSION['LOGIN_ID'].'">';
                        ?>

                    </p>
                </form>
            </div><!--//#comment-list-->

            <?php
            if( is_login() ){
            ?>
            <div id="edit-comment-popup" style="display: none;">
                <a href="#" class="b-close">close</a>
                <form action="<?php echo _BASE_URL_;?>/comments/edit/" method="post" id="commentEditform" class="comment_edit_form">
                    <h4>by <?php echo "by ".$_SESSION['LOGIN_NAME']; ?></h4>
                    <input id="name" name="name" type="hidden" placeholder="Name (required)" value="<?php echo (is_login() ? $_SESSION['LOGIN_NAME'] : "");?>" size="30" />
                    <input id="email" name="email" type="hidden" placeholder="Email (required)" value="<?php echo (is_login() ? $_SESSION['LOGIN_EMAIL'] : "");?>" size="30" />
                    <input id="website" name="website" type="text" placeholder="Website" value="" size="30">
                    <p class="comment_form_comment">
                        <textarea id="content" placeholder="Comment..." name="content" cols="45" rows="8" ></textarea>
                    </p>
                    <p class="form-submit">
                        <input name="submit" type="submit" id="submit-edit-comment" value="Submit">
                        <input type="hidden" name="comment-id" value="" />
                    </p>
                </form>
            </div><!--//#edit-comment-popup-->
            <?php }?>
        </div><!--//#comment-->
    </div><!--//#wrapper-->

    <script src="http://code.jquery.com/jquery-1.10.2.js"></script>
    <script src="<?php echo _BASE_URL_;?>/public/js/jquery.bpopup.min.js"></script>
    <script src="<?php echo _BASE_URL_;?>/public/js/functions.js"></script>
    <script>
        $(function(){
            getComments(<?php echo $obj_post->id?>, 1, "comment-list");

            //commetn add form popup
            $('#comment').on('click', '.comment_add', function(){
                var parent_id = $(this).attr('data-parent-id');
                popupAddComment(parent_id);
                return false;
            });
            //comment edit form popup
            $('#comment-list').on('click', '.comment_edit', function(){
                var comment_id = $(this).attr('data-id');
                var comment_obj = $('#comment-'+comment_id)
                var comment_content = $(comment_obj).find('.comment').text();
                var website = $(comment_obj).find('.user').attr('href');
                popupEditComment(website, comment_id, comment_content);
                return false;
            });

            //comment edit
            $('#commentEditform').submit(function(){
                var data = $(this).serializeArray();
                //console.log(printr_json(postData));
                var action = $(this).attr("action");
                actionComments(action, data, "commentEditform");
                return false;
            });

            //comment add
            $('#commentform').submit(function(){
                var data = $(this).serializeArray();
                var action = $(this).attr("action");
                actionComments(action, data, "commentform");
                return false;
            });

        });

        function popupAddComment(parent_id){
            $('#add-comment-popup').bPopup({
                closeClass:'b-close',
                modalClose: false,
                transitionClose: 'fadeIn',
                speed: 250,
                zIndex: 9000,
                position :['auto','auto'],
                follow: [false, false],
                //positionStyle : 'absolute',
                onOpen: function() {
                    $('#add-comment-popup input[name=parent_id]').val(parent_id);
                }
            });
        }

        function popupEditComment(website, comment_id, comment_content){
            $('#edit-comment-popup').bPopup({
                closeClass:'b-close',
                modalClose: false,
                transitionClose: 'fadeIn',
                speed: 250,
                zIndex: 9000,
                position :['auto','auto'],
                follow: [false, false],
                //positionStyle : 'absolute',
                onOpen: function() {
                    $('#edit-comment-popup input[name=comment-id]').val(comment_id);
                    $('#edit-comment-popup input[name=website]').val(website);
                    $('#edit-comment-popup textarea[name=content]').html(comment_content);
                }
            });
        }
        function getComments(post_id, thispage, target){
            //console.log(data);
            $.ajax({
                type: "POST",
                url: "<?php echo _BASE_URL_;?>/comments/viewall/"+post_id+"/"+thispage,
                dataType: "html"
            }).success(function( data ) {
                if(data){
                    $('#'+target).html(data);
                }
            }).fail(function(response){
                //console.log(printr_json(response));
            });
        }

        function actionComments(action, data, target){
            //console.log(data);
            $.ajax({
                type: "POST",
                url: action,
                data: data,
                dataType: "json"
            }).success(function( data ) {
                if(data.result){
                    getComments(<?php echo $obj_post->id?>, 1, "comment-list");
                    $('#'+target).bPopup().close();
                }else{
                    alert(data.message);
                }
            }).fail(function(response){
                console.log(printr_json(response));
            });
        }

    </script>