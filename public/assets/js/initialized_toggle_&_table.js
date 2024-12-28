// function initializer_main(options) {
//     const { baseUrl, csrf_token,formName} = options;

//     // Dynamically select the toggle and status elements for the given form
//     const toggle = $(`#toggle_${formName}`);
//     const toggleStatus = $(`#toggle-status-${formName}`);

//     // Set initial status text
//     toggleStatus.text(toggle.is(":checked") ? "Show" : "Hidden");
//     console.log("initializer_main called");
//     // Handle toggle status change with AJAX
//     toggle.change(function () {
//         const status = toggle.is(":checked") ? "Show" : "Hidden";
//         toggleStatus.text(status);

//         // Build the dynamic URL
//         let url = baseUrl.replace(":form", formName);

//         // Send AJAX request to update status
//         $.ajax({
//             url: url,
//             type: "POST",
//             data: {
//                 _token: csrf_token,
//                 status: status,
//                 form: formName,
//             },
//             success: function (response) {
//                 console.log(response.message);
//                 // Optionally refresh or notify
//                 // location.reload();
//             },
//             error: function (error) {
//                 console.error("Error:", error);
//             },
//         });
//     });

//     // console.log(`Toggle initialized for form: ${formName}`);
// }
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
    // console.log(`Toggle initialized for form: ${formName}`);
}

function initializeTable(options) {
    const { formName } = options;

    // Dynamically select the table element for the given form
    const table_name = $(`#${formName}`);
    new DataTable("#example", {
        search: {
            return: true,
        },
    });
    // Dynamically create the table selector using the formName provided in options

    console.log(`Initializing DataTable for ${formName}:`, table_name);

    // Initialize DataTable
    const table = $(table_name).DataTable({
        

        order: [
            [1, "asc"], // Default order by the first column (index 0)
        ],
        searching: true, // Enable search functionality
        language: {
            search: "Search: ", // Customize search label
            searchPlaceholder: "Type to search...", // Add placeholder text
        },
    });

    // $(table_name).DataTable();
    // Ensure the table is visible after initialization
    table.show();

    console.log(`Table ${formName} initialized with DataTable functionality.`);
}
