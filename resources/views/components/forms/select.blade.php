@props(['name', 'label', 'options'])

<fieldset>
        <label class="form-control">
            <div class="label">
              <span class="label-text uppercase">{{ $label }}</span>
            </div>
            <select name="country" class="select select-primary border-[#FBB040] w-full @error("country") input-error @enderror">
                @foreach ($options as $option)
                    <option value={{$option}}>{{ $option }}</option>
                @endforeach                                        
            </select>
            @error($name)
                <span class="text-md text-red-500">{{ $message }}</span>
            @enderror
        </label>
    </fieldset>