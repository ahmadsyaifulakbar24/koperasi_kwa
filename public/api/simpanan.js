let filter_by = '',
    approved = '',
    day = '',
    month = '',
    year = ''

axios.get('api/user/' + session.user_id).then((response) => {
	let value = response.data.data
    // console.log(value)
    let simpanan = value.user_koperasi_detail.saldo_simpanan
    $('.simpanan').html(rupiah(simpanan))
}).catch((err) => {
    // console.log(err)
    customAlert('warning', err)
})

get_data()

function get_data(page, day, month, year, approved) {
    $('#table').empty()
    $('#pagination').addClass('hide')
    $('#loading_table').show()
    axios.get('api/transaction/filter/' + session.user_id, {
        params: {
        	page: page,
            day: day,
            month: month,
            year: year,
            approved: approved,
            type: 'simpanan'
        }
    }).then((response) => {
        // console.log(response.data)
        let value = response.data
        if (value.data != '') {
            let append, sub_append, besaran, bukti_pembayaran, approved_date
            $.each(value.data, function(index, value) {
                value.approved_date == null ? approved_date = '' : approved_date = tanggal(value.approved_date)
                if (value.bukti_pembayaran == null) {
                    bukti_pembayaran = `<a href="${root}confirm/simpanan/${value.user_id}/${value.id}" class="btn btn-sm btn-primary px-4">Upload</a>`
                } else {
                    bukti_pembayaran = `<a href="${value.bukti_pembayaran}" class="btn btn-sm btn-outline-primary" target="_blank">Bukti pembayaran</a>`
                }
                sub_append = ''
                $.each(value.sub_transaction, function(index, value) {
                    besaran = rupiah(value.besaran)
                    if (value.type == 'simpanan_pokok') {
                        sub_append += `<li>Simpanan Pokok: ${besaran}</li>`
                    } else if (value.type == 'simpanan_wajib') {
                        sub_append += `<li>Simpanan Wajib: ${besaran}</li>`
                    } else if (value.type == 'simpanan_sukarela') {
                        sub_append += `<li>Simpanan Sukarela: ${besaran}</li>`
                    }
                })
                append = `<tr>
	        		<td class="text-center pl-4">${index + 1}.</td>
	        		<td class="text-truncate">${value.title}</td>
	        		<td>${value.message}</td>
	        		<td class="text-truncate"><ul class="pl-3 mb-0">${sub_append}</ul></td>
	        		<td class="text-truncate">${bukti_pembayaran}</td>
	        		<td class="text-truncate pr-4">${approved_date}</td>
	        	</tr>`
                $('#table').append(append)
            })
            pagination(value.links, value.meta, value.meta.path)
        } else {
            $('#table').html(`<tr>
            	<td colspan="10" class="text-center pb-4">
            		<i class="mdi mdi-36px mdi-close-circle-outline d-block pr-0"></i>
            		<span class="text-secondary">Belum ada tagihan</span>
            	</td>
            </tr>`)
        }
        $('#loading_table').hide()
    }).catch((err) => {
        // console.log(err)
        customAlert('warning', err)
    })
}

currentDate()

$('#filter_by').change(function() {
    let value = $(this).val()
    $('#date').parents('.form-group').addClass('none')
    $('#month').parents('.form-group').addClass('none')
    $('#year').parents('.form-group').addClass('none')
    if (value != '') $('#' + value).parents('.form-group').removeClass('none')
})

$('#filter').click(function() {
	filter_by = $('#filter_by').val()
	approved = $('input[type=radio][name=approved]:checked').val()
	day = '',
	month = '',
	year = ''
    if (filter_by == 'date') {
        day = $('#date').val().substr(8, 2)
        month = $('#date').val().substr(5, 2)
        year = $('#date').val().substr(0, 4)
    } else if (filter_by == 'month') {
        month = $('#month').val().substr(5, 2)
        year = $('#month').val().substr(0, 4)
    } else if (filter_by == 'year') {
        year = $('#year').val()
    }
    get_data(1, day, month, year, approved)
    $('#modal-filter').modal('hide')
})
