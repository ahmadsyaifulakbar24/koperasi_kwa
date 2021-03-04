axios.get('api/user/' + id).then((response) => {
    // console.log(response)
    let value = response.data.data
    $('title').prepend('Pinjaman ' + value.name)
    $('.user').prepend(value.name)
}).catch((err) => {
    // console.log(err.response)
})

get_data()

function get_data(page, status) {
    $('#table').empty()
    $('#pagination').addClass('hide')
    $('#loading_table').show()
    axios.get('api/pinjaman/filter/' + id, {
        params: {
        	page: page,
            status: status
        }
    }).then((response) => {
        // console.log(response.data)
        let value = response.data
        if (value.data != '') {
            let append, title, approved_date, paid_off_date, action
            $.each(value.data, function(index, value) {
                if (value.approved_date == null) {
                    title = `Rp${convert(value.besar_pinjaman)}`
                    approved_date = ''
                } else {
                    title = `<a href="${root}admin/pinjaman/${value.user_id}/${value.id}">Rp${convert(value.besar_pinjaman)}</a>`
                    approved_date = tanggal(value.approved_date)
                }
                if (value.status == 'pending') {
                    action = `<div class="btn btn-sm btn-primary approve" data-id="${value.id}" data-title="${rupiah(value.besar_pinjaman)}">Setujui</div>
                    <div class="btn btn-sm btn-outline-primary reject" data-id="${value.id}" data-title="${rupiah(value.besar_pinjaman)}">Tolak</div>`
                } else {
                    action = ''
                }
                value.paid_off_date == null ? paid_off_date = '' : paid_off_date = tanggal(value.paid_off_date)
                append = `<tr>
	        		<td class="text-center pl-4">${index + 1}.</td>
	        		<td class="text-truncate font-weight-bold" id="title${value.id}">${title}</td>
	        		<td class="text-truncate">${convert(value.tenor)} Bulan</td>
	        		<td class="text-truncate">Rp${convert(value.angsuran)}<small class="text-secondary">/bulan</small></td>
	        		<td class="text-truncate" id="status${value.id}">${get_status(value.status)}</td>
	        		<td class="text-truncate" id="approved_date${value.id}">${approved_date}</td>
	        		<td class="text-truncate" id="paid_off_date${value.id}">${paid_off_date}</td>
	        		<td class="text-truncate pr-4" id="action${value.id}">${action}</td>
	        	</tr>`
                $('#table').append(append)
            })
            pagination(value.links, value.meta, value.meta.path)
        } else {
            $('#table').html(`<tr>
            	<td colspan="10" class="text-center pb-4">
            		<i class="mdi mdi-36px mdi-close-circle-outline d-block pr-0"></i>
            		<span class="text-secondary">Belum ada pinjaman</span>
            	</td>
            </tr>`)
        }
        $('#loading_table').hide()
    }).catch((err) => {
        // console.log(err)
    })
}

$('#filter').click(function() {
    get_data(1, $('input[type=radio][name=status]:checked').val())
    $('#modal-filter').modal('hide')
})

$(document).on('click', '.approve', function() {
    $('#modal-approve').modal('show')
    $('#approve').data('id', $(this).data('id'))
    $('#approve').data('title', $(this).data('title'))
    $('#approve-body').html(`Anda yakin ingin setujui pinjaman <b>${$(this).data('title')}</b>`)
})

$('#approve').click(function() {
    let id = $(this).data('id')
    let title = $(this).data('title')
    $(this).attr('disabled', true)
    axios.patch('api/pinjaman/accept_pinjaman/' + id).then((response) => {
        console.log(response)
        let value = response.data.data 
        let date = value.approved_date
        let tgl = tanggal(date.substr(0, 10))
        $('#approved_date' + id).html(tgl)
        $('#title' + id).html(`<a href="${root}admin/pinjaman/${value.user_id}/${id}">${title}</a>`)
        $('#status' + id).html(get_status(value.status))
        $('#action' + id).empty()
        $('#modal-approve').modal('hide')
        $(this).attr('disabled', false)
        customAlert('success', 'Pinjaman berhasil disetujui')
    }).catch((err) => {
        // console.log(err)
    })
})

$(document).on('click', '.reject', function() {
    $('#modal-reject').modal('show')
    $('#reject').data('id', $(this).data('id'))
    $('#reject').data('title', $(this).data('title'))
    $('#reject-body').html(`Anda yakin ingin tolak pinjaman <b>${$(this).data('title')}</b>`)
})

$('#reject').click(function() {
    let id = $(this).data('id')
    $(this).attr('disabled', true)
    axios.patch('api/pinjaman/reject_pinjaman/' + id).then((response) => {
        // console.log(response)
        $('#action' + id).empty()
        $('#status' + id).html(get_status(response.data.data.status))
        $('#modal-reject').modal('hide')
        $(this).attr('disabled', false)
        customAlert('success', 'Pinjaman berhasil ditolak')
    }).catch((err) => {
        // console.log(err)
    })
})
