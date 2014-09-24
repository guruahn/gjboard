<?php
/**
 * Category list
 *
 * @category  View
 * @package   category
 * @author    Gongjam <guruahn@gmail.com>
 * @copyright Copyright (c) 2014
 * @license   http://opensource.org/licenses/gpl-3.0.html GNU Public License
 * @version   1.0
 **/

?>

<div id="wrapper" class="row small-11 small-centered columns">
    <h2><?php echo $title; ?></h2>
    <div class="category_list radius small-5 columns">
        <?php
        foreach($categories as $category):
            $obj_category = (object) $category;
            ?>
            <h3>
                <a href="<?php echo _BASE_URL_;?>/manager/categories/view/<?php echo $obj_category->id; ?>"><?php echo text_cut_utf8($obj_category->name, 70); ?></a>
            </h3>
            <p class="button-group radius">
                <span><a href="<?php echo _BASE_URL_;?>/manager/categories/editForm/<?php echo $obj_category->id; ?>" class="button radius secondary tiny">Edit</a></span>
                <span><a href="<?php echo _BASE_URL_;?>/manager/categories/del/<?php echo $obj_category->id; ?>" class="button radius secondary tiny">Del</a></span>
            </p>
        <?php
        endforeach;
        ?>

    </div>
    <div class="add-form-box radius small-5 columns">
        <h3>Add Category</h3>
        <form id="addForm" action="<?php echo _BASE_URL_;?>/manager/categories/add" method="post" data-abide>
            <label>Category name <small>required</small>
                <input name="name" type="text" value="" required />
            </label>
            <small class="error">Name is required.</small>
            <label>Category slug <small>required</small>
                <input name="slug" type="text" value="" required />
            </label>
            <small class="error">Slug is required.</small>
            <p class="button-group radius">
                <span><button class="radius tiny">Add</button></span>
            </p>
        </form>
    </div>

</div><!--//#wrapper-->