@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-dark text-light text-center">Ваша сторінка</div>

                <div class="card-body bg-primary text-dark">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                        <form action="/home/{{$user->id}}">
                            {{ csrf_field() }}
                            <li class="list-group-item">
                                <h3><a href="/problems" class="text-dark">Список проблем</a></h3>
                            </li>
                            <li class="list-group-item">
                                <h3><a href="/solutions" class="text-dark">Список рішень</a></h3>
                            </li>
                            <div class="form-group row  py-3">

                                        <label for="specialization" class="col-md-4 col-form-label text-md-right">
                                            Виберіть свою спеціалізацію</label>

                                        <select class="col-md-4" name="specialization" id="specialization">
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                @foreach($products as $data)
                                                    @if($user->role == $data->id)
                                                    <option class="dropdown-item form-control"
                                                             value="{{$data->id}}" autofocus>
                                                        {{$data->title}}
                                                    </option>
                                                    @else
                                                        <option class="dropdown-item form-control"
                                                                 value="{{$data->id}}">
                                                            {{$data->title}}
                                                        </option>
                                                    @endif
                                                @endforeach
                                            </div>
                                        </select>
                                    <div class="form-group row mb-0">
                                        <div class="col-md-6 offset-md-4">
                                            <form action="/home/{{$user->id}}">
                                                {{ method_field("PUT") }}
                                                {{ csrf_field() }}
                                                <button class="btn btn-light">Відправити</button>
                                            </form>
                                        </div>
                                    </div>
                        </ul>
                </div>
                        </form>
            </div>

        </div>
    </div>
</div>
@endsection
