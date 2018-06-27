<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class ReportsModel extends CI_Model {

    public function getAllGoodsList() {
        return $this->db->query("SELECT DISTINCT a.fld_category_id, (SELECT b.name FROM tbl_tree_variant b WHERE b.id = a.fld_parent_id) AS parent, (SELECT b.name FROM tbl_tree_variant b WHERE b.id = a.fld_category_id) AS category FROM im_stock a ORDER BY a.fld_parent_id")->result();
    }

    public function getAllItemListC() {
        return $this->db->query("SELECT a.*, (SELECT b.LOOKUP_DATA_NAME FROM sa_lookup_data b WHERE b.LOOKUP_DATA_ID = a.fld_unit) AS unit, (SELECT c.LOOKUP_DATA_NAME FROM sa_lookup_data c WHERE c.LOOKUP_DATA_ID = a.fld_type) AS type FROM sa_item a WHERE a.fld_type = 215")->result();
    }

    public function getAllItemListI() {
        return $this->db->query("SELECT a.*, (SELECT b.LOOKUP_DATA_NAME FROM sa_lookup_data b WHERE b.LOOKUP_DATA_ID = a.fld_unit) AS unit, (SELECT c.LOOKUP_DATA_NAME FROM sa_lookup_data c WHERE c.LOOKUP_DATA_ID = a.fld_type) AS type FROM sa_item a WHERE a.fld_type = 216")->result();
    }

    public function getAllStockList() {
        return $this->db->query("SELECT DISTINCT a.fld_category_id, (SELECT b.name FROM tbl_tree_variant b WHERE b.id = a.fld_parent_id) AS parent, (SELECT b.name FROM tbl_tree_variant b WHERE b.id = a.fld_category_id) AS category FROM im_stock a ORDER BY a.fld_parent_id")->result();
    }
    
    public function getAllIssuedList() {
        return $this->db->query("SELECT DISTINCT a.fld_category_id, (SELECT b.name FROM tbl_tree_variant b WHERE b.id = a.fld_parent_id) AS parent, (SELECT b.name FROM tbl_tree_variant b WHERE b.id = a.fld_category_id) AS category FROM im_stock a ORDER BY a.fld_parent_id")->result();
    }

    public function getAllDistributedList($id) {
        return $this->db->query("SELECT DISTINCT a.category_id, (SELECT c.name FROM tbl_tree_variant c WHERE c.id = a.parent_id) AS parentName, (SELECT c.name FROM tbl_tree_variant c WHERE c.id = a.category_id) AS categoryName  FROM im_distribution a WHERE a.user_id = {$id} ORDER BY a.parent_id")->result();
    }

    public function getAllConsumerByUser($id) {
        return $this->db->query("SELECT DISTINCT a.category_id, (SELECT c.name FROM tbl_tree_variant c WHERE c.id = a.parent_id) AS parentName, (SELECT c.name FROM tbl_tree_variant c WHERE c.id = a.category_id) AS categoryName  FROM im_consume a WHERE a.user_id = {$id} ORDER BY a.parent_id")->result();
    }

//    public function getAllCategoryList($cat) {
//        return $this->db->query("SELECT DISTINCT a.fld_category_id, (SELECT b.name FROM tbl_tree_variant b WHERE b.id = a.fld_parent_id) AS parent, (SELECT b.name FROM tbl_tree_variant b WHERE b.id = a.fld_category_id) AS category FROM im_stock a WHERE a.fld_parent_id = {$cat} ORDER BY a.fld_parent_id")->result();
//    }
//
//    public function getAllCategoryAndSubcategoryList($ca, $su) {
//        return $this->db->query("SELECT DISTINCT a.fld_category_id, (SELECT b.name FROM tbl_tree_variant b WHERE b.id = a.fld_parent_id) AS parent, (SELECT b.name FROM tbl_tree_variant b WHERE b.id = a.fld_category_id) AS category FROM im_stock a WHERE a.fld_parent_id = {$ca} AND a.fld_category_id = {$su} ORDER BY a.fld_parent_id")->result();
//    }
//
//    public function getAllCategoryAndSubcategoryAndItemList($ca, $su, $it) {
//        return $this->db->query("SELECT a.fld_item_id, (SELECT b.name FROM tbl_tree_variant b WHERE b.id = a.fld_parent_id) AS parent, (SELECT b.name FROM tbl_tree_variant b WHERE b.id = a.fld_category_id) AS category FROM im_stock a WHERE a.fld_parent_id = {$ca} AND a.fld_category_id = {$su} AND a.fld_item_id = {$it} ORDER BY a.fld_parent_id")->result();
//    }
//
//    public function getAllCategoryAndItemList($ca, $id) {
//        return $this->db->query("SELECT a.fld_item_id, (SELECT b.name FROM tbl_tree_variant b WHERE b.id = a.fld_parent_id) AS parent, (SELECT b.name FROM tbl_tree_variant b WHERE b.id = a.fld_category_id) AS category FROM im_stock a WHERE a.fld_parent_id = {$ca} AND a.fld_category_id = {$su} AND a.fld_item_id = {$it} ORDER BY a.fld_parent_id")->result();
//    }
    
    
    public function getCategoryByCategory($cat){
        
        return $this->db->query("SELECT DISTINCT a.fld_parent_id, a.fld_category_id, (SELECT b.name FROM tbl_tree_variant b WHERE b.id = a.fld_parent_id) cat_name FROM im_stock a WHERE a.fld_parent_id = $cat")->result();
        
    }
    
    public function getCategoryByCategoryAndSubCategory($cat, $sub){
        
        return $this->db->query("SELECT DISTINCT a.fld_parent_id, a.fld_category_id, (SELECT b.name FROM tbl_tree_variant b WHERE b.id = a.fld_parent_id) cat_name FROM im_stock a WHERE a.fld_parent_id = $cat AND a.fld_category_id = $sub")->result();
        
    }
    
    public function getCategoryByCategoryAndSubCategoryAndItem($cat,$sub,$item){
        
        return $this->db->query("SELECT DISTINCT a.fld_parent_id, a.fld_category_id, (SELECT b.name FROM tbl_tree_variant b WHERE b.id = a.fld_parent_id) cat_name FROM im_stock a WHERE a.fld_parent_id = $cat AND a.fld_category_id = $sub AND a.fld_item_id = $item")->result();
    
    }
    
    public function getCategoryByCategoryAndItem($cat, $item){
        
        return $this->db->query("SELECT DISTINCT a.fld_parent_id, a.fld_category_id, (SELECT b.name FROM tbl_tree_variant b WHERE b.id = a.fld_parent_id) cat_name FROM im_stock a WHERE a.fld_parent_id = $cat AND a.fld_item_id = $item")->result();
    }
    
    public function getCategoryByItem($item){
        
        return $this->db->query("SELECT DISTINCT a.fld_parent_id, a.fld_category_id, (SELECT b.name FROM tbl_tree_variant b WHERE b.id = a.fld_parent_id) cat_name FROM im_stock a WHERE  a.fld_item_id = $item")->result();
        
    }
    
    public function getCategoryAll(){
        
        return $this->db->query("SELECT DISTINCT a.fld_parent_id, a.fld_category_id, (SELECT b.name FROM tbl_tree_variant b WHERE b.id = a.fld_parent_id) cat_name FROM im_stock a")->result();
        
    }


    public function getSubCategoryName($sub){
        
        return $this->db->query("SELECT DISTINCT a.fld_category_id, a.fld_item_id, (SELECT b.name FROM tbl_tree_variant b WHERE b.id = a.fld_category_id) subCategoryName FROM im_stock a WHERE a.fld_category_id = $sub")->result();
        
    }
    
    public function getItemName($id){
        return $this->db->query("SELECT b.* FROM im_stock a LEFT JOIN sa_item b ON b.fld_id = a.fld_item_id WHERE a.fld_item_id = $id")->result();
    }
    
}