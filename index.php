<?php
/*
MIT License

Copyright (c) 2017 https://github.com/iamthemanintheshower (imthemanintheshower@gmail.com, http://www.imthemanintheshower.com)

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

include("filesystem_navigation/filesystem_navigation.php");

include 'conf/app_config.php';
include 'conf/config.php';

register_shutdown_function('shutDownFunction');

$_date = new DateTime();

if($dev_website_url !== ''){
    $dev_website_url_js = _get_website_url_js($dev_website_url); //#Customized URL for the javascript part
    $dev_website_cache_dir = __DIR__. '/'.$cached_root.$project_id.'-'.$_date->format('Y-m-d_H:i:s');
    $cached_root_js = _get_website_url_js($cached_root);

    $_download_website_to_cache = download_website_to_cache($dev_website_url, $dev_website_cache_dir);

    $files = filesystem_navigation($dev_website_cache_dir);

    $file_ary_edit = $files['file_ary_edit'];
    $file_ary_all = $files['file_ary_all'];

    echo '<h1>Response:</h1>';
    echo '<p>exec_status:'.$_download_website_to_cache['exec_status'].'</p>';
    echo '<p>$dev_website_cache_dir: '.$dev_website_cache_dir.'</p>';

    echo '<pre>';
    var_dump($file_ary_edit);
    echo '</pre>';

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

    echo '<a target="_blank" href="'.$prod_website_url.'">'.$prod_website_url.'</a>';
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
    //# enable this line if you know whats you are doing :-) exec('wget  -r -p -U Mozilla --no-parent '.$dev_website_url, $exec_output, $exec_status); //wget -E -H -k -p 

    return array('exec_output' => $exec_output, 'exec_status' => $exec_status);
}

function _get_website_url_js($dev_website_url){
    return str_replace('/', '\/', $dev_website_url);
}



function shutDownFunction() { 
    $error = error_get_last();
    print_r($error);
    die();
}
