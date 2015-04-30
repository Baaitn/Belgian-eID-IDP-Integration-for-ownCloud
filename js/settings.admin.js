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

        //TODO: add 'code hinting' to textfield

        $('input[name*=beididp]').change(ChangeEventHandler); //$('input[type=text][name*=beididp]').change(function () { alert('text.change()'); });
        $('select[name*=beididp]').change(ChangeEventHandler); //$('input[type=checkbox][name*=beididp]').change(function () { alert('checkbox.change()'); });
        
        function ChangeEventHandler(event) {
            //alert(event.target.type + '.change()');
            
            var url = $('#beididp_idp_url').val();
            var mail = $('#beididp_no_mail_verify').prop('checked');
            var https = $('#beididp_https_required').prop('checked');
            var hash = $('#beididp_hash_claimed_id').prop('checked');
            
            $('#form .msg').html(t('beididp', 'Saving...')).removeClass('success').removeClass('error').stop(true, true).show(); //OC.msg.startSaving('#form .msg');
            $.post(
                OC.filePath('beididp', 'ajax', 'settings.admin.php'),
                {url: url, mail: mail, https: https, hash: hash},
                function (result) {
                    if (result.status === 'success') {
                        $('#form .msg').html(result.data.message).addClass('success').removeClass('error').stop(true, true).delay(3000).fadeOut(900).show(); //OC.msg.finishedSaving('#form .msg', result);
                    } else {
                        $('#form .msg').html(result.data.message).addClass('error').removeClass('success').show(); //OC.msg.finishedSaving('#form .msg', result);
                    }
                }
            );
        }
        
        $('#submit').click(function () {
            //alert('#submit.click()');
        });

        $("#form").submit(function (event) {
            //event.preventDefault();
        });

    });

})(jQuery, OC);
