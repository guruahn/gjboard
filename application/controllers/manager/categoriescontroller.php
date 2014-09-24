<?php
/**
 * CategoriesController Class
 *
 * @category  Controller
 * @package   category manager
 * @author    Gongjam <guruahn@gmail.com>
 * @copyright Copyright (c) 2014
 * @license   http://opensource.org/licenses/gpl-3.0.html GNU Public License
 * @version   1.0
 **/

class CategoriesController extends Controller {

    function view($id = null,$name = null) {
        $this->set('title',$name.' - GJboard View App');
        $this->set('post',$this->Post->getPost( "*", array("id"=>$id) ));

    }

    function view_all($type = "add", $thispage=1) {

        if(is_null($thispage)) $thispage = 1;
        $limit = array( ($thispage-1)*10, 10 );

        $categories = $this->Category->getList( array('register_date'=>'desc'), $limit );
        $this->set('title','All Categires - GJboard Manager App');
        $this->set('type', $type);
        $this->set('categories',$categories);

    }

    function editForm($id = null) {
        $this->set('title','Edit Category - GJboard App');
        $this->set('category',$this->Category->getCategory( "*", array("id"=>$id) ));
    }

    function edit($id = null) {

        $data = Array(
            "name" => trim(strval($_POST['name'])),
            "slug" => trim(strval($_POST['slug']))
        );
        $this->Category->updateCategory($id, $data);
        redirect(_BASE_URL_."/manager/categories/view_all");
    }

    function add() {
        $name = trim(strval($_POST['name']));
        $slug = trim(strval($_POST['slug']));
        $data = Array (
            "name" => $name,
            "slug" => $slug
        );
        $this->set('post',$this->Category->add($data));
        redirect(_BASE_URL_."/manager/categories/view_all");
    }

    function del($id = null) {

        if( $this->Category->del($id) ){
            msg_page('Success delete post.', _BASE_URL_."/manager/categories/view_all");
            exit;
        }else{
            msg_page('Cannot delete this post.');
            exit;
        }
    }

}