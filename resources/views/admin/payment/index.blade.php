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
        <strong><i class='fa fa-money'></i> &nbsp;Proof of Payment</strong>
    </div>

    <div class="panel-body" style="padding:20px 0px 0px 0px">
        <div class="box-body" id="parent-form-area">

            <div class='table-responsive'>
                <table id='table-detail' class='table table-striped'>

                    <tr>
                        <td>Uploaded at</td>
                        <td>{{ $row->created_at ?: '-' }}</td>
                    </tr>

                    <tr>
                        <td>Proof of Payment</td>
                        <td><a data-lightbox='roadtrip' title='Proof Payment: {{ $transaction->code }}' href='{{ url($row->proof) }}'><img width='160px' height='160px' src='{{ $row->proof }}'/></a></td>
                    </tr>



                    <tr>
                        <td>Sender Name</td>
                        <td>{{ $row->sender_name ?: '-' }}</td>
                    </tr>



                    <tr>
                        <td>Sender Number</td>
                        <td>{{ $row->sender_number ?: '-' }}</td>
                    </tr>



                    <tr>
                        <td>Status</td>
                        <td>{{ $row->status ?: 'there is not any yet' }}</td>
                    </tr>



                </table>
            </div><!-- /.box-body -->

            <div class="box-footer" style="background: #F5F5F5">

                <div class="form-group">
                    <label class="control-label col-sm-2"></label>
                    <div class="col-sm-10">

                        <a class='btn btn-success' href="{{ CRUDBooster::adminPath('transactions/approve') }}/{{ $transaction->id }}"><i class='fa fa-check'></i> Approve Payment</a>
                        <a class='btn btn-danger' href="{{ CRUDBooster::adminPath('transactions/reject') }}/{{ $transaction->id }}"><i class='fa fa-close'></i> Reject Payment</a>

                    </div>
                </div>


            </div><!-- /.box-footer-->

        </div>
    </div>
</div>
@endsection
