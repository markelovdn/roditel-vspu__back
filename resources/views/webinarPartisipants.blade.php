<table>
    <thead>
    <tr>
        <th>ФИО</th>
        <th>Номер сертификата</th>
    </tr>
    </thead>
    <tbody>
        @foreach ($participants as $participant)
        <tr>
            <td>{{$participant->second_name}} {{$participant->first_name}} {{$participant->patronymic}}</td>
            <td>{{$participant->sertificate_number}}</td>
        </tr>
        @endforeach
    </tbody>
</table>
