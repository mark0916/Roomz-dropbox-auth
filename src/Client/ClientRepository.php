<?php namespace Roomz\Dropbox\Client;

class ClientRepository implements ClientRepositoryInterface
{
    //TODO:: add comments!!!!!!
    //TODO:: fill up the interface
    private $model;

    public function __construct()
    {
        $this->model = new ClientModel();
    }

    public function setClient($client)
    {
        return $this->model->
            setClient($client);
    }

    public function getClient()
    {
        return $this->model->
            getClient();
    }

    public function uploadFile($path, $uploadedName)
    {
        return $this->model->
            uploadFile(
                $path,
                $uploadedName
            );
    }
}
