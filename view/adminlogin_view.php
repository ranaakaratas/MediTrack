
<div class="container d-flex justify-content-center align-items-center" style="height: 100vh;">
    <div class="card shadow p-4" style="min-width: 350px;">
        <h3 class="mb-4 text-center">Clinician Login</h3>

        <?php
                if (isset($error))
                {
                    echo "<div class='alert alert-danger text-center' role='alert'>";
                    echo $error;
                    echo "</div>";
                }
        ?>

        <form method="POST" action="adminlogin.php">
            <div class="mb-3">
                <label for="contactInfo" class="form-label">Clinician Email</label>
                <input type="contactInfo" class="form-control" name="contactInfo" id="contactInfo" required>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Clinician Password</label>
                <input type="password" class="form-control" name="password" id="password" required>
            </div>

            <button type="submit" class="btn btn-primary w-100">Login</button>

            <div class="text-center mt-3">
                <a href="login.php" class="btn btn-outline-secondary w-100">Back to Patient Login</a>
            </div>
        </form>
    </div>
</div>

</body>
</html>
