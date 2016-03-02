<?php namespace Roomz\Dropbox\Auth;

use App\User;

class AuthRepository implements AuthRepositoryInterface
{
    //TODO:: add comments!!!!!!
    //TODO:: fill up the interface
    private $model;

    public function __construct()
    {
        $this->model = new AuthModel();
    }

    public function boot(User $user)
    {
        $this->model->boot($user);
    }

    public function reboot(User $user)
    {
        $this->model->reboot($user);
    }

    public function callback(User $user)
    {
        return $this->model->callback($user);
    }

    public function getApiClient(User $user)
    {
        return $this->model->getApiClient($user);
    }
}
