<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <label>Category:</label>

<select name="news_category_id">

    <option value="">
        Select Category
    </option>

    @foreach($categories as $category)

        <option value="{{ $category->id }}">
            {{ $category->name }}
        </option>

    @endforeach

</select>

<br><br>
    <title>Create news</title>
</head>
<body>
    <h2> create news </h2>
    <form action="{{ route('admin.news.store') }}"
      method="POST"
      enctype="multipart/form-data">

    @csrf
    <label> title</label>
    <input type="text" name="title"><br><br>
    <label>description</label>
    <br>
    <input type="text" name="description"><br><br>
    <label> status</label>
    <select name="status">
        <option value = "published">published</option>
        <option value="draft">draft</option>
</select>
<br> <br>
<label>image</label>
<input type="file" name="image">
<br><br>
<button type="submit">
    save News
</button>
</form>
</body>
</html>
