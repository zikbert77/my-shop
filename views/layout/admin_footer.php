<script src="https://code.jquery.com/jquery-2.2.0.min.js" type="text/javascript"></script>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="/template/js/bootstrap.js"></script>

<?php if($page=='edit' || $page == 'add_product'): ?>
    <script>
        $(document).ready(function (){
            $("select[name='p_category']").bind("change", function(){
                var params = {
                    parent: $("select[name='p_category']").val(),
                    p_id: $("select[name='p_id']").val()
                }
                $.get("/admin/ajaxCategory/", params, function(data){
                    $("select[name='p_type']").empty();
                    data = JSON.parse(data);
                    $("select[name='p_type']").append($("<option selected disabled>Виберіть категорію</option>"));
                    for(var i = 0; i < data.length; i++){
                        $("select[name='p_type']").append($("<option value='"+ data[i]["cat_id"] +"'>"+ data[i]["cat_name"] +"</option>"));
                    }
                });
            });

        });
    </script>

<script type="text/javascript">
    function handleFileSelect(evt) {
        var files = evt.target.files; // FileList object

        // Loop through the FileList and render image files as thumbnails.
        for (var i = 0, f; f = files[i]; i++) {

            // Only process image files.
            if (!f.type.match('image.*')) {
                continue;
            }

            var reader = new FileReader();

            // Closure to capture the file information.
            reader.onload = (function(theFile) {
                return function(e) {
                    // Render thumbnail.
                    var span = document.createElement('span');
                    span.innerHTML = ['<img class="thumb" src="', e.target.result,
                        '" title="', theFile.name, '"/>'].join('');
                    document.getElementById('list').insertBefore(span, null);
                };
            })(f);

            // Read in the image file as a data URL.
            reader.readAsDataURL(f);
        }
    }

    document.getElementById('p_img').addEventListener('change', handleFileSelect, false);
</script>
<?php endif; ?>
</body>
</html>