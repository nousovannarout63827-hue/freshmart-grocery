@extends('customer.profile.layout')

@section('title', 'Track Order #' . str_pad($order->id, 8, '0', STR_PAD_LEFT))

@section('profile-content')
@push('styles')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
<link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine@3.2.12/dist/leaflet-routing-machine.css" />
<style>
    .tracking-page { padding: 20px; max-width: 1200px; margin: 0 auto; }
    .tracking-header { text-align: center; margin-bottom: 24px; }
    .tracking-title { font-size: 28px; font-weight: 800; color: #1e293b; margin: 0 0 8px 0; }
    .tracking-subtitle { font-size: 14px; color: #64748b; margin: 0; }
    .status-badge { display: inline-block; padding: 8px 20px; border-radius: 20px; font-weight: 700; font-size: 13px; text-transform: uppercase; margin-top: 12px; }
    .status-pending { background: #fef3c7; color: #b45309; }
    .status-preparing { background: #dbeafe; color: #1e40af; }
    .status-ready_for_pickup { background: #e0e7ff; color: #3730a3; }
    .status-out_for_delivery { background: #fed7aa; color: #c2410c; }
    .status-arrived { background: #fef3c7; color: #b45309; }
    .status-delivered { background: #dcfce7; color: #166534; }
    .status-cancelled { background: #fee2e2; color: #b91c1c; }
    .tracking-grid { display: grid; grid-template-columns: 1fr 380px; gap: 20px; margin-bottom: 24px; }
    @media (max-width: 1024px) { .tracking-grid { grid-template-columns: 1fr; } }
    .map-card { background: white; border-radius: 16px; overflow: hidden; border: 1px solid #e2e8f0; box-shadow: 0 4px 6px rgba(0,0,0,0.05); }
    #tracking-map { width: 100%; height: 450px; }
    .info-panel { background: white; border-radius: 16px; padding: 20px; border: 1px solid #e2e8f0; box-shadow: 0 4px 6px rgba(0,0,0,0.05); }
    .info-section { margin-bottom: 24px; }
    .info-title { font-size: 16px; font-weight: 800; color: #1e293b; margin: 0 0 12px 0; display: flex; align-items: center; gap: 8px; }
    .driver-card { background: linear-gradient(135deg, #f0f9ff, #e0f2fe); border-radius: 12px; padding: 16px; border: 2px solid #bae6fd; margin-bottom: 16px; }
    .driver-info { display: flex; align-items: center; gap: 12px; margin-bottom: 12px; }
    .driver-avatar { width: 50px; height: 50px; border-radius: 50%; background: linear-gradient(135deg, #3b82f6, #2563eb); display: flex; align-items: center; justify-content: center; color: white; font-weight: 800; font-size: 20px; flex-shrink: 0; }
    .driver-details { flex: 1; }
    .driver-name { font-size: 15px; font-weight: 700; color: #1e293b; margin: 0; }
    .driver-phone { font-size: 13px; color: #64748b; margin: 2px 0 0 0; }
    .driver-actions { display: flex; gap: 8px; }
    .driver-btn { flex: 1; padding: 10px; border-radius: 8px; border: none; font-weight: 700; font-size: 12px; cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 6px; transition: all 0.2s; }
    .driver-btn-call { background: #10b981; color: white; }
    .driver-btn-call:hover { background: #059669; }
    .driver-btn-message { background: white; color: #3b82f6; border: 2px solid #3b82f6; }
    .driver-btn-message:hover { background: #eff6ff; }
    .order-progress { background: white; border-radius: 12px; padding: 16px; border: 1px solid #e2e8f0; margin-bottom: 16px; }
    .progress-bar { height: 8px; background: #e2e8f0; border-radius: 10px; overflow: hidden; margin: 12px 0; }
    .progress-fill { height: 100%; background: linear-gradient(90deg, #10b981, #059669); border-radius: 10px; transition: width 0.5s ease; }
    .progress-steps { display: flex; justify-content: space-between; margin-top: 12px; }
    .progress-step { text-align: center; flex: 1; }
    .step-dot { width: 12px; height: 12px; border-radius: 50%; background: #e2e8f0; margin: 0 auto 6px; transition: all 0.3s; }
    .step-dot.active { background: #10b981; box-shadow: 0 0 0 3px #dcfce7; }
    .step-label { font-size: 10px; color: #94a3b8; font-weight: 600; }
    .step-label.active { color: #10b981; font-weight: 700; }
    .live-indicator { display: inline-flex; align-items: center; gap: 6px; padding: 6px 12px; background: #f0fdf4; border: 2px solid #10b981; border-radius: 20px; font-size: 11px; font-weight: 700; color: #166534; margin-bottom: 12px; }
    .pulse-dot { width: 6px; height: 6px; background: #10b981; border-radius: 50%; animation: pulse 1.5s infinite; }
    @keyframes pulse { 0%, 100% { opacity: 1; transform: scale(1); } 50% { opacity: 0.5; transform: scale(1.3); } }
    .leaflet-routing-container { display: none !important; }
    .map-legend { position: absolute; bottom: 20px; left: 20px; z-index: 1000; background: white; padding: 10px 14px; border-radius: 10px; box-shadow: 0 2px 8px rgba(0,0,0,0.15); border: 1px solid #e2e8f0; }
    .legend-item { display: flex; align-items: center; gap: 6px; font-size: 10px; font-weight: 600; color: #475569; margin-bottom: 4px; }
    .legend-item:last-child { margin-bottom: 0; }
    .legend-icon { width: 20px; height: 20px; display: flex; align-items: center; justify-content: center; font-size: 12px; }
    .no-driver { text-align: center; padding: 30px 20px; background: #f8fafc; border-radius: 12px; border: 2px dashed #cbd5e1; }
    .no-driver-icon { font-size: 48px; margin-bottom: 12px; }
    .no-driver-text { font-size: 14px; color: #64748b; font-weight: 600; }
    .delivered-banner { background: linear-gradient(135deg, #dcfce7, #bbf7d0); border: 2px solid #16a34a; border-radius: 12px; padding: 20px; text-align: center; margin-bottom: 20px; }
    .delivered-banner h3 { color: #166534; font-size: 20px; font-weight: 800; margin: 0 0 8px 0; }
    .delivered-banner p { color: #15803d; font-size: 14px; margin: 0; }
</style>
@endpush

@if($order->status === 'delivered')
    <!-- Order Already Delivered - Show Success Banner -->
    <div class="delivered-banner">
        <h3>✅ Order Delivered Successfully!</h3>
        <p>Your order has been delivered. Thank you for your purchase!</p>
        <div style="margin-top: 16px;">
            <a href="{{ route('customer.order.details', $order->id) }}" style="display: inline-block; background: #16a34a; color: white; padding: 12px 24px; border-radius: 10px; text-decoration: none; font-weight: 700; font-size: 14px;">
                ← Back to Order Details
            </a>
        </div>
    </div>
    
    <!-- Show static map with delivery location only -->
    <div class="map-card" style="margin-bottom: 20px;">
        <div id="tracking-map"></div>
        <div class="map-legend">
            <div class="legend-item">
                <div class="legend-icon">🏠</div>
                <span>Delivery Location</span>
            </div>
        </div>
    </div>
    
    <div class="info-panel">
        <h3 class="info-title"><span>📦</span> Order Summary</h3>
        <p style="font-size: 14px; color: #64748b; margin-bottom: 12px;">Order #{{ str_pad($order->id, 8, '0', STR_PAD_LEFT) }}</p>
        <p style="font-size: 14px; color: #166534; font-weight: 700;">Status: Delivered ✅</p>
        <p style="font-size: 13px; color: #94a3b8; margin-top: 8px;">Delivered on: {{ $order->updated_at->format('M d, Y h:i A') }}</p>
        
        <div style="margin-top: 20px; padding-top: 16px; border-top: 1px solid #e2e8f0; text-align: center;">
            <a href="{{ route('customer.orders') }}" style="font-size: 13px; color: #3b82f6; text-decoration: none; font-weight: 700;">View All My Orders →</a>
        </div>
    </div>
@else
    <!-- Active Order Tracking -->
    <div class="tracking-page">
    <div class="tracking-header">
        <h1 class="tracking-title">Track Your Order</h1>
        <p class="tracking-subtitle">Order #{{ str_pad($order->id, 8, '0', STR_PAD_LEFT) }}</p>
        <span class="status-badge status-{{ str_replace('_', '-', $order->status) }}">
            {{ str_replace('_', ' ', $order->status) }}
        </span>
    </div>

    <div class="tracking-grid">
        <!-- Map -->
        <div class="map-card">
            <div id="tracking-map"></div>
            
            <!-- Map Legend -->
            <div class="map-legend">
                <div class="legend-item">
                    <div class="legend-icon">🚚</div>
                    <span>Driver</span>
                </div>
                <div class="legend-item">
                    <div class="legend-icon">🏠</div>
                    <span>Your Location</span>
                </div>
                <div class="legend-item">
                    <div class="legend-icon" style="width: 30px; height: 2px; background: #3b82f6;"></div>
                    <span>Route</span>
                </div>
            </div>
        </div>

        <!-- Info Panel -->
        <div class="info-panel">
            <!-- Live Tracking Indicator -->
            <div class="live-indicator">
                <span class="pulse-dot"></span>
                Live Tracking
            </div>

            <!-- Order Progress -->
            <div class="order-progress">
                <h3 class="info-title"><span>📊</span> Delivery Progress</h3>
                <div class="progress-bar"><div class="progress-fill" id="progress-fill" style="width: 0%"></div></div>
                <div class="progress-steps">
                    <div class="progress-step"><div class="step-dot" id="step-1"></div><div class="step-label">Order</div></div>
                    <div class="progress-step"><div class="step-dot" id="step-2"></div><div class="step-label">Preparing</div></div>
                    <div class="progress-step"><div class="step-dot" id="step-3"></div><div class="step-label">On Way</div></div>
                    <div class="progress-step"><div class="step-dot" id="step-4"></div><div class="step-label">Delivered</div></div>
                </div>
            </div>

            <!-- Driver Info -->
            @if($order->driver && $order->driver->latitude && $order->driver->longitude)
                <div class="driver-card">
                    <h3 class="info-title"><span>🚚</span> Your Driver</h3>
                    <div class="driver-info">
                        <div class="driver-avatar">
                            @php
                                $driverPhoto = $order->driver->avatar ?? $order->driver->profile_photo_path;
                                $driverPhotoUrl = $driverPhoto ? asset('storage/' . $driverPhoto) : null;
                            @endphp
                            @if($driverPhotoUrl)
                                <img src="{{ $driverPhotoUrl }}" alt="{{ $order->driver->name }}" style="width: 100%; height: 100%; object-fit: cover; border-radius: 50%;" onerror="this.style.display='none'; this.parentElement.innerHTML='{{ strtoupper(substr($order->driver->name, 0, 1)) }}';">
                            @else
                                {{ strtoupper(substr($order->driver->name, 0, 1)) }}
                            @endif
                        </div>
                        <div class="driver-details">
                            <p class="driver-name">{{ $order->driver->name }}</p>
                            <p class="driver-phone">📞 {{ $order->driver->phone_number ?? 'N/A' }}</p>
                        </div>
                    </div>
                    <div class="driver-actions">
                        @if($order->driver->phone_number)
                        <a href="tel:{{ $order->driver->phone_number }}" class="driver-btn driver-btn-call"><span>📞</span> Call</a>
                        @endif
                        <button class="driver-btn driver-btn-message" onclick="showDriverOnMap()"><span>🗺️</span> View on Map</button>
                    </div>
                </div>
            @else
                <div class="no-driver">
                    <div class="no-driver-icon">📦</div>
                    <p class="no-driver-text">
                        @if(in_array($order->status, ['pending', 'preparing']))
                            Your order is being prepared
                        @elseif(in_array($order->status, ['ready_for_pickup']))
                            Waiting for driver assignment
                        @else
                            Driver information will appear soon
                        @endif
                    </p>
                </div>
            @endif

            <!-- Delivery Address -->
            <div class="info-section">
                <h3 class="info-title"><span>📍</span> Delivery Address</h3>
                <p style="margin: 0; font-size: 14px; color: #64748b; line-height: 1.6;">{{ $order->delivery_address }}</p>
            </div>

            <!-- Estimated Time -->
            <div class="info-section">
                <h3 class="info-title"><span>⏱️</span> Estimated Delivery</h3>
                <p style="margin: 0; font-size: 14px; color: #1e293b; font-weight: 700;">{{ $order->created_at->addMinutes(30)->format('h:i A') }}</p>
                <p style="margin: 4px 0 0 0; font-size: 12px; color: #94a3b8;">Approximately 30 minutes from order</p>
            </div>

            <!-- Contact Support -->
            <div style="text-align: center; padding-top: 16px; border-top: 1px solid #e2e8f0;">
                <a href="{{ route('customer.order.details', $order->id) }}" style="font-size: 13px; color: #3b82f6; text-decoration: none; font-weight: 700;">← Back to Order Details</a>
            </div>
        </div>
    </div>
</div>
@endif

@push('scripts')
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
<script src="https://unpkg.com/leaflet-routing-machine@3.2.12/dist/leaflet-routing-machine.js"></script>
<script>
    let map, driverMarker, customerMarker, routeControl, liveTrackingInterval;
    const customerLat = {{ $order->latitude ?? 'null' }};
    const customerLng = {{ $order->longitude ?? 'null' }};
    const driverLat = {{ $order->driver?->latitude ?? 'null' }};
    const driverLng = {{ $order->driver?->longitude ?? 'null' }};

    document.addEventListener("DOMContentLoaded", function() {
        map = L.map('tracking-map', { zoomControl: false });
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', { maxZoom: 19, attribution: '© OpenStreetMap contributors' }).addTo(map);
        L.control.zoom({ position: 'bottomright' }).addTo(map);

        if (driverLat && driverLng) { map.setView([driverLat, driverLng], 13); }
        else if (customerLat && customerLng) { map.setView([customerLat, customerLng], 14); }
        else { map.setView([11.5564, 104.9282], 10); }

        if (customerLat && customerLng) {
            const customerIcon = L.divIcon({
                html: '<div style="background: #7c3aed; border: 3px solid white; border-radius: 50%; width: 36px; height: 36px; display: flex; align-items: center; justify-content: center; font-size: 18px; box-shadow: 0 2px 12px rgba(124,58,237,0.4);">🏠</div>',
                className: 'customer-marker', iconSize: [36, 36], iconAnchor: [18, 18]
            });
            customerMarker = L.marker([customerLat, customerLng], { icon: customerIcon }).addTo(map);
            customerMarker.bindPopup('<div style="text-align: center;"><strong style="font-size: 14px; color: #7c3aed;">📍 Your Location</strong><br><span style="font-size: 12px; color: #64748b;">{{ $order->delivery_address }}</span></div>').openPopup();
        }

        if (driverLat && driverLng) { updateDriverMarker(driverLat, driverLng); showRoute(); startLiveTracking(); }
        updateProgress('{{ $order->status }}');
    });

    function updateDriverMarker(lat, lng) {
        const driverIcon = L.divIcon({
            html: '<div style="background: #10b981; border: 3px solid white; border-radius: 50%; width: 36px; height: 36px; display: flex; align-items: center; justify-content: center; font-size: 18px; box-shadow: 0 2px 12px rgba(16,185,129,0.4);">🚚</div>',
            className: 'driver-marker', iconSize: [36, 36], iconAnchor: [18, 18]
        });
        if (driverMarker) { driverMarker.setLatLng([lat, lng]); }
        else {
            driverMarker = L.marker([lat, lng], { icon: driverIcon }).addTo(map);
            driverMarker.bindPopup('<div style="text-align: center;"><strong style="font-size: 14px; color: #10b981;">🚚 {{ $order->driver?->name ?? "Driver" }}</strong><br><span style="font-size: 12px; color: #64748b;">Your delivery driver</span></div>');
        }
    }

    function showRoute() {
        if (!driverMarker || !customerMarker) return;
        if (routeControl) { map.removeControl(routeControl); }
        routeControl = L.Routing.control({
            waypoints: [driverMarker.getLatLng(), customerMarker.getLatLng()],
            routeWhileDragging: false, showAlternatives: false, fitSelectedRoutes: false,
            createMarker: function() { return null; },
            lineOptions: { styles: [{ color: '#3b82f6', opacity: 0.8, weight: 5, dashArray: '10, 10' }] },
            addWaypoints: false, draggableWaypoints: false, containerClassName: 'routing-machine-container'
        }).addTo(map);
    }

    function showDriverOnMap() {
        if (driverMarker) { map.setView(driverMarker.getLatLng(), 15); driverMarker.openPopup(); }
    }

    function startLiveTracking() {
        liveTrackingInterval = setInterval(() => {
            fetch('{{ route("customer.order.track-api", $order->id) }}')
                .then(response => response.json())
                .then(data => {
                    if (data.driver) { updateDriverMarker(data.driver.latitude, data.driver.longitude); showRoute(); }
                })
                .catch(error => console.error('Tracking error:', error));
        }, 15000);
    }

    function updateProgress(status) {
        const progressMap = { 'pending': 10, 'preparing': 25, 'ready_for_pickup': 40, 'out_for_delivery': 60, 'arrived': 85, 'delivered': 100 };
        const progress = progressMap[status] || 0;
        document.getElementById('progress-fill').style.width = progress + '%';
        const steps = { 'pending': 1, 'preparing': 2, 'ready_for_pickup': 2, 'out_for_delivery': 3, 'arrived': 3, 'delivered': 4 };
        const activeStep = steps[status] || 1;
        for (let i = 1; i <= 4; i++) {
            const dot = document.getElementById(`step-${i}`);
            const label = dot.nextElementSibling;
            if (i <= activeStep) { dot.classList.add('active'); label.classList.add('active'); }
            else { dot.classList.remove('active'); label.classList.remove('active'); }
        }
    }
    
    // Stop tracking if order is delivered
    @if($order->status === 'delivered')
        // Order already delivered - just show delivery location
        if (customerLat && customerLng) {
            const customerIcon = L.divIcon({
                html: '<div style="background: #16a34a; border: 3px solid white; border-radius: 50%; width: 36px; height: 36px; display: flex; align-items: center; justify-content: center; font-size: 18px; box-shadow: 0 2px 12px rgba(22,163,74,0.4);">✅</div>',
                className: 'customer-marker', iconSize: [36, 36], iconAnchor: [18, 18]
            });
            L.marker([customerLat, customerLng], { icon: customerIcon }).addTo(map)
                .bindPopup('<div style="text-align: center;"><strong style="font-size: 14px; color: #16a34a;">✅ Delivered</strong><br><span style="font-size: 12px; color: #64748b;">{{ $order->delivery_address }}</span></div>')
                .openPopup();
            map.setView([customerLat, customerLng], 14);
        }
    @endif
</script>
@endpush
@endsection
