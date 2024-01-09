/*
usage:

You can use without any parametrs:

makeModal()
makeModalConfirm()
makeModalAlert()

then functions will create default instances of modals

But you can set modal how you want
Each function has its own options that you can pass as an object

For makeModal():

options = {
    contentType: 'string' - you can choose how you want to build the modal, the default set is set as "html"
    header: 'string' - you can set the header, this variable is only used if you set contentType as "object"
    body: 'string' - you can set the body
    footer: 'string' - you can set the footer, this variable is only used if you set contentType as "object"
    size: 'string' - you can set size of the modal, for example: 'sm, md, lg', deafult is set as 'lg'
    titleTag: 'string' - you can set tag of header, deafult: h4
    keyboard: 'boolen' - if set as true the modal is closed when user press esc, deafult is set as true
    reloadPage: 'boolen' - if set to true when the modal is closed the page will reload, deafult set to false
    alertType: 'string' - you can change color od modal, deafult set as light
    backdrop: 'boolean' - if false when user press around modal, modal won't be close, deafult set: true
    focus: 'boolen' - if true puts the focus on the modal when initialized, deafult: true
}

makeModal(options)

Additionally, if you put something in the content and you select the contentType as html and the content is empty, 
the body will replace the content

Finally you can call makeModal without the object, if you do that the variable you set will be used instead of the body to build
deafult modal

For example: makeModal("example")


For makeModalConfirm():

options = {
    header: 'string' - you can set header
    message: 'string' - you can set message, deafult: "Czy na pewno?"
    size: 'string' - you can set the modal size as above 
    titleTag: 'string' - you can set the modal header tag as above
    keyboard: 'boolen' - as above
    alertType: 'string' - as above
    confirmBtnText: 'string' -  you can set confirm button text, deafult: 'Tak'
    cancelBtnText: 'string' - you can set cancel button text, deafult: 'Nie'
    backdrop: 'boolean' - as above
    focus: 'boolean' - as above
}

makeModalConfirm(options)

Additionaly this modal return promise, so when user press the button this modal return true or false


Finally you can call makeModalConfirm without the object, if you do that the variable you set will be used instead of the body to build
deafult modal as above

For makeModalAlert():

options = {
    header: 'string' - as above
    message: 'string' - as above
    size: 'string' - as above, deafult: 'sm'
    titleTag: 'string' - as above, deafult: 'h4'
    keyboard: 'boolen' - as above, deafult: 'true'
    alertType: 'string' - as above, deafult: 'light'
    backdrop: 'boolean' - as above, deafult: 'true'
    focus: 'boolean' - as above, deafult: 'true'
}

makeModalAlert(options)

Additionaly you can call makeModalConfirm without the object, if you do that the variable you set will be used instead of the body to build
deafult modal as above

*/

function setCloseBtnStatus(alertType){
    switch (alertType) {
        case "primary":
            return true
            
        case "secondary":
            return true
            
        case "success":
            return true
            
        case "danger":
            return true
            
        case "dark":
            return true
            
        default:
            return false
            
    }
}
function buildContentModal(modalContent, deafultOptions){
    //set colour variant
    const lightCloseBtn = deafultOptions.alertType ? setCloseBtnStatus(deafultOptions.alertType) : false

    if(deafultOptions.header){
        //deafult content: create header
        const modalHeader = document.createElement('div')
        modalHeader.classList.add('modal-header')
        modalHeader.classList.add(`text-bg-${deafultOptions.alertType}`)
        modalHeader.setAttribute("data-bs-theme", lightCloseBtn === true ? 'dark' : 'light')

        const modalHeaderContent = document.createElement(deafultOptions.titleTag)
        modalHeaderContent.classList.add('modal-title')
        modalHeaderContent.innerHTML = deafultOptions.header

        const closeBtn = document.createElement('button')
        closeBtn.classList.add('btn-close')
        closeBtn.setAttribute('type','button')
        closeBtn.setAttribute('data-bs-dismiss', 'modal')
        closeBtn.setAttribute('aria-label','Close')
        closeBtn.setAttribute('value',false)

        modalHeader.appendChild(modalHeaderContent)
        modalHeader.appendChild(closeBtn)
        modalContent.appendChild(modalHeader)
    }

    //deafult content: create body
    const modalBody = document.createElement('div')
    modalBody.classList.add('modal-body')
    modalBody.innerHTML = deafultOptions.body

    modalContent.appendChild(modalBody)

    //deafult content: create footer
    if(!deafultOptions.footer){
        return modalContent
    }
    const modalFooter = document.createElement('div')
    modalFooter.setAttribute('id','contentModalFooter')
    modalFooter.classList.add('modal-footer')
    if(typeof deafultOptions.footer === 'object'){
        modalFooter.appendChild(deafultOptions.footer)
    }
    else{
        modalFooter.innerHTML = deafultOptions.footer
    }
    modalContent.appendChild(modalFooter)
    return modalContent
}
function buildBaseModal(deafultOptions){
    const modals = document.querySelectorAll('.modal')
    const modalsBackdrops = document.querySelectorAll('.modal-backdrop')
    let zIndex
    let backdropZIndex
    if(modals.length > 0 && modalsBackdrops.length > 0){
        zIndex = parseInt(window.getComputedStyle(modals.item(modals.length - 1)).getPropertyValue('z-index')) + 1
        backdropZIndex = parseInt(window.getComputedStyle(modalsBackdrops.item(modalsBackdrops.length - 1)).getPropertyValue('z-index')) + 1
        let dif =  zIndex - backdropZIndex
        zIndex += dif
        backdropZIndex += dif
    }
    //create a modal base
    const modalId = Math.floor(Math.random() * 1001) + "-" + Math.floor(Math.random() * 1001)
    const modalWrap = document.createElement('div')
    modalWrap.id = `contentModal-${modalId}`
    modalWrap.classList.add('modal')
    modalWrap.classList.add('fade')
    modalWrap.style.zIndex = zIndex

    const modalDialog = document.createElement('div')
    modalDialog.classList.add('modal-dialog')
    if(deafultOptions.fullscreen){
        modalDialog.classList.add('modal-fullscreen')
    }
    else{
        modalDialog.classList.add(`modal-${deafultOptions.size}`)
    }
    if(deafultOptions.scrollable){
        modalDialog.classList.add('modal-dialog-scrollable')
    }

    const modalContent = document.createElement('div')
    modalContent.classList.add('modal-content')

    return {
        modalWrap,
        modalDialog,
        modalContent,
        modalId,
        backdropZIndex
    }
}
function runModal(modal,deafultOptions){

    //create modal
    modal.modalDialog.appendChild(modal.modalContent)
    modal.modalWrap.appendChild(modal.modalDialog)

    document.body.appendChild(modal.modalWrap)
    //show modal
    const contentModal = new bootstrap.Modal(`#${modal.modalWrap.id}`,{
        keyboard: deafultOptions.keyboard,
        backdrop: deafultOptions.backdrop,
        focus: deafultOptions.focus
    })
    //add event after close modal
    const thisModal = document.getElementById(modal.modalWrap.id)
    thisModal.addEventListener('hidden.bs.modal', event => {
    if (deafultOptions.reloadPage) {
    //reload page
        location.reload()
    }
    //remove modal
    thisModal.remove()
    }) 

    contentModal.show()
    //show mulitple modal
    if(modal.backdropZIndex){
        const modalsBackdrops = document.querySelectorAll('.modal-backdrop')
        const modalBackdrop = modalsBackdrops.item(modalsBackdrops.length - 1)
        modalBackdrop.style.zIndex = modal.backdropZIndex
    }
    //run scripts
    const scriptElements = modal.modalWrap.querySelectorAll('script')
    scriptElements.forEach((scriptEl)=>{
        eval(scriptEl.textContent)
    })
    return contentModal
}
function createFooter(deafultOptions, alert = false){
    //create footer
    const footer = document.createElement('div')
    footer.classList.add('hstack')
    footer.classList.add('gap-2')

    if(alert){
        const closeBtn = document.createElement('button')
        closeBtn.classList.add('btn')
        closeBtn.classList.add('btn-primary')
        closeBtn.classList.add('btn-sm')
        closeBtn.setAttribute('type','button')
        closeBtn.setAttribute('data-bs-dismiss', 'modal')
        closeBtn.innerText = 'OK'

        footer.append(closeBtn)
        return footer
    }
    const confirmBtn = document.createElement('button')
    confirmBtn.classList.add('btn')
    confirmBtn.classList.add('btn-primary')
    confirmBtn.classList.add('btn-sm')
    confirmBtn.setAttribute('type','button')
    confirmBtn.setAttribute('value',true)
    confirmBtn.setAttribute('data-bs-dismiss', 'modal')

    if(deafultOptions.confirmBtnText){
        confirmBtn.innerText = deafultOptions.confirmBtnText
    }
    else{
        const confirmIcon = document.createElement('i')
        confirmIcon.classList.add('bi')
        confirmIcon.classList.add('bi-check-lg')
        confirmBtn.innerText = "Tak"
        confirmBtn.prepend(confirmIcon)
    }

    footer.appendChild(confirmBtn)

    const cancelBtn = document.createElement('button')
    cancelBtn.classList.add('btn')
    cancelBtn.classList.add('btn-danger')
    cancelBtn.classList.add('btn-sm')
    cancelBtn.setAttribute('type','button')
    cancelBtn.setAttribute('value',false)
    cancelBtn.setAttribute('data-bs-dismiss', 'modal')

    if(deafultOptions.cancelBtnText){
        cancelBtn.innerText = deafultOptions.cancelBtnText
    }
    else{
        const cancelIcon = document.createElement('i')
        cancelIcon.classList.add('bi')
        cancelIcon.classList.add('bi-x-lg')
        cancelBtn.innerText = "Nie"
        cancelBtn.prepend(cancelIcon)
    }

    footer.appendChild(cancelBtn)
    return footer
}
//use to make normal modal
function makeModal(options = {}){ //return object
    //set modal settings
    let deafultOptions = {
        contentType: 'html',
        header: '',
        footer:'',
        body:'',
        size:'lg',
        titleTag:'h4',
        keyboard: true,
        reloadPage:false,
        alertType:'light',
        backdrop:true,
        focus:false,
        fullscreen:false,
        scrollable:false
    }
    if(typeof options === 'object' && Object.keys(options).length > 0){
        deafultOptions.contentType = 'contentType' in options ? options.contentType : deafultOptions.contentType
        deafultOptions.header = 'header' in options ? options.header : deafultOptions.header
        deafultOptions.body = 'body' in options ? options.body : deafultOptions.body
        deafultOptions.footer = 'footer' in options ? options.footer : deafultOptions.footer
        deafultOptions.size = 'size' in options ? options.size : deafultOptions.size
        deafultOptions.titleTag = 'titleTag' in options ? options.titleTag : deafultOptions.titleTag
        deafultOptions.keyboard = 'keyboard' in options ? options.keyboard : deafultOptions.keyboard
        deafultOptions.reloadPage = 'reloadPage' in options ? options.reloadPage: deafultOptions.reloadPage
        deafultOptions.alertType = 'alertType' in options ? options.alertType : deafultOptions.alertType
        deafultOptions.backdrop = 'backdrop' in options ? options.backdrop : deafultOptions.backdrop
        deafultOptions.focus = 'focus' in options ? options.focus : deafultOptions.focus
        deafultOptions.fullscreen = 'fullscreen' in options ? options.fullscreen : deafultOptions.fullscreen
        deafultOptions.scrollable = 'scrollable' in options ? options.scrollable : deafultOptions.scrollable
    }
    else if(typeof options === 'object' && Object.keys(options).length === 0){
        deafultOptions.contentType = 'object'
    }
    else if (Object.keys(options).length > 0){ 
        deafultOptions.contentType = 'html'
        deafultOptions.body = options
    }

    
    //get modal components
    const modal = buildBaseModal(deafultOptions)

    if(deafultOptions.contentType === 'html'){
        //self content from body
        modal.modalContent.innerHTML = deafultOptions.body
    }
    else{
        //build content from object
        modal.modalContent = buildContentModal(modal.modalContent,deafultOptions)
    }
    //show modal and modal return
    return runModal(modal,deafultOptions)
}
//use to make confirm modal
async function makeModalConfirm(options = {}){//return promise: bool
    //set modal settings
    let deafultOptions = {
        header:'',
        message:'Czy na pewno?',
        size:'sm',
        titleTag:'h4',
        keyboard:true,
        alertType:'light',
        confirmBtnText:'',
        cancelBtnText:'',
        backdrop:true,
        focus:true,
        reloadPage:false,
        footer:'',
        fullscreen:false,
        scrollable:false
    }

    if(typeof options === 'object'){
        deafultOptions.header = 'header' in options ? options.header : deafultOptions.header
        deafultOptions.message = 'message' in options ? encodeURIComponent(options.message) : deafultOptions.message
        deafultOptions.size = 'size' in options ? options.size : deafultOptions.size
        deafultOptions.titleTag = 'titleTag' in options ? options.titleTag : deafultOptions.titleTag
        deafultOptions.keyboard = 'keyboard' in options ? options.keyboard : deafultOptions.keyboard
        deafultOptions.alertType = 'alertType' in options ? options.alertType : deafultOptions.alertType
        deafultOptions.confirmBtnText = 'confirmBtnText' in options ? encodeURIComponent(options.confirmBtnText) : deafultOptions.confirmBtnText
        deafultOptions.cancelBtnText = 'cancelBtnText' in options ? encodeURIComponent(options.cancelBtnText) : deafultOptions.cancelBtnText
        deafultOptions.backdrop = 'backdrop' in options ? options.backdrop : deafultOptions.backdrop
        deafultOptions.focus = 'focus' in options ? options.focus : deafultOptions.focus
        deafultOptions.fullscreen = 'fullscreen' in options ? options.fullscreen : deafultOptions.fullscreen
        deafultOptions.scrollable = 'scrollable' in options ? options.scrollable : deafultOptions.scrollable
    }
    else{
        deafultOptions.message = options
    }

    //get modal components
    const modal = buildBaseModal(deafultOptions)

    //get modal footer
    deafultOptions.footer = createFooter(deafultOptions)
    
    //get modal body
    deafultOptions.body = deafultOptions.message
    modal.modalContent = buildContentModal(modal.modalContent, deafultOptions)

    //show modal
    runModal(modal, deafultOptions)

    //return promise
    const buttons = modal.modalContent.querySelectorAll('button')
    return new Promise((resolve)=>{
        buttons.forEach(e =>{
            if(e.value){
                e.addEventListener('click',()=>{
                    resolve(e.value === 'true') 
                })
            }
        }) 
    })
}
//use to make alert modal
function makeModalAlert(options = {}){//return object
    //set modal settings
    let deafultOptions = {
        header:'',
        message:'Czy na pewno?',
        size:'sm',
        titleTag:'h4',
        keyboard:true,
        alertType:'light',
        backdrop:true,
        focus:true,
        reloadPage:false,
        footer:'',
        confirmBtnText:'',
        cancelBtnText:'',
        fullscreen:false,
        scrollable:false
    }

    if(typeof options === 'object'){
        deafultOptions.header = 'header' in options ? options.header : deafultOptions.header
        deafultOptions.message = 'message' in options ? encodeURIComponent(options.message) : deafultOptions.message
        deafultOptions.size = 'size' in options ? options.size : deafultOptions.size
        deafultOptions.titleTag = 'titleTag' in options ? options.titleTag : deafultOptions.titleTag
        deafultOptions.keyboard = 'keyboard' in options ? options.keyboard : deafultOptions.keyboard
        deafultOptions.alertType = 'alertType' in options ? options.alertType : deafultOptions.alertType
        deafultOptions.backdrop = 'backdrop' in options ? options.backdrop : deafultOptions.backdrop
        deafultOptions.focus = 'focus' in options ? options.focus : deafultOptions.focus
        deafultOptions.fullscreen = 'fullscreen' in options ? options.fullscreen : deafultOptions.fullscreen
        deafultOptions.scrollable = 'scrollable' in options ? options.scrollable : deafultOptions.scrollable
    }
    else{
        deafultOptions.message = options
    }

    //get modal components
    const modal = buildBaseModal(deafultOptions)

    //get modal footer
    deafultOptions.footer = createFooter(deafultOptions, true)

    //get modal body
    deafultOptions.body = deafultOptions.message
    modal.modalContent = buildContentModal(modal.modalContent, deafultOptions)

    //show modal and return modal
    return runModal(modal, deafultOptions)
}