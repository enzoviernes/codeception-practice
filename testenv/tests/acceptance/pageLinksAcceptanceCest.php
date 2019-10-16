<?php 
/**
 * [Documentation] This will test the links available in the login page; this includes the mobile app, footer, and register links.
 */
class pageLinksAcceptanceCest
{
    public function appLinks(AcceptanceTester $I, Page\Acceptance\LoginPO $loginUser)
    {
        $loginUser->openAppLinks();
    }

    public function footerLinks(AcceptanceTester $I, Page\Acceptance\LoginPO $loginUser)
    {
        $loginUser->openFooterLinks();
    }

    public function bodyLinks(AcceptanceTester $I, Page\Acceptance\LoginPO $loginUser)
    {
        $loginUser->openBodyLink();
    }
}
