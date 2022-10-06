@extends('layouts.layout')
@section('content')
<div class="card" id="card-main">
    <div class="row p-4">
            <div class="col-12">
                <h3 class="card-header p-0 my-4 mx-2" style="color: #14a881; border-bottom: 3px solid #14a881;">Solicitar
                    documentos</h3>
                <div class="card-body">

                    {{-- Boletim --}}
                    <div class="row">
                        <div class="col-4">
                            <div class="card mini-card">
                                <div class="card-body">
                                    <h6 class="text-center fw-bold m-2">Boletim</h6>
                                    <div class="d-flex justify-content-center">
                                        <button type="button" class="editbtn"
                                            style="background: transparent; border: none;" value="">
                                            <i class="bx bx-plus-circle"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Histórico escolar --}}
                    <div class="row">
                        <div class="col-4">
                            <div class="card mini-card">
                                <div class="card-body">
                                    <h6 class="text-center fw-bold m-2">Boletim escolar</h6>
                                    <div class="d-flex justify-content-center">
                                        <button type="button" class="editbtn"
                                            style="background: transparent; border: none;" value="">
                                            <i class="bx bx-plus-circle"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Disciplinas em dependência --}}
                    <div class="row">
                        <div class="col-4">
                            <div class="card mini-card">
                                <div class="card-body">
                                    <h6 class="text-center fw-bold m-2">Disciplinas em dependência</h6>
                                    <div class="d-flex justify-content-center">
                                        <button type="button" class="editbtn"
                                            style="background: transparent; border: none;" value="">
                                            <i class="bx bx-plus-circle"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<style>
    * {
        font-family: "Poppins", sans-serif;
    }

    h4 {
        font-size: 26px;
    }

    h6 {
        color: #45505b;
    }

    .card .mini-card {
        border-radius: 15px;
        margin-top: 10px;
        align-items: center;
        background: rgba(255, 255, 255, 0.411);
    }

    .card .mini-card i {
        font-size: 50px;
        margin-top: 10px;
        color: #45505b;
    }

    .card .mini-card:hover i {
        font-size: 56px;
        color: #34ebba;
    }
</style>
