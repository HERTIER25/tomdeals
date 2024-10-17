<?php
$Phone = '250785068810';
session_start();
if (isset($_SESSION['unique_code'])) {
    echo '
    <script type="text/javascript">
    window.location.href="dealpage.php";
    </script>
    ';
}
include './database/connection.php';
$category_sql = mysqli_query($conn, "SELECT * FROM category  WHERE item > 0");
$sql4 = mysqli_query($conn, " SELECT * FROM item  WHERE status='Approved' ORDER BY iid DESC ");
$new_arrival = mysqli_query($conn, "SELECT * FROM item WHERE status='Approved' ORDER BY iid DESC LIMIT 6");
$num_row = mysqli_num_rows($sql4);
$num_arrival = mysqli_num_rows($new_arrival);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1">
    <link rel="stylesheet" href="./style/style.css">
    <link rel="shortcut icon" type="image/x-icon" href="./mediaFiles/tomDealsLogo.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
    <link href="https://use.fontawesome.com/releases/v5.0.4/css/all.css" rel="stylesheet">
      <!-- Swiper CSS -->
<link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">

<!-- Swiper JS -->
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

    <title>TomDeals</title>
</head>

<body>
    <nav class="nav-bar">
        <div class="nav-container">
            <div class="nav-navLogo">
                <a href="./index.php">
                    <img src="./mediaFiles/tomDealsLogo.png" width="100%" height="100%" alt="logo">
                </a>
            </div>
            <div class="nav-navSearch">
                
                <form action="search_page.php" method="POST" class="search_form searchForm">
                    <input type="text" class="search-input search_field" name="search_data"
                        placeholder="Search items or categories" required>
                    <button type="submit" class="search-button sbtn" name="submit-btn-1"><i class="fas fa-search"></i></button>
                </form>
                
                <!-- <div class="container text-dark">
                        <div class="row rows">

                        </div>
                    </div> -->

            </div>
            <div class="top-nav-drop">
                <i class="fas fa-bars fa-bars-top" id="topDrop"></i>
            </div>
            <div class="nav-navLeft" id="NavNavLeft">
            <ul class="menu">
                    <li><a href="./index.php"><i class="fas fa-home"></i> Home</a></li>
                    <li><a href="./Support.php"><i class="fas fa-users"></i> Feedback</a></li>
                    <li><a href="./SignIn.php"><i class="fas fa-sign-in-alt"></i> SignIn</a></li>
                    <li><a href="./SignUp.php"><i class="fas fa-sign-out-alt"></i> SignUp</a></li>
                    <li><a href="contact.php"><i class="fas fa-sign-in-alt"></i>contact us</a></li>
                </ul>
            </div>
        </div>
        
    </nav>
    <!-- Menu Button -->
    <button class="menu-button" onclick="toggleMenu()">Menu</button>

    <!-- JavaScript -->
    <script>
        function toggleMenu() {
            var menu = document.querySelector('.menu');
            menu.classList.toggle('show');
        }
    </script>
    <div class="body-container">
         
        <div class="nav-2">

            <div class="side-nav-drop">
                <i class="fas fa-bars fa-bars-side"></i>
            </div>
           <div class="nav-2-buttom1">
            <div class="nav-2-buttons">
                <a href="#allProd"><button>All</button></a>
                <a href="#newArrivars"><button>Today's deal</button></a>
                <a href="./Support.php"><button>Customer Service</button></a>
                <a href="#"><button onclick="alert('Please! create account and Make login first');">UploadNow</button></a>
            </div>
            </div>
        </div>  
        <?php
        include('./components/homeslider.php');
        ?>
        <!-- start of main body-->
        <div class="main-body">
        <div class="swiper-container">
    <div class="swiper-wrapper">
        <div class="swiper-slide">
            <img src="assets/images/img-box/brand-1.png" alt="Brand 1">
        </div>
        <div class="swiper-slide">
            <img src="assets/images/img-box/brand-2.png" alt="Brand 2">
        </div>
        <div class="swiper-slide">
            <img src="assets/images/img-box/brand-3.png" alt="Brand 3">
        </div>
        <div class="swiper-slide">
            <img src="assets/images/img-box/brand-3.png" alt="Brand 3">
        </div>
        <!-- More slides -->
    </div>

    <!-- Pagination -->
    <div class="swiper-pagination"></div>
            </div>
<script>
    var swiper = new Swiper('.swiper-container', {
        slidesPerView: 5,
        spaceBetween: 30,
        loop: true,
        autoplay: {
            delay: 3000,
            disableOnInteraction: false,
        },
        breakpoints: {
            768: {
                slidesPerView: 3,
                spaceBetween: 20,
            },
            480: {
                slidesPerView: 2,
                spaceBetween: 10,
            },
        },
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
    });
</script>
            <div class="side-nav">
                <div class="categories-heading">Categories</div>
                <div class="sideNavContents">
                    <div>
                        <!--                    <div><h3>Cars</h3></div>-->
                        <div>
                            <?php
                            while ($rows = mysqli_fetch_assoc($category_sql)) {
                                ?>
                                <a href="index?cate_id=<?php echo $rows['cate_id']; ?>"><button>
                                        <?php echo $rows['cate_name']; ?>
                                    </button></a>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                    <div>
                    </div>
                </div>
            </div>
            <div class="items-container" id="newArrivars">
                <div class="new-arrivars-heading">
                    New Arrivals - Discounts
                </div>
                <div class="new-arrivals-deals">
                    <!-- <div class="productRowView"> -->
                    <?php
                    if ($num_arrival > 0) {
                        while ($row_arr = mysqli_fetch_assoc($new_arrival)) {
                            ?>
                            <div class="card col-md-4 new-arrival-prod">
                                <div class="new-prod-image">
                                    <a href="./item?detail_id=<?php echo $row_arr['iid']; ?>">
                                        <img src='./mediaFiles/<?php echo $row_arr['item_picture']; ?>'>
                                    </a>
                                </div>
                                <div class="card-body ">
                                    <br>
                                    <span class="card-text noWrapText">
                                        <?php echo $row_arr['short_description']; ?>
                                    </span>
                                    <!-- <span class="card-text">Size:<?php echo $row_arr['long_description']; ?></span>
                                        <br> -->
                                    <!-- <div class="new-prod-price"> -->
                                    <span class="card-text PriceNewArrival">Price:
                                        <?php echo number_format($row_arr['amount']);
                                        echo $row_arr['currency']; ?>&nbsp;
                                    </span>
                                    <br>
                                    <span><a class="fav-prod" target="_blank"
                                            href="https://wa.me/<?php echo $Phone ?>?text=http://tomdeals.rw/item?detail_id=<?php echo $row_arr['iid']; ?>%0a%0aI'm%20inquiring%20about%20this%20Item">Make
                                            Deal</a></span>
                                    <!-- <span><a class="fav-prod"  onclick="alert('Please! create account and Make login first');">Make Deal</a></span> -->
                                </div>

                            </div>
                            

                            <?php
                        }
                    } else {
                        ?>
                        <div class="alert alert-primary" role="alert">
                            No new arrival item was found in the store
                        </div>
                        <?php
                    }
                    ?>

                    <!--New Arrival Porduct 1-->
                    <!-- </div> -->
                </div>
                <div class="new-arrivars-heading">
                    All Products

                </div>
                <!--product table-->
                <div class="prod-nav" id="allProd">
                    <div class="container">
                        <div class="productRowView">
                            <?php
                            $sql4 = mysqli_query($conn, "SELECT * FROM item WHERE status= 'Approved' ORDER BY iid DESC ");
                            if (isset($_GET['cate_id'])) {
                                include 'category.php';
                            } else {
                                if ($num_row > 0) {
                                    while ($row = mysqli_fetch_assoc($sql4)) {
                                        ?>
                                        <div class="card product">
                                            <div class="prod-image">
                                                <a href="./item?detail_id=<?php echo $row['iid']; ?>">
                                                    <img src='./mediaFiles/<?php echo $row['item_picture']; ?>'>
                                                </a>
                                            </div>
                                            <div class="card-body">
                                                <div class="ItemDetails">
                                                    <div class="prod-name">
                                                        <?php echo $row['item_type'] . ' ' . $row['province'] . ' ' . $row['district']; ?>
                                                    </div>
                                                    <!-- <div class="SizeAndLocation"> -->
                                                        <div>
                                                            <div class="prod-price">Size</div>

                                                            <div class="fa-vector-square"><i class="fas fa-vector-square"></i>
                                                                <?php echo $row['long_description']; ?>
                                                            </div>
                                                        </div>
                                                        
                                                    <!-- </div> -->
                                                    <div>
                                                            <div class="prod-price">Location</div>
                                                            <div><i class="fa-solid fa-location-dot"></i>
                                                                <?php echo $row['sector']; ?>
                                                            </div>
                                                        </div>
                                                    <div class="prod-price">
                                                        Price<br>
                                                        <span class="Price">
                                                            <?php echo $row['currency'] . number_format($row['amount']); ?>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="indexOptions">
                                                    <!-- <a class="start-deal"
                                                        href="./messagepage?item=<?php echo $row['iid']; ?>">Make Deal</a> -->
                                                    <a class="start-deal" target="_blank"
                                                        href="https://wa.me/<?php echo $Phone ?>?text=http://tomdeals.rw/item?detail_id=<?php echo $row['iid']; ?>%0a%0aI'm%20inquiring%20about%20this%20Item">Make
                                                        Deal</a>
                                                    <a class="start-deal" href="./item.php?detail_id=<?php echo $row['iid']; ?>">View</a>
                                                </div>
                                                
                                            </div>
                                        </div>
                                        <?php
                                    }
                                } else {
                                    ?>
                                    <div class="alert alert-primary" role="alert">
                                        No new arrival item was found in the store
                                    </div>
                                    <?php
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end of main body-->
    </div>
    <?php
    include ('./components/footer.php');
    ?>
    <script type="text/javascript" src="./javascript/script.js"></script>
</body>

</html>