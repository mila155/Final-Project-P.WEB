<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Banana</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer"/>
</head>
<body class="flex flex-col min-h-screen pt-20">
  <!-- Navbar -->
  <nav class="fixed top-0 left-0 right-0 bg-green-700 z-50 shadow">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex justify-between h-16 items-center">
        <div class="flex items-center gap-2">
          <img src="./img/logonew.png" alt="logo" class="w-10 h-auto"/>
          <a href="#" class="text-white font-bold text-lg">Cemal Cemil</a>
        </div>
        <div class="hidden md:flex space-x-6">
          <a href="index.php" class="text-white hover:text-yellow-200">Home</a>
          <a href="product.php" class="text-white hover:text-yellow-200">Our Product</a>
          <a href="index.php" class="text-white hover:text-yellow-200">About Us</a>
          <a href="cart.php" class="text-white hover:text-yellow-200">Cart</a>
          <a href="register.php" class="text-white hover:text-yellow-200">Register</a>
        </div>
        <div class="md:hidden">
          <button id="menu-toggle" class="text-white">
            <i class="fas fa-bars"></i>
          </button>
        </div>
      </div>
    </div>
    <!-- Mobile Menu -->
    <div id="mobile-menu" class="hidden md:hidden px-4 pb-4">
      <a href="index.php" class="block text-white py-1">Home</a>
      <a href="product.php" class="block text-white py-1">Our Product</a>
      <a href="index.php" class="block text-white py-1">About Us</a>
      <a href="cart.php" class="block text-white py-1">Cart</a>
      <a href="#" class="block text-white py-1">Contact</a>
      <a href="#" class="block text-white py-1">Register</a>
    </div>
  </nav>

  <!-- Mobile menu toggle script -->
  <script>
    const menuToggle = document.getElementById('menu-toggle');
    const mobileMenu = document.getElementById('mobile-menu');
    menuToggle.addEventListener('click', () => {
      mobileMenu.classList.toggle('hidden');
    });
  </script>
</body>
</html>
