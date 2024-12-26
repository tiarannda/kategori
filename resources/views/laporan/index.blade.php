<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    @foreach ($files as $file)
        <tr>
            <td>{{ $file->getName() }}</td>
            <td><a href="{{ $file->getPathDisplay() }}" target="_blank">Download</a></td>
        </tr>
    @endforeach
</body>

</html>
