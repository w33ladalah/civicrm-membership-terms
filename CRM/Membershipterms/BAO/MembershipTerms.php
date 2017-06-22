<?php
require_once 'CRM/Membershipterms/DAO/MembershipTerms.php';

class CRM_Membershipterms_BAO_MembershipTerms extends CRM_Membershipterms_DAO_MembershipTerms {

  /**
   * Create a new MembershipsTerms based on array-data
   *
   * @param array $params key-value pairs
   * @return CRM_Membershipterms_DAO_MembershipsTerms|NULL
   *
   */
  public static function create($params) {
    $className = 'CRM_Membershipterms_DAO_MembershipsTerms';
    $entityName = 'MembershipsTerms';
    $hook = empty($params['id']) ? 'create' : 'edit';

    CRM_Utils_Hook::pre($hook, $entityName, CRM_Utils_Array::value('id', $params), $params);
    $instance = new $className();
    $instance->copyValues($params);
    $instance->save();
    CRM_Utils_Hook::post($hook, $entityName, $instance->id, $instance);

    return $instance;
  }

}
