@if ($errors->any())

    @foreach($errors->all() as $error)

        <script>

            new Noty({
                text: '{{$error}}',
                type:'error',
                timeout: 2000,
                animation: {
                    open: 'animated bounceInRight', // Animate.css class names
                    close: 'animated bounceOutRight' // Animate.css class names
                }
            }).show();
        </script>

    @endforeach
@endif


@if ( session('success') )

    <script>

        new Noty({
            theme: 'sunset',
            type: 'success',
            layout: 'topRight',
            text: "{{ session('success') }}",
            timeout: 2000,
            killer: true
        }).show();

    </script>
@endif

@if ( session('error') )

    <script>
        new Noty({
            theme: 'sunset',
            type: 'error',
            layout: 'topRight',
            text: "{{  session('error') }}",
            timeout: 2000,
            killer: true
        }).show();
    </script>
@endif

@if ( session('warning') )

    <script>
        new Noty({
            theme: 'sunset',
            type: 'warning',
            layout: 'topRight',
            text: "{{  session('warning') }}",
            timeout: 2000,
            killer: true
        }).show();
    </script>
@endif

