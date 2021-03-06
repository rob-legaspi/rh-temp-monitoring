@extends('layouts.layout')

@push('style')
	<link
		rel="stylesheet"
		type="text/css"
		href="{{ $server }}/css/vue-device.css"
	>
@endpush

@section('content')
<div class="content">
    <div class="loader" v-show="show_loader" transition="fade">
        <pulse-loader loading="loading" color="#ffffff" size="50px"></pulse-loader>
    </div>
	<section class="header">
		<device-table
			:devices.sync="devices"
			:input.sync="input"
			:show_loader.sync="show_loader"
			:modal="modal"
			:alert.sync="alert"
		>

		</device-table>
	</section>
    <ul :class="alert.class">
        <li v-for="message in alert.messages" transition="fade">-@{{ message | capitalize }}</li>
    </ul>

	<div class="form">
		<input-text :input.sync="input.ip" name="ip"></input-text>
		<input-text :input.sync="input.location" name="location"></input-text>

		<button class="btn save" @click="updateDevice" v-show="input.id != null">
			Save
			<i class="fa fa-save"></i>
		</button>

		<button class="btn save" @click="storeDevice" v-show="input.id == null">
			Insert
			<i class="fa fa-plus"></i>
		</button>

		<button class="btn cancel">
			Cancel
			<i class="fa fa-remove"></i>
		</button>
	</div>
	<div class="modal"
		v-show="modal.display"
		transition="fade"
		@keyup.esc="modal.display = false"
	>
		<div class="modal-content">
		<div class="modal-header">
			<a href="#" @click.prevent="modal.display = false">
				<span>x</span>
			</a>
		</div>
		<div class="modal-body">
			<h3>Export Failed RH & Temperature Logs:</h3>
			<div class="date-picker">
				<label>From:</label>
				<datepicker :readonly="true"
					format="MM/DD/YYYY"
					:value.sync="date.from"
				>
				</datepicker>
			</div>

			<div class="date-picker">
				<label>To:</label>
				<datepicker :readonly="true"
					format="MM/DD/YYYY"
					:value.sync="date.to"
				>
				</datepicker>
			</div>

			{{-- <select-date :select.sync="select"></select-date> --}}

			<a href="#" @click.prevent="export" class="export-link">
				<div>
					Extract to Excel
					<i class="fa fa-download"></i>
				</div>
			</a>
		</div>
		</div>
	</div>
</div>
@endsection

@push('script')
<script src="{{ $server }}/js/vue-device.js"></script>
@endpush
