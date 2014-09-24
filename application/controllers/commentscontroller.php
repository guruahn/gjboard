<?php
/**
 * CommentController Class
 *
 * @category  Controller
 * @package   Comment
 * @author    Gongjam <guruahn@gmail.com>
 * @copyright Copyright (c) 2014
 * @license   http://opensource.org/licenses/gpl-3.0.html GNU Public License
 * @version   1.0
 **/

class CommentsController extends Controller {

    function view($id = null,$name = null) {
        $comment = $this->Post->getComment( "*", array("id"=>$id) );
        $user = new User();
        $comment['user_name'] = $user->getUser("name",array('user_id'=>$comment["user_id"]));
        $this->set('comment',$comment);
    }

    function view_all($post_id = null, $thispage=1) {

        if(is_null($thispage)) $thispage = 1;
        $limit = Array( ($thispage-1)*10, 10 );
        $where = Array(
            "post_id" => $post_id,
            "parent_id" => 0,
            "is_approved" => "Y"
        );

        $comments = $this->Comment->getList( array('register_date'=>'asc'), $limit, $where );
        $count = count($comments);
        for( $i=0 ; $i < count($comments) ; $i++ ){
            $where['parent_id'] = $comments[$i]['id'];
            $reply_comments = $this->Comment->getList( array('register_date'=>'asc'), $limit, $where );
            if( count($reply_comments) > 0 )  {
                $comments[$i]['children'] = $reply_comments;
                $count += count($reply_comments);
            }
        }

        if( $count > 0 ){
            $this->set('comments', $comments);
            $this->set('count', $count);
        }


    }

    function add(){
        $result = array(
            'result'=>0,
            'message'=>'',
            'comment'=>''
        );

        //Check login
        if(!is_login()){
            $result['message'] = 'After login you can use.';
            echo json_encode($result);
            exit;
        }

        if( !isset($_POST['name']) || !isset($_POST['email']) || !isset($_POST['content']) ){
            $result['message'] = 'You missed a required field.';
            echo json_encode($result);
            exit;
        }
        $data = Array (
            "name" => $_POST['name'],
            "email" => $_POST['email'],
            "website" => (isset($_POST['website']) ? $_POST['website'] : ""),
            "content" => $_POST['content'],
            "post_id" => $_POST['post_id'],
            "user_id" => (isset($_POST['user_id']) ? $_POST['user_id'] : ""),
            "parent_id" => $_POST['parent_id'],
            "is_approved" => (isset($_POST['is_approved']) ? $_POST['is_approved'] : "N"),
            "register_date" => date("Y-m-d H:i:s"),
            "ip" => $_SERVER['SERVER_ADDR']
        );
        $id = $this->Comment->add($data);
        if($id){
            $result['result'] = 1;
            echo json_encode($result);
        }

    }

    function del($id){
        if(!is_login()){
            msg_page('After login you can use.', _BASE_URL_."/users/loginForm");
            exit;
        }
        if( $this->Comment->del($id) ){
            msg_page('Success delete post.');
            exit;
        }else{
            msg_page('Cannot delete this post.');
            exit;
        }
    }

    function edit() {

        $result = array(
            'result'=>0,
            'message'=>'',
            'comment'=>''
        );
        //Check login
        if(!is_login()){
            $result['message'] = 'After login you can use.';
            echo json_encode($result);
            exit;
        }

        $id = $_POST['comment-id'];

        $comment = $this->Comment->getComment( "*", array("id"=>$id) );
        //Check permissions
        if($_SESSION['LOGIN_ID'] != $comment['user_id']){
            $result['message'] = 'You do not have permission to access.';
            echo json_encode($result);
            exit;
        }
        $data = Array(
            "name" => $_POST['name'],
            "email" => $_POST['email'],
            "website" => $_POST['website'],
            "content" => $_POST['content']
        );
        if($comment){
            $result['result'] = $this->Comment->updateComment($id, $data);
        }
        echo json_encode($result);
    }

}