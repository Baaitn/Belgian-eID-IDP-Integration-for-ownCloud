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

        $('input[name="redirect"]').click(function (){
            $('#user').val('');
            $('#password').val('');
        });
        
    });

})(jQuery, OC);
