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
        <li class="menu-item active">
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
        <li class="menu-item">
            <a href="{{ route('campus.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-building-house"></i>
                <div data-i18n="Basic">Campus</div>
            </a>
        </li>
        @endcan

        @if(App\Models\Campus::count() != 0)
        <!-- Cursos -->
        @can('dev')
        <li class="menu-item">
            <a href="{{route('cursos.index')}}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-book-add"></i>
                <div data-i18n="Basic">Cursos</div>
            </a>
        </li>
        @endcan

        @if(App\Models\Cursos::count() != 0)
        <!-- Disciplinas -->
        @can('dev')
        <li class="menu-item">
            <a href="{{route('disciplinas.index')}}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-book-reader"></i>
                <div data-i18n="Basic">Disciplinas</div>
            </a>
        </li>
        @endcan

        @if(App\Models\Turmas::count() != 0)
        <!-- Turmas -->
        @canany(['administracao', 'dev'])
        <li class="menu-item">
            <a href="{{route('turmas.index')}}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-user-plus"></i>
                <div data-i18n="Basic">Turmas</div>
            </a>
        </li>
        @endcanany
        @endif

        @can('professor')
        <li class="menu-item">
            <a href="{{route('disciplinas-lecionadas.index')}}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-user-plus"></i>
                <div data-i18n="Basic">Disciplinas lecionadas</div>
            </a>
        </li>
        @endcan

        @canany(['dev', 'administracao', 'professor'])
        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Funcionalidades de Cadastramento</span>
        </li>
        @endcanany

        <!-- Usuários -->
        <li class="menu-item">
            <!-- Novo Usuário -->
            @canany(['dev', 'administracao'])
            <a href="{{route('usuario.index')}}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-user-plus"></i>
                <div data-i18n="Basic">Usuários</div>
            </a>
            @endcanany

            <!-- Área do Aluno -->
            @canany(['administracao', 'professor', 'dev'])
                @if(App\Models\Alunos::count() != 0)
                    <a href="{{route('alunos.index')}}" class="menu-link">
                        <i class="menu-icon tf-icons bx bx-user"></i>
                        <div data-i18n="Basic">Alunos</div>
                    </a>
                @endif
                @if(App\Models\Professores::count() != 0)
                    <a href="{{route('professores.index')}}" class="menu-link">
                        <i class="menu-icon tf-icons bx bx-user"></i>
                        <div data-i18n="Basic">Professores</div>
                    </a>
                @endif
            @endcanany

            @can('aluno')
                @php
                    $usuario_id = App\Models\Usuarios::where('user_id', Auth::id())->first();
                @endphp

                {{-- Em vez de acessar a parea do aluno, criar os links pelo sidebar: dados do curso, meu cadastro ... --}}
                <a href="{{route('area-permissao-aluno.meu-cadastro', $usuario_id)}}" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-face"></i>
                    <div data-i18n="Basic">Meu cadastro</div>
                </a>
                <a href="{{route('area-permissao-aluno.dados-curso', $usuario_id)}}" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-expand"></i>
                    <div data-i18n="Basic">Dados do curso</div>
                </a>
                <a href="{{route('alunos.area-aluno', $usuario_id)}}" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-exclude"></i>
                    <div data-i18n="Basic">Notas e faltas</div>
                </a>
                <a href="{{route('alunos.area-aluno', $usuario_id)}}" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-border-all"></i>
                    <div data-i18n="Basic">Integração curricular</div>
                </a>
                <a href="{{route('alunos.area-aluno', $usuario_id)}}" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-file"></i>
                    <div data-i18n="Basic">Solicitar documentos</div>
                </a>
            @endcan
        </li>

        @canany(['dev', 'administracao'])
        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Calendário Acadêmico</span>
        </li>

        <!-- Cadastrar Período Escolar -->
        <li class="menu-item">
            <a href="{{ route('periodo-escolar.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-building-house"></i>
                <div data-i18n="Basic">Período Escolar</div>
            </a>
        </li>

        <!-- Cadastrar Período de Avaliações -->
        <li class="menu-item">
            <a href="{{ route('periodo-avaliacoes.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-calendar"></i>
                <div data-i18n="Basic">Período de Avaliações</div>
            </a>
        </li>

        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Acompanhamento pedagógico</span>
        </li>

        <li class="menu-item" style="">
            <a href="javascript:void(0)" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-detail"></i>
                <div data-i18n="User interface">Relatórios</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="ui-accordion.html" class="menu-link">
                        <div data-i18n="Accordion">Turmas</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="{{route('relatorio-alunos.index')}}" class="menu-link">
                        <div data-i18n="Accordion">Alunos</div>
                    </a>
                </li>
            </ul>
        </li>
        @endcanany
        @endif
        @endif

    </ul>
</aside>