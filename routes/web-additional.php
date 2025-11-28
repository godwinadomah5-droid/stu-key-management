// Add this to the existing web routes if not present
Route::get('/reports/staff-activity', [ReportController::class, 'staffActivity'])->name('reports.staff-activity');
