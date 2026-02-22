@extends('layouts.admin')

@section('title', 'Create Coupon - Admin')

@section('content')
<div style="padding: 24px; max-width: 700px; margin: 0 auto;">
    
    <!-- Header -->
    <div style="margin-bottom: 24px;">
        <a href="{{ route('admin.coupons.index') }}" style="text-decoration: none; color: #64748b; font-weight: 600; font-size: 14px; display: inline-flex; align-items: center; gap: 6px; transition: color 0.2s;" onmouseover="this.style.color='#10b981'" onmouseout="this.style.color='#64748b'">
            <svg style="width: 16px; height: 16px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
            Back to Coupons
        </a>
        <h2 style="font-weight: 800; color: #1e293b; margin: 8px 0 0 0; font-size: 24px;">✨ Create Promo Code</h2>
        <p style="color: #64748b; margin: 4px 0 0 0; font-size: 14px;">Set up a new discount code for your marketing campaigns.</p>
    </div>

    <!-- Flash Messages -->
    @if($errors->any())
        <div style="background: #fef2f2; border: 1px solid #ef4444; color: #991b1b; padding: 16px 20px; border-radius: 10px; margin-bottom: 20px;">
            <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 8px;">
                <svg style="width: 20px; height: 20px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <strong>Please fix the following errors:</strong>
            </div>
            <ul style="margin: 0; padding-left: 32px; font-size: 14px;">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Form -->
    <form action="{{ route('admin.coupons.store') }}" method="POST" style="background: white; border-radius: 16px; padding: 30px; border: 1px solid #f1f5f9; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05);">
        @csrf

        <!-- Coupon Code -->
        <div style="margin-bottom: 24px;">
            <label style="display: block; font-weight: 800; color: #475569; margin-bottom: 8px; font-size: 12px; text-transform: uppercase; letter-spacing: 0.5px;">
                Coupon Code <span style="color: #ef4444;">*</span>
            </label>
            <input type="text" name="code" value="{{ old('code') }}" placeholder="e.g. SUMMER20" required 
                   style="width: 100%; padding: 14px 16px; border-radius: 10px; border: 1px solid #cbd5e1; outline: none; box-sizing: border-box; text-transform: uppercase; font-weight: 700; font-size: 16px; font-family: monospace; letter-spacing: 1px; transition: border-color 0.2s, box-shadow 0.2s;"
                   onfocus="this.style.borderColor='#10b981'; this.style.boxShadow='0 0 0 3px rgba(16,185,129,0.1)';"
                   onblur="this.style.borderColor='#cbd5e1'; this.style.boxShadow='none';">
            <p style="color: #94a3b8; font-size: 12px; margin-top: 6px;">The code will be automatically converted to uppercase.</p>
        </div>

        <!-- Discount Type and Value -->
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 24px;">
            <div>
                <label style="display: block; font-weight: 800; color: #475569; margin-bottom: 8px; font-size: 12px; text-transform: uppercase; letter-spacing: 0.5px;">
                    Discount Type <span style="color: #ef4444;">*</span>
                </label>
                <select name="type" required 
                        style="width: 100%; padding: 14px 16px; border-radius: 10px; border: 1px solid #cbd5e1; outline: none; box-sizing: border-box; background: white; font-size: 14px; font-weight: 600; transition: border-color 0.2s, box-shadow 0.2s;"
                        onfocus="this.style.borderColor='#10b981'; this.style.boxShadow='0 0 0 3px rgba(16,185,129,0.1)';"
                        onblur="this.style.borderColor='#cbd5e1'; this.style.boxShadow='none';">
                    <option value="fixed" {{ old('type') === 'fixed' ? 'selected' : '' }}>Fixed Amount ($)</option>
                    <option value="percent" {{ old('type') === 'percent' ? 'selected' : '' }}>Percentage (%)</option>
                </select>
            </div>
            
            <div>
                <label style="display: block; font-weight: 800; color: #475569; margin-bottom: 8px; font-size: 12px; text-transform: uppercase; letter-spacing: 0.5px;">
                    Discount Value <span style="color: #ef4444;">*</span>
                </label>
                <input type="number" name="value" step="0.01" min="0" max="999999.99" value="{{ old('value') }}" 
                       placeholder="e.g. 10.00" required 
                       style="width: 100%; padding: 14px 16px; border-radius: 10px; border: 1px solid #cbd5e1; outline: none; box-sizing: border-box; font-size: 16px; font-weight: 600; transition: border-color 0.2s, box-shadow 0.2s;"
                       onfocus="this.style.borderColor='#10b981'; this.style.boxShadow='0 0 0 3px rgba(16,185,129,0.1)';"
                       onblur="this.style.borderColor='#cbd5e1'; this.style.boxShadow='none';">
            </div>
        </div>

        <!-- Minimum Purchase -->
        <div style="margin-bottom: 24px;">
            <label style="display: block; font-weight: 800; color: #475569; margin-bottom: 8px; font-size: 12px; text-transform: uppercase; letter-spacing: 0.5px;">
                Minimum Purchase Required
            </label>
            <input type="number" name="min_purchase" step="0.01" min="0" max="999999.99" value="{{ old('min_purchase', 0) }}" 
                   placeholder="e.g. 50.00 (leave 0 for no minimum)" 
                   style="width: 100%; padding: 14px 16px; border-radius: 10px; border: 1px solid #cbd5e1; outline: none; box-sizing: border-box; font-size: 16px; font-weight: 600; transition: border-color 0.2s, box-shadow 0.2s;"
                   onfocus="this.style.borderColor='#10b981'; this.style.boxShadow='0 0 0 3px rgba(16,185,129,0.1)';"
                   onblur="this.style.borderColor='#cbd5e1'; this.style.boxShadow='none';">
            <p style="color: #94a3b8; font-size: 12px; margin-top: 6px;">Customers must spend at least this amount to use the coupon.</p>
        </div>

        <!-- Expiration Date -->
        <div style="margin-bottom: 24px;">
            <label style="display: block; font-weight: 800; color: #475569; margin-bottom: 8px; font-size: 12px; text-transform: uppercase; letter-spacing: 0.5px;">
                Expiration Date
            </label>
            <input type="date" name="expires_at" value="{{ old('expires_at') }}" 
                   style="width: 100%; padding: 14px 16px; border-radius: 10px; border: 1px solid #cbd5e1; outline: none; box-sizing: border-box; font-size: 16px; font-weight: 600; transition: border-color 0.2s, box-shadow 0.2s;"
                   onfocus="this.style.borderColor='#10b981'; this.style.boxShadow='0 0 0 3px rgba(16,185,129,0.1)';"
                   onblur="this.style.borderColor='#cbd5e1'; this.style.boxShadow='none';">
            <p style="color: #94a3b8; font-size: 12px; margin-top: 6px;">Leave empty for coupons that never expire.</p>
        </div>

        <!-- Status -->
        <div style="margin-bottom: 30px;">
            <label style="display: block; font-weight: 800; color: #475569; margin-bottom: 8px; font-size: 12px; text-transform: uppercase; letter-spacing: 0.5px;">
                Status <span style="color: #ef4444;">*</span>
            </label>
            <select name="status" required 
                    style="width: 100%; padding: 14px 16px; border-radius: 10px; border: 1px solid #cbd5e1; outline: none; box-sizing: border-box; background: white; font-size: 14px; font-weight: 600; transition: border-color 0.2s, box-shadow 0.2s;"
                    onfocus="this.style.borderColor='#10b981'; this.style.boxShadow='0 0 0 3px rgba(16,185,129,0.1)';"
                    onblur="this.style.borderColor='#cbd5e1'; this.style.boxShadow='none';">
                <option value="1" {{ old('status', 1) == 1 ? 'selected' : '' }}>Active (Customers can use it)</option>
                <option value="0" {{ old('status') == 0 ? 'selected' : '' }}>Disabled (Turned off)</option>
            </select>
        </div>

        <!-- Submit Button -->
        <button type="submit" style="width: 100%; background: linear-gradient(135deg, #10b981 0%, #059669 100%); color: white; border: none; padding: 16px; border-radius: 12px; font-size: 16px; font-weight: 800; cursor: pointer; transition: all 0.3s; box-shadow: 0 4px 6px -1px rgba(16, 185, 129, 0.3);"
                onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 10px 15px -3px rgba(16, 185, 129, 0.4)';"
                onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 6px -1px rgba(16, 185, 129, 0.3)';">
            <span style="display: flex; align-items: center; justify-content: center; gap: 10px;">
                <svg style="width: 20px; height: 20px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
                Save Coupon Code
            </span>
        </button>
    </form>
</div>
@endsection
