<?php

header("Content-Type:text/html; charset=utf-8");

// $map = array (
//     array( 0 , 0 , 0 , 0 , 0 , 0 , 0 , 0 , 0 , 0 ),
//     array( 0 , 0 , 0 , 0 , 0 , 0 , 0 , 0 , 0 , 0 ),
//     array( 0 , 0 , 0 , 0 , 0 , 0 , 0 , 0 , 0 , 0 ),
//     array( 0 , 0 , 0 , 0 , 0 , 0 , 0 , 0 , 0 , 0 ),
//     array( 0 , 0 , 0 , 0 , 0 , 0 , 0 , 0 , 0 , 0 ),
//     array( 0 , 0 , 0 , 0 , 0 , 0 , 0 , 0 , 0 , 0 ),
//     array( 0 , 0 , 0 , 0 , 0 , 0 , 0 , 0 , 0 , 0 ),
//     array( 0 , 0 , 0 , 0 , 0 , 0 , 0 , 0 , 0 , 0 ),
//     array( 0 , 0 , 0 , 0 , 0 , 0 , 0 , 0 , 0 , 0 ),
//     array( 0 , 0 , 0 , 0 , 0 , 0 , 0 , 0 , 0 , 0 )
//     );

$mineNumber = 40;
$row = 10;
$col = 10;


/**
 * 產生亂數
 * 方法一:如下
 * 方法二:shuffle
 */

for($i = 0; $i < $row*$col; $i++) {                         //產生100個
    $ranNumber = rand(1,$row*$col);                         //產生1~100的亂數
    for($j = 0; $j < $i; $j++) {                      //檢查重覆
        if($ranNumber == $mapInArray[$j]){
            $ranNumber = rand(1,$row*$col);                 //如果重覆，重新產生亂數
            $j = 0;
        }
    }
    $mapInArray[$i] = $ranNumber;                     //寫入陣列
}
    // arsort($mapInArray);                //排序
    // foreach($mapInArray as $value){     //把陣列內的亂數讀出
    // echo $value . "<br />";
    // }

/**
 * 地雷標示
 */

for($i = 0; $i < $row*$col; $i++) {
    if($mapInArray[$i] <= $mineNumber){
        $mapInArray[$i] = 'M';
    }
    else {
        $mapInArray[$i] = 0;
    }
}

$num = 0 ;
for($i = 0; $i < $row; $i++) {
    for($j = 0; $j < $col; $j++) {
        $map[$i][$j] = $mapInArray[$num];
        $num++;
    }
}

// for($i = 0; $i < $row; $i++) {
//     for($j = 0; $j < $col; $j++) {
//         if($map[$i][$j] === 'M') {
//             echo "Ｍ ";
//         }
//         else {
//             printf("%02d ",$map[$i][$j]) ;
//         }
//     }
//     echo "N<br>";
// }
// echo "<br>";


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

// for($i = 0; $i < $row; $i++) {
//     for($j = 0; $j < $col; $j++) {
//         if($map[$i][$j] === 'M') {
//             echo "Ｍ ";
//         }
//         else {
//             printf("%02d ",$map[$i][$j]) ;
//         }
//     }
//     echo "N<br>";
// }
// echo "<br>";


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

?>