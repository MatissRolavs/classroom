<!DOCTYPE html>
<html lang="lv">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kalendārs</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }
        .calendar {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            gap: 10px;
            margin-top: 20px;
        }
        .day {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: center;
            background: white;
        }
        .header {
            font-weight: bold;
            background: #007bff;
            color: white;
        }
        .navigation {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin: 20px 0;
        }
        .month {
            font-size: 24px;
            font-weight: bold;
        }
        .button {
            cursor: pointer;
            background: #007bff;
            color: white;
            border: none;
            padding: 10px;
            border-radius: 5px;
        }
        .button:hover {
            background: #0056b3;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="navigation">
        <button class="button" onclick="changeMonth(-1)">&laquo; Iepriekšējais mēnesis</button>
        <div class="month">{{ $monthName }} {{ $year }}</div>
        <button class="button" onclick="changeMonth(1)">Nākamais mēnesis &raquo;</button>
    </div>

    <div class="calendar">
        <div class="day header">P</div>
        <div class="day header">O</div>
        <div class="day header">T</div>
        <div class="day header">C</div>
        <div class="day header">P</div>
        <div class="day header">S</div>
        <div class="day header">Sv</div>

        @php
            // Aprēķinām sākuma datumu
            $startOfMonth = Carbon\Carbon::createFromDate($year, $month, 1)->startOfMonth();
            $startDay = $startOfMonth->copy()->startOfWeek();
        @endphp

        @for ($day = $startDay; $day->lte($startOfMonth->endOfMonth()); $day->addDay())
            <div class="day">
                @if ($day->month == $startOfMonth->month)
                    {{ $day->day }}
                @else
                    &nbsp; <!-- Tukša vieta, ja diena nav šajā mēnesī -->
                @endif
            </div>
        @endfor
    </div>
</div>

<script>
    function changeMonth(direction) {
        const currentMonth = {{ $month }};
        const currentYear = {{ $year }};
        let month = new Date(new Date(currentYear, currentMonth - 1).setMonth(currentMonth - 1 + direction));
        window.location.href = `/calendar/${month.getMonth() + 1}/${month.getFullYear()}`;
    }
</script>

</body>
</html>
