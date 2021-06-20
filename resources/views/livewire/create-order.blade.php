<div class="container py-8 grid grid-cols-5 gap-6">
    <div class="col-span-3">

        <div class="bg-white rounded-lg shadow p-6">

            <div class="mb-4">
                <x-jet-label value="Nombre de contacto" />

                <x-jet-input type="text" wire:model.defer="contact"
                    placeholder="Ingrese el nombre de la persona que recibirá el producto." class="w-full" />

                <x-jet-input-error for="contact" />
            </div>

            <div>
                <x-jet-label value="Telefono de contacto" />

                <x-jet-input type="text" wire:model.defer="phone"
                    placeholder="Ingrese un numero de telefono de contacto" class="w-full" />
                <x-jet-input-error for="phone" />
            </div>

        </div>

        <div x-data="{ envio_type: @entangle('envio_type')}">
            <p class=" mt-6 mb-3 text-lg text-gray-700 font-semibold">Envíos</p>
            <label class="bg-white rounded-lg shadow px-6 py-4 flex items-center mb-4">
                <input x-model="envio_type" type="radio" value="1" name="envio_type" class="text-gray-600">
                <span class="ml-2 text-gray-700">
                    Retiro en tienda (calle falsa 123)
                </span>

                <span class="font-semibold text-gray-700 ml-auto">
                    Gratis
                </span>
            </label>

            <div class="bg-white rounded-lg shadow">
                <label class="px-6 py-4 flex items-center">
                    <input x-model="envio_type" type="radio" value="2" name="envio_type" class="text-gray-600">
                    <span class="ml-2 text-gray-700">
                        Envío a domicilio
                    </span>

                </label>

                <div class="px-6 pb-6 grid-cols-2 gap-6 hidden" :class="{ 'hidden': envio_type != 2 }">
                    {{-- provincia --}}
                    <div>
                        <x-jet-label value="Departamento" />
                        <select class="form-control w-full" wire:model="department_id">
                            <option value="" disabled selected>Selecciones una Provincia</option>

                            @foreach ($departments as $department)
                                <option value="{{ $department->id }}">{{ $department->name }}</option>
                            @endforeach
                        </select>

                        <x-jet-input-error for="department_id" />
                    </div>

                    {{-- ciudad --}}
                    <div>
                        <x-jet-label value="Ciudad" />
                        <select class="form-control w-full" wire:model="city_id">
                            <option value="" disabled selected>Selecciones una Ciudad</option>

                            @foreach ($cities as $city)
                                <option value="{{ $city->id }}">{{ $city->name }}</option>
                            @endforeach
                        </select>

                        <x-jet-input-error for="city_id" />

                    </div>

                    {{-- localidad --}}
                    <div>
                        <x-jet-label value="Localidad" />
                        <select class="form-control w-full" wire:model="district_id">
                            <option value="" disabled selected>Selecciones una Localidad</option>

                            @foreach ($districts as $district)
                                <option value="{{ $district->id }}">{{ $district->name }}</option>
                            @endforeach
                        </select>

                        <x-jet-input-error for="district_id" />

                    </div>

                    <div>
                        <x-jet-label value="Dirección" />
                        <x-jet-input class="w-full" wire:model="address" type="text" />
                        <x-jet-input-error for="address" />
                    </div>

                    <div class=" col-span-2">
                        <x-jet-label value="Referencia" />
                        <x-jet-input class="w-full" wire:model="references" type="text" />
                        <x-jet-input-error for="references" />
                    </div>
                </div>
            </div>

        </div>

        <div>
            <x-jet-button class="mt-6 mb-4" wire:click="create_order">
                Continuar con la compra
            </x-jet-button>

            <hr>
            <p class="text-sm text-gray-700 mt-2">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Porro
                reiciendis
                accusamus impedit, debitis
                nulla exercitationem culpa sunt fugiat? Dignissimos ab magni cum veritatis maiores iure, eius magnam
                earum fugit nemo. <a href="" class="font-semibold text-orange-500">Políticas y privacidad</a></p>
        </div>
    </div>

    <div class="col-span-2">
        <div class="bg-white rounded-lg shadow p-6">
            <ul>
                @forelse (Cart::content() as $item)
                    <li class="flex p-2 border-b border-gray-200">
                        <img class="h-15 w-20 object-cover mr-4" src="{{ $item->options->image }}" alt="">
                        <article class="flex-1">
                            <h1 class="font-bold">{{ $item->name }}</h1>

                            <div class="flex">
                                <p>Cant: {{ $item->qty }}</p>
                                @isset($item->options['color'])
                                    <p class="mx-2">- Color: {{ __($item->options['color']) }}</p>
                                @endisset

                                @isset($item->options['size'])
                                    <p>- {{ $item->options['size'] }}</p>
                                @endisset
                            </div>

                            <p>USD: {{ $item->price }}</p>
                        </article>
                    </li>
                @empty
                    <li class="py-6 px-4">
                        <p class="text-center text-gray-700">
                            No tiene agregado ningun ítem al carrito.
                        </p>
                    </li>
                @endforelse
            </ul>

            <hr class="mt-4 mb-3">

            <div class="text-gray-700">
                <p class="flex justify-between items-center">
                    Subtotal
                    <span class=" font-semibold">{{ Cart::subtotal() }} USD</span>
                </p>

                <p class="flex justify-between items-center">
                    Envío
                    <span class=" font-semibold">Gratis</span>
                </p>

                <hr class="mt-4 mb-3">

                <p class="flex justify-between items-center font-semibold">
                    <span class="text-lg">Total</span>
                    {{ Cart::subtotal() }} USD
                </p>

            </div>
        </div>
    </div>
</div>