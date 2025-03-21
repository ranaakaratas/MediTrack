<div class="d-flex align-items-center justify-content-center vh-100">
    <div class="card p-4 shadow-lg" style="width: 100%; max-width: 400px; border-radius: 15px;">
        <div class="card-body">
            <h3 class="text-center mb-4">Create an Account</h3>
            <form method="post" action="signup.php">
                <div class="mb-3">
                    <label for="signupName" class="form-label">Full Name</label>
                    <input type="text" class="form-control" id="signupName" name="name" required>
                </div>
                <div class="mb-3">
                    <label for="signupDob" class="form-label">Date of Birth</label>
                    <input type="date" class="form-control" id="signupDob" name="dob" required>
                </div>
                <div class="mb-3">
                    <label for="signupGender" class="form-label">Gender</label>
                    <select class="form-control" id="signupGender" name="gender" required>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                        <option value="other">Other</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="signupPhone" class="form-label">Phone Number</label>
                    <input type="text" class="form-control" id="signupPhone" name="phoneNo" required>
                </div>
                <div class="mb-3">
                    <label for="signupMedicalNotes" class="form-label">Medical Notes</label>
                    <textarea class="form-control" id="signupMedicalNotes" name="medicalNotes" rows="3"></textarea>
                </div>
                <div class="mb-3">
                    <label for="signupDoctorId" class="form-label">Doctor ID</label>
                    <?php if (!empty($doctors)): ?>
                    <ul class="list-group mb-3">
                        <?php foreach ($doctors as $doctor): ?>
                            <li class="list-group-item">
                                <strong>Doctor:</strong> <?= htmlspecialchars($doctor['name']) ?> |
                                <input type="radio" name="doctorId" value="<?= $doctor['id'] ?>" required>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
                </div>
                <div class="mb-3">
                    <label for="signupEmail" class="form-label">Email Address</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                        <input type="email" class="form-control" id="signupEmail" name="email" required>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="signupPassword" class="form-label">Password</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-lock"></i></span>
                        <input type="password" class="form-control" id="signupPassword" name="password" required>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="signupPasswordConfirm" class="form-label">Re-enter Password</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-lock"></i></span>
                        <input type="password" class="form-control" id="signupPasswordConfirm" name="password_confirm" required>
                    </div>
                </div>
                <button type="submit" class="btn btn-success w-100">Sign Up</button>
                <div class="text-center mt-3">
                    <a href="login.php" class="text-decoration-none">Already have an account? Login</a>
                </div>
            </form>
        </div>
    </div>
</div>
