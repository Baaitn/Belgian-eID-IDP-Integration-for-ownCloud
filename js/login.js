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

        // <editor-fold defaultstate="collapsed" desc="add a form after the form">
        //$('form[name=login]').after(
        //    '<form method="post" name="eid">' + 
        //        '<fieldset>' + 
        //            '<img class="" alt="" title="" src="/owncloud/beididp/img/app.svg"/>' + 
        //            '<p class="grouptop groupbottom">' + 
        //                '<input name="user" id="user" placeholder="Username" value="" autofocus="" autocomplete="on" autocapitalize="off" autocorrect="off" required="" type="text">' + 
        //                '<label for="user" class="infield">Username</label>' + 
        //                '<img class="svg" src="/owncloud/core/img/actions/user.svg" alt="">' + 
        //            '</p>' + 
        //            '<input id="submit" type="submit" value="eID" class="login primary"></input>' + 
        //        '</fieldset>' + 
        //    '</form>'
        //);
        // </editor-fold>

        $('input[name="redirect"]').click(function (){
            $('#user').val('');
            $('#password').val('');
        });
        
    });

})(jQuery, OC);
