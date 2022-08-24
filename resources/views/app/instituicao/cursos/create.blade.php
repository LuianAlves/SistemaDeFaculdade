<!-- Modal Adicionar Curso -->
<div class="modal fade" id="adicionarNovoCurso" data-bs-backdrop="static" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <form class="modal-content" id="adicionarCurso" action="{{ route('cursos.store') }}" method="post">
            @csrf

            {{-- Header --}}
            <div class="modal-header bg-primary">
                <div class="nav-align-top">
                    <ul class="nav nav-pills mb-3 nav-fill" role="tablist">
                        <li class="nav-item text-white">
                            <span class="d-flex justify-content-start align-items-center">
                                <i class="tf-icons bx bx-book-add"></i>
                                <b style="margin-left: 12px;">Novo Curso</b>
                            </span>
                        </li>
                    </ul>
                </div>
            </div>

            {{-- Content --}}
            <div class="modal-body">              
                {{-- Nome --}}
                <div class="row mb-3">
                    <div class="col-6">
                        <label class="form-label" for="basic-icon-default-fullname">Nome do Curso</label>
                        <div class="input-group input-group-merge">
                            <span class="input-group-text"><i class="bx bx-book-add"></i></span>
                            <input type="text" class="form-control" name="curso" id="curso"
                                placeholder="Curso" />
                        </div>
                        <span class="text-danger">
                            <strong id="curso-error"></strong>
                        </span>
                    </div>
                    <div class="col-6">
                        <label class="form-label" for="basic-icon-default-estate">Grau de Instrução</label>
                        <select class="form-select" name="grau_instrucao_id">

                            @foreach ($grau_instrucao as $grau)
                                <option id="grau_instrucao_{{$grau->id}}" value="{{$grau->id}}">{{$grau->grau_instrucao}}</option>
                            @endforeach

                        </select>
                        <span class="text-danger">
                            <strong id="grau_instrucao_id-error"></strong>
                        </span>
                    </div>
                </div>

                {{-- Descrição --}}
                <div class="row mb-3">
                    <div class="col-6">
                        <label class="form-label" for="basic-icon-default-fullname">Quantidade de Semestres</label>
                        <div class="input-group input-group-merge">
                            <span class="input-group-text"><i class="bx bx-slider"></i></span>
                            <input type="number" class="form-control" name="quantidade_semestres" id="quantidade_semestres" placeholder="Semestres do curso" />
                        </div>
                        <span class="text-danger">
                            <strong id="quantidade_semestres-error"></strong>
                        </span>
                    </div>
                    <div class="col-6">
                        <label class="form-label" for="basic-icon-default-fullname">Descrição</label>
                        <div class="input-group input-group-merge">
                            <textarea class="form-control" name="descricao" id="descricao" rows="5" placeholder="Descreva um pouco sobre o curso .."></textarea>
                        </div>
                        <span class="text-danger">
                            <strong id="descricao-error"></strong>
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