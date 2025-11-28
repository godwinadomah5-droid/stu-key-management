<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KeySecure - STU University</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .navbar { background: #2c3e50; color: white; padding: 1rem; }
        .navbar-content { max-width: 1200px; margin: 0 auto; display: flex; justify-content: space-between; align-items: center; }
        .logo { font-size: 1.5rem; font-weight: bold; }
        .nav-links a { color: white; text-decoration: none; margin-left: 2rem; }
        .hero { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 4rem 2rem; text-align: center; }
        .container { max-width: 1200px; margin: 0 auto; padding: 2rem; }
        .stats { display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 2rem; margin: 3rem 0; }
        .stat-card { background: white; padding: 2rem; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); text-align: center; }
        .features { display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 2rem; margin: 3rem 0; }
        .feature-card { background: #f8f9fa; padding: 2rem; border-radius: 8px; border-left: 4px solid #667eea; }
        .btn { display: inline-block; background: #667eea; color: white; padding: 0.75rem 1.5rem; text-decoration: none; border-radius: 5px; margin: 0.5rem; transition: background 0.3s; }
        .btn:hover { background: #5a6fd8; }
        .btn-secondary { background: #6c757d; }
        .btn-secondary:hover { background: #5a6268; }
        .footer { background: #2c3e50; color: white; text-align: center; padding: 2rem; margin-top: 3rem; }
    </style>
</head>
<body>
    <!-- Simple Public Navbar - No Dashboard Links -->
    <nav class="navbar">
        <div class="navbar-content">
            <div class="logo">KeySecure</div>
            <div class="nav-links">
                <a href="/login">Sign In</a>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero">
        <h1>KeySecure</h1>
        <p>STU University</p>
        <h2>Secure Key Management for STU University</h2>
        <p>Enterprise-grade encryption key management and security monitoring system. Protect your digital assets with state-of-the-art security infrastructure.</p>
        <div style="margin-top: 2rem;">
            <!-- ONLY public buttons - no dashboard links -->
            <a href="/login" class="btn">Launch Dashboard</a>
            <a href="#learn-more" class="btn btn-secondary">Learn More</a>
        </div>
    </section>

    <div class="container">
        <div class="stats">
            <div class="stat-card">
                <h3>99.9%</h3>
                <p>System Uptime</p>
            </div>
            <div class="stat-card">
                <h3>A+</h3>
                <p>Security Rating</p>
            </div>
            <div class="stat-card">
                <h3>24/7</h3>
                <p>Monitoring</p>
            </div>
            <div class="stat-card">
                <h3>0</h3>
                <p>Active Threats</p>
            </div>
        </div>

        <div class="features">
            <div class="feature-card">
                <h3>Advanced Security</h3>
                <p>Military-grade encryption and multi-layered security protocols to protect your cryptographic keys and sensitive data.</p>
                <ul>
                    <li>AES-256 Encryption</li>
                    <li>Multi-factor Authentication</li>
                    <li>Role-based Access Control</li>
                </ul>
            </div>
            <div class="feature-card">
                <h3>Real-time Monitoring</h3>
                <p>Comprehensive monitoring dashboard with live activity feeds, threat detection, and instant security alerts.</p>
                <ul>
                    <li>Live Activity Tracking</li>
                    <li>Threat Intelligence</li>
                    <li>Automated Alerts</li>
                </ul>
            </div>
            <div class="feature-card">
                <h3>Enterprise Management</h3>
                <p>Complete key lifecycle management, audit trails, compliance reporting, and centralized administration.</p>
                <ul>
                    <li>Key Lifecycle Management</li>
                    <li>Comprehensive Auditing</li>
                    <li>Compliance Ready</li>
                </ul>
            </div>
        </div>

        <!-- Trust Section -->
        <div style="text-align: center; margin: 4rem 0; padding: 3rem; background: #f8f9fa; border-radius: 8px;">
            <h3 style="margin-bottom: 2rem; color: #2c3e50;">Trusted by STU University</h3>
            <p style="margin-bottom: 2rem; color: #666;">
                Protecting academic data, research materials, and institutional information with the highest security standards.
            </p>
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1rem; margin-top: 2rem;">
                <div style="text-align: center;">
                    <div style="font-size: 2rem; margin-bottom: 0.5rem;">🔒</div>
                    <strong>End-to-End Encryption</strong>
                </div>
                <div style="text-align: center;">
                    <div style="font-size: 2rem; margin-bottom: 0.5rem;">🛡️</div>
                    <strong>Zero Trust Architecture</strong>
                </div>
                <div style="text-align: center;">
                    <div style="font-size: 2rem; margin-bottom: 0.5rem;">📊</div>
                    <strong>24/7 Security Operations</strong>
                </div>
                <div style="text-align: center;">
                    <div style="font-size: 2rem; margin-bottom: 0.5rem;">✅</div>
                    <strong>FIPS 140-2 Compliant</strong>
                </div>
            </div>
        </div>

        <!-- Call to Action -->
        <div style="text-align: center; margin: 3rem 0; padding: 3rem; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; border-radius: 8px;">
            <h3 style="margin-bottom: 1rem;">Ready to Secure Your Systems?</h3>
            <p style="margin-bottom: 2rem; opacity: 0.9;">
                Join STU University's secure key management platform and protect your digital infrastructure today.
            </p>
            <!-- ONLY public button -->
            <a href="/login" class="btn" style="background: white; color: #667eea;">Get Started Now</a>
        </div>

        <!-- Security Features Footer -->
        <div style="text-align: center; margin-top: 2rem; padding: 2rem; background: #2c3e50; color: white; border-radius: 8px;">
            <p style="margin-bottom: 1rem;">
                <strong>Secure authentication • Instant access • Enterprise security</strong>
            </p>
        </div>
    </div>

    <footer class="footer">
        <p>KeySecure</p>
        <p>STU University</p>
        <p>© 2024 STU University. All rights reserved. | Privacy Policy • Terms of Service</p>
    </footer>

    <script>
        // Smooth scrolling for Learn More link
        document.querySelector('a[href="#learn-more"]')?.addEventListener('click', function(e) {
            e.preventDefault();
            document.querySelector('.features').scrollIntoView({ 
                behavior: 'smooth' 
            });
        });

        // Display current year in footer
        document.querySelector('footer p:last-child').innerHTML = 
            document.querySelector('footer p:last-child').innerHTML.replace('2024', new Date().getFullYear());
    </script>
</body>
</html>