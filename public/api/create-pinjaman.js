let pinjaman = []

axios.get('api/pinjaman/cek_pinjaman').then((response) => {
	let value = response.data.data
	// console.log(value)
	if (value.output == 'true') {
		$('#data').removeClass('hide')
		$('#loading').remove()
	} else {
		window.history.back()
	}
}).catch((err) => {
	// console.log(err.response)
})

$(document).on('keyup', '#besar_pinjaman', function() {
    let value = $(this).val()
    $(this).val(convert(value))
})

$('#form').submit(function(e) {
    // console.clear()
    e.preventDefault()
    addLoading()

    let besar_pinjaman = number($('#besar_pinjaman').val())
    let tenor = $('#tenor').val()
    $('.is-invalid').removeClass('is-invalid')
    $('#cicilan').addClass('hide')
    $('#pinjaman').addClass('hide')

    let formData = new FormData()
    formData.append('besar_pinjaman', besar_pinjaman)
    formData.append('tenor', tenor)

    if (tenor > 24) {
        $('#tenor').addClass('is-invalid')
        $('#tenor-feedback').html('Maksimal tenor 24 bulan')
        removeLoading('Hitung Cicilan')
    } else {
        axios.post('api/pinjaman/create_pinjaman/detail', formData).then((response) => {
            // console.log(response)
            let value = response.data.data
            pinjaman = {
                angsuran: value.angsuran,
                besar_pinjaman: value.besar_pinjaman,
                tenor: value.tenor,
                total_bayar: value.total_bayar
            }
            $('#besar_pinjaman_cicilan').html('Rp' + convert(value.besar_pinjaman))
            $('#angsuran_cicilan').html('Rp' + convert(value.angsuran))
            $('#tenor_cicilan').html(convert(value.tenor))
            $('#cicilan').removeClass('hide')
            $('#pinjaman').removeClass('hide')
            removeLoading('Hitung Cicilan')
        }).catch((xhr) => {
            removeLoading('Hitung Cicilan')
            let err = xhr.response.data.errors
            // console.log(err)
            if (err.besar_pinjaman) {
                $('#besar_pinjaman').addClass('is-invalid')
                $('#besar_pinjaman-feedback').html('Masukkan besar pinjaman')
            }
            if (err.tenor) {
                $('#tenor').addClass('is-invalid')
                $('#tenor-feedback').html('Masukkan tenor')
            }
        })
    }
})

$('#form-cicilan').submit(function(e) {
    // console.clear()
    e.preventDefault()
    addLoading('#pinjaman')

    let formData = new FormData()
    formData.append('angsuran', pinjaman.angsuran)
    formData.append('besar_pinjaman', pinjaman.besar_pinjaman)
    formData.append('tenor', pinjaman.tenor)
    formData.append('total_bayar', pinjaman.total_bayar)

    axios.post('api/pinjaman/create_pinjaman', formData).then((response) => {
        // console.log(response)
        location.href = root + 'pinjaman'
    }).catch((xhr) => {
        removeLoading('Buat Pinjaman', '#pinjaman')
        let err = xhr.response.data.errors
        // console.log(err)
    })
})
