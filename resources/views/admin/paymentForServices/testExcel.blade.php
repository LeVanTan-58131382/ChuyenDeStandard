@extends('admin.home')

@section('content')
<div class="bill">
    <form action="{{ route('admin.postimport')}}" method="post" enctype="multipart/form-data">
    @csrf
    Chọn file bạn muốn import
    <br><br>
    <input type="file" name="file" id="file">
    <br><br>
    <button type="submit">Upload File</button>
    <br><br><br>
    <a href="{{ url('/sample/month5.xlsx')}}">Download File</a>
    </form>
</div>
@endsection
<style>
    .bill{
        position: relative;
        left: 0%;
        top: 0%;
        width: 100%;
        height: 2000px;
        border: 1px solid black;
        border-radius: 5px;
        padding: 30px;
    }
</style>