<x-app-layout>
    <x-slot name="header">
        <x-page-header title="Registrar nuevo proceso" subtitle="Vincula un proceso a su área dueña" />
    </x-slot>

    <div class="py-8">
        <div class="mx-auto max-w-3xl px-4 sm:px-6 lg:px-8">
            <x-card>
                <form method="POST" action="{{ route('processes.store') }}" class="space-y-5">
                    @csrf
                    <div>
                        <x-input-label value="Seleccionar área dueña" />
                        <select name="area_id" required class="block w-full rounded-lg border-slate-300 text-sm shadow-sm transition focus:border-slate-900 focus:ring-2 focus:ring-slate-900/10">
                            @foreach($areas as $area)
                                <option value="{{ $area->id }}">{{ $area->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <x-input-label value="Nombre del proceso subordinado" />
                        <x-text-input type="text" name="name" required placeholder="Ej: Cierre de negociaciones comerciales" class="w-full" />
                    </div>
                    <div class="flex justify-end gap-3 border-t border-slate-100 pt-4">
                        <x-btn :href="route('processes.index')" variant="secondary">Cancelar</x-btn>
                        <x-btn>Guardar proceso</x-btn>
                    </div>
                </form>
            </x-card>
        </div>
    </div>
</x-app-layout>
