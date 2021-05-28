@extends('layouts.dashboard.app')

@section('content')

    <div class="content-wrapper">

        <section class="content-header">

            <h1>@lang('users')</h1>

            <ol class="breadcrumb">
                <li><a href="{{ route('dashboard.welcome') }}"><i class="fa fa-dashboard"></i> @lang('dashboard')</a></li>
                <li><a href="{{ route('dashboard.users.index') }}"> @lang('users')</a></li>
                <li class="active">@lang('edit')</li>
            </ol>
        </section>

        <section class="content">

            <div class="box box-primary">

                <div class="box-header">
                    <h3 class="box-title">@lang('edit')</h3>
                </div><!-- end of box header -->

                <div class="box-body">


                    <form action="{{ route('dashboard.users.update', $user->id) }}" method="post" enctype="multipart/form-data">

                        {{ csrf_field() }}
                        {{ method_field('put') }}

                        <div class="form-group">
                            <label>@lang('name')</label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ $user->name }}">

                            @error('name')
                              <span class="invalid-feedback" role="alert">
                              <strong class="message-error">{{ $message }}</strong>
                             </span>
                            @enderror

                        </div>

                        <div class="form-group">
                            <label>@lang('phone')</label>
                            <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ $user->phone }}">

                            @error('phone')
                              <span class="invalid-feedback" role="alert">
                              <strong class="message-error">{{ $message }}</strong>
                             </span>
                            @enderror

                        </div>


                       <div class="form-group">
                            <label>@lang('password')</label>
                            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" value="">

                            @error('password')
                              <span class="invalid-feedback" role="alert">
                              <strong class="message-error">{{ $message }}</strong>
                             </span>
                            @enderror

                        </div>


                        <div class="form-group">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-edit"></i> @lang('edit')</button>
                        </div>

                    </form><!-- end of form -->

                </div><!-- end of box body -->

            </div><!-- end of box -->

        </section><!-- end of content -->

    </div><!-- end of content wrapper -->

@endsection
