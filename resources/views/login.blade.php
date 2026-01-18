<!-- Login Modal -->
@extends('layout.user-layout')

@section('title')
    login page
@endsection

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-100 px-4">
    <div class="bg-white rounded-xl border border-gray-200 w-full max-w-md">
        <div class="p-6 border-b border-gray-200 flex justify-between items-center">
            <h2 class="text-2xl font-bold text-gray-800 text-center w-full">Login to GBS </h2>
        </div>

        <form class="p-6">
            <div class="mb-6">
                <label class="block text-gray-700 mb-2">Email or Mobile Number</label>
                <input type="text"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                    placeholder="Enter email or mobile">
            </div>

            <div class="mb-6">
                <label class="block text-gray-700 mb-2">Password</label>
                <input type="password"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                    placeholder="Enter password">
            </div>

            <div class="mb-6">
                <label class="flex items-center">
                    <input type="checkbox" class="mr-2">
                    <span class="text-gray-700">Remember me</span>
                </label>
            </div>

            <button type="submit"
                class="w-full bg-gradient-to-r from-blue-600 to-blue-700 text-white py-3 rounded-lg font-medium hover:from-blue-700 hover:to-blue-800 mb-4">
                Login
            </button>

            <p class="text-center text-gray-600">
                Don't have an account?
                <button type="button" class="text-blue-600 font-medium hover:text-blue-700">
                    Register now
                </button>
            </p>
        </form>
    </div>
</div>
@endsection
