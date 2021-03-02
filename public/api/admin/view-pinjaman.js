axios.get('api/user/' + user).then((response) => {
    let value = response.data.data
    // console.log(value)
    $('title').prepend('Pinjaman ' + value.name)
    $('.user').prepend(value.name)
    $('#name').attr('href', `${root}admin/pinjaman/${value.id}`)
}).catch((err) => {
    // console.log(err.response)
})

get_pinjaman()

function get_pinjaman() {
    axios.get('api/pinjaman/get/' + id).then((response) => {
        let value = response.data.data
        // console.log(value)
        $('#besar_pinjaman').html(rupiah(value.besar_pinjaman))
        $('#tenor').html(value.tenor + ' Bulan')
        let sisa_angsuran = value.sisa_bayar
        value.sisa_bayar == null || value.sisa_bayar <= 0 ? sisa_angsuran = 'Lunas' : sisa_angsuran = rupiah(value.sisa_bayar)
        $('#sisa_angsuran').html(sisa_angsuran)
        if (value.status == 'approved') {
        	if (value.sisa_bayar == null || value.sisa_bayar <= 0) get_lunas()
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

get_data()

function get_data(page, day, month, year, approved) {
    $('#table').empty()
    $('#pagination').addClass('hide')
    // $('#loading_table').show()
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
            let append, bukti_pembayaran, approved_date, action, month, year
            $.each(value.data.transaction, function(index, value) {
                value.approved_date == null ? approved_date = '' : approved_date = tanggal(value.approved_date)
                if (value.bukti_pembayaran == null) {
                    bukti_pembayaran = `<a href="${root}invoice/pinjaman/${user}/${id}/${value.id}" class="btn btn-sm btn-primary px-4">Konfirmasi</a>`
                    action = ''
                } else {
                    bukti_pembayaran = `<a href="${value.bukti_pembayaran}" class="btn btn-sm btn-outline-primary" target="_blank">Bukti pembayaran</a>`
                    if (value.approved_date == null) {
                        action = `<div class="btn btn-sm btn-primary approve" data-id="${value.id}" data-title="${value.title}">Setujui</div>`
                    } else {
                        action = ''
                    }
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
	        		<td class="text-truncate" id="approved_date${value.id}">${approved_date}</td>
	        		<td class="text-truncate pr-4" id="approve${value.id}">${action}</td>
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
        // get_pinjaman()
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

$(document).on('click', '.approve', function() {
    $('#modal-approve').modal('show')
    $('#approve').data('id', $(this).data('id'))
    $('#approve-body').html(`Anda yakin ingin setujui <b>${$(this).data('title')}</b>`)
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
        $('#approve' + id).empty()
        $('#modal-approve').modal('hide')
        $(this).attr('disabled', false)
        customAlert('success', 'Pinjaman berhasil disetujui')
        get_pinjaman()
    }).catch((err) => {
        // console.log(err)
        $('#modal-approve').modal('hide')
        $(this).attr('disabled', false)
        customAlert('warning', err)
    })
})
