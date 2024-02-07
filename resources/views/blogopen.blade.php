<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <style>
        .tox-tinymce {
            width: 100%;
            height:70px !important;
            resize: none;
            background-color: rgba(230,233,235, 0.8) !important;
            border: 3px solid #eee !important;
            border-radius: 9px;
            box-sizing: border-box !important;

        }
    </style>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <link href="https://cdn.quilljs.com/1.3.6/quill.core.css" rel="stylesheet">
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>

    <script src="https://cdn.tiny.cloud/1/4briqa25g9oadjn92w4pf4e553tnxjoz3vssb2plryk8owbz/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    

</head>
<body>
    
        <section>   
            <div class="container mt-2">
                <div class="row">
                    <div class="col-md-9 post-content">
            
                        
                        <div class="single-post">
                        
                        <h1 class="mb-4">{!!$blog->title!!}</h1>
                        <div class="post-meta d-flex align-items-end mb-2">
                            <h5 class="text-muted">{{$blog->name}}</h5>
                            <span class="mx-1">&bullet;</span>
                            <h6 class="readable-date">{{$blog->readable}}</h6>
                        </div>
                        
                        <img src="{{asset('storage/images/blogs/'.$blog->photo)}}" alt="" class="img-fluid my-1 p-2">
                        
                        <p>{!! $blog->content !!}</p>
                        </div>
                        
                        <div class="row justify-content-between mt-2 blog-action">
                            <div class="col-md-8 col-8 text-muted status">
                                {{$blog->views.' views'}}<span class="mx-1">&bullet;</span>{{$blog->likes.' likes'}}
                            </div>  
                            <div class="col-md-4 col-4 text-md-end blog-btns">
                                @can('isLiked',$blog->blog_id)
                                    <a href="" class="like-btn"><i class="fa-solid fa-heart heart"></i></a>
                                @else
                                    <a href="" class="like-btn"><i class="fa-regular fa-heart heart"></i></a>
                                @endcan
                                <a href="" class="comment-btn"><i class="fa-regular fa-comment"></i></a>
                                
                                <i class="fa-regular fa-share-from-square"></i>
                            </div>
                            <div class="comments">
                                @foreach ($comments as $comment)
                                
                                <div class="comment-block ms-2 ms-sm-3 mb-3" data-id="{{$comment->id}}">
                                    <div class="comment px-3 py-1" data-id="{{$comment->id}}">
                                        <div class="flex-shrink-1">
                                            <div class="comment-meta d-flex align-items-end">
                                                <h5 class="">{{$comment->name}}</h5>
                                                <span class="mx-1 text-muted">&bullet;</span>
                                                <h6 class="readable-date text-muted">{{$comment->readable}}</h6>
                                                
                                            </div>
                                            <div class="comment-body">
                                                {{$comment->comment}}
                                            </div>
                                            
                                        </div>
                                        
                                    </div>
                                    <div class="comment-actions ms-2 my-2">
                                        <a href="" class="reply-btn">Reply</a>
                                        <form action="" id="form-reply-{{$comment->id}}" class="form_reply d-none ms-3">
                                            <textarea class="form-control reply-box" id="reply-box-{{$comment->id}}"  cols="10" rows="2"></textarea>
                                        </form>
                                    </div>
                                    
                                    
                                    @if ($comment->replies>0)
                                        <a href="" class="btn btn-outline-primary rounded-pill view-replies ms-3 mb-3">{{$comment->replies==1? $comment->replies.' reply':$comment->replies.' replies' }}</a>
                                    @endif
                                    <div class="replies-block ms-2 d-none">
                                        
                                    </div>
                                    
                                    <a href="" class="more-replies d-none ms-4 mb-4">Load more replies</a>
                                    
                                    
                                </div>
                                
                                @endforeach
                            </div>

                            @if ($checkMore)
                                <div class="row justify-content-center ms-2 mb-1 w-100 ">
                                    <a href="" class="more-comments">Load more comments</a>
                                </div>
                            @endif
                            

                            
                            <div class="row justify-content-center mt-2 w-100 ">
                                <div class="col-12 mb-3">
                                    
                                    <form action="" class="form_comment">
                                        <textarea class="form-control comment-box" placeholder="Enter your Comment" cols="10" rows="2"></textarea>
                                    </form>
                                            
                                        
                                </div>
                            </div>
                        </div>

                        
                        
                    </div>
                </div>
            </div>
        </section>

    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    
    <script>

        $(document).ready(function() {


            tinymce.init({
                selector: '.reply-box',
                width:'100%',
                height:'20px',
                resize: "both",
                plugins: [
                
                ],
                content_style:`html{
                                    height:64px;
                                    margin:0;
                                    padding:0;
                                }
                                body{
                                    margin:0;
                                    padding:10px 12px;
                                    height:43px;
                                    background-color: rgba(230,233,235, 0.8) !important;
                                }
                                p{
                                    margin:0;
                                }
                
                                a{
                                    color:blue;
                                    text-decoration:none;
                                }`,

                menubar:false,
                toolbar: false,
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
                        
                        if (e.keyCode === 13 && !e.shiftKey) {
                            e.preventDefault();
                            var form=$(editor.getElement()).closest('.form_reply');
                            form.submit();
                        }else if ((e.keyCode >= 33 && e.keyCode <= 40) || e.ctrlKey || e.altKey) {
                            return;
                        }
                        else{
                            setTimeout(function () {
                                var selection = editor.selection.getContent();
                                var anchorTag = editor.dom.getParent(editor.selection.getNode(), 'a');

                                if (anchorTag) {
                                    var wholeTag = anchorTag.outerHTML;
                                    var contentInside = anchorTag.innerText.replace('@','');
                                    console.log(contentInside);
                                    var newTextNode = editor.getDoc().createTextNode(contentInside);

                                    // Replace the anchor tag with the new text node
                                    anchorTag.parentNode.replaceChild(newTextNode, anchorTag);
                                    
                                }
                            }, 0);
                        }
                    });
                }
            });
            // var quill = new Quill(element, {
            //     modules:{
            //         toolbar:false,
            //         keyboard: {
            //             bindings: {
            //                 enter: {
            //                 key: 13,
            //                 shiftKey:false,
            //                 handler:function() {
            //                     var quillContainer = $(quill.container);
            //                     var form = quillContainer.closest(".form_reply");

            //                     form.submit();
                                
            //                 }
            //                 }
            //             }
            //         }
            //     },
            //     readOnly: false,
            //     theme:'snow'
            // });

            $('.like-btn').click(function(event){
                event.preventDefault();
                var likeIcon=$(this).children('i');
                
                
                var status=$(this).parent().prev('.status');
                var id={{$id}};

                $.ajax({
                        url: "{{route('blogs.ajax-isUser')}}",
                        type:"POST",
                        data:{_token: '{{ csrf_token() }}'},
                        success: function(data){
                        
                            
                            if(data.check){
                                $.ajax({
                                    url: "{{route('blog.like')}}",
                                    type:"POST",
                                    data:{id,
                                        _token: '{{ csrf_token() }}'},
                                    success: function(data){
                                    
                                        var interaction=data.interaction;
                                        if(data.liked){
                                            likeIcon.removeClass('fa-regular').addClass('fa-solid');
                                        }else{
                                            likeIcon.removeClass('fa-solid').addClass('fa-regular');
                                        }
                                        var contentHtml=`
                                            ${interaction.views} views<span class="mx-1">&bullet;</span>${interaction.likes} likes
                                        `;
                                        status.html(contentHtml);
                                        
                                        
                                    },
                                    error: function (xhr, status, error) {
                                        console.log('Error:', xhr.responseText);
                                    }
                                    

                                });
                            }else{
                                window.open("{{ route('login') }}", '_blank');
                            }
                            
                            
                            
                        },
                        error: function (xhr, status, error) {
                            console.log('Error:', xhr.responseText);
                        }
                        

                    });

                    

                
            });

            var currentCommentPage={{$comments->currentPage()}};
            var lastCommentPage={{$comments->lastPage()}};
            

            $('body').on('click','.more-comments',function (event) {
                event.preventDefault();
                var id={{$id}};
                var repliesBlock=$(this).closest('.comment-block').children('.replies-block');
                var loadMore=$(this);

                if(currentCommentPage<lastCommentPage){
                    $.ajax({
                        url: "{{route('comment.load')}}",
                        type:"POST",
                        data:{id,
                            page: ++currentCommentPage,
                            _token: '{{ csrf_token() }}'},
                        success: function(data){
                            
                            
                            var lastCommentPage=data.comments.last_page;
                            var comments=data.comments.data;
                            console.log(comments);
                            if(comments.length>0){
                                comments.forEach(function(comment){
                                var duplicateElement=$('[data-id="'+ comment.id+'"].comment');
                                if(duplicateElement.length<=0){
                                    var contentHtml = `
                                        <div class="comment-block ms-2 ms-sm-3 mb-3" data-id="${comment.id}">
                                            <div class="comment px-3 py-1" data-id="${comment.id}">
                                                <div class="flex-shrink-1">
                                                    <div class="comment-meta d-flex align-items-end">
                                                        <h5 class="">${comment.name}</h5>
                                                        <span class="mx-1 text-muted">&bullet;</span>
                                                        <h6 class="readable-date text-muted">${comment.readable}</h6>
                                                    </div>
                                                    <div class="comment-body">
                                                        ${comment.comment}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="comment-actions ms-2 my-2">
                                                <a href="" class="reply-btn">Reply</a>
                                                <form action="" id="form-reply-${comment.id}" class="form_reply d-none ms-3">
                                                    <textarea class="form-control reply-box" id="reply-box-${comment.id}" cols="10" rows="2"></textarea>
                                                </form>
                                            </div>
                                            
                                            ${comment.replies > 0 ?
                                                `<a href="" class="btn btn-outline-primary rounded-pill view-replies ms-3 mb-3">
                                                    ${comment.replies === 1 ? `${comment.replies} reply` : `${comment.replies} replies`}
                                                </a>` : ''
                                            }
                                            <div class="replies-block ms-2 mb-3 d-none">
                                            </div>
                                        </div>
                                    `;
                                    $('.comments').append(contentHtml);
                                }
                                  
                                });
                                repliesBlock.removeClass('d-none').addClass('d-block');
                            }
                            if(currentCommentPage>=lastCommentPage){
                                loadMore.removeClass('d-block').addClass('d-none');
                            }

                            
                            
                        
                            
                        },
                        error: function (xhr, status, error) {
                            console.log('Error:', xhr.responseText);
                        }
                        

                    });
                }
            });

            

            $('body').on('click','.reply-btn',function (event) {
                event.preventDefault();
                var parentId=$(this).closest('.comment-block').data(id).id;
                var id=$(this).parent().prev('.comment').data('id');

                var replyForm=$('#form-reply-'+parentId);
                var replyBox=replyForm.children('.reply-box')
                $.ajax({
                    url: "{{route('comment.find')}}",
                    type:"POST",
                    data:{id,
                        _token: '{{ csrf_token() }}'},
                    success: function(data){
                        var comment=data.comment;
                        console.log(id +' '+comment.name);
                        var contentHtml=`<a href="" class="comment-mention">@${comment.name}</a>&nbsp;`;
                        var editorId = 'reply-box-' + parentId;
                        var editor = tinymce.get(editorId); 
                        editor.setContent(contentHtml);
                        editor.focus();
                    },
                    error: function (xhr, status, error) {
                        console.log('Error:', xhr.responseText);
                    }
                });
                $('.form_reply').removeClass('d-block').addClass('d-none');
                replyForm[0].reset();
                replyForm.removeClass('d-none').addClass('d-block');
            });
            
            var currentReplyPage=1;

            $('body').on('click','.view-replies',function (event) {
                event.preventDefault();
                currentReplyPage=1;
                var id=$(this).closest('.comment-block').data('id');
                var repliesBlock=$(this).next('.replies-block')
                var loadMore=$(this).closest('.comment-block').find('.more-replies');
                var viewReplies=this;

                if(repliesBlock.hasClass('d-none')){
                    $.ajax({
                        url: "{{route('reply.load')}}",
                        type:"POST",
                        data:{id,
                            page: currentReplyPage,
                            _token: '{{ csrf_token() }}'},
                        success: function(data){
                            
                            currentReplyPage=data.replies.current_page;
                            var lastReplyPage=data.replies.last_page;
                            var replies=data.replies.data;
                            repliesBlock.empty();
                            if(replies.length>0){
                                replies.forEach(function(reply){
                                    var duplicateElement=$('[data-id="'+ reply.id+'"].comment');
                                    if(duplicateElement.length<=0){
                                        var contentHtml=`
                                            <div class="comment ms-3 px-3 py-1" data-id="${reply.id}">
                                                <div class="flex-shrink-1">
                                                    <div class="comment-meta d-flex align-items-end">
                                                        <h5 class="">${reply.name}</h5>
                                                        <span class="mx-1 text-muted">&bullet;</span>
                                                        <h6 class="readable-date text-muted">${reply.readable}</h6>
                                                        
                                                    </div>
                                                    <div class="comment-body">
                                                        ${reply.comment}
                                                    </div>
                                                </div> 
                                                    
                                                </div>
                                                <div class="comment-actions ms-4 my-1">
                                                    <a href="" class="reply-btn">Reply</a>
                                                </div> 
                                            </div>
                                        `;
                                        repliesBlock.append(contentHtml);
                                    }
                                    
                                });
                                repliesBlock.removeClass('d-none').addClass('d-block')
                            }
                            if(currentReplyPage>=lastReplyPage){
                                loadMore.removeClass('d-block').addClass('d-none');
                            }else{
                                loadMore.removeClass('d-none').addClass('d-block');
                            }
                        },
                        error: function (xhr, status, error) {
                            console.log('Error:', xhr.responseText);
                        }
                        

                    });
                }else{
                    repliesBlock.removeClass('d-block').addClass('d-none');
                    loadMore.removeClass('d-block').addClass('d-none');
                }
            });

            $('body').on('click','.more-replies',function (event) {
                event.preventDefault();
                var id=$(this).closest('.comment-block').data('id');
                var repliesBlock=$(this).closest('.comment-block').children('.replies-block');
                var loadMore=$(this);
                $.ajax({
                    url: "{{route('reply.load')}}",
                    type:"POST",
                    data:{id,
                        page: ++currentReplyPage,
                        _token: '{{ csrf_token() }}'},
                    success: function(data){
                        
                        currentReplyPage=data.replies.current_page;
                        var lastReplyPage=data.replies.last_page;
                        var replies=data.replies.data;
                        if(replies.length>0){
                            replies.forEach(function(reply){
                                var duplicateElement=$('[data-id="'+ reply.id+'"].comment');
                                if(duplicateElement.length<=0){
                                    var contentHtml=`
                                        <div class="comment ms-3 px-3 py-1" data-id="${reply.id}">
                                            <div class="flex-shrink-1">
                                                <div class="comment-meta d-flex align-items-end">
                                                    <h5 class="">${reply.name}</h5>
                                                    <span class="mx-1 text-muted">&bullet;</span>
                                                    <h6 class="readable-date text-muted">${reply.readable}</h6>
                                                    
                                                </div>
                                                <div class="comment-body">
                                                    ${reply.comment}
                                                </div>
                                            </div> 
                                                
                                            </div>
                                            <div class="comment-actions ms-4 my-1">
                                                <a href="" class="reply-btn">Reply</a>
                                            </div> 
                                        </div>
                                    `;
                                    repliesBlock.append(contentHtml);
                                }
                                
                            });
                            repliesBlock.removeClass('d-none').addClass('d-block');
                        }
                        if(currentReplyPage>=lastReplyPage){
                            loadMore.removeClass('d-block').addClass('d-none');
                        }

                        
                        
                    
                        
                    },
                    error: function (xhr, status, error) {
                        console.log('Error:', xhr.responseText);
                    }
                    

                });
            });

            $('.comment-box').keypress(function (e) {
                if(e.which === 13 && !e.shiftKey) {
                    e.preventDefault();
                    $(this).closest(".form_comment").submit();
                }
            });
            
            

            $('.form_comment').on('submit',function(event){
                event.preventDefault();
                var id={{$id}};
                var area=$(this).closest('.blog-action').children('.comments');
                var comment=$(this).find('.comment-box').val();
                var form=this;
                $.ajax({
                        url: "{{route('blogs.ajax-isUser')}}",
                        type:"POST",
                        data:{_token: '{{ csrf_token() }}'},
                        success: function(data){
                        
                            if(data.check){
                                
                                $.ajax({
                                        url: "{{route('comment.add')}}",
                                        type:"POST",
                                        data:{id,
                                            comment,
                                            _token: '{{ csrf_token() }}'},
                                        success: function(data){

                                            var comment= data.comment;
                                            

                                            var contentHtml = `
                                                <div class="comment-block ms-2 ms-sm-3 mb-3" data-id="${comment.id}">
                                                    <div class="comment px-3 py-1" data-id="${comment.id}">
                                                        <div class="flex-shrink-1">
                                                            <div class="comment-meta d-flex align-items-end">
                                                                <h5 class="">${comment.name}</h5>
                                                                <span class="mx-1 text-muted">&bullet;</span>
                                                                <h6 class="readable-date text-muted">${comment.readable}</h6>
                                                            </div>
                                                            <div class="comment-body">
                                                                ${comment.comment}
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="comment-actions ms-2 my-2">
                                                        <a href="" class="reply-btn">Reply</a>
                                                        <form action="" id="form-reply-${comment.id}" class="form_reply d-none ms-3">
                                                            <textarea class="form-control reply-box" id="reply-box-${comment.id}" cols="10" rows="2"></textarea>
                                                        </form>
                                                    </div>
                                                    
                                                    ${comment.replies > 0 ?
                                                        `<a href="" class="btn btn-outline-primary rounded-pill view-replies ms-3 mb-3">
                                                            ${comment.replies === 1 ? `${comment.replies} reply` : `${comment.replies} replies`}
                                                        </a>` : ''
                                                    }
                                                    <div class="replies-block ms-2 mb-3 d-none">
                                                    </div>
                                                </div>
                                            `;
                                            area.prepend(contentHtml);
                                            form.reset();

                                            var replyBoxId='#reply-box-'+comment.id;
                                            if (!tinymce.get($(replyBoxId))) {
                                                tinymce.init({
                                                    selector: replyBoxId,
                                                    width:'100%',
                                                    height:'20px',
                                                    resize: "both",
                                                    plugins: [
                                                    
                                                    ],
                                                    content_style:`html{
                                                                        height:64px;
                                                                        margin:0;
                                                                        padding:0;
                                                                    }
                                                                    body{
                                                                        margin:0;
                                                                        padding:10px 12px;
                                                                        height:43px;
                                                                        background-color: rgba(230,233,235, 0.8) !important;
                                                                    }
                                                                    p{
                                                                        margin:0;
                                                                    }
                                                    
                                                                    a{
                                                                        color:blue;
                                                                        text-decoration:none;
                                                                    }`,

                                                    menubar:false,
                                                    toolbar: false,
                                                    statusbar:false,
                                                    tinycomments_mode: 'embedded',
                                                    tinycomments_author: 'Author name',
                                                    mergetags_list: [
                                                    { value: 'Swatik', title: 'First Name' },
                                                    { value: 'scsswash36@gmail.com', title: 'Email' },
                                                    ],
                                                    ai_request: (request, respondWith) => respondWith.string(() => Promise.reject("See docs to implement AI Assistant")),
                                                    setup: function (editor) {
                                                        // Add input event listener to the editor
                                                        editor.on('keydown', function (e) {
                                                            
                                                            if (e.keyCode === 13 && !e.shiftKey) {
                                                                e.preventDefault();
                                                                var form=$(editor.getElement()).closest('.form_reply');
                                                                form.submit();
                                                            }else if ((e.keyCode >= 33 && e.keyCode <= 40) || e.ctrlKey || e.altKey) {
                                                                return;
                                                            }
                                                            else{
                                                                var selection = editor.selection.getSel();
                                                                

                                                                // Check if the cursor is inside an <a> tag
                                                                if (selection && selection.anchorNode && selection.anchorNode.parentNode && selection.anchorNode.parentNode.tagName.toLowerCase() === 'a') {
                                                                    // Prevent the default behavior if inside an <a> tag
                                                                    
                                                                    var wholeTag = selection.anchorNode.parentNode.outerHTML;
                                                                    var contentInsideA = selection.anchorNode.parentNode.innerText;
                                                                    console.log(contentInsideA);
                                                                            e.preventDefault();
                                                                            console.log('done');
                                                                                                        
                                                                }
                                                            }
                                                        });
                                                    }
                                                }); 
                                            }




                                        },
                                        error: function (xhr, status, error) {
                                            console.log('Error:', xhr.responseText);
                                        }
                                        

                                });
                            }else{
                                window.open("{{ route('login') }}", '_blank');
                            }
                        },
                        error: function (xhr, status, error) {
                            console.log('Error:', xhr.responseText);
                        }
                        

                    });
                
            });

            // $('.reply-box').keypress(function (e) {
            //     if(e.which === 13 && !e.shiftKey) {
            //         e.preventDefault();
            //         $(this).closest(".form_reply").submit();
            //     }
            // });

            $('.form_reply').on('submit',function(event){

                event.preventDefault();
                var id={{$id}};
                var parentId=$(this).closest('.comment-block').data('id');
                var area=$(this).closest('.comment-block').children('.replies-block');
                var viewReplies=$(this).closest('.comment-block').children('.view-replies');
                var editorId = 'reply-box-' + parentId;
                var editor=tinymce.get(editorId);
                var reply=editor.getContent();
                var form=this;
                
                $.ajax({
                    url: "{{route('blogs.ajax-isUser')}}",
                    type:"POST",
                    data:{_token: '{{ csrf_token() }}'},
                    success: function(data){
                    
                        if(data.check){
                            $.ajax({
                                url: "{{route('reply.add')}}",
                                type:"POST",
                                data:{id,
                                    reply,
                                    parentId,
                                    _token: '{{ csrf_token() }}'},
                                success: function(data){

                                    var reply= data.reply;
                                    console.log(reply);
                                    

                                    var contentHtml = `
                                        <div class="comment ms-3 px-3 py-1" data-id="${reply.id}">
                                            <div class="flex-shrink-1">
                                                <div class="comment-meta d-flex align-items-end">
                                                    <h5 class="">${reply.name}</h5>
                                                    <span class="mx-1 text-muted">&bullet;</span>
                                                    <h6 class="readable-date text-muted">${reply.readable}</h6>
                                                    
                                                </div>
                                                <div class="comment-body">
                                                    ${reply.comment}
                                                </div>
                                            </div> 
                                                
                                            </div>
                                            <div class="comment-actions ms-4 my-1">
                                                <a href="" class="reply-btn">Reply</a>
                                            </div> 
                                        </div>
                                    `;
                                    area.prepend(contentHtml);
                                    area.removeClass('d-none').addClass('d-block');
                                    if(viewReplies.hasClass('d-none')){
                                        viewReplies.removeClass('d-none').addClass('d-block');
                                        viewReplies.click();
                                    }
                                    form.reset();
                                    


                                },
                                error: function (xhr, status, error) {
                                    console.log('Error:', xhr.responseText);
                                }
                                

                            });
                        }else{
                            window.open("{{ route('login') }}", '_blank');
                        }
                
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