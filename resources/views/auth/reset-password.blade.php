<x-guest-layout>
    <x-slot name="title">Restablecer contraseña</x-slot>
    <x-slot name="heading">Restablece tu contraseña</x-slot>
    <x-slot name="subheading">Elige una nueva contraseña para tu cuenta.</x-slot>

    <form method="POST" action="{{ route('password.store') }}" class="space-y-5">
        @csrf

        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <x-auth-field name="email" label="Correo electrónico" type="email" icon="mail" :value="$request->email" autofocus autocomplete="username" placeholder="tu@empresa.com" />
        <x-auth-field name="password" label="Nueva contraseña" type="password" icon="lock" autocomplete="new-password" placeholder="••••••••" />
        <x-auth-field name="password_confirmation" label="Confirmar contraseña" type="password" icon="lock" autocomplete="new-password" placeholder="••••••••" />

        <x-auth-button>Restablecer contraseña</x-auth-button>
    </form>
</x-guest-layout>
