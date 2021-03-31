<?php

namespace nikserg\EyeApi;

class Client
{
    private $baseUrl;
    const ACTION_CROP = 'crop';

    public function __construct($baseUrl)
    {
        $this->baseUrl = $baseUrl;
    }

    public function crop($filename)
    {

    }

    public function check($id)
    {

    }
}