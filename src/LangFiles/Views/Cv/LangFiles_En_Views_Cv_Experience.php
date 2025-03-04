<?php
class LangFiles_En_Views_Cv_Experience extends LangFiles_En_Views_Cv_Main
{
    static public function getLangHead():stdClass
    {
        $langHead = parent::getLangHead();

        $langHead->description = 'Мой опыт работы, профессиональные навыки, ответы на часто задаваемые вопросы.';
        $langHead->title = 'Резюме - опыт работы';

        return $langHead;
    }
    static public function getLangHeader():stdClass
    {
        $langHeader = parent::getLangHeader();
        $langHeader->h1 = 'Резюме - опыт работы';
        return $langHeader;
    }

}
