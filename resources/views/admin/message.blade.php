@if (Session::has('error'))
    <div class="alert alert-danger alert-dismissible" id="errorAlert">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        {{ Session::get('error') }}
    </div>
@endif

@if (Session::has('success'))
    <div class="alert alert-success alert-dismissible" id="successAlert">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        {{ Session::get('success') }}
    </div>
@endif

<script>
    // Function to close alerts after 3 seconds
    function closeAlert(alertId) {
        setTimeout(function () {
            $(alertId).alert('close');
        }, 3000);
    }

    // Automatically close error and success alerts
    @if (Session::has('error'))
        closeAlert("#errorAlert");
    @endif

    @if (Session::has('success'))
        closeAlert("#successAlert");
    @endif
</script>
