<?php
session_start();
header("Content-Type:text/html; charset=utf-8");

$mineNumber = 10;
$row = 10;
$col = 10;

/**
 * 產生亂數
 * 方法二:shuffle
 */

for($i = 0; $i < $row*$col; $i++) {
    if($i < $mineNumber) {
        $mapInArray[$i] = 99;
    }
    else{
        $mapInArray[$i] = 0;
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
        if ($map[$i][$j] == 0) {
            // 左上
            if($map[$i-1][$j-1] === 99) {
                $mineArround++;
            }
            // 上
            if($map[$i][$j-1] === 99) {
                $mineArround++;
            }
            // 右上
            if($map[$i+1][$j-1] === 99) {
                $mineArround++;
            }
            // 左
            if($map[$i-1][$j] === 99) {
                $mineArround++;
            }
            // 右
            if($map[$i+1][$j] === 99) {
                $mineArround++;
            }
            // 左下
            if($map[$i-1][$j+1] === 99) {
                $mineArround++;
            }
            // 下
            if($map[$i][$j+1] === 99) {
                $mineArround++;
            }
            // 右下
            if($map[$i+1][$j+1] === 99) {
                $mineArround++;
            }
            $map[$i][$j] = $mineArround;
        }
    }
}

$num = 0 ;
for($i = 0; $i < $row; $i++) {
    for($j = 0; $j < $col; $j++) {
        $mapInArray[$num] = $map[$i][$j];
        $num++;
        $_SESSION['MineweeperMap_' . $i . '_' . $j] = $map[$i][$j];
        echo $_SESSION['MineweeperMap_' . $i . '_' . $j] . " ";
    }
    echo "<br>";
}

$_SESSION['MineweeperMap'] = $map;

?>