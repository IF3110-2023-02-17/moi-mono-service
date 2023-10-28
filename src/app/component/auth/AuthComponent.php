<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" type="text/css" href="/styles/others/main.css">
    <link rel="stylesheet" type="text/css" href="/styles/others/auth.css">
    <script type="text/javascript" src="/js/others/debounce.js" defer></script>
    <?php if ($this->data["isLogin"]) : ?>
        <script type="text/javascript" src="http://localhost:8080/public/js/auth/login.js" defer></script>
    <?php else : ?>
        <script type="text/javascript" src="http://localhost:8080/public/js/auth/register.js" defer></script>
    <?php endif; ?>
</head>

<body>
    <div class="auth-container">
        <div class="auth-decor">
            <svg class="auth-shapes" viewBox="0 0 640 549" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect x="181.661" width="201.724" height="201.724" transform="rotate(12.5 181.661 0)" fill="#4362EA" />
                <mask id="mask0_0_1" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="0" y="-294" width="640" height="843">
                    <rect y="-294" width="640" height="843" fill="url(#paint0_linear_0_1)" />
                </mask>
                <g mask="url(#mask0_0_1)">
                    <path d="M-72.7773 107C-70.5992 128.055 -54.5325 148.445 -45.0326 166.97C-33.37 189.712 -9.9877 197.209 13.3863 203.159C46.0822 211.481 80.2601 213.342 113.853 212.292C153.594 211.05 179.482 196.145 214.665 179.55C246.224 164.663 276.827 142.651 311.857 136.813C341.439 131.882 385.421 128.994 414.047 138.536C456.035 152.532 470.078 192.848 488.837 228.491C516.827 281.671 561.927 313.481 618.944 331.025C637.976 336.881 660.429 338.76 678.57 346.535C703.702 357.306 721.393 378.04 737.506 399.267C773.764 447.036 780.961 495.437 780.243 554.362C779.41 622.664 716.901 655.323 657.546 667.753C591.055 681.678 517.571 676.044 450.064 674.301C360.117 671.98 274.608 647.164 188.816 622.086C102.717 596.919 23.7197 557.132 -58.6465 522.653C-98.3885 506.017 -110 485.686 -110 443.555C-110 407.975 -103.451 374.62 -100.522 339.47C-96.33 289.165 -88.2868 237.984 -88.2868 187.649C-88.2868 172.384 -82.6461 158.737 -82.083 143.533C-81.7112 133.496 -83.0693 110.431 -72.7773 107Z" fill="#3822E1" />
                </g>
                <rect x="409.808" y="210.595" width="122.074" height="122.074" transform="rotate(-27.5 409.808 210.595)" fill="#EB705C" />
                <g filter="url(#filter0_d_0_1)">
                    <circle cx="482.5" cy="72.5" r="29.5" fill="#F5C844" />
                </g>
                <defs>
                    <filter id="filter0_d_0_1" x="453" y="43" width="92" height="83" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                        <feFlood flood-opacity="0" result="BackgroundImageFix" />
                        <feColorMatrix in="SourceAlpha" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha" />
                        <feOffset dx="24" dy="15" />
                        <feGaussianBlur stdDeviation="4.5" />
                        <feComposite in2="hardAlpha" operator="out" />
                        <feColorMatrix type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.3 0" />
                        <feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow_0_1" />
                        <feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow_0_1" result="shape" />
                    </filter>
                    <linearGradient id="paint0_linear_0_1" x1="355.5" y1="366" x2="320" y2="-1472" gradientUnits="userSpaceOnUse">
                        <stop stop-color="#03034B" />
                        <stop offset="0.978989" stop-color="#3822E1" />
                    </linearGradient>
                </defs>
            </svg>
            <img src="/auth-decor-caption.png" alt="Ready for A Wave of New Beginnings"/>
        </div>
        <div class="auth-form-container">
            <? if ($this->data["isLogin"]) {
                include(dirname(__DIR__) . '/auth/LoginComponent.php');
            } else {
                include(dirname(__DIR__) . '/auth/RegisterComponent.php');
            } ?>
        </div>
    </div>

</body>

</html>