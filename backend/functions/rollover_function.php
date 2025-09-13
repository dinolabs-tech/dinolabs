<script>
$(document).ready(function(){
    $(".rollover-button").click(function(){
        var client_id = $(this).data("client-id");
        $.ajax({
            url: "process_rollover.php",
            type: "POST",
            data: {client_id: client_id},
            success: function(response){
                alert(response);
                location.reload();
            }
        });
    });
});
</script>