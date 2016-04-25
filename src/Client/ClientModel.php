<?php namespace Roomz\Dropbox\Client;

class ClientModel implements ClientModelInterface
{
    //TODO:: REMOVE HARD CLASS NOTATIONS!!!!!!!!!!!!!!!!!!!!!!
    //TODO:: Fill up the interface!!!!!!!!

    /**
     * Dropbox Api Client
     * @var \Dropbox\Client
     */
    private $client;

    public function __construct()
    {
        //...
    }

    /**
     * [uploadFile description]
     * @param  String $path         public path of the file thats gonna be uploaded
     * @param  String $uploadedName the name that the file is going to receive
     * @return $this
     */
    public function uploadFile($path, $uploadedName)
    {
        $file = fopen($path, 'rb');
        $size = filesize($path);

        $this->client->uploadFile(
            '/'. $uploadedName,
            \Dropbox\WriteMode::add(),
            $file,
            $size
        );
        return $this;
    }

    /**
     * setter for the dropbox api client
     *
     * @param \Dropbox\Client $client
     */
    public function setClient($client)
    {
        $this->client = $client;
        return $this;
    }

    /**
     * getter for the dropbox api client
     *
     * @return \Dropbox\Client
     */
    public function getClient()
    {
        return $this->client;
    }
}
