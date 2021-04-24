<?php
require_once "libs.php";
$userData = [];
if(isset(isAuth()[1])){$userData = isAuth()[1];}
?>
<!DOCTYPE html>
<html lang="en">
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
        <div class="homeHead">
            <svg width="300" height="300" viewBox="0 0 645 464" fill="none" xmlns="http://www.w3.org/2000/svg" class="quesChar">
                <g id="undraw_Questions_re_1fy7 1">
                <g id="hand2">
                <path id="Vector" d="M403.52 209.721C403.39 210.86 403.506 212.013 403.86 213.101C404.213 214.188 404.796 215.183 405.568 216.016C406.339 216.849 407.28 217.498 408.324 217.92C409.368 218.341 410.489 218.524 411.61 218.454L422.093 244.172L430.023 232.172L418.852 209.59C418.614 207.676 417.696 205.918 416.272 204.649C414.849 203.38 413.019 202.688 411.129 202.704C409.239 202.72 407.421 203.443 406.018 204.737C404.616 206.03 403.727 207.804 403.52 209.721L403.52 209.721Z" fill="#A0616A"/>
                <path id="Vector_2" d="M439.41 261.317C438.564 261.316 437.721 261.231 436.891 261.063C434.885 260.674 433.003 259.786 431.412 258.479C429.821 257.172 428.57 255.485 427.768 253.568L413.08 235.286C412.77 234.9 412.544 234.45 412.417 233.967C412.291 233.484 412.267 232.979 412.348 232.486C412.428 231.993 412.611 231.523 412.883 231.108C413.156 230.693 413.512 230.342 413.929 230.079L424.378 223.476C424.764 223.232 425.193 223.069 425.641 222.995C426.089 222.921 426.547 222.939 426.988 223.047C427.43 223.155 427.846 223.351 428.212 223.624C428.579 223.897 428.889 224.241 429.124 224.637L439.476 242.047L459.3 227.091C460.879 226.246 462.702 226.009 464.438 226.423C466.173 226.838 467.705 227.875 468.752 229.347C469.8 230.819 470.294 232.626 470.145 234.439C469.995 236.252 469.211 237.949 467.937 239.221L448.15 257.645C445.825 259.998 442.684 261.318 439.41 261.317Z" fill="#2F2E41"/>
                </g>
                <g id="body2">
                <path id="Vector_3" d="M437.556 453.763H428.195L423.741 416.903H437.558L437.556 453.763Z" fill="#A0616A"/>
                <path id="Vector_4" d="M421.508 451.032H439.562V462.637H410.14C410.14 461.113 410.434 459.604 411.005 458.196C411.577 456.788 412.414 455.509 413.469 454.431C414.525 453.354 415.778 452.499 417.157 451.916C418.537 451.333 420.015 451.032 421.508 451.032Z" fill="#2F2E41"/>
                <g id="Group 5">
                <g id="Group 1">
                <path id="Vector_5" d="M510.099 453.763H500.738L496.283 416.903H510.101L510.099 453.763Z" fill="#A0616A"/>
                <path id="Vector_6" d="M494.05 451.032H512.105V462.637H482.683C482.683 461.113 482.977 459.604 483.548 458.196C484.119 456.788 484.957 455.509 486.012 454.431C487.068 453.354 488.321 452.499 489.7 451.916C491.079 451.333 492.557 451.032 494.05 451.032V451.032Z" fill="#2F2E41"/>
                <path id="Vector_7" d="M487.585 274.697L495.977 255.014C498.015 250.397 498.599 245.248 497.649 240.278C496.698 235.307 494.26 230.76 490.67 227.265C489.933 226.521 489.15 225.825 488.326 225.183C484.185 221.877 479.082 220.075 473.825 220.062C470.29 220.076 466.8 220.869 463.593 222.385C463.318 222.51 463.051 222.642 462.775 222.775C462.249 223.032 461.73 223.313 461.225 223.601C457.938 225.528 455.14 228.216 453.058 231.45C450.975 234.683 449.666 238.371 449.237 242.215L445.533 273.894C444.602 276.38 411.369 366.177 422.992 434.734C423.115 435.466 423.465 436.138 423.99 436.653C424.515 437.168 425.187 437.497 425.909 437.594L437.691 439.231C438.552 439.351 439.424 439.134 440.134 438.624C440.844 438.113 441.338 437.347 441.517 436.48L461.287 340.283C461.41 339.685 461.726 339.147 462.184 338.754C462.642 338.361 463.216 338.136 463.814 338.116C464.412 338.095 464.999 338.28 465.483 338.64C465.966 339 466.317 339.516 466.479 340.104L494.412 441.266C494.611 442.001 495.041 442.649 495.635 443.111C496.229 443.572 496.956 443.822 497.703 443.822C497.926 443.821 498.148 443.8 498.367 443.76L512.761 440.93C513.598 440.771 514.346 440.298 514.859 439.604C515.372 438.911 515.612 438.046 515.533 437.181C513.418 413.103 502.178 292.492 487.585 274.697Z" fill="#2F2E41"/>
                </g>
                <g id="Group 2">
                <path id="Vector_8" d="M472.686 293.925C473.801 293.789 474.873 293.405 475.826 292.801C476.78 292.196 477.592 291.385 478.205 290.426C478.819 289.466 479.219 288.381 479.377 287.246C479.535 286.112 479.448 284.956 479.121 283.859L501.178 267.46L487.898 262.384L468.988 278.735C467.221 279.418 465.76 280.739 464.882 282.447C464.005 284.156 463.772 286.134 464.228 288.007C464.684 289.879 465.796 291.516 467.355 292.606C468.914 293.697 470.811 294.166 472.686 293.925V293.925Z" fill="#A0616A"/>
                <path id="Vector_9" d="M490.296 282.145C490.269 282.145 490.242 282.145 490.216 282.144C489.734 282.132 489.26 282.017 488.824 281.806C488.389 281.595 488.001 281.293 487.687 280.92L478.397 269.856C478.081 269.479 477.846 269.038 477.709 268.562C477.572 268.086 477.536 267.586 477.602 267.094C477.668 266.602 477.836 266.131 478.095 265.71C478.353 265.29 478.695 264.93 479.1 264.655L496.496 252.816L480.736 233.475C479.82 231.915 479.483 230.07 479.789 228.278C480.095 226.486 481.022 224.865 482.401 223.713C483.78 222.561 485.52 221.954 487.301 222.003C489.083 222.052 490.788 222.753 492.104 223.979L511.258 243.086C512.766 244.492 513.917 246.25 514.612 248.21C515.307 250.17 515.526 252.272 515.25 254.338C514.974 256.403 514.212 258.369 513.027 260.067C511.843 261.765 510.273 263.144 508.452 264.086L492.797 281.043C492.475 281.391 492.088 281.668 491.658 281.857C491.228 282.047 490.765 282.144 490.296 282.145Z" fill="#2F2E41"/>
                </g>
                <path id="Vector_10" d="M471.638 248.045C471.489 248.045 471.34 248.035 471.192 248.016C470.545 247.935 469.934 247.667 469.432 247.243C468.93 246.819 468.557 246.257 468.359 245.624L461.377 223.775C461.203 223.223 461.229 222.624 461.453 222.091C461.677 221.557 462.082 221.124 462.595 220.872L462.821 220.763C463.027 220.663 463.23 220.564 463.438 220.47C466.693 218.929 470.237 218.125 473.825 218.113C478.483 218.122 483.038 219.519 486.93 222.133C487.451 222.488 487.816 223.037 487.945 223.663C488.073 224.289 487.956 224.942 487.618 225.481L474.522 246.424C474.215 246.921 473.789 247.33 473.285 247.614C472.78 247.898 472.214 248.046 471.638 248.045V248.045Z" fill="#E6E6E6"/>
                </g>
                </g>
                <g id="head2">
                <path id="Vector_11" d="M479.888 212.797C492.54 212.797 502.796 202.328 502.796 189.413C502.796 176.498 492.54 166.028 479.888 166.028C467.236 166.028 456.98 176.498 456.98 189.413C456.98 202.328 467.236 212.797 479.888 212.797Z" fill="#2F2E41"/>
                <path id="Vector_12" d="M476.407 212.934C486.765 212.934 495.162 204.362 495.162 193.789C495.162 183.215 486.765 174.644 476.407 174.644C466.049 174.644 457.652 183.215 457.652 193.789C457.652 204.362 466.049 212.934 476.407 212.934Z" fill="#A0616A"/>
                <path id="Vector_13" d="M497.949 178.973C502.089 178.973 505.445 175.547 505.445 171.321C505.445 167.095 502.089 163.669 497.949 163.669C493.809 163.669 490.453 167.095 490.453 171.321C490.453 175.547 493.809 178.973 497.949 178.973Z" fill="#2F2E41"/>
                <path id="Vector_14" d="M472.252 162.91C466.986 162.91 461.936 165.045 458.213 168.846C454.49 172.647 452.398 177.802 452.398 183.177V191.751H462.729L467.67 183.177L469.153 191.751H500.505L492.106 183.177C492.106 177.802 490.014 172.647 486.291 168.846C482.567 165.045 477.517 162.91 472.252 162.91V162.91Z" fill="#2F2E41"/>
                <path id="Vector_15" d="M501.802 166.08C502.631 163.434 504.347 161.171 506.649 159.689C508.95 158.207 511.69 157.6 514.387 157.976C519.164 158.792 522.941 162.711 525.191 167.089C527.442 171.467 528.481 176.367 529.994 181.064C531.507 185.761 533.652 190.483 537.472 193.523C541.291 196.564 547.152 197.388 550.903 194.261C550.475 197.52 549.053 200.56 546.84 202.949C544.626 205.339 541.733 206.958 538.569 207.577C535.405 208.195 532.13 207.783 529.208 206.398C526.286 205.013 523.864 202.725 522.286 199.858C520.306 196.264 519.795 192.05 519.208 187.971C518.621 183.891 517.859 179.669 515.496 176.325C513.133 172.98 508.709 170.796 504.955 172.319L501.802 166.08Z" fill="#2F2E41"/>
                </g>
                <g id="body1">
                <path id="Vector_16" d="M96.6276 454.119L105.989 454.118L110.443 417.258L96.6253 417.258L96.6276 454.119Z" fill="#FFB8B8"/>
                <path id="Vector_17" d="M124.044 462.991L94.6216 462.993L94.621 451.388L112.676 451.388C115.691 451.388 118.582 452.61 120.714 454.786C122.846 456.962 124.044 459.914 124.044 462.991V462.991L124.044 462.991Z" fill="#2F2E41"/>
                <path id="Vector_18" d="M63.0289 454.119L72.39 454.118L76.8441 417.258L63.0266 417.258L63.0289 454.119Z" fill="#FFB8B8"/>
                <path id="Vector_19" d="M90.4452 462.991L61.0229 462.993L61.0223 451.388L79.0769 451.388C82.0918 451.388 84.9833 452.61 87.1153 454.786C89.2472 456.962 90.445 459.914 90.4452 462.991V462.991L90.4452 462.991Z" fill="#2F2E41"/>
                <path id="Vector_20" d="M71.2096 442.782L62.0654 442.291C61.5939 442.266 61.132 442.145 60.7065 441.937C60.2809 441.728 59.9002 441.435 59.5864 441.075C59.2726 440.714 59.0319 440.294 58.8783 439.839C58.7246 439.383 58.6611 438.9 58.6914 438.419L69.6207 314.897L119.951 328.761L124.8 327.41L109.636 436.761C109.507 437.583 109.107 438.336 108.502 438.895C107.896 439.454 107.123 439.786 106.308 439.836L96.4507 440.304C95.9578 440.332 95.4646 440.256 95.0022 440.079C94.5399 439.902 94.1184 439.63 93.7645 439.279C93.4106 438.927 93.1319 438.505 92.9461 438.038C92.7603 437.571 92.6714 437.07 92.685 436.566L94.471 370.936C94.4794 370.633 94.3761 370.337 94.1815 370.107C93.9869 369.878 93.7151 369.731 93.4197 369.696C93.1243 369.66 92.8267 369.739 92.5855 369.917C92.3443 370.095 92.1771 370.358 92.1167 370.655L74.8921 439.884C74.7295 440.705 74.2928 441.444 73.6566 441.973C73.0204 442.503 72.2239 442.791 71.403 442.788C71.339 442.788 71.2745 442.786 71.2096 442.782Z" fill="#2F2E41"/>
                <path id="Vector_21" d="M67.0826 250.931L69.1447 296.35L69.8902 312.874C69.9199 313.594 70.1592 314.288 70.5773 314.867C70.9955 315.447 71.5737 315.886 72.2378 316.129L120.602 334.013C120.992 334.161 121.406 334.235 121.823 334.232C122.299 334.234 122.771 334.138 123.211 333.95C123.65 333.762 124.048 333.486 124.38 333.138C124.713 332.789 124.973 332.376 125.145 331.923C125.318 331.47 125.399 330.985 125.384 330.499L123.401 248.835C123.271 242.134 120.855 235.691 116.57 230.614C112.284 225.537 106.398 222.146 99.9254 221.025C99.4575 220.952 98.9816 220.879 98.5057 220.814C94.4922 220.306 90.4184 220.701 86.5708 221.972C82.7231 223.244 79.1951 225.36 76.2351 228.173C73.17 231.051 70.7615 234.581 69.18 238.514C67.5984 242.446 66.8824 246.685 67.0825 250.931L67.0826 250.931Z" fill="#CCCCCC"/>
                <path id="Vector_22" d="M143.705 324.95C142.561 324.588 141.516 323.958 140.653 323.11C139.79 322.262 139.133 321.22 138.735 320.067C138.337 318.914 138.208 317.682 138.359 316.469C138.51 315.256 138.937 314.096 139.605 313.081L123.204 290.819L137.357 289.925L150.762 311.203C152.197 312.335 153.196 313.947 153.583 315.756C153.97 317.565 153.72 319.456 152.878 321.096C152.036 322.736 150.656 324.021 148.978 324.726C147.301 325.431 145.434 325.51 143.705 324.95H143.705Z" fill="#FFB8B8"/>
                <path id="Vector_23" d="M132.173 309.053C131.739 308.873 131.344 308.606 131.011 308.269C130.678 307.933 130.413 307.531 130.233 307.09L105.524 246.995C105.039 245.819 104.786 244.556 104.78 243.28C104.773 242.003 105.013 240.738 105.486 239.556C105.958 238.375 106.655 237.3 107.534 236.393C108.414 235.486 109.461 234.764 110.614 234.271C111.767 233.777 113.004 233.519 114.254 233.514C115.504 233.508 116.744 233.754 117.901 234.237C119.058 234.72 120.111 235.432 120.999 236.331C121.887 237.23 122.592 238.298 123.075 239.476L147.784 299.571C148.149 300.462 148.153 301.464 147.795 302.358C147.437 303.252 146.747 303.965 145.875 304.34L134.905 309.039C134.473 309.226 134.01 309.323 133.541 309.325C133.072 309.328 132.607 309.235 132.173 309.053L132.173 309.053Z" fill="#CCCCCC"/>
                <path id="Vector_24" d="M92.2784 306.933L116.011 260.546C116.468 259.654 117.254 258.984 118.195 258.683C119.137 258.381 120.156 258.473 121.031 258.938L155.479 277.303C156.353 277.77 157.01 278.572 157.305 279.533C157.6 280.494 157.51 281.535 157.055 282.428L133.322 328.815C132.865 329.707 132.079 330.377 131.138 330.678C130.196 330.98 129.176 330.888 128.302 330.423L93.8541 312.058C92.9802 311.591 92.3235 310.789 92.0281 309.828C91.7327 308.867 91.8227 307.826 92.2784 306.933Z" fill="#3F3D56"/>
                <path id="Vector_25" d="M108.194 285.74C107.772 284.596 107.094 283.568 106.214 282.739C105.334 281.91 104.276 281.302 103.125 280.964C101.974 280.627 100.762 280.568 99.5844 280.794C98.4072 281.019 97.298 281.523 96.3453 282.263L73.6063 266.865L73.5676 281.34L95.1669 293.743C96.3592 295.139 97.9948 296.061 99.7867 296.349C101.579 296.636 103.413 296.27 104.967 295.316C106.521 294.361 107.696 292.878 108.286 291.127C108.876 289.376 108.844 287.469 108.194 285.74V285.74Z" fill="#FFB8B8"/>
                <path id="Vector_26" d="M79.4444 288.995L60.8606 273.969C58.8502 273.279 57.0337 272.103 55.5669 270.539C54.1001 268.976 53.0269 267.072 52.4394 264.992C51.8519 262.912 51.7677 260.717 52.1939 258.597C52.6202 256.476 53.5442 254.493 54.8866 252.817L71.7601 230.243C72.9327 228.781 74.5818 227.798 76.4059 227.474C78.23 227.15 80.1074 227.507 81.6947 228.48C83.2821 229.453 84.4735 230.977 85.0511 232.772C85.6287 234.568 85.5539 236.516 84.8404 238.26L71.4897 260.553L91.1097 270.053C91.566 270.274 91.9711 270.591 92.2984 270.983C92.6256 271.376 92.8676 271.835 93.0082 272.33C93.1488 272.825 93.1849 273.345 93.1141 273.855C93.0432 274.366 92.8671 274.855 92.5974 275.291L84.6774 288.085C84.4097 288.517 84.0561 288.887 83.6396 289.17C83.223 289.454 82.7528 289.645 82.2593 289.731C82.2397 289.734 82.22 289.737 82.2003 289.74C81.7154 289.815 81.2207 289.788 80.7467 289.659C80.2726 289.531 79.8294 289.305 79.4444 288.995V288.995Z" fill="#CCCCCC"/>
                </g>
                <g id="head1">
                <path id="Vector_27" d="M98.3083 213.829C108.666 213.829 117.063 205.258 117.063 194.684C117.063 184.111 108.666 175.539 98.3083 175.539C87.9502 175.539 79.5533 184.111 79.5533 194.684C79.5533 205.258 87.9502 213.829 98.3083 213.829Z" fill="#FFB8B8"/>
                <path id="Vector_28" d="M84.1366 207.504C84.0561 207.264 84.0306 207.008 84.0619 206.756C84.0933 206.504 84.1808 206.263 84.3176 206.051C84.4544 205.839 84.637 205.661 84.8513 205.532C85.0657 205.403 85.306 205.326 85.5541 205.307C86.0621 205.335 86.5592 205.468 87.0154 205.698C87.4716 205.927 87.8774 206.249 88.2085 206.644C88.8872 207.442 89.6774 208.135 90.5536 208.699C91.4609 209.166 92.6914 209.099 93.2086 208.209C93.6943 207.374 93.3615 206.254 93.0674 205.284C92.3192 202.814 91.9006 200.252 91.8228 197.668C91.7381 194.784 92.1368 191.773 93.7011 189.524C95.72 186.62 99.3299 185.518 102.746 185.598C106.163 185.678 109.524 186.755 112.908 187.435C114.076 187.67 115.449 187.79 116.231 186.866C117.061 185.883 116.756 184.292 116.403 182.965C115.486 179.522 114.513 175.962 112.382 173.181C110.079 170.292 106.788 168.4 103.173 167.888C99.7019 167.449 96.1787 167.858 92.8927 169.08C87.5389 170.802 82.828 174.152 79.3899 178.682C75.8458 183.499 74.3143 189.553 75.1304 195.519C75.9277 200.716 78.6253 205.41 82.6793 208.657L84.1366 207.504Z" fill="#2F2E41"/>
                </g>
                <g id="qmark">
                <path id="Vector_29" d="M329.415 463.017C348.814 463.017 364.54 446.963 364.54 427.16C364.54 407.357 348.814 391.304 329.415 391.304C310.015 391.304 294.289 407.357 294.289 427.16C294.289 446.963 310.015 463.017 329.415 463.017Z" fill="#3895BF"/>
                <path id="Vector_30" d="M325.652 53.0079C270.755 53.4038 225.806 98.9431 225.026 154.978C225.019 155.495 225.015 159.133 225.016 163.891C225.016 170.867 227.731 177.557 232.563 182.49C237.395 187.423 243.949 190.195 250.783 190.195H250.783C254.17 190.195 257.525 189.512 260.654 188.188C263.783 186.863 266.626 184.922 269.02 182.476C271.415 180.029 273.313 177.125 274.607 173.929C275.901 170.733 276.566 167.309 276.563 163.85C276.56 160.614 276.559 158.374 276.559 158.236C276.557 149.576 278.764 141.065 282.962 133.539C287.16 126.014 293.205 119.734 300.502 115.316C307.799 110.899 316.097 108.497 324.579 108.346C333.061 108.195 341.436 110.301 348.879 114.456C356.323 118.611 362.578 124.673 367.03 132.045C371.482 139.416 373.978 147.844 374.272 156.499C374.565 165.154 372.647 173.738 368.705 181.406C364.763 189.075 358.933 195.564 351.79 200.235L351.799 200.246C351.799 200.246 315.124 224.347 303.943 257.41L303.952 257.412C301.986 264.186 300.99 271.213 300.994 278.278C300.994 281.182 301.162 306.59 301.485 327.212C301.598 334.328 304.447 341.113 309.417 346.103C314.387 351.094 321.079 353.89 328.051 353.888H328.051C331.554 353.888 335.022 353.181 338.257 351.807C341.491 350.434 344.427 348.421 346.896 345.884C349.366 343.348 351.319 340.338 352.645 337.028C353.97 333.718 354.641 330.173 354.62 326.598C354.507 307.711 354.447 285.72 354.447 284.124C354.447 263.822 373.633 243.594 389.392 230.403C407.54 215.214 420.599 194.513 425.845 171.163C427.005 166.356 427.645 161.433 427.753 156.482C427.753 142.831 425.107 129.314 419.967 116.711C414.826 104.108 407.294 92.6675 397.803 83.0492C388.313 73.4309 377.051 65.8247 364.668 60.6688C352.285 55.513 339.025 52.9093 325.652 53.0079V53.0079Z" fill="#3895BF"/>
                <path id="Vector_31" d="M258.058 177.753C251.224 177.753 244.671 174.981 239.838 170.048C235.006 165.115 232.291 158.425 232.291 151.449C232.291 146.691 232.294 143.053 232.301 142.536C232.518 126.239 236.539 110.231 244.029 95.8377C231.723 113.036 224.956 133.712 224.665 155.008C224.658 155.525 224.655 159.163 224.655 163.921C224.655 170.897 227.37 177.587 232.202 182.52C237.035 187.453 243.588 190.224 250.422 190.225V190.225C256.038 190.223 261.499 188.35 265.977 184.89C270.454 181.431 273.703 176.574 275.23 171.057C270.512 175.376 264.396 177.761 258.058 177.753V177.753Z" fill="#3F3D56"/>
                <path id="Vector_32" d="M327.399 108.434C335.299 108.819 342.99 111.156 349.811 115.244C356.632 119.331 362.379 125.048 366.559 131.902C370.738 138.757 373.226 146.544 373.808 154.596C374.39 162.648 373.049 170.724 369.9 178.131C374.455 172.67 377.803 166.271 379.716 159.37C381.628 152.469 382.06 145.228 380.983 138.141C379.906 131.054 377.344 124.287 373.473 118.302C369.601 112.317 364.511 107.255 358.549 103.46C352.588 99.6653 345.894 97.2274 338.926 96.3125C331.958 95.3977 324.878 96.0274 318.169 98.1588C311.461 100.29 305.282 103.873 300.053 108.663C294.824 113.453 290.668 119.338 287.869 125.916C292.707 120.107 298.787 115.51 305.641 112.479C312.494 109.448 319.938 108.064 327.399 108.434V108.434Z" fill="#3F3D56"/>
                <path id="Vector_33" d="M335.326 341.446C328.355 341.448 321.662 338.652 316.692 333.661C311.722 328.671 308.873 321.886 308.76 314.77C308.437 294.148 308.27 268.74 308.27 265.836C308.265 258.771 309.261 251.744 311.227 244.97L311.218 244.968C312.379 241.568 313.781 238.26 315.414 235.068C310.403 241.884 306.415 249.424 303.582 257.44L303.591 257.442C301.625 264.215 300.629 271.243 300.634 278.308C300.634 281.211 300.801 306.62 301.124 327.242C301.237 334.358 304.086 341.142 309.056 346.133C314.026 351.124 320.719 353.92 327.69 353.918V353.918C333.438 353.917 339.031 352.014 343.63 348.493C348.228 344.973 351.585 340.025 353.196 334.393C348.311 338.94 341.937 341.456 335.326 341.446V341.446Z" fill="#3F3D56"/>
                <path id="Vector_34" d="M321.676 454.271C316.686 452.052 312.269 448.68 308.775 444.421C305.28 440.162 302.803 435.132 301.539 429.728C300.275 424.324 300.258 418.694 301.491 413.283C302.723 407.871 305.171 402.826 308.641 398.546C304.618 401.544 301.266 405.382 298.807 409.803C296.348 414.225 294.839 419.13 294.379 424.193C293.919 429.256 294.519 434.361 296.14 439.168C297.76 443.976 300.364 448.377 303.778 452.079C307.192 455.782 311.339 458.7 315.942 460.641C320.546 462.583 325.501 463.502 330.48 463.339C335.458 463.176 340.345 461.934 344.818 459.695C349.29 457.456 353.244 454.272 356.419 450.354C351.467 454.048 345.654 456.354 339.559 457.041C333.463 457.728 327.297 456.773 321.676 454.271V454.271Z" fill="#3F3D56"/>
                </g>
                </g>
            </svg>

            <h1 onclick="location.href='index.php'" onmouseover="this.style.cursor='pointer'">AskLantic</h1>
            <?php
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
            ?>
            <p>Ask your stuff here</p>
            <div>
                <form method='get' action='search.php'>
                    <input placeholder="Search for a tag (seperate tags with spaces)" name='query'><button type='submit' onclick='if(document.getElementsByName("query")[0].value == ""){return false;}'><img src="images/search.svg" alt='search icon'></button>
                </form>
            </div>
        </div>
        <div class="homeBase">
            <?php
                if($userData == []){echo "<button onclick='location.href=\"signup.php\"'>Sign Up</button><button style='border-color:transparent;' onclick='location.href=\"login.php\"'>Login</button>";}
                else{echo "<button onclick='location.href=\"ask_question.php\"'>Ask Question</button>";} 
            ?>
            <h1>Recent Questions</h1>
            <div class="hotQues">
            <?php
            $exst = false;
            $raw_data = $pdo->query("select * from askLantic__questions where isCmnt is NULL order by quesId desc");
            while ($data = $raw_data->fetch(PDO::FETCH_ASSOC)){    
                $exst = true;
                $upvt = getVoteCount($data['quesId']);
                echo '
                <a href="questions.php?q='.md5($data['quesId']."QuestionOfFire@314159265").'" class="menuQues">
                        <div class="upvt">
                            <svg aria-hidden="true" class="m0 svg-icon iconArrowUpLg" width="36" height="36" viewBox="0 0 36 36" fill="rgb(50,120,150"><path d="M2 26h32L18 10 2 26z"></path></svg>
                            <p>'.$upvt.'</p>
                        </div>
                        <div class="ques">
                            <p class="title">'.$data['titl'].'</p>
                            <p class="descr">'.str_replace("[I]","",str_replace("[U]","",str_replace("[C]","",str_replace("[B]","",str_replace("[>]","",str_replace("[!]","",$data['ques'])))))).'</p>
                        </div>
                    </a>
                    ';
                }
                if(!$exst){
                    echo "<span style='font-size:20px;color:rgb(50,120,150);'>No questions found</span>";
                }
                ?>
            </div>
        </div>
    <script>timeSpent();</script>
    </body>
</html>
