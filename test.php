<?php



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
        });
        </script>
    </head>
    <body>
        <div style = "width:100% ; text-align:center ;">
            <div style = "width:100% ;"><span style = "font-size:xx-large;">Minesweeper</sapn><br><br></div>

            <div style = "width:500px ; height:500px ; margin:auto ; padding:25px 25px ; background-color:yellow">
                <?php for($i = 0; $i < 10; $i++): ?>
                    <?php for($j = 0; $j < 10; $j++): ?>
                    <div  style = "float:left ; width:45px ; height:45px ; margin:2.5px 2.5px ; background-color:red">

                    </div>
                    <?php endfor ?>
                <?php endfor ?>
            </div>

            <div style = "width:100% ;"><br><input type="button" class="but" name="btnStart" id="btnStart" value="開始" style="width:100px;" /><br></br></div>
            <div style = "width:100% ;">經過時間 : <div name="timeCounting" id="timeCounting"></div></div>

        </div>
    </body>
</html>