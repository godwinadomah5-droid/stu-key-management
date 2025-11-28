<div class="px-4 py-4 border-t border-gray-200 bg-white">
    <div class="flex flex-col sm:flex-row items-center justify-between">
        <div class="text-sm text-gray-700 mb-4 sm:mb-0">
            Showing {{ $logs->firstItem() }} to {{ $logs->lastItem() }} of {{ $logs->total() }} results
        </div>
        
        <!-- Use Laravel's built-in pagination which is more reliable -->
        <div class="flex items-center space-x-2">
            {{ $logs->links() }}
        </div>
    </div>
</div>
