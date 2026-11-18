<x-app-layout>
    <x-slot name="header">
        <x-page-header title="Nueva empresa" subtitle="Crea un entorno aislado (tenant) para un cliente" icon="building" />
    </x-slot>

    <div class="mx-auto max-w-3xl px-4 pb-12 pt-6 sm:px-6 lg:px-8">
        <x-card>
            <form method="POST" action="{{ route('saas.tenants.store') }}" class="space-y-6">
                @csrf
                <x-form-errors />

                <div>
                    <x-input-label for="name" value="Razón social" />
                    <x-text-input id="name" type="text" name="name" :value="old('name')" required autofocus placeholder="Ej: Logística Internacional S.A." />
                    <x-input-error :messages="$errors->get('name')" />
                </div>

                <fieldset>
                    <legend class="mb-1.5 block text-sm font-medium text-slate-700">Plan / tipo de licencia</legend>
                    <div class="grid grid-cols-1 gap-2 sm:grid-cols-3">
                        @foreach (['Basic' => 'Básica', 'Profesional' => 'Profesional', 'Corporativa' => 'Corporativa', 'Enterprise' => 'Enterprise', 'Premium' => 'Premium'] as $value => $label)
                            <label class="flex cursor-pointer items-center gap-2 rounded-xl border border-slate-200 px-3 py-2.5 text-sm transition hover:border-slate-300 has-[:checked]:border-slate-900 has-[:checked]:bg-slate-50 has-[:checked]:ring-1 has-[:checked]:ring-slate-900">
                                <input type="radio" name="license_type" value="{{ $value }}" required @checked(old('license_type') === $value)
                                       class="h-4 w-4 border-slate-300 text-slate-900 focus:ring-slate-900/20">
                                <span class="font-medium text-slate-800">{{ $label }}</span>
                            </label>
                        @endforeach
                    </div>
                    <x-input-error :messages="$errors->get('license_type')" />
                </fieldset>

                <x-form-actions :cancel="route('saas.dashboard')">
                    <x-btn icon="check">Crear entorno</x-btn>
                </x-form-actions>
            </form>
        </x-card>
    </div>
</x-app-layout>
