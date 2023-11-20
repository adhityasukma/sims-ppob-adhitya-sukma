<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ServicesModel;
use App\Models\UserModel;
use App\Models\BalanceModel;
class ServiceController extends BaseController
{
    protected $UserModel;
    protected $BalanceModel;
    protected $ServicesModel;
    public function __construct()
    {
        $this->UserModel = new UserModel();
        $this->BalanceModel = new BalanceModel();
        $this->ServicesModel = new ServicesModel();
        $this->ServicesModel = new ServicesModel();
        helper(['custom']);
    }

    public function index()
    {
        //
    }
    public function detail($service_code=''){
        $service_code = strtoupper($service_code);
        $user = $this->UserModel->find(session()->get('user_id'));
        $BalanceModel = $this->BalanceModel->get_balance(session()->get('user_id'));
        $data_service = $this->ServicesModel->get_service($service_code);
        if(!$data_service){
            return redirect()->to(site_url('/dashboard'));
        }
        $data=[
            'user'=>isset($user)?$user:false,
            'balance'=>isset($BalanceModel)?$BalanceModel:false,
            'services'=>$data_service,
        ];
        return view('layout/partials/services',['data'=>$data]);
    }
}
