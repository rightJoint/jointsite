<?php
class LangFiles_Ru_Views_User_Validate extends LangFiles_Ru_Views_SiteView
{
    public static function getLangHead(): stdClass
    {
        $langHead = parent::getLangHead();

        $langHead->title = 'Подтверждение email';
        return $langHead;
    }

    public static function getLangHeader(): stdClass
    {
        $langHeader = parent::getLangHeader();
        $langHeader->h1 = 'Подтверждение email';

        return $langHeader;
    }

    public static function getLangPageContent(): stdClass
    {
        $langPageContent = parent::getLangPageContent();
        $langPageContent->vldErr['undefined'] = 'Неизвестная ошибка подтверждения???';
        $langPageContent->vldErr['repeated'] = 'вы уже подтверждали свой eMail?!';
        $langPageContent->vldErr['success'] = 'Подтверждение eMail успешно))) Воспользуйтесь меню для продолжения';
        return $langPageContent;
    }
}