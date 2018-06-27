<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Reports extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->user_session = $this->session->userdata('logged_in');
        $this->load->model('lookUpModel');
        $this->load->model('reportsModel');
        $this->load->model('utilities');
        $this->load->library('mpdf_gen');
    }

    function itemReportPDF() {
        $data['listc'] = $this->reportsModel->getAllItemListC();
        $data['listi'] = $this->reportsModel->getAllItemListI();
        $output = $this->load->view('reports/item/report', $data, true);
        $this->mpdf_gen->gen_pdf($output);
    }

    function goodsReceiveReportPDF($category_id = '', $sub_category_id = '', $item_id = '', $dateRange = '') {
        $this->load->database();
        if (($category_id) || ($sub_category_id) || ($item_id)) {
            
            //Reformat date 
            $dateData = explode(" - ", $dateRange);
            $minData = $dateData[0];
            $maxData = $dateData[1];

            
            if (0!=($dateRange)) {
                $result = $this->lookUpModel->getAllGoodsReceivedListByDate($minData, $maxData);
            }

            if (0!=($category_id) && 0==($sub_category_id) && 0==($item_id)) {

                $result = $this->reportsModel->getCategoryByCategory($category_id);
            }

            if (0!=($category_id) && 0!=($sub_category_id) && 0==($item_id)) {

                $result = $this->reportsModel->getCategoryByCategoryAndSubCategory($category_id, $sub_category_id);
            }

            if (0!=($category_id) && 0!=($sub_category_id) && 0!=($item_id)) {

                $result = $this->reportsModel->getCategoryByCategoryAndSubCategoryAndItem($category_id, $sub_category_id, $item_id);
            }

            if (0!=($category_id) && 0==($sub_category_id) && 0!=($item_id)) {

                $result = $this->reportsModel->getCategoryByCategoryAndItem($category_id, $item_id);
            }

            if (0==($category_id) && 0==($sub_category_id) && 0!=($item_id)) {

                $result = $this->reportsModel->getCategoryByItem($item_id);
            }
        } else {
            $result = $this->reportsModel->getCategoryAll();
        }
        //$this->pr($result);
        $data['category'] = $result;
        $output = $this->load->view('reports/goodReceive/report', $data, true);
        $this->mpdf_gen->gen_pdf($output);
    }

    function stockReportPDF() {
        $data['category'] = $this->reportsModel->getAllStockList();
        $output = $this->load->view('reports/stock/report', $data, true);
        $this->mpdf_gen->gen_pdf($output);
    }

    function issuedReportPDF() {
        $data['category'] = $this->reportsModel->getAllIssuedList();
        $output = $this->load->view('reports/issue/report', $data, true);
        $this->mpdf_gen->gen_pdf($output);
    }

    public function distributedReportPDF($id) {
        $data['id'] = $id;
        $data['category'] = $this->reportsModel->getAllDistributedList($id);
        $output = $this->load->view('reports/distributed/report', $data, true);
        $this->mpdf_gen->gen_pdf($output);
    }

    public function receiveReportPDF($id) {
        $data['id'] = $id;
        $data['category'] = $this->reportsModel->getAllDistributedList($id);
        $output = $this->load->view('reports/received/report', $data, true);
        $this->mpdf_gen->gen_pdf($output);
    }

    public function consumingReportPDF($id) {
        $data['id'] = $id;
        $data['category'] = $this->reportsModel->getAllConsumerByUser($id);
        $output = $this->load->view('reports/consuming/report', $data, true);
        $this->mpdf_gen->gen_pdf($output);
    }

//    function reportPDF() {
//        $category_id = $this->uri->segment(3);
//        $sub_category_id = $this->uri->segment(4);
//        $item_id = $this->uri->segment(5);
//
//        if (!empty($category_id) && empty($sub_category_id) && empty($item_id)) {
//            $data['category'] = $this->reportsModel->getAllCategoryList($category_id);
//
//            $output = $this->load->view('reports/goodReceive/cat', $data, true);
//            $this->mpdf_gen->gen_pdf($output);
//        }
//
//        if (!empty($category_id) && !empty($sub_category_id) && empty($item_id)) {
//            $data['category'] = $this->reportsModel->getAllCategoryAndSubcategoryList($category_id, $sub_category_id);
//
//            $output = $this->load->view('reports/goodReceive/cat', $data, true);
//            $this->mpdf_gen->gen_pdf($output);
//        }
//
//        if (!empty($category_id) && !empty($sub_category_id) && !empty($item_id)) {
//            $data['category'] = $this->reportsModel->getAllCategoryAndSubcategoryAndItemList($category_id, $sub_category_id, $item_id);
//
//            $output = $this->load->view('reports/goodReceive/cat', $data, true);
//            $this->mpdf_gen->gen_pdf($output);
//        }
//
//        if (!empty($category_id) && empty($sub_category_id) && !empty($item_id)) {
//            $data['category'] = $this->reportsModel->getAllCategoryAndItemList($category_id, $item_id);
//
//            $output = $this->load->view('reports/goodReceive/cat', $data, true);
//            $this->mpdf_gen->gen_pdf($output);
//        }
//
//        if (empty($category_id) && empty($sub_category_id) && !empty($item_id)) {
//
//            $result = $this->reportsModel->getItemListByOnleyItem($item_id);
//        }
//
//        if (empty($category_id) && empty($sub_category_id) && empty($item_id)) {
//            $data['category'] = $this->reportsModel->getAllList();
//            $output = $this->load->view('reports/goodReceive/cat', $data, true);
//            $this->mpdf_gen->gen_pdf($output);
//        }
//    }

    private function pr($data) {
        echo "<pre>";
        print_r($data);
        echo "</pre>";
        exit;
    }

}

