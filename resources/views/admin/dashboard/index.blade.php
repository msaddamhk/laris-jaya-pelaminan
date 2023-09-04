@extends('Layout.admin.main')

@section('content')
    <h5>Dashboard</h5>

    <hr class="mb-4">

    <div class="row">
        {{-- <div class="col-md-6 mb-4">
            <div class="card p-4">
                <h6 class="fw-bold">Jumlah Pemasukan Perminggu</h6>
                <h6>Rp {{ number_format($totalPemasukanPerMinggu) }}</h6>
            </div>
        </div>
        <div class="col-md-6 mb-4">
            <div class="card p-4">
                <h6 class="fw-bold">Jumlah Keuntungan Perminggu</h6>
                <h6>Rp {{ number_format($totalKeuntunganPerMinggu) }}</h6>
            </div>
        </div> --}}

        <div class="col-md-6 mb-4">
            <div class="card p-4">
                <h6 class="fw-bold">Jumlah Jasa</h6>
                <h6>{{ $hitung_jasa }} Jasa</h6>
            </div>
        </div>
        <div class="col-md-6 mb-4">
            <div class="card p-4">
                <h6 class="fw-bold">Jumlah Vendor</h6>
                <h6>{{ $hitung_vendor }} Vendor</h6>
            </div>
        </div>
        <div class="col-md-6 mb-4">
            <div class="card p-4">
                <h6 class="fw-bold">Jumlah Pemasukan Bulan ini</h6>
                <h6>Rp {{ number_format($totalPemasukanPerBulan) }}</h6>
            </div>
        </div>
        <div class="col-md-6 mb-4">
            <div class="card p-4">
                <h6 class="fw-bold">Jumlah Keuntungan Bulan ini</h6>
                <h6>Rp {{ number_format($totalKeuntunganPerBulan) }}</h6>
            </div>
        </div>
        <div class="col-md-6 mb-4">
            <div class="card p-4">
                <h6 class="fw-bold">Jumlah Pemasukan Keseluruhan</h6>
                <h6>Rp {{ number_format($totalPemasukanKeseluruhan) }}</h6>
            </div>
        </div>
        <div class="col-md-6 mb-4">
            <div class="card p-4">
                <h6 class="fw-bold">Jumlah Keuntungan Keseluruhan</h6>
                <h6>Rp {{ number_format($totalKeuntunganKeseluruhan) }}</h6>
            </div>
        </div>
    </div>

    <hr>

    <canvas id="grafikKeuntungan"></canvas>

    <script>
        var data = {
            labels: {!! json_encode($labels) !!},
            datasets: [{
                label: 'Keuntungan',
                data: {!! json_encode($keuntunganPerBulan) !!},
                backgroundColor: [
                    'rgba(255, 206, 86, 0.5)',
                    'rgba(54, 162, 235, 0.5)',
                    'rgba(255, 99, 132, 0.5)',
                    'rgba(75, 192, 192, 0.5)',
                    'rgba(139, 125, 174, 0.5)',
                    'rgba(209, 124, 150, 0.5)',
                    'rgba(255, 159, 64, 0.5)',
                    'rgba(106, 187, 170, 0.5)',
                    'rgba(153, 102, 255, 0.5)',
                    'rgba(241, 130, 141, 0.5)',
                    'rgba(176, 102, 173, 0.5)',
                    'rgba(127, 179, 213, 0.5)'
                ],
                borderWidth: 1
            }, {
                label: 'Pemasukan',
                data: {!! json_encode($pemasukanPerBulan) !!},
                backgroundColor: [
                    'rgba(54, 162, 235, 0.5)',
                    'rgba(176, 102, 173, 0.5)',
                    'rgba(241, 130, 141, 0.5)',
                    'rgba(255, 159, 64, 0.5)',
                    'rgba(255, 99, 132, 0.5)',
                    'rgba(106, 187, 170, 0.5)',
                    'rgba(139, 125, 174, 0.5)',
                    'rgba(209, 124, 150, 0.5)',
                    'rgba(75, 192, 192, 0.5)',
                    'rgba(153, 102, 255, 0.5)',
                    'rgba(255, 206, 86, 0.5)',
                    'rgba(127, 179, 213, 0.5)'
                ],
                borderWidth: 1
            }]
        };

        // Menginisialisasi grafik menggunakan Chart.js
        var ctx = document.getElementById('grafikKeuntungan').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: data,
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
@endsection
