axios.get('api/pinjaman/cek_pinjaman').then((response) => {
	let value = response.data.data
	// console.log(value)
	value.output == 'true' ? $('#pinjaman').removeClass('hide') : $('#pinjaman').remove()
}).catch((err) => {
	// console.log(err.response)
})

get_data()

function get_data(page, status) {
    $('#table').empty()
    $('#pagination').addClass('hide')
    $('#loading_table').show()
    axios.get('api/pinjaman/filter/' + session.user_id, {
        params: {
            page: page,
            status: status
        }
    }).then((response) => {
        // console.log(response.data)
        let value = response.data
        if (value.data != '') {
            let append, title, approved_date, paid_off_date
            $.each(value.data, function(index, value) {
                if (value.approved_date == null) {
                    title = `Rp${convert(value.besar_pinjaman)}`
                    approved_date = ''
                } else {
                    title = `<a href="${root}pinjaman/${value.id}">Rp${convert(value.besar_pinjaman)}</a>`
                    approved_date = tanggal(value.approved_date)
                }
                value.paid_off_date == null ? paid_off_date = '' : paid_off_date = tanggal(value.paid_off_date)
                append = `<tr>
	        		<td class="text-center pl-4">${index + 1}.</td>
	        		<td class="text-truncate font-weight-bold" id="title${value.id}">${title}</td>
	        		<td class="text-truncate">${convert(value.tenor)} Bulan</td>
	        		<td class="text-truncate">Rp${convert(value.angsuran)}<small class="text-secondary">/bulan</small></td>
	        		<td class="text-truncate" id="status${value.id}">${get_status(value.status)}</td>
	        		<td class="text-truncate" id="approved_date${value.id}">${approved_date}</td>
	        		<td class="text-truncate pr-4" id="paid_off_date${value.id}">${paid_off_date}</td>
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
        // console.log(err.response)
    })
}

$('#filter').click(function() {
    get_data(1, $('input[type=radio][name=status]:checked').val())
    $('#modal-filter').modal('hide')
})
