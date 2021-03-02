let length = 0

$(document).on('click', '#item', function() {
    length = $('.form-item').length
    item(length)
})

$(document).on('click', '.close', function() {
    $(this).parents('.form-item').remove()
    $('.type').each(function(i, o) {
        $(this).attr('data-id', i)
    })
    $('.besaran').each(function(i, o) {
        $(this).attr('data-id', i)
    })
    length = $('.form-item').length
    length == 0 ? item(length) : ''
})

$(document).on('keyup', '.besaran', function() {
    let value = $(this).val()
    $(this).val(convert(value))
})

$(document).on('change', '.type', function() {
    $(this).parents('.form-group').siblings('.nominal').find('input').focus()
})

item(0)

function item(id) {
    let append = `<div class="form-item">
		<hr class="form-group mt-4 mb-4">
		<div class="form-group row position-relative">
			<label for="type" class="col-lg-4 col-sm-5 col-form-label text-secondary">Pembayaran</label>
			<!--<div class="close" role="button">
				<i class="mdi mdi-trash-can-outline mdi-18px pr-0"></i>
			</div>
			<div class="col-lg-8 col-sm-7 pr-sm-5 pr-3">-->
			<div class="col-lg-8 col-sm-7">
				<select class="type custom-select" data-id="${id}" role="button">
					<!--<option disabled selected>Pilih</option>
					<option value="simpanan_pokok">Simpanan Pokok</option>
					<option value="simpanan_wajib">Simpanan Wajib</option>-->
					<option value="simpanan_sukarela">Simpanan Sukarela</option>
				</select>
				<div class="invalid-feedback type-feedback" data-id="${id}"></div>
			</div>
		</div>
		<div class="form-group row nominal">
			<label for="besaran" class="col-lg-4 col-sm-5 col-form-label text-secondary">Nominal</label>
			<!--<div class="col-lg-8 col-sm-7 pr-sm-5 pr-3">-->
			<div class="col-lg-8 col-sm-7">
				<div class="input-group">
					<div class="input-group-prepend">
						<div class="input-group-text">Rp</div>
					</div>
					<input type="tel" class="besaran form-control rounded-right" data-id="${id}" autocomplete="off">
					<div class="invalid-feedback besaran-feedback" data-id="${id}"></div>
				</div>
			</div>
		</div>
	</div>`
    $('#data').append(append)
}

$('#form').submit(function(e) {
    // console.clear()
    e.preventDefault()
    addLoading()

    let sub_transaction = []
    let title = $('#title').val()
    let message = $('#message').val()
    $('.is-invalid').removeClass('is-invalid')
    $('.form-item').each(function(index, value) {
        sub_transaction.push({
            type: $(`.type[data-id=${index}]`).val(),
            besaran: number($(`.besaran[data-id=${index}]`).val())
        })
    })

    let formData = new FormData()
    formData.append('title', title)
    formData.append('message', message)
    $.each(sub_transaction, function(index, value) {
        formData.append(`sub_transaction[${index}][type]`, value.type)
        formData.append(`sub_transaction[${index}][besaran]`, value.besaran)
    })
    
    axios.post('api/transaction/create_transaction', formData).then((response) => {
        // console.log(response)
        location.href = root + 'simpanan'
    }).catch((xhr) => {
        removeLoading('Tambah Simpanan')
        let err = xhr.response.data.errors
        // console.log(err)
        if (err.title) {
            $('#title').addClass('is-invalid')
            $('#title-feedback').html('Masukkan judul')
        }
        if (err.message) {
            $('#message').addClass('is-invalid')
            $('#message-feedback').html('Masukkan pesan')
        }
        $('.form-item').each(function(index, value) {
            if (err[`sub_transaction.${index}.type`]) {
                $(`.type[data-id=${index}]`).addClass('is-invalid')
                $(`.type-feedback[data-id=${index}]`).html('Pilih simpanan')
            }
            if (err[`sub_transaction.${index}.besaran`]) {
                $(`.besaran[data-id=${index}]`).addClass('is-invalid')
                $(`.besaran-feedback[data-id=${index}]`).html('Masukkan nominal')
            }
        })
    })
})
