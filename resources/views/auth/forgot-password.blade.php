<x-guest-layout>
    <x-slot name="title">Recuperar contraseña</x-slot>
    <x-slot name="heading">¿Olvidaste tu contraseña?</x-slot>
    <x-slot name="subheading">Indícanos tu correo y te enviaremos un enlace para restablecerla.</x-slot>

    @if (session('status'))
        <div class="mb-5 rounded-lg border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-medium text-emerald-700">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}" class="space-y-5">
        @csrf

        <x-auth-field name="email" label="Correo electrónico" type="email" icon="mail" autofocus autocomplete="username" placeholder="tu@empresa.com" />

        <x-auth-button>Enviar enlace de recuperación</x-auth-button>

        <p class="text-center text-sm text-slate-500">
            <a href="{{ route('login') }}" class="font-medium text-slate-900 transition hover:underline">Volver al inicio de sesión</a>
        </p>
    </form>
</x-guest-layout>
