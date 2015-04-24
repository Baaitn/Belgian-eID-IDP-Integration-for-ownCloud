<?php
/**
 * ownCloud - Belgian eID IDP Integration
 *
 * This file is licensed under the Affero General Public License version 3 or 
 * later. See the COPYING file.
 *
 * @author Bert Maerten <maerten.bert@outlook.com>
 * @copyright Bert Maerten 2015
 */
?>

<div class="section">
    <h2><?php p($l->t('Belgian eID IDP Integration')); ?></h2>
    <form id="form" method="post">
        <label for="edit-beididp-idp-url"><?php p($l->t('eID IDP endpoint')); ?></label>
        <input id="edit-beididp-idp-url" name="beididp_idp_url" type="text" value="<?php p($_['beididp_idp_url']) ?>" maxlength="255" style="width: 500px"/><br/>
        <em><?php p($l->t('The HTTPS URL to the OpenID endpoint of the Belgian eID Identity Provider.')); ?></em><br/>
        <br/>
        <input id="edit-beididp-no-mail-verify" name="beididp_no_mail_verify" type="checkbox" value="1"<?php if ($_['beididp_no_mail_verify'] == 'true') { print_unescaped(' checked="checked"'); } ?>/>  
        <label for="edit-beididp-no-mail-verify"><?php p($l->t('No email verification required for eID accounts')); ?></label><br/>
        <em><?php p($l->t('Never require email verification when a visitor creates a new account using his/her eID-card.')); ?></em><br/>
        <input id="edit-beididp-https-required" name="beididp_https_required" type="checkbox" value="1"<?php if ($_['beididp_https_required'] == 'true') { print_unescaped(' checked="checked"'); } ?>/>  
        <label for="edit-beididp-https-required"><?php p($l->t('Require HTTPS on eID login')); ?></label><br/>
        <em><?php p($l->t('HTTPS must be activated to prevent cookie/session hijacking.')); ?></em><br/>
        <input id="edit-beididp-hash-claimed-id" name="beididp_hash_claimed_id" type="checkbox" value="1"<?php if ($_['beididp_hash_claimed_id'] == 'true') { print_unescaped(' checked="checked"'); } ?>/>  
        <label for="edit-beididp-hash-claimed-id"><?php p($l->t('Apply hash function to BeIDIDP identity')); ?></label><br/>
        <em><?php p($l->t('Enable this option to hash the unique National Registry Number (part of the BeidIDP Identity) before storing it in the database.')); ?></em><br/>
        <br/>
        <!--<input id="submit" name="submit" type="submit" value="<?php p($l->t('Save')); ?>"/>-->
        <span class="msg"></span>
    </form>
</div>
