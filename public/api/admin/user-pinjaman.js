let status = ''

get_data()

function get_data(page) {
    $('#table').empty()
    $('#pagination').addClass('hide')
    $('#loading_table').show()
    axios.get('api/pinjaman/filter', {
    	params: {
    		page: page,
    		status: status
    	}
    }).then((response) => {
        // console.log(response)
        let value = response.data
        let from = value.meta.from
        if (value.data != '') {
            let append
            $.each(value.data, function(index, value) {
                append = `<tr>
	        		<td class="text-center">${from}.</td>
	        		<td class="text-truncate text-capitalize">
	        			<a href="${root}admin/pinjaman/${value.user_id}">${String(value.name).toLowerCase()}</a>
	        		</td>
	        		<td class="text-truncate">${rupiah(value.besar_pinjaman)}</td>
	        		<td class="text-truncate">${convert(value.tenor)} Bulan</td>
	        		<td class="text-truncate">${rupiah(value.angsuran)}<small class="text-secondary">/bulan</small></td>
	        		<td class="text-truncate">${get_status(value.status)}</td>
	        		<td class="text-truncate"></td>
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

$(document).on('change', 'input[type=radio][name=type]', function() {
	let value = $(this).val()
	if (value == 'history') {
		$('#status').show()
	} else {
		$('#status').hide()
	}
})
$('#filter').click(function() {
	let type = $('input[type=radio][name=type]:checked').val()
	status = $('input[type=radio][name=status]:checked').val()
	if (type == 'history') {
		$('#all').hide()
		$('#history').show()
	    get_data(1)
	} else {
		$('#all').show()
		$('#history').hide()
	}
    $('#modal-filter').modal('hide')
})

get_data_all()

function get_data_all(page) {
    $('#table_all').empty()
    $('#pagination_all').addClass('hide')
    $('#loading_table_all').show()
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
	        		<td class="text-center">${from}.</td>
	        		<td class="text-truncate text-capitalize">
	        			<a href="${root}admin/pinjaman/${value.id}">${String(value.name).toLowerCase()}</a>
	        		</td>
	        		<td class="text-truncate"></td>
	        	</tr>`
                $('#table_all').append(append)
                from++
            })

            let current = value.meta.current_page
		    let replace = value.meta.path + '?page='

		    let first = value.links.first.replace(replace, '')
		    if (first != current) {
		        $('#allfirst').removeClass('disabled')
		        $('#allfirst').data('id', first)
		    } else {
		        $('#allfirst').addClass('disabled')
		    }

		    if (value.links.prev != null) {
		        $('#allprev').removeClass('disabled')
		        let prev = value.links.prev.replace(replace, '')
		        $('#allprev').data('id', prev)

		        $('#allprevCurrent').show()
		        $('#allprevCurrent span').html(prev)
		        $('#allprevCurrent').data('id', prev)

		        let prevCurrentDouble = prev - 1
		        if (prevCurrentDouble > 0) {
		            $('#allprevCurrentDouble').show()
		            $('#allprevCurrentDouble span').html(prevCurrentDouble)
		            $('#allprevCurrentDouble').data('id', prevCurrentDouble)
		        } else {
		            $('#allprevCurrentDouble').hide()
		        }
		    } else {
		        $('#allprev').addClass('disabled')
		        $('#allprevCurrent').hide()
		        $('#allprevCurrentDouble').hide()
		    }

		    $('#allcurrent').addClass('active')
		    $('#allcurrent span').html(current)

		    if (value.links.next != null) {
		        $('#allnext').removeClass('disabled')
		        let next = value.links.next.replace(replace, '')
		        $('#allnext').data('id', next)

		        $('#allnextCurrent').show()
		        $('#allnextCurrent span').html(next)
		        $('#allnextCurrent').data('id', next)

		        let nextCurrentDouble = ++next
		        if (nextCurrentDouble <= value.meta.last_page) {
		            $('#allnextCurrentDouble').show()
		            $('#allnextCurrentDouble span').html(nextCurrentDouble)
		            $('#allnextCurrentDouble').data('id', nextCurrentDouble)
		        } else {
		            $('#allnextCurrentDouble').hide()
		        }
		    } else {
		        $('#allnext').addClass('disabled')
		        $('#allnextCurrent').hide()
		        $('#allnextCurrentDouble').hide()
		    }

		    let last = value.links.last.replace(replace, '')
		    if (last != current) {
		        $('#alllast').removeClass('disabled')
		        $('#alllast').data('id', last)
		    } else {
		        $('#alllast').addClass('disabled')
		    }

		    $('#pagination_all').removeClass('hide')
		    $('#pagination-label_all').html(`Showing ${value.meta.from} to ${value.meta.to} of ${value.meta.total} entries`)
        } else {
            $('#table_all').html(`<tr>
            	<td colspan="10" class="text-center pb-4">
            		<i class="mdi mdi-36px mdi-close-circle-outline d-block pr-0"></i>
            		<span class="text-secondary">Belum ada data</span>
            	</td>
            </tr>`)
        }
        $('#loading_table_all').hide()
    }).catch((err) => {
        // console.log(err)
    })
}

$('.page-all').click(function() {
    if (!$(this).is('.active, .disabled')) {
        let page = $(this).data('id')
        $('#pagination_all').addClass('hide')
        $('#loading_table_all').removeClass('hide')
        get_data_all(page)
    }
})
