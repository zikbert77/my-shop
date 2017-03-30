<?php

class Cart {
    
    public static function getTotalPrice(){
        
        $total = array();
        
        if(isset($_SESSION['products'])){
            
            foreach($_SESSION['products'] as $product){
                $count = $product['count'] * $product['price'];
                array_push($total, $count);
            }
            
            return array_sum($total);
        }
        
        return 0;
    }
    
    public static function getTotalCount(){
        
        if(isset($_SESSION['products'])){

            return count($_SESSION['products']);
        }
        
        return 0;
    }
    
    public static function deleteProduct($id){
        
        if(isset($_SESSION['products'])){
            $id = intval($id);
            
            if(array_key_exists($id, $_SESSION['products'])){
                unset($_SESSION['products'][$id]);
                
                return true;
            }
            return false;
        }
        
    }
    
    public static function checkProduct($id){
        
        if(isset($_SESSION['products'])){
            $id = intval($id);
            
            if(array_key_exists($id, $_SESSION['products'])){             
                return true;
            }
            return false;
        }
        
    }
    
    public static function sortAreas($areasAll){
        
        $areas = array();
        foreach($areasAll->item as $area){            
           array_push($areas, $area);
        }
        
        return $areas;
    }
    
    public static function sortCities($citiesAll, $areaRef=false){
        
        $cities = array();
        $i = 0;
        
        foreach($citiesAll->item as $city){
           $descr   = array( (string) $city->Description);
           $descrRu = array( (string) $city->DescriptionRu);
           $ref     = array( (string) $city->Ref);
           $area    = array( (string) $city->Area);
           $CityID  = array( (string) $city->CityID);
           
           $cities[$i]['Description'] = $descr[0];
           $cities[$i]['DescriptionRu'] = $descrRu[0];
           $cities[$i]['CityRef'] = $ref[0];
           $cities[$i]['CityArea'] = $area[0];
           $cities[$i]['CityID'] = $CityID[0];
           $i++; 
        }
        
        if($areaRef){
           $areaRef = trim(htmlspecialchars(stripslashes($areaRef)));
           $citiesInArea = array(); 
           
           foreach($cities as $city){
               if($city['CityArea'] == $areaRef){
                   array_push($citiesInArea, $city);
               }
           }
           
           return($citiesInArea);
        }
        
        return $cities;
    }
    
    public static function sortWarehouse($warehouseAll){
        $sorted = array();
        
        $i = 0;
        
        foreach($warehouseAll->item as $item){
           $descr   = array( (string) $item->Description);
           $descrRu = array( (string) $item->DescriptionRu);
           $ref     = array( (string) $item->Ref);
           
           $sorted[$i]['Description'] = $descr[0];
           $sorted[$i]['DescriptionRu'] = $descrRu[0];
           $sorted[$i]['Ref'] = $ref[0];
           $i++; 
        }
        
        return $sorted;
    }
    
    public static function createOrder($user_id, $order){
        
        $order = json_encode($order);
        
        $db = Db::getConnection();
        
        $sql = "INSERT INTO orders(u_id, order_info, order_date) VALUES('$user_id', '$order', NOW())";
        $result = $db->query($sql) or die('Error');
        
        return true;
    }
    
}