@extends('main')

@section('title', 'Softys - Pode Entrar')

@section('content')
    <div id="dashboard">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <form action="{{ route('logout') }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-danger d-block ms-auto">Sair</button>
                    </form>

                    <h2 class="mt-5 mb-4">📊 Relatório de Inscrições por Unidade</h2>

                    <form method="GET" action="{{ route('dashboard') }}" class="mb-4">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control" placeholder="Buscar unidade..." value="{{ $search }}">
                            <button class="btn btn-primary" type="submit">Buscar</button>
                        </div>
                    </form>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="card mb-4">
                                <div class="card-header bg-primary text-white">
                                    Inscrições de Colaboradores
                                </div>
                                <div class="card-body p-0">
                                    <table class="table table-striped table-hover mb-0">
                                        <thead>
                                            <tr>
                                                <th>Unidade Original</th>
                                                <th>Unidade Contabilizada</th>
                                                <th>Total (APENAS DEPENDENTES)</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($colaboradores as $c)
                                                <tr>
                                                    <td>{{ $c->unidade_original }}</td>
                                                    <td>{{ $c->unidade_contabilizada }}</td>
                                                    <td>{{ $c->total }}</td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="3" class="text-center">Nenhum registro encontrado</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                                <div class="card-footer">
                                    {{ $colaboradores->links() }}
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="card mb-4">
                                <div class="card-header bg-success text-white">
                                    Inscrições de Voluntários
                                </div>
                                <div class="card-body p-0">
                                    <table class="table table-striped table-hover mb-0">
                                        <thead>
                                            <tr>
                                                <th>Unidade Original</th>
                                                <th>Unidade Contabilizada</th>
                                                <th>Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($voluntarios as $v)
                                                <tr>
                                                    <td>{{ $v->unidade_original }}</td>
                                                    <td>{{ $v->unidade_contabilizada }}</td>
                                                    <td>{{ $v->total }}</td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="3" class="text-center">Nenhum registro encontrado</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                                <div class="card-footer">
                                    {{ $voluntarios->links() }}
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="mb-3">
                                <a href="{{ route('export.colaboradores') }}" class="btn btn-primary">Exportar Colaboradores</a>
                                <a href="{{ route('export.voluntarios') }}" class="btn btn-success">Exportar Voluntários</a>
                                <a href="{{ route('export.dependentes') }}" class="btn btn-warning text-white">Exportar Dependentes</a>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')

@endpush