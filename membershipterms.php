<?php

require_once 'membershipterms.civix.php';
require_once 'helper/functions.php';

/**
 * Implements hook_civicrm_config().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_config
 */
function membershipterms_civicrm_config(&$config) {
  _membershipterms_civix_civicrm_config($config);
}

/**
 * Implements hook_civicrm_xmlMenu().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_xmlMenu
 */
function membershipterms_civicrm_xmlMenu(&$files) {
  _membershipterms_civix_civicrm_xmlMenu($files);
}

/**
 * Implements hook_civicrm_install().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_install
 */
function membershipterms_civicrm_install() {
  _membershipterms_civix_civicrm_install();
}

/**
 * Implements hook_civicrm_postInstall().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_postInstall
 */
function membershipterms_civicrm_postInstall() {
  _membershipterms_civix_civicrm_postInstall();
}

/**
 * Implements hook_civicrm_uninstall().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_uninstall
 */
function membershipterms_civicrm_uninstall() {
  _membershipterms_civix_civicrm_uninstall();
}

/**
 * Implements hook_civicrm_enable().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_enable
 */
function membershipterms_civicrm_enable() {
  _membershipterms_civix_civicrm_enable();
}

/**
 * Implements hook_civicrm_disable().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_disable
 */
function membershipterms_civicrm_disable() {
  _membershipterms_civix_civicrm_disable();
}

/**
 * Implements hook_civicrm_upgrade().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_upgrade
 */
function membershipterms_civicrm_upgrade($op, CRM_Queue_Queue $queue = NULL) {
  return _membershipterms_civix_civicrm_upgrade($op, $queue);
}

/**
 * Implements hook_civicrm_managed().
 *
 * Generate a list of entities to create/deactivate/delete when this module
 * is installed, disabled, uninstalled.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_managed
 */
function membershipterms_civicrm_managed(&$entities) {
  _membershipterms_civix_civicrm_managed($entities);
}

/**
 * Implements hook_civicrm_caseTypes().
 *
 * Generate a list of case-types.
 *
 * Note: This hook only runs in CiviCRM 4.4+.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_caseTypes
 */
function membershipterms_civicrm_caseTypes(&$caseTypes) {
  _membershipterms_civix_civicrm_caseTypes($caseTypes);
}

/**
 * Implements hook_civicrm_angularModules().
 *
 * Generate a list of Angular modules.
 *
 * Note: This hook only runs in CiviCRM 4.5+. It may
 * use features only available in v4.6+.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_angularModules
 */
function membershipterms_civicrm_angularModules(&$angularModules) {
  _membershipterms_civix_civicrm_angularModules($angularModules);
}

/**
 * Implements hook_civicrm_alterSettingsFolders().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_alterSettingsFolders
 */
function membershipterms_civicrm_alterSettingsFolders(&$metaDataFolders = NULL) {
  _membershipterms_civix_civicrm_alterSettingsFolders($metaDataFolders);
}

// --- Functions below this ship commented out. Uncomment as required. ---

/**
 * Implements hook_civicrm_preProcess().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_preProcess
 *
function membershipterms_civicrm_preProcess($formName, &$form) {

} // */

/**
 * Implements hook_civicrm_navigationMenu().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_navigationMenu
 *
 */
function membershipterms_civicrm_navigationMenu(&$menu) {
  // Create child menu under Memberships menu
  _membershipterms_civix_insert_navigation_menu($menu, 'Memberships', array(
    'label' => 'Membership Terms',
    'name' => 'membership_terms',
    'url' => 'civicrm/membership-terms',
    'permission' => 'administer CiviCRM',
    'operator' => 'OR',
    'separator' => 0,
  ));

  _membershipterms_civix_navigationMenu($menu);
}

/**
 * Implementation of hook_civicrm_entityTypes
 */
function membershipterms_civicrm_entityTypes(&$entityTypes) {
  $entityTypes[] = array(
    'name'  => 'MembershipTerms',
    'class' => 'CRM_Membershipterms_DAO_MembershipTerms',
    'table' => 'civicrm_membership_terms',
  );
}

/**
 * Implementation of hook_civicrm_post().
 *
 * @link https://docs.civicrm.org/dev/en/master/hooks/hook_civicrm_post/
 *
 */
function membershipterms_civicrm_post($op, $objectName, $objectId, &$objectRef) {
  if ($op != 'edit' && $objectName != 'Membership') {
    return;
  }

  $terms = _membershipterms_breakdown_terms($objectRef->start_date, $objectRef->end_date);
  foreach ($terms as $term) {
    civicrm_api3('MembershipTerms', 'create', array(
      'nth_term' => $term['nth_term'],
      'start_date' => $term['start_date'] . ' 00:00:00',
      'end_date' => $term['end_date'] . ' 23:59:59',
      'membership_id' => $objectRef->id,
    ));
  }
}

/**
 * Implementation of hook_civicrm_tabset().
 *
 * @link https://docs.civicrm.org/dev/en/master/hooks/hook_civicrm_tabset/
 *
 */
function membershipterms_civicrm_tabset($tabsetName, &$tabs, $context) {
  if ($tabsetName == 'civicrm/contact/view') {
    if (!empty($context)) {
      $contactId = $context['contact_id'];
      $url = CRM_Utils_System::url(
               'civicrm/membership-terms',
               "reset=1&id=$contactId"
             );
      $tab['membershipterms'] = array(
        'title' => ts('Membership Terms'),
        'url' => $url,
        'valid' => 1,
        'active' => 1,
        'current' => false,
      );
    } else {
      $tab['membershipterms'] = array(
      'title' => ts('Membership Terms'),
        'url' => 'civicrm/membership-terms',
      );
    }

    // $tabPosition = count($tabs);
    $tabs = array_merge(
      $tabs,
      $tab
    );
  }
}

