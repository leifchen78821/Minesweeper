<?php

header("Content-Type:text/html; charset=utf-8");
// $get = $_GET['map'] ;
// echo mb_strlen($get);
// var_dump($get);
$mapInOneDimensional = str_split($_GET["map"]);
// print_r($mapInOneDimensional);
// echo count($mapInOneDimensional);


if(count($mapInOneDimensional) > 109) {
    echo "不符合，輸入的字串長度為 : " . count($mapInOneDimensional) . "，字串長度超過格式標準!!";

    return ;
}
else if(count($mapInOneDimensional) < 109) {
    echo "不符合，輸入的字串長度為 : " . count($mapInOneDimensional) . "，字串長度不足格式標準!!";

    return ;
}
else {
    $checkIllegalCharacter = false ;
    $countIllegalCharacter = 1 ;
    $showRight = 0;
    foreach($mapInOneDimensional as $checkList) {
        // if($checkList != "0" && $checkList != "1" && $checkList != "2" && $checkList != "3" && $checkList != "4" && $checkList != "5" && $checkList != "6" && $checkList != "7" && $checkList != "8" && $checkList != "M" && $checkList != "N") {
        if(!preg_match("/^([0-8M-N]+)$/", $checkList , $result)) {
            if($showRight == 0) {
                echo "不符合";
                $showRight = 1;
            }
            echo "，於第 " . $countIllegalCharacter . " 個有不符合規定的字元(0-8及M/N) [ " . $checkList . " ] !!";
            $checkIllegalCharacter = true;
        }
        $countIllegalCharacter++;
    }
    if($checkIllegalCharacter == true) {

        return ;
    }
    else {
        $checkNumberM = 0;
        foreach($mapInOneDimensional as $checkList) {
            if($checkList == "M") {
                $checkNumberM++;
            }
        }
        if($checkNumberM > 40) {
            echo "不符合，地雷數量太多了，想害誰啊!!";
            return ;
        }
        if($checkNumberM < 40) {
            echo "不符合，地雷數量太少了，踩個屁阿!!";
            return ;
        }
        if($checkNumberM == 40) {

            // $checkRowColumNumber = explode("N" , $_GET["map"]);
            $checkN = array_count_values($mapInOneDimensional);
            // echo $checkN['N'];
            if($checkN['N'] != 9) {
                echo "不符合，行列規格不符合 10 * 10 (行數不為10)!!";
                return ;
            }

            $checkRowNumber = 0;
            foreach($mapInOneDimensional as $checkList) {
                if($checkList != "N") {
                    $checkRowNumber++;
                }
                else {
                    if($checkRowNumber != 10) {
                        echo "不符合，行列規格不符合 10 * 10 (列數不為10)!!";
                        return ;
                    }
                    $checkRowNumber = 0;
                }
            }

            $num = 0;
            for($i = 0 ; $i < 10 ; $i++) {
                for($j = 0 ; $j < 10 ; $j++) {
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

            // for($i = 0; $i < 10; $i++) {
            //     for($j = 0; $j < 10; $j++) {
            //         if($mapInTwoDimensional[$i][$j] === 'M') {
            //             echo "Ｍ ";
            //         }
            //         else {
            //             printf("%02d ",$mapInTwoDimensional[$i][$j]) ;
            //         }
            //     }
            //     echo "<br>";
            // }

            $checkMineArround = false;
            $showRight = 0;
            for($i = 0 ; $i < 10 ; $i++) {
                for($j = 0 ; $j < 10 ; $j++) {
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
                            if($showRight == 0) {
                                echo "不符合";
                                $showRight = 1 ;
                            }
                            echo "，於[ " . $j . " , " . $i . " ]的周圍地雷判斷錯誤，應為 [ " . $mineArround . " ] !!";
                            $checkMineArround = true;
                        }
                    }

                }
            }

            if($checkMineArround == false) {
                echo "符合";
            }
            else {
                return;
            }
        }
    }
}

?>