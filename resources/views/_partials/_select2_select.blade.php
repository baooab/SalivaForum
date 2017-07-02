<link rel="stylesheet" type="text/css" href="{{ asset('css/select2.min.css') }}">
<script type="text/javascript" src="{{ asset('js/select2.min.js') }}"></script>
<script type="text/javascript">
    // refer: https://select2.github.io/examples.html
    $(".categories").select2({
        maximumSelectionLength: 3
    });
</script>