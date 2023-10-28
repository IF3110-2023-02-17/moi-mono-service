<head>
    <link rel="stylesheet" type="text/css" href="/styles/others/navbar.css">
    <script type="text/javascript" src="/js/others/navbar.js" defer></script>
</head>

<header class="navbar">
    <!-- <nav class="nav-wrapper"> -->
        <div class="navbar-title">
            <a href="/home">
                <img class="navbar-img" src="/logo.svg" alt="MOI logo" />
            </a>
        </div>
        
        <a href="#" class="toggle-button">
            <span class="bar"></span>
            <span class="bar"></span>
            <span class="bar"></span>
        </a>
        <div class="navbar-links">
            <ul >
                <li><a href="/movie/search">Search</a></li>
                <li><a href="/review">Review</a></li>
                <!-- <li><a href="/user/login">Login</a></li>
                <li><a href="/user/register">Register</a></li> -->
                <?php if($this->data['isLogin']) : ?>
                    <li><a href="/user/logout">Logout</a></li>
                <?php else: ?>
                    <li><a href="/user/login">Login</a></li>
                <?php endif; ?>
                <li><a href="/home">Home</a></li>
                
            </ul>
        </div>
    <!-- </nav> -->
</header>