{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.0/jquery.js"></script>

<script type="text/javascript">
    // STORE - Validation
    $('body').on('click', '#createForm', function() {

        var novoCampus = $("#adicionarCampus");
        var formData = novoCampus.serialize();

        $('#nome_campus-error').html("");
        $('#estado_id-error').html("");

        $.ajax({
            url: "{{ route('campus.store') }}",
            type: 'POST',
            data: formData,
            success: function(data) {
                console.log(data);
                if (data.errors) {
                    if (data.errors.nome_campus) {
                        $('#nome_campus-error').html(data.errors.nome_campus[0]);
                    }
                    if (data.errors.estado_id) {
                        $('#estado_id-error').html(data.errors.estado_id[0]);
                    }
                }
                if (data.success) {
                    window.location.href = "{{ route('campus.index') }}";
                }
            },
        });
    });
</script> --}}
