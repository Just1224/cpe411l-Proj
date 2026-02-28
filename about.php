<?php

@include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if (!isset($user_id)) {
    header('location:login.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About</title>
    <link rel="icon" href="images/logo2.png" type="image/x-icon"> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="style_users.css">
</head>

<body>

<?php @include 'header.php'; ?>

<section class="heading">
    <h3>About Us</h3>
    <p><a href="index.php">Home</a> / About</p>
</section>

<section class="about">

    <div class="flex">
        <div class="image">
            <img src="images/gigi.jpg" alt="">
        </div>
        <div class="content">
            <h3>Why Choose Us?</h3>
            <p>We take pride in offering premium-quality smoked fish made using traditional methods and the freshest ingredients. Our tinapa is carefully prepared to deliver rich, smoky flavor in every bite. Whether for daily meals or special gatherings, our products guarantee satisfaction, convenience, and a true taste of home.</p>
            <a href="shop.php" class="btn">Shop Now</a>
        </div>
    </div>

    <div class="flex">
        <div class="content">
            <h3>What We Provide?</h3>
            <p>We offer top-quality tinapa (smoked fish) made from fresh, locally sourced ingredients and expertly smoked to perfection. Whether you're buying for your household, reselling, or gifting a taste of tradition, we provide ready-to-eat packs, bulk orders, and customizable bundles to suit your needs. Taste the authentic flavor of home in every bite.</p>
            <a href="contact.php" class="btn">Contact Us</a>
        </div>
        <div class="image">
            <img src="images/bangus.jpg" alt="">
        </div>
    </div>

</section>


<?php @include 'footer.php'; ?>

<script src="js/script.js"></script>

</body>

</html>
