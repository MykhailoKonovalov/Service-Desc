@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-dark text-light text-center">
                        Вітаємо Вас в нашій системі. Якщо у Вас виникли проблеми з нашими продуктами,
                        ви можете повідомити про це наших експертів.
                    </div>

                    <div class="card-body bg-primary">
                        <form method="POST" action="/problems" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group row">
                                <label for="title" class="col-md-2 col-form-label text-md-right">
                                    {{ __("Ваше ім'я") }}</label>
                                <div class="col-md-6">
                                    <input id="username" type="text"
                                           class="form-control @error('username') is-invalid @enderror"
                                           name="username" required autocomplete="username" autofocus>
                                    @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email" class="col-md-2 col-form-label text-md-right">
                                    Ваш email
                                </label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="title" class="col-md-2 col-form-label text-md-right">
                                    {{ __("Тема скарги") }}</label>
                                <div class="col-md-6">
                                    <input id="theme" type="text"
                                           class="form-control @error('theme') is-invalid @enderror"
                                           name="theme" required autocomplete="theme" autofocus>
                                    @error('theme')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="description" class="col-md-2 col-form-label text-md-right">
                                    {{ __("Опис") }}</label>

                                <div class="col-md-10">
                                    <textarea id="description" type="text" rows="10" name="description"
                                              class="form-control @error('description') is-invalid @enderror"
                                              autocomplete="description"></textarea>
                                    @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->all() }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="genre_id" class="col-md-4 col-form-label text-md-right">
                                    Товар, стосовно якого виникла проблема</label>

                                <select class="col-md-4" name="product_id" id="product_id">
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                        @foreach($products as $data)
                                            <option class="dropdown-item form-control" value="{{$data->id}}">
                                                {{$data->title}}
                                            </option>
                                        @endforeach
                                    </div>
                                </select>
                            </div>
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <form action="/problems" method="POST" enctype="multipart/form-data">
                                        {{ csrf_field() }}
                                        <button class="btn btn-light">Відправити</button>
                                    </form>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
@endsection
