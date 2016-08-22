<?php
// $time_start = microtime(true);

$mineNumber = 1200;
$row = 50;
$col = 60;

/**
 * 產生亂數
 * 方法二:shuffle
 */

for($i = 0; $i < $row*$col; $i++) {
    if($i < $mineNumber) {
        $mapInArray[$i] = 'M';
    }
    else{
        $mapInArray[$i] = '0';
    }
}

shuffle($mapInArray);

/**
 * 地雷標示
 */

$num = 0 ;
for($i = 0; $i < $row; $i++) {
    for($j = 0; $j < $col; $j++) {
        $map[$i][$j] = $mapInArray[$num];
        $num++;
    }
}

/**
 * 判斷周圍
 */

for($i = 0; $i < $row; $i++) {
    for($j = 0; $j < $col; $j++) {
        // 初始化地雷數
        $mineArround = 0;
        if ($map[$i][$j] == "0") {
            // 左上
            if($map[$i-1][$j-1] === "M") {
                $mineArround++;
            }
            // 上
            if($map[$i][$j-1] === "M") {
                $mineArround++;
            }
            // 右上
            if($map[$i+1][$j-1] === "M") {
                $mineArround++;
            }
            // 左
            if($map[$i-1][$j] === "M") {
                $mineArround++;
            }
            // 右
            if($map[$i+1][$j] === "M") {
                $mineArround++;
            }
            // 左下
            if($map[$i-1][$j+1] === "M") {
                $mineArround++;
            }
            // 下
            if($map[$i][$j+1] === "M") {
                $mineArround++;
            }
            // 右下
            if($map[$i+1][$j+1] === "M") {
                $mineArround++;
            }
            $map[$i][$j] = $mineArround;
        }
    }
}

/**
 * 印出
 */

for($i = 0; $i < $row; $i++) {
    for($j = 0; $j < $col; $j++) {
        echo $map[$i][$j];
    }
    if($i != $row-1) {
        echo "N";
    }
}

// $time_end = microtime(true);
// $time = $time_end - $time_start;

// echo "Did nothing in $time seconds\n";

?>