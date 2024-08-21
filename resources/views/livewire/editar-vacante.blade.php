<form class="md:w-1/2 space-y-5" wire:submit.prevent='editarVacante'>

    <div>
        <x-input-label for="titulo" :value="__('Titulo Vacante')" />
        <x-text-input 
            id="titulo" 
            class="block mt-1 w-full" 
            type="text" 
            wire:model="titulo" 
            :value="old('titulo')"
            placeholder="Titulo Vacante"
        />
        {{-- <x-input-error :messages="$errors->get('titulo')" class="mt-2" /> --}}
        
        @error("titulo")
            <livewire:mostrar-alerta :message="$message" />
        @enderror
    </div>

    <div>
        <x-input-label for="salario" :value="__('Salario Mensual')" />
        <select 
            id="salario" 
            wire:model="salario" 
            class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full"
        >
            <option>--- Seleccione ---</option>
            @foreach ($salarios as $salario)
                <option value="{{ $salario->id }}">{{ $salario->salario }}</option>
            @endforeach
        </select>

        @error("salario")
            <livewire:mostrar-alerta :message="$message" />
        @enderror
    </div>

    <div>
        <x-input-label for="categoria" :value="__('Categoria')" />
        <select 
            id="categoria" 
            wire:model="categoria" 
            class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full"
        >
            <option>--- Seleccione ---</option>
            @foreach ($categorias as $categoria)
                <option value="{{ $categoria->id }}">{{ $categoria->categoria }}</option>
            @endforeach
        </select>
        
        @error("categoria")
            <livewire:mostrar-alerta :message="$message" />
        @enderror
    </div>

    <div>
        <x-input-label for="empresa" :value="__('Empresa')" />
        <x-text-input 
            id="empresa" 
            class="block mt-1 w-full" 
            type="text" 
            wire:model="empresa" 
            :value="old('empresa')"
            placeholder="Empresa: ej. Netflix"
        />
        
        @error("empresa")
            <livewire:mostrar-alerta :message="$message" />
        @enderror
    </div>

    <div>
        <x-input-label for="ultimo_dia" :value="__('Ultimo Dia Para Postularse')" />
        <x-text-input 
            id="ultimo_dia" 
            class="block mt-1 w-full" 
            type="date"
            wire:model="ultimo_dia" 
            :value="old('ultimo_dia')"
        />
        
        @error("ultimo_dia")
            <livewire:mostrar-alerta :message="$message" />
        @enderror
    </div>

    <div>
        <x-input-label for="descripcion" :value="__('Descripcion Puesto')" />
        <textarea 
            wire:model="descripcion" 
            placeholder="Descripcion general del puesto, experiencia"
            class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full h-44"></textarea>

        @error("descripcion")
            <livewire:mostrar-alerta :message="$message" />
        @enderror
    </div>

    <div>
        <x-input-label for="imagen" :value="__('Imagen')" />
        <x-text-input 
            id="imagen" 
            class="block mt-1 w-full" 
            type="file" 
            wire:model="imagen_nueva"
            accept="image/*"
        />
    
    <div class="my-5 w-80">
        <x-input-label :value="__('Imagen Actual')" />

        <img src="{{ asset("storage/vacantes/" . $imagen) }}" alt="{{ "Imagen Vacante " . $titulo }}">
    </div>


        <div class="my-5 w-80">
            {{-- wire:model permite que la imagen este disponible para mostrar en el front --}}
            @if ($imagen_nueva) {{-- Si se sube una nueva imagen se mostrara la vista previa --}}
                <x-input-label :value="__('Imagen Nueva')" />
                <img src="{{ $imagen_nueva->temporaryUrl() }}" alt=""> {{-- Generar vista previa de la imagen (aun no se sube a servidor) --}}
            @endif
        </div>
        
        @error("imagen_nueva")
            <livewire:mostrar-alerta :message="$message" />
        @enderror
    </div>

    <x-primary-button>
        Guardar Cambios
    </x-primary-button>

</form>
