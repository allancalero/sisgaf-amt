<div>
    <!-- Toast container -->
    <div id="toast" class="fixed bottom-6 end-6 z-50 hidden">
        <div id="toast-body" class="inline-flex items-center gap-3 rounded-md bg-zinc-900 text-white px-4 py-2 shadow-lg"></div>
    </div>
    <div class="mt-4 md:hidden">
        @if(method_exists($areas, 'links'))
            {{ $areas->links() }}
        @endif
    </div>

    <flux:breadcrumbs>
        <flux:breadcrumbs.item href="{{ route('dashboard') }}">Inicio</flux:breadcrumbs.item>
        <flux:breadcrumbs.item href="{{ route('areas') }}">Listado de Áreas</flux:breadcrumbs.item>
    </flux:breadcrumbs>

    <div class="mb-4">
        <flux:button type="button" variant="primary" wire:click.prevent="toggleCreate">Crear nueva Área</flux:button>
    </div>

    @if($showCreate)
        <div class="mb-6 p-4 border rounded bg-white dark:bg-neutral-900">
            <div class="space-y-4">
                <div>
                    <flux:heading size="lg">@if($editingId) Editar área @else Crear nueva área @endif</flux:heading>
                    <flux:text class="mt-2">Complete los campos requeridos</flux:text>
                </div>
            </div>

            <form wire:submit.prevent="save" class="mt-4">
                <div class="space-y-4">
                    <div>
                        <flux:label for="Nombre">Nombre<b>(*)</b></flux:label>
                        <flux:input id="Nombre" type="text" wire:model="Nombre" required class="mt-1 w-full" />
                        @error('Nombre') <flux:text class="text-red-600 text-sm">{{ $message }}</flux:text> @enderror
                    </div>

                    <div>
                        <flux:label for="Estado">Estado</flux:label>
                        <flux:select id="Estado" wire:model="Estado" class="mt-1 w-full">
                            <option value="Activo">Activo</option>
                            <option value="Inactivo">Inactivo</option>
                        </flux:select>
                        @error('Estado') <flux:text class="text-red-600 text-sm">{{ $message }}</flux:text> @enderror
                    </div>
                </div>

                <div class="mt-4 flex justify-end gap-3">
                    @if($editingId)
                        <flux:button type="button" variant="outline" wire:click.prevent="cancelEdit">Cancelar</flux:button>
                        <flux:button type="submit" variant="primary">Actualizar Área</flux:button>
                    @else
                        <flux:button type="button" variant="outline" wire:click.prevent="toggleCreate">Cancelar</flux:button>
                        <flux:button type="submit" variant="primary">Crear Área</flux:button>
                    @endif
                </div>
            </form>
        </div>
    @endif

    <br>

    <!-- Mobile list -->
    <div class="md:hidden space-y-3">
        @forelse($areas as $area)
            <div class="p-4 bg-white dark:bg-neutral-900 border rounded">
                <div class="flex items-start justify-between">
                    <div>
                        <div class="text-sm text-gray-500">Nombre</div>
                        <div class="font-medium text-gray-900 dark:text-gray-200">{{ $area->Nombre }}</div>
                        <div class="text-sm text-gray-500 mt-1">Estado: <span class="font-medium text-gray-900 dark:text-gray-200">{{ $area->Estado }}</span></div>
                    </div>
                    <div class="text-right">
                        <div class="flex flex-col items-end gap-2">
                            <button wire:click="edit({{ $area->id }})" class="px-2 py-1 text-sm rounded border bg-white dark:bg-neutral-800">Editar</button>
                            <button onclick="if(confirm('{{ $area->Estado === 'Activo' ? '¿Desea inactivar esta área?' : '¿Desea activar esta área?' }}')) Livewire.emit('confirmToggle', {{ $area->id }})" class="px-2 py-1 text-sm rounded {{ $area->Estado === 'Activo' ? 'bg-red-600 text-white' : 'bg-green-600 text-white' }}">{{ $area->Estado === 'Activo' ? 'Inactivar' : 'Activar' }}</button>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="p-4 bg-white dark:bg-neutral-900 border rounded">No hay áreas disponibles.</div>
        @endforelse
    </div>

    <div class="hidden md:block overflow-x-auto">
        <table class="min-w-full bg-white dark:bg-neutral-900 border border-b divide-y divide-gray-200" style="width: 100%">
            <thead class="bg-gray-50 dark:bg-neutral-800">
                <tr>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">ID</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Nombre</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Estado</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Acciones</th>
                </tr>
            </thead>
            <tbody class="bg-white dark:bg-transparent divide-y divide-gray-200 dark:divide-neutral-700">
                @forelse($areas as $area)
                    <tr class="odd:bg-white even:bg-gray-50 dark:odd:bg-neutral-900 dark:even:bg-neutral-800">
                        <td class="px-4 py-3 whitespace-nowrap text-gray-900 dark:text-gray-200">{{ $area->id }}</td>
                        <td class="px-4 py-3 whitespace-nowrap text-gray-900 dark:text-gray-200">{{ $area->Nombre }}</td>
                        <td class="px-4 py-3 whitespace-nowrap text-gray-900 dark:text-gray-200">{{ $area->Estado }}</td>
                        <td class="px-4 py-3 whitespace-nowrap text-gray-900 dark:text-gray-200">
                            <div class="flex items-center gap-2">
                                <span class="px-2 py-0.5 rounded text-xs {{ $area->Estado === 'Activo' ? 'bg-green-100 text-green-800' : 'bg-gray-200 text-gray-800' }}">{{ $area->Estado }}</span>
                                <button wire:click="edit({{ $area->id }})" class="px-2 py-1 text-sm rounded border bg-white dark:bg-neutral-800">Editar</button>
                                <button onclick="if(confirm('{{ $area->Estado === 'Activo' ? '¿Desea inactivar esta área?' : '¿Desea activar esta área?' }}')) Livewire.emit('confirmToggle', {{ $area->id }})" class="px-2 py-1 text-sm rounded {{ $area->Estado === 'Activo' ? 'bg-red-600 text-white' : 'bg-green-600 text-white' }}" title="{{ $area->Estado === 'Activo' ? 'Inactivar' : 'Activar' }}">
                                    {{ $area->Estado === 'Activo' ? 'Inactivar' : 'Activar' }}
                                </button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td class="px-4 py-3 text-gray-700 dark:text-gray-300" colspan="4">No hay áreas disponibles.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <div class="mt-4">
            @if(method_exists($areas, 'links'))
                {{ $areas->links() }}
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

            @if(session('message'))
                document.addEventListener('DOMContentLoaded', function(){ showToast(@json(session('message'))); });
            @endif
        })();
    </script>
</div>
