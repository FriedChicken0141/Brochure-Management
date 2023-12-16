@extends('adminlte::page')

@section('title', 'パンフレット使用再申請')

@section('content_header')
    <h1>使用再申請</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                       @foreach ($errors->all() as $error)
                          <li>{{ $error }}</li>
                       @endforeach
                    </ul>
                </div>
            @endif

            {{-- idは不要。 nameは重要 --}}
            <div class="card card-primary">
                {{-- 入力内容をPOSTで/brochures/applicationへ渡す --}}
                <form method="POST" action="/brochures/consent/update">
                    @csrf

                    {{-- 編集部分 --}}
                    <div class="card-body">
                        <div class="col-md-6">
                            {{-- id --}}
                            <div class="form-group">
                                <input type="hidden" name="id" value="{{$approvals->id}}" class="form-control"  >
                            </div>
                            {{-- 名前 --}}
                            <div class="iabel">
                                <h2>{{$approvals->brochure->name}}</h2>
                            </div>
                            {{-- 使用数 --}}
                            <div class="form-group">
                                <label for="quantity">使用数</label>
                                <input type="number" name="quantity" value="{{$approvals->quantity}}" class="form-control" required>
                            </div>
                            {{-- 詳細 --}}
                            <div class="form-group">
                                <label for="detail">使用用途</label>
                                <input type="text" name="detail" value="{{$approvals->detail}}" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">再申請</button>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="text" class="label-preview">表紙画像プレビュー</label>
                            <div class="preview">
                                <img src="{{ ($approvals->brochure->img_path) }}" alt="表紙" id="image-preview" >
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="copyright">
        @include('footer')
    </div>
@stop

@section('css')
<link rel="stylesheet" href="{{ asset('/css/style-request.css')  }}" >
@stop

@section('js')
<script>
        $('#form-image').on('change', function(){
	var $fr = new FileReader();

	$fr.onload = function(){
		$('#preview').attr('src', $fr.result);
	}
	$fr.readAsDataURL(this.files[0]);
    });

    $(function (){
        $(".btn").click(function(){
            if(confirm("この内容で申請しますか？")){

            }else{

                return false;

            }
        });
    });
</script>
@stop
