function initializer(options) {
    const {
        baseUrl,
        csrf_token,
        key,
        formName, // Form name (e.g., 'projects', 'contacts')
    } = options;

    // Get toggle and status elements
    const toggle = $("#toggle");
    const toggleStatus = $("#toggle-status");
    const checkbox_name = "input.:form-checkbox".replace(":form", formName);

    // Set initial status text
    toggleStatus.text(toggle.is(":checked") ? "Show" : "Hidden");
    // Handle toggle status change with AJAX
    toggle.change(function () {
        const status = toggle.is(":checked") ? "Show" : "Hidden";
        toggleStatus.text(status);
        let url = baseUrl.replace(":form", formName).replace(":key", key).replace(":status", status);
        $.ajax({
            url: url,
            type: "POST",
            data: {
                _token: csrf_token,
                status: status,
                form: formName,
            },
            success: function (response) {
                console.log(response.message);
                // Optionally show a success message or notification
                // alert('Status updated successfully');

                // Refresh the page
                location.reload();
            },
            error: function (error) {
                console.error("Error:", error);
                // Optionally show an error message or notification
                // alert('Something went wrong!');
            },
        });
        // Set initial status text based on checkbox state
        toggleStatus.text(toggle.is(":checked") ? "Show" : "Hidden");
    });

    console.log(`Toggle and checkboxes initialized for ${formName}`);
}

function initializeTable(options) {
    const { formName } = options;

    // Dynamically create the table selector using the formName provided in options
    const table_name = `#${formName}Table`;

    console.log(`Initializing DataTable for ${formName}:`, table_name);

    // Initialize DataTable
    const table = $(table_name).DataTable({
        scrollX: true, // Enable horizontal scrolling
        fixedColumns: true, // Fix the columns for scrolling
        order: [
            [1, "asc"], // Default order by the second column (index 1)
        ],
    });

    // Ensure the table is visible after initialization
    $(table_name).show();

    // Handle checkbox selection (checkbox_name dynamically constructed from formName)
    const checkbox_name = `input[name='${formName}-checkbox']`;

    $(table_name).on("click", checkbox_name, function () {
        const row = $(this).closest("tr");
        if (this.checked) {
            table.rows(row).select();
        } else {
            table.rows(row).deselect();
        }
    });

    console.log(
        `Table ${formName} initialized with DataTable and checkbox functionality.`
    );
}
