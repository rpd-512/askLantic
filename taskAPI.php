<?php
require_once "libs.php";

if(isset($_POST['getView']) and isset($_POST['postId'])){
    $exst = false;
    $raw_data = $pdo->query("select * from askLantic__questions where md5(concat(quesId,'GetThisManAView')) = '".$_POST['postId']."';");
    while ($data = $raw_data->fetch(PDO::FETCH_ASSOC)){
        echo $data['view'];
        $exst = true;
    }
    if(!$exst){
        echo 'na';
    }
    exit();
}

if (isset(isAuth()[1])) {
    $userData = isAuth()[1];
} else {
    exit();
}

if(isset($_POST['postId']) and isset($_POST['dltPost'])){
    if(strpos(strtolower($_POST['postId']),"drop") or strpos(strtolower($_POST['postId']),"insert") or strpos(strtolower($_POST['postId']),"create") or strpos(strtolower($_POST['postId']),"delete")){
        echo "pd";
        exit();
    }
    $exst = false;
    $raw_data = $pdo->query("select * from askLantic__questions where md5(concat(quesId,'deleteBOI'))= '".$_POST['postId']."'");
    while ($data = $raw_data->fetch(PDO::FETCH_ASSOC)){
        $pData = $data;
        $exst = true;
    }
    if(!$exst){
        echo "pd";
        exit();
    }
    if($userData['userId'] != $pData['usrId']){echo "pd"; exit();}

    $qry = "delete from askLantic__questions where quesId=".$pData['quesId'];
    $raw_data = $pdo->prepare($qry);
    $raw_data->execute(array());

    echo "dl";
}

if(isset($_POST['postId']) and isset($_POST['edtPost'])){
    if(strpos(strtolower($_POST['postId']),"drop") or strpos(strtolower($_POST['postId']),"insert") or strpos(strtolower($_POST['postId']),"create") or strpos(strtolower($_POST['postId']),"delete")){
        echo "pd";
        exit();
    }
    $exst = false;
    $raw_data = $pdo->query("select * from askLantic__questions where md5(concat(quesId,'editBOI'))= '".$_POST['postId']."'");
    while ($data = $raw_data->fetch(PDO::FETCH_ASSOC)){
        $pData = $data;
        $exst = true;
    }
    if(!$exst){
        echo "pd";
        exit();
    }
    if($userData['userId'] != $pData['usrId']){echo "pd"; exit();}
    echo "ed".md5($pData['quesId']."editDaBOI");
}

if(isset($_POST['postId']) and isset($_POST['verifRepl'])){
    if(strpos(strtolower($_POST['postId']),"drop") or strpos(strtolower($_POST['postId']),"insert") or strpos(strtolower($_POST['postId']),"create") or strpos(strtolower($_POST['postId']),"delete")){
        echo "pd";
        exit();
    }
    $exst = false;
    $raw_data = $pdo->query("select * from askLantic__questions where concat('repl',md5(concat(quesId,'saltyBOI'))) = '".$_POST['postId']."';");
    while ($data = $raw_data->fetch(PDO::FETCH_ASSOC)){
        $pData = $data;
        $exst = true;
    }
    if(!$exst){
        echo "pd";
        exit();
    }
    if($userData['userId'] == $pData['usrId']){echo "pd";exit();}

    $raw_data = $pdo->query("select * from askLantic__questions where quesId = '".$pData['isCmnt']."';");
    while ($data = $raw_data->fetch(PDO::FETCH_ASSOC)){
        if($userData['userId'] != $data['usrId']){echo "pd";exit();}
    }

    $alrdy = $pData['view'];
    $verif = 1;
    if($alrdy == 1){$verif = 0;}
    if($alrdy == 0){
        sendNotif($pData['usrId'],"Someone verified your answer","questions.php?q=".md5($pData['isCmnt']."QuestionOfFire@314159265"));
    }
    $qry = 'update askLantic__questions SET view=:v where quesId='.$pData['quesId'].';';
    $raw_data = $pdo->prepare($qry);
    $raw_data->execute(array(':v' => $verif));

    $userExst = false;
    $raw_data = $pdo->query("select * from askLantic__userData where userId = ".$pData['usrId'].";");
    while ($data = $raw_data->fetch(PDO::FETCH_ASSOC)){
        $userExst = true;
        $userReput = $data['reput'];
    }
    if($verif == 0){
        $newReput = $userReput-5;
    }
    else{
        $newReput = $userReput+5;
    }
    

    if($userExst){
    $qry = 'update askLantic__userData SET reput=:r where userId='.$pData['usrId'].';';
    $raw_data = $pdo->prepare($qry);
    $raw_data->execute(array(':r' => $newReput));
    }
    echo "cnf".$verif;
}

if(isset($_POST['postId']) and isset($_POST['votePost'])){
    if(strpos(strtolower($_POST['postId']),"drop") or strpos(strtolower($_POST['postId']),"insert") or strpos(strtolower($_POST['postId']),"create") or strpos(strtolower($_POST['postId']),"delete") or $_POST['votePost'] != 'u' and $_POST['votePost'] != 'd'){
        echo "pd";
        exit();
    }
    $exst = false;
    $raw_data = $pdo->query("select * from askLantic__questions where concat('vote',md5(concat(quesId,'vote'))) = '".$_POST['postId']."';");
    while ($data = $raw_data->fetch(PDO::FETCH_ASSOC)){
        $pData = $data;
        $exst = true;
    }
    if(!$exst){
        echo "pd";
        exit();
    }
    elseif($pData['usrId'] == $userData['userId']){
        echo "vtSelf";
        exit();
    }
    if($userData['reput'] < 10){
        echo "rpLess";
        exit();
    }
    $crntVt = 'n';
    $exst = false;
    $raw_data = $pdo->query("select * from askLantic__votePost where uId = ".$userData['userId']." and pId = ".$pData['quesId']);
    while ($data = $raw_data->fetch(PDO::FETCH_ASSOC)){
        $exst = true;
        $crntVt = $data['vte'];
    }
    if(!$exst){
        $qry = "insert into askLantic__votePost  values(".$userData['userId'].",".$pData['quesId'].",'n')";
        $raw_data = $pdo->prepare($qry);
        $raw_data->execute();
    }
    if($_POST['votePost']==$crntVt){
        $qry = "update askLantic__votePost SET vte='n'  where uId = ".$userData['userId']." and pId = ".$pData['quesId'];
        $raw_data = $pdo->prepare($qry);
        $raw_data->execute();
        $arrDir = 'n';
        $raw_data = $pdo->query("select * from askLantic__userData where userId = ".$pData['usrId'].";");
        while ($data = $raw_data->fetch(PDO::FETCH_ASSOC)){
            $userExst = true;
            $userReput = $data['reput'];
        }
        if($crntVt == 'u'){
            $newReput = $userReput-3;
        }
        else{
            $newReput = $userReput+1;
        }
        
    
        if($userExst){
        $qry = 'update askLantic__userData SET reput=:r where userId='.$pData['usrId'].';';
        $raw_data = $pdo->prepare($qry);
        $raw_data->execute(array(':r' => $newReput));
        }

    }
    else{
        $qry = "update askLantic__votePost SET vte='".$_POST['votePost']."'  where uId = ".$userData['userId']." and pId = ".$pData['quesId'];
        $raw_data = $pdo->prepare($qry);
        $raw_data->execute();
        if($_POST['votePost'] == 'u'){

            $arrDir = 'u';
        }
        else{
            $arrDir = 'd';
        }

        $raw_data = $pdo->query("select * from askLantic__userData where userId = ".$pData['usrId'].";");
        while ($data = $raw_data->fetch(PDO::FETCH_ASSOC)){
            $userExst = true;
            $userReput = $data['reput'];
        }
        if($arrDir == 'u' and $crntVt == 'n'){
            $newReput = $userReput+3;
            if(getVoteCount($pData['quesId']) < 5){
                if($pData['isCmnt'] > 0)
                {sendNotif($pData['usrId'],"Someone upvotes your post","questions.php?q=".md5($pData['isCmnt']."QuestionOfFire@314159265"));}
                else{
                    sendNotif($pData['usrId'],"Someone upvotes your post","questions.php?q=".md5($pData['isCmnt']."QuestionOfFire@314159265"));
                }
            }
        }
        elseif($arrDir == 'd' and $crntVt == 'n'){
            $newReput = $userReput-1;
        }
        elseif($arrDir == 'u' and $crntVt == 'd'){
            $newReput = $userReput+4;
        }
        elseif($arrDir == 'd' and $crntVt == 'u'){
            $newReput = $userReput-4;
        }
        
    
        if($userExst){
        $qry = 'update askLantic__userData SET reput=:r where userId='.$pData['usrId'].';';
        $raw_data = $pdo->prepare($qry);
        $raw_data->execute(array(':r' => $newReput));
        }
    
    }
    echo getVoteCount($pData['quesId'])."|".$arrDir;
}
if(isset($_POST['timeSpent'])){
    $qry = 'update askLantic__userData SET timeSpent=:t where userId='.$userData['userId'].';';
    $raw_data = $pdo->prepare($qry);
    $raw_data->execute(array(':t' => time()));
}
if(isset($_POST['socialClick'])){
    if(($_POST['socialClick'] == 't' or $_POST['socialClick'] == 'b' or $_POST['socialClick'] == 'g') and (strpos($userData['socialVisit'],$_POST['socialClick']) === false )){
    $qry = 'update askLantic__userData SET socialVisit=:s where userId='.$userData['userId'].';';
    $raw_data = $pdo->prepare($qry);
    $raw_data->execute(array(':s' => $userData['socialVisit'].$_POST['socialClick']));}
}
if(isset($_POST['dltNotif'])){
    $exst = false;
    $raw_data = $pdo->query("select * from askLantic__notifications where md5(concat(notifId,'DeleteMe')) = '".$_POST['dltNotif']."';");
    while ($data = $raw_data->fetch(PDO::FETCH_ASSOC)){
        $nData = $data;
        $exst = true;
    }
    if(!$exst){
        echo "pd";
        exit();
    }
    $qry = "delete from askLantic__notifications where notifId=".$nData['notifId'];
    $raw_data = $pdo->prepare($qry);
    $raw_data->execute(array());
}
?>