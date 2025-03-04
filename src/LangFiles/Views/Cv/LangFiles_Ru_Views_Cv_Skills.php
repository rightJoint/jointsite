<?php
class LangFiles_Ru_Views_Cv_Skills extends LangFiles_Ru_Views_Cv_Main
{
    static public function getLangHead():stdClass
    {
        $langHead = parent::getLangHead();

        $langHead->description = 'Оченка собственных профессиональных навыков, которые чаще всего требуют в описаниях к вакансиям';
        $langHead->title = 'Резюме - профессиональные навыки';

        return $langHead;
    }
    static public function getLangHeader():stdClass
    {
        $langHeader = parent::getLangHeader();
        $langHeader->h1 = 'Резюме - профессиональные навыки';
        return $langHeader;
    }

}
