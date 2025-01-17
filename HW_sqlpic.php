<?php
require('db.php');
$src = $_FILES['file']['tmp_name'];
$dst = 'D:/Downloads/' . $_FILES['file']['name'];
if(move_uploaded_file($src, $dst) == 1){
    // echo 'done';
}else{
    // echo 'error code: ' . $_FILES['file']['error'];
}
$contents = file_get_contents($dst);
$sql = "update UserInfo set image = ? where uid = 'A01'";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param('b', $contents);
$stmt->send_long_data(0, $contents);
$stmt->execute();
$stmt->close();
$sql = "select * from UserInfo where uid = 'A01'";
$stmt = $mysqli->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$image = $row['image'];
$mime_type = (new finfo(FILEINFO_MIME_TYPE))->buffer($image);
$image_base64 = base64_encode($image);
$src = "data: $mime_type; base64, $image_base64";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>合作店家</title>
    <!-- 根據文件，加入所需的css樣式檔案 -->
    <link rel="stylesheet" href="../_css/bootstrap.css">
    <!-- navbar與footer相關的css設定 -->
    <link rel="stylesheet" href="./style.css">
    <script src="../_js/bootstrap.bundle.js"></script>
    <!-- CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <style>
        /* 離footer的距離，要設在最靠近footer的頁面 */
        /* 設定包含整個內容的div，會距離底部100px */
        .homehead {
            padding-bottom: 100px;
        }

        .firstpag {
            margin-top: 10vh;
        }


        /* ------------------------------合作店家------------------------------ */

        .firstpag {
            background-color: rgb(204, 212, 230);
            display: flex;
            justify-content: center;
            align-items: center;
            /* height: 100vh; */
            width: 80%;
        }

        .a {
            position: relative;
            /* width: 700px;
            height: 400px; */
            width: 50vw;
            height: 50vh;
            border: #fff 10px solid;
            background-color: rgb(120, 140, 200);
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.445);
            filter: drop-shadow(4px 4px 5px rgba(0, 0, 0, 0.164));
        }

        .b {
            position: absolute;
            /* width: 200px;
            height: 300px; */
            width: 20vw;
            height: 40vh;
            left: 0;
            margin: 75px 50px;
            transition: 1s;
        }

        .b a {
            text-decoration: none;
            color: #fff;
            font: 900 28px '';
        }

        .b h2 {
            /* 鼠标放开时的动画，第一个值是动画的过渡时间
            第二个值是延迟一秒后执行动画 */
            transition: .5s 1s;
            opacity: 0;
            color: rgb(30, 210, 200);
        }

        .b span {
            transition: .5s 1s;
            color: #fff;
            font: 500 15px '';
            position: absolute;
            top: 70px;
        }


        .a:hover .c div {
            /* 设置延迟动画 */
            transition: .5s calc(var(--i)*.1s);
            /* 移动的轨迹 */
            transform: rotateZ(220deg) translate(-200px, 400px);
        }

        .a:hover .b {
            transition: 1s .5s;
            left: 370px;
        }

        .a:hover .b span {
            transition: 1s .5s;
            top: 105px;
        }

        .a:hover .b h2 {
            transition: 1s .5s;
            opacity: 1;
        }

        .c {
            width: 15vw;
            height: 35vh;
            position: absolute;
            /* background-image: url("../fish.jpg"); */
            background-size: cover;
            margin-right: -20vw;
        }

        .f {
            
            width: 8vw;
            height: 15vh;
            position: absolute;
            /* background-image: url("../鮪魚QR.jpg"); */
            background-size: cover;
            /* margin: 0px; */
            margin-right: 20vw;
            opacity: 0;
            transition: .5s;
        }

        .a:hover .f {
            transition: 1s 1.3s;
            opacity: 1;
        }

        .a:hover .c {
            transition: 0.5s 0.5s;
            opacity: 0;
        }

        img{
            width: 100%;
            height: 100%;
        }
    </style>
    <style type="text/css">
        * {
            cursor: url(https://cur.cursors-4u.net/nature/nat-10/nat979.ani), url(https://cur.cursors-4u.net/nature/nat-10/nat979.gif), auto !important;
        }
    </style>

</head>

<body>


    <div class="wrapper content container homehead" style="margin-top: 0px; width: 100%;">
        <!-- navbar 置頂選單部分設定 -->
        <div class="fixed-top">
            <!-- Nav相關設定，例如Nav底色 -->
            <nav class="navbar navbar-expand-lg ti navbar-light" style="background-color: #fff3b9;">
                <div class="container-fluid justify-content-lg-end">
                    <div class="container-fluid justify-content-lg-center" style="width: 20%;">
                        <a class="navbar-brand" href="./HW_home.html"><img src="../小專資源/logo.svg" style="height: 5vh;"></a>
                    </div>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false"
                        aria-label="Toggle navigation">
                        <div class="containerbtn" onclick="myFunction(this)">
                            <div class="bar1"></div>
                            <div class="bar2"></div>
                            <div class="bar3"></div>
                        </div>
                    </button>
                    <script>
                        function myFunction(x) {
                            x.classList.toggle("change");
                        }
                    </script>

                    <div class="collapse navbar-collapse" id="navbarScroll">
                        <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100%;">
                            <li class="nav-item">
                                <a class="mx-2 nav-link" href="./HW_AboutUs.html">關於我們</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="mx-2 nav-link dropdown-toggle" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    狗狗山店
                                </a>
                                <ul class="dropdown-menu dropdown-menu-dark">
                                    <a class="dropdown-item" href="./HW_shop.html">商店一覽</a>
                                    <a class="dropdown-item" href="./HW_shop.html">狗山周邊</a>
                                    <a class="dropdown-item" href="./HW_shop.html">愛物園</a>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a class="mx-2 nav-link" href="./HW_support.html">貓狗助養</a>
                            </li>
                            <li class="nav-item">
                                <a class="mx-2 nav-link" href="#">合作店家</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            <!-- navbar 置頂選單部分設定結束 -->
        </div>

        <!----------------------------------- 網頁內容 ----------------------------------->

        <!------------------------------- 合作店家 ------------------------------->

        <div class="a firstpag">
            <div class="b">
                <a href="https://myship.7-11.com.tw/general/detail/GM2303216336149">新鮮鮪魚皮</a>
                <h2>掃QR-code購買</h2>
                <span>選用新鮮鮪魚皮烘烤的啃咬零食，滿足孩子咬咬的口腔慾，每包的盈餘給狗狗山的孩子買肉肉</span>
            </div>
            <!-- 滑動前圖片 -->
            <div class="c" style="object-fit: cover;">
                <!-- <img src="../小專資源/fish.jpg"> -->
                <img src="<?= $src ?>">
            </div>
            <!-- 滑動後圖片 -->
            <div class="f" style="object-fit: cover;"><img src="../小專資源/鮪魚QR.jpg"></div>
        </div>

        
        <!------------------------------- 合作商店結束 ------------------------------->



    </div>
</body>


<!-- footer -->
<footer class="footer">Copyright © 2023 GouGouSuan. All rights reserved.</footer>
<!-- footer結束 -->

</html>