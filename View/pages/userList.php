<section class="main-section">
    <div class="table-container">
        <h2>Gestion des utilisateurs</h2>
        
        <table class="user-table">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Email</th>
                    <th>Adresse</th>
                    <th>Code Postal</th>
                    <th>Ville</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($users)): ?>
                    <tr>
                        <td colspan="6" style="text-align:center;">Aucun utilisateur trouvé.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($users as $user): ?>
                        <tr>
                            <td><?= htmlspecialchars($user->getLastName()) ?></td>
                            <td><?= htmlspecialchars($user->getFirstName()) ?></td>
                            <td>
                                <a href="mailto:<?= htmlspecialchars($user->getEmail()) ?>">
                                    <?= htmlspecialchars($user->getEmail()) ?>
                                </a>
                            </td>
                            <td><?= htmlspecialchars($user->getAddress()) ?></td>
                            <td><?= htmlspecialchars($user->getPostalCode()) ?></td>
                            <td><?= htmlspecialchars($user->getCity()) ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</section>