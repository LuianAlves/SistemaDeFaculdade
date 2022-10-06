@extends('layouts.layout')

@section('content')
    <div class="card">
        <div class="row p-4">
            <div class="col-12">
                <!-- Header Lista -->
                <h3 class="card-header p-0 my-4 mx-4" style="color: #14a881; border-bottom: 3px solid #14a881;">Campus
                </h3>

                <!-- abela de Usuarios -->
                <div class="card-body">
                    <div class="text-nowrap">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="text-left">Campus</th>
                                    <th class="text-center">Estado</th>
                                    <th class="text-center">Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($campus as $camp)
                                    <tr>
                                        <td>{{ $camp->nome_campus }}</td>
                                        <td class="text-center">
                                            {{ $camp->estado->estado . ' / ' . $camp->estado->sigla }}
                                        </td>

                                        <td class="text-center">
                                            <div class="dropdown">
                                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                    data-bs-toggle="dropdown">
                                                    <i class="bx bx-dots-vertical-rounded"></i>
                                                </button>
                                                <div class="dropdown-menu">
                                                    <!-- Editar -->
                                                    <button type="button" class="dropdown-item editbtn"
                                                        value="{{ $camp->id }}">
                                                        <i class="bx bx-edit-alt me-1"></i>
                                                        Editar Campus
                                                    </button>

                                                    <!-- Excluir -->
                                                    <form id="{{ 'remove_' . $camp->id }}"
                                                        action="{{ route('campus.destroy', $camp->id) }}" method="post">
                                                        @csrf
                                                        @method('DELETE')

                                                        <a type="button" id="{{ 'remove_' . $camp->id }}"
                                                            class="dropdown-item"
                                                            onclick="document.getElementById('remove_{{ $camp->id }}').submit()">
                                                            <i class="bx bx-trash me-1"></i>
                                                            Apagar Campus
                                                        </a>
                                                    </form>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="card-footer">
                    <div class="d-flex justify-content-end">

                        <button type="button" class="btn btn-sm btn-primary fw-bold"
                            data-bs-toggle="modal"data-bs-target="#adicionarNovoCampus" style="background: #14a881; border-color: #14a881;">
                        <b>Campus +</b>
                    </button>
                </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Include Modal Adicionar Campus -->
    @include('app.instituicao.campus.create')

    <!-- Include Modal Editar Campus -->
    @include('app.instituicao.campus.edit')

    <!-- Include Scripts -->
    @include('app.instituicao.campus.campus_scripts')
@endsection
