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

<div id="beididp" class="section">
    <h2><?php p($l->t('Belgian eID IDP Integration')); ?></h2>
    <em><?php p($l->t('The HTTPS URL to the OpenID endpoint of the Belgian eID Identity Provider.')); ?></em><br/>
    <!--<label for="beididp_url"><?php p($l->t('eID IDP endpoint')); ?></label>-->
    <input id="beididp_url" name="beididp_url" type="text" value="<?php p($_['beididp_url']) ?>" maxlength="255"/><br/>
    <br/>
    <!--<input id="beididp_mail" name="beididp_mail" type="checkbox" <?php // if ($_['beididp_mail'] === 'true') { print_unescaped(' checked="checked"'); } ?>/>-->
    <!--<label for="beididp_mail"><?php p($l->t('No email verification required for eID accounts')); ?></label><br/>-->
    <!--<em><?php p($l->t('Never require email verification when a visitor creates a new account using his/her eID-card.')); ?></em><br/>-->
    <!--<input id="beididp_https" name="beididp_https" type="checkbox" <?php // if ($_['beididp_https'] === 'true') { print_unescaped(' checked="checked"'); } ?>/>-->
    <!--<label for="beididp_https"><?php p($l->t('Require HTTPS on eID login')); ?></label><br/>-->
    <!--<em><?php p($l->t('HTTPS must be activated to prevent cookie/session hijacking.')); ?></em><br/>-->
    <!--<input id="beididp_hash" name="beididp_hash" type="checkbox" <?php // if ($_['beididp_hash'] === 'true') { print_unescaped(' checked="checked"'); } ?>/>-->
    <!--<label for="beididp_hash"><?php p($l->t('Apply hash function to BeIDIDP identity')); ?></label><br/>-->
    <!--<em><?php p($l->t('Enable this option to hash the unique National Registry Number (part of the BeidIDP Identity) before storing it in the database.')); ?></em><br/>-->
    <input id="beididp_hide" name="beididp_hide" type="checkbox" <?php if ($_['beididp_hide'] === 'true') { print_unescaped(' checked="checked"'); } ?>/>
    <label for="beididp_hide"><?php p($l->t('Hide username & password fields')); ?></label><br/>
    <em><?php p($l->t('Hide the default login on the frontpage, preventing users from logging in using their username and password.')); ?></em><br/>
    <br/>
    <span class="msg"></span>
</div>
