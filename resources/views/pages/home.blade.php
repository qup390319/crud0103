@extends('layouts.master')
@section('content')


    <div class="container p-3">
        <div style="margin-bottom: 10px">
            <button type="button" class="btn btn-outline-success" id="create" data-bs-toggle="modal"
                    data-bs-target="#createModal">新增一篇文章
            </button>
{{--            <button  type="button" class="btn btn-outline-info" id="download" onclick="download()">下載為 .xslx</button>--}}
        </div>
        <form class="d-flex" style="margin-bottom: 10px"  action="{{route('index')}}">
            <input class="form-control me-2" type="search" name="search_content" id="searchwords" placeholder="Search" aria-label="Search" >
            <button class="btn btn-outline-success" type="submit" id="search" >Search</button>
        </form>
        <table class="table table-dark table-striped">
            <thead>
            <tr>
                <td>標題</td>
                <td>內容</td>
                <td>功能</td>
            </tr>
            </thead>
            <tbody>

            @foreach($data as $row)
                <tr>
                    <td class="col-sm-3">{{$row->title}}</td>
                    <td class="col-sm-3">{{$row->content}}</td>
                    <td class="col-sm-3">
                        <button class="btn btn-outline-success get_data" name="get_data" value="{{$row->storyid}}"
                                data-bs-toggle="modal" data-bs-target="#editModal">修改
                        </button>
                        <button class="btn btn-outline-danger" onclick=delete_data({{$row->storyid}})>刪除</button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <!-- 新增文章 Modal -->
        <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">新增文章</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">標題</span>
                            <input type="text" class="form-control" placeholder="Username" aria-label="Username"
                                   aria-describedby="basic-addon1" id="title_story">
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label">內容</label>
                            {{--                            <input type="text" class="form-control" placeholder="Username" aria-label="Username"--}}
                            {{--                                   aria-describedby="basic-addon1" id="content_story">--}}
                            <textarea class="form-control" rows="10"
                                      id="content_story" name="content_story"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">取消</button>
                        <button type="button" class="btn btn-primary" id="btn_create_story">新增文章</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- 編輯文章 Modal -->
        <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <input type="hidden" class="form-control" placeholder="Username" aria-label="Username"
                               aria-describedby="basic-addon1" name="id" id="storyid" value="">
                        <h5 class="modal-title" id="exampleModalLabel">編輯文章</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">標題</span>
                            <input type="text" class="form-control" placeholder="Username" aria-label="Username"
                                   aria-describedby="basic-addon1" id="get_title">
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label">內容</label>
                            <textarea class="form-control" rows="10"
                                      id="get_content"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">取消</button>
                        <button type="button" class="btn btn-primary" id="btn_edit_story">完成編輯</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <script>
        //新增文章
        $("#btn_create_story").click(function () {
            $.ajax({
                url: '{{route('create_story')}}',
                method: 'post',
                data: {
                    _token: "{{ csrf_token() }}",
                    title_story: $("#title_story").val(),
                    content_story: $("#content_story").val(),
                },
                success: function (res) {
                    if (res == "success") {
                        window.alert("新增成功");
                    }
                    ;
                    $("#title_story").val('')
                    $("#content_story").val('')
                    window.location.reload();
                },
                error: function (err) {
                    window.alert('新增失敗');
                }
            })
        })

        //查詢
        $("#search").click(function () {
            $.ajax({
                url: '{{route('index')}}',
                method: 'get',
                data: {
                    _token: "{{ csrf_token() }}",
                    words: $("#searchwords").val(),
                },
                success: function (res) {
                    // window.location.reload();
                },
                error: function (err) {
                    window.alert('連線失敗');
                }
            })
        })

        //刪除文章
        function delete_data(id) {
            if (confirm('確定要刪除嗎') == true) {
                window.location.href = "{{route('delete_data')}}" + "?id=" + id;
                window.alert('刪除成功');
            } else {
                //
            }
        }

        //編輯時獲取資料
        $('.get_data').click(function () {
            let id = $(this).val();
            // 方法1
            // let id = $(this).attr('value');
            // 方法2
            $.ajax({
                url: '{{route('get_data')}}',
                method: 'get',
                data: {
                    _token: "{{ csrf_token() }}",
                    id: id,
                    // get_title: $("#get_title").val(),
                    // get_content: $("#get_content").val(),
                },
                success: function (res) {
                    console.log(res[0]);
                    $("#get_title").val(res[0]['title'])
                    $("#get_content").val(res[0]['content'])
                    $("#storyid").val(res[0]['storyid'])
                },
                error: function (err) {
                    window.alert('連線失敗');
                }
            })
        })

        //編輯資料
        $('#btn_edit_story').click(function () {
            $.ajax({
                url: '{{route('edit_data')}}',
                method: 'post',
                data: {
                    _token: "{{ csrf_token() }}",
                    id: $('#storyid').val(),
                    get_title: $("#get_title").val(),
                    get_content: $("#get_content").val(),
                },
                success: function (res) {
                    window.alert('儲存成功')
                    window.location.reload();
                },
                error: function (err) {
                    window.alert('連線失敗');
                }
            })
        })

        {{--function download() {--}}
        {{--    window.location.href = "{{route('export')}}";--}}
        {{--}--}}
    </script>
@endsection
