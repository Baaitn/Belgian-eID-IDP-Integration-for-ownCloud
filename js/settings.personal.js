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

        $('#identities td.remove > img').click(function () {
            alert('row.remove()');

            var row = $(this).parent().parent();
            var identity = $.trim(row.text());

            //$('#form .msg').html(t('core', 'Saving...')).removeClass('success').removeClass('error').stop(true, true).show(); //OC.msg.startSaving('#form .msg'); /* OC.msg.startSaving(selector) & OC.msg.startAction(selector, message) in core/js/js.js */
            //$.ajax({
            //    type: 'POST',
            //    url: OC.filePath('beididp','ajax','remove.eid.php'),
            //    data: {identity: identity},
            //    success: function (data, textStatus, jqXHR) {
            //        $('#form .msg').html('success').addClass('success').removeClass('error').stop(true, true).delay(3000).fadeOut(900).show(); //OC.msg.finishedSaving('#form .msg', data); /* OC.msg.finishedSaving(selector, data) & OC.msg.finishedAction(selector, data)  in core/js/js.js */
            //        row.remove();
            //    },
            //    error: function (jqXHR, textStatus, errorThrown) {
            //        $('#form .msg').html('error').addClass('error').removeClass('success').show(); //OC.msg.finishedSaving('#form .msg', data);
            //    }
            //});

            //FIXME: change this back to V1
            //If it happens that an identity does get added twice, you'll be able to remove just one of them. Added bonus is that there won't be a decync between GUI and DB untill you reload the page.

            $('#form .msg').html(t('beididp', 'Removing...')).removeClass('success').removeClass('error').stop(true, true).show(); //OC.msg.startSaving('#form .msg');
            $.post(
                OC.filePath('beididp', 'ajax', 'remove.eid.php'),
                {identity: identity},
                function (result) {
                    if (result.status === 'success') {
                        $('#form .msg').html(result.data.message).addClass('success').removeClass('error').stop(true, true).delay(3000).fadeOut(900).show(); //OC.msg.finishedSaving('#form .msg', result);
                        row.remove();
                    } else {
                        $('#form .msg').html(result.data.message).addClass('error').removeClass('success').show(); //OC.msg.finishedSaving('#form .msg', result);
                    }
                }
            );
        });

        // <editor-fold defaultstate="collapsed" desc="V1 - remove identity from view; send leftover identities to server; save identities">
        //$('#identities').on('click', 'td.remove > img', function () {
        //    alert('row.remove()');
        //
        //    //remove identity from view, 
        //    var row = $(this).parent().parent();
        //    row.remove();
        //
        //    //debug: select usefull data (only remaining identities, nothing else)
        //    //$("#identities").css( "border", "3px solid green" );
        //    //$("#identities tbody tr td:nth-child(1)").css( "color", "red" );          
        //
        //    //store remaining identities in array
        //    var identities = [];
        //    $('#identities tbody tr td:nth-child(1)').each(function () {
        //        identities.push($(this).text());
        //    });
        //
        //    //debug: display content of array
        //    //$.each(identities, function(index, value) {
        //    //    alert('index: ' + index + ', value: ' + value);
        //    //});
        //
        //    //serialize identities
        //    //var serialized1 = identities.serialize();
        //    //var serialized2 = identities.serializeArray();
        //    //var serialized3 = JSON.stringify(identities);
        //
        //    //debug: display serialized identities
        //    //alert(serialized1);
        //    //alert(serialized2);
        //    //alert(serialized3);
        //
        //    //send identities to be removed from storage
        //    //$('#form .msg').html(t('beididp', 'Removing...')).removeClass('success').removeClass('error').stop(true, true).show();
        //    $.ajax({
        //        type: 'POST',
        //        url: OC.filePath('beididp','ajax','remove.eid.php'),
        //        data: {identities: identities},
        //        success: function (data, textStatus, jqXHR) {
        //            //$('#form .msg').html('success').addClass('success').removeClass('error').stop(true, true).delay(3000).fadeOut(900).show();
        //            row.remove();
        //        },
        //        error: function (jqXHR, textStatus, errorThrown) {
        //            //$('#form .msg').html('error').addClass('error').removeClass('success').show();
        //        }
        //    });
        //
        //    //$('#form .msg').html(t('beididp', 'Removing...')).removeClass('success').removeClass('error').stop(true, true).show();
        //    $.post(
        //        OC.filePath('beididp', 'ajax', 'remove.eid.php'),
        //        identities,
        //        function (result) {
        //            if (result.status === 'success') {
        //                //$('#form .msg').html('success').addClass('success').removeClass('error').stop(true, true).delay(3000).fadeOut(900).show();
        //                row.remove();
        //            } else {
        //                //$('#form .msg').html('error').addClass('error').removeClass('success').show();
        //            }
        //        }
        //    );
        //});
        // </editor-fold>
        // <editor-fold defaultstate="collapsed" desc="V2 - get identity; send identity to server; get identities and remove the recieved one; save identities; remove identity from view">
        //$('#identities').on('click', 'td.remove > img', function () {
        //    alert('row.remove()');
        //
        //    var row = $(this).parent().parent();
        //    var identity = $.trim(row.text());
        //
        //    //$('#form .msg').html(t('beididp', 'Removing...')).removeClass('success').removeClass('error').stop(true, true).show();
        //    $.ajax({
        //        type: 'POST',
        //        url: OC.filePath('beididp','ajax','remove.eid.php'),
        //        data: {identity: identity},
        //        success: function (data, textStatus, jqXHR) {
        //            //$('#form .msg').html('success').addClass('success').removeClass('error').stop(true, true).delay(3000).fadeOut(900).show();
        //            row.remove();
        //        },
        //        error: function (jqXHR, textStatus, errorThrown) {
        //            //$('#form .msg').html('error').addClass('error').removeClass('success').show();
        //        }
        //    });
        //
        //    //$('#form .msg').html(t('beididp', 'Removing...')).removeClass('success').removeClass('error').stop(true, true).show();
        //    $.post(
        //        OC.filePath('beididp', 'ajax', 'remove.eid.php'),
        //        {identity: identity},
        //        function (result) {
        //            if (result.status === 'success') {
        //                //$('#form .msg').html('success').addClass('success').removeClass('error').stop(true, true).delay(3000).fadeOut(900).show();
        //                row.remove();
        //            } else {
        //                //$('#form .msg').html('error').addClass('error').removeClass('success').show();
        //            }
        //        }
        //    );
        //});
        // </editor-fold>

        $('#submit').click(function () {
            alert('#submit.click()');
        });

        // <editor-fold defaultstate="collapsed" desc="debug: add identities without redirecting to the idp">
        //$("#form").submit(function (event) { 
        //    event.preventDefault();
        //
        //    var count = 1;
        //
        //    alert('Adding ' + count + ' additional identities');
        //
        //    $('#form .msg').html(t('beididp', 'Adding...')).removeClass('success').removeClass('error').stop(true, true).show(); //OC.msg.startSaving('#form .msg');
        //    $.post(
        //        OC.filePath('beididp', 'ajax', 'debug.add.eid.php'),
        //        {count: count},
        //        function (result) {
        //            if (result.status === 'success') {
        //                $('#form .msg').html(result.data.message).addClass('success').removeClass('error').stop(true, true).delay(3000).fadeOut(900).show(); //OC.msg.finishedSaving('#form .msg', result);
        //                //FIXME: add identities to table needing to reload the page, note that in production the page will reload due to the redict to and from the idp
        //                location.reload();
        //            } else {
        //                $('#form .msg').html(result.data.message).addClass('error').removeClass('success').show(); //OC.msg.finishedSaving('#form .msg', result);
        //            }
        //        }
        //    );
        //});
        // </editor-fold>

    });

})(jQuery, OC);
