function initializer(options) {
    const { baseUrl, csrf_token, formName } = options;

    const toggle = $("#toggle_" + formName);
    const toggleStatus = $("#toggle-status-" + formName);

    toggleStatus.text(toggle.is(":checked") ? "Show" : "Hidden");

    toggle.change(function () {
        const status = toggle.is(":checked") ? "on" : "off";
        toggleStatus.text(status === "on" ? "Show" : "Hidden");

        $.ajax({
            url: baseUrl.replace(":form", formName).replace(":status", status),
            type: "POST",
            data: {
                _token: csrf_token,
                status: status,
                form: formName,
            },
            success: function (response) {
                console.log(response.message);
                // alert('Status updated successfully!');
                location.reload();
            },
            error: function (error) {
                console.error("Error:", error);
                // alert('Failed to update status.');
            },
        });
    });
    console.log(`Toggle initialized for form: ${formName}`);
}

function initializeTable(options) {
    const { formName } = options;
    console.log("initializeTable called with formName:", formName);
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
