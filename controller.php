<?php
/**
 * Created by PhpStorm.
 * User: mak
 * Date: 12/04/2016
 * Time: 18:07
 */
function user_connected(){
    if ( isset( $_SESSION ) && !empty( $_SESSION ) ) {
        return $result=true;
    } else{
        return $result=false;
    }
}