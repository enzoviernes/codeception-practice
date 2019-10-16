<?php 
/**
 * [Documentation] This tests the changing of site's language. 
 * After changing it will assert the title text of the login for if it is correct.
 */
class changeLanguageAcceptanceCest
{
    public function changeToLithuanian(AcceptanceTester $I, Page\Acceptance\LoginPO $changer)
    {
        $language = 'lietuvių';

        $changer->changeLanguage($language);
        $I->waitForText('PRISIJUNKITE', 30);
        $I->amOnPage('/lt/login');
    }

    public function changeToRussian(AcceptanceTester $I, Page\Acceptance\LoginPO $changer)
    {
        $language = 'русский';

        $changer->changeLanguage($language);
        $I->waitForText('ВОЙТИ В СИСТЕМУ', 30);
        $I->amOnPage('/ru/login/');
    }

    public function changeToLatvian(AcceptanceTester $I, Page\Acceptance\LoginPO $changer)
    {
        $language = 'latviešu';

        $changer->changeLanguage($language);
        $I->waitForText('PIESLĒGTIES', 30);
        $I->amOnPage('/lv/login/');
    }

    public function changeToPolish(AcceptanceTester $I, Page\Acceptance\LoginPO $changer)
    {
        $language = 'polski';

        $changer->changeLanguage($language);
        $I->waitForText('ZALOGUJ SIĘ', 30);
        $I->amOnPage('/pl/login/');
    }

    public function changeToBulgarian(AcceptanceTester $I, Page\Acceptance\LoginPO $changer)
    {
        $language = 'български';

        $changer->changeLanguage($language);
        $I->waitForText('ВХОД', 30);
        $I->amOnPage('/bg/login/');
    }

    public function changeToSpanish(AcceptanceTester $I, Page\Acceptance\LoginPO $changer)
    {
        $language = 'español';

        $changer->changeLanguage($language);
        $I->waitForText('INICIA', 30);
        $I->amOnPage('/es/login/');
    }

    public function changeToEstonian(AcceptanceTester $I, Page\Acceptance\LoginPO $changer)
    {
        $language = 'eesti';

        $changer->changeLanguage($language);
        $I->waitForText('LOGI SISSE', 30);
        $I->amOnPage('/et/login/');
    }

    public function changeToDeutsch(AcceptanceTester $I, Page\Acceptance\LoginPO $changer)
    {
        $language = 'Deutsch';

        $changer->changeLanguage($language);
        $I->waitForText('MELDEN SIE SICH AN', 30);
        $I->amOnPage('/de/login/');
    }

    public function changeToRomanian(AcceptanceTester $I, Page\Acceptance\LoginPO $changer)
    {
        $language = 'română';

        $changer->changeLanguage($language);
        $I->waitForText('CONECTARE', 30);
        $I->amOnPage('/ro/login/');
    }
}
