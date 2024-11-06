<x-main-layout>
    <body class="font-sans antialiased dark:bg-black dark:text-white/50">
        <div class=" text-black/50">
            <div class="relative min-h-screen flex flex-col items-center justify-center selection:bg-[#FF2D20] selection:text-white">
                <div class="relative w-full max-w-5xl pb-12 rounded-md shadow-lg  border-green-400 bg-[#FBB040]">
                    <main class="w-full flex items-center justify-center">
                        <x-forms.payment :$amount :$designation :action="$formAction" />
                    </main>
                </div>
            </div>
        </div>
    </body>
</x-main-layout>
