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

        $('#identities').on('click', 'td.remove > img', function () { //$('#identities td.remove > img').click(function () {
            //alert('row.remove()');
           
            //remove identity from view
            var row = $(this).parent().parent();
            row.remove();

            //debug: select usefull data (only remaining identities, nothing else)
            //$("#identities").css( "border", "3px solid green" );
            //$("#identities tbody tr td:nth-child(1)").css( "color", "red" );          

            //store remaining identities in array
            var identities = [];
            $('#identities tbody tr td:nth-child(1)').each(function () {
                identities.push($(this).text());
            });

            //debug: display content of array
            //$.each(identities, function(index, value) {
            //    alert('index: ' + index + ', value: ' + value);
            //});

            //send identities to be removed from storage
            $('#form .msg').html(t('beididp', 'Removing...')).removeClass('success').removeClass('error').stop(true, true).show(); //OC.msg.startSaving('#form .msg');
            $.post(
                OC.filePath('beididp', 'ajax', 'remove.eid.php'),
                {identities: identities},
                function (result) {
                    if (result.status === 'success') {
                        $('#form .msg').html(result.data.message).addClass('success').removeClass('error').stop(true, true).delay(3000).fadeOut(900).show(); //OC.msg.finishedSaving('#form .msg', result);
                        //row.remove();
                    } else {
                        $('#form .msg').html(result.data.message).addClass('error').removeClass('success').show(); //OC.msg.finishedSaving('#form .msg', result);
                        $('#identities tbody').append(row);
                    }
                }
            );
    
            //$('#form .msg').html(t('beididp', 'Removing...')).removeClass('success').removeClass('error').stop(true, true).show(); //OC.msg.startSaving('#form .msg');
            //$.ajax({
            //    type: 'POST',
            //    url: OC.filePath('beididp','ajax','remove.eid.php'),
            //    data: {identities: identities},
            //    success: function (data, textStatus, jqXHR) {
            //        $('#form .msg').html('success').addClass('success').removeClass('error').stop(true, true).delay(3000).fadeOut(900).show(); //OC.msg.finishedSaving('#form .msg', result);
            //        row.remove();
            //    },
            //    error: function (jqXHR, textStatus, errorThrown) {
            //        $('#form .msg').html('error').addClass('error').removeClass('success').show(); //OC.msg.finishedSaving('#form .msg', result);
            //    }
            //});
        });

        $('#submit').click(function () {
            //alert('#submit.click()');
        });

        $("#form").submit(function (event) { 
            //event.preventDefault();
            
            //debug: add identities without redirecting to the idp
            //$('#form .msg').html(t('beididp', 'Adding...')).removeClass('success').removeClass('error').stop(true, true).show(); //OC.msg.startSaving('#form .msg');
            //$.post(
            //    OC.filePath('beididp', 'ajax', 'add.eid.debug.php'),
            //    function (result) {
            //        if (result.status === 'success') {
            //            $('#form .msg').html(result.data.message).addClass('success').removeClass('error').stop(true, true).delay(3000).fadeOut(900).show(); //OC.msg.finishedSaving('#form .msg', result);
            //            location.reload(); //FIXME: add identities to the table without needing to reload the page, note that in production the page will reload due to the redict to and from the idp
            //        } else {
            //            $('#form .msg').html(result.data.message).addClass('error').removeClass('success').show(); //OC.msg.finishedSaving('#form .msg', result);
            //        }
            //    }
            //);
        });

        if($('#form .msg').hasClass('success')) {
            $('#form .msg').addClass('success').removeClass('error').stop(true, true).delay(3000).fadeOut(900);
        }
        
        if($('#form .msg').hasClass('error')) {
            $('#form .msg').addClass('error').removeClass('success');
        }

    });

})(jQuery, OC);
