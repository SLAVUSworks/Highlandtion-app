@extends('back.layouts.app')

@section('title', 'Server Manager')

@section('content')
    <div class="container mx-auto">
    <div class="mb-6 rounded-lg bg-white/60 backdrop-blur px-6 py-4 shadow-sm border border-gray-200">
        <h1 class="flex items-center gap-3 text-3xl font-semibold text-gray-800">
            <span class="h-8 w-1.5 rounded-full bg-teal-500"></span>
            Server Manager
        </h1>
        <p class="mt-1 text-sm text-gray-500">
            Statistik dan status server secara real-time
        </p>
    </div>
    <div class="mt-4 rounded-lg bg-white p-5 shadow-sm border border-gray-100">
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6">
            <!-- CPU Load Card -->
            <div class="relative bg-gradient-to-br from-slate-800 to-slate-900 rounded-lg shadow-2xl border border-slate-700 overflow-hidden group hover:border-blue-500 transition-all duration-300">
                <div class="absolute top-0 right-0 w-32 h-32 bg-blue-500 opacity-10 rounded-full blur-3xl group-hover:opacity-20 transition-opacity"></div>
                <div class="p-6 relative">
                    <div class="flex items-center justify-between mb-4">
                        <h2 class="text-lg font-semibold text-slate-600">CPU Load</h2>
                        <svg class="w-6 h-6 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z"></path>
                        </svg>
                    </div>
                    <p id="cpu" class="text-2xl font-bold text-slate-600">...</p>
                    <p class="text-sm text-slate-400 mt-2">Average load</p>
                </div>
            </div>
            
            <!-- Memory Usage Card -->
            <div class="relative bg-gradient-to-br from-slate-800 to-slate-900 rounded-lg shadow-2xl border border-slate-700 overflow-hidden group hover:border-purple-500 transition-all duration-300">
                <div class="absolute top-0 right-0 w-32 h-32 bg-purple-500 opacity-10 rounded-full blur-3xl group-hover:opacity-20 transition-opacity"></div>
                <div class="p-6 relative">
                    <div class="flex items-center justify-between mb-4">
                        <h2 class="text-lg font-semibold text-slate-600">Memory</h2>
                        <svg class="w-6 h-6 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M5 12a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v4a2 2 0 01-2 2M5 12a2 2 0 00-2 2v4a2 2 0 002 2h14a2 2 0 002-2v-4a2 2 0 00-2-2m-2-4h.01M17 16h.01"></path>
                        </svg>
                    </div>
                    
                    <div class="relative">
                        <div class="w-full bg-slate-700 rounded-full h-3 overflow-hidden">
                            <div id="ram_bar" class="bg-gradient-to-r from-purple-500 to-pink-500 h-3 rounded-full transition-all duration-500 relative" style="width: 0%">
                                <div class="absolute inset-0 bg-white opacity-20 animate-pulse"></div>
                            </div>
                        </div>
                        <p id="ram" class="text-sm text-slate-400 mt-3 font-medium"></p>
                    </div>
                </div>
            </div>
            
            <!-- Disk Usage Card -->
            <div class="relative bg-gradient-to-br from-slate-800 to-slate-900 rounded-lg shadow-2xl border border-slate-700 overflow-hidden group hover:border-emerald-500 transition-all duration-300">
                <div class="absolute top-0 right-0 w-32 h-32 bg-emerald-500 opacity-10 rounded-full blur-3xl group-hover:opacity-20 transition-opacity"></div>
                <div class="p-6 relative">
                    <div class="flex items-center justify-between mb-4">
                        <h2 class="text-lg font-semibold text-slate-600">Disk Space</h2>
                        <svg class="w-6 h-6 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4m0 5c0 2.21-3.582 4-8 4s-8-1.79-8-4"></path>
                        </svg>
                    </div>
                    
                    <div class="relative">
                        <div class="w-full bg-slate-700 rounded-full h-3 overflow-hidden">
                            <div id="disk_bar" class="bg-gradient-to-r from-emerald-500 to-teal-500 h-3 rounded-full transition-all duration-500 relative" style="width: 0%">
                                <div class="absolute inset-0 bg-white opacity-20 animate-pulse"></div>
                            </div>
                        </div>
                        <p id="disk" class="text-sm text-slate-400 mt-3 font-medium"></p>
                    </div>
                </div>
            </div>
            
            <!-- Uptime Card -->
            <div class="relative bg-gradient-to-br from-slate-800 to-slate-900 rounded-lg shadow-2xl border border-slate-700 overflow-hidden group hover:border-amber-500 transition-all duration-300">
                <div class="absolute top-0 right-0 w-32 h-32 bg-amber-500 opacity-10 rounded-full blur-3xl group-hover:opacity-20 transition-opacity"></div>
                <div class="p-6 relative">
                    <div class="flex items-center justify-between mb-4">
                        <h2 class="text-lg font-semibold text-slate-600">Uptime</h2>
                        <svg class="w-6 h-6 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <p id="uptime" class="text-xl font-bold text-slate-600">...</p>
                    <p class="text-sm text-slate-400 mt-2">System running</p>
                </div>
            </div>
            
            <!-- Received Card -->
            <div class="relative bg-gradient-to-br from-slate-800 to-slate-900 rounded-lg shadow-2xl border border-slate-700 overflow-hidden group hover:border-cyan-500 transition-all duration-300">
                <div class="absolute top-0 right-0 w-32 h-32 bg-cyan-500 opacity-10 rounded-full blur-3xl group-hover:opacity-20 transition-opacity"></div>
                <div class="p-6 relative">
                    <div class="flex items-center justify-between mb-4">
                        <h2 class="text-lg font-semibold text-slate-600">Received</h2>
                        <svg class="w-6 h-6 text-cyan-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 13l5 5m0 0l5-5m-5 5V6"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4h18"></path>
                        </svg>
                    </div>
                    <p id="rx" class="text-lg font-bold text-slate-600">...</p>
                    <p class="text-sm text-slate-400 mt-2">Network Traffic</p>
                </div>
            </div>
            
            <!-- Sent Card -->
            <div class="relative bg-gradient-to-br from-slate-800 to-slate-900 rounded-lg shadow-2xl border border-slate-700 overflow-hidden group hover:border-orange-500 transition-all duration-300">
                <div class="absolute top-0 right-0 w-32 h-32 bg-orange-500 opacity-10 rounded-full blur-3xl group-hover:opacity-20 transition-opacity"></div>
                <div class="p-6 relative">
                    <div class="flex items-center justify-between mb-4">
                        <h2 class="text-lg font-semibold text-slate-600">Sent</h2>
                        <svg class="w-6 h-6 text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 11l5-5m0 0l5 5m-5-5v12"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 20h18"></path>
                        </svg>
                    </div>
                    <p id="tx" class="text-lg font-bold text-slate-600">...</p>
                    <p class="text-sm text-slate-400 mt-2">Network Traffic</p>
                </div>
            </div>
            
            <!-- Ping Card -->
            <div class="relative bg-gradient-to-br from-slate-800 to-slate-900 rounded-lg shadow-2xl border border-slate-700 overflow-hidden group hover:border-green-500 transition-all duration-300">
                <div class="absolute top-0 right-0 w-32 h-32 bg-green-500 opacity-10 rounded-full blur-3xl group-hover:opacity-20 transition-opacity"></div>
                <div class="p-6 relative">
                    <div class="flex items-center justify-between mb-4">
                        <h2 class="text-lg font-semibold text-slate-600">Ping</h2>
                        <svg class="w-6 h-6 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.111 16.404a5.5 5.5 0 017.778 0M12 20h.01m-7.08-7.071c3.904-3.905 10.236-3.905 14.141 0M1.394 9.393c5.857-5.857 15.355-5.857 21.213 0"></path>
                        </svg>
                    </div>
                    <p id="ping" class="text-xl font-bold text-slate-600">...</p>
                    <p class="text-sm text-slate-400 mt-2">Network Latency</p>
                </div>
            </div>
            
            <!-- Database Card -->
            <div class="relative bg-gradient-to-br from-slate-800 to-slate-900 rounded-lg shadow-2xl border border-slate-700 overflow-hidden group hover:border-indigo-500 transition-all duration-300">
                <div class="absolute top-0 right-0 w-32 h-32 bg-indigo-500 opacity-10 rounded-full blur-3xl group-hover:opacity-20 transition-opacity"></div>
                <div class="p-6 relative">
                    <div class="flex items-center justify-between mb-4">
                        <h2 class="text-lg font-semibold text-slate-600">Database</h2>
                        <svg class="w-6 h-6 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4m0 5c0 2.21-3.582 4-8 4s-8-1.79-8-4"></path>
                        </svg>
                    </div>
                    <p id="db_ping" class="text-xl font-bold text-slate-600">...</p>
                    <p class="text-sm text-slate-400 mt-2">Database Latency</p>
                </div>
            </div>
        </div>
    </div>
<script>
    function updateStats() {
        $.get('{{ route("back.server.stats.data") }}', function(data) {

            // CPU
            $("#cpu").text(data.cpu_percent + "%");

            // RAM
            $("#ram").text(
                `${data.memory.used} MB / ${data.memory.total} MB (${data.memory.percentage}%)`
            );
            $("#ram_bar").css('width', data.memory.percentage + "%");

            // Disk
            $("#disk").text(`${data.disk.used_percentage}% used (${data.disk.used_gb} GB / ${data.disk.total_gb} GB)`);
            $("#disk_bar").css('width', data.disk.used_percentage + "%");

            // Uptime
            $("#uptime").text(data.uptime);

            // Ping
            $("#ping").text(data.ping ? data.ping + " ms" : "timeout");

            // Database
            $("#db_ping").text(data.database.ping !== null ? data.database.ping + " ms" : "Offline");

            // Network
            const rxMB = (data.network.rx / 1024 / 1024).toFixed(2);
            const txMB = (data.network.tx / 1024 / 1024).toFixed(2);

            $("#rx").text(`${rxMB} MB`);
            $("#tx").text(`${txMB} MB`);
        });
    }

    updateStats();
    setInterval(updateStats, 3000);
</script>
@endsection