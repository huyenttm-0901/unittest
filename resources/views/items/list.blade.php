@extends('layouts.app')

@section('content')
	<div class="container panel-body">
        <form action="{{ route('items.store') }}" method="POST" class="form-horizontal">
            {{ csrf_field() }}
            <div class="form-group">
                <div class="col-sm-6">
                	<div>
                		<label>Name</label>
                    	<input type="text" name="name" id="name" class="form-control">
                	</div>
                	<div>
                		<label>Quantity</label>
                    	<input type="text" name="quantity" id="quantity" class="form-control">
                	</div>
                	<div>
                		<label>Description</label>
                    	<input type="text" name="description" id="description" class="form-control">
                	</div>
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6">
                    <button type="submit" class="btn btn-default">
                        <i class="fa fa-plus"></i> Add Item
                    </button>
                </div>
            </div>
        </form>
    </div>
    <br>
    <div class="container">
    	@if (count($items) > 0)
	        <div class="panel panel-default">
	            <div class="panel-heading text-danger">
	                Current Items
	            </div>

	            <div class="panel-body">
	                <table class="table table-striped task-table">
	                    <thead>
	                        <th>Item</th>
	                        <th>Quantity</th>
	                        <th>Description</th>
	                        <th>&nbsp;</th>
	                    </thead>
	                    <tbody>
	                        @foreach ($items as $item)
	                            <tr>
	                                <td class="table-text">
	                                    <div>{{ $item->name }}</div>
	                                </td>
	                                <td class="table-text">
	                                    <div>{{ $item->quantity }}</div>
	                                </td>
	                                <td class="table-text">
	                                    <div>{{ $item->description }}</div>
	                                </td>

	                                <td class="text-center" width="20%">
	                                	<form action="{{ route('items.destroy', ['item' => $item->id]) }}" method="POST">
								            {{ csrf_field() }}
								            {{ method_field('DELETE') }}

								            <button type="submit" class="btn btn-danger">
								                <i class="fa fa-trash"></i> Delete
								            </button>
								        </form>
	                                </td>
	                            </tr>
	                        @endforeach
	                    </tbody>
	                </table>
	            </div>
	        </div>
    	@endif
    </div>
@endsection
