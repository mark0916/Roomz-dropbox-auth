<?php namespace Roomz\Dropbox\Auth;

use App\User;

class AuthRepository implements AuthRepositoryInterface
{
    private $model;

    public function __construct()
    {
        $this->model = new AuthModel();
    }

    public function boot(User $user, $update = true)
    {
        $this->model->boot($user, $update);
    }

    public function callback(User $user)
    {
        return $this->model->callback($user);
    }
}
