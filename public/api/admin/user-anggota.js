get_data()

function get_data(page, search) {
    $('#table').empty()
    $('#pagination').addClass('hide')
    $('#loading_table').show()
    axios.get('api/user', {
    	params: {
    		page: page,
    		search: search
    	}
    }).then((response) => {
        // console.log(response)
        let value = response.data
        let from = value.meta.from
        let empty
        if (value.data != '') {
            let append
            $.each(value.data, function(index, value) {
                append = `<tr>
	        		<td class="text-center">${from}.</td>
	        		<td class="text-truncate text-capitalize">
	        			<a href="${root}admin/anggota/${value.id}">${String(value.name).toLowerCase()}
	        		</td>
	        		<td class="text-truncate"></td>
	        	</tr>`
                $('#table').append(append)
            	from++
            })
            pagination(value.links, value.meta, value.meta.path)
        } else {
        	if (search) {
        		empty = `Nama "<b>${search}</b>" tidak ditemukan`
        	} else {
        		empty = 'Belum ada data'
        	}
            $('#table').html(`<tr>
            	<td colspan="10" class="text-center pb-4">
            		<i class="mdi mdi-36px mdi-close-circle-outline d-block pr-0"></i>
            		<span class="text-secondary">${empty}</span>
            	</td>
            </tr>`)
        }
        $('#loading_table').hide()
    }).catch((err) => {
        // console.log(err)
    })
}

$('#search').keyup(function(e) {
    let param = $(this).val()
    let keyCode = e.originalEvent.keyCode
    if (keyCode >= 48 && keyCode <= 90 || keyCode == 8) {
	    $('#table').empty()
	    $('#pagination').addClass('hide')
	    $('#loading_table').show()
        param.length != 0 ? $('#search-close').removeClass('hide') : $('#search-close').addClass('hide')
    }
})

$('#search').keyup(delay(function(e) {
    let param = $(this).val()
    let keyCode = e.originalEvent.keyCode
    if (keyCode >= 48 && keyCode <= 90 || keyCode == 8) {
        param.length != 0 ? get_data(1, param) : get_data()
    }
}, 500))

$('#search-close').click(function() {
    $('#search').val('')
    $(this).addClass('hide')
    get_data()
})
