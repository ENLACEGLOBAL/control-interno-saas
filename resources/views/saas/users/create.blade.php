<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">👥 Registrar Nuevo Empleado SaaS</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 border-t-4 border-slate-800">
                <form method="POST" action="{{ route('saas.users.store') }}">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-6">
                        <div class="bg-gray-50 p-5 rounded-xl border border-gray-200 space-y-4">
                            <h3 class="font-bold text-gray-700 text-sm border-b pb-2 flex items-center gap-1">🔑 1. Credenciales Globales</h3>
                            <div>
                                <label class="block text-xs font-bold text-gray-600 uppercase">Nombre Completo</label>
                                <input type="text" name="name" required class="mt-1 block w-full text-sm rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" placeholder="Ej: Juan Pérez">
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-gray-600 uppercase">Correo Electrónico (Inicios de Sesión)</label>
                                <input type="email" name="email" required class="mt-1 block w-full text-sm rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" placeholder="juan@empresa.com">
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-gray-600 uppercase">Contraseña Temporal</label>
                                <input type="password" name="password" required class="mt-1 block w-full text-sm rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" placeholder="Mínimo 8 caracteres">
                            </div>
                        </div>

                        <div class="bg-indigo-50/60 p-5 rounded-xl border border-indigo-100 col-span-1 md:col-span-2">
                            <h3 class="font-bold text-indigo-950 text-sm border-b border-indigo-200 pb-2 flex items-center gap-1 mb-4">
                                🛡️ 2. Entornos Autorizados y Niveles de Acceso
                            </h3>

                            <div class="overflow-x-auto bg-white rounded-xl border border-indigo-100 shadow-sm">
                                <table class="min-w-full divide-y divide-gray-200 text-sm text-left">
                                    <thead class="bg-gray-50 text-xs font-bold text-indigo-900 uppercase tracking-wider">
                                        <tr>
                                            <th class="px-6 py-3 w-16 text-center">¿Acceso?</th>
                                            <th class="px-6 py-3">Empresa / Tenant</th>
                                            <th class="px-6 py-3">Rol asignado para esta Empresa</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-100 bg-white">
                                        @forelse($tenants as $t)
                                        <tr class="hover:bg-slate-50 transition-colors">
                                            <td class="px-6 py-4 text-center">
                                                <input type="checkbox" name="tenant_ids[]" value="{{ $t->id }}"
                                                    class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500 h-4 w-4 cursor-pointer">
                                            </td>
                                            <td class="px-6 py-4 font-semibold text-gray-700">
                                                {{ $t->name }}
                                            </td>
                                            <td class="px-6 py-4">
                                                <select name="role_names[{{ $t->id }}]" class="block w-full text-xs rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 bg-slate-50 py-1">
                                                    <option value="">-- Seleccionar Rol --</option>
                                                    @foreach($roles as $r)
                                                    <option value="{{ $r->name }}">{{ strtoupper(str_replace('_', ' ', $r->name)) }}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="3" class="text-xs text-red-500 italic p-4 text-center font-medium">
                                                ⚠️ Alerta: Debes registrar al menos una empresa antes de dar de alta usuarios.
                                            </td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-end border-t pt-4 gap-3">
                        <a href="{{ route('saas.dashboard') }}" class="text-gray-500 hover:text-gray-700 font-bold text-xs uppercase tracking-wider flex items-center px-4">Cancelar</a>
                        <button type="submit" class="bg-slate-800 hover:bg-slate-700 text-white font-bold py-2 px-6 rounded-lg text-xs uppercase tracking-wider shadow-md transition-all">
                            Dar de Alta y Enlazar Cuentas
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>