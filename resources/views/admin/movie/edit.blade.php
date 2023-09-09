@extends('Admin.layout.main')

@section('title')
Sửa phim {{$movie->name}}
@endsection

@section('content')

<h1 class="h3 mb-2 text-gray-800  border-bottom bg-white mb-4"><i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>Sửa phim "{{$movie->name}}"<a style="float:right;" href="{{route('admin.movies')}}" class="btn btn-danger col-1"><i class="fas fa-sharp fa-solid fa-arrow-left"></i> Quay lại</a></h1>
<div class="card shadow mb-4">
    <!-- Account details card-->
    <div class="card mb-4">
        <form action="{{route('admin.movies_update',['id'=>$movie->id])}}" method="post"  enctype="multipart/form-data">
        @csrf
        <div class="card-header text-primary font-weight-bold">Sửa phim "{{$movie->name}}"</div>
          <div class="card-body">
                <div class="mb-3">
                    <label class="small mb-1 font-weight-bold text-primary text-lg">Tên phim</label>
                    <input required name="name" class="form-control" type="text" placeholder="Nhập tên sản phẩm" value="{{$movie->name}}">
                </div>
                <img src="{{asset('/admin/assets/img/movies/'.$movie->image)}}" id='imgPreview' alt="">
                <div class="mb-3">
                    <label class="small mb-1 font-weight-bold text-primary text-lg">Poster</label>
                    <input name="image" class="form-control col-3" id="photo" type="file" oninput='UpdatePreview()'>
                </div>
                <div class="mb-3">
                    <label class="small mb-1 font-weight-bold text-primary text-lg">Link trailer</label>
                    <input required name="trailer" class="form-control" type="text" placeholder="Dán link trailer" value="{{$movie->trailer}}">
                </div>

                <div class="mb-3">
                    <label class="small mb-1 font-weight-bold text-primary text-lg">Danh mục: </label>
                    <select required class="form-select" name="id_category">
                        <option value="">--Chọn--</option>
                        @foreach($categories as $value)
                        <option {{$value->id==$movie->id_category? 'selected':''}} value="{{$value->id}}">{{$value->name}}</option>
                        @endforeach

                    </select>
                    <label style="margin-left: 5%" class="small mb-1 font-weight-bold text-primary text-lg">Giới hạn độ tuổi: </label>
                    <select id="sale" name="age_limit">
                        <option value="0" {{ $movie->age_limit == 0 ? 'selected' : '' }}>Không</option>
                        <option value="12" {{ $movie->age_limit == 12 ? 'selected' : '' }}>12+</option>
                        <option value="15" {{ $movie->age_limit == 15 ? 'selected' : '' }}>15+</option>
                        <option value="18" {{ $movie->age_limit == 18 ? 'selected' : '' }}>18+</option>
                    </select>
                </div>
                <div class="mb-3 row">
                    <div class="col-3">
                        <label class="small mb-1 font-weight-bold text-primary text-lg">Chọn ngày khởi chiếu: </label>
                        <input required name="start_date" class="form-control" type="date" value="{{$movie->start_date}}">
                    </div>
                    <div class="col-3">
                        <label class="small mb-1 font-weight-bold text-primary text-lg">Thời lượng: (phút)</label>
                        <input id="total_payment" name="time" class="form-control" type="number" value="{{$movie->time}}">
                    </div>
                </div>
                <label class="small mb-1 font-weight-bold text-primary text-lg" for="inputUsername">Mô tả</label>
                <div class="mb-3">
                    <textarea name="description" id="editor">{{$movie->description}}</textarea>
                </div>
                <button class="btn btn-warning" type="submit">Sửa</button>

            </div>
    </div>

     </form>

</div>

<!-- ck editor -->
    <script src="{{asset('ckeditor5/ckeditor.js')}}"></script>
<script>
    ClassicEditor
        .create(document.querySelector('#editor'))
        .catch(error => {
            console.error(error);
        });
</script>
<!-- xử lý pre hình ảnh -->
<script type="text/javascript">
    $(document).ready(function() {
        $('#photo').change(function() {
            const file = this.files[0];
            console.log(file);
            if (file) {
                let reader = new FileReader();
                reader.onload = function(event) {
                    console.log(event.target.result);
                    $('#imgPreview').attr('src', event.target.result);
                }
                reader.readAsDataURL(file);
            }
        });
    });
</script>
@endsection