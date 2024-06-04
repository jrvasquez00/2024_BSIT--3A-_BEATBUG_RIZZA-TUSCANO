<?php

if (!isset($_SESSION)) {
  session_start();
}


include_once ("connection/connection.php");

$con = connection();
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
  <title>Bibimmart</title>
  <link rel="stylesheet" href="css/style.css" />

  <style>
    *{
      text-decoration: none;
    }
  </style>
  
</head>
<body>
  <header>
    <nav>
      <ul>
        <li><a href="#home">Home</a></li>
        <li><a href="#products">See Our Products</a></li>
        <li><a href="#contacts">Contacts</a></li>
        <li><a href="login.php">Login</a>
        <li>
        <li><a href="registration.php">Sign Up</a>
        <li>
        <li class="cart">
          <a href="#cart">
            <img src="img/shopping-cart.png" alt="Shopping Cart">

          </a>
        </li>
        <li class="search">
          <button id="search-toggle">
            <img src="img/search.png" alt="Search Icon">
          </button>
          <form id="search-form" style="display: none;">
            <input type="text" placeholder="Search...">
            <button type="submit">Search</button>
          </form>
        </li>
      </ul>
    </nav>
  </header>
  <main>
    <section id="home" class="hero">
      <div class="content">
        <h1>WELCOME TO Bibim-Mart</h1>
        <h2>Feel the taste of Korean Foods</h2>
        <p>Korean cuisine is one of the healthiest in the world due to the extensive use of natural and seasonal food
          products..</p>
        <a href="#products" class="cta">See Our Products</a>
      </div>
      <div class="background-img">
        <img src="img/bg.png" alt="Background Image">
      </div>
    </section>
    <section id="products">
      <h4>PRODUCT CATEGORIES</h4>
      <h2>What we offer?</h2>
      <ul class="product-categories">
        <li>
          <a href="#">
            <img src="img/noodles.png" alt="Noodles" width="100">
            <h3>Noodles</h3>
          </a>
        </li>
        <li>
          <a href="#">
            <img src="img/sauces.png" alt="Sauce / Paste" width="100">
            <h3>Sauce / Paste</h3>
          </a>
        </li>
        <li>
          <a href="#">
            <img src="img/sachet.png" alt="Processed food" width="100">
            <h3>Processed food</h3>
          </a>
        </li>
        <li>
          <a href="#">
            <img src="img/kimchi.png" alt="Kimchi" width="100">
            <h3>Kimchi</h3>
          </a>
        </li>
        <li>
          <a href="#">
            <img src="img/seaweed.png" alt="Seaweed" width="100">
            <h3>Seaweed</h3>
          </a>
        </li>
        <li>
          <a href="#">
            <img src="img/snacks.png" alt="Snacks" width="100">
            <h3>Snacks</h3>
          </a>
        </li>
        <li>
          <a href="#">
            <img src="img/soft-drink.png" alt="Drinks" width="100">
            <h3>Drinks</h3>
          </a>
        </li>
        <li>
          <a href="#">
            <img src="img/rice.png" alt="Rice / Grain" width="100">
            <h3>Rice / Grain</h3>
          </a>
        </li>
        <li>
          <a href="#">
            <img src="img/frozen-goods.png" alt="Frozen / Fresh foods" width="100">
            <h3>Frozen / Fresh foods</h3>
          </a>
        </li>
        <li>
          <a href="#">
            <img src="img/love.png" alt="Life style" width="100">
            <h3>Life style</h3>
          </a>
        </li>
      </ul>
      <a href="#products" class="cta">EXPLORE THE SHOP</a>
    </section>


    <section id="best-product">
      <div class="center">
        <h4>The Korean Supermarket</h4>
        <h2>Best Korean Products</h2>
      </div>
      <div class="row">
        <p>Available Only Online</p>
        <p>Best Sellers</p>
        <p>Deals and Promotion</p>
      </div>
      </div>
    </section>



    <section class="row">
      <div class="card">
        <div class="card-img">
          <img src="img/SAMYANG.png" alt="Noodles" width="100">
        </div>
        <div class="card-title">Samyang Buldak</div>
        <div class="card-subtitle">Product description. Lorem ipsum dolor sit amet, consectetur adipisicing elit.</div>
        <hr class="card-divider">
        <div class="card-footer">
          <div class="card-price"><span>₱</span> 80</div>
          <button class="card-btn">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
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
        </div>
      </div>

      <div class="card">
        <div class="card-img">
          <img src="img/Kimchi ramyun.png" alt="Noodles" width="100">
        </div>
        <div class="card-title">Nongshim Ramyeon </div>
        <div class="card-subtitle">Product description. Lorem ipsum dolor sit amet, consectetur adipisicing elit.</div>
        <hr class="card-divider">
        <div class="card-footer">
          <div class="card-price"><span>₱</span> 45</div>
          <button class="card-btn">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
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
        </div>
      </div>
      <div class="card">
        <div class="card-img">
          <img src="img/CHACHARONI.png" alt="Noodles" width="100">
        </div>
        <div class="card-title">Samyang Chacharoni</div>
        <div class="card-subtitle">Product description. Lorem ipsum dolor sit amet, consectetur adipisicing elit.</div>
        <hr class="card-divider">
        <div class="card-footer">
          <div class="card-price"><span>₱</span> 105</div>
          <button class="card-btn">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
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
        </div>
      </div>
      <div class="card">
        <div class="card-img">
          <img src="img/SOJU.png" alt="Drinks" width="100">
        </div>
        <div class="card-title">Soju Original</div>
        <div class="card-subtitle">Product description. Lorem ipsum dolor sit amet, consectetur adipisicing elit.</div>
        <hr class="card-divider">
        <div class="card-footer">
          <div class="card-price"><span>₱</span> 123</div>
          <button class="card-btn">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
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
        </div>
      </div>
    </section>
    <a href="#products" class="cta">Load More Products</a>



    <section id="about">
      <div class="content-b">
        <div class="img">
          <img src="img/Bibim-Mart.png" alt="img1" />
        </div>
        <div class="about-b">
          <h5>ABOUT US</h5>
          <h1>We are Bibim-Mart.</h1>
          <p>
            According to Korean culture, "food and medicine are grown from the same root" and therefore there is no
            better medicine than food. We offer a wide range of traditional Korean food and drinks.
          </p>
          <a href="#home" class="cta-button">Learn More</a>
          <a href="#contacts" class="cta-button">Contacts</a>
        </div>
      </div>
    </section>

    <div class="green-bar">
      <div class="icon"><img src="img/flag.png" alt="Icon 1"></div>
      <h4>KOREAN MADE PRODUCT</h4>
      <div class="icon"><img src="img/quality.png" alt="Icon 2"></div>
      <h4>HIGH QUALITY GUARANTEED</h4>
      <div class="icon"><img src="img/delivery-bike.png" alt="Icon 3"></div>
      <h4>SHIPPING WITH ECONT</h4>
    </div>

    </section>

    <section id="below">
      <h1>Bibim-Mart</h1>
      <section id="shop">
        <h2>Shops</h2>
        <P> Our Products</P>
        <p>Best Sellers</p>
        <p>Deals</p>
        <p>Available Online</p>
      </section>
      <section id="Bibim-Mart">
        <h2>About Bibim-Mart</h2>
        <p>About us</p>

        <p>Privacy Policy</p>
        <p>Terms&Conditions</p>

      </section>
      <section id="contacts">
        <h2>Contacts</h2>
        <p>Working Hours:8-12</p>
        <p>Phone number: +359 897 865 337</p>
        <p>Email: <a href="mailto:tuscanorizza922@gmail.com">tuscanorizza922@gmail.com</a></p>
        <p>Store location: Polangui, Albay</p>
      </section>
      <footer>
        <p> @Bibim-Mart 2024 All Rights Reserved</p>
      </footer>
    </section>
    <script>

      document.getElementById('search-toggle').addEventListener('click', function () {
        const searchForm = document.getElementById('search-form');
        if (searchForm.style.display === 'none' || searchForm.style.display === '') {
          searchForm.style.display = 'block';
        } else {
          searchForm.style.display = 'none';
        }
      });

      window.onload = function () {
        const buttons = document.querySelectorAll('.cta');

        buttons.forEach(button => {
          const textWidth = button.textContent.length * 12; // Adjust the multiplier as needed
          button.style.width = `${textWidth}px`;
        });
      };


    </script>
  </main>
</body>

</html>