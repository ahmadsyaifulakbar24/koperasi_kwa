axios.get('api/pinjaman/get/' + id).then((response) => {
    // console.log(response)
    let value = response.data.data
    $('#besar_pinjaman').html(rupiah(value.besar_pinjaman))
    $('#tenor').html(value.tenor + ' Bulan')
    let sisa_angsuran = value.sisa_bayar
    if (value.sisa_bayar == null || value.sisa_bayar <= 0) {
    	sisa_angsuran = 'Lunas'
	} else {
    	sisa_angsuran = rupiah(value.sisa_bayar)
    	$('.paid-off').removeClass('hide')
	}
    $('#sisa_angsuran').html(sisa_angsuran)
}).catch((err) => {
    // console.log(err.response)
})

let total_bayar = 0

axios.get('api/pinjaman/lunas_pinjaman/' + id).then((response) => {
    // console.log(response)
    let value = response.data.data
    $('#hutang_pokok').html(rupiah(value.hutang_pokok))
    $('#bunga').html(rupiah(value.bunga))
    $('#total_bayar').html(rupiah(value.total_bayar))
    total_bayar = value.total_bayar
}).catch((err) => {
    // console.log(err.response)
})

get_data()

function get_data(page, day, month, year, approved) {
    $('#table').empty()
    $('#pagination').addClass('hide')
    $('#loading_table').show()
    axios.get('api/pinjaman/get/' + id, {
        params: {
        	page: page,
            day: day,
            month: month,
            year: year,
            approved: approved,
            type: 'pinjaman'
        }
    }).then((response) => {
        // console.log(response.data.data)
        let value = response.data
        if (value.data.transaction != '') {
            let append, bukti_pembayaran, approved_date, month, year
            $.each(value.data.transaction, function(index, value) {
                value.approved_date == null ? approved_date = '' : approved_date = tanggal(value.approved_date)
                if (value.bukti_pembayaran == null) {
                    bukti_pembayaran = `<a href="${root}confirm/pinjaman/${value.user_id}/${id}/${value.id}" class="btn btn-sm btn-primary px-4">Konfirmasi</a>`
                } else {
                    bukti_pembayaran = `<a href="${value.bukti_pembayaran}" class="btn btn-sm btn-outline-primary" target="_blank">Bukti pembayaran</a>`
                }
                month = value.created_at.substr(5, 2)
			    month.length == 2 ? month = month.substr(1, 1) : ''
			    year = value.created_at.substr(0, 4)
                append = `<tr>
	        		<td class="text-center pl-4">${index + 1}.</td>
	        		<td class="text-truncate">${value.title}</td>
	        		<td class="text-truncate">${bulan_tahun(month, year)}</td>
	        		<td class="text-truncate">${rupiah(value.sub_transaction[0].besaran)}</td>
	        		<td class="text-truncate">${bukti_pembayaran}</td>
	        		<td class="text-truncate pr-4">${approved_date}</td>
	        	</tr>`
                $('#table').append(append)
            })
            // pagination(value.links, value.meta, value.meta.path)
        } else {
            $('#table').html(`<tr>
            	<td colspan="10" class="text-center pb-4">
            		<i class="mdi mdi-36px mdi-close-circle-outline d-block pr-0"></i>
            		<span class="text-secondary">Belum ada data</span>
            	</td>
            </tr>`)
        }
        $('#loading_table').hide()
    }).catch((err) => {
        // console.log(err)
    })
}

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

$('#form').submit(function(e) {
    e.preventDefault()
    $('#submit').attr('disabled', true)
    let formData = new FormData()
    formData.append('bukti_pembayaran', picture)
    formData.append('total_bayar', total_bayar)
    axios.post('api/pinjaman/create_lunas_pinjaman/' + id, formData).then((response) => {
        console.log(response)
        $('#submit').attr('disabled', false)
        $('#modal-paid-off').modal('hide')
        // $('.paid-off').remove()
        get_data()
    }).catch((xhr) => {
        let err = xhr.response.data.errors
        // console.clear()
        // console.log(err)
        $('#submit').attr('disabled', false)
        if (err.bukti_pembayaran) {
            $('#picture').addClass('is-invalid')
            $('#picture-feedback').html('Masukkan bukti pembayaran')
        }
    })
})
