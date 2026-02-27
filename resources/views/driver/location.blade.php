@extends('layouts.driver')

@section('title', 'Update Location - Driver Dashboard')

@push('styles')
<!-- Leaflet CSS -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
<!-- SweetAlert2 CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<style>
    .location-page {
        padding: 24px;
        max-width: 1200px;
        margin: 0 auto;
    }

    .location-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 24px;
        flex-wrap: wrap;
        gap: 12px;
    }

    .location-title {
        font-size: 24px;
        font-weight: 800;
        color: #1e293b;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .location-card {
        background: white;
        border-radius: 16px;
        padding: 24px;
        border: 1px solid #e2e8f0;
        box-shadow: 0 4px 6px rgba(0,0,0,0.05);
        margin-bottom: 24px;
    }

    .location-card-title {
        font-size: 18px;
        font-weight: 800;
        color: #1e293b;
        margin: 0 0 16px 0;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .map-container {
        height: 400px;
        border-radius: 12px;
        overflow: hidden;
        border: 2px solid #e2e8f0;
        margin-bottom: 16px;
    }

    #location-map {
        height: 100%;
        width: 100%;
        z-index: 1;
    }

    .location-info {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 16px;
        margin-bottom: 20px;
    }

    .location-stat {
        background: #f8fafc;
        padding: 16px;
        border-radius: 12px;
        border: 1px solid #e2e8f0;
    }

    .location-stat-label {
        font-size: 12px;
        color: #64748b;
        font-weight: 600;
        text-transform: uppercase;
        margin: 0 0 8px 0;
    }

    .location-stat-value {
        font-size: 16px;
        font-weight: 700;
        color: #1e293b;
        margin: 0;
    }

    .btn-group {
        display: flex;
        flex-wrap: wrap;
        gap: 12px;
    }

    .btn {
        padding: 12px 24px;
        border-radius: 10px;
        font-weight: 700;
        font-size: 14px;
        cursor: pointer;
        border: none;
        transition: all 0.2s;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    .btn-primary {
        background: linear-gradient(135deg, #10b981, #059669);
        color: white;
        box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(16, 185, 129, 0.4);
    }

    .btn-secondary {
        background: linear-gradient(135deg, #3b82f6, #2563eb);
        color: white;
        box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
    }

    .btn-secondary:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(59, 130, 246, 0.4);
    }

    .btn-outline {
        background: white;
        color: #64748b;
        border: 2px solid #e2e8f0;
    }

    .btn-outline:hover {
        background: #f8fafc;
        border-color: #cbd5e1;
        color: #475569;
    }

    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 8px 16px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 700;
        text-transform: uppercase;
    }

    .status-active {
        background: #dcfce7;
        color: #166534;
    }

    .status-inactive {
        background: #fef2f2;
        color: #991b1b;
    }

    .pulse-dot {
        width: 8px;
        height: 8px;
        border-radius: 50%;
        background: #10b981;
        animation: pulse 2s infinite;
    }

    @keyframes pulse {
        0%, 100% { opacity: 1; transform: scale(1); }
        50% { opacity: 0.5; transform: scale(1.2); }
    }

    .tracking-toggle {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 16px;
        background: #f0f9ff;
        border: 1px solid #bae6fd;
        border-radius: 12px;
        margin-bottom: 20px;
    }

    .toggle-switch {
        position: relative;
        width: 60px;
        height: 32px;
    }

    .toggle-switch input {
        opacity: 0;
        width: 0;
        height: 0;
    }

    .toggle-slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #cbd5e1;
        transition: 0.3s;
        border-radius: 32px;
    }

    .toggle-slider:before {
        position: absolute;
        content: "";
        height: 24px;
        width: 24px;
        left: 4px;
        bottom: 4px;
        background-color: white;
        transition: 0.3s;
        border-radius: 50%;
    }

    input:checked + .toggle-slider {
        background-color: #10b981;
    }

    input:checked + .toggle-slider:before {
        transform: translateX(28px);
    }

    .alert {
        padding: 16px;
        border-radius: 12px;
        margin-bottom: 20px;
        font-weight: 600;
    }

    .alert-success {
        background: #f0fdf4;
        border: 1px solid #22c55e;
        color: #15803d;
    }

    .alert-warning {
        background: #fef3c7;
        border: 1px solid #f59e0b;
        color: #b45309;
    }
</style>
@endpush

@section('content')
<div class="location-page">
    <div class="location-header">
        <h1 class="location-title">
            <span>📍</span> Update Your Location
        </h1>
        <div>
            @if($driver->latitude && $driver->longitude)
                <span class="status-badge status-active">
                    <span class="pulse-dot"></span>
                    Location Active
                </span>
            @else
                <span class="status-badge status-inactive">
                    No Location Set
                </span>
            @endif
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            ✅ {{ session('success') }}
        </div>
    @endif

    @if(!$driver->latitude || !$driver->longitude)
        <div class="alert alert-warning">
            ⚠️ You haven't set your location yet. Please use the map below or click "Use Current Location" to get started.
        </div>
    @endif

    <!-- Auto Tracking Toggle -->
    <div class="location-card">
        <h3 class="location-card-title">
            <span>🔄</span> Auto Location Tracking
        </h3>
        <div class="tracking-toggle">
            <div>
                <strong style="color: #0369a1;">Enable Automatic Updates</strong>
                <p style="margin: 4px 0 0 0; font-size: 13px; color: #0c4a6e;">
                    Your location will be updated every 30 seconds automatically
                </p>
            </div>
            <label class="toggle-switch">
                <input type="checkbox" id="auto-tracking-toggle" onchange="toggleAutoTracking(this.checked)">
                <span class="toggle-slider"></span>
            </label>
        </div>
    </div>

    <!-- Map Card -->
    <div class="location-card">
        <h3 class="location-card-title">
            <span>🗺️</span> Select Your Location
        </h3>
        
        <div class="map-container">
            <div id="location-map"></div>
        </div>

        <div class="location-info">
            <div class="location-stat">
                <p class="location-stat-label">Latitude</p>
                <p class="location-stat-value" id="lat-display">--</p>
            </div>
            <div class="location-stat">
                <p class="location-stat-label">Longitude</p>
                <p class="location-stat-value" id="lng-display">--</p>
            </div>
            <div class="location-stat">
                <p class="location-stat-label">Last Updated</p>
                <p class="location-stat-value" id="updated-display">
                    @if($driver->location_updated_at)
                        {{ $driver->location_updated_at->diffForHumans() }}
                        <span style="display: block; font-size: 11px; color: #94a3b8; font-weight: 500; margin-top: 2px;">
                            {{ $driver->location_updated_at->format('M d, Y h:i A') }}
                        </span>
                    @else
                        Never
                    @endif
                </p>
            </div>
        </div>

        <div class="btn-group">
            <button type="button" class="btn btn-secondary" onclick="useCurrentLocation()">
                📍 Use Current Location
            </button>
            <button type="button" class="btn btn-primary" onclick="saveLocation()">
                💾 Save Location
            </button>
            <button type="button" class="btn btn-outline" onclick="resetMap()">
                🔄 Reset View
            </button>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<!-- Leaflet JS -->
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
<!-- SweetAlert2 JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    let map;
    let marker;
    // Initialize with driver's saved location from database, or default to Phnom Penh
    let currentLat = {{ $driver->latitude ?? 'null' }};
    let currentLng = {{ $driver->longitude ?? 'null' }};
    let autoTrackingInterval = null;
    
    // If no saved location, use browser's location or default
    const hasSavedLocation = currentLat !== null && currentLng !== null;
    if (!hasSavedLocation) {
        currentLat = 11.5564; // Default to Phnom Penh
        currentLng = 104.9282;
    }

    // Initialize map
    function initMap() {
        map = L.map('location-map').setView([currentLat, currentLng], 13);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);

        // Add marker
        marker = L.marker([currentLat, currentLng], {
            draggable: true,
            icon: L.icon({
                iconUrl: 'https://unpkg.com/leaflet@1.9.4/dist/images/marker-icon.png',
                iconRetinaUrl: 'https://unpkg.com/leaflet@1.9.4/dist/images/marker-icon-2x.png',
                shadowUrl: 'https://unpkg.com/leaflet@1.9.4/dist/images/marker-shadow.png',
                iconSize: [25, 41],
                iconAnchor: [12, 41],
                popupAnchor: [1, -34],
                shadowSize: [41, 41]
            })
        }).addTo(map);

        // Update coordinates when marker is dragged
        marker.on('dragend', function(event) {
            const position = marker.getLatLng();
            currentLat = position.lat;
            currentLng = position.lng;
            updateDisplay();
        });

        // Update coordinates when map is clicked
        map.on('click', function(event) {
            currentLat = event.latlng.lat;
            currentLng = event.latlng.lng;
            marker.setLatLng([currentLat, currentLng]);
            updateDisplay();
        });

        updateDisplay();
        
        // Show notification if driver has saved location
        @if($driver->latitude && $driver->longitude)
            setTimeout(function() {
                Swal.fire({
                    icon: 'info',
                    title: 'Location Loaded',
                    html: '<p>✅ Your last saved location has been loaded.</p><p style="font-size: 12px; color: #64748b; margin-top: 8px;">Drag the marker or click "Use Current Location" to update.</p>',
                    confirmButtonColor: '#3b82f6',
                    confirmButtonText: 'OK',
                    timer: 4000,
                    timerProgressBar: true
                });
            }, 500);
        @endif
    }

    // Update coordinate display
    function updateDisplay() {
        document.getElementById('lat-display').textContent = currentLat.toFixed(6);
        document.getElementById('lng-display').textContent = currentLng.toFixed(6);
    }

    // Use browser's current location
    function useCurrentLocation() {
        if (!navigator.geolocation) {
            Swal.fire({
                icon: 'error',
                title: 'Not Supported',
                text: 'Geolocation is not supported by your browser',
                confirmButtonColor: '#10b981',
                confirmButtonText: 'OK'
            });
            return;
        }

        const btn = event.target;
        btn.disabled = true;
        btn.innerHTML = '⏳ Getting Location...';

        navigator.geolocation.getCurrentPosition(
            (position) => {
                currentLat = position.coords.latitude;
                currentLng = position.coords.longitude;
                marker.setLatLng([currentLat, currentLng]);
                map.setView([currentLat, currentLng], 15);
                updateDisplay();
                btn.disabled = false;
                btn.innerHTML = '📍 Use Current Location';
                
                Swal.fire({
                    icon: 'success',
                    title: 'Location Found! ✅',
                    text: 'Your current location has been detected. Click "Save Location" to update.',
                    confirmButtonColor: '#10b981',
                    confirmButtonText: 'Great!',
                    timer: 3000,
                    timerProgressBar: true
                });
            },
            (error) => {
                btn.disabled = false;
                btn.innerHTML = '📍 Use Current Location';
                
                let errorMessage = 'Unable to get your location';
                if (error.code === 1) {
                    errorMessage = 'Location access denied. Please allow location access in your browser settings.';
                } else if (error.code === 2) {
                    errorMessage = 'Location unavailable. Please check your device settings.';
                }
                
                Swal.fire({
                    icon: 'warning',
                    title: 'Location Error',
                    text: errorMessage,
                    confirmButtonColor: '#f59e0b',
                    confirmButtonText: 'OK'
                });
            }
        );
    }

    // Save location to database
    function saveLocation() {
        const btn = event.target;
        btn.disabled = true;
        btn.innerHTML = '⏳ Saving...';

        console.log('💾 Saving location:', { lat: currentLat, lng: currentLng });
        console.log('CSRF Token:', document.querySelector('meta[name="csrf-token"]')?.content);

        fetch('{{ route("driver.location.update") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '',
                'Accept': 'application/json',
            },
            body: JSON.stringify({
                latitude: currentLat,
                longitude: currentLng
            })
        })
        .then(response => {
            console.log('Response status:', response.status);
            console.log('Response OK:', response.ok);
            
            if (!response.ok) {
                throw new Error('Server responded with status ' + response.status);
            }
            
            return response.json();
        })
        .then(data => {
            console.log('✅ Response data:', data);
            
            if (data.success) {
                document.getElementById('updated-display').textContent = 'Just now';
                
                Swal.fire({
                    icon: 'success',
                    title: 'Location Saved! 🎉',
                    text: 'Your location has been updated successfully. Customers can now track you.',
                    confirmButtonColor: '#10b981',
                    confirmButtonText: 'Awesome!',
                    timer: 2500,
                    timerProgressBar: true
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Save Failed',
                    text: data.message || 'An error occurred while saving your location.',
                    confirmButtonColor: '#ef4444',
                    confirmButtonText: 'Try Again'
                });
            }
        })
        .catch(error => {
            console.error('❌ Error:', error);
            Swal.fire({
                icon: 'error',
                title: 'Save Failed ❌',
                html: '<p>An error occurred. Please check:</p><ul style="text-align: left; margin-top: 8px;"><li>You are logged in as a driver</li><li>Your internet connection</li><li>Browser console for details (F12)</li></ul>',
                footer: '<span style="font-size: 11px; color: #64748b;">Error: ' + error.message + '</span>',
                confirmButtonColor: '#ef4444',
                confirmButtonText: 'OK'
            });
        })
        .finally(() => {
            btn.disabled = false;
            btn.innerHTML = '💾 Save Location';
        });
    }

    // Reset map view
    function resetMap() {
        map.setView([currentLat, currentLng], 13);
    }

    // Toggle auto tracking
    function toggleAutoTracking(enabled) {
        if (enabled) {
            // Start auto tracking
            autoTrackingInterval = setInterval(() => {
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(
                        (position) => {
                            currentLat = position.coords.latitude;
                            currentLng = position.coords.longitude;
                            marker.setLatLng([currentLat, currentLng]);
                            updateDisplay();
                            
                            // Auto-save
                            fetch('{{ route("driver.location.update") }}', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                                    'Accept': 'application/json',
                                },
                                body: JSON.stringify({
                                    latitude: currentLat,
                                    longitude: currentLng
                                })
                            });
                        },
                        (error) => {
                            console.error('Auto-tracking error:', error);
                        }
                    );
                }
            }, 30000); // Update every 30 seconds

            Swal.fire({
                icon: 'success',
                title: 'Auto-Tracking Enabled! 🔄',
                html: '<p>Your location will update automatically every 30 seconds.</p><p style="font-size: 12px; color: #64748b; margin-top: 8px;">Keep this page open for continuous tracking.</p>',
                confirmButtonColor: '#10b981',
                confirmButtonText: 'Got it!',
                timer: 3500,
                timerProgressBar: true
            });
        } else {
            // Stop auto tracking
            if (autoTrackingInterval) {
                clearInterval(autoTrackingInterval);
                autoTrackingInterval = null;
            }
            
            Swal.fire({
                icon: 'info',
                title: 'Auto-Tracking Paused ⏸️',
                text: 'Automatic location updates have been disabled.',
                confirmButtonColor: '#3b82f6',
                confirmButtonText: 'OK',
                timer: 2000,
                timerProgressBar: true
            });
        }
    }

    // Initialize on page load
    document.addEventListener('DOMContentLoaded', initMap);
</script>
@endpush
