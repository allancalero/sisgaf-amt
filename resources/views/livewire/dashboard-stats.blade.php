<div class="p-4 bg-white dark:bg-neutral-900 rounded-lg border border-neutral-200 dark:border-neutral-700">
    <div class="flex items-center justify-between mb-3">
        <flux:heading size="md">Resumen</flux:heading>
        <flux:text class="text-sm">Cantidad de registros</flux:text>
    </div>

    <div class="grid grid-cols-4 gap-3 mb-4">
        <div class="p-3 bg-gray-50 dark:bg-neutral-800 rounded-md flex items-center justify-between">
            <div>
                <div class="text-sm text-gray-500">Proyectos</div>
                <div class="flex items-center gap-2">
                    <div id="proyectos-count" class="text-2xl font-semibold text-gray-900 dark:text-white">{{ $proyectos }}</div>
                    <div id="proyectos-loader" class="hidden">
                        <svg class="h-5 w-5 animate-spin text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
                        </svg>
                    </div>
                </div>
            </div>
            <div class="text-3xl text-blue-600">
                <!-- folder SVG -->
                <svg class="w-8 h-8" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M3 7a2 2 0 012-2h4l2 2h6a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2V7z" stroke="#2563EB" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
            </div>
        </div>

        <div class="p-3 bg-gray-50 dark:bg-neutral-800 rounded-md flex items-center justify-between">
            <div>
                <div class="text-sm text-gray-500">Responsables (Total)</div>
                <div class="flex items-center gap-2">
                    <div id="responsables-count" class="text-2xl font-semibold text-gray-900 dark:text-white">{{ $responsables }}</div>
                    <div id="responsables-loader" class="hidden">
                        <svg class="h-5 w-5 animate-spin text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
                        </svg>
                    </div>
                </div>
            </div>
            <div class="text-3xl text-green-600">
                <!-- users SVG -->
                <svg class="w-8 h-8" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M17 21v-2a4 4 0 00-4-4H9a4 4 0 00-4 4v2" stroke="#059669" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><circle cx="12" cy="7" r="4" stroke="#059669" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
            </div>
        </div>

        <div class="p-3 bg-gray-50 dark:bg-neutral-800 rounded-md flex items-center justify-between">
            <div>
                <div class="text-sm text-gray-500">Responsables Activos</div>
                <div class="flex items-center gap-2">
                    <div id="responsables-active-count" class="text-2xl font-semibold text-gray-900 dark:text-white">{{ $responsables_active ?? 0 }}</div>
                    <div id="responsables-active-loader" class="hidden">
                        <svg class="h-5 w-5 animate-spin text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
                        </svg>
                    </div>
                </div>
            </div>
            <div class="text-3xl text-green-600">
                <svg class="w-8 h-8" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M17 21v-2a4 4 0 00-4-4H9a4 4 0 00-4 4v2" stroke="#059669" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><circle cx="12" cy="7" r="4" stroke="#059669" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
            </div>
        </div>

        <div class="p-3 bg-gray-50 dark:bg-neutral-800 rounded-md flex items-center justify-between">
            <div>
                <div class="text-sm text-gray-500">Responsables Inactivos</div>
                <div class="flex items-center gap-2">
                    <div id="responsables-inactive-count" class="text-2xl font-semibold text-gray-900 dark:text-white">{{ $responsables_inactive ?? 0 }}</div>
                    <div id="responsables-inactive-loader" class="hidden">
                        <svg class="h-5 w-5 animate-spin text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
                        </svg>
                    </div>
                </div>
            </div>
            <div class="text-3xl text-gray-600">
                <svg class="w-8 h-8" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M17 21v-2a4 4 0 00-4-4H9a4 4 0 00-4 4v2" stroke="#6B7280" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><circle cx="12" cy="7" r="4" stroke="#6B7280" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
            </div>
        </div>
    </div>

    <div class="w-full">
        <canvas id="dashboard-stats-chart" width="400" height="180"></canvas>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        (function(){
            const ctx = document.getElementById('dashboard-stats-chart').getContext('2d');
            const initialData = [@json($proyectos), @json($responsables)];
            const data = {
                labels: ['Proyectos','Responsables'],
                datasets: [{
                    label: 'Conteo',
                    data: initialData,
                    backgroundColor: ['#2563EB','#059669'],
                }]
            };

            const config = {
                type: 'bar',
                data: data,
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: { beginAtZero: true, ticks: { precision:0 } }
                    }
                }
            };

            // destroy existing chart if re-rendered by Livewire
            if (window._dashboardStatsChart) {
                try { window._dashboardStatsChart.destroy(); } catch(e){}
            }

            window._dashboardStatsChart = new Chart(ctx, config);

            // Listen for server-dispatched browser events to update counts and chart
            window.addEventListener('dashboard-updated', function(e){
                const detail = e.detail || (e.originalEvent && e.originalEvent.detail) || {};
                const proyectos = detail.proyectos ?? null;
                const responsables = detail.responsables ?? null;

                if (proyectos !== null) {
                    const el = document.getElementById('proyectos-count');
                    if (el) el.textContent = proyectos;
                }
                if (responsables !== null) {
                    const el2 = document.getElementById('responsables-count');
                    if (el2) el2.textContent = responsables;
                }

                if (typeof detail.responsables_active !== 'undefined') {
                    const a = document.getElementById('responsables-active-count');
                    if (a) a.textContent = detail.responsables_active;
                }
                if (typeof detail.responsables_inactive !== 'undefined') {
                    const b = document.getElementById('responsables-inactive-count');
                    if (b) b.textContent = detail.responsables_inactive;
                }

                if (window._dashboardStatsChart && proyectos !== null && responsables !== null) {
                    window._dashboardStatsChart.data.datasets[0].data = [proyectos, responsables];
                    window._dashboardStatsChart.update();
                }

                // hide loaders after update
                ['proyectos','responsables','responsables-active','responsables-inactive'].forEach(id => {
                    const loader = document.getElementById(id + '-loader');
                    if (loader) loader.classList.add('hidden');
                });
            });

            // When server components dispatch a "dashboard-refresh" browser event,
            // show loaders and trigger a Livewire client emit so the DashboardStats component refreshes counts server-side.
            window.addEventListener('dashboard-refresh', function(){
                // show per-card loaders
                ['proyectos','responsables','responsables-active','responsables-inactive'].forEach(id => {
                    const loader = document.getElementById(id + '-loader');
                    if (loader) loader.classList.remove('hidden');
                });

                if (window.Livewire) {
                    window.Livewire.emit('dashboardRefresh');
                }
            });
        })();
    </script>
</div>
