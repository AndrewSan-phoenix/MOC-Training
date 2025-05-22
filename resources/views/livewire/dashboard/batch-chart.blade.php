



<div class="bg-white shadow-md rounded-md p-6 mt-6">
    <h2 class="text-xl font-bold mb-4 text-gray-800">Most Attended Batches</h2>

    <div>
        <canvas id="batchChart" height="100"></canvas>
    </div>
</div>

<script>
    document.addEventListener('livewire:init', function () {
        const ctx = document.getElementById('batchChart');
        if (!ctx) return;

        const chart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: @json($labels),
                datasets: @json($dataset)
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                },
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: 'Batches'
                        }
                    },
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Number of Enrolled Students'
                        }
                    }
                }
            }
        });

        Livewire.on('updateChart', data => {
            chart.data = data;
            chart.update();
        });
    });
</script>


    

    


