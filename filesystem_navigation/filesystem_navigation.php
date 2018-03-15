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

/**
 * Description of FileSystemNavigation
 *
 * @author imthemanintheshower
 */

$file_ary_edit[] = $file_ary_all[] = NULL;

function filesystem_navigation($directory, $extensions = array()) {
    global $file_ary_edit, $file_ary_all;

    if( substr($directory, -1) == "/" ) { 
        $directory = substr($directory, 0, strlen($directory) - 1); 
    }

    _filesystem_navigation_folder($directory, $extensions);

    return array('file_ary_edit' => $file_ary_edit, 'file_ary_all' => $file_ary_all);
}

function _filesystem_navigation_folder($directory, $extensions = array(), $first_call = true) {
    global $file_ary_edit, $file_ary_all;

    $file = scandir($directory); 
    natcasesort($file);
    $files = $dirs = array();

    foreach($file as $this_file) {
        if( is_dir("$directory/$this_file" ) ){ 
            $dirs[] = $this_file;
        }else{ 
            $files[] = $this_file;
        }
    }
    $file = array_merge($dirs, $files);

    if( !empty($extensions) ) {
        foreach( array_keys($file) as $key ) {
            if( !is_dir("$directory/$file[$key]") ) {
                $ext = substr($file[$key], strrpos($file[$key], ".") + 1); 
                if( !in_array($ext, $extensions) ){ unset($file[$key]); }
            }
        }
    }

    if( count($file) > 2 ) {
        if( $first_call ) { $first_call = false; }

        foreach( $file as $this_file ) {
            if( $this_file != "." && $this_file != ".." ) {
                if( is_dir("$directory/$this_file") ) {
                    _filesystem_navigation_folder("$directory/$this_file", $extensions, false);
                } else {
                    $ext = '';
                    $path_parts = pathinfo($this_file);
                    if(isset($path_parts['extension'])){
                        $ext = $path_parts['extension'];
                    }

                    switch ($ext) {
                        case 'php':
                        case 'html':
                        case 'js':
                        case 'txt':
                        case 'mo':
                        case '':
                            $file_ary_edit[] = $directory.'/'.$this_file;

                            break;

                        default:
                            break;
                    }
                    if(!isset($path_parts['extension'])){
                        $file_ary_edit[] = $directory.'/'.$this_file;
                    }

                    $file_ary_all[] = $directory.'/'.$this_file;
                }
            }
        }
    }
}
