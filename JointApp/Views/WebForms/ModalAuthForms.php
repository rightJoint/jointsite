<?php



namespace JointApp\Views\WebForms;


use JointApp\AuthConfig;

class ModalAuthForms
{
    public \stdClass $langForms;
    public \stdClass $langErrs;
    public \stdClass $paramsFroms;

    function __construct(\stdClass $langForms, \stdClass $paramsFroms)
    {
        $this->langForms = $langForms;
        $this->paramsFroms  = $paramsFroms;
    }

    public function printAuthForms():string
    {
        $activeSignInFlag = true;
        $activeSignUpFlag = false;
        if($this->paramsFroms->switchForm == 'signUp'){
            $activeSignInFlag = false;
            $activeSignUpFlag = true;
        }

        $return = $this->modalSignInForm($activeSignInFlag).
            $this->modalSignUpForm($activeSignUpFlag);
        //$return = $this->modalSignUpForm($activeSignUpFlag);

        return $return;


    }

    public function modalSignInForm(bool $activeSignInFlag = true):string
    {
        $add_form_class = '';
        if(!$activeSignInFlag){
            $add_form_class = 'disp-none';
        }



        $return = '<form class="auth-form signIn '.$add_form_class.'" method="post" action="/user/signIn">'.
            '<div class="modal-line">'.
            '<div class="modal-line-img"><img src="/img/popimg/user-logo.png"></div>' .
            '<div class="modal-line-text">';
        $return.= self::printSocialButtons();
        $return.= '<a class="m-l-blue title decnone" id="siteSignIn" href="#">'.
            $this->langForms->signInForm->form_title.
            '</a>'.
            '</div>'.
            '</div><br>'.
            '<div class="modal-line">'.
            '<div class="modal-line-text"><input type="text" name="signInLogin" value="'.$this->paramsFroms->signInForm->fVals->signInLogin.'"'.
            ' placeholder="'.$this->langForms->signInForm->placeholder_login.'">'.
            '</div>'.
            '<div class="modal-line-img"><img src="/img/popimg/avatar-default.png"></div>';
        if($this->paramsFroms->signInForm->err->signInErrNotFound){
            $return.= '<div class="modal-line-err">'.
                $this->langForms->signInForm->err->signInErrNotFound.
                '</div>';
        }
        if($this->paramsFroms->signInForm->err->signInErrEMailValid){
            $return.= '<div class="modal-line-err">'.
                $this->langForms->signInForm->err->signInErrEMailValid.
                '</div>';
        }
        if($this->paramsFroms->signInForm->err->signInErrBlackList){
            $return.= '<div class="modal-line-err">'.
                $this->langForms->signInForm->err->signInErrBlackList.
                '</div>';
        }
        if($this->paramsFroms->signInForm->err->signInErrLogin){
            $return.= '<div class="modal-line-err">'.
                $this->langForms->signInForm->err->signInErrLogin.
                '</div>';
        }

        $return.= '</div>';
        $return.='<div class="modal-line">'.
            '<div class="modal-line-text">'.
            '<input type="password" name="signInPassword" value="'.$this->paramsFroms->signInForm->fVals->signInPassword.'"'.
            ' placeholder="'.$this->langForms->signInForm->placeholder_password.'">'.
            '</div>'.
            '<div class="modal-line-img"><img src="/img/popimg/pass-img.png">'.
            '</div>';

        if($this->paramsFroms->signInForm->err->signInPassword){
            $return.= '<div class="modal-line-err">'.
                $this->langForms->signInForm->err->signInErrPass.'</div>';
        }
        if($this->paramsFroms->signInForm->err->signInErrWrongPass){
            $return.= '<div class="modal-line-err">'.
                $this->langForms->signInForm->err->signInErrWrongPass.'</div>';
        }
        $return.= '</div>';
        $return.= '<div class="modal-line">'.
            '<div class="modal-line-text">'.
            '<a class="m-l-blue title" href="#siteSignUp">'.
            $this->langForms->signUpForm->form_title.
            '</a>'.
            '<input type="submit" name="auth_signIn" value="'.$this->langForms->signInForm->submit_btn.'"></div>'.
            '<div class="modal-line-img"></div>'.
            '</div>'.
            '</form>';

        return $return;
    }

    function modalSignUpForm(
        bool $activeSignUpFlag = true
        /*
        $add_form_class = null, $signUp_err=array(
        'login_unacceptable' => false,
        'login_reserved' => false,
        'pass_unacceptable' => false,
        'pass_dont_match' => false,
        'email_unacceptable' => false,
    )
    */

    ):string
    {

        $add_form_class = '';
        if(!$activeSignUpFlag){
            $add_form_class = 'disp-none';
        }

        //echo '<pre>';
        // print_r($this->langForms);
        //  exit;

        $return = '<form class="auth-form signUp '.$add_form_class.'" method="post" action="/user/signUp">'.
            '<div class="modal-line">'.
            '<div class="modal-line-img"><img src="/img/popimg/checkInNow.png"></div>' .
            '<div class="modal-line-text">';
        $return.= self::printSocialButtons();

        $return.= '<a class="m-l-blue title decnone" href="#" id="siteSignUp">'.
            $this->langForms->signUpForm->form_title.
            '</a>'.
            '</div>'.
            '</div>'.
            '<div class="modal-line">'.
            '<div class="modal-line-text"><input type="text" name="signUpLogin" value="'.
            $this->paramsFroms->signUpForm->fVals->signUpLogin.'" placeholder="'.$this->langForms->signUpForm->placeholder_login.'"></div>'.
            '<div class="modal-line-img"><img src="/img/popimg/avatar-default.png"></div>';
        if($this->paramsFroms->signUpForm->err->signUpErrLoginAccept){
            $return.= '<div class="modal-line-err">'.
                $this->langForms->signUpForm->err->signUpErrLoginAccept.'</div>';
        }
        if($this->paramsFroms->signUpForm->err->signUpErrLoginReserved){
            $return.= '<div class="modal-line-err">'.
                $this->langForms->signUpForm->err->signUpErrLoginReserved.'</div>';
        }
        $return.= '</div>'.
            '<div class="modal-line">'.
            '<div class="modal-line-text">'.
            '<input type="password" name="signUpPassword" value="'.
            $this->paramsFroms->signUpForm->fVals->signUpPassword.
            '" placeholder="'.$this->langForms->signUpForm->placeholder_password.'">'.
            '</div>'.
            '<div class="modal-line-img"><img src="/img/popimg/pass-img.png"></div>';
        if($this->paramsFroms->signUpForm->err->signUpErrPassAccept){
            $return.= '<div class="modal-line-err">'.
                $this->langForms->signUpForm->err->signUpErrPassAccept.
                '</div>';
        }
        $return.= '</div>'.
            '<div class="modal-line">'.
            '<div class="modal-line-text">'.
            '<input type="password" name="signUpPasswordRepeat" value="'.
            $this->paramsFroms->signUpForm->fVals->signUpPasswordRepeat.
            '" placeholder="'.$this->langForms->signUpForm->placeholder_repeat.'">'.
            '</div>'.
            '<div class="modal-line-img"><img src="/img/popimg/pass-img.png"></div>';
        if($this->paramsFroms->signUpForm->err->signUpErrPassMatch){
            $return.= '<div class="modal-line-err">'.
                $this->langForms->signUpForm->err->signUpErrPassMatch.
                '</div>';
        }
        $return.= '</div>'.
            '<div class="modal-line">'.
            '<div class="modal-line-text">'.
            '<input type="email" name="signUpEMail" value="'.
            $this->paramsFroms->signUpForm->fVals->signUpEMail.
            '" placeholder="'.$this->langForms->signUpForm->placeholder_mail.'">'.
            '</div>'.
            '<div class="modal-line-img"><img src="/img/popimg/eMailLogo.png"></div>';
        if($this->paramsFroms->signUpForm->err->signUpErrEMailAccept){
            $return.= '<div class="modal-line-err">'.
                $this->langForms->signUpForm->err->signUpErrEMailAccept.
                '</div>';
        }
        $return.= '</div>'.
            '<div class="modal-line">'.
            '<div class="modal-line-text">'.
            '<a class="m-l-blue title" href="#siteSignIn">'.
            $this->langForms->signUpForm->form_title.
            '</a>'.
            '<input type="submit" name="auth_signUp" value="'.$this->langForms->signUpForm->submit_btn. '"></div>'.
            '<div class="modal-line-img"></div>'.
            '</div>'.
            '</form>';

        return $return;
    }

    public static function printSocialButtons()
    {
        $AuthConfig = new AuthConfig();

        $return = '<a href="https://connect.ok.ru/oauth/authorize?client_id='.$AuthConfig->ok->client_id.'&scope=VALUABLE_ACCESS'.
            '&response_type=code&redirect_uri='.$AuthConfig->ok->redirect_uri.'&layout=w&state=ok" '.
            'title="Вход через Одноклассники" class="sb_auth">'.
            '<img src="/img/social_logo/ok-logo.png" alt="ok-кнопка">' .
            '</a>'.
            '<a href="https://oauth.vk.com/authorize?client_id='.$AuthConfig->vk->client_id.
            '&display=page&redirect_uri='.$AuthConfig->vk->redirect_uri.'&scope=friends&response_type=code&v=5.62" '.
            'title="Вход через ВКонтакте" class="sb_auth">'.
            '<img src="/img/social_logo/vk-logo.png" alt="vk-кнопка">' .
            '</a>';
        return $return;
    }
}