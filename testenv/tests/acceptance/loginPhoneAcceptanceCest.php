<?php 
/**
 * [Documentation] This will test the logging in of a user via their phone number.
 */
class loginPhoneAcceptanceCest
{
    public function loginViaPhone(AcceptanceTester $I, Page\Acceptance\LoginPO $loginUser)
    {
        $phoneNumber = $_ENV['MOBILENO'];

        $loginUser->login($phoneNumber);
        $loginUser->assertAOPageElements();
    }
}
