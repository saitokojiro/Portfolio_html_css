const express = require('express')
const app = express()
const server = require('http').Server(app)
const io = require('socket.io')(server) 
const colors = require('colors');



colors.setTheme({
    info: 'bgGreen',
    help: 'cyan',
    warn: 'yellow',
    success: 'bgBlue',
    error: 'red'
  });

const users = {}
const usersrnd = {}
const rooms = {}
/*
//routes
app.get('/', (req,res)=>{
    res.sendFile(__dirname + './views/index.html');
});
*/
io.on('connection', socket => {
    console.log('New User');
    socket.on('new-user', name => {
        users[socket.id] = name
        console.log(`new user: ${users[socket.id]}`)
        socket.broadcast.emit('user-connected', name)
        
    })

    socket.on('send-chat-message', message => {
        console.log(users[socket.id]+": "+ message )
        socket.broadcast.emit('chat-message', {message: message, name: users[socket.id]})
    })
    socket.on('disconnect', () => {
        socket.broadcast.emit('user-disconnected' , users[socket.id])
        console.log(`user disconnected: ${users[socket.id]}`)
        delete users[socket.id]
    })
})
console.log("--------------------------------".red)
console.log("Serveur : ".cyan + "Online".green)
console.log("Chat : ".cyan + "Online".green)
console.log("--------------------------------".red)



server.listen( process.env.PORT || 4500);






function rndnb(min, max) {
    return Math.floor(Math.random() * (max - min)) + min;
}


//------------------------------------------------------

/*
app.set('views','./views')
app.set('view engine', 'ejs')
app.use(express.static('public'));
app.use(express.urlencoded({extended: true}))
*/

/*
app.get('/', (req, res) => {
    res.render('index', {room: rooms})
})

app.get('/:room',(req, res) => {
    res.render ('room', {roomName: req.params.room})
})

const user = {}
*/




/*
   socket.on('new-user', name => {
        user[socket.id] = name
        socket.broadcast.emit
        ('user-connected', name)
    })
*/