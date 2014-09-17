<?php
/**
 * Comment Model Class
 *
 * @category  Model
 * @package   Comment
 * @author    Gongjam <guruahn@gmail.com>
 * @copyright Copyright (c) 2014
 * @license   http://opensource.org/licenses/gpl-3.0.html GNU Public License
 * @version   1.0
 **/

class Comment extends Model {
    /*
	* Get a comment
	* @param
	* @return array
	*/
    public function getComment($column = "*", $where = null)
    {
        if( is_array($where) && !is_null($where) )
        {
            foreach($where as $key => $value)
            {
                $this->where($key,$value);
            }
            $comment = $this->getOne("comment", $column);
        }else{
            $comment = $this->get("comment", $column);

        }
        return	$comment;
    }

    /*
     * Get list
     * @param
     * @return array
     */
    public function getList($orderby = null, $limit, $where = null) {
        if( !is_null($orderby) && is_array($orderby) ){
            foreach($orderby as $key => $value){
                $this->orderBy($key,$value);
            }
        }
        if( !is_null($where) && is_array($where) ){
            foreach($where as $key => $value){
                $this->where($key,$value);
            }
        }
        $comments = $this->get('comment', $limit);
        return $comments;
    }

    /*
    * add comment
    * @param
    * @return array
    */
    public function add($data)
    {
        $id = $this->insert('comment', $data);
        return	$id;
    }

    /*
    * update comment
    * @param
    * @return array
    */
    public function updateComment($id, $data)
    {
        $this->where ('id', $id);
        return	$this->update('comment', $data);
    }

    /*
    * delete comment
    * @param
    * @return array
    */
    public function del($id)
    {
        $this->where ('id', $id);
        return	$this->delete('comment');
    }

}