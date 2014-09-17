<?php
/**
 * User add
 *
 * @category  View
 * @package   user
 * @author    Gongjam <guruahn@gmail.com>
 * @copyright Copyright (c) 2014
 * @license   http://opensource.org/licenses/gpl-3.0.html GNU Public License
 * @version   1.0
 **/
?>

</head>
<body>

<div id="wrapper">
    <h2><?php echo $title;?></h2>
    <form action="<?php echo _BASE_URL_;?>/users/add" method="post" name="joinForm">
        <input type="hidden" name="ip" value="<?php echo $_SERVER['SERVER_ADDR']; ?>" />
        <input type="hidden" name="referer" value="<?php echo $_SERVER['HTTP_REFERER']; ?>" />
        <ul>

            <li>
                <label for="user_id">ID</label>
                <input name="user_id" id="user_id" type="text" size="30" value="" />
            </li>
            <li>
                <label for="name">name</label>
                <input name="name" id="name" type="text" size="30" value="" />
            </li>
            <li>
                <label for="password">password</label>
                <input name="password" id="password" type="text" size="30" value="" />
            </li>
            <li>
                <label for="repassword">repeat password</label>
                <input name="repassword" id="repassword" type="text" size="30" value="" />
            </li>
            <li>
                <label for="email">email</label>
                <input name="email" id="email" type="text" size="30" value="" />
            </li>
            <li>
                <label for="profile">profile</label>
                <textarea name="profile" id="profile" size="80" >

                </textarea>
            </li>
        </ul>
        <p><input type="submit" value="submit" /> </p>
    </form>
</div>