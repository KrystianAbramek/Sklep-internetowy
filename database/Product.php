<?php

// Use to fetch product data
class Product
{
    public $db = null;

    public function __construct(DBController $db)
    {
        if (!isset($db->con)) return null;
        $this->db = $db;
    }

    private function getDataByItemDestination($destination_name){

        if($destination_name == null)
            return [];

        $result = $this->db->con->query("SELECT * FROM product WHERE item_destination = '{$destination_name}'");

        $resultArray = array();

        // fetch product data one by one
        while ($item = mysqli_fetch_array($result, MYSQLI_ASSOC)){
            $resultArray[] = $item;
        }

        return $resultArray;
    }

    // fetch product data using getDataTopSale Method
    public function getDataTopSale(){
        return $this -> getDataByItemDestination('top-sale');
    }

    // fetch product data using getDataSpecialPrice Method
    public function getDataSpecialPrice(){
        return $this -> getDataByItemDestination('special-price');
    }

    // fetch product data using getDataNewPhones Method
    public function getDataNewPhones(){
        return $this -> getDataByItemDestination('new-phone');
    }

    // get product using item id
    public function getProduct($item_id = null, $table= 'product'){
        if (isset($item_id)){
            $result = $this->db->con->query("SELECT * FROM {$table} WHERE item_id={$item_id}");

            $resultArray = array();

            // fetch product data one by one
            while ($item = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                $resultArray[] = $item;
            }

            return $resultArray;
        }
    }

}
