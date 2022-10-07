<!-- Modal Adicionar Campus -->
<div class="modal fade" id="adicionarNovoCampus" data-bs-backdrop="static" tabindex="-1">
    <div class="modal-dialog ">
        <form class="modal-content" id="adicionarCampus" action="{{ route('campus.store') }}" method="post">
            @csrf

            {{-- Header --}}
            <div class="modal-header bg-padrao">
                <div class="nav-align-top">
                    <ul class="nav nav-pills mb-3 nav-fill" role="tablist">
                        <li class="nav-item text-white">
                            <span class="d-flex justify-content-start align-items-center">
                                <i class="tf-icons bx bx-buildings"></i>
                                <b style="margin-left: 12px;">Novo Campus</b>
                            </span>
                        </li>
                    </ul>
                </div>
            </div>

            {{-- Content --}}
            <div class="modal-body">
                <div class="row mb-3">
                    <div class="col-6">
                        <label class="form-label fw-bold" for="basic-icon-default-fullname">Nome do Campus</label>
                        <div class="input-group input-group-merge">
                            <span class="input-group-text"><i class="bx bx-building-house" style="font-size: 12px;"></i></span>
                            <input type="text" class="form-control form-control-sm" name="nome_campus" id="nome_campus"
                                placeholder="Campus" />
                        </div>
                        <span class="text-danger">
                            <strong id="nome_campus-error"></strong>
                        </span>
                    </div>
                    <div class="col-6">
                        <label class="form-label fw-bold" for="basic-icon-default-estate">Estado</label>
                        <select class="form-select form-select-sm" name="estado_id">

                            @foreach ($estados as $estado)
                                <option id="estado_{{$estado->id}}" value="{{$estado->id}}">{{$estado->estado.' / '.$estado->sigla}}</option>
                            @endforeach

                        </select>
                        <span class="text-danger">
                            <strong id="estado_id-error"></strong>
                        </span>
                    </div>
                </div>     
            </div>

            <div class="modal-footer">
                <button type="button" class="btn-outline-padrao" data-bs-dismiss="modal">
                    Fechar
                </button>
                <button type="button" class="btn-padrao" id="createForm">Salvar</button>
            </div>

        </form>
    </div>
</div>