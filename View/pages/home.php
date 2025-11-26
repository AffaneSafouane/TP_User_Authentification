<section id="main-section">
    <?php if (isset($_SESSION['SUCCESS'])): ?>
        <div class="alert alert-success">
            <?php echo htmlspecialchars($_SESSION['SUCCESS']);
            unset($_SESSION['SUCCESS']); ?>
        </div>
    <?php endif; ?>

    <!-- Monthly box -->
    <div id="monthly-box">
    </div>
    <!-- End Monthly Box -->

    <div id="newItems">
    </div>
</section>