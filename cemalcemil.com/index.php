<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Banana</title>
  <!-- bootstrap CSS link -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" 
        rel="stylesheet" 
        integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" 
        crossorigin="anonymous">
  <!-- font awesome link -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" 
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" 
        crossorigin="anonymous" referrerpolicy="no-referrer"/>

    <link rel="stylesheet" href="style.css">

</head>
<body class="d-flex flex-column min-vh-100" style="padding-top: 70px;">
  <!-- navbar -->
  <div class="container-fluid p-0">
  <nav class="navbar navbar-expand-xl fixed-top">
      <div class="container-fluid">
        <img src="./img/logonew.png" alt="logo" class="img-fluid" style="max-width: 50px;">
        <a class="navbar-brand text-white fw-bold" href="#">Cemal Cemil</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" 
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" 
                aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="index.php">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="product.php">Our Product</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="index.php">About Us</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="cart.php">Cart</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Contact</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="register.php">Register</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  </div>
  <!-- navbar end -->

<div class="row">
    <div class="col-md-10 mx-auto">
        <!-- Why Cemal Cemil Section -->
<section class="container my-5">
  <div class="row align-items-center">
    <div class="col-md-6">
      <img src="img/why.png" alt="Kenapa Cemal Cemil" class="img-fluid rounded shadow-sm">
    </div>
    <div class="col-md-6">
      <h4 class="fw-bold text-success">Why Cemal Cemil?</h4>
      <p class="text-muted">Cemal Cemil menggunakan bahan baku lokal yang berkualitas tinggi dan diproses secara higienis untuk menghasilkan keripik pisang dengan berbagai rasa yang unik dan menggugah selera. Cocok untuk segala usia, baik untuk camilan santai maupun oleh-oleh khas Indonesia.</p>
    </div>
  </div>
</section>

<!-- Who Are We Section -->
<section class="container my-5">
  <div class="row align-items-center">
    <div class="col-md-6 order-md-2">
      <img src="img/who.png" alt="Tentang Kami" class="img-fluid rounded shadow-sm">
    </div>
    <div class="col-md-6 order-md-1">
      <h4 class="fw-bold text-success">Who Are We</h4>
      <p class="mb-1 fw-semibold">Bumi Raya</p>
      <p class="text-muted">Kami berdiri pada Maret 2025 dan berfokus memproduksi keripik pisang, granola, hingga susu pisang dengan aneka rasa. Semua produk kami dibuat dari bahan-bahan pilihan dengan kualitas terbaik demi memastikan rasa lezat, sehat, dan aman untuk dikonsumsi.</p>
    </div>
  </div>
</section>
                </div>
            </div>
         </div>
    </div>
</div>

<!-- second child end -->

  <!-- footer -->
  <footer class="custom-footer text-white py-5 mt-auto">
  <div class="container">
    <div class="row gy-4">
      <div class="col-md-3">
        <h4 class="text-success fw-bold">Cemal Cemil</h4>
        <p>Cemal Cemil - produsen keripik pisang, granola, dan susu pisang</p>
        <div class="d-flex gap-3">
          <a href="#"><i class="fab fa-instagram text-white fs-4"></i></a>
          <a href="#"><i class="fab fa-facebook text-white fs-4"></i></a>
        </div>
      </div>
      <div class="col-md-3">
        <h6 class="fw-bold">Pages</h6>
        <ul class="list-unstyled">
          <li><a href="product.php" class="footer-link">Our Product</a></li>
          <li><a href="index.php" class="footer-link">About us</a></li>
          <li><a href="#" class="footer-link">Cart</a></li>
          <li><a href="#" class="footer-link">Contact</a></li>
        </ul>
      </div>

      <div class="col-md-3">
        <h6 class="fw-bold">Our info</h6>
        <p><span class="text-warning">6288888888</span><br>
          <a href="mailto:bumiraya@CemalCemil.com" class="footer-link">bumiraya@CemalCemil.com</a><br>
          Jl. Rungkut Madya, Gn. Anyar, Kec. Gn. Anyar,<br>
          Surabaya, Jawa Timur 60294, Indonesia
        </p>
      </div>
    </div>
  </div>
</footer>
<!-- footer end -->


  <!-- bootstrap js link -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" 
          integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" 
          crossorigin="anonymous"></script>
</body>
</html>
