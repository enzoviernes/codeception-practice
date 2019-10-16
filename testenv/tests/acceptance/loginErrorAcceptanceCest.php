<?php 
/**
 * [Documentation] This will test the availability of error handling for invalid users, passwords and no registered mobile app.
 */
class loginErrorAcceptanceCest
{
    public function invalidUser(AcceptanceTester $I, Page\Acceptance\LoginPO $loginUser)
    {
        $dummy = 'dummy@email';

        $loginUser->loginInvalidUser($dummy);
    }

    public function invalidPassword(AcceptanceTester $I, Page\Acceptance\LoginPO $loginUser)
    {
        $user = $_ENV['EMAIL'];
        $password ='dummypass123';

        $loginUser->loginInvalidPassword($user, $password);
    }

    public function noMobileApp(AcceptanceTester $I, Page\Acceptance\LoginPO $loginUser)
    {    
        $user = $_ENV['EMAIL'];

        $loginUser->loginNoMobileApp($user);
    }
}
