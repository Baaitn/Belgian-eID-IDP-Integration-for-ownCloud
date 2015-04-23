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
           
                //eventhandlers
                $('input[name^=beididp_]').change(addEventHandler);
                $('select[name^=beididp_]').change(addEventHandler);
                
                //functions
                function addEventHandler(event) {
                    event.preventDefault();
                    saveSettings();
                    saveSites();
                }
                
                
                function saveSettings() {
                    OC.msg.startSaving('#beididp .msg');
                    var post = $('#beididp').serialize();
                    $.post( OC.filePath('beididp','ajax','admin.php') , post, function(data) {
                        OC.msg.finishedSaving('#beididp .msg', data);
                    });
                }
                
                function saveSites() {
                    OC.msg.startSaving('#external .msg');
                    var post = $('#external').serialize();
                    $.post(OC.filePath('external', 'ajax', 'setsites.php'), post, function (data) {
                        OC.msg.finishedSaving('#external .msg', data);
                    });
                }

	});

})(jQuery, OC);