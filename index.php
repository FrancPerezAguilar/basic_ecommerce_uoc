<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-COMMERCE</title>
</head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3"
    crossorigin="anonymous"></script>

<body>
    <?php
        // Hay que cambiar el usuario
        $servername = "localhost:3306";
        $username = "root";
        $password = "";
        $database = "ecommerce";
        // Create connection
        $conn = new mysqli($servername, $username);

        // Check connection
        if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
        }

        $db = mysqli_select_db($conn, $database) or die("Connection failed: " . $db->connect_error);

        #search categories to dynamicaly update the navigation.
        $sql = "SELECT * FROM category";
        $result = mysqli_query($conn, $sql);

        while ($row = mysqli_fetch_assoc($result)) {
            $categories[] = $row["name"];
        }
        sort($categories);
        $navCategories = "";

        foreach($categories as $category){
            $navCategories .= '<li><a class="dropdown-item" href="/categories'.$category.'">'.$category.'</a></li>';
        }

        #query products to show in the front page.
        $sql = "SELECT * FROM products ORDER BY RAND() LIMIT 3";
        $productsRaw = mysqli_query($conn, $sql);

        while ($row = mysqli_fetch_assoc($productsRaw)) {
            $products[] = $row;
        }

        $productCards = "";
        foreach($products as $product){
            $productCards .= '<div class="col"><div class="card" style="width: 18rem;"><img src="./public/testimg.jpg" class="card-img-top" alt=""><div class="card-body"><h5 class="card-title">'.$product["name"].'</h5><p class="card-text">'.$product["description"].'</p><p>'.$product["price"].'</p><a href="#" class="btn btn-primary">Add to cart</a></div></div></div>';
        }



        mysqli_close( $conn );
    ?>
    <nav class="navbar navbar-dark navbar-expand-lg" style="background-color: #2e7eff;">
        <div class="container">
            <a class="navbar-brand" href="#">E-Commerce</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/products.php">Products</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Categories
                        </a>
                        <ul class="dropdown-menu">
                        <?php
                        echo $navCategories;
                        ?>
                        </ul>
                    </li>
                </ul>
                <span class="navbar-text" style="margin-right: 20px;">
                    <a href="#">Log In</a>
                </span>
                <span class="navbar-text">
                    <a href="#"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                            class="bi bi-cart" viewBox="0 0 16 16" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">
                            <path
                                d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l1.313 7h8.17l1.313-7H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                        </svg></i></a>
                </span>
            </div>
        </div>
    </nav>
    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasRightLabel">Shopping Cart</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            ...
        </div>
    </div>
    <div class="container" id="banner" style="position: relative; text-align: center; color: white;">
        <img src="./public/testimg.jpg" class="img-fluid" alt="banner_img">
        <div class="centered" style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);">
            <h1>The best e-commerce ever</h1>
        </div>
    </div>
    <div class="container">
        <div style="text-align: center; padding: 30px">
            <h2>Featured products:</h2>
        </div>
        <div class="container text-center">
            <div class="row">
                <?php
                echo $productCards;
                ?>
            </div>
        </div>
    </div>
    <div class="container">
        <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
            <p class="col-md-4 mb-0 text-muted">© 2022 Company, Inc</p>

            <a href="/" class="col-md-4 d-flex align-items-center justify-content-center mb-3 mb-md-0 me-md-auto link-dark text-decoration-none">
            <svg class="bi me-2" width="40" height="32"><use xlink:href="#bootstrap"></use></svg>
            </a>

            <ul class="nav col-md-4 justify-content-end">
            <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">Home</a></li>
            <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">Features</a></li>
            <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">Pricing</a></li>
            <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">FAQs</a></li>
            <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">About</a></li>
            </ul>
        </footer>
    </div>
</body>

</html>