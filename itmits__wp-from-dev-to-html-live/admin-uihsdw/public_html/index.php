<?php
/*
MIT License

Copyright 2018 https://github.com/iamthemanintheshower - imthemanintheshower@gmail.com

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.
*/

require realpath(__DIR__ . '/../../../../../wp-load.php');

if(!is_user_logged_in){
    return false;
}

if(isset($_POST) &&

    //# FTP
    isset($_POST['ftp__host']) &&
    isset($_POST['ftp__user']) &&
    isset($_POST['ftp__password']) &&
    isset($_POST['ftp__destination_folder']) &&

    //# PROJECT
    isset($_POST['project_id']) &&
    isset($_POST['dev_website_protocol']) &&
    isset($_POST['dev_website_url']) &&
    isset($_POST['prod_website_url']) &&
    isset($_POST['cached_root'])){

    $_date = new DateTime();

    $project_id = $_POST['project_id'];
    $dev_website_protocol = $_POST['dev_website_protocol'];
    $dev_website_url = $dev_website_protocol.$_POST['dev_website_url'].'/'; //#URL of the DEV WP website
    $prod_website_url = $_POST['prod_website_url'].'/';
    $cached_root = $_POST['cached_root'].'/';

    if(!file_exists($cached_root)){
        @mkdir($cached_root);
    }
    $dev_website_url_js = _get_website_url_js($dev_website_url); //#Customized URL for the javascript part
    $dev_website_cache_dir = __DIR__. '/'.$cached_root.$project_id.'-'.$_date->format('Y-m-d_H_i_s');
    $cached_root_js = _get_website_url_js($cached_root); //'cached_\/';

    $_download_website_to_cache = download_website_to_cache($dev_website_url, $dev_website_cache_dir);

    $files = filesystem_navigation($dev_website_cache_dir);
    $file_ary_edit = $files['file_ary_edit'];
    $file_ary_all = $files['file_ary_all'];

    //replace dev_website_url
    foreach ($file_ary_edit as $f){
        _find_replace_in_file($f, $dev_website_url, $prod_website_url);
    }

    //replace dev_website_url_js
    foreach ($file_ary_edit as $f){
        _find_replace_in_file($f, $dev_website_url_js, _get_website_url_js($prod_website_url));
    }

    //replace /wp-content
    foreach ($file_ary_edit as $f){
        _find_replace_in_file($f, 'src="/wp-content/', 'src="'.$prod_website_url.'/wp-content/');
    }

    //rename file with ?
    foreach ($file_ary_all as $f){
        _rename_file($f);
    }

    //copy some files that wget can't catch
    foreach ($ary_missing_files as $k => $v){
        copy(
            __DIR__. '/'.$k, 
            $dev_website_cache_dir.'/'.str_replace($dev_website_protocol, '', $dev_website_url).$v
        );
    }

    $ftp_connection = ftp_connect($_POST['ftp__host']) or die("Couldn't connect to ".$_POST['ftp__host']); 
    if (ftp_login($ftp_connection, $_POST['ftp__user'], $_POST['ftp__password'])) {
        ftp_chdir($ftp_connection, $_POST['ftp__destination_folder']);
        foreach ($file_ary_all as $filename){
            if(file_exists($filename)){
                //# enable this line if you know what you are doing :-)    ftp_put_dir($ftp_connection, $dev_website_cache_dir.'/'.str_replace($dev_website_protocol, '', $dev_website_url), $_POST['ftp__destination_folder']);
            }
        }
        $message = 'Check the website: <a target="_blank" href="'.$prod_website_url.'">'.$prod_website_url.'</a>';
    }else{
        $message = 'Not connected. Check FTP details.';
    }

    $_response = array(
        'message' => $message,
        'exec_status' => $_download_website_to_cache['exec_status']
    );

    echo response($_response);

}else{
    var_dump($_POST);
}


//# FUNCTIONS
function response($response){
    header("Content-Type: application/json");
    if($response !== ''){
        echo json_encode($response);
    }
    die();
}

function _find_replace_in_file($path_to_file, $dev_website_url, $prod_website_url){
    if(!empty($path_to_file) && is_file($path_to_file)){
        $file_contents = file_get_contents($path_to_file);
        $file_contents = str_replace($dev_website_url, $prod_website_url, $file_contents);
        file_put_contents($path_to_file,$file_contents);
    }
}
function _rename_file($path_to_file){
    if(strpos($path_to_file, '?') !== false || strpos($path_to_file, '?') !== false){
        $path_to_file__ary = explode('?', $path_to_file);
        if(isset($path_to_file__ary[0])){
            rename($path_to_file, $path_to_file__ary[0]);
        }
    }
}

function download_website_to_cache($dev_website_url, $dev_website_cache_dir){
    $exec_output = $exec_status = '';

    //# Create dir for the cache
    mkdir($dev_website_cache_dir);

    //# Change directory to the cache
    chdir($dev_website_cache_dir);

    //# wget the website cache into the directory cache
    //# enable this line if you know what you are doing :-)    exec('wget  -r -p -U Mozilla --no-parent '.$dev_website_url, $exec_output, $exec_status); //wget -E -H -k -p 

    return array('exec_output' => $exec_output, 'exec_status' => $exec_status);
}

function _get_website_url_js($dev_website_url){
    return str_replace('/', '\/', $dev_website_url);
}

function ftp_put_dir($ftp_connection, $local_folder, $ftp__destination_folder) {
    $d = dir($local_folder);
    while($file = $d->read()) {
        if ($file != "." && $file != "..") {
            if (is_dir($local_folder."/".$file)) {
                if (!@ftp_chdir($ftp_connection, $ftp__destination_folder."/".$file)) {
                    ftp_mkdir($ftp_connection, $ftp__destination_folder."/".$file);
                }
                ftp_put_dir($ftp_connection, $local_folder."/".$file, $ftp__destination_folder."/".$file);
            } else {
                ftp_put($ftp_connection, $ftp__destination_folder."/".$file, $local_folder."/".$file, FTP_BINARY);
            }
        }
    }
    $d->close();
}