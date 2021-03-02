let fdp = new FormData()
let picture = null
let status = false

$(document).on('change', 'input[type="file"]', function(e) {
    let val = $(this).get(0).files[0]
    let ext = val.name.split('.').pop()
    const format = ['image/jpeg', 'image/png']

    if (format.includes(val.type) == true) {
        if (val.size <= 5000000) {
		    $('#loading-picture').show()
            picture = val
            let input = e.currentTarget
            let reader = new FileReader()
            reader.onload = function() {
                addStagingFile(val.name, reader.result)
            }
            reader.readAsDataURL(input.files[0])

            $(this).parents('.file-group').hide()
            $(this).removeClass('is-invalid')
            // console.clear()
            // console.log(val)
        } else {
            $(this).addClass('is-invalid')
            $(this).siblings('.invalid-feedback').html('Ukuran foto maksimal 5MB.')
        }
    } else {
        $(this).addClass('is-invalid')
        $(this).siblings('.invalid-feedback').html('Format foto wajib berupa jpg/png.')
    }
})

$(document).on('click', '.mdi-staging', function() {
    picture = null
    status = true
    $('#picture').val('')
    $('.file-group').show()
    $(this).parents('.file-group').remove()
    // console.clear()
    // console.log(picture)
})

function addStagingFile(name, url) {
    let append = `<div class="file-group">
		<div class="staging-file d-flex align-items-center border rounded-top pr-0">
			<div class="d-flex align-items-center text-truncate w-100">
				<i class="mdi mdi-18px mdi-image-outline px-2"></i>
				<small class="text-truncate" title="${name}">${name}</small>
			</div>
			<i class="mdi mdi-close mdi-staging ml-auto pl-2 py-2" role="button"></i>
		</div>
		<img src="${url}" class="border-right border-bottom border-left rounded-bottom w-100">
	</div>`
    $('#form-picture').append(append)
    $('#loading-picture').hide()
}
