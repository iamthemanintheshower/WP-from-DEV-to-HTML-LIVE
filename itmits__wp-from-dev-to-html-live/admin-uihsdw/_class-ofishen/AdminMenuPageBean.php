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

class AdminMenuPageBean {

    private $_plugin_page_title;
    private $_plugin_menu_title;
    private $_plugin_page_capability;
    private $_plugin_top_menu_slug;
    private $_plugin_page_function;
    private $_plugin_menu_icon;
    private $_plugin_menu_position;
    private $_admin_menu_page_fields;

    function get_plugin_page_title() {
        return $this->_plugin_page_title;
    }

    function get_plugin_menu_title() {
        return $this->_plugin_menu_title;
    }

    function get_plugin_page_capability() {
        return $this->_plugin_page_capability;
    }

    function get_plugin_top_menu_slug() {
        return $this->_plugin_top_menu_slug;
    }

    function get_plugin_page_function() {
        return $this->_plugin_page_function;
    }

    function get_plugin_menu_icon() {
        return $this->_plugin_menu_icon;
    }

    function get_plugin_menu_position() {
        return $this->_plugin_menu_position;
    }

    function get_admin_menu_page_fields() {
        return $this->_admin_menu_page_fields;
    }

    function set_plugin_page_title($_plugin_page_title) {
        $this->_plugin_page_title = $_plugin_page_title;
    }

    function set_plugin_menu_title($_plugin_menu_title) {
        $this->_plugin_menu_title = $_plugin_menu_title;
    }

    function set_plugin_page_capability($_plugin_page_capability) {
        $this->_plugin_page_capability = $_plugin_page_capability;
    }

    function set_plugin_top_menu_slug($_plugin_top_menu_slug) {
        $this->_plugin_top_menu_slug = $_plugin_top_menu_slug;
    }

    function set_plugin_page_function($_plugin_page_function) {
        $this->_plugin_page_function = $_plugin_page_function;
    }

    function set_plugin_menu_icon($_plugin_menu_icon) {
        $this->_plugin_menu_icon = $_plugin_menu_icon;
    }

    function set_plugin_menu_position($_plugin_menu_position) {
        $this->_plugin_menu_position = $_plugin_menu_position;
    }

    function set_admin_menu_page_fields($_admin_menu_page_fields) {
        $this->_admin_menu_page_fields = $_admin_menu_page_fields;
    }

}
