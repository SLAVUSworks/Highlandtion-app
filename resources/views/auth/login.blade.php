@extends('layouts.app')

@section('content')

<div class="min-h-screen flex items-center justify-center px-4 py-12 bg-background-dark">
    <div class="w-full max-w-sm space-y-6">

        {{-- Logo --}}
        <div class="text-center space-y-2">
            <h1 class="text-2xl font-black text-white">{{ $config['app_name'] ?? config('app.name') }}</h1>
            <p class="text-sm text-slate-400">Web Control Panel Login</p>
        </div>

        {{-- Error --}}
        @if($errors->any())
            <div class="flex items-center gap-3 rounded-2xl border border-red-500/20 bg-red-500/10 px-4 py-3">
                <span class="material-symbols-outlined text-red-500 shrink-0">error</span>
                <p class="text-sm font-semibold text-red-500">
                    {{ $errors->first() }}
                </p>
            </div>
        @endif

        {{-- Form Card --}}
        <div class="rounded-3xl border border-primary/10 bg-slate-900 shadow-xl overflow-hidden divide-y divide-slate-800">

            <div class="px-6 py-5 space-y-1">
                <label for="email" class="text-xs font-bold text-slate-400 uppercase tracking-widest">
                    Email Address
                </label>
                <form id="login-form" method="POST" action="{{ route('login') }}">
                @csrf
                <input id="email" type="email" name="email"
                       value="{{ old('email') }}"
                       required autocomplete="email" autofocus
                       class="block w-full rounded-xl border bg-slate-800 px-4 py-3 text-sm font-semibold text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary transition mt-1
                              @error('email') border-red-500/50 @else border-primary/20 @enderror"
                       placeholder="admin@example.com">
            </div>

            <div class="px-6 py-5 space-y-1">
                <label for="password" class="text-xs font-bold text-slate-400 uppercase tracking-widest">
                    Password
                </label>
                <input id="password" type="password" name="password"
                       required autocomplete="current-password"
                       class="block w-full rounded-xl border bg-slate-800 px-4 py-3 text-sm font-semibold text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary transition mt-1
                              @error('password') border-red-500/50 @else border-primary/20 @enderror"
                       placeholder="••••••••">
            </div>

            <div class="px-6 py-4 flex items-center justify-between">
                <label class="flex items-center gap-2.5 cursor-pointer select-none">
                    <input type="checkbox" name="remember" id="remember"
                           {{ old('remember') ? 'checked' : '' }}
                           class="w-4 h-4 rounded border-primary/20 bg-slate-800 text-primary focus:ring-primary/30 cursor-pointer">
                    <span class="text-sm font-semibold text-slate-400">Remember Me</span>
                </label>
            </div>

            <div class="px-6 py-5">
                <button type="submit" form="login-form"
                        class="w-full flex items-center justify-center gap-3 rounded-2xl bg-primary py-4 font-bold text-white hover:bg-primary-dark active:scale-[0.98] transition-all shadow-lg shadow-primary/20">
                    Login
                    <span class="w-8 h-8 bg-white text-primary flex items-center justify-center rounded-full">
                        <span class="material-symbols-outlined text-base">login</span>
                    </span>
                </button>
            </div>

            </form>
        </div>

    </div>
</div>

@endsection