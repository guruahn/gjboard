<?php
/**
 * Category Model
 *
 * @category  Model
 * @package   Category
 * @author    Gongjam <guruahn@gmail.com>
 * @copyright Copyright (c) 2014
 * @license   http://opensource.org/licenses/gpl-3.0.html GNU Public License
 * @version   1.0
 **/

class Category extends Model {
    /*
	* Get a category
	* @param
	* @return array
	*/
    public function getCategory($column = "*", $where = null)
    {
        if( is_array($where) && !is_null($where) )
        {
            foreach($where as $key => $value)
            {
                $this->where($key,$value);
            }
            $category = $this->getOne("category", $column);
        }else{
            $category = $this->get("category", $column);

        }
        return	$category;
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
        $category = $this->get('category', $limit);
        return $category;
    }

    /*
    * update category
    * @param
    * @return array
    */
    public function updateCategory($id, $data)
    {
        $this->where ('id', $id);
        return	$this->update('category', $data);
    }

    /*
    * add category
    * @param
    * @return array
    */
    public function add($data)
    {
        $id = $this->insert('category', $data);
        return	$id;
    }

    /*
    * delete category
    * @param
    * @return array
    */
    public function del($id)
    {
        $this->where ('id', $id);
        return	$this->delete('category');
    }

}