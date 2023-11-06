@if (empty($survey))
@json('You do not have access to this survey')
@endif
<table>
    <thead>
    <tr>
        <th>Пол</th>
        <th>ФИО</th>
        <th>Дата рождения</th>
        <th>Претендует на гып</th>
        <th>Тренер</th>
    </tr>
    </thead>
    <tbody>
        <tr>
            <td>{{$survey->title}}</td>
            <td>{{$survey->title}}</td>
            <td>{{$survey->title}}</td>
            <td>{{$survey->title}}</td>
            <td>{{$survey->title}}</td>
        </tr>
    </tbody>
</table>
