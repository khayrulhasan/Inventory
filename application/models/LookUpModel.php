<?php

/**
 * Description of LookUpModel
 *
 * @author Khayrul Hasan
 */
class LookUpModel extends CI_Model {
    /*
     * @methodName Gell All()
     * @access
     * @param  none
     * @return  All table data   
     */

    function get_all($tableName) {
        $query_result = $this->db->get($tableName);
        return $query_result->result();
    }

    /*
     * @methodName Gell All()
     * @access
     * @param  none
     * @return  inserted Last Id // Insert data into the table   
     */

    function insert($tableName, $data) {
        $this->db->insert($tableName, $data);
        return $this->db->insert_id();
    }

    /*
     * @methodName Udate()
     * @access
     * @param  none
     * @return  // Updae   
     */

    function update($tableName, $id, $data) {
        $this->db->where('id', $id);
        return $this->db->update($tableName, $data);
    }

    function updateDistribution($tableName, $id, $data) {
        $this->db->where('item_id', $id);
        return $this->db->update($tableName, $data);
    }

    /*
     * @methodName Delete()
     * @access
     * @param  none
     * @return  // delete    
     */

    function delete($tableName, $id) {
        $this->db->where('id', $id);
        return $this->db->delete($tableName);
    }

    /*
     * @methodName Get Variant All Content()
     * @access
     * @param  none
     * @return  // delete    
     */

    function getVariantAllContentInfo($id) {
        return $this->db->query("SELECT  tbl_tree_variant.type, tbl_tree_variant.unit, tbl_tree_variant.manufacturer, tbl_tree_variant.name, tbl_tree_variant.parent_id,
        (select name from tbl_tree_variant where id = (SELECT parent_id FROM tbl_tree_variant where id={$id})) parant_name,
        tbl_tree_variant.colorpicker, tbl_tree_variant.canvas_image, tbl_gallery_group.gallery_path, tbl_tree_variant.id FROM tbl_tree_variant LEFT OUTER JOIN tbl_gallery_group ON tbl_gallery_group.gallery_id = tbl_tree_variant.id WHERE tbl_tree_variant.id={$id} ORDER BY tbl_gallery_group.id  DESC")->row();
    }

    /*
     * @methodName get all by id()
     * @access
     * @param  none
     * @return  // delete    
     */

    function get_all_by_id($tableName, $id) {
        $this->db->where('id', $id);
        $query_result = $this->db->get($tableName);
        return $query_result->result();
    }

    /*
     * @methodName get all Data by condition()
     * @access
     * @param  none
     * @return  // delete    
     */

    function get_all_by_coondition($tableName, $condition) {
        $this->db->where($condition);
        $query_result = $this->db->get($tableName);
        return $query_result->result();
    }

    function get_table_name_by_id($tableName, $id) {
        $this->db->where('id', $id);
        $query_result = $this->db->get($tableName);
        return $query_result->row();
    }

    function get_all_by_attr() {
        return $this->db->query("SELECT a.*, b.LOOKUP_DATA_NAME unit_name FROM sa_item a LEFT JOIN sa_lookup_data b ON a.fld_unit = b.LOOKUP_DATA_ID")->result();
    }

    public function getLookupData($LOOKUP_DATA_ID) {

        return $this->db->query("select sa_lookup_data.*, grp.USE_CHAR_NUMB as USE_CHAR_NUMB  from sa_lookup_data 
                                 left join sa_lookup_grp as grp on grp.LOOKUP_GRP_ID = sa_lookup_data.LOOKUP_GRP_ID
                                 where LOOKUP_DATA_ID=$LOOKUP_DATA_ID")->row();
    }

    public function get_all_item() {
        return $this->db->query("SELECT a.*, b.LOOKUP_DATA_NAME unit_name FROM sa_item a LEFT JOIN sa_lookup_data b ON a.fld_unit = b.LOOKUP_DATA_ID")->result();
    }

    public function getAllItemByMainMenu($id) {
        return $this->db->query("SELECT a.*, (SELECT LOOKUP_DATA_NAME FROM sa_lookup_data b WHERE a.fld_unit = b.LOOKUP_DATA_ID) AS unit_name FROM sa_item a WHERE a.parent_id = {$id}")->result();
    }

    public function getAllItemByUser($id) {
        return $this->db->query("SELECT a.* , b.fld_item_name, (SELECT c.LOOKUP_DATA_NAME FROM sa_lookup_data c WHERE c.LOOKUP_DATA_ID = b.fld_unit) AS unit, (SELECT d.name FROM tbl_tree_variant d WHERE d.id = a.parent_id) AS parenName , (SELECT d.name FROM tbl_tree_variant d WHERE d.id = a.category_id) AS categoryName  FROM im_distribution a LEFT JOIN sa_item b ON b.fld_id = a.item_id WHERE a.user_id = {$id}")->result();
    }

    public function getAllConsumerByUser($id) {
        return $this->db->query("SELECT a.*,  (SELECT c.fld_item_name FROM sa_item c WHERE c.fld_id = a.item_id) AS itemName, (SELECT d.LOOKUP_DATA_NAME FROM sa_lookup_data d WHERE d.LOOKUP_DATA_ID = b.fld_unit)AS unit  FROM im_consume a LEFT JOIN sa_item b ON b.fld_id = a.item_id WHERE a.user_id = {$id}")->result();
    }

    public function getAllItemList() {
        return $this->db->query("SELECT a.*, (SELECT b.LOOKUP_DATA_NAME FROM sa_lookup_data b WHERE b.LOOKUP_DATA_ID = a.fld_unit) AS unit, (SELECT c.LOOKUP_DATA_NAME FROM sa_lookup_data c WHERE c.LOOKUP_DATA_ID = a.fld_type) AS type FROM sa_item a")->result();
    }

    public function getAllGoodsReceivedList() {
        return $this->db->query("SELECT a.*, b.fld_item_name, b.fld_ledger_page, (SELECT d.name FROM tbl_tree_variant d WHERE d.id = a.fld_parent_id) AS parent,(SELECT d.name FROM tbl_tree_variant d WHERE d.id = a.fld_category_id) AS category, (SELECT c.LOOKUP_DATA_NAME FROM sa_lookup_data c WHERE c.LOOKUP_DATA_ID = b.fld_unit) AS unit, (SELECT c.LOOKUP_DATA_NAME FROM sa_lookup_data c WHERE c.LOOKUP_DATA_ID = b.fld_type) AS fld_type FROM im_stock a LEFT JOIN sa_item b ON b.fld_id = a.fld_item_id")->result();
    }

    public function getAllStockedList() {
        return $this->db->query("SELECT a.*, b.fld_item_name, b.fld_ledger_page, (SELECT d.name FROM tbl_tree_variant d WHERE d.id = a.fld_parent_id) AS parent,(SELECT d.name FROM tbl_tree_variant d WHERE d.id = a.fld_category_id) AS category, (SELECT c.LOOKUP_DATA_NAME FROM sa_lookup_data c WHERE c.LOOKUP_DATA_ID = b.fld_unit) AS unit, (SELECT c.LOOKUP_DATA_NAME FROM sa_lookup_data c WHERE c.LOOKUP_DATA_ID = b.fld_type) AS fld_type FROM im_stock a LEFT JOIN sa_item b ON b.fld_id = a.fld_item_id")->result();
    }

//    public function getAllGoodsReceivedListById($p,$cat,$id) {
//        return $this->db->query("SELECT a.*, SUM(a.fld_quantity) AS quantity, b.fld_item_name, b.fld_ledger_page, (SELECT d.name FROM tbl_tree_variant d WHERE d.id = a.fld_parent_id) AS parent,(SELECT d.name FROM tbl_tree_variant d WHERE d.id = a.fld_category_id) AS category, (SELECT c.LOOKUP_DATA_NAME FROM sa_lookup_data c WHERE c.LOOKUP_DATA_ID = b.fld_unit) AS unit FROM im_stock a LEFT JOIN sa_item b ON b.fld_id = a.fld_item_id WHERE a.fld_item_id = {$id} AND a.fld_parent_id = {$p} AND a.fld_category_id = {$cat} GROUP BY a.fld_item_id")->row();
//    }
    public function getAllGoodsReceivedListById($id) {
        return $this->db->query("SELECT a.*, b.fld_item_name, b.fld_ledger_page, (SELECT d.name FROM tbl_tree_variant d WHERE d.id = a.fld_parent_id) AS parent,(SELECT d.name FROM tbl_tree_variant d WHERE d.id = a.fld_category_id) AS category, (SELECT c.LOOKUP_DATA_NAME FROM sa_lookup_data c WHERE c.LOOKUP_DATA_ID = b.fld_unit) AS unit FROM im_stock a LEFT JOIN sa_item b ON b.fld_id = a.fld_item_id WHERE a.fld_id = {$id}")->row();
    }

    public function getAllGoodsReceivedListByDate($min, $max) {
        return $this->db->query("SELECT a.*, b.fld_item_name, b.fld_ledger_page, (SELECT d.name FROM tbl_tree_variant d WHERE d.id = a.fld_parent_id) AS parent,(SELECT d.name FROM tbl_tree_variant d WHERE d.id = a.fld_category_id) AS category, (SELECT c.LOOKUP_DATA_NAME FROM sa_lookup_data c WHERE c.LOOKUP_DATA_ID = b.fld_unit) AS unit FROM im_stock a LEFT JOIN sa_item b ON b.fld_id = a.fld_item_id WHERE a.fld_last_receive_date BETWEEN '$min' AND '$max'")->result();
    }

    public function getItemListByCategory($id) {
        return $this->db->query("SELECT a.*, b.fld_item_name, b.fld_ledger_page, (SELECT d.name FROM tbl_tree_variant d WHERE d.id = a.fld_parent_id) AS parent,(SELECT d.name FROM tbl_tree_variant d WHERE d.id = a.fld_category_id) AS category, (SELECT c.LOOKUP_DATA_NAME FROM sa_lookup_data c WHERE c.LOOKUP_DATA_ID = b.fld_unit) AS unit FROM im_stock a LEFT JOIN sa_item b ON b.fld_id = a.fld_item_id WHERE a.fld_parent_id = {$id}")->result();
    }

    public function getItemListBySubCategorySelect($categoryId) {
        return $this->db->query("SELECT b.fld_id, b.fld_item_name FROM im_stock a LEFT JOIN sa_item b ON b.fld_id = a.fld_item_id WHERE  a.fld_category_id = {$categoryId}")->result();
    }

    public function getItemListBySubCategory($ca, $su) {
        return $this->db->query("SELECT a.*, b.fld_item_name, b.fld_ledger_page, (SELECT d.name FROM tbl_tree_variant d WHERE d.id = a.fld_parent_id) AS parent,(SELECT d.name FROM tbl_tree_variant d WHERE d.id = a.fld_category_id) AS category, (SELECT c.LOOKUP_DATA_NAME FROM sa_lookup_data c WHERE c.LOOKUP_DATA_ID = b.fld_unit) AS unit FROM im_stock a LEFT JOIN sa_item b ON b.fld_id = a.fld_item_id WHERE a.fld_parent_id = {$ca} AND a.fld_category_id = {$su}")->result();
    }

    public function getItemListByItem($ca, $su, $it) {

        return $this->db->query("SELECT a.*, b.fld_item_name, b.fld_ledger_page, (SELECT d.name FROM tbl_tree_variant d WHERE d.id = a.fld_parent_id) AS parent,(SELECT d.name FROM tbl_tree_variant d WHERE d.id = a.fld_category_id) AS category, (SELECT c.LOOKUP_DATA_NAME FROM sa_lookup_data c WHERE c.LOOKUP_DATA_ID = b.fld_unit) AS unit FROM im_stock a LEFT JOIN sa_item b ON b.fld_id = a.fld_item_id WHERE a.fld_parent_id = {$ca} AND a.fld_category_id = {$su} AND a.fld_item_id = {$it}")->result();
    }

    public function getItemListByCatAndItem($ca, $it) {

        return $this->db->query("SELECT a.*, b.fld_item_name, b.fld_ledger_page, (SELECT d.name FROM tbl_tree_variant d WHERE d.id = a.fld_parent_id) AS parent,(SELECT d.name FROM tbl_tree_variant d WHERE d.id = a.fld_category_id) AS category, (SELECT c.LOOKUP_DATA_NAME FROM sa_lookup_data c WHERE c.LOOKUP_DATA_ID = b.fld_unit) AS unit FROM im_stock a LEFT JOIN sa_item b ON b.fld_id = a.fld_item_id WHERE a.fld_parent_id = {$ca} AND a.fld_item_id = {$it}")->result();
    }

    public function getItemListByOnleyItem($it) {

        return $this->db->query("SELECT a.*, b.fld_item_name, b.fld_ledger_page, (SELECT d.name FROM tbl_tree_variant d WHERE d.id = a.fld_parent_id) AS parent,(SELECT d.name FROM tbl_tree_variant d WHERE d.id = a.fld_category_id) AS category, (SELECT c.LOOKUP_DATA_NAME FROM sa_lookup_data c WHERE c.LOOKUP_DATA_ID = b.fld_unit) AS unit FROM im_stock a LEFT JOIN sa_item b ON b.fld_id = a.fld_item_id WHERE a.fld_item_id = {$it}")->result();
    }

    //------------------------------------
    public function getAllDistributedList() {
        return $this->db->query("SELECT a.*, b.fld_item_name, (SELECT d.name FROM tbl_tree_variant d WHERE d.id = a.fld_parent_id) AS parent,(SELECT d.name FROM tbl_tree_variant d WHERE d.id = a.fld_category_id) AS category, (SELECT c.LOOKUP_DATA_NAME FROM sa_lookup_data c WHERE c.LOOKUP_DATA_ID = b.fld_unit) AS unit FROM im_stock a LEFT JOIN sa_item b ON b.fld_id = a.fld_item_id")->result();
    }

    public function getGoodsReceivedListById($id) {
        return $this->db->query("SELECT a.*, b.fld_item_name, (SELECT d.name FROM tbl_tree_variant d WHERE d.id = a.fld_parent_id) AS parent,(SELECT d.name FROM tbl_tree_variant d WHERE d.id = a.fld_category_id) AS category, (SELECT c.LOOKUP_DATA_NAME FROM sa_lookup_data c WHERE c.LOOKUP_DATA_ID = b.fld_unit) AS unit FROM im_stock a LEFT JOIN sa_item b ON b.fld_id = a.fld_item_id WHERE a.fld_id = {$id}")->row();
    }

    // Summmary Page
    public function getAllTotalStock() {
        return $this->db->query("SELECT a.*, SUM(a.quantity) AS totalQuantity FROM im_distribution a WHERE a.user_id = {$this->user_session['user_status']}")->result();
    }

    public function getAllTotalGiven() {
        return $this->db->query("SELECT a.*, SUM(a.quantity) AS totalQuantity FROM im_consume a WHERE a.user_id = {$this->user_session['user_status']}")->result();
    }

    public function getAllTotalConsume() {
        return $this->db->query("SELECT a.*,SUM(a.quantity) AS totalQuantity FROM im_distribution a INNER JOIN sa_item b ON (a.item_id = b.fld_id AND b.fld_type = 215) WHERE a.user_id = {$this->user_session['user_status']}")->result();
    }

    public function getAllTotalInconsume() {
        return $this->db->query("SELECT a.*,SUM(a.quantity) AS totalQuantity FROM im_distribution a INNER JOIN sa_item b ON (a.item_id = b.fld_id AND b.fld_type = 216) WHERE a.user_id = {$this->user_session['user_status']}")->result();
    }

    public function getALLItemData() {
        $result = $this->db->query("SELECT  SUM(a.quantity) AS value, b.name AS label FROM im_distribution a INNER JOIN tbl_tree_variant b ON a.category_id = b.id WHERE a.user_id = {$this->user_session['user_status']} GROUP BY a.category_id")->result_array();
        return $result = json_encode($result);
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

    public function getALLItemDataForAreaChart() {
        // $result = $this->db->query("SELECT a.quantity AS value, b.fld_item_name AS label FROM im_distribution a INNER JOIN sa_item b ON a.item_id = b.fld_id WHERE a.user_id = {$this->user_session['user_status']} LIMIT 10")->result_array();
        $consume = $this->db->query("SELECT a.quantity AS totalQuantity FROM im_distribution a INNER JOIN sa_item b ON (a.item_id = b.fld_id AND b.fld_type = 215) WHERE a.user_id = {$this->user_session['user_status']}")->result();
        $inconsume = $this->db->query("SELECT a.quantity AS totalQuantity FROM im_distribution a INNER JOIN sa_item b ON (a.item_id = b.fld_id AND b.fld_type = 216) WHERE a.user_id = {$this->user_session['user_status']}")->result_array();
        $color = array("#f56954", "#00a65a", "#f39c12", "#00c0ef", "#3c8dbc", "#d2d6de", "#307D7E", "#FFFF00", "#800080", "#0000A0");

        return json_encode($inconsume);

        //return $result = json_encode($result);
    }

    public function getItemWithImageInfoById($id) {
        return $this->db->query("SELECT a.*, b.image_path FROM sa_item a LEFT JOIN im_item_gallery b ON a.fld_id = b.item_id WHERE a.fld_id = {$id}")->row();
    }
    
    public function getAllItemWithImageInfo() {
        return $this->db->query("SELECT a.fld_id, a.fld_item_name, b.image_path FROM sa_item a LEFT JOIN im_item_gallery b ON a.fld_id = b.item_id")->result();
    }

}

