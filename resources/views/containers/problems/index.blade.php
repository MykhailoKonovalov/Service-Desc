@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="container py-3">
            <div class="row">
                </div>
            </div>

            <div class="row bg-dark px-2 py-1 mx-1">
                <div class="col-3">
                    <p class="text-light">Тема</p>
                </div>
                <div class="col-4">
                    <p class="text-light">Опис</p>
                </div>
                <div class="col-2">
                    <p class="text-light">Стосовно</p>
                </div>
            </div>

            @foreach($problems as $data)
                <div class="row bg-light px-2 py-2 mx-1 ">
                    <div class="col-3">
                        {{mb_strimwidth($data->theme, 0, 90, '...')}}
                    </div>
                    <div class="col-4">
                        {{mb_strimwidth($data->description, 0, 120, '...')}}
                    </div>
                    <div class="col-2">
                        {{$data->product_title}}
                    </div>
                    <div class="col-2 px-2 float-right">
                        <a href="/problems/{{$data->id}}/edit" class="btn btn-info">Переглянути</a>
                    </div>
                </div>
            @endforeach
            {{$problems->appends(["problems_query" => $_GET["problems_query"] ?? null])->links()}}
        </div>
    </div>
@endsection
