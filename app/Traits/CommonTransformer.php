<?php

namespace App\Traits;

trait CommonTransformer
{
    public function transfromAddressFormat1($address = []){
        if(!$address || !is_array($address)){
            return '';
        }
        $addressString = '';
        if($address['first_name']){
            $addressString .= $address['first_name'].' '.$address['last_name'];
        }
        if($address['address1']){
            if($addressString){
                $addressString .= ', '.$address['address1'];
            }else{
                $addressString .= $address['address1'];
            }
        }
        if($address['address2']){
            if($addressString){
                $addressString .= ', '.$address['address2'];
            }else{
                $addressString .= $address['address2'];
            }
        }
        if($address['city']){
            if($addressString){
                $addressString .= ', '.$address['city'];
            }else{
                $addressString .= $address['city'];
            }
        }
        if($address['province']){
            if($addressString){
                $addressString .= ', '.$address['province'];
            }else{
                $addressString .= $address['province'];
            }
        }
        if($address['zip']){
            if($addressString){
                $addressString .= ', '.$address['zip'];
            }else{
                $addressString .= $address['zip'];
            }
        }
        if($address['country']){
            if($addressString){
                $addressString .= ', '.$address['country'];
            }else{
                $addressString .= $address['country'];
            }
        }
        return $addressString;
    }
}