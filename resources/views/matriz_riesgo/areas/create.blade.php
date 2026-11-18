<x-app-layout>
    <x-slot name="header">
        <x-page-header title="Crear dirección / área" subtitle="Registra una nueva unidad organizacional" />
    </x-slot>

    <div class="py-8">
        <div class="mx-auto max-w-3xl px-4 sm:px-6 lg:px-8">
            <x-card>
                <form method="POST" action="{{ route('areas.store') }}" class="space-y-5">
                    @csrf
                    <div>
                        <x-input-label value="Nombre de la dirección / área" />
                        <x-text-input type="text" name="name" required placeholder="Ej: Dirección Financiera y Contable" class="w-full" />
                    </div>
                    <div class="flex justify-end gap-3 border-t border-slate-100 pt-4">
                        <x-btn :href="route('areas.index')" variant="secondary">Cancelar</x-btn>
                        <x-btn>Guardar área</x-btn>
                    </div>
                </form>
            </x-card>
        </div>
    </div>
</x-app-layout>
