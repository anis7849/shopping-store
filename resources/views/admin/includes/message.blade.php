@if($errors->any())

<div class="alert alert-danger">
           <ul>
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
        </ul>
</div>

@endif

@if (session('success'))
<div class="alert alert-success alert-block">
	<button type="button" class="close" data-dismiss="alert">×</button>
        <strong> {{ session('success') }}</strong>
</div>
@endif
