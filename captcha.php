<?php
session_start();

// Generate a random CAPTCHA text
function generateCaptchaText($length = 6)
{
    $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    $captchaText = '';
    for ($i = 0; $i < $length; $i++) {
        $captchaText .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $captchaText;
}

// Generate CAPTCHA image
function generateCaptchaImage($text)
{
    $width = 120;
    $height = 40;
    $image = imagecreatetruecolor($width, $height);

    // Generate random background color
    $bgColor = imagecolorallocate($image, rand(200, 255), rand(200, 255), rand(200, 255));
    imagefilledrectangle($image, 0, 0, $width, $height, $bgColor);

    // Generate random text color
    $textColor = imagecolorallocate($image, rand(0, 100), rand(0, 100), rand(0, 100));

    // Draw the CAPTCHA text
    imagettftext($image, 20, rand(-10, 10), rand(5, 25), rand(25, 35), $textColor, 'path/to/your/font.ttf', $text);

    // Output the image
    header('Content-type: image/png');
    imagepng($image);
    imagedestroy($image);
}

// Generate new CAPTCHA text and store it in session
$captchaText = generateCaptchaText();
$_SESSION['captcha'] = $captchaText;

// Generate CAPTCHA image and display it
generateCaptchaImage($captchaText);
?>
