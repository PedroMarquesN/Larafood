@extends('adminlte::page')

@section('title', "Permissôes do perfil {$profile->name}")

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('admin.index')}}">Dashboard</a></li>
        <li class="breadcrumb-item"></li><a href="{{route('profiles.index')}}">Perfis</a>

    </ol>

    <h1>Permissôes do perfil <strong>{{$profile->name}}</strong>
        <a href="{{route('profiles.permissions.available', $profile->id)}}" class="btn btn-dark">ADD NOVA PERMISSÃO</a></h1>


@stop

@section('content')

        <div class="card-body">
            <table class="table table-condensed">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th width="250">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($permissions as $permission)
                        <tr>
                            <td>
                                {{$permission->name}}
                            </td>
                            <td style="width=10px;">
                                <a href="{{route('profiles.permissions.detach', [$profile->id, $permission->id])}}" class="btn btn-danger">Desvincular</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            @if (@isset($filters))
            
            {!! $permissions->appends($filters)->links() !!}
            @else
            {!! $permissions->links() !!}
            @endif
            
        </div>
    </div>
@stop