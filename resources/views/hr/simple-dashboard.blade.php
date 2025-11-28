<!DOCTYPE html>
<html>
<head>
    <title>Simple Dashboard Test</title>
</head>
<body>
    <h1>Simple Dashboard Test</h1>
    <p>If you can see this, the dashboard is working!</p>
    <p>User: {{ Auth::user()->name }}</p>
    <p>Email: {{ Auth::user()->email }}</p>
    
    <h2>Quick Links:</h2>
    <ul>
        <li><a href="/hr/dashboard">Full Dashboard</a></li>
        <li><a href="/check-auth">Check Auth Status</a></li>
        <li><a href="/logout" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a></li>
    </ul>
    
    <form id="logout-form" action="/logout" method="POST" style="display: none;">
        @csrf
    </form>
</body>
</html>