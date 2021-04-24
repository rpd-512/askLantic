<?php
require_once "libs.php";
session_start();
$cmnd = "";
$err = 0;
if (isset($_SESSION['cmnd'])) {
    $cmnd = $_SESSION['cmnd'];
    unset($_SESSION['cmnd']);
    if (strpos($cmnd, 'File')) {
        $err = 1;
    }
}
if (isset(isAuth()[1])) {
    $userData = isAuth()[1];
} else {
    header("Location: index.php");
}
if ($userData != []) {
    $profPic = $userData["prfpc"];
    if ($profPic == "") {
        $profPic = "images/default.png";
    } else {
        $profPic = "profile_picture/" . $profPic;
    }
}
if (isset($_POST['saveChng'])) {
    if ($_FILES['save']['name'] != "") {
        if ($_FILES['save']['size'] > 1000000) {
            $_SESSION['cmnd'] = "File too large, please choose a file below 1 MB";
            header("Location: edit_profile.php");
            exit();
        }
        $fValid = ["png", "gif", "jpg", "jpeg"];
        $fPrfx = md5(rand(1, 99999999999999));
        $fExnt = strtolower(pathinfo($_FILES['save']['name'], PATHINFO_EXTENSION));
        if (!in_array($fExnt, $fValid)) {
            $_SESSION['cmnd'] = "File is not an image, only png, jpg, jpeg and gif files are allowed";
            header("Location: edit_profile.php");
            exit();
        }
        if ($_POST['isErr'] == 1) {
            $_SESSION['cmnd'] = "File is not an image, please check again";
            header("Location: edit_profile.php");
            exit();
        }
        $fDest = "profile_picture/" . $fPrfx . "." . $fExnt;
        if ($userData['prfpc'] != "") {
            unlink("./profile_picture/" . $userData['prfpc']);
        }
        move_uploaded_file($_FILES["save"]["tmp_name"], $fDest);
        $qry = 'update askLantic__userData SET prfpc=:p where userId=' . $userData['userId'] . ';';
        $raw_data = $pdo->prepare($qry);
        $raw_data->execute(array(':p' => $fPrfx . "." . $fExnt));
    } else if ($_FILES['save']['name'] == "" and $_POST['saveChng'] == 1) {
        $qry = 'update askLantic__userData SET prfpc=:p where userId=' . $userData['userId'] . ';';
        $raw_data = $pdo->prepare($qry);
        $raw_data->execute(array(':p' => NULL));
    } else {
        null;
    }
    $_SESSION['cmnd'] = "Changes saved";
    header("Location: edit_profile.php");
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>AskLantic || Ask your stuff here</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <link href='https://fonts.googleapis.com/css?family=Days One' rel='stylesheet'>
    <link rel="shortcut icon" type="image/png" href="images/favicon.png">
    <link rel="stylesheet" href="css/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="js/index.js"></script>
    <style>
        .dltAcc {
            color: red !important;
            background: pink !important;
            border-color: red !important;
        }

        .dltAcc:hover {
            color: pink !important;
            background: red !important;
            border-color: red !important;
        }
    </style>
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
    <div class="homeHead" style="height:120px;position:sticky;top:7px;">
        <h1 onclick="location.href='index.php'" onmouseover="this.style.cursor='pointer'">AskLantic</h1>
        <p>User profile</p>
    </div>
    <div id="err" <?php if ($err == 0) {
                        echo 'style="color:green;border-color:green;background:rgba(120,255,120,0.5);"';
                    } ?>></div>
    <div class="profile">
        <div class="ls">
            <img src="<?= $profPic ?>" alt="profile picture" id="profPic" onerror='this.src="images/error.png"; imgErr=1;'>
        </div>
        <div class="rs">
            <button onclick="slctImg.click()" class="profPcSlct">Change Profile Picture</button>
            <button onclick="slctImg.value = slctImg.defaultValue;profPic.src='images/default.png';" class="profPcSlct" id="rmvImg" disabled>Remove profile picture</button>
        </div>
        <hr>
        <div class="ls">
            <span>Username</span>
        </div>
        <div class="rs">
            <span><?= $userData['usern'] ?></span>
        </div>
        <hr>
        <div class="ls">
            <span>Email</span>
        </div>
        <div class="rs">
            <span><?= $userData['email'] ?></span>
        </div>
        <hr>
        <div class="ls">
            <span>Reputation</span>
        </div>
        <div class="rs">
            <span><?= $userData['reput'] ?></span>
        </div>
        <hr>
        <div class="rs" style="width:100%;"><button style="width:80%;" onclick="location.href='change_password.php'">Change password</button></div>

    </div>
    <div class="profile" style="background:rgba(255,120,120,0.5);">
        <div class="ls">
            <span style="color:red;">Danger Zone</span>
        </div>
        <div class="rs">
            <button class="dltAcc" onclick="location.href = 'delete_account.php'">Delete Account</button>
        </div>
    </div>
    <div class="profile">
        <div class="rs">
            <form method="post" enctype="multipart/form-data"><input id="slctImg" type="file" style="display:none;" accept="image/*" name="save" /><button type="submit" style="width:100%;" value="0" name="saveChng" id="isDef"> Save Changes</button><input type="hidden" id="e" name="isErr"></form>
        </div>
        <div class="rs ls"><button style="width:100%" onclick="location.href='index.php'">Home</button></div>
    </div><br><br>

    <svg width="70" height="200" viewBox="0 0 206 526" fill="none" xmlns="http://www.w3.org/2000/svg" class="standChar2">
        <g id="standBody2">
            <path id="Path 67" d="M57.186 71.033C57.186 71.033 64.334 98.197 62.186 101.771C60.038 105.345 82.916 124.646 82.916 124.646L105.076 120.357L106.506 89.619C106.506 89.619 86.49 72.463 90.78 59.596L57.186 71.033Z" fill="#FFB9B9" />
            <g id="Group 5">
                <path id="Path 68" opacity="0.1" d="M57.186 71.033C57.186 71.033 64.334 98.197 62.186 101.771C60.038 105.345 82.916 124.646 82.916 124.646L105.076 120.357L106.506 89.619C106.506 89.619 86.49 72.463 90.78 59.596L57.186 71.033Z" fill="black" />
                <g id="Group 4">
                    <g id="Group 2">
                        <path id="Path 69" d="M38.6 242.598C38.6 242.598 32.881 278.34 37.17 307.648C41.459 336.956 43.604 358.401 41.459 362.69C39.314 366.979 37.17 366.264 38.6 371.268C40.03 376.272 42.889 374.127 40.03 379.131C37.171 384.135 37.886 392.713 37.886 394.857C37.886 397.001 34.312 443.466 37.886 448.47C41.46 453.474 42.886 452.759 42.886 452.759L47.175 478.493L70.05 474.919L66.476 451.329C66.476 451.329 75.054 447.04 71.476 444.181C67.898 441.322 65.757 441.322 67.902 441.322C70.047 441.322 73.621 440.607 70.761 439.177C67.901 437.747 70.046 399.146 70.046 399.146C70.046 399.146 75.046 328.377 95.065 330.522C115.084 332.667 130.811 374.128 130.811 374.128L136.53 392.714C136.53 392.714 138.674 427.741 140.104 430.6C141.534 433.459 140.819 434.174 140.104 435.6C139.389 437.026 134.385 433.455 139.389 439.174C144.393 444.893 144.389 447.037 144.389 447.037L147.606 484.566L170.845 469.92V447.76C170.845 447.76 175.134 440.612 173.704 434.893C172.274 429.174 172.274 402.01 173.704 397.007C175.134 392.004 174.419 390.573 172.989 388.429C171.559 386.285 167.989 387.714 170.844 382.71C173.699 377.706 175.844 364.839 171.559 355.546C167.274 346.253 143.68 254.754 133.673 249.746C123.666 244.738 38.6 242.598 38.6 242.598Z" fill="#2F2E41" />
                        <path id="Path 70" d="M70.053 462.767C70.053 462.767 53.612 459.908 52.897 464.197C52.5044 467.76 52.5044 471.356 52.897 474.919C52.897 474.919 47.178 475.634 47.897 480.638C48.616 485.642 49.327 499.224 49.327 499.224C49.327 499.224 40.392 520.312 45.395 525.316C45.445 525.366 55.266 524.959 60.911 524.959H81.494C81.494 524.959 84.353 514.951 81.494 513.522C78.635 512.093 72.201 499.222 72.916 496.366C73.631 493.51 72.916 472.776 72.916 472.776L69.759 472.954L70.053 462.767Z" fill="#3F3D56" />
                        <path id="Path 71" d="M153.689 475.634L145.111 482.068C145.111 482.068 148.685 494.22 146.541 496.368C144.397 498.516 139.75 523.175 144.041 524.604C148.332 526.033 174.779 523.889 174.779 523.889C174.779 523.889 204.445 524.961 205.159 523.532C205.873 522.103 207.304 513.524 198.726 510.665C190.148 507.806 185.144 508.521 182.285 499.942C179.426 491.363 172.992 478.497 172.992 478.497L171.562 462.771C171.562 462.771 162.984 464.201 161.554 464.201C160.124 464.201 152.976 467.775 153.691 470.635C154.126 472.273 154.125 473.996 153.689 475.634Z" fill="#3F3D56" />
                    </g>
                    <g id="Group 3">
                        <path id="Path 72" d="M88.639 101.06L99.362 82.318C99.362 82.318 124.381 81.044 125.811 83.904C127.241 86.764 139.393 228.304 139.393 228.304C139.393 228.304 145.112 236.167 141.537 241.171L137.963 246.171V256.179C137.963 256.179 120.092 270.479 95.788 267.616C71.484 264.753 40.746 251.89 40.746 251.89L47.18 211.859L46.465 93.911L60.865 86.891C60.865 86.891 77.2 98.2 80.059 101.774C82.918 105.348 88.639 101.06 88.639 101.06Z" fill="#3D3DB5" />
                        <path id="Path 73" d="M63.619 101.06L60.402 82.117L16.4391 113.217L40.739 184.701C40.739 184.701 25.727 211.865 28.587 221.873C31.447 231.881 32.876 246.892 32.876 246.892C32.876 246.892 71.4761 256.9 70.7621 251.892C70.0481 246.884 70.7621 224.728 70.7621 224.728C70.7621 224.728 83.262 132.154 77.011 118.037C70.76 103.92 63.619 101.06 63.619 101.06Z" fill="#FF7878" />
                        <path id="Path 74" d="M102.935 91.767L96.144 78.542C96.144 78.128 144.393 84.802 146.544 88.907L140.822 198.993C140.822 198.993 141.537 214.719 145.111 219.008C148.685 223.297 147.97 230.445 146.541 231.16C145.112 231.875 121.522 239.023 121.522 239.023C121.522 239.023 98.647 199.707 100.792 152.523C102.937 105.339 102.935 91.767 102.935 91.767Z" fill="#FF7878" />
                    </g>
                    <path id="Path 76" d="M30.737 274.765L43.604 294.065L50.752 269.765L45.752 262.617L30.737 274.765Z" fill="#FFB9B9" />
                    <path id="Path 77" d="M22.873 113.926L16.44 113.212L0.713013 197.562L27.877 281.913L51.467 264.042L35.026 207.57L40.744 163.965L22.873 113.926Z" fill="#FF7878" />
                </g>
            </g>
        </g>
        <g id="standHead2">
            <path id="Path 66" d="M59.4 9.58401C59.4 9.58401 57.482 2.68402 54.6 0.953018V9.58401C54.6 9.58401 43.092 7.85802 34.94 16.484L42.612 18.21C42.612 18.21 31.343 21.95 28.946 38.061L33.746 35.761L46.693 63.38L54.845 48.42L71.1451 65.106L67.3091 55.9L73.543 58.777L69.227 51.297L88.4081 59.928L86.969 55.328L93.997 67.104C93.997 67.104 118.138 42.094 91.764 15.626C91.767 15.626 79.779 2.96701 59.4 9.58401Z" fill="#2F2E41" />
            <path id="Ellipse 12" d="M69.338 79.972C85.7221 79.972 99.004 66.6901 99.004 50.306C99.004 33.9219 85.7221 20.64 69.338 20.64C52.9539 20.64 39.672 33.9219 39.672 50.306C39.672 66.6901 52.9539 79.972 69.338 79.972Z" fill="#FFB9B9" />
            <path id="Path 78" d="M100.309 41.936C96.381 27.618 84.097 17.168 69.542 17.168C64.4666 17.2201 59.4799 18.5046 55.0108 20.911C50.5418 23.3173 46.7244 26.7735 43.887 30.982L51.227 45.048L58.546 32.982L73.183 46.44L69.739 39.015L75.339 41.335L71.464 35.302L88.684 42.263L87.392 38.55L95.572 49.224C97.4734 47.0201 99.0669 44.5684 100.309 41.936Z" fill="#2F2E41" />
        </g>
        <g id="standHand2">
            <path id="Path 75" d="M138.963 89.622L146.534 88.01C149.497 89.6772 151.853 92.2445 153.26 95.34C155.405 100.34 180.424 153.957 180.424 157.531C180.424 161.105 181.139 187.554 165.412 187.554C149.685 187.554 137.533 120.359 137.533 120.359L138.963 89.622Z" fill="#FF7878" />
            <path id="Path 79" opacity="0.1" d="M134.316 124.292L153.577 141.085L143.609 119.285L134.316 124.292Z" fill="black" />
            <path id="Path 81" d="M126.095 121.79C126.095 121.79 116.802 93.196 105.365 98.2C93.928 103.204 109.654 133.227 109.654 133.227L119.662 139.661L126.095 121.79Z" fill="#FFB9B9" />
            <path id="Path 82" d="M175.419 158.247L125.38 118.931L107.509 145.381C107.509 145.381 154.688 195.42 165.409 185.412C176.13 175.404 175.419 158.247 175.419 158.247Z" fill="#FF7878" />
        </g>
    </svg>
    <script>
        var imgErr = 0;
        var prfImg = profPic.src;
        var updImg = profPic.src;
        setInterval(function() {
            rtuImg()
        }, 250);
        <?php
        if ($cmnd != "") {
            echo "displayErr('" . $cmnd . "');";
        }
        ?>
    </script>
    <script>timeSpent();</script>
</body>

</html>
