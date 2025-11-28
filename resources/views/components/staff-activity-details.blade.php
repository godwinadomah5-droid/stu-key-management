<div class="text-left">
    <!-- Staff Information -->
    <div class="mb-4 p-4 bg-gray-50 rounded-lg">
        <h4 class="font-medium text-gray-900">{{ $staff->name }}</h4>
        <p class="text-sm text-gray-600">{{ $staff->phone }}</p>
        <p class="text-xs text-gray-500 mt-1">
            Type: 
            @if($holderType === 'hr')
                HR Staff
                @if(isset($staff->dept))
                    • {{ $staff->dept }}
                @endif
            @elseif($holderType === 'perm_manual')
                Permanent Staff (Manual)
                @if(isset($staff->dept))
                    • {{ $staff->dept }}
                @endif
            @else
                Temporary Staff
                @if(isset($staff->id_number))
                    • ID: {{ $staff->id_number }}
                @endif
            @endif
        </p>
    </div>

    <!-- Current Held Keys -->
    <div class="mb-4">
        <h5 class="font-medium text-gray-900 mb-2">Currently Held Keys</h5>
        @if($currentKeys->count() > 0)
            <div class="space-y-2">
                @foreach($currentKeys as $keyLog)
                <div class="flex justify-between items-center p-2 bg-yellow-50 border border-yellow-200 rounded">
                    <div>
                        <span class="font-medium text-sm">{{ $keyLog->key->label }}</span>
                        <span class="text-xs text-gray-500 block">{{ $keyLog->key->location->name }}</span>
                    </div>
                    <span class="text-xs text-yellow-700">
                        Since {{ $keyLog->created_at->format('M j, g:i A') }}
                    </span>
                </div>
                @endforeach
            </div>
        @else
            <p class="text-sm text-gray-500">No keys currently checked out</p>
        @endif
    </div>

    <!-- Recent Activity -->
    <div>
        <h5 class="font-medium text-gray-900 mb-2">Recent Activity</h5>
        @if($recentActivity->count() > 0)
            <div class="space-y-2 max-h-60 overflow-y-auto">
                @foreach($recentActivity as $activity)
                <div class="flex justify-between items-center p-2 border-b border-gray-100">
                    <div>
                        <span class="text-sm {{ $activity->action === 'checkout' ? 'text-green-600' : 'text-blue-600' }}">
                            {{ $activity->action === 'checkout' ? 'Checked out' : 'Checked in' }}
                        </span>
                        <span class="text-xs text-gray-500 block">{{ $activity->key->label }}</span>
                    </div>
                    <span class="text-xs text-gray-500">
                        {{ $activity->created_at->diffForHumans() }}
                    </span>
                </div>
                @endforeach
            </div>
        @else
            <p class="text-sm text-gray-500">No recent activity</p>
        @endif
    </div>
</div>
