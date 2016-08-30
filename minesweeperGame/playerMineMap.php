<?php
session_start();
header("Content-Type:text/html; charset=utf-8");

// 規則
// 未判斷 = 55 ;
// 判斷過 = 66;

if($_GET['action'] == 'gameStart') {
    // 初始化玩家地圖
    for($i = 0; $i < 10; $i++) {
        for($j = 0; $j < 10; $j++) {
            // $playerMap[$i][$j] = 0 ;
            $_SESSION['playerMap_' . $i . '_' . $j] = 55 ;
        }
    }
    // 初始化玩家探索炸彈數
    $_SESSION['minePlayerFind'] = 0 ;
    echo $_SESSION['mineNumber'] ;
}

if($_GET['action'] == 'flagOn') {
    $_SESSION['playerMap_' . $_GET['i'] . '_' . $_GET['j']] = 77;
    $_SESSION['minePlayerFind']++;
    if($_SESSION['minePlayerFind'] == 10) {
        $findAllMine = 0;
        for ($i = 0; $i < 10; $i++) {
            for ($j = 0; $j < 10; $j++) {
                if ($_SESSION['playerMap_' . $i . '_' . $j] == 77 && $_SESSION['MineweeperMap_' . $i . '_' . $j] == 99) {
                    $findAllMine++;
                }
            }
        }
        if($findAllMine == 10) {
            echo "YouWin";
        }
    }
    if($_SESSION['minePlayerFind'] > 10) {
        echo "tooMuchFlag";
    }
    // echo $_SESSION['playerMap_' . $_GET['i'] . '_' . $_GET['j']];
}

if($_GET['action'] == 'flagOff') {
    $_SESSION['playerMap_' . $_GET['i'] . '_' . $_GET['j']] = 55;
    $_SESSION['minePlayerFind']--;
    // echo $_SESSION['playerMap_' . $_GET['i'] . '_' . $_GET['j']];
}

function findZero($i,$j,$result)
{
    $i = (int)$i;
    $j = (int)$j;

    $_SESSION['playerMap_' . $i . '_' . $j] = 66 ;
    $data[0] = 'zero';
    $data[1] = $_SESSION['MineweeperMap_' . $i . '_' . $j];
    $data[2] = $i;
    $data[3] = $j;
    array_unshift($result, $data);

    // for($ii = 0; $ii < 10; $ii++) {
    //     for($ij = 0; $ij < 10; $ij++) {
    //         // $playerMap[$i][$j] = 0 ;
    //         echo $_SESSION['playerMap_' . $ii . '_' . $ij] . " " ;
    //     }
    //     echo "<br>";
    // }
    // echo "<br><br>";

    // 左上
    if ($i != 0 && $j != 0) {
        if ($_SESSION['playerMap_' . ($i-1) . '_' . ($j-1)] == 55) {
            $_SESSION['playerMap_' . ($i-1) . '_' . ($j-1)] = 66;

            if ($_SESSION['MineweeperMap_' . ($i-1) . '_' . ($j-1)] == 0) {
                // echo "左上0<br><br>";
                $result = findZero($i-1,$j-1,$result);
            } else {
                // echo "左上1<br><br>";
                $data[0] = 'safe';
                $data[1] = $_SESSION['MineweeperMap_' . ($i-1) . '_' . ($j-1)];
                $data[2] = $i-1;
                $data[3] = $j-1;
                array_unshift($result, $data);
            }
        }
    }
    // 上
    if ($i != 0) {
        if ($_SESSION['playerMap_' . ($i-1) . '_' . $j] == 55) {
            $_SESSION['playerMap_' . ($i-1) . '_' . $j] = 66;

            if ($_SESSION['MineweeperMap_' . ($i-1) . '_' . $j] == 0) {
                // echo "上0<br><br>";
                $result = findZero($i-1,$j,$result);
            } else {
                // echo "上1<br><br>";
                $data[0] = 'safe';
                $data[1] = $_SESSION['MineweeperMap_' . ($i-1) . '_' . $j];
                $data[2] = $i-1;
                $data[3] = $j;
                array_unshift($result, $data);
            }
        }
    }
    // 右上
    if ($i != 0 && $j != 9) {
        if ($_SESSION['playerMap_' . ($i-1) . '_' . ($j+1)] == 55) {
            $_SESSION['playerMap_' . ($i-1) . '_' . ($j+1)] = 66;

            if ($_SESSION['MineweeperMap_' . ($i-1) . '_' . ($j+1)] == 0) {
                // echo "右上0<br><br>";
                $result = findZero($i-1,$j+1,$result);
            } else {
                // echo "右上1<br><br>";
                $data[0] = 'safe';
                $data[1] = $_SESSION['MineweeperMap_' . ($i-1) . '_' . ($j+1)];
                $data[2] = $i-1;
                $data[3] = $j+1;
                array_unshift($result, $data);
            }
        }
    }
    // 左
    if ($j != 0) {
        if ($_SESSION['playerMap_' . $i . '_' . ($j-1)] == 55) {
            $_SESSION['playerMap_' . $i . '_' . ($j-1)] = 66;

            if ($_SESSION['MineweeperMap_' . $i . '_' . ($j-1)] == 0) {
                // echo "左0<br><br>";
                $result = findZero($i,$j-1,$result);
            } else {
                // echo "左1<br><br>";
                $data[0] = 'safe';
                $data[1] = $_SESSION['MineweeperMap_' . $i . '_' . ($j-1)];
                $data[2] = $i;
                $data[3] = $j-1;
                array_unshift($result, $data);
            }
        }
    }
    // 右
    if ($j != 9) {
        if ($_SESSION['playerMap_' . $i . '_' . ($j+1)] == 55) {
            $_SESSION['playerMap_' . $i . '_' . ($j+1)] = 66;

            if ($_SESSION['MineweeperMap_' . $i . '_' . ($j+1)] == 0) {
                // echo "右0<br><br>";
                $result = findZero($i,$j+1,$result);
            } else {
                // echo "右1<br><br>";
                $data[0] = 'safe';
                $data[1] = $_SESSION['MineweeperMap_' . $i . '_' . ($j+1)];
                $data[2] = $i;
                $data[3] = $j+1;
                array_unshift($result, $data);
            }
        }
    }
    // 左下
    if ($i != 9 && $j != 0) {
        if ($_SESSION['playerMap_' . ($i+1) . '_' . ($j-1)] == 55) {
            $_SESSION['playerMap_' . ($i+1) . '_' . ($j-1)] = 66;

            if ($_SESSION['MineweeperMap_' . ($i+1) . '_' . ($j-1)] == 0) {
                // echo "左下0<br><br>";
                $result = findZero($i+1,$j-1,$result);
            } else {
                // echo "左下1<br><br>";
                $data[0] = 'safe';
                $data[1] = $_SESSION['MineweeperMap_' . ($i+1) . '_' . ($j-1)];
                $data[2] = $i+1;
                $data[3] = $j-1;
                array_unshift($result, $data);
            }
        }
    }
    // 下
    if ($i != 9) {
        if ($_SESSION['playerMap_' . ($i+1) . '_' . $j] == 55) {
            $_SESSION['playerMap_' . ($i+1) . '_' . $j] = 66;

            if ($_SESSION['MineweeperMap_' . ($i+1) . '_' . $j] == 0) {
                // echo "下0<br><br>";
                $result = findZero($i+1,$j,$result);
            } else {
                // echo "下1<br><br>";
                $data[0] = 'safe';
                $data[1] = $_SESSION['MineweeperMap_' . ($i+1) . '_' . $j];
                $data[2] = $i+1;
                $data[3] = $j;
                array_unshift($result, $data);
            }
        }
    }
    // 右下
    if ($i != 9 && $j != 9) {
        if ($_SESSION['playerMap_' . ($i+1) . '_' . ($j+1)] == 55) {
            $_SESSION['playerMap_' . ($i+1) . '_' . ($j+1)] = 66;

            if ($_SESSION['MineweeperMap_' . ($i+1) . '_' . ($j+1)] == 0) {
                // echo "右下0<br><br>";
                $result = findZero($i+1,$j+1,$result);
            } else {
                // echo "右下1<br><br>";
                $data[0] = 'safe';
                $data[1] = $_SESSION['MineweeperMap_' . ($i+1) . '_' . ($j+1)];
                $data[2] = $i+1;
                $data[3] = $j+1;
                array_unshift($result, $data);
            }
        }
    }

    return $result;
}

if($_GET['action'] == 'click') {

    if($_SESSION['MineweeperMap_' . $_GET['i'] . '_' . $_GET['j']] == 99) {
        // $_SESSION['playerMap_' . $_GET['i'] . '_' . $_GET['j']] = $_SESSION['MineweeperMap_' . $_GET['i'] . '_' . $_GET['j']];
        $data[0] = 'gameOver';
        $data[1] = $_SESSION['MineweeperMap_' . $_GET['i'] . '_' . $_GET['j']];
        $data[2] = $_GET['i'];
        $data[3] = $_GET['j'];

        echo json_encode($data);
    } elseif($_SESSION['MineweeperMap_' . $_GET['i'] . '_' . $_GET['j']] == 0) {
        // $_SESSION['playerMap_' . $_GET['i'] . '_' . $_GET['j']] = $_SESSION['MineweeperMap_' . $_GET['i'] . '_' . $_GET['j']];

        $result = array();
        $answer = findZero($_GET['i'],$_GET['j'],$result);
        // array_unshift($answer, 'zero');
        echo json_encode($answer,JSON_FORCE_OBJECT);
    } else {
        // $_SESSION['playerMap_' . $_GET['i'] . '_' . $_GET['j']] = $_SESSION['MineweeperMap_' . $_GET['i'] . '_' . $_GET['j']];
        $data[0] = 'safe';
        $data[1] = $_SESSION['MineweeperMap_' . $_GET['i'] . '_' . $_GET['j']];
        $data[2] = $_GET['i'];
        $data[3] = $_GET['j'];

        echo json_encode($data);
    }
}

if($_GET['action'] == 'gameOver') {
    $k = 0;
    for($i = 0; $i < 10; $i++) {
        for($j = 0; $j < 10; $j++) {
            $data[$k] = $_SESSION['MineweeperMap_' . $i . '_' . $j];
            $k++;
        }
    }
    echo json_encode($data);
}
// $savePlayerData = $_SESSION['playerMap'];

?>