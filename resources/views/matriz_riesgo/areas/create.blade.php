<x-app-layout>
    <x-slot name="header">
        <x-page-header title="Nueva dirección / área" subtitle="Registra una unidad organizacional de la empresa" icon="building" />
    </x-slot>

    <div class="mx-auto max-w-3xl px-4 pb-12 pt-6 sm:px-6 lg:px-8">
        <x-card>
            <form method="POST" action="{{ route('areas.store') }}" class="space-y-6">
                @csrf
                <x-form-errors />

                <div>
                    <x-input-label for="name" value="Nombre de la dirección / área" />
                    <x-text-input id="name" type="text" name="name" :value="old('name')" required autofocus placeholder="Ej: Dirección Financiera y Contable" />
                    <p class="mt-1.5 text-xs text-slate-400">Usa el nombre oficial tal como aparece en el organigrama.</p>
                    <x-input-error :messages="$errors->get('name')" />
                </div>

                <x-form-actions :cancel="route('areas.index')">
                    <x-btn icon="check">Guardar área</x-btn>
                </x-form-actions>
            </form>
        </x-card>
    </div>
</x-app-layout>
