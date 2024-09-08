<?php
//php ./vendor/bin/phpunit tests/core/NotificationTest.php
require_once "application/core/model_pdo.php";
require_once "application/core/ntSendModel.php";

class NotificationTest extends PHPUnit\Framework\TestCase
{
    public $ntfModel;
    private $check_templates;

    protected function setUp(): void
    {
        require_once "tests/setEnvir.php";

        $this->ntfModel = $this->getMockBuilder('ntSendModel')->onlyMethods(array("sendOnEmail"))->getMock();
        $this->ntfModel->expects($this->once())->method("sendOnEmail");

        $this->check_templates = array(
            'changePassForUser' => 'A944C068-D109-44FD-B4BA-11258C2DB407',
            'welcomeFromSiteForUser' => 'A39A0281-C4F8-4C79-9857-CF848F38FE08',
            'newUserOnSite-site' => '8ED2AC47-8F84-4C01-92BB-81FBCA278D8C',
        );
    }

    protected function tearDown(): void
    {

    }

    public function testNotificationSend()
    {
        $addNtf_res = $this->ntfModel->AddNtf($this->check_templates["welcomeFromSiteForUser"], "user",
            "F42F81F8-1300-41CA-89BB-36BD7417BE1E", "xxx", true, "phpMailer");
        $this->assertEquals(true, $addNtf_res);
    }
}