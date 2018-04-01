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

class AdminPage {
    
    public function getAdminMenuPageBean($admin_menu_page_config, $admin_menu_page_fields, $admin_menu_page_bean){
        $admin_menu_page_bean->set_plugin_page_title($admin_menu_page_config['plugin_page_title']);
        $admin_menu_page_bean->set_plugin_menu_title($admin_menu_page_config['plugin_menu_title']);
        $admin_menu_page_bean->set_plugin_page_capability($admin_menu_page_config['plugin_page_capability']);
        $admin_menu_page_bean->set_plugin_top_menu_slug($admin_menu_page_config['plugin_menu_slug']);
        $admin_menu_page_bean->set_plugin_page_function($admin_menu_page_config['plugin_page_function']);
        $admin_menu_page_bean->set_plugin_menu_icon($admin_menu_page_config['plugin_menu_icon']);
        $admin_menu_page_bean->set_plugin_menu_position($admin_menu_page_config['plugin_menu_position']);

        $admin_menu_page_bean->set_admin_menu_page_fields($admin_menu_page_fields);

        return $admin_menu_page_bean;
    }
    
    public function getAdminSubmenuPageBean($admin_submenu_page_config, $admin_submenu_page_fields, $admin_submenu_page_bean){
        $admin_submenu_page_bean->set_plugin_page_title($admin_submenu_page_config['plugin_page_title']);
        $admin_submenu_page_bean->set_plugin_menu_title($admin_submenu_page_config['plugin_menu_title']);
        $admin_submenu_page_bean->set_plugin_page_capability($admin_submenu_page_config['plugin_page_capability']);
        $admin_submenu_page_bean->set_plugin_menu_slug($admin_submenu_page_config['plugin_menu_slug']);
        $admin_submenu_page_bean->set_plugin_page_function($admin_submenu_page_config['plugin_page_function']);
        $admin_submenu_page_bean->set_plugin_menu_icon($admin_submenu_page_config['plugin_menu_icon']);
        $admin_submenu_page_bean->set_plugin_menu_position($admin_submenu_page_config['plugin_menu_position']);

        $admin_submenu_page_bean->set_admin_menu_page_fields($admin_submenu_page_fields);

        return $admin_submenu_page_bean;
    }
    
}
