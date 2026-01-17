@extends('layout.user-layout')

@section('title')
reigster page
@endsection

@section('content')
<div class=" flex items-center mt-[7%] mb-[5%] justify-center  px-4">
    <div class="bg-white rounded-md border border-gray-200 w-full max-w-2xl mx-4 ">
        <div class="p-6 border-b border-gray-200 flex justify-between items-center">
            <h2 class="text-2xl font-bold text-gray-800">Create Your Account</h2>
        </div>
        
        <form id="registrationForm" class="p-6">
            <div class="grid md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-gray-700 mb-2">Full Name *</label>
                    <input type="text" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="Enter your full name">
                </div>
                
                <div>
                    <label class="block text-gray-700 mb-2">Mobile Number *</label>
                    <input type="tel" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="10-digit mobile number">
                </div>
                
                <div>
                    <label class="block text-gray-700 mb-2">Email ID *</label>
                    <input type="email" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="example@email.com">
                </div>
                
                <div>
                    <label class="block text-gray-700 mb-2">State *</label>
                    <select required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option value="">Select State</option>
                        <option>California</option>
                        <option>New York</option>
                        <option>Texas</option>
                        <option>Florida</option>
                        <option>Illinois</option>
                    </select>
                </div>
                
                <div>
                    <label class="block text-gray-700 mb-2">District *</label>
                    <input type="text" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="Enter district">
                </div>
                
                <div>
                    <label class="block text-gray-700 mb-2">PIN Code *</label>
                    <input type="text" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="6-digit PIN code">
                </div>
            </div>
            
            <div class="mt-6">
                <label class="block text-gray-700 mb-2">Select Category *</label>
                <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
                    <label class="flex items-center p-3 border border-gray-300 rounded-lg cursor-pointer hover:bg-blue-50">
                        <input type="radio" name="category_id" value="doctors" class="mr-3">
                        <span>Doctors</span>
                    </label>
                    <label class="flex items-center p-3 border border-gray-300 rounded-lg cursor-pointer hover:bg-blue-50">
                        <input type="radio" name="category" value="it" class="mr-3">
                        <span>IT Professionals</span>
                    </label>
                    <label class="flex items-center p-3 border border-gray-300 rounded-lg cursor-pointer hover:bg-blue-50">
                        <input type="radio" name="category" value="lawyers" class="mr-3">
                        <span>Lawyers</span>
                    </label>
                    <label class="flex items-center p-3 border border-gray-300 rounded-lg cursor-pointer hover:bg-blue-50">
                        <input type="radio" name="category" value="real-estate" class="mr-3">
                        <span>Real Estate</span>
                    </label>
                    <label class="flex items-center p-3 border border-gray-300 rounded-lg cursor-pointer hover:bg-blue-50">
                        <input type="radio" name="category" value="accountants" class="mr-3">
                        <span>Accountants</span>
                    </label>
                    <label class="flex items-center p-3 border border-gray-300 rounded-lg cursor-pointer hover:bg-blue-50">
                        <input type="radio" name="category" value="other" class="mr-3">
                        <span>Other</span>
                    </label>
                </div>
            </div>
            
            <div class="mt-8 flex gap-4">
                <button type="submit" class="flex-1 bg-gradient-to-r from-blue-600 to-blue-700 text-white px-6 py-3 rounded-lg font-medium hover:from-blue-700 hover:to-blue-800">
                    Create Account
                </button>
            </div>
            
            <p class="text-center text-gray-600 mt-6">
                Already have an account? 
                <button type="button" class="text-blue-600 font-medium hover:text-blue-700">
                    Login here
                </button>
            </p>
        </form>
    </div>
</div>
@endsection
