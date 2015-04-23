# Belgian eID IDP Integration
An app for ownCloud that allows users to authenticate with their Belgian eID card using e-Contract.be's OpenID Identity provider.

## Installation
Upload this app to **owncloud/apps/**.
Navigate to the 'Apps' page and choose 'Not enabled'. Then click the 'Enable' button.

## Publish to App Store

First get an account for the [App Store](http://apps.owncloud.com/) then run:

    make appstore

**ocdev** will ask for your App Store credentials and save them to ~/.ocdevrc which is created afterwards for reuse.

If the <ocsid> field in **appinfo/info.xml** is not present, a new app will be created on the appstore instead of updated. You can look up the ocsid in the app page URL, e.g.: **http://apps.owncloud.com/content/show.php/News?content=168040** would use the ocsid **168040**

## Running tests
After [Installing PHPUnit](http://phpunit.de/getting-started.html) run:

    phpunit -c phpunit.xml
