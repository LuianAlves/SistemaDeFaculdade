<!-- Modal Adicionar Campus -->
<div class="modal fade" id="editarDadosCampus" data-bs-backdrop="static" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <form class="modal-content" id="editarCampus" action="{{ route('campus.update') }}" method="post">
            @csrf

            <input type="hidden" name="campus_id" id="campus_id">

            {{-- Header --}}
            <div class="modal-header bg-primary">
                <div class="nav-align-top">
                    <ul class="nav nav-pills mb-3 nav-fill" role="tablist">
                        <li class="nav-item text-white">
                            <span class="d-flex justify-content-start align-items-center">
                                <i class="tf-icons bx bx-buildings"></i>
                                <b style="margin-left: 12px;">Editar Campus - <span name="nome_campus"></span></b>
                            </span>
                        </li>
                    </ul>
                </div>
            </div>

            {{-- Content --}}
            <div class="modal-body">
                <div class="row mb-3">
                    <div class="col-6">
                        <label class="form-label" for="basic-icon-default-fullname">Nome</label>
                        <div class="input-group input-group-merge">
                            <span class="input-group-text"><i class="bx bx-building-house"></i></span>
                            <input type="text" class="form-control" name="nome_campus" id="nome_campus_edit"
                                placeholder="Campus" />
                        </div>
                        <span class="text-danger">
                            <strong id="nome_campus-error-edit"></strong>
                        </span>
                    </div>
                    <div class="col-6">
                        <label class="form-label" for="basic-icon-default-estate">Estado</label>
                        <select class="form-select" name="estado_id" id="estado_id_edit">

                            @foreach ($estados as $estado)
                                <option value="{{$estado->id}}" data-value="{{$estado->estado}}">{{$estado->estado.' / '.$estado->sigla}}</option>
                            @endforeach

                        </select>
                        <span class="text-danger">
                            <strong id="estado_id-error-edit"></strong>
                        </span>
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