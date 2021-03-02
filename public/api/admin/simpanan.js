let balance = 0,
    filter_by = '',
    approved = '',
    day = '',
    month = '',
    year = ''

axios.get('api/user/' + id).then((response) => {
    // console.log(response)
    let value = response.data.data
    $('title').prepend('Simpanan ' + value.name)
    $('#name').html(value.name)
    $('#approve-name').prepend(value.name)
    $('#balance').html(rupiah(value.user_koperasi_detail.saldo_simpanan))
    balance = value.user_koperasi_detail.saldo_simpanan
}).catch((err) => {
    // console.log(err.response)
})

get_data()

function get_data(page, day, month, year, approved) {
    $('#table').empty()
    $('#pagination').addClass('hide')
    $('#loading_table').show()
    axios.get('api/transaction/filter/' + id, {
        params: {
            page: page,
            day: day,
            month: month,
            year: year,
            approved: approved,
            type: 'simpanan'
        }
    }).then((response) => {
        // console.log(response.data.data)
        let value = response.data
        if (value.data != '') {
            let append, sub_append, besaran, bukti_pembayaran, approved_date, action
            $.each(value.data, function(index, value) {
                value.approved_date == null ? approved_date = '' : approved_date = tanggal(value.approved_date)
                if (value.bukti_pembayaran == null) {
                    bukti_pembayaran = `<a href="${root}invoice/simpanan/${value.user_id}/${value.id}" class="btn btn-sm btn-primary px-4">Konfirmasi</a>`
                    action = ''
                } else {
                    bukti_pembayaran = `<a href="${value.bukti_pembayaran}" class="btn btn-sm btn-outline-primary" target="_blank">Bukti pembayaran</a>`
                    if (value.approved_date == null) {
                        action = `<div class="btn btn-sm btn-primary approve" data-id="${value.id}" data-title="${value.title}">Setujui</div>`
                    } else {
                        action = ''
                    }
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
	        		<td class="text-truncate" id="approved_date${value.id}">${approved_date}</td>
	        		<td class="text-truncate pr-4" id="approve${value.id}">${action}</td>
	        	</tr>`
                $('#table').append(append)
            })
            pagination(value.links, value.meta, value.meta.path)
        } else {
            $('#table').html(`<tr>
            	<td colspan="7" class="text-center pb-4">
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
        $.each(value.sub_transaction, function(index, value) {
            if (value.type == 'simpanan_wajib' || value.type == 'simpanan_sukarela') balance += value.besaran
        })
        let date = value.approved_date
        let tgl = tanggal(date.substr(0, 10))
        $('#balance').html(rupiah(balance))
        $('#approved_date' + id).html(tgl)
        $('#approve' + id).empty()
        $('#modal-approve').modal('hide')
        $(this).attr('disabled', false)
        customAlert('success', 'Simpanan berhasil disetujui')
    }).catch((err) => {
        // console.log(err.response)
        $('#modal-approve').modal('hide')
        $(this).attr('disabled', false)
        customAlert('warning', err)
    })
})
