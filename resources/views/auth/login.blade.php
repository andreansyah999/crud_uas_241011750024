@extends('layouts.public')

@section('title', 'Login Admin')

@section('content')
<div class="min-h-[80vh] flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8 relative overflow-hidden bg-slate-900">
    <!-- Decorative Ambient Glows -->
    <div class="absolute top-1/4 left-1/4 w-72 h-72 bg-indigo-500/20 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute bottom-1/4 right-1/4 w-72 h-72 bg-teal-500/10 rounded-full blur-3xl pointer-events-none"></div>

    <div class="max-w-md w-full space-y-8 relative z-10">
        <!-- Logo and Heading -->
        <div class="text-center">
            <div class="inline-flex w-16 h-16 rounded-2xl btn-gradient items-center justify-center text-white shadow-xl shadow-indigo-500/30 mb-4 animate-bounce">
                <i class="fa-solid fa-lock text-2xl"></i>
            </div>
            <h2 class="text-3xl font-extrabold text-white tracking-tight">
                Dashboard Login
            </h2>
            <p class="mt-2 text-sm text-slate-400">
                Silakan masuk dengan akun administrator Anda.
            </p>
        </div>

        <!-- Login Card -->
        <div class="bg-white/10 backdrop-blur-md border border-white/10 rounded-3xl p-8 shadow-2xl shadow-slate-950/50">
            <form class="space-y-6" action="{{ route('login.post') }}" method="POST">
                @csrf
                
                <!-- Username Field -->
                <div>
                    <label for="username" class="block text-sm font-semibold text-slate-200 mb-2">Username</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center text-slate-400">
                            <i class="fa-solid fa-user text-sm"></i>
                        </span>
                        <input id="username" name="username" type="text" value="{{ old('username') }}" required 
                            class="block w-full pl-10 pr-3 py-3 border border-white/10 rounded-2xl bg-white/5 text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 focus:bg-white/10 transition-all duration-200 text-sm" 
                            placeholder="Masukkan username">
                    </div>
                    @error('username')
                        <p class="mt-2 text-xs text-rose-400 flex items-center gap-1.5 font-medium animate-pulse">
                            <i class="fa-solid fa-circle-exclamation"></i>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Password Field -->
                <div>
                    <label for="password" class="block text-sm font-semibold text-slate-200 mb-2">Password</label>
                    <div class="relative" x-data="{ show: false }">
                        <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center text-slate-400">
                            <i class="fa-solid fa-key text-sm"></i>
                        </span>
                        <input :type="show ? 'text' : 'password'" id="password" name="password" required 
                            class="block w-full pl-10 pr-10 py-3 border border-white/10 rounded-2xl bg-white/5 text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 focus:bg-white/10 transition-all duration-200 text-sm" 
                            placeholder="••••••••">
                        <button type="button" @click="show = !show" class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-slate-400 hover:text-white transition-colors duration-150">
                            <i class="fa-solid" :class="show ? 'fa-eye-slash' : 'fa-eye'"></i>
                        </button>
                    </div>
                    @error('password')
                        <p class="mt-2 text-xs text-rose-400 flex items-center gap-1.5 font-medium animate-pulse">
                            <i class="fa-solid fa-circle-exclamation"></i>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Remember Me and Additional Options -->
                <div class="flex items-center justify-between">
                    <label class="flex items-center gap-2 cursor-pointer group">
                        <input type="checkbox" name="remember" value="1" {{ old('remember') ? 'checked' : '' }}
                            class="rounded border-white/10 bg-white/5 text-indigo-600 focus:ring-indigo-500 focus:ring-offset-slate-900 focus:ring-offset-2">
                        <span class="text-xs text-slate-300 group-hover:text-white transition-colors duration-150 font-medium">Ingat Saya</span>
                    </label>
                </div>

                <!-- Submit Button -->
                <div>
                    <button type="submit" 
                        class="w-full flex justify-center items-center gap-2 py-3 px-4 border border-transparent rounded-2xl text-sm font-bold text-white btn-gradient shadow-lg shadow-indigo-500/20 hover:shadow-indigo-500/40 hover:-translate-y-0.5 active:translate-y-0 transition-all duration-200 cursor-pointer">
                        Masuk Ke Dashboard <i class="fa-solid fa-circle-arrow-right"></i>
                    </button>
                </div>
            </form>
        </div>

        <!-- Back to Home -->
        <div class="text-center">
            <a href="{{ route('home') }}" class="inline-flex items-center gap-1.5 text-xs text-slate-400 hover:text-white transition-colors duration-150 font-semibold">
                <i class="fa-solid fa-arrow-left"></i> Kembali ke Beranda
            </a>
        </div>
    </div>
</div>
@endsection
