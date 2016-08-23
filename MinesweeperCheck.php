<?php

header("Content-Type:text/html; charset=utf-8");
$mapInOneDimensional = str_split($_GET["map"]);

function checkCountInOneDimensional($mapInOneDimensional) {
    $check = true;
    if(count($mapInOneDimensional) > 109) {
        echo "不符合，輸入的字串長度為 : " . count($mapInOneDimensional) . "，字串長度超過格式標準!!\n";
        $check = false;
    }
    else if(count($mapInOneDimensional) < 109) {
        echo "不符合，輸入的字串長度為 : " . count($mapInOneDimensional) . "，字串長度不足格式標準!!\n";
        $check = false;
    }

    return $check;
}

function checkIllegalCharacter($mapInOneDimensional) {
    $check = true;
    $checkIllegalCharacter = false;
    $countIllegalCharacter = 1;
    foreach($mapInOneDimensional as $checkList) {
        // if($checkList != "0" && $checkList != "1" && $checkList != "2" && $checkList != "3" && $checkList != "4" && $checkList != "5" && $checkList != "6" && $checkList != "7" && $checkList != "8" && $checkList != "M" && $checkList != "N") {
        if(!preg_match("/^([0-8M-N]+)$/", $checkList , $result)) {
            echo "不符合，於第 " . $countIllegalCharacter . " 個有不符合規定的字元(0-8及M/N) [ " . $checkList . " ] !!\n";
            $checkIllegalCharacter = true;
            $check = false;
        }
        $countIllegalCharacter++;
    }

    return $check;
}

function checkRowAndColum($mapInOneDimensional) {
    $check = true;
    $checkN = array_count_values($mapInOneDimensional);
    if($checkN['N'] != 9) {
        echo "不符合，行列規格不符合 10 * 10 (行數不為10)!!\n";
        $check = false;
    }
    $checkRowNumber = 0;
    foreach($mapInOneDimensional as $checkList) {
        if($checkList != "N") {
            $checkRowNumber++;
        } else {
            if($checkRowNumber != 10) {
                echo "不符合，行列規格不符合 10 * 10 (列數不為10)!!\n";
                $check = false;
            }
            $checkRowNumber = 0;
        }
    }

    return $check;
}

function checkMineNumber($mapInOneDimensional) {
    $check = true;
    $checkNumberM = 0;
    foreach($mapInOneDimensional as $checkList) {
        if($checkList == "M") {
            $checkNumberM++;
        }
    }
    if($checkNumberM > 40) {
        echo "不符合，地雷數量( " . $checkNumberM . " )太多了，想害誰啊!!\n";
        $check = false;
    }
    if($checkNumberM < 40) {
        echo "不符合，地雷數量( " . $checkNumberM . " )太少了，踩個屁阿!!\n";
        $check = false;
    }
    return $check;
}

function checkMineArround($mapInOneDimensional) {
    $check = true;
    $num = 0;
    for($i = 0 ;$i < 10 ;$i++) {
        for($j = 0 ;$j < 10 ;$j++) {
            if($mapInOneDimensional[$num] == "N") {
                $num++;
                $mapInTwoDimensional[$i][$j] = $mapInOneDimensional[$num];
                $num++;
            }
            else {
                $mapInTwoDimensional[$i][$j] = $mapInOneDimensional[$num];
                $num++;
            }
        }
    }

    $checkMineArround = false;
    for($i = 0 ;$i < 10 ;$i++) {
        for($j = 0 ;$j < 10 ;$j++) {
            $mineArround = 0;
            if ($mapInTwoDimensional[$i][$j] != "M") {
                // 左上
                if($mapInTwoDimensional[$i-1][$j-1] === "M") {
                    $mineArround++;
                }
                // 上
                if($mapInTwoDimensional[$i][$j-1] === "M") {
                    $mineArround++;
                }
                // 右上
                if($mapInTwoDimensional[$i+1][$j-1] === "M") {
                    $mineArround++;
                }
                // 左
                if($mapInTwoDimensional[$i-1][$j] === "M") {
                    $mineArround++;
                }
                // 右
                if($mapInTwoDimensional[$i+1][$j] === "M") {
                    $mineArround++;
                }
                // 左下
                if($mapInTwoDimensional[$i-1][$j+1] === "M") {
                    $mineArround++;
                }
                // 下
                if($mapInTwoDimensional[$i][$j+1] === "M") {
                    $mineArround++;
                }
                // 右下
                if($mapInTwoDimensional[$i+1][$j+1] === "M") {
                    $mineArround++;
                }

                if($mapInTwoDimensional[$i][$j] != $mineArround) {
                    echo "不符合，於[ " . $j . " , " . $i . " ]的周圍地雷判斷錯誤，應為 [ " . $mineArround . " ] !!\n";
                    $checkMineArround = true;
                    $check = false;
                }
            }

        }
    }
    return $check;
}

$check1 = checkCountInOneDimensional($mapInOneDimensional);
$check2 = checkIllegalCharacter($mapInOneDimensional);
$check3 = checkRowAndColum($mapInOneDimensional);
$check4 = checkMineNumber($mapInOneDimensional);
$check5 = checkMineArround($mapInOneDimensional);

if($check1 == true && $check2 == true && $check3 == true && $check4 == true && $check5 == true) {
    echo "符合";
}

?>