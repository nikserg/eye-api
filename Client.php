<?php

namespace nikserg\EyeApi;

use nikserg\EyeApi\model\Task;

class Client
{
    private $baseUrl;
    private $client;
    const ACTION_CROP = 'crop';

    public function __construct($baseUrl)
    {
        $this->baseUrl = $baseUrl;
        $this->client = new \GuzzleHttp\Client();
    }
    private function getUrl($action) {
        return $this->baseUrl . '/' . $action;
    }

    /**
     * @param $filename
     * @return Task
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function crop($filename)
    {
        $response = $this->client->request('POST', $this->getUrl(self::ACTION_CROP), [
            'multipart' => [
                [
                    'name' => 'file',
                    'contents' => file_get_contents($filename),
                    'filename' => basename($filename)
                ]
            ]
        ]);
        return $this->responseToTask($response);
    }

    /**
     * @param $action
     * @param $id
     * @return Task
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function check($action, $id)
    {
        $response = $this->client->get($this->getUrl($action).'/'.$id);
        return $this->responseToTask($response);
    }

    private function responseToTask($response)
    {

        $response = json_decode($response, true);

        $task = new Task();
        $task->id = $response['id'];
        $task->status = $response['status'];
        if (isset($response['resultUrl'])) {
            $task->resultUrl = $response['resultUrl'];
        }

        return $task;
    }
}