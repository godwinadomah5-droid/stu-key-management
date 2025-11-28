<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HR Reports - KeySecure</title>
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
        .report-card {
            transition: all 0.3s ease;
        }
        .report-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        }
        .dark .report-card:hover {
            box-shadow: 0 10px 25px rgba(0,0,0,0.3);
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
                        <p class="text-sm text-gray-500 dark:text-gray-400">HR Reports</p>
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
                <div class="w-20 h-20 bg-pink-100 dark:bg-pink-900 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-chart-pie text-pink-600 dark:text-pink-400 text-2xl"></i>
                </div>
                <h1 class="text-3xl font-bold text-gray-800 dark:text-white mb-2">HR Reports</h1>
                <p class="text-gray-600 dark:text-gray-400 mb-6">Generate and view HR analytics and reports</p>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                    <div class="bg-blue-50 dark:bg-blue-900/20 p-4 rounded-lg">
                        <p class="text-2xl font-bold text-blue-600 dark:text-blue-400">15</p>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Available Reports</p>
                    </div>
                    <div class="bg-green-50 dark:bg-green-900/20 p-4 rounded-lg">
                        <p class="text-2xl font-bold text-green-600 dark:text-green-400">8</p>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Scheduled Reports</p>
                    </div>
                    <div class="bg-purple-50 dark:bg-purple-900/20 p-4 rounded-lg">
                        <p class="text-2xl font-bold text-purple-600 dark:text-purple-400">3</p>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Custom Reports</p>
                    </div>
                </div>

                <!-- Report Generation Section -->
                <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-6 mb-8">
                    <p class="text-gray-600 dark:text-gray-400 mb-4">Generate comprehensive HR reports and analytics</p>
                    
                    <!-- Report Type Selection -->
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Select Report Type</label>
                        <select id="reportType" class="w-full md:w-64 bg-white dark:bg-gray-600 border border-gray-300 dark:border-gray-500 rounded-lg px-4 py-2 focus:ring-2 focus:ring-pink-500 focus:border-pink-500">
                            <option value="employee_directory">Employee Directory</option>
                            <option value="attendance">Attendance Report</option>
                            <option value="performance">Performance Review</option>
                            <option value="payroll">Payroll Summary</option>
                            <option value="recruitment">Recruitment Analytics</option>
                            <option value="turnover">Employee Turnover</option>
                        </select>
                    </div>

                    <!-- Date Range Selection -->
                    <div class="mb-6 grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Start Date</label>
                            <input type="date" id="startDate" class="w-full bg-white dark:bg-gray-600 border border-gray-300 dark:border-gray-500 rounded-lg px-4 py-2 focus:ring-2 focus:ring-pink-500 focus:border-pink-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">End Date</label>
                            <input type="date" id="endDate" class="w-full bg-white dark:bg-gray-600 border border-gray-300 dark:border-gray-500 rounded-lg px-4 py-2 focus:ring-2 focus:ring-pink-500 focus:border-pink-500">
                        </div>
                    </div>

                    <!-- Format Selection -->
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Export Format</label>
                        <div class="flex flex-wrap gap-4 justify-center">
                            <label class="inline-flex items-center">
                                <input type="radio" name="format" value="pdf" class="text-pink-500 focus:ring-pink-500" checked>
                                <span class="ml-2 text-gray-700 dark:text-gray-300">PDF</span>
                            </label>
                            <label class="inline-flex items-center">
                                <input type="radio" name="format" value="excel" class="text-pink-500 focus:ring-pink-500">
                                <span class="ml-2 text-gray-700 dark:text-gray-300">Excel</span>
                            </label>
                            <label class="inline-flex items-center">
                                <input type="radio" name="format" value="csv" class="text-pink-500 focus:ring-pink-500">
                                <span class="ml-2 text-gray-700 dark:text-gray-300">CSV</span>
                            </label>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex flex-col sm:flex-row justify-center space-y-4 sm:space-y-0 sm:space-x-4">
                        <button id="generateReportBtn" class="bg-pink-500 hover:bg-pink-600 text-white px-8 py-3 rounded-lg transition-colors font-semibold flex items-center justify-center">
                            <i class="fas fa-chart-bar mr-2"></i>Generate Report
                        </button>
                        <button id="exportDataBtn" class="bg-green-500 hover:bg-green-600 text-white px-8 py-3 rounded-lg transition-colors font-semibold flex items-center justify-center">
                            <i class="fas fa-download mr-2"></i>Export Data
                        </button>
                    </div>
                </div>

                <!-- Progress Bar (Hidden by default) -->
                <div id="progressSection" class="hidden fade-in mb-6">
                    <div class="bg-white dark:bg-gray-600 rounded-lg p-4">
                        <div class="flex justify-between items-center mb-2">
                            <span id="progressText" class="text-sm font-medium text-gray-700 dark:text-gray-300">Generating report...</span>
                            <span id="progressPercent" class="text-sm font-medium text-gray-700 dark:text-gray-300">0%</span>
                        </div>
                        <div class="w-full bg-gray-200 dark:bg-gray-500 rounded-full h-2">
                            <div id="progressBar" class="progress-bar bg-pink-500 h-2 rounded-full" style="width: 0%"></div>
                        </div>
                    </div>
                </div>

                <!-- Success Message (Hidden by default) -->
                <div id="successMessage" class="hidden fade-in bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 rounded-lg p-4 mb-6">
                    <div class="flex items-center">
                        <i class="fas fa-check-circle text-green-500 text-xl mr-3"></i>
                        <div>
                            <h4 class="font-semibold text-green-800 dark:text-green-300">Report Generated Successfully!</h4>
                            <p id="successDetails" class="text-sm text-green-600 dark:text-green-400">Your report is ready for download.</p>
                        </div>
                        <button id="downloadReportBtn" class="ml-auto bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg text-sm transition-colors">
                            <i class="fas fa-download mr-1"></i>Download
                        </button>
                    </div>
                </div>

                <!-- Report Types -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    <div class="report-card bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg p-4 text-center cursor-pointer" onclick="selectReport('employee_directory')">
                        <i class="fas fa-users text-blue-500 text-xl mb-2"></i>
                        <h4 class="font-semibold text-gray-800 dark:text-white">Employee Directory</h4>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Complete staff listing</p>
                        <button class="mt-3 bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg text-sm transition-colors" onclick="generateEmployeeDirectory(event)">
                            <i class="fas fa-file-export mr-1"></i>Generate
                        </button>
                    </div>
                    <div class="report-card bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg p-4 text-center cursor-pointer" onclick="selectReport('attendance')">
                        <i class="fas fa-calendar text-green-500 text-xl mb-2"></i>
                        <h4 class="font-semibold text-gray-800 dark:text-white">Attendance Report</h4>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Time and attendance</p>
                        <button class="mt-3 bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg text-sm transition-colors" onclick="generateAttendanceReport(event)">
                            <i class="fas fa-file-export mr-1"></i>Generate
                        </button>
                    </div>
                    <div class="report-card bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg p-4 text-center cursor-pointer" onclick="selectReport('performance')">
                        <i class="fas fa-chart-line text-purple-500 text-xl mb-2"></i>
                        <h4 class="font-semibold text-gray-800 dark:text-white">Performance</h4>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Employee performance</p>
                        <button class="mt-3 bg-purple-500 hover:bg-purple-600 text-white px-4 py-2 rounded-lg text-sm transition-colors" onclick="generatePerformanceReport(event)">
                            <i class="fas fa-file-export mr-1"></i>Generate
                        </button>
                    </div>
                    <div class="report-card bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg p-4 text-center cursor-pointer" onclick="selectReport('payroll')">
                        <i class="fas fa-file-invoice-dollar text-indigo-500 text-xl mb-2"></i>
                        <h4 class="font-semibold text-gray-800 dark:text-white">Payroll Summary</h4>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Salary and compensation</p>
                        <button class="mt-3 bg-indigo-500 hover:bg-indigo-600 text-white px-4 py-2 rounded-lg text-sm transition-colors" onclick="generatePayrollReport(event)">
                            <i class="fas fa-file-export mr-1"></i>Generate
                        </button>
                    </div>
                    <div class="report-card bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg p-4 text-center cursor-pointer" onclick="selectReport('recruitment')">
                        <i class="fas fa-user-plus text-orange-500 text-xl mb-2"></i>
                        <h4 class="font-semibold text-gray-800 dark:text-white">Recruitment</h4>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Hiring analytics</p>
                        <button class="mt-3 bg-orange-500 hover:bg-orange-600 text-white px-4 py-2 rounded-lg text-sm transition-colors" onclick="generateRecruitmentReport(event)">
                            <i class="fas fa-file-export mr-1"></i>Generate
                        </button>
                    </div>
                    <div class="report-card bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg p-4 text-center cursor-pointer" onclick="selectReport('turnover')">
                        <i class="fas fa-exchange-alt text-red-500 text-xl mb-2"></i>
                        <h4 class="font-semibold text-gray-800 dark:text-white">Turnover</h4>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Employee retention</p>
                        <button class="mt-3 bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg text-sm transition-colors" onclick="generateTurnoverReport(event)">
                            <i class="fas fa-file-export mr-1"></i>Generate
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script>
        // Set default dates
        document.getElementById('startDate').valueAsDate = new Date(new Date().getFullYear(), new Date().getMonth(), 1);
        document.getElementById('endDate').valueAsDate = new Date();

        // Report type selection from cards
        function selectReport(type) {
            document.getElementById('reportType').value = type;
            
            // Add visual feedback
            const cards = document.querySelectorAll('.report-card');
            cards.forEach(card => {
                card.classList.remove('ring-2', 'ring-pink-500', 'border-pink-500');
            });
            event.currentTarget.classList.add('ring-2', 'ring-pink-500', 'border-pink-500');
        }

        // Generate Report Functions for each type
        function generateEmployeeDirectory(event) {
            event.stopPropagation();
            simulateReportGeneration('employee_directory', 'Employee Directory Report');
        }

        function generateAttendanceReport(event) {
            event.stopPropagation();
            simulateReportGeneration('attendance', 'Attendance Report');
        }

        function generatePerformanceReport(event) {
            event.stopPropagation();
            simulateReportGeneration('performance', 'Performance Review Report');
        }

        function generatePayrollReport(event) {
            event.stopPropagation();
            simulateReportGeneration('payroll', 'Payroll Summary Report');
        }

        function generateRecruitmentReport(event) {
            event.stopPropagation();
            simulateReportGeneration('recruitment', 'Recruitment Analytics Report');
        }

        function generateTurnoverReport(event) {
            event.stopPropagation();
            simulateReportGeneration('turnover', 'Employee Turnover Report');
        }

        // Main report generation function
        function simulateReportGeneration(reportType, reportName) {
            const format = document.querySelector('input[name="format"]:checked').value;

            // Show progress
            const progressSection = document.getElementById('progressSection');
            const progressBar = document.getElementById('progressBar');
            const progressText = document.getElementById('progressText');
            const progressPercent = document.getElementById('progressPercent');
            
            progressSection.classList.remove('hidden');
            progressText.textContent = `Generating ${reportName}...`;
            
            // Simulate progress
            let progress = 0;
            const interval = setInterval(() => {
                progress += Math.random() * 12;
                if (progress >= 100) {
                    progress = 100;
                    clearInterval(interval);
                    
                    // Show success message
                    setTimeout(() => {
                        const successMessage = document.getElementById('successMessage');
                        const successDetails = document.getElementById('successDetails');
                        const downloadReportBtn = document.getElementById('downloadReportBtn');
                        
                        successDetails.textContent = `${reportName} generated successfully in ${format.toUpperCase()} format.`;
                        successMessage.classList.remove('hidden');
                        
                        // Set up download button
                        downloadReportBtn.onclick = function() {
                            simulateDownload(`${reportType}_report_${new Date().toISOString().split('T')[0]}.${format}`);
                        };
                        
                        // Auto-hide success message after 8 seconds
                        setTimeout(() => {
                            successMessage.classList.add('hidden');
                        }, 8000);
                    }, 500);
                }
                
                progressBar.style.width = `${progress}%`;
                progressPercent.textContent = `${Math.round(progress)}%`;
            }, 180);
        }

        // Generate Report Button (main form)
        document.getElementById('generateReportBtn').addEventListener('click', function() {
            const reportType = document.getElementById('reportType').value;
            const startDate = document.getElementById('startDate').value;
            const endDate = document.getElementById('endDate').value;
            const format = document.querySelector('input[name="format"]:checked').value;

            if (!startDate || !endDate) {
                alert('Please select both start and end dates.');
                return;
            }

            const reportNames = {
                'employee_directory': 'Employee Directory Report',
                'attendance': 'Attendance Report',
                'performance': 'Performance Review Report',
                'payroll': 'Payroll Summary Report',
                'recruitment': 'Recruitment Analytics Report',
                'turnover': 'Employee Turnover Report'
            };

            simulateReportGeneration(reportType, reportNames[reportType]);
        });

        // Export Data Button
        document.getElementById('exportDataBtn').addEventListener('click', function() {
            const reportType = document.getElementById('reportType').value;
            const startDate = document.getElementById('startDate').value;
            const endDate = document.getElementById('endDate').value;
            const format = document.querySelector('input[name="format"]:checked').value;

            if (!startDate || !endDate) {
                alert('Please select both start and end dates.');
                return;
            }

            // Show progress
            const progressSection = document.getElementById('progressSection');
            const progressBar = document.getElementById('progressBar');
            const progressText = document.getElementById('progressText');
            const progressPercent = document.getElementById('progressPercent');
            
            progressSection.classList.remove('hidden');
            progressText.textContent = `Exporting ${reportType.replace('_', ' ')} data...`;
            
            // Simulate progress
            let progress = 0;
            const interval = setInterval(() => {
                progress += Math.random() * 15;
                if (progress >= 100) {
                    progress = 100;
                    clearInterval(interval);
                    
                    // Show success message and trigger download
                    setTimeout(() => {
                        const successMessage = document.getElementById('successMessage');
                        const successDetails = document.getElementById('successDetails');
                        successDetails.textContent = `Data exported successfully in ${format.toUpperCase()} format. Download will start automatically.`;
                        successMessage.classList.remove('hidden');
                        
                        // Simulate file download
                        simulateDownload(`${reportType}_data_${new Date().toISOString().split('T')[0]}.${format}`);
                        
                        // Auto-hide success message after 5 seconds
                        setTimeout(() => {
                            successMessage.classList.add('hidden');
                        }, 5000);
                    }, 500);
                }
                
                progressBar.style.width = `${progress}%`;
                progressPercent.textContent = `${Math.round(progress)}%`;
            }, 150);
        });

        // Simulate file download
        function simulateDownload(filename) {
            // Create a temporary link to simulate download
            const link = document.createElement('a');
            link.href = '#'; // In a real app, this would be the actual file URL
            link.download = filename;
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
            
            // Show download confirmation
            console.log(`Downloading: ${filename}`);
        }

        // Add hover effects to report cards
        document.addEventListener('DOMContentLoaded', function() {
            const cards = document.querySelectorAll('.report-card');
            cards.forEach(card => {
                card.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-5px)';
                });
                card.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(0)';
                });
            });
        });
    </script>
</body>
</html>