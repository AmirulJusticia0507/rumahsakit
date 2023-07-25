<?php include 'koneksi.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Login</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">Halaman Login</h4>
                    </div>
                    <div class="card-body">
                        <form action="proses_login.php" method="POST">
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" class="form-control" id="username" name="username" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <div class="form-group">
                                <label for="captcha">CAPTCHA</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="captcha" name="captcha" required>
                                    <div class="input-group-append">
                                        <span class="input-group-text" id="captchaImageContainer">
                                            <!-- CAPTCHA Image will be added here -->
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-block">Login</button>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer">
                        <div class="text-center">
                            <p>Belum punya akun? <a href="register.php">Register</a></p>
                            <p>Lupa password? <a href="lupa_password.php">Reset Password</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript to generate and update the CAPTCHA image -->
    <script>
        // Function to generate random string for the CAPTCHA
        function generateCaptcha() {
            var chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
            var captcha = "";
            for (var i = 0; i < 6; i++) {
                captcha += chars.charAt(Math.floor(Math.random() * chars.length));
            }
            return captcha;
        }

        // Function to set the CAPTCHA image and value
        function setCaptcha() {
            var captchaText = generateCaptcha();
            var captchaImage = document.getElementById("captchaImageContainer");
            captchaImage.innerHTML = '<img src="captcha.php?captcha=' + captchaText + '" alt="CAPTCHA Image">';
            document.getElementById("captcha").value = captchaText;
        }

        // Call the setCaptcha function on page load
        window.onload = function() {
            setCaptcha();
        };
    </script>
</body>
</html>
