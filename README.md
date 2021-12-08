# Update civicrm l10n from scaning untranlsated wording in netiCRM translated text file.

## Step

1. Execute `prepareFiles.sh`. It will pull civicrm transifex setting files from [the github repository](https://github.com/civicrm/l10n) and download the newest netiCRM translate text file.
2. Execute `php doUpdatePO.php` file. It will check all the zh_TW untranlated wording in civicrm po folder, search for translated text in netiCRM po file. And if there are translated text, insert to `msgstr ""` text in origin po file.
3. Please use git or diff tool to check the po files in `l10n/po/zh_TW/`. Make sure the formatted and difference is correct.
4. Execute `pushPOtoTransifex.sh`. It will execute push command to civicrm zh_TW transifex project.