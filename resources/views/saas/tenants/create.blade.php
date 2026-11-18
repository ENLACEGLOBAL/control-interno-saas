<x-app-layout>
    <x-slot name="header">
        <x-page-header title="Registrar nueva empresa" subtitle="Crea un nuevo tenant en la plataforma" />
    </x-slot>

    <div class="py-8">
        <div class="mx-auto max-w-2xl px-4 sm:px-6 lg:px-8">
            <x-card>
                <form method="POST" action="{{ route('saas.tenants.store') }}" class="space-y-5">
                    @csrf
                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                        <div>
                            <x-input-label value="Razón social de la empresa" />
                            <x-text-input type="text" name="name" required placeholder="Ej: Logística Internacional S.A." class="w-full" />
                        </div>
                        <div>
                            <x-input-label value="Plan / tipo de licencia" />
                            <x-select name="license_type" required>
                                <option value="">-- Seleccionar plan SaaS --</option>
                                <option value="Basic">Licencia básica</option>
                                <option value="Profesional">Licencia profesional</option>
                                <option value="Corporativa">Licencia corporativa</option>
                                <option value="Enterprise">Enterprise</option>
                                <option value="Premium">Premium</option>
                            </x-select>
                        </div>
                    </div>

                    <div class="flex justify-end gap-3 border-t border-slate-100 pt-4">
                        <x-btn :href="route('saas.dashboard')" variant="secondary">Cancelar</x-btn>
                        <x-btn>Crear entorno de cliente</x-btn>
                    </div>
                </form>
            </x-card>
        </div>
    </div>
</x-app-layout>
