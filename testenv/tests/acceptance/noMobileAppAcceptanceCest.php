<?php 
/**
 * [Documentation] This will test the availability of links to the mobile app store for users with no mobile app attached to their account.
 */
class noMobileAppAcceptanceCest
{
    public function noMobileAppDownloadLink(AcceptanceTester $I, Page\Acceptance\LoginPO $loginUser)
    {
        $user = $_ENV['EMAIL'];

        $loginUser->checkMobileAppDownloadLink($user);
    }
}
