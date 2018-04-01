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

jQuery(document).ready(function () {

    jQuery('body').on('click', '#btnGoToLive', function () {
        var values = {
            btnGoToLive: 'btnGoToLive',
            ftp__host: jQuery('#ftp__host').val(),
            ftp__user: jQuery('#ftp__user').val(),
            ftp__password: jQuery('#ftp__password').val(),
            ftp__destination_folder: jQuery('#ftp__destination_folder').val(),

            project_id: jQuery('#project_id').val(),
            dev_website_protocol: jQuery('#dev_website_protocol').val(),
            dev_website_url: jQuery('#dev_website_url').val(),
            prod_website_url: jQuery('#prod_website_url').val(),
            cached_root: jQuery('#cached_root').val()
        };

        jQuery.post( pluginUrl__wp_from_dev_to_html_live + "admin-uihsdw/public_html/index.php", values)
        .done(function( data ) {
            console.log(data);
            jQuery('#response').html('');
            jQuery.each( data, function( key, value ) {
                jQuery('#response').html(jQuery('#response').html() + '<br><b>' + key + '</b>: ' + value);
            });
        })
        .fail(function( data ) {
            console.log( "FAIL: " );
            console.log( data );
            jQuery('#response').html(data.responseText);
        });
        return false;
    });
});