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
</script>