<table>
    <thead>
    <tr>
        <th>ФИО</th>
        <th>Телефон</th>
        <th>Email</th>
        <th>Регион</th>
        <th>Номер сертификата</th>
    </tr>
    </thead>
    <tbody>
        @foreach ($participants as $participant)
        <tr>
            <td>{{$participant->second_name}} {{$participant->first_name}} {{$participant->patronymic}}</td>
            <td>{{$participant->phone}}</td>
            <td>{{$participant->email}}</td>
            <td>{{$participant->region_title}}</td>
            <td>{{$participant->sertificate_number}}</td>
        </tr>
        @endforeach
    </tbody>
</table>
