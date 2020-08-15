@extends('layouts.admin')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Edit  {{$role->name}} role details</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    {{--                <ol class="breadcrumb float-sm-right">--}}
                    {{--                    <li class="breadcrumb-item"><a href="#">Home</a></li>--}}
                    {{--                    <li class="breadcrumb-item active">Starter Page</li>--}}
                    {{--                </ol>--}}
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8 offset-2">
                    <div class="card">
                        <div class="card-header">
                            {{ trans('global.edit') }} {{ trans('cruds.role.title_singular') }}
                        </div>

                        <div class="card-body">
                            <form action="{{ route("admin.roles.update", [$role->id]) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                                    <label for="name">{{ trans('cruds.role.fields.title') }}*</label>
                                    <input type="text" id="name" name="name" class="form-control" value="{{ old('name', isset($role) ? $role->name : '') }}" required>
                                    @if($errors->has('name'))
                                        <em class="invalid-feedback">
                                            {{ $errors->first('name') }}
                                        </em>
                                    @endif
                                    <p class="helper-block">
                                        {{ trans('cruds.role.fields.title_helper') }}
                                    </p>
                                </div>
                                <div class="form-group {{ $errors->has('permission') ? 'has-error' : '' }}">
                                    <label for="permission">{{ trans('cruds.role.fields.permissions') }}*
                                        <span class="btn btn-info btn-xs select-all">{{ trans('global.select_all') }}</span>
                                        <span class="btn btn-info btn-xs deselect-all">{{ trans('global.deselect_all') }}</span></label>
                                    <select name="permission[]" id="permission" class="form-control select2" multiple="multiple" required>
                                        @foreach($permissions as $id => $permissions)
                                            <option value="{{ $id }}" {{ (in_array($id, old('permissions', [])) || isset($role) && $role->permissions()->pluck('name', 'id')->contains($id)) ? 'selected' : '' }}>{{ $permissions }}</option>
                                        @endforeach
                                    </select>
                                    @if($errors->has('permission'))
                                        <em class="invalid-feedback">
                                            {{ $errors->first('permission') }}
                                        </em>
                                    @endif
                                    <p class="helper-block">
                                        {{ trans('cruds.role.fields.permissions_helper') }}
                                    </p>
                                </div>
                                <div>
                                    <input class="btn btn-danger" type="submit" value="{{ trans('global.save') }}">
                                </div>
                            </form>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.content -->
@endsection