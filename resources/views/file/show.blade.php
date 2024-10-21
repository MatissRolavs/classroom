<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Display File</title>
</head>
<body>
    <h1>Display File</h1>
    @if($taskFile->path)
        @if(in_array(pathinfo($taskFile->path, PATHINFO_EXTENSION), ['jpg', 'png']))
            <img src="{{ asset('uploads/' . $taskFile->path) }}" alt="File Image">
        @elseif(pathinfo($taskFile->path, PATHINFO_EXTENSION) === 'pdf')
            <embed src="{{ asset('uploads/' . $taskFile->path) }}" type="application/pdf" width="100%" height="900px"></embed>
        @else
            <p>Unsupported file type</p>
        @endif
    @else
        <p>No file found.</p>
    @endif
</body>
</html>
