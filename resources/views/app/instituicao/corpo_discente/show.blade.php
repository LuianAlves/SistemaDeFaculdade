<!-- Modal Informações do Aluno -->
<div class="modal fade" id="visualizarDadosAluno" data-bs-backdrop="static" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-body">

                <div class="nav-align-top">

                    {{-- Abas --}}
                    <ul class="nav nav-pills mb-3 nav-fill" role="tablist">
                        <li class="nav-item">
                            <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab"
                                data-bs-target="#cadastroAluno"
                                aria-controls="cadastroAluno" aria-selected="false">
                                <span class="d-flex justify-content-center align-items-center">
                                    <i class="tf-icons bx bx-user"></i>
                                    <b style="margin-left: 12px;">Cadastro aluno</b>
                                </span>
                            </button>
                        </li>
                        <li class="nav-item">
                            <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                                data-bs-target="#informacoesAdicional" aria-controls="informacoesAdicional"
                                aria-selected="true">
                                <span class="d-flex justify-content-center align-items-center">
                                    <i class="tf-icons bx bx-user-pin"></i>
                                    <b style="margin-left: 12px;">Informações adicionais</b>
                                </span>
                            </button>
                        </li>
                    </ul>

                    {{-- Informaçoes das Abas --}}
                    <div class="tab-content bg-transparent">
                        {{-- Usuario --}}
                        <div class="tab-pane fade show active" id="cadastroAluno" role="tabpanel">
                            <div class="row">
                                {{-- <div class="col-md-4">
                                    <img class="card-img card-img-left h-100" name="foto_usuario" src="" alt="Card image">
                                </div> --}}
                                <div class="col-md-12">
                                    <div class="card-body">
            
                                        <div class="d-flex">
                                            <div class="col-8">
                                                <h5 class="card-title">
                                                    <span name="nome"></span>
                                                    <span name="sobrenome"></span>
                                                </h5>
                                            </div>    
                                            <div class="col-4">
                                                <p class="card-text"><small class="text-muted" name="email"></small></p>
                                            </div>
                                        </div>
            
                                        <div class="demo-inline-spacing mb-3">
                                            <span class="badge bg-label-primary" id="administrativo"></span>
                                            <span class="badge bg-label-danger" id="estudante"></span>
                                            <span class="badge bg-label-info" id="professor"></span>
                                        </div>
            
                                        <div class="my-3">                               
                                            <h6 class="text-muted card-title">
                                                <span>Tel: </span>
                                                <span name="telefone"></span>
                                            </h6>
                                        </div>
            
                                        <div class="text-muted my-3">
                                            <p class="card-text">
                                                Endereço: 
                                                <span class="text-success" name="nome_rua"></span>
                                                <span><b>n°</b> <small class="text-success" name="numero_casa"></small></span>
                                            </p>
                                            <h6 class="card-title">
                                                CEP: <span name="cep"></span>
                                            </h6>
                                        </div>
            
                                        <div class="my-3">
                                            <span class="badge bg-label-dark" id="codigo_usuario"></span>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Info Adicional --}}
                        <div class="tab-pane fade" id="informacoesAdicional" role="tabpanel">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card-body">
            
                                        Nome da mãe: <span id="nome_mae"></span><br>
                                        Nome da pai: <span id="nome_pai"></span><br>
                                        CPF: <span id="cpf"></span><br>
                                        RG: <span id="rg"></span><br>
                                        E-mail pessoal: <span id="email_pessoal"></span><br>
                                        Telefone recado: <span id="telefone_recado"></span><br>
                                        Situação do aluno: <span id="situacao"></span><br>
                                        Turma matriculada: <span id="serie_turma"></span><br>
                                        
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
            </div>
        </div>
    </div>
</div>
