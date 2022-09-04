@extends('layouts.layout')

@section('content')
    {{-- Breadcrumb --}}
    {{-- @include('layouts.breadcrumb') --}}

    <div class="row justify-content-end">
        <div class="col-xl-6 col-lg-6 col-md-8 col-sm-10 col-12 my-3">
            <div class="card">
                <h5 class="card-header text-center">Informações do Perfil</h5>
                <div class="card-body">
                    <p class="mb-4 text-center">Atualize suas informações de conta e endereço de e-mail</p>

                    <form class="mb-3" action="{{ route('auth.profile.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <input type="hidden" name="old_image" value="{{Auth::user()->profile_photo_path}}">

                        <div class="row mb-3 ">
                            <div class="col-12">
                                <div class="image-upload input-group input-group-merge">
                                    <label for="profile_photo_path">
                                        <img src="{{ (!empty(Auth::user()->profile_photo_path)) ? url('sistema/usuarios/foto/'.Auth::user()->profile_photo_path) : url('sistema/assets/adicionar_foto.png')}}" style="width: 150px; height: 150px; border-radius: 50%;">                            
                                    </label>
                                    <input type="file" id="profile_photo_path" name="profile_photo_path" value="{{Auth::user()->profile_photo_path}}">
                                </div>
                            </div>
                        </div>
                        
                        <!-- Nome e E-mail -->
                        <div class="row mb-3">
                            <div class="col-12">
                                <label class="form-label" for="name_input">Nome <span class="text-danger fw-bold"> *</span></label>
                                <div class="input-group input-group-merge">
                                    <span id="name_input" class="input-group-text"><i class="bx bx-user-circle"></i></span>
                                    <input type="text" name="name" id="name" class="form-control" value="{{ ucfirst($user->name) }}" :value="old('name')" placeholder="Nome de usuário">
                                </div>
                                @error('name')
                                    <small class="text-danger fw-bold">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-12">
                                <label class="form-label" for="name_input">Endereço de e-mail <span class="text-danger fw-bold"> *</span></label>
                                <div class="input-group input-group-merge">
                                    <span id="email_input" class="input-group-text"><i class="bx bx-mail-send"></i></span>
                                    <input type="email" name="email" id="email" class="form-control" value="{{ ucfirst($user->email) }}" :value="old('email')" placeholder="Endereço de e-mail">
                                </div>
                                @error('email')
                                    <small class="text-danger fw-bold">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-0 d-flex justify-content-end">
                            <button class="btn btn-secondary" type="submit">Salvar</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row justify-content-end">
        <div class="col-xl-6 col-lg-6 col-md-8 col-sm-10 col-12 my-3">
            <div class="card">
                <h5 class="card-header text-center">Atualização de Senha 👾</h5>

                <div class="card-body">
                    <p class="mb-4 text-center">Certifique-se de utilizar senhas longas com carateres especiais para maior
                        segurança</p>

                    <form id="formAuthentication" class="mb-3"
                        action="{{ route('auth.password.update') }}" method="POST">
                        @csrf

                        <input type="hidden" name="user_id" id="user_id" value="{{ $user->id }}">

                        <div class="mb-3 form-password-toggle">
                            <div class="d-flex justify-content-between">
                                <label class="form-label" for="current_password">Senha Atual</label>
                            </div>
                            <div class="input-group input-group-merge">
                                <span class="input-group-text"><i class="bx bx-key"></i></span>
                                <input type="password" id="current_password" class="form-control" name="current_password"
                                    placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                    aria-describedby="current_password" />
                                <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                            </div>
                        </div>

                        <div class="mb-3 form-password-toggle">
                            <div class="d-flex justify-content-between">
                                <label class="form-label" for="password">Nova Senha</label>
                            </div>
                            <div class="input-group input-group-merge">
                                <span class="input-group-text"><i class="bx bx-key"></i></span>
                                <input type="password" id="password" class="form-control" name="password"
                                    placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                    aria-describedby="password" />
                                <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                            </div>
                        </div>

                        <div class="mb-3 form-password-toggle">
                            <div class="d-flex justify-content-between">
                                <label class="form-label" for="password_confirmation">Confirmar Senha</label>
                            </div>
                            <div class="input-group input-group-merge">
                                <span class="input-group-text"><i class="bx bx-key"></i></span>
                                <input type="password" id="password_confirmation" class="form-control"
                                    name="password_confirmation"
                                    placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                    aria-describedby="password_confirmation" />
                                <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                            </div>
                        </div>


                        <div class="mb-0 d-flex justify-content-end">
                            <button class="btn btn-secondary" type="submit">Salvar</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection