<?php

header("Content-Type:text/html; charset=utf-8");

$map = array (
    array( 0 , 0 , 0 , 0 , 0 , 0 , 0 , 0 , 0 , 0 ),
    array( 0 , 0 , 0 , 0 , 0 , 0 , 0 , 0 , 0 , 0 ),
    array( 0 , 0 , 0 , 0 , 0 , 0 , 0 , 0 , 0 , 0 ),
    array( 0 , 0 , 0 , 0 , 0 , 0 , 0 , 0 , 0 , 0 ),
    array( 0 , 0 , 0 , 0 , 0 , 0 , 0 , 0 , 0 , 0 ),
    array( 0 , 0 , 0 , 0 , 0 , 0 , 0 , 0 , 0 , 0 ),
    array( 0 , 0 , 0 , 0 , 0 , 0 , 0 , 0 , 0 , 0 ),
    array( 0 , 0 , 0 , 0 , 0 , 0 , 0 , 0 , 0 , 0 ),
    array( 0 , 0 , 0 , 0 , 0 , 0 , 0 , 0 , 0 , 0 ),
    array( 0 , 0 , 0 , 0 , 0 , 0 , 0 , 0 , 0 , 0 )
    );

$mineNumber = 40;

/**
 * 產生亂數
 */

for($i = 0; $i < 100; $i++) {              //產生100個

    $ranNumber = rand(1,100);              //產生1~100的亂數

    for($j = 0; $j < $i; $j++) {           //檢查重覆
        if($b == $mapInArray[$j]){
            $b=rand(1,100);                //如果重覆，重新產生亂數
            $j = 0;
        }
    }
    $mapInArray[$i] = $b;                  //寫入陣列
}
    // arsort($mapInArray);                //排序
    // foreach($mapInArray as $value){     //把陣列內的亂數讀出
    // echo $value . "<br />";
    // }

/**
 * 地雷標示
 */

for($i = 0; $i < 100; $i++) {
    if($mapInArray[$i] <= $mineNumber){
        $mapInArray[$i] = '99';
    }
    else {
        $mapInArray[$i] = 0;
    }
}

$num = 0 ;
for($i = 0; $i < 10; $i++) {
    for($j = 0; $j < 10; $j++) {
        $map[$i][$j] = $mapInArray[$num];
        $num++;
    }
}

// for($i = 0; $i < 10; $i++) {
//     for($j = 0; $j < 10; $j++) {
//         if($map[$i][$j] == '0') {
//             printf("%02d ",$map[$i][$j]) ;

//         }
//         else {
//             echo $map[$i][$j] . " ";
//         }
//     }
//     echo "N<br>";
// }
// echo "<br>";


/**
 * 判斷周圍
 */

for($i = 0; $i < 10; $i++) {
    for($j = 0; $j < 10; $j++) {
        // 初始化地雷數
        $mineArround = 0;
        if ($map[$i][$j] == "0") {
            // 左上
            if($map[$i-1][$j-1] == "99") {
                $mineArround++;
            }
            // 上
            if($map[$i][$j-1] == "99") {
                $mineArround++;
            }
            // 右上
            if($map[$i+1][$j-1] == "99") {
                $mineArround++;
            }
            // 左
            if($map[$i-1][$j] == "99") {
                $mineArround++;
            }
            // 右
            if($map[$i+1][$j] == "99") {
                $mineArround++;
            }
            // 左下
            if($map[$i-1][$j+1] == "99") {
                $mineArround++;
            }
            // 下
            if($map[$i][$j+1] == "99") {
                $mineArround++;
            }
            // 右下
            if($map[$i+1][$j+1] == "99") {
                $mineArround++;
            }
            $map[$i][$j] = $mineArround;
        }
    }
}

// for($i = 0; $i < 10; $i++) {
//     for($j = 0; $j < 10; $j++) {
//         if($map[$i][$j] != '99') {
//             printf("%02d ",$map[$i][$j]) ;

//         }
//         else {
//             echo "Ｍ ";
//         }
//     }
//     echo "N<br>";
// }
// echo "<br>";


/**
 * 印出
 */

for($i = 0; $i < 10; $i++) {
    for($j = 0; $j < 10; $j++) {
        if($map[$i][$j] != '99') {
            echo $map[$i][$j];

        }
        else {
            echo "M";
        }
    }
    if($i != 9) {
        echo "N";
    }
}

?>