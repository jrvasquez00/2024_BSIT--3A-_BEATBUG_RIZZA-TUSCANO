<?php
include ('../myfunctions.php');

$category_id = isset($_GET['product_cat_id']) ? $_GET['product_cat_id'] : '';


?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
        integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous"
        referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="../css/style.css" />
    <title>Products</title>
</head>
<style>

    *{
        text-decoration: none;
    }



    #search form {
        display: flex;
        align-items: center;
        margin-left: 900px;
    }

    #search input[type="text"] {
        width: 170px;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        margin-right: 10px;
        padding: 5px 10px;
    }

    #search button {
        padding: 5px 10px;
        background-color: #0bff9a;
        color: #fff;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    #search button:hover {
        background-color: #a0ffb5;
    }

    .card {
        --font-color: #323232;
        --font-color-sub: #666;
        --bg-color: #c1f4c6;
        --main-color: #323232;
        --main-focus: #147a4c;
        margin: 5px;
        /* Centers the cards horizontally */
        width: 200px;
        height: 280px;
        background: var(--bg-color);
        border: 2px solid var(--main-color);
        box-shadow: 4px 4px var(--main-color);
        border-radius: 5px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        padding: 15px;
        gap: 10px;
    }

    .card-img {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100px;
    }

    .card-img img {
        max-width: 100%;
        max-height: 100%;
        object-fit: contain;
    }

    .card-title {
        font-size: 20px;
        font-weight: 500;
        text-align: center;
        color: var(--font-color);
    }

    .card-subtitle {
        font-size: 14px;
        font-weight: 400;
        color: var(--font-color-sub);
    }

    .card-divider {
        width: 100%;
        border: 1px solid var(--main-color);
        border-radius: 50px;
    }

    .card-footer {
        display: flex;
        flex-direction: row;
        justify-content: space-between;
        align-items: center;
    }

    .card-price {
        font-size: 20px;
        font-weight: 500;
        color: var(--font-color);
    }

    .card-price span {
        font-size: 20px;
        font-weight: 500;
        color: var(--font-color-sub);
    }

    .card-btn {
        height: 40px;
        background: var(--bg-color);
        border: 2px solid var(--main-color);
        border-radius: 5px;
        padding: 0 15px;
        transition: all 0.3s;
    }

    .card-btn svg {
        width: 100%;
        height: 100%;
        fill: var(--main-color);
        transition: all 0.3s;
    }

    .card-btn:hover {
        border: 2px solid var(--main-focus);
    }

    .card-btn:hover svg {
        fill: var(--main-focus);
    }

    .card-btn:active {
        transform: translateY(3px);
    }

    .quantity-input {
        width: 35px;
        text-align: center;
        border: 1px solid #ccc;
        border-radius: 5px;
        padding: 5px;
    }

    .row {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        /* Center the items horizontally */
        gap: 2px;
        /* Add some space between the cards */
        padding-top: 10px;
        /* Adjust padding as needed */
        padding-bottom: 40px;
    }

    .top {
        position: fixed;
        bottom: 2.1rem;
        right: 1.0rem;
    }

    .top i {
        color: #000;
        background: #fdd1bdf1;
        font-size: 14px;
        padding: 10px;
        border-radius: 5px;
    }
</style>

<body>
    <header>
        <nav>
            <ul>
                <li><a href="client.php">Home</a></li>
                <li><a href="our products.php">See Our Products</a></li>
                <li><a href="#contacts">Contacts</a></li>
                <li><a href="../index.php">Logout</a></li>
                <li><a href="order.php">My Orders</a></li>
                <li class="cart">
                    <a href="cart.php">
                        <img src="../img/shopping-cart.png" alt="Shopping Cart">
                    </a>
                </li>

                <section id="search">
                    <form action="search results.php" method="get">
                        <input type="text" name="query" placeholder="Search for products..." required>
                        <button type="submit">Search</button>
                    </form>
                </section>
            </ul>
        </nav>
    </header>

    <div class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h1 class="display-4">OUR PRODUCTS</h1>

                    <h2 class="mt-5">Categories</h2>
                    <div class="row">
                        <?php
                        $categories = getAllActive("product_cat");

                        if ($categories === false) {
                            echo "Error fetching categories: " . mysqli_error($con);
                        } else {
                            if (mysqli_num_rows($categories) > 0) {
                                foreach ($categories as $product_cat) {
                                    echo "<div class='col-md-2 mb-2' style='margin-right: 25px;'>";
                                    echo "<a href='#' data-category-id='" . $product_cat['product_cat_id'] . "' class='category-link'>";
                                    echo "<img src='../uploads/{$product_cat['product_cat_image']}' alt='{$product_cat['product_cat_name']}' width='90'>";
                                    echo "<br>";
                                    echo $product_cat['product_cat_name'];
                                    echo "</a>";
                                    echo "</div>";
                                }
                            } else {
                                echo "No categories found";
                            }
                        }
                        ?>
                    </div>

                    <h2 class="mt-5">Products</h2>
                    <div class="product-container row">
                        <?php
                        $ourproducts = getAllActive("products");
                        if ($ourproducts === false) {
                            echo "Error fetching products: " . mysqli_error($con);
                        } else {
                            if (mysqli_num_rows($ourproducts) > 0) {
                                foreach ($ourproducts as $product) { ?>
                                    <section class="row">
                                        <div class="card">
                                            <div class="card-img">
                                                <img src="../uploads/<?php echo $product['product_image']; ?>" alt="product_image"
                                                    width="100">
                                            </div>
                                            <div class="card-title"><?php echo $product['product_name']; ?></div>
                                            <div class="card-subtitle"><?php echo $product['product_desc']; ?></div>
                                            <hr class="card-divider">
                                            <div class="card-footer">
                                                <div class="card-price"><span>₱</span><?php echo $product['product_price']; ?></div>
                                                <form action="process_add_to_cart.php" method="get">
                                                    <div class="quantity">
                                                        <input type="hidden" name="product_id"
                                                            value="<?php echo $product['product_id']; ?>">
                                                        <input type="number" name="qty" value="1" min="1" class="quantity-input"
                                                            style="width: 40px;">
                                                    </div>
                                                    <button type="submit" class="btn btn-primary">
                                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="34"
                                                            height="24">
                                                            <path
                                                                d="m397.78 316h-205.13a15 15 0 0 1 -14.65-11.67l-34.54-150.48a15 15 0 0 1 14.62-18.36h274.27a15 15 0 0 1 14.65 18.36l-34.6 150.48a15 15 0 0 1 -14.62 11.67zm-193.19-30h181.25l27.67-120.48h-236.6z">
                                                            </path>
                                                            <path
                                                                d="m222 450a57.48 57.48 0 1 1 57.48-57.48 57.54 57.54 0 0 1 -57.48 57.48zm0-84.95a27.48 27.48 0 1 0 27.48 27.47 27.5 27.5 0 0 0 -27.48-27.47z">
                                                            </path>
                                                            <path
                                                                d="m368.42 450a57.48 57.48 0 1 1 57.48-57.48 57.54 57.54 0 0 1 -57.48 57.48zm0-84.95a27.48 27.48 0 1 0 27.48 27.47 27.5 27.5 0 0 0 -27.48-27.47z">
                                                            </path>
                                                            <path
                                                                d="m158.08 165.49a15 15 0 0 1 -14.23-10.26l-25.71-77.23h-47.44a15 15 0 1 1 0-30h58.3a15 15 0 0 1 14.23 10.26l29.13 87.49a15 15 0 0 1 -14.23 19.74z">
                                                            </path>
                                                        </svg>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </section>
                                    <?php
                                }
                            } else {
                                echo "No products found";
                            }
                        }
                        ?>
                    </div>

                    <section id="below">
                        <h1>Bibim-Mart</h1>
                        <section id="shop">
                            <h2>Shops</h2>
                            <p>Our Products</p>
                            <p>Best Sellers</p>
                            <p>Deals</p>
                            <p>Available Online</p>
                        </section>
                        <section id="Bibim-Mart">
                            <h2>About Bibim-Mart</h2>
                            <p>About us</p>
                            <p>Privacy Policy</p>
                            <p>Terms & Conditions</p>
                        </section>
                        <section id="contacts">
                            <h2>Contacts</h2>
                            <p>Working Hours: 8-12</p>
                            <p>Phone number: +359 897 865 337</p>
                            <p>Email: <a href="mailto:tuscanorizza922@gmail.com">tuscanorizza922@gmail.com</a></p>
                            <p>Store location: Polangui, Albay</p>
                        </section>
                        <footer>
                            <p>@Bibim-Mart 2024 All Rights Reserved</p>
                        </footer>
                    </section>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const categoryLinks = document.querySelectorAll('.category-link');
            categoryLinks.forEach(link => {
                link.addEventListener('click', (event) => {
                    event.preventDefault();
                    const categoryId = link.getAttribute('data-category-id');
                    fetchProductsByCategory(categoryId);
                });
            });

            function fetchProductsByCategory(categoryId) {
  fetch(`category_result.php?product_cat_id=${categoryId}&product_status=1`)
    .then(response => response.json())
    .then(data => {
      const container = document.querySelector('.product-container');
      container.innerHTML = '';

      if (data.error) {
        container.innerHTML = `<p>${data.error}</p>`;
      } else {
        container.innerHTML = data.html;
      }
    })
    .catch(error => {
      console.error('Error fetching products:', error);
      const container = document.querySelector('.product-container');
      container.innerHTML = `<p>Error fetching products</p>`;
    });
}
        });
    </script>

    <a href="#" class="top"><i class='bx bx-up-arrow-alt'></i></i></a>
</body>

</html>