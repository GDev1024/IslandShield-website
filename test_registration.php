<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test Registration - IslandShield</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 600px; margin: 50px auto; padding: 20px; }
        .result { padding: 15px; margin: 10px 0; border-radius: 5px; }
        .success { background: #d4edda; border: 1px solid #c3e6cb; color: #155724; }
        .error { background: #f8d7da; border: 1px solid #f5c6cb; color: #721c24; }
        button { padding: 10px 20px; background: #007bff; color: white; border: none; cursor: pointer; }
        button:hover { background: #0056b3; }
        pre { background: #f4f4f4; padding: 10px; overflow-x: auto; }
    </style>
</head>
<body>
    <h1>🛡️ IslandShield - Connection Test</h1>
    
    <h2>Step 1: Test Database Connection</h2>
    <button onclick="testConnection()">Test Connection</button>
    <div id="connectionResult"></div>
    
    <h2>Step 2: Test Registration Handler</h2>
    <button onclick="testRegistration()">Test Registration</button>
    <div id="registrationResult"></div>
    
    <h2>Step 3: Test Login Handler</h2>
    <button onclick="testLogin()">Test Login</button>
    <div id="loginResult"></div>

    <script>
        async function testConnection() {
            const resultDiv = document.getElementById('connectionResult');
            resultDiv.innerHTML = '<p>Testing...</p>';
            
            try {
                const response = await fetch('test_connection.php');
                const data = await response.json();
                
                resultDiv.innerHTML = `
                    <div class="result ${data.db_connected ? 'success' : 'error'}">
                        <h3>Connection Test Results:</h3>
                        <pre>${JSON.stringify(data, null, 2)}</pre>
                    </div>
                `;
            } catch (error) {
                resultDiv.innerHTML = `
                    <div class="result error">
                        <h3>Error:</h3>
                        <p>${error.message}</p>
                    </div>
                `;
            }
        }
        
        async function testRegistration() {
            const resultDiv = document.getElementById('registrationResult');
            resultDiv.innerHTML = '<p>Testing registration...</p>';
            
            const formData = new FormData();
            formData.append('firstName', 'Test');
            formData.append('lastName', 'User');
            formData.append('email', 'test' + Date.now() + '@example.com');
            formData.append('phone', '4735551234');
            formData.append('address', '123 Test St');
            formData.append('parish', 'St. Andrew');
            formData.append('propertyType', 'residential');
            formData.append('password', 'TestPass123!');
            formData.append('confirmPassword', 'TestPass123!');
            
            try {
                const response = await fetch('includes/registration_handler.php', {
                    method: 'POST',
                    body: formData
                });
                
                const text = await response.text();
                console.log('Raw response:', text);
                
                try {
                    const data = JSON.parse(text);
                    resultDiv.innerHTML = `
                        <div class="result ${data.success ? 'success' : 'error'}">
                            <h3>Registration Test:</h3>
                            <p><strong>Success:</strong> ${data.success}</p>
                            <p><strong>Message:</strong> ${data.message || 'None'}</p>
                            ${data.errors ? '<p><strong>Errors:</strong> ' + data.errors.join(', ') + '</p>' : ''}
                            <details>
                                <summary>Full Response</summary>
                                <pre>${JSON.stringify(data, null, 2)}</pre>
                            </details>
                        </div>
                    `;
                } catch (e) {
                    resultDiv.innerHTML = `
                        <div class="result error">
                            <h3>Invalid JSON Response:</h3>
                            <p>The server returned non-JSON data. This usually means a PHP error.</p>
                            <details>
                                <summary>Raw Response</summary>
                                <pre>${text}</pre>
                            </details>
                        </div>
                    `;
                }
            } catch (error) {
                resultDiv.innerHTML = `
                    <div class="result error">
                        <h3>Network Error:</h3>
                        <p>${error.message}</p>
                        <p>This usually means the request couldn't reach the server.</p>
                    </div>
                `;
            }
        }
        
        async function testLogin() {
            const resultDiv = document.getElementById('loginResult');
            resultDiv.innerHTML = '<p>Testing login...</p>';
            
            const formData = new FormData();
            formData.append('email', 'garysonwalker@test.com');
            formData.append('password', 'password123');
            
            try {
                const response = await fetch('includes/login_handler.php', {
                    method: 'POST',
                    body: formData
                });
                
                const text = await response.text();
                console.log('Raw response:', text);
                
                try {
                    const data = JSON.parse(text);
                    resultDiv.innerHTML = `
                        <div class="result ${data.success ? 'success' : 'error'}">
                            <h3>Login Test:</h3>
                            <p><strong>Success:</strong> ${data.success}</p>
                            <p><strong>Message:</strong> ${data.message}</p>
                            <details>
                                <summary>Full Response</summary>
                                <pre>${JSON.stringify(data, null, 2)}</pre>
                            </details>
                        </div>
                    `;
                } catch (e) {
                    resultDiv.innerHTML = `
                        <div class="result error">
                            <h3>Invalid JSON Response:</h3>
                            <p>The server returned non-JSON data.</p>
                            <details>
                                <summary>Raw Response</summary>
                                <pre>${text}</pre>
                            </details>
                        </div>
                    `;
                }
            } catch (error) {
                resultDiv.innerHTML = `
                    <div class="result error">
                        <h3>Network Error:</h3>
                        <p>${error.message}</p>
                    </div>
                `;
            }
        }
    </script>
</body>
</html>
