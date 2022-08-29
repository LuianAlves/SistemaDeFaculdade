<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.0/jquery.js"></script>

<script type="text/javascript">

// Select Turmas
$(document).ready(function() {
    $('select[name="curso_id"]').on('change', function() {
        var curso_id = $(this).val()
        if (curso_id) {
            $.ajax({
                url: "{{ url('/alunos/area_aluno/ajax') }}/" + curso_id,
                type: "GET",
                dataType: "json",
                success: function(data) {
                    var d = $('select[name="serie_turma"]').empty()
                    $.each(data, function(key, value) {
                        $('select[name="serie_turma"]').append('<option value="' + value.id + '">' + value.codigo_turma + '</option>')
                    })
                },
            })
        } else {
            alert('Error!')
        }
    })
})

// Show Aluno
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
})

function visualizarAluno(id) {
    $.ajax({
        type: 'GET',
        url: '/alunos/area_aluno/show/'+id,
        dataType: 'json',

        success: function(data) {

            //CADASTRO DO ALUNO
            $('#codigo_usuario').text(data.aluno.codigo_usuario)

            if(data.aluno.departamento_id == 1) {
                $('#administrativo').text('Administrativo')
            } else if(data.aluno.departamento_id == 2){
                $('#professor').text('Professor')
            } else if(data.aluno.departamento_id == 3){
                $('#estudante').text('Estudante')
            }
            
            $("span[name='nome']").text(data.aluno.nome);
            $("span[name='sobrenome']").text(data.aluno.sobrenome);
            $("span[name='telefone']").text(data.aluno.telefone);

            if(data.aluno.foto_usuario != null) {
                $('.modal-body img').attr('src', data.aluno.foto_usuario);
            } else {
                $('.modal-body img').attr('src', 'sistema/assets/adicionar_foto.png');
            }

            $("span[name='cep']").text(data.aluno.cep);
            $("span[name='nome_rua']").text(data.aluno.nome_rua + ", ");
            $("small[name='numero_casa']").text(data.aluno.numero_casa);

            $("small[name='email']").text(data.aluno.email);
            $("small[name='senha']").text(data.aluno.senha);

            console.log(data.alunoInfAdicional);

            //INFORMAÇÕES ADICIONAIS
            $('#cpf').text(data.alunoInfAdicional.cpf);
            $('#rg').text(data.alunoInfAdicional.rg);
            $('#email_pessoal').text(data.alunoInfAdicional.email_pessoal);
            $('#telefone_recado').text(data.alunoInfAdicional.telefone_recado);
            $('#nome_mae').text(data.alunoInfAdicional.nome_mae);
            $('#nome_pai').text(data.alunoInfAdicional.nome_pai);
            $('#serie_turma').text(data.alunoInfAdicional.serie_turma);
            $('#situacao').text(data.alunoInfAdicional.situacao);
        }
    })
}

// EDIT - Validation
$('body').on('click', '#updateForm', function(){

    var editarAluno = $("#editarAluno");
    var formData = editarAluno.serialize();

    $( '#departamento_id-error' ).html( "" );
    $( '#codigo_usuario-error' ).html( "" );

    $( '#nome-error-edit' ).html( "" );
    $( '#sobrenome-error' ).html( "" );
    $( '#telefone-error' ).html( "" );

    $( '#cep-error' ).html( "" );
    $( '#nome_rua-error' ).html( "" );
    $( '#numero_casa-error' ).html( "" );

    $.ajax({
        url: "{{route('alunos.update')}}",
        type:'POST',
        data:formData,
        success:function(data) {
            if(data.errors) {
                if(data.errors.departamento_id){
                    $( '#departamento_id-error-edit' ).html( data.errors.departamento_id[0] );
                }

                if(data.errors.nome){
                    $( '#nome-error-edit' ).html( data.errors.nome[0] );
                }
                if(data.errors.sobrenome){
                    $( '#sobrenome-error-edit' ).html( data.errors.sobrenome[0] );
                }
                if(data.errors.telefone){
                    $( '#telefone-error-edit' ).html( data.errors.telefone[0] );
                }

                if(data.errors.cep){
                    $( '#cep-error-edit' ).html( data.errors.cep[0] );
                }
                if(data.errors.nome_rua){
                    $( '#nome_rua-error-edit' ).html( data.errors.nome_rua[0] );
                }
                if(data.errors.numero_casa){
                    $( '#numero_casa-error-edit' ).html( data.errors.numero_casa[0] );
                }
            }
            if(data.success) {
                window.location.href="/alunos/area_aluno/"+data.aluno_id;
            }
        },
    });
});

// Get dados Aluno/Usuario
$(document).ready(function() {
    $(document).on('click', '.editbtn', function() {
        var aluno_id = $(this).val();
        
        $('#editarDadosAluno').modal('show');

        $.ajax({
            type: 'GET',
            url: '/alunos/area_aluno/edit/'+aluno_id,

            success: function(response) {
                $('#usuario_id').val(response.usuario.id);
                $('#aluno_id').val(response.aluno.id);

                $("input[name='departamento_id'][value='" + response.usuario.departamento_id + "']").prop("checked",true);
                
                $('#nome_edit').val(response.usuario.nome);
                $('#sobrenome_edit').val(response.usuario.sobrenome);
                $('#telefone_edit').val(response.usuario.telefone);
                
                // if(response.usuario.foto_usuario != null) {
                //     $('.modal-body img').attr('src', response.usuario.foto_usuario);
                // } else {
                //     $('.modal-body img').attr('src', 'sistema/assets/adicionar_foto.png');
                // }

                $('#cep_edit').val(response.usuario.cep);
                $('#nome_rua_edit').val(response.usuario.nome_rua);
                $('#numero_casa_edit').val(response.usuario.numero_casa);

                $('#nome_mae_edit').val(response.aluno.nome_mae);
                $('#nome_pai_edit').val(response.aluno.nome_pai);
                $('#cpf_edit').val(response.aluno.cpf);
                $('#rg_edit').val(response.aluno.rg);
                $('#telefone_recado_edit').val(response.aluno.telefone_recado);
                $('#email_pessoal_edit').val(response.aluno.email_pessoal);

                $("#curso_id_edit option[data-value='" + response.curso.curso +"']").attr("selected","selected");
                $("#serie_turma_edit option[data-value='" + response.turma.codigo_turma +"']").attr("selected","selected");

                $("input[name='situacao'][value='" + response.aluno.situacao + "']").prop("checked",true);
            }
        });
    });
});

</script>