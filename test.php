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

// for($i = 0; $i < $row; $i++) {
//     for($j = 0; $j < $col; $j++) {
//         echo $map[$i][$j];
//     }
//     if($i != $row-1) {
//         echo "N";
//     }
// }

?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>Minesweeper</title>
        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <script>
        $( function() {
            $('#btnStart').click( function() {
                var num = 0;
                setInterval(function() {
                    $("#timeCounting").html(num);
                    num++;
                },1000);
            });

            var num = 0 ;
            var JbtnMine = new Array(10);
            var JdivMine = new Array(10);
            for(var i = 0 ; i < 10 ; i++){
                JbtnMine[i] = new Array(10);
                JdivMine[i] = new Array(10);
            }

            for(var i = 0 ; i < 10 ; i++){
                for(var j = 0 ; j < 10 ; j++) {
                    JdivMine[i][j] = $("#divM[" + num + "]").html();
                    num++;
                }
            }

            $('#btnMine[0]').click( function() {
                alert('23');
            });
        });
        </script>
    </head>
    <body>
        <div style = "width:100% ; text-align:center ;">
            <div style = "width:100% ;"><span style = "font-size:xx-large;">Minesweeper</sapn><br><br></div>

            <div style = "width:500px ; height:500px ; margin:auto ; padding:25px 25px ; background-color:gray">
                <?php for($i = 0; $i < 10; $i++): ?>
                    <?php for($j = 0; $j < 10; $j++): ?>
                    <div style = "float:left ; width:45px ; height:45px ; margin:2.5px 2.5px ; background-color:#929CB0">
                        <input type="button" class="butM" name="btnMine[]" id="btnMine[]" value="" style="width:100% ; height:100% ;" onclick="enableAction();">
                        <div class="divM" name = "divMine[]" id="divMine[]" style="display: none"><?php echo $map[$i][$j] ; ?></div>
                    </div>
                    <?php endfor ?>
                <?php endfor ?>
            </div>

            <div style = "width:100% ;"><br><input type="button" class="but" name="btnStart" id="btnStart" value="開始" style="width:100px;" /><br></br></div>
            <div style = "width:100% ;">經過時間 : <div name="timeCounting" id="timeCounting"></div></div>

        </div>
    </body>
</html>