<div>
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


    <flux:modal.trigger name="crear-proyecto">
    <flux:button variant="primary">Crear nuevo proyecto</flux:button>
</flux:modal.trigger>

<flux:modal name="crear-proyecto" class="md:w-96">
    <div class="space-y-6">
        <div>
            <flux:heading size="lg">Crear nuevo</flux:heading>
            <flux:text class="mt-2">Complete los campos requeridos</flux:text>
        </div>
        <br>
    </div>
    <form wire:submit.prevent="save">
        <div class="space-y-4">
            <div>
                <flux:label for="nombre">Nombre del Proyecto<b>(*)</b></flux:label>
                <flux:input id="nombre" type="text" wire:model="nombre" required class="mt-1 w-full" />
                @error('nombre') <flux:text class="text-red-600 text-sm">{{ $message }}</flux:text> @enderror
            </div>
            <div>
                <flux:label for="descripcion">Descripción<b>(*)</b></flux:label>
                <flux:textarea id="descripcion" wire:model="descripcion" required class="mt-1 w-full" />
                @error('descripcion') <flux:text class="text-red-600 text-sm">{{ $message }}</flux:text> @enderror
            </div>
        </div>
        <div class="mt-6 flex justify-end gap-3">
            <flux:modal.close name="crear-proyecto" class="mr-2">
                <flux:button type="button" variant="filled">cerrar2</flux:button>
            </flux:modal.close>

            <flux:button type="submit" variant="primary">Crear Proyecto</flux:button>
        </div>

</flux:modal>

<br>
<flux:textarea
    label="Order notes"
    placeholder="No lettuce, tomato, or onion..."
/>
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
</div>
