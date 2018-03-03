<?php
function IsbnConsistencyCheck($isbn){
    if(preg_match('|^978[0-9]{10}$|', $isbn)){
        $isbn_arr = str_split($isbn);
        $odd = 0;
        $mod = 0;
        
        for($i=0;$i<(count($isbn_arr)-1);$i++){
            if($i % 2 == 0) $mod += (int)$isbn_arr[$i];
            else $odd += (int)$isbn_arr[$i];
        }
        
        $odd *= 3;
        
        $check_digit = 10 - (($mod + $odd) % 10);
        
        if(substr($isbn, -1) == $check_digit) return false;
        else return true;
    }else{
        return true;
    }
}
?>