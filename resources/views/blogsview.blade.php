<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</head>

<body>
    @extends('layout/master')
    @section('content')
        <section>
            <div class="container mx-6 mx-sm-none">
                <div class="card mb-3" style="width: 100%;">

                    <div class="card-header d-flex" style="width: 100%;">
                        <i class="fa-solid fa-blog my-1"></i>&nbsp;Blogs
                        <div class="ms-auto">
                            <button type="button" id="new_blog" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                data-bs-target="#form_modal">
                                <i class="fa-solid fa-pen-fancy"></i> Write your Blog
                            </button>

                        </div>

                    </div>
                    <div class="card-body">

                        <div class="row">
                            <div class="col-lg-9 col-md-6 col-sm-12">


                                <div class="row justify-content-start load-blogs">
                                    @foreach ($blogs as $blog)
                                        <div class="col-lg-6 col-md-12 blog-container my-3 ">
                                            <div class="card">
                                                <div class="card-body blog" data-id="{{ $blog->blog_id }}">
                                                    <div class="row justify-content-between">
                                                        <div class="col-md-9 col-9">
                                                            <a href="{{ route('blog.show-content', ['id' => $blog->blog_id]) }}"
                                                                target="blank" class="blog-title">
                                                                <h3 class="card-title">{!! $blog->title !!}</h3>
                                                            </a>
                                                        </div>
                                                        @can('canUpdate', $blog->blog_id)
                                                            <div class="col-md-3 col-3 text-md-end">
                                                                <a href="" class="update-btn text-dark"><i
                                                                        class="fa-solid fa-edit"></i></a>
                                                                <a href="" class="delete-btn text-danger"><i
                                                                        class="fa-solid fa-trash"></i></a>
                                                            </div>
                                                        @endcan



                                                    </div>

                                                    <div class="card-subtitle mb-2 d-flex align-items-end">
                                                        <h5 class="text-muted">{{ $blog->name }}</h5>
                                                        <span class="mx-1">&bullet;</span>
                                                        <h6 class="readable-date">{{ $blog->readable }}</h6>
                                                    </div>

                                                    <img src="{{ asset('storage/images/blogs/' . $blog->photo) }}"
                                                        alt="" class="img-fluid blog-image my-1 p-2">
                                                    <div class="card-text blog-content">{!! $blog->content !!}</div>
                                                    <button class="btn btn-primary more-btn">Read more</button>
                                                    <div class="row justify-content-between mt-2 blog-action">
                                                        <div class="col-md-8 col-8 text-muted status">
                                                            {{ $blog->views . ' views' }}<span
                                                                class="mx-1">&bullet;</span>{{ $blog->likes . ' likes' }}
                                                        </div>
                                                        <div class="col-md-4 col-4 text-md-end blog-btns">
                                                            @can('isLiked', $blog->blog_id)
                                                                <a href="" class="like-btn"><i
                                                                        class="fa-solid fa-heart heart"></i></a>
                                                            @else
                                                                <a href="" class="like-btn"><i
                                                                        class="fa-regular fa-heart heart"></i></a>
                                                            @endcan
                                                            <a href="{{ route('blog.show-content', ['id' => $blog->blog_id]) }}"
                                                                target="blank" class="comment-btn"><i
                                                                    class="fa-regular fa-comment"></i></a>

                                                            <i class="fa-regular fa-share-from-square"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach


                                </div>
                                <button class="btn btn-outline-primary load-btn d-block mx-auto p-2">Load More...</button>
                            </div>




                            <div class="col-lg-3 col-md-6 d-none d-md-block mt-3">



                                <div class="card" style="width: 100%;height:100%">

                                    <div class="card-header" style="width: 100%;">
                                        <i class="fa-solid fa-blog"></i>&nbsp;Bloggers

                                    </div>
                                    <div class="card-body">
                                        <div class="row" width="90%">

                                            <div class="col m-2">

                                            </div>

                                        </div>




                                    </div>
                                </div>

                            </div>
                        </div>



                    </div>


                </div>
                <div class="modal fade" id="form_modal" tabindex="-1" role="dialog" aria-modal="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modal_title">New Blog</h5>
                                <button class="btn btn-outline-danger close" data-bs-dismiss="modal">
                                    <span>&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="" method="POST" id="post_form">

                                    @csrf
                                    <div class="form-group">
                                        <label>Title <i class="text-danger">*</i></label>
                                        <input type="text" id="title_post" name="title" class="form-control"
                                            maxlength="100" autocomplete="off" placeholder="Blog Title">
                                        <div id="title_error_message" class="text-danger"></div>
                                        @error('title')
                                            <div id="title_error_message" class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="edit-image">
                                        <label>Add/Edit Image</label>
                                        <br>
                                        <img class="blog-image img-fluid d-none" id="blogImage" src=""
                                            alt="Blog Image" />
                                        <input type="file" id="fileInput" name="photo" style="display:none;"
                                            accept=".jpg, .jpeg, .png">
                                        <br>
                                        <button type="button" id="chooseFileButton">Choose File</button>

                                    </div>
                                    <div class="form-group">
                                        <label>Content <i class="text-danger">*</i></label>
                                        <textarea id="content_post" name="content" class="form-control" style="height:30vh !important; resize:none;"
                                            autocomplete="off" placeholder="Your content goes here" rows=20></textarea>
                                        <div id="content_error_message" class="text-danger"></div>
                                        @error('content')
                                            <div id="content_error_message" class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="d-flex justify-content-end">
                                        <input type="button" value="Cancel" class="btn btn-light my-3"
                                            data-bs-dismiss="modal">
                                        <input type="submit" value="Post" class="btn btn-primary my-3">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="update_modal" role="dialog">
                    <div class="modal-dialog modal-dialog-centered modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modal_title">Update Blog</h5>
                                <button class="btn btn-outline-danger close" data-bs-dismiss="modal">
                                    <span>&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="" method="POST" id="update_form" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group d-none">
                                        <input type="hidden" id="update-id" name="blog_id">
                                    </div>
                                    <div class="form-group">
                                        <label>Title <i class="text-danger">*</i></label>
                                        <input type="text" id="title_update" name="title" class="form-control"
                                            maxlength="100" autocomplete="off" placeholder="Blog Title">
                                        <div id="title_error_message" class="text-danger"></div>
                                        @error('title')
                                            <div id="title_error_message" class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="edit-image">
                                        <label>Add/Edit Image</label>
                                        <br>
                                        <img class="blog-image img-fluid d-none" id="blogImageUpdate" src=""
                                            alt="Blog Image" />
                                        <input type="hidden" id="imageURL" name="photoCopy">
                                        <input type="file" id="fileUpdate" name="photo" style="display:none;"
                                            accept=".jpg, .jpeg, .png">
                                        <br>
                                        <button type="button" id="updateFileButton">Choose File</button>

                                    </div>
                                    <div class="form-group">
                                        <label>Content <i class="text-danger">*</i></label>
                                        <textarea id="content_update" name="content" class="form-control" style="height:30vh !important; resize:none;"
                                            autocomplete="off" placeholder="Your content goes here" rows=20></textarea>
                                        <div id="content_error_message" class="text-danger"></div>
                                        @error('content')
                                            <div id="content_error_message" class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="d-flex justify-content-end">
                                        <input type="button" value="Cancel" class="btn btn-light my-3"
                                            data-bs-dismiss="modal">
                                        <input type="submit" value="Update" class="btn btn-primary my-3">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="delete_modal" role="dialog">
                    <div class="modal-dialog modal-dialog-centered modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modal_title">Delete Blog?</h5>
                                <button class="btn btn-outline-danger close" data-bs-dismiss="modal">
                                    <span>&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <h4>Are you sure you want to delete this blog?</h4>
                                <form action="" method="POST" id="delete_form">
                                    @csrf
                                    <div class="form-group d-none">
                                        <input type="hidden" id="delete-id" name="blog_id">
                                    </div>
                                    <div class="d-flex justify-content-end">
                                        <input type="button" value="Cancel" class="btn btn-light my-3"
                                            data-bs-dismiss="modal">
                                        <input type="submit" value="Delete" class="btn btn-danger my-3">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endsection

    <script>
        // jQuery(document).ready(function ($) {
        $(document).ready(function() {


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

            $('#updateFileButton').click(function() {
                $('#fileUpdate').click();
            });

            $('#fileUpdate').change(function() {
                var fileInput = this;
                var blogImage = $('#blogImageUpdate');

                if (fileInput.files.length > 0) {
                    var selectedFile = fileInput.files[0];

                    var objectURL = URL.createObjectURL(selectedFile);

                    $('#imageURL').val(objectURL);

                    blogImage.attr('src', objectURL).removeClass('d-none').addClass('d-block');
                }
            });

            $('body').on('click', '.more-btn', function() {
                console.log('hey');
                var blogContent = $(this).prev('.blog-content');
                blogContent.toggleClass("expanded");
                var status = $(this).next('.blog-action').children('.status');


                var id = $(this).closest('.blog').data(id);


                if (blogContent.hasClass('expanded')) {
                    $(this).html('See less');
                    $.ajax({
                        url: "{{ route('blog.view') }}",
                        type: "POST",
                        data: {
                            id,
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(data) {


                            var interaction = data.interaction;

                            var views = interaction.views;
                            var likes = interaction.likes;
                            status.html(views + ' views.' + likes + ' likes');


                        },
                        error: function(xhr, status, error) {
                            console.log('Error:', xhr.responseText);
                        }


                    });

                } else {
                    $(this).html('Read more');
                }

            });


            $('body').on('click', '.like-btn', function(event) {
                event.preventDefault();
                var likeIcon = $(this).children('i');


                var status = $(this).parent().prev('.status');
                var id = $(this).closest('.blog').data(id).id;

                $.ajax({
                    url: "{{ route('blog.like') }}",
                    type: "POST",
                    data: {
                        id,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(data) {

                        var interaction = data.interaction;
                        if (data.liked) {
                            likeIcon.removeClass('fa-regular').addClass('fa-solid');
                        } else {
                            likeIcon.removeClass('fa-solid').addClass('fa-regular');
                        }
                        var contentHtml = `
                                    ${interaction.views} views<span class="mx-1">&bullet;</span>${interaction.likes} likes
                                `;
                        status.html(contentHtml);
                    },
                    error: function(xhr, status, error) {
                        console.log('Error:', xhr.responseText);
                    }
                });
            });

            $('body').on('click', '.update-btn', function(event) {
                event.preventDefault();
                var id = $(this).closest('.blog').data(id).id;
                var container = $(this).closest('blog-container');
                var blogImage = $('#blogImageUpdate');
                $.ajax({
                    url: "{{ route('blog.find') }}",
                    type: "POST",
                    data: {
                        id,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(data) {
                        $('#update_form')[0].reset();
                        $('#update-id').val(id);
                        var blog = data.blog;
                        var imageURL = "{{ asset('storage/images/blogs/:photo') }}".replace(
                            ':photo', blog.photo);
                        $('#title_update').val(blog.title);
                        $('#imageURL').val(blog.photo);
                        blogImage.attr('src', imageURL).removeClass('d-none').addClass(
                            'd-block');
                        $('#content_update').val(blog.content);
                    },
                    error: function(xhr, status, error) {
                        console.log('Error:', xhr.responseText);
                    }
                });


                $('#update_modal').modal('show');

            });

            $('body').on('click', '.delete-btn', function(event) {
                event.preventDefault();
                $('#delete_form')[0].reset();
                var id = $(this).closest('.blog').data(id).id;
                var container = $(this).closest('blog-container');
                $('#delete-id').val(id);
                $('#delete_modal').modal('show');

            });

            $('#new_blog').click(function(event) {
                event.preventDefault();
                $('#post_form')[0].reset();
                var blogImage = $('#blogImage');
                blogImage.attr('src', null).removeClass('d-block').addClass('d-none');
                $('#form_modal').modal('show');

            });

            $('#update_form').submit(function(event) {
                event.preventDefault();
                var form = this;
                var formData = new FormData(this);
                formData.append('_token', '{{ csrf_token() }}');

                $.ajax({
                    url: "{{ route('blog.update') }}",
                    type: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(data) {




                        var blog = data.editBlog;

                        var edittedElement = $('[data-id="' + blog.blog_id + '"]');
                        if (edittedElement.length > 0) {
                            $('#update_modal').modal('hide');


                            var imageURL = "{{ asset('storage/images/blogs/:photo') }}"
                                .replace(':photo', blog.photo);
                            var titleHtml = `<h4 class="card-title">${blog.title}</h4>`;
                            edittedElement.find('.blog-title').html(titleHtml);
                            edittedElement.find('.readable-date').html(blog.readable);
                            edittedElement.find('.blog-image').attr('src', imageURL);
                            edittedElement.find('.blog-content').html(blog.content);


                        }
                    },
                    error: function(xhr, status, error) {
                        console.log('Error:', xhr.responseText);
                    }
                });
            });

            $('#delete_form').submit(function(event) {
                event.preventDefault();

                var form = this;
                var formData = new FormData(this);
                formData.append('_token', '{{ csrf_token() }}');


                $.ajax({
                    url: "{{ route('blog.delete') }}",
                    type: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(data) {
                        var id = data.id;
                        var deletedElement = $('[data-id="' + id + '"]');
                        if (deletedElement.length > 0) {


                            deletedElement.closest('.blog-container').removeClass('d-block')
                                .addClass('d-none');
                            $('#delete_modal').modal('hide');
                        }

                    },
                    error: function(xhr, status, error) {
                        console.log('Error:', xhr.responseText);
                    }
                });
            });

            $('#post_form').submit(function(event) {
                event.preventDefault();
                var form = this;
                var formData = new FormData(this);
                formData.append('_token', '{{ csrf_token() }}');
                var blogImage = $('#blogImage');


                $.ajax({
                    url: "{{ route('blog.post') }}",
                    type: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,

                    success: function(data) {

                        blogImage.attr('src', null).removeClass('d-block').addClass('d-none');
                        form.reset();
                        $('#form_modal').modal('hide');

                        var blog = data.newBlog;
                        var blogRoute = "{{ route('blog.show-content', ['id' => ':blogId']) }}"
                            .replace(':blogId', blog.blog_id);
                        var image = '{{ asset('storage/images/blogs') }}' + '/' + blog.photo;


                        var contentHtml = `
                                <div class="col-lg-6 blog-container col-md-12 my-3">
                                    <div class="card">
                                        <div class="card-body blog" data-id="${blog.blog_id}">
                                            <div class="row justify-content-between action-header-${blog.blog_id}">
                                                <div class="col-md-9 col-9">
                                                    <a href="${blogRoute}" target="blank" class="blog-title">
                                                        <h4 class="card-title">${blog.title}  </h4>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="card-subtitle mb-2 d-flex align-items-end">
                                                <h5 class="text-muted">${blog.name}</h5>
                                                <span class="mx-1">&bullet;</span>
                                                <h6 class="readable-date">${blog.readable}</h6>
                                            </div>
                                            <img src="${image}" alt="" class="img-fluid blog-image my-1 p-2">
                                            <div class="card-text blog-content">${blog.content}</div>
                                            <button class="btn btn-primary more-btn">Read more</button>
                                            <div class="row justify-content-between mt-2 blog-action">
                                                <div class="col-md-8 col-8 text-muted status">
                                                    ${blog.views + ' views'}<span class="mx-1">&bullet;</span>${blog.likes + ' likes'}
                                                </div>
                                                <div class="col-md-4 col-4 text-md-end blog-btns-${blog.blog_id}">
                                                    <a href="" class="like-btn"><i class="fa-regular fa-heart heart"></i></a>
                                                    <a href="${blogRoute}" target="blank" class="comment-btn"><i class="fa-regular fa-comment"></i></a>
                                                    <i class="fa-regular fa-share-from-square"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                `;
                        $('.load-blogs').prepend(contentHtml);


                        $.ajax({
                            url: "{{ route('blogs.ajax-canUpdate') }}",
                            type: "POST",
                            data: {
                                'id': blog.blog_id,
                                _token: '{{ csrf_token() }}'
                            },
                            success: function(data) {

                                if (data.result) {

                                    actionHtml = `
                                            <div class="col-md-3 col-3 text-md-end">
                                                <a href="" class="update-btn text-dark"><i class="fa-solid fa-edit"></i></a>
                                                <a href="" class="delete-btn text-danger"><i class="fa-solid fa-trash"></i></a>
                                            </div>
                                            `;
                                    $(".action-header-" + blog.blog_id).append(
                                        actionHtml);
                                }
                            },
                            error: function(xhr, status, error) {
                                console.log('Error:', xhr.responseText);
                            }
                        });




                    },
                    error: function(xhr, status, error) {


                        console.log('Error:', xhr.responseText);

                    }


                });
            });

            var current = {{ $blogs->currentPage() }};
            var last = {{ $blogs->lastPage() }};

            $('.load-btn').click(function(events) {
                if (current < last) {


                    $.ajax({
                        url: "{{ route('blogs.more') }}",
                        type: "POST",
                        data: {
                            page: ++current,
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(data) {
                            var actionHtml = '';
                            var likeHtml = '';


                            var blogs = data.blogs.data;
                            last = data.blogs.last_page;
                            blogs.forEach(function(blog) {


                                var blogRoute =
                                    "{{ route('blog.show-content', ['id' => ':blogId']) }}"
                                    .replace(':blogId', blog.blog_id);
                                var image = '{{ asset('storage/images/blogs') }}' +
                                    '/' + blog.photo;
                                var duplicateElement = $('[data-id="' + blog.blog_id +
                                    '"].blog');
                                if (duplicateElement.length <= 0) {
                                    var contentHtml = `
                                    <div class="col-lg-6 col-md-12 my-3">
                                        <div class="card">
                                            <div class="card-body blog" data-id="${blog.blog_id}">
                                                <div class="row justify-content-between action-header-${blog.blog_id}">
                                                    <div class="col-md-9 col-9">
                                                        <a href="${blogRoute}" target="blank" class="blog-title">
                                                            <h4 class="card-title">${blog.title}  </h4>
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="card-subtitle mb-2 d-flex align-items-end">
                                                    <h5 class="text-muted">${blog.name}</h5>
                                                    <span class="mx-1">&bullet;</span>
                                                    <h6 class="readable-date">${blog.readable}</h6>
                                                </div>
                                                <img src="${image}" alt="" class="img-fluid blog-image my-1 p-2">
                                                <div class="card-text blog-content">${blog.content}</div>
                                                <button class="btn btn-primary more-btn">Read more</button>
                                                <div class="row justify-content-between mt-2 blog-action">
                                                    <div class="col-md-8 col-8 text-muted status">
                                                        ${blog.views + ' views'}<span class="mx-1">&bullet;</span>${blog.likes + ' likes'}
                                                    </div>
                                                    <div class="col-md-4 col-4 text-md-end blog-btns-${blog.blog_id}">
                                                        <a href="" class="like-btn"><i class="fa-regular fa-heart heart"></i></a>
                                                        <a href="${blogRoute}" target="blank" class="comment-btn"><i class="fa-regular fa-comment"></i></a>
                                                        <i class="fa-regular fa-share-from-square"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    `;
                                    $('.load-blogs').append(contentHtml);


                                    $.ajax({
                                        url: "{{ route('blogs.ajax-canUpdate') }}",
                                        type: "POST",
                                        data: {
                                            'id': blog.blog_id,
                                            _token: '{{ csrf_token() }}'
                                        },
                                        success: function(data) {

                                            if (data.result) {

                                                actionHtml = `
                                                <div class="col-md-3 col-3 text-md-end">
                                                    <a href="" class="update-btn text-dark"><i class="fa-solid fa-edit"></i></a>
                                                    <a href="" class="delete-btn text-danger"><i class="fa-solid fa-trash"></i></a>
                                                </div>
                                                `;
                                                $(".action-header-" + blog
                                                    .blog_id).append(
                                                    actionHtml);
                                            }
                                        },
                                        error: function(xhr, status, error) {
                                            console.log('Error:', xhr
                                                .responseText);
                                        }
                                    });

                                    $.ajax({
                                        url: "{{ route('blogs.ajax-hasLiked') }}",
                                        type: "POST",
                                        data: {
                                            'id': blog.blog_id,
                                            _token: '{{ csrf_token() }}'
                                        },
                                        success: function(data) {

                                            if (data.result) {
                                                $(".blog-btns-" + blog
                                                        .blog_id).children(
                                                        '.like-btn')
                                                    .children('i')
                                                    .removeClass(
                                                        'fa-regular')
                                                    .addClass('fa-solid');
                                            }


                                        },
                                        error: function(xhr, status, error) {
                                            console.log('Error:', xhr
                                                .responseText);
                                        }
                                    });
                                }

                            });

                        },
                        error: function(xhr, status, error) {


                            console.log('Error:', xhr.responseText);

                        }


                    });
                }
            });

        });
    </script>


</body>

</html>
