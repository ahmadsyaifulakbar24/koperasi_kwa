axios.get('api/pinjaman/get/' + id).then((response) => {
    let value = response.data.data
    // console.log(value)
    if (value.user_id == session.user_id) {
        $('#besar_pinjaman').html(rupiah(value.besar_pinjaman))
        $('#tenor').html(value.tenor + ' Bulan')
        let sisa_angsuran = value.sisa_bayar
        if (value.sisa_bayar == null || value.sisa_bayar <= 0) {
            sisa_angsuran = 'Lunas'
            $('.paid-off').remove()
            $('#modal-paid-off').remove()
        } else {
            sisa_angsuran = rupiah(value.sisa_bayar)
            $('.paid-off').removeClass('hide')
        }
        $('#sisa_angsuran').html(sisa_angsuran)
        if (value.contract == null) {
            $('#kontrak_pinjaman').parents('.hide').remove()
        } else {
            $('#kontrak_pinjaman').parents('.hide').removeClass('hide')
            // $('#kontrak_pinjaman').html(`<a href="${value.contract}" class="btn btn-sm btn-outline-primary px-5" target="_blank">Lihat</a>`)
            $('#kontrak_pinjaman').html(`<a href="${value.contract}" target="_blank">${value.contract.split('/').pop()}</a>`)
        }
        get_data()
    } else {
        window.history.back()
    }
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

function get_data() {
    $('#table').empty()
    $('#pagination').addClass('hide')
    $('#loading_table').show()
    axios.get('api/pinjaman/get/' + id).then((response) => {
        // console.log(response.data.data)
        let value = response.data
        if (value.data.transaction != '') {
            $.each(value.data.transaction, function(index, value) {
            	if (value.approved_date == null) {
            		status = 'Belum Lunas'
            	} else {
            		status = 'Lunas'
            	}
                value.approved_date == null ? approved_date = '' : approved_date = tanggal(value.approved_date)
                if (value.bukti_pembayaran == null) {
                    bukti_pembayaran = `<div class="btn btn-sm btn-outline-primary upload px-4">Upload</div>`
                } else {
                    bukti_pembayaran = `<a href="${value.bukti_pembayaran}" target="_blank">${value.bukti_pembayaran.split('/').pop()}</a>`
                }
                // if (value.approved_date)
                month = value.created_at.substr(5, 2)
                year = value.created_at.substr(0, 4)
                append = `<tr data-id="${value.id}">
	        		<td class="text-center">${index + 1}.</td>
	        		<!--<td class="text-truncate">${value.title}</td>-->
	        		<td class="text-truncate">${bulan_tahun(month, year)}</td>
	        		<td class="text-truncate">${rupiah(value.sub_transaction[0].besaran)}</td>
	        		<td class="text-truncate">${status}</td>
	        		<td class="text-truncate">${approved_date}</td>
	        		<td class="text-truncate" id="bukti_pembayaran${value.id}">${bukti_pembayaran}</td>
	        	</tr>`
                $('#table').append(append)
            })
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
    })
}

currentDate()

$(document).on('click', '.upload', function() {
    let id = $(this).parents('tr').data('id')
    $('#file').attr('data-id', id)
    $('#file').val('')
    $('#file').click()
})

$(document).on('change', '#file', function() {
    let id = $(this).data('id')
    let file = $(this).get(0).files[0]
    let formData = new FormData()
    formData.append('bukti_pembayaran', file)
    axios.post('api/transaction/bukti_pembayaran/' + id, formData).then((response) => {
        // console.log(response)
        let value = response.data.data
        $('#bukti_pembayaran' + id).html(`<a href="${value.bukti_pembayaran}" target="_blank">${value.bukti_pembayaran.split('/').pop()}</a>`)
	    customAlert('success', 'Bukti pembayaran berhasil diupload')
    }).catch((xhr) => {
        let err = xhr.response.data.errors
        // console.log(err)
    })
})

$('#form').submit(function(e) {
    e.preventDefault()
    $('#submit').attr('disabled', true)
    let formData = new FormData()
    formData.append('bukti_pembayaran', picture)
    formData.append('total_bayar', total_bayar)
    axios.post('api/pinjaman/create_lunas_pinjaman/' + id, formData).then((response) => {
        // console.log(response)
        $('#submit').attr('disabled', false)
        $('#modal-paid-off').modal('hide')
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
