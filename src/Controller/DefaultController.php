<?php


namespace App\Controller;


class DefaultController extends BaseController
{
    public function index()
    {
        return $this->response([
            'status' => 'OK'
        ]);
    }
}