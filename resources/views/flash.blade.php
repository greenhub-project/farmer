@if (Session::has('flash_message'))
    <script type="text/javascript">
        swal({
            title: "{{ Session::get('flash_message.title') }}",
            text: "{{ Session::get('flash_message.text') }}",
            icon: "{{ Session::get('flash_message.type') }}",
            timer: 2000,
            buttons: false,
        });
    </script>
@endif

@if (Session::has('flash_overlay'))
    <script type="text/javascript">
        swal({
            title: "{{ Session::get('flash_overlay.title') }}",
            text: "{{ Session::get('flash_overlay.text') }}",
            icon: "{{ Session::get('flash_overlay.type') }}",
            button: "Ok",
        });
    </script>
@endif