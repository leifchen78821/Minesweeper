<?php
session_start();

// 規則
// unkown = 55 ;
// flag = 66;

// if($_GET['action'] == 'gameStart') {
//     for($i = 0; $i < 10; $i++) {
//         for($j = 0; $j < 10; $j++) {
//             // $playerMap[$i][$j] = 0 ;
//             $_SESSION['playerMap_' . $i . '_' . $j] = 55 ;
//         }
//     }
//     // $_SESSION['playerMap'] = $playerMap;
//     // echo json_encode($_SESSION['playerMap']);
// }

// if($_GET['action'] == 'flagOn') {
//     $_SESSION['playerMap_' . $_GET['i'] . '_' . $_GET['j']] = 66;
//     echo $_SESSION['playerMap_' . $_GET['i'] . '_' . $_GET['j']];
// }

// if($_GET['action'] == 'flagOff') {
//     $_SESSION['playerMap_' . $_GET['i'] . '_' . $_GET['j']] = 55;
//     echo $_SESSION['playerMap_' . $_GET['i'] . '_' . $_GET['j']];
// }

function findZero($i,$j,$result)
{
        $data[0] = 'zero';
        $data[1] = $_SESSION['MineweeperMap_' . $_GET['i'] . '_' . $_GET['j']];
        $data[2] = $_GET['i'];
        $data[3] = $_GET['j'];
        array_unshift($result, $data);

        // 左上
        if ($_SESSION['MineweeperMap_' . $_GET['i']-1 . '_' . $_GET['j']]-1 == 0) {
            $result = findZero($_GET['i']-1,$_GET['j']-1,$result);
        } else {
            $data[0] = 'safe';
            $data[1] = $_SESSION['MineweeperMap_' . $_GET['i']-1 . '_' . $_GET['j']-1];
            $data[2] = $_GET['i']-1;
            $data[3] = $_GET['j']-1;
            array_unshift($result, $data);
        }
        // 上
        if ($_SESSION['MineweeperMap_' . $_GET['i']-1 . '_' . $_GET['j']] == 0) {
            $result = findZero($_GET['i']-1,$_GET['j'],$result);
        } else {
            $data[0] = 'safe';
            $data[1] = $_SESSION['MineweeperMap_' . $_GET['i']-1 . '_' . $_GET['j']];
            $data[2] = $_GET['i']-1;
            $data[3] = $_GET['j'];
            array_unshift($result, $data);
        }
        // 右上
        if ($_SESSION['MineweeperMap_' . $_GET['i']-1 . '_' . $_GET['j']]+1 == 0) {
            $result = findZero($_GET['i']-1,$_GET['j']+1,$result);
        } else {
            $data[0] = 'safe';
            $data[1] = $_SESSION['MineweeperMap_' . $_GET['i']-1 . '_' . $_GET['j']+1];
            $data[2] = $_GET['i']-1;
            $data[3] = $_GET['j']+1;
            array_unshift($result, $data);
        }
        // 左
        if ($_SESSION['MineweeperMap_' . $_GET['i'] . '_' . $_GET['j']]-1 == 0) {
            $result = findZero($_GET['i'],$_GET['j']-1,$result);
        } else {
            $data[0] = 'safe';
            $data[1] = $_SESSION['MineweeperMap_' . $_GET['i'] . '_' . $_GET['j']-1];
            $data[2] = $_GET['i'];
            $data[3] = $_GET['j']-1;
            array_unshift($result, $data);
        }
        // 右
        if ($_SESSION['MineweeperMap_' . $_GET['i'] . '_' . $_GET['j']]+1 == 0) {
            $result = findZero($_GET['i'],$_GET['j']+1,$result);
        } else {
            $data[0] = 'safe';
            $data[1] = $_SESSION['MineweeperMap_' . $_GET['i'] . '_' . $_GET['j']+1];
            $data[2] = $_GET['i'];
            $data[3] = $_GET['j']+1;
            array_unshift($result, $data);
        }
        // 左下
        if ($_SESSION['MineweeperMap_' . $_GET['i']+1 . '_' . $_GET['j']]-1 == 0) {
            $result = findZero($_GET['i']+1,$_GET['j']-1,$result);
        } else {
            $data[0] = 'safe';
            $data[1] = $_SESSION['MineweeperMap_' . $_GET['i']+1 . '_' . $_GET['j']-1];
            $data[2] = $_GET['i']+1;
            $data[3] = $_GET['j']-1;
            array_unshift($result, $data);
        }
        // 下
        if ($_SESSION['MineweeperMap_' . $_GET['i']+1 . '_' . $_GET['j']] == 0) {
            $result = findZero($_GET['i']+1,$_GET['j'],$result);
        } else {
            $data[0] = 'safe';
            $data[1] = $_SESSION['MineweeperMap_' . $_GET['i']+1 . '_' . $_GET['j']];
            $data[2] = $_GET['i']+1;
            $data[3] = $_GET['j'];
            array_unshift($result, $data);
        }
        // 右下
        if ($_SESSION['MineweeperMap_' . $_GET['i']+1 . '_' . $_GET['j']]+1 == 0) {
            $result = findZero($_GET['i']+1,$_GET['j']+1,$result);
        } else {
            $data[0] = 'safe';
            $data[1] = $_SESSION['MineweeperMap_' . $_GET['i']+1 . '_' . $_GET['j']+1];
            $data[2] = $_GET['i']+1;
            $data[3] = $_GET['j']+1;
            array_unshift($result, $data);
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
        array_unshift($result, 'zero');
        echo json_encode($answer);
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