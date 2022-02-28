@extends('crudbooster::admin_template')
@push('head')
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/crudbooster/assets/summernote/summernote.css') }}">
    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
@endpush
@section('content')
    <p><a title='Return' href='{{ CRUDBooster::mainpath() }}'><i class='fa fa-chevron-circle-left '></i>
            &nbsp; Back To List Data Products</a></p>

    <div class="panel panel-default">
        <div class="panel-heading">
            <strong><i class='fa fa-product-hunt'></i> {{ $page_title }}</strong>
        </div>

        <div class="panel-body" style="padding:20px 0px 0px 0px">
            <form class='form-horizontal' method='post' id="form" enctype="multipart/form-data"
                action='{{ CRUDBooster::mainpath($row ? 'edit-save/' . $row->id : 'add-save') }}'>
                @csrf
                <div class="box-body" id="parent-form-area">

                    <div class='form-group header-group-0 ' id='form-group-name' style="">
                        <label class='control-label col-sm-2'>
                            Name
                            <span class='text-danger' title='This field is required'>*</span>
                        </label>

                        <div class="col-sm-10">
                            <input type='text' title="Name" required placeholder='' maxlength=70 class='form-control'
                                name="name" id="name" value='{{ old('name', optional($row)->name) }}' />

                            <div class="text-danger"></div>
                            <p class='help-block'></p>

                        </div>
                    </div>
                    <div class='form-group header-group-0 ' id='form-group-images' style="">
                        <label class='col-sm-2 control-label'>Images
                            <span class='text-danger' title='This field is required'>*</span>
                        </label>

                        <div class="col-sm-10">
                            <div class="needsclick dropzone" id="document-dropzone">

                            </div>
                        </div>

                    </div>
                    <div class='form-group header-group-0 ' id='form-group-permalink' style="">
                        <label class='control-label col-sm-2'>
                            Permalink
                            <span class='text-danger' title='This field is required'>*</span>
                        </label>

                        <div class="col-sm-10">
                            <input type='text' title="Permalink" required maxlength=255 class='form-control'
                                name="permalink" id="permalink"
                                value='{{ old('permalink', optional($row)->permalink) }}' />

                            <div class="text-danger"></div>
                            <p class='help-block'></p>

                        </div>
                    </div>
                    <div class='form-group' id='form-group-description' style="">
                        <label class='control-label col-sm-2'>Description</label>

                        <div class="col-sm-10">
                            <textarea id='textarea_description' id="description" required name="description"
                                class='form-control' rows='5'>{!! old('description', optional($row)->description) !!}</textarea>
                            <div class="text-danger"></div>
                            <p class='help-block'></p>
                        </div>
                    </div>
                    <div class='form-group header-group-0 ' id='form-group-categories_id' style="">
                        <label class='control-label col-sm-2'>Category
                            <span class='text-danger' title='This field is required'>*</span>
                        </label>

                        <div class="col-sm-10">
                            <select class='form-control' id="categories_id" data-value='' name="categories_id" required>
                                <option value=''>** Please select a Category</option>
                                @foreach ($categories as $category)
                                    <option value='{{ $category->id }}' @if (old('categories_id', optional($row)->categories_id) == $category->id) selected @endif>
                                        {{ $category->name }}</option>
                                @endforeach
                            </select>
                            <div class="text-danger"></div>
                            <p class='help-block'></p>
                        </div>
                    </div>
                    <div class='form-group header-group-0 ' id='form-group-sub_categories_id' style="" required>
                        <label class='control-label col-sm-2'>Sub Category
                            <span class='text-danger' title='This field is required'>*</span>
                        </label>

                        <div class="col-sm-10">
                            <select class='form-control' id="sub_categories_id" data-value='' name="sub_categories_id">
                                <option value=''>** Please select a Sub Category</option>
                            </select>
                            <div class="text-danger"></div>
                            <p class='help-block'></p>
                        </div>
                    </div>
                    <div class='form-group header-group-0 ' id='form-group-location' style="">
                        <label class='control-label col-sm-2'>
                            Location
                            <span class='text-danger' title='This field is required'>*</span>
                        </label>

                        <div class="col-sm-10">
                            <input type='text' title="Location" required maxlength=255 class='form-control' name="location"
                                id="location" value='{{ old('location', optional($row)->location) }}' />

                            <div class="text-danger"></div>
                            <p class='help-block'></p>

                        </div>
                    </div>
                    <div class="form-group header-group-0 " id="form-group-price" style="">
                        <label class="control-label col-sm-2">Price
                            <span class='text-danger' title='This field is required'>*</span>
                        </label>

                        <div class="col-sm-10">
                            <input type="text" title="Price" required class="form-control inputMoney" name="price"
                                id="price" value="{{ old('price', optional($row)->price) }}">
                            <div class="text-danger"></div>
                            <p class="help-block"></p>
                        </div>
                    </div>
                    <div class='form-group header-group-0 ' id='form-group-size' style="">
                        <label class='control-label col-sm-2'>
                            Size
                            <span class='text-danger' title='This field is required'>*</span>
                        </label>

                        <div class="col-sm-10">
                            <input type='text' title="Size" required maxlength=255 class='form-control' name="size"
                                id="size" value='{{ old('size', optional($row)->size) }}' />
                            <div class="text-danger"></div>
                            <p class='help-block'></p>
                        </div>
                    </div>
                    <div class='form-group header-group-0 ' id='form-group-stock' style="">
                        <label class='control-label col-sm-2'>Stock
                            <span class='text-danger' title='This field is required'>*</span>
                        </label>
                        <div class="col-sm-10">
                            <input type='number' step="1" title="Stock" required class='form-control' name="stock"
                                id="stock" value='{{ old('stock', optional($row)->stock) }}' />
                            <div class="text-danger"></div>
                            <p class='help-block'></p>
                        </div>
                    </div>
                </div><!-- /.box-body -->
                <div class="box-footer" style="background: #F5F5F5">
                    <div class="form-group">
                        <label class="control-label col-sm-2"></label>
                        <div class="col-sm-10">
                            <a href='https://ioi.test/admin/products' class='btn btn-default'><i
                                    class='fa fa-chevron-circle-left'></i> Back</a>
                            @if (!$row)
                                <input type="submit" name="submit" value='Save &amp; Add More' class='btn btn-success'>
                            @endif
                            <input type="submit" name="submit" value='Save' class='btn btn-success'>
                        </div>
                    </div>
                </div><!-- /.box-footer-->
            </form>
        </div>
    </div>
@endsection
@push('bottom')
    <script type="text/javascript" src="{{ asset('vendor/crudbooster/assets/summernote/summernote.min.js') }}"></script>
    <script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
    <script>
        $(function() {
            $('#name').on('input', function() {
                var permalink;
                permalink = $.trim($(this).val());
                permalink = permalink.replace(/\s+/g, ' ');
                $('#permalink').val(permalink.toLowerCase());
                $('#permalink').val($('#permalink').val().replace(/\W/g, ' '));
                $('#permalink').val($.trim($('#permalink').val()));
                $('#permalink').val($('#permalink').val().replace(/\s+/g, '-'));
            });
        });
    </script>
    <script>
        var uploadedDocumentMap = {}
        Dropzone.options.documentDropzone = {
            url: `${ADMIN_PATH}/products/dropzone`,
            maxFilesize: 2, // MB
            addRemoveLinks: true,
            acceptedFiles: ".jpeg,.jpg,.png,.gif",
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            success: function(file, response) {
                var file_path = ASSET_URL + response.name;
                $('form').append('<input type="hidden" name="images[]" value="' + file_path + '">')
                uploadedDocumentMap[file.name] = file_path
            },
            removedfile: function(file) {
                file.previewElement.remove()
                var name = ''
                if (typeof file.name !== 'undefined') {
                    name = file.name
                } else {
                    name = uploadedDocumentMap[file.name]
                }
                console.log(name);
                $('form').find('input[name="images[]"][value="' + name + '"]').remove()
            },
            @if (isset($row) && $row->product_images)
                init: function() {
                var files = {!! json_encode($row->product_images) !!}
                for (var i in files) {
                var file_path = ASSET_URL + files[i]
                var file_size = 0;
                var http = new XMLHttpRequest();
                http.open('HEAD', file_path, false);
                http.send(null);
                if (http.status === 200) {
                file_size = http.getResponseHeader('content-length');
                }
                var file = {
                name: file_path,
                width: 226,
                height: 324,
                size: file_size
                }
                this.options.addedfile.call(this, file)
                this.options.thumbnail.call(this, file, file.name)
                file.previewElement.classList.add('dz-complete')
            
                $('form').append('<input type="hidden" name="images[]" value="' + file.name + '">')
                }
                }
            @endif
        }
    </script>
    <script>
        $(function() {
            $('.inputMoney#price').priceFormat({
                "prefix": "",
                "thousandsSeparator": ",",
                "centsLimit": "0",
                "clearOnEmpty": false
            });
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#textarea_description').summernote({
                height: ($(window).height() - 300),
                callbacks: {
                    onImageUpload: function(image) {
                        uploadImagedescription(image[0]);
                    }
                }
            });

            function uploadImagedescription(image) {
                var data = new FormData();
                data.append("userfile", image);
                $.ajax({
                    url: `${ADMIN_PATH}/products/upload-summernote`,
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: data,
                    type: "post",
                    success: function(url) {
                        var image = $('<img>').attr('src', url);
                        $('#textarea_description').summernote("insertNode", image[0]);
                    },
                    error: function(data) {
                        console.log(data);
                    }
                });
            }
        })
    </script>
    <script type="text/javascript">
        $(function() {
            $('#categories_id, input:radio[name=categories_id]').change(function() {
                var $current = $("#sub_categories_id");
                var parent_id = $(this).val();
                var fk_name = "categories_id";
                var fk_value = $(this).val();
                var datatable = "sub_categories,name".split(',');
                var datatableWhere = "";
                var table = datatable[0].trim('');
                var label = datatable[1].trim('');
                var value = "{{ old('sub_categories_id', optional($row)->sub_categories_id) }}";

                if (fk_value != '') {
                    $current.html("<option value=''>Please wait loading... Sub Category");
                    $.get(ADMIN_PATH + "/products/data-table?table=" + table + "&label=" + label +
                        "&fk_name=" + fk_name + "&fk_value=" + fk_value + "&datatable_where=" +
                        encodeURI(datatableWhere),
                        function(response) {
                            if (response) {
                                $current.html("<option value=''>** Please select a Sub Category");
                                $.each(response, function(i, obj) {
                                    var selected = (value && value == obj.select_value) ?
                                        "selected" : "";
                                    $("<option " + selected + " value='" + obj.select_value +
                                        "'>" + obj.select_label + "</option>").appendTo(
                                        "#sub_categories_id");
                                })
                                $current.trigger('change');
                            }
                        });
                } else {
                    $current.html("<option value=''>** Please select a Sub Category");
                }
            })

            $('#categories_id').trigger('change');
            $("input[name='categories_id']:checked").trigger("change");
            $("#sub_categories_id").trigger('change');
        })
    </script>
@endpush
