<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.0/jquery.js"></script>

<script type="text/javascript">
    // STORE - Validation
    $('body').on('click', '#createForm', function(){

        var novoUsuario = $("#adicionarUsuario");
        var formData = novoUsuario.serialize();

        $( '#departamento_id-error' ).html( "" );
        $( '#codigo_usuario-error' ).html( "" );

        $( '#nome-error' ).html( "" );
        $( '#sobrenome-error' ).html( "" );
        $( '#telefone-error' ).html( "" );

        $( '#cep-error' ).html( "" );
        $( '#nome_rua-error' ).html( "" );
        $( '#numero_casa-error' ).html( "" );

        $( '#email-error' ).html( "" );
        $( '#senha-error' ).html( "" );

        $.ajax({
            url:"{{ route('usuario.store') }}",
            type:'POST',
            data:formData,
            success:function(data) {
                console.log(data);
                if(data.errors) {
                    if(data.errors.departamento_id){
                        $( '#departamento_id-error' ).html( data.errors.departamento_id[0] );
                    }

                    if(data.errors.nome){
                        $( '#nome-error' ).html( data.errors.nome[0] );
                    }
                    if(data.errors.sobrenome){
                        $( '#sobrenome-error' ).html( data.errors.sobrenome[0] );
                    }
                    if(data.errors.telefone){
                        $( '#telefone-error' ).html( data.errors.telefone[0] );
                    }

                    if(data.errors.cep){
                        $( '#cep-error' ).html( data.errors.cep[0] );
                    }
                    if(data.errors.nome_rua){
                        $( '#nome_rua-error' ).html( data.errors.nome_rua[0] );
                    }
                    if(data.errors.numero_casa){
                        $( '#numero_casa-error' ).html( data.errors.numero_casa[0] );
                    }

                    if(data.errors.email){
                        $( '#email-error' ).html( data.errors.email[0] );
                    }
                }
                if(data.success) {
                    // setInterval(function(){ 
                    //     $('#adicionarNovoUsuario').modal('hide');
                    // }, 1000);
                    window.location.href="{{route('usuario.index')}}";
                }
            },
        });
    });

    // EDIT - Validation
    $('body').on('click', '#updateForm', function(){
    
        var editarUsuario = $("#editarUsuario");
        var formData = editarUsuario.serialize();
    
        $( '#departamento_id-error' ).html( "" );
        $( '#codigo_usuario-error' ).html( "" );
    
        $( '#nome-error-edit' ).html( "" );
        $( '#sobrenome-error' ).html( "" );
        $( '#telefone-error' ).html( "" );
    
        $( '#cep-error' ).html( "" );
        $( '#nome_rua-error' ).html( "" );
        $( '#numero_casa-error' ).html( "" );
    
        $( '#email-error' ).html( "" );
        $( '#senha-error' ).html( "" );
    
        $.ajax({
            url:"{{ route('usuario.update') }}",
            type:'POST',
            data:formData,
            success:function(data) {
                console.log(data);
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
    
                    if(data.errors.email){
                        $( '#email-error-edit' ).html( data.errors.email[0] );
                    }
                }
                if(data.success) {
                    window.location.href="{{route('usuario.index')}}";
                }
            },
        });
    });

    // EDIT - GET Dados para editar
    $(document).ready(function() {
        $(document).on('click', '.editbtn', function() {
 
            var usuario_id = $(this).val();

            $('#editarDadosUsuario').modal('show');

            $.ajax({
                type: 'GET',
                url: 'usuario/' +usuario_id+ '/edit',

                success: function(response) {
                    $('#usuario_id').val(response.usuario.id);

                    $("input[name='departamento_id'][value='" + response.usuario.departamento_id + "']").prop("checked",true);
                    
                    $('#nome_edit').val(response.usuario.nome);
                    $('#sobrenome_edit').val(response.usuario.sobrenome);
                    $('#telefone_edit').val(response.usuario.telefone);
                    
                    if(response.usuario.foto_usuario != null) {
                        $('.modal-body img').attr('src', response.usuario.foto_usuario);
                    } else {
                        $('.modal-body img').attr('src', 'sistema/assets/adicionar_foto.png');
                    }

                    $('#cep_edit').val(response.usuario.cep);
                    $('#nome_rua_edit').val(response.usuario.nome_rua);
                    $('#numero_casa_edit').val(response.usuario.numero_casa);
                    
                    $('#email_edit').val(response.usuario.email);
                }
            });
        });
    });

    // Show - Registro de Usuários
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    })
   
    function visualizarUsuario(id) {
        $.ajax({
            type: 'GET',
            url: 'usuario/'+id,
            dataType: 'json',

            success: function(data) {

                // console.log(document.URL)

                $('#codigo_usuario').text(data.usuario.codigo_usuario)

                if(data.usuario.departamento_id == 1) {
                    $('#administrativo').text('Administrativo')
                } else if(data.usuario.departamento_id == 2){
                    $('#professor').text('Professor')
                } else if(data.usuario.departamento_id == 3){
                    $('#estudante').text('Estudante')
                }
                
                $("span[name='nome']").text(data.usuario.nome);
                $("span[name='sobrenome']").text(data.usuario.sobrenome);
                $("span[name='telefone']").text(data.usuario.telefone);

                if(data.usuario.foto_usuario != null) {
                    $('.modal-body img').attr('src', data.usuario.foto_usuario);
                } else {
                    $('.modal-body img').attr('src', 'sistema/assets/adicionar_foto.png');
                }

                $("span[name='cep']").text(data.usuario.cep);
                $("span[name='nome_rua']").text(data.usuario.nome_rua + ", ");
                $("small[name='numero_casa']").text(data.usuario.numero_casa);

                $("small[name='email']").text(data.usuario.email);
                $("small[name='senha']").text(data.usuario.senha);
            }
        })
    }

</script>




