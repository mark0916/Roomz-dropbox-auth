<?php namespace Roomz\Dropbox\Auth;

class AuthRepository implements AuthRepositoryInterface
{
    //TODO:: add comments!!!!!!
    //TODO:: fill up the interface
    private $model;

    public function __construct()
    {
        $this->model = new AuthModel();
    }

    /**
     * Initiate oauth process
     *
     * @param  Default laravel User
     * @return array
     */
    public function boot($user)
    {
        return $this->model->boot($user);
    }

    /**
     * reboot oauth process
     *
     * @param  Default laravel User
     * @return array
     */
    public function reboot($user)
    {
        return $this->model->reboot($user);
    }

    /**
     * callback for oauth process
     *
     * @param  Default laravel User
     * @return array
     */
    public function callback($user)
    {
        return $this->model->callback($user);
    }

    /**
     * Getter for the client
     *
     * @param  Default laravel User
     * @return Dropnbox Client
     */
    public function getApiClient($user)
    {
        return $this->model->getApiClient($user);
    }

    /**
     * get client details array or reboot oauth
     *
     * @param  Default laravel User
     * @return array
     */
    public function getClientDetails($user)
    {
        return $this->model->getClientDetails($user);
    }
}
