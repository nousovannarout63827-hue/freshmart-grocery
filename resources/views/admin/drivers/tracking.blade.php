@extends('layouts.admin')

@section('title', 'Driver Tracking - Admin')

@push('styles')
<!-- Leaflet CSS -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
<style>
    .tracking-page {
        padding: 24px;
        max-width: 100%;
        margin: 0;
        height: calc(100vh - 80px);
        overflow: hidden;
    }

    .tracking-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 16px;
        flex-wrap: wrap;
        gap: 12px;
    }

    .tracking-title {
        font-size: 24px;
        font-weight: 800;
        color: #1e293b;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .tracking-grid {
        display: grid;
        grid-template-columns: 1fr 380px;
        gap: 16px;
        height: calc(100% - 50px);
    }

    @media (max-width: 1024px) {
        .tracking-grid {
            grid-template-columns: 1fr;
            height: auto;
        }
        
        .map-card {
            height: 500px !important;
        }
    }

    .map-card {
        background: white;
        border-radius: 16px;
        overflow: hidden;
        border: 1px solid #e2e8f0;
        box-shadow: 0 4px 6px rgba(0,0,0,0.05);
        height: 100%;
        min-height: 400px;
    }

    .map-container {
        height: 100%;
        width: 100%;
    }

    #drivers-map {
        height: 100%;
        width: 100%;
        z-index: 1;
    }

    .drivers-panel {
        background: white;
        border-radius: 16px;
        padding: 16px;
        border: 1px solid #e2e8f0;
        box-shadow: 0 4px 6px rgba(0,0,0,0.05);
        height: 100%;
        overflow: hidden;
        display: flex;
        flex-direction: column;
    }

    .panel-title {
        font-size: 16px;
        font-weight: 800;
        color: #1e293b;
        margin: 0 0 12px 0;
        display: flex;
        align-items: center;
        gap: 8px;
        flex-shrink: 0;
    }

    .driver-list {
        display: flex;
        flex-direction: column;
        gap: 12px;
        flex: 1;
        overflow-y: auto;
        padding-right: 4px;
        min-height: 0;
    }

    .driver-item {
        background: #f8fafc;
        border-radius: 12px;
        padding: 16px;
        border: 1px solid #e2e8f0;
        cursor: pointer;
        transition: all 0.2s;
    }

    .driver-item:hover {
        border-color: #3b82f6;
        background: #eff6ff;
        transform: translateX(4px);
    }

    .driver-item.active {
        border-color: #10b981;
        background: #f0fdf4;
    }

    .driver-header {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 12px;
    }

    .driver-avatar {
        width: 48px;
        height: 48px;
        border-radius: 50%;
        background: linear-gradient(135deg, #3b82f6, #2563eb);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: 800;
        font-size: 18px;
        flex-shrink: 0;
    }

    .driver-avatar img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 50%;
    }

    .driver-info {
        flex: 1;
        min-width: 0;
    }

    .driver-name {
        font-size: 15px;
        font-weight: 700;
        color: #1e293b;
        margin: 0;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .driver-phone {
        font-size: 12px;
        color: #64748b;
        margin: 2px 0 0 0;
    }

    .driver-stats {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 8px;
    }

    .driver-stat {
        background: white;
        padding: 8px 10px;
        border-radius: 8px;
        border: 1px solid #e2e8f0;
    }

    .driver-stat-label {
        font-size: 10px;
        color: #64748b;
        font-weight: 600;
        text-transform: uppercase;
        margin: 0;
    }

    .driver-stat-value {
        font-size: 13px;
        font-weight: 700;
        color: #1e293b;
        margin: 4px 0 0 0;
    }

    .status-indicator {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 4px 10px;
        border-radius: 12px;
        font-size: 11px;
        font-weight: 700;
        margin-top: 8px;
    }

    .status-active {
        background: #dcfce7;
        color: #166534;
    }

    .status-old {
        background: #fef3c7;
        color: #b45309;
    }

    .pulse-dot {
        width: 6px;
        height: 6px;
        border-radius: 50%;
        background: #10b981;
        animation: pulse 2s infinite;
    }

    @keyframes pulse {
        0%, 100% { opacity: 1; transform: scale(1); }
        50% { opacity: 0.5; transform: scale(1.2); }
    }

    .refresh-btn {
        background: #f1f5f9;
        color: #64748b;
        border: none;
        padding: 8px 16px;
        border-radius: 8px;
        font-weight: 600;
        font-size: 13px;
        cursor: pointer;
        transition: all 0.2s;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }

    .refresh-btn:hover {
        background: #e2e8f0;
        color: #475569;
    }

    .empty-state {
        text-align: center;
        padding: 40px 20px;
        color: #64748b;
    }

    .empty-state-icon {
        font-size: 48px;
        margin-bottom: 16px;
    }

    .custom-marker {
        background: white;
        border: 3px solid #10b981;
        border-radius: 50%;
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.2);
    }

    /* Custom Scrollbar for drivers panel */
    .drivers-panel::-webkit-scrollbar,
    .driver-list::-webkit-scrollbar {
        width: 6px;
    }

    .drivers-panel::-webkit-scrollbar-track,
    .driver-list::-webkit-scrollbar-track {
        background: #f1f5f9;
        border-radius: 10px;
    }

    .drivers-panel::-webkit-scrollbar-thumb,
    .driver-list::-webkit-scrollbar-thumb {
        background: #cbd5e1;
        border-radius: 10px;
    }

    .drivers-panel::-webkit-scrollbar-thumb:hover,
    .driver-list::-webkit-scrollbar-thumb:hover {
        background: #94a3b8;
    }

    /* Hide Leaflet Routing Machine panel */
    .leaflet-routing-container,
    .routing-machine-container {
        display: none !important;
    }

    /* Route distance label styling */
    .route-distance-label {
        z-index: 1000 !important;
    }

    .route-distance-label > div {
        background: linear-gradient(135deg, #3b82f6, #2563eb) !important;
        color: white !important;
        padding: 6px 12px !important;
        border-radius: 20px !important;
        font-size: 12px !important;
        font-weight: 800 !important;
        white-space: nowrap !important;
        box-shadow: 0 2px 12px rgba(59,130,246,0.5) !important;
        border: 3px solid white !important;
        text-shadow: 0 1px 2px rgba(0,0,0,0.2) !important;
    }
</style>
@endpush

@section('content')
<div class="tracking-page">
    <div class="tracking-header">
        <h1 class="tracking-title">
            <span>🚚</span> Driver Location Tracking
        </h1>
        <button class="refresh-btn" onclick="loadDrivers()">
            🔄 Refresh Locations
        </button>
    </div>

    <div class="tracking-grid">
        <!-- Map -->
        <div class="map-card" style="position: relative;">
            <div class="map-container" style="position: relative;">
                <div id="drivers-map"></div>
            </div>
            <!-- Map Legend -->
            <div style="position: absolute; bottom: 16px; left: 16px; background: white; padding: 10px 14px; border-radius: 10px; box-shadow: 0 2px 8px rgba(0,0,0,0.15); z-index: 1000; border: 1px solid #e2e8f0; min-width: 140px;">
                <p style="margin: 0 0 6px 0; font-size: 10px; font-weight: 700; color: #64748b; text-transform: uppercase;">Map Legend</p>
                <div style="display: flex; flex-direction: column; gap: 6px;">
                    <div style="display: flex; align-items: center; gap: 6px;">
                        <div style="width: 20px; height: 20px; background: white; border: 2px solid #10b981; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 12px;">🚚</div>
                        <span style="font-size: 10px; font-weight: 600; color: #475569;">Driver</span>
                    </div>
                    <div style="display: flex; align-items: center; gap: 6px;">
                        <div style="width: 20px; height: 20px; background: white; border: 2px solid #ef4444; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 12px;">🏠</div>
                        <span style="font-size: 10px; font-weight: 600; color: #475569;">Customer</span>
                    </div>
                    <div style="display: flex; align-items: center; gap: 6px;">
                        <div style="width: 24px; height: 2px; background: #3b82f6; opacity: 0.8;"></div>
                        <span style="font-size: 10px; font-weight: 600; color: #475569;">Route</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Drivers List -->
        <div class="drivers-panel">
            <h2 class="panel-title">
                <span>👥</span> Active Drivers
                <span id="driver-count" style="margin-left: auto; font-size: 13px; color: #64748b; font-weight: 600;">0</span>
            </h2>
            <div class="driver-list" id="driver-list">
                <div class="empty-state">
                    <div class="empty-state-icon">📍</div>
                    <p>Loading drivers...</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<!-- Leaflet JS -->
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
<!-- Leaflet Routing Machine -->
<link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine@3.2.12/dist/leaflet-routing-machine.css" />
<script src="https://unpkg.com/leaflet-routing-machine@3.2.12/dist/leaflet-routing-machine.js"></script>
<script>
    let map;
    let driverMarkers = {};
    let customerMarkers = {};
    let routeLines = {};
    let routingControls = {};
    let driversData = [];
    let customersData = [];

    // Initialize map
    function initMap() {
        // Default to Phnom Penh, Cambodia
        map = L.map('drivers-map').setView([11.5564, 104.9282], 10);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);

        loadDrivers();
    }

    // Load all drivers
    function loadDrivers() {
        console.log('🔄 Loading drivers and customers from API...');
        
        fetch('{{ route("admin.api.drivers.location") }}')
            .then(response => {
                console.log('API Response status:', response.status);
                return response.json();
            })
            .then(data => {
                console.log('📊 Full API Response:', data);
                console.log('Total drivers:', data.total_drivers);
                console.log('Drivers with location:', data.drivers_with_location);
                console.log('Drivers with orders:', data.drivers_with_orders);
                
                driversData = data.drivers || [];
                customersData = data.unassigned_orders || [];
                
                updateDriverList();
                updateMapMarkers();
            })
            .catch(error => {
                console.error('❌ Error loading drivers:', error);
                document.getElementById('driver-list').innerHTML = `
                    <div class="empty-state">
                        <div class="empty-state-icon">❌</div>
                        <p>Error loading drivers</p>
                        <p style="font-size: 11px; margin-top: 8px; color: #ef4444;">Check browser console (F12) for details</p>
                    </div>
                `;
            });
    }

    // Update driver list panel
    function updateDriverList() {
        const listEl = document.getElementById('driver-list');
        const countEl = document.getElementById('driver-count');

        if (!driversData.length) {
            listEl.innerHTML = `
                <div class="empty-state">
                    <div class="empty-state-icon">✅</div>
                    <p style="font-weight: 700; color: #10b981;">All Drivers Completed!</p>
                    <p style="font-size: 12px; margin-top: 8px; color: #64748b;">No drivers currently on active deliveries</p>
                    <div style="margin-top: 16px; padding: 12px; background: #f0fdf4; border: 1px solid #22c55e; border-radius: 8px; font-size: 11px; color: #166534;">
                        <strong>💡 Note:</strong> Drivers only appear here when they have orders "Out for Delivery" or "Arrived"
                    </div>
                </div>
            `;
            countEl.textContent = '0';
            return;
        }

        const driversWithLocation = driversData.filter(d => d.has_location);
        const driversWithoutLocation = driversData.filter(d => !d.has_location);
        
        countEl.textContent = `${driversWithLocation.length}/${driversData.length}`;

        let html = '';
        
        // Show drivers WITH location first
        if (driversWithLocation.length > 0) {
            html += `<div style="margin-bottom: 16px;"><p style="font-size: 11px; font-weight: 700; color: #10b981; text-transform: uppercase; margin-bottom: 8px;">🚚 Active Drivers on Delivery (${driversWithLocation.length})</p></div>`;
            html += driversWithLocation.map(driver => createDriverItem(driver, true)).join('');
        }
        
        // Show drivers WITHOUT location
        if (driversWithoutLocation.length > 0) {
            html += `<div style="margin-top: 20px; margin-bottom: 16px;"><p style="font-size: 11px; font-weight: 700; color: #f59e0b; text-transform: uppercase; margin-bottom: 8px;">⚠️ No GPS Signal (${driversWithoutLocation.length})</p></div>`;
            html += driversWithoutLocation.map(driver => createDriverItem(driver, false)).join('');
        }

        listEl.innerHTML = html;
    }

    // Create driver item HTML
    function createDriverItem(driver, hasLocation) {
        const initials = driver.name.split(' ').map(n => n[0]).join('').toUpperCase().slice(0, 2);
        const statusClass = hasLocation ? (driver.updated_at?.includes('second') || driver.updated_at?.includes('minute') ? 'status-active' : 'status-old') : '';
        
        // Check if driver has valid coordinates
        const hasValidCoords = hasLocation && 
                               driver.latitude !== null && 
                               driver.longitude !== null && 
                               typeof driver.latitude === 'number' && 
                               typeof driver.longitude === 'number';
        
        const canClick = hasValidCoords;
        
        // Build avatar URL
        let avatarHtml = '';
        if (driver.avatar) {
            const avatarUrl = driver.avatar.startsWith('http') ? driver.avatar : '/storage/' + driver.avatar;
            avatarHtml = `<img src="${avatarUrl}" alt="${driver.name}" style="width: 100%; height: 100%; object-fit: cover; border-radius: 50%;" onerror="this.style.display='none'; this.parentElement.innerHTML='${initials}';">`;
        } else {
            avatarHtml = initials;
        }
        
        return `
            <div class="driver-item ${driverMarkers[driver.id] ? 'active' : ''}" 
                 onclick="${canClick ? `focusOnDriver(${driver.id})` : ''}" 
                 style="${!canClick ? 'opacity: 0.7; cursor: default;' : ''}">
                <div class="driver-header">
                    <div class="driver-avatar">${avatarHtml}</div>
                    <div class="driver-info">
                        <p class="driver-name">${driver.name}</p>
                        <p class="driver-phone">📞 ${driver.phone_number || 'N/A'}</p>
                    </div>
                    ${hasValidCoords ? '<span style="font-size: 18px;">🗺️</span>' : '<span style="font-size: 18px; opacity: 0.3;">📍</span>'}
                </div>
                ${hasValidCoords ? `
                    ${driver.assigned_order ? `
                        <div style="margin-top: 10px; padding: 10px; background: linear-gradient(135deg, #dbeafe, #bfdbfe); border: 2px solid #3b82f6; border-radius: 10px;">
                            <p style="margin: 0 0 6px 0; font-size: 10px; font-weight: 700; color: #1e40af; text-transform: uppercase;">📦 Currently Delivering</p>
                            <p style="margin: 0 0 4px 0; font-size: 12px; font-weight: 700; color: #1e293b;">${driver.assigned_order.customer_name}</p>
                            <p style="margin: 0 0 6px 0; font-size: 10px; color: #64748b;">Order #${String(driver.assigned_order.id).padStart(8, '0')}</p>
                            <div style="display: flex; align-items: center; justify-content: space-between;">
                                <span style="display: inline-block; background: #f59e0b; color: white; padding: 3px 8px; border-radius: 12px; font-size: 9px; font-weight: 700;">${driver.assigned_order.status}</span>
                                <span style="font-size: 9px; color: #1e40af; font-weight: 700;">📍 ${driver.assigned_order.address.substring(0, 25)}...</span>
                            </div>
                        </div>
                    ` : `
                        <div style="margin-top: 10px; padding: 8px; background: #f1f5f9; border: 1px solid #e2e8f0; border-radius: 8px; text-align: center;">
                            <p style="margin: 0; font-size: 10px; color: #64748b; font-weight: 600;">🕐 Between deliveries</p>
                        </div>
                    `}
                    <div class="status-indicator ${statusClass}" style="margin-top: 8px;">
                        <span class="pulse-dot"></span>
                        Updated: ${driver.updated_at || 'Unknown'}
                        ${driver.updated_at_full ? `<span style="display:block; margin-top:2px; font-size:9px; opacity:0.7;">${driver.updated_at_full}</span>` : ''}
                    </div>
                ` : `
                    <div style="margin-top: 10px; padding: 10px; background: #fef3c7; border: 1px solid #fcd34d; border-radius: 8px;">
                        <p style="margin: 0; font-size: 11px; color: #b45309; font-weight: 600;">
                            ⚠️ Location not set
                        </p>
                        <p style="margin: 4px 0 0 0; font-size: 10px; color: #92400e;">
                            Driver needs to visit /driver/location
                        </p>
                    </div>
                `}
            </div>
        `;
    }

    // Update map markers
    function updateMapMarkers() {
        // Clear existing markers, routes, and routing controls
        Object.values(driverMarkers).forEach(marker => map.removeLayer(marker));
        Object.values(customerMarkers).forEach(marker => map.removeLayer(marker));
        Object.values(routeLines).forEach(line => map.removeLayer(line));
        Object.values(routingControls).forEach(control => map.removeControl(control));
        driverMarkers = {};
        customerMarkers = {};
        routeLines = {};
        routingControls = {};

        const allMarkers = [];

        // Add driver markers with assigned orders
        driversData.forEach(driver => {
            if (!driver.has_location) return;
            
            const driverIcon = L.divIcon({
                html: `<div style="background: white; border: 3px solid #10b981; border-radius: 50%; width: 44px; height: 44px; display: flex; align-items: center; justify-content: center; font-size: 18px; font-weight: 800; color: #10b981; box-shadow: 0 2px 8px rgba(0,0,0,0.3);">🚚</div>`,
                className: 'driver-marker',
                iconSize: [44, 44],
                iconAnchor: [22, 22]
            });

            const marker = L.marker([driver.latitude, driver.longitude], { icon: driverIcon })
                .addTo(map);
            
            // Build popup content
            let popupContent = `
                <div style="text-align: center; min-width: 220px;">
                    <div style="background: linear-gradient(135deg, #10b981, #059669); color: white; padding: 10px; border-radius: 10px 10px 0 0; margin: -12px -12px 10px -12px;">
                        <strong style="font-size: 15px;">🚚 ${driver.name}</strong>
                    </div>
                    <span style="font-size: 12px; color: #64748b;">📞 ${driver.phone_number || 'N/A'}</span><br>
                    <span style="font-size: 11px; color: #94a3b8;">Updated: ${driver.updated_at || 'Unknown'}</span>
            `;
            
            // Add assigned order info and create route
            if (driver.assigned_order && driver.assigned_order.customer_latitude && driver.assigned_order.customer_longitude) {
                popupContent += `
                    <div style="margin-top: 12px; padding-top: 10px; border-top: 2px dashed #e2e8f0;">
                        <p style="margin: 0 0 6px 0; font-size: 11px; font-weight: 700; color: #3b82f6; text-transform: uppercase;">📦 Assigned Order</p>
                        <p style="margin: 0 0 4px 0; font-size: 12px; font-weight: 700; color: #1e293b;">${driver.assigned_order.customer_name}</p>
                        <p style="margin: 0 0 6px 0; font-size: 11px; color: #64748b;">Order #${String(driver.assigned_order.id).padStart(8, '0')}</p>
                        <span style="display: inline-block; background: #dbeafe; color: #1e40af; padding: 3px 10px; border-radius: 12px; font-size: 10px; font-weight: 700;">${driver.assigned_order.status}</span>
                    </div>
                `;
                
                // Create route using OSRM (Open Source Routing Machine)
                try {
                    const routingControl = L.Routing.control({
                        waypoints: [
                            L.latLng(driver.latitude, driver.longitude),
                            L.latLng(driver.assigned_order.customer_latitude, driver.assigned_order.customer_longitude)
                        ],
                        routeWhileDragging: false,
                        showAlternatives: false,
                        fitSelectedRoutes: false,
                        createMarker: function() { return null; }, // Don't create default markers
                        lineOptions: {
                            styles: [
                                {
                                    color: '#3b82f6',
                                    opacity: 0.8,
                                    weight: 5,
                                    dashArray: '10, 10'
                                }
                            ]
                        },
                        addWaypoints: false,
                        draggableWaypoints: false,
                        containerClassName: 'routing-machine-container'
                    }).addTo(map);
                    
                    routingControl.on('routesfound', function(e) {
                        const routes = e.routes;
                        const summary = routes[0].summary;
                        const distanceKm = (summary.totalDistance / 1000).toFixed(2);
                        const timeMinutes = Math.round(summary.totalTime / 60);
                        
                        popupContent += `
                            <div style="margin-top: 10px; padding: 8px; background: linear-gradient(135deg, #eff6ff, #dbeafe); border: 1px solid #3b82f6; border-radius: 8px;">
                                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 4px;">
                                    <span style="font-size: 10px; color: #1e40af; font-weight: 700;">📍 Distance:</span>
                                    <span style="font-size: 11px; color: #1e40af; font-weight: 800;">${distanceKm} km</span>
                                </div>
                                <div style="display: flex; justify-content: space-between; align-items: center;">
                                    <span style="font-size: 10px; color: #1e40af; font-weight: 700;">⏱️ Est. Time:</span>
                                    <span style="font-size: 11px; color: #1e40af; font-weight: 800;">${timeMinutes} min</span>
                                </div>
                            </div>
                        `;
                        
                        // Store the route layer
                        if (routes[0] && routes[0].coordinates) {
                            const routeCoordinates = routes[0].coordinates;
                            
                            // Draw the main route line
                            routeLines[`driver-${driver.id}`] = L.polyline(routeCoordinates, {
                                color: '#3b82f6',
                                weight: 5,
                                opacity: 0.8,
                                dashArray: '10, 10'
                            }).addTo(map);
                            allMarkers.push(routeLines[`driver-${driver.id}`]);
                            
                            // Add distance label at midpoint of route
                            const midIndex = Math.floor(routeCoordinates.length / 2);
                            const midPoint = routeCoordinates[midIndex];
                            
                            if (midPoint) {
                                const distanceLabel = L.marker([midPoint.lat, midPoint.lng], {
                                    icon: L.divIcon({
                                        html: `<div style="background: #3b82f6; color: white; padding: 4px 10px; border-radius: 16px; font-size: 11px; font-weight: 800; white-space: nowrap; box-shadow: 0 2px 8px rgba(59,130,246,0.4); border: 2px solid white;">📍 ${distanceKm} km</div>`,
                                        className: 'route-distance-label',
                                        iconSize: [80, 28],
                                        iconAnchor: [40, 14]
                                    }),
                                    zIndexOffset: 1000
                                }).addTo(map);
                                
                                routeLines[`label-${driver.id}`] = distanceLabel;
                                allMarkers.push(distanceLabel);
                            }
                        }
                    });
                    
                    routingControls[`driver-${driver.id}`] = routingControl;
                } catch (error) {
                    console.error('Routing error:', error);
                    // Fallback to straight line if routing fails
                    const fallbackLine = L.polyline([
                        [driver.latitude, driver.longitude],
                        [driver.assigned_order.customer_latitude, driver.assigned_order.customer_longitude]
                    ], {
                        color: '#3b82f6',
                        weight: 4,
                        opacity: 0.8,
                        dashArray: '10, 10'
                    }).addTo(map);
                    routeLines[`driver-${driver.id}`] = fallbackLine;
                    allMarkers.push(fallbackLine);
                    
                    // Add label for fallback line too
                    const midLat = (driver.latitude + driver.assigned_order.customer_latitude) / 2;
                    const midLng = (driver.longitude + driver.assigned_order.customer_longitude) / 2;
                    const straightDistance = calculateDistance(
                        driver.latitude, driver.longitude,
                        driver.assigned_order.customer_latitude, driver.assigned_order.customer_longitude
                    ).toFixed(2);
                    
                    const fallbackLabel = L.marker([midLat, midLng], {
                        icon: L.divIcon({
                            html: `<div style="background: #3b82f6; color: white; padding: 4px 10px; border-radius: 16px; font-size: 11px; font-weight: 800; white-space: nowrap; box-shadow: 0 2px 8px rgba(59,130,246,0.4); border: 2px solid white;">📍 ${straightDistance} km</div>`,
                            className: 'route-distance-label',
                            iconSize: [80, 28],
                            iconAnchor: [40, 14]
                        }),
                        zIndexOffset: 1000
                    }).addTo(map);
                    
                    routeLines[`label-${driver.id}`] = fallbackLabel;
                    allMarkers.push(fallbackLabel);
                }
            }
            
            popupContent += `
                    <a href="https://www.google.com/maps/dir/?api=1&destination=${driver.latitude},${driver.longitude}" 
                       target="_blank" 
                       style="display: inline-block; margin-top: 10px; font-size: 11px; color: #3b82f6; text-decoration: none; font-weight: 700;">
                        Get Directions →
                    </a>
                </div>
            `;
            
            marker.bindPopup(popupContent);
            driverMarkers[driver.id] = marker;
            allMarkers.push(marker);
        });

        // Add customer markers (unassigned orders)
        customersData.forEach(customer => {
            const customerIcon = L.divIcon({
                html: `<div style="background: white; border: 3px solid #ef4444; border-radius: 50%; width: 40px; height: 40px; display: flex; align-items: center; justify-content: center; font-size: 16px; font-weight: 800; color: #ef4444; box-shadow: 0 2px 8px rgba(0,0,0,0.3);">🏠</div>`,
                className: 'customer-marker',
                iconSize: [40, 40],
                iconAnchor: [20, 20]
            });

            const marker = L.marker([customer.latitude, customer.longitude], { icon: customerIcon })
                .addTo(map)
                .bindPopup(`
                    <div style="text-align: center; min-width: 200px;">
                        <div style="background: linear-gradient(135deg, #ef4444, #dc2626); color: white; padding: 10px; border-radius: 10px 10px 0 0; margin: -12px -12px 10px -12px;">
                            <strong style="font-size: 15px;">🏠 ${customer.customer_name}</strong>
                        </div>
                        <span style="font-size: 11px; color: #64748b; display: block; margin-bottom: 4px;">Order #${String(customer.id).padStart(8, '0')}</span>
                        <span style="font-size: 11px; color: #94a3b8; display: block; margin-bottom: 6px;">${customer.address}</span>
                        <span style="display: inline-block; background: #fef3c7; color: #b45309; padding: 3px 8px; border-radius: 12px; font-size: 10px; font-weight: 700;">${customer.status}</span><br>
                        <a href="https://www.google.com/maps/dir/?api=1&destination=${customer.latitude},${customer.longitude}" 
                           target="_blank" 
                           style="display: inline-block; margin-top: 8px; font-size: 11px; color: #3b82f6; text-decoration: none; font-weight: 700;">
                            Get Directions →
                        </a>
                    </div>
                `);

            customerMarkers[customer.id] = marker;
            allMarkers.push(marker);
        });

        // Fit map to show all markers
        if (allMarkers.length > 0) {
            const group = new L.featureGroup(allMarkers);
            map.fitBounds(group.getBounds().pad(0.2));
        }
    }

    // Focus on specific driver
    function focusOnDriver(driverId) {
        const driver = driversData.find(d => d.id === driverId);
        if (!driver) return;

        map.setView([driver.latitude, driver.longitude], 14);
        if (driverMarkers[driverId]) {
            driverMarkers[driverId].openPopup();
        }

        // Highlight selected driver
        document.querySelectorAll('.driver-item').forEach(item => item.classList.remove('active'));
        event.currentTarget.classList.add('active');
    }

    // Initialize on page load
    document.addEventListener('DOMContentLoaded', initMap);

    // Auto-refresh every 30 seconds
    setInterval(loadDrivers, 30000);
</script>
@endpush
