<?php namespace Roomz\Dropbox\Auth;

use App\User;

class AuthModel implements AuthModelInterface
{
    //TODO:: REMOVE HARD CLASS NOTATIONS!!!!!!!!!!!!!!!!!!!!!!
    //TODO:: Fill up the interface!!!!!!!!
    public function __construct()
    {
        //...
    }

    /**
     * Starts a oauth authentication procedure. checks first if user had a token already
     *
     * @param   User $user
     * @return array
     */
    public function boot(User $user)
    {
        // dd($this->checkToken($user));
        if (!$this->checkToken($user))
        {
            $webAuth = $this->webAuth();

            $authUrl = $webAuth->start();

            header('Location: ' . $authUrl);
            exit();
        }
    }

    /**
     * Restarts a oauth authentication procedure. Should be called when token related exeptions are thrown
     *
     * @param   User $user
     * @return \Dropbox\Client
     */
    public function reboot(User $user)
    {

        $webAuth = $this->webAuth();

        $authUrl = $webAuth->start();

        header('Location: ' . $authUrl);
        exit();
    }

    /**
     * Finalizes oauth authentication procedure. sets the aquired token on the given User
     *
     * @param   User $user
     * @return User $user
     */
    public function callback(User $user)
    {
        $webAuth = $this->webAuth();

        list($accesToken) = $webAuth->finish($_GET);

        $user->setAttribute('dropboxToken', $accesToken);
        $user->save();

        return [
            'token' => $user->getAttribute('dropboxToken'),
            'name'  => getenv('ROOMZ_DROPBOX_NAME')
        ];

    }

    /**
     * getter for the dropbox api client for further use in the application.
     * User needs to be authenticated and the exeption should be caught in the controllers
     *
     * @param   User $user
     * @return \Dropbox\Client
     * @throws \Dropbox\Exception_InvalidAccessToken
     */
    public function getApiClient(User $user)
    {
        return new \Dropbox\Client($user->dropboxToken, getenv('ROOMZ_DROPBOX_NAME'), 'UTF-8');
    }

    /**
     * Initialises basic info used to contact the dropbox api.
     * Uses values from the laravel envirimental file (.env)
     *
     * @return \Dropbox\WebAuth
     */
    private function webAuth()
    {
        $dropboxKey    = getenv('ROOMZ_DROPBOX_KEY');
        $dropboxSecret = getenv('ROOMZ_DROPBOX_SECRET');
        $appName       = getenv('ROOMZ_DROPBOX_NAME');

        $appInfo = new \Dropbox\AppInfo($dropboxKey, $dropboxSecret);

        $csrfTokenStore = new \Dropbox\ArrayEntryStore($_SESSION, 'dropbox-auth-csrf-token');

        return new \Dropbox\WebAuth($appInfo, $appName, getenv('ROOMZ_DROPBOX_CALLBACK'), $csrfTokenStore);
    }

    /**
     * Check if the user has a token. Does not check if its a valid one tho.
     *
     * @return boolean
     */
    private function checkToken(User $user)
    {
        return !is_null($user->getAttribute('dropboxToken'));
    }

    /**
     * Check if the user has a token. and then return default info needed for client
     *
     * @return array
     */
    public function getClientDetails(User $user)
    {
        $valid = $this->checkToken($user);
        if ($valid) {
            return [
                'token' => $user->getAttribute('dropboxToken'),
                'name'  => getenv('ROOMZ_DROPBOX_NAME')
            ];
        }
        return $this->reboot($user);
    }


}
