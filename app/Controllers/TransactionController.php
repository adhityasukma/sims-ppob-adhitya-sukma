<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class TransactionController extends BaseController
{
    public function index()
    {
        //
    }
    public function topup()
    {
//        $user = $this->UserModel->find($this->session->get('user_id'));
//        $BalanceModel = $this->BalanceModel->get_balance($this->session->get('user_id'));
//        $ServicesModel = $this->ServicesModel->findAll();
//        $BannersModel = $this->BannersModel->findAll();
//        $data = [
//            'user' => isset($user) ? $user : false,
//            'balance' => isset($BalanceModel) ? $BalanceModel : false,
//            'nominal' => ['10000', '20000', '50000', '100000', '250000', '500000'],
//        ];
        return view('layout/partials/topup');
    }
    public function transaction_history()
    {
//        $user = $this->UserModel->find($this->session->get('user_id'));
//        $BalanceModel = $this->BalanceModel->get_balance($this->session->get('user_id'));
//        $limit = 5;
//        $offset = 0;
//        $th_count = 0;
//        $get_th_count = 0;
//        $transaksi_history_count = $this->TransactionsModel->get_data_by($this->session->get('user_id'), 'users_id');
//        if ($transaksi_history_count) {
//            $th_count = count($transaksi_history_count);
//        }
//
//        $transaksi_history = $this->TransactionsModel->get_data($this->session->get('user_id'), 'users_id', $limit, $offset);
//        $history = array();
//        if ($transaksi_history) {
//            $get_th_count = count($transaksi_history);
//            foreach ($transaksi_history as $thv) {
//                if ($thv['services_id'] == 0) {
//                    $history[] = [
//                        'description' => 'Top Up Saldo',
//                        'type_class' => 'text-success',
//                        'transaction_type' => $thv['transaction_type'],
//                        'total_amount' => "+ Rp " . format_rupiah($thv['total_amount']),
//                        'created_on' => date("d F Y h:i:s", strtotime($thv['created_on'])) . " WIB"
//                    ];
//                } else {
//                    $ServicesModel = $this->ServicesModel->find($thv['services_id']);
//                    if ($ServicesModel) {
//                        $history[] = [
//                            'description' => $ServicesModel['service_name'],
//                            'type_class' => 'text-danger',
//                            'transaction_type' => $thv['transaction_type'],
//                            'total_amount' => "- Rp " . format_rupiah($thv['total_amount']),
//                            'created_on' => date("d F Y h:i:s", strtotime($thv['created_on'])) . " WIB"
//                        ];
//                    }
//                }
//            }
//        }
//
//        $data = [
//            'user' => isset($user) ? $user : false,
//            'balance' => isset($BalanceModel) ? $BalanceModel : false,
//            'history' => isset($history) ? $history : false,
//            'limit' => $limit + 5,
//            'hide_showmore_btn' => ($get_th_count == $th_count) ? true : false,
//        ];
        return view('layout/partials/history_transaction');
    }
}
