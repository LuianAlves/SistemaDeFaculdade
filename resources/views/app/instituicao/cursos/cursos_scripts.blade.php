<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.0/jquery.js"></script>

<script type="text/javascript">
    // STORE - Validation
    $('body').on('click', '#createForm', function(){

    var novoCurso = $("#adicionarCurso");
    var formData = novoCurso.serialize();

    $( '#grau_instrucao_id-error' ).html( "" );
    
    $( '#curso-error' ).html( "" );
    $( '#descricao-error' ).html( "" );
    $( '#quantidade_semestres-error' ).html( "" );
    $( '#duracao_total_horas-error' ).html( "" );

        $.ajax({
            url:"{{ route('cursos.store') }}",
            type:'POST',
            data:formData,
            success:function(data) {
                // console.log(data);
                if(data.errors) {
                    if(data.errors.grau_instrucao_id){
                        $( '#grau_instrucao_id-error' ).html( data.errors.grau_instrucao_id[0] );
                    }

                    if(data.errors.curso){
                        $( '#curso-error' ).html( data.errors.curso[0] );
                    }

                    if(data.errors.descricao){
                        $( '#descricao-error' ).html( data.errors.descricao[0] );
                    }

                    if(data.errors.quantidade_semestres){
                        $( '#quantidade_semestres-error' ).html( data.errors.quantidade_semestres[0] );
                    }

                    if(data.errors.duracao_total_horas){
                        $( '#duracao_total_horas-error' ).html( data.errors.duracao_total_horas[0] );
                    }
                    
                }
                if(data.success) {
                    window.location.href="{{route('cursos.index')}}";
                }
            },
        });
    });

    // EDIT - Validation
    $('body').on('click', '#updateForm', function(){
    
    var editarCurso = $("#editarCurso");
    var formData = editarCurso.serialize();

    $( '#grau_instrucao_id-error-edit' ).html( "" );
    
    $( '#curso-error-edit' ).html( "" );
    $( '#descricao-error-edit' ).html( "" );
    $( '#quantidade_semestres-error-edit' ).html( "" );
    $( '#duracao_total_horas-error-edit' ).html( "" );

    $.ajax({
        url:"{{ route('cursos.update') }}",
        type:'POST',
        data:formData,
        success:function(data) {
            if(data.errors) {
                if(data.errors.grau_instrucao_id){
                    $( '#grau_instrucao_id-error-edit' ).html( data.errors.grau_instrucao_id[0] );
                }

                if(data.errors.curso){
                    $( '#curso-error-edit' ).html( data.errors.curso[0] );
                }

                if(data.errors.descricao){
                    $( '#descricao-error-edit' ).html( data.errors.descricao[0] );
                }

                if(data.errors.quantidade_semestres){
                    $( '#quantidade_semestres-error-edit' ).html( data.errors.quantidade_semestres[0] );
                }

                if(data.errors.duracao_total_horas){
                    $( '#duracao_total_horas-error-edit' ).html( data.errors.duracao_total_horas[0] );
                }                   
            }

            if(data.success) {
                window.location.href="{{route('cursos.index')}}";
            }
        },
        });
    });

    // EDIT - GET Dados para editar
    $(document).ready(function() {
        $(document).on('click', '.editbtn', function() {
 
            var curso_id = $(this).val();

            $('#editarDadosCurso').modal('show');

            $.ajax({
                type: 'GET',
                url: 'cursos/' +curso_id+ '/edit',

                success: function(response) {
                    $('#curso_id').val(response.curso.id);

                    $('#curso_edit').val(response.curso.curso);

                    $("span[name='curso_titulo']").text(response.curso.curso);
                    
                    $('#quantidade_semestres_edit').val(response.curso.quantidade_semestres);
             
                    $('#duracao_total_horas_edit').val(response.curso.duracao_total_horas);
             
                    $('#descricao_edit').val(response.curso.descricao);
             
                    $("#grau_instrucao_id_edit option[data-value='" + response.grauInstrucao.grau_instrucao +"']").attr("selected","selected");
                }
            });
        });
    });

    // SHOW - Visualizar Cursos
    function visualizarCurso(id) {
        $.ajax({
            type: 'GET',
            url: 'cursos/'+id,
            dataType: 'json',

            success: function(data) {

                console.log(data.curso)

                $("span[name='curso']").text(data.curso.curso);

                $("span[name='quantidade_semestres']").text(data.curso.quantidade_semestres)
                
                $("span[name='duracao_total_horas']").text(data.curso.duracao_total_horas)

                $("span[name='grau_instrucao']").text(data.grauInstrucao.grau_instrucao)

                $("span[name='descricao']").text(data.curso.descricao)
            }
        })
    }
</script>