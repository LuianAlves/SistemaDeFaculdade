<!-- Modal Adicionar Usuario -->
<div class="modal fade" id="adicionarNovoUsuario" data-bs-backdrop="static" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <form class="modal-content" id="adicionarUsuario" action="{{ route('usuario.store') }}" method="post"
            enctype="multipart/form-data">
            @csrf

            <div class="modal-body">
                <div class="nav-align-top">

                    {{-- Abas --}}
                    <ul class="nav nav-pills mb-3 nav-fill" role="tablist">
                        <li class="nav-item">
                            <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab"
                                data-bs-target="#navs-pills-justified-profile"
                                aria-controls="navs-pills-justified-profile" aria-selected="false">
                                <span class="d-flex justify-content-center align-items-center">
                                    <i class="tf-icons bx bx-user"></i>
                                    <b style="margin-left: 12px;">Usuário</b>
                                </span>
                            </button>
                        </li>
                        <li class="nav-item">
                            <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                                data-bs-target="#navs-pills-justified-home" aria-controls="navs-pills-justified-home"
                                aria-selected="true">
                                <span class="d-flex justify-content-center align-items-center">
                                    <i class="tf-icons bx bx-home"></i>
                                    <b style="margin-left: 12px;">Endereço</b>
                                </span>
                            </button>
                        </li>
                    </ul>

                    {{-- Informaçoes das Abas --}}
                    <div class="tab-content bg-transparent">
                        {{-- Usuario --}}
                        <div class="tab-pane fade show active" id="navs-pills-justified-profile" role="tabpanel">
                            <div class="row mb-3">
                                <div class="col-6">
                                    <label class="form-label" for="basic-icon-default-fullname">Nome</label>
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text"><i class="bx bx-user"></i></span>
                                        <input type="text" class="form-control" name="nome" id="nome"
                                            placeholder="João" />
                                    </div>
                                    <span class="text-danger">
                                        <strong id="nome-error"></strong>
                                    </span>
                                </div>
                                <div class="col-6">
                                    <label class="form-label" for="basic-icon-default-fullname">Sobrenome</label>
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text"><i class="bx bx-user"></i></span>
                                        <input type="text" class="form-control" name="sobrenome" id="sobrenome"
                                            placeholder="Alves dos Santos" />
                                    </div>
                                    <span class="text-danger">
                                        <strong id="sobrenome-error"></strong>
                                    </span>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-6">
                                    <label class="form-label" for="telefone">Telefone</label>
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text"><i class="bx bx-phone"></i></span>
                                        <input type="text" maxlength="15" name="telefone" id="telefone"
                                            class="form-control phone-mask" placeholder="(11) 95723-4497"
                                            onkeydown="javascript: fMasc( this, mTelefone );" />
                                    </div>
                                    <span class="text-danger">
                                        <strong id="telefone-error"></strong>
                                    </span>
                                </div>
                            </div>

                            <div class="row mt-5">
                                <div class="col-7">
                                    <div class="d-flex align-items-start align-items-sm-center gap-4">
                                        <img src="{{asset('sistema/assets/adicionar_foto.png')}}" alt="user-avatar"
                                            class="d-block rounded" height="100" width="100" id="uploadedAvatar" />
                                        <div class="button-wrapper mt-3">
                                            <label for="foto_usuario" class="btn btn-primary me-2 mb-4" tabindex="0">
                                                <span class="d-none d-sm-block">Upload</span>
                                                <i class="bx bx-upload d-block d-sm-none"></i>
                                                <input type="file" id="foto_usuario" name="foto_usuario"
                                                    class="account-file-input" hidden />
                                            </label>
                                            <button type="button"
                                                class="btn btn-outline-danger account-image-reset mb-4">
                                                <i class="bx bx-reset d-block d-sm-none"></i>
                                                <span class="d-none d-sm-block">Resetar</span>
                                            </button>

                                        </div>
                                    </div>
                                    <div class="form-text">Permitido JPG, GIF ou PNG. Tamanho máximo 4096 Bytes</div>
                                </div>

                                <div class="col-5">
                                    @foreach ($departamentos as $departamento)
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="departamento_id"
                                            id="{{ 'departamento_'.$departamento->id }}" value="{{$departamento->id}}"
                                            @if($departamento->id) checked @endif>
                                        <label class="form-check-label" for="{{ 'departamento_'.$departamento->id }}">
                                            {{ $departamento->nome_departamento }}
                                        </label>
                                        <span class="text-danger">
                                            <strong id="departamento_id-error"></strong>
                                        </span>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        {{-- Endereço --}}
                        <div class="tab-pane fade" id="navs-pills-justified-home" role="tabpanel">
                            <div class="row mb-3">
                                <div class="col-5">
                                    <label class="form-label" for="cep">CEP</label>
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text"><i class="bx bx-map"></i></span>
                                        <input type="text" class="form-control" maxlength="9" name="cep" id="cep"
                                            placeholder="xxxxx-xx" onkeydown="javascript: fMasc( this, mCep );" onblur="getCEP(this.value)" />
                                    </div>
                                    <span class="text-danger">
                                        <strong id="cep-error"></strong>
                                    </span>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-8">
                                    <label class="form-label" for="nome_rua">Rua</label>
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text"><i class="bx bx-map-pin"></i></span>
                                        <input type="text" class="form-control" name="nome_rua" id="nome_rua"
                                            placeholder="Rua Santana da Parnaiba" />
                                    </div>
                                    <span class="text-danger">
                                        <strong id="nome_rua-error"></strong>
                                    </span>
                                </div>
                                <div class="col-4">
                                    <label class="form-label" for="numero_casa">Número</label>
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text"><i class="bx bx-sitemap"></i></span>
                                        <input type="text" class="form-control" name="numero_casa" id="numero_casa"
                                            placeholder="1332" />
                                    </div>
                                    <span class="text-danger">
                                        <strong id="numero_casa-error"></strong>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                    Fechar
                </button>
                <button type="button" class="btn btn-primary" id="createForm">Adicionar</button>
            </div>

        </form>
    </div>
</div>

