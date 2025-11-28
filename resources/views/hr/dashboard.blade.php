@extends('layouts.app')

@section('title', 'HR Dashboard')

@section('subtitle', 'Staff management and discrepancy resolution')

@section('actions')
<a href="{{ route('hr.import.form') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-xl text-gray-700 bg-white hover:bg-gray-50 transition-colors shadow-sm">
    <i class="fas fa-upload mr-2"></i> Import Staff
</a>
<a href="{{ route('hr.manual-staff.create') }}" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-blue-500 to-blue-600 text-white font-medium rounded-xl shadow-lg hover:from-blue-600 hover:to-blue-700 transition-all transform hover:-translate-y-0.5">
    <i class="fas fa-user-plus mr-2"></i> Add Manual Staff
</a>
@endsection

@section('content')
<div class="space-y-6">
    <!-- Stats Cards Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Total HR Staff -->
        <div class="bg-gradient-to-r from-blue-500 to-blue-600 rounded-2xl shadow-lg overflow-hidden card-hover">
            <div class="p-6 text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-blue-100">Total HR Staff</p>
                        <p class="text-2xl font-bold">{{ $stats['total_hr_staff'] }}</p>
                    </div>
                    <div class="w-12 h-12 bg-white bg-opacity-20 rounded-xl flex items-center justify-center">
                        <i class="fas fa-users text-xl"></i>
                    </div>
                </div>
                <div class="mt-4 flex items-center text-sm text-blue-100">
                    <i class="fas fa-user-check mr-1"></i>
                    <span>{{ $stats['active_hr_staff'] }} active</span>
                </div>
            </div>
        </div>

        <!-- Manual Staff -->
        <div class="bg-gradient-to-r from-orange-500 to-orange-600 rounded-2xl shadow-lg overflow-hidden card-hover">
            <div class="p-6 text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-orange-100">Manual Staff</p>
                        <p class="text-2xl font-bold">{{ $stats['total_manual_staff'] }}</p>
                    </div>
                    <div class="w-12 h-12 bg-white bg-opacity-20 rounded-xl flex items-center justify-center">
                        <i class="fas fa-user-edit text-xl"></i>
                    </div>
                </div>
                <div class="mt-4 flex items-center text-sm text-orange-100">
                    <i class="fas fa-plus-circle mr-1"></i>
                    <span>Manually added</span>
                </div>
            </div>
        </div>

        <!-- Pending Discrepancies -->
        <div class="bg-gradient-to-r from-red-500 to-red-600 rounded-2xl shadow-lg overflow-hidden card-hover">
            <div class="p-6 text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-red-100">Pending Issues</p>
                        <p class="text-2xl font-bold">{{ $stats['pending_discrepancies'] }}</p>
                    </div>
                    <div class="w-12 h-12 bg-white bg-opacity-20 rounded-xl flex items-center justify-center">
                        <i class="fas fa-exclamation-triangle text-xl"></i>
                    </div>
                </div>
                <div class="mt-4 flex items-center text-sm text-red-100">
                    <i class="fas fa-clock mr-1"></i>
                    <span>Requires attention</span>
                </div>
            </div>
        </div>

        <!-- Today's Activity -->
        <div class="bg-gradient-to-r from-green-500 to-green-600 rounded-2xl shadow-lg overflow-hidden card-hover">
            <div class="p-6 text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-green-100">Today's Activity</p>
                        <p class="text-2xl font-bold">{{ $todayActivity ?? 0 }}</p>
                    </div>
                    <div class="w-12 h-12 bg-white bg-opacity-20 rounded-xl flex items-center justify-center">
                        <i class="fas fa-chart-line text-xl"></i>
                    </div>
                </div>
                <div class="mt-4 flex items-center text-sm text-green-100">
                    <i class="fas fa-sync mr-1"></i>
                    <span>Key transactions</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Recent Discrepancies -->
        <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
            <div class="px-6 py-5 border-b border-gray-200">
                <div class="flex items-center justify-between">
                    <h3 class="text-lg font-semibold text-gray-900">Recent Discrepancies</h3>
                    <div class="flex space-x-2">
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-red-100 text-red-800">
                            {{ $stats['pending_discrepancies'] }} Pending
                        </span>
                    </div>
                </div>
            </div>
            <div class="p-6">
                @if($recentDiscrepancies->count() > 0)
                <div class="space-y-4">
                    @foreach($recentDiscrepancies as $discrepancy)
                    <div class="flex items-center space-x-4 p-4 rounded-xl border border-red-200 bg-red-50 hover:bg-red-100 transition-all duration-200 cursor-pointer">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 bg-red-600 rounded-2xl flex items-center justify-center">
                                <i class="fas fa-exclamation text-white"></i>
                            </div>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-semibold text-gray-900">{{ $discrepancy->holder_name }}</p>
                            <p class="text-sm text-gray-600">
                                Key <span class="font-medium">{{ $discrepancy->key->label }}</span> • 
                                {{ $discrepancy->action }}
                            </p>
                            <p class="text-xs text-gray-500 mt-1">
                                {{ $discrepancy->created_at->diffForHumans() }} • {{ $discrepancy->receiver->name }}
                            </p>
                            @if($discrepancy->discrepancy_reason)
                            <p class="text-xs text-red-600 mt-1">{{ $discrepancy->discrepancy_reason }}</p>
                            @endif
                        </div>
                        <div class="flex-shrink-0">
                            <a href="{{ route('hr.discrepancies.index') }}" 
                               class="inline-flex items-center px-4 py-2 bg-red-600 text-white text-sm font-medium rounded-lg hover:bg-red-700 transition-colors">
                                Resolve
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>
                @else
                <div class="text-center py-12">
                    <div class="w-20 h-20 bg-green-100 rounded-2xl flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-check-circle text-3xl text-green-600"></i>
                    </div>
                    <p class="text-gray-500 font-medium">No pending discrepancies</p>
                    <p class="text-sm text-gray-400 mt-1">All transactions are verified</p>
                </div>
                @endif
            </div>
        </div>

        <!-- Recent Manual Additions -->
        <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
            <div class="px-6 py-5 border-b border-gray-200">
                <div class="flex items-center justify-between">
                    <h3 class="text-lg font-semibold text-gray-900">Recent Manual Staff</h3>
                    <a href="{{ route('hr.manual-staff.index') }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                        View All
                    </a>
                </div>
            </div>
            <div class="p-6">
                @if($recentManualAdditions->count() > 0)
                <div class="space-y-4">
                    @foreach($recentManualAdditions as $staff)
                    <div class="flex items-center space-x-4 p-4 rounded-xl border border-orange-200 bg-orange-50 hover:bg-orange-100 transition-all duration-200">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 bg-orange-600 rounded-2xl flex items-center justify-center">
                                <i class="fas fa-user text-white"></i>
                            </div>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-semibold text-gray-900">{{ $staff->name }}</p>
                            <p class="text-sm text-gray-600">{{ $staff->phone }}</p>
                            @if($staff->staff_id)
                            <p class="text-xs text-gray-500">ID: {{ $staff->staff_id }}</p>
                            @endif
                            <p class="text-xs text-gray-400 mt-1">
                                Added by {{ $staff->addedBy->name }} • {{ $staff->created_at->diffForHumans() }}
                            </p>
                        </div>
                    </div>
                    @endforeach
                </div>
                @else
                <div class="text-center py-12">
                    <div class="w-20 h-20 bg-gray-100 rounded-2xl flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-users text-3xl text-gray-400"></i>
                    </div>
                    <p class="text-gray-500 font-medium">No manual staff additions</p>
                    <p class="text-sm text-gray-400 mt-1">Add your first manual staff member</p>
                </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Quick Actions & System Overview -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Quick Actions -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                <div class="px-6 py-5 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900">Quick Actions</h3>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                        <a href="{{ route('hr.staff.index') }}" 
                           class="flex flex-col items-center p-4 rounded-xl bg-blue-50 hover:bg-blue-100 transition-colors group border-2 border-transparent hover:border-blue-300">
                            <div class="w-12 h-12 bg-blue-600 rounded-xl flex items-center justify-center mb-3 group-hover:bg-blue-700 transition-colors">
                                <i class="fas fa-list text-white text-lg"></i>
                            </div>
                            <span class="text-sm font-medium text-gray-900 text-center">View All Staff</span>
                        </a>
                        
                        <a href="{{ route('hr.discrepancies.index') }}" 
                           class="flex flex-col items-center p-4 rounded-xl bg-red-50 hover:bg-red-100 transition-colors group border-2 border-transparent hover:border-red-300">
                            <div class="w-12 h-12 bg-red-600 rounded-xl flex items-center justify-center mb-3 group-hover:bg-red-700 transition-colors">
                                <i class="fas fa-exclamation-triangle text-white text-lg"></i>
                            </div>
                            <span class="text-sm font-medium text-gray-900 text-center">Resolve Issues</span>
                        </a>
                        
                        <a href="{{ route('hr.import.form') }}" 
                           class="flex flex-col items-center p-4 rounded-xl bg-green-50 hover:bg-green-100 transition-colors group border-2 border-transparent hover:border-green-300">
                            <div class="w-12 h-12 bg-green-600 rounded-xl flex items-center justify-center mb-3 group-hover:bg-green-700 transition-colors">
                                <i class="fas fa-file-csv text-white text-lg"></i>
                            </div>
                            <span class="text-sm font-medium text-gray-900 text-center">Import CSV</span>
                        </a>
                        
                        <a href="{{ route('reports.staff-activity') }}" 
                           class="flex flex-col items-center p-4 rounded-xl bg-purple-50 hover:bg-purple-100 transition-colors group border-2 border-transparent hover:border-purple-300">
                            <div class="w-12 h-12 bg-purple-600 rounded-xl flex items-center justify-center mb-3 group-hover:bg-purple-700 transition-colors">
                                <i class="fas fa-chart-bar text-white text-lg"></i>
                            </div>
                            <span class="text-sm font-medium text-gray-900 text-center">Staff Reports</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- System Status -->
        <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
            <div class="px-6 py-5 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900">System Status</h3>
            </div>
            <div class="p-6">
                <div class="space-y-4">
                    <div class="flex items-center justify-between p-3 rounded-xl bg-green-50">
                        <div class="flex items-center space-x-3">
                            <div class="w-8 h-8 bg-green-600 rounded-lg flex items-center justify-center">
                                <i class="fas fa-check text-white text-sm"></i>
                            </div>
                            <span class="text-sm font-medium text-gray-900">HR Sync</span>
                        </div>
                        <span class="text-sm text-green-600 font-medium">Active</span>
                    </div>
                    
                    <div class="flex items-center justify-between p-3 rounded-xl bg-green-50">
                        <div class="flex items-center space-x-3">
                            <div class="w-8 h-8 bg-green-600 rounded-lg flex items-center justify-center">
                                <i class="fas fa-check text-white text-sm"></i>
                            </div>
                            <span class="text-sm font-medium text-gray-900">Database</span>
                        </div>
                        <span class="text-sm text-green-600 font-medium">Online</span>
                    </div>
                    
                    <div class="flex items-center justify-between p-3 rounded-xl bg-blue-50">
                        <div class="flex items-center space-x-3">
                            <div class="w-8 h-8 bg-blue-600 rounded-lg flex items-center justify-center">
                                <i class="fas fa-sync text-white text-sm"></i>
                            </div>
                            <span class="text-sm font-medium text-gray-900">Notifications</span>
                        </div>
                        <span class="text-sm text-blue-600 font-medium">Enabled</span>
                    </div>
                    
                    <div class="flex items-center justify-between p-3 rounded-xl bg-gray-50">
                        <div class="flex items-center space-x-3">
                            <div class="w-8 h-8 bg-gray-600 rounded-lg flex items-center justify-center">
                                <i class="fas fa-shield-alt text-white text-sm"></i>
                            </div>
                            <span class="text-sm font-medium text-gray-900">Security</span>
                        </div>
                        <span class="text-sm text-gray-600 font-medium">Enabled</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .card-hover {
        transition: all 0.3s ease;
    }
    .card-hover:hover {
        transform: translateY(-3px);
        box-shadow: 0 15px 30px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
    }
</style>
@endpush

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Animate stats cards
        const statsCards = document.querySelectorAll('.card-hover');
        statsCards.forEach((card, index) => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(20px)';
            
            setTimeout(() => {
                card.style.transition = 'all 0.5s ease';
                card.style.opacity = '1';
                card.style.transform = 'translateY(0)';
            }, index * 100);
        });

        // Add hover effects to action items
        const actionItems = document.querySelectorAll('.hover\\:bg-red-100, .hover\\:bg-orange-100');
        actionItems.forEach(item => {
            item.addEventListener('mouseenter', function() {
                this.style.transform = 'scale(1.02)';
            });
            item.addEventListener('mouseleave', function() {
                this.style.transform = 'scale(1)';
            });
        });

        // Auto-refresh discrepancies count
        setInterval(() => {
            // You can add AJAX to refresh discrepancy count
            console.log('HR dashboard auto-refresh');
        }, 60000);
    });
</script>
@endpush
