<script>
    Filament.forms['your-form-name'].addEventListener('change', function (event) {
    // Check if the change event is for the media_types field
    if (event.detail.name === 'media_types') {
        // Get the selected value
        var selectedValue = event.detail.value;

        // Get the media field
        var mediaField = Filament.forms['your-form-name'].getField('media');

        // Enable or disable the media field based on the selected media type
        if (selectedValue === 'image' || selectedValue === 'video') {
            mediaField.enable();
        } else {
            mediaField.disable();
        }
    }
});
</script>