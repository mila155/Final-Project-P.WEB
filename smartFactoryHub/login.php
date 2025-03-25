<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - SmartFactory Hub</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="h-screen flex items-center justify-center bg-cover bg-center" style="background-image: url('https://source.unsplash.com/1600x900/?manufacturing,factory');">
    <div class="bg-white bg-opacity-90 rounded-lg shadow-lg flex max-w-4xl w-full">
        <!-- Form Login -->
        <div class="w-full md:w-1/2 p-8">
            <h2 class="text-2xl font-bold text-center text-orange-600">Login ke SmartFactory Hub</h2>
            <p class="text-center text-gray-500">Kelola produksi, bahan baku, dan distribusi dengan mudah</p>
            <form id="loginForm" class="mt-4">
                <label for="email" class="block text-gray-700 font-medium">Email</label>
                <input type="email" id="email" name="email" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-orange-500 outline-none" required>
                
                <label for="password" class="block mt-3 text-gray-700 font-medium">Password</label>
                    <div class="relative">
                        <input type="password" id="password" name="password" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-orange-500 outline-none" required>
                        <span class="absolute inset-y-0 right-4 flex items-center cursor-pointer text-gray-500" onclick="togglePassword()">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 opacity-50" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M10 3c-6 0-9 7-9 7s3 7 9 7 9-7 9-7-3-7-9-7zm0 12a5 5 0 110-10 5 5 0 010 10zM10 7a3 3 0 100 6 3 3 0 000-6z"/>
                            </svg>
                        </span>
                    </div>

                <button type="submit" class="w-full mt-4 bg-orange-600 text-white py-2 rounded-lg hover:bg-orange-700 transition">Login</button>
            </form>
            
            <div class="text-center my-4 text-gray-600">OR</div>
            <p class="text-center text-gray-600">Belum punya akun? <a href="signup.php" class="text-orange-600 hover:underline">Daftar di sini</a></p>
        </div>
        
        <!-- Gambar Samping -->
        <div class="hidden md:block w-1/2 bg-cover bg-center rounded-r-lg" style="background-image: url('https://images.unsplash.com/photo-1600880292089-90a7e086ee0c?q=80&w=1974&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D');"></div>
    </div>
    
    <script>
        function togglePassword() {
            const password = document.getElementById("password");
            password.type = password.type === "password" ? "text" : "password";
        }
        
        document.getElementById("loginForm").addEventListener("submit", function(event) {
            event.preventDefault();
            const email = document.getElementById("email").value;
            const password = document.getElementById("password").value;
            
            if (email === "jamilafarhanaa@gmail.com" && password === "admin123") {
                alert("Login berhasil!");
                window.location.href = "indexUser.php";
            } else {
                alert("Email atau password salah!");
            }
        });
    </script>
</body>
</html>