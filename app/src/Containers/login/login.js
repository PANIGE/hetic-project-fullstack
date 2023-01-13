import React from 'react'

export default function report() {

    function handleClick(e) {
        e.preventDefault();
            
            fetch('http://localhost:3000/report/create', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    title: 'foo',
                    body: 'bar',
                    userId: 1
                    })
        })
        .then((response) => {
            return response.json()
        })
    }

    return (
        <div className='form'>
            <form onSubmit={handleClick}>
                
                <div className='div_input'>
                    <input type="text" name="email" id="email" />
                    <span></span>
                    <label for="email">E-mail</label>
                </div>

                <div className='div_input'>
                    <input type="text" name="mdp" id="mdp" />
                    <span></span>
                    <label for="mdp">Mot de passe</label>
                </div>
                
                <input type="submit" id="send" value="Se connecter"/>
            </form>
        </div>
    )
    
    
}
