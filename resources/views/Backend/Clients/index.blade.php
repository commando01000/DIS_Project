@extends('Backend.Shared.layout')

@section('title', 'Client Data')

@section('css')
    <style>
        .input-group-text {
            width: 100px;
        }

        .toggle-container {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .toggle-switch {
            position: relative;
            width: 60px;
            height: 30px;
        }

        .toggle-input {
            display: none;
        }

        .toggle-label {
            display: block;
            width: 100%;
            height: 100%;
            background: #ccc;
            border-radius: 50px;
            cursor: pointer;
            position: relative;
            transition: background-color 0.3s ease;
        }

        .toggle-indicator {
            position: absolute;
            top: 3px;
            left: 3px;
            width: 24px;
            height: 24px;
            background: #fff;
            border-radius: 50%;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
            transition: transform 0.3s ease;
        }

        .toggle-input:checked+.toggle-label {
            background: #4caf50;
        }

        .toggle-input:checked+.toggle-label .toggle-indicator {
            transform: translateX(30px);
        }

        .toggle-status {
            font-size: 16px;
            font-weight: bold;
            color: #333;
            transition: color 0.3s ease;
        }

        .toggle-input:checked~.toggle-status {
            color: #4caf50;
        }

        .form-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 20px;
        }

        .toggle-container {
            margin-left: auto;
            display: flex;
            align-items: center;
            gap: 10px;
        }
    </style>
@endsection

@section('content')
    <div id="clients" class="m-5 p-5 w-75 mx-auto">
        <form action="{{ route('admin.client.translate') }}" enctype="multipart/form-data" method="POST">
            @csrf
            <!-- Bank Name En-->
            <div class="mb-3">
                <label for="bank_name" class="form-label">Bank/Company Name</label>
                <input type="text" class="form-control" name="bank_name_en" id="bank_name_en"
                    placeholder="Bank or Company Name" />
            </div>
            <!-- Bank Name Ar-->
            <div class="mb-3">
                <label for="bank_name" class="form-label">بنك/شركه</label>
                <input type="text" class="form-control" name="bank_name_ar" id="bank_name_ar"
                    placeholder="اسم البنك او الشركة" />
            </div>

            <!-- Contract Date -->
            {{-- <div class="mb-3">
                <label for="contract_date" class="form-label">Contract Date</label>
                <input type="date" class="form-control" name="contract_date" id="contract_date" />
            </div>


            <!-- Module Type -->
            <div class="mb-3">
                <label for="selected_module" class="form-label">Module Type</label>
                <select name="selected_module[]" class="form-control" multiple required>
                    <option value="Legal Pro" {{ in_array('Legal Pro', $moduleTypes ?? []) ? 'selected' : '' }}>Legal Pro
                    </option>
                    <option value="Mail Pro" {{ in_array('Mail Pro', $moduleTypes ?? []) ? 'selected' : '' }}>Mail Pro
                    </option>
                    <option value="Visit Pro" {{ in_array('Visit Pro', $moduleTypes ?? []) ? 'selected' : '' }}>Visit Pro
                    </option>
                </select>
            </div>


            <!-- Logo Upload -->
            <div class="mb-3">
                <label for="logo" class="form-label">Logo</label>
                <input type="file" class="form-control" name="logo" id="logo" />
            </div> --}}

            <div class="form-actions">
                <input class="btn btn-success" type="submit" value="Save Client" />
                <div class="toggle-container">
                    <div class="toggle-switch">
                        <input type="checkbox" id="toggle" class="toggle-input" checked />
                        <label for="toggle" class="toggle-label">
                            <span class="toggle-indicator"></span>
                        </label>
                    </div>
                    <span id="toggle-status" class="toggle-status text-light">Show</span>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('js')
    <script>
        const toggle = document.getElementById('toggle');
        const toggleStatus = document.getElementById('toggle-status');

        toggle.addEventListener('change', () => {
            toggleStatus.textContent = toggle.checked ? 'Show' : 'Hidden';
        });

        toggleStatus.textContent = toggle.checked ? 'Show' : 'Hidden';
    </script>
@endsection
