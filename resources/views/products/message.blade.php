@if(count($errors) > 0)
    <div class="alert alert-danger">
        @foreach ($errors->all() as $error)
            <li>{{$error}}</li>
        @endforeach
    </div>
@endif

<style>
li {
    font-weight:bolder;
    letter-spacing:1px;
    font-size:13px;
}
</style>
