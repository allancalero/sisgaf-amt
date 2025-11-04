<div>
    <!-- Toast container -->
    <div id="toast" class="fixed bottom-6 end-6 z-50 hidden">
        <div id="toast-body" class="inline-flex items-center gap-3 rounded-md bg-zinc-900 text-white px-4 py-2 shadow-lg"></div>
    </div>

    <flux:breadcrumbs>
        <flux:breadcrumbs.item href="{{ route('dashboard') }}">Inicio</flux:breadcrumbs.item>
        <flux:breadcrumbs.item href="{{ route('proyectos') }}">Listado de Proyectos</flux:breadcrumbs.item>
         </flux:breadcrumbs>

    <div class="my-4 flex items-center justify-between">
        <hr class="flex-1 mr-4">
        <div class="flex items-center gap-2">
            <button id="theme-toggle" type="button" class="inline-flex items-center px-3 py-1.5 border border-gray-300 rounded-md text-sm bg-white dark:bg-neutral-800 dark:border-neutral-700">
                <!-- label set by JS -->
            </button>
        </div>
    </div>


    <div class="mb-4">
        <flux:button type="button" variant="primary" wire:click.prevent="toggleCreate">Crear nuevo proyecto</flux:button>
    </div>

    @if($showCreate)
        <div class="mb-6 p-4 border rounded bg-white dark:bg-neutral-900">
            <div class="space-y-4">
                <div>
                    <flux:heading size="lg">Crear nuevo</flux:heading>
                    <flux:text class="mt-2">Complete los campos requeridos</flux:text>
                </div>
            </div>

            <form wire:submit.prevent="save" class="mt-4">
                <div class="space-y-4">
                    <div>
                        <flux:label for="nombre">Nombre del Proyecto<b>(*)</b></flux:label>
                        <flux:input id="nombre" type="text" wire:model="nombre" required class="mt-1 w-full" />
                        @error('nombre') <flux:text class="text-red-600 text-sm">{{ $message }}</flux:text> @enderror
                    </div>
                </div>

                <div class="mt-4 flex justify-end gap-3">
                    <flux:button type="button" variant="outline" wire:click.prevent="toggleCreate">Cancelar</flux:button>
                    <flux:button type="submit" variant="primary">Crear Proyecto</flux:button>
                </div>
            </form>
        </div>
    @endif

<br>

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white dark:bg-neutral-900 border border-b divide-y divide-gray-200" style="width: 100%">
            <thead class="bg-gray-50 dark:bg-neutral-800">
                <tr>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">ID</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Nombre del Proyecto</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Descripción</th>
                </tr>
            </thead>
            <tbody class="bg-white dark:bg-transparent divide-y divide-gray-200 dark:divide-neutral-700">
                @forelse($proyectos as $proyecto)
                    <tr class="odd:bg-white even:bg-gray-50 dark:odd:bg-neutral-900 dark:even:bg-neutral-800">
                        <td class="px-4 py-3 whitespace-nowrap text-gray-900 dark:text-gray-200">{{ $proyecto->id }}</td>
                        <td class="px-4 py-3 whitespace-nowrap text-gray-900 dark:text-gray-200">{{ $proyecto->nombre }}</td>
                        <td class="px-4 py-3 whitespace-normal text-gray-900 dark:text-gray-200">{{ $proyecto->descripcion }}</td>
                    </tr>
                @empty
                    <tr>
                        <td class="px-4 py-3 text-gray-700 dark:text-gray-300" colspan="3">No hay proyectos disponibles.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <div class="mt-4">
            @if(method_exists($proyectos, 'links'))
                {{ $proyectos->links() }}
            @endif
        </div>
    </div>
    <script>
        (function(){
            const toast = document.getElementById('toast');
            const toastBody = document.getElementById('toast-body');
            if(!toast || !toastBody) return;
            function showToast(message, timeout = 3000){
                toastBody.textContent = message;
                toast.classList.remove('hidden');
                toast.classList.add('opacity-0');
                // animate in
                requestAnimationFrame(()=>{
                    toast.classList.remove('opacity-0');
                    toast.classList.add('transition','duration-300','opacity-100');
                });
                setTimeout(()=>{
                    toast.classList.remove('opacity-100');
                    toast.classList.add('opacity-0');
                    setTimeout(()=> toast.classList.add('hidden'), 300);
                }, timeout);
            }

            // Listen for Livewire browser event
            window.addEventListener('notify', function(e){
                if(e && e.detail && e.detail.message) showToast(e.detail.message);
            });

            // If server rendered a flash message in session, show it on load
            @if(session('message'))
                document.addEventListener('DOMContentLoaded', function(){ showToast(@json(session('message'))); });
            @endif
        })();
    </script>
</div>
