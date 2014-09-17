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
            <a href="<?php echo $obj_comment->website; ?>">
                <?php echo $obj_comment->name; ?>
            </a>

            <div class="comment"><?php echo $obj_comment->content; ?></div>
            <p><?php echo $obj_comment->register_date; ?> written</p>
            <?php
            if(isset($obj_comment->children)){
                foreach ( $obj_comment->children as $children ){
                    $obj_children = (object) $children;
            ?>
                    <div id="comment-<?php echo $obj_children->id; ?>" class="child" style="padding-left:20px;">
                        <a href="<?php echo $obj_children->website; ?>">
                            <?php echo $obj_children->name; ?>
                        </a>
                        <div class="comment"><?php echo $obj_children->content; ?></div>
                        <p><?php echo $obj_children->register_date; ?> written</p>
                    </div>
            <?php
                }
            }
            ?>
        </div>
    <?php
    }
}