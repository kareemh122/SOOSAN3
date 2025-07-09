@extends('layouts.admin')

@section('title', 'Audit Log Details')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">Audit Log Details</h1>
        <a href="{{ route('admin.audit-logs.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Back to Audit Logs
        </a>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Basic Information</h5>
                </div>
                <div class="card-body">
                    <table class="table table-borderless">
                        <tr>
                            <th>Event:</th>
                            <td>
                                <span class="badge badge-{{ $auditLog->event === 'created' ? 'success' : ($auditLog->event === 'updated' ? 'warning' : 'danger') }}">
                                    {{ ucfirst($auditLog->event) }}
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <th>Model Type:</th>
                            <td>{{ class_basename($auditLog->auditable_type) }}</td>
                        </tr>
                        <tr>
                            <th>Record ID:</th>
                            <td>{{ $auditLog->auditable_id }}</td>
                        </tr>
                        <tr>
                            <th>User:</th>
                            <td>{{ $auditLog->user ? $auditLog->user->name . ' (#' . $auditLog->user->id . ')' : 'System' }}</td>
                        </tr>
                        <tr>
                            <th>Date/Time:</th>
                            <td>{{ $auditLog->created_at->format('Y-m-d H:i:s') }}</td>
                        </tr>
                        <tr>
                            <th>IP Address:</th>
                            <td>{{ $auditLog->ip_address ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>Method:</th>
                            <td>{{ $auditLog->method ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>URL:</th>
                            <td>{{ $auditLog->url ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>User Agent:</th>
                            <td style="word-break: break-word;">{{ Str::limit($auditLog->user_agent, 100) ?? 'N/A' }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            @if($auditLog->old_values || $auditLog->new_values)
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Data Changes</h5>
                </div>
                <div class="card-body">
                    @if($auditLog->old_values && $auditLog->event === 'updated')
                    <h6>Old Values:</h6>
                    <div class="bg-light p-3 mb-3 rounded">
                        <pre class="mb-0">{{ json_encode($auditLog->old_values, JSON_PRETTY_PRINT) }}</pre>
                    </div>
                    @endif

                    @if($auditLog->new_values)
                    <h6>{{ $auditLog->event === 'updated' ? 'New Values:' : 'Values:' }}</h6>
                    <div class="bg-light p-3 rounded">
                        <pre class="mb-0">{{ json_encode($auditLog->new_values, JSON_PRETTY_PRINT) }}</pre>
                    </div>
                    @endif

                    @if($auditLog->old_values && $auditLog->event === 'deleted')
                    <h6>Deleted Values:</h6>
                    <div class="bg-light p-3 rounded">
                        <pre class="mb-0">{{ json_encode($auditLog->old_values, JSON_PRETTY_PRINT) }}</pre>
                    </div>
                    @endif
                </div>
            </div>
            @endif
        </div>
    </div>

    @if($auditLog->event === 'updated' && $auditLog->old_values && $auditLog->new_values)
    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Field-by-Field Comparison</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Field</th>
                                    <th>Old Value</th>
                                    <th>New Value</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($auditLog->new_values as $field => $newValue)
                                <tr>
                                    <td><strong>{{ $field }}</strong></td>
                                    <td>
                                        <span class="text-danger">
                                            {{ $auditLog->old_values[$field] ?? 'N/A' }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="text-success">
                                            {{ $newValue }}
                                        </span>
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
    @endif
</div>
@endsection
