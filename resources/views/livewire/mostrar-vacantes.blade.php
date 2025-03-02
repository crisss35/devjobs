<div>
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

        @forelse ($vacantes as $vacante)
            
            <div class="p-6 bg-white border-b border-gray-200 text-gray-900 md:flex md:justify-between md:items-center">
                <div class="space-y-3">
                    <a href="{{ route("vacantes.show", $vacante->id) }}" class="text-xl font-bold">
                        {{ $vacante->titulo }}
                    </a>
                    <p class="text-sm text-gray-600 font-bold">{{ $vacante->empresa }}</p>
                    <p class="text-sm text-gray-500 font-semibold">Ultimo dia para postular: {{ $vacante->ultimo_dia->format("d/m/Y") }}</p>
                </div>
            
            
                <div class="flex flex-col md:flex-row items-stretch gap-3 mt-5 md:mt-0">
                    <a 
                        href="{{ route("candidatos.index", $vacante) }}"
                        class="bg-slate-800 py-2 px-4 rounded-lg text-white text-xs font-bold uppercase text-center"
                    > {{ $vacante->candidatos->count() }}
                    Candidatos</a>

                    <a 
                        href="{{ route("vacantes.edit", $vacante->id) }}"
                        class="bg-blue-800 py-2 px-4 rounded-lg text-white text-xs font-bold uppercase text-center"
                    >Editar</a>

                    <button 
                        {{-- $dispatch: dispara el evento mostrarAlerta --}}
                        wire:click='$dispatch("mostrarAlerta", {{ $vacante->id }} )'
                        class="bg-red-600 py-2 px-4 rounded-lg text-white text-xs font-bold uppercase text-center"
                    >Eliminar</button>
                </div>
            </div>

        @empty
            <p class="p-3 text-center text-sm text-gray-600 font-bold">No hay vacantes que mostrar</p>
        @endforelse

        <div class="p-3">
            {{ $vacantes->links() }}
        </div>
    </div>
</div>


@push("scripts")

    {{-- Implementar SweetAlert --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <script>

        // Eventos en livewire, aqui elimino la vacante

        Livewire.on("mostrarAlerta", vacanteId => {
            Swal.fire({
                title: "¿Estas Seguro?",
                text: "Una vacante eliminada no se puede recuperar",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Si, ¡Eliminar!",
                cancelButtonText: "Cancelar"
            }).then((result) => {
                if (result.isConfirmed) {

                    // Eliminar la vacante desde el servidor
                    // Livewire.dispatch("eliminarVacante", vacanteId)

                    // this.call: es una llamada directa al metodo eliminarVacante, util para llamar un metodo en especifico
                    @this.call("eliminarVacante", vacanteId);


                    Swal.fire({
                        title: "Se Eliminó!",
                        text: "La Vacante Ha Sido Eliminada",
                        icon: "success"
                    });
                }
            });
        })

    </script>
@endpush
