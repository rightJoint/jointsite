<?php

namespace JointApp\Views\WebForms;


use JointApp\AuthConfig;

trait SocialButtontsTrait
{
    public static function printSocialButtons(\stdClass $socialButtons)
    {
        $AuthConfig = new AuthConfig();

        $return = '<a href="https://connect.ok.ru/oauth/authorize?client_id='.$AuthConfig->ok->client_id.'&scope=VALUABLE_ACCESS'.
            '&response_type=code&redirect_uri='.$AuthConfig->ok->redirect_uri.'&layout=w&state=ok" '.
            'title="'.$socialButtons->ok->title.'" class="sb_auth">'.
            '<img src="/img/social_logo/ok-logo.png" alt="'.$socialButtons->ok->alt.'">' .
            '</a>'.
            '<a href="https://oauth.vk.com/authorize?client_id='.$AuthConfig->vk->client_id.
            '&display=page&redirect_uri='.$AuthConfig->vk->redirect_uri.'&scope=friends&response_type=code&v=5.62" '.
            'title="'.$socialButtons->vk->title.'" class="sb_auth">'.
            '<img src="/img/social_logo/vk-logo.png" alt="'.$socialButtons->vk->alt.'">' .
            '</a>';
        return $return;
    }
}