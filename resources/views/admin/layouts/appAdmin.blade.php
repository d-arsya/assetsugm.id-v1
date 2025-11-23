<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    @vite('resources/css/stylesAdmin.css')
    <style>
        html,
        body {
            overflow-x: hidden;
        }

        .user-info {
            font-weight: 100px;
            font-size: 18px;
        }

        #button {
            background-color: #115C5B;
            color: white;
        }

        #buttonred {
            background-color: #FFE0E0;
            color: #D30000;
        }

        #buttonredreverse {
            background-color: #D30000;
            color: #FFE0E0;
        }

        #buttonedit {
            background-color: #CDFFCD;
            color: #007F00;
        }

        .pagination .page-item.active .page-link {
            background-color: #115C5B;
            border-color: #115C5B;
            color: white;
        }

        .pagination .page-link {
            color: #115C5B;
        }

        .pagination .page-link:hover {
            background-color: #115C5B;
            border-color: #115C5B;
            color: white;
        }

        #logout {
            background-color: white;
            border: 1px solid #115C5B;
        }

        #logout:hover {
            background-color: #115C5B;
            color: white
        }
    </style>
</head>

<body>
    <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">
        @include('admin.layouts.sidebar')

        <!--  Main wrapper -->
        <div class="body-wrapper">

            <div class="container-fluid">
                @yield('content')
            </div>

            <script src="{{ asset('libs/jquery/dist/jquery.min.js') }}"></script>
            <script src="{{ asset('libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
            <script src="{{ asset('js/sidebarmenu.js') }}"></script>
            <script src="{{ asset('js/app.min.js') }}"></script>
            <script src="{{ asset('libs/apexcharts/dist/apexcharts.min.js') }}"></script>
            <script src="{{ asset('libs/simplebar/dist/simplebar.js') }}"></script>
            <script src="{{ asset('js/dashboard.js') }}"></script>
        </div>
        @yield('scripts')
        <script>
            //Handling invalid form submission
            (() => {
                'use strict';

                // Fetch all the forms we want to apply custom Bootstrap validation styles to
                const forms = document.querySelectorAll('.needs-validation');

                // Loop over them and prevent submission
                Array.from(forms).forEach(form => {
                    form.addEventListener('submit', event => {
                        if (!form.checkValidity()) {
                            event.preventDefault();
                            event.stopPropagation();
                        }

                        form.classList.add('was-validated');
                    }, false);
                });
            })();

            function searchTable() {
                // Ambil input dari user
                var input = document.getElementById("searchInput");
                var filter = input.value.toLowerCase();
                var tableBody = document.getElementById("TableBody");
                var rows = tableBody.getElementsByTagName("tr");

                // Looping semua baris tabel
                for (var i = 0; i < rows.length; i++) {
                    var cols = rows[i].getElementsByTagName("td");
                    var found = false;

                    // Looping setiap kolom di baris
                    for (var j = 0; j < cols.length; j++) {
                        if (cols[j]) {
                            var txtValue = cols[j].textContent || cols[j].innerText;
                            if (txtValue.toLowerCase().indexOf(filter) > -1) {
                                found = true;
                                break;
                            }
                        }
                    }

                    // Tampilkan atau sembunyikan baris berdasarkan hasil pencarian
                    rows[i].style.display = found ? "" : "none";
                }
            }
        </script>
</body>

</html>
