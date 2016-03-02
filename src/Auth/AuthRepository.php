<?php namespace Roomz\Dropbox\Auth;

class AuthRepository implements AuthRepositoryInterface
{
    private $model;

    public function __construct()
    {
        $this->model = new AuthModel();
    }

    public function boot($dummyVar)
    {
        $this->model->boot();
    }

    public function callback()
    {
        return $this->model->callback();
    }
}
