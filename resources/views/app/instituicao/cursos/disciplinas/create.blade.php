<!-- Modal Adicionar Curso -->
<div class="modal fade" id="adicionarNovaDisciplina" data-bs-backdrop="static" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <form class="modal-content" id="adicionarDisciplina" action="{{ route('disciplinas.store') }}" method="post">
            @csrf

            <div class="modal-body">
                <div class="nav-align-top">

                    {{-- Header --}}
                    <ul class="nav nav-pills mb-3 nav-fill" role="tablist">
                        <li class="nav-item">
                            <button type="button" class="nav-link active" style="cursor: auto;">
                                <span class="d-flex justify-content-start align-items-center">
                                    <i class="tf-icons bx bx-building-house"></i>
                                    <b style="margin-left: 12px;">Adicionar Disciplina</b>
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
                                        <input type="text" class="form-control" name="disciplina" id="disciplina"
                                            placeholder="Nome" />
                                    </div>
                                    <span class="text-danger">
                                        <strong id="disciplina-error"></strong>
                                    </span>
                                </div>
                                <div class="col-6">
                                    <label class="form-label" for="basic-icon-default-estate">Área de
                                        Conhecimento</label>
                                    <select class="form-select" name="area_conhecimento_id">

                                        @foreach ($classificacaoCursos as $classificacao)
                                        <option id="area_conhecimento_{{$classificacao->id}}"
                                            value="{{$classificacao->id}}">{{$classificacao->area_conhecimento}}
                                        </option>
                                        @endforeach

                                    </select>
                                    <span class="text-danger">
                                        <strong id="area_conhecimento_id-error"></strong>
                                    </span>
                                </div>
                            </div>
                            <div class="row mt-5 mb-3">
                                <div class="col-6">
                                    <label class="form-label" for="basic-icon-default-fullname">Duração em Horas</label>
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text"><i class="bx bx-building-house"></i></span>
                                        <input type="number" class="form-control" name="duracao_horas" id="duracao_horas" placeholder="Curso" />
                                    </div>
                                    <span class="text-danger">
                                        <strong id="duracao_horas-error"></strong>
                                    </span>
                                </div>
                                <div class="col-6">
                                    <label class="form-label" for="basic-icon-default-fullname">Modalidade</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" value="Presencial"
                                            name="modalidade" id="modalidade">
                                        <label class="form-check-label" for="modalidade"> Presencial </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" value="AVA" name="modalidade"
                                            id="modalidade1">
                                        <label class="form-check-label" for="modalidade1"> AVA </label>
                                    </div>
                                    <span class="text-danger">
                                        <strong id="modalidade-error"></strong>
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