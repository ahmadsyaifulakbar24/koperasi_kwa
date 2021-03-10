get_data()

function get_data(page) {
    $('#table').empty()
    $('#pagination').addClass('hide')
    $('#loading_table').show()
    axios.get('api/user', {
    	params: {
    		page: page
    	}
    }).then((response) => {
        // console.log(response)
        let value = response.data
        let from = value.meta.from
        if (value.data != '') {
            let append
            $.each(value.data, function(index, value) {
                append = `<tr>
	        		<td class="text-center font-weight-bold pl-4">${from}.</td>
	        		<td class="text-truncate font-weight-bold"><a href="${root}admin/pinjaman/${value.id}">${value.name}</td>
	        		<td class="text-truncate pr-4" id="approve${value.id}"></td>
	        	</tr>`
                $('#table').append(append)
                from++
            })
            pagination(value.links, value.meta, value.meta.path)
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
