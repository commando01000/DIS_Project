<div class="toggle-container justify-content-end">
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
