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
    // console.log("initializeTable called with formName:", formName);

    const tableId = "#" + formName;

    // Log to ensure the table exists
    // console.log(`Initializing DataTable for ${formName}:`, tableId);
    // console.log("Table Exists:", $(tableId).length > 0);

    // Check if DataTable is already initialized and destroy if necessary
    if ($.fn.DataTable.isDataTable(tableId)) {
        $(tableId).DataTable().destroy(); // Destroy existing instance
    }

    // Initialize DataTable
    const table = $(tableId).DataTable({
        order: [
            [1, "asc"], // Default order by the first column (index 1)
        ],
        searching: true, // Enable search functionality
        language: {
            search: "Search: ", // Customize search label
            searchPlaceholder: "Type to search...", // Add placeholder text
        },
    });

    // Use jQuery to ensure the table DOM element is visible
    $(tableId).show();

    // console.log(`Table ${tableId} initialized with DataTable functionality.`);
}
