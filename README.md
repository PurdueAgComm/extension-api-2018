# Extension API for Purdue Ag

## Summary

The API implementation lives in the lib directory.  I've namespaced it so porting to a composer.json autoload should work when using PSR-4.

In public_html is a set of example pages/templates for usage.  The public_html/app/functions.php is a set of wrapper functions for the lib to bring the API results into the templates.

## Framework Notes

### Routes

* / - Routes to the main intHomeID=1 presence (absolute)
* /{county} - Routes to the home page for the county (absolute)
* category/{id} - Routes to a category page (relative)
* subcategory/{id} - Routes to a subcategory page (relative)
* events - Routes to the all events page (relative)
* event/{id} - Routes to a specific event page (relative)
* label/{id} - Routes to a an article list page filtered by label (relative)
* about - Routes to an about page (relative)
* article/{id} - Routes to an article page (relative)
* profile/{alias} - Routes to a profile page (relative)

## Direct API Usage

Require the lib/SFP/PurdueAg/src/ExtDCR.php in your application.  The public_html/app/functions.php is a suggestion on how to go about usage, but you can certainly use the API library directly if you prefer.

## Developer Notes

The vagrant box referenced in Vagrantfile is specific to SFP dev environment only.  This can be updated to use publicly available vagrant boxes if time and budget allows.

## Developers

* purduekenny (Kenny Wilson)
* sfp-john (John Alder)