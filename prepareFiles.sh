#!/bin/bash
if [ -d "l10n" ]; then
  echo "civicrm l10n folder is ready."
  echo "Ready to pull newest files from github."
  cd l10n && git pull
  cd ../
else
  git clone git@github.com:civicrm/l10n.git
fi

echo "Ready to download newest netiCRM translated po files."
wget -O civicrm.po "https://raw.githubusercontent.com/NETivism/netiCRM/hotfix/l10n/zh_TW/civicrm.po"
echo "Finished to download newest netiCRM translated po files."