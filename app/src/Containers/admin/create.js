import React from 'react'
import { NavLink, Outlet } from 'react-router-dom'

export default function report() {
    
    function handleClick(e) {
        e.preventDefault();

        fetch('http://localhost:3000/admin/create', {
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
        <div className="adminCreate">
        <div className='form'>
            <form onSubmit={handleClick}>
                <div className='div_input '>
                    <input type="text" name="email" id="email" required />
                    <span></span>
                    <label for="email">E-mail</label>    
                </div>
                
                <input type="submit" id="send" value="Submit"/>
                
            </form>

            <NavLink to="/admin/" id='searchBtn'
                className={({isActive}) => { return isActive ? "sectionLink" : "vueLink"}}
            >-</NavLink>
        
        </div>
        </div>
    )
}