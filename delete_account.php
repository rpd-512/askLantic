<?php
require_once "libs.php";
if(isset(isAuth()[1])){$userData = isAuth()[1];}
else{header("Location: index.php");exit();}
if(isset($_POST['user']) and isset($_POST['pswd'])){
    if(! isValid($_POST['user'],$_POST['pswd'])){header("Location: signup.php");exit();}
    $qry = "delete from askLantic__userData where userId=:id";
    $raw_data = $pdo->prepare($qry);
    $raw_data->execute(array(':id' => $userData['userId']));
    setcookie('user',$userData['usern'],time()+60);
    header("Location: goodbye.php");
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
            .dltAcc{color:red !important;background:pink !important;border-color:red !important;}
            .dltAcc:hover{color:pink !important;background:red !important;border-color:red !important;}
        </style>
    </head>
    <body style="text-align:center;">
        <div class="homeHead" style="height:120px;position:sticky;top:7px;">
                <h1 onclick="location.href='index.php'" onmouseover="this.style.cursor='pointer'">AskLantic</h1>
                <p>Delete account</p>
        </div>
        <span class="dltMsg">Are you leaving us :-( ??<br> we will really miss you....</span>
        <div id="err" style="transform:translateY(-50px);"></div>
        <div class="dltConf">
            <form method="post">
                <input type="hidden" value="<?= $userData['usern']?>" id="us" name="user">
                <input type="password" placeholder="Enter password" name="pswd" id="ps">
                <input type="submit" id="subm" value="Delete account" onclick="return sign('in');" style="border-radius:5px;">
                <input type="button" value="Back" onclick="location.href='profile.php'">
            </form>
        </div>

        <svg width="75" height="300" viewBox="0 0 206 660" fill="none" xmlns="http://www.w3.org/2000/svg">
            <g id="waitArm1">
            <path id="Vector" d="M7.81032 76.4817L7.54683 69.0762C7.54683 69.0762 -4.32325 19.8986 11.9657 32.7461C28.2547 45.5936 23.5517 68.3063 23.5517 68.3063L21.1847 75.0038L7.81032 76.4817Z" fill="#FBBEBE"/>
            <path id="Vector_2" d="M50.6346 238.086L50.529 229.993C41.529 229.993 13.1168 163.669 10.4039 138.114C7.69106 112.558 6.19257 92.9723 6.19257 92.9723C6.19257 92.9723 -2.22569 76.0371 1.35565 75.3085C4.93699 74.5799 26.1821 69.0143 26.9107 72.5956C27.6394 76.177 29.8664 99.3445 29.8664 99.3445L46.5219 150.656L63.2966 165.891L50.6346 238.086Z" fill="#D0CDE1"/>
            </g>
            <g id="waitArm2">
            <path id="Vector_3" d="M198.087 85.4817L198.351 78.0762C198.351 78.0762 210.221 28.8987 193.932 41.7461C177.643 54.5936 182.346 77.3063 182.346 77.3063L184.713 84.0038L198.087 85.4817Z" fill="#FBBEBE"/>
            <path id="Vector_4" d="M100.263 247.086L150.369 238.993C170.369 238.993 192.781 172.669 195.494 147.114C198.207 121.558 199.705 101.972 199.705 101.972C199.705 101.972 208.123 85.0372 204.542 84.3085C200.961 83.5799 179.716 78.0144 178.987 81.5957C178.258 85.177 176.031 108.345 176.031 108.345L159.376 159.656L142.601 174.891L100.263 247.086Z" fill="#D0CDE1"/>
            </g>
            <g id="waitBody">
            <path id="Vector_5" d="M52.939 598.894V620.822L44.411 622.041L32.229 618.386L35.883 595.239L52.939 598.894Z" fill="#3F3D56"/>
            <path id="Vector_6" d="M41.9744 609.858C41.9744 609.858 38.3198 600.112 32.2286 601.33C26.1374 602.549 24.9192 609.858 24.9192 609.858C24.9192 609.858 20.0462 628.132 12.7368 634.223C5.42743 640.314 -1.88197 656.151 12.7368 658.588C27.3556 661.024 39.538 654.933 39.538 653.715C39.538 652.496 43.1927 645.187 49.2839 643.969C55.375 642.75 60.248 641.532 60.248 636.659C60.248 631.786 56.5933 626.913 56.5933 626.913C56.5933 626.913 55.375 603.805 52.9386 606.832C51.2536 609.223 50.0154 611.899 49.2839 614.731L41.9744 609.858Z" fill="#2F2E41"/>
            <path id="Vector_7" d="M105.323 587.93L100.45 606.203L112.632 608.64L118.723 602.549L119.941 586.712L105.323 587.93Z" fill="#3F3D56"/>
            <path id="Vector_8" d="M104.104 603.767C104.104 603.767 108.977 600.112 111.414 600.112H115.068C115.068 600.112 115.068 591.585 121.16 591.585C127.251 591.585 126.033 597.676 126.033 597.676C126.033 597.676 139.433 618.386 143.088 622.041C146.743 625.695 166.234 636.659 150.397 641.532C134.56 646.405 123.596 646.405 116.287 637.878C116.287 637.878 108.977 634.223 104.104 634.223C99.2315 634.223 93.1403 631.786 93.1403 628.132C93.1403 624.477 96.795 617.168 96.795 617.168C96.795 617.168 99.2314 595.239 100.45 597.676C101.668 600.112 104.104 603.767 104.104 603.767Z" fill="#2F2E41"/>
            <g id="Group 7">
            <path id="Vector_9" d="M98.0132 132.31C98.0132 132.31 95.5768 157.893 94.3585 159.112C93.1403 160.33 112.632 183.476 112.632 183.476L129.687 167.639C129.687 167.639 128.469 144.493 132.124 139.62C135.778 134.747 98.0132 132.31 98.0132 132.31Z" fill="#FBBEBE"/>
            <path id="Vector_10" d="M51.7203 307.736V347.938C51.7203 347.938 38.3198 425.905 38.3198 451.488C38.3198 477.071 17.6097 598.894 27.3556 601.331C37.1015 603.767 60.248 607.422 61.4662 603.767C62.6844 600.112 71.2121 484.38 72.4303 483.162C73.6486 481.944 99.2314 385.703 99.2314 385.703L104.104 386.921L106.541 496.562C106.541 496.562 94.3585 595.239 100.45 595.239C106.541 595.239 132.124 594.021 132.124 586.712C132.124 579.402 145.524 444.178 145.524 444.178C145.524 444.178 161.361 336.974 155.27 326.01C149.179 315.046 149.179 308.954 149.179 308.954L51.7203 307.736Z" fill="#2F2E41"/>
            <path id="Vector_11" opacity="0.1" d="M98.0132 132.31C98.0132 132.31 95.5768 157.893 94.3585 159.112C93.1403 160.33 112.632 183.476 112.632 183.476L129.687 167.639C129.687 167.639 128.469 144.493 132.124 139.62C135.778 134.747 98.0132 132.31 98.0132 132.31Z" fill="black"/>
            <path id="Vector_12" d="M112.632 168.857C112.632 168.857 97.4041 156.066 96.1858 151.193C96.1858 151.193 88.2673 159.112 88.2673 160.33C88.2673 161.548 54.1568 165.203 45.6291 174.949C37.1015 184.694 29.7921 205.404 29.7921 205.404L50.5021 244.388C50.5021 244.388 51.7203 266.316 51.7203 268.753C51.7203 271.189 45.6292 310.173 48.0656 311.391C50.5021 312.609 74.8668 324.791 95.5768 322.355C116.287 319.918 136.997 316.264 143.088 316.264C149.179 316.264 154.052 318.7 154.052 316.264C154.052 313.827 150.397 308.954 150.397 306.518C150.397 304.081 149.179 297.99 149.179 294.336C149.179 290.681 146.743 284.59 146.743 279.717C146.743 274.844 173.544 209.059 173.544 209.059C173.544 209.059 172.326 188.349 152.834 178.603C133.342 168.857 130.906 165.203 130.906 165.203C130.906 165.203 130.526 157.893 129.497 157.893C128.469 157.893 124.814 168.857 115.068 170.076L112.632 168.857Z" fill="#D0CDE1"/>
            <path id="Vector_13" opacity="0.1" d="M88.876 160.939L109.586 177.994L112.023 174.339L88.876 160.939Z" fill="black"/>
            <path id="Vector_14" opacity="0.1" d="M130.296 165.812L115.678 174.339L116.896 177.994L130.296 165.812Z" fill="black"/>
            </g>
            </g>
            <g id="waitHead">
            <path id="Vector_15" d="M117.408 150.72C130.864 150.72 141.773 139.811 141.773 126.355C141.773 112.899 130.864 101.99 117.408 101.99C103.952 101.99 93.0433 112.899 93.0433 126.355C93.0433 139.811 103.952 150.72 117.408 150.72Z" fill="#FBBEBE"/>
            <path id="Vector_16" d="M100.859 114.526C102.353 113.893 104.079 114.407 105.679 114.137C107.557 113.82 109.238 112.428 111.134 112.604C112.033 112.77 112.906 113.054 113.732 113.447C114.146 113.642 114.595 113.75 115.052 113.767C115.51 113.783 115.965 113.707 116.392 113.542C116.596 113.448 116.776 113.309 116.919 113.137C117.062 112.964 117.165 112.762 117.221 112.544C117.276 112.327 117.283 112.1 117.239 111.879C117.196 111.659 117.104 111.451 116.971 111.271C118.576 111.13 120.093 110.477 121.298 109.408C121.539 109.159 121.817 108.95 122.124 108.789C122.482 108.696 122.855 108.677 123.22 108.734C123.585 108.79 123.934 108.922 124.247 109.119L127.034 110.404C127.662 110.626 128.215 111.021 128.627 111.544C128.959 112.061 129.024 112.756 129.493 113.152C130.093 113.657 130.988 113.41 131.771 113.459C132.481 113.529 133.141 113.856 133.625 114.379C134.11 114.903 134.386 115.586 134.4 116.299C134.389 117.117 134.092 118.121 134.739 118.622C135.114 118.912 135.647 118.866 136.086 119.044C137.226 119.507 137.23 121.093 137.062 122.311C136.894 123.529 136.977 125.136 138.148 125.511C138.973 125.775 139.816 125.212 140.672 125.087C141.965 124.897 143.161 125.706 144.311 126.324C145.462 126.943 146.99 127.36 147.988 126.517C148.916 125.731 148.856 124.295 148.601 123.107C148.235 121.403 147.633 119.758 146.814 118.22C146.51 117.767 146.332 117.242 146.295 116.699C146.365 116.316 146.515 115.952 146.735 115.632C146.955 115.311 147.241 115.041 147.573 114.839C148.983 113.724 150.605 112.602 151.061 110.864C151.396 109.588 151.019 108.243 151.048 106.924C151.084 105.32 151.722 103.722 151.423 102.145C150.88 99.287 147.699 97.9115 145.646 95.8507C142.825 93.0189 141.908 88.4896 138.579 86.2778C135.915 84.5084 132.43 84.7196 129.397 83.7072C126.064 82.5951 123.382 80.0401 120.095 78.8006C118.301 78.139 116.382 77.8825 114.477 78.0496C112.572 78.2167 110.728 78.8032 109.076 79.7671C108.095 80.4944 107 81.0537 105.836 81.4223C104.856 81.5358 103.865 81.5243 102.888 81.3881C100.945 81.2878 99.0089 81.6873 97.2644 82.5483C96.5967 82.8152 96.0407 83.3028 95.689 83.93C95.1005 85.2371 95.9555 87.2804 94.6654 87.9054C94.0639 88.1968 93.3538 87.9177 92.6857 87.9323C91.3863 87.9609 90.3867 89.0915 89.7685 90.2347C89.2864 91.4432 88.5944 92.5569 87.7244 93.5244C86.1361 94.9154 83.2506 95.1453 82.8356 97.2153C82.8281 98.0918 82.8779 98.9677 82.9846 99.8377C82.8646 101.672 80.9014 103.066 81.0039 104.902C81.1221 107.019 83.8121 108.054 84.5311 110.049C85.0787 111.568 84.3581 113.21 83.8623 114.747C83.3666 116.283 83.217 118.253 84.4974 119.236C84.9995 119.622 85.645 119.78 86.157 120.153C87.4819 121.116 87.4652 123.061 87.3181 124.693C87.2333 125.031 87.2328 125.386 87.3167 125.725C87.4006 126.063 87.5664 126.377 87.7994 126.637C88.0182 126.769 88.2627 126.853 88.5166 126.884C88.7705 126.914 89.028 126.89 89.2718 126.813C90.0674 126.621 90.8151 126.267 91.4692 125.775C92.1233 125.283 92.6699 124.662 93.0756 123.951C93.5022 123.246 93.588 122.624 94.3631 122.25C94.889 121.996 95.5277 122.222 96.0631 121.893C98.6101 120.325 97.7333 115.851 100.859 114.526Z" fill="#2F2E41"/>
            </g>
            <g id="waitEclm">
            <circle id="Ellipse 1" cx="116.923" cy="50.2141" r="4" transform="rotate(15.5 116.923 50.2141)" fill="#FF7373"/>
            <circle id="Ellipse 3" cx="120.077" cy="38.8433" r="3.4" transform="rotate(15.5 120.077 38.8433)" fill="#FF7373"/>
            <circle id="Ellipse 2" cx="129.644" cy="4.34529" r="3.4" transform="rotate(15.5 129.644 4.34529)" fill="#FF7373"/>
            <rect id="Rectangle 1" x="126.207" y="4.01489" width="6.8" height="35.2" transform="rotate(15.5 126.207 4.01489)" fill="#FF7373"/>
            </g>
        </svg><br>
        <span class="dltMsg">Please don't leave us :-(</span>
</body>
</html>