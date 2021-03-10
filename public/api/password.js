$('#form').submit(function(e) {
    // console.clear()
    $('.is-invalid').removeClass('is-invalid')
    e.preventDefault()
    addLoading()
    let formData = new FormData()
    let old_password = $('#password').val()
    let password = $('#npassword').val()
    let password_confirmation = $('#cpassword').val()
    formData.append('old_password', old_password)
    formData.append('password', password)
    formData.append('password_confirmation', password_confirmation)
    axios.post('api/auth/reset_password', formData).then((response) => {
        // console.log(response)
        customAlert('success', 'Password berhasil diubah')
        removeLoading('Ubah Password')
        $('input').val('')
    }).catch((xhr) => {
        let err = xhr.response.data.errors
        // console.log(xhr.response)
        if(err) {
	        if (err.old_password) {
	            if (err.old_password == 'The old password field is required.') {
	                $('#password').addClass('is-invalid')
	                $('#password-feedback').html('Masukkan password lama')
	            }
	        }
	        if (err.password) {
	            if (err.password == 'The password field is required.') {
	                $('#npassword').addClass('is-invalid')
	                $('#npassword-feedback').html('Masukkan password baru')
	            } else if (err.password == 'The password must be at least 8 characters.') {
	                $('#npassword').addClass('is-invalid')
	                $('#npassword-feedback').html('Password minimal 8 karakter')
	            } else if (err.password == 'The password confirmation does not match.') {
	                $('#cpassword').addClass('is-invalid')
	                $('#cpassword-feedback').html('Konfirmasi password dengan benar')
	            }
	        }
	        if (err.password_confirmation) {
	            if (err.password_confirmation == 'The password confirmation field is required.') {
	                $('#cpassword').addClass('is-invalid')
	                $('#cpassword-feedback').html('Masukkan konfirmasi password')
	            }
	        }
	    }
        if (xhr.response.data.message == 'previous password are not the same') {
            $('#password').addClass('is-invalid')
            $('#password-feedback').html('Password lama salah')
        }
        removeLoading('Ubah Password')
    })
})
