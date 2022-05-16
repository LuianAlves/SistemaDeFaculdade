<!DOCTYPE html>

<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="{{ asset('sistema/assets/') }}" data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="_token" content="{{csrf_token()}}" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <title>Dashboard - Analytics | Sneat - Bootstrap 5 HTML Admin Template - Pro</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('sistema/assets/img/favicon/favicon.ico') }}" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet" />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="{{ asset('sistema/assets/vendor/fonts/boxicons.css') }}" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('sistema/assets/vendor/css/core.css') }}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('sistema/assets/vendor/css/theme-default.css') }}" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('sistema/assets/css/demo.css') }}" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ asset('sistema/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />
    <link rel="stylesheet" href="{{ asset('sistema/assets/vendor/libs/apex-charts/apex-charts.css') }}" />

    <!-- Helpers -->
    <script src="{{ asset('sistema/assets/vendor/js/helpers.js') }}"></script>
    <script src="{{ asset('sistema/assets/js/config.js') }}"></script>

    {{-- Toast Notification --}}
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">
    	
    {{-- Jquery --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<body>

    <div class="layout-wrapper layout-content-navbar">  
        <div class="layout-container">

            <!-- Menu - Sidenav -->
            @include('app.body.sidenav.sidenav')

            <!-- Layout container -->
            <div class="layout-page">

                <!-- Navbar -->
                @include('app.body.navbar.navbar')

                <!-- Content wrapper -->
                <div class="content-wrapper">

                    <!-- Content -->
                    <div class="container-xxl flex-grow-1 container-p-y">
                        @yield('content')
                    </div>
                    
                    <!-- Footer -->
                    {{-- @include('app.body.footer.footer') --}}

                    <div class="content-backdrop fade"></div>
                </div>
            </div>
        </div>

        <!-- Overlay -->
        <div class="layout-overlay layout-menu-toggle"></div>
    </div>

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
</body>

</html>