@extends('layouts.layout')

@section('content')
<div class="card">
    <!-- Header Lista -->
    <div class="d-flex align-items-center p-3">
        <div class="d-flex align-items-center">
            <div class="span"><h5>Lista de Usuários</h5></div>
        </div>
        <div class="justify-content-end align-items-center ms-auto">
            <button type="button" class="btn btn-sm btn-primary fw-bold" data-bs-toggle="modal"data-bs-target="#adicionarNovoUsuario">
                <b>Usuario +</b>
            </button>
            <div class="dropdown dropup footer-link me-3">
                <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle" data-bs-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    Ordenação
                </button>
                <div class="dropdown-menu dropdown-menu-end" style="font-size: 12px;">
                    <!-- Ordenação Alfabética Ascendente -->
                    <a class="dropdown-item" href="{{route('alfabetic.order.asc')}}">
                        <i class="bx bx-sort-a-z text-success"></i>
                        Alfabética
                    </a>

                    <!-- Ordenação Alfabética Decrescente -->
                    <a class="dropdown-item" href="{{route('alfabetic.order.desc')}}">
                        <i class="bx bx-sort-z-a text-danger me-1"></i>
                        Alfabética
                    </a>

                    <!-- Ordenação Cadastro Ascendente -->
                    <a class="dropdown-item" href="{{route('alfabetic.date.asc')}}">
                        <i class="bx bx-calendar text-success me-1"></i>
                        Cadastro
                    </a>

                    <!-- Ordenação Cadastro Ascendente -->
                    <a class="dropdown-item" href="{{route('alfabetic.date.desc')}}">
                        <i class="bx bx bx-calendar text-danger me-1"></i>
                        Cadastro
                    </a>

                    <!-- Ordenação Departamento Ascendente -->
                    <a class="dropdown-item" href="{{route('alfabetic.departamento.asc')}}">
                        <i class="bx bx-mobile-vibration text-success me-1"></i>
                        Departamento
                    </a>

                    <!-- Ordenação Departamento Decrescente -->
                    <a class="dropdown-item" href="{{route('alfabetic.departamento.desc')}}">
                        <i class="bx bx bx-mobile-vibration text-danger me-1"></i>
                        Departamento
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- Tabela de Usuarios -->
    <div class="card-body">
        <div class="text-nowrap">
            <table class="table">
                <thead>
                    <tr>
                        <th class="text-left"><b>#</b></th>
                        <th class="text-left">Nome</th>
                        <th class="text-center">Foto Usuário</th>
                        <th class="text-center">Departamento</th>
                        <th class="text-center">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($usuarios as $usuario)
                    <tr>
                        <td>
                            <i class="fab fa-angular fa-lg text-danger"></i>
                            <strong>{{$usuario->codigo_usuario}}</strong>
                        </td>
                        <td>{{$usuario->nome.' '.$usuario->sobrenome}}</td>
                        <td>
                            <ul
                                class="list-unstyled users-list m-0 avatar-group d-flex justify-content-center align-items-center">
                                <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                                    class="avatar avatar-xs pull-up" title="{{$usuario->nome}}">
                                    <img src="{{ $usuario->foto_usuario != '' ? asset($usuario->foto_usuario) : asset('sistema/assets/adicionar_foto.png') }}" alt="Avatar"
                                        class="rounded-circle" />
                                </li>
                            </ul>
                        </td>
                        <td class="text-center">
                            @switch($usuario->departamento_id)
                            @case(1)
                            <span class="badge bg-label-primary me-1">Administrativo</span>
                            @break
                            @case(2)
                            <span class="badge bg-label-info me-1">Professor</span>
                            @break
                            @case(3)
                            <span class="badge bg-label-danger me-1">Estudante</span>
                            @break
                            @default

                            @endswitch
                        </td>
                        <td class="text-center">
                            <div class="dropdown">
                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                    data-bs-toggle="dropdown">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu">
                                    <!-- Visualizar -->
                                    <a type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#visualizarDadosUsuario"
                                        id="{{$usuario->id}}" onclick="visualizarUsuario(this.id)">
                                        <i class="bx bx-show-alt me-1"></i>
                                        Visualizar Usuário
                                    </a>

                                    <!-- Editar -->
                                    <button type="button" class="dropdown-item editbtn" value="{{$usuario->id}}">
                                        <i class="bx bx-edit-alt me-1"></i>
                                        Editar Usuário
                                    </button>

                                    <!-- Excluir -->
                                    <form id="{{'remove_'.$usuario->id}}"
                                        action="{{route('usuario.destroy', $usuario->id)}}" method="post">
                                        @csrf
                                        @method('DELETE')

                                        <a type="button" id="{{'remove_'.$usuario->id}}" class="dropdown-item"
                                            onclick="document.getElementById('remove_{{$usuario->id}}').submit()">
                                            <i class="bx bx-trash me-1"></i>
                                            Apagar Usuário
                                        </a>
                                    </form>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="row d-flex align-items-center mt-5">
                <div class="justify-content-center">
                    {{$usuarios->links('vendor.pagination.default')}}
                </div>
            </div>
            <div class="row d-flex align-items-center">
                <div class="d-flex justify-content-center">
                    <span class="text-muted">
                        Usuários cadastrados: {{$usuarios->total()}}
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>



<!-- Include Modal Adicionar Usuario -->
@include('app.usuario.create')

<!-- Include Modal Adicionar Usuario -->
@include('app.usuario.edit')

<!-- Include Modal visualizar Usuario -->
@include('app.usuario.show')

<!-- Include Scripts -->
@include('app.usuario.usuario_scripts')
@endsection

