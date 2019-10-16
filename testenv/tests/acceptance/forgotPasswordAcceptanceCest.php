<?php 
/**
 * [Documentation] This will test the logging in the user via their email. 
 * After successfully logging in, it will assert some the Account Overview page elements.
 */
class forgotPasswordAcceptanceCest
{
    public function forgotPasswordRedirect(AcceptanceTester $I, \Page\Acceptance\LoginPO $loginUser)
    {
        $userEmail = $_ENV['EMAIL'];

        $loginUser->openForgotPasswordLink($userEmail);
    }
}