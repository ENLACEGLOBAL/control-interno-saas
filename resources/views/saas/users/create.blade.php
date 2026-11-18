<x-app-layout>
    <x-slot name="header">
        <x-page-header title="Registrar nuevo usuario" subtitle="Crea credenciales globales y asigna entornos" />
    </x-slot>

    <div class="py-8">
        <div class="mx-auto max-w-4xl px-4 sm:px-6 lg:px-8">
            <x-card>
                <form method="POST" action="{{ route('saas.users.store') }}" class="space-y-6">
                    @csrf

                    <div>
                        <h3 class="mb-4 flex items-center gap-2 border-b border-slate-100 pb-2 text-sm font-semibold text-slate-700">
                            <span class="flex h-6 w-6 items-center justify-center rounded-md bg-slate-100 text-slate-500 text-xs">1</span>
                            Credenciales globales
                        </h3>
                        <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">
                            <div>
                                <x-input-label value="Nombre completo" />
                                <x-text-input type="text" name="name" required placeholder="Ej: Juan Pérez" class="w-full text-sm" />
                            </div>
                            <div>
                                <x-input-label value="Correo electrónico" />
                                <x-text-input type="email" name="email" required placeholder="juan@empresa.com" class="w-full text-sm" />
                            </div>
                            <div>
                                <x-input-label value="Contraseña temporal" />
                                <x-text-input type="password" name="password" required placeholder="Mínimo 8 caracteres" class="w-full text-sm" />
                            </div>
                        </div>
                    </div>

                    <div>
                        <h3 class="mb-4 flex items-center gap-2 border-b border-slate-100 pb-2 text-sm font-semibold text-slate-700">
                            <span class="flex h-6 w-6 items-center justify-center rounded-md bg-slate-100 text-slate-500 text-xs">2</span>
                            Entornos autorizados y niveles de acceso
                        </h3>
                        <div class="overflow-x-auto rounded-xl border border-slate-200">
                            <table class="min-w-full divide-y divide-slate-200 text-left text-sm">
                                <thead class="bg-slate-50 text-xs font-semibold uppercase tracking-wider text-slate-500">
                                    <tr>
                                        <th class="w-16 px-6 py-3 text-center">¿Acceso?</th>
                                        <th class="px-6 py-3">Empresa / tenant</th>
                                        <th class="px-6 py-3">Rol asignado</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-100 bg-white">
                                    @forelse($tenants as $t)
                                    <tr class="transition hover:bg-slate-50">
                                        <td class="px-6 py-4 text-center">
                                            <input type="checkbox" name="tenant_ids[]" value="{{ $t->id }}"
                                                class="h-4 w-4 cursor-pointer rounded border-slate-300 text-slate-900 focus:ring-slate-900/20">
                                        </td>
                                        <td class="px-6 py-4 font-semibold text-slate-700">{{ $t->name }}</td>
                                        <td class="px-6 py-4">
                                            <x-select name="role_names[{{ $t->id }}]" class="py-1 text-xs">
                                                <option value="">-- Seleccionar rol --</option>
                                                @foreach($roles as $r)
                                                <option value="{{ $r->name }}">{{ strtoupper(str_replace('_', ' ', $r->name)) }}</option>
                                                @endforeach
                                            </x-select>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="3" class="p-4 text-center text-xs font-medium italic text-red-500">
                                            Debes registrar al menos una empresa antes de dar de alta usuarios.
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="flex justify-end gap-3 border-t border-slate-100 pt-4">
                        <x-btn :href="route('saas.dashboard')" variant="secondary">Cancelar</x-btn>
                        <x-btn>Dar de alta y enlazar cuentas</x-btn>
                    </div>
                </form>
            </x-card>
        </div>
    </div>
</x-app-layout>
