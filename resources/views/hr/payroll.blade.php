<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payroll Management - KeySecure</title>
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
        
        .pulse-slow {
            animation: pulse 2s infinite;
        }
        
        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.8; }
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
                        <p class="text-sm text-gray-500 dark:text-gray-400">Payroll Management</p>
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
                <div class="w-20 h-20 bg-indigo-100 dark:bg-indigo-900 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-file-invoice-dollar text-indigo-600 dark:text-indigo-400 text-2xl"></i>
                </div>
                <h1 class="text-3xl font-bold text-gray-800 dark:text-white mb-2">Payroll Management</h1>
                <p class="text-gray-600 dark:text-gray-400 mb-6">Process and manage employee payroll</p>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                    <div class="bg-blue-50 dark:bg-blue-900/20 p-4 rounded-lg">
                        <p class="text-2xl font-bold text-blue-600 dark:text-blue-400">$247K</p>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Monthly Payroll</p>
                    </div>
                    <div class="bg-green-50 dark:bg-green-900/20 p-4 rounded-lg">
                        <p class="text-2xl font-bold text-green-600 dark:text-green-400">15</p>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Days to Next Payroll</p>
                    </div>
                    <div class="bg-purple-50 dark:bg-purple-900/20 p-4 rounded-lg">
                        <p class="text-2xl font-bold text-purple-600 dark:text-purple-400">0</p>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Pending Approvals</p>
                    </div>
                </div>

                <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-6 mb-6">
                    <p class="text-gray-600 dark:text-gray-400 mb-4">Process and manage employee payroll</p>
                    <div class="flex flex-col sm:flex-row justify-center space-y-4 sm:space-y-0 sm:space-x-4">
                        <button id="processPayrollBtn" class="bg-indigo-500 hover:bg-indigo-600 text-white px-6 py-2 rounded-lg transition-colors">
                            <i class="fas fa-calculator mr-2"></i>Process Payroll
                        </button>
                        <button id="viewHistoryBtn" class="bg-green-500 hover:bg-green-600 text-white px-6 py-2 rounded-lg transition-colors">
                            <i class="fas fa-history mr-2"></i>View History
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
        // Function to handle Process Payroll button click
        document.getElementById('processPayrollBtn').addEventListener('click', function() {
            const resultDiv = document.getElementById('actionResult');
            resultDiv.innerHTML = `
                <div class="bg-indigo-50 dark:bg-indigo-900/20 border border-indigo-200 dark:border-indigo-800 rounded-lg p-4 fade-in">
                    <div class="flex items-center">
                        <i class="fas fa-calculator text-indigo-500 text-xl mr-3"></i>
                        <div>
                            <h3 class="font-bold text-indigo-700 dark:text-indigo-300">Process Payroll</h3>
                            <p class="text-indigo-600 dark:text-indigo-400 text-sm">Initializing payroll processing...</p>
                        </div>
                    </div>
                </div>
            `;
            resultDiv.classList.remove('hidden');
            
            // Simulate payroll processing steps
            setTimeout(() => {
                resultDiv.innerHTML = `
                    <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg p-6 shadow-sm fade-in">
                        <h3 class="text-xl font-bold text-gray-800 dark:text-white mb-6">Process Payroll</h3>
                        
                        <!-- Payroll Summary -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <div class="bg-blue-50 dark:bg-blue-900/20 p-4 rounded-lg">
                                <h4 class="font-semibold text-blue-700 dark:text-blue-300 mb-2">Payroll Period</h4>
                                <div class="flex items-center justify-between">
                                    <select class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md bg-white dark:bg-gray-700 text-gray-800 dark:text-white">
                                        <option>June 2023</option>
                                        <option>July 2023</option>
                                        <option>August 2023</option>
                                    </select>
                                </div>
                            </div>
                            <div class="bg-green-50 dark:bg-green-900/20 p-4 rounded-lg">
                                <h4 class="font-semibold text-green-700 dark:text-green-300 mb-2">Employees</h4>
                                <p class="text-2xl font-bold text-green-600 dark:text-green-400">87</p>
                                <p class="text-sm text-gray-600 dark:text-gray-400">Total employees in payroll</p>
                            </div>
                        </div>
                        
                        <!-- Payroll Preview -->
                        <div class="mb-6">
                            <h4 class="font-semibold text-gray-800 dark:text-white mb-4">Payroll Preview</h4>
                            <div class="overflow-x-auto">
                                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                        <tr>
                                            <th class="px-4 py-3">Department</th>
                                            <th class="px-4 py-3">Employees</th>
                                            <th class="px-4 py-3">Total Amount</th>
                                            <th class="px-4 py-3">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 slide-in">
                                            <td class="px-4 py-3 font-medium text-gray-900 dark:text-white">Engineering</td>
                                            <td class="px-4 py-3">35</td>
                                            <td class="px-4 py-3">$142,500</td>
                                            <td class="px-4 py-3"><span class="bg-yellow-100 text-yellow-800 text-xs px-2 py-1 rounded-full">Pending</span></td>
                                        </tr>
                                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 slide-in">
                                            <td class="px-4 py-3 font-medium text-gray-900 dark:text-white">Sales</td>
                                            <td class="px-4 py-3">22</td>
                                            <td class="px-4 py-3">$89,200</td>
                                            <td class="px-4 py-3"><span class="bg-yellow-100 text-yellow-800 text-xs px-2 py-1 rounded-full">Pending</span></td>
                                        </tr>
                                        <tr class="bg-white dark:bg-gray-800 slide-in">
                                            <td class="px-4 py-3 font-medium text-gray-900 dark:text-white">Marketing</td>
                                            <td class="px-4 py-3">18</td>
                                            <td class="px-4 py-3">$65,800</td>
                                            <td class="px-4 py-3"><span class="bg-yellow-100 text-yellow-800 text-xs px-2 py-1 rounded-full">Pending</span></td>
                                        </tr>
                                    </tbody>
                                    <tfoot class="bg-gray-50 dark:bg-gray-700">
                                        <tr>
                                            <td class="px-4 py-3 font-bold text-gray-900 dark:text-white">Total</td>
                                            <td class="px-4 py-3 font-bold">87</td>
                                            <td class="px-4 py-3 font-bold text-green-600 dark:text-green-400">$297,500</td>
                                            <td class="px-4 py-3"></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                        
                        <!-- Processing Options -->
                        <div class="flex flex-col sm:flex-row justify-between items-center space-y-4 sm:space-y-0">
                            <div class="flex items-center">
                                <input type="checkbox" id="sendNotifications" class="w-4 h-4 text-indigo-600 bg-gray-100 border-gray-300 rounded focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                <label for="sendNotifications" class="ml-2 text-sm text-gray-600 dark:text-gray-400">Send payment notifications to employees</label>
                            </div>
                            <div class="flex space-x-3">
                                <button type="button" id="cancelPayroll" class="px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">Cancel</button>
                                <button id="runPayroll" class="px-4 py-2 bg-indigo-500 hover:bg-indigo-600 text-white rounded-md transition-colors pulse-slow">
                                    <i class="fas fa-play mr-2"></i>Run Payroll
                                </button>
                            </div>
                        </div>
                    </div>
                `;
                
                // Add cancel button functionality
                document.getElementById('cancelPayroll').addEventListener('click', function() {
                    resultDiv.classList.add('hidden');
                });
                
                // Add run payroll functionality
                document.getElementById('runPayroll').addEventListener('click', function() {
                    const runBtn = this;
                    runBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Processing...';
                    runBtn.disabled = true;
                    
                    // Simulate payroll processing
                    setTimeout(() => {
                        resultDiv.innerHTML = `
                            <div class="bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 rounded-lg p-6 fade-in">
                                <div class="text-center">
                                    <div class="w-16 h-16 bg-green-100 dark:bg-green-800 rounded-full flex items-center justify-center mx-auto mb-4">
                                        <i class="fas fa-check text-green-500 dark:text-green-400 text-2xl"></i>
                                    </div>
                                    <h3 class="text-xl font-bold text-green-700 dark:text-green-300 mb-2">Payroll Processed Successfully!</h3>
                                    <p class="text-green-600 dark:text-green-400 mb-4">Payroll for June 2023 has been processed for 87 employees.</p>
                                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                                        <div class="bg-white dark:bg-gray-800 p-3 rounded-lg">
                                            <p class="text-2xl font-bold text-gray-800 dark:text-white">$297,500</p>
                                            <p class="text-sm text-gray-600 dark:text-gray-400">Total Amount</p>
                                        </div>
                                        <div class="bg-white dark:bg-gray-800 p-3 rounded-lg">
                                            <p class="text-2xl font-bold text-gray-800 dark:text-white">87</p>
                                            <p class="text-sm text-gray-600 dark:text-gray-400">Employees</p>
                                        </div>
                                        <div class="bg-white dark:bg-gray-800 p-3 rounded-lg">
                                            <p class="text-2xl font-bold text-gray-800 dark:text-white">$3,421</p>
                                            <p class="text-sm text-gray-600 dark:text-gray-400">Average Pay</p>
                                        </div>
                                    </div>
                                    <button class="bg-indigo-500 hover:bg-indigo-600 text-white px-4 py-2 rounded-lg transition-colors">
                                        <i class="fas fa-download mr-2"></i>Download Reports
                                    </button>
                                </div>
                            </div>
                        `;
                    }, 2000);
                });
            }, 800);
        });

        // Function to handle View History button click
        document.getElementById('viewHistoryBtn').addEventListener('click', function() {
            const resultDiv = document.getElementById('actionResult');
            resultDiv.innerHTML = `
                <div class="bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 rounded-lg p-4 fade-in">
                    <div class="flex items-center">
                        <i class="fas fa-history text-green-500 text-xl mr-3"></i>
                        <div>
                            <h3 class="font-bold text-green-700 dark:text-green-300">Payroll History</h3>
                            <p class="text-green-600 dark:text-green-400 text-sm">Loading payroll records...</p>
                        </div>
                    </div>
                </div>
            `;
            resultDiv.classList.remove('hidden');
            
            // Simulate loading history after a short delay
            setTimeout(() => {
                resultDiv.innerHTML = `
                    <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg p-6 shadow-sm fade-in">
                        <div class="flex justify-between items-center mb-6">
                            <h3 class="text-xl font-bold text-gray-800 dark:text-white">Payroll History</h3>
                            <div class="flex space-x-2">
                                <button class="px-3 py-1 bg-blue-100 dark:bg-blue-900 text-blue-700 dark:text-blue-300 rounded-md text-sm">All</button>
                                <button class="px-3 py-1 bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-md text-sm">This Year</button>
                                <button class="px-3 py-1 bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-md text-sm">Last Quarter</button>
                            </div>
                        </div>
                        
                        <!-- Payroll Statistics -->
                        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
                            <div class="bg-blue-50 dark:bg-blue-900/20 p-3 rounded-lg">
                                <p class="text-lg font-bold text-blue-600 dark:text-blue-400">6</p>
                                <p class="text-sm text-gray-600 dark:text-gray-400">Payroll Runs</p>
                            </div>
                            <div class="bg-green-50 dark:bg-green-900/20 p-3 rounded-lg">
                                <p class="text-lg font-bold text-green-600 dark:text-green-400">$1.78M</p>
                                <p class="text-sm text-gray-600 dark:text-gray-400">Total Paid</p>
                            </div>
                            <div class="bg-purple-50 dark:bg-purple-900/20 p-3 rounded-lg">
                                <p class="text-lg font-bold text-purple-600 dark:text-purple-400">522</p>
                                <p class="text-sm text-gray-600 dark:text-gray-400">Total Payments</p>
                            </div>
                            <div class="bg-orange-50 dark:bg-orange-900/20 p-3 rounded-lg">
                                <p class="text-lg font-bold text-orange-600 dark:text-orange-400">0</p>
                                <p class="text-sm text-gray-600 dark:text-gray-400">Issues</p>
                            </div>
                        </div>
                        
                        <!-- Payroll History Table -->
                        <div class="overflow-x-auto">
                            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                    <tr>
                                        <th class="px-4 py-3">Payroll Period</th>
                                        <th class="px-4 py-3">Employees</th>
                                        <th class="px-4 py-3">Total Amount</th>
                                        <th class="px-4 py-3">Processed Date</th>
                                        <th class="px-4 py-3">Status</th>
                                        <th class="px-4 py-3">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 slide-in">
                                        <td class="px-4 py-3 font-medium text-gray-900 dark:text-white">May 2023</td>
                                        <td class="px-4 py-3">85</td>
                                        <td class="px-4 py-3">$289,420</td>
                                        <td class="px-4 py-3">May 31, 2023</td>
                                        <td class="px-4 py-3"><span class="bg-green-100 text-green-800 text-xs px-2 py-1 rounded-full">Completed</span></td>
                                        <td class="px-4 py-3">
                                            <button class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300 mr-2">View</button>
                                            <button class="text-green-600 hover:text-green-800 dark:text-green-400 dark:hover:text-green-300">Export</button>
                                        </td>
                                    </tr>
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 slide-in">
                                        <td class="px-4 py-3 font-medium text-gray-900 dark:text-white">April 2023</td>
                                        <td class="px-4 py-3">83</td>
                                        <td class="px-4 py-3">$281,150</td>
                                        <td class="px-4 py-3">April 28, 2023</td>
                                        <td class="px-4 py-3"><span class="bg-green-100 text-green-800 text-xs px-2 py-1 rounded-full">Completed</span></td>
                                        <td class="px-4 py-3">
                                            <button class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300 mr-2">View</button>
                                            <button class="text-green-600 hover:text-green-800 dark:text-green-400 dark:hover:text-green-300">Export</button>
                                        </td>
                                    </tr>
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 slide-in">
                                        <td class="px-4 py-3 font-medium text-gray-900 dark:text-white">March 2023</td>
                                        <td class="px-4 py-3">80</td>
                                        <td class="px-4 py-3">$272,890</td>
                                        <td class="px-4 py-3">March 31, 2023</td>
                                        <td class="px-4 py-3"><span class="bg-green-100 text-green-800 text-xs px-2 py-1 rounded-full">Completed</span></td>
                                        <td class="px-4 py-3">
                                            <button class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300 mr-2">View</button>
                                            <button class="text-green-600 hover:text-green-800 dark:text-green-400 dark:hover:text-green-300">Export</button>
                                        </td>
                                    </tr>
                                    <tr class="bg-white dark:bg-gray-800 slide-in">
                                        <td class="px-4 py-3 font-medium text-gray-900 dark:text-white">February 2023</td>
                                        <td class="px-4 py-3">78</td>
                                        <td class="px-4 py-3">$265,740</td>
                                        <td class="px-4 py-3">February 28, 2023</td>
                                        <td class="px-4 py-3"><span class="bg-green-100 text-green-800 text-xs px-2 py-1 rounded-full">Completed</span></td>
                                        <td class="px-4 py-3">
                                            <button class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300 mr-2">View</button>
                                            <button class="text-green-600 hover:text-green-800 dark:text-green-400 dark:hover:text-green-300">Export</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                `;
                
                // Add functionality to filter buttons
                const filterButtons = resultDiv.querySelectorAll('button.bg-gray-100');
                filterButtons.forEach(button => {
                    button.addEventListener('click', function() {
                        // Remove active class from all buttons
                        filterButtons.forEach(btn => {
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
    </script>
</body>
</html>