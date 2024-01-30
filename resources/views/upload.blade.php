<!-- resources/views/image/index.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Image Gallery</title>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</head>
<body>

    <h1>Image Gallery Automated Pros</h1>

 
    <form id="imageUploadForm" enctype="multipart/form-data">
        @csrf
        <input type="file" name="image" accept="image/*" required>
        <button type="submit">Upload Image</button>
    </form>

   
    <div id="imageContainer">
        @foreach($images as $image)
            <img src="{{ $image->path }}" alt="{{ $image->name }}" width="150">
        @endforeach
    </div>


    <script>
        $(document).ready(function() {
           
            $('#imageUploadForm').submit(function(e) {
                e.preventDefault();

                $.ajax({
                    url: '/post/images',
                    type: 'POST',
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function(response) {
                        
                        $('#imageContainer').append('<img src="' + response.image.path + '" alt="' + response.image.name + '" width="150">');
                     
                        $('#imageUploadForm')[0].reset();
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
            });
        });
    </script>

</body>
</html>
