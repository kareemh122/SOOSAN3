@extends('layouts.admin')

@section('title', 'Test Notifications')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Test Notification System</h4>
                    <p class="text-muted">Use these buttons to test different types of notifications.</p>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div class="card border-primary">
                                <div class="card-header bg-primary text-white">
                                    <h6 class="mb-0">Admin Notifications</h6>
                                </div>
                                <div class="card-body">
                                    <p>These notifications will be sent to all admin users:</p>
                                    
                                    <button type="button" class="btn btn-info btn-sm mb-2" onclick="testNotification('contact')">
                                        <i class="fas fa-envelope"></i> Test Contact Message
                                    </button><br>
                                    
                                    <button type="button" class="btn btn-warning btn-sm mb-2" onclick="testNotification('pending')">
                                        <i class="fas fa-clock"></i> Test Pending Change
                                    </button><br>
                                    
                                    <button type="button" class="btn btn-danger btn-sm mb-2" onclick="testNotification('audit')">
                                        <i class="fas fa-exclamation-triangle"></i> Test Important Audit Log
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <div class="card border-success">
                                <div class="card-header bg-success text-white">
                                    <h6 class="mb-0">Employee Notifications</h6>
                                </div>
                                <div class="card-body">
                                    <p>These notifications will be sent to employees:</p>
                                    
                                    <button type="button" class="btn btn-success btn-sm mb-2" onclick="testNotification('approval')">
                                        <i class="fas fa-check-circle"></i> Test Approval Notification
                                    </button><br>
                                    
                                    <button type="button" class="btn btn-danger btn-sm mb-2" onclick="testNotification('rejection')">
                                        <i class="fas fa-times-circle"></i> Test Rejection Notification
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="alert alert-info">
                        <h6><i class="fas fa-info-circle"></i> How to Test:</h6>
                        <ol>
                            <li>Click any of the test buttons above</li>
                            <li>Check the notification bell icon in the top navigation</li>
                            <li>You should see a red badge with the notification count</li>
                            <li>Click the notification bell to see the dropdown</li>
                            <li>Visit the <a href="{{ route('notifications.index') }}">notifications page</a> to see all notifications</li>
                        </ol>
                    </div>

                    <div id="testResults" class="mt-3"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
async function testNotification(type) {
    const button = event.target;
    const originalText = button.innerHTML;
    button.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Sending...';
    button.disabled = true;
    
    try {
        const response = await fetch(`/test-notifications/${type}`, {
            method: 'GET',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        });
        
        const data = await response.json();
        
        if (data.success) {
            showResult('success', data.message);
            // Update notification badge if the manager exists
            if (window.notificationManager) {
                setTimeout(() => {
                    window.notificationManager.loadNotifications();
                }, 1000);
            }
        } else {
            showResult('error', data.error || 'Failed to send notification');
        }
    } catch (error) {
        showResult('error', 'Network error: ' + error.message);
    } finally {
        button.innerHTML = originalText;
        button.disabled = false;
    }
}

function showResult(type, message) {
    const resultsDiv = document.getElementById('testResults');
    const alertClass = type === 'success' ? 'alert-success' : 'alert-danger';
    const icon = type === 'success' ? 'check-circle' : 'exclamation-circle';
    
    resultsDiv.innerHTML = `
        <div class="alert ${alertClass} alert-dismissible fade show">
            <i class="fas fa-${icon}"></i> ${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    `;
    
    // Auto-hide after 5 seconds
    setTimeout(() => {
        const alert = resultsDiv.querySelector('.alert');
        if (alert) {
            alert.classList.remove('show');
            setTimeout(() => {
                alert.remove();
            }, 300);
        }
    }, 5000);
}
</script>
@endsection
