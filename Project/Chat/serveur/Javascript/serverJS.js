var socket = io('http://localhost:4500')
const messageForm = document.getElementById("send-container")
const messageInput = document.getElementById('message-input')
const messageContainer = document.getElementById('message-container')

const name = prompt('what is your name')
appendMessage('you joined')
if(name !== null){
    socket.emit('new-user', name)
}else{
    socket.emit('new-user', "Anon")
}





socket.on('chat-message', data => {
    console.log(data)
    appendMessage(`${data.name}: ${data.message}`)
})
socket.on('user-connected', name => {
    console.log(name)
    appendMessage(`${name} connected`)
    
})
socket.on('user-disconnected', name => {
    console.log(name)
    appendMessage(`${name} disconnected`)
    
})

messageForm.addEventListener('submit', e => {
    e.preventDefault()
    const message = messageInput.value
    appendMessage(`You: ${message}`)
    socket.emit('send-chat-message', message)
    messageInput.value = ''
})

function appendMessage(message) {
    const messageElement = document.createElement('div')
    messageElement.innerHTML = message
    messageContainer.append(messageElement)
}



//--------------------

