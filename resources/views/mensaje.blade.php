<!--notificacion de confirmacion -->
@if (Session::has('success'))
    <script>
        Swal.fire({
            icon: 'success',
            text: '{{ Session::get('success') }}',
            showConfirmButton: false,
            timer: 2000
        });
    </script>
@endif
<!--notificación de error -->
@if (Session::has('error'))
    <script>
        Swal.fire({
            icon: 'error',
            text: '{{ Session::get('error') }}',
            showConfirmButton: false,
            timer: 2000
        });
    </script>
@endif
<!--notificacion de warning -->
@if (Session::has('message'))
    <script>
        Swal.fire({
            icon: 'warning',
            text: '{{ Session::get('message') }}',
            showConfirmButton: false,
            timer: 2000
        });
    </script>
@endif