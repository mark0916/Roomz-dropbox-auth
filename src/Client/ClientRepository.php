<?php namespace Roomz\Dropbox\Client;

class ClientRepository implements ClientRepositoryInterface
{
    private $model;

    public function __construct()
    {
        $this->model = new ClientModel();
    }

    public function setClient($client)
    {
        return $this->model->setClient($client);
    }

    public function getClient()
    {
        return $this->model->getClient();
    }
}
