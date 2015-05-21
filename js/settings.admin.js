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

        $('#beididp_url').autocomplete({
            source:[
                "https://www.e-contract.be/eid-idp/endpoints/openid/auth",
            //  "https://www.e-contract.be/eid-idp/endpoints/openid/ident", /* removed since it allows to login without pincode */
                "https://www.e-contract.be/eid-idp/endpoints/openid/auth-ident"
            ]
        });

        $('input[name*=beididp]').change(ChangeEventHandler); //[name*=beididp][type=text] //[name*=beididp][type=checkbox]
        
        function ChangeEventHandler(event) {
            //alert(event.target.type + '.change()');
            
            var url = $('#beididp_url').val();
            var hide = $('#beididp_hide').prop('checked');
            
            $('#beididp .msg').html(t('beididp', 'Saving...')).removeClass('success').removeClass('error').stop(true, true).show(); //OC.msg.startSaving('#beididp .msg');
            $.post(
                OC.filePath('beididp', 'ajax', 'settings.admin.php'),
                {url: url, hide: hide},
                function (result) {
                    if (result.status === 'success') {
                        $('#beididp .msg').html(result.data.message).addClass('success').removeClass('error').stop(true, true).delay(3000).fadeOut(900).show(); //OC.msg.finishedSaving('#beididp .msg', result);
                    } else {
                        $('#beididp .msg').html(result.data.message).addClass('error').removeClass('success').show(); //OC.msg.finishedSaving('#beididp .msg', result);
                    }
                }
            );
        }

    });

})(jQuery, OC);
