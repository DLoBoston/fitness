<html>
    <head>
        <title>My Fitness App</title>
    </head>
<body>
    
<header>
    <h1><a href="/">My Fitness App</a></h1>
    <?php if (isset($_SESSION['userId'])): ?>
        <!--  Only display navigation to logged in users  -->
        <nav>
            <ul>
                <li><a href="/my/logout">Logout</a></li>
            </ul>
        </nav>
    <?php endif; ?>
</header>
    
