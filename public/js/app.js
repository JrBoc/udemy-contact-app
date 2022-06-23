document.getElementById('filter_company_id')?.addEventListener('change', function () {
    let companyId = this.value || this.options[this.selectedIndex].value

    window.location.href = window.location.href.split('?')[0] + '?company_id=' + companyId
})

document.querySelectorAll('.btn-delete')?.forEach((button) => {
    button.addEventListener('click', function (event) {
        event.preventDefault()

        if (confirm('Are you sure?')) {
            let action = this.getAttribute('href')
            let form = document.getElementById('form-delete')

            form.setAttribute('action', action)
            form.submit()
        }

    })
})

document.getElementById('btn-clear')?.addEventListener('click', () => {
    // document.getElementById('search').value = ''
    // document.getElementById('filter_company_id').selectedIndex = 0

    window.location.href = window.location.href.split('?')[0]
})

const toggleClearButton = () => {
    let query = location.search
    let pattern = /[?&]search=/
    let button = document.getElementById('btn-clear')

    if (!button) {
        return false
    }

    if (pattern.test(query)) {
        button.style.display = 'block'
    } else {
        button.style.display = 'none'
    }
}

toggleClearButton()
