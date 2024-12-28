@extends('Backend.Shared.layout')

@section('title', 'Emails')

<style>
    /* General Styles */
    .select2-container .select2-selection {
        background-color: #1e1e1e;
        /* Default dark mode background */
        border: 1px solid #444;
        /* Subtle border */
        color: #fff;
        /* Text color for dark mode */
    }

    .select2-container--default .select2-selection--multiple .select2-selection__choice {
        background-color: #444;
        /* Tag background */
        color: #fff;
        /* Tag text color */
        border: 1px solid #333;
        /* Border for tags */
    }

    /* Dropdown styles for dark mode */
    .select2-dropdown {
        background-color: #1e1e1e;
        color: #fff;
        border: 1px solid #444;
    }

    .select2-dropdown .select2-results__option {
        color: #fff;
    }

    .select2-dropdown .select2-results__option--highlighted {
        background-color: #444;
        color: #fff;
    }

    /* Light mode */
    body.light-mode .select2-container .select2-selection {
        background-color: #fff;
        border: 1px solid #ccc;
        color: #333;
    }

    body.light-mode .select2-container--default .select2-selection--multiple .select2-selection__choice {
        background-color: #f0f0f0;
        color: #333;
        border: 1px solid #ccc;
    }

    body.light-mode .select2-dropdown {
        background-color: #fff;
        color: #333;
        border: 1px solid #ccc;
    }

    body.light-mode .select2-dropdown .select2-results__option {
        color: #333;
    }

    body.light-mode .select2-dropdown .select2-results__option--highlighted {
        background-color: #f0f0f0;
        color: #333;
    }
</style>


@section('content')

    <form action="{{ route('admin.emails.store') }}" class="mt-5" method="POST">
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

@section('scripts')
    <script>
        $(document).ready(function() {
            $('#recipients').select2({
                placeholder: 'Select recipients',
                allowClear: true,
                width: '100%',
            });
        });
    </script>
@endsection
