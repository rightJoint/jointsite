<?php
class LangFiles_En_Views_Landing extends LangFiles_En_Views_SiteView
{
    static public function getLangPageContent():\stdClass
    {
        $langPageContent = parent::getLangPageContent();

        $titleBlock = new stdClass();
        $titleBlock->invoke = 'Programming on php and c#';
        $titleBlock->invoke_cm = 'Developing new and maintenance existing software, business process automation';
        $titleBlock->st_txt1 = 'Analytical approach';
        $titleBlock->st_txt2 = 'Responsible for the execution';
        $titleBlock->st_txt3 = 'Solving complex problems';
        $titleBlock->thought = 'By entrusting your tasks to a specialist, you do not have to worry '.
            'that everything will be done correctly and on time.';
        $titleBlock->cb_txt = 'Call now';
        $titleBlock->advantages_list_1 = 'More than 10 years of experience in the IT field';
        $titleBlock->advantages_list_2 = 'Good reputation';
        $titleBlock->advantages_list_3 = 'Work experience in the bank';
        $titleBlock->advantages_list_4 = 'Without intermediaries';
        $titleBlock->advantages_list_5 = 'Flexible pricing and discount system';
        $titleBlock->ask_q_1 = 'Ask me your questions on ';
        $titleBlock->ask_q_2 = 'Telegram';
        $titleBlock->ask_q_3 = 'or';
        $titleBlock->ask_q_4 = 'leave a request';
        $titleBlock->ask_q_5 = 'on this site';

        $langPageContent->titleBlock = $titleBlock;

        $jointPass = new stdClass();

        $artLang = new stdClass();
        $artLang->h2 = 'IT-Блог';

        $langPageContent->artLang = $artLang;

        $contactsBlock = new stdClass();

        $contactsBlock->address_f = 'Address';
        $contactsBlock->address_v = 'Russia, Ivanovo, 8-Match st., b. 32, «Silver city» mall, public hall';
        $contactsBlock->Schedule_f = 'Schedule';
        $contactsBlock->Schedule_v = 'mon. - fri. 9.00 am - 6.00pm +4 UTC, sat., sun. - days off';
        $contactsBlock->phone_f = 'Phone';

        $langPageContent->contactsBlock = $contactsBlock;

        $popServ = new stdClass();

        $popServ->h2 = 'Pop services';
        $popServ->btn_buy = 'Buy';
        $popServ->more_txt = 'one more';

        $langPageContent->popServ = $popServ;

        return $langPageContent;
    }
    /*
    function __construct()
    {

        $this->head["h1"] = "Услуги разработчика";
        $this->head["title"] = "Наёмный программист";
        $this->head["description"] = "Наёмный программист RightJoint: программирование на php и c#. Создание нового и поддержка существующего софта. ".
            "Бесплатно продукт jointPass - органайзер паролей, скачать. ".
            "Популярные услуги: php, c#, js, html, git, ";

        $this->producth2 = "Мои продукты - бесплатно";
    );
    }
    */
}
