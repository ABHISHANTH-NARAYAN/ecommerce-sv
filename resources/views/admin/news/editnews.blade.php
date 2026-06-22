<!DOCTYPE html>
<html>
<head>
    <title>Edit news</title>
</head>
<body>
<h2>edit news</h2>
<form action="{{ route('news.update',$news->id) }}"
      method="POST"
      enctype="multipart/form-data">
@csrf
    @method('PUT')

    <label>Title</label>

    <input type="text"
           name="title"
           value="{{ old('title',$news->title) }}">
           <br><br>
           <label>Description</label>
            <textarea name="description"
              rows="5"
              cols="50">{{ old('description',$news->description) }}</textarea>

              <label>Status</label>

    <select name="status">

        <option value="Published"
            {{ $news->status == 'Published' ? 'selected' : '' }}>
            Published
        </option>

        <option value="Draft"
            {{ $news->status == 'Draft' ? 'selected' : '' }}>
            Draft
        </option>

    </select>

    <br><br>

    <label>Current Image</label>

    <br>
     @if($news->image)
        <img src="{{ asset('storage/'.$news->image) }}"
             width="150">
    @endif

    <br><br>

    <label>Change Image</label>

    <input type="file" name="image">

    <br><br>

    <button type="submit">
        Update News
    </button>

</form>

</body>
</html>