<?php namespace Roomz\Dropbox\Auth;

interface AuthRepositoryInterface
{
    /**
     * Initiate oauth process
     *
     * @param  Default laravel User
     * @return array
     */
    public function boot($user);

    /**
     * reboot oauth process
     *
     * @param  Default laravel User
     * @return array
     */
    public function reboot($user);

    /**
     * callback for oauth process
     *
     * @param  Default laravel User
     * @return array
     */
    public function callback($user);

    /**
     * Getter for the client
     *
     * @param  Default laravel User
     * @return Dropnbox Client
     */
    public function getApiClient($user);

    /**
     * get client details array or reboot oauth
     *
     * @param  Default laravel User
     * @return array
     */
    public function getClientDetails($user);
}
