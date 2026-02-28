<?php

@include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
   header('location:login.php');
};

if (isset($_POST['update_product'])) {

   $update_p_id = $_POST['update_p_id'];
   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $price = mysqli_real_escape_string($conn, $_POST['price']);
   $details = mysqli_real_escape_string($conn, $_POST['details']);
   $quantity = mysqli_real_escape_string($conn, $_POST['quantity']);

   mysqli_query($conn, "UPDATE `products` SET name = '$name', details = '$details', price = '$price', quantity = '$quantity' WHERE id = '$update_p_id'") or die('query failed');

   $image = $_FILES['image']['name'];
   $image_size = $_FILES['image']['size'];
   $image_tmp_name = $_FILES['image']['tmp_name'];
   $image_folder = 'uploaded_img/' . $image;
   $old_image = $_POST['update_p_image'];

   if (!empty($image)) {
      if ($image_size > 2000000) {
         $message[] = 'Image File Size is too Large!';
      } else {
         mysqli_query($conn, "UPDATE `products` SET image = '$image' WHERE id = '$update_p_id'") or die('query failed');
         move_uploaded_file($image_tmp_name, $image_folder);
         unlink('uploaded_img/' . $old_image);
         $message[] = 'Image Updated Successfully!';
      }
   }

   $message[] = 'Product Updated Successfully!';
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Update Product</title>
   <link rel="icon" href="images/logo2.png" type="image/x-icon"> 

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <link rel="stylesheet" href="admin_styles.css">
</head>
<body>

<?php @include 'admin_header.php'; ?>

<section class="update-product">

<?php

$update_id = $_GET['update'];
$select_products = mysqli_query($conn, "SELECT * FROM `products` WHERE id = '$update_id'") or die('query failed');
if (mysqli_num_rows($select_products) > 0) {
   while ($fetch_products = mysqli_fetch_assoc($select_products)) {
?>

<form action="" method="post" enctype="multipart/form-data">
   <img src="uploaded_img/<?php echo $fetch_products['image']; ?>" class="image" alt="">
   <input type="hidden" value="<?php echo $fetch_products['id']; ?>" name="update_p_id">
   <input type="hidden" value="<?php echo $fetch_products['image']; ?>" name="update_p_image">

   <input type="text" class="box" value="<?php echo $fetch_products['name']; ?>" required placeholder="Update product name" name="name">
   <input type="number" min="0" class="box" value="<?php echo $fetch_products['price']; ?>" required placeholder="Update product price" name="price">
   <input type="number" min="0" class="box" value="<?php echo $fetch_products['quantity']; ?>" required placeholder="Update quantity" name="quantity">
   <textarea name="details" class="box" required placeholder="Update product details" cols="30" rows="10"><?php echo $fetch_products['details']; ?></textarea>
   <input type="file" accept="image/jpg, image/jpeg, image/png" class="box" name="image">

   <input type="submit" value="Update Product" name="update_product" class="btn">
   <a href="admin_products.php" class="option-btn">Go Back</a>
</form>

<?php
   }
} else {
   echo '<p class="empty">No Product Selected for Update</p>';
}
?>

</section>

<script src="js/admin_script.js"></script>

</body>
</html>
