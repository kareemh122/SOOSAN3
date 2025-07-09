@extends('layouts.admin')

@section('title', 'System Activity Dashboard')

@section('content')
<div class="container-fluid">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col-md-12">
            <div class="d-flex justify-content-between align-items-center">
                <h1 class="h3 mb-0">
                    <i class="fas fa-chart-bar text-primary"></i>
                    System Activity Dashboard
                </h1>
                <div class="btn-group">
                    <a href="{{ route('admin.audit-logs.index') }}" class="btn btn-primary">
                        <i class="fas fa-list"></i> View All Logs
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Activity Charts Row -->
    <div class="row mb-4">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">
                        <i class="fas fa-chart-line"></i>
                        Daily Activity (Last 7 Days)
                    </h5>
                </div>
                <div class="card-body">
                    <canvas id="dailyActivityChart" height="100"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">
                        <i class="fas fa-chart-pie"></i>
                        Event Types (Last 30 Days)
                    </h5>
                </div>
                <div class="card-body">
                    <canvas id="eventTypesChart" height="150"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats Row -->
    <div class="row mb-4">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">
                        <i class="fas fa-database"></i>
                        Most Active Models (Last 30 Days)
                    </h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th>Model</th>
                                    <th>Activity Count</th>
                                    <th>Percentage</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $totalModelActivity = $modelStats->sum('count'); @endphp
                                @foreach($modelStats as $stat)
                                    <tr>
                                        <td>
                                            <strong>{{ class_basename($stat->auditable_type) }}</strong>
                                        </td>
                                        <td>{{ number_format($stat->count) }}</td>
                                        <td>
                                            @php $percentage = $totalModelActivity > 0 ? ($stat->count / $totalModelActivity) * 100 : 0; @endphp
                                            <div class="progress" style="height: 20px;">
                                                <div class="progress-bar" role="progressbar" style="width: {{ $percentage }}%">
                                                    {{ number_format($percentage, 1) }}%
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">
                        <i class="fas fa-users"></i>
                        Most Active Users (Last 30 Days)
                    </h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th>User</th>
                                    <th>Activity Count</th>
                                    <th>Percentage</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $totalUserActivity = $activeUsers->sum('count'); @endphp
                                @foreach($activeUsers as $userStat)
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="avatar avatar-sm bg-primary text-white rounded-circle me-2">
                                                    {{ substr($userStat->user->name, 0, 1) }}
                                                </div>
                                                <strong>{{ $userStat->user->name }}</strong>
                                            </div>
                                        </td>
                                        <td>{{ number_format($userStat->count) }}</td>
                                        <td>
                                            @php $percentage = $totalUserActivity > 0 ? ($userStat->count / $totalUserActivity) * 100 : 0; @endphp
                                            <div class="progress" style="height: 20px;">
                                                <div class="progress-bar bg-success" role="progressbar" style="width: {{ $percentage }}%">
                                                    {{ number_format($percentage, 1) }}%
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Activity -->
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">
                        <i class="fas fa-clock"></i>
                        Recent Activity
                    </h5>
                    <span class="badge bg-primary">{{ $recentLogs->count() }} latest entries</span>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Time</th>
                                    <th>User</th>
                                    <th>Event</th>
                                    <th>Model</th>
                                    <th>Summary</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recentLogs as $log)
                                    <tr>
                                        <td>
                                            <span class="text-muted small">{{ $log->created_at->format('H:i:s') }}</span>
                                            <br>
                                            <small class="text-muted">{{ $log->created_at->diffForHumans() }}</small>
                                        </td>
                                        <td>
                                            @if($log->user)
                                                <div class="d-flex align-items-center">
                                                    <div class="avatar avatar-sm bg-primary text-white rounded-circle me-2">
                                                        {{ substr($log->user->name, 0, 1) }}
                                                    </div>
                                                    <div>
                                                        <div class="fw-bold small">{{ $log->user->name }}</div>
                                                        <small class="text-muted">{{ ucfirst($log->user->role) }}</small>
                                                    </div>
                                                </div>
                                            @else
                                                <span class="text-muted">System</span>
                                            @endif
                                        </td>
                                        <td>
                                            @php
                                                $eventColors = [
                                                    'created' => 'success',
                                                    'updated' => 'warning',
                                                    'deleted' => 'danger',
                                                    'restored' => 'info'
                                                ];
                                                $color = $eventColors[$log->event] ?? 'secondary';
                                            @endphp
                                            <span class="badge bg-{{ $color }}">
                                                {{ ucfirst($log->event) }}
                                            </span>
                                        </td>
                                        <td>
                                            <div>
                                                <span class="fw-bold">{{ class_basename($log->auditable_type) }}</span>
                                                <small class="text-muted d-block">ID: {{ $log->auditable_id }}</small>
                                            </div>
                                        </td>
                                        <td>
                                            @if($log->new_values && count($log->new_values) > 0)
                                                @php
                                                    $changedFields = collect($log->new_values)->keys()->take(3);
                                                @endphp
                                                <small class="text-muted">
                                                    Changed: {{ $changedFields->implode(', ') }}
                                                    @if(count($log->new_values) > 3)
                                                        <span class="badge bg-light text-dark">+{{ count($log->new_values) - 3 }} more</span>
                                                    @endif
                                                </small>
                                            @else
                                                <small class="text-muted">{{ ucfirst($log->event) }} {{ class_basename($log->auditable_type) }}</small>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.audit-logs.show', $log) }}" class="btn btn-sm btn-outline-primary">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer text-center">
                    <a href="{{ route('admin.audit-logs.index') }}" class="btn btn-primary">
                        View All Activity Logs
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.avatar {
    width: 32px;
    height: 32px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 14px;
    font-weight: bold;
}
</style>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
// Daily Activity Chart
const dailyActivityCtx = document.getElementById('dailyActivityChart').getContext('2d');
const dailyActivityChart = new Chart(dailyActivityCtx, {
    type: 'line',
    data: {
        labels: {!! json_encode($dailyActivity->pluck('date')) !!},
        datasets: [{
            label: 'Activity Count',
            data: {!! json_encode($dailyActivity->pluck('count')) !!},
            borderColor: 'rgb(75, 192, 192)',
            backgroundColor: 'rgba(75, 192, 192, 0.2)',
            tension: 0.1,
            fill: true
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        scales: {
            y: {
                beginAtZero: true
            }
        },
        plugins: {
            legend: {
                display: false
            }
        }
    }
});

// Event Types Chart
const eventTypesCtx = document.getElementById('eventTypesChart').getContext('2d');
const eventTypesChart = new Chart(eventTypesCtx, {
    type: 'doughnut',
    data: {
        labels: {!! json_encode($eventStats->pluck('event')->map(function($event) { return ucfirst($event); })) !!},
        datasets: [{
            data: {!! json_encode($eventStats->pluck('count')) !!},
            backgroundColor: [
                '#28a745', // created - green
                '#ffc107', // updated - yellow
                '#dc3545', // deleted - red
                '#17a2b8', // restored - blue
                '#6f42c1', // other - purple
                '#fd7e14'  // other - orange
            ]
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                position: 'bottom'
            }
        }
    }
});
</script>
@endsection
