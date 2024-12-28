@extends('Backend.Shared.layout')

@section('title', 'Client Data')

@section('content')
    <div id="clients" class="themed-box">
        @include('Shared.loader')</h2>
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
        <table id="banksTable" class="table content table-bordered" style="width:100%">
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
                $('#banksTable').DataTable();
                initializeTable({
                    contacts: 'banks'
                });
            });
        });
    </script>

@endsection
