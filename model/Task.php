<?php
namespace nikserg\EyeApi\model;

class Task {

    const STATUS_NEW = 'new';
    const STATUS_DONE = 'done';


    public $id;
    public $status;
    public $resultUrl;
}