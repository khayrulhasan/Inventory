<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Description of LookUp Controller
 *
 * @author Khayrul Hasan
 */
class LookUp extends CI_Controller {

    //set the class variable.
    var $template = array();
    var $data = array();
    private $now;
    public $product_id;

    public function __construct() {
        parent::__construct();
        $this->user_session = $this->session->userdata('logged_in');
        if (!$this->user_session) {
            redirect('index.php/login/index');
        }
        //get current time
        date_default_timezone_set("Asia/Dhaka");
        $this->now = date('Y-m-d H:i:s', time());

        $this->load->model('lookUpModel');
        $this->load->model('utilities');
    }

    /*
     * @methodName layout()
     * @access
     * @param  none
     * @return  //Load layout  
     */

    private function layOut() {
        $this->data['user'] = $this->user_session['user_name'];
        $this->data['status'] = $this->user_session['user_status'];
        $this->data['main_menus'] = $this->utilities->findByAttributeAll('tbl_tree_variant', array('parent_id' => '51'));
        $this->data['users'] = $this->lookUpModel->get_all('tbl_user');

//        $this->pr($this->data['users']);
        // making temlate and send data to view.
        $this->template['header'] = $this->load->view('layouts/header', $this->data, true);
        $this->template['content'] = $this->load->view($this->content, $this->data, true);
        $this->template['footer'] = $this->load->view('layouts/footer', $this->data, true);
        $this->load->view('layouts/index', $this->template);
    }

    /*
     * @methodName Build Tree()
     * @access
     * @param  none
     * @return  //data tree formate  
     */

    private function buildTree($flat, $pidKey, $idKey = null) {
        $grouped = array();
        foreach ($flat as $sub) {
            $grouped[$sub[$pidKey]][] = $sub;
        }
        $treeBuilder = function($siblings) use (&$treeBuilder, $grouped, $idKey) {
                    foreach ($siblings as $k => $sibling) {
                        $id = $sibling[$idKey];
                        if (isset($grouped[$id])) {
                            $sibling['children'] = $treeBuilder($grouped[$id]);
                        }
                        $siblings[$k] = $sibling;
                    }
                    return $siblings;
                };
        $tree = $treeBuilder($grouped[0]);
        return $tree;
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

    function index() {
        $this->data['title'] = "Dashboard";
        $this->data['total_stock'] = $this->lookUpModel->getAllTotalStock();
        $this->data['total_given'] = $this->lookUpModel->getAllTotalGiven();
        $this->data['total_consume'] = $this->lookUpModel->getAllTotalConsume();
        $this->data['total_inconsume'] = $this->lookUpModel->getAllTotalInconsume();
        $this->data['pieChart'] = $this->lookUpModel->getALLItemData();
        $this->data['areaChart'] = $this->lookUpModel->getALLItemDataForAreaChart();
//        $this->pr($this->data['areaChart']);
        $this->content = 'layouts/welcome'; // passing content to function. change this for different views.
        $this->layOut();
    }

    /*
     * @methodName Create category()
     * @access
     * @param  none
     * @return  //View All Category   
     */

    function createVariant() {
        $this->data['title'] = "Show Category";
        $query = $this->db->query('select * from tbl_tree_variant')->result_array();
        $this->data["tree"] = $this->buildTree($query, 'parent_id', 'id');
        $this->content = 'variant/index';
        $this->layOut();
    }

    /*
     * @methodName Add Category Variant()
     * @access
     * @param  none
     * @return  //Show page For Form Create   
     */

    function addVariant($id) {
        $data['id'] = $id;
        $this->load->view('variant/add', $data);
    }

    function saveCategory() {
        $data['parent_id'] = $this->input->post('patent_id');
        $data['name'] = $this->input->post('name');
        $this->utilities->insertData($data, 'tbl_tree_variant');
        redirect('index.php/lookUp/createVariant');
    }

    /*
     * @methodName Edit Variant()
     * @access
     * @param  none
     * @return  //Show page For Form Create   
     */

    function editVariant($id) {
        $data['result'] = $this->utilities->findByAttribute('tbl_tree_variant', array('id' => $id));
        $this->load->view('variant/edit', $data);
    }

    function updateCategory() {
        $id = $this->input->post('id');
        $data['name'] = $this->input->post('name');
        $this->utilities->updateData('tbl_tree_variant', $data, array('id' => $id));
        redirect('index.php/lookUp/createVariant');
    }

    function deleteVariant($id) {
        $data['id'] = $id;
        $this->load->view('variant/delete', $data);
    }

    function deleteCategory($id) {
        $this->utilities->deleteRowByAttribute('tbl_tree_variant', array('id' => $id));
        redirect('index.php/lookUp/createVariant');
    }

    /*
     * @methodName Variant All Content() //ajax
     * @access
     * @param  none
     * @return  variant all content By Id   
     */

    function getVariantAllContentById() {
        $id = $_POST['variantId'];
        $result = $this->lookUpModel->getVariantAllContentInfo($id);
        echo json_encode($result);
    }

    /*
     * @methodName type setup ()
     * @access
     * @param  none
     * @return  //Show type setup page
     */

    function typeSetUp() {
        $this->data['title'] = "Type Setup";
        $this->data['lists'] = $this->db->query("SELECT * FROM tbl_types")->result();
        $this->content = 'type/add';
        $this->layOut();
    }

    /*
     * @methodName Item setup()
     * @access
     * @param  none
     * @return  //Show Item Setup page
     */

//    function itemSetup() {
//        $query = $this->db->query("SELECT tbl_tree_variant.name, tbl_tree_variant.id, tbl_tree_variant.level, tbl_tree_variant.parent_id FROM tbl_tree_variant ORDER BY tbl_tree_variant.parent_id")->result_Array();
//        $this->data['title'] = "Item Setup";
//        $this->data['list'] = $this->lookUpModel->get_all_item();
//        $this->data['main_menu'] = $this->utilities->dropdownFromTableWithCondition('tbl_tree_variant', '', 'id', 'name', array('parent_id' => '51'));
//        $this->data['unit'] = $this->utilities->dropdownFromTableWithCondition('sa_lookup_data', '', 'LOOKUP_DATA_ID', 'LOOKUP_DATA_NAME', array('LOOKUP_GRP_ID' => '46'));
//        $this->data['type'] = $this->utilities->dropdownFromTableWithCondition('sa_lookup_data', '', 'LOOKUP_DATA_ID', 'LOOKUP_DATA_NAME', array('LOOKUP_GRP_ID' => '48'));
//        $this->data['variant_list'] = $this->buildTree($query, 'parent_id', 'id');
//        $this->content = 'item/add';
//        $this->layOut();
//    }

    /*
     * @methodName get Variant By Id()
     * @access
     * @param  none
     * @return  //Get variant all data by filterint Id/ ajax
     */

    function getVariantById() {
        $id = $_POST['ID'];
        $result = $this->db->query("SELECT  tbl_tree_variant.parent_id, tbl_tree_variant.type, tbl_tree_variant.unit, tbl_tree_variant.manufacturer, tbl_tree_variant.name, tbl_tree_variant.parent_id,
        (select name from tbl_tree_variant where id = (SELECT parent_id FROM tbl_tree_variant where id={$id})) parant_name,
         tbl_tree_variant.colorpicker, tbl_tree_variant.canvas_image, tbl_gallery_group.gallery_path, tbl_tree_variant.id FROM tbl_tree_variant LEFT OUTER JOIN tbl_gallery_group ON tbl_gallery_group.gallery_id = tbl_tree_variant.id WHERE tbl_tree_variant.id={$id} ORDER BY tbl_gallery_group.id  DESC")->row();
        echo json_encode($result);
    }

    /*
     * @methodName get Variant All images()
     * @access
     * @param  none
     * @return  //Get variant all images/ ajax
     */

    function getVariantAllImages() {
        $id = $_POST['ID'];
        $result = $this->db->query("SELECT * FROM tbl_gallery_group where gallery_id= '$id'")->result();
        echo json_encode($result);
    }

    /*
     * @methodName get Form by Id()
     * @access
     * @param  none
     * @return  //Get all Form/ ajax
     */

    function getFormById() {
        $id = $_POST['ID'];
        $result = $this->db->query("SELECT * FROM tbl_forms where variant_option= '$id'")->row();
        echo json_encode($result);
    }

    /*
     * @methodName Save Requird data By ajax()
     * @access
     * @param  none
     * @return  //Get all Form/ ajax
     */

    function saveRequirdDataByAjax() {
        $data['item_id'] = $this->input->post('itemId');
        $data['item_name'] = $this->input->post('item_name');
        $data['item_active'] = $this->input->post('item_active');
        $data['item_obsolete'] = $this->input->post('item_obsolete');
        $data['parent_id'] = $this->input->post('parent_id');
        $data['parent_id'] = $this->input->post('parent_id');
        $data['parent_name'] = $this->input->post('parent_name');
        $data['item_flug'] = $this->input->post('item_flug');
        $data['manufacturer'] = $this->input->post('manufacturer');
        $data['others'] = $this->input->post('others');
        echo $id = $this->lookUpModel->insert('tbl_required', $data);
    }

    /*
     * @methodName Save Additional data By ajax()
     * @access
     * @param  none
     * @return  //Save Additional data and redirect requird page/ ajax
     */

    function saveAdditionalDataByAjax() {
        $tbl = 'dynamic_' . $this->input->post('table_name');
        $tableName = str_replace(' ', '_', $tbl);
        $data['item_id'] = $this->input->post('item_id');
        $data = $this->input->post();
        echo $id = $this->lookUpModel->insert($tableName, $data);
    }

    /*
     * @methodName Save Additional data By ajax()
     * @access
     * @param  none
     * @return  //Save Additional data and redirect requird page/ ajax
     */

    function itemSaveByAjax() {
        $data['parent_id'] = $this->input->post('parentId');
        $data['category_id'] = $itemId = $this->input->post('itemId');
        $data['item_name'] = $this->input->post('itemName');
        $data['description'] = $this->input->post('itemDescription');
        $data['item_quantity'] = $this->input->post('itemQuantity');
        $data['fld_unit'] = $this->input->post('itemUnit');
        $data['cre_date'] = date('Y-m-d H:i:s');
        $id = $this->lookUpModel->insert('tbl_item', $data);
        if ($id) {
            $result['list'] = $this->lookUpModel->get_all_by_attr();
            $this->load->view('item/list.php', $result);
        }
    }

    function showLookup() {
        $this->data['title'] = "All Groups";
        $this->data['result'] = $this->utilities->findAllFromView('sa_lookup_grp');
        $this->content = 'lookup/index';
        $this->layOut();
    }

    function addGroup() {
        $this->load->view('lookup/addGroup');
    }

    /*
     * @methodName saveGroup()
     * @access public
     * @param  none
     * @return  //  
     */

    public function saveGroup() {
        $group_data = array(
            'LOOKUP_GRP_NAME' => $this->input->post('LOOKUP_GRP_NAME'),
            'USE_CHAR_NUMB' => $this->input->post('short_name'),
            'ACTIVE_FLAG' => (isset($_POST['ACTIVE_FLAG'])) ? 1 : 0
        );
        $this->utilities->insertData($group_data, 'sa_lookup_grp');
        redirect('index.php/lookUp/showLookup');
    }

    /*
     * @methodName addGroupItem()
     * @access public
     * @param  $lkp_grp_id
     * @return  //  
     */

    function addGroupItem($lkp_grp_id, $USE_CHAR_NUMB) {
        $data['lkp_grp_id'] = $lkp_grp_id;
        $data['USE_CHAR_NUMB'] = $USE_CHAR_NUMB;
        $this->load->view('lookup/addGroupItem', $data);
    }

    /*
     * @methodName saveGroupIitem()
     * @access public
     * @param  
     * @return  //   return all data from table "sa_lookup_data"
     */

    function saveGroupIitem() {
        $LOOKUP_GRP_ID = $_POST['LOOKUP_GRP_ID'];
        $USE_CHAR_NUMB = $_POST['USE_CHAR_NUMB'];
        if ($USE_CHAR_NUMB == 'N') {
            $NUMB_LOOKUP = $_POST['NUMB_LOOKUP'];
            $CHAR_LOOKUP = '';
        } else {
            $NUMB_LOOKUP = '';
            $CHAR_LOOKUP = $_POST['CHAR_LOOKUP'];
        }
        $item_data = array(
            'LOOKUP_DATA_NAME' => $_POST['LOOKUP_DATA_NAME'],
            'LOOKUP_GRP_ID' => $LOOKUP_GRP_ID,
            'NUMB_LOOKUP' => $NUMB_LOOKUP,
            'CHAR_LOOKUP' => $CHAR_LOOKUP,
            'ACTIVE_FLAG' => $_POST['ACTIVE_FLAG']
        );
        $this->utilities->insertData($item_data, 'sa_lookup_data');
        $data['lookup_item_data'] = $this->utilities->findAllByAttribute('sa_lookup_data', array('LOOKUP_GRP_ID' => $LOOKUP_GRP_ID));
        $data['USE_CHAR_NUMB'] = $this->db->query("select USE_CHAR_NUMB  from sa_lookup_grp where LOOKUP_GRP_ID=$LOOKUP_GRP_ID")->row();
        $this->load->view('lookup/ajax_lookup_data', $data);
    }

    /*
     * @methodName editGroupItem()
     * @access public
     * @param  $lkp_id
     * @return  //   return all data from table "sa_lookup_data"
     */

    function editGroupItem($lkp_id) {
        $data['item'] = $this->lookUpModel->getLookupData($lkp_id);
        $this->load->view('lookup/editGroupIitem', $data);
    }

    /*
     * @methodName updateGroupItem()
     * @access public
     * @param  $lkp_id
     * @return  //   return all data from table "sa_lookup_data"
     */

    function updateGroupItem() {
        $LOOKUP_DATA_ID = $_POST['LOOKUP_DATA_ID'];
        $LOOKUP_GRP_ID = $_POST['LOOKUP_GRP_ID'];
        $USE_CHAR_NUMB = $_POST['USE_CHAR_NUMB'];
        if ($USE_CHAR_NUMB == 'N') {
            $NUMB_LOOKUP = $_POST['NUMB_LOOKUP'];
            $CHAR_LOOKUP = '';
        } else {
            $NUMB_LOOKUP = '';
            $CHAR_LOOKUP = $_POST['CHAR_LOOKUP'];
        }
        $act_fg = $_POST['active_flag'];
        $update_item_data = array(
            'LOOKUP_DATA_NAME' => $_POST['LOOKUP_DATA_NAME'],
            'NUMB_LOOKUP' => $NUMB_LOOKUP,
            'CHAR_LOOKUP' => $CHAR_LOOKUP,
            'ACTIVE_FLAG' => $act_fg
        );
        $this->utilities->updateData('sa_lookup_data', $update_item_data, array('LOOKUP_DATA_ID' => $LOOKUP_DATA_ID));
        $data['lookup_item_data'] = $this->utilities->findAllByAttribute('sa_lookup_data', array('LOOKUP_GRP_ID' => $LOOKUP_GRP_ID));
        $data['USE_CHAR_NUMB'] = $this->db->query("select USE_CHAR_NUMB  from sa_lookup_grp where LOOKUP_GRP_ID=$LOOKUP_GRP_ID")->row();
        $this->load->view('lookup/ajax_lookup_data', $data);
    }

    public function distribution($id) {
        $this->data['title'] = "Item List";
        $this->data['result'] = $this->lookUpModel->getAllItemByMainMenu($id);
        $this->content = 'distribution/list';
        $this->layOut();
    }

    public function getDistributionForm() {
        $id = $_POST['item_id'];
        $data['result'] = $this->utilities->getAllItemDetailsById($id);
        $data['user'] = $this->utilities->dropdownFromTableWithCondition('tbl_user', '', 'id', 'name');
        $this->load->view('distribution/distribute', $data);
    }

    public function saveDistributionItem() {
        $item_id = $this->input->post('item_id');
        $parent_id = $this->input->post('parent_id');
        $curr_data['item_quantity'] = $this->input->post('current_quantity');
        $user_id = $this->input->post('user_id');
        $this->lookUpModel->update('tbl_item', $item_id, $curr_data);
        //Update stock item quantity

        $result = $this->utilities->findByAttribute('im_distribution', array('item_id' => $item_id, 'user_id' => $user_id));
        if ($result) {
//            $this->pr($result);
            $exdata['quantity'] = $this->input->post('issue_quantity') + $result->quantity;
            $this->utilities->updateData('im_distribution', $exdata, array('item_id' => $item_id));
        } else {
            $data['item_id'] = $item_id;
            $data['parent_id'] = $parent_id;
            $data['category_id'] = $this->input->post('category_id');
            $data['quantity'] = $this->input->post('issue_quantity');
            $data['cre_date'] = date('Y-m-d H:i:s');
            $data['user_id'] = $user_id;
            $this->utilities->insertData($data, 'im_distribution');
        }
        redirect("index.php/lookUp/distribution/$parent_id");
    }

    public function goodsReceive($id) {
        $this->data['title'] = "Goods Receive";
        $this->data['result'] = $this->utilities->getAllItemForGoodsReceive($id);
//      $this->pr($this->data['result']);
        $this->content = 'goodReceive/list';
        $this->layOut();
    }

    public function getGoodsReceiveForm() {
        $id = $_POST['item_id'];
        $data['result'] = $this->utilities->getAllItemDetailsById($id);
        $this->load->view('goodReceive/form', $data);
    }

    public function goodsReceiveSave() {
        $id = $this->input->post('item_id');
        $prnid = $this->input->post('parent_id');
        $data['item_quantity'] = $this->input->post('quantity') + $this->input->post('current_quantity');
        $data['upd_date'] = date('Y-m-d H:i:s');
        $this->utilities->updateData('tbl_item', $data, array('id' => $id));
        redirect("index.php/lookUp/goodsReceive/$prnid");
    }

    public function createUser() {
        if (isset($_POST['user_name'])) {
            $data['name'] = $this->input->post('user_name', TRUE);
            $pass = $this->input->post('fld_password', TRUE);
            $data['password'] = md5($pass);
            $data['fullName'] = $this->input->post('full_name', TRUE);
            $data['user_type'] = $this->input->post('fld_user_type', TRUE);
            $data['active_status'] = isset($_POST['active_status']) == 'on' ? 1 : 0;
            $this->utilities->insertData($data, 'tbl_user');
            redirect("index.php/lookUp/createUser");
        } else {
            $this->data['title'] = "User List";
            $this->data['result'] = $this->utilities->getAllUser();
//             $this->pr($this->data['result']);
            $this->content = 'user/index';
            $this->layOut();
        }
    }

    public function getUserForm() {
        $data['user_type'] = $this->utilities->dropdownFromTableWithCondition('sa_lookup_data', 'Select User', 'LOOKUP_DATA_ID', 'LOOKUP_DATA_NAME', array('LOOKUP_GRP_ID' => '50'));
        $this->load->view('user/form', $data);
    }

    public function editUser() {
        $id = $this->uri->segment(3);
        if (isset($_POST['user_name'])) {
            $idd = $this->input->post('user_id');
            $data['name'] = $this->input->post('user_name', TRUE);
            if ($_POST['fld_password']) {
                $pass = $this->input->post('fld_password', TRUE);
                $data['password'] = md5($pass);
            }
            $data['fullName'] = $this->input->post('full_name', TRUE);
            $data['user_type'] = $this->input->post('fld_user_type', TRUE);
            $data['active_status'] = isset($_POST['active_status']) == 'on' ? 1 : 0;
            $this->utilities->updateData('tbl_user', $data, array('id' => $idd));
            redirect("index.php/lookUp/createUser");
        }
        $data['row'] = $this->utilities->findByAttribute('tbl_user', array('id' => $id));
        $data['user'] = $this->utilities->dropdownFromTableWithCondition('sa_lookup_data', 'Select User', 'LOOKUP_DATA_ID', 'LOOKUP_DATA_NAME', array('LOOKUP_GRP_ID' => '50'));
        $this->load->view('user/edit', $data);
    }

    public function deleteUser() {
        $id = $_POST['itemid'];
        $this->utilities->deleteRowByAttribute('tbl_user', array('id' => $id));
    }

}

