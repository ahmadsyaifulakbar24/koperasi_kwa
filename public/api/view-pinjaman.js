axios.get('api/pinjaman/get/' + id).then((response) => {
    // console.log(response)
    let value = response.data.data
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

function get_data() {
    $('#table').empty()
    $('#pagination').addClass('hide')
    $('#loading_table').show()
    axios.get('api/pinjaman/get/' + id).then((response) => {
        // console.log(response.data.data)
        let value = response.data
        if (value.data.transaction != '') {
            let append, bukti_pembayaran, approved_date, month, year
            $.each(value.data.transaction, function(index, value) {
                value.approved_date == null ? approved_date = '' : approved_date = tanggal(value.approved_date)
                if (value.bukti_pembayaran == null) {
                    bukti_pembayaran = `<a href="${root}confirm/pinjaman/${value.user_id}/${id}/${value.id}" class="btn btn-sm btn-primary px-4">Upload</a>`
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

currentDate()

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
