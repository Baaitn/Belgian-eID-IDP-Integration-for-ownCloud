/**
 * ownCloud - Belgian eID IDP Integration
 *
 * This file is licensed under the Affero General Public License version 3 or
 * later. See the COPYING file.
 *
 * @author Bert Maerten <maerten.bert@outlook.com>
 * @copyright Bert Maerten 2015
 */

(function ($, OC) {

    $(document).ready(function () {
        //alert('document.ready()');
        
        $('#hello').click(function () {
            alert('Hello from your script file');
        });

        $('#echo').click(function () {
            var url = OC.generateUrl('/apps/beididp/echo');
            var data = {
                echo: $('#echo-content').val()
            };
            $.post(url, data).success(function (response) {
                $('#echo-result').text(response.echo);
            });
        });
        
    });

})(jQuery, OC);
