var dataId = '';
(function ($) {
	"use strict";
	$('.selectgroup-input').on('click', function (e) {

		var $box = $(this);
		if ($box.hasClass('radiotypecheckbox')) {
			if ($box.is(":checked")) {
				// the name of the box is retrieved using the .attr() method
				// as it is assumed and expected to be immutable
				var group = "input:checkbox[name='" + $box.attr("name") + "']";
				// the checked state of the group/box on the other hand will change
				// and the current value is retrieved using .prop() method
				$(group).prop("checked", false);
				$box.prop("checked", true);
			} else {
				$box.prop("checked", false);
			}
		}
		let total = 0;

		$('.selectgroup-input:checked').each(function () {
			var id = $(this).attr('data-productid');
			var price = $(this).attr('data-price'); // price of item selected
			var price = parseFloat(price);
			console.log("price0: " + price);

			total = parseFloat(price + total);
			console.log("total0: " + total);


			var mainprice = $(this).attr('data-mainprice'); // initial price of product
			var mainprice = parseFloat(mainprice);
			console.log("mainpriceOne0: " + mainprice);


			var price_type = $(this).attr('data-amounttype');
			if (price_type == 0) {
				var percent = mainprice * total / 100;
				var total_price = mainprice + percent;
			}
			else {
				var total_price = mainprice + total;
			}

			$('#price' + id).html('Rs.' + total_price + '.00');
		});
	});
	$(".basicform").on('submit', function (e) {
		e.preventDefault();
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});
		var basicbtnhtml = $('#submitbtn' + dataId).html();
		$.ajax({
			type: 'POST',
			url: this.action,
			data: new FormData(this),
			dataType: 'json',
			contentType: false,
			cache: false,
			processData: false,
			beforeSend: function () {

				$('#submitbtn' + dataId).html('<div class="spinner-border text-white spinner-border-sm" role="status"> <span class="sr-only">Loading...</span></div>');
				$('#submitbtn' + dataId).attr('disabled', '')

			},

			success: function (response) {
				$('#submitbtn' + dataId).removeAttr('disabled')
				Sweet('success', 'Cart Item Added');
				$('#submitbtn' + dataId).html(basicbtnhtml);

				$('#cart_count').html(response.count);
				render_cart_item(response.items);
			},
			error: function (xhr, status, error) {
				$('#submitbtn' + dataId).html(basicbtnhtml);

				$.each(xhr.responseJSON.errors, function (key, item) {
					Sweet('error', item)
					$("#errors").html("<li class='text-danger'>" + item + "</li>")
				});

			}
		})


	});

	$(".cartform").on('submit', function (e) {
		e.preventDefault();
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});

		$.ajax({
			type: 'get',
			url: this.action,
			data: new FormData(this),
			dataType: 'json',


			success: function (response) {

				Sweet('success', 'Cart Item Added');


				$('#cart_count').html(response.count);
				render_cart_item(response.items);
			},

		})
	});

	// $('.selectgroup-input').on('click', function (e) {
	// 	console.log("insirde");
	// 	let thisRadio = $(this);
	// 	if ($(this).is(":checked")) {
	// 		console.log("was checked ");

	// 		thisRadio.is("checked");
	// 		thisRadio.prop('checked', false);
	// 		// subtract this item value from total
	// 		let total_price = 0;
	// 		var id = $(this).attr('data-productid');
	// 		var price = $(this).attr('data-price'); // price of item selected
	// 		var price = parseFloat(price);
	// 		console.log("price1: " + price);

	// 		var mainprice = $(this).attr('data-mainprice'); // initial price of product
	// 		var mainprice = parseFloat(mainprice);
	// 		console.log("mainpriceOne1: " + mainprice);
	// 		total_price = mainprice - price;

	// 		$('#price' + id).html('Rs.' + total_price + '.00');

	// 	} else {
	// 		console.log("was not checked ");

	// 	}
	// });
})(jQuery);

function assignId(id) {
	dataId = id;
}



function render_cart_item(data) {

	var url = $('#removecart_url').val();

	$('.cart-row').remove();
	$.each(data, function (index, row) {

		var r_id = row.rowId;
		var delete_url = url + '/' + r_id;
		var html = '<tr class="cart-row cart' + row.rowId + '">';
		html += '<td><img src="' + row.options.preview + '" height="50"></td>';
		html += '<td>' + row.name + '</td><td>' + row.price + '</td><td>' + row.qty + '</td>';
		html += '<td class="text-right"><a href="' + delete_url + '" class="btn btn-danger btn-sm remove_btn"><i class="fa fa-trash"></i></a></td></tr>';
		$('#cart-content').append(html);
	});
}