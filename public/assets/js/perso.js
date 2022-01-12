
window.onload = () => {
    const page = document.getElementById('page')?.dataset.page
    const { protocol, hostname } = location
    const base_url = `${protocol}//${hostname}`

    // Initiate the fetch request
    const init_fetch = () => {
        
        const header = new Headers()
        header.append("X-Requested-With", "XMLHttpRequest")
        return { 
            method: 'GET',
            headers: header,
            mode: 'cors',
            cache: 'default'
        };
    }

    // Display the modal
    const display_modal = (btn, modal_content, more = {}) => {

        btn.addEventListener('click', function() {
            const id = this.dataset.id
            const url = `${base_url}/ticket/${id}`
            const myInit = init_fetch()

            modal_content.innerHTML = 'chargement...';
            
            fetch(url, myInit).then(res => res.json()).then(ticket => {

                const { user } = ticket
                const description = ticket.description === '' ? 'N/A' : ticket.description

                const get_info = () => {
                    return (ticket.solution != null) ? 
                    `<div class = "bg-secondary p-3">
                        <strong class="h6">Solution</strong>
                        <p class="mt-2">${ticket.solution}</p>
                    </div>`: more.solution_form(id)
                }
                

                modal_content.innerHTML = `
                <div class="modal-header">
                    <h2 class="h6 modal-title">
                        Details du ticket <span class="bg-primary text-white px-2">${ticket.reference}</span>
                    </h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div>
                        <strong class="h6">Libellé</strong>
                        <p class="text-gray-500 mt-2">${ticket.label}</p>
                    </div>
                    <div>
                        <strong class="h6">Description</strong>
                        <p class="text-gray-500 mt-2">${description}</p>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <strong class="h6">Déclaré le</strong>
                            <p class="text-gray-500 mt-2">${ticket.created_at}</p>
                        </div>
                        <div class="col-md-4">
                            <strong class="h6">Cloturé le</strong>
                            <p class="text-gray-500 mt-2">${ ticket.closed_at ?? 'N/A'}</p>
                        </div>
                    </div>
                    <span class="h5 text-secondary my-2 d-block">Agent</span>

                    <div class="row">
                        <div class="col-md-4">
                            <strong class="h6">Nom(s) et prénom(s)</strong>
                            <p class="text-gray-500 mt-2">${user.firstname} ${user.name}</p>
                        </div>
                        <div class="col-md-4">
                            <strong class="h6">Email</strong>
                            <p class="text-gray-500 mt-2">${user.email}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <strong class="h6 text-tertiary">Direction</strong>
                            <p class="text-gray-500 mt-2">${user.department}</p>
                        </div>
                        <div class="col-md-4">
                            <strong class="h6 text-tertiary">Service</strong>
                            <p class="text-gray-500 mt-2">${user.service}</p>
                        </div>
                    </div>
                    ${get_info()}
                </div>
                <div class="modal-footer">
                ${ ticket.solution === null ? more.button : ''}
                    <button type="button" class="btn btn-link text-gray-600 ms-auto" data-bs-dismiss="modal">
                        Fermer
                    </button>
                </div>
                `                    
            })
        })
    }

    if (page === "new_ticket") {
    
        // Initialisation
        const url = `${base_url}/category/`;
        const form = document.forms['new_ticket']
        const category_elt = form.elements['category']
        const bug_elt = form.elements['bug'];
        const description_block = document.getElementById('description_block')
        const description = form.elements['description'];
        const default_value = 'Autre...'

        // category selection
        category_elt.addEventListener('change', function (event) {
    
            const label = event.target.value;
            const myInit = init_fetch()

            fetch(url + label, myInit).then(res => res.json()).then(bugs => {
    
                bug_elt.innerHTML = ''
                Array.from(bugs).forEach(bug => {
                    bug_elt.innerHTML += `<option value = "${bug.label}">${bug.label}</option>`
                })
                bug_elt.innerHTML += `<option value = "${default_value}">${default_value}</option>`
            }).catch(err => console.log(err))
        })
    
        // bug selection
        bug_elt.addEventListener('change', function (event) {
    
            if (event.target.value === `${default_value}`) {
                description_block.classList.replace('d-none', 'd-block')
                description.setAttribute('required', 'required');
            } else {
                description.removeAttribute('required');
                description_block.classList.replace('d-block', 'd-none')
            }
        })
    }

    // Assigned tickets part or all declared tickets
    if ( page === "my_tickets" || page === 'all_tickets' ) {

        const modal_content = document.querySelector('.modal-content')
        const btn_modal_open = document.getElementsByClassName('modal_show')
        const more = { solution_form: (id) => '', button: ''}

        if ( page === "my_tickets" ) {
            more.solution_form = (id) => {
                return `<span class="h5 text-secondary my-2 d-block">Solution</span>
                    <form action="/cloturer/${id}" id = "solution" method = "POST">
                        <div class="form-group">
                        <div class="form-group mb-4">
                            <label for="description">Description de la solution</label>
                            <textarea class="form-control"
                            rows="5" name="solution"
                            id="description" 
                            placeholder="Décrivez comment vous avez résolu le problème" 
                            required ></textarea>
                        </div>
                        </div>
                    </form>`
            }
            
            more.button = `<button type="submit" class="btn btn-secondary" form="solution" >Clôturer</button>`
        }

        Array.from(btn_modal_open).forEach(btn => display_modal(btn, modal_content, more));
    }
}