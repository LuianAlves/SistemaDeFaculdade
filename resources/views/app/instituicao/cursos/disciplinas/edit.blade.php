<!-- Modal Editar Disciplina -->
<div class="modal fade" id="editarDadosDisciplina" data-bs-backdrop="static" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <form class="modal-content" id="editarDisciplina" action="{{ route('disciplinas.update') }}" method="post">
            @csrf

            <input type="hidden" name="disciplina_id" id="disciplina_id">

            <div class="modal-body">
                <div class="nav-align-top">

                    {{-- Header --}}
                    <ul class="nav nav-pills mb-3 nav-fill" role="tablist">
                        <li class="nav-item">
                            <button type="button" class="nav-link active" style="cursor: auto;">
                                <span class="d-flex justify-content-start align-items-center">
                                    <i class="tf-icons bx bx-user"></i>
                                    <b style="margin-left: 12px;">Editar Campus</b>
                                </span>
                            </button>
                        </li>
                    </ul>

                    {{-- Informaçoes das Abas --}}
                    <div class="tab-content bg-transparent">
                        <div class="tab-pane fade show active">
                            <div class="row mb-3">
                                <div class="col-6">
                                    <label class="form-label" for="basic-icon-default-fullname">Disciplina</label>
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text"><i class="bx bx-building-house"></i></span>
                                        <input type="text" class="form-control" name="disciplina" id="disciplina_edit"
                                            placeholder="Nome" />
                                    </div>
                                    <span class="text-danger">
                                        <strong id="disciplina-error-edit"></strong>
                                    </span>
                                </div>
                                <div class="col-6">
                                    <label class="form-label" for="basic-icon-default-estate">Área de
                                        Conhecimento</label>
                                    <select class="form-select" name="area_conhecimento_id" id="area_conhecimento_id_edit">

                                        @foreach ($classificacaoCursos as $classificacao)
                                        <option value="{{$classificacao->id}}" data-value="{{$classificacao->area_conhecimento}}">{{$classificacao->area_conhecimento}}
                                        </option>
                                        @endforeach

                                    </select>
                                    <span class="text-danger">
                                        <strong id="area_conhecimento_id-error-edit"></strong>
                                    </span>
                                </div>
                            </div>
                            <div class="row mt-5 mb-3">
                                <div class="col-6">
                                    <label class="form-label" for="basic-icon-default-fullname">Duração em Horas</label>
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text"><i class="bx bx-building-house"></i></span>
                                        <input type="number" class="form-control" name="duracao_horas" id="duracao_horas_edit" placeholder="Curso" />
                                    </div>
                                    <span class="text-danger">
                                        <strong id="duracao_horas-error-edit"></strong>
                                    </span>
                                </div>
                                <div class="col-6">
                                    <label class="form-label" for="basic-icon-default-fullname">Modalidade</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" value="Presencial" name="modalidade" id="presencial">
                                        <label class="form-check-label" for="presencial"> Presencial </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" value="AVA" name="modalidade" id="ava">
                                        <label class="form-check-label" for="ava"> AVA </label>
                                    </div>
                                    <span class="text-danger">
                                        <strong id="modalidade-error-edit"></strong>
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
                <button type="button" class="btn btn-primary" id="updateForm">Atualizar</button>
            </div>

        </form>
    </div>
</div>