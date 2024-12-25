<!-- Social Media Links -->
<div class="mb-3">
    <label for="swiper-data" class="form-label">Social Media Links Section</label>
    <div id="swiper-data-container">
        <input type="text" name="swiper-data[0][key]" class="form-control"
            placeholder="Enter title (e.g., Title in English)">
        <input type="text" name="swiper-data[0][value]" class="form-control"
            placeholder="Enter description (e.g., Description in English)">
        <input type="text" name="swiper-data[1][key]" class="form-control"
            placeholder="Enter label (e.g., Facebook, Phone, Email)">
        <input type="text" name="swiper-data[1][value]" class="form-control"
            placeholder="Enter the URL or contact (e.g., https://facebook.com/yourpage)"><br>
    </div>
    <button type="button" class="btn btn-primary btn-sm mt-2" id="swiper-data">Add Slider</button>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const socialMediaContainer = document.getElementById('swiper-data-container');
        const addSocialMediaBtn = document.getElementById('swiper-data');

        // Function to create a new row for social media inputs
        function addSocialMediaRow() {
            const index = socialMediaContainer.children.length;

            // Create a new row container
            const row = document.createElement('div');
            row.classList.add('d-flex', 'gap-2', 'mb-2', 'flex-wrap'); // Add flex-wrap for better alignment

            // Input: title_en (key)
            const titleKeyInput = document.createElement('input');
            titleKeyInput.type = 'text';
            titleKeyInput.name = `swiper-data[${index}][key]`;
            titleKeyInput.classList.add('form-control');
            titleKeyInput.placeholder = 'Enter title (e.g., Title in English)';

            // Input: title_ar (value)
            const descriptionValueInput = document.createElement('input');
            descriptionValueInput.type = 'text';
            descriptionValueInput.name = `swiper-data[${index}][value]`;
            descriptionValueInput.classList.add('form-control');
            descriptionValueInput.placeholder = 'Enter description (e.g., Description in English)';

            // Input: description_en (key)
            const socialKeyInput = document.createElement('input');
            socialKeyInput.type = 'text';
            socialKeyInput.name = `swiper-data[${index}][key]`;
            socialKeyInput.classList.add('form-control');
            socialKeyInput.placeholder = 'Enter label (e.g., Facebook, Phone, Email)';

            // Input: description_ar (value)
            const socialValueInput = document.createElement('input');
            socialValueInput.type = 'text';
            socialValueInput.name = `swiper-data[${index}][value]`;
            socialValueInput.classList.add('form-control');
            socialValueInput.placeholder = 'Enter the URL or contact (e.g., https://facebook.com/yourpage)';

            // Remove Button
            const removeButton = document.createElement('button');
            removeButton.type = 'button';
            removeButton.textContent = 'Remove';
            removeButton.classList.add('btn', 'btn-danger', 'btn-sm');
            removeButton.addEventListener('click', function() {
                row.remove(); // Remove this row
            });

            // Append inputs and button to the row
            row.appendChild(titleKeyInput);
            row.appendChild(descriptionValueInput);
            row.appendChild(socialKeyInput);
            row.appendChild(socialValueInput);
            row.appendChild(removeButton);

            // Add the row to the container
            socialMediaContainer.appendChild(row);
        }

        // Attach the addSocialMediaRow function to the 'Add Social Media' button
        addSocialMediaBtn.addEventListener('click', addSocialMediaRow);
    });
</script>
