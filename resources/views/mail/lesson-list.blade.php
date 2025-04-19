<html>
    <body>
        <h1>Lesson List</h1>
        <p>Here is the list of lessons for the week:</p>
        <ul>
            @foreach ($lessons as $lesson)
                <li>{{ $lesson->title }}</li>
                <li>{{ $lesson->student1->name }}</li>
                @if($lesson->student2)
                    <li>{{ $lesson->student2->name }}</li>
                @endif
                <li>{{ $lesson->coach->name }}</li>
            @endforeach
        </ul>
    </body>
</html>