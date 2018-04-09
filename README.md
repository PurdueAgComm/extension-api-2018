# Extension API for Purdue Ag

## Summary

The API implementation lives in the lib directory.  I've namespaced it so porting to a composer.json autoload should work when using PSR-4.

In public_html is a set of example pages/templates for usage.  The public_html/app/functions.php is a set of wrapper functions for the lib to bring the API results into the templates.

## Usage

Require the lib/SFP/PurdueAg/src/ExtDCR.php in your application.  The public_html/app/functions.php is a suggestion on how to go about usage, but you can certainly use the API library directly if you prefer.

## Developer Notes

The vagrant box referenced in Vagrantfile is specific to SFP dev environment only.  This can be updated to use publicly available vagrant boxes if time and budget allows.

## Developers

* purduekenny (Kenny Wilson)
* sfp-john (John Alder)