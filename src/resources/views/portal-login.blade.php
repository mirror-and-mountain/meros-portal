<div class="p-5">
    {!! $formHtml !!}
</div>
@script
    <script>
        (() => {
            $wire.$el.addEventListener('mforms::merosPortalLogin', function(event) {
                const {form, formData} = event.detail;
                if (formData.username && formData.password) {
                    form.isSubmitting = true;
                    $wire.login(formData.username, formData.password)
                        .then(success => {
                            if (!success) form.showError('The username or password is incorrect.');
                        })
                        .catch(error => {
                            console.error(error);
                            form.showError('Unable to log in. Please try again.');
                        })
                        .finally(() => {
                            form.isSubmitting = false;
                        });
                } else {
                    form.showError('Please enter both username and password.');
                }
            });
        })();
    </script>
@endscript