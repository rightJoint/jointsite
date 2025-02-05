<?php
class LangFiles_En_Views_BlogArts extends LangFiles_En_Views_SiteView
{
    static public function getLangHead():stdClass
    {
        $langHead = new stdClass();

        $langHead->updateFromArray = function ($array = []) use (&$langHead){
            if(count($array)){
                foreach ($array as $key => $value){
                    if($key=='title'){
                        $langHead->title = 'Blog-'.$value;
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
        $artHeader->created = 'Pub date';
        $artHeader->refresh = 'Refresh date';
        $artHeader->tags = 'Tags';

        $langPageContent->artHeader = $artHeader;

        $langPageContent->langArtContent = static::getLangArtContent();

        $formComments = new stdClass();
        $formComments->socialButtons = self::blogSocicalButtons();
        $langPageContent->formComments = $formComments;
        $formComments->artCommentNew = 'Post New comment';
        $formComments->postNew = 'Post New';
        $formComments->postAnswer = 'Post answer';
        $formComments->postErrText = 'Error';

        $langPageContent->landFilter = self::getLangCommentsFilter();

        $langPageContent->commentsH3 = 'Comments';

        $langPageContent->langList = self::getLangCommentsList();

        return $langPageContent;
    }

    static public function blogSocicalButtons():\stdClass
    {
        $socialButtons = self::socialButtons();

        $mail = new stdClass();
        $mail->title = 'jointsite account';
        $mail->alt = 'Using login and password';
        $socialButtons->mail = $mail;

        $socialButtons->defaultText = 'Sign In to write comments';

        return $socialButtons;
    }

    static public function getLangArtContent():\stdClass
    {
        return new stdClass();
    }

    static public function getLangCommentsFilter():\stdClass
    {
        $landFilter = new \stdClass();
        $landFilter->labelFound = 'Found';
        $landFilter->labelSort = 'Sort';
        $landFilter->labelOnPage = 'On page';
        $landFilter->labelViewType = 'View type';

        $landFilter->optByDate = 'by date';
        $landFilter->optNewTop = 'new on top';
        $landFilter->optLikePlus = 'likes plus';
        $landFilter->optLikeMinus = 'likes minus';

        $landFilter->opTypeList = 'List';
        $landFilter->opTypeTree = 'Tree';

        $langPg = new \stdClass();
        $langPg->next = 'next';
        $langPg->pre = 'pre';

        $landFilter->langPg = $langPg;

        return $landFilter;
    }

    static public function getLangCommentsList():stdClass
    {
        $langList = new \stdClass();
        $langList->respLink = 'Respond';
        $langList->respTest = 'answ';
        $langList->firstComment = 'Add comment first!';
        return $langList;
    }
}
