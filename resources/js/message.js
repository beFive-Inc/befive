window.addEventListener('DomContentLoaded', () => {
    console.log(uuid);
})

Echo.join(`chatroom.${uuid}`)
    .here(users => {
        console.log(users)
    })
    .joining(user => {
        console.log(user.name + ' a rejoint')
    })
    .leaving(user => {
        console.log(user.name + ' est parti')
    })
    .listen('MessageSent', (e) => {
        window.livewire.emit('messageSent', e.message)
    });
