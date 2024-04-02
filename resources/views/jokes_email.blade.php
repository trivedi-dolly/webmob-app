<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jokes Email</title>
</head>

<body>
    <h1>Here are your daily jokes!</h1>

    @foreach($jokes as $index => $joke)
    <div>
        <p><strong>Joke {{ $index + 1 }}:</strong> {{ $joke->jokes }}</p>
    </div>
    @endforeach
</body>

</html>