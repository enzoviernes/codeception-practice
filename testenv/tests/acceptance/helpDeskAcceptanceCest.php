<?php 
/**
 * [Documentation] This will test if the helpdesk window is successfully opened.
 */
class helpDeskAcceptanceCest
{
    public function helpDeskAvailability(AcceptanceTester $I, Page\Acceptance\LoginPO $loginUser)
    {
        $loginUser->openHelpDesk();
    }
}
