@extends('Backend.Shared.layout')

@section('title', 'Emails')



@section('content')

    <form action="{{ route('admin.emails.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="subject">Subject</label>
            <input type="text" name="subject" id="subject" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="editor1">Body</label>
            <textarea class="ckeditorform-control" name="editor1" id="editor1" rows="10" cols="60">
            </textarea>
        </div>
        <div class="form-group">
            <label for="recipients">Recipients</label>
            <select name="recipients[]" id="recipients" class="form-control" multiple required>
                @foreach ($users as $user)
                    <option value="{{ $user->id }}">{{ $user->email }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-success">Send Email</button>
    </form>

@endsection
