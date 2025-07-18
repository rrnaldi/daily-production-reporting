@extends('layout.app')

@section('title', 'Dashboard Supervisor')

@section('content')
    <h2>Selamat Datang, Supervisor {{ Auth::user()->name }}</h2>
    <h4 class="mt-4">Grafik Total Produksi (30 Hari Terakhir)</h4>
    <canvas id="grafikProduksi" height="100"></canvas>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        fetch("{{ url('/api/production-summary') }}?start={{ now()->subDays(30)->format('Y-m-d') }}&end={{ now()->format('Y-m-d') }}")
            .then(response => response.json())
            .then(data => {
                const labels = data.map(row => row.tanggal);
                const values = data.map(row => row.total_output);

                new Chart(document.getElementById('grafikProduksi'), {
                    type: 'bar',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'Qty Output',
                            data: values,
                            backgroundColor: 'rgba(75, 192, 192, 0.7)'
                        }]
                    },
                    options: {
                        responsive: true,
                        scales: {
                            y: { beginAtZero: true }
                        }
                    }
                });
            })
            .catch(error => {
                console.error('Gagal mengambil data:', error);
            });
    });
</script>


@endsection
