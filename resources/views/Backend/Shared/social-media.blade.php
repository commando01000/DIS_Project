<!-- Social Media Links -->
<div class="mb-3">
    <label for="social_media" class="form-label">Social Media Links Section</label>
    <div id="social-media-container">
        <!-- Social Media Inputs will be added dynamically here -->
        @if (!empty($links['links']))
            @foreach (json_decode($links['links'], true) as $index => $link)
                <div class="d-flex gap-2 mb-2">
                    <input type="text" name="social_media[{{ $index }}][key]" class="form-control"
                        value="{{ $link['key'] ?? '' }}"
                        placeholder="Enter label (e.g., Facebook, Phone, Email)">
                    <input type="text" name="social_media[{{ $index }}][value]" class="form-control"
                        value="{{ $link['value'] ?? '' }}"
                        placeholder="Enter the URL or contact (e.g., https://facebook.com/yourpage)">
                    <button type="button" class="btn btn-danger btn-sm">Remove</button>
                </div>
            @endforeach
        @endif
    </div>
    <button type="button" class="btn btn-primary btn-sm mt-2" id="add-social-media">Add Social Media</button>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const socialMediaContainer = document.getElementById('social-media-container');
        const addSocialMediaBtn = document.getElementById('add-social-media');

        // Function to create a new row for social media inputs
        function addSocialMediaRow() {
            const index = socialMediaContainer.children.length;

            // Create a new row for social media key-value input
            const row = document.createElement('div');
            row.classList.add('d-flex', 'gap-2', 'mb-2');

            // Social Media Key Input
            const keyInput = document.createElement('input');
            keyInput.type = 'text';
            keyInput.name = `social_media[${index}][key]`;
            keyInput.classList.add('form-control');
            keyInput.placeholder = 'Enter label (e.g., Facebook, Phone, Email)';

            // Social Media Value Input
            const valueInput = document.createElement('input');
            valueInput.type = 'text';
            valueInput.name = `social_media[${index}][value]`;
            valueInput.classList.add('form-control');
            valueInput.placeholder = 'Enter the URL or contact (e.g., https://facebook.com/yourpage)';

            // Remove Button
            const removeButton = document.createElement('button');
            removeButton.type = 'button';
            removeButton.textContent = 'Remove';
            removeButton.classList.add('btn', 'btn-danger', 'btn-sm');
            removeButton.addEventListener('click', function() {
                row.remove(); // Remove this row
            });

            // Append inputs and button to the row
            row.appendChild(keyInput);
            row.appendChild(valueInput);
            row.appendChild(removeButton);

            // Add the row to the container
            socialMediaContainer.appendChild(row);
        }

        // Attach the addSocialMediaRow function to the 'Add Social Media' button
        addSocialMediaBtn.addEventListener('click', addSocialMediaRow);
    });
</script>
