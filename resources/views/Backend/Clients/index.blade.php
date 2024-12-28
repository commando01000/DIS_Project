@extends('Backend.Shared.layout')

@section('title', 'Client Data')

@section('content')
    <div id="clients" class="themed-box">
        @include('Shared.loader')</h2>
        <h2>TTTTTTTTTTTTTTTTTTTTTTT</h2>
        <form action="{{ route('admin.client.translate') }}" enctype="multipart/form-data" method="POST">
            @csrf
            <form action="{{ route('update.settings.clients') }}" method="POST">
                @csrf
                <div class="mb-5 pb-5">
                    @include('Backend.shared.section-translation', [
                        'settings' => Settings::getSettingValue('clients'),
                    ])

                    @include('Backend.Shared.form-actions', [
                        'settings' => Settings::getSettingValue('clients'),
                        'formName' => 'clients',
                    ])
                </div>
            </form>
            {{-- <!-- Bank Name En -->
            <div class="mb-3">
                <label for="bank_name" class="form-label">Bank/Company Name</label>
                <input type="text" class="form-control" name="bank_name_en" id="bank_name_en"
                    placeholder="Bank or Company Name" />
            </div>
            <!-- Bank Name Ar -->
            <div class="mb-3">
                <label for="bank_name" class="form-label">بنك/شركه</label>
                <input type="text" class="form-control" name="bank_name_ar" id="bank_name_ar"
                    placeholder="اسم البنك او الشركة" />
            </div> --}}

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
    <div id="bank-tables" class="themed-box">
        <p><button id="button">Row count</button></p>
        <table id="banksTable" class="display" style="width:100%">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Position</th>
                    <th>Office</th>
                    <th>Age</th>
                    <th>Start date</th>
                    <th>Salary</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Tiger Nixon</td>
                    <td>System Architect</td>
                    <td>Edinburgh</td>
                    <td>61</td>
                    <td>2011-04-25</td>
                    <td>$320,800</td>
                </tr>
                <tr>
                    <td>Garrett Winters</td>
                    <td>Accountant</td>
                    <td>Tokyo</td>
                    <td>63</td>
                    <td>2011-07-25</td>
                    <td>$170,750</td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <th>Name</th>
                    <th>Position</th>
                    <th>Office</th>
                    <th>Age</th>
                    <th>Start date</th>
                    <th>Salary</th>
                </tr>
            </tfoot>
        </table>
    </div>

@endsection


@section('scripts')
    {{-- <script src="{{ asset('assets/js/initialized_toggle_&_table.js') }}"></script> --}}
    <script>
        const toggle = document.getElementById('toggle');
        const toggleStatus = document.getElementById('toggle-status');

        toggle.addEventListener('change', () => {
            toggleStatus.textContent = toggle.checked ? 'Show' : 'Hidden';
        });

        toggleStatus.textContent = toggle.checked ? 'Show' : 'Hidden';
    </script>
    <script>
        const table = new DataTable('#example');

        table.on('click', 'tbody tr', function(e) {
            e.currentTarget.classList.toggle('selected');
        });

        document.querySelector('#button').addEventListener('click', function() {
            alert(table.rows('.selected').data().length + ' row(s) selected');
        });
    </script>
    <script>
        $(window).on('load', function() {
            // Show the loader when the page starts loading
            $('.loader').show();
            // Call the initializer toggle function
            $(document).ready(function() {
                initializeTable({
                    baseUrl: baseUrl,
                    csrf_token: token,
                    formName: 'clients'
                });

            });
        });
    </script>

@endsection
