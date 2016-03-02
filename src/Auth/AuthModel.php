<?php namespace Roomz\Dropbox\Auth;

use App\User;

class AuthModel implements AuthModelInterface
{
    public function __construct()
    {

    }

    public function boot(User $user, $update = true)
    {
        if(!$update)
        {
            if ($this->checkToken($user))
            {
                return new \Dropbox\Client($user->dropboxToken, getenv('ROOMZ_DROPBOX_NAME'), 'UTF-8');
            }
        }

        $webAuth = $this->webAuth();

        $authUrl = $webAuth->start();

        header('Location: ' . $authUrl);
        exit();
    }

    public function callback(User $user)
    {
        $webAuth = $this->webAuth();

        list($accesToken) = $webAuth->finish($_GET);

        $user->setAttribute('dropboxToken', $accesToken);
        $user->save();

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

    private function checkToken(User $user)
    {
        return !is_null($user->getAttribute('dropboxToken'));
    }
}
