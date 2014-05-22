<?php
/**
 *
 * Class BasicUtilityTest
 */
class BasicUtilityTest extends PHPUnit_Framework_TestCase {

  public function testDefaults() {

    $myConfiguration = array(
      "someOther" => 10
    );

    $defaultsSettings = array(
      "someDefault" => 7
    );

    $finalConfiguration = UsabilityDynamics\Utility::defaults( $myConfiguration, $defaultsSettings );

    $this->assertEquals( 7,   $finalConfiguration->someDefault );
    $this->assertEquals( 10,  $finalConfiguration->someOther );

  }

}
