@extends('layout.admin')
@section('content')
    <style>
        .image-upload>input {
            display: none;
        }

        .upload-icon {
            width: 100px;
            height: 97px;
            border: 2px solid #5642BE;
            border-style: dotted;
            border-radius: 18px;
            float: left;
        }

        .upload-icon .icon {
            width: 60px;
            height: 60px;
            margin: 19px;
            cursor: pointer;
        }

        .prev {
            display: none;
            width: 95px;
            height: 92px;
            margin: 2px;
            border-radius: 15px;
        }

        .label-info {
            background-color: #5bc0de;
        }

    </style>
    <link rel="stylesheet" href="https://bootstrap-tagsinput.github.io/bootstrap-tagsinput/dist/bootstrap-tagsinput.css">
    @if (session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger" role="alert">
            {{ session('error') }}
        </div>
    @endif

    <form id="product_creat" action="{{ URL::to('/dashboard/product/store') }}" method="POST"
        enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label>Tên sản phẩm</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name"
                value="{{ old('name') }}" onkeyup="ChangeToSlug();" placeholder="Enter name" required>
            @error('name')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label>Slug</label>
            <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug" name="slug"
                value="{{ old('slug') }}" placeholder="Slug" required>
            @error('slug')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label>Từ khóa</label>
            <input type="text" class="form-control @error('keywords') is-invalid @enderror" name="keywords" value="{{ old('keywords') }}"
                data-role="tagsinput" required>
            @error('keywords')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <br>
        <label>Hình ảnh</label>
        <div class="input-images"  @if (Session::has('images')) autofocus @endif></div>
        @error('images')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
        <br>
        <div class="form-group">
            <label>Mô tả</label>
            <textarea rows="10" cols="50" class="form-control @error('content') is-invalid @enderror" id="content" name="content" required>{{ old('content') }}
    </textarea >
            @error('content')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label>Số lượng</label>
            <input type="number" class="form-control @error('quantity') is-invalid @enderror" id="quantity" name="quantity"
                value="{{ old('quantity') }}" placeholder="0" required>
            @error('quantity')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label>Giá nhập</label>
            <input type="text" class="form-control @error('cost_price') is-invalid @enderror price_format" id="cost_price"
                name="cost_price" value="{{ old('cost_price') }}" placeholder="0" required>
            @error('cost_price')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label>Giá bán</label>
            <input type="text" class="form-control @error('price') is-invalid @enderror price_format" id="price"
                name="price" value="{{ old('price') }}" placeholder="0" required>
            @error('price')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label>Giảm giá</label>
            <input type="text" class="form-control @error('sale') is-invalid @enderror price_format" id="sale" name="sale"
                value="{{ old('sale') }}" placeholder="0" >
            @error('sale')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label>Danh mục</label>
            <select class="form-control  @error('category_id') is-invalid @enderror" name="category_id">
                @if (count($category))
                    @foreach ($category as $key => $val)
                        @if ($val->category_parent == 0)
                            <option disabled value="{{ $val->id }}"><strong>{{ $val->name }}</strong></option>
                            @foreach ($category as $key2 => $val2)
                                @if ($val2->category_parent == $val->id)
                                    <option value="{{ $val2->id }}">--{{ $val2->name }}--</option>
                                @endif
                            @endforeach
                        @endif
                    @endforeach
                @endif
            </select>
            @error('category_id')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label>trạng thái</label>
            <select class="form-control  @error('status') is-invalid @enderror" name="status">
                <option value="1">Hiện</option>
                <option value="0">Ẩn</option>
            </select>
            @error('status')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <br><br>
        <button type="submit" class="btn btn-primary">Lưu</button>
    </form>
    <script language="javascript">
        function ChangeToSlug() {
            var title, slug;

            //Lấy text từ thẻ input title
            title = document.getElementById("name").value;

            //Đổi chữ hoa thành chữ thường
            slug = title.toLowerCase();

            //Đổi ký tự có dấu thành không dấu
            slug = slug.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a');
            slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e');
            slug = slug.replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i');
            slug = slug.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o');
            slug = slug.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u');
            slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y');
            slug = slug.replace(/đ/gi, 'd');
            //Xóa các ký tự đặt biệt
            slug = slug.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '');
            //Đổi khoảng trắng thành ký tự gạch ngang
            slug = slug.replace(/ /gi, "-");
            //Đổi nhiều ký tự gạch ngang liên tiếp thành 1 ký tự gạch ngang
            //Phòng trường hợp người nhập vào quá nhiều ký tự trắng
            slug = slug.replace(/\-\-\-\-\-/gi, '-');
            slug = slug.replace(/\-\-\-\-/gi, '-');
            slug = slug.replace(/\-\-\-/gi, '-');
            slug = slug.replace(/\-\-/gi, '-');
            //Xóa các ký tự gạch ngang ở đầu và cuối
            slug = '@' + slug + '@';
            slug = slug.replace(/\@\-|\-\@|\@/gi, '');
            //In slug ra textbox có id “slug”
            document.getElementById('slug').value = slug;
        }
    </script>
    <script>
        $(document).ready(function() {
            $('.input-images').imageUploader();
        });
    </script>
    <script>
        /*! Image Uploader - v1.0.0 - 15/07/2019
         * Copyright (c) 2019 Christian Bayer; Licensed MIT */
        (function($) {
            $.fn.imageUploader = function(options) {
                let defaults = {
                    preloaded: [],
                    imagesInputName: "images",
                    preloadedInputName: "preloaded",
                    label: "Drag & Drop files here or click to browse",
                };
                let plugin = this;
                plugin.settings = {};
                plugin.init = function() {
                    plugin.settings = $.extend(plugin.settings, defaults, options);
                    plugin.each(function(i, wrapper) {
                        let $container = createContainer();
                        $(wrapper).append($container);
                        $container.on("dragover", fileDragHover.bind($container));
                        $container.on("dragleave", fileDragHover.bind($container));
                        $container.on("drop", fileSelectHandler.bind($container));
                        if (plugin.settings.preloaded.length) {
                            $container.addClass("has-files");
                            let $uploadedContainer = $container.find(".uploaded");
                            for (let i = 0; i < plugin.settings.preloaded.length; i++) {
                                $uploadedContainer.append(
                                    createImg(
                                        plugin.settings.preloaded[i].src,
                                        plugin.settings.preloaded[i].id,
                                        !0
                                    )
                                );
                            }
                        }
                    });
                };
                let dataTransfer = new DataTransfer();
                let createContainer = function() {
                    let $container = $("<div>", {
                            class: "image-uploader"
                        }),
                        $input = $("<input>", {
                            type: "file",
                            id: plugin.settings.imagesInputName,
                            name: plugin.settings.imagesInputName + "[]",
                            multiple: "",
                            accept: "image/*"
                        }).appendTo($container),
                        $uploadedContainer = $("<div>", {
                            class: "uploaded"
                        }).appendTo(
                            $container
                        ),
                        $textContainer = $("<div>", {
                            class: "upload-text"
                        }).appendTo(
                            $container
                        ),
                        $i = $("<i>", {
                            class: "material-icons",
                            text: "cloud_upload",
                        }).appendTo($textContainer),
                        $span = $("<span>", {
                            text: plugin.settings.label
                        }).appendTo(
                            $textContainer
                        );
                    $container.on("click", function(e) {
                        prevent(e);
                        $input.trigger("click");
                    });
                    $input.on("click", function(e) {
                        e.stopPropagation();
                    });
                    $input.on("change", fileSelectHandler.bind($container));
                    return $container;
                };
                let prevent = function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                };
                let createImg = function(src, id) {
                    let $container = $("<div>", {
                            class: "uploaded-image"
                        }),
                        $img = $("<img>", {
                            src: src
                        }).appendTo($container),
                        $button = $("<button>", {
                            class: "delete-image"
                        }).appendTo(
                            $container
                        ),
                        $i = $("<i>", {
                            class: "material-icons",
                            text: "X",
                        }).appendTo($button);
                    if (plugin.settings.preloaded.length) {
                        $container.attr("data-preloaded", !0);
                        let $preloaded = $("<input>", {
                            type: "hidden",
                            name: plugin.settings.preloadedInputName + "[]",
                            value: id,
                        }).appendTo($container);
                    } else {
                        $container.attr("data-index", id);
                    }
                    $container.on("click", function(e) {
                        prevent(e);
                    });
                    $button.on("click", function(e) {
                        prevent(e);
                        let index = parseInt($container.data("index"));
                        $(".uploaded-image[data-index]").each(function(i, cont) {
                                if (i > index) {
                                    $(cont).attr("data-index", i - 1);
                                }
                            });
                             const dt = new DataTransfer();
                              const input = document.getElementById('images');
                              const { files } = input;
                              for (let i = 0; i < files.length; i++) {
                                const file = files[i];
                                if (index !== i)
                                  dt.items.add(file); // here you exclude the file. thus removing it.
                              }

                              input.files = dt.files; // Assign the updates list
                        dataTransfer.items.remove(index);

                        $container.remove();
                        if (!$container.find(".uploaded-image").length) {
                            $container.removeClass("has-files");
                        }
                    });
                    return $container;
                };
                let fileDragHover = function(e) {
                    prevent(e);
                    if (e.type === "dragover") {
                        $(this).addClass("drag-over");
                    } else {
                        $(this).removeClass("drag-over");
                    }
                };
                let fileSelectHandler = function(e) {
                    prevent(e);
                    let $container = $(this);
                    $container.removeClass("drag-over");
                    let files = e.target.files || e.originalEvent.dataTransfer.files;
                    setPreview($container, files);
                };
                let setPreview = function($container, files) {
                    $container.addClass("has-files");
                    let $uploadedContainer = $container.find(".uploaded"),
                        $input = $container.find('input[type="file"]');
                    $(files).each(function(i, file) {
                        dataTransfer.items.add(file);
                        $uploadedContainer.append(
                            createImg(
                                URL.createObjectURL(file),
                                dataTransfer.items.length - 1
                            )
                        );
                    });
                    $input.prop("files", dataTransfer.files);
                };
                let random = function() {
                    return Date.now() + Math.floor(Math.random() * 100 + 1);
                };
                this.init();
                return this;
            };
        })(jQuery);
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.min.js"
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

@endsection
