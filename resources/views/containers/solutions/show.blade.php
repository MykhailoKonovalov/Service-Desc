@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card bg-dark text-light">
                    <div class="container">
                        <h3 class="display-4 text-center">
                            {{$solution->theme}}
                        </h3>
                    </div>
                    <div class="container mx-5">
                        <blockquote class="blockquote">
                            <p class="mb-0 font-weight-bold">{{$solution->description}}</p>
                        </blockquote>
                    </div>
                    @if(isset($problem))
                        <div class="form-group row mb-0">
                            <div class="col-2 offset-md-2">
                                <form action="/problems/addAnswer/{{$solution->id}}/{{$problem->id}}"
                                      method="POST">
                                    {{ csrf_field() }}
                                    {{ method_field('PUT') }}
                                    <button class="btn btn-warning">Обрати відповідь</button>
                                </form>
                            </div>
                        </div>
                        <div class="container py-3">
                            <div class="card bg-light text-dark col-6">
                                <p>Обрано проблему:</p>
                                <p>{{mb_strimwidth($problem->theme, 0, 90, '...')}}</p>
                                <p>Від {{$problem->username}}</p>
                            </div>
                        </div>
                    @endif
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
