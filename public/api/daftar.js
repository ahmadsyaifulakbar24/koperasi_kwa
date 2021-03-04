if (session) {
    axios.post('api/auth/logout').then((response) => {
        localStorage.removeItem('session')
    }).catch((xhr) => {
        // console.log(xhr.response)
    })
}

get_pendidikan()

$('#name').focus()

$('#simpanan_sukarela').keyup(function() {
	let value = $(this).val()
	$(this).val(convert(value))
})

$('#form').submit(function(e) {
    addLoading()
    e.preventDefault()
    $('.is-invalid').removeClass('is-invalid')

    let name = $('#name').val()
    let no_id = $('#no_id').val()
	let jenis_kelamin = $('input[type=radio][name=jenis_kelamin]:checked').val()
    let tempat_lahir = $('#tempat_lahir').val()
    let tanggal_lahir = $('#tanggal_lahir').val()
    let alamat = $('#alamat').val()
    let no_telp = $('#no_telp').val()
	let pendidikan_id = $('input[type=radio][name=pendidikan_id]:checked').val()
	let jabatan_id = $('input[type=radio][name=jabatan_id]:checked').val()
	let status_keluarga_id = $('input[type=radio][name=status_keluarga_id]:checked').val()
    let nama_ahliwaris = $('#nama_ahliwaris').val()
	let besar_simpanan_wajib = $('input[type=radio][name=besar_simpanan_wajib]:checked').val()
    let simpanan_sukarela = number($('#simpanan_sukarela').val())
    let email = $('#email').val()
    let username = $('#username').val()
    let password = $('#password').val()
    let cpassword = $('#cpassword').val()

    let formData = new FormData
    formData.append('name', name)
    formData.append('no_id', no_id)
    formData.append('jenis_kelamin', jenis_kelamin)
    formData.append('tempat_lahir', tempat_lahir)
    formData.append('tanggal_lahir', tanggal_lahir)
    formData.append('alamat', alamat)
    formData.append('no_telp', no_telp)
    formData.append('pendidikan_id', pendidikan_id)
    formData.append('jabatan_id', jabatan_id)
    formData.append('status_keluarga_id', status_keluarga_id)
    formData.append('nama_ahliwaris', nama_ahliwaris)
    formData.append('besar_simpanan_wajib', besar_simpanan_wajib)
    formData.append('simpanan_sukarela', simpanan_sukarela)
    formData.append('upload_ktp', picture)
    formData.append('username', username)
    formData.append('email', email)
    formData.append('password', password)
    formData.append('password_confirmation', cpassword)
    formData.append('user_level_id', 101)

    axios.post('api/auth/register', formData).then((response) => {
    	// console.log(response)
        location.href = root + '?success'
    }).catch((xhr) => {
        let err = xhr.response.data.errors
        // console.clear()
        // console.log(err)
        if (err.name) {
        	$('#name').addClass('is-invalid')
        	$('#name-feedback').html('Masukkan nama lengkap')
        }
        if (err.no_id) {
        	$('#no_id').addClass('is-invalid')
        	$('#no_id-feedback').html('Masukkan nomor identitas')
        }
        if (err.jenis_kelamin) {
        	$('#jenis_kelamin').addClass('is-invalid')
        	$('#jenis_kelamin-feedback').html('Pilih jenis kelamin')
        }
        if (err.tempat_lahir) {
        	$('#tempat_lahir').addClass('is-invalid')
        	$('#tempat_lahir-feedback').html('Masukkan tempat lahir')
        }
        if (err.tanggal_lahir) {
        	$('#tanggal_lahir').addClass('is-invalid')
        	$('#tanggal_lahir-feedback').html('Pilih tanggal lahir')
        }
        if (err.alamat) {
        	$('#alamat').addClass('is-invalid')
        	$('#alamat-feedback').html('Masukkan alamat lengkap')
        }
        if (err.no_telp) {
	        if (err.no_telp == "The no telp field is required.") {
	        	$('#no_telp').addClass('is-invalid')
	        	$('#no_telp-feedback').html('Masukkan nomor telepon')
	        }
	        else if (err.no_telp == "The no telp has already been taken.") {
	        	$('#no_telp').addClass('is-invalid')
	        	$('#no_telp-feedback').html('Nomor telepon telah digunakan')
	        }
        }
        if (err.pendidikan_id) {
        	$('#pendidikan_id').addClass('is-invalid')
        	$('#pendidikan_id-feedback').html('Pilih pendidikan terakhir')
        }
        if (err.jabatan_id) {
        	$('#jabatan_id').addClass('is-invalid')
        	$('#jabatan_id-feedback').html('Pilih jabatan')
        }
        if (err.status_keluarga_id) {
        	$('#status_keluarga_id').addClass('is-invalid')
        	$('#status_keluarga_id-feedback').html('Pilih status dalam keluarga')
        }
        if (err.nama_ahliwaris) {
        	$('#nama_ahliwaris').addClass('is-invalid')
        	$('#nama_ahliwaris-feedback').html('Masukkan nama ahli waris')
        }
        if (err.besar_simpanan_wajib) {
        	$('#besar_simpanan_wajib').addClass('is-invalid')
        	$('#besar_simpanan_wajib-feedback').html('Pilih besaran simpanan wajib')
        }
        if (err.simpanan_sukarela) {
        	$('#simpanan_sukarela').addClass('is-invalid')
        	$('#simpanan_sukarela-feedback').html('Masukkan simpanan sukarela')
        }
        if (err.upload_ktp) {
        	$('#picture').addClass('is-invalid')
        	$('#picture-feedback').html('Pilih foto ktp')
        }
        if (err.username) {
	        if (err.username == "The username field is required.") {
	        	$('#username').addClass('is-invalid')
	        	$('#username-feedback').html('Masukkan username')
	        }
	        else if (err.username == "The username has already been taken.") {
	        	$('#username').addClass('is-invalid')
	        	$('#username-feedback').html('Username telah digunakan')
	        }
        }
        if (err.email) {
	        if (err.email == "The email field is required.") {
	        	$('#email').addClass('is-invalid')
	        	$('#email-feedback').html('Masukkan email')
	        }
	        else if (err.email == "The email has already been taken.") {
	        	$('#email').addClass('is-invalid')
	        	$('#email-feedback').html('Email telah digunakan')
	        }
        }
        if (err.password) {
	        if (err.password == "The password field is required.") {
	        	$('#password').addClass('is-invalid')
	        	$('#password-feedback').html('Masukkan password')
	        }
	        if (err.password == "The password confirmation does not match.") {
	        	$('#cpassword').addClass('is-invalid')
	        	$('#cpassword-feedback').html('Masukkan konfirmasi password dengan benar')
	        }
        }
        if (err.password_confirmation) {
        	$('#cpassword').addClass('is-invalid')
        	$('#cpassword-feedback').html('Masukkan konfirmasi password')
        }
	    removeLoading('Daftar')
    })
})
