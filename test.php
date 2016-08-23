<?php

header("Content-Type:text/html; charset=utf-8");

$mineNumber = 40;
$row = 10;
$col = 10;

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

$num = 0 ;
for($i = 0; $i < $row; $i++) {
    for($j = 0; $j < $col; $j++) {
        $mapInArray[$num] = $map[$i][$j];
        $num++;
    }
}

?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>Minesweeper</title>
        <link rel="stylesheet" type="text/css" href="style.css">
        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <script>
        $( function() {
            $('#btnStart').click( function() {
                alert('Start!!!!!');
                var num = 0;
                setInterval(function() {
                    $("#timeCounting").html(num);
                    num++;
                },1000);
            $("#btnStart").prop("disabled", true);
            $(".btnM").prop("disabled", false);
            });
        });
        </script>
    </head>
    <body>
        <div style = "width:100% ; text-align:center ;">
            <form id="Form1" method="post" encType="multipart/form-data" runat="server">
                <div style = "width:100% ;"><span style = "font-size:xx-large;">Minesweeper</sapn><br><br></div>

                <div id = "background">
                    <?php for($i = 0; $i < 100; $i++): ?>
                    <div class = "divM" name = "<?= $mapInArray[$i] ; ?>" id = "<?= $mapInArray[$i] ; ?>">
                        <span class = "spanMineDis"><?= $mapInArray[$i] ; ?>
                        </span><input type = "button" class = "btnM" name = "<?= "btnMine[" . $i . "]" ?>" id = "<?= "btnMine[" . $i . "]" ?>" onclick = "disapear()" disabled>
                    </div>
                    <?php endfor ?>
                </div>

                <div style = "width:100% ;"><br><input type="button" class="but" name="btnStart" id="btnStart" value="開始" style="width:100px;" /><br></br></div>
                <div style = "width:100% ;">經過時間 : <div name="timeCounting" id="timeCounting"></div></div>
            </form>
        </div>
        <script>
            function disapear() {
                event.srcElement.className = "disappearBtnM" ;
                event.srcElement.previousSibling.className = "spanMine" ;
                if(event.srcElement.parentNode.id == "M") {
                    alert('Booom!!!!!!!');
                    event.srcElement.previousSibling.className = "spanMineM" ;
                }
                // $( "#btnMine" ).prop( "disabled", true );
                // $("forn[id=Form1]").delegate("input[id=btnStart]","click",function(){
                // });
            };
        </script>
    </body>
</html>