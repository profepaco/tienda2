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
                            <x-th-table>ID</x-th-table>
                            <x-th-table>Nombre</x-th-table>
                            <x-th-table>Descripción</x-th-table>
                            <x-th-table>Precio</x-th-table>
                            <x-th-table>Acciones</x-th-table>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($products as $product)
                            <tr>
                                <x-td-table>{{ $product->id }}</x-td-table>
                                <x-td-table>{{ $product->name }}</x-td-table>
                                <x-td-table>{{ $product->description }}</x-td-table>
                                <x-td-table>${{ number_format($product->price, 2) }}</x-td-table>
                                <x-td-table>
                                    <flux:button size="xs" wire:click="edit({{ $product->id }})" color="emerald" variant="primary">Editar</flux:button>
                                    <flux:button size="xs" wire:click="delete({{ $product->id }})" color="red" variant="primary" >Eliminar</flux:button>
                                </x-td-table>
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