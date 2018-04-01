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

function admin_itmits__wp_from_dev_to_html_live__menu() {
    global $getAdminMenuPageBean;
    global $getAdminSubmenuPageBean;

    //# admin panel
    add_menu_page(
        $getAdminMenuPageBean->get_plugin_page_title(), $getAdminMenuPageBean->get_plugin_menu_title(),
        $getAdminMenuPageBean->get_plugin_page_capability(), $getAdminMenuPageBean->get_plugin_top_menu_slug(),
        $getAdminMenuPageBean->get_plugin_page_function(), $getAdminMenuPageBean->get_plugin_menu_icon(),
        $getAdminMenuPageBean->get_plugin_menu_position()
    );

    add_submenu_page(
        $getAdminMenuPageBean->get_plugin_top_menu_slug(),
        $getAdminSubmenuPageBean->get_plugin_page_title(), $getAdminSubmenuPageBean->get_plugin_menu_title(),
        $getAdminSubmenuPageBean->get_plugin_page_capability(), $getAdminSubmenuPageBean->get_plugin_menu_slug(),
        $getAdminSubmenuPageBean->get_plugin_page_function()
    );

    add_action( 'admin_init', 'admin_itmits__register_wp_from_dev_to_html_live' );
}

//# MENU
function admin_itmits__wp_from_dev_to_html_live__menu_page() {
    global $getAdminMenuPageBean; ?>
    <div class="wrap">
        <h1>WP from DEV to HTML LIVE</h1>
        <form method="post" action="options.php">
            <?php settings_fields( 'wp_from_dev_to_html_live_group' ); ?>
            <?php do_settings_sections( 'wp_from_dev_to_html_live_group' ); ?>
            <table class="form-table" id="wp_from_dev_to_html_live__form">
                <?php
                $_get_admin_menu_page_fields = $getAdminMenuPageBean->get_admin_menu_page_fields();
                foreach ($_get_admin_menu_page_fields as $k=>$v){
                    $label_slug = $v['label_slug'];
                    $fields = $v['fields'];
                    ?>
                    <tr valign="top">
                        <th scope="row"><span><?php echo $k;?></span></th>
                        <td><?php echo $label_slug;?></td>
                    </tr>
                    <?php
                    foreach ($fields as $field_label => $args){?>
                        <tr valign="top">
                            <td scope="row">- <?php echo $field_label;?></td>
                            <td><?php echo _get_field__wp_from_dev_to_html_live($args);?></td>
                        </tr>
                        <?php
                    }
                }
                ?>
            </table>

            <?php submit_button(); ?> <button id="btnGoToLive" class="button">Go to Live!</button>
        </form>


        <div id="response">
            
        </div>
    </div>
<?php 
}

function admin_itmits__register_wp_from_dev_to_html_live() {
    global $getAdminMenuPageBean;
    $_get_admin_menu_page_fields = $getAdminMenuPageBean->get_admin_menu_page_fields();
    foreach ($_get_admin_menu_page_fields as $k=>$v){
        $label_slug = $v['label_slug'];
        $fields = $v['fields'];
        register_setting( 'wp_from_dev_to_html_live_group', $args['field_slug'] );
        foreach ($fields as $field_label => $args){
            register_setting( 'wp_from_dev_to_html_live_group', $args['field_slug'] );
        }
    }
}

//# SUB MENU
function admin_itmits__wp_from_dev_to_html_live__submenu_page() {
    global $getAdminMenuPageBean; ?>
    <div class="wrap">
        <h1>WP from DEV to HTML LIVE - sub menu</h1>
    </div>
<?php 
}


function _get_field__wp_from_dev_to_html_live($args){
    switch ($args['field_type']) {
        case 'text':
            return '<input type="text" id="'.$args['field_slug'].'" name="'.$args['field_slug'].'" class="retrieved_input" value="'.esc_attr( get_option($args['field_slug']) ).'"/>';
        case 'textarea':
            return '<textarea id="'.$args['field_slug'].'" name="'.$args['field_slug'].'" class="retrieved_text_area">'.esc_attr( get_option($args['field_slug']) ).'</textarea>';
        case 'checkbox':
            if(esc_attr( get_option($args['field_slug'])) === 'on'){
                return '<input id="'.$args['field_slug'].'" checked="checked" name="'.$args['field_slug'].'" class="retrieved_checkbox" type="checkbox"/>';
            }else{
                return '<input id="'.$args['field_slug'].'" name="'.$args['field_slug'].'" class="retrieved_checkbox" type="checkbox"/>';
            }
        default:
            return '';
    }
}

function admin_itmits__wp_from_dev_to_html_live_inline_js(){
    global $plugin_dir_url;
    echo "<script type='text/javascript'>\n";
        echo 'var pluginUrl__wp_from_dev_to_html_live = "' . $plugin_dir_url . '";';
    echo "\n</script>";
}

function admin_itmits__wp_from_dev_to_html_live_enqueue() { //https://codex.wordpress.org/Plugin_API/Action_Reference/admin_enqueue_scripts
    global $plugin_dir_url;
    wp_enqueue_style( 'admin', $plugin_dir_url . '/admin-uihsdw/public_html/css/admin.css' );
    wp_enqueue_script( 'admin', $plugin_dir_url . '/admin-uihsdw/public_html/js/admin-script.js' );
}