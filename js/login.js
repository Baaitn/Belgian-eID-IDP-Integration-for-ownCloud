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
        alert('document.ready()');

        // <editor-fold defaultstate="collapsed" desc="add button after submit, try to handle it with ajax, didn't work (redirect on server, not on client?)">
//        $('#submit').after(
//            '<input id="eid" type="button" value="eID" class="login primary"></input>'
//        );
        // </editor-fold>

        // <editor-fold defaultstate="collapsed" desc="add form after form, same as above">
//        $('form[name=login]').after(
//            '<form method="post" name="eid">' + 
//                '<fieldset>' + 
//                    '<img class="" alt="" title="" src="/owncloud/beididp/img/app.svg"/>' + 
//                    '<p class="grouptop groupbottom">' + 
//                        '<input name="user" id="user" placeholder="Gebruikersnaam" value="" autofocus="" autocomplete="on" autocapitalize="off" autocorrect="off" required="" type="text">' + 
//                        '<label for="user" class="infield">Gebruikersnaam</label>' + 
//                        '<img class="svg" src="/owncloud/core/img/actions/user.svg" alt="">' + 
//                    '</p>' + 
//                    '<input id="eid" type="submit" value="eID" class="login primary"></input>' + 
//                '</fieldset>' + 
//            '</form>'
//        );
        // </editor-fold>
        
//        $('#eid').click(function () {
//            alert('#eid.click()');
//        
//            $.post(
//                OC.filePath('beididp', 'ajax', 'homepage.php'),
//                function (result) {
//                    if (result.status === 'success') {
//                        alert('S');
//                    } else {
//                        alert('F');
//                    }
//                }
//            );
//        });

        $('input[name="redirect"]').click(function (){
            $('#user').val('');
            $('#password').val('');
        });
        
    });

})(jQuery, OC);
