<?php
require_once("CreateMineweeperMap.php");
session_start();
// $saveData = $_SESSION['MineweeperMap'];
?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>Minesweeper</title>
        <link rel="stylesheet" type="text/css" href="style.css">
        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <script>
        // 設定定時器
        var intervel;
        var mineNumber;

        $( function() {
            // 開始
            $('#btnStart').click( function() {

                $.get("/_Minesweeper/minesweeperGame/playerMineMap.php?action=gameStart",
                    function(data) {
                        mineNumber = Number(data);
                        $("#mineleft").html(mineNumber);
                    }
                )

                alert('遊戲開始啦!!!!!\n有10顆炸彈');
                var num = 0;
                intervel = window.setInterval(function() {
                    $("#timeCounting").html(num);
                    num++;
                },1000);

                $("#btnStart").prop("disabled", true);
                $(".btnM").prop("disabled", false);
            });

            //關閉右鍵選單
            $(document).bind("contextmenu",function(event){
                  return false;
            });
        });
        </script>
    </head>
    <body>
        <div style = "width:100% ; text-align:center ;">
            <form id="Form1" method="post" encType="multipart/form-data" runat="server">
                <div style = "width:100% ;"><span style = "font-size:xx-large;">Minesweeper</sapn><br><br></div>

                <div id = "background">
                    <?php for($i = 0; $i < 10; $i++): ?>
                        <?php for($j = 0; $j < 10; $j++): ?>
                            <!--<div class = "divM" name = "<?= $mapInArray[$i][$j] ; ?>" id = "<?= $mapInArray[$i][$j] ; ?>">-->
                            <div class = "divM">
                                <span class = "spanMine" name = "spanMine_<?= $i . "_" . $j ?>" id = "spanMine_<?= $i . "_" . $j ?>">
                                </span><button class = "btnM" name = "btnMine_<?= $i . "_" . $j ?>" id = "btnMine_<?= $i . "_" . $j ?>" onmousedown = "checkAction(<?= $i . "," . $j ?>)" disabled></button>
                            </div>
                        <?php endfor ?>
                    <?php endfor ?>
                </div>

                <div style = "width:100% ;"><br><input type="button" class="but" name="btnStart" id="btnStart" value="開始" style="width:100px;" /><br></br></div>
                <div style = "width:100% ;">剩餘地雷數 : <div name="mineleft" id="mineleft"></div></div>
                <div style = "width:100% ;">經過時間 : <div name="timeCounting" id="timeCounting"></div></div>
            </form>
        </div>
        <script>

            function checkAction(i, j) {
                //先判斷是滑鼠左鍵還是右鍵,0是滑鼠左鍵,2是右
                var buttonType = event.button;
                //滑鼠左鍵的情況
                if (buttonType == 0) {

                    if(event.srcElement.className == "showFlagBtnM") {
                        // $("#spanMine_"+String(i)+"_"+String(j)).html('');
                        alert("不能踩旗子!!!!");
                    } else {
                        // 將方塊消失
                        event.srcElement.className = "disappearBtnM";
                        // event.srcElement.previousSibling.className = "spanMine";

                        // 尋找資料
                        $.get("/_Minesweeper/minesweeperGame/playerMineMap.php?action=click&i=" + i + "&j=" + j,
                            function(data) {
                                var ajaxData = JSON.parse(data);
                                if(ajaxData[0] == 'safe') {
                                    $("#spanMine_"+ajaxData[2]+"_"+ajaxData[3]).html(ajaxData[1]);
                                } else if(ajaxData[0] == 'gameOver') {
                                    $.get("/_Minesweeper/minesweeperGame/playerMineMap.php?action=gameOver",
                                        function(data) {
                                            $(".btnM").hide();
                                            var ajaxData = JSON.parse(data);
                                            var k = 0;
                                            for(var i = 0; i < 10; i++) {
                                                for(var j = 0; j < 10; j++) {
                                                    if ($("#spanMine_"+String(i)+"_"+String(j)).html() == '　' || $("#spanMine_"+String(i)+"_"+String(j)).html() == '1' || $("#spanMine_"+String(i)+"_"+String(j)).html() == '2' || $("#spanMine_"+String(i)+"_"+String(j)).html() == '3' || $("#spanMine_"+String(i)+"_"+String(j)).html() == '4' || $("#spanMine_"+String(i)+"_"+String(j)).html() == '5' || $("#spanMine_"+String(i)+"_"+String(j)).html() == '6' || $("#spanMine_"+String(i)+"_"+String(j)).html() == '7' || $("#spanMine_"+String(i)+"_"+String(j)).html() == '8') {
                                                        // alert($("#spanMine_"+String(i)+"_"+String(j)).html());
                                                    } else {
                                                        if (ajaxData[k] == '99') {
                                                            // document.getElementById("spanMine_"+String(i)+"_"+String(j)).style.backgroundColor = "red";
                                                            $("#spanMine_"+String(i)+"_"+String(j)).html('　');
                                                            document.getElementById("spanMine_"+String(i)+"_"+String(j)).className = "spanMineM";
                                                        } else {
                                                            document.getElementById("spanMine_"+String(i)+"_"+String(j)).style.backgroundColor = "#4682b4";
                                                            $("#spanMine_"+String(i)+"_"+String(j)).html(ajaxData[k]);
                                                        }
                                                    }
                                                    k++;
                                                }
                                            }
                                            if (confirm("Game Over!!!\nStart New Game ?")) {
                                                location.href='index.php';
                                            }
                                            window.clearInterval(intervel);
                                        }
                                    )
                                } else {
                                    for (var key in ajaxData) {
                                        if(ajaxData[key][0] == 'safe') {
                                            document.getElementById("btnMine_"+ajaxData[key][2]+"_"+ajaxData[key][3]).className = "disappearBtnM";
                                            $("#spanMine_"+ajaxData[key][2]+"_"+ajaxData[key][3]).html(ajaxData[key][1]);
                                        }
                                        if(ajaxData[key][0] == 'zero') {
                                            document.getElementById("btnMine_"+ajaxData[key][2]+"_"+ajaxData[key][3]).className = "disappearBtnM";
                                            document.getElementById("spanMine_"+ajaxData[key][2]+"_"+ajaxData[key][3]).style.backgroundColor = "#8fbc8f";
                                            $("#spanMine_"+ajaxData[key][2]+"_"+ajaxData[key][3]).html("　");
                                        }
                                        // alert(key);
                                        // document.getElementById("spanMine_"+ajaxData[2]+"_"+ajaxData[3]).style.backgroundColor = "#8fbc8f";
                                        // $("#spanMine_"+ajaxData[2]+"_"+ajaxData[3]).html(ajaxData[1]);
                                    }
                                }

                            }
                        )
                    }
                }
                //滑鼠右鍵的情況
                if (buttonType == 2) {

                    if(event.srcElement.className == "showFlagBtnM") {
                        event.srcElement.className = "btnM";
                        mineNumber = mineNumber+1;
                        $("#mineleft").html(mineNumber);
                        $.get("/_Minesweeper/minesweeperGame/playerMineMap.php?action=flagOff&i=" + i + "&j=" + j,
                            function(data) {
                                // alert(data);
                            }
                        )
                    } else {
                        event.srcElement.className = "showFlagBtnM";
                        mineNumber = mineNumber-1;
                        $("#mineleft").html(mineNumber);
                        $.get("/_Minesweeper/minesweeperGame/playerMineMap.php?action=flagOn&i=" + i + "&j=" + j,
                            function(data) {
                                if (data == 'YouWin') {
                                    if (confirm("Congratulation!!!\nYou Find All Mines!!!\nStart New Game ?")) {
                                        location.href='index.php';
                                    }
                                    window.clearInterval(intervel);
                                }
                                // alert(data);
                            }
                        )
                    }
                }
            }
            // function disapear() {
            //     event.srcElement.className = "disappearBtnM";
            //     event.srcElement.previousSibling.className = "spanMine";

            //     if(event.srcElement.parentNode.id == "M") {
            //         alert('Booom!!!!!!!');
            //         event.srcElement.previousSibling.className = "spanMineM";
            //         $(".btnM").hide();
            //         $(".spanMineDis").show();
            //         window.clearInterval(intervel);
            //     }
            //     if(event.srcElement.parentNode.id == "0") {
            //         //
            //     }
            // };
        </script>
    </body>
</html>