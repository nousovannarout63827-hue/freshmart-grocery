<!-- Order Timeline -->
<div class="bg-white rounded-2xl border border-gray-100 p-6">
    @php
        // Define the exact order of statuses
        $statuses = ['pending', 'preparing', 'ready_for_pickup', 'picked_up', 'out_for_delivery', 'arrived', 'delivered'];

        // Map order status to timeline index
        $statusMap = [
            'pending' => 0,
            'preparing' => 1,
            'ready_for_pickup' => 2,
            'picked_up' => 3,
            'out_for_delivery' => 3,
            'arrived' => 4,
            'delivered' => 5,
        ];
        
        // Find out which step we are currently on
        $currentIndex = $statusMap[$order->status] ?? 0;
    @endphp

    <h3 class="text-xl font-bold text-gray-900 mb-6 flex items-center gap-2">
        <svg class="w-6 h-6 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"></path>
        </svg>
        Order Timeline
    </h3>

    <div class="relative pl-4">
        <!-- Vertical Line -->
        <div class="absolute left-[2.25rem] top-2 bottom-2 w-0.5 bg-gray-200"></div>

        <!-- Step 1: Order Placed -->
        <div class="relative flex items-start gap-4 mb-8">
            <div class="z-10 flex items-center justify-center w-10 h-10 rounded-full shrink-0 {{ $currentIndex >= 0 ? 'bg-green-500' : 'bg-gray-100' }}">
                @if($currentIndex >= 0)
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                @else
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                @endif
            </div>
            <div class="pt-1">
                <h4 class="font-bold {{ $currentIndex >= 0 ? 'text-gray-900' : 'text-gray-400' }}">Order Placed</h4>
                <p class="text-sm {{ $currentIndex >= 0 ? 'text-gray-500' : 'text-gray-400' }}">We have received your order.</p>
            </div>
        </div>

        <!-- Step 2: Preparing -->
        <div class="relative flex items-start gap-4 mb-8">
            <div class="z-10 flex items-center justify-center w-10 h-10 rounded-full shrink-0 {{ $currentIndex >= 1 ? 'bg-green-500' : 'bg-gray-100' }}">
                @if($currentIndex >= 1)
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 18.657A8 8 0 016.343 7.343S7 9 9 10c0-2 .5-5 2.986-7C14 5 16.09 5.777 17.656 7.343A7.98 7.98 0 0117.657 18.657z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14a2 2 0 100-4 2 2 0 000 4z"/>
                    </svg>
                @else
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 18.657A8 8 0 016.343 7.343S7 9 9 10c0-2 .5-5 2.986-7C14 5 16.09 5.777 17.656 7.343A7.98 7.98 0 0117.657 18.657z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14a2 2 0 100-4 2 2 0 000 4z"/>
                    </svg>
                @endif
            </div>
            <div class="pt-1">
                <h4 class="font-bold {{ $currentIndex >= 1 ? 'text-gray-900' : 'text-gray-400' }}">Preparing</h4>
                <p class="text-sm {{ $currentIndex >= 1 ? 'text-gray-500' : 'text-gray-400' }}">Your items are being packed/prepared.</p>
            </div>
        </div>

        <!-- Step 3: Driver Picked Up -->
        <div class="relative flex items-start gap-4 mb-8">
            <div class="z-10 flex items-center justify-center w-10 h-10 rounded-full shrink-0 {{ $currentIndex >= 2 ? 'bg-green-500' : 'bg-gray-100' }}">
                @if($currentIndex >= 2)
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                    </svg>
                @else
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                    </svg>
                @endif
            </div>
            <div class="pt-1">
                <h4 class="font-bold {{ $currentIndex >= 2 ? 'text-gray-900' : 'text-gray-400' }}">Driver Picked Up</h4>
                <p class="text-sm {{ $currentIndex >= 2 ? 'text-gray-500' : 'text-gray-400' }}">A driver has collected your order.</p>
            </div>
        </div>

        <!-- Step 4: Out for Delivery -->
        <div class="relative flex items-start gap-4 mb-8">
            <div class="z-10 flex items-center justify-center w-10 h-10 rounded-full shrink-0 {{ $currentIndex >= 3 ? 'bg-green-500' : 'bg-gray-100' }}">
                @if($currentIndex >= 3)
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                    </svg>
                @else
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                    </svg>
                @endif
            </div>
            <div class="pt-1">
                <h4 class="font-bold {{ $currentIndex >= 3 ? 'text-gray-900' : 'text-gray-400' }}">Out for Delivery</h4>
                <p class="text-sm {{ $currentIndex >= 3 ? 'text-gray-500' : 'text-gray-400' }}">Your order is on the way to you!</p>
                
                @if($currentIndex == 3)
                    <a href="#delivery-map" class="inline-flex items-center gap-2 mt-2 px-3 py-1 rounded-full bg-green-50 border border-green-100 hover:bg-green-100 transition-colors cursor-pointer shadow-sm">
                        <span class="relative flex h-2.5 w-2.5">
                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-red-500"></span>
                        </span>
                        <span class="text-xs font-bold text-green-700">View on Map</span>
                    </a>
                @endif
            </div>
        </div>

        <!-- Step 5: Arrived -->
        <div class="relative flex items-start gap-4 mb-8">
            <div class="z-10 flex items-center justify-center w-10 h-10 rounded-full shrink-0 {{ $currentIndex >= 4 ? 'bg-green-500' : 'bg-gray-100' }}">
                @if($currentIndex >= 4)
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                @else
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                @endif
            </div>
            <div class="pt-1">
                <h4 class="font-bold {{ $currentIndex >= 4 ? 'text-gray-900' : 'text-gray-400' }}">Arrived</h4>
                <p class="text-sm {{ $currentIndex >= 4 ? 'text-gray-500' : 'text-gray-400' }}">Driver has arrived at your location.</p>
            </div>
        </div>

        <!-- Step 6: Delivered -->
        <div class="relative flex items-start gap-4">
            <div class="z-10 flex items-center justify-center w-10 h-10 rounded-full shrink-0 {{ $currentIndex >= 5 ? 'bg-green-500' : 'bg-gray-100' }}">
                @if($currentIndex >= 5)
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                @else
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                @endif
            </div>
            <div class="pt-1">
                <h4 class="font-bold {{ $currentIndex >= 5 ? 'text-gray-900' : 'text-gray-400' }}">Delivered</h4>
                <p class="text-sm {{ $currentIndex >= 5 ? 'text-gray-500' : 'text-gray-400' }}">Enjoy your order!</p>
            </div>
        </div>
    </div>

    @if($order->status == 'delivered')
        <div class="mt-6 p-4 bg-green-50 border border-green-200 rounded-xl">
            <div class="flex items-center gap-3 text-green-700">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <div>
                    <p class="font-bold">Order Delivered Successfully!</p>
                    <p class="text-sm">Thank you for ordering with FreshMart. We hope you enjoyed your order!</p>
                </div>
            </div>
        </div>
    @endif
</div>
