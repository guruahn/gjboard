<?php
/**
 * PostsController Class
 *
 * @category  Controller
 * @package   Posts
 * @author    Gongjam <guruahn@gmail.com>
 * @copyright Copyright (c) 2014
 * @license   http://opensource.org/licenses/gpl-3.0.html GNU Public License
 * @version   1.0
 **/

class PostsController extends Controller {

    function view($id = null,$name = null) {
        $this->set('title',$name.' - GJboard View App');
        $post = $this->Post->getPost( "*", array("id"=>$id) );
        $user = new User();
        $post['user_name'] = $user->getUser("name",array('user_id'=>$post["user_id"]));
        $this->set('post',$post);

    }

    function viewall($thispage=1) {
        global $is_API;
        $result = array(
            'result'=>0,
            'message'=>'failed get feed',
            'feed_list'=>''
        );

        if(is_null($thispage)) $thispage = 1;
        $limit = array( ($thispage-1)*10, 10 );

        $posts = $this->Post->getList( array('publish_date'=>'desc'), $limit );
        $this->set('title','All Posts - GJboard App');

        if(count($posts) > 0 ){
            $result['result'] = 1;
            $result['message'] = 'total '.count($posts).' posts';
            $result['post_list'] = $posts;
        }
        if($is_API){
            echo json_encode($result);
        }else{
            $this->set('posts',$posts);
        }

    }

    function writeForm() {
        if(!is_login()){
            msg_page('After login you can use.', _BASE_URL_."/users/loginForm");
            exit;
        }
        $this->set('title','write  post - GJboard writeform App');
    }

    function add() {
        $title = $_POST['title'];
        $data = Array (
            "title" => $title
        );
        $this->set('post',$this->Post->add($data));
        redirect(_BASE_URL_."/posts/viewall");
    }

    function del($id = null) {
        if(!is_login()){
            msg_page('After login you can use.', _BASE_URL_."/users/loginForm");
            exit;
        }

        if( $this->Post->del($id) ){
            msg_page('Success delete post.', _BASE_URL_."/posts/viewall");
            exit;
        }else{
            msg_page('Cannot delete this post.');
            exit;
        }
    }

    function edit($id = null) {
        if(!is_login()){
            msg_page('After login you can use.', _BASE_URL_."/users/loginForm");
            exit;
        }

        $this->set('title','Edit Post - GJboard App');
        $post = $this->Post->getPost( "*", array("id"=>$id) );
        if($_SESSION['LOGIN_ID'] != $post['user_id']){
            msg_page('You do not have permission to access.', _BASE_URL_."/posts/view/".$id);
            exit;
        }
        $this->set('post',$post);
    }

    function updatePost($id = null) {

        $data = Array(
            "title" => trim(strval($_POST['title'])),
            "category_id" => $_POST['category_id'],
            "content" => trim(strval($_POST['content'])),
            "tags" => trim(strval($_POST['tags'])),
            "is_notice" => trim(strval($_POST['is_notice'])),
            "is_secret" => trim(strval($_POST['is_secret'])),
            "ip" => trim(strval($_POST['ip'])),
            "modify_date" => date("Y-m-d H:i:s",strtotime($_POST['modify_date']))
        );
        $this->Post->updatePost($id, $data);
        redirect(_BASE_URL_."/posts/viewall");
    }

    function uploadFile($file = null) {
        global $is_API;
        if(is_null($file)) $file = $_FILES;
        $result = array(
            'result'=>0,
            'link'=>''
        );
        if($file['file']['name']) {
            $file_check = explode(".", $file['file']['name']);
            $ext = strtolower($file_check[count($file_check)-1]);					// 파일 확장자 구하기
            $upfile = file_upload($file['file']['tmp_name'], "board_".date("YmdHis").rand(1000,9999), $ext, "..".UPLOAD_PATH."/".date("Y")."/".date("m")."/", 1);
            if($upfile){
                $result['result'] = 1;
                $result['link'] = UPLOAD_PATH."/".date("Y")."/".date("m")."/".$upfile;
                $result['filename'] = $upfile;
            }
            //thumbnail($path."/".$upfile, $path."/thumb_".$upfile, 120, 100, 1);
            $post_id = (isset($_POST['id']) ? $_POST['id'] : "");
            $is_thumbnail = (isset($_POST['is_thumbnail']) ? $_POST['is_thumbnail'] : "N");
            if( !$this->addAttachment($post_id, $is_thumbnail, $file, $upfile, $result['link']) ) {
                $result['result'] = 0;
                $result['message'] = "file information update failed!";
            }
        }

        if($is_API){
            echo json_encode($result);
        }else{
            return $result;
        }
    }

    function loadFile($post_id = null, $user_id = null){
        global $is_API;

        $where = Array(
            "post_id" => $post_id,
            "user_id" => $user_id
        );
        $data = null;

        $files = $this->Post->getAttachment("url", $where);
        if($is_API){
            echo json_encode($files);
        }else{
            return $files;
        }

    }

    function deleteFile(){
        $result = array(
            'result'=>0
        );

        $src = $_POST['src'];
        $path = getcwd();
        $path = str_replace( "\\public", "", $path );

        $real_path = realpath($path.$src);
        // Check if file exists.
        if (file_exists($real_path)) {
            // Delete file.
            if(unlink($real_path)){
                //database delete...
                if( $this->Post->delAttachment( Array("url" => $src)) ) $result['result'] = 1;
            }
        }
        echo json_encode($result);
    }

    function addAttachment($post_id = "", $is_thumbnail = "N", $file = null, $name, $url) {
        if(is_null($file)) $file = $_FILES;
        $result = array(
            'result'=>0
        );

        $data = Array(
            "post_id" => $post_id,
            "user_id" => $_SESSION['LOGIN_ID'],
            "name" => $name,
            "original_name" => $file['file']['name'],
            "url" => $url,
            "mime" => $file['file']['type'],
            "size" => $file['file']['size'],
            "is_thumbnail" => $is_thumbnail,
            "register_date" => date("Y-m-d H:i:s"),
        );
        if( $this->Post->addAttachment($data) ) $result['result'] = 1;

        return $result;
    }
}