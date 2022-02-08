@extends('crudbooster::admin_template')
@section('content')
@if(g('return_url'))
<p><a href='{{ g('return_url') }}'><i class='fa fa-chevron-circle-left'></i>
        &nbsp; Back To List Data Transaction</a></p>
@endif

<div class="box box-default">
    <div class="box-body table-responsive no-padding">
        <table class='table table-bordered'>
            <tbody>
                <tr class='active'>
                    <td colspan="2"><strong><i class='fa fa-bars'></i> Transaction</strong></td>
                </tr>
                <tr>
                    <td width="25%"><strong>
                            Code
                        </strong></td>
                    <td> {{ $transaction->code }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<div class="panel panel-default">
    <div class="panel-heading">
        <strong><i class='fa fa-road'></i> Shipping</strong>
    </div>

    <div class="panel-body" style="padding:20px 0px 0px 0px">
        <form class='form-horizontal' method='post' id="form" enctype="multipart/form-data"
            action='{{ CRUDBooster::adminPath('transactions/shipping') }}/{{ $transaction->id }}'>
            {{ csrf_field() }}
            <div class="box-body" id="parent-form-area">

                <div class='form-group header-group-0 ' id='form-group-name' style="">
                    <label class='control-label col-sm-2'>
                        Courier
                        <span class='text-danger' title='This field is required'>*</span>
                    </label>

                    <div class="col-sm-10">
                        <input @if($transaction->status == 'Success') readonly @endif type='text' title="Courier" required placeholder='You can only enter the letter only'
                            maxlength=70 class='form-control' name="courier" id="courier" value='{{ $row->courier }}' />

                        <div class="text-danger"></div>
                        <p class='help-block'></p>

                    </div>
                </div>
                <div class='form-group header-group-0 ' id='form-group-name' style="">
                    <label class='control-label col-sm-2'>
                        Resi
                        <span class='text-danger' title='This field is required'>*</span>
                    </label>

                    <div class="col-sm-10">
                        <input @if($transaction->status == 'Success') readonly @endif type='text' title="Resi" required placeholder='You can only enter the letter only'
                            maxlength=70 class='form-control' name="resi" id="resi" value='{{ $row->resi }}' />

                        <div class="text-danger"></div>
                        <p class='help-block'></p>

                    </div>
                </div>
                <div class='form-group header-group-0 ' id='form-group-name' style="">
                    <label class='control-label col-sm-2'>
                        Address
                        <span class='text-danger' title='This field is required'>*</span>
                    </label>

                    <div class="col-sm-10">
                        <textarea @if($transaction->status == 'Success') readonly @endif rows="3" title="Address" name="address" id="address" class='form-control'
                            required>{{ $row->address }}</textarea>
                        <div class="text-danger"></div>
                        <p class='help-block'></p>

                    </div>
                </div>
            </div><!-- /.box-body -->

            @if($transaction->status != 'Success')
            <div class="box-footer" style="background: #F5F5F5">

                <div class="form-group">
                    <label class="control-label col-sm-2"></label>
                    <div class="col-sm-10">

                        <input type="submit" name="submit" value='Save' class='btn btn-success'>

                    </div>
                </div>


            </div><!-- /.box-footer-->
            @endif

        </form>

    </div>
</div>
@endsection
