if (session) {
    axios.post('api/auth/logout').then((response) => {
        localStorage.removeItem('session')
    }).catch((xhr) => {
        // console.log(xhr.response)
    })
}

$('#form').submit(function(e) {
    e.preventDefault()
    addLoading()
    $('.alert').hide()
    axios.get('sanctum/csrf-cookie').then((response) => {
        let formData = new FormData
        formData.append('email', document.getElementById('email').value)
        formData.append('password', document.getElementById('password').value)
        formData.append('device_name', navigator.platform)
        axios.post('api/auth/login', formData).then((response) => {
            // console.log(response)
            let value = response.data
            const session = {
                token: value.token,
                name: value.user.name,
                user_id: value.user.id,
                level: value.user.user_level_id
            }
            $.ajax({
                url: root + 'session/login',
                type: 'GET',
                data: {
                    token: value.token,
                    user_id: value.user.id,
                    level: value.user.user_level_id
                },
                success: function(result) {
                    localStorage.setItem('session', JSON.stringify(session))
                    location.href = root + 'dashboard'
                }
            })
        }).catch((xhr) => {
            // console.log(xhr.response)
            // console.clear()
            removeLoading('Login')
            $('.alert').show()
        })
    }).catch((xhr) => {
        // console.log(xhr.response)
    })
})
