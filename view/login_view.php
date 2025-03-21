
<div class="d-flex align-items-center justify-content-center vh-100">
    <div class="card p-4 shadow-lg" style="width: 100%; max-width: 400px; border-radius: 15px;">
        <div class="card-body">
        
            <h3 class="text-center mb-4">Login</h3>
            <form method="post" action="login.php"> 
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Email Address</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email" required>
                    </div>
                    <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Password</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-lock"></i></span>
                        <input type="password" class="form-control" id="exampleInputPassword1" name="password" required>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary w-100">Login</button>
        
                <div class="text-center mt-3">
                    <a href="signup.php" class="text-decoration-none">Don't have an account?</a>
                </div>

            </form>
        </div>
    </div>
</div>
