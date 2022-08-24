<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.0/jquery.js"></script>

<script type="text/javascript">
    // STORE - Validation
    $('body').on('click', '#createForm', function(){

    var novoCampus = $("#adicionarCampus");
    var formData = novoCampus.serialize();

    $( '#nome_campus-error' ).html( "" );
    $( '#estado_id-error' ).html( "" );

        $.ajax({
            url:"{{ route('campus.store') }}",
            type:'POST',
            data:formData,
            success:function(data) {
                console.log(data);
                if(data.errors) {
                    if(data.errors.nome_campus){
                        $( '#nome_campus-error' ).html( data.errors.nome_campus[0] );
                    }
                    if(data.errors.estado_id){
                        $( '#estado_id-error' ).html( data.errors.estado_id[0] );
                    } 
                }
                if(data.success) {
                    window.location.href="{{route('campus.index')}}";
                }
            },
        });
    });

    // EDIT - Validation
    $('body').on('click', '#updateForm', function(){
    
    var editarCampus = $("#editarCampus");
    var formData = editarCampus.serialize();

    $('#estado_id-error-edit').html( "" );
    $('#codigo_usuario-error-edit').html( "" );

    $.ajax({
        url:"{{ route('campus.update') }}",
        type:'POST',
        data:formData,
        success:function(data) {
                if(data.errors) {
                    if(data.errors.estado_id){
                        $('#estado_id-error-edit').html( data.errors.estado_id[0] );
                    }

                    if(data.errors.nome_campus){
                        $('#nome_campus-error-edit').html( data.errors.nome_campus[0] );
                    }        
                }

                if(data.success) {
                    window.location.href="{{route('campus.index')}}";
                }
            },
        });
    });

    // EDIT - GET Dados para editar
    $(document).ready(function() {
        $(document).on('click', '.editbtn', function() {
 
            var campus_id = $(this).val();

            $('#editarDadosCampus').modal('show');

            $.ajax({
                type: 'GET',
                url: 'campus/' +campus_id+ '/edit',

                success: function(response) {
                    $('#campus_id').val(response.campus.id);

                    $('#nome_campus_edit').val(response.campus.nome_campus);
                    $("span[name='nome_campus']").text(response.campus.nome_campus)
             
                    $("#estado_id_edit option[data-value='" + response.estado.estado +"']").attr("selected","selected");
                }
            });
        });
    });
</script>