<!-- views/auth/login.php -->
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login</title>
    <link
      href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
      rel="stylesheet"
    />
    <style>
        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh; /* Full height */
        }
    </style>
  </head>
  <body>
    <div class="container">
      <div class="col-md-5 p-5 col-12 m-auto border">
        <h2>Login</h2>
        <?php if (isset($_GET['error'])): ?>
        <div class="alert alert-danger">
          <?php echo htmlspecialchars($_GET['error']); ?>
        </div>
        <?php endif; ?>
        <?php if (isset($_GET['success'])): ?>
        <div class="alert alert-success">
          <?php echo htmlspecialchars($_GET['success']); ?>
        </div>
        <?php endif; ?>
        <form
          action="../../controllers/AuthController.php?action=login"
          method="POST"
        >
          <div class="form-group">
            <label for="email">Email</label>
            <input
              type="email"
              name="email"
              id="email"
              class="form-control"
              required
            />
          </div>
          <div class="form-group">
            <label for="password">Password</label>
            <input
              type="password"
              name="password"
              id="password"
              class="form-control"
              required
            />
          </div>
          <button type="submit" class="btn btn-primary">Login</button>
        </form>
        <a href="/ebookstore/password_reset" class="btn btn-link"
          >Forgot Password?</a
        >
      </div>
    </div>
  </body>
</html>
