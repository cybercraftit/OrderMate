@if( $message = Session::get('flash_message') )
@php
$msg_status = Session::get('msg_status')
@endphp
<div class="container-fluid mt-5" v-if="close_flash != true">
    <div class="row">
        <div class="col-sm-12">
            <div class="alert alert-{{ $msg_status }} alert-block">
                <button type="button" class="close" data-dismiss="alert" @click="close_flash = true">×</button>
                <strong>{{ $message }}</strong>
            </div>
        </div>
    </div>
</div>
@endif