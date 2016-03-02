<?php namespace Roomz\Dropbox\Client;

class ClientModel implements ClientModelInterface
{
    private $client;

    public function __construct()
    {

    }

    public function uploadFile()
    {

    }

    public function setClient($client)
    {
        $this->client = $client;
        return $this;
    }

    public function getClient()
    {
        return $this->client;
    }
}
