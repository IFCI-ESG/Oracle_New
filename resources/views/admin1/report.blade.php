<div id="reportContainer"></div>



<script src="https://cdnjs.cloudflare.com/ajax/libs/powerbi-client/2.22.2/powerbi.js"> </script>
<script>
	// Replace {embedUrl} and {accessToken} with the appropriate values for your report
	models = window['powerbi-client'].models;

	// Get a reference to the report container
	var reportContainer = document.getElementById('reportContainer');
	var permissions = models.Permissions.All;
	// Embed the report
	var report = powerbi.embed(reportContainer, {
		type: 'dashboard',
		accessToken: '{{ $embed_token }}',
		embedUrl: '{{ $embed_url }}',
		permissions: permissions,
		tokenType: models.TokenType.Embed,
		settings: {
			filterPaneEnabled: false,
			navContentPaneEnabled: true
		}
	});

</script>
