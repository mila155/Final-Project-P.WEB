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
<body class="d-flex flex-column min-vh-100">
  <!-- navbar -->
  <div class="container-fluid p-0">
    <nav class="navbar navbar-expand-xl">
      <div class="container-fluid">
        <img src="./img/logo.png" alt="logo" class="img-fluid" style="max-width: 50px;">
        <a class="navbar-brand text-white fw-bold" href="#">Banana</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" 
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" 
                aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="#">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Our Product</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">About Us</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Cart</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Contact</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Register</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  </div>
  <!-- navbar end -->

<!-- first child -->

<div class="bg-light">
    <h3 class="text-center">Product</h3>
    <p class="text-center">nanti diisi penjelasan produk Lorem ipsum dolor sit amet consectetur.</p>
</div>

<!-- first child end -->

<!-- second child -->

<div class="row">
    <div class="col-md-10 mx-auto">
        <!-- product -->
         <div class="row">
            <div class="col-md-4 mb-2">
                <div class="card">
                    <img src="./img/1.jpg" class="card-img-top">
                        <div class="card-body">
                            <h5 class="card-title">Card title</h5>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                            <a href="#" class="btn btn-primary">Beli Sekarang</a>
                        </div>
                </div>
            </div>
            <div class="col-md-4 mb-2">
                <div class="card">
                    <img src="./img/2.jpg" class="card-img-top">
                        <div class="card-body">
                            <h5 class="card-title">Card title</h5>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                            <a href="#" class="btn btn-primary">Beli Sekarang</a>
                        </div>
                </div>
            </div>
            <div class="col-md-4 mb-2">
                <div class="card">
                    <img src="./img/OIP.jpeg" class="card-img-top">
                        <div class="card-body">
                            <h5 class="card-title">Card title</h5>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                            <a href="#" class="btn btn-primary">Beli Sekarang</a>
                        </div>
                </div>
            </div>
            <div class="col-md-4 mb-2">
                <div class="card">
                    <img src="./img/2.jpg" class="card-img-top">
                        <div class="card-body">
                            <h5 class="card-title">Card title</h5>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                            <a href="#" class="btn btn-primary">Beli Sekarang</a>
                        </div>
                </div>
            </div>
            <div class="col-md-4 mb-2">
                <div class="card">
                    <img src="./img/2.jpg" class="card-img-top">
                        <div class="card-body">
                            <h5 class="card-title">Card title</h5>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                            <a href="#" class="btn btn-primary">Beli Sekarang</a>
                        </div>
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


  <!-- bootstrap js link -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" 
          integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" 
          crossorigin="anonymous"></script>
</body>
</html>
