<section class="main-section">
    <div class="wrapper-50 margin-auto center">
        <?php if (isset($_SESSION['ERRORS'])): ?>
            <div class="alert alert-danger">
                <?php if (is_array($_SESSION['ERRORS'])): ?>
                    <?php foreach ($_SESSION['ERRORS'] as $error): ?>
                        <?= $error ?>
                        <br>
                    <?php endforeach ?>
                <?php else: ?>
                    <?= $_SESSION['ERRORS']; ?>
                <?php endif; ?>
                <?php unset($_SESSION['ERRORS']); ?>
            </div>
        <?php endif; ?>

        <?php if (isset($_SESSION['SUCCESS'])): ?>
            <div class="alert alert-success">
                <?php echo htmlspecialchars($_SESSION['SUCCESS']);
                unset($_SESSION['SUCCESS']); ?>
            </div>
        <?php endif; ?>

        <h2>Login</h2>
        <form class="form" action="index.php?ctrl=user&action=doLogin" method="POST">
            <input type="email" name="email" placeholder="Mail" required /><br>
            <input type="password" name="password" placeholder="Password" required /><br>
            <p>
                <input type="submit" class="submit-btn" value="Connect">
            </p>
        </form>
        <p></p>

        <div class="create-account">You don't have an account ? <a href='index.php?ctrl=user&action=create'>Create
                one</a> !</div>
    </div>
</section>