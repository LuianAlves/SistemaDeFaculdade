@php
    $usuario_id = App\Models\Usuarios::where('user_id', Auth::id())->first();
    
    $route = Route::current()->getName();
@endphp

<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="{{ route('dashboard') }}" class="app-brand-link">
            <span class="app-brand-text demo text-uppercase menu-text fw-bolder ms-2">UNITECH</span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">

        <!-- Dashboard -->
        <li class="menu-item {{$route == 'dashboard' ? 'active' : ''}}">
            <a href="{{ route('dashboard') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Dashboard</div>
            </a>
        </li>

        @can('dev')
            <li class="menu-header small text-uppercase">
                <span class="menu-header-text">Cadastro da Instituição</span>
            </li>

            <!-- Novo Campus -->
            <li class="menu-item {{$route == 'campus.index' ? 'active' : ''}}">
                <a href="{{ route('campus.index') }}" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-building-house"></i>
                    <div data-i18n="Basic">Campus</div>
                </a>
            </li>
        @endcan

        @if(App\Models\Campus::count() != 0)
            <!-- Cursos -->
            @can('dev')
                <li class="menu-item {{$route == 'cursos.index' ? 'active' : ''}}">
                    <a href="{{route('cursos.index')}}" class="menu-link">
                        <i class="menu-icon tf-icons bx bx-book-add"></i>
                        <div data-i18n="Basic">Cursos</div>
                    </a>
                </li>
            @endcan

            @if(App\Models\Cursos::count() != 0)
                <!-- Disciplinas -->
                @can('dev')
                    <li class="menu-item {{$route == 'disciplinas.index' ? 'active' : ''}}">
                        <a href="{{route('disciplinas.index')}}" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-book-reader"></i>
                            <div data-i18n="Basic">Disciplinas</div>
                        </a>
                    </li>
                @endcan

                <!-- Turmas -->
                @if(App\Models\Turmas::count() != 0)
                    @canany(['administracao', 'dev'])
                        <li class="menu-item {{$route == 'turmas.index' ? 'active' : ''}}">
                            <a href="{{route('turmas.index')}}" class="menu-link">
                                <i class="menu-icon tf-icons bx bx-user-plus"></i>
                                <div data-i18n="Basic">Turmas</div>
                            </a>
                        </li>
                    @endcanany
                @endif

                @can('professor')
                    <li class="menu-header small text-uppercase">
                        <span class="menu-header-text"></span>
                    </li>
                    <li class="menu-item {{$route == 'area-permissao-professor.meu-cadastro' ? 'active' : ''}}">
                        <a href="{{route('area-permissao-professor.meu-cadastro', $usuario_id)}}" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-face"></i>
                            <div data-i18n="Basic">Meu cadastro</div>
                        </a>
                    </li>
                    @if(App\Models\Alunos::count() != 0)
                    <li class="menu-item {{$route == 'alunos.index' ? 'active' : ''}}">
                        <a href="{{route('alunos.index')}}" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-user"></i>
                            <div data-i18n="Basic">Meus alunos</div>
                        </a>
                    </li>
                    @endif
                    <li class="menu-item {{$route == 'area-permissao-professor.disciplinas-lecionadas' ? 'active' : ''}}">
                        <a href="{{route('area-permissao-professor.disciplinas-lecionadas', $usuario_id)}}" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-book-reader"></i>
                            <div data-i18n="Basic">Disciplinas lecionadas</div>
                        </a>
                    </li>
                @endcan

                @canany(['dev', 'administracao'])
                    <li class="menu-header small text-uppercase">
                        <span class="menu-header-text">Funcionalidades de Cadastramento</span>
                    </li>
                @endcanany

                <!-- Novo Usuário -->
                @canany(['dev', 'administracao'])
                    <li class="menu-item {{$route == 'usuario.index' ? 'active' : ''}}">
                        <a href="{{route('usuario.index')}}" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-user-plus"></i>
                            <div data-i18n="Basic">Usuários</div>
                        </a>
                    </li>
                @endcanany

                <!-- Área do Aluno -->
                @canany(['administracao', 'dev'])
                    @if(App\Models\Alunos::count() != 0)
                        <li class="menu-item {{$route == 'alunos.index' ? 'active' : ''}}">
                            <a href="{{route('alunos.index')}}" class="menu-link">
                                <i class="menu-icon tf-icons bx bx-user"></i>
                                <div data-i18n="Basic">Alunos</div>
                            </a>
                        </li>
                    @endif
                    @if(App\Models\Professores::count() != 0)
                        <li class="menu-item {{$route == 'professores.index' ? 'active' : ''}}">
                            <a href="{{route('professores.index')}}" class="menu-link">
                                <i class="menu-icon tf-icons bx bx-user"></i>
                                <div data-i18n="Basic">Professores</div>
                            </a>
                        </li>
                    @endif
                @endcanany

                    @can('aluno')
                        <li class="menu-item {{$route == 'area-permissao-aluno.meu-cadastro' ? 'active' : ''}}">
                            <a href="{{route('area-permissao-aluno.meu-cadastro', $usuario_id)}}" class="menu-link">
                                <i class="menu-icon tf-icons bx bx-face"></i>
                                <div data-i18n="Basic">Meu cadastro</div>
                            </a>
                        </li>
                        <li class="menu-item {{$route == 'area-permissao-aluno.dados-curso' ? 'active' : ''}}">
                            <a href="{{route('area-permissao-aluno.dados-curso', $usuario_id)}}" class="menu-link">
                                <i class="menu-icon tf-icons bx bx-expand"></i>
                                <div data-i18n="Basic">Dados do curso</div>
                            </a>
                        </li>
                            <li class="menu-item {{$route == 'area-permissao-aluno.notas-faltas' ? 'active' : ''}}">
                            <a href="{{route('area-permissao-aluno.notas-faltas', $usuario_id)}}" class="menu-link">
                                <i class="menu-icon tf-icons bx bx-exclude"></i>
                                <div data-i18n="Basic">Notas e faltas</div>
                            </a>
                        </li>
                            <li class="menu-item {{$route == 'area-permissao-aluno.integracao-curricular' ? 'active' : ''}}">
                            <a href="{{route('area-permissao-aluno.integracao-curricular', $usuario_id)}}" class="menu-link">
                                <i class="menu-icon tf-icons bx bx-border-all"></i>
                                <div data-i18n="Basic">Integração curricular</div>
                            </a>
                        </li>
                            <li class="menu-item {{$route == 'area-permissao-aluno.documentos' ? 'active' : ''}}">
                            <a href="{{route('documentos.index')}}" class="menu-link">
                                <i class="menu-icon tf-icons bx bx-file"></i>
                                <div data-i18n="Basic">Solicitar documentos</div>
                            </a>
                        </li>
                    @endcan
                

                @canany(['dev', 'administracao'])
                    <li class="menu-header small text-uppercase">
                        <span class="menu-header-text">Calendário Acadêmico</span>
                    </li>

                    <!-- Cadastrar Período Escolar -->
                    <li class="menu-item  {{$route == 'periodo-escolar.index' ? 'active' : ''}}">
                        <a href="{{ route('periodo-escolar.index') }}" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-building-house"></i>
                            <div data-i18n="Basic">Período Escolar</div>
                        </a>
                    </li>

                    <!-- Cadastrar Período de Avaliações -->
                    <li class="menu-item {{$route == 'periodo-avaliacoes.index' ? 'active' : ''}}">
                        <a href="{{ route('periodo-avaliacoes.index') }}" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-calendar"></i>
                            <div data-i18n="Basic">Período de Avaliações</div>
                        </a>
                    </li>
                @endcanany
            @endif
        @endif

    </ul>
</aside>