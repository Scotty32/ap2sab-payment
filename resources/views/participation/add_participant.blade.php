<x-main-layout>
    <div class="text-black/50">
        <div class="mx-3 sm:mx-0 relative min-h-screen flex flex-col items-center justify-center selection:text-white">
            <div class="relative w-full max-w-5xl pb-12 rounded-md shadow-lg">
                <main class="w-full flex items-center justify-center">
                    <x-forms.payment
                        :$amount
                        :$designation
                        :action="$formAction"
                        :can-edit-amount="false"/>
                </main>
            </div>
        </div>
    </div>
</x-main-layout>
