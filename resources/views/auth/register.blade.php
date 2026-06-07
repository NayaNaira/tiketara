```blade
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi - Tiketara</title>

    @vite(['resources/css/app.css'])
</head>

<body class="bg-[#020d1f] min-h-screen flex flex-col">

    <!-- Logo -->
    <div class="w-full px-4 sm:px-8 pt-6">
        <h1 class="text-yellow-500 font-bold text-xl sm:text-2xl">
            🎟️ TIKETARA
        </h1>
    </div>

    <!-- Register -->
    <div class="flex-1 flex items-center justify-center px-4 py-8">

        <div
            class="w-full max-w-md border border-cyan-500 rounded-2xl p-6 sm:p-8 bg-[#03142c] shadow-lg">

            <h2 class="text-3xl sm:text-4xl font-bold text-yellow-500 mb-3">
                Buat Akun
            </h2>

            <p class="text-gray-400 mb-8 text-sm sm:text-base">
                Daftar untuk mulai mengelola tiket dan event Anda.
            </p>

            <form action="#" method="POST">
                @csrf

                <!-- Nama -->
                <div class="mb-5">
                    <label class="block text-gray-300 mb-2">
                        Nama Lengkap
                    </label>

                    <input
                        type="text"
                        name="name"
                        placeholder="Masukkan nama lengkap"
                        class="w-full px-4 py-3 rounded-lg bg-gray-100 text-black focus:outline-none focus:ring-2 focus:ring-yellow-500">
                </div>

                <!-- Email -->
                <div class="mb-5">
                    <label class="block text-gray-300 mb-2">
                        Email
                    </label>

                    <input
                        type="email"
                        name="email"
                        placeholder="nama@email.com"
                        class="w-full px-4 py-3 rounded-lg bg-gray-100 text-black focus:outline-none focus:ring-2 focus:ring-yellow-500">
                </div>

                <!-- Password -->
                <div class="mb-5">
                    <label class="block text-gray-300 mb-2">
                        Password
                    </label>

                    <div class="relative">

                        <input
                            type="password"
                            id="password"
                            name="password"
                            placeholder="********"
                            class="w-full px-4 py-3 rounded-lg bg-gray-100 text-black focus:outline-none focus:ring-2 focus:ring-yellow-500">

                        <button
                            type="button"
                            onclick="togglePassword()"
                            class="absolute right-4 top-1/2 -translate-y-1/2 text-black">

                            👁️

                        </button>

                    </div>
                </div>

                <!-- Button -->
                <button
                    type="submit"
                    class="w-full bg-yellow-500 hover:bg-yellow-400 text-black font-bold py-3 rounded-lg transition">

                    Daftar →
                </button>

                <!-- Login -->
                <div class="mt-6 text-center">

                    <span class="text-gray-400 text-sm">
                        Sudah punya akun?
                    </span>

                    <a
                        href="#"
                        class="text-cyan-400 hover:underline text-sm">

                        Masuk

                    </a>

                </div>

            </form>

        </div>

    </div>

    <script>
        function togglePassword() {
            const password =
                document.getElementById('password');

            password.type =
                password.type === 'password'
                ? 'text'
                : 'password';
        }
    </script>

</body>
</html>
```
