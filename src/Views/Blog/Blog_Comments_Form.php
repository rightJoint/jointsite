<?php


namespace Src\Views\Blog;


use JointApp\Views\WebForms\SocialButtontsTrait;

class Blog_Comments_Form
{
    use SocialButtontsTrait;

    public \stdClass $langForms;
    public \stdClass $fromParams;
    public \stdClass $filterParams;
    public string $langSl = 'ru';

    const USER_AVATARS_DIR = '/userdata/avatars';

    function __construct(\stdClass $langForm, \stdClass $fromParams, \stdClass $filterParams, $langSl = 'ru')
    {
        $this->langForms = $langForm;
        $this->fromParams  = $fromParams;
        $this->langSl  = $langSl;
        $this->filterParams  = $filterParams;
    }

    public function printBlogForm($socialButtons):string
    {
        global $currentUser;

        $return = '';
        if(!empty($currentUser->user_id)){
            $avatar = '';
            if(!empty($currentUser->photoLink)){
                if($currentUser->network == 'site'){
                    $avatar.= self::USER_AVATARS_DIR.'/'.$currentUser->photoLink;
                }else{
                    $avatar.= $currentUser->photoLink;
                }
            }else{
                $avatar.= '/img/popimg/avatar-default.png';
            }

            $return =
                '<form class="form-comments" method="post">'.
                '<input type="hidden" name="addCommentFlag" value="y">'.
                '<input type="hidden" name="commentP_id" value="'.$this->fromParams->commentP_id.'">'.
                '<input type="hidden" name="artRef" value="'.$this->fromParams->artRef.'">'.
                '<input type="hidden" name="curPage" value="'.$this->filterParams->curPage.'">'.
                '<input type="hidden" name="onPage" value="'.$this->filterParams->onPage.'">'.
                '<input type="hidden" name="sort" value="'.$this->filterParams->sort.'">'.
                '<input type="hidden" name="viewtype" value="'.$this->filterParams->viewtype.'">'.
                '<div class="form-comments-user">'.
                '<img src="'.$avatar.'">'.
                '<span>'.
                $currentUser->accAlias.
                '</span>'.
                '</div>'.
                '<div class="form-comments-content">'.
                '<textarea id="form-comments-content" name="formCommentsContent">'.
                $this->fromParams->formCommentsContent.
                '</textarea>'.
                '</div>';
            if(!empty($this->fromParams->formCommentsErr)){
                $return .= '<div class="form-comments-err">'.
                    '<b>'.$this->langForms->postErrText.': </b>'.
                    $this->fromParams->formCommentsErr.
                    '</div>';
            }

            if($this->fromParams->commentP_id == 'new'){
                $newClass = 'inherit';
                $respClass = 'none';
            }else{
                $newClass = 'none';
                $respClass = 'inherit';
            }

            $return .= '<div class="form-comments-buttons">'.
                '<button id="form-comments-submit"><span id="form-comments-submit-new" style="display: '.$newClass.'">'.
                $this->langForms->postNew.'</span>'.
                '<span id="form-comments-submit-answer" style="display: '.$respClass.'">'.
                $this->langForms->postAnswer.
                '</span>'.
                '</button>'.
                '</div>'.
                '</form>';
        }else{
            $return = '<div class="form-comments-check-in">'.
                '<span onclick="$(\'.modal.menu, .modal.menu .overlay\').css({\'opacity\': 1, \'visibility\': \'visible\'})">'.
                '<img src="/img/popimg/checkInNow-footer.png" title="'.$socialButtons->mail->title.'" '.
                'alt="'.$socialButtons->mail->alt.'">'.
                '</span>'.
                self::printSocialButtons($socialButtons).
                '<span class="check-in" onclick="$(\'.modal.menu, .modal.menu .overlay\').css({\'opacity\': 1, \'visibility\': \'visible\'})">'.
                ' - '.$socialButtons->defaultText.
                '</span>'.
                '</div>';
        }
        return $return;
    }
}