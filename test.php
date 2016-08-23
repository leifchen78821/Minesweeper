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

            // for(var i = 0 ; i < 100 ; i++) {
            //     $( function() {
            //         var obj = $('#mineClone').clone().show();
            //         $('#mineBox').append( obj ) ;
            //     });
            // }

            // $("div[class=divM]").delegate("input[class=btnM]","click",function(){
            //     alert('123');
            // });

            // function disapear() {
            //     alert('123');
            //     $("forn[id=Form1]").delegate("input[id=btnStart]","click",function(){
            //     });
            // };
        });
        </script>
    </head>
    <body>
        <div style = "width:100% ; text-align:center ;">
            <form id="Form1" method="post" encType="multipart/form-data" runat="server">
                <div style = "width:100% ;"><span style = "font-size:xx-large;">Minesweeper</sapn><br><br></div>

                <div style = "width:500px ; height:500px ; margin:auto ; padding:25px 25px ; background-color:#337091">
                    <!--<?php for($i = 0; $i < 10; $i++): ?>-->
                    <!--    <?php for($j = 0; $j < 10; $j++): ?>-->
                    <!--    <div style = "float:left ; width:45px ; height:45px ; margin:2.5px 2.5px ; background-color:#929CB0">-->
                    <!--        <input type="button" class="butM" name="btnMine" id="btnMine" value="" style="width:100% ; height:100% ;" onclick="enableAction();">-->
                    <!--        <div class="divM" name = "divMine[]" id="divMine[]" style="display: none"><?php echo $map[$i][$j] ; ?></div>-->
                    <!--    </div>-->
                    <!--    <?php endfor ?>-->
                    <!--<?php endfor ?>-->
                    <!--<div id = "mineBox"></div>-->

                    <!--<div id = "mineClone" style = "float:left ; width:45px ; height:45px ; margin:2.5px 2.5px ; background-color:#929CB0 ; display:none">-->
                    <!--    <input type="button" class="btnM" name="btnMine[]" id="btnMine[]" value="" style="width:100% ; height:100% ; background-color : #78ABC7">-->
                    <!--</div>-->
                    <?php for($i = 0; $i < 100; $i++): ?>
                    <div class = "divM" name = "<?= $mapInArray[$i] ; ?>" id = "<?= $mapInArray[$i] ; ?>" style = "float:left ; width:45px ; height:45px ; margin:2.5px 2.5px ; background-color:#929CB0 ;">
                        <span style = "font-size:40px ; display:none"><?= $mapInArray[$i] ; ?></span>
                        <input type = "button" class = "btnM" name = "<?= "btnMine[" . $i . "]" ?>" id = "<?= "btnMine[" . $i . "]" ?>" style = "width:100% ; height:100% ; background-color : #78ABC7" onclick = "disapear()" disabled>
                    </div>
                    <?php endfor ?>

                </div>

                <div style = "width:100% ;"><br><input type="button" class="but" name="btnStart" id="btnStart" value="開始" style="width:100px;" /><br></br></div>
                <div style = "width:100% ;">經過時間 : <div name="timeCounting" id="timeCounting"></div></div>
            </form>
        </div>
        <script>
            function disapear() {
                button.style.visibility = "hidden";
                // $( "#btnMine" ).prop( "disabled", true );
                // $("forn[id=Form1]").delegate("input[id=btnStart]","click",function(){
                // });
            };
        </script>
    </body>
</html>