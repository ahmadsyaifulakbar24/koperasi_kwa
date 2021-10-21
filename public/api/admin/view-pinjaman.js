axios.get('api/user/' + user).then((response) => {
    let value = response.data.data
    // console.log(value)
    $('title').prepend('Pinjaman ' + value.name)
    $('.user').prepend(String(value.name).toLowerCase())
    $('#name').attr('href', `${root}admin/pinjaman/${value.id}`)
}).catch((err) => {
    // console.log(err.response)
})

get_pinjaman()

function get_pinjaman() {
    axios.get('api/pinjaman/get/' + id).then((response) => {
        let value = response.data.data
        // console.log(value)
        if (value.user_id == user) {
            $('#besar_pinjaman').html(rupiah(value.besar_pinjaman))
            $('#tenor').html(value.tenor + ' Bulan')
            let sisa_angsuran = value.sisa_bayar
            value.sisa_bayar == null || value.sisa_bayar <= 0 ? sisa_angsuran = 'Lunas' : sisa_angsuran = rupiah(value.sisa_bayar)
            $('#sisa_angsuran').html(sisa_angsuran)
            if (value.status == 'approved') {
                if (value.sisa_bayar == null || value.sisa_bayar <= 0) get_lunas()
            }
            if (value.contract == null) {
                $('#kontrak_pinjaman').parents('.hide').remove()
            } else {
                $('#kontrak_pinjaman').parents('.hide').removeClass('hide')
                $('#kontrak_pinjaman').html(`<a href="${value.contract}" target="_blank">${value.contract.split('/').pop()}</a>`)
            }
            get_data()
        } else {
            window.history.back()
        }
    }).catch((err) => {
        // console.log(err.response)
    })
}

function get_lunas() {
    axios.patch('api/pinjaman/paid_off_pinjaman/' + id).then((response) => {
        let value = response.data.data
        // console.log(value)
    }).catch((err) => {
        // console.log(err.response)
    })
}

function get_data() {
    $('#table').empty()
    $('#pagination').addClass('hide')
    $('#loading_table').show()
    axios.get('api/pinjaman/get/' + id).then((response) => {
        // console.log(response.data.data)
        let value = response.data
        if (value.data.transaction != '') {
            $.each(value.data.transaction, function(index, value) {
                value.approved_date == null ? approved_date = '' : approved_date = tanggal(value.approved_date)
                if (value.approved_date == null) {
                    status = 'Belum Lunas'
                    action = `<div class="btn btn-sm btn-primary approve px-3">Lunasi</div>`
                } else {
                    status = 'Lunas'
                    action = ''
                }
                if (value.bukti_pembayaran == null) {
                    bukti_pembayaran = `<div class="btn btn-sm btn-outline-primary upload px-3">Upload</a>`
                } else {
                    bukti_pembayaran = `<a href="${value.bukti_pembayaran}" target="_blank">${value.bukti_pembayaran.split('/').pop()}</a>`
                }
                month = value.created_at.substr(5, 2)
                year = value.created_at.substr(0, 4)
                append = `<tr data-id="${value.id}" data-month="${bulan_tahun(month, year)}" data-transaction="${rupiah(value.sub_transaction[0].besaran)}">
	        		<td class="text-center">${index + 1}.</td>
	        		<!--<td class="text-truncate">${value.title}</td>-->
	        		<td class="text-truncate">${bulan_tahun(month, year)}</td>
	        		<td class="text-truncate">${rupiah(value.sub_transaction[0].besaran)}</td>
	        		<td class="text-truncate" id="status${value.id}">${status}</td>
	        		<td class="text-truncate" id="approved_date${value.id}">${approved_date}</td>
	        		<td class="text-truncate" id="bukti_pembayaran${value.id}">${bukti_pembayaran}</td>
	        		<td class="text-truncate" id="approve${value.id}">${action}</td>
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

$(document).on('click', '.approve', function() {
    let id = $(this).parents('tr').data('id')
    let month = $(this).parents('tr').data('month')
    let total_sub_transaction = $(this).parents('tr').data('transaction')
    $('#modal-approve').modal('show')
    $('#month').html(month)
    $('#total_sub_transaction').html(total_sub_transaction)
    $('#approve').data('id', id)
})

$('#approve').click(function() {
    let id = $(this).data('id')
    $(this).attr('disabled', true)
    axios.patch('api/transaction/accept_transaction/' + id).then((response) => {
        // console.log(response.data.data)
        let value = response.data.data
        let date = value.approved_date
        let tgl = tanggal(date.substr(0, 10))
        $('#approved_date' + id).html(tgl)
	    $('#status' + id).html('Lunas')
        $('#approve' + id).empty()
        $('#modal-approve').modal('hide')
        $(this).attr('disabled', false)
	    customAlert('success', 'Tagihan berhasil dilunasi')
        get_pinjaman()
    }).catch((err) => {
        // console.log(err)
        $('#modal-approve').modal('hide')
        $(this).attr('disabled', false)
        customAlert('warning', err)
    })
})
