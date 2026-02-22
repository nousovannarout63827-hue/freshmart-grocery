<div class="p-6 bg-gray-50 min-h-screen">
    <div class="max-w-4xl mx-auto">
        <h1 class="text-3xl font-extrabold text-gray-900 mb-6">Driver Performance Leaderboard</h1>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-8">
            <div class="bg-indigo-600 p-6 rounded-xl shadow-lg text-white">
                <p class="text-indigo-100 text-sm font-semibold uppercase tracking-wider">Total Deliveries</p>
                <h2 class="text-4xl font-bold">{{ $drivers->sum('deliveries_count') }}</h2>
            </div>
            <div class="bg-emerald-600 p-6 rounded-xl shadow-lg text-white">
                <p class="text-emerald-100 text-sm font-semibold uppercase tracking-wider">Total Revenue Generated</p>
                <h2 class="text-4xl font-bold">${{ number_format($drivers->sum('total_earned'), 2) }}</h2>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            <table class="w-full text-left">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase">Driver</th>
                        <th class="px-6 py-4 text-center text-xs font-bold text-gray-500 uppercase">Jobs</th>
                        <th class="px-6 py-4 text-right text-xs font-bold text-gray-500 uppercase">Earnings</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach($drivers as $driver)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 flex items-center gap-3">
                            <div class="w-10 h-10 rounded-full bg-gray-200 flex items-center justify-center font-bold text-gray-600">
                                {{ substr($driver->name, 0, 1) }}
                            </div>
                            <span class="font-semibold text-gray-800">{{ $driver->name }}</span>
                        </td>
                        <td class="px-6 py-4 text-center text-gray-600 font-medium">{{ $driver->deliveries_count }}</td>
                        <td class="px-6 py-4 text-right font-mono font-bold text-emerald-600">
                            ${{ number_format($driver->total_earned ?? 0, 2) }}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
