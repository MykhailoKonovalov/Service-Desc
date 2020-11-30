@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card bg-dark text-light">
                        <div class="container">
                            <h3 class="display-4 text-center">
                                {{$problem->theme}}
                            </h3>
                        </div>
                        <div class="container mx-5">
                            <blockquote class="blockquote">
                                <p class="mb-0 font-weight-bold">{{$problem->description}}</p>
                            </blockquote>
                        </div>
                        <div class="container mx-5">
                            <blockquote class="blockquote">
                                <p class="mb-0">Надіслано від: {{$problem->username}}</p>
                            </blockquote>
                        </div>
                        <div class="container mx-5">
                            <blockquote class="blockquote">
                                <p class="mb-0">E-mail: {{$problem->email}}</p>
                            </blockquote>
                        </div>
                        <div class="container mx-5">
                            <blockquote class="blockquote">
                                <p class="mb-0">Дата: {{$problem->detection_date}}</p>
                            </blockquote>
                        </div>

                        @if (isset($problem->solution_date))
                        <div class="container mx-5">
                            <blockquote class="blockquote">
                                <p class="mb-0">Дата вирішення: {{$problem->solution_date}}</p>
                            </blockquote>
                        </div>
                    @endif

                    @if (isset($problem->solution_time))
                        <div class="container mx-5">
                            <blockquote class="blockquote">
                                <p class="mb-0">Дата: {{$problem->solution_time}}</p>
                            </blockquote>
                        </div>
                    @endif

                    @if (isset($problem->solution_time))
                        <div class="container mx-5">
                            <blockquote class="blockquote">
                                <p class="mb-0">Дата: {{$problem->solution_time}}</p>
                            </blockquote>
                        </div>
                    @endif

                    @if (isset($problem->solution_id))
                        <div class="container mx-5">
                            <blockquote class="blockquote">
                                <p class="mb-0">
                                    <a href="/solutions/{{$problem->solution_id}}"
                                    class="btn btn-success text-dark">Рішення</a>
                                    </p>
                            </blockquote>
                        </div>
                    @endif

                    @if (isset($problem->user_id))
                        <div class="container mx-5">
                            <blockquote class="blockquote">
                                <p class="mb-0">
                                    <a href="/solutions/{{$problem->user_id}}"
                                       class="btn btn-success text-dark">Вирішено:
                                    {{\App\User::find($problem->user_id)->name}}
                                    </a>
                                </p>
                            </blockquote>
                        </div>
                    @endif

                    @if ($problem->status == 2 and $user->role == 1)
                        <div class="container mx-5">
                            <blockquote class="blockquote">
                                <p class="mb-0">Відправлено експертам</p>
                            </blockquote>
                        </div>
                    @endif

                    @if($problem->status == 1 and $user->role == 1
                            or $problem->status == 2 and $user->role == 2)
                        <form method="POST"
                              action="/problems/answer/{{$problem->id}}/{{$problem->theme}}/{{$problem->product_id}}"
                              enctype="multipart/form-data">
                            @csrf
                            <div class="col-md-12">
                                <div class="container px-2 py-2">
                                    <div class="container my-5">
                                        <blockquote class="blockquote">
                                            <h4 class="mb-0">Відповісти:</h4>
                                        </blockquote>
                                    </div>
                                    <textarea id="description" type="text" rows="10" name="description" required
                                              class="form-control bg-light text-dark @error('description') is-invalid @enderror"
                                              autocomplete="description"></textarea>
                                @error('description')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->all() }}</strong>
                                    </span>
                                @enderror
                                    <div class="container row py-3 px-5 offset-md-2">
                                        <form action="/problems/answer/{{$problem->id}}/{{$problem->theme}}/{{$problem->product_id}}" method="POST">
                                            {{ csrf_field() }}
                                            <button class="btn btn-primary col-2">Відправити</button>
                                        </form>
                                    <div class="form-group row mb-0">
                                        <div class="offset-md-2">
                                            <form action="/problems/sendToExperts/{{$problem->id}}" method="POST">
                                                {{ csrf_field() }}
                                                {{ method_field('PUT') }}
                                                <button class="btn btn-warning">Надіслати експертам</button>
                                            </form>
                                        </div>
                                    </div>
                                        <div class="form-group row mb-0">
                                            <div class="offset-md-4">
                                                <a href="/solutions?problem={{$problem->id}}" class="btn btn-success">
                                                    Обрати відповідь із наявних
                                                </a>
                                            </div>
                                        </div>
                            </div>

                            </div>

                            </div>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>

@endsection
