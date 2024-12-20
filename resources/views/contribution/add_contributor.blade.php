<x-main-layout>
    <div class=" text-black/50">
        <div class="relative min-h-screen flex flex-col items-center justify-center selection:text-white">
            <div class="relative w-full max-w-5xl pb-12 rounded-md shadow-lg">
                <main class="w-full flex items-center justify-center">
                    <x-forms.payment :$designation :action="$formAction" />
                </main>
            </div>
        </div>
    </div>
</x-main-layout>
