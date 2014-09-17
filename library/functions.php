<?php
/*
* Checked Image
*/
function is_image($mime) {
    $A_mime = array('image/jpg', 'image/jpeg', 'image/pjpg', 'image/pjpeg', 'image/png', 'image/gif', 'image/x-png');
    if (in_array($mime, $A_mime)) {
        return TRUE;
    }else {
        return FALSE;
    }
}

/**
* 텍스트 일정한 길이로 자르기
*/

function text_cut_utf8($str, $len, $tail = '...') {
    $str = strip_tags($str);
    $var = mb_strimwidth($str, 0, $len, "…", "UTF-8");
return $var;
}

function text_cut_with_tag($str, $len, $tail = '...') {
    $str = strip_tags($str, '<i><b>');
    $var = mb_strimwidth($str, 0, $len, "…", "UTF-8");
    return $var;
}

/**
* array or obj return to html
*/
function getPrintr($var, $title = null){
    $dump = '';
    $dump .=  '<div align="left">';
    $dump .=  '<pre style="background-color:#000; color:#00ff00; padding:5px; font-size:14px;">';
    if( $title ){
        $dump .=  "<strong style='color:#fff'>{$title} :</strong> \n";
    }
    $dump .= print_r($var, TRUE);
    $dump .=  '</pre>';
    $dump .=  '</div>';
    $dump .=  '<br />';
    return $dump;
}

/**
* array or obj print to html
*/
function printr($var, $title = null){
    $dump = getPrintr($var, $title);
    echo $dump;
}

/**
* array or obj print to html and exit
*/
function printr2($var, $title = null){
    printr($var, $title);
    exit;
}

/**
 * redirect
 */
function redirect($url, $statusCode = 303)
{
    header('Location: ' . $url, true, $statusCode);
    die();
}

/**
 * password
 */
function db_password($val){
    echo db_result("select password('$val')");
    exit;
    return db_result("select password('$val')");
}

function is_login(){
    if( !isset($_SESSION['LOGIN_NO']) || !isset($_SESSION['LOGIN_ID']) ) {
        return false;
    }else{
        return true;
    }
}
/**
 * popup message and redirect
 */
function msg_page($msg, $url=""){
    if($url==""){
        $url="history.go(-1)";
    }else if($url=="close"){
        $url="window.close()";
    }else{
        $url="document.location.href='$url'";
    }

    echo "<script type='text/javascript'>alert('$msg');$url;</script>";
    exit;
}
/**
 * file upload
 */
function file_upload($file, $file_name, $ext, $path, $change="2"){

    $org_name = str_replace(".".$ext, "", $file_name);
    $org_name = str_replace(" ", "_", $org_name);

    $file_list = array ('html','htm','php','phtml','php3','php4','php5','asp','jsp', 'exe', 'js','cgi','inc','pl'); // 금지 파일 항목

    // 금지 파일인지 아닌지 확인 시작
    if(in_array($ext, $file_list)){
        echo "<script>alert('This file can not upload.');history.go(-1);</script>";
        exit;
    }
    if(!is_dir($path)){
        if (!mkdir($path, 0777, true)) {
            die('Failed to create folders...');
        }
        chmod($path, 0777);
    }

    $tmp_filename = ($change==1 ? $org_name.".".$ext : time().".".$ext);

    $i = 1;
    while(file_exists($path."/".$tmp_filename)){
        $tmp_filename = ($change==1 ? $org_name."_".$i.".".$ext : time().".".$ext);
        $i++;
    }

    if(!move_uploaded_file($file, "$path/$tmp_filename")){
        echo "file upload Error!! Please contact the system administrator.";
        exit;
    }
    return $tmp_filename;
}

/**
 * make thumbnail image and save
 */
function thumbnail($file, $save_filename, $max_width=100, $max_height=100, $sizeChg=1){

    $img_info=@getimagesize($file);//이미지 사이즈를 확인합니다.

    //이미지 타입을 이용해 변수를 재지정해줍니다.
    //------------------------------------------------------
    // Imagetype Constants
    //------------------------------------------------------
    // 1 IMAGETYPE_GIF
    // 2 IMAGETYPE_JPEG
    // 3 IMAGETYPE_PNG
    // 4 IMAGETYPE_SWF
    // 5 IMAGETYPE_PSD
    // 6 IMAGETYPE_BMP
    // 7 IMAGETYPE_TIFF_II (intel byte order)
    // 8 IMAGETYPE_TIFF_MM (motorola byte order)
    // 9 IMAGETYPE_JPC
    // 10 IMAGETYPE_JP2
    // 11 IMAGETYPE_JPX
    // 12 IMAGETYPE_JB2
    // 13 IMAGETYPE_SWC
    // 14 IMAGETYPE_IFF
    // 15 IMAGETYPE_WBMP
    // 16 IMAGETYPE_XBM
    //------------------------------------------------------


    if($img_info[2]==1) $src_img=ImageCreateFromGIF($file);
    elseif($img_info[2]==2) $src_img=ImageCreateFromJPEG($file);
    elseif($img_info[2]==3) $src_img=ImageCreateFromPNG($file);
    elseif($img_info[2]==4) $src_img=ImageCreateFromWBMP($file);
    else return false;

    $img_info = getImageSize($file);//원본이미지의 정보를 얻어옵니다
    $img_width = $img_info[0];
    $img_height = $img_info[1];

    $crt_width=$max_width;  //생성되면 이미지 사이즈
    $crt_height=$max_height;

    //1.가로 세로 원본비율을 맞추고, 남은 영역에 색채워서 정해진 크기로 생성
    if($sizeChg==1){

        if(($img_width/$max_width) == ($img_height/$max_height)){ //원본과 썸네일의 가로세로비율이 같은경우
            $dst_x = 0;
            $dst_y = 0;
            $dst_width=$max_width;
            $dst_height=$max_height;
        }
        elseif(($img_width/$max_width) < ($img_height/$max_height)){ //세로에 기준을 둔경우
            $dst_x= ($max_width - $img_width*($max_height/$img_height) ) / 2;
            $dst_y = 0;

            $dst_width=$max_height*($img_width/$img_height);
            $dst_height=$max_height;
        }
        else{ //가로에 기준을 둔경우
            $dst_x= 0;
            $dst_y = ($max_height - $img_height*($max_width/$img_width) ) / 2;

            $dst_width=$max_width;
            $dst_height=$max_width*($img_height/$img_width);
        }


        //2.가로 세로 원본비율을 맞추고, 남은 영역없이 이미지만 컷 생성
    }else if($sizeChg==2){

        if(($img_width/$max_width) == ($img_height/$max_height)){ //원본과 썸네일의 가로세로비율이 같은경우
            $dst_width=$max_width;
            $dst_height=$max_height;
        }
        elseif(($img_width/$max_width) < ($img_height/$max_height)){ //세로에 기준을 둔경우
            $dst_width=$max_height*($img_width/$img_height);
            $dst_height=$max_height;
        }
        else{//가로에 기준을 둔경우
            $dst_width=$max_width;
            $dst_height=$max_width*($img_height/$img_width);
        }

        $dst_x= 0;
        $dst_y = 0;

        $crt_width=$dst_width;
        $crt_height=$dst_height;


        //3.가로 세로 원본비율을 맞추지 않고, 정해진 크기대로 생성
    }else{

        $dst_width=$max_width;
        $dst_height=$max_height;

        $dst_x= 0;
        $dst_y = 0;
    }

    $dst_img = imagecreatetruecolor($crt_width, $crt_height); //타겟이미지를 생성합니다

    $white = imagecolorallocate($dst_img,255,255,255);
    imagefill($dst_img, 0, 0, $white);

    ImageCopyResized($dst_img, $src_img, $dst_x, $dst_y, 0, 0, $dst_width, $dst_height, $img_width, $img_height); //타겟이미지에 원하는 사이즈의 이미지를 저장합니다
    ImageInterlace($dst_img);

    switch ($img_info[2]){
        case "1" : ImageGIF($dst_img,  $save_filename); break;
        case "2" : ImageJPEG($dst_img,  $save_filename); break;
        case "3" :
            imagealphablending($dst_img, false);
            imagecopyresampled($dst_img, $src_img, $dst_x, $dst_y, 0, 0, $dst_width, $dst_height, $img_width, $img_height); //(생성이미지,원소스이미지,시작점X,시작점Y,원본소스상 시작점X,원본소스상 시작점Y,생성이미지너비, 생성이미지높이,원이미지너비,원이미지높이)
            imagesavealpha($dst_img, true);
            ImagePNG($dst_img,  $save_filename,0);
            break;

        case "4" : ImageWBMP($dst_img,  $save_filename); break;
    }

    ImageDestroy($dst_img);
    ImageDestroy($src_img);
}