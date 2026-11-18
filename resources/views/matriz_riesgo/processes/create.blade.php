<x-app-layout>
    <x-slot name="header">
        <x-page-header title="Nuevo proceso" subtitle="Vincula un proceso operativo a su área dueña" icon="flow" />
    </x-slot>

    <div class="mx-auto max-w-3xl px-4 pb-12 pt-6 sm:px-6 lg:px-8">
        <x-card>
            @if ($areas->isEmpty())
                <x-empty-state icon="building" title="Primero necesitas un área"
                               description="Cada proceso pertenece a un área. Registra al menos una para continuar.">
                    <x-btn :href="route('areas.create')" icon="plus">Crear área</x-btn>
                </x-empty-state>
            @else
                <form method="POST" action="{{ route('processes.store') }}" class="space-y-6">
                    @csrf
                    <x-form-errors />

                    <div>
                        <x-input-label for="area_id" value="Área dueña" />
                        <x-select id="area_id" name="area_id" required>
                            @foreach ($areas as $area)
                                <option value="{{ $area->id }}" @selected(old('area_id') == $area->id)>{{ $area->name }}</option>
                            @endforeach
                        </x-select>
                        <x-input-error :messages="$errors->get('area_id')" />
                    </div>
                    <div>
                        <x-input-label for="name" value="Nombre del proceso" />
                        <x-text-input id="name" type="text" name="name" :value="old('name')" required placeholder="Ej: Cierre de negociaciones comerciales" />
                        <x-input-error :messages="$errors->get('name')" />
                    </div>

                    <x-form-actions :cancel="route('processes.index')">
                        <x-btn icon="check">Guardar proceso</x-btn>
                    </x-form-actions>
                </form>
            @endif
        </x-card>
    </div>
</x-app-layout>
