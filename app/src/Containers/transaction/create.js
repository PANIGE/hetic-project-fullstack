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
                    <select name="type" id="type">
                        <option value="dog">1</option>
                        <option value="cat">2</option>
                        <option value="hamster">3</option>
                    </select>  
                    <label for="type">Choose a type:</label>
                </div>

                <div className='div_input '>
                    <input type="text" name="reason" id="reason" required />
                    <span></span>
                    <label for="reason">Reason</label>    
                </div>

                <div className='div_input '>
                    <input type="text" name="value" id="value" required />
                    <span></span>
                    <label for="value">Value</label>    
                </div>
                
                <input type="submit" id="send" value="Submit"/>
                
            </form>

            <NavLink to="/transaction/" id='searchBtn'
                className={({isActive}) => { return isActive ? "sectionLink" : "vueLink"}}
            >-</NavLink>
        
        </div>
        </div>
    )
}