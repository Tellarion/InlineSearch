import axios from 'axios'

async function getData() {
    axios.post('request.php', {name: (<HTMLInputElement>document.getElementById('name')).value})
    .then(function(response) {
        console.log('data')
        const posts = document.querySelector('.posts') as HTMLElement
        let templateTpl = ``

        for(let i = 0; i < response.data.length; i++) {
            let data = JSON.parse(response.data[i])
            console.log(data)
            templateTpl += `<div class="zapis">[${data.postId}] ${data.title}</div><div class="comment">Comment: ${data.body}</div>`
        }

        posts.innerHTML = templateTpl
    
    })
    .catch(function(error) {
        console.log(error);
    });
}

document.getElementById("search").onclick = function(e)
{
    const element = (<HTMLInputElement>document.getElementById('name')).value
    if(element.length >= 3) {
        e.preventDefault()
        getData()
    } else {
        alert('Min 3 characters for input')
    }
}