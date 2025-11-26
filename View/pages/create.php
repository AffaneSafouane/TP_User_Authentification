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

<section id="main-section">
    <div class="wrapper-50 margin-auto center">
        <h2>Create an account</h2>
        <form class="form" action="index.php?ctrl=user&action=doCreate" method="POST">
            <input type="email" name="email" placeholder="Mail" /><br>
            <input type="password" name="password" placeholder="Password" /><br>
            <input type="text" name="lastName" placeholder="Last Name" /><br>
            <input type="text" name="firstName" placeholder="First Name" /><br>
            <input type="text" name="address" placeholder="Address" /><br>
            <input type="text" name="postalCode" placeholder="Postal Code" inputmode="numeric" min="5" max="5" /><br>
            <input type="text" name="city" placeholder="City" /><br>
            <p>
                <input type="submit" class="submit-btn" value="Create">
            </p>
        </form>
        <span></span>
    </div>
</section>