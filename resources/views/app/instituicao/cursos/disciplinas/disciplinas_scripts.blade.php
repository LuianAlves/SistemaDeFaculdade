<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.0/jquery.js"></script>

<script type="text/javascript">
    // STORE - Validation
    $('body').on('click', '#createForm', function(){

    var novaDisciplina = $("#adicionarDisciplina");
    var formData = novaDisciplina.serialize();

    $( '#area_conhecimento_id-error' ).html( "" );
    
    $( '#disciplina-error' ).html( "" );
    $( '#modalidade-error' ).html( "" );
    $( '#duracao_horas-error' ).html( "" );

        $.ajax({
            url:"{{ route('disciplinas.store') }}",
            type:'POST',
            data:formData,
            success:function(data) {
                // console.log(data);
                if(data.errors) {
                    if(data.errors.area_conhecimento_id){
                        $( '#area_conhecimento_id-error' ).html( data.errors.area_conhecimento_id[0] );
                    }

                    if(data.errors.disciplina){
                        $( '#disciplina-error' ).html( data.errors.disciplina[0] );
                    }
                    
                    if(data.errors.modalidade){
                        $( '#modalidade-error' ).html( data.errors.modalidade[0] );
                    }
                    
                    if(data.errors.duracao_horas){
                        $( '#duracao_horas-error' ).html( data.errors.duracao_horas[0] );
                    }
                    
                }
                if(data.success) {
                    window.location.href="{{route('disciplinas.index')}}";
                }
            },
        });
    });

    // EDIT - Validation
    $('body').on('click', '#updateForm', function(){
    
    var editarDisciplina = $("#editarDisciplina");
    var formData = editarDisciplina.serialize();

    $( '#area_conhecimento_id-error-edit' ).html( "" );
    
    $( '#disciplina-error-edit' ).html( "" );
    $( '#modalidade-error-edit' ).html( "" );
    $( '#duracao_horas-error-edit' ).html( "" );

    $.ajax({
        url:"{{ route('disciplinas.update') }}",
        type:'POST',
        data:formData,
        success:function(data) {
            if(data.errors) {
                console.log(data.errors)
                    if(data.errors.area_conhecimento_id){
                        $( '#area_conhecimento_id-error-edit' ).html( data.errors.area_conhecimento_id[0] );
                    }

                    if(data.errors.disciplina){
                        $( '#disciplina-error-edit' ).html( data.errors.disciplina[0] );
                    }
                    
                    if(data.errors.modalidade){
                        $( '#modalidade-error-edit' ).html( data.errors.modalidade[0] );
                    }
                    
                    if(data.errors.duracao_horas){
                        $( '#duracao_horas-error-edit' ).html( data.errors.duracao_horas[0] );
                    }
                    
                }
                if(data.success) {
                    window.location.href="{{route('disciplinas.index')}}";
                }
            },
        });
    });

    // EDIT - GET Dados para editar
    $(document).ready(function() {
        $(document).on('click', '.editbtn', function() {
 
            var disciplina_id = $(this).val();

            $('#editarDadosDisciplina').modal('show');

            $.ajax({
                type: 'GET',
                url: 'disciplinas/' +disciplina_id+ '/edit',

                success: function(response) {
                    $('#disciplina_id').val(response.disciplina.id);

                    $('#disciplina_edit').val(response.disciplina.disciplina);

                    $('#duracao_horas_edit').val(response.disciplina.duracao_horas);

                    $("input[name='modalidade'][value='" + response.disciplina.modalidade + "']").prop("checked",true);

                    console.log(response.classificacaoCursos.area_conhecimento)

                    $("#area_conhecimento_id_edit option[data-value='" + response.classificacaoCursos.area_conhecimento +"']").attr("selected","selected");
                }
            });
        });
    });


    // Show - Registro de Usuários
    function visualizarDisciplina(id) {
        $.ajax({
            type: 'GET',
            url: 'disciplinas/'+id,
            dataType: 'json',

            success: function(data) {

                $("span[name='disciplina']").text(data.disciplina.disciplina);

                if(data.disciplina.modalidade == 'AVA') {
                    $("span[name='ava']").text(data.disciplina.modalidade);
                } else {
                    $("span[name='presencial']").text(data.disciplina.modalidade);
                }

                $("span[name='duracao_horas']").text(data.disciplina.duracao_horas)
                
                $('#codigo_disciplina').text(data.disciplina.codigo_disciplina)

                $("span[name='area_conhecimento_id']").text(data.classificacaoCursos.area_conhecimento)
            }
        })
    }

</script>