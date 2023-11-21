<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class MembershipController extends BaseController
{
    protected $session;

    public function __construct()
    {
        $this->session = \Config\Services::session();
        helper(['custom']);
    }

    public function index()
    {
        if ($this->session->get("token")) {
            return redirect()->to(site_url('/dashboard'));
        } else {
            return view("auth/login");
        }
    }

    public function set_session()
    {
        $token = $this->request->getVar("token");
        $this->session->set('token', $token);
        return $this->response->setJSON(array("status" => TRUE));
    }

    public function logout()
    {
        $this->session->destroy();
        return redirect()->to(site_url('/'));
    }

    public function registration()
    {
        return view("auth/registration");
    }

    public function profile_view()
    {
        return view('layout/partials/profile');
    }
}
