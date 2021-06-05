<div id="main">
    <article>
        <div class="form_acc">
            <form method="post">
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" id="email" placeholder="name@example.com"
                           required>
                </div>
                <div class="mb-3">
                    <label for="haslo" class="form-label">Haslo</label>
                    <input type="password" name="password" class="form-control" id="haslo" maxlength="254" required>
                </div>
                <button type="submit" name="acc_zaloguj" class="btn btn-outline-success">Zaloguj sie</button>
            </form>
            <?php
            if (isset($_POST['acc_zaloguj'])) {
                include "../server/sign_in.php";
            }
            ?>
        </div>
    </article>
</div>