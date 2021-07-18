let date = new Date()
let month = date.getMonth() + 1
let year = date.getFullYear()

get_data(1, month, year)

function get_data(page, month, year) {
    $('#table').empty()
    $('#pagination').addClass('hide')
    $('#loading_table').show()
	$('#bulan').html(`(${bulan_tahun(month, year)})`)
    axios.get('api/transaction/get_simpanan_perbulan', {
    	params: {
    		page: page,
    		month: month,
    		year: year
    	}
    }).then((response) => {
        // console.log(response)
        let value = response.data
        let from = value.from
        let path = 'https://koperasi.lekarlwig.com/api/transaction/get_simpanan_perbulan'
        const links = {
        	first: path + '?page=1',
        	last: path + '?page=' + value.last_page,
        	prev: value.prev_page_url,
        	next: value.next_page_url
        }
        const meta = {
        	current_page: parseInt(value.current_page),
        	from: value.from,
        	last_page: value.last_page,
        	path: path,
        	per_page: value.per_page,
        	to: value.to,
        	total: value.total
        }
        if (value.data != null) {
            let append
            $.each(value.data, function(index, value) {
                append = `<tr>
	        		<td class="text-center">${from}.</td>
	        		<td class="text-truncate text-capitalize">${String(value.name).toLowerCase()}</td>
	        		<td class="text-truncate">Rp${convert(value.simpanan_wajib)}</td>
	        		<td class="text-truncate">Rp${convert(value.simpanan_sukarela)}</td>
	        	</tr>`
                $('#table').append(append)
                from++
            })
            pagination(links, meta, path)
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
        // console.log(err.response)
    })
}

currentDate()

$('.page').click(function() {
    if (!$(this).is('.active, .disabled')) {
        let page = $(this).data('id')
        $('#pagination').addClass('hide')
        $('#loading_table').removeClass('hide')
        get_data(page, month, year)
    }
})

$('#filter').click(function() {
    month = $('#month').val().substr(5, 2)
    month.length == 2 ? month = month.substr(1, 1) : ''
    year = $('#month').val().substr(0, 4)
    get_data(1, month, year)
    $('#modal-filter').modal('hide')
})
