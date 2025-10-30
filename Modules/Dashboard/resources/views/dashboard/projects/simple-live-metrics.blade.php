<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Live Metrics - Horizon Pulse</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .container { max-width: 1200px; margin: 0 auto; }
        .card { border: 1px solid #ddd; border-radius: 8px; padding: 20px; margin: 10px 0; }
        .loading { text-align: center; padding: 40px; }
        .spinner { border: 4px solid #f3f3f3; border-top: 4px solid #3498db; border-radius: 50%; width: 40px; height: 40px; animation: spin 2s linear infinite; margin: 0 auto; }
        @keyframes spin { 0% { transform: rotate(0deg); } 100% { transform: rotate(360deg); } }
        .project-card { display: inline-block; width: 300px; margin: 10px; vertical-align: top; }
        .status-active { color: green; }
        .status-warning { color: orange; }
        .status-error { color: red; }
        .refresh-btn { background: #007bff; color: white; border: none; padding: 10px 20px; border-radius: 4px; cursor: pointer; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Live Metrics - Horizon Pulse</h1>
        <button id="refresh-metrics" class="refresh-btn">Refresh</button>
        
        <div id="metrics-container">
            <div class="loading">
                <div class="spinner"></div>
                <p>Loading metrics...</p>
            </div>
        </div>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        let refreshInterval;
        
        function loadMetrics() {
            fetch('/dashboard/test-metrics')
                .then(response => response.json())
                .then(data => {
                    updateMetricsGrid(data);
                })
                .catch(error => {
                    console.error('Error fetching metrics:', error);
                    document.getElementById('metrics-container').innerHTML = `
                        <div class="card">
                            <h3>Error Loading Metrics</h3>
                            <p>Failed to fetch metrics data: ${error.message}</p>
                            <button onclick="loadMetrics()" class="refresh-btn">Try Again</button>
                        </div>
                    `;
                });
        }
        
        function updateMetricsGrid(metrics) {
            const container = document.getElementById('metrics-container');
            
            if (!metrics || metrics.length === 0) {
                container.innerHTML = `
                    <div class="card">
                        <h3>No Projects Found</h3>
                        <p>No projects are configured yet.</p>
                    </div>
                `;
                return;
            }
            
            let html = '';
            
            metrics.forEach(metric => {
                const statusClass = getStatusClass(metric.status);
                const statusIcon = getStatusIcon(metric.status);
                
                html += `
                    <div class="project-card card">
                        <h3>${metric.project_name}</h3>
                        <p><strong>Environment:</strong> ${metric.environment}</p>
                        <p><strong>Status:</strong> <span class="${statusClass}">${statusIcon} ${metric.status.charAt(0).toUpperCase() + metric.status.slice(1)}</span></p>
                        <p><strong>Failed Jobs:</strong> <span class="${metric.failed_jobs?.count > 0 ? 'status-error' : 'status-active'}">${metric.failed_jobs?.count || 0}</span></p>
                        <p><strong>Last Updated:</strong> ${new Date(metric.last_updated).toLocaleTimeString()}</p>
                        <p><strong>Note:</strong> ${metric.note || 'No notes'}</p>
                    </div>
                `;
            });
            
            container.innerHTML = html;
        }
        
        function getStatusClass(status) {
            switch(status) {
                case 'active': return 'status-active';
                case 'warning': return 'status-warning';
                default: return 'status-error';
            }
        }
        
        function getStatusIcon(status) {
            switch(status) {
                case 'active': return '✅';
                case 'warning': return '⚠️';
                default: return '❌';
            }
        }
        
        // Manual refresh button
        document.getElementById('refresh-metrics').addEventListener('click', function() {
            loadMetrics();
        });
        
        // Initial load
        loadMetrics();
        
        // Set up auto-refresh every 30 seconds
        refreshInterval = setInterval(loadMetrics, 30000);
        
        // Clean up on page unload
        window.addEventListener('beforeunload', function() {
            if (refreshInterval) {
                clearInterval(refreshInterval);
            }
        });
    });
    </script>
</body>
</html>
