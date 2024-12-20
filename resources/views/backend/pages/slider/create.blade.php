@extends("backend.layout.app")

@section("content")
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Slider {{empty($slider) ?'Ekle':'Güncelle'}}</h4>
                @if (session()->get('success'))
                    <div class="alert alert-success">
                        {{session()->get('success')}}
                    </div>
                @endif
                @if ($errors)
                    @foreach ($errors->all() as $error)
                        <div class="alert alert-danger">
                            {{$error}}
                        </div>
                    @endforeach
                @endif
                @if(!empty($slider->id))
                    @php
                    $routeLink=route('panel.slider.update',$slider->id)
                        @endphp
                @else
                    @php
                        $routeLink=route('panel.slider.store')
                    @endphp
                @endif

                <form action="{{$routeLink}}" class="forms-sample" method="POST" enctype="multipart/form-data">
                    @csrf
                    @if(!empty($slider->id))
                            @method('PUT')
                    @else
                    @endif
                    <div class="form-group">
                        <label for="name">Başlık</label>
                        <input name="name" type="text" class="form-control" id="name" value="{{$slider->name??''}}" placeholder="Slider Başlık">
                    </div>
                    <div class="form-group">
                        <label for="content">Slogan</label>
                        <textarea rows="3" name="content" class="form-control" id="content" {{$slider->content??''}} placeholder="Slogan">{{ $slider->content??'' }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="link">Link</label>
                        <input name="link" type="text" class="form-control" id="link" value="{{$slider->link??''}}" placeholder="Link">
                    </div>
                    <div class="form-group">
                        <div class="input-group col-xs-12">
                            <img src="{{asset($slider->image??"")}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Dosya Yükle</label>
                        <input type="file" name="image" class="file-upload-default">
                        <div class="input-group col-xs-12">
                            <input type="text" class="form-control file-upload-info" disabled placeholder="Fotoğraf Seç">
                            <span class="input-group-append">
                          <button class="file-upload-browse btn btn-primary" type="button">Seç</button>
                        </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="status">Durum</label>
                        @php
                        $status= $slider->status??"";
 @endphp
                        <select name="status" id="status" class="form-control">
                            <option value="0" {{$status=='0'? 'selected': ''}}>Pasif</option>
                            <option value="1" {{$status=='1'? 'selected': ''}}>Aktif</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary mr-2">Gönder</button>
                    <button class="btn btn-light">İptal</button>
                </form>
            </div>
        </div>
    </div>
@endsection
