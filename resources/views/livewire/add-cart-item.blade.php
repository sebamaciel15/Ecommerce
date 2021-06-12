<div>
    <div class="flex">
        <div class="mr-4">
            <x-jet-secondary-button wire:click="decrement">
                -
            </x-jet-secondary-button>

            <span class="mx-2 text-gray-700">{{$qty}}</span>

            <x-jet-secondary-button wire:click="increment">
                +
            </x-jet-secondary-button>
        </div>

        <div class="flex-1">
            <x-button color="orange" class="w-full">
                Agregar a carrito de compras
            </x-button>
        </div>

    </div>
</div>
