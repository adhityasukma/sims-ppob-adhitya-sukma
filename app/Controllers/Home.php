<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\BalanceModel;
use App\Models\ServicesModel;
use App\Models\BannersModel;
use App\Models\TransactionsModel;
use CodeIgniter\API\ResponseTrait;

class Home extends BaseController
{
    use ResponseTrait;

    protected $UserModel;
    protected $BalanceModel;
    protected $ServicesModel;
    protected $BannersModel;
    protected $TransactionsModel;
    protected $session;

    public function __construct()
    {
        $this->UserModel = new UserModel();
        $this->BalanceModel = new BalanceModel();
        $this->ServicesModel = new ServicesModel();
        $this->BannersModel = new BannersModel();
        $this->TransactionsModel = new TransactionsModel();
        $this->session = \Config\Services::session();
        helper(['custom']);
    }

    public function index(): string
    {

        $user = $this->UserModel->find($this->session->get('user_id'));
        $BalanceModel = $this->BalanceModel->get_balance($this->session->get('user_id'));
        $ServicesModel = $this->ServicesModel->findAll();
        $BannersModel = $this->BannersModel->findAll();

        $data = [
            'user' => isset($user) ? $user : false,
            'balance' => isset($BalanceModel) ? $BalanceModel : false,
            'services' => $ServicesModel,
            'banners' => $BannersModel,
        ];

        return view('utama', ['data' => $data]);
    }

    public function topup()
    {
        $user = $this->UserModel->find($this->session->get('user_id'));
        $BalanceModel = $this->BalanceModel->get_balance($this->session->get('user_id'));
        $ServicesModel = $this->ServicesModel->findAll();
        $BannersModel = $this->BannersModel->findAll();
        $data = [
            'user' => isset($user) ? $user : false,
            'balance' => isset($BalanceModel) ? $BalanceModel : false,
            'nominal' => ['10000', '20000', '50000', '100000', '250000', '500000'],
        ];
        return view('layout/partials/topup', ['data' => $data]);
    }

    public function history($limit)
    {
        $offset = 0;
        $th_count = 0;
        $get_th_count = 0;
        $transaksi_history_count = $this->TransactionsModel->get_data_by($this->session->get('user_id'), 'users_id');
        if($transaksi_history_count){
            $th_count = count($transaksi_history_count);
        }
        $transaksi_history = $this->TransactionsModel->get_data($this->session->get('user_id'), 'users_id', $limit, $offset);
        $history = array();
        if ($transaksi_history) {
            $get_th_count = count($transaksi_history);
            foreach ($transaksi_history as $thv) {
                if ($thv['services_id'] == 0) {
                    $history[] = [
                        'description' => 'Top Up Saldo',
                        'type_class' => 'text-success',
                        'transaction_type' => $thv['transaction_type'],
                        'total_amount' => "+ Rp " . format_rupiah($thv['total_amount']),
                        'created_on' => date("d F Y h:i:s", strtotime($thv['created_on'])) . " WIB"
                    ];
                } else {
                    $ServicesModel = $this->ServicesModel->find($thv['services_id']);
                    if ($ServicesModel) {
                        $history[] = [
                            'description' => $ServicesModel['service_name'],
                            'type_class' => 'text-danger',
                            'transaction_type' => $thv['transaction_type'],
                            'total_amount' => "- Rp " . format_rupiah($thv['total_amount']),
                            'created_on' => date("d F Y h:i:s", strtotime($thv['created_on'])) . " WIB"
                        ];
                    }
                }
            }
        }

        $data = [
            'history' => isset($history) ? $history : false,
            'limit' => $limit + 5,
            'hide_showmore_btn' => ($get_th_count==$th_count) ? true:false,
        ];
        return $this->response->setJSON(array("status" => TRUE, 'html' => view("layout/partials/th_content", ['data'=>$data])));
    }

    public function profile_get(){
        $user = $this->UserModel->find($this->session->get('user_id'));

        if(!$user){
            return $this->response->setJSON(["status" => false, 'pesan' => view("layout/partials/akun/alert-fail", ['pesan' => 'Data tidak ditemukan'])]);
        }
        return $this->response->setJSON(array("status" => TRUE, 'email'=>$user['email'],'first_name'=>$user['first_name'],'last_name'=>$user['last_name']));
    }
    public function profile_view(){
        $user = $this->UserModel->find($this->session->get('user_id'));
        $data = [
            'user' => isset($user) ? $user : false,
        ];
        return view('layout/partials/profile', ['data' => $data]);
    }
    public function profile_update(){
        helper(['form']);
        $user = $this->UserModel->find($this->session->get('user_id'));
        $email = '';
        if($user){
            $email = $user['email'];
        }
        if($email === $this->request->getVar('email')){
            $rules['email']['rules'] = 'required|valid_email';
            $rules['email']['errors']['required'] = 'Email tidak boleh kosong';
            $rules['email']['errors']['valid_email'] = 'Email harus unik';
        }else{
            $rules['email']['rules'] = 'required|valid_email|is_unique[users.email]';
            $rules['email']['errors']['required'] = 'Email tidak boleh kosong';
            $rules['email']['errors']['valid_email'] = 'Email harus unik';
            $rules['email']['errors']['is_unique'] = 'Email sudah terdaftar';
        }

        $rules = [
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
        ];
        if (!$this->validate($rules)) {
            return $this->response->setJSON(["status" => false, 'pesan' => $this->validator->getErrors()]);
        }
        $data = [
            'email' => $this->request->getVar('email'),
            'first_name' => $this->request->getVar('first_name'),
            'last_name' => $this->request->getVar('last_name')
        ];
        $this->UserModel->update($user['id'],$data);
        $users = $this->UserModel->get_user_by("email",$this->request->getVar('email'));
        $this->session->set("user_email",$users['email']);
        $this->session->set("user_id",$users['id']);
        return $this->response->setJSON(["status" => true, 'akun_name'=>$this->request->getVar('first_name')." ".$this->request->getVar('last_name'),'pesan' => view("layout/partials/akun/alert-success", ['pesan' => 'Berhasil edit profile'])]);
    }
    public function profile_image(){

        $validationRule = [
            'profile_image' => [
                'label' => 'Image File',
                'rules' => [
                    'uploaded[profile_image]',
                    'is_image[profile_image]',
                    'mime_in[profile_image,image/jpg,image/jpeg,image/gif,image/png]',
                    'max_size[profile_image,100]'
                ],
                'errors' => [
                    'max_size' => 'Ukuran gambar terlalu besar',
                    'is_image' => "Yang anda pilih bukan gambar",
                    'mime_in' => "Yang anda pilih bukan gambar",
                ],
            ],
        ];
        if (! $this->validate($validationRule)) {
            $data = ['errors' => $this->validator->getErrors(),'btn_text_batal' => 'Tutup'];
            return $this->response->setJSON(["status" => false, 'pesan' => view("layout/partials/akun/modal_gagal_content", $data)]);
        }
        $fileGambar = $this->request->getFile('profile_image');
        $fileName = $fileGambar->getName();
        $fileName = str_replace(" ","-",$fileName);
        if (! $fileGambar->hasMoved()) {
            $fileGambar->move(WRITEPATH ."../public/assets/img/profile/".$this->session->get('user_id'), $fileName, true);
            $this->UserModel->update($this->session->get('user_id'),['profile_image'=>site_url("assets/img/profile/".$this->session->get('user_id')."/{$fileName}")]);
        }
        return $this->response->setJSON(array("status" => TRUE, 'img' => site_url("assets/img/profile/".$this->session->get('user_id')."/{$fileName}")));
    }
    public function transaction_history()
    {
        $user = $this->UserModel->find($this->session->get('user_id'));
        $BalanceModel = $this->BalanceModel->get_balance($this->session->get('user_id'));
        $limit = 5;
        $offset = 0;
        $th_count = 0;
        $get_th_count = 0;
        $transaksi_history_count = $this->TransactionsModel->get_data_by($this->session->get('user_id'), 'users_id');
        if($transaksi_history_count){
            $th_count = count($transaksi_history_count);
        }

        $transaksi_history = $this->TransactionsModel->get_data($this->session->get('user_id'), 'users_id', $limit, $offset);
        $history = array();
        if ($transaksi_history) {
            $get_th_count = count($transaksi_history);
            foreach ($transaksi_history as $thv) {
                if ($thv['services_id'] == 0) {
                    $history[] = [
                        'description' => 'Top Up Saldo',
                        'type_class' => 'text-success',
                        'transaction_type' => $thv['transaction_type'],
                        'total_amount' => "+ Rp " . format_rupiah($thv['total_amount']),
                        'created_on' => date("d F Y h:i:s", strtotime($thv['created_on'])) . " WIB"
                    ];
                } else {
                    $ServicesModel = $this->ServicesModel->find($thv['services_id']);
                    if ($ServicesModel) {
                        $history[] = [
                            'description' => $ServicesModel['service_name'],
                            'type_class' => 'text-danger',
                            'transaction_type' => $thv['transaction_type'],
                            'total_amount' => "- Rp " . format_rupiah($thv['total_amount']),
                            'created_on' => date("d F Y h:i:s", strtotime($thv['created_on'])) . " WIB"
                        ];
                    }
                }
            }
        }

        $data = [
            'user' => isset($user) ? $user : false,
            'balance' => isset($BalanceModel) ? $BalanceModel : false,
            'history' => isset($history) ? $history : false,
            'limit' => $limit + 5,
            'hide_showmore_btn' => ($get_th_count==$th_count) ? true:false,
        ];
        return view('layout/partials/history_transaction', ['data' => $data]);
    }

    public function topup_modal_view($nominal_saldo = 0)
    {
        $nominal_saldo_topup = format_rupiah($nominal_saldo);
        return $this->response->setJSON(array("status" => TRUE, 'pesan' => view("layout/partials/modal_content", ['nominal' => $nominal_saldo_topup, 'code' => '', 'title' => 'Anda yakin untuk Top Up sebesar', 'btn_text_lanjut' => 'Ya, lanjutkan Top Up', 'btn_text_batal' => 'Batalkan', 'btn_class_lanjut' => 'lanjutkan-topup-modal'])));
    }

    public function ts_modal_view($nominal_saldo = 0, $service_name = '')
    {
        $nominal_saldo_topup = format_rupiah($nominal_saldo);
        $service_name = strtolower($service_name);
        $ServicesModel = $this->ServicesModel->get_service($service_name, 'service_name');
        $service_code = '';
        if (isset($ServicesModel['service_code'])) {
            $service_code = $ServicesModel['service_code'];
        }
        return $this->response->setJSON(array("status" => TRUE, 'pesan' => view("layout/partials/modal_content", ['nominal' => $nominal_saldo_topup . " ?", 'code' => $service_code, 'title' => "Beli {$service_name} senilai", 'btn_text_lanjut' => 'Ya, lanjutkan Bayar', 'btn_text_batal' => 'Batalkan', 'btn_class_lanjut' => 'lanjutkan-ts-modal'])));
    }

    public function transaction()
    {
        $service_code = $this->request->getVar('service_code');
        $ServicesModel = $this->ServicesModel->get_service($service_code);
        $BalanceModel = $this->BalanceModel->get_balance($this->session->get('user_id'));
        $saldo_user = 0;
        $service_id = 0;
        $total_saldo = 0;
        $service_tariff = 0;
        $service_name = "";
        if (isset($BalanceModel['balance'])) {
            $saldo_user = $BalanceModel['balance'];

        }
        if (isset($ServicesModel['service_tariff'])) {
            $service_id = $ServicesModel['id'];
            $service_tariff = $ServicesModel['service_tariff'];
            $service_name = $ServicesModel['service_name'];
            $service_name = strtolower($service_name);
        }
        if ($saldo_user < $service_tariff) {
            return $this->response->setJSON(["status" => false, 'pesan' => view("layout/partials/modal_gagal_content", ['nominal' => format_rupiah($service_tariff), 'title' => "Pembayaran {$service_name} sebesar", 'btn_text_lanjut' => 'Ya, lanjutkan Bayar', 'btn_text_batal' => 'Kembali ke Beranda', 'btn_class_lanjut' => 'lanjutkan-ts-modal'])]);
        }
        $BalanceModel = $this->BalanceModel->get_balance($this->session->get('user_id'));
        if (isset($BalanceModel['balance'])) {
            $saldo_user = $BalanceModel['balance'];
            $total_saldo = $saldo_user - $service_tariff;
            $data = [
                'users_id' => $this->session->get('user_id'),
                'balance' => $total_saldo,
            ];
            $this->BalanceModel->update($BalanceModel['id'], $data);
        }
        $data_transaction = [
            'users_id' => $this->session->get('user_id'),
            'invoice_number' => time(),
            'services_id' => $service_id,
            'transaction_type' => "PAYMENT",
            'total_amount' => $service_tariff,
            'created_on' => date("Y-m-d h:i:s"),
        ];
        $this->TransactionsModel->insert($data_transaction);
        return $this->response->setJSON(["status" => true, 'pesan' => view("layout/partials/modal_berhasil_content", ['nominal' => format_rupiah($service_tariff), 'title' => "Pembayaran {$service_name} sebesar", 'btn_text_lanjut' => 'Ya, lanjutkan Bayar', 'btn_text_batal' => 'Kembali ke Beranda', 'btn_class_lanjut' => 'lanjutkan-ts-modal']), 'total_saldo_user' => format_rupiah($total_saldo)]);
    }

    public function topup_saldo()
    {
        $nominal_saldo = $this->request->getVar('top_up_amount');
        if ($nominal_saldo < 10000 || $nominal_saldo > 1000000) {
            return $this->response->setJSON(["status" => false, 'pesan' => view("layout/partials/modal_gagal_content", ['nominal' => format_rupiah($nominal_saldo), 'title' => "Top Up sebesar", 'btn_text_lanjut' => 'Ya, lanjutkan Bayar', 'btn_text_batal' => 'Kembali ke Beranda', 'btn_class_lanjut' => 'lanjutkan-ts-modal'])]);
        }
        $user = $this->UserModel->find($this->session->get('user_id'));
        $total_saldo = $nominal_saldo;
        $BalanceModel = $this->BalanceModel->get_balance($this->session->get('user_id'));
        if (isset($BalanceModel['balance'])) {
            $saldo_user = $BalanceModel['balance'];
            $total_saldo = $total_saldo + $saldo_user;
            $data = [
                'users_id' => $this->session->get('user_id'),
                'balance' => $total_saldo,
            ];
            $this->BalanceModel->update($BalanceModel['id'], $data);
        } else {
            $data = [
                'users_id' => $this->session->get('user_id'),
                'balance' => $nominal_saldo,
            ];
            $this->BalanceModel->insert($data);
        }

        $data_transaction = [
            'users_id' => $this->session->get('user_id'),
            'invoice_number' => time(),
            'services_id' => 0,
            'transaction_type' => "TOPUP",
            'total_amount' => $nominal_saldo,
            'created_on' => date("Y-m-d h:i:s"),
        ];
        $this->TransactionsModel->insert($data_transaction);
        return $this->response->setJSON(["status" => true, 'pesan' => view("layout/partials/modal_berhasil_content", ['nominal' => format_rupiah($nominal_saldo), 'title' => "Top Up sebesar", 'btn_text_lanjut' => 'Ya, lanjutkan Bayar', 'btn_text_batal' => 'Kembali ke Beranda', 'btn_class_lanjut' => 'lanjutkan-ts-modal']), 'total_saldo_user' => format_rupiah($total_saldo)]);
    }
}
