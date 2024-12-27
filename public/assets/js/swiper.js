function swiper() {
    document.addEventListener("DOMContentLoaded", function () {
        const addInputTextContainer = document.getElementById(
            "swiper-data-container"
        );
        const addInputTextBtn = document.getElementById("swiper-data");
    
        // Log to check if the elements are correctly selected
        console.log(addInputTextContainer, addInputTextBtn);
    
        // Function to create a new row for swiper data inputs
        function addInputTextRow() {
            const index = addInputTextContainer.children.length; // Use direct count of rows for a simple integer index
    
            // Create a new row container
            const row = document.createElement("div");
            row.classList.add("d-flex", "gap-2", "mb-2");
    
            // Input: title_en (key)
            const titleKeyInput = document.createElement("input");
            titleKeyInput.type = "text";
            titleKeyInput.name = `swiper-data[${index}][title_en]`;
            titleKeyInput.classList.add("form-control");
            titleKeyInput.placeholder = "Enter title in English";
    
            // Input: description_en (value)
            const descriptionValueInput = document.createElement("input");
            descriptionValueInput.type = "text";
            descriptionValueInput.name = `swiper-data[${index}][description_en]`;
            descriptionValueInput.classList.add("form-control");
            descriptionValueInput.placeholder = "Enter description in English";
    
            // Input: title_ar (key)
            const titleKeyArInput = document.createElement("input");
            titleKeyArInput.type = "text";
            titleKeyArInput.name = `swiper-data[${index}][title_ar]`;
            titleKeyArInput.classList.add("form-control");
            titleKeyArInput.placeholder = "Enter title in Arabic";
    
            // Input: description_ar (value)
            const descriptionValueArInput = document.createElement("input");
            descriptionValueArInput.type = "text";
            descriptionValueArInput.name = `swiper-data[${index}][description_ar]`;
            descriptionValueArInput.classList.add("form-control");
            descriptionValueArInput.placeholder = "Enter description in Arabic";
    
            // Remove Button
            const removeButton = document.createElement("button");
            removeButton.type = "button";
            removeButton.textContent = "Remove";
            removeButton.classList.add("btn", "btn-danger", "btn-sm");
            removeButton.addEventListener("click", function () {
                row.remove();
            });
    
            // Append inputs and button to the row
            row.appendChild(titleKeyInput);
            row.appendChild(descriptionValueInput);
            row.appendChild(titleKeyArInput);
            row.appendChild(descriptionValueArInput);
            row.appendChild(removeButton);
    
            // Add the row to the container
            addInputTextContainer.appendChild(row);
        }
    
        // Attach the addInputTextRow function to the 'Add Swiper' button
        if (addInputTextBtn) {
            addInputTextBtn.addEventListener("click", addInputTextRow);
        } else {
            console.error("Button not found!");
        }
    });
}    
swiper();