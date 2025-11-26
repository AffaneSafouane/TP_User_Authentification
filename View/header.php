<header>
    <div id="info-bar">
        <a href="index.php">My wonderful platform</a>
    </div>

    <div id="banner-bloc">
        <h1>TP Authentification et MVC</h1>
    </div>

    <div id="account_bar">
        <div class="connection center">
            <?php if (isset($_SESSION['USER'])): ?>
                <a href="./index.php?ctrl=user&action=logout" class="no-deco" title="Logout">
                    <i class="fas fa-user"></i>
                    <div class="text">Logout</div>
                </a>
            <?php else: ?>
                <a href="./index.php?ctrl=user&action=login" class="no-deco" title="Login or create account">
                    <i class="fas fa-user"></i>
                    <div class="text">Login</div>
                </a>
            <?php endif; ?>
        </div>
    </div>

    <ul id="menu_bar">
        <a href="./index.php?ctrl=user&action=usersList" class="no-deco">
            <li>Liste des utilisateurs</li>
        </a>
        <a href="./" class="no-deco">
            <li>Le mémoire</li>
        </a>
        <a href="./" class="no-deco">
            <li>La soutenance</li>
        </a>
        <a href="./" class="no-deco">
            <li>Le carnet de liaison</li>
        </a>
        <a href="./" class="no-deco">
            <li>Les espaces de travail</li>
        </a>
    </ul>
</header>