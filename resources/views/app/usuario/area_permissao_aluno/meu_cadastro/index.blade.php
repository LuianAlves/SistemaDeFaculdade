@extends('layouts.layout')

@section('content')
<div class="card">
    <div class="row justify-content-around pb-4">
        <div class="col-5">
            <h5 class="card-header p-0 my-4 mx-3">Informações pessoais</h5>
            <div class="card-body p-0 mx-2">
                <table class="table table-striped">
                    <tbody class="table-border-bottom-0">
                        <tr>
                            <td class="d-flex justify-content-between">
                                <b class="justify-content-start">RA:</b>
                                <span class="justify-content-end">{{"$usuario->codigo_usuario"}}</span>
                            </td>
                        </tr>
                        <tr>
                            <td class="d-flex justify-content-between">
                                <span class="fw-bold">Nome completo:</span>
                                <span class="text-muted">{{"$usuario->nome $usuario->sobrenome"}}</span>
                            </td>
                        </tr>
                        <tr>
                            <td class="d-flex justify-content-between">
                                <span class="fw-bold">E-mail:</span>
                                <span class="text-muted">{{"$usuario->email"}}</span>
                            </td>
                        </tr>
                        <tr>
                            <td class="d-flex justify-content-between">
                                <span class="fw-bold">Telefone:</span>
                                <span class="text-muted">{{"$usuario->telefone"}}</span>
                            </td>
                        </tr>
                        <tr>
                            <td class="d-flex justify-content-between">
                                <span class="fw-bold">CEP:</span>
                                <span class="text-muted">{{"$usuario->cep"}}</span>
                            </td>
                        </tr>
                        <tr>
                            <td class="d-flex justify-content-between">
                                <span class="fw-bold">Rua:</span>
                                <span class="text-muted">{{"$usuario->nome_rua"}}</span>
                            </td>
                        </tr>
                        <tr>
                            <td class="d-flex justify-content-between">
                                <span class="fw-bold">N°:</span>
                                <span class="text-muted">{{"$usuario->numero_casa"}}</span>
                            </td>
                        </tr>

                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-5">
            <h5 class="card-header p-0 my-4 mx-3">Informações adicionais</h5>
            <div class="card-body p-0 mx-2">
                <table class="table table-striped">
                    <tbody class="table-border-bottom-0">
                        <tr>
                            <td class="d-flex justify-content-between">
                                <b class="justify-content-start">CPF:</b>
                                <span class="justify-content-end">{{"$aluno->cpf"}}</span>
                            </td>
                        </tr>
                        <tr>
                            <td class="d-flex justify-content-between">
                                <span class="fw-bold">RG:</span>
                                <span class="text-muted">{{"$aluno->rg"}}</span>
                            </td>
                        </tr>
                        <tr>
                            <td class="d-flex justify-content-between">
                                <span class="fw-bold">E-mail pessoal:</span>
                                <span class="text-muted">{{"$aluno->email_pessoal"}}</span>
                            </td>
                        </tr>
                        <tr>
                            <td class="d-flex justify-content-between">
                                <span class="fw-bold">Telefone recado:</span>
                                <span class="text-muted">{{"$aluno->telefone_recado"}}</span>
                            </td>
                        </tr>
                        <tr>
                            <td class="d-flex justify-content-between">
                                <span class="fw-bold">Nome da mãe:</span>
                                <span class="text-muted">{{"$aluno->nome_mae"}}</span>
                            </td>
                        </tr>
                        <tr>
                            <td class="d-flex justify-content-between">
                                <span class="fw-bold">Nome do pai:</span>
                                <span class="text-muted">{{"$aluno->nome_pai"}}</span>
                            </td>
                        </tr>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection