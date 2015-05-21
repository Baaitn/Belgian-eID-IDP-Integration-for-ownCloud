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

        $('#beididp #identities').on('click', 'td.remove > img', function () { //$('#identities td.remove > img').click(function () {
            //alert('row.remove()');
           
            //select cardnumber
            var row = $(this).parent().parent();
            var cardnumber = row.children('td:nth-child(1)').text();

            //send cardnumber
            $('#beididp .msg').html(t('beididp', 'Removing...')).removeClass('success').removeClass('error').stop(true, true).show(); //OC.msg.startSaving('#beididp .msg');
            $.post(
                OC.filePath('beididp', 'ajax', 'remove.eid.php'),
                {cardnumber: cardnumber},
                function (result) {
                    if (result.status === 'success') {
                        $('#beididp .msg').html(result.data.message).addClass('success').removeClass('error').stop(true, true).delay(3000).fadeOut(900).show(); //OC.msg.finishedSaving('#beididp .msg', result);
                        row.remove();
                    } else {
                        $('#beididp .msg').html(result.data.message).addClass('error').removeClass('success').show(); //OC.msg.finishedSaving('#beididp .msg', result);
                    }
                }
            );
    
            //$('#beididp .msg').html(t('beididp', 'Removing...')).removeClass('success').removeClass('error').stop(true, true).show(); //OC.msg.startSaving('#beididp .msg');
            //$.ajax({
            //    type: 'POST',
            //    url: OC.filePath('beididp','ajax','remove.eid.php'),
            //    data: {cardnumber: cardnumber},
            //    success: function (data, textStatus, jqXHR) {
            //        $('#beididp .msg').html('success').addClass('success').removeClass('error').stop(true, true).delay(3000).fadeOut(900).show(); //OC.msg.finishedSaving('#beididp .msg', result);
            //        row.remove();
            //    },
            //    error: function (jqXHR, textStatus, errorThrown) {
            //        $('#beididp .msg').html('error').addClass('error').removeClass('success').show(); //OC.msg.finishedSaving('#beididp .msg', result);
            //    }
            //});
        });

        $('#beididp #submit').click(function () {
            //alert('#submit.click()');
        });

        $("#beididp #form").submit(function (event) { 
            //event.preventDefault();
            
            //debug: add identities without redirecting to the idp
            //$('#beididp .msg').html(t('beididp', 'Adding...')).removeClass('success').removeClass('error').stop(true, true).show(); //OC.msg.startSaving('#beididp .msg');
            //$.post(
            //    OC.filePath('beididp', 'ajax', 'add.eid.debug.php'),
            //    function (result) {
            //        if (result.status === 'success') {
            //            $('#beididp .msg').html(result.data.message).addClass('success').removeClass('error').stop(true, true).delay(3000).fadeOut(900).show(); //OC.msg.finishedSaving('#beididp .msg', result);
            //            location.reload(); //FIXME: add identities to the table without needing to reload the page, note that in production the page will reload due to the redict to and from the idp
            //        } else {
            //            $('#beididp .msg').html(result.data.message).addClass('error').removeClass('success').show(); //OC.msg.finishedSaving('#beididp .msg', result);
            //        }
            //    }
            //);
        });

        if($('#beididp .msg').hasClass('success')) {
            $('#beididp .msg').addClass('success').removeClass('error').stop(true, true).delay(3000).fadeOut(900);
        }
        
        if($('#beididp .msg').hasClass('error')) {
            $('#beididp .msg').addClass('error').removeClass('success');
        }

    });

})(jQuery, OC);
