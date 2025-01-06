<?php


namespace JointApp;


class AuthConfig
{
    public \stdClass $ok;
    public \stdClass $fb;
    public \stdClass $vk;

    public function __construct()
    {
        $ok = new \stdClass();
        $ok->client_id = 'ok-client-id';
        $ok->application_key = 'ok-application-key';
        $ok->client_secret = 'ok-client-secret';
        $ok->redirect_uri = 'https://rightjoint.ru/user/signIn';
        $this->ok = $ok;

        $fb = new \stdClass();
        $fb->client_id = 'fb-client-id';
        $fb->client_secret = 'fb-client-secret';
        $fb->redirect_uri = 'https://rightjoint.ru/user/signIn';
        $this->fb = $fb;

        $vk = new \stdClass();
        $vk->client_id = 'vk-client-id';
        $vk->application_key = 'vk-application-key';
        $vk->client_secret = 'vk-client-secret';
        $vk->redirect_uri = 'https://rightjoint.ru/user/signIn';
        $this->vk = $vk;
    }
}