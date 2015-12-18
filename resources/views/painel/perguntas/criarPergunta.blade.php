{!! Form::open(['url' => 'admin/users']) !!}
<div class="row">
    @include('_form', ['submitButton' => 'Create'])
</div>
{!! Form::close() !!}