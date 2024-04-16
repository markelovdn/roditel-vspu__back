<table>
    <thead>
    <tr>
        <th>Вопрос</th>
        <th>Ответы</th>
    </tr>
    </thead>
    <tbody>
        @foreach ($questionnaire->questions as $question)
        <tr>
            <td>{{$question->text}}</td>
            @foreach ($question->options as $option)
                <td>{{$option->text}}</td>
            @endforeach
            @if ($question->optionOther)
                <td>{{$question->optionOther->text}}</td>
            @endif
        </tr>
        @endforeach
    </tbody>
</table>
