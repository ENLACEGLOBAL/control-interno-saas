<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">🛡️ Matriz Maestra de Roles y Permisos</h2>
            <a href="{{ route('saas.dashboard') }}" class="text-sm font-bold text-indigo-600 hover:text-indigo-900">Volver al Dashboard</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200">
                    <h3 class="font-bold text-gray-800 uppercase text-sm mb-4">1. Crear Nuevo Permiso (Código)</h3>
                    <form method="POST" action="{{ route('saas.permissions.store') }}" class="flex gap-2">
                        @csrf
                        <input type="text" name="name" required placeholder="ej: crear_riesgos, editar_controles..." class="flex-1 text-sm rounded-md border-gray-300 shadow-sm focus:border-indigo-500">
                        <button type="submit" class="bg-slate-800 text-white px-4 py-2 rounded text-sm font-bold hover:bg-slate-700">Añadir Permiso</button>
                    </form>
                    <p class="text-[10px] text-gray-400 mt-2">Este nombre es el que usarás en el código (Ej: <span class="font-mono text-indigo-500">@@can('crear_riesgos')</span>)</p>
                </div>

                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200 border-t-4 border-indigo-600">
                    <h3 class="font-bold text-gray-800 uppercase text-sm mb-4">2. Crear Nuevo Rol Organizacional</h3>
                    <form method="POST" action="{{ route('saas.roles.store') }}" class="flex gap-2">
                        @csrf
                        <input type="text" name="name" required placeholder="ej: auditor_externo, gerente..." class="flex-1 text-sm rounded-md border-gray-300 shadow-sm focus:border-indigo-500">
                        <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded text-sm font-bold hover:bg-indigo-700">Crear Rol</button>
                    </form>
                    <p class="text-[10px] text-gray-400 mt-2">El rol agrupará múltiples permisos. A los usuarios se les asignan roles, no permisos sueltos.</p>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                <div class="p-4 bg-gray-50 border-b border-gray-200">
                    <h3 class="font-bold text-gray-700 uppercase tracking-wider text-sm">3. Matriz de Vinculación (Role-Permission Sync)</h3>
                </div>
                
                <div class="p-6">
                    @if($permissions->isEmpty())
                        <div class="text-center text-red-500 font-bold py-4">Aún no has creado ningún permiso en el sistema.</div>
                    @else
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                            @foreach($roles as $role)
                                <form method="POST" action="{{ route('saas.roles.permissions.sync', $role->id) }}" class="bg-slate-50 p-4 rounded-lg border border-slate-200 shadow-inner">
                                    @csrf
                                    <div class="flex justify-between items-center mb-4 border-b border-slate-200 pb-2">
                                        <h4 class="font-black text-indigo-900 uppercase text-lg">Rol: {{ str_replace('_', ' ', $role->name) }}</h4>
                                        <button type="submit" class="bg-indigo-100 text-indigo-700 hover:bg-indigo-600 hover:text-white border border-indigo-200 transition-colors font-bold text-[10px] px-3 py-1 rounded-full uppercase tracking-wider">
                                            💾 Guardar Matriz
                                        </button>
                                    </div>
                                    
                                    <div class="grid grid-cols-2 gap-2 max-h-60 overflow-y-auto">
                                        @foreach($permissions as $permission)
                                            <label class="flex items-start text-xs font-medium text-gray-700 cursor-pointer p-1.5 hover:bg-white rounded transition-colors border border-transparent hover:border-gray-200">
                                                <input type="checkbox" name="permissions[]" value="{{ $permission->name }}" 
                                                    {{ $role->hasPermissionTo($permission->name) ? 'checked' : '' }}
                                                    class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500 h-3.5 w-3.5 mr-2 mt-0.5">
                                                <span class="font-mono text-gray-600">{{ $permission->name }}</span>
                                            </label>
                                        @endforeach
                                    </div>
                                </form>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>

        </div>
    </div>
</x-app-layout>