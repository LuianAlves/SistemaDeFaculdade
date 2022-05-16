<!-- Modal Adicionar Usuario -->
<div class="modal fade" id="informacaoAdicionalAluno" data-bs-backdrop="static" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <form class="modal-content" id="informacaoAluno" action="{{ route('alunos.store') }}" method="post">
            @csrf

            <input type="hidden" name="aluno_id" value="{{$aluno->id}}">

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
                                    <b style="margin-left: 12px;">Informações Adicionais</b>
                                </span>
                            </button>
                        </li>
                        <li class="nav-item">
                            <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                                data-bs-target="#navs-pills-justified-home" aria-controls="navs-pills-justified-home"
                                aria-selected="true">
                                <span class="d-flex justify-content-center align-items-center">
                                    <i class="tf-icons bx bx-home"></i>
                                    <b style="margin-left: 12px;">Turma</b>
                                </span>
                            </button>
                        </li>
                    </ul>

                    {{-- Informaçoes das Abas --}}
                    <div class="tab-content bg-transparent">
                        {{-- Usuario --}}
                        <div class="tab-pane fade show active" id="navs-pills-justified-profile" role="tabpanel">

                            <!-- Nome Pai/Mãe -->
                            <div class="row mb-3">
                                <div class="col-6">
                                    <label class="form-label" for="nome_mae">Nome Mãe</label>
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text"><i class="bx bx-map-pin"></i></span>
                                        <input type="text" class="form-control" name="nome_mae" id="nome_mae"
                                            placeholder="Maria Alves" />
                                    </div>
                                    <span class="text-danger">
                                        <strong id="nome_mae-error"></strong>
                                    </span>
                                </div>
                                <div class="col-6">
                                    <label class="form-label" for="nome_pai">Nome Pai (Opcional)</label>
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text"><i class="bx bx-map-pin"></i></span>
                                        <input type="text" class="form-control" name="nome_pai" id="nome_pai"
                                            placeholder="João Alves da Silva" />
                                    </div>
                                    <span class="text-danger">
                                        <strong id="nome_pai-error"></strong>
                                    </span>
                                </div>
                            </div>

                            <!-- RG/CPF -->
                            <div class="row mb-3">
                                <div class="col-6">
                                    <label class="form-label" for="cpf">CPF</label>
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text"><i class="bx bx-user"></i></span>
                                        <input type="text" maxlength="14" name="cpf" id="cpf"
                                            class="form-control phone-mask" placeholder="422.566.478/60"
                                            onkeydown="javascript: fMasc( this, mCPF );" />
                                    </div>
                                    <span class="text-danger">
                                        <strong id="cpf-error"></strong>
                                    </span>
                                </div>
                                <div class="col-6">
                                    <label class="form-label" for="rg">RG</label>
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text"><i class="bx bx-user"></i></span>
                                        <input type="text" maxlength="12" name="rg" id="rg"
                                            class="form-control phone-mask" placeholder="36.152.874-8"
                                            onkeydown="javascript: fMasc( this, mRG );" />
                                    </div>
                                    <span class="text-danger">
                                        <strong id="rg-error"></strong>
                                    </span>
                                </div>
                            </div>
                            
                            <!-- Email/Telefone -->
                            <div class="row mb-3">
                                <div class="col-6">
                                    <label class="form-label" for="telefone_recado">Telefone Recado (Opcional)</label>
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text"><i class="bx bx-phone"></i></span>
                                        <input type="text" maxlength="15" name="telefone_recado" id="telefone_recado"
                                            class="form-control phone-mask" placeholder="(11) 95723-4497"
                                            onkeydown="javascript: fMasc( this, mTelefoneRecado );" />
                                    </div>
                                    <span class="text-danger">
                                        <strong id="telefone_recado-error"></strong>
                                    </span>
                                </div>
                                <div class="col-6">
                                    <label class="form-label" for="email_pessoal">Email Pessoal (Opcional)</label>
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text"><i class="bx bx-map-pin"></i></span>
                                        <input type="text" class="form-control" name="email_pessoal" id="email_pessoal"
                                            placeholder="teste@teste.com.br" />
                                    </div>
                                    <span class="text-danger">
                                        <strong id="email_pessoal-error"></strong>
                                    </span>
                                </div>
                            </div>

                        </div>

                        {{-- Turma --}}
                        <div class="tab-pane fade" id="navs-pills-justified-home" role="tabpanel">
                            <!-- Curso/Turma -->
                            <div class="row mb-4">
                                <div class="col-6">
                                    <label class="form-label" for="curso_id">Curso</label>
                                    <select class="form-select" name="curso_id" id="curso_id">
                                        <option selected disabled>Selecionar Curso</option>
                                        @foreach ($cursos as $curso)
                                            <option id="curso_{{$curso->id}}" value="{{$curso->id}}">{{$curso->curso}}</option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger">
                                        <strong id="curso_id-error"></strong>
                                    </span>
                                </div>
                                <div class="col-6">
                                    <label class="form-label" for="serie_turma">Turma</label>
                                    <select class="form-select" id="serie_turma" name="serie_turma">
                                        <option selected disabled>Selecione a Turma</option>
                                    </select>
                                    <span class="text-danger">
                                        <strong id="serie_turma-error"></strong>
                                    </span>
                                </div>
                            </div>

                            <!-- Situação do Aluno -->
                            <div class="row">
                                <div class="col-4">
                                    <label class="form-label" for="situacao">Situação do Aluno</label>
                                    <div class="form-check mt-2">
                                        <input class="form-check-input" type="radio" value="1"
                                            id="ativo" name="situacao" checked="">
                                        <label class="form-check-label" for="ativo">Ativo</label>
                                    </div>
                                    <div class="form-check mt-2">
                                        <input class="form-check-input" type="radio" value="2"
                                            id="inativo" name="situacao">
                                        <label class="form-check-label" for="inativo">Inativo</label>
                                    </div>
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
                <button type="submit" class="btn btn-primary" id="createForm">Adicionar</button>
            </div>

        </form>
    </div>
</div>