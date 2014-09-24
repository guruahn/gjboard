<?php
/**
 * User Model Class
 *
 * @category  Model
 * @package   User
 * @author    Gongjam <guruahn@gmail.com>
 * @copyright Copyright (c) 2014
 * @license   http://opensource.org/licenses/gpl-3.0.html GNU Public License
 * @version   1.0
 **/

class User extends Model {
    /*
	* Get a user
	* @param
	* @return array
	*/
    public function getUser($column = "*", $where = null)
    {
        if( is_array($where) && !is_null($where) )
        {
            foreach($where as $key => $value)
            {
                $this->where($key,$value);
            }
            $user = $this->getOne("user", $column);
        }else{
            $user = $this->get("user", $column);

        }
        return	$user;
    }

   /*
    * add post
    * @param
    * @return array
    */
    public function add($data)
    {
        $id = $this->insert('user', $data);
        return	$id;
    }

    /*
    * update post
    * @param
    * @return array
    */
    public function update($id, $data)
    {
        $this->where ('id', $id);
        return	$this->update('user', $data);;
    }
}