<?php
require_once "const.php";


function long_chaine($chaine){
    $cmpt = 0;
    
    while (isset($chaine[$cmpt])) {
        $cmpt ++;
    }
    return $cmpt;

}

function supp_spc_avant_apres($chaine){
    $debut=0;
    $fin=long_chaine($chaine)-1;
    $newChaine = '';
    if($chaine==''){ 
        return $chaine; 
    }
    while ($chaine[$debut]==' '){
        $debut++; 
        if(!isset($chaine[$debut])){
            return '';
        } }
    while ($chaine[$fin]==' '){ 
        $fin--; 
    }
    while ($debut<=$fin){ 
        $newChaine.=$chaine[$debut++]; 
    }
    return $newChaine;
}

function is_empty($chaine){
    return supp_spc_avant_apres($chaine)=='';
}

//fonction qui permet de tester si un caractere est alphabetique

function is_car_alpha($car){
    if( long_chaine($car)==1 && ($car >='a' && $car <='z') || ($car>='A' && $car<='Z')){
        return true;
    }
    return false;
}

//Si le caractere saisi est un chiffre ou non 
function is_car_numeric($car){

    if ($car >= '0' &&  $car <= '9'){
       return true;
   }
   return false;

}

function print_error($tab){
    $chaine = "";
    foreach ($tab as $t){
        $chaine .= $t." - ";
    }
    return $chaine;
}

function is_chaine_alpha($chaine){
    for ($i=0;$i<long_chaine($chaine);$i++){
        if (!is_car_alpha($chaine[$i])){
            return false;
        }
    }
    return true;
}
function is_chaine_numeric($chaine){
    for ($i=0;$i<long_chaine($chaine);$i++){
        if (!is_car_numeric($chaine[$i])){
            return false;
        }
    }
    return true;
}

function invers_car_case($car){
    $min = 'a';
    $max = 'A';
    if(long_chaine($car)==1){
       for ($i=0; $i < 26; $i++) { 
           if ($car==$min) {
               return $max;
           }elseif ($car==$max) {
               return $min;
           }
           $min++;
           $max++;
       }
    }
    return $car;
}

function is_car_present_in_chaine($car,$chaine){
    for ($i=0;$i<long_chaine($chaine);$i++){
        if ($chaine[$i] == $car || $chaine[$i] == invers_car_case($car)){
            return true;
        }
    }
    return false;
}

function is_phrase($chaine){
    if(preg_match('/^[A-Z]/',$chaine) && preg_match('/[.!?]$/',$chaine)){
      return true;
    }
  return false;
}
