<?php


namespace Src\Views\Blog\IT;


class AlvasarCode
{
    static function calcCode(string $birthday, string $full_name):string
    {
        $full_name = mb_strtoupper(str_replace(" ", "", $full_name));

        $birthday_rev = $birthday.strrev($birthday);

        $birthday_chars = str_split($birthday_rev);

        $birthday_associative_chars = array();

        $full_name_chars = mb_str_split($full_name);

        $replaces = array(
            "А" => 1, "Б" => 2, "В" => 3, "Г" => 4, "Д" => 5, "Е" => 6, "Ё" => 7, "Ж" => 8, "З" => 9,
            "И" => 1, "Й" => 2, "К" => 3, "Л" => 4, "М" => 5, "Н" => 6, "О" => 7, "П" => 8, "Р" => 9,
            "С" => 1, "Т" => 2, "У" => 3, "Ф" => 4, "Х" => 5, "Ц" => 6, "Ч" => 7, "Ш" => 8, "Щ" => 9,
            "Ъ" => 1, "Ы" => 2, "Ь" => 3, "Э" => 4, "Ю" => 5, "Я" => 6,
        );

        $counter = 0;
        $stop_count = false;
        foreach($full_name_chars as $char){

            if(!$stop_count){
                $birthday_associative_chars[$counter][] = $birthday_chars[$counter];
            }

            $birthday_associative_chars[$counter][] = $replaces[$char];
            $counter++;

            if($counter > count($birthday_chars)-1){
                $stop_count = true;
                $counter = 0;
            }
        }

        $birthday_associative_folded = array();

        foreach ($birthday_associative_chars as $num => $numbers){
            $num_summ = 0;
            foreach ($numbers as $number){
                $num_summ+=$number;
            }
            $birthday_associative_folded[$num] = self::foldSum($num_summ);
        }

        $sum_couples_in_str = self::sumCouples($birthday_associative_folded, array());

        $sum_couples_arr = array();

        $couples_counter = 0;
        foreach ($sum_couples_in_str as $couples_arr){
            $sum_numbers = 0;

            foreach ($couples_arr as $key => $number){
                $sum_numbers += $number;
            }

            $sum_couples_arr[$couples_counter] = $sum_numbers;
            $couples_counter++;
        }

        $final_arr = array();

        for ($i =0; $i <= count($sum_couples_arr)-1; $i = $i+2){
            $final_arr[] = self::foldSum($sum_couples_arr[$i] + $sum_couples_arr[$i+1], false);
        }

        $final_code_str = null;

        foreach ($final_arr as $key => $number){
            $final_code_str.= $number;
        }

        return $final_code_str;
    }

    static function foldSum(int $sum, bool $zero_flag = true):int
    {
        if($sum == 10){
            if($zero_flag){
                return 0;
            }else{
                return 1;
            }
        }
        $sum_str = strval($sum);
        if(strlen($sum_str) > 1){
            $sum_split_sum = 0;
            $sum_split = mb_str_split($sum_str);

            foreach ($sum_split as $key => $number){
                $sum_split_sum += intval($number);
            }

            $return_sum = self::foldSum($sum_split_sum, $zero_flag);

            return $return_sum;
        }
        return $sum;
    }

    static function sumCouples(array $birthday_associative_folded, array $couples_arr):array
    {
        $couples_arr[] = $birthday_associative_folded;

        if(count($birthday_associative_folded) > 1){
            $sum_couples = array();
            for ($num = 0; $num <= count($birthday_associative_folded) - 2; $num++){
                $sum_couples[] = self::foldSum($birthday_associative_folded[$num] + $birthday_associative_folded[$num+1]);
            }

            $result_arr = self::sumCouples($sum_couples, $couples_arr);

            return $result_arr;
        }

        return $couples_arr;
    }
}