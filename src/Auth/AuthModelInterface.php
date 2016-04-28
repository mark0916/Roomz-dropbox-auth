<?php namespace Roomz\Dropbox\Auth;

interface AuthModelInterface
{
    /**
     * Starts a oauth authentication procedure. checks first if user had a token already
     *
     * @param   User $user
     * @return array
     */
    public function boot($user);

    /**
     * Restarts a oauth authentication procedure. Should be called when token related exeptions are thrown
     *
     * @param   User $user
     * @return \Dropbox\Client
     */
    public function reboot($user);

    /**
     * Finalizes oauth authentication procedure. sets the aquired token on the given User
     *
     * @param   User $user
     * @return User $user
     */
    public function callback($user);

    /**
     * getter for the dropbox api client for further use in the application.
     * User needs to be authenticated and the exeption should be caught in the controllers
     *
     * @param   User $user
     * @return \Dropbox\Client
     * @throws \Dropbox\Exception_InvalidAccessToken
     */
    public function getApiClient($user);

    /**
     * Initialises basic info used to contact the dropbox api.
     * Uses values from the laravel envirimental file (.env)
     *
     * @return \Dropbox\WebAuth
     */
    public function webAuth();

    /**
     * Check if the user has a token. Does not check if its a valid one tho.
     *
     * @return boolean
     */
    public function checkToken($user);

    /**
     * Check if the user has a token. and then return default info needed for client
     *
     * @return array
     */
    public function getClientDetails($user);
}
