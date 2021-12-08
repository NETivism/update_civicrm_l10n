#!/bin/bash
if [ -d "l10n" ]; then
  echo "civicrm l10n folder is ready."
  echo "Ready to push translated words to transifex."
  cd l10n
  for file in po/zh_TW/*
  do
    resourceName=`echo $file | cut -d'/' -f 3 | cut -d'.' -f 1`
    tx push -l zh_TW -r civicrm.$resourceName -t
  done
else
  echo "civicrm l10n folder is not ready. Please begin from executing prepareFiles.sh."
fi