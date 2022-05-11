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

    // fetch product data using getDataTopSale Method
    public function getDataTopSale(){
        $result = $this->db->con->query("SELECT * FROM product WHERE item_destination = 'top-sale'");

        $resultArray = array();

        // fetch product data one by one
        while ($item = mysqli_fetch_array($result, MYSQLI_ASSOC)){
            $resultArray[] = $item;
        }

        return $resultArray;
    }

    // fetch product data using getDataSpecialPrice Method
    public function getDataSpecialPrice(){
        $result = $this->db->con->query("SELECT * FROM product WHERE item_destination = 'special-price'");

        $resultArray = array();

        // fetch product data one by one
        while ($item = mysqli_fetch_array($result, MYSQLI_ASSOC)){
            $resultArray[] = $item;
        }

        return $resultArray;
    }

    // fetch product data using getDataNewPhones Method
    public function getDataNewPhones(){
        $result = $this->db->con->query("SELECT * FROM product WHERE item_destination = 'new-phone'");

        $resultArray = array();

        // fetch product data one by one
        while ($item = mysqli_fetch_array($result, MYSQLI_ASSOC)){
            $resultArray[] = $item;
        }

        return $resultArray;
    }
}

?>