<label class="control-label">{{ trans('syntara::permissions.permissions')}}</label>
<div class="input-group">
    <span class="input-group-addon"><span class="glyphicon glyphicon-plus-sign add-input"></span></span>
    <select class="form-control permissions-select">
        @foreach($permissions as $permission)
        <option value="permission[{{ $permission->getValue() }}]">{{ $permission->getName() }}</option>
        @endforeach
    </select>
</div>
<br>
<div class="input-container">
@if(isset($ownPermissions) && !empty($ownPermissions))
    @foreach($ownPermissions as $permission)
        <div class="form-group">
            <p class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-minus-sign remove-input"></span></span>
                <input readonly type="text" class="form-control" name="permission[{{ $permission->getValue() }}]" value="{{ $permission->getName() }}"/>
            </p>
        </div>
    @endforeach
@endif
</div>
<br>