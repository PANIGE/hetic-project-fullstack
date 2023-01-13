import React from 'react'
import { NavLink, Outlet } from 'react-router-dom'

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
                    <input type="text" name="title" id="title" />
                    <span></span>
                    <label for="title">Title</label>
                </div>

                <div className='div_input'>
                    <input type="text" name="commentaire" id="commentaire" />
                    <span></span>
                    <label for="commentaire">Commentaire</label>
                </div>

                <div className='div_input'>
                    <input type="date" name="dateMin" id="dateMin" required />
                    <span></span>
                    <label for="dateMin">date min</label>
                </div>

                <div className='div_input'>
                    <input type="date" name="dateMax" id="dateMax" required />
                    <span></span>
                    <label for="dateMin">date max</label>
                </div>
                
                <button id="send" type="submit">Submit</button>
            </form>

            <NavLink to="/report/" id='searchBtn'
                className={({isActive}) => { return isActive ? "sectionLink" : "vueLink"}}
            >-</NavLink>
                    
        </div>
    )
    
    
}
