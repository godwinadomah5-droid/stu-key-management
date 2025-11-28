<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recruitment - KeySecure</title>
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
                        <p class="text-sm text-gray-500 dark:text-gray-400">Recruitment</p>
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
                <div class="w-20 h-20 bg-blue-100 dark:bg-blue-900 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-user-plus text-blue-600 dark:text-blue-400 text-2xl"></i>
                </div>
                <h1 class="text-3xl font-bold text-gray-800 dark:text-white mb-2">Recruitment</h1>
                <p class="text-gray-600 dark:text-gray-400 mb-6">Manage job openings and candidate applications</p>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                    <div class="bg-blue-50 dark:bg-blue-900/20 p-4 rounded-lg">
                        <p class="text-2xl font-bold text-blue-600 dark:text-blue-400">8</p>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Open Positions</p>
                    </div>
                    <div class="bg-green-50 dark:bg-green-900/20 p-4 rounded-lg">
                        <p class="text-2xl font-bold text-green-600 dark:text-green-400">12</p>
                        <p class="text-sm text-gray-600 dark:text-gray-400">New Applications</p>
                    </div>
                    <div class="bg-orange-50 dark:bg-orange-900/20 p-4 rounded-lg">
                        <p class="text-2xl font-bold text-orange-600 dark:text-orange-400">3</p>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Interviews Today</p>
                    </div>
                </div>

                <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-6 mb-6">
                    <p class="text-gray-600 dark:text-gray-400 mb-4">Recruitment system is under development.</p>
                    <div class="flex flex-col sm:flex-row justify-center space-y-4 sm:space-y-0 sm:space-x-4">
                        <button id="postJobBtn" class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-2 rounded-lg transition-colors">
                            <i class="fas fa-briefcase mr-2"></i>Post New Job
                        </button>
                        <button id="viewCandidatesBtn" class="bg-green-500 hover:bg-green-600 text-white px-6 py-2 rounded-lg transition-colors">
                            <i class="fas fa-list mr-2"></i>View Candidates
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
        // Function to handle Post New Job button click
        document.getElementById('postJobBtn').addEventListener('click', function() {
            const resultDiv = document.getElementById('actionResult');
            resultDiv.innerHTML = `
                <div class="bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-lg p-4 fade-in">
                    <div class="flex items-center">
                        <i class="fas fa-briefcase text-blue-500 text-xl mr-3"></i>
                        <div>
                            <h3 class="font-bold text-blue-700 dark:text-blue-300">Post New Job</h3>
                            <p class="text-blue-600 dark:text-blue-400 text-sm">Opening job posting form...</p>
                        </div>
                    </div>
                </div>
            `;
            resultDiv.classList.remove('hidden');
            
            // Simulate form opening after a short delay
            setTimeout(() => {
                resultDiv.innerHTML = `
                    <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg p-6 shadow-sm fade-in">
                        <h3 class="text-xl font-bold text-gray-800 dark:text-white mb-4">Create New Job Posting</h3>
                        <form id="jobForm">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Job Title</label>
                                    <input type="text" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md bg-white dark:bg-gray-700 text-gray-800 dark:text-white" placeholder="e.g. Senior Developer">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Department</label>
                                    <select class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md bg-white dark:bg-gray-700 text-gray-800 dark:text-white">
                                        <option>Engineering</option>
                                        <option>Marketing</option>
                                        <option>Sales</option>
                                        <option>HR</option>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Job Description</label>
                                <textarea class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md bg-white dark:bg-gray-700 text-gray-800 dark:text-white" rows="4" placeholder="Enter job description..."></textarea>
                            </div>
                            <div class="flex justify-end space-x-3">
                                <button type="button" class="px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">Cancel</button>
                                <button type="submit" class="px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white rounded-md transition-colors">Post Job</button>
                            </div>
                        </form>
                    </div>
                `;
                
                // Add form submission handler
                document.getElementById('jobForm').addEventListener('submit', function(e) {
                    e.preventDefault();
                    resultDiv.innerHTML = `
                        <div class="bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 rounded-lg p-4 fade-in">
                            <div class="flex items-center">
                                <i class="fas fa-check-circle text-green-500 text-xl mr-3"></i>
                                <div>
                                    <h3 class="font-bold text-green-700 dark:text-green-300">Success!</h3>
                                    <p class="text-green-600 dark:text-green-400 text-sm">Job posting has been created successfully.</p>
                                </div>
                            </div>
                        </div>
                    `;
                });
            }, 800);
        });

        // Function to handle View Candidates button click
        document.getElementById('viewCandidatesBtn').addEventListener('click', function() {
            const resultDiv = document.getElementById('actionResult');
            resultDiv.innerHTML = `
                <div class="bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 rounded-lg p-4 fade-in">
                    <div class="flex items-center">
                        <i class="fas fa-list text-green-500 text-xl mr-3"></i>
                        <div>
                            <h3 class="font-bold text-green-700 dark:text-green-300">View Candidates</h3>
                            <p class="text-green-600 dark:text-green-400 text-sm">Loading candidate list...</p>
                        </div>
                    </div>
                </div>
            `;
            resultDiv.classList.remove('hidden');
            
            // Simulate loading candidates after a short delay
            setTimeout(() => {
                resultDiv.innerHTML = `
                    <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg p-6 shadow-sm fade-in">
                        <h3 class="text-xl font-bold text-gray-800 dark:text-white mb-4">Candidate Applications</h3>
                        <div class="overflow-x-auto">
                            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                    <tr>
                                        <th class="px-4 py-3">Name</th>
                                        <th class="px-4 py-3">Position</th>
                                        <th class="px-4 py-3">Status</th>
                                        <th class="px-4 py-3">Applied Date</th>
                                        <th class="px-4 py-3">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                        <td class="px-4 py-3 font-medium text-gray-900 dark:text-white">John Smith</td>
                                        <td class="px-4 py-3">Senior Developer</td>
                                        <td class="px-4 py-3"><span class="bg-yellow-100 text-yellow-800 text-xs px-2 py-1 rounded-full">Review</span></td>
                                        <td class="px-4 py-3">2023-06-15</td>
                                        <td class="px-4 py-3">
                                            <button class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300 mr-2">View</button>
                                            <button class="text-green-600 hover:text-green-800 dark:text-green-400 dark:hover:text-green-300">Contact</button>
                                        </td>
                                    </tr>
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                        <td class="px-4 py-3 font-medium text-gray-900 dark:text-white">Sarah Johnson</td>
                                        <td class="px-4 py-3">Marketing Manager</td>
                                        <td class="px-4 py-3"><span class="bg-green-100 text-green-800 text-xs px-2 py-1 rounded-full">Interview</span></td>
                                        <td class="px-4 py-3">2023-06-12</td>
                                        <td class="px-4 py-3">
                                            <button class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300 mr-2">View</button>
                                            <button class="text-green-600 hover:text-green-800 dark:text-green-400 dark:hover:text-green-300">Contact</button>
                                        </td>
                                    </tr>
                                    <tr class="bg-white dark:bg-gray-800">
                                        <td class="px-4 py-3 font-medium text-gray-900 dark:text-white">Michael Brown</td>
                                        <td class="px-4 py-3">UX Designer</td>
                                        <td class="px-4 py-3"><span class="bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded-full">New</span></td>
                                        <td class="px-4 py-3">2023-06-18</td>
                                        <td class="px-4 py-3">
                                            <button class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300 mr-2">View</button>
                                            <button class="text-green-600 hover:text-green-800 dark:text-green-400 dark:hover:text-green-300">Contact</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                `;
            }, 800);
        });
    </script>
</body>
</html>