get_data()

function get_data(page, status) {
    $('#table').empty()
    $('#pagination').addClass('hide')
    $('#loading_table').show()
    axios.get('api/pinjaman/filter/1', {
        params: {
            page: page,
            status: status
        }
    }).then((response) => {
        // console.log(response.data)
        let value = response.data
        let from = value.meta.from
        if (value.data != '') {
            let append, title, approved_date, paid_off_date, contract, action
            $.each(value.data, function(index, value) {
            	// console.log(value)
                value.contract == null ? contract = '' : contract = `<a href="${value.contract}" class="btn btn-sm btn-outline-primary px-5" target="_blank">Lihat</a>`
                title = `Rp${convert(value.besar_pinjaman)}`
                if (value.approved_date == null) {
                    approved_date = ''
                } else {
                    approved_date = tanggal(value.approved_date)
                }
                if (value.status == 'pending') {
                    action = `<div class="btn btn-sm btn-primary approve" data-id="${value.id}" data-title="${rupiah(value.besar_pinjaman)}">Setujui</div>
                    <div class="btn btn-sm btn-outline-primary reject" data-id="${value.id}" data-title="${rupiah(value.besar_pinjaman)}">Tolak</div>`
                } else {
                    if (value.contract == null) {
                        action = `<div class="btn btn-sm btn-primary contract" data-id="${value.id}">Upload kontrak</div>`
                    } else {
                        action = ''
                    }
                }
                value.paid_off_date == null ? paid_off_date = '' : paid_off_date = tanggal(value.paid_off_date)
                append = `<tr>
	        		<td class="text-center">${from}.</td>
	        		<td class="text-truncate" id="description${value.id}">${value.description}</td>
	        		<td class="text-truncate" id="title${value.id}">${title}</td>
	        		<td class="text-truncate" id="approved_date${value.id}">${approved_date}</td>
	        	</tr>`
                $('#table').append(append)
                from++
            })
            pagination(value.links, value.meta, value.meta.path)
        } else {
            $('#table').html(`<tr>
            	<td colspan="10" class="text-center pb-4">
            		<i class="mdi mdi-36px mdi-close-circle-outline d-block pr-0"></i>
            		<span class="text-secondary">Belum ada history pengurangan</span>
            	</td>
            </tr>`)
        }
        $('#loading_table').hide()
    }).catch((err) => {
        // console.log(err)
    })
}
