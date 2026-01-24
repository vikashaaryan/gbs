@extends('layout.admin-layout')

@section('title', 'Admin Dashboard | GBS')

@section('meta_description')
    GBS admin dashboard – manage users, circles, resources, and platform settings efficiently.
@endsection

@section('meta_keywords')
    GBS admin dashboard, admin panel, user management, circle management, resource management, system settings
@endsection

@section('content')
    <!-- Page Header -->
    <div class="mb-6">
        <h1 class="text-2xl md:text-3xl font-bold text-gray-800">Admin Dashboard</h1>
        <p class="text-gray-600 mt-2">Welcome back, Admin! Here's what's happening with your platform today.</p>
        <div class="flex items-center gap-2 mt-2 text-sm text-gray-500">
            <i class="fas fa-calendar-alt"></i>
            <span>Today: {{ date('F j, Y') }}</span>
            <span class="mx-2">•</span>
            <i class="fas fa-clock"></i>
            <span>Last updated: {{ date('g:i A') }}</span>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Total Users Card -->
        <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-teal-500 hover:shadow-xl transition-shadow duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm font-medium mb-1">Total Users</p>
                    <p class="text-3xl font-bold text-gray-800">2,847</p>
                    <div class="flex items-center mt-2">
                        <span class="text-xs text-green-500 bg-green-50 px-2 py-1 rounded-full">
                            <i class="fas fa-arrow-up mr-1"></i> 8.2% this month
                        </span>
                    </div>
                </div>
                <div class="p-3 bg-gradient-to-br from-teal-50 to-teal-100 rounded-xl">
                    <i class="fas fa-users text-2xl text-teal-600"></i>
                </div>
            </div>
            <div class="mt-4 pt-4 border-t border-gray-100">
                <div class="flex justify-between text-xs text-gray-500">
                    <span>Active: 2,341</span>
                    <span>New: 142</span>
                </div>
            </div>
        </div>

        <!-- Revenue Card -->
        <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-blue-500 hover:shadow-xl transition-shadow duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm font-medium mb-1">Total Revenue</p>
                    <p class="text-3xl font-bold text-gray-800">$48,560</p>
                    <div class="flex items-center mt-2">
                        <span class="text-xs text-green-500 bg-green-50 px-2 py-1 rounded-full">
                            <i class="fas fa-arrow-up mr-1"></i> 15.5% growth
                        </span>
                    </div>
                </div>
                <div class="p-3 bg-gradient-to-br from-blue-50 to-blue-100 rounded-xl">
                    <i class="fas fa-dollar-sign text-2xl text-blue-600"></i>
                </div>
            </div>
            <div class="mt-4 pt-4 border-t border-gray-100">
                <div class="flex justify-between text-xs text-gray-500">
                    <span>This month: $8,250</span>
                    <span>Avg/month: $4,047</span>
                </div>
            </div>
        </div>

        <!-- Active Circles -->
        <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-green-500 hover:shadow-xl transition-shadow duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm font-medium mb-1">Active Circles</p>
                    <p class="text-3xl font-bold text-gray-800">156</p>
                    <div class="flex items-center mt-2">
                        <span class="text-xs text-green-500 bg-green-50 px-2 py-1 rounded-full">
                            <i class="fas fa-arrow-up mr-1"></i> 12 new this week
                        </span>
                    </div>
                </div>
                <div class="p-3 bg-gradient-to-br from-green-50 to-green-100 rounded-xl">
                    <i class="fas fa-layer-group text-2xl text-green-600"></i>
                </div>
            </div>
            <div class="mt-4 pt-4 border-t border-gray-100">
                <div class="flex justify-between text-xs text-gray-500">
                    <span>Private: 89</span>
                    <span>Public: 67</span>
                </div>
            </div>
        </div>

        <!-- Platform Performance -->
        <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-purple-500 hover:shadow-xl transition-shadow duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm font-medium mb-1">Platform Performance</p>
                    <p class="text-3xl font-bold text-gray-800">98.7%</p>
                    <div class="flex items-center mt-2">
                        <span class="text-xs text-green-500 bg-green-50 px-2 py-1 rounded-full">
                            <i class="fas fa-check-circle mr-1"></i> Optimal
                        </span>
                    </div>
                </div>
                <div class="p-3 bg-gradient-to-br from-purple-50 to-purple-100 rounded-xl">
                    <i class="fas fa-chart-line text-2xl text-purple-600"></i>
                </div>
            </div>
            <div class="mt-4 pt-4 border-t border-gray-100">
                <div class="flex justify-between text-xs text-gray-500">
                    <span>Uptime: 99.9%</span>
                    <span>Load: 42%</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts & Graphs Row -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
        <!-- User Growth Chart -->
        <div class="lg:col-span-2 bg-white rounded-xl shadow-lg p-6">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-lg font-semibold text-gray-800">User Growth Analytics</h3>
                <div class="flex items-center gap-2">
                    <span class="text-sm text-gray-500">Last 30 days</span>
                    <i class="fas fa-calendar text-gray-400"></i>
                </div>
            </div>
            <div class="h-64 flex items-center justify-center bg-gradient-to-br from-gray-50 to-gray-100 rounded-lg">
                <!-- Chart Placeholder -->
                <div class="text-center">
                    <i class="fas fa-chart-bar text-4xl text-gray-300 mb-3"></i>
                    <p class="text-gray-500">User growth chart visualization</p>
                    <div class="mt-4 flex items-center justify-center space-x-4">
                        <div class="flex items-center">
                            <div class="w-3 h-3 bg-teal-500 rounded-full mr-2"></div>
                            <span class="text-xs text-gray-600">New Users</span>
                        </div>
                        <div class="flex items-center">
                            <div class="w-3 h-3 bg-blue-500 rounded-full mr-2"></div>
                            <span class="text-xs text-gray-600">Active Users</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-4 grid grid-cols-3 gap-4">
                <div class="text-center p-3 bg-gray-50 rounded-lg">
                    <p class="text-sm text-gray-500">Avg. Daily Users</p>
                    <p class="text-lg font-semibold text-gray-800">847</p>
                </div>
                <div class="text-center p-3 bg-gray-50 rounded-lg">
                    <p class="text-sm text-gray-500">Retention Rate</p>
                    <p class="text-lg font-semibold text-gray-800">78%</p>
                </div>
                <div class="text-center p-3 bg-gray-50 rounded-lg">
                    <p class="text-sm text-gray-500">Growth Rate</p>
                    <p class="text-lg font-semibold text-gray-800">12.5%</p>
                </div>
            </div>
        </div>

        <!-- Platform Statistics -->
        <div class="bg-white rounded-xl shadow-lg p-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-6">Platform Statistics</h3>
            
            <!-- Storage Usage -->
            <div class="mb-6">
                <div class="flex justify-between items-center mb-2">
                    <span class="text-sm font-medium text-gray-700">Storage Usage</span>
                    <span class="text-sm font-semibold text-teal-600">65%</span>
                </div>
                <div class="w-full bg-gray-200 rounded-full h-2">
                    <div class="bg-gradient-to-r from-teal-400 to-teal-600 h-2 rounded-full" style="width: 65%"></div>
                </div>
                <div class="flex justify-between text-xs text-gray-500 mt-1">
                    <span>Used: 325 GB</span>
                    <span>Total: 500 GB</span>
                </div>
            </div>

            <!-- Active Sessions -->
            <div class="mb-6">
                <div class="flex justify-between items-center mb-2">
                    <span class="text-sm font-medium text-gray-700">Active Sessions</span>
                    <span class="text-sm font-semibold text-blue-600">234</span>
                </div>
                <div class="w-full bg-gray-200 rounded-full h-2">
                    <div class="bg-gradient-to-r from-blue-400 to-blue-600 h-2 rounded-full" style="width: 78%"></div>
                </div>
                <div class="flex justify-between text-xs text-gray-500 mt-1">
                    <span>Mobile: 156</span>
                    <span>Desktop: 78</span>
                </div>
            </div>

            <!-- API Requests -->
            <div class="mb-6">
                <div class="flex justify-between items-center mb-2">
                    <span class="text-sm font-medium text-gray-700">API Requests (24h)</span>
                    <span class="text-sm font-semibold text-green-600">12.5K</span>
                </div>
                <div class="w-full bg-gray-200 rounded-full h-2">
                    <div class="bg-gradient-to-r from-green-400 to-green-600 h-2 rounded-full" style="width: 85%"></div>
                </div>
                <div class="flex justify-between text-xs text-gray-500 mt-1">
                    <span>Success: 98.2%</span>
                    <span>Avg. Time: 142ms</span>
                </div>
            </div>

            <!-- System Health -->
            <div class="p-4 bg-gradient-to-r from-gray-50 to-gray-100 rounded-lg">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-700">System Health</p>
                        <p class="text-xs text-gray-500">All systems operational</p>
                    </div>
                    <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center">
                        <i class="fas fa-check text-green-600"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

  
@endsection