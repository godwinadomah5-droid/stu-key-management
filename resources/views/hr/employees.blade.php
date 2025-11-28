<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Directory - KeySecure</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .fade-in {
            animation: fadeIn 0.5s ease-in;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .progress-bar {
            transition: width 0.3s ease;
        }
        .employee-card {
            transition: all 0.3s ease;
        }
        .employee-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(0,0,0,0.1);
        }
        .dark .employee-card:hover {
            box-shadow: 0 8px 20px rgba(0,0,0,0.3);
        }
    </style>
</head>
<body class="bg-gray-50 dark:bg-gray-900">
    <nav class="bg-white dark:bg-gray-800 shadow-sm border-b border-gray-200 dark:border-gray-700">
        <div class="px-6 py-4">
            <div class="flex justify-between items-center">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-gradient-to-r from-red-500 to-red-700 rounded-xl flex items-center justify-center">
                        <i class="fas fa-users text-white text-lg"></i>
                    </div>
                    <div>
                        <h1 class="text-xl font-bold text-gray-800 dark:text-white">KeySecure</h1>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Employee Directory</p>
                    </div>
                </div>
                <a href="/hr/dashboard" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg transition-colors">
                    <i class="fas fa-arrow-left mr-2"></i>Back to Dashboard
                </a>
            </div>
        </div>
    </nav>

    <main class="container mx-auto p-6">
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 p-8">
            <div class="text-center">
                <div class="w-20 h-20 bg-green-100 dark:bg-green-900 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-users text-green-600 dark:text-green-400 text-2xl"></i>
                </div>
                <h1 class="text-3xl font-bold text-gray-800 dark:text-white mb-2">Employee Directory</h1>
                <p class="text-gray-600 dark:text-gray-400 mb-6">Manage and view all employee information</p>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                    <div class="bg-blue-50 dark:bg-blue-900/20 p-4 rounded-lg">
                        <p class="text-2xl font-bold text-blue-600 dark:text-blue-400">247</p>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Total Employees</p>
                    </div>
                    <div class="bg-green-50 dark:bg-green-900/20 p-4 rounded-lg">
                        <p class="text-2xl font-bold text-green-600 dark:text-green-400">231</p>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Active Today</p>
                    </div>
                    <div class="bg-purple-50 dark:bg-purple-900/20 p-4 rounded-lg">
                        <p class="text-2xl font-bold text-purple-600 dark:text-purple-400">6</p>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Departments</p>
                    </div>
                </div>

                <!-- Search and Export Section -->
                <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-6 mb-8">
                    <p class="text-gray-600 dark:text-gray-400 mb-4">Search employees and export directory data</p>
                    
                    <!-- Search Form -->
                    <div class="mb-6">
                        <div class="flex flex-col md:flex-row gap-4 justify-center items-center">
                            <div class="relative w-full md:w-64">
                                <input type="text" id="searchInput" placeholder="Search employees by name, department, or ID..." 
                                       class="w-full bg-white dark:bg-gray-600 border border-gray-300 dark:border-gray-500 rounded-lg px-4 py-2 pl-10 focus:ring-2 focus:ring-green-500 focus:border-green-500">
                                <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                            </div>
                            <select id="departmentFilter" class="w-full md:w-48 bg-white dark:bg-gray-600 border border-gray-300 dark:border-gray-500 rounded-lg px-4 py-2 focus:ring-2 focus:ring-green-500 focus:border-green-500">
                                <option value="">All Departments</option>
                                <option value="it">IT Department</option>
                                <option value="admin">Administration</option>
                                <option value="academic">Academic Staff</option>
                                <option value="support">Support Staff</option>
                                <option value="finance">Finance</option>
                                <option value="marketing">Marketing</option>
                            </select>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex flex-col sm:flex-row justify-center space-y-4 sm:space-y-0 sm:space-x-4">
                        <button id="searchEmployeesBtn" class="bg-green-500 hover:bg-green-600 text-white px-8 py-3 rounded-lg transition-colors font-semibold flex items-center justify-center">
                            <i class="fas fa-search mr-2"></i>Search Employees
                        </button>
                        <button id="exportDirectoryBtn" class="bg-blue-500 hover:bg-blue-600 text-white px-8 py-3 rounded-lg transition-colors font-semibold flex items-center justify-center">
                            <i class="fas fa-download mr-2"></i>Export Directory
                        </button>
                    </div>
                </div>

                <!-- Progress Bar (Hidden by default) -->
                <div id="progressSection" class="hidden fade-in mb-6">
                    <div class="bg-white dark:bg-gray-600 rounded-lg p-4">
                        <div class="flex justify-between items-center mb-2">
                            <span id="progressText" class="text-sm font-medium text-gray-700 dark:text-gray-300">Processing...</span>
                            <span id="progressPercent" class="text-sm font-medium text-gray-700 dark:text-gray-300">0%</span>
                        </div>
                        <div class="w-full bg-gray-200 dark:bg-gray-500 rounded-full h-2">
                            <div id="progressBar" class="progress-bar bg-green-500 h-2 rounded-full" style="width: 0%"></div>
                        </div>
                    </div>
                </div>

                <!-- Success Message (Hidden by default) -->
                <div id="successMessage" class="hidden fade-in bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 rounded-lg p-4 mb-6">
                    <div class="flex items-center">
                        <i class="fas fa-check-circle text-green-500 text-xl mr-3"></i>
                        <div>
                            <h4 class="font-semibold text-green-800 dark:text-green-300" id="successTitle">Success!</h4>
                            <p id="successDetails" class="text-sm text-green-600 dark:text-green-400">Operation completed successfully.</p>
                        </div>
                        <button id="actionButton" class="ml-auto bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg text-sm transition-colors">
                            <i class="fas fa-download mr-1"></i>Download
                        </button>
                    </div>
                </div>

                <!-- Search Results Section -->
                <div id="searchResults" class="hidden fade-in">
                    <h3 class="text-xl font-semibold text-gray-800 dark:text-white mb-4">Search Results</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mb-6">
                        <!-- Sample Employee Cards -->
                        <div class="employee-card bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg p-4">
                            <div class="flex items-center space-x-3">
                                <div class="w-12 h-12 bg-blue-500 rounded-full flex items-center justify-center text-white font-semibold">
                                    JD
                                </div>
                                <div class="flex-1">
                                    <h4 class="font-semibold text-gray-800 dark:text-white">John Doe</h4>
                                    <p class="text-sm text-gray-600 dark:text-gray-400">Software Engineer</p>
                                    <p class="text-xs text-blue-500">IT Department</p>
                                </div>
                            </div>
                        </div>
                        <div class="employee-card bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg p-4">
                            <div class="flex items-center space-x-3">
                                <div class="w-12 h-12 bg-green-500 rounded-full flex items-center justify-center text-white font-semibold">
                                    SW
                                </div>
                                <div class="flex-1">
                                    <h4 class="font-semibold text-gray-800 dark:text-white">Sarah Wilson</h4>
                                    <p class="text-sm text-gray-600 dark:text-gray-400">HR Manager</p>
                                    <p class="text-xs text-green-500">Administration</p>
                                </div>
                            </div>
                        </div>
                        <div class="employee-card bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg p-4">
                            <div class="flex items-center space-x-3">
                                <div class="w-12 h-12 bg-purple-500 rounded-full flex items-center justify-center text-white font-semibold">
                                    MB
                                </div>
                                <div class="flex-1">
                                    <h4 class="font-semibold text-gray-800 dark:text-white">Michael Brown</h4>
                                    <p class="text-sm text-gray-600 dark:text-gray-400">Professor</p>
                                    <p class="text-xs text-purple-500">Academic Staff</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mt-8">
                    <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg p-4 text-center">
                        <i class="fas fa-user-plus text-blue-500 text-xl mb-2"></i>
                        <h4 class="font-semibold text-gray-800 dark:text-white">Add Employee</h4>
                        <p class="text-sm text-gray-600 dark:text-gray-400">New hire</p>
                        <button class="mt-2 bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg text-sm transition-colors w-full">
                            <i class="fas fa-plus mr-1"></i>Add New
                        </button>
                    </div>
                    <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg p-4 text-center">
                        <i class="fas fa-sync-alt text-green-500 text-xl mb-2"></i>
                        <h4 class="font-semibold text-gray-800 dark:text-white">Sync Data</h4>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Update records</p>
                        <button class="mt-2 bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg text-sm transition-colors w-full">
                            <i class="fas fa-sync mr-1"></i>Sync Now
                        </button>
                    </div>
                    <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg p-4 text-center">
                        <i class="fas fa-chart-bar text-purple-500 text-xl mb-2"></i>
                        <h4 class="font-semibold text-gray-800 dark:text-white">Reports</h4>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Generate reports</p>
                        <button class="mt-2 bg-purple-500 hover:bg-purple-600 text-white px-4 py-2 rounded-lg text-sm transition-colors w-full">
                            <i class="fas fa-chart-pie mr-1"></i>View Reports
                        </button>
                    </div>
                    <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg p-4 text-center">
                        <i class="fas fa-cog text-orange-500 text-xl mb-2"></i>
                        <h4 class="font-semibold text-gray-800 dark:text-white">Settings</h4>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Directory settings</p>
                        <button class="mt-2 bg-orange-500 hover:bg-orange-600 text-white px-4 py-2 rounded-lg text-sm transition-colors w-full">
                            <i class="fas fa-cog mr-1"></i>Configure
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script>
        // Search Employees Button
        document.getElementById('searchEmployeesBtn').addEventListener('click', function() {
            const searchTerm = document.getElementById('searchInput').value.trim();
            const department = document.getElementById('departmentFilter').value;

            // Show progress
            const progressSection = document.getElementById('progressSection');
            const progressBar = document.getElementById('progressBar');
            const progressText = document.getElementById('progressText');
            const progressPercent = document.getElementById('progressPercent');
            
            progressSection.classList.remove('hidden');
            progressText.textContent = 'Searching employees...';
            
            // Simulate search progress
            let progress = 0;
            const interval = setInterval(() => {
                progress += Math.random() * 20;
                if (progress >= 100) {
                    progress = 100;
                    clearInterval(interval);
                    
                    // Show search results
                    setTimeout(() => {
                        const searchResults = document.getElementById('searchResults');
                        const successMessage = document.getElementById('successMessage');
                        const successTitle = document.getElementById('successTitle');
                        const successDetails = document.getElementById('successDetails');
                        const actionButton = document.getElementById('actionButton');
                        
                        // Show search results
                        searchResults.classList.remove('hidden');
                        
                        // Show success message
                        let searchDescription = 'All employees';
                        if (searchTerm) searchDescription += ` matching "${searchTerm}"`;
                        if (department) searchDescription += ` in ${document.getElementById('departmentFilter').options[document.getElementById('departmentFilter').selectedIndex].text}`;
                        
                        successTitle.textContent = 'Search Completed';
                        successDetails.textContent = `Found 247 employees${searchTerm ? ` matching "${searchTerm}"` : ''}${department ? ` in ${document.getElementById('departmentFilter').options[document.getElementById('departmentFilter').selectedIndex].text}` : ''}.`;
                        successMessage.classList.remove('hidden');
                        
                        // Update action button for search results
                        actionButton.innerHTML = '<i class="fas fa-download mr-1"></i>Export Results';
                        actionButton.onclick = function() {
                            simulateExport('search_results');
                        };
                        
                        // Auto-hide success message after 6 seconds
                        setTimeout(() => {
                            successMessage.classList.add('hidden');
                        }, 6000);
                    }, 500);
                }
                
                progressBar.style.width = `${progress}%`;
                progressPercent.textContent = `${Math.round(progress)}%`;
            }, 150);
        });

        // Export Directory Button
        document.getElementById('exportDirectoryBtn').addEventListener('click', function() {
            const department = document.getElementById('departmentFilter').value;
            const searchTerm = document.getElementById('searchInput').value.trim();

            // Show progress
            const progressSection = document.getElementById('progressSection');
            const progressBar = document.getElementById('progressBar');
            const progressText = document.getElementById('progressText');
            const progressPercent = document.getElementById('progressPercent');
            
            progressSection.classList.remove('hidden');
            progressText.textContent = 'Preparing directory export...';
            
            // Simulate export progress
            let progress = 0;
            const interval = setInterval(() => {
                progress += Math.random() * 15;
                if (progress >= 100) {
                    progress = 100;
                    clearInterval(interval);
                    
                    // Show success message
                    setTimeout(() => {
                        const successMessage = document.getElementById('successMessage');
                        const successTitle = document.getElementById('successTitle');
                        const successDetails = document.getElementById('successDetails');
                        const actionButton = document.getElementById('actionButton');
                        
                        let exportDescription = 'Complete employee directory';
                        if (department) exportDescription += ` for ${document.getElementById('departmentFilter').options[document.getElementById('departmentFilter').selectedIndex].text}`;
                        if (searchTerm) exportDescription += ` filtered by "${searchTerm}"`;
                        
                        successTitle.textContent = 'Export Ready';
                        successDetails.textContent = `${exportDescription} has been prepared for download.`;
                        successMessage.classList.remove('hidden');
                        
                        // Update action button for download
                        actionButton.innerHTML = '<i class="fas fa-download mr-1"></i>Download Now';
                        actionButton.onclick = function() {
                            simulateExport('employee_directory');
                        };
                        
                        // Auto-hide success message after 6 seconds
                        setTimeout(() => {
                            successMessage.classList.add('hidden');
                        }, 6000);
                    }, 500);
                }
                
                progressBar.style.width = `${progress}%`;
                progressPercent.textContent = `${Math.round(progress)}%`;
            }, 200);
        });

        // Simulate file export/download
        function simulateExport(type) {
            const department = document.getElementById('departmentFilter').value;
            const searchTerm = document.getElementById('searchInput').value.trim();
            
            let filename = `${type}_${new Date().toISOString().split('T')[0]}`;
            if (department) filename += `_${department}`;
            if (searchTerm) filename += `_${searchTerm.replace(/\s+/g, '_')}`;
            filename += '.xlsx';
            
            // Create a temporary link to simulate download
            const link = document.createElement('a');
            link.href = '#'; // In a real app, this would be the actual file URL
            link.download = filename;
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
            
            // Show download confirmation
            console.log(`Exporting: ${filename}`);
            
            // Show quick confirmation
            const successMessage = document.getElementById('successMessage');
            const successTitle = document.getElementById('successTitle');
            const successDetails = document.getElementById('successDetails');
            const actionButton = document.getElementById('actionButton');
            
            successTitle.textContent = 'Download Started';
            successDetails.textContent = `Your ${type.replace('_', ' ')} is being downloaded as ${filename}`;
            actionButton.style.display = 'none';
            
            // Auto-hide after 3 seconds
            setTimeout(() => {
                successMessage.classList.add('hidden');
                actionButton.style.display = 'block';
            }, 3000);
        }

        // Add Enter key support for search
        document.getElementById('searchInput').addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                document.getElementById('searchEmployeesBtn').click();
            }
        });

        // Add quick action button functionality
        document.addEventListener('DOMContentLoaded', function() {
            const quickActionButtons = document.querySelectorAll('.bg-blue-500, .bg-green-500, .bg-purple-500, .bg-orange-500');
            quickActionButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const actionText = this.closest('.text-center').querySelector('h4').textContent;
                    alert(`${actionText} functionality is coming soon!`);
                });
            });
        });
    </script>
</body>
</html>