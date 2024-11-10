<div class="w-full flex gap-6 flex-col items-center">
    <div class="w-full h-16 flex items-center justify-center bg-[#073A3F] text-white text-center">
        <span class="text-xl sm:text-4xl">
            {{ $designation }}
        </span>
    </div>
    <form class="w-full flex flex-col max-w-3xl gap-12" method="POST" action={{ $action }}>
        @csrf
        <div class=" flex flex-col px-3 sm:px-0  sm:grid sm:grid-cols-2 gap-x-6 gap-y-3">
            <x-forms.text-input name="last_name" label="Nom"/>
            <x-forms.text-input name="first_name" label="Prenoms"/>
            <x-forms.text-input name="email" label="email"/>
            <x-forms.text-input name="phone_number" label="Telephone"/>
            <x-forms.text-input name="promotion" label="Promotion"/>
            <x-forms.text-input name="profession" label="Profession"/>
            <label class="form-control">
                <select name="country" class="select select-primary w-full @error("country") input-error @enderror">
                    <option selected disabled>Pays</option>
                    @foreach ($countries as $country)
                        <option value={{$country}}>{{ $country }}</option>
                    @endforeach                                        
                </select> 
                @error("country")
                    <span class="text-md text-red-500">{{ $message }}</span>
                @enderror
            </label>
            <x-forms.text-input name="city" label="ville"/>
            <x-forms.text-input
                class="col-span-2"
                :disabled="$amount !== null"
                name="amount"
                label="montant"
            />
        </div>
        <div class="self-center min-w-36">
            <button
                type="submit"
                class="btn uppercase text-white bg-cyan-800"
            >   Payer {{ $amount }} XOF
           </button>
        </div>
        
    </form>                            
</div>