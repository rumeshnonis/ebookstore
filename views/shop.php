<!-- views/shop.php -->

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Shop - Ebookstore</title>
    <meta
      name="description"
      content="Shop our extensive collection of e-books across various genres and authors."
    />
    <meta
      name="keywords"
      content="ebooks, online shopping, buy ebooks, ebookstore"
    />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
      crossorigin="anonymous"
    />
    <link rel="stylesheet" href="assets/css/styles.css" />
  </head>
  <body>
    <?php include 'includes/header.php'; ?>

    <div class="container pt-5" style="margin-top: 100px">
      <div class="row m-0">
        <div class="col-md-3">
            <div class="sticky-top-md">
                <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item"><a href="#" class="" style="text-decoration: none;">Home</a></li>
                      <li class="breadcrumb-item active" aria-current="page">Shop</li>
                    </ol>
                  </nav>
                <div class="card">
                    <ul class="list-group list-group-flush">
                      <li class="list-group-item py-3">Browse by Categories</li>
                      <li class="list-group-item py-2 px-4">
                        <a href="#" style="text-decoration: none; color: #262626"
                          >Fiction</a
                        >
                      </li>
                      <li class="list-group-item py-2 px-4">
                        <a href="#" style="text-decoration: none; color: #262626"
                          >Romance</a
                        >
                      </li>
                      <li class="list-group-item py-2 px-4">
                        <a href="#" style="text-decoration: none; color: #262626"
                          >Fantasy</a
                        >
                      </li>
                      <li class="list-group-item py-2 px-4">
                        <a href="#" style="text-decoration: none; color: #262626"
                          >Epic</a
                        >
                      </li>
                      <li class="list-group-item py-2 px-4">
                        <a href="#" style="text-decoration: none; color: #262626"
                          >Horror</a
                        >
                      </li>
                    </ul>
                  </div>
                  <br>
                  <div class="radius-1">
                    <img src="assets/images/square-ad.png" class="img-fluid" alt="">
                  </div>        
            </div>
        </div>
        <div class="col-md-9">
            <h3 class="my-3">Ebookstore Shop</h3>
          <form method="GET" action="shop.php">
            <div class="input-group mb-3">
              <input
                type="text"
                name="search"
                class="form-control"
                placeholder="Search for products..."
                aria-label="Search for products"
                aria-describedby="button-search"
              />
              <button class="btn btn-primary" type="submit" id="button-search">
                Search
              </button>
            </div>
          </form>
          <div class="row">
            <?php
                        include 'models/Product.php';
                        $product = new Product();
        
                        // Check if a search query is present
                        $search_query = isset($_GET['search']) ? $_GET['search'] : '';
                        
                        if ($search_query) {
                            $all_products = $product->searchProducts($search_query);
            echo "<!-- Search query: $search_query -->"; } else { $all_products
            = $product->getAllProducts(); } // Debugging output echo "<!-- Total products found: " . count($all_products) . " -->";
            if (!empty($all_products)) { foreach ($all_products as $product): ?>
                <div class="col-xl-3 col-lg-3 col-sm-4 col-6 px-1 py-1">
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
                      <?php
                endforeach;
                } 
            ?>
          </div>
        </div>
      </div>
    </div>

    <?php include 'includes/footer.php'; ?>

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
