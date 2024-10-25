    <label {{ $attributes->merge(['class' => 'form-control']) }} >
        <input
            name={{$name}}
            type="text"
            @if($defaultValue)
                value={{$defaultValue}}
            @endif
            class="input input-bordered w-full @error($name) input-error @enderror"
            placeholder={{ $label }}
        />
        @error($name)
            <span class="text-md text-red-500">{{ $message }}</span>
        @enderror
    </label>
