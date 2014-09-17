<?php
/**
 * UsersController Class
 *
 * @category  Controller
 * @package   user
 * @author    Gongjam <guruahn@gmail.com>
 * @copyright Copyright (c) 2014
 * @license   http://opensource.org/licenses/gpl-3.0.html GNU Public License
 * @version   1.0
 **/

class UsersController extends Controller {

    function view($id = null,$name = null) {
        $this->set('title',$name.' - GJboard View App');
        $this->set('post',$this->Post->getPost( "*", array("id"=>$id) ));

    }

    function joinForm() {
        $this->set('title','join user - GJboard App');
    }

    function add() {
        $referer = (isset($_POST['referer'])? $_POST['referer'] : _BASE_URL_."/posts/viewall" );

        if( !trim($_POST['name']) || !trim($_POST['user_id']) || !trim($_POST['password']) ){
            msg_page("Required fields are missing.");
        }

        $data = Array(
            "user_id" => trim(strval($_POST['user_id'])),
            "name" => trim(strval($_POST['name'])),
            "password" => $this->User->func('SHA1(?)', Array( trim(strval($_POST['password'])).SALT) ),
            "email" => trim(strval($_POST['email'])),
            "profile" => trim(strval($_POST['profile'])),
            "register_date" => date("Y-m-d H:i:s")
        );
        $this->User->getUser("id", array("user_id"=>$data['user_id']));
        if( $this->User->count > 0 ){
            msg_page("ID is already subscribed.");
        }
        $this->User->getUser("id", array("email"=>$data['email']));
        if( $this->User->count > 0 ){
            msg_page("email is already subscribed.");
        }

        $id = $this->set('user',$this->User->add($data));
        redirect($referer);
    }

    function loginForm() {
        $this->set('title','login user - GJboard Manager App');
    }

    function login() {
        printr($_POST['referer']);
        $referer = (isset($_POST['referer']) && !empty($_POST['referer']) ? $_POST['referer'] : _BASE_URL_."/manager/posts/viewall" );

        if( !trim($_POST['user_id']) || !trim($_POST['password']) ){
            msg_page("Required fields are missing.");
        }

        $data = Array(
            "user_id" => trim(strval($_POST['user_id'])),
            "password" => SHA1( $_POST['password'].SALT )
        );

        $user = $this->User->getUser("*", $data);
        if( $this->User->count > 0 ){
            if( $user['level'] >= 5){
                $_SESSION['LOGIN_NO'] = $user["id"];
                $_SESSION['LOGIN_ID'] = $user["user_id"];
                $_SESSION['LOGIN_NAME'] = $user["name"];
                $_SESSION['LOGIN_EMAIL'] = $user["email"];
                $_SESSION['LOGIN_LEVEL'] = $user["level"];

                /*check is save id */
                $is_save_id =  ( isset($_POST['is_save_id']) ? trim(strval($_POST['is_save_id'])) : "N");
                if($is_save_id == "Y"){
                    setcookie("is_save_id", "Y" , time()+60*60*24*365,"/");
                    setcookie("LOGIN_ID", $user['user_id'] , time()+60*60*24*365,"/");
                }else{
                    setcookie("is_save_id", "" , time()+60*60*24*365,"/");
                }
            }else{
                msg_page("You do not have permission to access.");
            }
        }else{
            msg_page("information does not match.");
        }
        printr($referer);
        redirect($referer);
    }

    function logout(){
        $referer = (isset($_POST['referer'])? $_POST['referer'] : _BASE_URL_."/posts/viewall" );
        unset($_SESSION['LOGIN_NO']);
        unset($_SESSION['LOGIN_ID']);
        unset($_SESSION['LOGIN_NAME']);
        unset($_SESSION['LOGIN_EMAIL']);
        unset($_SESSION['LOGIN_LEVEL']);
        redirect($referer);
    }

    function uploadFile($file = null) {
        global $is_API;
        if(is_null($file)) $file = $_FILES;
        $result = array(
            'result'=>0,
            'link'=>''
        );
        if($file['file']['name']) {
            $upfile = file_upload($file['file']['tmp_name'], "user_".$_POST['id']."_".$file['file']['name'], "..".UPLOAD_PATH."/".date("Y")."/".date("m")."/", 1);
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