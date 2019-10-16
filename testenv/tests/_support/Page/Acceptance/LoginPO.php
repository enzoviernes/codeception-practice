<?php
namespace Page\Acceptance;
use \Codeception\Step\Argument\PasswordArgument;
use \Codeception\Util\Locator;

class LoginPO
{
    /**-------------------
     * - Login Page URLs -*
     ---------------------*/
    public static $URL = '/en/login';
    public static $privacyURL = '/v2/en/legal/privacy-policy';
    public static $serviceURL = '/v2/en/legal/general-payment-service-agreement-for-private';
    public static $recommendationURL = '/v2/en/legal/safety-recommendations';
    public static $registrationURL = '/en/registration#/';
    public static $homeURL = '/v2/en-GB/index';
    public static $forgotPasswordURL = '/en/reset-password/';
    /**-----------------------
     * - Login Page Elements -*
     -------------------------*/
    public $loginFormContainer = '.authentication-login-form-container';
    public $loginUsernameField = 'input[name="userIdentifier"]';
    public $loginPasswordField = 'input[name="password"]';
    public $loginButton = 'button[type="submit"]';
    public $mobileLoginButton = 'button[type="button"]';
    public $disabledLoginButton = 'button[type="submit"][disabled]';
    public $loginMethodsContainer = '.login-methods-container';
    public $loginMobileMethodButton = '#login-methods-heading-app_credentials';
    public $loginMobileMethodOpen = 'a[aria-controls="login-methods-body-app_credentials"][aria-expanded="true"]';
    public $loginPasswordMethodButton = '#login-methods-heading-user_credentials';
    public $loginPasswordMethodOpen = 'a[aria-controls="login-methods-body-user_credentials"][aria-expanded="true"]';
    public $loginErrorMessage = '.alert.alert-danger';
    public $changeLanguageFooter = '.react-language-list-container';
    public $changeLanguageModal = '.modal-content';
    public $changeLanguageMoreButton = '.fa.fa-plus';
    public $mobileAppLinksContainer = '.login-banner-app-providers';
    public $playStoreIconLink = 'img[alt="Google Play"]';
    public $appStoreIconLink = 'img[alt="App Store"]';
    public $playStoreLoginLink = '.fa-android';
    public $appStoreLoginLink = '.fa-apple';
    public $bankLink = 'a[href="https://www.lb.lt/en/sfi-financial-market-participants/paysera-lt-uab"]';
    public $registerLink = 'a[href="/en/registration"]';
    public $forgotPasswordLink = '.text-center a[href="/en/reset-password"]';
    public $homeLink = '.logo-container img';
    public $helpDeskLink = '.livechatlink';
    /**----------------------------------
     * - Account Overview Page Elements -*
     ------------------------------------*/
    // Note: I will create a separate resource file for this if the page has its own set of test suites
    public $acctNavBar = '.navbar-header';
    public $acctOverviewContainer = '.account-overview-page';
    public $acctBalance = '.account-balance';
    /**--------------------------
     * - Helpdesk Page Elements -*
     ----------------------------*/
    public $helpDeskBody = '#maincore';

    public static function route($param)
    {
        return static::$URL.$param;
    }

    /**
     * @var \AcceptanceTester;
     */
    protected $acceptanceTester;

    public function __construct(\AcceptanceTester $I)
    {
        $this->acceptanceTester = $I;
    }

    public function assertAOPageElements()
    {
        $I = $this->acceptanceTester;

        $I->waitForElement($this->acctNavBar, 30);
        $I->seeElement(Locator::combine($this->acctNavBar,$this->acctOverviewContainer,$this->acctBalance));
    }

    public function login($user)
    {
        $I = $this->acceptanceTester;

        $I->amOnPage(self::$URL);
        $I->seeElement($this->loginFormContainer);
        $I->fillField($this->loginUsernameField, $user);
        $I->click($this->loginButton);
        $I->waitForElement($this->loginMethodsContainer, 30);
        $I->click($this->loginPasswordMethodButton);
        $I->waitForElement($this->loginPasswordMethodOpen, 30);
        $I->waitForElement($this->loginPasswordField, 30);
        $I->fillField($this->loginPasswordField, new PasswordArgument($_ENV['PASSWORD']));
        $I->click($this->loginButton);
        $I->retry(4, 400);
    }

    public function loginInvalidUser($user)
    {
        $I = $this->acceptanceTester;

        $I->amOnPage(self::$URL);
        $I->seeElement($this->loginFormContainer);
        $I->fillField($this->loginUsernameField, $user);
        $I->click($this->loginButton);
        $I->see('The specified user could not be found', $this->loginErrorMessage);
    }

    public function loginInvalidPassword($user, $password)
    {
        $I = $this->acceptanceTester;

        $I->amOnPage(self::$URL);
        $I->seeElement($this->loginFormContainer);
        $I->fillField($this->loginUsernameField, $user);
        $I->click($this->loginButton);
        $I->waitForElement($this->loginMethodsContainer, 30);
        $I->click($this->loginPasswordMethodButton);
        $I->waitForElement($this->loginPasswordMethodOpen, 30);
        $I->waitForElement($this->loginPasswordField, 30);
        $I->fillField($this->loginPasswordField, $password);
        $I->click($this->loginButton);
        $I->see('Incorrect password. Please try again.', $this->loginErrorMessage);
    }

    public function loginNoMobileApp($user)
    {
        $I = $this->acceptanceTester;

        $I->amOnPage(self::$URL);
        $I->seeElement($this->loginFormContainer);
        $I->fillField($this->loginUsernameField, $user);
        $I->click($this->loginButton);
        $I->waitForElement($this->loginMethodsContainer, 30);
        $I->waitForElement($this->loginMobileMethodOpen, 30);
        $I->click($this->mobileLoginButton);
        $I->see('Incorrect request status', $this->loginErrorMessage);
    }

    public function changeLanguage($language)
    {
        $I = $this->acceptanceTester;

        $I->amOnPage(self::$URL);
        $I->click($this->changeLanguageMoreButton);
        $I->waitForElement($this->changeLanguageModal, 30);
        $I->click(Locator::contains('.modal-body a[href]', $language));
    }

    public function checkMobileAppDownloadLink($user)
    {
        $I = $this->acceptanceTester;

        $I->amOnPage(self::$URL);

        $I->seeElement($this->loginFormContainer);
        $I->fillField($this->loginUsernameField, $user);
        $I->click($this->loginButton);
        $I->waitForElement($this->loginMethodsContainer, 30);
        $I->waitForElement($this->loginMobileMethodOpen, 30);
        $I->click('I do not have the mobile app yet');
        $I->seeElement(Locator::combine($this->appStoreLoginLink,$this->playStoreLoginLink));
    }

    public function openAppLinks()
    {
        $I = $this->acceptanceTester;

        $I->resizeWindow(1400,900);
        $I->amOnPage(self::$URL);
        $I->seeElement(Locator::combine($this->mobileAppLinksContainer,$this->appStoreIconLink,$this->playStoreIconLink));
    }

    public function openBodyLink()
    {
        $I = $this->acceptanceTester;
        
        $I->amOnPage(self::$URL);

        $I->seeLink('Register Now!');
        $I->click($this->registerLink);
        $I->seeInCurrentUrl(self::$registrationURL);
        $I->click($this->homeLink);
        $I->seeInCurrentUrl(self::$homeURL);
    }

    public function openFooterLinks()
    {
        $I = $this->acceptanceTester;
        
        $I->amOnPage(self::$URL);

        $I->seeElement($this->bankLink);
        $I->seeLink('Bank of Lithuania');
        $I->seeLink('Privacy Policy');
        $I->click('Privacy Policy');
        $I->seeInCurrentUrl(self::$privacyURL);
        $I->moveBack();
        $I->seeLink('Service agreements');
        $I->click('Service agreements');
        $I->seeInCurrentUrl(self::$serviceURL);
        $I->moveBack();
        $I->seeLink('Recommendations for the safe usage');
        $I->click('Recommendations for the safe usage');
        $I->seeInCurrentUrl(self::$recommendationURL);
        $I->moveBack();
    }

    public function openForgotPasswordLink($user)
    {
        $I = $this->acceptanceTester;

        $I->amOnPage(self::$URL);

        $I->seeElement($this->loginFormContainer);
        $I->fillField($this->loginUsernameField, $user);
        $I->click($this->loginButton);
        $I->waitForElement($this->loginMethodsContainer, 30);
        $I->click($this->loginPasswordMethodButton);
        $I->waitForElement($this->loginPasswordMethodOpen, 30);
        $I->seeLink('Forgot password?');
        $I->click('Forgot password?');
        $I->seeInCurrentUrl(self::$forgotPasswordURL);
    }

    public function openHelpDesk()
    {
        $I = $this->acceptanceTester;

        $I->amOnPage(self::$URL);
        $I->click($this->helpDeskLink);
        $I->switchToNewWindow();
        $I->waitForElement($this->helpDeskBody, 30);
        $I->switchToWindow();
    }
}
