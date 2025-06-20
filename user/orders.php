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
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>orders</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- custom admin css file link  -->
    <link rel="stylesheet" href="css/style.css">

</head>

<body>

    <?php @include 'header.php'; ?>

    <section class="heading">
        <h3>ĐƠN HÀNG CỦA BẠN</h3>
        <p> <a href="home.php">Trang chủ</a> / Đặt hàng </p>
    </section>

    <section class="placed-orders">

        <h1 class="title">Đơn đã đặt hàng</h1>

        <div class="box-container">

            <?php
            $select_orders = mysqli_query($conn, "SELECT * FROM `orders` WHERE user_id = '$user_id'") or die('query failed');
            if (mysqli_num_rows($select_orders) > 0) {
                while ($fetch_orders = mysqli_fetch_assoc($select_orders)) {
            ?>
                    <div class="box">
                        <p> Thời gian : <span><?php echo $fetch_orders['placed_on']; ?></span> </p>
                        <p> Tên : <span><?php echo $fetch_orders['name']; ?></span> </p>
                        <p> Số diện thoại : <span><?php echo $fetch_orders['number']; ?></span> </p>
                        <p> Email : <span><?php echo $fetch_orders['email']; ?></span> </p>
                        <p> Địa chỉ: <span><?php echo $fetch_orders['address']; ?></span> </p>
                        <p> Phương thức thanh toán: <span><?php echo $fetch_orders['method']; ?></span> </p>
                        <p> Đơn hàng: <span><?php echo $fetch_orders['total_products']; ?></span> </p>
                        <p> Tổng tiền: <span>$<?php echo $fetch_orders['total_price']; ?></span> </p>
                        <p> Trạng thái thanh toán : <span style="color:<?php if ($fetch_orders['payment_status'] == 'pending') {
                                                                    echo 'tomato';
                                                                } else {
                                                                    echo 'green';
                                                                } ?>"><?php echo $fetch_orders['payment_status']; ?></span> </p>
                    </div>
            <?php
                }
            } else {
                echo '<p class="empty">Chưa có đặt hàng!</p>';
            }
            ?>
        </div>

    </section>







    <?php @include 'footer.php'; ?>

    <script src="js/script.js"></script>

</body>

</html>