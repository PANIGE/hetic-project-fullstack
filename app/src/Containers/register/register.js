import React from 'react'
import { NavLink } from 'react-router-dom';
import './register.css'

export default function register() {
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
        <div className='form_login'>
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

                <div className='div_input'>
                    <input type="text" name="confirmMdp" id="conirmMdp" />
                    <span></span>
                    <label for="confirmMdp">Confirmer le mot de passe</label>
                </div>
                
                <input type="submit" id="send" value="S'inscrire"/>

                <NavLink to="/login/" 
                className={({isActive}) => { return isActive ? "sectionLink" : " "}}
            >Déjà un compte ?</NavLink>

            </form>
            


        </div> 
        
    )
}
