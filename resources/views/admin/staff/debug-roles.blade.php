@extends('layouts.admin')

@section('content')
<div style="padding: 30px; max-width: 1200px; margin: 0 auto;">
    <h2 style="font-weight: 800; color: #1e293b; margin-bottom: 20px;">🔍 Role Debug Page</h2>
    
    <div style="background: white; border-radius: 12px; padding: 20px; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
        <h3 style="margin-bottom: 15px; color: #1e293b;">All Users & Their Roles</h3>
        
        <table style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr style="background: #f8fafc; border-bottom: 2px solid #e2e8f0;">
                    <th style="padding: 12px; text-align: left; color: #64748b; font-size: 13px; font-weight: 700;">ID</th>
                    <th style="padding: 12px; text-align: left; color: #64748b; font-size: 13px; font-weight: 700;">Name</th>
                    <th style="padding: 12px; text-align: left; color: #64748b; font-size: 13px; font-weight: 700;">Email</th>
                    <th style="padding: 12px; text-align: left; color: #64748b; font-size: 13px; font-weight: 700;">Role (Raw)</th>
                    <th style="padding: 12px; text-align: left; color: #64748b; font-size: 13px; font-weight: 700;">Role (Trimmed)</th>
                    <th style="padding: 12px; text-align: left; color: #64748b; font-size: 13px; font-weight: 700;">Badge Preview</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    @php
                        $rawRole = $user->role ?? 'NULL';
                        $trimmedRole = trim(strtolower($rawRole));
                    @endphp
                    <tr style="border-bottom: 1px solid #f1f5f9;">
                        <td style="padding: 12px; color: #475569;">{{ $user->id }}</td>
                        <td style="padding: 12px; color: #1e293b; font-weight: 600;">{{ $user->name }}</td>
                        <td style="padding: 12px; color: #64748b;">{{ $user->email }}</td>
                        <td style="padding: 12px;">
                            <code style="background: #f1f5f9; padding: 4px 8px; border-radius: 4px; font-size: 12px;">
                                "{{ $rawRole }}" ({{ strlen($rawRole) }} chars)
                            </code>
                        </td>
                        <td style="padding: 12px;">
                            <code style="background: #e0f2fe; padding: 4px 8px; border-radius: 4px; font-size: 12px;">
                                "{{ $trimmedRole }}"
                            </code>
                        </td>
                        <td style="padding: 12px;">
                            @php
                                $roleColors = [
                                    'admin' => '#7c3aed',
                                    'super_user' => '#dc2626',
                                    'staff' => '#2563eb',
                                    'driver' => '#ea580c'
                                ];
                                $roleIcons = [
                                    'admin' => '👑',
                                    'super_user' => '🔥',
                                    'staff' => '🏬',
                                    'driver' => '🚚'
                                ];
                                $badgeColor = $roleColors[$trimmedRole] ?? '#64748b';
                                $badgeIcon = $roleIcons[$trimmedRole] ?? '👤';
                            @endphp
                            <span style="background: {{ $badgeColor }}; color: white; padding: 4px 12px; border-radius: 12px; font-size: 11px; font-weight: 700; display: inline-flex; align-items: center; gap: 4px;">
                                {{ $badgeIcon }} {{ ucfirst($trimmedRole) }}
                            </span>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    
    <div style="margin-top: 30px; background: #fef3c7; border: 2px solid #f59e0b; border-radius: 12px; padding: 20px;">
        <h4 style="margin: 0 0 10px; color: #92400e; font-weight: 700;">💡 How to Use This Page</h4>
        <ul style="margin: 0; padding-left: 20px; color: #78350f; line-height: 1.8;">
            <li>Check if the <strong>"Role (Raw)"</strong> column has any unexpected whitespace or casing.</li>
            <li>The <strong>"Role (Trimmed)"</strong> shows what the badge logic uses after normalization.</li>
            <li>If roles look correct but badges still don't show, clear the view cache: <code style="background: white; padding: 2px 6px; border-radius: 4px;">php artisan view:clear</code></li>
            <li>Return to <a href="{{ route('admin.staff.index') }}" style="color: #0284c7; font-weight: 600;">Staff List</a></li>
        </ul>
    </div>
</div>
@endsection
