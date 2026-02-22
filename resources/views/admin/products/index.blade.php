@extends('layouts.admin')

@section('content')
<div class="products-page">

    <div class="page-header">
        @php
            $badgeColor = '#00c853'; // Default Green for All Products
            if(request('out_of_stock')) $badgeColor = '#991b1b'; // Dark Red for Out of Stock
            elseif(request('low_stock')) $badgeColor = '#ef4444'; // Bright Red for Low Stock
        @endphp

        <h1 style="display: flex; align-items: center; gap: 10px; margin: 0; font-size: 24px; font-weight: 900;">
            {{ $pageTitle }}
            
            <span style="background-color: {{ $badgeColor }}; color: white; padding: 4px 12px; border-radius: 20px; font-size: 16px; font-weight: bold;">
                {{ $products->total() }}
            </span>
        </h1>
        <div class="header-actions">
            <a href="{{ route('admin.products.index', ['out_of_stock' => 1]) }}" class="btn" style="background-color: #991b1b; color: white; border: none; position: relative;">
                🛑 View Out of Stock
                @if($outOfStockCount > 0)
                    <span class="notification-dot">{{ $outOfStockCount }}</span>
                @endif
            </a>

            <a href="{{ route('admin.products.index', ['low_stock' => 1]) }}" class="btn btn-danger" style="position: relative;">
                ⚠️ View Low Stock
                @if($lowStockCount > 0)
                    <span class="notification-dot">{{ $lowStockCount }}</span>
                @endif
            </a>

            @if(auth()->user()->isAdmin())
                <a href="{{ route('admin.products.trash') }}" class="btn btn-secondary">🗑️ View Trash</a>
                <button id="bulk-delete-btn" class="btn btn-outline-danger">Delete Selected</button>
            @endif

            <a href="{{ route('admin.products.create') }}" class="btn btn-primary">+ Add New Product</a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert-success">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="alert-icon">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            
            <span class="alert-text">{{ session('success') }}</span>
            
            <button type="button" class="alert-close" onclick="this.parentElement.style.display='none';">
                &times;
            </button>
        </div>
    @endif

    <div class="filter-bar">
        <form action="{{ route('admin.products.index') }}" method="GET">
            <input type="text" id="search-input" name="search" placeholder="Search product name..."
                   value="{{ request('search') }}" class="form-control" autocomplete="off">
            
            <select name="category" id="category-filter" class="form-control">
                <option value="">All Categories</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
            
            <label class="checkbox-label">
                <input type="checkbox" name="low_stock" id="low-stock-filter" value="1" {{ request('low_stock') ? 'checked' : '' }}>
                Low Stock Only
            </label>

            <label class="checkbox-label" style="margin-left: 15px;">
                <input type="checkbox" name="out_of_stock" id="out-of-stock-filter" value="1" {{ request('out_of_stock') ? 'checked' : '' }}>
                Out of Stock Only
            </label>

            <button type="submit" class="btn btn-primary">Filter</button>
            <button type="button" id="reset-filters" class="btn btn-outline">Reset</button>
        </form>
    </div>

    <div class="table-container">
        <table class="data-table">
            <thead>
                <tr>
                    @if(auth()->user()->isAdmin())
                        <th><input type="checkbox" id="select-all-checkbox"></th>
                    @endif
                    <th>Image</th>
                    <th>Product Name</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Stock</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="product-table-body">
                @include('admin.products.partials.table-rows')
            </tbody>
        </table>
        
        <div class="pagination-wrapper" style="display: flex; flex-direction: column; align-items: flex-start; margin-top: 20px;">
            {{ $products->links() }}
        </div>
    </div>
</div>

<script>
    // Wait until the entire HTML page is 100% loaded before running any JavaScript
    document.addEventListener('DOMContentLoaded', function() {
        // Live Search with Category and Low Stock Filters
        let searchTimeout = null;
        const searchInput = document.getElementById('search-input');
        const categoryFilter = document.getElementById('category-filter');
        const lowStockFilter = document.getElementById('low-stock-filter');
        const outOfStockFilter = document.getElementById('out-of-stock-filter');
        const resetButton = document.getElementById('reset-filters');
        const bulkDeleteBtn = document.getElementById('bulk-delete-btn');
        const selectAllCheckbox = document.getElementById('select-all-checkbox');
        const tableBody = document.getElementById('product-table-body');

        // Check if elements exist before proceeding
        if (!searchInput || !categoryFilter || !lowStockFilter || !resetButton || !tableBody) {
            console.error('One or more required filter elements not found!');
        }

        // Check for bulk delete button (admin only)
        if (!bulkDeleteBtn) {
            console.log('Bulk delete button not found (expected for non-admin users)');
        }

    function fetchFilteredProducts() {
        let searchQuery = searchInput.value;
        let categoryId = categoryFilter.value;

        // 1. Start with just the search and category in the URL
        let url = `/admin/products?search=${searchQuery}&category=${categoryId}`;

        // 2. ONLY add low_stock to the URL if the box is checked!
        if (lowStockFilter && lowStockFilter.checked) {
            url += `&low_stock=1`;
        }
        
        // 3. ONLY add out_of_stock to the URL if the box is checked!
        if (outOfStockFilter && outOfStockFilter.checked) {
            url += `&out_of_stock=1`;
        }

        // 4. Fetch the data
        fetch(url, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => response.text())
        .then(html => {
            tableBody.innerHTML = html;
        })
        .catch(error => {
            console.error('Filter error:', error);
        });
    }

    // Event Listeners
    if (searchInput) {
        searchInput.addEventListener('input', function() {
            clearTimeout(searchTimeout);
            searchTimeout = setTimeout(fetchFilteredProducts, 300);
        });
    }

    if (categoryFilter) {
        categoryFilter.addEventListener('change', fetchFilteredProducts);
    }

    // Trigger the filter instantly when the checkbox is clicked
    if (lowStockFilter) {
        lowStockFilter.addEventListener('change', fetchFilteredProducts);
    }
    
    // Listen for Out of Stock checkbox clicks
    if (outOfStockFilter) {
        outOfStockFilter.addEventListener('change', fetchFilteredProducts);
    }

    // Reset Button Logic
    if (resetButton) {
        resetButton.addEventListener('click', function(e) {
            // 1. Stops the browser from reloading the page
            e.preventDefault();

            // 2. Clear all the input values visually
            if (searchInput) searchInput.value = '';
            if (categoryFilter) categoryFilter.value = '';
            if (lowStockFilter) {
                lowStockFilter.checked = false;
                // Also remove the 'checked' attribute to ensure it's fully reset
                lowStockFilter.removeAttribute('checked');
            }
            if (outOfStockFilter) {
                outOfStockFilter.checked = false;
                outOfStockFilter.removeAttribute('checked');
            }

            // 3. Fetch the clean, unfiltered data from Laravel immediately
            // Since low_stock is not checked, it won't be added to the URL
            fetchFilteredProducts();
        });
    }

    // "Select All" Checkbox Logic
    if (selectAllCheckbox) {
        selectAllCheckbox.addEventListener('change', function() {
            // Find all checkboxes that belong to product rows
            let rowCheckboxes = document.querySelectorAll('input[name="ids[]"]');
            rowCheckboxes.forEach(checkbox => {
                checkbox.checked = selectAllCheckbox.checked;
            });
        });
    }

    // Bulk Delete Logic
    if (bulkDeleteBtn) {
        bulkDeleteBtn.addEventListener('click', function() {
            // Gather all the IDs from the currently checked boxes
            let selectedIds = Array.from(document.querySelectorAll('input[name="ids[]"]:checked'))
                                   .map(checkbox => checkbox.value);

            if (selectedIds.length === 0) {
                // Use SweetAlert for the error message
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Please select at least one product to delete.',
                    confirmButtonColor: '#00c853'
                });
                return;
            }

            // The beautiful, centered SweetAlert Modal
            Swal.fire({
                title: 'Are you sure?',
                text: `You are about to completely delete ${selectedIds.length} products.`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#ef4444', // Matches your red delete button
                cancelButtonColor: '#64748b',  // Grey cancel button
                confirmButtonText: 'Yes, delete them!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                // This runs if the user clicks the Red "Yes" button
                if (result.isConfirmed) {
                    
                    // Send the IDs to Laravel securely via AJAX POST
                    fetch('/admin/products/bulk-delete', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}', // Laravel security token
                            'X-Requested-With': 'XMLHttpRequest'
                        },
                        body: JSON.stringify({ ids: selectedIds })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            fetchFilteredProducts();
                            selectAllCheckbox.checked = false;
                            
                            // Show a quick success popup!
                            Swal.fire({
                                title: 'Deleted!',
                                text: 'Your products have been deleted.',
                                icon: 'success',
                                timer: 1500, // Closes automatically after 1.5 seconds
                                showConfirmButton: false
                            });
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: 'Something went wrong.',
                            confirmButtonColor: '#ef4444'
                        });
                    });
                }
            });
        });
    }

    // Single Product Delete Confirmation with SweetAlert2
    const deleteForms = document.querySelectorAll('.delete-form');
    
    deleteForms.forEach(form => {
        form.addEventListener('submit', function(e) {
            // Stop the form from submitting immediately
            e.preventDefault();
            
            // Get the product name for a personalized message (optional)
            const row = form.closest('tr');
            const productName = row ? row.querySelector('strong')?.textContent || 'this product' : 'this product';
            
            // Fire the beautiful SweetAlert popup
            Swal.fire({
                title: 'Are you sure?',
                text: `This will move "${productName}" to the trash.`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#ef4444',
                cancelButtonColor: '#64748b',
                confirmButtonText: 'Yes, move to trash!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                // If they clicked Yes, actually submit the form to Laravel
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });
    }); // Close DOMContentLoaded wrapper
</script>
@endsection
