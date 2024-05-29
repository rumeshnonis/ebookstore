<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Ebookstore - The only bookstore you visit!</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
      crossorigin="anonymous"
    />
    <link rel="stylesheet" href="assets/css/styles.css" />
  </head>
  <body>
    <nav class="navbar navbar-expand-md navbar-light fixed-top bg-light">
      <div class="container">
        <a class="navbar-brand" href="#"
          ><img
            src="assets/images/bookstore-logo.png"
            alt="ebookstore logo"
            height="60"
            width="auto"
        /></a>
        <div>
          <ul class="navbar-nav ms-auto mb-2 mb-md-0">
            <li class="nav-item">
              <a
                class="nav-link active"
                aria-current="page"
                href="/ebookstore/login"
                ><span data-feather="user"></span> My Account</a
              >
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <div
      class="top-bar-bottom bg-primary text-center fixed-top p-2"
      style="margin-top: 85px"
    >
      <ul class="list-inline mb-2 mb-md-0">
        <li class="list-inline-item px-3">
          <a
            class="nav-link text-white"
            aria-current="page"
            href="/ebookstore/login"
            >Home</a
          >
        </li>
        <li class="list-inline-item px-3">
          <a class="nav-link text-white" href="/ebookstore/register">Shop</a>
        </li>
        <li class="list-inline-item px-3">
          <a class="nav-link text-white" href="/ebookstore/register">FAQ</a>
        </li>
        <li class="list-inline-item px-3">
          <a class="nav-link text-white" href="/ebookstore/register"
            ><span data-feather="shopping-cart"></span
          ></a>
        </li>
      </ul>
    </div>
    <div
      class="position-relative overflow-hidden p-3 p-md-5 bg-body-tertiary"
      style="margin-top: 85px"
    >
    <div class="row m-auto pt-5">
        <div class="col-md-5 text-end">
            <img class="mt-4" src="assets/images/the_shining.png" width="300" alt="the hobbit book">
        </div>
        <div class="col-md-6 my-5 pt-4">
            <h1 class="display-3 fw-bold">Discover Your Next Great Read</h1>
            <h4 class="fw-normal text-muted mb-3">
              Explore our extensive collection of e-books from various genres and
              authors.
            </h4>
            <div class="d-flex gap-3 lead fw-normal">
              <a href="#">
                <button type="button" class="btn btn-lg btn-primary border-0">
                  Shop Now!
                </button>
              </a>
              <a href="#">
                <button type="button" class="btn btn-lg btn-dark border-0">
                  Categories
                </button>
              </a>
            </div>
          </div>    
    </div>
    </div>

    <!-- Featured Products -->
    <div class="container">
      <h2 class="mt-5 mb-3 border-bottom pb-3">Featured Products</h2>
      <div class="row m-0">
        <?php
              // include 'config/database.php';
              include 'models/Product.php';
      
              $product = new Product();
              $featured_products = $product->getFeaturedProducts(); foreach
        ($featured_products as $product): ?>
        <div class="col-xl-2 col-lg-3 col-sm-4 col-6 px-1 py-1">
          <div class="card card-hover-shadow p-3" style="border-radius: 0">
            <span class="text-primary"
              ><?php echo $product['category']; ?></span
            >
            <a
              href="/ebookstore/views/products/product_details.php?id=<?php echo $product['id']; ?>"
              class="nav-link"
            >
              <h6 class="card-title">
                <?php echo htmlspecialchars($product['name']); ?>
              </h6>
            </a>
            <hr />
            <a
              href="/ebookstore/views/products/product_details.php?id=<?php echo $product['id']; ?>"
            >
              <img
                src="/ebookstore/assets/images/<?php echo htmlspecialchars($product['image']); ?>"
                class="card-img-top p-0"
                alt="<?php echo htmlspecialchars($product['name']); ?>"
              />
            </a>
            <hr />
            <div class="card-body">
              <!-- <p class="card-text"><?php echo htmlspecialchars($product['description']); ?></p> -->
              <div class="d-flex justify-content-between align-items-center">
                <h5 class="text-muted">
                  £
                  <?php echo htmlspecialchars($product['price']); ?>
                </h5>
                <a
                  href="/ebookstore/controllers/CartController.php?action=add&product_id=<?php echo $product['id']; ?>"
                  class="btn btn-sm btn-primary rounded-circle p-1 border-0"
                  ><span data-feather="plus"></span
                ></a>
              </div>
            </div>
          </div>
        </div>
        <?php endforeach; ?>
      </div>
    </div>

    <!-- Banner -->
    <div class="img-fluid text-center mt-5">
        <img src="assets/images/banner.png" class="img-fluid" alt="bookstore banner">
    </div>



        <!-- Latest Products -->
        <div class="container">
            <h2 class="mt-5 mb-3 border-bottom pb-3">Latest Products</h2>
            <div class="row m-0">
              <?php
            
                    $product = new Product();
                    $latest_products = $product->getLatestProducts(); foreach
              ($latest_products as $product): ?>
              <div class="col-xl-2 col-lg-3 col-sm-4 col-6 px-1 py-1">
                <div class="card card-hover-shadow p-3" style="border-radius: 0">
                  <span class="text-primary"
                    ><?php echo $product['category']; ?></span
                  >
                  <a
                    href="/ebookstore/views/products/product_details.php?id=<?php echo $product['id']; ?>"
                    class="nav-link"
                  >
                    <h6 class="card-title">
                      <?php echo htmlspecialchars($product['name']); ?>
                    </h6>
                  </a>
                  <hr />
                  <a
                    href="/ebookstore/views/products/product_details.php?id=<?php echo $product['id']; ?>"
                  >
                    <img
                      src="/ebookstore/assets/images/<?php echo htmlspecialchars($product['image']); ?>"
                      class="card-img-top p-0"
                      alt="<?php echo htmlspecialchars($product['name']); ?>"
                    />
                  </a>
                  <hr />
                  <div class="card-body">
                    <!-- <p class="card-text"><?php echo htmlspecialchars($product['description']); ?></p> -->
                    <div class="d-flex justify-content-between align-items-center">
                      <h5 class="text-muted">
                        £
                        <?php echo htmlspecialchars($product['price']); ?>
                      </h5>
                      <a
                        href="/ebookstore/controllers/CartController.php?action=add&product_id=<?php echo $product['id']; ?>"
                        class="btn btn-sm btn-primary rounded-circle p-1 border-0"
                        ><span data-feather="plus"></span
                      ></a>
                    </div>
                  </div>
                </div>
              </div>
              <?php endforeach; ?>
            </div>
          </div>

          <hr style="margin-top: 75px;">

          <!-- footer -->
            <footer class="pt-5">
                <div class="container pb-5">
              <div class="row">
                <div class="col-md-5 mb-3">
                    <form>
                      <h5>Subscribe to our newsletter</h5>
                      <p>Get our latest product updates & offers to your mailbox.</p>
                      <div class="d-flex flex-column flex-sm-row w-100 gap-2">
                        <label for="newsletter1" class="visually-hidden">Email address</label>
                        <input id="newsletter1" type="text" class="form-control" placeholder="Email address">
                        <button class="btn btn-primary border-0" type="button">Subscribe</button>
                      </div>
                    </form>
                  </div>  
                            
                <div class="col-6 offset-md-1 col-md-2 mb-3">
                    <h5 class="text-primary">Top 5 Books</h5>
                    <ul class="nav flex-column">
                      <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary">The Hobbit</a></li>
                      <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary">The Shining</a></li>
                      <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary">Moby-Dick</a></li>
                      <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary">War and Peace</a></li>
                      <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary">The Road</a></li>
                    </ul>
                  </div>  

                <div class="col-6 col-md-2 mb-3">
                  <h5 class="text-primary">Categories</h5>
                  <ul class="nav flex-column">
                    <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary">Fiction</a></li>
                    <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary">Romance</a></li>
                    <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary">Fantasy</a></li>
                    <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary">Epic</a></li>
                    <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary">Horror</a></li>
                  </ul>
                </div>

                <div class="col-6 col-md-2 mb-3">
                    <h5 class="text-primary">Useful Links</h5>
                    <ul class="nav flex-column">
                      <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary">Home</a></li>
                      <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary">Shop</a></li>
                      <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary">My Account</a></li>
                      <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary">FAQs</a></li>
                    </ul>
                  </div>
          
          
              </div>
            </div>
          
              <div class="pt-3 pb-1 text-white border-top bg-primary">
                <div class="container">
                    <p>&copy; 2024 The Bookstore Ltd. All rights reserved.</p>
                </div>
              </div>
            </footer>
      

    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
      crossorigin="anonymous"
    ></script>
    <script src="https://unpkg.com/feather-icons"></script>
    <script>
      feather.replace();
    </script>
  </body>
</html>
