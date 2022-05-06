<!-- Modal Adicionar Usuario -->
<div class="modal fade" id="visualizarDadosUsuario" data-bs-backdrop="static" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-body">
                <div class="row">
                    <div class="col-md-4">
                        <img class="card-img card-img-left h-100" name="foto_usuario" src="" alt="Card image">
                    </div>
                    <div class="col-md-8">
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

            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                    Fechar
                </button>
            </div>
        </div>
    </div>
</div>
