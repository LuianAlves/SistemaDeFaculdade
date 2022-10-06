@extends('layouts.layout')

@section('content')
    <div class="card">
        <div class="row p-4">
            <div class="col-12">
                <h3 class="card-header p-0 my-4 mx-2" style="color: #14a881; border-bottom: 3px solid #14a881;">Meu cadastro
                </h3>
                <div class="col-5">
                    <h5 class="card-header p-0 my-4 mx-3 fw-bold" style="color: #0a7c5e;">Informações pessoais</h5>
                    <div class="card-body p-0 mx-2">
                        <table class="table table-striped">
                            <tbody class="table-border-bottom-0">
                                <tr>
                                    <td class="d-flex justify-content-between">
                                        <b class="justify-content-start">RA:</b>
                                        <span class="justify-content-end">{{ "$usuario->codigo_usuario" }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="d-flex justify-content-between">
                                        <span class="fw-bold">Nome completo:</span>
                                        <span class="text-muted">{{ "$usuario->nome $usuario->sobrenome" }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="d-flex justify-content-between">
                                        <span class="fw-bold">E-mail:</span>
                                        <span class="text-muted">{{ "$usuario->email" }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="d-flex justify-content-between">
                                        <span class="fw-bold">Telefone:</span>
                                        <span class="text-muted">{{ "$usuario->telefone" }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="d-flex justify-content-between">
                                        <span class="fw-bold">CEP:</span>
                                        <span class="text-muted">{{ "$usuario->cep" }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="d-flex justify-content-between">
                                        <span class="fw-bold">Rua:</span>
                                        <span class="text-muted">{{ "$usuario->nome_rua" }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="d-flex justify-content-between">
                                        <span class="fw-bold">N°:</span>
                                        <span class="text-muted">{{ "$usuario->numero_casa" }}</span>
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                    </div>

                    <h5 class="card-header p-0 my-4 mx-3 fw-bold" style="color: #0a7c5e;">Informações adicionais</h5>
                    <div class="card-body p-0 mx-2">
                        <table class="table table-striped">
                            <tbody class="table-border-bottom-0">
                                <tr>
                                    <td class="d-flex justify-content-between">
                                        <b class="justify-content-start">CPF:</b>
                                        <span class="justify-content-end">{{ "$professor->cpf" }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="d-flex justify-content-between">
                                        <span class="fw-bold">RG:</span>
                                        <span class="text-muted">{{ "$professor->rg" }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="d-flex justify-content-between">
                                        <span class="fw-bold">E-mail pessoal:</span>
                                        <span class="text-muted">{{ "$professor->email_pessoal" }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="d-flex justify-content-between">
                                        <span class="fw-bold">Telefone recado:</span>
                                        <span class="text-muted">{{ "$professor->telefone_recado" }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="d-flex justify-content-between">
                                        <span class="fw-bold">Nome da mãe:</span>
                                        <span class="text-muted">{{ "$professor->nome_mae" }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="d-flex justify-content-between">
                                        <span class="fw-bold">Nome do pai:</span>
                                        <span class="text-muted">{{ "$professor->nome_pai" }}</span>
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
