<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Performance Management - KeySecure</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .fade-in {
            animation: fadeIn 0.5s ease-in-out;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .slide-in {
            animation: slideIn 0.3s ease-out;
        }
        
        @keyframes slideIn {
            from { transform: translateX(-10px); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }
        
        .chart-container {
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
        }
        
        .dark .chart-container {
            background: linear-gradient(135deg, #1e293b 0%, #334155 100%);
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
                        <p class="text-sm text-gray-500 dark:text-gray-400">Performance Management</p>
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
                <div class="w-20 h-20 bg-yellow-100 dark:bg-yellow-900 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-chart-line text-yellow-600 dark:text-yellow-400 text-2xl"></i>
                </div>
                <h1 class="text-3xl font-bold text-gray-800 dark:text-white mb-2">Performance Management</h1>
                <p class="text-gray-600 dark:text-gray-400 mb-6">Track and manage employee performance reviews</p>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                    <div class="bg-blue-50 dark:bg-blue-900/20 p-4 rounded-lg">
                        <p class="text-2xl font-bold text-blue-600 dark:text-blue-400">45</p>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Reviews Completed</p>
                    </div>
                    <div class="bg-green-50 dark:bg-green-900/20 p-4 rounded-lg">
                        <p class="text-2xl font-bold text-green-600 dark:text-green-400">32</p>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Exceeds Expectations</p>
                    </div>
                    <div class="bg-orange-50 dark:bg-orange-900/20 p-4 rounded-lg">
                        <p class="text-2xl font-bold text-orange-600 dark:text-orange-400">8</p>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Needs Improvement</p>
                    </div>
                </div>

                <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-6 mb-6">
                    <p class="text-gray-600 dark:text-gray-400 mb-4">Track and manage employee performance reviews</p>
                    <div class="flex flex-col sm:flex-row justify-center space-y-4 sm:space-y-0 sm:space-x-4">
                        <button id="viewReportsBtn" class="bg-yellow-500 hover:bg-yellow-600 text-white px-6 py-2 rounded-lg transition-colors">
                            <i class="fas fa-chart-bar mr-2"></i>View Reports
                        </button>
                        <button id="scheduleReviewsBtn" class="bg-green-500 hover:bg-green-600 text-white px-6 py-2 rounded-lg transition-colors">
                            <i class="fas fa-edit mr-2"></i>Schedule Reviews
                        </button>
                    </div>
                </div>
                
                <!-- Action Result Display Area -->
                <div id="actionResult" class="mt-6 fade-in hidden">
                    <!-- This area will show the result of button actions -->
                </div>
            </div>
        </div>
    </main>

    <script>
        // Function to handle View Reports button click
        document.getElementById('viewReportsBtn').addEventListener('click', function() {
            const resultDiv = document.getElementById('actionResult');
            resultDiv.innerHTML = `
                <div class="bg-yellow-50 dark:bg-yellow-900/20 border border-yellow-200 dark:border-yellow-800 rounded-lg p-4 fade-in">
                    <div class="flex items-center">
                        <i class="fas fa-chart-bar text-yellow-500 text-xl mr-3"></i>
                        <div>
                            <h3 class="font-bold text-yellow-700 dark:text-yellow-300">Performance Reports</h3>
                            <p class="text-yellow-600 dark:text-yellow-400 text-sm">Loading performance analytics...</p>
                        </div>
                    </div>
                </div>
            `;
            resultDiv.classList.remove('hidden');
            
            // Simulate loading reports after a short delay
            setTimeout(() => {
                resultDiv.innerHTML = `
                    <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg p-6 shadow-sm fade-in">
                        <div class="flex justify-between items-center mb-6">
                            <h3 class="text-xl font-bold text-gray-800 dark:text-white">Performance Analytics</h3>
                            <div class="flex space-x-2">
                                <button class="px-3 py-1 bg-blue-100 dark:bg-blue-900 text-blue-700 dark:text-blue-300 rounded-md text-sm">This Month</button>
                                <button class="px-3 py-1 bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-md text-sm">Last Quarter</button>
                                <button class="px-3 py-1 bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-md text-sm">YTD</button>
                            </div>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <!-- Performance Distribution Chart -->
                            <div class="chart-container p-4 rounded-lg">
                                <h4 class="font-semibold text-gray-800 dark:text-white mb-4">Performance Distribution</h4>
                                <div class="space-y-3">
                                    <div class="flex items-center justify-between">
                                        <span class="text-sm text-gray-600 dark:text-gray-400">Exceeds Expectations</span>
                                        <div class="w-32 bg-gray-200 dark:bg-gray-700 rounded-full h-2.5">
                                            <div class="bg-green-500 h-2.5 rounded-full" style="width: 65%"></div>
                                        </div>
                                        <span class="text-sm font-medium text-gray-800 dark:text-white">65%</span>
                                    </div>
                                    <div class="flex items-center justify-between">
                                        <span class="text-sm text-gray-600 dark:text-gray-400">Meets Expectations</span>
                                        <div class="w-32 bg-gray-200 dark:bg-gray-700 rounded-full h-2.5">
                                            <div class="bg-blue-500 h-2.5 rounded-full" style="width: 25%"></div>
                                        </div>
                                        <span class="text-sm font-medium text-gray-800 dark:text-white">25%</span>
                                    </div>
                                    <div class="flex items-center justify-between">
                                        <span class="text-sm text-gray-600 dark:text-gray-400">Needs Improvement</span>
                                        <div class="w-32 bg-gray-200 dark:bg-gray-700 rounded-full h-2.5">
                                            <div class="bg-orange-500 h-2.5 rounded-full" style="width: 10%"></div>
                                        </div>
                                        <span class="text-sm font-medium text-gray-800 dark:text-white">10%</span>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Department Performance -->
                            <div class="chart-container p-4 rounded-lg">
                                <h4 class="font-semibold text-gray-800 dark:text-white mb-4">Department Performance</h4>
                                <div class="space-y-3">
                                    <div class="flex items-center justify-between">
                                        <span class="text-sm text-gray-600 dark:text-gray-400">Engineering</span>
                                        <div class="w-32 bg-gray-200 dark:bg-gray-700 rounded-full h-2.5">
                                            <div class="bg-green-500 h-2.5 rounded-full" style="width: 85%"></div>
                                        </div>
                                        <span class="text-sm font-medium text-gray-800 dark:text-white">4.2/5</span>
                                    </div>
                                    <div class="flex items-center justify-between">
                                        <span class="text-sm text-gray-600 dark:text-gray-400">Sales</span>
                                        <div class="w-32 bg-gray-200 dark:bg-gray-700 rounded-full h-2.5">
                                            <div class="bg-blue-500 h-2.5 rounded-full" style="width: 70%"></div>
                                        </div>
                                        <span class="text-sm font-medium text-gray-800 dark:text-white">3.5/5</span>
                                    </div>
                                    <div class="flex items-center justify-between">
                                        <span class="text-sm text-gray-600 dark:text-gray-400">Marketing</span>
                                        <div class="w-32 bg-gray-200 dark:bg-gray-700 rounded-full h-2.5">
                                            <div class="bg-blue-500 h-2.5 rounded-full" style="width: 75%"></div>
                                        </div>
                                        <span class="text-sm font-medium text-gray-800 dark:text-white">3.8/5</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Top Performers Table -->
                        <div class="overflow-x-auto">
                            <h4 class="font-semibold text-gray-800 dark:text-white mb-4">Top Performers</h4>
                            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                    <tr>
                                        <th class="px-4 py-3">Employee</th>
                                        <th class="px-4 py-3">Department</th>
                                        <th class="px-4 py-3">Rating</th>
                                        <th class="px-4 py-3">Last Review</th>
                                        <th class="px-4 py-3">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 slide-in">
                                        <td class="px-4 py-3 font-medium text-gray-900 dark:text-white">Sarah Johnson</td>
                                        <td class="px-4 py-3">Engineering</td>
                                        <td class="px-4 py-3">
                                            <div class="flex items-center">
                                                <span class="bg-green-100 text-green-800 text-xs px-2 py-1 rounded-full mr-2">4.8</span>
                                                <span class="text-green-600 dark:text-green-400">Excellent</span>
                                            </div>
                                        </td>
                                        <td class="px-4 py-3">Jun 15, 2023</td>
                                        <td class="px-4 py-3">
                                            <button class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300 mr-2">View</button>
                                            <button class="text-green-600 hover:text-green-800 dark:text-green-400 dark:hover:text-green-300">Schedule</button>
                                        </td>
                                    </tr>
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 slide-in">
                                        <td class="px-4 py-3 font-medium text-gray-900 dark:text-white">Michael Brown</td>
                                        <td class="px-4 py-3">Sales</td>
                                        <td class="px-4 py-3">
                                            <div class="flex items-center">
                                                <span class="bg-green-100 text-green-800 text-xs px-2 py-1 rounded-full mr-2">4.6</span>
                                                <span class="text-green-600 dark:text-green-400">Excellent</span>
                                            </div>
                                        </td>
                                        <td class="px-4 py-3">Jun 10, 2023</td>
                                        <td class="px-4 py-3">
                                            <button class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300 mr-2">View</button>
                                            <button class="text-green-600 hover:text-green-800 dark:text-green-400 dark:hover:text-green-300">Schedule</button>
                                        </td>
                                    </tr>
                                    <tr class="bg-white dark:bg-gray-800 slide-in">
                                        <td class="px-4 py-3 font-medium text-gray-900 dark:text-white">Emily Davis</td>
                                        <td class="px-4 py-3">Marketing</td>
                                        <td class="px-4 py-3">
                                            <div class="flex items-center">
                                                <span class="bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded-full mr-2">4.4</span>
                                                <span class="text-blue-600 dark:text-blue-400">Good</span>
                                            </div>
                                        </td>
                                        <td class="px-4 py-3">Jun 5, 2023</td>
                                        <td class="px-4 py-3">
                                            <button class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300 mr-2">View</button>
                                            <button class="text-green-600 hover:text-green-800 dark:text-green-400 dark:hover:text-green-300">Schedule</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                `;
                
                // Add functionality to time period buttons
                const periodButtons = resultDiv.querySelectorAll('button.bg-gray-100');
                periodButtons.forEach(button => {
                    button.addEventListener('click', function() {
                        // Remove active class from all buttons
                        periodButtons.forEach(btn => {
                            btn.classList.remove('bg-blue-100', 'dark:bg-blue-900', 'text-blue-700', 'dark:text-blue-300');
                            btn.classList.add('bg-gray-100', 'dark:bg-gray-700', 'text-gray-700', 'dark:text-gray-300');
                        });
                        
                        // Add active class to clicked button
                        this.classList.remove('bg-gray-100', 'dark:bg-gray-700', 'text-gray-700', 'dark:text-gray-300');
                        this.classList.add('bg-blue-100', 'dark:bg-blue-900', 'text-blue-700', 'dark:text-blue-300');
                    });
                });
            }, 800);
        });

        // Function to handle Schedule Reviews button click
        document.getElementById('scheduleReviewsBtn').addEventListener('click', function() {
            const resultDiv = document.getElementById('actionResult');
            resultDiv.innerHTML = `
                <div class="bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 rounded-lg p-4 fade-in">
                    <div class="flex items-center">
                        <i class="fas fa-edit text-green-500 text-xl mr-3"></i>
                        <div>
                            <h3 class="font-bold text-green-700 dark:text-green-300">Schedule Reviews</h3>
                            <p class="text-green-600 dark:text-green-400 text-sm">Loading scheduling interface...</p>
                        </div>
                    </div>
                </div>
            `;
            resultDiv.classList.remove('hidden');
            
            // Simulate loading scheduling interface after a short delay
            setTimeout(() => {
                resultDiv.innerHTML = `
                    <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg p-6 shadow-sm fade-in">
                        <h3 class="text-xl font-bold text-gray-800 dark:text-white mb-4">Schedule Performance Reviews</h3>
                        <form id="scheduleReviewForm">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Employee</label>
                                    <select class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md bg-white dark:bg-gray-700 text-gray-800 dark:text-white">
                                        <option>Select Employee</option>
                                        <option>Sarah Johnson</option>
                                        <option>Michael Brown</option>
                                        <option>Emily Davis</option>
                                        <option>John Smith</option>
                                        <option>Robert Wilson</option>
                                    </select>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Review Type</label>
                                    <select class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md bg-white dark:bg-gray-700 text-gray-800 dark:text-white">
                                        <option>Quarterly Review</option>
                                        <option>Annual Review</option>
                                        <option>Probation Review</option>
                                        <option>Promotion Review</option>
                                    </select>
                                </div>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Review Date</label>
                                    <input type="date" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md bg-white dark:bg-gray-700 text-gray-800 dark:text-white">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Reviewer</label>
                                    <select class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md bg-white dark:bg-gray-700 text-gray-800 dark:text-white">
                                        <option>Select Reviewer</option>
                                        <option>HR Manager</option>
                                        <option>Department Head</option>
                                        <option>Team Lead</option>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Review Objectives</label>
                                <textarea class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md bg-white dark:bg-gray-700 text-gray-800 dark:text-white" rows="3" placeholder="Enter review objectives and focus areas..."></textarea>
                            </div>
                            <div class="flex justify-end space-x-3">
                                <button type="button" id="cancelSchedule" class="px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">Cancel</button>
                                <button type="submit" class="px-4 py-2 bg-green-500 hover:bg-green-600 text-white rounded-md transition-colors">Schedule Review</button>
                            </div>
                        </form>
                        
                        <!-- Upcoming Reviews Section -->
                        <div class="mt-8">
                            <h4 class="text-lg font-semibold text-gray-800 dark:text-white mb-4">Upcoming Reviews</h4>
                            <div class="space-y-3">
                                <div class="flex items-center justify-between p-3 bg-blue-50 dark:bg-blue-900/20 rounded-lg slide-in">
                                    <div>
                                        <p class="font-medium text-gray-800 dark:text-white">Sarah Johnson - Quarterly Review</p>
                                        <p class="text-sm text-gray-600 dark:text-gray-400">June 30, 2023 • HR Manager</p>
                                    </div>
                                    <button class="text-red-500 hover:text-red-700 dark:text-red-400 dark:hover:text-red-300">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                                <div class="flex items-center justify-between p-3 bg-green-50 dark:bg-green-900/20 rounded-lg slide-in">
                                    <div>
                                        <p class="font-medium text-gray-800 dark:text-white">Michael Brown - Annual Review</p>
                                        <p class="text-sm text-gray-600 dark:text-gray-400">July 5, 2023 • Department Head</p>
                                    </div>
                                    <button class="text-red-500 hover:text-red-700 dark:text-red-400 dark:hover:text-red-300">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                `;
                
                // Add cancel button functionality
                document.getElementById('cancelSchedule').addEventListener('click', function() {
                    resultDiv.classList.add('hidden');
                });
                
                // Add form submission handler
                document.getElementById('scheduleReviewForm').addEventListener('submit', function(e) {
                    e.preventDefault();
                    resultDiv.innerHTML = `
                        <div class="bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 rounded-lg p-4 fade-in">
                            <div class="flex items-center">
                                <i class="fas fa-check-circle text-green-500 text-xl mr-3"></i>
                                <div>
                                    <h3 class="font-bold text-green-700 dark:text-green-300">Success!</h3>
                                    <p class="text-green-600 dark:text-green-400 text-sm">Performance review has been scheduled successfully.</p>
                                </div>
                            </div>
                        </div>
                    `;
                });
            }, 800);
        });
    </script>
</body>
</html>