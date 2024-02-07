<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.tiny.cloud/1/4briqa25g9oadjn92w4pf4e553tnxjoz3vssb2plryk8owbz/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>

    <style>
        .tox-tinymce {
            width: 100%;
            height:70vh !important;
            resize: none;

        }
    </style>
</head>
<body>
    @extends('../layout/master')
    @section('content')
        <section>
            <div class="container-fluid">
                <form action="" method="POST" id="post_form">
                    
                    @csrf
                    <div class="form-group">
                        <label>Title <i class="text-danger">*</i></label>
                        <input type="text" id="title_post" name="title" class="form-control" maxlength="100" autocomplete="off" placeholder="Blog Title">
                        <div id="title_error_message" class="text-danger"></div>
                        @error('title')
                        <div id="title_error_message" class="text-danger">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="edit-image">
                        <label>Add/Edit Image</label>
                        <br>
                        <img class="blog-image img-fluid d-none" id="blogImage" src="" alt="Blog Image" />
                        <input type="file" id="fileInput" name="photo" style="display:none;" accept=".jpg, .jpeg, .png">
                        <br>
                        <button type="button" id="chooseFileButton">Choose File</button>
                        
                    </div>
                    <div class="form-group">
                        <label>Content <i class="text-danger">*</i></label>
                        <textarea id="content_post" class="form-control" style="height:30vh !important; resize:none;" autocomplete="off" placeholder="Your content goes here" rows=20></textarea>
                        <div id="content_error_message" class="text-danger"></div> 
                        @error('content')
                        <div id="content_error_message" class="text-danger">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="d-flex justify-content-end">
                        <input type="button" value="Cancel" class="btn btn-light my-3"  data-bs-dismiss="modal">
                        <input type="submit" value="Post" class="btn btn-primary my-3">
                    </div>
                </form>
            </div>
        </section>
        
    @endsection

    <script>
        $(document).ready(function() {

            tinymce.init({
                selector: '#content_post',
                width:'100%',
                height:'60%',
                resize: "both",
                plugins: [
                
                ],
                content_style:`html{
                                    height:100%;
                                    margin:0;
                                    padding:10px 12px;
                                }
                                body{
                                    margin:0;
                                    padding:0;
                                    height:94%;
                                }
                                p{
                                    margin:0;
                                }
                
                                a{
                                    color:blue;
                                    text-decoration:none;
                                }`,

                menubar:false,
                toolbar: true,
                statusbar:false,
                tinycomments_mode: 'embedded',
                tinycomments_author: 'Author name',
                mergetags_list: [
                { value: 'Swatik', title: 'First Name' },
                { value: 'scsswash36@gmail.com', title: 'Email' },
                ],
                setup: function (editor) {
                    // Add input event listener to the editor
                    editor.on('keydown', function (e) {
                        
                        
                    });
                }
            });
            
            $('#chooseFileButton').click(function() {
                $('#fileInput').click();
            });

            $('#fileInput').change(function() {
                var fileInput = this;
                var blogImage = $('#blogImage');

                if (fileInput.files.length > 0) {
                    var selectedFile = fileInput.files[0];

                    var objectURL = URL.createObjectURL(selectedFile);

                    blogImage.attr('src', objectURL).removeClass('d-none').addClass('d-block');
                }
            });

            $('#post_form').submit(function(){
                event.preventDefault();
                var content=tinymce.get('content_post').getContent();
                var form=this;
                var formData=new FormData(this);
                console.log(formData);
                formData.append('content', content);
                formData.append('_token', '{{ csrf_token() }}');
                
                var blogImage = $('#blogImage');
                $.ajax({
                    url: "{{route('blog.post')}}",
                    type:"POST",
                    data:formData,
                    processData: false,
                    contentType: false, 

                    success: function(data){
                        
                        blogImage.attr('src', null).removeClass('d-block').addClass('d-none');
                        form.reset();
                        
                    },
                    error: function (xhr, status, error) {
                    
                        
                        console.log('Error:', xhr.responseText);
                    
                    }
                    

                });
            });
        });
    </script>
</body>
</html>