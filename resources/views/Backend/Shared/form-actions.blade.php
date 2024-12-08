<style>
    .toggle-container {
        display: flex;
        align-items: center;
        gap: 10px;
        /* Space between toggle and text */
        font-family: Arial, sans-serif;
    }

    /* Base styling for the toggle switch */
    .toggle-switch {
        position: relative;
        width: 60px;
        height: 30px;
    }

    /* Hide the checkbox */
    .toggle-input {
        display: none;
    }

    /* The toggle background */
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

    /* The sliding indicator */
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

    /* Change background when checked */
    .toggle-input:checked+.toggle-label {
        background: #4caf50;
        /* Green color for "Enabled" */
    }

    /* Slide the indicator when checked */
    .toggle-input:checked+.toggle-label .toggle-indicator {
        transform: translateX(30px);
    }

    /* Optional: Status text */
    .toggle-status {
        font-size: 16px;
        font-weight: bold;
        color: #333;
        transition: color 0.3s ease;
    }

    /* Change text color dynamically for visual cue */
    .toggle-input:checked~.toggle-status {
        color: #4caf50;
    }
</style>
<div class="form-actions d-flex justify-content-between align-items-center">
    <input class="btn btn-success" name="translation" value="Save Translation" type="submit" />
    <div class="toggle-container">
        <div class="toggle-switch">
            <input type="checkbox" name="status" id="toggle" class="toggle-input"
                {{ $settings['status'] === 'on' ? 'checked' : '' }} />
            <!-- The checkbox state is dynamically set based on current status -->
            <label for="toggle" class="toggle-label">
                <span class="toggle-indicator"></span>
            </label>
        </div>
        <span id="toggle-status" name="status" class="toggle-status text-light">
            {{ $settings['status'] === 'on' ? 'Show' : 'Hidden' }}
        </span>
    </div>
</div>
