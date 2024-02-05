@extends('layouts.app')

@push('js')
    <script>
        $("#page1").change(function() {
            var id = $(this).val();
            var url = "{{ url('/seo-panel?page_id=') }}" + id;
            window.location.href = url;
        });

        $(".tag_delete").submit(function(e) {
            e.preventDefault();
            var result = confirm("Delete the tag?");
            if (result) {
                var seo_id = $(this).find("input[name='s_e_o_id']").val();
                var url = $(this).attr("action");
                $.ajax({
                    url: url,
                    type: 'POST',
                    data: {
                        s_e_o_id: seo_id
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        window.location.reload();
                    },
                    error: function(xhr, status, error) {
                        console.log(error);
                    }
                });

            } else {
                e.preventDefault();
            }

        })
    </script>
@endpush

@section('content')
    <div>
        <div class="content-wrapper">
            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                {{-- card header --}}
                                <div class="card-header">
                                    <h3 class="card-title">SEO Panel</h3>
                                </div>

                                {{-- card body --}}
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <select id="page1" class="form-control">
                                                <option>Select a page</option>
                                                @foreach ($pages as $page)
                                                    <option value="{{ $page->id }}"
                                                        {{ $page->id == $page_id ? 'selected' : '' }}>{{ $page->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-md-6">
                                            @if ($page_id > 0)
                                                <form method="POST" action="{{ route('seo-panel.add-tag') }}">
                                                    @csrf
                                                    <label> Add a new tag</label>
                                                    <br />
                                                    <lable>
                                                        <input type="radio" name="tag" value="link"> Link
                                                    </lable>
                                                    <br />
                                                    <lable>
                                                        <input type="radio" name="tag" value="meta"> Meta
                                                    </lable>
                                                    <br />
                                                    <lable>
                                                        <input type="radio" name="tag" value="script"> Script
                                                    </lable>
                                                    <br />
                                                    <lable>
                                                        <input type="radio" name="tag" value="title"> Title
                                                    </lable>
                                                    @error('tag')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                    <br />
                                                    <input type="hidden" name="page_id" value="{{ $page_id }}">
                                                    <br />
                                                    <button type="submit" class="btn btn-primary btn-sm">Add Tag</button>
                                                </form>
                                            @endif
                                        </div>

                                        <div class="col-md-12">
                                            <table class="table">
                                                <thead>
                                                    <th> Tag Name </th>
                                                    <th> Attributes </th>
                                                    <th> Add Attributes </th>
                                                    <th>
                                                        Preview
                                                    </th>
                                                    <th>
                                                        Delete
                                                    </th>
                                                </thead>

                                                <tbody>
                                                    @if ($meta_data)
                                                        @foreach ($meta_data as $meta)
                                                            <tr>
                                                                <td> {{ $meta->tag_name }} </td>
                                                                <td>
                                                                    @if ($meta->attributes)
                                                                        @foreach ($meta->attributes as $attribute)
                                                                            <div
                                                                                style="border: 1px solid rgb(213, 213, 213); padding: 2px; display: flex; justify-content: space-between; align-items: center">
                                                                                <div>
                                                                                    @if($meta->tag_name == 'title')
                                                                                    Content: {{ $attribute->content }}
                                                                                    @else
                                                                                    {{ $attribute->field }} :
                                                                                    {{ $attribute->value }}
                                                                                    @endif
                                                                                    
                                                                                </div>
                                                                                <div style="color: red">
                                                                                    <form method="POST"
                                                                                        action="{{ route('seo-panel.delete-attribute') }}">
                                                                                        @csrf
                                                                                        <input type="hidden"
                                                                                            name="attribute_id"
                                                                                            value="{{ $attribute->id }}" />
                                                                                        <button type="submit"
                                                                                            class="btn btn-danger btn-sm">
                                                                                            <i class="fa fa-trash"></i>
                                                                                        </button>

                                                                                    </form>
                                                                                </div>

                                                                            </div>
                                                                        @endforeach
                                                                    @endif

                                                                </td>
                                                                <td>
                                                                    <form method="POST"
                                                                        action="{{ route('seo-panel.add-attribute') }}">
                                                                        @csrf
                                                                        <input type="hidden" name="s_e_o_id"
                                                                            value="{{ $meta->id }}" />
                                                                        @if ($meta->tag_name == 'title')
                                                                            <input type="text" name="content"
                                                                                style="margin-bottom: 2px"
                                                                                placeholder="Content" />
                                                                            <br />
                                                                            @if(count($meta->attributes))
                                                                            <input type="submit" value="Update" />
                                                                            @else
                                                                            <input type="submit" value="Add" />
                                                                            @endif
                                                                        @else
                                                                            <input type="text" name="field"
                                                                                style="margin-bottom: 2px"
                                                                                placeholder="Field" />
                                                                            <br />

                                                                            <input type="text" name="value"
                                                                                style="margin-bottom: 2px"
                                                                                placeholder="Value" />
                                                                            <br />

                                                                            <input type="submit" value="Add" />
                                                                        @endif

                                                                        
                                                                    </form>
                                                                </td>

                                                                <td>
                                                                    @if ($meta->tag_name == 'title')
                                                                        @if(count($meta->attributes))
                                                                        {{ "<$meta->tag_name>"}} {{$meta->attributes->first()->content}} {{"</$meta->tag_name>" }}
                                                                        @else
                                                                        {{ "<$meta->tag_name>"}}  {{"</$meta->tag_name>" }}
                                                                        @endif
                                                                    @else
                                                                        {{ "<$meta->tag_name" }}
                                                                        @if ($meta->attributes)
                                                                            @foreach ($meta->attributes as $attribute1)
                                                                                {{ $attribute1->field }} = "{{ $attribute1->value }}"
                                                                            @endforeach
                                                                        @endif
                                                                        {{ '/>' }}
                                                                    @endif

                                                                </td>

                                                                <td>
                                                                    <form class="tag_delete" method="POST"
                                                                        action="{{ route('seo-panel.delete-tag') }}">
                                                                        @csrf
                                                                        <input type="hidden" name="s_e_o_id"
                                                                            value="{{ $meta->id }}" />
                                                                        <button type="submit"
                                                                            class="btn btn-danger btn-sm"> <i
                                                                                class="fa fa-trash"></i> </button>

                                                                    </form>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    @endif

                                                </tbody>

                                            </table>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

        </div>
    </div>
@endsection
