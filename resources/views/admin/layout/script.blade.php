<!--   Core JS Files   -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('admin/assets/js/core/appointments.js') }}"></script>
    <script src="{{ asset('admin/assets/js/plugins/choices.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/core/popper.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/core/bootstrap.min.js') }}"></script>
    <script src="{{ asset('admin/cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js') }}"></script>
    <script src="{{ asset('admin/maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/plugins/dropzone.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/plugins/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/plugins/smooth-scrollbar.min.js') }}"></script>
    <!-- Kanban scripts -->
    <script src="{{ asset('admin/assets/js/plugins/fullcalendar.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/plugins/dragula/dragula.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/plugins/jkanban/jkanban.js') }}"></script>
    <script src="{{ asset('admin/assets/js/plugins/chartjs.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/plugins/threejs.js') }}"></script>
    <script src="{{ asset('admin/assets/js/plugins/orbit-controls.js') }}"></script>
    <script src="{{ asset('admin/assets/js/plugins/datatables.js') }}"></script>
    <script>
        var calendar = new FullCalendar.Calendar(document.getElementById("calendar"), {
            contentHeight: 'auto',
            initialView: "dayGridMonth",
            headerToolbar: {
                start: 'title', // will normally be on the left. if RTL, will be on the right
                center: '',
                end: 'today prev,next' // will normally be on the right. if RTL, will be on the left
            },
            selectable: true,
            editable: true,
            initialDate: '2020-12-01',
            events: [{
                title: 'Dr john Doe',
                start: '2020-11-18',
                end: '2020-11-18',
                time: '9:00 AM',
                className: 'bg-gradient-danger'
            },

            {
                title: 'Dr john Doe',
                start: '2020-11-21',
                end: '2020-11-22',
                time: '9:00 AM',
                className: 'bg-gradient-warning'
            },

            {
                title: 'Dr john Doe',
                start: '2020-11-29',
                end: '2020-11-29',
                time: '9:00 AM',
                className: 'bg-gradient-success'
            },

            {
                title: 'Dr john Doe',
                start: '2020-12-01',
                end: '2020-12-01',
                time: '9:00 AM',
                className: 'bg-gradient-info'
            },

            {
                title: 'Dr john Doe',
                start: '2020-12-03',
                end: '2020-12-03',
                time: '9:00 AM',
                className: 'bg-gradient-danger'
            },

            {
                title: 'Dr john Doe',
                start: '2020-12-07',
                end: '2020-12-09',
                  time:'9:00 AM',
                className: 'bg-gradient-warning'
            },

            {
                title: 'Dr john Doe',
                start: '2020-12-10',
                end: '2020-12-10',
                  time:'9:00 AM',
                className: 'bg-primary'
            },

            {
                title: 'Dr john Doe',
                start: '2020-12-19',
                end: '2020-12-19',
                  time:'9:00 AM',
                className: 'bg-gradient-danger'
            },

            {
                title: 'Dr john Doe',
                start: '2020-12-23',
                end: '2020-12-23',
                  time:'9:00 AM',
                className: 'bg-gradient-info'
            },

            {
                title: 'Dr john Doe',
                start: '2020-12-02',
                end: '2020-12-02',
                  time:'9:00 AM',
                className: 'bg-gradient-warning'
            },

            ],
            views: {
                month: {
                    titleFormat: {
                        month: "long",
                        year: "numeric"
                    }
                },
                agendaWeek: {
                    titleFormat: {
                        month: "long",
                        year: "numeric",
                        day: "numeric"
                    }
                },
                agendaDay: {
                    titleFormat: {
                        month: "short",
                        year: "numeric",
                        day: "numeric"
                    }
                }
            },
        });

        calendar.render();

        var ctx1 = document.getElementById("chart-line-1").getContext("2d");

        var gradientStroke1 = ctx1.createLinearGradient(0, 230, 0, 50);

        gradientStroke1.addColorStop(1, 'rgba(255,255,255,0.3)');
        gradientStroke1.addColorStop(0.2, 'rgba(72,72,176,0.0)');
        gradientStroke1.addColorStop(0, 'rgba(203,12,159,0)'); //purple colors

        new Chart(ctx1, {
            type: "line",
            data: {
                labels: ["Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                datasets: [{
                    label: "Visitors",
                    tension: 0.5,
                    borderWidth: 0,
                    pointRadius: 0,
                    borderColor: "#fff",
                    borderWidth: 2,
                    backgroundColor: gradientStroke1,
                    data: [50, 45, 60, 60, 80, 65, 90, 80, 100],
                    maxBarThickness: 6,
                    fill: true
                }],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false,
                    }
                },
                interaction: {
                    intersect: false,
                    mode: 'index',
                },
                scales: {
                    y: {
                        grid: {
                            drawBorder: false,
                            display: false,
                            drawOnChartArea: false,
                            drawTicks: false,
                        },
                        ticks: {
                            display: false
                        }
                    },
                    x: {
                        grid: {
                            drawBorder: false,
                            display: false,
                            drawOnChartArea: false,
                            drawTicks: false,
                        },
                        ticks: {
                            display: false
                        }
                    },
                },
            },
        });
    </script>
    <script>
        var win = navigator.platform.indexOf('Win') > -1;
        if (win && document.querySelector('#sidenav-scrollbar')) {
            var options = {
                damping: '0.5'
            }
            Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
        }
    </script>
    <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="{{ asset('admin/assets/js/soft-ui-dashboard.min.js?v=1.2.0') }}"></script>
    @yield('script')