<div class="form-actions">
    <input class="btn btn-success" type="submit" />
    <div class="toggle-container">
        <div class="toggle-switch">
            <input type="checkbox" name="status" id="toggle" class="toggle-input"
                {{ json_decode($settings->value, true)['status'] === 'on' ? 'checked' : '' }} />
            <!-- The checkbox state is dynamically set based on current status -->
            <label for="toggle" class="toggle-label">
                <span class="toggle-indicator"></span>
            </label>
        </div>
        <span id="toggle-status" name="status" class="toggle-status text-light">
            {{ json_decode($settings->value, true)['status'] === 'on' ? 'Show' : 'Hidden' }}
        </span>
    </div>
</div>
