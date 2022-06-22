<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>
</head>
<body class="antialiased">
<div>
    <a href="{{ route('contacts.index') }}">All Contacts</a>
    <a href="{{ route('contacts.create') }}">Add Contacts</a>
    <a href="{{ route('contacts.show',1) }}">Show a Contacts</a>
</div>
</body>
</html>
