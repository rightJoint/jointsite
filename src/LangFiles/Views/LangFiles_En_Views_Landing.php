<?php
class LangFiles_En_Views_Landing extends LangFiles_En_Views_SiteView
{
    static public function getLangHead():stdClass
    {
        $langHead = parent::getLangHead();

        $langHead->description = 'Developing and supporting web-sites: creating web-sites, integration with api of external services like payment systems, social networks e t.c., '.
            'business-process automation, scripts optimization, layout, settings up git-repositories and ci/cd. '.
            'Programming on php and c#. Pop services: php, c#, js, html, git, docker, crm.';
        $langHead->title = 'IT-services';

        return $langHead;
    }

    static public function getLangHeader():stdClass
    {
        $langHeader = parent::getLangHeader();
        $langHeader->h1 = 'Hiring programmer';

        return $langHeader;
    }

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
        $titleBlock->advantages_list_3 = 'Team player';
        $titleBlock->advantages_list_4 = 'Without intermediaries';
        $titleBlock->advantages_list_5 = 'Flexible pricing and discount system';
        $titleBlock->ask_q_1 = 'Ask me your questions on ';
        $titleBlock->ask_q_2 = 'Telegram';
        $titleBlock->ask_q_3 = 'or';
        $titleBlock->ask_q_4 = 'leave a request';
        $titleBlock->ask_q_5 = 'on this site';

        $langPageContent->titleBlock = $titleBlock;


        $langPageContent->artLang = self::getLangLandingArt();

        $contactsBlock = new stdClass();

        $contactsBlock->address_f = 'Address';
        $contactsBlock->address_v = 'Russia, Ivanovo, 8-Match st., b. 32, «Silver city» mall, public hall';
        $contactsBlock->Schedule_f = 'Schedule';
        $contactsBlock->Schedule_v = 'Weekdays 9.00 am - 6.00pm +4 UTC';
        $contactsBlock->phone_f = 'Phone';

        $langPageContent->contactsBlock = $contactsBlock;

        $popServ = new stdClass();

        $popServ->h2 = 'Pop services';
        $popServ->btn_buy = 'Buy';
        $popServ->more_txt = 'one more';

        $langPageContent->popServ = $popServ;

        return $langPageContent;
    }

    static public function getLangLandingArt():\stdClass
    {
        $artLang = new stdClass();
        $artLang->h2 = 'IT-Blog';
        $artLang->article = 'Article';
        $artLang->from = 'from';
        $artLang->written = 'Issued';
        $artLang->arts = 'articles';
        $artLang->tags = 'tags';
        return $artLang;
    }
}
