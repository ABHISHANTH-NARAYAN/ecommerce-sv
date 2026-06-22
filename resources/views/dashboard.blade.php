<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-white leading-tight">
            Admin Dashboard
        </h2>
    </x-slot>

<style>
    body {
        background: #0f172a; /* dark slate */
        color: #e5e7eb;
    }

    .container {
        padding: 25px;
    }

    /* STATS GRID */
    .stats {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
        gap: 20px;
        margin-bottom: 30px;
    }

    .card {
        background: #111827;
        border-radius: 16px;
        padding: 20px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.4);
        border: 1px solid #1f2937;
        transition: 0.2s;
    }

    .card:hover {
        transform: translateY(-3px);
        border-color: #374151;
    }

    .card h3 {
        font-size: 13px;
        color: #9ca3af;
        margin-bottom: 10px;
    }

    .card h1 {
        font-size: 28px;
        margin: 0;
        color: #f9fafb;
    }

    /* LINKS */
    .links {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        margin: 25px 0;
    }

    .links a {
        background: #111827;
        padding: 10px 14px;
        border-radius: 10px;
        text-decoration: none;
        color: #c7d2fe;
        font-weight: 600;
        border: 1px solid #1f2937;
        transition: 0.2s;
    }

    .links a:hover {
        background: #4f46e5;
        color: white;
        border-color: #4f46e5;
    }

    .btn-primary {
        background: #2563eb !important;
        color: white !important;
        border: none !important;
    }

    /* SECTIONS */
    .section {
        background: #111827;
        padding: 20px;
        border-radius: 16px;
        border: 1px solid #1f2937;
        box-shadow: 0 10px 30px rgba(0,0,0,0.3);
        margin-bottom: 30px;
    }

    .section h2 {
        color: #f9fafb;
        margin-bottom: 15px;
    }

    ul {
        margin: 0;
        padding-left: 20px;
    }

    ul li {
        padding: 6px 0;
        color: #d1d5db;
    }

    /* CHART */
    .chart-box {
        height: 380px;
        background: #0b1220;
        border-radius: 12px;
        padding: 10px;
        border: 1px solid #1f2937;
    }

    /* HEADER override */
    header {
        background: #0f172a !important;
        border-bottom: 1px solid #1f2937;
    }

    @media(max-width: 768px) {
        .card h1 {
            font-size: 22px;
        }
    }
</style>

<div class="container">

    <!-- STATS -->
    <div class="stats">

        <div class="card">
            <h3>Total Products</h3>
            <h1>{{ $products }}</h1>
        </div>

        <div class="card">
            <h3>Total Reviews</h3>
            <h1>{{ $reviews }}</h1>
        </div>

        <div class="card">
            <h3>Total Enquiries</h3>
            <h1>{{ $enquiries }}</h1>
        </div>

        <div class="card">
            <h3>Total Registrations</h3>
            <h1>{{ $registrations }}</h1>
        </div>

        <div class="card">
            <h3>Total News</h3>
            <h1>{{ $news }}</h1>
        </div>

        <div class="card">
            <h3>Total Orders</h3>
            <h1>{{ \App\Models\Order::count() }}</h1>
        </div>

    </div>

    <!-- LINKS -->
    <div class="links">

        <a href="{{ route('admin.products.index') }}">Products</a>
        <a href="{{ route('admin.reviews.index') }}">Reviews</a>
        <a href="{{ route('admin.enquiries.index') }}">Enquiries</a>
        <a href="{{ route('admin.registrations.index') }}">Registrations</a>
        <a href="{{ route('admin.news.index') }}">News</a>

        <a href="{{ route('admin.orders.index') }}" class="btn-primary">
            Manage Orders
        </a>

    </div>

    <!-- RECENT ORDERS -->
    <div class="section">

        <h2>Recent Orders</h2>

        @php
            $latestOrders = \App\Models\Order::latest()->take(5)->get();
        @endphp

        <ul>
            @forelse($latestOrders as $order)
                <li>
                    Order #{{ $order->id }} —
                    ₹{{ number_format($order->total ?? 0, 2) }} —
                    {{ $order->created_at->format('d M Y') }}
                </li>
            @empty
                <li>No orders yet.</li>
            @endforelse
        </ul>

    </div>

    <!-- CHART -->
    <div class="section">

        <h2>Business Analytics</h2>

        <div class="chart-box">
            <canvas id="dashboardChart"></canvas>
        </div>

    </div>

</div>

<!-- CHART -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
const months = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];

const reviewData = @json($reviewChart ?? array_fill(0,12,0));
const enquiryData = @json($enquiryChart ?? array_fill(0,12,0));
const registrationData = @json($registrationChart ?? array_fill(0,12,0));

new Chart(document.getElementById('dashboardChart'), {
    type: 'line',
    data: {
        labels: months,
        datasets: [
            {
                label: 'Reviews',
                data: reviewData,
                borderColor: '#60a5fa',
                backgroundColor: 'rgba(96, 165, 250, 0.1)',
                tension: 0.4,
                fill: true
            },
            {
                label: 'Enquiries',
                data: enquiryData,
                borderColor: '#34d399',
                backgroundColor: 'rgba(52, 211, 153, 0.1)',
                tension: 0.4,
                fill: true
            },
            {
                label: 'Registrations',
                data: registrationData,
                borderColor: '#fbbf24',
                backgroundColor: 'rgba(251, 191, 36, 0.1)',
                tension: 0.4,
                fill: true
            }
        ]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                labels: {
                    color: '#e5e7eb'
                }
            }
        },
        scales: {
            x: {
                ticks: { color: '#9ca3af' },
                grid: { color: '#1f2937' }
            },
            y: {
                ticks: { color: '#9ca3af' },
                grid: { color: '#1f2937' }
            }
        }
    }
});
</script>

</x-app-layout>