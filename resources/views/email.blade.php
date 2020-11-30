<div class="well col-sm-8">
   <h1>Шановний {{$problem->username}}!</h1>
    <p>Наш експерт {{$user}} переглянув ваше питання за темою "{{$problem->theme}}":<br> {{$problem->description}}
    <br> <b>Відповідь:</b>
        {{$solution->description}}<br>
        Всього найкращого!
    </p>
</div>
