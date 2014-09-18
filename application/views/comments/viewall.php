<?php
/**
 * Comment List
 *
 * @category  View
 * @package   Comment
 * @author    Gongjam <guruahn@gmail.com>
 * @copyright Copyright (c) 2014
 * @license   http://opensource.org/licenses/gpl-3.0.html GNU Public License
 * @version   1.0
 **/

if(isset($comments)){
    echo "<p>".$count." comments</p>";
    foreach ( $comments as $comment ){
        $obj_comment = (object) $comment;
    ?>
        <div id="comment-<?php echo $obj_comment->id; ?>">
            <a class="user" href="<?php echo $obj_comment->website; ?>">
                <?php echo $obj_comment->name; ?>
            </a>

            <div class="comment"><?php echo $obj_comment->content; ?></div>
            <p>
                <span><?php echo $obj_comment->register_date; ?> written</span>
                <?php
                if(is_login() && $_SESSION['LOGIN_ID'] == $obj_comment->user_id ){
                    echo '<span><a href="'._BASE_URL_.'/comments/del/'.$obj_comment->id.'">del</a></span>';
                    echo '<span><a href="#" class="comment_edit" data-id="'.$obj_comment->id.'" >edit</a></span>';
                }
                ?>
                <span><a href="#" class="comment_add" data-parent-id="<?php echo $obj_comment->id; ?>">add reply</a></span>
            </p>
            <?php
            if(isset($obj_comment->children)){
                foreach ( $obj_comment->children as $children ){
                    $obj_children = (object) $children;
            ?>
                    <div id="comment-<?php echo $obj_children->id; ?>" class="child" style="padding-left:20px;">
                        <a class="user" href="<?php echo $obj_children->website; ?>">
                            <?php echo $obj_children->name; ?>
                        </a>
                        <div class="comment"><?php echo $obj_children->content; ?></div>
                        <p>
                            <span><?php echo $obj_children->register_date; ?> written</span>
                            <?php
                            if(is_login() && $_SESSION['LOGIN_ID'] == $obj_children->user_id ){
                                echo '<span><a href="'._BASE_URL_.'/comments/del/'.$obj_children->id.'">del</a></span>';
                                echo '<span><a href="#" class="comment_edit" data-id="'.$obj_children->id.'">edit</a></span>';
                            }
                            ?>
                        </p>
                    </div>
            <?php
                }
            }
            ?>
        </div>
    <?php
    }

}