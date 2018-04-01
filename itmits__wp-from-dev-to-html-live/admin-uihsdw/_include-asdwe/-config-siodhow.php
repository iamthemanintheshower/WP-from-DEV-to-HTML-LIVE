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

//# Reference: https://developer.wordpress.org/reference/functions/add_menu_page
$admin_menu_page_config = array(
    'plugin_page_title' => 'WP from DEV to HTML LIVE',
    'plugin_menu_title' => 'WP from DEV to HTML LIVE',
    'plugin_page_capability' => 'administrator',
    'plugin_menu_slug' => 'wp_from_dev_to_html_live__menu_page',
    'plugin_page_function' => 'admin_itmits__wp_from_dev_to_html_live__menu_page',
    'plugin_menu_icon' => $plugin_dir_url.'admin-uihsdw/public_html/imgs/icon.png',
    'plugin_menu_position' => ''
);

$admin_menu_page_fields = array(
    'Fields' => 
        array(
            'label_slug' => '** PAY ATTENTION THIS WILL REPLACE FILES ON THE REMOTE FTP SERVER - READ THE FOLLOWING CODE CAREFULLY BEFORE PROCEED***',
            'fields' => array(
                //# FTP
                'Host' => 
                    array(
                        'field_slug' => 'ftp__host',
                        'field_type' => 'text'
                    ),
                'User' => 
                    array(
                        'field_slug' => 'ftp__user',
                        'field_type' => 'text'
                    ),
                'Password' => 
                    array(
                        'field_slug' => 'ftp__password',
                        'field_type' => 'text'
                    ),
                'Destination folder' => 
                    array(
                        'field_slug' => 'ftp__destination_folder',
                        'field_type' => 'text'
                    ),

                //# PROJECT
                'Project ID' => 
                    array(
                        'field_slug' => 'project_id',
                        'field_type' => 'text'
                    ),
                'Protocol' => 
                    array(
                        'field_slug' => 'dev_website_protocol',
                        'field_type' => 'text'
                    ),
                'DEV URL' => 
                    array(
                        'field_slug' => 'dev_website_url',
                        'field_type' => 'text'
                    ),
                'PROD URL' => 
                    array(
                        'field_slug' => 'prod_website_url',
                        'field_type' => 'text'
                    ),
                'Cached Folder' => 
                    array(
                        'field_slug' => 'cached_root',
                        'field_type' => 'text'
                    ),
//                
//                'Checkbox' =>
//                    array(
//                        'field_slug' =>'checkbox_field',
//                        'field_type' => 'checkbox'
//                    ),
//                'Textarea' => 
//                    array(
//                        'field_slug' =>'textarea_field',
//                        'field_type' => 'textarea'
//                    ),
            )
        ),
    );


//# Reference: https://developer.wordpress.org/reference/functions/add_submenu_page/
$admin_submenu_page_config = array(
    'plugin_page_title' => 'WP from DEV to HTML LIVE',
    'plugin_menu_title' => 'WP from DEV to HTML LIVE - submenu',
    'plugin_page_capability' => 'administrator',
    'plugin_menu_slug' => 'wp_from_dev_to_html_live__submenu_page',
    'plugin_page_function' => 'admin_itmits__wp_from_dev_to_html_live__submenu_page'
);

$ary_missing_files = array(
    '_utils/wp-emoji-release.min.js' => '/wp-includes/js/wp-emoji-release.min.js',
    '_utils/wp-embed.min.js' => '/wp-includes/js/wp-embed.min.js'
);

$admin_submenu_page_fields = null;
