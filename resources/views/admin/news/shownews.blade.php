<!DOCTYPE html>
<html>
<head>
    <title>News Details</title>
</head>
<body>

<h2>News Details</h2>

<p>
    <strong>Title:</strong>
    {{ $news->title }}
</p>

<p>
    <strong>Description:</strong>
    {{ $news->description }}
</p>

<p>
    <strong>Status:</strong>
    {{ $news->status }}
</p>

<p>
    <strong>Image:</strong>
</p>

@if(!empty($news->image))
    <img src="{{ asset('storage/'.$news->image) }}" width="250">
@else
    <p>No Image</p>
@endif

<br><br>

<a href="{{ route('admin.news.edit', $news->id) }}">
    Edit
</a>

|

<a href="{{ route('admin.news.index') }}">
    Back
</a>

</body>
</html>