<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Banana</title>

  <!-- Tailwind CSS CDN -->
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            primary: '#28a745', // warna hijau
          }
        }
      }
    }
  </script>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" 
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" 
        crossorigin="anonymous" referrerpolicy="no-referrer"/>

  <link rel="stylesheet" href="style.css">
</head>

<body class="flex flex-col min-h-screen m-0 p-0 bg-white text-gray-800">
  <!-- Navbar (Tailwind Template) -->
<nav class="bg-primary text-white fixed w-full z-50 shadow">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex justify-between h-16">
      <!-- Logo & Brand -->
      <div class="flex items-center">
        <img src="./img/logonew.png" alt="logo" class="h-10 w-auto mr-2">
        <span class="text-xl font-bold">Cemal Cemil</span>
      </div>

      <!-- Mobile Menu Button -->
      <div class="flex items-center xl:hidden">
        <button id="mobile-menu-button" class="focus:outline-none">
          <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2"
               viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round"
                  d="M4 6h16M4 12h16M4 18h16"></path>
          </svg>
        </button>
      </div>

      <!-- Navigation Links -->
      <div id="navbar-links" class="hidden xl:flex space-x-6 items-center">
        <a href="index.php" class="hover:underline">Home</a>
        <a href="product.php" class="hover:underline">Our Product</a>
        <a href="index.php" class="hover:underline">About Us</a>
        <a href="cart.php" class="hover:underline">Cart</a>
        <a href="register.php" class="hover:underline">Register</a>
      </div>
    </div>
  </div>

  <!-- Mobile Menu -->
  <div id="mobile-menu" class="xl:hidden hidden px-4 pb-4">
    <a href="index.php" class="block py-2 hover:underline">Home</a>
    <a href="product.php" class="block py-2 hover:underline">Our Product</a>
    <a href="index.php" class="block py-2 hover:underline">About Us</a>
    <a href="cart.php" class="block py-2 hover:underline">Cart</a>
    <a href="register.php" class="block py-2 hover:underline">Register</a>
  </div>
</nav>

<!-- Script Toggle -->
<script>
  const menuButton = document.getElementById('mobile-menu-button');
  const mobileMenu = document.getElementById('mobile-menu');

  menuButton.addEventListener('click', () => {
    mobileMenu.classList.toggle('hidden');
  });
</script>