@extends('layout.user-layout')

@section('title', 'Login | GBS')

@section('meta_description')
Login to your GBS account to access your dashboard, resources, and personalized services securely.
@endsection

@section('meta_keywords')
GBS login, user login, account access, secure sign in
@endsection

@section('content')
<div class="flex items-center justify-center px-4 py-8">
    <div class="bg-white rounded-xl border border-gray-200 w-full max-w-md">
        <div class="p-6 border-b border-gray-200">
            <h2 class="text-2xl font-bold text-gray-800 text-center">Login to GBS</h2>
        </div>

        {{-- Display success message from registration --}}
        @if(session('success'))
            <div class="mx-6 mt-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        {{-- Display login errors --}}
        @if($errors->any())
            <div class="mx-6 mt-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg">
                @foreach($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form class="p-6" method="POST" action="{{ route('login.post') }}">
            @csrf
            
            <div class="mb-6">
                <label class="block text-gray-700 mb-2">Email or Mobile Number</label>
                <input type="text" 
                    name="login" 
                    value="{{ old('login') }}"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('login') border-red-500 @enderror"
                    placeholder="Enter email or mobile" 
                    required>
                @error('login')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label class="block text-gray-700 mb-2">Password</label>
                <input type="password" 
                    name="password"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('password') border-red-500 @enderror"
                    placeholder="Enter password" 
                    required>
                @error('password')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6 flex items-center justify-between">
                <label class="flex items-center">
                    <input type="checkbox" name="remember" class="mr-2">
                    <span class="text-gray-700">Remember me</span>
                </label>
                
              
            </div>

            <button type="submit"
                class="w-full bg-gradient-to-r from-blue-600 to-blue-700 text-white py-3 rounded-lg font-medium hover:from-blue-700 hover:to-blue-800 mb-4 transition duration-200">
                Login
            </button>

            <p class="text-center text-gray-600">
                Don't have an account?
                <a href="{{ route('register') }}" class="text-blue-600 font-medium hover:text-blue-700">
                    Register now
                </a>
            </p>
        </form>
    </div>
</div>
@endsection