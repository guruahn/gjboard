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
        $this->set('title','All Posts - GJboard Manager App');

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
        $this->set('title','write  post - GJboard writeform App');
    }

    function addPost() {
        $title = $_POST['title'];
        $data = Array (
            "title" => $title
        );
        $this->set('post',$this->Post->add($data));
        redirect(_BASE_URL_."/posts/viewall");
    }

    function delete($id = null) {
        $this->set('result',$this->Item->query('delete from post where id = \''.mysql_real_escape_string($id).'\''));
    }

    function edit($id = null) {
        $this->set('title','Edit Post - GJboard App');
        $this->set('post',$this->Post->getPost( "*", array("id"=>$id) ));
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
            $upfile = file_upload($file['file']['tmp_name'], "board_".$_POST['id']."_".$file['file']['name'], "..".UPLOAD_PATH."/".date("Y")."/".date("m")."/", 1);
            if($upfile){
                $result['result'] = 1;
                $result['link'] = UPLOAD_PATH."/".date("Y")."/".date("m")."/".$upfile;
            }
            //thumbnail($path."/".$upfile, $path."/thumb_".$upfile, 120, 100, 1);
        }

        if($is_API){
            echo json_encode($result);
        }else{
            return $upfile;
        }
    }
}