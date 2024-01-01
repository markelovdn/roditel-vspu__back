<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Сертификат</title>
    <style>
        body {
            font-family: DejaVu Sans;
            margin: 0;
            padding: 0;
        }

        @page {
            size: A4 landscape;
        }
        .container {
            width: 27cm;
            height: 18.4cm;
            margin: 0 auto;
            padding: 0;
            font-size: 12px;
            border: 3px solid #0091f9;
            box-sizing: border-box;
        }
    </style>
</head>
<body>
    <div class="container">
        <header>
            <div style="display: inline-block; float: left; width: 20%; margin-left: 20px; margin-top: 20px">
                <img style="width: 5.74cm; height: 4.27cm" src="{{ asset('storage/webinars/logo/sertificate_logo_left.png') }}" alt="">
            </div>
            <div style="display: inline-block; margin-top: 20px; float: left; width: 60%; text-align: center">
                <span style="font-size: 11px; font-weight: bold;">МИНПРОСВЕЩЕНИЯ РОССИИ</span><br>
                <span style="font-size: 11px; font-weight: bold;">ФГБОУ ВО «ВОЛГОГРАДСКИЙ ГОСУДАРСТВЕННЫЙ СОЦИАЛЬНО-ПЕДАГОГИЧЕСКИЙ</span><br>
                <span style="font-size: 11px; font-weight: bold;">УНИВЕРСИТЕТ»</span><br>
                <span style="font-size: 11px; font-weight: bold;">ФАКУЛЬТЕТ ПСИХОЛОГО-ПЕДАГОГИЧЕСКОГО И СОЦИАЛЬНОГО ОБРАЗОВАНИЯ</span><br>
                <span style="font-size: 11px; font-weight: bold;">МЕЖРЕГИОНАЛЬНАЯ СЛУЖБА КОНСУЛЬТИРОВАНИЯ РОДИТЕЛЕЙ</span><br>
            </div>
            <div style="display: inline-block; float: right; width: 20%; margin-right: 20px; margin-top: 20px">
                <img style="width: 4.51cm; height: 4.27cm" src="{{ asset('storage/webinars/logo/sertificate_logo_right.png') }}" alt="">
            </div>
        </header>
        <div style="text-align: center; margin-top: 130">
            <div style="font-size: 28px; font-weight: bold;">СЕРТИФИКАТ</div>
            <div style="font-size: 18px;">настоящий сертификат подтверждает, что</div>
            <div style="font-size: 18px; font-weight: bold; margin-top: 10px;">
                {{$parented->first_name}} {{$parented->patronymic}} {{$parented->second_name}}
            </div>
            <div style="font-size: 18px;">принял(а) участие в просветительском мероприятии для родительского сообщества2</div>
            <div style="font-size: 22px; font-weight: bold; margin: 10px;">{{$webinar->title}}</div>
            <div style="font-size: 18px;">г. Волгоград, {{$webinarDate}}</div>
        </div>
        <footer style="width: 100%; margin-top: 30px">
            <div style="font-size: 14px; float: left; width: 35%; margin-left: 20px; inline-block">
                декан факультета психолого-педагогического и социального образования
            </div>
            <div style="inline-block; width: 20%; float: left;">
                <img style="width: 4.8cm; height: 2.8cm; margin-top: -30px; margin-left: 160px;" src="{{ asset('storage/webinars/logo/sign.png') }}" alt="">
            </div>
            <div style="font-size: 14px; float: right; width: 10%; margin-top: 20px; margin-right: 20px; inline-block">
                Зотова Н.Г.
            </div>
        </footer>
        <div style="text-align: center; font-size: 14px; display: block; margin-top: 120px">Регистрационный номер {{$webinarRegNumber}}</div>
    </div>
</body>
</html>
