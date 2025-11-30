<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\UserModel;
use Firebase\JWT\JWT;

class Auth extends ResourceController
{
    use ResponseTrait;

    protected $UserModel;
    protected $session;

    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
    public function __construct()
    {
        $this->UserModel = new UserModel();
        $this->session = \Config\Services::session();
        helper(['custom']);
    }

    public function registration(){
        helper(['form']);
        $is_registration = $this->request->getVar('is_registration');
        if(!isset($is_registration)){
            return view("auth/registration");
        }
        $rules = [
            'email' => [
                'rules'  => 'required|valid_email|is_unique[users.email]',
                'errors' => [
                    'required' => 'Email tidak boleh kosong',
                    'valid_email' => 'Email harus unik',
                    'is_unique' => 'Email sudah terdaftar',
                ],
            ],
            'first_name' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Nama depan tidak boleh kosong',
                ],
            ],
            'last_name' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Nama belakang tidak boleh kosong',
                ],
            ],
            'password' => [
                'rules'  => 'required|min_length[6]',
                'errors' => [
                    'required' => 'Password tidak boleh kosong',
                    'min_length' => 'Password mimimal 6 karakter',
                ],
            ],
            'confirm_password' => [
                'rules'  => 'required_with[password]|matches[password]',
                'errors' => [
                    'required' => 'Konfirmasi password tidak boleh kosong',
                    'matches' => 'Konfirmasi password tidak sama',
                ],
            ],
        ];
        if (!$this->validate($rules)) {
            $this->session->setFlashdata('errors', $this->validator->getErrors());
            return redirect()->to(site_url('/registration'))->withInput();
        }
        $data = [
            'email' => $this->request->getVar('email'),
            'first_name' => $this->request->getVar('first_name'),
            'last_name' => $this->request->getVar('last_name'),
            'password' => password_hash($this->request->getVar('password'),PASSWORD_DEFAULT)
        ];
        $this->UserModel->insert($data);
        $this->session->setFlashdata('success', 'Berhasil buat akun');
        return redirect()->to(site_url('/'))->withInput();
    }
    public function check_login()
    {
        helper(['form']);
        $rules = [
            'email' => [
                'rules'  => 'required|valid_email',
                'errors' => [
                    'required' => 'Email tidak boleh kosong',
                    'valid_email' => 'Email tidak valid',
                ],
            ],
            'password' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Password tidak boleh kosong',
                ],
            ],
        ];
        if (!$this->validate($rules)) {
            $this->session->setFlashdata('errors', $this->validator->getErrors());
            return redirect()->to(site_url('/'))->withInput();
        }

        $user = $this->UserModel->check_login($this->request->getVar('email'));
        if (!$user) {
            $this->session->setFlashdata('error_email', 'Email belum terdaftar');
            return redirect()->to(site_url('/'))->withInput();
        }
        $verify = password_verify($this->request->getVar('password'), $user['password']);
        if (!$verify) {
            $this->session->setFlashdata('error_password', 'Password yang anda masukan salah');
            return redirect()->to(site_url('/'))->withInput();
        }
        $key = getenv('TOKEN_SECRET');
        if(!$key){
            $key = 'cfkhfuwt48wbfjn3i4utnjf38754hf3yfbjc93758thrjsnf83hcwn2023';
        }
        $payload = array(
            "iat" => 1356999524,
            "nbf" => 1357000000,
            "uid" => $user['id'],
            "email" => $user['email']
        );
        $this->session->set("user_email",$user['email']);
        $this->session->set("user_id",$user['id']);
        $token = JWT::encode($payload, $key,'HS256');
        $this->session->set("login_token",$token);
        return redirect()->to(site_url('/dashboard'));

    }

    public function index()
    {
        helper(['form']);
        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');
        if(!isset($email) && !isset($password) && !is_login()){
            return view("auth/login");
        }
        if(is_login()){
            return redirect()->to(site_url('/dashboard'));
        }
    }

    public function logout(){
        $this->session->destroy();
        return redirect()->to(site_url('/'));
    }

    /**
     * Return the properties of a resource object
     *
     * @return mixed
     */
    public function show($id = null)
    {
        //
    }

    /**
     * Return a new resource object, with default properties
     *
     * @return mixed
     */
    public function new()
    {
        //
    }

    /**
     * Create a new resource object, from "posted" parameters
     *
     * @return mixed
     */
    public function create()
    {
        //
    }

    /**
     * Return the editable properties of a resource object
     *
     * @return mixed
     */
    public function edit($id = null)
    {
        //
    }

    /**
     * Add or update a model resource, from "posted" properties
     *
     * @return mixed
     */
    public function update($id = null)
    {
        //
    }

    /**
     * Delete the designated resource object from the model
     *
     * @return mixed
     */
    public function delete($id = null)
    {
        //
    }
}
