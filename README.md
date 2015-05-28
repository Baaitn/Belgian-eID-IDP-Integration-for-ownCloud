# Belgian eID IDP Integration
An app for ownCloud that allows users to authenticate with their Belgian eID card using e-Contract.be's OpenID Identity provider.

## Installation
Upload this to **owncloud/apps/beididp** and navigate to the 'Apps' page. Choose the category 'Not enabled'. Then click the 'Enable' button of 'Belgian eID IDP Integration'.

Make sure to copy **beididp/templates/login.php** and **beididp/templates/openid.php** to **owncloud/core/templates**. Don't forget to backing up the original **login.php** in case you want to uninstall this app.

## Publish to App Store

First get an account for the [App Store](http://apps.owncloud.com/) then run:

    make appstore

**ocdev** will ask for your App Store credentials and save them to ~/.ocdevrc which is created afterwards for reuse.

If the <ocsid> field in **appinfo/info.xml** is not present, a new app will be created on the appstore instead of updated. You can look up the ocsid in the app page URL, e.g.: **http://apps.owncloud.com/content/show.php/News?content=168040** would use the ocsid **168040**

## Running tests
After [Installing PHPUnit](http://phpunit.de/getting-started.html) run:

    phpunit -c phpunit.xml
