<?php
require_once "pdoData.php";

function isAuth(){
    if(isset($_COOKIE['userId'])){
        $pdo = $GLOBALS['pdo'];
        $raw_data = $pdo->query("select * from askLantic__userData");
        while ($data = $raw_data->fetch(PDO::FETCH_ASSOC))
        {
            if(md5(strtolower($data["usern"]).$data["paswd"]."ASKmeBOIS@69069") == $_COOKIE['userId']){
                return [true,$data];
                exit();
            }
        }
        return [false];
    }
    return [false];
}
function isValid($usr,$pwd){
    $pdo = $GLOBALS['pdo'];
    $raw_data = $pdo->query("select * from askLantic__userData");
    while ($data = $raw_data->fetch(PDO::FETCH_ASSOC))
    {
        if(strtolower($data["usern"]) == $usr){
            if($data['paswd'] == md5($pwd."ASKmeBOIS@69069")){
                return true;
            }
            return false;
        }
    }
    return [false];
}
function isValidTag($tgs){
    $rslt = preg_match_all('/\w/',$tgs);
    return !(!($rslt));
}

function arrUnique($arr){
    $rtrnArr = [];
    $arr = array_unique($arr);
    foreach($arr as $a){
        array_push($rtrnArr, $a);
    }
    return $rtrnArr;
}
function arrRemove($arr,$val){
    $rtrnArr = [];
    $val = [$val];
    $arr = array_diff($arr,$val);
    foreach($arr as $a){
        array_push($rtrnArr, $a);
    }
    return $rtrnArr;
}

function secondsToTime($inputSeconds) {

    $secondsInAMinute = 60;
    $secondsInAnHour  = 60 * $secondsInAMinute;
    $secondsInADay    = 24 * $secondsInAnHour;
    $days = floor($inputSeconds / $secondsInADay);
    $hourSeconds = $inputSeconds % $secondsInADay;
    $hours = floor($hourSeconds / $secondsInAnHour);
    $minuteSeconds = $hourSeconds % $secondsInAnHour;
    $minutes = floor($minuteSeconds / $secondsInAMinute);
    $remainingSeconds = $minuteSeconds % $secondsInAMinute;
    $seconds = ceil($remainingSeconds);
    $obj = array(
        'd' => (int) $days,
        'h' => (int) $hours,
        'm' => (int) $minutes,
        's' => (int) $seconds,
    );
    return $obj;
}
function convTime($tm){
    $stt = secondsToTime($tm);
    $tm = $stt['s'];
    $suffix = ' seconds';
    if($stt['d'] != 0){
        $tm = $stt['d'];
        $suffix = ' days';
    }
    elseif($stt['h'] != 0){
        $tm = $stt['h'];
        $suffix = ' hours';
    }
    elseif($stt['m'] != 0){
        $tm = $stt['m'];
        $suffix = ' minutes';
    }
    return $tm.$suffix." ago";
}
function getVoteCount($qId){
    $qry = "select * from askLantic__votePost where pId = ".$qId;
    $totVoteCnt = 0;
    $pdo = $GLOBALS['pdo'];
    $raw_data = $pdo->query($qry);
    while ($data = $raw_data->fetch(PDO::FETCH_ASSOC))
    {
        if($data['vte'] == 'u'){$totVoteCnt += 1;}
        elseif($data['vte'] == 'd'){$totVoteCnt -= 1;}
    }
    return $totVoteCnt;
}
function voteExst($qId,$uId){
    $qry = "select * from askLantic__votePost where pId = ".$qId." and uId = ".$uId;
    $pdo = $GLOBALS['pdo'];
    $raw_data = $pdo->query($qry);
    $exst = false;
    while ($data = $raw_data->fetch(PDO::FETCH_ASSOC))
    {
        $exst = true;
        $tsk = $data['vte'];
    }
    if(!$exst){
        return 'n';
    }
    return $tsk;
}
function toTimeStamp($date) {
    $yr=strval(substr($date,0,4));
    $mo=strval(substr($date,5,2));
    $da=strval(substr($date,8,2));
    $hr=strval(substr($date,11,2));
    $mi=strval(substr($date,14,2));
    $se=strval(substr($date,17,2));
    return mktime($hr,$mi,$se,$mo,$da,$yr);
}
function calcAchv($userData){
    $pdo = $GLOBALS['pdo'];
    $totUpvt = $totVerif = $totAns = $totQues = $twit = $gith = $bmec = $ask1 = $ask2 = $ask3 = $ans1 = $ans2 = $ans3 = $vrf1 = $vrf2 = $upv = 0;
    $timeSpent = floor(($userData['timeSpent']-toTimeStamp($userData['accCreated']))/60/60/24);
    if($timeSpent >= 31){$timeSpent = 31;}
    if(strpos($userData['socialVisit'],'t') !== false){$twit = 1;}
    if(strpos($userData['socialVisit'],'g') !== false){$gith = 1;}
    if(strpos($userData['socialVisit'],'b') !== false){$bmec = 1;}

    $raw_data = $pdo->query("select * from askLantic__questions where usrId = '".$userData['userId']."' and isCmnt is null;");
    while ($data = $raw_data->fetch(PDO::FETCH_ASSOC)){
        $ask1 = 1;
        if(getVoteCount($data['quesId']) >= 2){$totQues += 1;}
    }
    $ask3 = $ask2 = $totQues;
    if($totQues >= 5){$ask2 = 5;}
    if($totQues >= 10){$ask3 = 10;}


    $raw_data = $pdo->query("select * from askLantic__questions where usrId = '".$userData['userId']."' and isCmnt is not null;");
    while ($data = $raw_data->fetch(PDO::FETCH_ASSOC)){
        $ans1 = 1;
        if(getVoteCount($data['quesId']) >= 2){$totAns += 1;}
        if($data['view'] == 1){$vrf1 = 1;$totVerif += 1;}
        $totUpvt += getVoteCount($data['quesId']);
    }
    if($totAns >= 5){$ans2 = 5;}
    if($totAns >= 10){$ans3 = 10;}
    if($totVerif >= 10){$vrf2 = 10;}
    if($totUpvt >= 10){$upv = 10;}

    return [$vrf2,$upv,$vrf1,$ans3,$ans2,$ans1,$ask3,$ask2,$ask1,$timeSpent,$twit,$gith,$bmec];
}
function sendNotif($usr,$msg,$lnk = ''){
    $pdo = $GLOBALS['pdo'];
        $qry = "insert into askLantic__notifications (usrId,mesg,time,link) values(:u,:m,".time().",:l)";
        $raw_data = $pdo->prepare($qry);
        $raw_data->execute(array(
            ':u' => $usr,
            ':m' => htmlentities($msg),
            ':l' => $lnk
        ));
        return;
}
?>
