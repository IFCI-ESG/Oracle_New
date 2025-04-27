<script>
    $(document).ready(function () {
        $('.prevent-multiple-submit').on('submit', function() {
			const btn = document.getElementById("submit");
			btn.disabled = true;
            setTimeout(function(){btn.disabled = false;}, (1000*10));
        });
    });
</script>

{{--
    .prevent-multiple-submit class add in <form> tag & #submit id add in save button
--}}
