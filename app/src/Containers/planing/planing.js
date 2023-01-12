import React from 'react'
import { NavLink, Outlet } from 'react-router-dom'

export default function planing() {
    return (
        <div>

            <div id='allPlaning'>
                <h1>Planing title</h1>
                <h1>Planing Commentaire</h1>
                <h1>Planing date start</h1>
                <h1>Planing date end</h1>
                <ul>
                    <li>transactions</li>
                    <li>transactions</li>
                </ul> 
            </div>
              
            <ul>

                <NavLink to="/planing" 
                    className={({isActive}) => { return isActive ? "activeLink" : ""}}
                >search</NavLink>
                
                <NavLink to="/planing/Create" 
                    className={({isActive}) => { return isActive ? "activeLink" : ""}}
                >Create</NavLink>
            
            </ul>
            <Outlet />
        </div>
    )
}
