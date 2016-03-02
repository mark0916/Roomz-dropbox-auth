<?php namespace Roomz\Dropbox\Auth;

class AuthModel implements AuthModelInterface
{
    public function __construct()
    {

    }

    public function boot()
    {
        $webAuth = $this->webAuth();

        $authUrl = $webAuth->start();

        header('Location: ' . $authUrl);
        exit();
    }

    public function callback()
    {
        $webAuth = $this->webAuth();

        list($accesToken) = $webAuth->finish($_GET);

        return new \Dropbox\Client($accesToken, getenv('ROOMZ_DROPBOX_NAME'), 'UTF-8');

    }

    private function webAuth()
    {
        $dropboxKey    = getenv('ROOMZ_DROPBOX_KEY');
        $dropboxSecret = getenv('ROOMZ_DROPBOX_SECRET');
        $appName       = getenv('ROOMZ_DROPBOX_NAME');

        $appInfo = new \Dropbox\AppInfo($dropboxKey, $dropboxSecret);

        $csrfTokenStore = new \Dropbox\ArrayEntryStore($_SESSION, 'dropbox-auth-csrf-token');

        return new \Dropbox\WebAuth($appInfo, $appName, getenv('ROOMZ_DROPBOX_CALLBACK'), $csrfTokenStore);
    }

    public function upload($dummyVar)
    {
        dd($dummyVar);
    }
}
