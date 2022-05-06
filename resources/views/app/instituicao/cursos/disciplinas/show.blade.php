<!-- Modal Visualizar Disciplina -->
<div class="modal fade" id="visualizarDadosDisciplinas" data-bs-backdrop="static" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card-body">

                            <div class="d-flex">
                                <div class="col-12">
                                    <h5 class="card-title text-center">
                                        <span name="disciplina"></span>
                                    </h5>
                                </div>    
                            </div>

                            <div class="demo-inline-spacing mb-3">
                                <span class="badge bg-label-primary" name="presencial"></span>
                                <span class="badge bg-label-info" name="ava"></span>
                            </div>

                            <div class="my-3">                               
                                <h6 class="text-muted card-title">
                                    <span name="duracao_horas"></span>
                                    <span> Horas</span>
                                </h6>
                            </div>

                            <div class="text-muted my-3">
                                <p class="card-text">
                                    <span><b>Área de Conhecimento: </b> <span class="text-muted" name="area_conhecimento_id"></span></span>
                                </p>
                            </div>

                            <div class="text-muted my-3">
                                <span><b>Código da Disciplina: </b>
                                <span class="badge bg-label-dark" id="codigo_disciplina"></span> </span>
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
