@extends('layouts.app')

@section('content')
<div class="container">
    <h3 class="mb-4">Estado de los libros</h3>

    {{-- Mostrar valores para ver si llegan correctamente --}}
    <p><strong>Prestados:</strong> {{ $prestados }}</p>
    <p><strong>Disponibles:</strong> {{ $disponibles }}</p>

    {{-- Canvas con estilo para asegurar altura --}}
    <canvas id="graficoLibros" style="width: 100%; max-width: 600px; height: 300px;"></canvas>
</div>
@endsection

@section('scripts')
{{-- Chart.js CDN --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const ctx = document.getElementById('graficoLibros').getContext('2d');

        const prestados = {{ $prestados ?? 0 }};
        const disponibles = {{ $disponibles ?? 0 }};

        console.log("Prestados:", prestados);
        console.log("Disponibles:", disponibles);

        new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['Prestados', 'Disponibles'],
                datasets: [{
                    label: 'Cantidad de libros',
                    data: [prestados, disponibles],
                    backgroundColor: ['#f87171', '#34d399'],
                    borderColor: ['#ef4444', '#10b981'],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { position: 'bottom' },
                    title: {
                        display: true,
                        text: 'Libros Prestados vs Disponibles'
                    }
                }
            }
        });
    });
</script>
@endsection
