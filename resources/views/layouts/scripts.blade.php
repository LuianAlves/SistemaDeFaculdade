<!-- Core JS -->
<script src="{{ asset('sistema/assets/vendor/libs/jquery/jquery.js') }}"></script>
<script src="{{ asset('sistema/assets/vendor/libs/popper/popper.js') }}"></script>
<script src="{{ asset('sistema/assets/vendor/js/bootstrap.js') }}"></script>
<script src="{{ asset('sistema/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
<script src="{{ asset('sistema/assets/vendor/js/menu.js') }}"></script>
<!-- Vendors JS -->
<script src="{{ asset('sistema/assets/vendor/libs/apex-charts/apexcharts.js') }}"></script>
<!-- Main JS -->
<script src="{{ asset('sistema/assets/js/main.js') }}"></script>
<!-- Page JS -->
<script src="{{ asset('sistema/assets/js/dashboards-analytics.js') }}"></script>
<!-- Place this tag in your head or just before your close body tag. -->
<script async defer src="https://buttons.github.io/buttons.js"></script>

{{-- Bloqueando tecla ENTER --}}
<script>
    $(document).ready(function() {
        $(window).keydown(function(event){
            if(event.keyCode == 13) {
                event.preventDefault();
            return false;
            }
        });
    }); 
</script>

{{-- Formatando Inputs --}}
<script>
    function fMasc(objeto,mascara) {
        obj=objeto
        masc=mascara
        setTimeout("fMascEx()",1)
    }

    function fMascEx() {
        obj.value=masc(obj.value)
    }
    
    function mTelefone(telefone){
        telefone=telefone.replace(/\D/g,"")
        telefone=telefone.replace(/^(\d{2})(\d)/g,"($1) $2");
        telefone=telefone.replace(/(\d)(\d{4})$/,"$1-$2"); 

        return telefone
    }

    function mTelefoneRecado(telefone_recado){
        telefone_recado=telefone_recado.replace(/\D/g,"")
        telefone_recado=telefone_recado.replace(/^(\d{2})(\d)/g,"($1) $2");
        telefone_recado=telefone_recado.replace(/(\d)(\d{4})$/,"$1-$2"); 

        return telefone_recado
    }

    function mCelular(celular){
        celular=celular.replace(/\D/g,"")
        celular=celular.replace(/^(\d{2})(\d)/g,"($1) $2");
        celular=celular.replace(/(\d)(\d{4})$/,"$1-$2"); 

        return celular
    }   

    function mCep(cep){
        cep=cep.replace(/\D/g,"")
        cep=cep.replace(/(\d)(\d{3})$/,"$1-$2"); 

        return cep
    }

    function mCPF(cpf){
        cpf=cpf.replace(/\D/g,"")
        cpf=cpf.replace(/(\d{3})(\d)/,"$1.$2")
        cpf=cpf.replace(/(\d{3})(\d)/,"$1.$2")
        cpf=cpf.replace(/(\d{3})(\d{1,2})$/,"$1/$2")

        return cpf
    }

    function mRG(rg){
        rg=rg.replace(/\D/g,"")
        rg=rg.replace(/(\d{2})(\d)/,"$1.$2")
        rg=rg.replace(/(\d{3})(\d)/,"$1.$2")
        rg=rg.replace(/(\d{3})(\d{1,2})$/,"$1-$2")

        return rg
    }
</script>

{{-- API CEP --}}
<script>
    function getCEP(cep) {

        var url = 'https://viacep.com.br/ws/'+cep+'/json/'

        xmlHttp = new XMLHttpRequest()
        xmlHttp.open('GET', url)

        xmlHttp.onreadystatechange = () => {
            if(xmlHttp.readyState == 4 && xmlHttp.status == 200) {

                var dadosTexto = xmlHttp.responseText               
                var dadosObj = JSON.parse(dadosTexto)
                
                document.getElementById('nome_rua').value = dadosObj.logradouro
            } 
        }

        xmlHttp.send()
    }
</script>

<!-- Resetar/Atualizar Imagem -->
<script>
    document.addEventListener('DOMContentLoaded', function (e) {
        (function () {
            const deactivateAcc = document.querySelector('#formAccountDeactivation');

            // Update/reset user image of account page
            let accountUserImage = document.getElementById('uploadedAvatar');
            const fileInput = document.querySelector('.account-file-input'),
            resetFileInput = document.querySelector('.account-image-reset');

            if (accountUserImage) {
            const resetImage = accountUserImage.src;
            fileInput.onchange = () => {
                if (fileInput.files[0]) {
                accountUserImage.src = window.URL.createObjectURL(fileInput.files[0]);
                }
            };
            resetFileInput.onclick = () => {
                fileInput.value = '';
                accountUserImage.src = resetImage;
            };
            }
        })();
    });
</script>

{{-- Notification Toastr --}}
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>   
<script type="text/javascript">
    @if (Session::has('message'))
        var type = "{{ Session::get('alert-type', 'info') }}"
    
        switch(type) {
        case 'info':
        toastr.info(" {{ Session::get('message') }} ");
        break;
        case 'success':
        toastr.success(" {{ Session::get('message') }} ");
        break;
        case 'warning':
        toastr.warning(" {{ Session::get('message') }} ");
        break;
        case 'error':
        toastr.error(" {{ Session::get('message') }} ");
        break;
        }
    @endif
</script>