<?php

require_once 'CRM/Membershipterms/DAO/MembershipTerms.php';

class CRM_Membershipterms_Page_List extends CRM_Core_Page {
  public $useLivePageJS = TRUE;

  /**
   * Get BAO Name
   *
   * @return string Classname of BAO.
   */
  public function getBAOName() {
    return 'CRM_Membershipterms_BAO_MembershipTerms';
  }

  /**
   * Get action Links
   *
   * @return array (reference) of action links
   */
  public function &links() {
    if (!(self::$_links)) {
      self::$_links = array(
        CRM_Core_Action::VIEW => array(
          'name' => ts('View'),
          'url' => 'civicrm/contact/view/membership',
          'qs' => 'id=%%id%%&reset=1&cid=%%cid%%&action=view',
          'title' => ts('View Membership')
        )
      );
    }
    return self::$_links;
  }

  public function run() {
    CRM_Utils_System::setTitle(ts('Membership Terms'));

    $contactId = CRM_Utils_Request::retrieve('id', 'Positive', $this, FALSE);
    $contact = civicrm_api3('Membership', 'getsingle', array(
      'return' => array("contact_id", "start_date", "end_date"),
      'contact_id' => $contactId,
    ));
    $rows = civicrm_api3('MembershipTerms', 'get', array(
      'membership_id' => $contact['id'],
    ));

    $this->assign('contact_id', $contactId);
    $this->assign('membership_start', $contact['start_date']);
    $this->assign('membership_end', $contact['end_date']);
    $this->assign('rows', $rows);

    parent::run();
  }

}
