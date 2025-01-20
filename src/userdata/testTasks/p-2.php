<?php
//php C:\OSPanel\domains\x-site.web\src\userdata\testTasks\p-2.php самолет
//php C:\OSPanel\domains\x-site.web\src\userdata\testTasks\p-2.php муравьед
//php C:\OSPanel\domains\x-site.web\src\userdata\testTasks\p-2.php электрохлеборезка

$testWord = '';

if(isset($argv[1]) and !empty($argv[1])){
    $testWord = strval($argv[1]);
}else{
    echo "error: argument 'word' didnt pass params or not correct\n";
    exit;
}

$wordBaseFile = __DIR__."/russian.txt";

if(!file_exists($wordBaseFile)){
    echo "error: word base file '".$wordBaseFile."'not found\n";
    exit;
}

$handle = fopen($wordBaseFile, "r");

$limitRead = 10000000;
$limitPrint = 10000000;

if ($handle) {
    $limit = 0;

    $charset = prepareCharsetByPattern($testWord);

    $res_count = 0;
    $start_time = microtime(true);
    $result = [];
    while (($line = fgets($handle)) !== false) {
        $str = mb_convert_encoding($line, "utf-8", "windows-1251");
        if (checkString($str, $charset)){
            $result[] = $str;
            $res_count++;
        }
        $limit++;
        if($limit > $limitRead){
            break;
        }
    }

    fclose($handle);

    for ($i = 0; $i<count($result); $i++){
        echo $result[$i];
        if($i > $limitPrint){
            break;
        }
    }

    echo 'found: '.$res_count.' runTime='.(microtime(true) - $start_time);
}

function prepareCharsetByPattern(string $pattern):array
{
    $letters = mb_str_split($pattern);
    $return_charset = [];

    $charset = array(
        'а' => 1,
        'б' => 2,
        'в' => 3,
        'г' => 4,
        'д' => 5,
        'е' => 6,
        'ё' => 7,
        'ж' => 8,
        'з' => 9,
        'и' => 10,
        'й' => 11,
        'к' => 12,
        'л' => 13,
        'м' => 14,
        'н' => 15,
        'о' => 16,
        'п' => 17,
        'р' => 18,
        'с' => 19,
        'т' => 20,
        'у' => 21,
        'ф' => 22,
        'х' => 23,
        'ц' => 24,
        'ч' => 25,
        'ш' => 26,
        'щ' => 27,
        'ь' => 28,
        'ы' => 29,
        'ъ' => 30,
        'э' => 31,
        'ю' => 32,
        'я' => 33,
    );

    foreach ($charset as $lS => $lN){
        if(in_array($lS, $letters)){
            $return_charset[$lS] = 'ok';
        }
    }
    return $return_charset;
}

function checkString(string $str, $charset):bool
{
    $letters = mb_str_split($str);
    $checkRes = true;
    for ($i=0; $i<count($letters)-1; $i++){

        if(!(isset($charset[$letters[$i]]))){
            $checkRes = false;
            break;
        }
    }
    return $checkRes;
}