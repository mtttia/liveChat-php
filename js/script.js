const server = 'http://localhost/chat_php/server.php';
let id = 0;

$(document).ready(() =>{
   const nome = prompt('come ti chiami?');
   $('#send').submit(() =>{
         $.post(server, 
         {
            message : $('#message').val(),
            sender : nome
         });
         $('#message').val('');
         return false;
   })

   load();

});

function load()
{
   $.get(server + '?start=' + id, (data)=>{
         //console.log('messaggio');
         //console.log(data);
         
         
         data.forEach(row => {
            //message = messaggio, sender = chi l'ha inviato
            let div = document.createElement('div');
            let sender = document.createElement('p');
            let message = document.createElement('p');
            div.setAttribute('class', 'packet');
            sender.setAttribute('class', 'm sender');
            message.setAttribute('class', 'm message');
            sender.innerHTML= row.sender;
            message.innerHTML= row.message;
            div.appendChild(sender);
            div.appendChild(message);
            document.getElementById('chat').appendChild(div);
            id++;
         });

         setTimeout(() => {
            load(); 
         }, 500);
         
   })
}
