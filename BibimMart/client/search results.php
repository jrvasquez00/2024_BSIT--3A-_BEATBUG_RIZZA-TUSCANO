<?php
include_once ("../connection/connection.php");
session_start();

$conn = connection();


$s_user_id = $_SESSION['customer_id'];
if ($_SESSION['users_user_type'] != 'C') {
  header("location: ../client.php");
}

$search_query = "";
if (isset($_GET['query'])) {
  $search_query = $_GET['query'];
}

$sql = "SELECT * FROM products WHERE product_name LIKE ?";
$stmt = $conn->prepare($sql);
$search_term = "%" . $search_query . "%";
$stmt->bind_param("s", $search_term);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
    integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous"
    referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
  <link rel="stylesheet" href="../css/style.css" />
  <title>Search Results</title>

      <style>
        
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

        
      </style>
</head>
<body>
  
  <header>
  <nav>
      <ul>
        <li><a href="client.php">Home</a></li>
        <li><a href="our products.php">See Our Products</a></li>
        <li><a href="#deals">Deals</a></li>
        <li><a href="#contacts">Contacts</a></li>
        <li><a href="../index.php">Logout</a></li>
        <li><a href="order.php">My Orders</a></li>
        <li class="cart">
          <a href="cart.php">
            <img src="../img/shopping-cart.png" alt="Shopping Cart">
          </a>
        </li>
        <li class="search">
          <section id="search">
        <form action="search results.php" method="get">
            <input type="text" name="query" placeholder="Search for products..." required>
            <button type="submit">Search</button>
        </form>
        </li>
      </ul>
    </nav>
  </header>

  <section id="search-results">
    <h2>Search Results for "<?php echo htmlspecialchars($search_query); ?>"</h2>
    <ul>
      <?php while ($product = $result->fetch_assoc()) { ?>
        <section class="row">
          <div class="card">
            <div class="card-img">
              <img src="../uploads/<?php echo $product['product_image']; ?>" alt="product_image" width="100">
            </div>
            <div class="card-title"><?php echo $product['product_name']; ?></div>
            <div class="card-subtitle"><?php echo $product['product_desc']; ?></div>
            <hr class="card-divider">
            <div class="card-footer">
              <div class="card-price"><span>₱</span><?php echo $product['product_price']; ?></div>
              <form action="process_add_to_cart.php" method="get">
                <div class="quantity">
                  <input type="hidden" name="product_id" value="<?php echo $product['product_id']; ?>">
                  <input type="number" name="qty" value="1" min="1" class="quantity-input" style="width: 40px;">
                </div>
                <button type="submit" class="btn btn-primary">
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="24" height="24">
                    <path d="m397.78 316h-205.13a15 15 0 0 1 -14.65-11.67l-34.54-150.48a15 15 0 0 1 14.62-18.36h274.27a15 15 0 0 1 14.65 18.36l-34.6 150.48a15 15 0 0 1 -14.62 11.67zm-193.19-30h181.25l27.67-120.48h-236.6z"></path>
                    <path d="m222 450a57.48 57.48 0 1 1 57.48-57.48 57.54 57.54 0 0 1 -57.48 57.48zm0-84.95a27.48 27.48 0 1 0 27.48 27.47 27.5 27.5 0 0 0 -27.48-27.47z"></path>
                    <path d="m368.42 450a57.48 57.48 0 1 1 57.48-57.48 57.54 57.54 0 0 1 -57.48 57.48zm0-84.95a27.48 27.48 0 1 0 27.48 27.47 27.5 27.5 0 0 0 -27.48-27.47z"></path>
                    <path d="m158.08 165.49a15 15 0 0 1 -14.23-10.26l-25.71-77.23h-47.44a15 15 0 1 1 0-30h58.3a15 15 0 0 1 14.23 10.26l29.13 87.49a15 15 0 0 1 -14.23 19.74z"></path>
                  </svg>
                </button>
              </form>
            </div>
          </div>
        </section>
      <?php } ?>
    </ul>
  </section>
  <script>

// Toggle search form visibility
const searchToggle = document.getElementById('search-toggle');
const searchForm = document.getElementById('search-form');

searchToggle.addEventListener('click', () => {
  if (searchForm.style.display === 'none' || searchForm.style.display === '') {
    searchForm.style.display = 'block';
  } else {
    searchForm.style.display = 'none';
  }
});

// Function to add item to cart
function addToCart(itemName, itemPrice) {
  // Perform addition to cart functionality
  // For demonstration, let's just increase the cart count by 1
  var cartCountElement = document.getElementById('cart-count');
  var currentCount = parseInt(cartCountElement.textContent);
  cartCountElement.textContent = currentCount + 1;
}

// Call the function to update cart count on page load
updateCartCount();
</script>
</body>
</html>
