<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Form Update</title>
</head>
<body>
    @if ($errors->any())
        <p>{{ $errors->first() }}</p>
    @endif
    <form action="" method="post">
        @csrf
        <p>Form Title</p>
        <input type="text" name="title" id="" value="{{ ucwords($form->title) }}">
        <p>Form Description (max 100)</p>
        <input type="text" name="desc" id="" value="{{ $form->desc }}">
        <p>Form Massage ?</p>
        <input type="checkbox" name="form-massage" id="" @if ($form->id_massage)
            checked
        @endif>
        <p>Form Public ?</p>
        <select name="status_form" id="">
            <option value="{{ $form->status }}">{{ ucwords($form->status) }}</option>
            <option value="public">Public</option>
            <option value="private">Private</option>
        </select>
        <p>Password Form</p>
        <input type="text" name="password" id="" value="{{ old('password') ?? $form->password }}">
        <p>Registerd Member</p>
        <p>Total : {{ ($form->register != null) ? count($form->register) : 0 }} <span><a href="{{ route('form.list.member', ['slug' => $form->slug]) }}">See all</a></span></p>
        <p>Form Details</p>
        <textarea name="details" id="editor" cols="30" rows="10">{{ old('details') ?? $form->details }}</textarea>
        <button type="submit">Create</button>
    </form>
</body>
@include('Includes.CKEditor')

</html>