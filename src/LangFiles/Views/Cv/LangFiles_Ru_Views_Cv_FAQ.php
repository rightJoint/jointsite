<?php
class LangFiles_Ru_Views_Cv_FAQ extends LangFiles_Ru_Views_Cv_Main
{
    static public function getLangHead():stdClass
    {
        $langHead = parent::getLangHead();

        $langHead->description = 'Мой опыт работы, профессиональные навыки, ответы на часто задаваемые вопросы.';
        $langHead->title = 'Резюме - часто задаваемые вопросы';

        return $langHead;
    }
    static public function getLangHeader():stdClass
    {
        $langHeader = parent::getLangHeader();
        $langHeader->h1 = 'Резюме - часто задаваемые вопросы';
        return $langHeader;
    }

}
