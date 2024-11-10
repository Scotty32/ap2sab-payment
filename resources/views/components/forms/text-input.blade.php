    <fieldset {{ $attributes }}>
        <label class="form-control">
            <div class="label">
              <span class="label-text uppercase">{{ $label }}</span>
            </div>
            <input
                name={{$name}}
                type="text"
                @if($defaultValue)
                    value={{$defaultValue}}
                @endif
                @disabled($disabled)
                class="input input-bordered border-[#FBB040] w-full @error($name) input-error @enderror"
            />
            @error($name)
                <span class="text-md text-red-500">{{ $message }}</span>
            @enderror
        </label>
    </fieldset>