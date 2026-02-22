@extends('layouts.admin')

@section('content')
<div style="padding: 30px; box-sizing: border-box; min-height: 100vh; display: flex; align-items: center; justify-content: center;">
    
    <div class="error-card" style="background: white; border-radius: 20px; padding: 60px 40px; max-width: 550px; width: 90%; box-shadow: 0 20px 60px rgba(0,0,0,0.1); text-align: center;">
        
        {{-- Shield Icon --}}
        <div style="font-size: 100px; line-height: 1; margin-bottom: 30px; animation: bounce 2s infinite;">
            🛡️
        </div>
        
        {{-- Error Code --}}
        <div style="font-size: 24px; font-weight: 900; color: #ef4444; margin-bottom: 10px; letter-spacing: 2px;">
            ERROR 403
        </div>
        
        {{-- Title --}}
        <h1 style="font-size: 32px; font-weight: 900; color: #1e293b; margin: 0 0 20px; line-height: 1.2;">
            Access Denied
        </h1>
        
        {{-- Message --}}
        <p style="color: #64748b; font-size: 16px; line-height: 1.8; margin-bottom: 40px;">
            Oops! It looks like your account does not have the required permissions to view this module. 
            <br>
            <strong style="color: #475569;">If you believe this is a mistake, please contact the SuperAdmin to update your role.</strong>
        </p>
        
        {{-- Action Buttons --}}
        <div style="display: flex; gap: 15px; justify-content: center; flex-wrap: wrap;">
            <a href="{{ route('admin.dashboard') }}" 
               style="background: #3b82f6; color: white; border: none; padding: 14px 30px; border-radius: 10px; font-weight: 700; font-size: 15px; cursor: pointer; transition: all 0.2s; text-decoration: none; display: inline-flex; align-items: center; gap: 8px;"
               onmouseover="this.style.background='#2563eb'; this.style.transform='translateY(-2px)'; this.style.boxShadow='0 6px 20px rgba(59,130,246,0.4)';"
               onmouseout="this.style.background='#3b82f6'; this.style.transform='translateY(0)'; this.style.boxShadow='none';">
                ← Return to Dashboard
            </a>
            
            <a href="javascript:history.back()" 
               style="background: #f1f5f9; color: #64748b; border: 2px solid #e2e8f0; padding: 14px 30px; border-radius: 10px; font-weight: 700; font-size: 15px; cursor: pointer; transition: all 0.2s; text-decoration: none; display: inline-flex; align-items: center; gap: 8px;"
               onmouseover="this.style.background='#e2e8f0'; this.style.borderColor='#cbd5e1';"
               onmouseout="this.style.background='#f1f5f9'; this.style.borderColor='#e2e8f0';">
                Go Back
            </a>
        </div>
        
        {{-- Help Text --}}
        <div style="margin-top: 40px; padding-top: 30px; border-top: 2px solid #f1f5f9;">
            <p style="font-size: 13px; color: #94a3b8; margin: 0;">
                Need help? Contact your system administrator.
            </p>
        </div>
        
    </div>
</div>

<style>
    @keyframes bounce {
        0%, 20%, 50%, 80%, 100% {
            transform: translateY(0);
        }
        40% {
            transform: translateY(-20px);
        }
        60% {
            transform: translateY(-10px);
        }
    }
</style>
@endsection
