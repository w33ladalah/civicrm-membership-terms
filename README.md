# CiviCRM Membership Terms

A CiviCRM extension to save and display membership terms.

Below is description about how this extension works:
The main file is membershipterms.php which contains several CiviCRM hooks implementation:
   - To create membership terms records when membership renew event triggered. I am create function _membershipterms_civicrm_post_ which is implementation of _hook_civicrm_post_ hook.
   - To display membership terms record I am creating function _membershipterms_civicrm_tabset_ which implement _hook_civicrm_tabset_ hooks.
   - I am creating helper functions to process membership start and end date to membership terms. I put this functions to a file in _helper/functions.php_

