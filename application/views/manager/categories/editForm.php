<?php
/**
 * Category Edit
 *
 * @category  View
 * @package   category
 * @author    Gongjam <guruahn@gmail.com>
 * @copyright Copyright (c) 2014
 * @license   http://opensource.org/licenses/gpl-3.0.html GNU Public License
 * @version   1.0
 **/

$obj_category = (object) $category;
?>

<div id="wrapper" class="row small-11 small-centered columns">
    <h2><?php echo $title; ?></h2>
    <div class="category-form radius small-5 columns">
            <form id="editForm" action="<?php echo _BASE_URL_;?>/manager/categories/edit/<?php echo $obj_category->id; ?>" method="post" data-abide>
                <label>Category name <small>required</small>
                    <input name="name" type="text" value="<?php echo $obj_category->name; ?>" />
                </label>
                <small class="error">Name is required.</small>
                <label>Category slug <small>required</small>
                    <input name="slug" type="text" value="<?php echo $obj_category->slug; ?>" />
                </label>
                <small class="error">Slug is required.</small>
                <p class="button-group radius">
                    <span><button class="radius tiny">Edit</button></span>
                </p>
            </form>

    </div>

</div><!--//#wrapper-->