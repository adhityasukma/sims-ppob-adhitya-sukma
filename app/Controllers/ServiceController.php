<?php

namespace App\Controllers;
use App\Controllers\BaseController;
class ServiceController extends BaseController
{
    public function __construct()
    {
        helper(['custom']);
    }

    public function index()
    {
        //
    }
    public function detail_service($service_code=''){
        $service_code = strtoupper($service_code);

        $data=[
            'services'=>$service_code,
        ];
        return view('layout/partials/services',$data);
    }
}
