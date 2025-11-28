<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leave Management - KeySecure</title>
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
    </style>
</head>
<body class="bg-gray-50 dark:bg-gray-900">
    <!-- Simple Navigation -->
    <nav class="bg-white dark:bg-gray-800 shadow-sm border-b border-gray-200 dark:border-gray-700">
        <div class="px-6 py-4">
            <div class="flex justify-between items-center">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-gradient-to-r from-red-500 to-red-700 rounded-xl flex items-center justify-center">
                        <i class="fas fa-users text-white text-lg"></i>
                    </div>
                    <div>
                        <h1 class="text-xl font-bold text-gray-800 dark:text-white">KeySecure</h1>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Leave Management</p>
                    </div>
                </div>
                <a href="/hr/dashboard" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg transition-colors">
                    <i class="fas fa-arrow-left mr-2"></i>Back to Dashboard
                </a>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="container mx-auto p-6">
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 p-8">
            <div class="text-center">
                <div class="w-20 h-20 bg-purple-100 dark:bg-purple-900 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-calendar-alt text-purple-600 dark:text-purple-400 text-2xl"></i>
                </div>
                <h1 class="text-3xl font-bold text-gray-800 dark:text-white mb-2">Leave Management</h1>
                <p class="text-gray-600 dark:text-gray-400 mb-6">Manage employee leave requests and approvals</p>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                    <div class="bg-blue-50 dark:bg-blue-900/20 p-4 rounded-lg">
                        <p class="text-2xl font-bold text-blue-600 dark:text-blue-400">5</p>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Pending Requests</p>
                    </div>
                    <div class="bg-green-50 dark:bg-green-900/20 p-4 rounded-lg">
                        <p class="text-2xl font-bold text-green-600 dark:text-green-400">12</p>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Approved This Month</p>
                    </div>
                    <div class="bg-orange-50 dark:bg-orange-900/20 p-4 rounded-lg">
                        <p class="text-2xl font-bold text-orange-600 dark:text-orange-400">3</p>
                        <p class="text-sm text-gray-600 dark:text-gray-400">On Leave Today</p>
                    </div>
                </div>

                <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-6 mb-6">
                    <p class="text-gray-600 dark:text-gray-400 mb-4">Manage employee leave requests and approvals</p>
                    <div class="flex flex-col sm:flex-row justify-center space-y-4 sm:space-y-0 sm:space-x-4">
                        <button id="newLeaveRequestBtn" class="bg-purple-500 hover:bg-purple-600 text-white px-6 py-2 rounded-lg transition-colors">
                            <i class="fas fa-plus mr-2"></i>New Leave Request
                        </button>
                        <button id="viewAllRequestsBtn" class="bg-green-500 hover:bg-green-600 text-white px-6 py-2 rounded-lg transition-colors">
                            <i class="fas fa-list mr-2"></i>View All Requests
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
        // Function to handle New Leave Request button click
        document.getElementById('newLeaveRequestBtn').addEventListener('click', function() {
            const resultDiv = document.getElementById('actionResult');
            resultDiv.innerHTML = `
                <div class="bg-purple-50 dark:bg-purple-900/20 border border-purple-200 dark:border-purple-800 rounded-lg p-4 fade-in">
                    <div class="flex items-center">
                        <i class="fas fa-plus text-purple-500 text-xl mr-3"></i>
                        <div>
                            <h3 class="font-bold text-purple-700 dark:text-purple-300">New Leave Request</h3>
                            <p class="text-purple-600 dark:text-purple-400 text-sm">Opening leave request form...</p>
                        </div>
                    </div>
                </div>
            `;
            resultDiv.classList.remove('hidden');
            
            // Simulate form opening after a short delay
            setTimeout(() => {
                resultDiv.innerHTML = `
                    <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg p-6 shadow-sm fade-in">
                        <h3 class="text-xl font-bold text-gray-800 dark:text-white mb-4">Create New Leave Request</h3>
                        <form id="leaveRequestForm">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Employee Name</label>
                                    <select class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md bg-white dark:bg-gray-700 text-gray-800 dark:text-white">
                                        <option>John Smith</option>
                                        <option>Sarah Johnson</option>
                                        <option>Michael Brown</option>
                                        <option>Emily Davis</option>
                                        <option>Robert Wilson</option>
                                    </select>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Leave Type</label>
                                    <select class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md bg-white dark:bg-gray-700 text-gray-800 dark:text-white">
                                        <option>Vacation</option>
                                        <option>Sick Leave</option>
                                        <option>Personal Leave</option>
                                        <option>Maternity/Paternity</option>
                                        <option>Emergency</option>
                                    </select>
                                </div>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Start Date</label>
                                    <input type="date" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md bg-white dark:bg-gray-700 text-gray-800 dark:text-white">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">End Date</label>
                                    <input type="date" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md bg-white dark:bg-gray-700 text-gray-800 dark:text-white">
                                </div>
                            </div>
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Reason for Leave</label>
                                <textarea class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md bg-white dark:bg-gray-700 text-gray-800 dark:text-white" rows="3" placeholder="Please provide a reason for your leave request..."></textarea>
                            </div>
                            <div class="flex justify-end space-x-3">
                                <button type="button" id="cancelLeaveRequest" class="px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">Cancel</button>
                                <button type="submit" class="px-4 py-2 bg-purple-500 hover:bg-purple-600 text-white rounded-md transition-colors">Submit Request</button>
                            </div>
                        </form>
                    </div>
                `;
                
                // Add cancel button functionality
                document.getElementById('cancelLeaveRequest').addEventListener('click', function() {
                    resultDiv.classList.add('hidden');
                });
                
                // Add form submission handler
                document.getElementById('leaveRequestForm').addEventListener('submit', function(e) {
                    e.preventDefault();
                    resultDiv.innerHTML = `
                        <div class="bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 rounded-lg p-4 fade-in">
                            <div class="flex items-center">
                                <i class="fas fa-check-circle text-green-500 text-xl mr-3"></i>
                                <div>
                                    <h3 class="font-bold text-green-700 dark:text-green-300">Success!</h3>
                                    <p class="text-green-600 dark:text-green-400 text-sm">Leave request has been submitted successfully.</p>
                                </div>
                            </div>
                        </div>
                    `;
                });
            }, 800);
        });

        // Function to handle View All Requests button click
        document.getElementById('viewAllRequestsBtn').addEventListener('click', function() {
            const resultDiv = document.getElementById('actionResult');
            resultDiv.innerHTML = `
                <div class="bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 rounded-lg p-4 fade-in">
                    <div class="flex items-center">
                        <i class="fas fa-list text-green-500 text-xl mr-3"></i>
                        <div>
                            <h3 class="font-bold text-green-700 dark:text-green-300">View All Requests</h3>
                            <p class="text-green-600 dark:text-green-400 text-sm">Loading leave requests...</p>
                        </div>
                    </div>
                </div>
            `;
            resultDiv.classList.remove('hidden');
            
            // Simulate loading leave requests after a short delay
            setTimeout(() => {
                resultDiv.innerHTML = `
                    <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg p-6 shadow-sm fade-in">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-xl font-bold text-gray-800 dark:text-white">All Leave Requests</h3>
                            <div class="flex space-x-2">
                                <button class="px-3 py-1 bg-blue-100 dark:bg-blue-900 text-blue-700 dark:text-blue-300 rounded-md text-sm">All</button>
                                <button class="px-3 py-1 bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-md text-sm">Pending</button>
                                <button class="px-3 py-1 bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-md text-sm">Approved</button>
                                <button class="px-3 py-1 bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-md text-sm">Rejected</button>
                            </div>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                    <tr>
                                        <th class="px-4 py-3">Employee</th>
                                        <th class="px-4 py-3">Leave Type</th>
                                        <th class="px-4 py-3">Dates</th>
                                        <th class="px-4 py-3">Status</th>
                                        <th class="px-4 py-3">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 slide-in">
                                        <td class="px-4 py-3 font-medium text-gray-900 dark:text-white">John Smith</td>
                                        <td class="px-4 py-3">Vacation</td>
                                        <td class="px-4 py-3">Jun 20 - Jun 25, 2023</td>
                                        <td class="px-4 py-3"><span class="bg-yellow-100 text-yellow-800 text-xs px-2 py-1 rounded-full">Pending</span></td>
                                        <td class="px-4 py-3">
                                            <button class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300 mr-2">View</button>
                                            <button class="text-green-600 hover:text-green-800 dark:text-green-400 dark:hover:text-green-300 mr-2">Approve</button>
                                            <button class="text-red-600 hover:text-red-800 dark:text-red-400 dark:hover:text-red-300">Reject</button>
                                        </td>
                                    </tr>
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 slide-in">
                                        <td class="px-4 py-3 font-medium text-gray-900 dark:text-white">Sarah Johnson</td>
                                        <td class="px-4 py-3">Sick Leave</td>
                                        <td class="px-4 py-3">Jun 18 - Jun 19, 2023</td>
                                        <td class="px-4 py-3"><span class="bg-green-100 text-green-800 text-xs px-2 py-1 rounded-full">Approved</span></td>
                                        <td class="px-4 py-3">
                                            <button class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300 mr-2">View</button>
                                        </td>
                                    </tr>
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 slide-in">
                                        <td class="px-4 py-3 font-medium text-gray-900 dark:text-white">Michael Brown</td>
                                        <td class="px-4 py-3">Personal Leave</td>
                                        <td class="px-4 py-3">Jun 22 - Jun 23, 2023</td>
                                        <td class="px-4 py-3"><span class="bg-yellow-100 text-yellow-800 text-xs px-2 py-1 rounded-full">Pending</span></td>
                                        <td class="px-4 py-3">
                                            <button class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300 mr-2">View</button>
                                            <button class="text-green-600 hover:text-green-800 dark:text-green-400 dark:hover:text-green-300 mr-2">Approve</button>
                                            <button class="text-red-600 hover:text-red-800 dark:text-red-400 dark:hover:text-red-300">Reject</button>
                                        </td>
                                    </tr>
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 slide-in">
                                        <td class="px-4 py-3 font-medium text-gray-900 dark:text-white">Emily Davis</td>
                                        <td class="px-4 py-3">Vacation</td>
                                        <td class="px-4 py-3">Jul 5 - Jul 12, 2023</td>
                                        <td class="px-4 py-3"><span class="bg-red-100 text-red-800 text-xs px-2 py-1 rounded-full">Rejected</span></td>
                                        <td class="px-4 py-3">
                                            <button class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300 mr-2">View</button>
                                        </td>
                                    </tr>
                                    <tr class="bg-white dark:bg-gray-800 slide-in">
                                        <td class="px-4 py-3 font-medium text-gray-900 dark:text-white">Robert Wilson</td>
                                        <td class="px-4 py-3">Emergency</td>
                                        <td class="px-4 py-3">Jun 15 - Jun 16, 2023</td>
                                        <td class="px-4 py-3"><span class="bg-green-100 text-green-800 text-xs px-2 py-1 rounded-full">Approved</span></td>
                                        <td class="px-4 py-3">
                                            <button class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300 mr-2">View</button>
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