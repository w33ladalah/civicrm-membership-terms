<?php

/**
 * Calculate total terms from start date to end date
 * @param $startDate string
 * @param $endDate string
 * @return integer
 *
 */
function _membershipterms_calculate_total_terms($startDate, $endDate) {
  if (strtotime($endDate) <= strtotime($startDate)) {
    return 0;
  }

  $sDate = new DateTime($startDate);
  $eDate = new DateTime($endDate);

  $dateDiff = $eDate->diff($sDate);

  return intval($dateDiff->y);
}

/**
 * Break down membership start date and end date to per year terms/periods
 * @param $startDate string
 * @param $endDate string
 * @return array
 *
 */
function _membershipterms_breakdown_terms($startDate, $endDate) {
  $membershipStartDate = date("Y-m-d", strtotime($startDate));
  $membershipEndDate = date("Y-m-d", strtotime('+1 day', strtotime($endDate)));
  $totalTerms = _membershipterms_calculate_total_terms($membershipStartDate, $membershipEndDate);
  $terms = array();
  $lastDate = null;
  for ($i=0; $i < $totalTerms; $i++) {
    $termStartDate = $lastDate == null ? $membershipStartDate : date('Y-m-d', strtotime($lastDate));
    $termEndDate = date('Y-m-d', strtotime('+1 year', strtotime($termStartDate)));
    $terms[] = array(
                      'nth_term' => $i + 1,
                      'start_date' => $termStartDate,
                      'end_date' => date('Y-m-d', strtotime('-1 day', strtotime($termEndDate)))
                    );
    $lastDate = $termEndDate;
  }
  return $terms;
}
