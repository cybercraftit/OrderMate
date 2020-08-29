<div class="row">
    <div class="col-sm-12">
        <div class="card mb-3">
            <div class="card-body">
                <div class="form-group {{ $errors->has('first_name') ? 'has-error' : ''}}">
                    <label for="name" class="control-label">@lang('ordermate::main.First Name')</label>
                    <input class="form-control" name="first_name" type="text" id="first_name" value="{{ isset($item->first_name) ? $item->first_name : ''}}" required>
                    {!! $errors->first('first_name', '<p class="help-block">:message</p>') !!}
                </div>
                <div class="form-group {{ $errors->has('last_name') ? 'has-error' : ''}}">
                    <label for="name" class="control-label">@lang('ordermate::main.Last Name')</label>
                    <input class="form-control" name="last_name" type="text" id="last_name" value="{{ isset($item->last_name) ? $item->last_name : ''}}" required>
                    {!! $errors->first('last_name', '<p class="help-block">:message</p>') !!}
                </div>
                <div class="form-group {{ $errors->has('phone') ? 'has-error' : ''}}">
                    <label for="name" class="control-label">@lang('ordermate::main.Phone')</label>
                    <input class="form-control" name="phone" type="text" id="phone" value="{{ isset($item->phone) ? $item->phone : ''}}" required>
                    {!! $errors->first('phone', '<p class="help-block">:message</p>') !!}
                </div>
                <div class="form-group {{ $errors->has('email') ? 'has-error' : ''}}">
                    <label for="name" class="control-label">@lang('ordermate::main.Email')</label>
                    <input class="form-control" name="email" type="email" id="email" value="{{ isset($item->email) ? $item->email : ''}}" required>
                    {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
                </div>
                <div class="form-group {{ $errors->has('address') ? 'has-error' : ''}}">
                    <label for="address" class="control-label">@lang('ordermate::main.Address')</label>
                    <textarea class="form-control" rows="5" name="address" type="textarea" id="address" >{{ isset($item->address) ? $item->address : ''}}</textarea>
                    {!! $errors->first('address', '<p class="help-block">:message</p>') !!}
                </div>
                <div class="form-group">
                    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Update' : 'Create' }}">
                </div>
            </div>
        </div>
    </div>
</div>
