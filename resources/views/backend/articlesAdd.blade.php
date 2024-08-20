<!-- resources/views/home.blade.php -->
@extends('backend.layouts.backendLayout')

@section('title', 'Dashborad')

@section('content')

<link rel="stylesheet" href="{{ asset('assets/vendor/libs/quill/katex.css')}}" />
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/quill/editor.css')}}" />

<div class="content-wrapper">
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
      <div class="row">
        
        <!-- Snow Theme -->
        <div class="col-12">
          <div class="card mb-6">
            <h5 class="card-header">Add Article</h5>
            <div class="card-body">
                <form id="addArticleForm"  method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="title_en" class="form-label">Title(English)</label>
                    <input type="text" class="form-control" id="title_en" name="title_en" required>
                </div>
                <div class="mb-3">
                    <label for="title_ar" class="form-label">Title(Arabic)</label>
                    <input type="text" class="form-control" id="title_ar" name="title_ar" required>
                </div>
                <div class="mb-3" id="thumbnailImg">
                    <label for="image" class="form-label">Thumbnail Image</label>
                    <input type="file" class="form-control" id="image" name="image"  accept="image/*">
                </div>
                <div class="mb-3" id="imgdiv" style="display: none;">
                    <img id="articleImage" src="" alt="" width="100px" height="100px" >
                </div>
                <div class="mb-3">
                    <label for="article_en" class="form-label">Article(English)</label>
                    <div id="snow-toolbar">
               
                <span class="ql-formats">
                  <select class="ql-font"></select>
                  <select class="ql-size"></select>
                </span>
                <span class="ql-formats">
                  <button class="ql-bold"></button>
                  <button class="ql-italic"></button>
                  <button class="ql-underline"></button>
                  <button class="ql-strike"></button>
                </span>
                <span class="ql-formats">
                  <select class="ql-color"></select>
                  <select class="ql-background"></select>
                </span>
                <span class="ql-formats">
                  <button class="ql-script" value="sub"></button>
                  <button class="ql-script" value="super"></button>
                </span>
                <span class="ql-formats">
                  <button class="ql-header" value="1"></button>
                  <button class="ql-header" value="2"></button>
                  <button class="ql-blockquote"></button>
                  <button class="ql-code-block"></button>
                </span>
              </div>
              <div id="snow-editor">
               </div>
              </div>
              <div class="mb-3">
                    <label for="article_ar" class="form-label">Article(Arabic)</label>
                    <div id="snow-toolbar1">
               
                <span class="ql-formats">
                  <select class="ql-font"></select>
                  <select class="ql-size"></select>
                </span>
                <span class="ql-formats">
                  <button class="ql-bold"></button>
                  <button class="ql-italic"></button>
                  <button class="ql-underline"></button>
                  <button class="ql-strike"></button>
                </span>
                <span class="ql-formats">
                  <select class="ql-color"></select>
                  <select class="ql-background"></select>
                </span>
                <span class="ql-formats">
                  <button class="ql-script" value="sub"></button>
                  <button class="ql-script" value="super"></button>
                </span>
                <span class="ql-formats">
                  <button class="ql-header" value="1"></button>
                  <button class="ql-header" value="2"></button>
                  <button class="ql-blockquote"></button>
                  <button class="ql-code-block"></button>
                </span>
              </div>
              <div id="snow-editor1">
               </div>
              </div>
              <div class="mb-3">
                    <label for="slug" class="form-label">Slug</label>
                    <input type="text" class="form-control" id="slug" name="slug" required>
                </div>
              
              <div class="row justify-content-end">
                <div class="col-sm-6">
                  <button type="submit" class="btn btn-primary">Save</button>
                  <a href="{{ route('articles.index') }}" class="btn btn-secondary">Cancel</a>
                </div>
              </div>
              
              <input type="hidden" name="content" id="content">
              <input type="hidden" name="_token" value="{{ csrf_token() }}">

              </form>
            </div>
          </div>
        </div>
      </div>
    </div>

    <script src="{{ asset('assets/vendor/libs/jquery/jquery.js')}}"></script>
    <script src="{{ asset('assets/vendor/libs/quill/katex.js')}}"></script>
    <script src="{{ asset('assets/vendor/libs/quill/quill.js')}}"></script>
 

<script>
$(document).ready(function () {
const snowEditor = new Quill('#snow-editor', {
    bounds: '#snow-editor',
    modules: {
      formula: true,
      toolbar: '#snow-toolbar'
    },
    theme: 'snow'
  });
  const snowEditor1 = new Quill('#snow-editor1', {
    bounds: '#snow-editor1',
    modules: {
      formula: true,
      toolbar: '#snow-toolbar1'
    },
    theme: 'snow'
  });
    // Submit form
$('#addArticleForm').on('submit', function(e) {
//document.getElementById('content').value = snowEditor.root.innerHTML;
 e.preventDefault();
 let contentEn = snowEditor.root.innerHTML;
        let contentAr = snowEditor1.root.innerHTML;

        // Add content to hidden input fields
        $('<input>').attr({
            type: 'hidden',
            name: 'content_en',
            value: contentEn
        }).appendTo('#addArticleForm');

        $('<input>').attr({
            type: 'hidden',
            name: 'content_ar',
            value: contentAr
        }).appendTo('#addArticleForm');

        // var formData = new FormData(this);
 var formData = new FormData(this);
 $.ajax({
     url: "{{ route('articles.store') }}",
     type: 'POST',
     data: formData,
     processData: false,
     contentType: false,
     success: function(response) {
         if (response.status) {
             Swal.fire({
              title: 'Good job!',
              text: 'Article created successfully!',
              icon: 'success',
              customClass: {
                confirmButton: 'btn btn-primary waves-effect waves-light'
              },
              buttonsStyling: false
            }).then(() => {
              setTimeout(() => {
                window.location.href = "{{route('articles.index')}}"; // Replace with the URL of the page you want to redirect to
              }, 0); // 2000 milliseconds = 2 seconds
            });
            // location.reload(); 
         } else {
             console.log('Error saving article: ' + response.message);
         }
     },
     error: function(xhr) {
        console.log('Error saving article: ' + (xhr.responseJSON.message || 'Unknown error'));
     }
  });
 });   
});
</script>
@endsection