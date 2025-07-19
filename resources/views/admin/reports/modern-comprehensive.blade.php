@extends('layouts.admin')

@section('title', 'Comprehensive Business Report')

@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
<style>
  .report-header { background: linear-gradient(90deg, #667eea 0%, #764ba2 100%); color: #fff; padding: 2rem 1rem 1rem; border-radius: 0 0 24px 24px; text-align: center; }
  .report-logo { max-height: 60px; margin-bottom: 1rem; }
  .report-section { margin: 2rem 0; }
  .section-title { color: #764ba2; font-weight: 700; margin-bottom: 1rem; font-size: 1.3rem; }
  .report-footer { background: #f8fafc; color: #888; text-align: center; padding: 1rem; border-radius: 16px; margin-top: 2rem; font-size: 0.95rem; }
  .table thead { background: #e9ecef; }
  .insight-card { background: #f3f0fa; border-left: 4px solid #764ba2; padding: 1rem 1.5rem; border-radius: 12px; margin-bottom: 1rem; }
</style>
@endpush

@section('content')
<div class="container my-4">
  <div class="report-header">
    <img src="/images/company-logo.png" alt="Company Logo" class="report-logo">
    <h1>Comprehensive Business Report</h1>
    <div>{{ $dateRange['label'] ?? '' }}</div>
    <div class="mt-2"><small>Generated: {{ now()->format('F j, Y \\a\\t g:i A') }}</small></div>
  </div>

  <!-- Executive Summary -->
  <div class="report-section">
    <div class="section-title">Executive Summary</div>
    <div class="row g-3">
      <div class="col-md-4">
        <div class="insight-card">
          <strong>Total Revenue:</strong> ${{ number_format($data['financial_overview']['total_revenue'], 2) }}<br>
          <strong>Revenue Growth:</strong>
          @if($data['financial_overview']['revenue_growth'] == 0)
            Revenue remained unchanged (0.0%) compared to last period.
          @elseif($data['financial_overview']['revenue_growth'] > 0)
            Up {{ number_format($data['financial_overview']['revenue_growth'], 1) }}% from last period.
          @else
            Down {{ number_format(abs($data['financial_overview']['revenue_growth']), 1) }}% from last period.
          @endif
        </div>
      </div>
      <div class="col-md-4">
        <div class="insight-card">
          <strong>Total Sales:</strong> {{ number_format($data['financial_overview']['total_sales']) }}<br>
          <strong>Average Sale Value:</strong> ${{ number_format($data['financial_overview']['average_sale_value'], 2) }}
        </div>
      </div>
      <div class="col-md-4">
        <div class="insight-card">
          <strong>Profit Margin:</strong> {{ number_format($data['financial_overview']['profit_margin'], 1) }}%<br>
          <strong>Sales Growth:</strong> {{ number_format($data['financial_overview']['sales_growth'], 1) }}%
        </div>
      </div>
    </div>
  </div>

  <!-- Revenue Trends Chart -->
  <div class="report-section">
    <div class="section-title">Revenue Trends</div>
    <canvas id="revenueChart" height="80"></canvas>
  </div>

  <!-- Product Performance Table & Chart -->
  <div class="report-section">
    <div class="section-title">Product Performance (All Products)</div>
    <div class="table-responsive">
      <table class="table table-bordered table-striped">
        <thead><tr><th>Model</th><th>Line</th><th>Type</th><th>Sales</th><th>Revenue</th><th>Avg Price</th></tr></thead>
        <tbody>
        @foreach($data['top_products'] as $p)
          <tr>
            <td>{{ $p['model_name'] }}</td>
            <td>{{ $p['line'] }}</td>
            <td>{{ $p['type'] }}</td>
            <td>{{ $p['sales_count'] }}</td>
            <td>${{ number_format($p['total_revenue'], 2) }}</td>
            <td>${{ number_format($p['avg_price'], 2) }}</td>
          </tr>
        @endforeach
        </tbody>
      </table>
    </div>
    <canvas id="productChart" height="80"></canvas>
  </div>

  <!-- Staff Performance Table -->
  <div class="report-section">
    <div class="section-title">Staff Performance (All Staff)</div>
    <div class="table-responsive">
      <table class="table table-bordered table-striped">
        <thead><tr><th>Name</th><th>Role</th><th>Sales</th><th>Revenue</th></tr></thead>
        <tbody>
        @foreach($data['staff_performance'] as $s)
          <tr>
            <td>{{ \Illuminate\Support\Str::title(collect(explode(' ', preg_replace('/\s+/', ' ', $s['name'])))->unique()->implode(' ')) }}</td>
            <td>{{ $s['role'] === 'admin' ? 'Admin' : 'Employee' }}</td>
            <td>{{ $s['sales_count'] }}</td>
            <td>${{ number_format($s['total_revenue'], 2) }}</td>
          </tr>
        @endforeach
        </tbody>
      </table>
    </div>
  </div>
  <!-- Regional Performance Table -->
  <div class="report-section">
    <div class="section-title">Regional Performance (All Regions)</div>
    <div class="table-responsive">
      <table class="table table-bordered table-striped">
        <thead><tr><th>City</th><th>Country</th><th>Owners</th><th>Sales</th><th>Revenue</th></tr></thead>
        <tbody>
        @foreach($data['regional_data'] as $r)
          <tr>
            <td>{{ $r['city'] ?? '' }}</td>
            <td>{{ $r['country'] ?? '' }}</td>
            <td>{{ $r['owner_count'] }}</td>
            <td>{{ $r['sales_count'] }}</td>
            <td>${{ number_format($r['total_revenue'], 2) }}</td>
          </tr>
        @endforeach
        </tbody>
      </table>
    </div>
  </div>

  <!-- Regional Sales Pie Chart -->
  <div class="report-section">
    <div class="section-title">Regional Sales Distribution</div>
    <canvas id="regionChart" height="80"></canvas>
  </div>

  <!-- Strategic Insights -->
  <div class="report-section">
    <div class="section-title">Strategic Insights</div>
    <ul>
      @php
        $topProduct = $data['top_products'][0] ?? null;
        $totalRevenue = $data['financial_overview']['total_revenue'] ?? 0;
        $topProductShare = $topProduct && $totalRevenue > 0 ? ($topProduct['total_revenue'] / $totalRevenue) * 100 : 0;
      @endphp
      @if($topProductShare > 90)
        <li><strong>Alert:</strong> Over 90% of revenue comes from {{ $topProduct['model_name'] }}. CEO should consider diversifying product focus to reduce risk.</li>
      @endif
      <li>
        @if($data['financial_overview']['revenue_growth'] > 10)
          <strong>Growth:</strong> Revenue is growing rapidly. CEO should invest in scaling top-performing products and regions.
        @elseif($data['financial_overview']['revenue_growth'] < 0)
          <strong>Decline:</strong> Revenue is falling. CEO should review underperforming areas and adjust strategy.
        @else
          <strong>Stable:</strong> Revenue is flat. CEO should explore new markets or innovations for future growth.
        @endif
      </li>
      <li>
        @if($data['totals']['contact_messages'] > 100)
          <strong>Engagement:</strong> Customer inquiries are high. CEO should ensure support teams are resourced to maintain satisfaction.
        @else
          <strong>Engagement:</strong> Customer engagement is normal.
        @endif
      </li>
    </ul>
  </div>

  <div class="report-footer">
    <div>CONFIDENTIAL BUSINESS REPORT | For Internal Use Only</div>
    <div>© {{ now()->year }} Company Name. All rights reserved.</div>
    <div>Generated: {{ now()->format('F j, Y \\a\\t g:i A') }}</div>
  </div>
</div>

<!-- Chart.js CDN -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
  // Revenue Trends
  const revenueCtx = document.getElementById('revenueChart').getContext('2d');
  new Chart(revenueCtx, {
    type: 'line',
    data: {
      labels: {!! json_encode(collect($data['monthly_trends'])->pluck('month')) !!},
      datasets: [{
        label: 'Revenue',
        data: {!! json_encode(collect($data['monthly_trends'])->pluck('revenue')) !!},
        borderColor: '#667eea',
        backgroundColor: 'rgba(102,126,234,0.1)',
        fill: true,
        tension: 0.3
      }]
    },
    options: { plugins: { legend: { display: false } } }
  });

  // Product Performance (all products)
  const productCtx = document.getElementById('productChart').getContext('2d');
  new Chart(productCtx, {
    type: 'bar',
    data: {
      labels: {!! json_encode(collect($data['top_products'])->pluck('model_name')) !!},
      datasets: [{
        label: 'Revenue',
        data: {!! json_encode(collect($data['top_products'])->pluck('total_revenue')) !!},
        backgroundColor: '#764ba2'
      }]
    },
    options: {
      plugins: { legend: { display: false } },
      scales: { x: { title: { display: true, text: 'Product' } }, y: { title: { display: true, text: 'Revenue ($)' } } }
    }
  });

  // Regional Sales (all regions)
  const regionCtx = document.getElementById('regionChart').getContext('2d');
  new Chart(regionCtx, {
    type: 'pie',
    data: {
      labels: {!! json_encode(collect($data['regional_data'])->map(function($r){return ($r['city'] ?? '').' '.($r['country'] ?? '');})) !!},
      datasets: [{
        label: 'Sales',
        data: {!! json_encode(collect($data['regional_data'])->pluck('sales_count')) !!},
        backgroundColor: [ '#36A2EB', '#FF6384', '#FFCE56', '#764ba2', '#667eea', '#48bb78', '#ed8936', '#38a169', '#bada55', '#e17055', '#00b894', '#fdcb6e', '#0984e3', '#6c5ce7', '#00cec9', '#d63031', '#fab1a0', '#636e72', '#fd79a8', '#e84393', '#2d3436' ]
      }]
    },
    options: { plugins: { legend: { position: 'bottom' } } }
  });
});
</script>
@endsection
