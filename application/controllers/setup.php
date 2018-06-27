<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class setup extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->user_session = $this->session->userdata('logged_in');
        if (!$this->user_session) {
            redirect('index.php/login/index');
        }
        $this->load->model('lookUpModel');
        $this->load->model('utilities');
        $this->load->library('mpdf_gen');
    }

    /*
     * @methodName layout()
     * @access
     * @param  none
     * @return  //Load layout  
     */

    private function layOut() {
        $this->data['user'] = $this->user_session['user_name'];
        $this->data['status'] = $this->user_session['user_id'];
        $this->data['main_menus'] = $this->utilities->findByAttributeAll('tbl_tree_variant', array('parent_id' => '51'));
        $this->data['users'] = $this->lookUpModel->get_all('tbl_user');
        $this->template['header'] = $this->load->view('layouts/header', $this->data, true);
        $this->template['content'] = $this->load->view($this->content, $this->data, true);
        $this->template['footer'] = $this->load->view('layouts/footer', $this->data, true);
        $this->load->view('layouts/index', $this->template);
    }

    /*
     * @methodName Multiple Image upload()
     * @access
     * @param  none
     * @return  Debug Function   
     */

    private function image_upload($file, $path_name) {
        $_FILES['userfile']['name'] = $file['name'];
        $_FILES['userfile']['type'] = $file['type'];
        $_FILES['userfile']['tmp_name'] = $file['tmp_name'];
        $_FILES['userfile']['error'] = $file['error'];
        $_FILES['userfile']['size'] = $file['size'];

        $config['upload_path'] = './uploads/' . $path_name . '/full/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['max_size'] = '60000';

        $this->load->library('upload');
        $this->upload->initialize($config);
        $this->upload->do_upload();

        $data1 = array('upload_data' => $this->upload->data());
        $image = $data1['upload_data']['file_name'];
        $rename_file = date('Ymd') . time() . rand(111111, 99999999);
        $rename = $rename_file . $data1['upload_data']['file_ext'];

        rename('./uploads/' . $path_name . '/full/' . $image, './uploads/' . $path_name . '/full/' . $rename);

        $config['image_library'] = 'gd2';
        $config['source_image'] = './uploads/' . $path_name . '/full/' . $rename;
        $config['new_image'] = './uploads/' . $path_name . '/single/';
        //$config['create_thumb'] = FALSE;
        $config['maintain_ratio'] = FALSE;
        $config['width'] = '600';
        $config['height'] = '600';
        $this->load->library('image_lib', $config);
        $this->image_lib->initialize($config);
        $result = $this->image_lib->resize();
        $this->image_lib->clear();

        $config['new_image'] = './uploads/' . $path_name . '/thumb/';
        $config['width'] = '180';
        $config['height'] = '200';
        $this->image_lib->initialize($config);
        $result = $this->image_lib->resize();
        $this->image_lib->clear();
        return $rename;
    }

    /*
     * @methodName Pr()
     * @access
     * @param  none
     * @return  Debug Function   
     */

    private function pr($data) {
        echo "<pre>";
        print_r($data);
        echo "</pre>";
        exit;
    }

    /*
     * @methodName index()
     * @access
     * @param  none
     * @return  //Welcome page  
     */

    function itemSetup() {
        $this->data['title'] = "Item Setup";
        $this->data['list'] = $this->lookUpModel->getAllItemList();
        $this->content = 'item/index'; // passing content to function. change this for different views.
        $this->layOut();
    }

    /*
     * @methodName Create()
     * @access
     * @param  none
     * @return  //Load divition create page
     */

    public function create() {
        if (isset($_POST['fld_item_name'])) {
            $data = array(
                'fld_description' => $this->input->post('fld_description', true),
                'fld_item_name' => $this->input->post('fld_item_name', true),
                'fld_type' => $this->input->post('fld_type', true),
                'fld_unit' => $this->input->post('fld_unit', true),
                'fld_ledger_page' => $this->input->post('fld_ledger_page', true),
                'fld_cre_by' => $this->user_session["user_id"],
                'fld_cre_date' => $this->input->post('receive_date', true),
                'fld_active' => (isset($_POST['ACTIVE_STATUS'])) ? 1 : 0,
            );
            if ($id = $this->lookUpModel->insert('sa_item', $data)) {

                if (isset($_FILES['image']) && !empty($_FILES["image"]["name"])) {
                    $imageData['item_id'] = $id;
                    $imageData['image_path'] = $this->image_upload($_FILES['image'], 'item');
                    $this->lookUpModel->insert('im_item_gallery', $imageData);
                }

                redirect('index.php/setup/itemSetup');
            }
        }
        $data['unit'] = $this->utilities->dropdownFromTableWithCondition('sa_lookup_data', '', 'LOOKUP_DATA_ID', 'LOOKUP_DATA_NAME', array('LOOKUP_GRP_ID' => '46'));
        $data['type'] = $this->utilities->dropdownFromTableWithCondition('sa_lookup_data', '', 'LOOKUP_DATA_ID', 'LOOKUP_DATA_NAME', array('LOOKUP_GRP_ID' => '48'));
        $this->load->view('item/create', $data);
    }

    /*
     * @methodName editItem()
     * @access
     * @param  none
     * @return  //Load divition create page
     */

    public function editItem() {
        $id = $this->uri->segment(3);
        if (isset($_POST['fld_description'])) {
            $idd = $this->input->post('fld_id');
            $data = array(
                'fld_description' => $this->input->post('fld_description', true),
                'fld_item_name' => $this->input->post('fld_item_name', true),
                'fld_type' => $this->input->post('fld_type', true),
                'fld_unit' => $this->input->post('fld_unit', true),
                'fld_ledger_page' => $this->input->post('fld_ledger_page', true),
                'fld_cre_by' => $this->user_session["user_id"],
                'fld_cre_date' => $this->input->post('receive_date', true),
                'fld_active' => (isset($_POST['ACTIVE_STATUS'])) ? 1 : 0,
            );
            $this->utilities->updateData('sa_item', $data, array('fld_id' => $idd));


            if (isset($_FILES['image']) && !empty($_FILES["image"]["name"])) {
                $checkExistImage = $this->utilities->findByAttribute('im_item_gallery', array('item_id' => $idd));
                if ($checkExistImage) {
                    $imageData['image_path'] = $this->image_upload($_FILES['image'], 'item');
                    $this->utilities->updateData('im_item_gallery', $imageData, array('item_id' => $idd));
                } else {
                    $imageData['item_id'] = $idd;
                    $imageData['image_path'] = $this->image_upload($_FILES['image'], 'item');
                    $this->lookUpModel->insert('im_item_gallery', $imageData);
                }
            }

            redirect('index.php/setup/itemSetup');
        }
        //$data['row'] = $this->utilities->findByAttribute('sa_item', array('fld_id' => $id));
        $data['row'] = $this->lookUpModel->getItemWithImageInfoById($id);
        $data['unit'] = $this->utilities->dropdownFromTableWithCondition('sa_lookup_data', '', 'LOOKUP_DATA_ID', 'LOOKUP_DATA_NAME', array('LOOKUP_GRP_ID' => '46'));
        $data['type'] = $this->utilities->dropdownFromTableWithCondition('sa_lookup_data', '', 'LOOKUP_DATA_ID', 'LOOKUP_DATA_NAME', array('LOOKUP_GRP_ID' => '48'));
        $this->load->view('item/edit', $data);
    }

    public function viewItem() {
        $id = $this->uri->segment(3);
        $data['unit'] = $this->utilities->dropdownFromTableWithCondition('sa_lookup_data', '', 'LOOKUP_DATA_ID', 'LOOKUP_DATA_NAME', array('LOOKUP_GRP_ID' => '46'));
        $data['type'] = $this->utilities->dropdownFromTableWithCondition('sa_lookup_data', '', 'LOOKUP_DATA_ID', 'LOOKUP_DATA_NAME', array('LOOKUP_GRP_ID' => '48'));
        $data['row'] = $this->utilities->findByAttribute('sa_item', array('fld_id' => $id));
        $this->load->view('item/itemView', $data);
    }

    public function goodsReceive() {
        $this->data['title'] = "Goods Received History";
        $this->data['category'] = $this->utilities->dropdownFromTableWithCondition('tbl_tree_variant', 'Select Category', 'id', 'name', array('parent_id' => '51'));
        $this->data['items'] = $this->utilities->dropdownFromTableWithCondition('sa_item', 'Select Item', 'fld_id', 'fld_item_name');
        if (($_POST['category']) || ($_POST['daterange']) || ($_POST['item'])) {
            //For report filterring
            $category_id = $_POST['category'];
            $sub_category_id = $_POST['subCategory'];
            $item_id = $_POST['item'];
            $dateRange = $_POST['daterange'];


            //Set param
            $this->data['category_id'] = $category_id;
            $this->data['subcategory_id'] = $sub_category_id;
            $this->data['item_id'] = $item_id;
            $this->data['daterange'] = $dateRange;

            //Reformat date 
            $dateData = explode(" - ", $dateRange);
            $minData = $dateData[0];
            $maxData = $dateData[1];



            if (!empty($dateRange)) {
                $result = $this->lookUpModel->getAllGoodsReceivedListByDate($minData, $maxData);
            }

            if (!empty($category_id) && empty($sub_category_id) && empty($item_id)) {

                $result = $this->lookUpModel->getItemListByCategory($category_id);
            }

            if (!empty($category_id) && !empty($sub_category_id) && empty($item_id)) {

                $result = $this->lookUpModel->getItemListBySubCategory($category_id, $sub_category_id);
            }

            if (!empty($category_id) && !empty($sub_category_id) && !empty($item_id)) {

                $result = $this->lookUpModel->getItemListByItem($category_id, $sub_category_id, $item_id);
            }


            if (!empty($category_id) && empty($sub_category_id) && !empty($item_id)) {

                $result = $this->lookUpModel->getItemListByCatAndItem($category_id, $item_id);
            }

            if (empty($category_id) && empty($sub_category_id) && !empty($item_id)) {

                $result = $this->lookUpModel->getItemListByOnleyItem($item_id);
            }
            $this->data['result'] = $result;
        } else {
            $this->data['result'] = $this->lookUpModel->getAllGoodsReceivedList();
        }
        $this->content = 'goodReceive/list';
        $this->layOut();
    }

    public function getFilteringForm() {
        $data['main_manu'] = $this->utilities->dropdownFromTableWithCondition('tbl_tree_variant', 'Select Category', 'id', 'name', array('parent_id' => '51'));
        //$data['items'] = $this->utilities->dropdownFromTableWithCondition('sa_item', 'Select Item', 'fld_id', 'fld_item_name');
        $data['items'] = $this->lookUpModel->getAllItemWithImageInfo();
        $data['type'] = $this->utilities->dropdownFromTableWithCondition('sa_lookup_data', 'Select Type', 'LOOKUP_DATA_ID', 'LOOKUP_DATA_NAME', array('LOOKUP_GRP_ID' => '48'));
        $this->load->view('goodReceive/dataFilter', $data);
    }

    public function getFilteringFormForDistribution() {
        $data['main_manu'] = $this->utilities->dropdownFromTableWithCondition('tbl_tree_variant', 'Select Category', 'id', 'name', array('parent_id' => '51'));
        $data['items'] = $this->lookUpModel->getAllItemWithImageInfo();
        //$data['items'] = $this->utilities->dropdownFromTableWithCondition('sa_item', 'Select Item', 'fld_id', 'fld_item_name');
        $data['type'] = $this->utilities->dropdownFromTableWithCondition('sa_lookup_data', 'Select Type', 'LOOKUP_DATA_ID', 'LOOKUP_DATA_NAME', array('LOOKUP_GRP_ID' => '48'));
        $this->load->view('distribution/dataFilter', $data);
    }

    public function getFilteringFormForEditDistribution() {
        $data['user'] = $this->utilities->dropdownFromTableWithCondition('tbl_user', 'Select User', 'id', 'fullName');
        $data['main_manu'] = $this->utilities->dropdownFromTableWithCondition('tbl_tree_variant', 'Select Category', 'id', 'name', array('parent_id' => '51'));
        //$data['items'] = $this->utilities->dropdownFromTableWithCondition('sa_item', 'Select Item', 'fld_id', 'fld_item_name');
        $data['items'] = $this->lookUpModel->getAllItemWithImageInfo();
        $data['type'] = $this->utilities->dropdownFromTableWithCondition('sa_lookup_data', 'Select Type', 'LOOKUP_DATA_ID', 'LOOKUP_DATA_NAME', array('LOOKUP_GRP_ID' => '48'));
        $this->load->view('editDistribution/dataFilter', $data);
    }

    public function getFilteringFormForDistributed($id = "") {
        $data['id'] = $id;
        $data['main_manu'] = $this->utilities->dropdownFromTableWithCondition('tbl_tree_variant', 'Select Category', 'id', 'name', array('parent_id' => '51'));
        //$data['items'] = $this->utilities->dropdownFromTableWithCondition('sa_item', 'Select Item', 'fld_id', 'fld_item_name');
        $data['items'] = $this->lookUpModel->getAllItemWithImageInfo();
        $data['type'] = $this->utilities->dropdownFromTableWithCondition('sa_lookup_data', 'Select Type', 'LOOKUP_DATA_ID', 'LOOKUP_DATA_NAME', array('LOOKUP_GRP_ID' => '48'));
        $this->load->view('distributed/dataFilter', $data);
    }

    public function getGoodsReceiveForm() {
        $data['main_manu'] = $this->utilities->dropdownFromTableWithCondition('tbl_tree_variant', 'Select Category', 'id', 'name', array('parent_id' => '51'));
        $data['items'] = $this->utilities->dropdownFromTableWithCondition('sa_item', 'Select Item', 'fld_id', 'fld_item_name');
        //$data['items'] = $this->lookUpModel->getAllItemWithImageInfo();
        $data['store'] = $this->utilities->dropdownFromTableWithCondition('sa_lookup_data', 'Select Store', 'LOOKUP_DATA_ID', 'LOOKUP_DATA_NAME', array('LOOKUP_GRP_ID' => '49'));
        $this->load->view('goodReceive/form', $data);
    }

    public function getFilteringFormForReceived() {
        $data['main_manu'] = $this->utilities->dropdownFromTableWithCondition('tbl_tree_variant', 'Select Category', 'id', 'name', array('parent_id' => '51'));
        //$data['items'] = $this->utilities->dropdownFromTableWithCondition('sa_item', 'Select Item', 'fld_id', 'fld_item_name');
        $data['items'] = $this->lookUpModel->getAllItemWithImageInfo();
        $data['store'] = $this->utilities->dropdownFromTableWithCondition('sa_lookup_data', 'Select Store', 'LOOKUP_DATA_ID', 'LOOKUP_DATA_NAME', array('LOOKUP_GRP_ID' => '49'));
        $this->load->view('receives/dataFilter', $data);
    }

    public function getFilteringFormForConsuming() {
        $data['main_manu'] = $this->utilities->dropdownFromTableWithCondition('tbl_tree_variant', 'Select Category', 'id', 'name', array('parent_id' => '51'));
        //$data['items'] = $this->utilities->dropdownFromTableWithCondition('sa_item', 'Select Item', 'fld_id', 'fld_item_name');
        $data['items'] = $this->lookUpModel->getAllItemWithImageInfo();
        $data['store'] = $this->utilities->dropdownFromTableWithCondition('sa_lookup_data', 'Select Store', 'LOOKUP_DATA_ID', 'LOOKUP_DATA_NAME', array('LOOKUP_GRP_ID' => '49'));
        $this->load->view('consumer/dataFilter', $data);
    }

    public function getCategoryList() {
        $mainMenuid = $_POST['main_manu_id'];
        if (!empty($mainMenuid)) {
            $categories = $this->utilities->dropdownFromTableWithCondition('tbl_tree_variant', 'Select Sub Category', 'id', 'name', array('parent_id' => $mainMenuid,));
        }
        echo form_dropdown('category[]', $categories);
    }

    public function getItemList() {
        $categoryId = $_POST['category_id'];
        if (!empty($categoryId)) {
            $items = $this->utilities->dropdownFromTableWithCondition('sa_item', 'Select Item', 'fld_id', 'fld_item_name');
        }
        echo form_dropdown('item[]', $items);
    }

    public function getItemListForMultiple() {
        $items = $this->utilities->dropdownFromTableWithCondition('sa_item', 'Select Item', 'fld_id', 'fld_item_name');
        echo form_dropdown('item[]', $items);
    }

    public function getCategoryListSelect() {
        $mainMenuid = $_POST['main_manu_id'];
        if (!empty($mainMenuid)) {
            $categories = $this->utilities->dropdownFromTableWithCondition('tbl_tree_variant', 'Select Sub Category', 'id', 'name', array('parent_id' => $mainMenuid,));
        }
        echo form_dropdown('category', $categories);
    }

    public function getItemListSelect() {
        $categoryId = $_POST['category_id'];
        if (!empty($categoryId)) {
            $items = $this->utilities->dropdownFromTableWithCondition('sa_item', 'Select Item', 'fld_id', 'fld_item_name');
        }
        echo form_dropdown('item', $items);
    }

    public function saveStock() {
        
        if (isset($_POST['store'])) {
            $arrayLenth = count($this->input->post('mainmenu[]'));
            for ($i = 0; $i < $arrayLenth; $i++) {
                $data = array(
                    'fld_parent_id' => $p = $this->input->post("mainmenu[$i]"),
                    'fld_category_id' => $cat = $this->input->post("category[$i]"),
                    'fld_item_id' => $itm = $this->input->post("item[$i]"),
                    'fld_quantity' => $qnt = $this->input->post("quantity[$i]"),
                    'fld_history_quantity' => $qnt = $this->input->post("quantity[$i]"),
                    'fld_item_serial_number' => $this->input->post("itemSerialNumber[$i]"),
                    'fld_description' => $this->input->post("description[$i]"),
                    'fld_cre_date' => date('Y-m-d H:i:s'),
                    'fld_cre_by' => $this->user_session['user_id']
                );
                $data['fld_store_id'] = $this->input->post('store');
                $data['fld_last_receive_date'] = $this->input->post('receive_date');
                $insertId = $this->lookUpModel->insert('im_stock', $data); //insert data 
                if (isset($_FILES['image' . $i]) && !empty($_FILES['image' . $i]['name'])) {
                    $imageData['image_path'] = $this->image_upload($_FILES['image' . $i], 'item');
                    $imageData['item_id'] = $insertId;
                    $this->lookUpModel->insert('im_gallery', $imageData);
                }
                // For Issue Quantity Item
//                $existResult = $this->utilities->findByAttribute('im_quantity', array('parent_id' => $p, 'category_id' => $cat, 'item_id' => $itm));
//                if ($existResult) {
//                    $issueItem['item_quantity'] = $qnt + $existResult->item_quantity;
//                    $this->utilities->updateData('im_quantity', $issueItem, array('parent_id' => $p, 'category_id' => $cat, 'item_id' => $itm));
//                } else {
//                    $issueItem['parent_id'] = $p;
//                    $issueItem['category_id'] = $cat;
//                    $issueItem['item_id'] = $itm;
//                    $issueItem['item_quantity'] = $qnt;
//                    $this->lookUpModel->insert('im_quantity', $issueItem);
//                }
                // For Issue Quantity Item
            }
            redirect('index.php/setup/goodsReceive');
        }
    }

    public function distribution() {
        $this->data['title'] = "Stock List";
        $this->data['category'] = $this->utilities->dropdownFromTableWithCondition('tbl_tree_variant', 'Select Category', 'id', 'name', array('parent_id' => '51'));
        if (($_POST['category']) || ($_POST['daterange']) || ($_POST['item'])) {
            $category_id = $_POST['category'];
            $sub_category_id = $_POST['subCategory'];
            $item_id = $_POST['item'];
            $dateRange = $_POST['daterange'];

            //Reformat date 
            $dateData = explode(" - ", $dateRange);
            $minData = $dateData[0];
            $maxData = $dateData[1];
            if (!empty($dateRange)) {
                $result = $this->lookUpModel->getAllGoodsReceivedListByDate($minData, $maxData);
            }
            if (!empty($category_id) && empty($sub_category_id) && empty($item_id)) {

                $result = $this->lookUpModel->getItemListByCategory($category_id);
            }
            if (!empty($category_id) && !empty($sub_category_id) && empty($item_id)) {

                $result = $this->lookUpModel->getItemListBySubCategory($category_id, $sub_category_id);
            }
            if (!empty($category_id) && !empty($sub_category_id) && !empty($item_id)) {

                $result = $this->lookUpModel->getItemListByItem($category_id, $sub_category_id, $item_id);
            }
            if (!empty($category_id) && !empty($sub_category_id) && !empty($item_id)) {

                $result = $this->lookUpModel->getItemListByItem($category_id, $sub_category_id, $item_id);
            }
            if (!empty($category_id) && empty($sub_category_id) && !empty($item_id)) {

                $result = $this->lookUpModel->getItemListByCatAndItem($category_id, $item_id);
            }
            if (empty($category_id) && empty($sub_category_id) && !empty($item_id)) {

                $result = $this->lookUpModel->getItemListByOnleyItem($item_id);
            }
            $this->data['result'] = $result;
        } else {
            $this->data['result'] = $this->lookUpModel->getAllStockedList();
//            $this->pr($this->data['result']);
        }
        $this->content = 'distribution/list';
        $this->layOut();
    }

    public function editIssueItemList() {
        $this->data['title'] = "Edit Issue List";
        $this->data['category'] = $this->utilities->dropdownFromTableWithCondition('tbl_tree_variant', 'Select Category', 'id', 'name', array('parent_id' => '51'));

        if (($_POST['category']) || ($_POST['daterange']) || ($_POST['item']) || ($_POST['user'])) {
            $category_id = $_POST['category'];
            $sub_category_id = $_POST['subCategory'];
            $item_id = $_POST['item'];
            $dateRange = $_POST['daterange'];
            $user = $_POST['user'];
            
            $dateData = explode(" - ", $dateRange);
            $minData = $dateData[0];
            $maxData = $dateData[1];
            if (!empty($user)) {
                $result = $this->utilities->getAllDistributedItemForEditByUser($user);
            }
            if (!empty($dateRange)) {
                $result = $this->utilities->getAllDistributedItemForEditByDate($minData, $maxData);
            }
            if (!empty($category_id) && empty($sub_category_id) && empty($item_id)) {

                $result = $this->utilities->getAllDistributedItemForEditByCategory($category_id);
            }
            if (!empty($category_id) && !empty($sub_category_id) && empty($item_id)) {

                $result = $this->utilities->getAllDistributedItemForEditBySubCategory($category_id, $sub_category_id);
            }
            if (!empty($category_id) && !empty($sub_category_id) && !empty($item_id)) {

                $result = $this->utilities->getAllDistributedItemForEditByItem($category_id, $sub_category_id, $item_id);
            }
            if (!empty($category_id) && empty($sub_category_id) && !empty($item_id)) {

                $result = $this->utilities->getAllDistributedItemForEditByCatAndItem($category_id, $item_id);
            }
            if (empty($category_id) && empty($sub_category_id) && !empty($item_id)) {

                $result = $this->utilities->getAllDistributedItemForEditByOnleyItem($item_id);
            }
            $this->data['result'] = $result;
        } else {
            $this->data['result'] = $this->utilities->getAllDistributedItemForEdit();
        }
        $this->data['category'] = $category_id;
        $this->data['subCategory'] = $sub_category_id;
        $this->data['item'] = $item_id;
        $this->content = 'editDistribution/list';
        $this->layOut();
    }

    public function getDistributionForm() {
        $id = $this->uri->segment(3);
//        $p = $this->uri->segment(3);
//        $cat = $this->uri->segment(4);
//        $id = $this->uri->segment(5);
//        $data['result'] = $this->lookUpModel->getAllGoodsReceivedListById($p, $cat, $id);
        $data['image_id'] = $id;
        $data['result'] = $this->lookUpModel->getAllGoodsReceivedListById($id);
        $data['image'] = $this->utilities->findByAttribute('im_gallery', array('item_id' => $id));
        $data['user'] = $this->utilities->dropdownFromTableWithCondition('tbl_user', '', 'id', 'fullName');
//        $this->pr($data);
        $this->load->view('distribution/distribute', $data);
    }

    public function saveDistributionItem() {
        $id = $this->input->post('id');
        $item_id = $this->input->post('item_id');
        $category_id = $this->input->post('category_id');
        $parent_id = $this->input->post('parent_id');
        $receiveDate = $this->input->post('receive_date');
        $curr_data['fld_quantity'] = $this->input->post('current_quantity');
        $user_id = $this->input->post('user_id');
        $this->utilities->updateData('im_stock', $curr_data, array('fld_id' => $id));
        //Update stock item quantity

        $result = $this->utilities->findByAttribute('im_distribution', array('parent_id' => $parent_id, 'category_id' => $category_id, 'item_id' => $item_id, 'user_id' => $user_id, 'cre_date' => $receiveDate));
        if ($result) {
            $exdata['image_id'] = $this->input->post('image_id');
            $exdata['quantity'] = $this->input->post('issue_quantity') + $result->quantity;
            $exdata['remarks'] = $this->input->post('remarks');
            //$exdata['cre_date'] = $this->input->post('receive_date');
            $this->utilities->updateData('im_distribution', $exdata, array('parent_id' => $parent_id, 'category_id' => $category_id, 'item_id' => $item_id, 'user_id' => $user_id, 'cre_date' => $receiveDate));
        } else {
            $data['image_id'] = $this->input->post('image_id');
            $data['item_id'] = $item_id;
            $data['parent_id'] = $parent_id;
            $data['category_id'] = $category_id;
            $data['quantity'] = $this->input->post('issue_quantity');
            $data['remarks'] = $this->input->post('remarks');
            $data['cre_date'] = $this->input->post('receive_date');
            $data['user_id'] = $user_id;
            $this->utilities->insertData($data, 'im_distribution');
        }
        redirect("index.php/setup/distribution/");
    }

    public function getDistributionEditForm() {
        $id = $this->uri->segment(3);
        $image_id = $this->uri->segment(4);
        $data['result'] = $this->utilities->getDistributionDetailsById($id);
        $data['image'] = $this->utilities->findByAttribute('im_gallery', array('item_id' => $image_id));
        $data['user'] = $this->utilities->dropdownFromTableWithCondition('tbl_user', '', 'id', 'fullName');
//        $this->pr($data);
        $this->load->view('editDistribution/editDistribute', $data);
    }

    public function saveEditDistributionItem() {
        $id = $this->input->post('id');
        $stock_idd = $this->input->post('stock_id');
        $item_id = $this->input->post('item_id');
        $category_id = $this->input->post('category_id');
        $parent_id = $this->input->post('parent_id');
//      $issue_data['user_id'] = $this->input->post('user_id');
        $issue_data['cre_date'] = $this->input->post('receive_date');
        $issue_data['quantity'] = $this->input->post('issue_quantity');
        $issue_data['remarks'] = $this->input->post('remarks');
        $user_id = $this->input->post('user_id_exist');

        $this->utilities->updateData('im_distribution', $issue_data, array('parent_id' => $parent_id, 'category_id' => $category_id, 'item_id' => $item_id, 'user_id' => $user_id));

        $result = $this->utilities->findByAttribute('im_stock', array('fld_parent_id' => $parent_id, 'fld_category_id' => $category_id, 'fld_item_id' => $item_id, 'fld_id' => $stock_idd));
        if ($result) {
            $stock_id = $result->fld_id;
            $quantity = $result->fld_quantity + $this->input->post('current_quantity');
            $curr_data['fld_quantity'] = $quantity;
            $this->utilities->updateData('im_stock', $curr_data, array('fld_id' => $stock_id));
        }

        //Update stock item quantity
        redirect("index.php/setup/editIssueItemList/");
    }

    public function distributedItem($id) { // ($id) user id
        $this->data['title'] = "Distributed Item";
        $this->data['category'] = $this->utilities->dropdownFromTableWithCondition('tbl_tree_variant', 'Select Category', 'id', 'name', array('parent_id' => '51'));

        $dateRange = $_POST['daterange'];
        $this->data['id'] = $id;
        //Reformat date 
        $dateData = explode(" - ", $dateRange);
        $minData = $dateData[0];
        $maxData = $dateData[1];
        if (($_POST['category']) || ($_POST['item']) || ($_POST['daterange'])) {

            $category_id = $_POST['category'];
            $sub_category_id = $_POST['subCategory'];
            $item_id = $_POST['item'];

            if (!empty($dateRange)) {
                $result = $this->utilities->getAllDistributedItemByDate($minData, $maxData, $id);
            }

            if (!empty($category_id) && empty($sub_category_id) && empty($item_id)) {

                $result = $this->utilities->getAllDistributedItemByCategory($category_id, $id);
            }

            if (!empty($category_id) && !empty($sub_category_id) && empty($item_id)) {

                $result = $this->utilities->getAllDistributedItemBySubCategory($category_id, $sub_category_id, $id);
            }

            if (!empty($category_id) && !empty($sub_category_id) && !empty($item_id)) {

                $result = $this->utilities->getAllDistributedItemByItem($category_id, $sub_category_id, $item_id, $id);
            }

            if (empty($category_id) && empty($sub_category_id) && !empty($item_id)) {

                $result = $this->utilities->getAllDistributedItemByOnleyItem($item_id, $id);
            }

            $this->data['result'] = $result;
        } else {
            $this->data['result'] = $this->utilities->getAllDistributedItemById($id);
        }
        $this->content = 'distributed/list';
        $this->layOut();
    }

    public function receive() {
        $id = $this->user_session['user_id'];
        $this->data['user_id'] = $id;
        $this->data['title'] = "Received List";
        $this->data['category'] = $this->utilities->dropdownFromTableWithCondition('tbl_tree_variant', 'Select Category', 'id', 'name', array('parent_id' => '51'));

        $dateRange = $_POST['daterange'];
        //Reformat date 
        $dateData = explode(" - ", $dateRange);
        $minData = $dateData[0];
        $maxData = $dateData[1];

        if (($_POST['category']) || ($_POST['item']) || ($_POST['daterange'])) {
            $category_id = $_POST['category'];
            $sub_category_id = $_POST['subCategory'];
            $item_id = $_POST['item'];

            if (!empty($dateRange)) {
                $result = $this->utilities->getAllDistributedItemByDate($minData, $maxData, $id);
            }
            if (!empty($category_id) && empty($sub_category_id) && empty($item_id)) {

                $result = $this->utilities->getAllDistributedItemByCategory($category_id, $id); // same as receive get all item by user
            }
            if (!empty($category_id) && !empty($sub_category_id) && empty($item_id)) {

                $result = $this->utilities->getAllDistributedItemBySubCategory($category_id, $sub_category_id, $id); // same as receive get all item by user
            }
            if (!empty($category_id) && !empty($sub_category_id) && !empty($item_id)) {

                $result = $this->utilities->getAllDistributedItemByItem($category_id, $sub_category_id, $item_id, $id); // same as receive get all item by user
            }
            if (empty($category_id) && empty($sub_category_id) && !empty($item_id)) {

                $result = $this->utilities->getAllDistributedItemByItemForReceive($item_id, $id); // same as receive get all item by user
            }
            $this->data['result'] = $result;
        } else {
            $this->data['result'] = $this->utilities->getAllDistributedItemById($id);
        }
//        $this->pr($this->data['result']);
        $this->content = 'receives/list';
        $this->layOut();
    }

    public function getConsumeForm($id) {
        $data['result'] = $result = $this->utilities->getConsumeFormById($id);
        $data['image_d'] = $image_id = $result->image_id;
        $data['image'] = $this->utilities->findByAttribute('im_gallery', array('item_id' => $image_id));
        $this->load->view('consume/consume', $data);
    }

    public function viewConsumeForm($id) {
        $data['result'] = $result = $this->utilities->getConsumingFormById($id);
        $image_id = $result->image_id;
        $data['image'] = $this->utilities->findByAttribute('im_gallery', array('item_id' => $image_id));
//        $this->pr($data);
        $this->load->view('consume/view', $data);
    }

    public function saveConsumeItem() {
        $id = $this->input->post('id');
        $item_id = $this->input->post('item_id');
        $parent_id = $this->input->post('parent_id');
        $user_id = $this->user_session['user_id'];
        $curr_data['quantity'] = $this->input->post('current_quantity');
        $this->utilities->updateData('im_distribution', $curr_data, array('id' => $id));

        $data['item_id'] = $item_id;
        $data['parent_id'] = $parent_id;
        $data['image_id'] = $this->input->post('image_id');
        $data['category_id'] = $this->input->post('category_id');
        $data['quantity'] = $this->input->post('issue_quantity');
        $data['remarks'] = $this->input->post('remarks');
        $data['cre_date'] = $this->input->post('receive_date');
        $data['user_id'] = $user_id;
        $this->utilities->insertData($data, 'im_consume');
        redirect("index.php/setup/receive");
    }

    public function consuming() {
        $id = $this->user_session['user_id'];
        $this->data['user_id'] = $id;
        $this->data['title'] = "Consuming List";
        $this->data['category'] = $this->utilities->dropdownFromTableWithCondition('tbl_tree_variant', 'Select Category', 'id', 'name', array('parent_id' => '51'));



        $dateRange = $_POST['daterange'];
        //Reformat date 
        $dateData = explode(" - ", $dateRange);
        $minData = $dateData[0];
        $maxData = $dateData[1];

        if (($_POST['category']) || ($_POST['item']) || ($_POST['daterange'])) {
            $category_id = $_POST['category'];
            $sub_category_id = $_POST['subCategory'];
            $item_id = $_POST['item'];

            if (!empty($dateRange)) {
                $result = $this->utilities->getAllConsumerItemByDate($minData, $maxData, $id);
            }

            if (empty($category_id) && empty($sub_category_id) && empty($item_id)) {
                $result = $this->utilities->getAllConsumerByUser($id);
            }

            if (!empty($category_id) && empty($sub_category_id) && empty($item_id)) {

                $result = $this->utilities->getAllConsumerByCategory($category_id, $id);
            }
            if (!empty($category_id) && !empty($sub_category_id) && empty($item_id)) {

                $result = $this->utilities->getAllConsumerBySubCategory($category_id, $sub_category_id, $id);
            }
            if (empty($category_id) && empty($sub_category_id) && !empty($item_id)) {

                $result = $this->utilities->getAllConsumerByOnleyItem($item_id, $id);
            }
            $this->data['result'] = $result;
        } else {
            $this->data['result'] = $this->utilities->getAllConsumerByUser($id);
        }
//        $this->pr($this->data['result']);
        $this->content = 'consumer/list';
        $this->layOut();
    }

    public function deleteItem() {
        $id = $_POST['itemid'];
        $this->utilities->deleteRowByAttribute('sa_item', array('fld_id' => $id));
    }

    public function viewGoodsReceiveItem() {
        $id = $this->uri->segment(3);
        $data['result'] = $this->lookUpModel->getGoodsReceivedListById($id);
        $data['image'] = $this->utilities->findByAttribute('im_gallery', array('item_id' => $id));
        $data['store'] = $this->utilities->dropdownFromTableWithCondition('sa_lookup_data', 'Select Store', 'LOOKUP_DATA_ID', 'LOOKUP_DATA_NAME', array('LOOKUP_GRP_ID' => '49'));
        $this->load->view('goodReceive/view', $data);
    }

    public function editGoodsReceiveItem() {
        $id = $this->uri->segment(3);
        if (isset($_POST['item'])) {

            //Curent item's ID
            $prnt_name = $this->input->post('prnt_name', true);
            $cat_name = $this->input->post('cat_name', true);
            $itm_name = $this->input->post('itm_name', true);


            $idd = $this->input->post('fld_id');
            $data = array(
                'fld_store_id' => $str = $this->input->post('store', true),
                'fld_parent_id' => $prnt = $this->input->post('mainmenu', true),
                'fld_category_id' => $cat = $this->input->post('category', true),
                'fld_item_id' => $itm = $this->input->post('item', true),
                'fld_quantity' => ($this->input->post('stock_quantity') + (($this->input->post('quantity', true)) - ($this->input->post('history_quantity')))),
                'fld_history_quantity' => $this->input->post('quantity', true),
                'fld_item_serial_number' => $this->input->post('itemSerialNumber', true),
                'fld_description' => $this->input->post('description', true),
                'fld_cre_by' => $this->user_session["user_id"],
                'fld_upd_date' => date('Y-m-d H:i:s'),
                'fld_last_receive_date' => $this->input->post('receive_date'),
            );
            if (isset($_FILES['image']) && !empty($_FILES['image']['name'])) {
                $checkExistImage = $this->utilities->findByAttribute('im_gallery', array('item_id' => $idd));
                if ($checkExistImage) {
                    $imageData['image_path'] = $this->image_upload($_FILES['image'], 'item');
                    $this->utilities->updateData('im_gallery', $imageData, array('item_id' => $idd));
                } else {
                    $imageData['item_id'] = $idd;
                    $imageData['image_path'] = $this->image_upload($_FILES['image'], 'item');
                    $this->lookUpModel->insert('im_gallery', $imageData);
                }
            }

            $distribution = $this->utilities->findByAttribute('im_distribution', array('parent_id' => $prnt_name, 'category_id' => $cat_name, 'item_id' => $itm_name));

//            $this->pr($distribution);

            if ($distribution) {
                $distrib['parent_id'] = $prnt;
                $distrib['category_id'] = $cat;
                $distrib['item_id'] = $itm;
                $this->utilities->updateData('im_distribution', $distrib, array('parent_id' => $prnt_name, 'category_id' => $cat_name, 'item_id' => $itm_name));
            }

            $consumeData = $this->utilities->findByAttribute('im_consume', array('parent_id' => $prnt_name, 'category_id' => $cat_name, 'item_id' => $itm_name));
            if ($consumeData) {
                $consumData['parent_id'] = $prnt;
                $consumData['category_id'] = $cat;
                $consumData['item_id'] = $itm;
                $this->utilities->updateData('im_consume', $consumData, array('parent_id' => $prnt_name, 'category_id' => $cat_name, 'item_id' => $itm_name));
            }



            if ($this->utilities->updateData('im_stock', $data, array('fld_id' => $idd))) {
                redirect('index.php/setup/goodsReceive');
            }
        }
        $data['image'] = $this->utilities->findByAttribute('im_gallery', array('item_id' => $id));
        $data['result'] = $this->lookUpModel->getGoodsReceivedListById($id);
        $data['main_manu'] = $this->utilities->dropdownFromTableWithCondition('tbl_tree_variant', 'Select Category', 'id', 'name', array('parent_id' => '51'));
        $data['category'] = $this->utilities->dropdownFromTableWithCondition('tbl_tree_variant', 'Select Sub Category', 'id', 'name');
        $data['items'] = $this->utilities->dropdownFromTableWithCondition('sa_item', 'Select Item', 'fld_id', 'fld_item_name');
        $data['store'] = $this->utilities->dropdownFromTableWithCondition('sa_lookup_data', 'Select Store', 'LOOKUP_DATA_ID', 'LOOKUP_DATA_NAME', array('LOOKUP_GRP_ID' => '49'));
//        $this->pr($data);
        $this->load->view('goodReceive/edit', $data);
    }

    public function deleteGoodsReceiveItem() {
        $id = $_POST['itemid'];
        $this->utilities->deleteRowByAttribute('im_stock', array('fld_id' => $id));
    }
    
    public function checkItemType($id){
        $result=$this->db->query("SELECT  a.fld_type FROM sa_item a WHERE a.fld_id = {$id}")->result();
        echo json_encode($result);
        
    }
    
    

}