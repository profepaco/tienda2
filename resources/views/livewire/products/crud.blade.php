<div class="p-6">
    <h1 class="text-2xl font-bold mb-4">Productos</h1>

    @if (session()->has('message'))
        <div class="bg-green-100 text-green-800 p-2 rounded mb-4">
            {{ session('message') }}
        </div>
    @endif

    <div class="flex justify-between items-center mb-4 gap-4">
        <flux:input 
            type="text" 
            wire:model.live="search" 
            placeholder="Buscar productos..." 
        />
        <!-- <flux:modal.trigger name="create"> -->
            <flux:button variant="primary" wire:click="create">Nuevo</flux:button>
        <!-- </flux:modal.trigger> -->
    </div>

    <div class="flex flex-col mt-5">
        <div class="overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
            <div class="inline-block min-w-full overflow-hidden align-middle border-b border-gray-200 dark:border-gray-600 shadow sm:rounded-lg">
                <table class="w-full">
                    <thead>
                        <tr>
                            <th class="px-6 py-3 text-sm font-extra-bold leading-4 tracking-wider text-left text-gray-500 dark:text-gray-300 uppercase border-b border-gray-200 dark:border-gray-600 bg-gray-50 dark:bg-neutral-700">ID</th>
                            <th class="px-6 py-3 text-sm font-extra-bold leading-4 tracking-wider text-left text-gray-500 dark:text-gray-300 uppercase border-b border-gray-200 dark:border-gray-600 bg-gray-50 dark:bg-neutral-700">Nombre</th>
                            <th class="px-6 py-3 text-sm font-extra-bold leading-4 tracking-wider text-left text-gray-500 dark:text-gray-300 uppercase border-b border-gray-200 dark:border-gray-600 bg-gray-50 dark:bg-neutral-700">Descripción</th>
                            <th class="px-6 py-3 text-sm font-extra-bold leading-4 tracking-wider text-left text-gray-500 dark:text-gray-300 uppercase border-b border-gray-200 dark:border-gray-600 bg-gray-50 dark:bg-neutral-700">Precio</th>
                            <th class="px-6 py-3 text-sm font-extra-bold leading-4 tracking-wider text-left text-gray-500 dark:text-gray-300 uppercase border-b border-gray-200 dark:border-gray-600 bg-gray-50 dark:bg-neutral-700">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($products as $product)
                            <tr>
                                <td class="py-4 px-6 whitespace-no-wrap border-b border-gray-200 dark:border-gray-600">{{ $product->id }}</td>
                                <td class="py-4 px-6 whitespace-no-wrap border-b border-gray-200 dark:border-gray-600">{{ $product->name }}</td>
                                <td class="py-4 px-6 whitespace-no-wrap border-b border-gray-200 dark:border-gray-600">{{ $product->description }}</td>
                                <td class="py-4 px-6 whitespace-no-wrap border-b border-gray-200 dark:border-gray-600">${{ number_format($product->price, 2) }}</td>
                                <td class="py-4 px-6 whitespace-no-wrap border-b border-gray-200 dark:border-gray-600">
                                    <flux:button size="xs" wire:click="edit({{ $product->id }})" color="emerald" variant="primary">Editar</flux:button>
                                    <flux:button size="xs" wire:click="delete({{ $product->id }})" color="red" variant="primary" >Eliminar</flux:button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-4 py-4 text-center">No hay productos</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="mt-4">
        {{ $products->links() }}
    </div>

    @if($isOpen)
    <flux:modal wire:model.self="isOpen" class="md:w-96">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">{{ $productId ? 'Editar Producto' : 'Crear Producto' }}</flux:heading>
            </div>
            <flux:field>
                <flux:label>Nombre</flux:label>
                <flux:input wire:model="name" type="text" />
                <flux:error name="name" />
            </flux:field>
            <flux:field>
                <flux:label>Descripción</flux:label>
                <flux:textarea wire:model="description" />
                <flux:error name="description" />
            </flux:field>
            <flux:field>
                <flux:label>Precio</flux:label>
                <flux:input type="number" step="0.01" wire:model="price"/>
                <flux:error name="price" />
            </flux:field>
            <div class="flex gap-2">
                <flux:spacer />
                <flux:modal.close>
                    <flux:button variant="ghost" wire:click="closeModal">Cancelar</flux:button>
                </flux:modal.close>
                <flux:button wire:click="save" variant="primary">Guardar</flux:button>
            </div>
        </div>
    </flux:modal>
    @endif
    <!-- Modal -->
    
</div>