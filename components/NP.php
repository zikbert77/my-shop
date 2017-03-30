<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of NP
 *
 * @author zikbe
 */
class NP {
    
        /* Город отправителя */
	 public static $out_city='Луцьк';
 	/* Отправитель */	 
	 public static $out_company='Brand city';
 	/* Склад */	 
	 public static $out_warehouse='1';	 
 	/* Представитель отправителя */	 
	 public static $out_name='Бондарук Богдан Вікторович';	 
 	/* Телефон отправителя */	 
	 public static $out_phone='0993086345';	 
 	/* API ключ */	 
	 public static $api_key='01c23ee0029991fd5691b0088c89988c';	 
 	/* Описание посылки */	 
	 public static $description='Одяг';
 	/* Описание упаковки */	 
	 public static $pack='Коробка';	
    
    public static function send($xml){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://api.novaposhta.ua/v2.0/xml/');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, Array("Content-Type: text/xml"));
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $xml);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        $response = curl_exec($ch);
        curl_close($ch);
        
        return $response;
    }
	
	 /**
	  * Запрос на получение списка населённых пунктов, в которых есть склады Новой почты
	  */	
	public static function getAreas(){
		$xml='<!--?xml version="1.0" encoding="utf-8"?-->
		<file>
		<apiKey>'.NP::$api_key.'</apiKey>
                <modelName>Address</modelName>
                <calledMethod>getAreas</calledMethod>
		</file>';
		
		$xml = simplexml_load_string(NP::send($xml));
		return($xml);
	}
        
        public static function getCity(){
            
		$xml='<?xml version="1.0" encoding="utf-8"?>
                        <file>
                            <apiKey>'.NP::$api_key.'</apiKey>
                            <modelName>Address</modelName>
                            <calledMethod>getCities</calledMethod>
                            <methodProperties>
                            <Area>71508129-9b87-11de-822f-000c2965ae0e</Area>
                            </methodProperties>
                        </file>';
		
		$xml = simplexml_load_string(NP::send($xml));
		return($xml);
	}
        
        public static function getWarehouse($cityRef=false){
            
            if($cityRef){
		$xml='<?xml version="1.0" encoding="utf-8"?>
                        <root>
                        <modelName>AddressGeneral</modelName>
                        <calledMethod>getWarehouses</calledMethod>
                        <methodProperties>
                                <CityRef>'.$cityRef.'</CityRef>
                        </methodProperties>
                <apiKey>'.NP::$api_key.'</apiKey>
                        </root>';
		
		$xml = simplexml_load_string(NP::send($xml));
		return($xml);
            } 
            return false;
	}
    
}
