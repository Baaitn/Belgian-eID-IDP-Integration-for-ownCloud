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

            //$('#form .msg').html(t('core', 'Saving...')).removeClass('success').removeClass('error').stop(true, true).show(); //OC.msg.startSaving('#form .msg'); /* OC.msg.startSaving(selector) & OC.msg.startAction(selector, message) in core/js/js.js*/
            //$.ajax({
            //    type: 'POST',
            //    url: OC.filePath('beididp','ajax','remove.eid.php'),
            //    data: {identity: identity},
            //    success: function (data, textStatus, jqXHR) {
            //        $('#form .msg').html('success').addClass('success').removeClass('error').stop(true, true).delay(3000).fadeOut(900).show(); //OC.msg.finishedSaving('#form .msg', data); /* OC.msg.finishedSaving(selector, data) & OC.msg.finishedAction(selector, data)  in core/js/js.js*/
            //        row.remove();
            //    },
            //    error: function (jqXHR, textStatus, errorThrown) {
            //        $('#form .msg').html('error').addClass('error').removeClass('success').show(); //OC.msg.finishedSaving('#form .msg', data);
            //    }
            //});

            $('#form .msg').html(t('core', 'Saving...')).removeClass('success').removeClass('error').stop(true, true).show(); //OC.msg.startSaving('#form .msg');
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

        //V2 - get identity; send identity to server; get identities and remove the recieved one; save identities; remove identity from view
        //$('#identities').on('click', 'td.remove > img', function () {
        //    alert('row.remove()');
        //
        //    var row = $(this).parent().parent();
        //    var identity = $.trim(row.text());
        //
        //    //$('#form .msg').html(t('core', 'Saving...')).removeClass('success').removeClass('error').stop(true, true).show();
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
        //    //$('#form .msg').html(t('core', 'Saving...')).removeClass('success').removeClass('error').stop(true, true).show();
        //    $.post(
        //        OC.filePath('beididp', 'ajax', 'remove.eid.php'),
        //        {identity: identity},
        //        function (data) {
        //            if (data.status === 'success') {
        //                //$('#form .msg').html('success').addClass('success').removeClass('error').stop(true, true).delay(3000).fadeOut(900).show();
        //                row.remove();
        //            } else {
        //                //$('#form .msg').html('error').addClass('error').removeClass('success').show();
        //            }
        //        }
        //    );
        //});

        //V1 - remove identity from view; send leftover identities to server; save identities
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
        //    //$('#form .msg').html(t('core', 'Saving...')).removeClass('success').removeClass('error').stop(true, true).show();
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
        //    //$('#form .msg').html(t('core', 'Saving...')).removeClass('success').removeClass('error').stop(true, true).show();
        //    $.post(
        //        OC.filePath('beididp', 'ajax', 'remove.eid.php'),
        //        identities,
        //        function (data) {
        //            if (data.status === 'success') {
        //                //$('#form .msg').html('success').addClass('success').removeClass('error').stop(true, true).delay(3000).fadeOut(900).show();
        //                row.remove();
        //            } else {
        //                //$('#form .msg').html('error').addClass('error').removeClass('success').show();
        //            }
        //        }
        //    );
        //});

        //Failed attempts

//        //OC.msg.startSaving('#form .msg');
//        $.ajax({
//            url: OC.filePath('beididp','ajax','remove.eid.php'),
//            dataType: 'json',
//            contentType: 'application/json; charset=UTF-8',
//            type: 'post',
//            data: {identities: JSON.stringify(identities)},
//            success: function (result) {
//                alert('Success');
//                //$('#form .msg').html("success");
//                $('#form .msg').text("success");
//                $('#form .msg').text(result.data.message);
//                //OC.msg.finishedSaving('#form .msg', result);
//                //$('#output').html(OC.filePath('beididp','templates','eid.php'));
//            },
//            error: function (result) {
//                alert('Error');
//                //$('#form .msg').html("error");
//                $('#form .msg').text("error");
//                $('#form .msg').text(result.data.message);
//                //OC.msg.finishedSaving('#form .msg', result);
//                //$('#output').html(OC.filePath('beididp','templates','eid.php'));
//            },
//            complete: function (result) {
//                alert('Complete');
//                //$('#form .msg').html("complete");
//                $('#form .msg').text("complete");
//                $('#form .msg').text(result.data.message);
//                //OC.msg.finishedSaving('#form .msg', result);
//                //$('#output').html(OC.filePath('beididp','templates','eid.php'));
//            }
//        });

//        $.post(
//            OC.filePath('beididp','ajax','remove.eid.php'), 
//            post, 
//            function (data) {
//                OC.msg.finishedSaving('#form .msg', data);
//            }
//        );

//        $.post(
//            OC.filePath('beididp','ajax','remove.eid.php'),
//            {identities: identities},
//            function (result) {
//                if (result.status != 'success') {
//                    OC.Notification.show(t('admin', result.data.message));
//                } else {
//                    alert('Alert: Error');
//                }
//            }
//        );

//        $.post(
//            OC.filePath('beididp','ajax','remove.eid.php'), 
//            {ids: identities}, 
//            function (data) {
//                if (data.status != 'success') {
//                    alert("Error : " + data.data.message);
//                } else {
//                    alert("Success");
//                }
//        }, 'json');

//        $.post(
//            OC.filePath('beididp','ajax','remove.eid.php'), 
//            post, 
//            function (data) {
//                if (data.status == "success") {
//                    alert("Success");
//                } else {
//                    alert("Error : " + data.data.message);
//                }
//        });

//        $.post(OC.filePath('beididp','ajax','remove.eid.php'), post, function (data) {
//            $('#form .msg').text('Finished: ' + data);
//            alert('Finished: ' + data);
//        }); 

//        $.post(OC.filePath('beididp', 'ajax', 'remove.eid.php'), data, function (result) {
//            OC.msg.finishedSaving('#form .msg', result);
//        });

//        $.post(OC.filePath('beididp', 'ajax', 'remove.eid.php', function () {
//            alert("success");
//        })
//            .done(function () {
//                alert("second success");
//            })
//            .fail(function () {
//                alert("error");
//            })
//            .always(function () {
//                alert("finished");
//            })
//        );

//        OC.msg.startSaving('#form .msg');
//        var post = $('#form').serialize();
//        $.post(OC.filePath('beididp', 'ajax', 'add.eid.php'), post, function (result) {
//            OC.msg.finishedSaving('#form .msg', result);
//        });
//            
//        $.get(
//            OC.generateUrl('/owncloud/index.php/apps/beididp/templates/eid.php'),
//            function (result) {
//                alert("finish");
//            }
//        );
            
//        var post = $("#passwordform").serialize();
//        $.post(OC.generateUrl('/settings/personal/changepassword'), post, function (data) {
//            if (data.status === "success") {
//                $('#pass1').val('');
//                $('#pass2').val('');
//                $('#passwordchanged').show();
//            } else {
//                if (typeof (data.data) !== "undefined") {
//                    $('#passworderror').html(data.data.message);
//                } else {
//                    $('#passworderror').html(t('Unable to change password'));
//                }
//                $('#passworderror').show();
//            }
//        });
            
//        $.ajax({
//            url: OC.filePath('beididp', 'templates', 'eid.php'),
//            type: 'post',
//            data: {},
//            complete: function (result) {
//                $('#output').html(OC.filePath('beididp', 'templates', 'eid.php'));
//            },
//            error: function () {
//                $('#output').html(OC.filePath('beididp', 'templates', 'eid.php'));
//            }
//        });
            
//        $('#identities').on('click', 'td.remove > a', function () {
//            alert('Hello from your script file');
//            var row = $(this).parent().parent();
//            $.post(OC.generateUrl('settings/ajax/removeRootCertificate'), {
//                cert: row.data('name')
//            });
//            row.remove();
//            return true;
//        });

        //Other functions

        $('#submit').click(function () {
            alert('#submit.click()');
        });

//        $("#form").submit(function (event) {
//            event.preventDefault();
//        });

    });

})(jQuery, OC);
