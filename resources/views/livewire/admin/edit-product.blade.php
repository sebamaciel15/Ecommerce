<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12 text-gray-700">
    <h1 class="text-3xl text-center font-semibold mb-8">Complete esta informacion para crear un producto</h1>

    <div class="bg-white shadow-xl rounded-lg p-6">
        <div class="grid grid-cols-2 gap-6 mb-4">
            {{-- categoria --}}
            <div>
                <x-jet-label value="categorías"></x-jet-label>
                <select class="w-full form-control" wire:model="category_id">
                    <option value="" selected disabled>Seleccione una categoria</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>

                <x-jet-input-error for="category_id"></x-jet-input-error>

            </div>
            {{-- subcategoria --}}
            <div>
                <x-jet-label value="Subcategorías"></x-jet-label>
                <select class="w-full form-control" wire:model="product.subcategory_id">
                    <option value="" selected disabled>Seleccione una subcategoria</option>
                    @foreach ($subcategories as $subcategory)
                        <option value="{{ $subcategory->id }}">{{ $subcategory->name }}</option>
                    @endforeach
                </select>

                <x-jet-input-error for="product.subcategory_id"></x-jet-input-error>

            </div>
        </div>

        {{-- Nombre --}}
        <div class="mb-4">
            <x-jet-label value="Nombre"></x-jet-label>
            <x-jet-input type="text" class="w-full" wire:model="product.name"
                placeholder="Ingrese el nombre del producto">
            </x-jet-input>
            <x-jet-input-error for="product.name"></x-jet-input-error>
        </div>

        {{-- Slug --}}
        <div class="mb-4">
            <x-jet-label value="Slug"></x-jet-label>
            <x-jet-input type="text" disabled class="w-full bg-gray-200" wire:model="product.slug"
                placeholder="Ingrese el slug del producto">
            </x-jet-input>
            <x-jet-input-error for="product.slug"></x-jet-input-error>
        </div>

        {{-- Descripcion --}}
        <div class="mb-4">
            <div wire:ignore>
                <x-jet-label value="Descripción"></x-jet-label>
                <textarea class="w-full form-control" wire:model="product.description" rows="4" x-data x-init="ClassicEditor
                .create( $refs.miEditor )
                .then(function(editor){
                    editor.model.document.on('change:data', () => {
                        @this.set('product.description', editor.getData())
                    })
                })
                .catch( error => {
                    console.error( error );
                } );" x-ref="miEditor">
                </textarea>
            </div>
            <x-jet-input-error for="product.description"></x-jet-input-error>
        </div>

        <div class="grid grid-cols-2 gap-6 mb-4">
            {{-- marca --}}
            <div>
                <x-jet-label value="Marca"></x-jet-label>
                <select class="form-control w-full" wire:model="product.brand_id">
                    <option value="" selected disabled>Seleccione una marca</option>
                    @foreach ($brands as $brand)
                        <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                    @endforeach
                </select>
                <x-jet-input-error for="product.brand_id"></x-jet-input-error>
            </div>

            {{-- Precio --}}
            <div>
                <x-jet-label value="Precio"></x-jet-label>
                <x-jet-input wire:model="product.price" type="number" class="w-full" step=".01"></x-jet-input>
                <x-jet-input-error for="product.price"></x-jet-input-error>
            </div>

        </div>

        @if ($this->subcategory)

            @if (!$this->subcategory->color && !$this->subcategory->size)
                <div>
                    <x-jet-label value="Cantidad"></x-jet-label>
                    <x-jet-input wire:model="product.quantity" type="number" class="w-full"></x-jet-input>
                    <x-jet-input-error for="product.quantity"></x-jet-input-error>
                </div>
            @endif

        @endif

        <div class="flex justify-end items-center mt-4 ">
            <x-jet-action-message class="mr-3" on="saved">Actualizado</x-jet-action-message>
            <x-jet-button wire:loading.attr="disabled" wire:target="save" wire:click="save">Actualizar
                producto
            </x-jet-button>
        </div>
    </div>

    @if ($this->subcategory)
        @if ($this->subcategory->size)

            @livewire('admin.size-product', ['product' => $product], key('size-product' . $product->id))

        @elseif($this->subcategory->color)

            @livewire('admin.color-product', ['product' => $product], key('color-product' . $product->id))

        @endif
    @endif

</div>
