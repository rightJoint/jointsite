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
        $ok->client_id = '1250591744';
        $ok->application_key = 'CBAFILILEBABABABA';
        $ok->client_secret = 'E5B0E90CCC5F702E640C4D9C';
        $ok->redirect_uri = 'https://rightjoint.ru/user/signIn';
        $this->ok = $ok;

        $fb = new \stdClass();
        $fb->client_id = 'fb-client-id';
        $fb->client_secret = 'fb-client-secret';
        $fb->redirect_uri = 'https://rightjoint.ru/user/signIn';
        $this->fb = $fb;

        $vk = new \stdClass();
        $vk->client_id = '5869266';
        $vk->application_key = '258adca2258adca2258adca2b525d352702258a258adca27e9ae02c7f63e098276cf03a';
        $vk->client_secret = 'WyXuG66U0ZfAQqAebVsj';
        $vk->redirect_uri = 'https://rightjoint.ru/user/signIn';
        $this->vk = $vk;
    }
}