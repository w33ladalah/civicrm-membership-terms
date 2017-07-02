<?php

class CRM_Membershipterms_HelperTest extends \PHPUnit\Framework\TestCase {

  /**
   * Test 1: calculating terms.
   */
  public function testCalculateTotalTerms() {
    $startDate = '2017-01-01';
    $endDate = '2019-12-31';

    $totalTerms = _membershipterms_calculate_total_terms($startDate, $endDate);

    $this->assertTrue(is_int($totalTerms));
    $this->assertEquals(2, $totalTerms);
  }

  /**
   * Test 2: if start date same as end date.
   */
  public function testCalculateTotalTermsDayDateIsEquals() {
    $startDate = '2017-12-01';
    $endDate = '2019-12-01';

    $totalTerms = _membershipterms_calculate_total_terms($startDate, $endDate);

    $this->assertTrue(is_int($totalTerms));
    $this->assertEquals(2, $totalTerms);
  }

  /**
   * Test 3: if end date less than start date.
   */
  public function testCalculateTotalTermsEndDateLessThanStartDate() {
    $startDate = '2017-01-01';
    $endDate = '2017-12-31';

    $totalTerms = _membershipterms_calculate_total_terms($startDate, $endDate);

    $this->assertTrue(is_int($totalTerms));
    $this->assertEquals(0, $totalTerms);
  }

  /**
   * Test 4: if end date less than start date.
   */
  public function testCalculateTotalTermsEmptyInputs() {
    $startDate = '';
    $endDate = '';

    $totalTerms = _membershipterms_calculate_total_terms($startDate, $endDate);

    $this->assertTrue(is_int($totalTerms));
    $this->assertEquals(0, $totalTerms);
  }

  /**
   * Test 5: breakdown the date range into per year terms.
   */
  public function testBreakdownTerms() {
    $startDate = '2017-01-01';
    $endDate = '2019-12-31';

    $terms = _membershipterms_breakdown_terms($startDate, $endDate);

    $expected = array(
      array(
        'nth_term' => 1,
        'start_date' => '2017-01-01',
        'end_date' => '2017-12-31'
      ),
      array(
        'nth_term' => 2,
        'start_date' => '2018-01-01',
        'end_date' => '2018-12-31'
      ),
      array(
        'nth_term' => 3,
        'start_date' => '2019-01-01',
        'end_date' => '2019-12-31'
      ),
    );

    $this->assertTrue(is_array($expected));
    $this->assertEquals($expected, $terms);
    $this->assertEquals(3, count($terms));
  }

  /*
   * Test 6: breakdown the date range no inputs.
   */
  public function testBreakdownTermsEmptyInputs() {
    $startDate = '';
    $endDate = '';

    $terms = _membershipterms_breakdown_terms($startDate, $endDate);

    $expected = array();

    $this->assertTrue(is_array($expected));
    $this->assertEquals($expected, $terms);
    $this->assertEquals(0, count($terms));
  }

}
