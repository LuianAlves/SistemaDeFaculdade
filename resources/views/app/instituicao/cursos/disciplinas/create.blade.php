<!-- Modal Adicionar Curso -->
<div class="modal fade" id="adicionarNovaDisciplina" data-bs-backdrop="static" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <form class="modal-content" id="adicionarDisciplina" action="{{ route('disciplinas.store') }}" method="post">
            @csrf

            {{-- Header --}}
            <div class="modal-header bg-primary">
                <div class="nav-align-top">
                    <ul class="nav nav-pills mb-3 nav-fill" role="tablist">
                        <li class="nav-item text-white">
                            <span class="d-flex justify-content-start align-items-center">
                                <i class="tf-icons bx bx-book-reader"></i>
                                <b style="margin-left: 12px;">Nova Disciplina</b>
                            </span>
                        </li>
                    </ul>
                </div>
            </div>

            {{-- Content --}}
            <div class="modal-body">
                <div class="row mb-3">
                    <div class="col-6">
                        <label class="form-label" for="basic-icon-default-fullname">Nome da Disciplina</label>
                        <div class="input-group input-group-merge">
                            <span class="input-group-text"><i class="bx bx-book-reader"></i></span>
                            <input type="text" class="form-control" name="disciplina" id="disciplina"
                                placeholder="Disciplina" />
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
                        <label class="form-label" for="basic-icon-default-fullname">Carga horária</label>
                        <div class="input-group input-group-merge">
                            <span class="input-group-text"><i class="bx bx-webcam"></i></span>
                            <input type="number" class="form-control" name="duracao_horas" id="duracao_horas" placeholder="Carga horária" />
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

            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                    Fechar
                </button>
                <button type="button" class="btn btn-primary" id="createForm">Adicionar</button>
            </div>

        </form>
    </div>
</div>