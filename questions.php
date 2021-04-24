<?php

use function PHPSTORM_META\type;

require_once "libs.php";
session_start();
$cmnd = "";
$quesData = [];
$askData = [];
$userData = [];
if (isset($_SESSION['cmnd'])) {
    $cmnd = $_SESSION['cmnd'];
    unset($_SESSION['cmnd']);
}
if (isset(isAuth()[1])) {
    $userData = isAuth()[1];
}
$qExist = false;
$raw_data = $pdo->query("select * from askLantic__questions where isCmnt is NULL");
while ($data = $raw_data->fetch(PDO::FETCH_ASSOC)){
    if(md5($data['quesId']."QuestionOfFire@314159265") == $_GET['q']){$quesData = $data;$qExist = true;}
}

if(! isset($_GET['q'])){header("Location: index.php");exit();}

elseif(!$qExist){echo '
    <!DOCTYPE html>
<html lang="en">
    <head>
        <title>AskLantic || Ask your stuff here</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <link href=\'https://fonts.googleapis.com/css?family=Days One\' rel=\'stylesheet\'>
        <link rel="shortcut icon" type="image/png" href="images/favicon.png">
        <link rel="stylesheet" href="css/style.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="js/index.js"></script>
    </head>
    <body onload="$(\'#ldScrn\')[0].remove()">
        <div id=\'ldScrn\'>
            <svg width="250" height="250" viewBox="0 0 604 603" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M302 603C468.514 603 603.5 468.014 603.5 301.5C603.5 134.986 468.514 0 302 0C135.486 0 0.5 134.986 0.5 301.5C0.5 468.014 135.486 603 302 603Z" fill="#3F3D56"/>
                <path opacity="0.05" d="M302 550.398C439.462 550.398 550.898 438.962 550.898 301.5C550.898 164.038 439.462 52.6021 302 52.6021C164.537 52.6021 53.1021 164.038 53.1021 301.5C53.1021 438.962 164.537 550.398 302 550.398Z" fill="black"/>
                <path opacity="0.05" d="M302 505.494C414.663 505.494 505.994 414.163 505.994 301.5C505.994 188.837 414.663 97.5064 302 97.5064C189.337 97.5064 98.0064 188.837 98.0064 301.5C98.0064 414.163 189.337 505.494 302 505.494Z" fill="black"/>
                <path opacity="0.05" d="M302 447.76C382.777 447.76 448.26 382.277 448.26 301.5C448.26 220.723 382.777 155.24 302 155.24C221.223 155.24 155.74 220.723 155.74 301.5C155.74 382.277 221.223 447.76 302 447.76Z" fill="black"/>
                <path d="M304.76 533.012C324.159 533.012 339.885 516.958 339.885 497.155C339.885 477.352 324.159 461.299 304.76 461.299C285.36 461.299 269.634 477.352 269.634 497.155C269.634 516.958 285.36 533.012 304.76 533.012Z" fill="#3895BF"/>
                <path d="M300.997 123.003C246.1 123.399 201.151 168.938 200.371 224.973C200.364 225.49 200.36 229.128 200.361 233.886C200.361 240.862 203.076 247.552 207.908 252.485C212.74 257.418 219.294 260.19 226.128 260.19C229.515 260.19 232.87 259.507 235.999 258.183C239.128 256.858 241.971 254.917 244.365 252.471C246.76 250.024 248.658 247.12 249.952 243.924C251.246 240.728 251.911 237.304 251.908 233.845C251.905 230.609 251.904 228.369 251.904 228.231C251.902 219.571 254.109 211.06 258.307 203.534C262.505 196.009 268.55 189.729 275.847 185.311C283.144 180.894 291.442 178.492 299.924 178.341C308.406 178.19 316.781 180.296 324.224 184.451C331.668 188.606 337.923 194.668 342.375 202.04C346.827 209.411 349.323 217.839 349.617 226.494C349.91 235.149 347.992 243.733 344.05 251.401C340.108 259.07 334.278 265.559 327.135 270.23L327.144 270.241C327.144 270.241 290.469 294.342 279.288 327.405L279.297 327.407C277.331 334.181 276.335 341.208 276.339 348.273C276.339 351.177 276.507 376.585 276.83 397.207C276.943 404.323 279.792 411.108 284.762 416.098C289.732 421.089 296.424 423.885 303.396 423.883C306.899 423.883 310.367 423.176 313.602 421.802C316.836 420.429 319.772 418.416 322.241 415.879C324.711 413.343 326.664 410.333 327.99 407.023C329.315 403.713 329.986 400.168 329.965 396.593C329.852 377.706 329.792 355.715 329.792 354.119C329.792 333.817 348.978 313.589 364.737 300.398C382.885 285.209 395.944 264.508 401.19 241.158C402.35 236.351 402.99 231.428 403.098 226.477C403.098 212.826 400.452 199.309 395.312 186.706C390.171 174.103 382.639 162.662 373.148 153.044C363.658 143.426 352.396 135.819 340.013 130.664C327.63 125.508 314.37 122.904 300.997 123.003Z" fill="#3895BF"/>
            </svg>
        </div>
        <div class="homeHead" style="height:60px;">
                <h1 onclick="location.href=\'index.php\'" onmouseover="this.style.cursor=\'pointer\'">AskLantic</h1>
                ';
                if($userData != []){
                $profPic = $userData["prfpc"];
                if($profPic == ""){$profPic = "images/default.png";}
                else{$profPic = "profile_picture/".$profPic;}
                echo "
                <div class='menu' onmouseover='document.getElementsByClassName(\"menuOptions\")[0].style.display=\"block\"' onmouseout='document.getElementsByClassName(\"menuOptions\")[0].style.display=\"none\"'>
                    <button class='prof'>
                        <img src='".$profPic."' alt='profile picture' onerror='this.src=\"images/default.png\"'>
                    </button>
                    <div class='menuOptions'>
                        <button onclick='location.href=\"profile.php\"'>Profile</button><br>
                        <button onclick='location.href=\"achievements.php\"'>Achievements</button><br>
                        <button onclick='location.href=\"notifications.php\"'>Notification</button><br>
                        <button onclick='lgout()'>Logout</button><br>
                    </div>
                </div>";
            }
            echo '
            <p style="color:rgb(50,120,150);">Question doesn\'t exists <br>or has been deleted by the user</p>

            <svg width="300" height="400" viewBox="0 0 928 743" fill="none" xmlns="http://www.w3.org/2000/svg">
            <g id="undraw_starry_window_ppm0 1" clip-path="url(#clip0)">
            <g id="starStat">
            <g id="Group 6">
            <path id="Vector" d="M484.631 324.745L482.028 327.331L479.442 324.727L477.707 326.451L480.292 329.054L477.689 331.64L479.412 333.375L482.016 330.79L484.601 333.393L486.337 331.669L483.751 329.066L486.354 326.481L484.631 324.745Z" fill="#E6E6E6"/>
            <g id="Group 5">
            <path id="Vector_2" d="M927.76 251.193V444.373H425.38V251.193C425.289 196.828 442.923 143.915 475.61 100.473C497.537 71.232 525.582 47.1291 557.787 29.8469C589.992 12.5647 625.581 2.51966 662.07 0.413097C666.86 0.133097 671.693 -0.00356545 676.57 0.00310122C679.34 0.00310122 682.11 0.0431006 684.85 0.143101C748.585 2.16176 809.148 28.4249 854.18 73.5731C855.54 74.9331 856.87 76.3031 858.21 77.6831C865.093 84.8926 871.544 92.5025 877.53 100.473C910.212 143.917 927.846 196.829 927.76 251.193Z" fill="#3F3D56"/>
            <path id="Vector_3" d="M802.645 243.484C839.202 243.484 868.838 213.849 868.838 177.292C868.838 140.734 839.202 111.099 802.645 111.099C766.088 111.099 736.453 140.734 736.453 177.292C736.453 213.849 766.088 243.484 802.645 243.484Z" fill="#6C63FF"/>
            <path id="Vector_4" opacity="0.2" d="M796.134 139.312C800.33 139.312 803.73 135.911 803.73 131.716C803.73 127.521 800.33 124.12 796.134 124.12C791.939 124.12 788.539 127.521 788.539 131.716C788.539 135.911 791.939 139.312 796.134 139.312Z" fill="black"/>
            <path id="Vector_5" opacity="0.2" d="M809.156 215.271C813.351 215.271 816.752 211.87 816.752 207.675C816.752 203.48 813.351 200.079 809.156 200.079C804.961 200.079 801.56 203.48 801.56 207.675C801.56 211.87 804.961 215.271 809.156 215.271Z" fill="black"/>
            <path id="Vector_6" opacity="0.2" d="M838.454 170.781C841.451 170.781 843.88 168.352 843.88 165.355C843.88 162.359 841.451 159.93 838.454 159.93C835.458 159.93 833.029 162.359 833.029 165.355C833.029 168.352 835.458 170.781 838.454 170.781Z" fill="black"/>
            <path id="Vector_7" opacity="0.2" d="M776.602 200.079C786.191 200.079 793.964 192.306 793.964 182.717C793.964 173.128 786.191 165.355 776.602 165.355C767.013 165.355 759.24 173.128 759.24 182.717C759.24 192.306 767.013 200.079 776.602 200.079Z" fill="black"/>
            <path id="Vector_8" d="M684.853 0.145036V444.371H662.065V0.414293C666.861 0.134666 671.695 -0.0034319 676.567 1.43038e-06C679.343 1.43038e-06 682.108 0.0414162 684.853 0.145036Z" fill="white"/>
            <path id="Vector_9" d="M877.528 100.476H475.605C481.588 92.504 488.039 84.8945 494.924 77.6873H858.21C865.094 84.8945 871.545 92.504 877.528 100.476V100.476Z" fill="white"/>
            <path id="Vector_10" d="M871.619 297.631C874.499 297.631 876.834 295.296 876.834 292.415C876.834 289.535 874.499 287.2 871.619 287.2C868.738 287.2 866.403 289.535 866.403 292.415C866.403 295.296 868.738 297.631 871.619 297.631Z" fill="#E6E6E6"/>
            <path id="Vector_11" d="M534.619 254.631C537.499 254.631 539.834 252.296 539.834 249.415C539.834 246.535 537.499 244.2 534.619 244.2C531.738 244.2 529.403 246.535 529.403 249.415C529.403 252.296 531.738 254.631 534.619 254.631Z" fill="#E6E6E6"/>
            <path id="Vector_12" d="M772.631 272.745L770.028 275.331L767.442 272.727L765.707 274.451L768.292 277.054L765.689 279.64L767.412 281.375L770.016 278.79L772.601 281.393L774.337 279.669L771.751 277.066L774.354 274.481L772.631 272.745Z" fill="#E6E6E6"/>
            <path id="Vector_13" d="M743.631 354.745L741.028 357.331L738.442 354.727L736.707 356.451L739.292 359.054L736.689 361.64L738.412 363.375L741.016 360.79L743.601 363.393L745.337 361.669L742.751 359.066L745.354 356.481L743.631 354.745Z" fill="#E6E6E6"/>
            <path id="Vector_14" d="M567.631 124.745L565.028 127.331L562.442 124.727L560.707 126.451L563.292 129.054L560.689 131.64L562.412 133.375L565.016 130.79L567.601 133.393L569.337 131.669L566.751 129.066L569.354 126.481L567.631 124.745Z" fill="#E6E6E6"/>
            </g>
            </g>
            <g id="Group 4">
            <path id="Vector_15" d="M227.324 249.928L224.793 286.623L256.427 290.419C256.427 290.419 256.427 260.051 258.958 256.255C261.488 252.459 227.324 249.928 227.324 249.928Z" fill="#FFB8B8"/>
            <g id="Group 3">
            <path id="Vector_16" d="M303.245 448.589L299.449 465.039C299.449 465.039 300.714 503 290.592 499.204C280.469 495.408 282.999 462.508 282.999 462.508L291.857 446.059L303.245 448.589Z" fill="#FFB8B8"/>
            <path id="Vector_17" d="M297.478 297.715L256.487 280.399C256.487 280.399 236.9 265.313 225.427 276.489L220.278 283.864C220.278 283.864 174.741 301.619 174.753 315.538L192.529 385.117C192.529 385.117 182.441 424.352 197.627 426.87L279.882 434.39C279.882 434.39 291.258 420.461 281.12 402.755L284.879 360.995L297.478 297.715Z" fill="#327896"/>
            <path id="Vector_18" d="M269.641 299.005L297.478 297.715C297.478 297.715 306.337 300.238 312.685 324.275C319.033 348.311 320.333 387.536 320.333 387.536L305.21 458.409L286.228 455.895L293.76 387.559L281.067 342.017L269.641 299.005Z" fill="#327896"/>
            <path id="Vector_19" d="M189.93 306.667L176.209 310.954C176.209 310.954 164.641 328.2 164.649 337.058C164.657 345.915 159.654 412.984 159.654 412.984L192.601 467.366L202.701 440.784L182.425 406.637L198.838 364.866L189.93 306.667Z" fill="#327896"/>
            <g id="Group 2">
            <path id="Vector_20" d="M283.632 431.507L192.657 423.503C192.657 423.503 183.669 480.856 184.934 503.633C186.199 526.409 187.465 561.839 187.465 561.839L177.342 716.213L216.568 711.152L221.63 583.35L238.079 513.755L257.06 602.331L269.713 716.213L303.878 712.417L292.49 574.493C292.49 574.493 302.613 450.487 283.632 431.507Z" fill="#2F2E41"/>
            <path id="Vector_21" d="M296.286 706.09L307.674 709.886C307.674 709.886 331.716 703.559 325.389 720.009C319.062 736.459 301.347 733.928 301.347 733.928C301.347 733.928 279.836 750.378 270.979 737.724L276.04 711.152L296.286 706.09Z" fill="#2F2E41"/>
            <path id="Vector_22" d="M203.914 706.09L215.303 709.886C215.303 709.886 239.345 703.559 233.018 720.009C226.691 736.459 208.976 733.928 208.976 733.928C208.976 733.928 187.465 750.378 178.607 737.724L183.669 711.152L203.914 706.09Z" fill="#2F2E41"/>
            </g>
            </g>
            </g>
            </g>
            <g id="starHead">
            <path id="Vector_23" d="M246.937 268.276C260.913 268.276 272.244 256.945 272.244 242.968C272.244 228.992 260.913 217.661 246.937 217.661C232.96 217.661 221.63 228.992 221.63 242.968C221.63 256.945 232.96 268.276 246.937 268.276Z" fill="#FFB8B8"/>
            <path id="Vector_24" d="M227.324 265.112C227.324 265.112 200.751 246.132 214.67 223.355C224.326 207.554 244.335 208.805 255.685 211.053C258.743 211.618 261.618 212.917 264.062 214.84C266.506 216.763 268.445 219.251 269.713 222.09C271.611 226.519 271.611 230.948 264.019 230.948C248.835 230.948 256.427 242.336 256.427 242.336C256.427 242.336 246.304 244.866 248.835 253.724C251.365 262.582 227.324 265.112 227.324 265.112Z" fill="#2F2E41"/>
            </g>
            <g id="starShot">
            <path id="Vector_25" opacity="0.8" d="M649.923 324.899L682.893 286.3L715.864 247.701L734.476 225.912C735.506 224.706 733.917 222.826 732.887 224.031L699.917 262.63L666.946 301.228L648.334 323.018C647.304 324.223 648.893 326.104 649.923 324.899V324.899Z" fill="url(#paint0_linear)"/>
            <path id="Vector_26" opacity="0.8" d="M680.923 54.2554L713.893 15.6568L746.864 -22.9417L765.476 -44.7313C766.506 -45.9368 764.917 -47.8177 763.887 -46.6121L730.917 -8.01356L697.946 30.585L679.334 52.3744C678.304 53.58 679.893 55.4609 680.923 54.2553V54.2554Z" fill="url(#paint1_linear)"/>
            </g>
            </g>
            <defs>
            <linearGradient id="paint0_linear" x1="648" y1="274.465" x2="734.81" y2="274.465" gradientUnits="userSpaceOnUse">
            <stop stop-color="white"/>
            <stop offset="1" stop-color="white" stop-opacity="0.3"/>
            </linearGradient>
            <linearGradient id="paint1_linear" x1="63682.4" y1="22047.5" x2="71218.4" y2="22047.5" gradientUnits="userSpaceOnUse">
            <stop stop-color="white"/>
            <stop offset="1" stop-color="white" stop-opacity="0.3"/>
            </linearGradient>
            <clipPath id="clip0">
            <rect width="927.76" height="742.508" fill="white"/>
            </clipPath>
            </defs>
            </svg>

            </body></html>';exit();}
$qry = 'update askLantic__questions SET view=:v where quesId='.$quesData['quesId'].';';
$raw_data = $pdo->prepare($qry);
$raw_data->execute(array(':v' => $quesData['view']+1));

$raw_data = $pdo->query("select * from askLantic__userData where userId = ".$quesData['usrId']);
while ($data = $raw_data->fetch(PDO::FETCH_ASSOC)){
    $askData = $data;
}
$cmnts = [];
$raw_data = $pdo->query("select * from askLantic__questions where isCmnt = ".$quesData['quesId']);
while ($data = $raw_data->fetch(PDO::FETCH_ASSOC)){
    array_push($cmnts,$data);
}

if(isset($_POST['repl']) and (strlen($_POST['repl']) > 0 or strlen($_POST['repl']) < 1500)){
    $rprt = array(
        "spm" => 0,
        "abs" => 0,
        "typ" => 0,
        "inv" => 0,
        'rptr' => ''
    );

    $qry = "insert into askLantic__questions (ques,usrId,rprt,isCmnt,view,time) VALUES (:qst,:usr,:rpt,:qId,0,:tme)";
    $raw_data = $pdo->prepare($qry);
    $raw_data->execute(array(
        ':qst' => $_POST["repl"],
        ':usr' => $userData['userId'],
        ':qId' => $quesData["quesId"],
        ':rpt' => json_encode($rprt),
        ':tme' => time()
    ));
    if($userData['userId'] != $quesData['usrId']){
        sendNotif($quesData['usrId'],"Someone replied your question","questions.php?q=".$_GET['q']);
    }
    $_SESSION['cmnd'] = "displayErr('Reply posted');";
    header("Location: questions.php"."?q=".$_GET['q']."#".md5($pdo->lastInsertId()."IamTheQuestion"));
}
if(isset($_POST['replyEdit']) and isset($_POST['replId'])){
    $exst = false;
    if(strpos(strtolower($_POST['replId']),"drop") or strpos(strtolower($_POST['replId']),"insert") or strpos(strtolower($_POST['replId']),"create") or strpos(strtolower($_POST['replId']),"delete")){
        header("Location: index.php");exit();
    }
    $raw_data = $pdo->query("select * from askLantic__questions where concat('ed',md5(concat(quesId,'editDaBOI')))= '".$_POST['replId']."'");
    while ($data = $raw_data->fetch(PDO::FETCH_ASSOC)){
        $rData = $data;
        $exst = true;
    }
    if(!$exst){header("Location: index.php");exit();}
    if($rData['usrId'] != $userData['userId']){header("Location: index.php");exit();}
    $qry = 'update askLantic__questions SET ques=:qs where quesId='.$rData['quesId'].';';
    $raw_data = $pdo->prepare($qry);
    $raw_data->execute(array(':qs' => $_POST['replyEdit']));
    $_SESSION['cmnd'] = "displayErr('Reply edited');";
    header("Location: questions.php?q=".$_GET['q']);
}

if(isset($_POST['report'])){
    if(! isset($_POST['rprt'])){header("Location: index.php");exit();}
    if(isset($_POST['replId']) and $_POST['replId'] != ""){
        if(strpos(strtolower($_POST['replId']),"drop") or strpos(strtolower($_POST['replId']),"insert") or strpos(strtolower($_POST['replId']),"create") or strpos(strtolower($_POST['replId']),"delete")){
            header("Location: index.php");
            exit();
        }
        $exst = false;
        $raw_data = $pdo->query("select * from askLantic__questions where md5(concat(quesId,'IamBad')) = '".$_POST['replId']."'");
        while ($data = $raw_data->fetch(PDO::FETCH_ASSOC)){
            $exst = true;
            $quesData = $data;
        }
        if(!$exst){
            header("Location: index.php");
            exit();    
        }
    }
    $rprtData = get_object_vars(json_decode($quesData['rprt']));
    $validArr = ['spm','abs','typ','inv'];
    if(in_array($userData['userId'],(explode(" ",$rprtData['rptr'])))){
        $_SESSION['cmnd'] = "displayErr(\"You have already reported this post, you can't report it again\");";
        header("Location: questions.php?q=".$_GET['q']);
        exit();
    }
    if(!in_array($_POST['rprt'],$validArr)){
        header("Location: index.php");
        exit();
    }
    if($userData['userId'] == $quesData['usrId']){
        header("Location: index.php");
        exit();
    }
    $dueTo = "";
    $spm = $rprtData['spm'];
    $abs = $rprtData['abs'];
    $typ = $rprtData['typ'];
    $inv = $rprtData['inv'];
    if($_POST['rprt'] == "spm"){$spm += 1; $dueTo = "spam";}
    elseif($_POST['rprt'] == "abs"){$abs += 1; $dueTo = "abuse";}
    elseif($_POST['rprt'] == "typ"){$typ += 1; $dueTo = "a typo";}
    elseif($_POST['rprt'] == "inv"){$inv += 1; $dueTo = "invalid";}
    $rprt = array(
        "spm" => $spm,
        "abs" => $abs,
        "typ" => $typ,
        "inv" => $inv,
        'rptr' => $rprtData['rptr']." ".$userData['userId']
    );
    $qry = 'update askLantic__questions SET rprt=:rprt where quesId='.$quesData['quesId'].';';
    $raw_data = $pdo->prepare($qry);
    $raw_data->execute(array(':rprt' => json_encode($rprt)));
    sendNotif($quesData['usrId'],"Someone reported your post and marked it ".$dueTo,"questions.php?q=".$_GET['q']);
    if($spm+($inv/2)+$abs > 12){
        sendNotif($quesData['usrId'],"Question deleted due to too many reports");
        $qry = "delete from askLantic__questions where quesId=".$quesData['quesId'];
        $raw_data = $pdo->prepare($qry);
        $raw_data->execute(array());    
    }
    $_SESSION['cmnd'] = "displayErr('Question reported successfully');";
    header("Location: questions.php?q=".$_GET['q']);
}

$quesVote = getVoteCount($quesData['quesId'],"not");
?>
<!DOCTYPE html>
<html lang='en'>
    <head>
        <title>AskLantic || Ask your stuff here</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <link href='https://fonts.googleapis.com/css?family=Days One' rel='stylesheet'>
        <link rel="shortcut icon" type="image/png" href="images/favicon.png">
        <link rel="stylesheet" href="css/style.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="js/index.js"></script>
    </head>
    <body onload="$('#ldScrn')[0].remove()">
        <div id='ldScrn'>
            <svg width="250" height="250" viewBox="0 0 604 603" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M302 603C468.514 603 603.5 468.014 603.5 301.5C603.5 134.986 468.514 0 302 0C135.486 0 0.5 134.986 0.5 301.5C0.5 468.014 135.486 603 302 603Z" fill="#3F3D56"/>
                <path opacity="0.05" d="M302 550.398C439.462 550.398 550.898 438.962 550.898 301.5C550.898 164.038 439.462 52.6021 302 52.6021C164.537 52.6021 53.1021 164.038 53.1021 301.5C53.1021 438.962 164.537 550.398 302 550.398Z" fill="black"/>
                <path opacity="0.05" d="M302 505.494C414.663 505.494 505.994 414.163 505.994 301.5C505.994 188.837 414.663 97.5064 302 97.5064C189.337 97.5064 98.0064 188.837 98.0064 301.5C98.0064 414.163 189.337 505.494 302 505.494Z" fill="black"/>
                <path opacity="0.05" d="M302 447.76C382.777 447.76 448.26 382.277 448.26 301.5C448.26 220.723 382.777 155.24 302 155.24C221.223 155.24 155.74 220.723 155.74 301.5C155.74 382.277 221.223 447.76 302 447.76Z" fill="black"/>
                <path d="M304.76 533.012C324.159 533.012 339.885 516.958 339.885 497.155C339.885 477.352 324.159 461.299 304.76 461.299C285.36 461.299 269.634 477.352 269.634 497.155C269.634 516.958 285.36 533.012 304.76 533.012Z" fill="#3895BF"/>
                <path d="M300.997 123.003C246.1 123.399 201.151 168.938 200.371 224.973C200.364 225.49 200.36 229.128 200.361 233.886C200.361 240.862 203.076 247.552 207.908 252.485C212.74 257.418 219.294 260.19 226.128 260.19C229.515 260.19 232.87 259.507 235.999 258.183C239.128 256.858 241.971 254.917 244.365 252.471C246.76 250.024 248.658 247.12 249.952 243.924C251.246 240.728 251.911 237.304 251.908 233.845C251.905 230.609 251.904 228.369 251.904 228.231C251.902 219.571 254.109 211.06 258.307 203.534C262.505 196.009 268.55 189.729 275.847 185.311C283.144 180.894 291.442 178.492 299.924 178.341C308.406 178.19 316.781 180.296 324.224 184.451C331.668 188.606 337.923 194.668 342.375 202.04C346.827 209.411 349.323 217.839 349.617 226.494C349.91 235.149 347.992 243.733 344.05 251.401C340.108 259.07 334.278 265.559 327.135 270.23L327.144 270.241C327.144 270.241 290.469 294.342 279.288 327.405L279.297 327.407C277.331 334.181 276.335 341.208 276.339 348.273C276.339 351.177 276.507 376.585 276.83 397.207C276.943 404.323 279.792 411.108 284.762 416.098C289.732 421.089 296.424 423.885 303.396 423.883C306.899 423.883 310.367 423.176 313.602 421.802C316.836 420.429 319.772 418.416 322.241 415.879C324.711 413.343 326.664 410.333 327.99 407.023C329.315 403.713 329.986 400.168 329.965 396.593C329.852 377.706 329.792 355.715 329.792 354.119C329.792 333.817 348.978 313.589 364.737 300.398C382.885 285.209 395.944 264.508 401.19 241.158C402.35 236.351 402.99 231.428 403.098 226.477C403.098 212.826 400.452 199.309 395.312 186.706C390.171 174.103 382.639 162.662 373.148 153.044C363.658 143.426 352.396 135.819 340.013 130.664C327.63 125.508 314.37 122.904 300.997 123.003Z" fill="#3895BF"/>
            </svg>
        </div>
        <div id='edtR'>
            <button class="cls" onclick="edtR.style.opacity='0';setTimeout(() => {edtR.style.display = 'none';},100);replBdy.value=''">Close</button>
            <div class="edtRepl">
                <form method="post">
                    <button type="button" onclick="insrtInBdy('[B] insert text here [!]',replBdy)"><b>B</b></button><button type="button" onclick="insrtInBdy('[I] insert text here [!]',replBdy)"><i>I</i></button><button type="button" onclick="insrtInBdy('[U] insert text here [!]',replBdy)"><u>U</u></button><button type="button" onclick="insrtInBdy('[C] insert text here [!]',replBdy)">&lt;Code&gt;</button><button type="button" onclick="insrtInBdy('[>] insert text here [!]',replBdy)">Quote</button>
                    <span id='edtWrdCnt'>0/1500</span><br>
                    <textarea placeholder="Edit your reply" id="replBdy" rows="10" name='replyEdit'></textarea>
                    <input type='hidden'  name='replId'></input>
                    <span id='edtRpw'></span>
                    <button type="submit" onclick='return submRelp(replBdy)'>Edit Reply</button>
                </form>
            </div>
        </div>
        <div id='rprt'>
            <button class="cls" onclick="rprt.style.opacity='0';setTimeout(() => {rprt.style.display = 'none';},100);">Cancel</button>
            <h1 style="color:rgb(50,120,150);text-shadow:rgb(10,50,150) 1px 1px;">Reason for reporting</h1>
            <div class='main'>
                <form method="post">
                    <input type='hidden' name='replId'>
                    <div onclick="spm.click();"><input type='radio' name='rprt' id='spm' value="spm"><span></span></div><label for='spm'>Spam</label><br>
                    <div onclick="abs.click();"><input type='radio' name='rprt' id='abs' value="abs"><span></span></div><label for='abs'>Abuse or hateful</label><br>
                    <div onclick="typ.click();"><input type='radio' name='rprt' id='typ' value="typ"><span></span></div><label for='typ'>Typo error</label><br>
                    <div onclick="inv.click();"><input type='radio' name='rprt' id='inv' value="inv"><span></span></div><label for='inv'>Invalid or wrong question</label><br>
                    <button class="subm" onclick="return canRprt()" name='report'>Report</button>
                </form>
            </div>
        </div>
        <div class="homeHead" style="height:60px;">
                <h1 onclick="location.href='index.php'" onmouseover="this.style.cursor='pointer'">AskLantic</h1>
                <?php
                if($userData != []){
                $profPic = $userData["prfpc"];
                if($profPic == ""){$profPic = "images/default.png";}
                else{$profPic = "profile_picture/".$profPic;}
                echo "
                <div class='menu' onmouseover='document.getElementsByClassName(\"menuOptions\")[0].style.display=\"block\"' onmouseout='document.getElementsByClassName(\"menuOptions\")[0].style.display=\"none\"'>
                    <button class='prof'>
                        <img src='".$profPic."' alt='profile picture'  onerror='this.src=\"images/default.png\"'>
                    </button>
                    <div class='menuOptions'>
                        <button onclick='location.href=\"profile.php\"'>Profile</button><br>
                        <button onclick='location.href=\"achievements.php\"'>Achievements</button><br>
                        <button onclick='location.href=\"notifications.php\"'>Notification</button><br>
                        <button onclick='lgout()'>Logout</button><br>
                    </div>
                </div>";
            }
            ?>

        </div>
        <div id="err" style="position:fixed;color:green;border-color:green;background:rgba(120,255,120,0.5);"></div>
        <div class="dispQues">
            <span class="view" style="font-family:arial;position:absolute;margin-top:-25px;">Views: <span id='vw' style='font-family:arial;'><?php if($quesData['view'] <1000){echo $quesData['view'];} else{echo round($quesData['view']/1000,1) . "K";} ?></span>
    <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" style="margin-left:1px;transform:translateY(4px);"
        width="20px"viewBox="0 0 54.309 54.309" fill="rgb(50,70,150)"
        xml:space="preserve">
    <g>
	<path d="M53.583,25.903c-5.448-9.413-15.575-15.26-26.429-15.26c-10.854,0-20.981,5.847-26.429,15.26L0,27.154l0.725,1.252
		c5.447,9.414,15.574,15.26,26.429,15.26c10.854,0,20.98-5.846,26.429-15.26l0.726-1.252L53.583,25.903z M37.602,22.885
		c0,1.155-0.313,2.234-0.852,3.167c-1.098,1.903-3.148,3.188-5.505,3.188c-3.51,0-6.356-2.846-6.356-6.355
		c0-2.778,1.785-5.133,4.267-5.998c0.654-0.228,1.355-0.358,2.089-0.358C34.756,16.529,37.602,19.375,37.602,22.885z M19.154,31.902
		c0.207-1.277,1.306-2.254,2.642-2.254c1.483,0,2.685,1.202,2.685,2.686c0,1.222-0.821,2.24-1.938,2.566
		c-0.239,0.069-0.486,0.118-0.747,0.118c-1.483,0-2.685-1.202-2.685-2.685C19.111,32.186,19.132,32.044,19.154,31.902z
		 M5.827,27.154c2.187-3.318,5.102-6.031,8.452-7.993c-1.198,2.126-1.889,4.574-1.889,7.183c0,3.778,1.446,7.215,3.797,9.821
		C12.031,34.18,8.419,31.09,5.827,27.154z M37.844,36.303c2.426-2.621,3.922-6.113,3.922-9.958c0-2.667-0.727-5.163-1.975-7.321
		c3.451,1.972,6.452,4.734,8.689,8.13C45.83,31.179,42.116,34.324,37.844,36.303z"/></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g></svg>
        </span>
        <span class="view" style="font-family:arial;margin-top:-20px;float:right;">Asked: <?= convTime(time()-$quesData['time']) ?></span>
        <span class="titl" style="text-align:center;"><?= $quesData['titl'] ?></span><hr>
            <div class="vote">
                <svg width="50" height="50" viewBox="0 0 139 139" xmlns="http://www.w3.org/2000/svg" class="voteArr" id="upvt" onclick="votePost('u','vote<?= md5($quesData['quesId'].'vote') ?>',quesUpvt,quesDwvt,vote)">
                <g id="Frame 1">
                    <path class="arrTop" d="M19 94H119L69 44L19 94Z" stroke="black" stroke-width="2px" id='quesUpvt'>
                </g>
                </svg>

                <svg width="50" height="50" viewBox="0 0 139 139" xmlns="http://www.w3.org/2000/svg" class="voteArr" style="transform:rotate(180deg);" id="dwvt"  onclick="votePost('d','vote<?= md5($quesData['quesId'].'vote') ?>',quesUpvt,quesDwvt,vote)">
                <g id="Frame 1">
                    <path class="arrTop" d="M19 94H119L69 44L19 94Z" stroke="black" stroke-width="2px"  id='quesDwvt'/>
                </g>
                </svg>

                <span id="vote"><?= $quesVote; ?></span>
            </div><hr>
            <span class="desc"><?= $quesData['ques'] ?></span><br>
            <h1 style="margin-top:25px;display:inline-block;font-size:25px;color:rgb(50,120,150);">Tags: </h1>
            <div id="tag" style="display:inline-block;transform:translateY(-5px);"></div>
        </div>
        <div class="dispUser">
            <div class="quesTask">
            <?php
            if($userData != [] and $askData['userId'] == $userData['userId']){
            echo '
                <a onclick="if(confirm(\'Are you sure you want to delete the question? You will not be able to retrieve it later.\')){pDlt(\''.md5($quesData['quesId']."deleteBOI").'\')}">Delete <svg viewBox="-40 0 427 427.00131" width="20px" xmlns="http://www.w3.org/2000/svg" ><path d="m232.398438 154.703125c-5.523438 0-10 4.476563-10 10v189c0 5.519531 4.476562 10 10 10 5.523437 0 10-4.480469 10-10v-189c0-5.523437-4.476563-10-10-10zm0 0"/><path d="m114.398438 154.703125c-5.523438 0-10 4.476563-10 10v189c0 5.519531 4.476562 10 10 10 5.523437 0 10-4.480469 10-10v-189c0-5.523437-4.476563-10-10-10zm0 0"/><path d="m28.398438 127.121094v246.378906c0 14.5625 5.339843 28.238281 14.667968 38.050781 9.285156 9.839844 22.207032 15.425781 35.730469 15.449219h189.203125c13.527344-.023438 26.449219-5.609375 35.730469-15.449219 9.328125-9.8125 14.667969-23.488281 14.667969-38.050781v-246.378906c18.542968-4.921875 30.558593-22.835938 28.078124-41.863282-2.484374-19.023437-18.691406-33.253906-37.878906-33.257812h-51.199218v-12.5c.058593-10.511719-4.097657-20.605469-11.539063-28.03125-7.441406-7.421875-17.550781-11.5546875-28.0625-11.46875h-88.796875c-10.511719-.0859375-20.621094 4.046875-28.0625 11.46875-7.441406 7.425781-11.597656 17.519531-11.539062 28.03125v12.5h-51.199219c-19.1875.003906-35.394531 14.234375-37.878907 33.257812-2.480468 19.027344 9.535157 36.941407 28.078126 41.863282zm239.601562 279.878906h-189.203125c-17.097656 0-30.398437-14.6875-30.398437-33.5v-245.5h250v245.5c0 18.8125-13.300782 33.5-30.398438 33.5zm-158.601562-367.5c-.066407-5.207031 1.980468-10.21875 5.675781-13.894531 3.691406-3.675781 8.714843-5.695313 13.925781-5.605469h88.796875c5.210937-.089844 10.234375 1.929688 13.925781 5.605469 3.695313 3.671875 5.742188 8.6875 5.675782 13.894531v12.5h-128zm-71.199219 32.5h270.398437c9.941406 0 18 8.058594 18 18s-8.058594 18-18 18h-270.398437c-9.941407 0-18-8.058594-18-18s8.058593-18 18-18zm0 0"/><path d="m173.398438 154.703125c-5.523438 0-10 4.476563-10 10v189c0 5.519531 4.476562 10 10 10 5.523437 0 10-4.480469 10-10v-189c0-5.523437-4.476563-10-10-10zm0 0"/></svg></a> <a>|</a>
                <a href="edit_question.php?q='.$_GET['q'].'">Edit
<svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
	 viewBox="0 0 306.637 306.637" style="enable-background:new 0 0 306.637 306.637;" xml:space="preserve" width="20px">
<g>
	<g>
		<path d="M12.809,238.52L0,306.637l68.118-12.809l184.277-184.277l-55.309-55.309L12.809,238.52z M60.79,279.943l-41.992,7.896
			l7.896-41.992L197.086,75.455l34.096,34.096L60.79,279.943z"/>
		<path d="M251.329,0l-41.507,41.507l55.308,55.308l41.507-41.507L251.329,0z M231.035,41.507l20.294-20.294l34.095,34.095
			L265.13,75.602L231.035,41.507z"/></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g></svg></a><a>|</a>';
            }
        elseif($userData != []){echo '
            <a onclick="rprtQues()">Report <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="20px"
	 viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve">
<g>
	<g>
		<path d="M424.385,20.69C401.182,6.768,376.445,0,348.761,0c-33.122,0-65.635,9.753-97.077,19.185
			c-30.716,9.214-59.729,17.917-88.446,17.919c-0.004,0-0.007,0-0.011,0c-19.199,0-36.583-4.064-52.894-12.382V15
			c0-8.284-6.716-15-15-15s-15,6.716-15,15v18.551v203.896V497c0,8.284,6.716,15,15,15s15-6.716,15-15V261.453
			c16.567,6.4,34.052,9.547,52.906,9.547c33.121,0,65.631-9.753,97.071-19.185c30.718-9.215,59.733-17.919,88.451-17.919
			c22.092,0,41.779,5.369,60.188,16.415c4.633,2.78,10.404,2.854,15.108,0.191c4.703-2.663,7.609-7.649,7.609-13.053V33.552
			C431.667,28.283,428.903,23.4,424.385,20.69z M251.691,223.081C220.972,232.296,191.957,241,163.24,241
			c-19.206,0-36.594-4.058-52.906-12.376V57.566c16.564,6.399,34.046,9.539,52.894,9.538c0.003,0,0.01,0,0.014,0
			c33.118-0.002,65.626-9.754,97.063-19.185C291.024,38.704,320.042,30,348.761,30c19.206,0,36.594,4.058,52.905,12.375v171.06
			c-16.566-6.4-34.052-9.539-52.905-9.539C315.641,203.896,283.13,213.649,251.691,223.081z"/></g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g></svg></a><a>|</a>';}
            ?>
            <a onclick="cpyTxt(location.hostname+'/askLantic/questions.php?q=<?= $_GET['q'] ?>')">
            Share
            <svg fill="#000000" xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 24 24" width="20px" height="20px"><path d="M 20 0 C 17.789063 0 16 1.789063 16 4 C 16 4.277344 16.039063 4.550781 16.09375 4.8125 L 7 9.375 C 6.265625 8.535156 5.203125 8 4 8 C 1.789063 8 0 9.789063 0 12 C 0 14.210938 1.789063 16 4 16 C 5.203125 16 6.265625 15.464844 7 14.625 L 16.09375 19.1875 C 16.039063 19.449219 16 19.722656 16 20 C 16 22.210938 17.789063 24 20 24 C 22.210938 24 24 22.210938 24 20 C 24 17.789063 22.210938 16 20 16 C 18.796875 16 17.734375 16.535156 17 17.375 L 7.90625 12.8125 C 7.960938 12.550781 8 12.277344 8 12 C 8 11.722656 7.960938 11.449219 7.90625 11.1875 L 17 6.625 C 17.734375 7.464844 18.796875 8 20 8 C 22.210938 8 24 6.210938 24 4 C 24 1.789063 22.210938 0 20 0 Z"/></svg>
            </a>
            </div>
            <span>
            <span onclick="location.href = 'profile.php?u=<?= md5($askData['userId'].'LookAtMe') ?>'"><?= $askData['usern'] ?>
            <img src="profile_picture/<?= $askData['prfpc'] ?>" onerror='this.src="images/default.png"' alt="profile picture of asker"></span>
            </span>
        </div>
        <hr>
        <div class="dispRepl">
            <?php
                foreach($cmnts as $cmnt){
                    $cmntVote = getVoteCount($cmnt['quesId'],"");
                    $verif=$cmnt['view'];
                    $raw_data = $pdo->query("select * from askLantic__userData where userId = ".$cmnt['usrId']);
                    while ($data = $raw_data->fetch(PDO::FETCH_ASSOC)){
                        $replData = $data;
                    }
                    echo "<div class='replies' id='".md5($cmnt['quesId'].'IamTheQuestion')."'>";
                    echo '<div class="vote">
                    <svg width="50" height="50" viewBox="0 0 139 139" fill="none" xmlns="http://www.w3.org/2000/svg" class="voteArr" id="upvt" onclick="votePost(\'u\',\'vote'. md5($cmnt['quesId'].'vote') .'\',quesUpvt,quesDwvt,vote'.md5($cmnt['quesId']."votesCount").')">
                    <g id="Frame 1">
                        <path class="arrTop" id="upvt'.md5("voteDir".$cmnt['quesId']).'" d="M19 94H119L69 44L19 94Z" stroke="black" stroke-width="2px"/>
                    </g>
                    </svg>

                    <svg width="50" height="50" viewBox="0 0 139 139" fill="none" xmlns="http://www.w3.org/2000/svg" class="voteArr" style="transform:rotate(180deg);" id="dwvt"  onclick="votePost(\'d\',\'vote'. md5($cmnt['quesId'].'vote') .'\',quesUpvt,quesDwvt,vote'.md5($cmnt['quesId']."votesCount").')">
                    <g id="Frame 1">
                        <path class="arrTop" id="dwvt'.md5("voteDir".$cmnt['quesId']).'" d="M19 94H119L69 44L19 94Z" stroke="black" stroke-width="2px"/>
                    </g>
                    </svg><br>
                    <span id="vote'.md5($cmnt['quesId']."votesCount").'">'.$cmntVote.'</span>
                    </div>
                    ';
                    if($userData != [] and $quesData['usrId'] == $userData['userId'] and $cmnt['usrId'] != $userData['userId']){
                        echo'
                        <div class="verif">
                            <button id="repl'.md5($cmnt['quesId'].'saltyBOI').'" onclick="confThis(this.id)"';
                            if($askData['userId'] != $userData['userId']){echo "style='border:none;transform:scale(1)'";}
                            echo '>';
                            if($verif == "0"){
                            echo '<svg width="50" height="50" viewBox="0 0 458 361" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M165.074 360.906C155.104 360.906 145.755 357.029 138.726 349.981L10.9137 222.169C-3.63919 207.639 -3.63919 183.994 10.9137 169.445L41.0335 139.325C55.563 124.772 79.2275 124.772 93.757 139.325L165.074 210.643L364.227 11.5128C378.757 -3.04003 402.421 -3.04003 416.951 11.5128L447.071 41.6327C454.123 48.6849 458 58.0344 458 67.9847C458 77.931 454.123 87.304 447.071 94.3327L191.446 349.958C184.397 357.01 175.044 360.906 165.074 360.906ZM67.3855 160.349C66.0203 160.349 64.659 160.86 63.6137 161.905L33.4938 192.025C31.4031 194.112 31.4031 197.478 33.4938 199.565L161.306 327.378C163.307 329.402 166.845 329.402 168.846 327.378L424.471 71.7526C426.558 69.6658 426.558 66.2996 424.471 64.2129L394.351 34.093C392.26 32.0023 388.894 32.0023 386.807 34.093L176.366 244.534C170.125 250.775 160.004 250.775 153.763 244.534L71.1339 161.925C70.112 160.86 68.7702 160.349 67.3855 160.349Z" fill="#327896"/>
                            <path d="M165.074 360.906C155.104 360.906 145.755 357.029 138.726 349.981L10.9137 222.169C-3.63919 207.639 -3.63919 183.994 10.9137 169.445L41.0335 139.325C55.563 124.772 79.2275 124.772 93.757 139.325L165.074 210.643L364.227 11.5128C378.757 -3.04003 402.421 -3.04003 416.951 11.5128L447.071 41.6327C454.123 48.6849 458 58.0344 458 67.9847C458 77.931 454.123 87.304 447.071 94.3327L191.446 349.958C184.397 357.01 175.044 360.906 165.074 360.906ZM67.3855 160.349C66.0203 160.349 64.659 160.86 63.6137 161.905L33.4938 192.025C31.4031 194.112 31.4031 197.478 33.4938 199.565L161.306 327.378C163.307 329.402 166.845 329.402 168.846 327.378L424.471 71.7526C426.558 69.6658 426.558 66.2996 424.471 64.2129L394.351 34.093C392.26 32.0023 388.894 32.0023 386.807 34.093L176.366 244.534C170.125 250.775 160.004 250.775 153.763 244.534L71.1339 161.925C70.112 160.86 68.7702 160.349 67.3855 160.349Z" stroke="black"/>
                            </svg>';}
                            else{
                                echo '
                                <svg width="50" height="50" viewBox="0 0 458 361" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M165.074 360.906C155.104 360.906 145.755 357.029 138.726 349.981L10.9137 222.169C-3.63919 207.639 -3.63919 183.994 10.9137 169.445L41.0335 139.325C55.563 124.772 79.2275 124.772 93.757 139.325L165.074 210.643L364.227 11.5128C378.757 -3.04003 402.421 -3.04003 416.951 11.5128L447.071 41.6327C454.123 48.6849 458 58.0344 458 67.9847C458 77.931 454.123 87.304 447.071 94.3327L191.446 349.958C184.397 357.01 175.044 360.906 165.074 360.906ZM67.3855 160.349C66.0203 160.349 64.659 160.86 63.6137 161.905L33.4938 192.025C31.4031 194.112 31.4031 197.478 33.4938 199.565L161.306 327.378C163.307 329.402 166.845 329.402 168.846 327.378L424.471 71.7526C426.558 69.6658 426.558 66.2996 424.471 64.2129L394.351 34.093C392.26 32.0023 388.894 32.0023 386.807 34.093L176.366 244.534C170.125 250.775 160.004 250.775 153.763 244.534L71.1339 161.925C70.112 160.86 68.7702 160.349 67.3855 160.349Z" fill="#327896"/>
                                <path d="M165.074 360.906C155.104 360.906 145.755 357.029 138.726 349.981L10.9137 222.169C-3.63919 207.639 -3.63919 183.994 10.9137 169.445L41.0335 139.325C55.563 124.772 79.2275 124.772 93.757 139.325L165.074 210.643L364.227 11.5128C378.757 -3.04003 402.421 -3.04003 416.951 11.5128L447.071 41.6327C454.123 48.6849 458 58.0344 458 67.9847C458 77.931 454.123 87.304 447.071 94.3327L191.446 349.958C184.397 357.01 175.044 360.906 165.074 360.906ZM67.3855 160.349C66.0203 160.349 64.659 160.86 63.6137 161.905L33.4938 192.025C31.4031 194.112 31.4031 197.478 33.4938 199.565L161.306 327.378C163.307 329.402 166.845 329.402 168.846 327.378L424.471 71.7526C426.558 69.6658 426.558 66.2996 424.471 64.2129L394.351 34.093C392.26 32.0023 388.894 32.0023 386.807 34.093L176.366 244.534C170.125 250.775 160.004 250.775 153.763 244.534L71.1339 161.925C70.112 160.86 68.7702 160.349 67.3855 160.349Z" stroke="black"/>
                                <rect x="381.269" y="14" width="95" height="378.214" transform="rotate(45.5 381.269 14)" fill="#327896"/>
                                <rect x="10" y="203.759" width="95" height="182.092" transform="rotate(-45.5 10 203.759)" fill="#327896"/>
                                </svg>
                                ';
                            }
                            echo '</button>
                        </div>';
                    }
                    else{
                        if($verif == "1"){
                        echo'
                        <div class="verif">
                            <button ';
                            if($userData==[] or $askData['userId'] != $userData['userId']){echo "style='border:none;transform:scale(1);cursor:default;'";}
                            echo '>';
                            echo '
                                <svg width="50" height="50" viewBox="0 0 458 361" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M165.074 360.906C155.104 360.906 145.755 357.029 138.726 349.981L10.9137 222.169C-3.63919 207.639 -3.63919 183.994 10.9137 169.445L41.0335 139.325C55.563 124.772 79.2275 124.772 93.757 139.325L165.074 210.643L364.227 11.5128C378.757 -3.04003 402.421 -3.04003 416.951 11.5128L447.071 41.6327C454.123 48.6849 458 58.0344 458 67.9847C458 77.931 454.123 87.304 447.071 94.3327L191.446 349.958C184.397 357.01 175.044 360.906 165.074 360.906ZM67.3855 160.349C66.0203 160.349 64.659 160.86 63.6137 161.905L33.4938 192.025C31.4031 194.112 31.4031 197.478 33.4938 199.565L161.306 327.378C163.307 329.402 166.845 329.402 168.846 327.378L424.471 71.7526C426.558 69.6658 426.558 66.2996 424.471 64.2129L394.351 34.093C392.26 32.0023 388.894 32.0023 386.807 34.093L176.366 244.534C170.125 250.775 160.004 250.775 153.763 244.534L71.1339 161.925C70.112 160.86 68.7702 160.349 67.3855 160.349Z" fill="#327896"/>
                                <path d="M165.074 360.906C155.104 360.906 145.755 357.029 138.726 349.981L10.9137 222.169C-3.63919 207.639 -3.63919 183.994 10.9137 169.445L41.0335 139.325C55.563 124.772 79.2275 124.772 93.757 139.325L165.074 210.643L364.227 11.5128C378.757 -3.04003 402.421 -3.04003 416.951 11.5128L447.071 41.6327C454.123 48.6849 458 58.0344 458 67.9847C458 77.931 454.123 87.304 447.071 94.3327L191.446 349.958C184.397 357.01 175.044 360.906 165.074 360.906ZM67.3855 160.349C66.0203 160.349 64.659 160.86 63.6137 161.905L33.4938 192.025C31.4031 194.112 31.4031 197.478 33.4938 199.565L161.306 327.378C163.307 329.402 166.845 329.402 168.846 327.378L424.471 71.7526C426.558 69.6658 426.558 66.2996 424.471 64.2129L394.351 34.093C392.26 32.0023 388.894 32.0023 386.807 34.093L176.366 244.534C170.125 250.775 160.004 250.775 153.763 244.534L71.1339 161.925C70.112 160.86 68.7702 160.349 67.3855 160.349Z" stroke="black"/>
                                <rect x="381.269" y="14" width="95" height="378.214" transform="rotate(45.5 381.269 14)" fill="#327896"/>
                                <rect x="10" y="203.759" width="95" height="182.092" transform="rotate(-45.5 10 203.759)" fill="#327896"/>
                                </svg>
                            </button>
                        </div>';
                            }
                        }

                    echo "<p class='repl'>".$cmnt['ques']."</p><br>";
                    echo "<p id='repl".md5($cmnt['quesId'].'EditMeBOIS')."' style='display:none;'>".$cmnt['ques']."</p>";
                    echo "<div class='replTask'>";
                    if($userData != [] and $replData['userId'] == $userData['userId']){
                        echo '
                            <a onclick="if(confirm(\'Are you sure you want to delete you reply? You will not be able to retrieve it later.\')){pDlt(\''.md5($cmnt['quesId']."deleteBOI").'\');}">Delete <svg viewBox="-40 0 427 427.00131" width="20px" xmlns="http://www.w3.org/2000/svg" ><path d="m232.398438 154.703125c-5.523438 0-10 4.476563-10 10v189c0 5.519531 4.476562 10 10 10 5.523437 0 10-4.480469 10-10v-189c0-5.523437-4.476563-10-10-10zm0 0"/><path d="m114.398438 154.703125c-5.523438 0-10 4.476563-10 10v189c0 5.519531 4.476562 10 10 10 5.523437 0 10-4.480469 10-10v-189c0-5.523437-4.476563-10-10-10zm0 0"/><path d="m28.398438 127.121094v246.378906c0 14.5625 5.339843 28.238281 14.667968 38.050781 9.285156 9.839844 22.207032 15.425781 35.730469 15.449219h189.203125c13.527344-.023438 26.449219-5.609375 35.730469-15.449219 9.328125-9.8125 14.667969-23.488281 14.667969-38.050781v-246.378906c18.542968-4.921875 30.558593-22.835938 28.078124-41.863282-2.484374-19.023437-18.691406-33.253906-37.878906-33.257812h-51.199218v-12.5c.058593-10.511719-4.097657-20.605469-11.539063-28.03125-7.441406-7.421875-17.550781-11.5546875-28.0625-11.46875h-88.796875c-10.511719-.0859375-20.621094 4.046875-28.0625 11.46875-7.441406 7.425781-11.597656 17.519531-11.539062 28.03125v12.5h-51.199219c-19.1875.003906-35.394531 14.234375-37.878907 33.257812-2.480468 19.027344 9.535157 36.941407 28.078126 41.863282zm239.601562 279.878906h-189.203125c-17.097656 0-30.398437-14.6875-30.398437-33.5v-245.5h250v245.5c0 18.8125-13.300782 33.5-30.398438 33.5zm-158.601562-367.5c-.066407-5.207031 1.980468-10.21875 5.675781-13.894531 3.691406-3.675781 8.714843-5.695313 13.925781-5.605469h88.796875c5.210937-.089844 10.234375 1.929688 13.925781 5.605469 3.695313 3.671875 5.742188 8.6875 5.675782 13.894531v12.5h-128zm-71.199219 32.5h270.398437c9.941406 0 18 8.058594 18 18s-8.058594 18-18 18h-270.398437c-9.941407 0-18-8.058594-18-18s8.058593-18 18-18zm0 0"/><path d="m173.398438 154.703125c-5.523438 0-10 4.476563-10 10v189c0 5.519531 4.476562 10 10 10 5.523437 0 10-4.480469 10-10v-189c0-5.523437-4.476563-10-10-10zm0 0"/></svg></a> <a>|</a>
                            <a onclick="editRepl(\''.md5($cmnt['quesId'].'editBOI').'\',repl'.md5($cmnt['quesId'].'EditMeBOIS').'.innerHTML)">Edit
            <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                 viewBox="0 0 306.637 306.637" style="enable-background:new 0 0 306.637 306.637;" xml:space="preserve" width="20px">
            <g>
                <g>
                    <path d="M12.809,238.52L0,306.637l68.118-12.809l184.277-184.277l-55.309-55.309L12.809,238.52z M60.79,279.943l-41.992,7.896
                        l7.896-41.992L197.086,75.455l34.096,34.096L60.79,279.943z"/>
                    <path d="M251.329,0l-41.507,41.507l55.308,55.308l41.507-41.507L251.329,0z M231.035,41.507l20.294-20.294l34.095,34.095
                        L265.13,75.602L231.035,41.507z"/></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g></svg></a><a>|</a>';
                        }
                    elseif($userData != []){echo '
                        <a onclick="rprtQues(\''.md5($cmnt['quesId'].'IamBad').'\')">Report <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="20px"
                 viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve">
            <g>
                <g>
                    <path d="M424.385,20.69C401.182,6.768,376.445,0,348.761,0c-33.122,0-65.635,9.753-97.077,19.185
                        c-30.716,9.214-59.729,17.917-88.446,17.919c-0.004,0-0.007,0-0.011,0c-19.199,0-36.583-4.064-52.894-12.382V15
                        c0-8.284-6.716-15-15-15s-15,6.716-15,15v18.551v203.896V497c0,8.284,6.716,15,15,15s15-6.716,15-15V261.453
                        c16.567,6.4,34.052,9.547,52.906,9.547c33.121,0,65.631-9.753,97.071-19.185c30.718-9.215,59.733-17.919,88.451-17.919
                        c22.092,0,41.779,5.369,60.188,16.415c4.633,2.78,10.404,2.854,15.108,0.191c4.703-2.663,7.609-7.649,7.609-13.053V33.552
                        C431.667,28.283,428.903,23.4,424.385,20.69z M251.691,223.081C220.972,232.296,191.957,241,163.24,241
                        c-19.206,0-36.594-4.058-52.906-12.376V57.566c16.564,6.399,34.046,9.539,52.894,9.538c0.003,0,0.01,0,0.014,0
                        c33.118-0.002,65.626-9.754,97.063-19.185C291.024,38.704,320.042,30,348.761,30c19.206,0,36.594,4.058,52.905,12.375v171.06
                        c-16.566-6.4-34.052-9.539-52.905-9.539C315.641,203.896,283.13,213.649,251.691,223.081z"/></g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g></svg></a><a>|</a>';
                    }
                        echo '&nbsp;<a onclick="cpyTxt(location.hostname+\'/askLantic/questions.php?q='.$_GET['q']."#".md5($cmnt['quesId'].'IamTheQuestion').'\')">Share
                        <svg fill="#000000" xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 24 24" width="20px" height="20px"><path d="M 20 0 C 17.789063 0 16 1.789063 16 4 C 16 4.277344 16.039063 4.550781 16.09375 4.8125 L 7 9.375 C 6.265625 8.535156 5.203125 8 4 8 C 1.789063 8 0 9.789063 0 12 C 0 14.210938 1.789063 16 4 16 C 5.203125 16 6.265625 15.464844 7 14.625 L 16.09375 19.1875 C 16.039063 19.449219 16 19.722656 16 20 C 16 22.210938 17.789063 24 20 24 C 22.210938 24 24 22.210938 24 20 C 24 17.789063 22.210938 16 20 16 C 18.796875 16 17.734375 16.535156 17 17.375 L 7.90625 12.8125 C 7.960938 12.550781 8 12.277344 8 12 C 8 11.722656 7.960938 11.449219 7.90625 11.1875 L 17 6.625 C 17.734375 7.464844 18.796875 8 20 8 C 22.210938 8 24 6.210938 24 4 C 24 1.789063 22.210938 0 20 0 Z"/></svg>
                        </a>
                        ';
                        echo "<br>
                        <span class='view' style='font-family:arial;margin-top:-20px;'>Replied: ".convTime(time()-$cmnt['time'])."</span>
                        ";
                        echo "</div>";
                    echo "<div class='user'><span onclick='location.href=\"profile.php?u=".md5($replData['userId']."LookAtMe")."\"'>".$replData['usern']."
                    <img src='profile_picture/".$replData['prfpc']."' onerror='this.src=\"images/default.png\"' alt='profile picture of the replier'></span>
                    </div>";
                    echo "</div><hr>";
                }
            ?>
        </div>
            <?php
                if($userData != []){
                    $plcHld = "Please be specific and polite to the user";
                    if($userData['userId'] == $askData['userId']){$plcHld = "Answer yourself? Make it comfortable for other users too";}
                    echo '
                    <div class="wrtRepl">
                    <form method="post">
                        <div>
                        <button type="button" onclick="insrtInBdy(\'[B] insert text here [!]\')"><b>B</b></button><button type="button" onclick="insrtInBdy(\'[I] insert text here [!]\')"><i>I</i></button><button type="button" onclick="insrtInBdy(\'[U] insert text here [!]\')"><u>U</u></button><button type="button" onclick="insrtInBdy(\'[C] insert text here [!]\')">&lt;Code&gt;</button><button type="button" onclick="insrtInBdy(\'[>] insert text here [!]\')">Quote</button>
                        <span class="wrdCnt">0/1500</span>
                        <br><textarea id="bdy" placeholder="'.$plcHld.'" rows="10" name="repl"></textarea>
                        </div>
                        <div id="prw"></div>
                        <button type="submit" onclick="return submRelp();">Reply</button>
                    </form>
                    </div>
                    ';
                    }
            ?>
        <svg width="125" height="300" viewBox="0 0 398 851" fill="none" xmlns="http://www.w3.org/2000/svg">
            <g id="ansHand">
            <path id="Vector" d="M281.246 379.547L275.314 419.029L207.508 464.891C207.508 464.891 171.857 481.975 174.102 492.589C176.102 502.05 203.612 500.93 212.269 486.3L293.336 449.446L320.448 395.771L281.246 379.547Z" fill="#FFB8B8"/>
            </g>
            <g id="ansBody">
            <g id="Group 2">
            <path id="Vector_2" d="M281.602 777.589L284.602 819.589L313.602 817.589L308.602 777.589H281.602Z" fill="#FFB8B8"/>
            <path id="Vector_3" d="M289.602 806.589C289.602 806.589 285.602 791.589 281.602 792.589L275.602 803.589C275.602 803.589 248.602 828.589 240.602 829.589C240.602 829.589 214.602 837.589 240.602 849.589H270.602C270.602 849.589 290.602 848.589 294.602 849.589C298.602 850.589 321.602 850.589 322.602 844.589C323.602 838.589 319.602 826.589 319.602 826.589C319.602 826.589 315.914 797.086 311.758 802.837C309.586 805.923 307.194 808.847 304.602 811.589L289.602 806.589Z" fill="#2F2E41"/>
            <path id="Vector_4" d="M356.602 778.089L359.602 820.089L388.602 818.089L383.602 778.089H356.602Z" fill="#FFB8B8"/>
            <path id="Vector_5" d="M364.602 807.089C364.602 807.089 360.602 792.089 356.602 793.089L350.602 804.089C350.602 804.089 323.602 829.089 315.602 830.089C315.602 830.089 289.602 838.089 315.602 850.089H345.602C345.602 850.089 365.602 848.089 369.602 849.089C373.602 850.089 396.602 850.089 397.602 844.089C398.602 838.089 394.602 827.089 394.602 827.089C394.602 827.089 390.914 797.586 386.758 803.337C384.586 806.423 382.194 809.347 379.602 812.089L364.602 807.089Z" fill="#2F2E41"/>
            <path id="Vector_6" d="M242.602 520.089L237.602 527.089V541.089L269.602 660.089L275.602 686.089C275.602 686.089 275.602 786.089 281.602 786.089C287.602 786.089 314.602 789.089 314.602 783.089C314.602 777.089 312.602 641.089 312.602 641.089L339.602 692.089C339.602 692.089 351.602 782.089 355.602 783.089C359.602 784.089 387.602 783.089 389.602 777.089L383.602 720.089C383.602 720.089 384.602 656.089 367.602 642.089C367.602 642.089 364.602 625.089 361.602 618.089C358.602 611.089 353.602 607.089 356.602 602.089C359.602 597.089 352.602 542.089 352.602 542.089C352.602 542.089 354.602 525.089 350.602 520.089C346.602 515.089 242.602 520.089 242.602 520.089Z" fill="#2F2E41"/>
            </g>
            <g id="Group 6">
            <g id="Group 4">
            <path id="Vector_7" d="M326.102 280.589L324.102 300.589L332.102 307.589L281.102 331.589C293.665 310.125 297.385 290.581 291.102 276.589L326.102 280.589Z" fill="#FFB8B8"/>
            <path id="Vector_8" d="M291.102 310.589C291.102 310.589 283.102 326.589 293.102 322.589L324.102 300.589C324.102 300.589 358.102 313.589 370.102 328.589L360.102 434.589L352.102 509.589C352.102 509.589 357.102 518.589 356.102 519.589C355.102 520.589 354.102 518.589 355.102 521.589C356.102 524.589 359.102 521.589 356.102 524.589C353.102 527.589 350.102 524.589 353.102 527.589C356.102 530.589 353.102 531.589 353.102 531.589C353.102 531.589 349.102 507.589 314.102 525.589C279.102 543.589 264.102 548.589 238.102 526.589L268.102 412.589L270.524 369.593C271.333 355.231 273.889 341.021 278.135 327.278C280.428 319.854 284.423 312.559 291.102 308.589V310.589Z" fill="#D0CDE1"/>
            </g>
            <path id="Vector_9" d="M344.602 398.089L359.602 435.089L324.602 509.089C324.602 509.089 316.602 518.089 321.602 529.089C324.185 534.967 327.193 540.648 330.602 546.089C330.602 546.089 339.602 542.089 339.602 525.089L390.602 452.089L386.602 392.089L344.602 398.089Z" fill="#FFB8B8"/>
            <path id="Vector_10" d="M342.602 332.089C342.602 332.089 328.602 346.089 334.602 368.089C340.602 390.089 345.602 407.089 345.602 407.089C345.602 407.089 369.602 389.089 389.602 400.089C389.602 400.089 386.602 335.089 369.602 329.089C352.602 323.089 342.602 332.089 342.602 332.089Z" fill="#D0CDE1"/>
            </g>
            </g>
            <g id="ansHead">
            <path id="Vector_11" d="M306.602 293.089C323.723 293.089 337.602 279.21 337.602 262.089C337.602 244.968 323.723 231.089 306.602 231.089C289.481 231.089 275.602 244.968 275.602 262.089C275.602 279.21 289.481 293.089 306.602 293.089Z" fill="#FFB8B8"/>
            <path id="Vector_12" d="M332.086 235.495C332.086 235.495 322.614 214.974 304.461 219.71C286.307 224.445 276.046 231.549 275.257 238.652C274.468 245.756 275.652 256.411 275.652 256.411C275.652 256.411 277.625 241.81 290.253 244.967C302.882 248.124 322.614 245.756 322.614 245.756L325.771 274.17C325.771 274.17 331.155 268.432 335.102 271.589C339.048 274.746 344.714 241.81 332.086 235.495Z" fill="#2F2E41"/>
            </g>
            <g id="ansMesg">
            <path id="Vector_13" d="M246.991 123.447C246.981 96.3811 238.079 70.0682 221.654 48.5553C205.23 27.0424 182.193 11.5209 156.087 4.3781C129.98 -2.76472 102.25 -1.13326 77.1617 9.02153C52.073 19.1763 31.0151 37.292 17.2268 60.5824C3.43844 83.8729 -2.31674 111.048 0.846448 137.929C4.00963 164.809 15.916 189.906 34.7343 209.359C53.5525 228.813 78.2405 241.545 105.001 245.598C131.762 249.652 159.113 244.802 182.848 231.794C191.388 237.87 212.222 249.99 232.803 241.259L208.029 213.488C220.344 201.949 230.158 188.002 236.86 172.513C243.562 157.024 247.011 140.324 246.991 123.447Z" fill="rgb(50,120,150)"/>
            <path id="Vector_14" d="M60.2912 103.069C85.8498 102.803 111.405 102.346 136.962 101.999C145.483 101.883 154.003 101.782 162.524 101.695C169.865 101.618 169.884 90.2018 162.524 90.2785C136.965 90.5446 111.41 91.0015 85.8525 91.3487C77.3322 91.4645 68.8118 91.5659 60.2912 91.6531C52.9496 91.7296 52.9308 103.146 60.2912 103.069V103.069Z" fill="white"/>
            <path id="Vector_15" d="M60.2912 129.707L163.589 128.637L192.967 128.332C200.308 128.256 200.327 116.84 192.967 116.916L89.6693 117.986L60.2912 118.291C52.9496 118.367 52.9308 129.783 60.2912 129.707V129.707Z" fill="white"/>
            <path id="Vector_16" d="M60.2912 156.344L163.589 155.274L192.967 154.97C200.308 154.894 200.327 143.477 192.967 143.554L89.6693 144.624L60.2912 144.928C52.9496 145.004 52.9308 156.421 60.2912 156.344Z" fill="white"/>
            </g>
        </svg>

        <script>
            <?= $cmnd; ?>
            <?php 
            if($userData != []){
            if(voteExst($quesData['quesId'],$userData['userId']) == 'u'){
                echo "quesUpvt.style.fill = 'rgb(50,120,150)';";
            }
            elseif(voteExst($quesData['quesId'],$userData['userId']) == 'd'){
                echo "quesDwvt.style.fill = 'rgb(50,120,150)';";
            }

            foreach($cmnts as $cmnt){
                if(voteExst($cmnt['quesId'],$userData['userId']) == 'u'){
                    echo "upvt".md5("voteDir".$cmnt['quesId']).".style.fill = 'rgb(50,120,150)';";
                }
                elseif(voteExst($cmnt['quesId'],$userData['userId']) == 'd'){
                    echo "dwvt".md5("voteDir".$cmnt['quesId']).".style.fill = 'rgb(50,120,150)';";
                }
            }}
            ?>
            tags = "<?= $quesData['tags'] ?>";
            for(t of tags.split(" ")){
                if(t!=" " && t!=""){
                    tag.innerHTML += "<span style='padding:5px; background:rgba(50,51,51,0.5);color:white; display:inline-block;border-radius:5px;margin-right:10px;'>"+t+"</span>";
                }
            }
            for(r = 0; r<document.getElementsByClassName("repl").length;r++){
                document.getElementsByClassName("repl")[r].innerHTML = fltrDesc(document.getElementsByClassName("repl")[r].innerHTML);
            }

            document.getElementsByClassName("desc")[0].innerHTML = fltrDesc(document.getElementsByClassName("desc")[0].innerHTML);
            getViewCnt("<?= md5($quesData['quesId'].'GetThisManAView') ?>");
            <?php
                if($userData != []){
                    echo "
                    setInterval(() => {
                        document.getElementsByClassName('wrdCnt')[0].innerHTML = bdy.value.length+'/1500'
                        if(bdy.value.length > 1500){document.getElementsByClassName('wrdCnt')[0].style.color='red';}
                        else{{document.getElementsByClassName('wrdCnt')[0].style.color='rgb(50, 120, 150)';}}
                        prw.innerHTML = fltrDesc(bdy.value,true);
                        edtRpw.innerHTML = fltrDesc(replBdy.value,true);
                        edtWrdCnt.innerHTML = replBdy.value.length+'/1500'
                        if(replBdy.value.length > 1500){edtWrdCnt.style.color='red';}
                        else{edtWrdCnt.style.color='white';}
                    },100)
                    ";
                }
            ?>
        </script>
    <script>timeSpent();</script>
    </body>
</html>
