<x-main-layout>
    <div class="relative min-h-screen flex flex-col items-center justify-center selection:bg-[#FF2D20] selection:text-white">
        <div class="relative w-full max-w-5xl px-6 rounded-md shadow-lg  border-green-400 bg-[#FBB040]">
            <main class="w-full flex items-center justify-center  mt-6">
            </main>

            <footer class="py-16 text-center text-sm text-black dark:text-white/70">
                Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})
            </footer>
        </div>
    </div>
</x-main-layout>
