<div class="p-10">
    <div class="mb-5">
        <h3 class="font-bold text-2xl text-gray-800 my-3">
            {{ $vacante->titulo }}
        </h3>

        <div class="md:grid md:grid-cols-2 bg-gray-50 p-4 my-10">
            <p class="font-bold text-sm uppercase text-gray-800 my-3">Empresa: 
                <span class="normal-case font-semibold">{{ $vacante->empresa }}</span>
            </p>

            <p class="font-bold text-sm uppercase text-gray-800 my-3">Ultimo dia para postularse: 
                <span class="normal-case font-semibold">{{ $vacante->ultimo_dia->toFormattedDateString() }}</span>
            </p>

            <p class="font-bold text-sm uppercase text-gray-800 my-3">Categoria:
                {{-- Recibir el nombre de la categoria, no su id --}}
                <span class="normal-case font-semibold">{{ $vacante->categoria->categoria }}</span>
            </p>

            <p class="font-bold text-sm uppercase text-gray-800 my-3">Salario:
                <span class="normal-case font-semibold">{{ $vacante->salario->salario }}</span>
            </p>
        </div>
    </div>

    <div class="md:grid md:grid-cols-6 gap-4">
        {{-- Se crearon 6 columnas con el grid pero con col-spam indico cuantas columnas quiero que utilizen los elementos --}}
        {{-- col-spam-2: La imagen usara 2 columnas --}}
        <div class="md:col-span-2">
            <img src="{{ asset('storage/vacantes/' . $vacante->imagen) }}" alt="{{'Imagen Vacante: ' . $vacante->titulo}}">
        </div>

        {{-- col-spam-2: La descripcion usara 4 columnas --}}
        <div class="md:col-span-4">
            <h2 class="text-2xl font-bold mb-5">Descripcion del Puesto:</h2>
            <p>{{$vacante->descripcion}}</p>
        </div>

    </div>

    @guest
        <div class="mt-5 bg-gray-50 border border-dashed p-5 text-center">
            <p>
                ¿Deseas aplicar a esta vacante? 
                <a class="font-bold text-indigo-600" href="{{ route("register") }}">
                    Crea tu cuenta para aplicar a esta y otras vacantes
                </a>
            </p>
        </div>
    @endguest


    {{-- Can: Puede, trabaja con el policy.  Rol = 2 - Solo reclutadores pueden acceder --}}
    {{-- Cannot: No puede --}}
    @auth
        @cannot("create", App\Models\Vacante::class)
            <livewire:postular-vacante :vacante="$vacante" />
        @endcannot    
    @endauth
    

    
</div>
