<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.0/jquery.js"></script>

<script type="text/javascript">
    // STORE - Validation
    // $('body').on('click', '#createForm', function(){

    //     var informacaoAdicional = $("#informacaoAluno");
    //     var formData = informacaoAdicional.serialize();

    //     var aluno_id = $(this).val()

    //     console.log(aluno_id)

    //     $( '#nome_mae-error' ).html( "" );
    //     $( '#nome_pai-error' ).html( "" );

    //     $( '#rg-error' ).html( "" );
    //     $( '#cpf-error' ).html( "" );
    //     $( '#telefone_recado-error' ).html( "" );
    //     $( '#email_pessoal-error' ).html( "" );

    //     $( '#curso_id-error' ).html( "" );
    //     $( '#serie_turma-error' ).html( "" );


    //     $.ajax({
    //         url:"{{ route('alunos.store') }}",
    //         type:'POST',
    //         data:formData,
    //         success:function(data) {
    //             console.log(data);
    //             if(data.errors) {
    //                 if(data.errors.nome_mae){
    //                     $( '#nome_mae-error' ).html( data.errors.nome_mae[0] );
    //                 }

    //                 if(data.errors.nome_pai){
    //                     $( '#nome_pai-error' ).html( data.errors.nome_pai[0] );
    //                 }
    //                 if(data.errors.rg){
    //                     $( '#rg-error' ).html( data.errors.rg[0] );
    //                 }
    //                 if(data.errors.cpf){
    //                     $( '#cpf-error' ).html( data.errors.cpf[0] );
    //                 }

    //                 if(data.errors.telefone_recado){
    //                     $( '#telefone_recado-error' ).html( data.errors.telefone_recado[0] );
    //                 }
    //                 if(data.errors.email_pessoal){
    //                     $( '#email_pessoal-error' ).html( data.errors.email_pessoal[0] );
    //                 }
    //                 if(data.errors.curso_id){
    //                     $( '#curso_id-error' ).html( data.errors.curso_id[0] );
    //                 }

    //                 if(data.errors.serie_turma){
    //                     $( '#serie_turma-error' ).html( data.errors.serie_turma[0] );
    //                 }
    //             }
    //             if(data.success) {
    //                 // setInterval(function(){ 
    //                 //     $('#adicionarNovoUsuario').modal('hide');
    //                 // }, 1000);
    //                 var aluno_id = $(this).val()

    //                 window.location.href="{{url('/alunos/area_aluno')}}/" + aluno_id;
    //             }
    //         },
    //     });
    // });

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
                        // console.log(data)
                        var d = $('select[name="serie_turma"]').empty()
                        $.each(data, function(key, value) {
                            // console.log(value.codigo_turma)
                            $('select[name="serie_turma"]').append('<option value="' + value.id + '">' + value.codigo_turma + '</option>')
                        })
                    },
                })
            } else {
                alert('Error!')
            }
        })
    })

</script>