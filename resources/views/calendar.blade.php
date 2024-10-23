<x-app-layout>
<!DOCTYPE html>
<html lang="lv">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Callendar</title>
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
            padding: 20px;
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

        .empty-day {
            background-color: #f1f1f1;
        }
        .task-title {
            font-size: 16px;
            color: #0d6efd;
            text-decoration: underline;
        }
    </style>
</head>

<body>

<div class="container">
    <div class="navigation">
        <button class="button" onclick="changeMonth(-1)">&laquo; Previous month</button>
        <div class="month">{{ $monthName }} {{ $year }}</div>
        <button class="button" onclick="changeMonth(1)">Next month &raquo;</button>
    </div>

    <div class="calendar">
        <div class="day header">Mon</div>
        <div class="day header">Tue</div>
        <div class="day header">Wed</div>
        <div class="day header">Thu</div>
        <div class="day header">Fri</div>
        <div class="day header">Sat</div>
        <div class="day header">Sun</div>

        @php
            $startOfMonth = Carbon\Carbon::createFromDate($year, $month, 1);
            $startDay = $startOfMonth->copy()->startOfWeek(); // First day of the week (could be from the previous month)
            $endDay = $startOfMonth->copy()->endOfMonth()->endOfWeek(); // Last day of the month plus days until the end of the week
        @endphp

        @foreach ($tasks as $task)
            @if (Carbon\Carbon::parse($task->due_date)->month == $month && Carbon\Carbon::parse($task->due_date)->year == $year)
                @php
                    $taskDay = Carbon\Carbon::parse($task->due_date)->format('j');
                @endphp
            @endif
        @endforeach

        @for ($day = $startDay; $day->lte($endDay); $day->addDay())
            <div class="day">
                    {{ $day->day }}
                    @if ($day->month == $month)
                    @foreach ($user_subjects as $user_subject)
                        @foreach($subjects as $subject)
                        @if ($user_subject->user_id == auth()->user()->id && $user_subject->subject_id == $subject->id)
                            @foreach ($tasks as $task)
                                @if ($task->class_id == $user_subject->subject_id && Carbon\Carbon::parse($task->due_date)->format('j') == $day->format('j'))
                                    <div class="task-title"><a href="{{ route('subject.show', $user_subject->subject_id) }}">{{ $task->title }}</a></div>
                                @endif
                            @endforeach
                        @endif
                        @endforeach
                    @endforeach
                @else
                    <span class="empty-day">&nbsp;</span> <!-- Handle empty days -->
                @endif
            </div>
        @endfor
    </div>
</div>

<script>
    function changeMonth(direction) {

        let currentMonth = {{ $month }} - 1;
        let currentYear = {{ $year }};
        
        let newDate = new Date(currentYear, currentMonth + direction, 1);
        let newMonth = newDate.getMonth() + 1;
        let newYear = newDate.getFullYear();

        window.location.href = `/calendar/${newMonth}/${newYear}`;
    }
</script>

</body>
</html>
</x-app-layout>

