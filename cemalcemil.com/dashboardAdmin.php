<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="../style.css">
    <style>
        body {
            background-color: #f3f3f3;
            color: #222;
        }
        .navbar {
            background-color: #4CAF50 !important; /* green leaf */
        }
        .navbar .nav-link {
            color: white;
        }
        .navbar .nav-link:hover {
            color: #FFD700; /* golden yellow */
        }
        .admin-section {
            background-color: #646e76; /* dark gray */
            padding: 20px;
        }
        .admin-section img {
            width: 80px;
            border-radius: 10px;
        }
        .admin-name {
            color: #fff;
            margin-top: 10px;
            font-weight: bold;
        }
        .admin-buttons a {
            display: inline-block;
            margin: 5px;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border-radius: 6px;
            text-decoration: none;
            transition: all 0.2s ease-in-out;
        }
        .admin-buttons a:hover {
            background-color: #3e8e41;
            color: #FFD700;
        }
    </style>
</head>

<body class="admin">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid justify-content-between">
            <div class="d-flex align-items-center">
                <img src="../img/logo.png" alt="logo" class="img-fluid me-2" style="max-width: 40px;">
                <a class="navbar-brand text-white fw-bold" href="#">Banana</a>
            </div>
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a href="#" class="nav-link">Welcome Guest</a>
                </li>
            </ul>
        </div>
    </nav>
    <!-- Navbar End -->

    <!-- Header -->
    <div class="bg-light text-center py-3">
        <h3 class="fw-semibold">Manage Details</h3>
    </div>
    <!-- Header End -->

    <!-- Admin Section -->
    <div class="admin-section d-flex flex-wrap align-items-center justify-content-start">
        <div class="text-center me-4">
            <img src="../img/1.jpg" alt="admin-photo">
            <p class="admin-name">Admin Name</p>
        </div>

        <div class="admin-buttons">
            <a href="#">Inventaris</a>
            <a href="#">Penjualan</a>
            <a href="#">Keuangan</a>
            <a href="#">Produk</a>
            <a href="#">List User</a>
            <a href="#">Log Out</a>
        </div>
    </div>
    <!-- Admin Section End -->

        <!-- footer -->
  <footer class="custom-footer text-white py-5 mt-auto">
  <div class="container">
    <div class="row gy-4">
      <div class="col-md-3">
        <h4 class="text-success fw-bold">Banana</h4>
        <p>Banana - produsen keripik pisang, granola, cookies granola, dan tepung pisang</p>
        <div class="d-flex gap-3">
          <a href="#"><i class="fab fa-instagram text-white fs-4"></i></a>
          <a href="#"><i class="fab fa-facebook text-white fs-4"></i></a>
        </div>
      </div>
      <div class="col-md-3">
        <h6 class="fw-bold">Pages</h6>
        <ul class="list-unstyled">
          <li><a href="#" class="footer-link">Our Product</a></li>
          <li><a href="#" class="footer-link">About us</a></li>
          <li><a href="#" class="footer-link">Cart</a></li>
          <li><a href="#" class="footer-link">Contact</a></li>
        </ul>
      </div>

      <div class="col-md-3">
        <h6 class="fw-bold">Our info</h6>
        <p><span class="text-warning">6288888888</span><br>
          <a href="mailto:bumiraya@banana.com" class="footer-link">bumiraya@banana.com</a><br>
          Jl. Rungkut Madya, Gn. Anyar, Kec. Gn. Anyar,<br>
          Surabaya, Jawa Timur 60294, Indonesia
        </p>
      </div>
    </div>
  </div>
</footer>
<!-- footer end -->

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
