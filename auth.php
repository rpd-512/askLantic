<?php
require_once "pdoData.php";
if(isset($_POST['tsk'])){
    if($_POST['tsk'] == "up"){
        $usrn = $_POST['u'];
        $mail = $_POST['m'];
        $raw_data = $pdo->query("select * from askLantic__userData");
        while ($data = $raw_data->fetch(PDO::FETCH_ASSOC))
        {
            if(strtolower($data['usern']) == strtolower($usrn)){
                echo "u";
                return 0;
            }
            if(strtolower($data['email']) == strtolower($mail)){
                echo "m";
                return 0;
            }
        }
        echo "1";
    }
    if($_POST['tsk'] == "in"){
        $usrn = $_POST['u'];
        $pswd = $_POST['p'];
        $raw_data = $pdo->query("select * from askLantic__userData");
        $exist = false;
        while ($data = $raw_data->fetch(PDO::FETCH_ASSOC))
        {
            if(strtolower($usrn) == strtolower($data['usern'])){
                $exist = true;
                if(md5($pswd."ASKmeBOIS@69069") != $data['paswd']){
                    echo "p";
                }
            }
        }
        if(! $exist){
            echo "u";
        }
    }
}

?>