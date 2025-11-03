<script>
    @if (Session::has('message'))
        let responseTitle = "{!!  Session::get('title') !!}"
        let responseMessage = "{!! Session::get('message') !!}"
        let responseIcon = "{!! Session::get('icon') !!}"
        let responseStatus = "{!! Session::get('status') !!}"

        $.notify({
            title: responseTitle,
            message: responseMessage,
            icon: responseIcon,
        }, {
            // settings
            type: responseStatus,
            z_index: 2000,
            animate: {
                enter: 'animated bounceInDown',
                exit: 'animated bounceOutUp'
            }
        });
    @endif
</script>
