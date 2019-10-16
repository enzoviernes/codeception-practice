<?php 
/**
 * [Documentation] This will test the logging in the user via their email. 
 * After successfully logging in, it will assert some the Account Overview page elements.
 */
class loginEmailAcceptanceCest
{
    public function loginViaEmail(AcceptanceTester $I, \Page\Acceptance\LoginPO $loginUser)
    {
        $userEmail = $_ENV['EMAIL'];

        $loginUser->login($userEmail);
        $loginUser->assertAOPageElements();
    }
}