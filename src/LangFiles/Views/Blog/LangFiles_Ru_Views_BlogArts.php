<?php
class LangFiles_Ru_Views_BlogArts extends LangFiles_Ru_Views_SiteView
{
    static public function getLangHead():stdClass
    {
        $langHead = new stdClass();

        $langHead->updateFromArray = function ($array = []) use (&$langHead){
            if(count($array)){
                foreach ($array as $key => $value){
                    if($key=='title'){
                        $langHead->title = 'Блог-'.$value;
                    }else{
                        $langHead->$key = $value;
                    }
                }
            }
        };

        return $langHead;
    }

    static public function getLangPageContent():\stdClass
    {
        $langPageContent = parent::getLangPageContent();

        $artHeader = new stdClass();
        $artHeader->created = 'Опубликовано';
        $artHeader->refresh = 'Обновлено';
        $artHeader->tags = 'Тэги';

        $langPageContent->artHeader = $artHeader;

        $langPageContent->langArtContent = static::getLangArtContent();

        $formComments = new stdClass();
        $formComments->socialButtons = self::blogSocicalButtons();
        $formComments->artCommentNew = 'Написать новый коммент';
        $formComments->postNew = 'Написать';
        $formComments->postAnswer = 'Ответить';
        $formComments->postErrText = 'ОШИБКА';

        $langPageContent->formComments = $formComments;

        $langPageContent->landFilter = self::getLangCommentsFilter();

        $langPageContent->commentsH3 = 'Комментарии';

        $langPageContent->langList = self::getLangCommentsList();

        return $langPageContent;
    }

    static public function blogSocicalButtons():\stdClass
    {
        $socialButtons = self::socialButtons();

        $mail = new stdClass();
        $mail->title = 'Через аккаунт на сайте';
        $mail->alt = 'Вход по логин и пароль';
        $socialButtons->mail = $mail;

        $socialButtons->defaultText = 'Зарегистрируйтесь что бы писать комменты';

        return $socialButtons;
    }

    static public function getLangArtContent():\stdClass
    {
        return new stdClass();
    }

    static public function getLangCommentsFilter():\stdClass
    {
        $landFilter = new \stdClass();
        $landFilter->labelFound = 'Найдено';
        $landFilter->labelSort = 'Сортировка';
        $landFilter->labelOnPage = 'Показывать по';
        $landFilter->labelViewType = 'Вид списка';

        $landFilter->optByDate = 'По дате';
        $landFilter->optNewTop = 'Сначала новые';
        $landFilter->optLikePlus = 'Больше лайков';
        $landFilter->optLikeMinus = 'Меньше лайков';

        $landFilter->opTypeList = 'Список';
        $landFilter->opTypeTree = 'Дерево';

        $langPg = new \stdClass();
        $langPg->next = 'след.';
        $langPg->pre = 'пред.';

        $landFilter->langPg = $langPg;

        return $landFilter;
    }

    static public function getLangCommentsList():stdClass
    {
        $langList = new \stdClass();
        $langList->respLink = 'Ответить';
        $langList->respTest = 'ответ.';
        $langList->firstComment = 'Напишите коммент первым!';
        return $langList;
    }
}
